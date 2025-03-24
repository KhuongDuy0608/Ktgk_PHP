<?php
include '../config/database.php';
include '../controllers/SinhVienController.php';

if (!isset($_GET['id'])) {
    die('Không có mã sinh viên được cung cấp.');
}

$controller = new SinhVienController($conn);
$student = $controller->detail($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>

</head>
<body>
<style>
        /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Container chính */
.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Tiêu đề */
h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Nút thêm sinh viên */
.btn-add {
    display: inline-block;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}

.btn-add:hover {
    background-color: #218838;
}

/* Bảng danh sách sinh viên */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.styled-table th, .styled-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.styled-table th {
    background-color: #007bff;
    color: white;
}

.styled-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Ảnh sinh viên */
.table-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

/* Link chỉnh sửa và xóa */
td a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    margin: 0 5px;
}

td a:hover {
    text-decoration: underline;
}

    </style>
    <div class="container">
        <h1>Chi Tiết Sinh Viên</h1>
        <div class="student-detail">
            <img src="<?php echo htmlspecialchars($student['Hinh']); ?>" alt="Hình Sinh Viên" class="student-image">
            <p><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($student['MaSV']); ?></p>
            <p><strong>Họ Tên:</strong> <?php echo htmlspecialchars($student['HoTen']); ?></p>
            <p><strong>Giới Tính:</strong> <?php echo htmlspecialchars($student['GioiTinh']); ?></p>
            <p><strong>Ngày Sinh:</strong> <?php echo htmlspecialchars($student['NgaySinh']); ?></p>
            <p><strong>Ngành:</strong> <?php echo htmlspecialchars($student['TenNganh']); ?></p>
        </div>
        <a href="index.php" class="btn-back">Quay Lại</a>
    </div>
</body>
</html>