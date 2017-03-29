<?php
require __DIR__ . "/../inc/bootstrap.php";

$appId = request()->get('appId');
$appTime = request()->get('time');

if (round((strtotime($appTime) - strtotime(date('Y-m-d H:i:s'))) / 3600, 1) > 10) {
    try {
        deleteAppointment($appId);
        $session->getFlashBag()->add('success', 'Appointment deleted');
        redirect('/viewStudAppointments.php');
    } catch (\Exception $e) {
        $session->getFlashBag()->add('error', 'Error cancelling Appointment');
        redirect('/viewStudAppointments.php');
    }
} else {
    $session->getFlashBag()->add('error', "You can't cancel this appointment, It's due in less than 10 hours<br/><a href='/inbox.php'>Contact</a> your supervisor");
    redirect('/viewStudAppointments.php');
}