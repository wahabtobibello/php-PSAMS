<?php require __DIR__ . '/../inc/bootstrap.php';

$id = request()->get('id');
$from = request()->get('from');
$to = request()->get('to');
$max = request()->get('maxApp');
$staffNumber = request()->get('sn');

try {
    if (strtotime($to) <= strtotime($from)) throw new Exception('Bad Time Format', 5);
    updateSchedule($id, $from, $to, $max, $staffNumber);
    $session->getFlashBag()->add('success', 'Schedule Updated');
    redirect("../viewSchedule.php");
} catch (\Exception $e) {
    if ($e->getCode() == 5)
        $session->getFlashBag()->add('error', $e->getMessage());
    $session->getFlashBag()->add('error', 'Error updating schedule');
    redirect('/viewSchedule.php');
}