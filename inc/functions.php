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

function postMessage($senderId, $recipientId, $subject, $message)
{
    global $db;
    try {
        $query = "INSERT INTO message_t
                (subject, text_message, sender_id, recipient_id)
                VALUES
                (:subject, :text, :senderId, :recipientId)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":subject", $subject);
        $stmt->bindParam(":text", $message);
        $stmt->bindParam(":senderId", $senderId);
        $stmt->bindParam(":recipientId", $recipientId);
        return $stmt->execute();
    } catch (\Exception $e) {
        throw $e;
    }
}

function getInbox()
{
    $user = findUser();
    global $db;

    try {
        $query = "SELECT *
                  FROM message_t
                  JOIN user_t ON sender_id = user_number
                  WHERE recipient_id = :myId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':myId', $user['user_number']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
}

function getSentMessages()
{
    $user = findUser();
    global $db;

    try {
        $query = "SELECT *
                  FROM message_t
                  JOIN user_t ON recipient_id = user_number
                  WHERE sender_id = :myId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':myId', $user['user_number']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw $e;
    }
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

function getAppointments($staffNumber)
{
    global $db;
    try {
        $query = "SELECT `day`, appointment_time, appointment_t.matric_number, CONCAT(first_name,' ',last_name) AS full_name
                  FROM appointment_t
                  JOIN day_t ON day_t.day_id = appointment_t.day_id
                  JOIN user_t ON user_t.user_number = appointment_t.matric_number
                  ORDER BY appointment_time;
                  WHERE staff_number = :staffNumber";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':staffNumber', $staffNumber);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function getMyAppointments($matric)
{
    global $db;
    try {
        $query = "SELECT appointment_id, `day`, appointment_time
                  FROM appointment_t
                  JOIN day_t ON day_t.day_id = appointment_t.day_id
                  ORDER BY appointment_time;
                  WHERE matric_number = :matric";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matric', $matric);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        throw $e;
    }
}

function getAppointment($id)
{
    global $db;
    try {
        $query = "SELECT appointment_id, `day`, appointment_time
                  FROM appointment_t
                  JOIN day_t ON day_t.day_id = appointment_t.day_id
                  ORDER BY appointment_time;
                  WHERE matric_number = :matric";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':matric', $matric);
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

function getAllStudents(){
    global $db;
    try {
        $query = "SELECT * 
                  FROM student_t
                  JOIN user_t ON student_t.matric_number = user_t.user_number";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

function numberOfSlotsLeftOnDate($datetime)
{
    global $db;
    try {
        $query = "SELECT schedule_t.appointment_max - COUNT(*) AS noOfAppoints
                  FROM appointment_t
                  JOIN schedule_t ON DAYOFWEEK('2017-05-01') = schedule_t.day_id
                  WHERE CAST(appointment_t.appointment_time AS DATE) = CAST(:datetime AS DATE)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":datetime", $datetime);
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (\Exception $e) {
        throw $e;
    }
}

function insertAppointment($dayId, $matricNo, $datetime, $staffNumber)
{
    global $db;
    try {
        $query = "INSERT INTO appointment_t (day_id, matric_number, appointment_time, staff_number)
                  VALUES
                  (:dayId, :matricNo, :datetime, :staffNumber)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dayId', $dayId);
        $stmt->bindParam(':matricNo', $matricNo);
        $stmt->bindParam(':datetime', $datetime);
        $stmt->bindParam(':staffNumber', $staffNumber);
        return $stmt->execute();
    } catch (Exception $e) {
        throw $e;
    }
}

function deleteAppointment($id)
{
    global $db;
    try {
        $query = "DELETE FROM appointment_t
                  WHERE appointment_id=?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    } catch (Exception $e) {
        throw $e;
    }
}

function updateProfile($firstName, $lastName, $project, $matricNo, $pictureFile = null)
{
    global $db;
    try {
        $query = "UPDATE user_t
                  SET first_name=:firstName,last_name=:lastName
                  WHERE user_number=:matricNo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':matricNo', $matricNo);
        $stmt->execute();
        $query = "UPDATE student_t
                  SET project=:project";
        if ($pictureFile !== null)
            $query .= ",profile_picture=:pictureFile";
        $query .= " WHERE matric_number =:matricNo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':project', $project);
        if ($pictureFile !== null)
            $stmt->bindParam(':pictureFile', $pictureFile);
        $stmt->bindParam(':matricNo', $matricNo);
        return $stmt->execute();
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

    $response = "<div class='alert alert-danger alert-dismissible' > ";
    foreach ($messages as $message) {
        $response .= "
            $message<br />";
    }
    $response .= "</div > ";

    return $response;
}

function displaySuccess()
{
    global $session;

    if (!$session->getFlashBag()->has('success')) {
        return;
    }
    $messages = $session->getFlashBag()->get('success');

    $response = "<div class='alert alert-success alert-dismissible' > ";
    foreach ($messages as $message) {
        $response .= "
            $message<br />";
    }
    $response .= "</div > ";

    return $response;
}

function displayInfo()
{
    global $session;

    if (!$session->getFlashBag()->has('info')) {
        return;
    }
    $messages = $session->getFlashBag()->get('info');

    $response = "<div class='alert alert-info alert-dismissible' > ";
    foreach ($messages as $message) {
        $response .= "
            $message<br />";
    }
    $response .= "</div > ";

    return $response;
}

