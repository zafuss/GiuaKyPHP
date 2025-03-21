<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm chi tiết đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm chi tiết đăng ký</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/ChiTietDangKy/save" method="POST">
            <div class="mb-3">
                <label for="maDK" class="form-label">Mã đăng ký</label>
                <select class="form-control" id="maDK" name="maDK">
                    <?php foreach ($dangKys as $dangKy): ?>
                        <option value="<?= htmlspecialchars($dangKy->MaDK) ?>"><?= htmlspecialchars($dangKy->MaDK) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="maHP" class="form-label">Học phần</label>
                <select class="form-control" id="maHP" name="maHP">
                    <?php foreach ($hocPhans as $hocPhan): ?>
                        <option value="<?= htmlspecialchars($hocPhan->MaHP) ?>"><?= htmlspecialchars($hocPhan->TenHP) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="/ChiTietDangKy" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>