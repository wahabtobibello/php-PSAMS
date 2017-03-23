<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/connection.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();