<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sửa học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Sửa học phần</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/HocPhan/update" method="POST">
            <input type="hidden" name="maHP" value="<?= htmlspecialchars($hocPhan->MaHP) ?>">
            <div class="mb-3">
                <label for="maHP" class="form-label">Mã học phần</label>
                <input type="text" class="form-control" id="maHP" value="<?= htmlspecialchars($hocPhan->MaHP) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="tenHP" class="form-label">Tên học phần</label>
                <input type="text" class="form-control" id="tenHP" name="tenHP" value="<?= htmlspecialchars($hocPhan->TenHP) ?>">
            </div>
            <div class="mb-3">
                <label for="soTinChi" class="form-label">Số tín chỉ</label>
                <input type="number" class="form-control" id="soTinChi" name="soTinChi" value="<?= htmlspecialchars($hocPhan->SoTinChi) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="/HocPhan" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>