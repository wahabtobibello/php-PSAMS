<?php
require_once __DIR__ . "/../inc/bootstrap.php";

$sender = findUser();
$recipientID = request()->get('recipient');
$subject = request()->get('subject');
$message = request()->get('messageText');
$time = request()->get('time');

echo "$recipientID, $subject, $message";
try {
    postMessage($sender['user_number'], $recipientID, $subject, $message);
    $session->getFlashBag()->add('success', 'Message sent');
    if (!empty($time)) {
        deleteAppointment($recipientID, $time);
        $session->getFlashBag()->add('info', 'Appointment Deleted');
        redirect('/viewAppointment.php');
    }
    redirect('/inbox.php');
} catch (\Exception $e) {
    $session->getFlashBag()->add('error', 'Error sending message');
    redirect('/inbox.php');
}