<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Quản lý học phần'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/GiuaKyPHP">Quản lý học phần</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['sinhvien'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Xin chào, <?php echo htmlspecialchars($_SESSION['sinhvien']['HoTen']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GiuaKyPHP/SinhVien">Quản lý sinh viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GiuaKyPHP/HocPhan">Danh sách học phần</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GiuaKyPHP/HocPhan/registered">Học phần đã chọn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="/GiuaKyPHP/Login/logout">Đăng xuất</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/GiuaKyPHP/Login">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">