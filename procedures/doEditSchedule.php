<?php require_once __DIR__ . '/../inc/bootstrap.php';

$id = request()->get('id');
$from = request()->get('from');
$to = request()->get('to');
$max = request()->get('maxApp');
try {
    updateSchedule($id, $from, $to, $max);
    redirect("../viewSchedule.php");
} catch (\Exception $e) {
    echo "Error Saving";
    echo $e;
}