<?php
$servername = "localhost";
$username = "root";
$password = "B3d0fSt0n3";
$dbname = "db_psams";
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}