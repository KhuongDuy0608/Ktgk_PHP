<?php
include '../config/database.php';
include '../controllers/SinhVienController.php';

$controller = new SinhVienController($conn);
$students = $controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>

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
        <h1>Danh Sách Sinh Viên</h1>
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="create.php" class="btn-add">Thêm Sinh Viên</a>
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Hình</th>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($student['Hinh']); ?>" alt="image" class="table-image"></td>
                        <td><?php echo htmlspecialchars($student['MaSV']); ?></td>
                        <td><?php echo htmlspecialchars($student['HoTen']); ?></td>
                        <td><?php echo htmlspecialchars($student['NgaySinh']); ?></td>
                        <td><?php echo htmlspecialchars($student['GioiTinh']); ?></td>
                        <td><?php echo htmlspecialchars($student['TenNganh']); ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo htmlspecialchars($student['MaSV']); ?>">Chi Tiết</a> |
                            <a href="edit.php?id=<?php echo htmlspecialchars($student['MaSV']); ?>">Sửa</a> |
                            <a href="delete.php?id=<?php echo htmlspecialchars($student['MaSV']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>