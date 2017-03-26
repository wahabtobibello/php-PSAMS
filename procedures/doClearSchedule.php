<?php require_once __DIR__ . '/../inc/bootstrap.php';
$id = request()->get('id');
$staffNumber = request()->get('sn');
try {
    clearSchedule($id, $staffNumber);
    redirect('../viewSchedule.php');
} catch (\Exception $e) {
    echo "Error Clearing";
}