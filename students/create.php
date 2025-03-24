<?php
include '../config/database.php';
include '../controllers/SinhVienController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SinhVienController($conn);
    $controller->create($_POST, $_FILES);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>

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
        <h1>Thêm Sinh Viên</h1>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <label for="MaSV">Mã Sinh Viên:</label>
            <input type="text" id="MaSV" name="MaSV" required>

            <label for="HoTen">Họ Tên:</label>
            <input type="text" id="HoTen" name="HoTen" required>

            <label for="GioiTinh">Giới Tính:</label>
            <select id="GioiTinh" name="GioiTinh" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>

            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" id="NgaySinh" name="NgaySinh" required>

            <label for="MaNganh">Mã Ngành:</label>
            <input type="text" id="MaNganh" name="MaNganh" required>

            <label for="Hinh">Hình Ảnh:</label>
            <input type="file" id="Hinh" name="Hinh" required>

            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>