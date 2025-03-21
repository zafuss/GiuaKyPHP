<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm ngành học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm ngành học</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/NganhHoc/save" method="POST">
            <div class="mb-3">
                <label for="maNganh" class="form-label">Mã ngành</label>
                <input type="text" class="form-control" id="maNganh" name="maNganh" value="<?= isset($maNganh) ? htmlspecialchars($maNganh) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="tenNganh" class="form-label">Tên ngành</label>
                <input type="text" class="form-control" id="tenNganh" name="tenNganh" value="<?= isset($tenNganh) ? htmlspecialchars($tenNganh) : '' ?>">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="/NganhHoc" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>