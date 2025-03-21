<?php
$title = "Danh sách học phần";
require_once 'app/views/layouts/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chi tiết sinh viên</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Mã SV:</strong> <?= htmlspecialchars($sinhVien->MaSV) ?></p>
                <p><strong>Họ tên:</strong> <?= htmlspecialchars($sinhVien->HoTen) ?></p>
                <p><strong>Giới tính:</strong> <?= htmlspecialchars($sinhVien->GioiTinh) ?></p>
                <p><strong>Ngày sinh:</strong> <?= htmlspecialchars($sinhVien->NgaySinh) ?></p>
                <p><strong>Hình:</strong> <img src="/public/images/<?= htmlspecialchars($sinhVien->Hinh) ?>" alt="Hinh" width="100"></p>
                <p><strong>Mã ngành:</strong> <?= htmlspecialchars($sinhVien->MaNganh) ?></p>
                <a href="/GiuaKyPHP/SinhVien" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>