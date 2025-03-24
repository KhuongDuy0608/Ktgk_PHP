<?php
$servername = "localhost"; // Địa chỉ server MySQL (hoặc IP)
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL (để trống nếu chưa đặt)
$database = "test1"; // Tên database

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} 
echo "Kết nối thành công!";
?>
