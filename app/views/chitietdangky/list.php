<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Danh sách chi tiết đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách chi tiết đăng ký</h2>
        <a href="/ChiTietDangKy/add" class="btn btn-primary mb-3">Thêm chi tiết đăng ký</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã DK</th>
                    <th>Tên HP</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chiTietDangKys as $chiTietDangKy): ?>
                    <tr>
                        <td><?= htmlspecialchars($chiTietDangKy->MaDK) ?></td>
                        <td><?= htmlspecialchars($chiTietDangKy->TenHP) ?></td>
                        <td>
                            <a href="/ChiTietDangKy/show/<?= $chiTietDangKy->MaDK ?>/<?= $chiTietDangKy->MaHP ?>" class="btn btn-info btn-sm">Xem</a>
                            <a href="/ChiTietDangKy/delete/<?= $chiTietDangKy->MaDK ?>/<?= $chiTietDangKy->MaHP ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>