<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psams";
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}