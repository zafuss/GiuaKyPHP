<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách đăng ký</h2>
        <a href="/DangKy/add" class="btn btn-primary mb-3">Thêm đăng ký</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã DK</th>
                    <th>Ngày DK</th>
                    <th>Sinh viên</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dangKys as $dangKy): ?>
                    <tr>
                        <td><?= htmlspecialchars($dangKy->MaDK) ?></td>
                        <td><?= htmlspecialchars($dangKy->NgayDK) ?></td>
                        <td><?= htmlspecialchars($dangKy->HoTen) ?></td>
                        <td>
                            <a href="/DangKy/show/<?= $dangKy->MaDK ?>" class="btn btn-info btn-sm">Xem</a>
                            <a href="/DangKy/edit/<?= $dangKy->MaDK ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/DangKy/delete/<?= $dangKy->MaDK ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>