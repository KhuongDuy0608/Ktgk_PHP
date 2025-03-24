<?php
include '../config/database.php';
include '../controllers/SinhVienController.php';

if (!isset($_GET['id'])) {
    die('Không có mã sinh viên được cung cấp.');
}

$controller = new SinhVienController($conn);
$controller->delete($_GET['id']);
header('Location: index.php');
exit();
?>