<?php

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function
request()
{
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function redirect($path, $extra = [])
{
    $response = \Symfony\Component\HttpFoundation\Response::create(null, \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location' => $path]);
    if (key_exists('cookies', $extra)) {
//        echo "hi there";
//        var_dump($extra['cookies'][0]);
        foreach ($extra['cookies'] as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }
    $response->send();
    exit;
}

function getDailySchedule()
{
    global $db;
    try {
        $query = "SELECT day_t.day_id AS day_id, day, from_time, to_time, appointment_max
              FROM day_t
              LEFT OUTER JOIN schedule_t ON day_t.day_id = schedule_t.day_id
              ORDER BY day_id;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function clearSchedule($id)
{
    global $db;
    try {
        $query = "UPDATE schedule_t
              SET from_time=NULL, to_time=NULL, appointment_max=NULL
              WHERE day_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function updateSchedule($id, $from, $to, $max)
{
    global $db;
    try {
        $query = "UPDATE schedule_t
              SET from_time=?, to_time=?, appointment_max=?
              WHERE day_id = ? ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $from);
        $stmt->bindParam(2, $to);
        $stmt->bindParam(3, $max);
        $stmt->bindParam(4, $id);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function getAllAppointments()
{
    global $db;
    try {
        $query = "SELECT day_t.day_id AS day_id, day, from_time, to_time, appointment_max
              FROM day_t
              LEFT OUTER JOIN schedule_t ON day_t.day_id = schedule_t.day_id
              ORDER BY day_id;";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function findStudentByMatricNo($matricNo)
{
    global $db;
    try {
        $query = "SELECT * 
                  FROM student_t
                  WHERE matric_number = :matricNo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matricNo', $matricNo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getAdminDetails($staffNumber)
{
    global $db;
    try {
        $query = "SELECT * 
                  FROM supervisor_t
                  WHERE staff_number = :staffNumber";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':staffNumber', $staffNumber, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function createStudentUser($firstName, $lastName, $project, $matricNo, $password)
{
    global $db;
    try {
        $query = "INSERT INTO student_t
                  (matric_number, first_name, last_name, user_password, staff_number, project)
                  VALUES
                  (:matricNo, :firstName, :lastName, :userPassword, 123456789, :project)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matricNo', $matricNo, PDO::PARAM_INT);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':userPassword', $password);
        $stmt->bindParam(':project', $project);
        $stmt->execute();
        return findStudentByMatricNo($matricNo);
    } catch (\Exception $e) {
        throw $e;
    }
}

function isAuthenticated()
{
    if (!request()->cookies->has("access_token")) {
        return false;
    }
    try {
        \Firebase\JWT\JWT::$leeway = 1;
        \Firebase\JWT\JWT::decode(
            request()->cookies->get('access_token'),
            getenv('SECRET_KEY'),
            ['HS256']
        );
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function requireAuth()
{
    if (!isAuthenticated()) {
        $accessToken = new Symfony\Component\HttpFoundation\Cookie(
            'access_token', 'Expired', time() - 3600, '/', getenv(COOKIE_DOMAIN));
        redirect("/login.php", ['cookies' => [$accessToken]]);
    }
}