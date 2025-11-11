<?php
// config.php - Database connection only
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "onlineshop_lab3";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>