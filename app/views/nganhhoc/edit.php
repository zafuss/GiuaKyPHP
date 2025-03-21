<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sửa ngành học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Sửa ngành học</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/NganhHoc/update" method="POST">
            <input type="hidden" name="maNganh" value="<?= htmlspecialchars($nganhHoc->MaNganh) ?>">
            <div class="mb-3">
                <label for="maNganh" class="form-label">Mã ngành</label>
                <input type="text" class="form-control" id="maNganh" value="<?= htmlspecialchars($nganhHoc->MaNganh) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="tenNganh" class="form-label">Tên ngành</label>
                <input type="text" class="form-control" id="tenNganh" name="tenNganh" value="<?= htmlspecialchars($nganhHoc->TenNganh) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="/NganhHoc" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>