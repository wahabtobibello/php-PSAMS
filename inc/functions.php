<?php

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