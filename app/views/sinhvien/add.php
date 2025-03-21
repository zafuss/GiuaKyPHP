<?php
$title = "Danh sách học phần";
require_once 'app/views/layouts/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm sinh viên</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/GiuaKyPHP/SinhVien/save" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="maSV" class="form-label">Mã sinh viên</label>
                <input type="text" class="form-control" id="maSV" name="maSV">
            </div>
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="hoTen" name="hoTen">
            </div>
            <div class="mb-3">
                <label for="gioiTinh" class="form-label">Giới tính</label>
                <select class="form-control" id="gioiTinh" name="gioiTinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh">
            </div>
            <div class="mb-3">
                <label for="hinh" class="form-label">Hình</label>
                <input type="file" class="form-control" id="hinh" name="hinh">
            </div>
            <div class="mb-3">
                <label for="maNganh" class="form-label">Ngành học</label>
                <select class="form-control" id="maNganh" name="maNganh">
                    <?php foreach ($nganhHocs as $nganhHoc): ?>
                        <option value="<?= htmlspecialchars($nganhHoc->MaNganh) ?>"><?= htmlspecialchars($nganhHoc->TenNganh) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="/GiuaKyPHP/SinhVien" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>