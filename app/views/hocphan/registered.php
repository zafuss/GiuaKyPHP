<?php
$title = "Học phần đã chọn";
require_once 'app/views/layouts/header.php';

// Tính tổng số tín chỉ và số học phần đã chọn từ cookie
$registered = isset($_COOKIE['registered_hocphan']) ? json_decode($_COOKIE['registered_hocphan'], true) : [];
$totalCredits = 0;
$totalCourses = count($registered);
foreach ($registered as $hocPhan) {
    $totalCredits += (int)$hocPhan['SoTinChi'];
}
?>

<div class="container mt-5">
    <!-- Tiêu đề và thống kê -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">Học phần đã chọn</h2>
        <div class="d-flex gap-3">
            <div class="bg-light p-3 rounded shadow-sm">
                <span class="fw-bold text-muted">Số học phần:</span>
                <span class="text-primary fs-5"><?php echo $totalCourses; ?></span>
            </div>
            <div class="bg-light p-3 rounded shadow-sm">
                <span class="fw-bold text-muted">Tổng số tín chỉ:</span>
                <span class="text-primary fs-5"><?php echo $totalCredits; ?></span>
            </div>
        </div>
    </div>

    <!-- Nút hành động -->
    <div class="d-flex justify-content-end mb-4 gap-2">
        <a href="/GiuaKyPHP/HocPhan" class="btn btn-secondary btn-lg shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Quay lại danh sách học phần
        </a>
        <a href="/GiuaKyPHP/HocPhan/removeAll" class="btn btn-danger btn-lg shadow-sm"
            onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã chọn?')">
            <i class="bi bi-trash-fill me-1"></i> Xóa tất cả
        </a>
        <a href="/GiuaKyPHP/HocPhan/saveRegistration" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-save me-1"></i> Lưu đăng ký
        </a>
    </div>

    <!-- Thông báo lỗi -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Bảng học phần đã chọn -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center py-3">Mã HP</th>
                            <th class="text-center py-3">Tên HP</th>
                            <th class="text-center py-3">Số tín chỉ</th>
                            <th class="text-center py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($registered)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Bạn chưa chọn học phần nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($registered as $hocPhan): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= htmlspecialchars($hocPhan['MaHP']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($hocPhan['TenHP']) ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars($hocPhan['SoTinChi']) ?></td>
                                    <td class="text-center align-middle">
                                        <a href="/GiuaKyPHP/HocPhan/remove/<?= $hocPhan['MaHP'] ?>"
                                            class="btn btn-danger btn-sm shadow-sm"
                                            onclick="return confirm('Bạn có chắc muốn xóa học phần này khỏi danh sách?')">
                                            <i class="bi bi-trash me-1"></i> Xóa
                                        </a>
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
</style>