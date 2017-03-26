<?php
require __DIR__ . '/../inc/bootstrap.php';
requireAuth();

$currPassword = request()->get('oldPassword');
$newPassword = request()->get('newPassword');
$confirmPassword = request()->get('confirmPassword');

if ($newPassword != $confirmPassword) {
    $session->getFlashBag()->add('error', 'New passwords do not match, please try again.');
    redirect('/changePassword.php');
}

$user = findUser();

if (empty($user)) {
    $session->getFlashBag()->add('error', 'Some Error Happened. Try again. If it continues please log out and log back in.');
    redirect('/changePassword.php');
}

if (!password_verify($currPassword, $user['user_password'])) {
    $session->getFlashBag()->add('error', 'Current Password is incorrect, please try again.');
    redirect('/changePassword.php');
}

$updated = updatePassword(password_hash($newPassword, PASSWORD_DEFAULT), $user['id']);

if (!$updated) {
    $session->getFlashBag()->add('error', 'Could not update password, Please try again.');
    redirect('/changePassword.php');
}

$session->getFlashBag()->add('success', 'Password Updated');
redirect('/changePassword.php');