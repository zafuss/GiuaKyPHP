<?php
$title = "Danh sách học phần";
require_once 'app/views/layouts/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Đăng nhập</h2>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } ?>
        <form action="/GiuaKyPHP/Login/login" method="POST">
            <div class="mb-3">
                <label for="maSV" class="form-label">Mã sinh viên</label>
                <input type="text" class="form-control" id="maSV" name="maSV" value="<?= isset($maSV) ? htmlspecialchars($maSV) : '' ?>">
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
</body>

</html>