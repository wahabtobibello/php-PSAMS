<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$dayId = request()->get('id');
$appointmentDate = request()->get('appointmentDate');
$appointmentTime = request()->get('appointmentTime');

$combined = date('Y-m-d H:i:s', strtotime("$appointmentDate $appointmentTime"));
$user = findUser();
insertAppointment($dayId, $user['matric_number'], $combined, $user['staff_number']);
$session->getFlashBag()->add('success', 'Appointment Booked');
redirect('/index.php');


