<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chi tiết học phần</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Mã HP:</strong> <?= htmlspecialchars($hocPhan->MaHP) ?></p>
                <p><strong>Tên HP:</strong> <?= htmlspecialchars($hocPhan->TenHP) ?></p>
                <p><strong>Số tín chỉ:</strong> <?= htmlspecialchars($hocPhan->SoTinChi) ?></p>
                <a href="/HocPhan" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>