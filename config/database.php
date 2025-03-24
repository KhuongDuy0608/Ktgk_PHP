<?php
$host = "localhost";
$user = "root";      
$password = "";      
$database = "Test1";

$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
