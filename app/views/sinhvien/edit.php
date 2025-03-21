<?php
$title = "Danh sách học phần";
require_once 'app/views/layouts/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Sửa sinh viên</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/GiuaKyPHP/SinhVien/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="maSV" value="<?= htmlspecialchars($sinhVien->MaSV) ?>">
            <div class="mb-3">
                <label for="maSV" class="form-label">Mã sinh viên</label>
                <input type="text" class="form-control" id="maSV" value="<?= htmlspecialchars($sinhVien->MaSV) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?= htmlspecialchars($sinhVien->HoTen) ?>">
            </div>
            <div class="mb-3">
                <label for="gioiTinh" class="form-label">Giới tính</label>
                <select class="form-control" id="gioiTinh" name="gioiTinh">
                    <option value="Nam" <?= $sinhVien->GioiTinh == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $sinhVien->GioiTinh == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh" value="<?= htmlspecialchars($sinhVien->NgaySinh) ?>">
            </div>
            <div class="mb-3">
                <label for="hinh" class="form-label">Hình</label>
                <input type="file" class="form-control" id="hinh" name="hinh">
                <input type="hidden" name="old_hinh" value="<?= htmlspecialchars($sinhVien->Hinh) ?>">
                <img src="/public/images/<?= htmlspecialchars($sinhVien->Hinh) ?>" alt="Hinh" width="100" class="mt-2">
            </div>
            <div class="mb-3">
                <label for="maNganh" class="form-label">Ngành học</label>
                <select class="form-control" id="maNganh" name="maNganh">
                    <?php foreach ($nganhHocs as $nganhHoc): ?>
                        <option value="<?= htmlspecialchars($nganhHoc->MaNganh) ?>" <?= $sinhVien->MaNganh == $nganhHoc->MaNganh ? 'selected' : '' ?>>
                            <?= htmlspecialchars($nganhHoc->TenNganh) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="/GiuaKyPHP/SinhVien" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>