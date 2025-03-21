<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm học phần</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/HocPhan/save" method="POST">
            <div class="mb-3">
                <label for="maHP" class="form-label">Mã học phần</label>
                <input type="text" class="form-control" id="maHP" name="maHP">
            </div>
            <div class="mb-3">
                <label for="tenHP" class="form-label">Tên học phần</label>
                <input type="text" class="form-control" id="tenHP" name="tenHP">
            </div>
            <div class="mb-3">
                <label for="soTinChi" class="form-label">Số tín chỉ</label>
                <input type="number" class="form-control" id="soTinChi" name="soTinChi">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="/HocPhan" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>