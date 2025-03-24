<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Thêm sinh viên mới</h1>

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
    <form method="POST" action="/QLSV/SinhVien/save" enctype="multipart/form-data" onsubmit="return validateForm();" class="p-4 border rounded shadow bg-light" style="width: 500px;">
            <div class="mb-3">
                <label for="HoTen" class="form-label">Tên sinh viên:</label>
                <input type="text" id="HoTen" name="HoTen" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính:</label>
                <textarea id="GioiTinh" name="GioiTinh" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nganhhoc_MaNganh" class="form-label">Ngành:</label>
                <select id="nganhhoc_MaNganh" name="nganhhoc_MaNganh" class="form-control" required>
                    <?php foreach ($nganhs as $nganhhoc): ?>
                        <option value="<?php echo $nganhhoc->id; ?>">
                            <?php echo htmlspecialchars($nganhhoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình ảnh sinh viên:</label>
                <input type="file" id="Hinh" name="Hinh" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Thêm sinh viên</button>
            <a href="/QLSV/SinhVien/index" class="btn btn-secondary w-100 mt-2">Quay lại danh sách sinh viên</a>
        </form>
    </div>
</div>
