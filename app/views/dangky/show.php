<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chi tiết đăng ký</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Mã DK:</strong> <?= htmlspecialchars($dangKy->MaDK) ?></p>
                <p><strong>Ngày DK:</strong> <?= htmlspecialchars($dangKy->NgayDK) ?></p>
                <p><strong>Mã SV:</strong> <?= htmlspecialchars($dangKy->MaSV) ?></p>
                <a href="/DangKy" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>