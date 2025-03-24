<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Danh sách sinh viên</h1>
    <div class="text-center mb-3">
        <a href="/QLSV/SinhVien/add" class="btn btn-success">Thêm sinh viên mới</a>
    </div>

    <?php if (!empty($sinhviens)): ?>
        <div class="list-group">
            <?php foreach ($sinhviens as $sinhvien): ?>
                <div class="list-group-item border rounded shadow-sm p-3 mb-3">
                <?php
                    $imagePath = "/QLSV/public/" . ltrim($sinhvien->Hinh, '/');
                    echo '<img src="' . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') . '" alt="Ảnh sinh viên" 
                        class="img-thumbnail mb-2" style="width: 150px; height: 150px; object-fit: cover;">';
                ?>    
                    <h5>
                        <a href="/QLSV/SinhVien/show/<?php echo $sinhvien->MaSV; ?>" class="text-decoration-none">
                            <?php echo htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h5>
                    <p class="text-muted mb-1"><?php echo htmlspecialchars($sinhvien->GioiTinh, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="text-muted mb-1"><?php echo htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8'); ?></p>
                    <div>
                        <a href="/QLSV/SinhVien/edit/<?php echo $sinhvien->MaSV; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/QLSV/SinhVine/delete/<?php echo $sinhvien->MaSV; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                            Xóa
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Không có sinh viên nào.</p>
    <?php endif; ?>
</div>

