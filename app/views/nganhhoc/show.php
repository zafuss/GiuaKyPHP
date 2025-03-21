<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết ngành học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chi tiết ngành học</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Mã ngành:</strong> <?= htmlspecialchars($nganhHoc->MaNganh) ?></p>
                <p><strong>Tên ngành:</strong> <?= htmlspecialchars($nganhHoc->TenNganh) ?></p>
                <a href="/NganhHoc" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>