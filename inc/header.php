<?php require_once __DIR__ . "/../inc/bootstrap.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Project Supervision Appointment Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/styles.css">
</head>
<!--body-->

<body>
<!--header-->
<header>
    <nav class="navbar navbar-toggleable-md navbar-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href=".">Project Supervision Appointment Management System
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <?php
                if (!isAuthenticated()) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logIn.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register.php">Register</a>
                    </li>
                <?php } else {
                    $user = findUser();
                    if (isSupervisor()) {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                Dashboard
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                <a class="dropdown-item" href="ViewSchedule.php">Schedule</a>
                                <a class="dropdown-item" href="ViewAppointment.php">Appointments</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/index.php">Dashboard</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink3"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            Messages
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                            <a class="dropdown-item" href="Inbox.php">Inbox</a>
                            <a class="dropdown-item" href="Sent.php">Sent</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                            <?php if (!isSupervisor()) { ?>
                                <a class="dropdown-item" href="#">John Doe<br/><span
                                            style="font-size: small;">View profile</span></a>
                                <hr class="my-0"/>
                            <?php } else { ?>
                                <a class="dropdown-item" href="/viewAllStudents.php">View Student Profiles</a>
                            <?php } ?>
                            <a class="dropdown-item" href="/changePassword.php">Change password</a>
                            <a class="dropdown-item" href="/procedures/doLogout.php">Log out</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<div class="container">