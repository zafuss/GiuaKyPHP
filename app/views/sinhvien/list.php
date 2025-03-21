<?php
$title = "Danh sách sinh viên";
require_once 'app/views/layouts/header.php';
?>

<div class="container mt-5">
    <!-- Tiêu đề -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">Danh sách sinh viên</h2>
        <a href="/GiuaKyPHP/SinhVien/add" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm sinh viên
        </a>
    </div>

    <!-- Thông báo lỗi (nếu có) -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Bảng sinh viên -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center py-3">Mã SV</th>
                            <th class="text-center py-3">Họ tên</th>
                            <th class="text-center py-3">Giới tính</th>
                            <th class="text-center py-3">Ngày sinh</th>
                            <th class="text-center py-3">Hình</th>
                            <th class="text-center py-3">Tên ngành</th>
                            <th class="text-center py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($sinhViens)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Không có sinh viên nào để hiển thị.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($sinhViens as $sinhVien): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= htmlspecialchars($sinhVien->MaSV) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($sinhVien->HoTen) ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($sinhVien->GioiTinh) ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($sinhVien->NgaySinh) ?></td>
                                    <td class="text-center align-middle">
                                        <img src="/public/images/<?= htmlspecialchars($sinhVien->Hinh) ?>"
                                            alt="Hình" class="img-thumbnail" width="50" height="50" style="object-fit: cover;">
                                    </td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($sinhVien->TenNganh) ?></td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group">
                                            <a href="/GiuaKyPHP/SinhVien/show/<?= $sinhVien->MaSV ?>"
                                                class="btn btn-info btn-sm shadow-sm">
                                                <i class="bi bi-eye me-1"></i> Xem
                                            </a>
                                            <a href="/GiuaKyPHP/SinhVien/edit/<?= $sinhVien->MaSV ?>"
                                                class="btn btn-warning btn-sm shadow-sm">
                                                <i class="bi bi-pencil me-1"></i> Sửa
                                            </a>
                                            <a href="/GiuaKyPHP/SinhVien/delete/<?= $sinhVien->MaSV ?>"
                                                class="btn btn-danger btn-sm shadow-sm"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                <i class="bi bi-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn-lg {
        padding: 10px 20px;
    }

    .shadow-sm {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .text-primary {
        color: #007bff !important;
    }

    .img-thumbnail {
        border-radius: 5px;
    }
</style>