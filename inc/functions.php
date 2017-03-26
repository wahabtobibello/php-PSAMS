<?php

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */

function request()
{
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function redirect($path, $extra = [])
{
    $response = \Symfony\Component\HttpFoundation\Response::create(null, \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location' => $path]);
    if (key_exists('cookies', $extra)) {
        foreach ($extra['cookies'] as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }
    $response->send();
    exit;
}

function decodeJwt($prop = null)
{
    \Firebase\JWT\JWT::$leeway = 1;
    $jwt = \Firebase\JWT\JWT::decode(
        request()->cookies->get('access_token'),
        getenv('SECRET_KEY'),
        ['HS256']
    );

    if ($prop === null) {
        return $jwt;
    }

    return $jwt->{$prop};
}

function getDailySchedule($staffNumber)
{
    global $db;
    try {
        $query = "SELECT day_t.day_id AS day_id, day, from_time, to_time, appointment_max
                  FROM day_t
                  LEFT OUTER JOIN schedule_t ON day_t.day_id = schedule_t.day_id
                  ORDER BY day_id;
                  WHERE staff_number = :staffNumber";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':staffNumber', $staffNumber);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function clearSchedule($id, $staffNumber)
{
    global $db;
    try {
        $query = "UPDATE schedule_t
              SET from_time=NULL, to_time=NULL, appointment_max=NULL
              WHERE day_id = ? AND staff_number = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $staffNumber, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function updateSchedule($id, $from, $to, $max, $staffNumber)
{
    global $db;
    try {
        $query = "UPDATE schedule_t
              SET from_time=?, to_time=?, appointment_max=?
              WHERE day_id = ? AND staff_number = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $from);
        $stmt->bindParam(2, $to);
        $stmt->bindParam(3, $max);
        $stmt->bindParam(4, $id);
        $stmt->bindParam(5, $staffNumber);
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

function findUser($userNo = null)
{
    global $db;
    try {
        if ($userNo === null) {
            $userNo = decodeJwt('sub');
        }
    } catch (\Exception $e) {
        throw $e;
    }
    try {
        $query = "SELECT * 
                  FROM user_t";
        $query .= " LEFT JOIN supervisor_t ON supervisor_t.staff_number = user_t.user_number 
                    LEFT JOIN title_t ON title_t.title_id = supervisor_t.title_id";
        $query .= " LEFT JOIN student_t ON student_t.matric_number = user_t.user_number";
        $query .= " WHERE user_t.user_number = :userNo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userNo', $userNo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
                  JOIN user_t ON student_t.matric_number = user_t.user_number
                  WHERE student_t.matric_number = :matricNo";
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
                  FROM user_t
                  JOIN supervisor_t ON supervisor_t.staff_number = user_t.user_number
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
        $query = "INSERT INTO user_t
                  (user_number, first_name,	last_name,	user_password)
                  VALUES
                  (:matricNo, :firstName, :lastName,:userPassword)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matricNo', $matricNo, PDO::PARAM_INT);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':userPassword', $password);
        $stmt->execute();
        $query = "INSERT INTO student_t
                  (matric_number, staff_number, project)
                  VALUES
                  (:matricNo, 123456789, :project)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matricNo', $matricNo, PDO::PARAM_INT);
        $stmt->bindParam(':project', $project);
        $stmt->execute();
        return findStudentByMatricNo($matricNo);
    } catch (\Exception $e) {
        throw $e;
    }
}

function updatePassword($password, $userId)
{
    global $db;

    try {
        $query = 'UPDATE user_t SET user_password=:password WHERE user_number = :userId';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    } catch (\Exception $e) {
        return false;
    }

    return true;
}


function isAuthenticated()
{
    if (!request()->cookies->has("access_token")) {
        return false;
    }
    try {
        decodeJwt();
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

function requireNotAuth()
{
    global $session;
    if (isAuthenticated()) {
        $session->getFlashBag()->add('info', 'Log out first');
        redirect("/index.php");
    }
}

function requireSupervisor()
{
    global $session;
    if (!isAuthenticated()) {
        $accessToken = new \Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time() - 3600, '/', getenv('COOKIE_DOMAIN'));
        redirect('/login.php', ['cookies' => [$accessToken]]);
    }

    try {
        if (!decodeJwt('is_admin')) {
            $session->getFlashBag()->add('error', 'Not Authorized');
            redirect('/');
        }
    } catch (\Exception $e) {
        $accessToken = new \Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time() - 3600, '/', getenv('COOKIE_DOMAIN'));
        redirect('/login.php', ['cookies' => [$accessToken]]);
    }
}

function requireStudent()
{
    global $session;
    if (!isAuthenticated()) {
        $accessToken = new \Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time() - 3600, '/', getenv('COOKIE_DOMAIN'));
        redirect('/login.php', ['cookies' => [$accessToken]]);
    }

    try {
        if (decodeJwt('is_admin')) {
            $session->getFlashBag()->add('error', 'Not Authorized');
            redirect('/');
        }
    } catch (\Exception $e) {
        $accessToken = new \Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time() - 3600, '/', getenv('COOKIE_DOMAIN'));
        redirect('/login.php', ['cookies' => [$accessToken]]);
    }
}

function isSupervisor()
{
    if (!isAuthenticated()) {
        return false;
    }

    try {
        $isAdmin = decodeJwt('is_admin');
    } catch (\Exception $e) {
        return false;
    }

    return (boolean)$isAdmin;
}

function displayErrors()
{
    global $session;

    if (!$session->getFlashBag()->has('error')) {
        return;
    }
    $messages = $session->getFlashBag()->get('error');

    $response = "<div class='alert alert-danger alert-dismissible'>";
    foreach ($messages as $message) {
        $response .= "{$message}<br/>";
    }
    $response .= "</div>";

    return $response;
}

function displaySuccess()
{
    global $session;

    if (!$session->getFlashBag()->has('success')) {
        return;
    }
    $messages = $session->getFlashBag()->get('success');

    $response = "<div class='alert alert-success alert-dismissible'>";
    foreach ($messages as $message) {
        $response .= "{$message}<br/>";
    }
    $response .= "</div>";

    return $response;
}

function displayInfo()
{
    global $session;

    if (!$session->getFlashBag()->has('info')) {
        return;
    }
    $messages = $session->getFlashBag()->get('info');

    $response = "<div class='alert alert-info alert-dismissible'>";
    foreach ($messages as $message) {
        $response .= "{$message}<br/>";
    }
    $response .= "</div>";

    return $response;
}

function landingPage()
{
    if (isSupervisor()) {
        redirect("/viewSchedule.php");
    } else {
        $supervisor = findUser(findUser()['staff_number']);
//        var_dump($supervisor);
        echo "<h5 class='mb-3'>" . $supervisor['title'] . " " . $supervisor['first_name'] . " "
                    . $supervisor['last_name'] . "'s schedule </h5>";
        echo "<table class='table table-striped table-hover' >
        <thead >
        <tr >
            <th > Day</th >
            <th > From</th >
            <th > To</th >
            <th > Max . number of appointments </th >
        </tr >
        </thead >
        <tbody >";
        foreach (getDailySchedule($supervisor['staff_number']) as $item) {
            $id = $item['day_id'];
            $day = $item['day'];
            $from = $item['from_time'];
            $to = $item['to_time'];
            $max = $item['appointment_max'];
            echo "<tr>";
            echo "<th scope=\"row\">" . $day . "</th>";
            echo "<td>" . $from . "</td>";
            echo "<td>" . $to . "</td>";
            echo "<td>" . $max . "</td>";
            echo "
            <td>
                <button type='button' class='btn btn-primary'
                data-day='" . $day . "' data-id='" . $id . "' data-from='" . $from
                . "' data-to='" . $to . "' data-max=" . $max . "
                >Book Appointment</button>
            </td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
}

