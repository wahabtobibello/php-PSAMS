<?php require __DIR__ . '/../inc/bootstrap.php';

$id = request()->get('id');
$from = request()->get('from');
$to = request()->get('to');
$max = request()->get('maxApp');
$staffNumber = request()->get('sn');
try {
    updateSchedule($id, $from, $to, $max, $staffNumber);
    redirect("../viewSchedule.php");
} catch (\Exception $e) {
    echo "Error Saving";
    echo $e;
}