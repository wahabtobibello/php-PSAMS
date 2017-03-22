<?php require_once __DIR__ . '/../inc/bootstrap.php';
$id = request()->get('id');
try {
    clearSchedule($id);
    redirect('../viewSchedule.php');
} catch (\Exception $e) {
    echo "Error Clearing";
}