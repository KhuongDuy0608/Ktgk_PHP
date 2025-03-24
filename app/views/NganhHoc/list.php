<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="text-center">Danh sách danh mục</h1>
<div class="text-center mb-2">
    <a href="/QLSV/NganhHoc/add" class="btn btn-success">Thêm danh mục mới</a>
</div>

<div class="d-flex justify-content-center">
    <table class="table table-bordered" style="width: 60%;">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên ngành</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($nganhs) && is_array($nganhs)) : ?>
                <?php foreach ($nganhs as $nganhhoc) : ?>
                    <tr>
                        <td><?= htmlspecialchars($nganhhoc->MaNganh) ?></td>
                        <td><?= htmlspecialchars($nganhhoc->TenNganh) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="3" class="text-center">Không có ngành nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

