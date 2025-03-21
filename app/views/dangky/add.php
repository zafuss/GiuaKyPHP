<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm đăng ký</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/DangKy/save" method="POST">
            <div class="mb-3">
                <label for="ngayDK" class="form-label">Ngày đăng ký</label>
                <input type="date" class="form-control" id="ngayDK" name="ngayDK">
            </div>
            <div class="mb-3">
                <label for="maSV" class="form-label">Sinh viên</label>
                <select class="form-control" id="maSV" name="maSV">
                    <?php foreach ($sinhViens as $sinhVien): ?>
                        <option value="<?= htmlspecialchars($sinhVien->MaSV) ?>"><?= htmlspecialchars($sinhVien->HoTen) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="/DangKy" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>