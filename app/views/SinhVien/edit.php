<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Sửa sinh viên</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <form method="POST" action="/QLSV/SinhVien/update" enctype="multipart/form-data" onsubmit="return validateForm();"  
              class="p-4 border rounded shadow bg-light" style="width: 500px;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Họ tên:</label>
                <input type="text" id="name" name="name" class="form-control"
                       value="<?php echo htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính:</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="Nam" <?php echo ($sinhvien->GioiTinh == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($sinhvien->GioiTinh == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="birthdate" class="form-label">Ngày sinh:</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control"
                       value="<?php echo htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh sinh viên:</label>
                <?php if (!empty($sinhvien->Hinh)): ?>
                    <p>Ảnh hiện tại:</p>
                    <img src="/QLSV/public/<?php echo htmlspecialchars($sinhvien->Hinh); ?>" width="150">
                <?php endif; ?>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="nganhhoc_MaNganh" class="form-label">Ngành học:</label>
                <select id="nganhhoc_MaNganh" name="nganhhoc_MaNganh" class="form-control" required>
                    <?php foreach ($nganhhocs as $nganhhoc): ?>
                        <option value="<?php echo $nganhhoc->MaNganh; ?>"
                            <?php echo ($nganhhoc->MaNganh == $sinhvien->nganhhoc_MaNganh) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($nganhhoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Lưu thay đổi</button>
            <a href="/QLSV/SinhVien/list" class="btn btn-secondary w-100 mt-2">Quay lại danh sách sinh viên</a>
        </form>
    </div>
</div>


