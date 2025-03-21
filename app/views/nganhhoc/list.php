<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Danh sách ngành học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách ngành học</h2>
        <?php if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        } ?>
        <a href="/NganhHoc/add" class="btn btn-primary mb-3">Thêm ngành học</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã ngành</th>
                    <th>Tên ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nganhHocs as $nganhHoc): ?>
                    <tr>
                        <td><?= htmlspecialchars($nganhHoc->MaNganh) ?></td>
                        <td><?= htmlspecialchars($nganhHoc->TenNganh) ?></td>
                        <td>
                            <a href="/NganhHoc/show/<?= $nganhHoc->MaNganh ?>" class="btn btn-info btn-sm">Xem</a>
                            <a href="/NganhHoc/edit/<?= $nganhHoc->MaNganh ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/NganhHoc/delete/<?= $nganhHoc->MaNganh ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>