<?php require __DIR__ . '/../inc/bootstrap.php';

$id = request()->get('id');
$from = request()->get('from');
$to = request()->get('to');
$max = request()->get('maxApp');
$staffNumber = request()->get('sn');
try {
    updateSchedule($id, $from, $to, $max, $staffNumber);
    $session->getFlashBag()->add('sucess', 'Schedule Updated');
    redirect("../viewSchedule.php");
} catch (\Exception $e) {
    $session->getFlashBag()->add('error', 'Error updating schedule');
    redirect('/viewSchedule.php');
}