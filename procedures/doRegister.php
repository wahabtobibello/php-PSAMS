<?php
require __DIR__ . "/../inc/bootstrap.php";

$firstName = request()->request->get('firstName');
$lastName = request()->request->get('lastName');
$matricNo = request()->request->get('matricNo');
$project = request()->request->get('project');
$password = request()->request->get('password');
$confirmPassword = request()->request->get('confirmPassword');

if($password != $confirmPassword){
    $session->getFlashBag()->add('error', "Passwords do not match");
    redirect('../register.php');
}
$user = findStudentByMatricNo($matricNo);
if(!empty($user)){
    $session->getFlashBag()->add('error', "Matric Number already exists");
    redirect('../register.php');
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$user = createStudentUser($firstName, $lastName, $project, $matricNo, $hashed);

$expTime = time() + 3600;

$jwt = \Firebase\JWT\JWT::encode([
    'iss' => request()->getBaseUrl(),
    'sub' => "{$user['user_number']}",
    'exp' => $expTime,
    'iat' => time(),
    'nbf' => time(),
    'is_admin' => $user['role_id'] == 1
], getenv("SECRET_KEY"));

$accessToken = new Symfony\Component\HttpFoundation\Cookie(
    "access_token", $jwt, $expTime, '/', getenv("COOKIE_DOMAIN"));

redirect("/", ['cookies' => [$accessToken]]);