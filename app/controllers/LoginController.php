<?php
require_once('app/config/database.php');
require_once('app/models/SinhVienModel.php');

class LoginController
{
    private $sinhVienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
    }

    public function index()
    {
        // Nếu đã đăng nhập, chuyển hướng về trang danh sách sinh viên
        if (isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/SinhVien');
            exit();
        }
        include 'app/views/login/index.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSV = $_POST['maSV'] ?? '';
            $errors = [];

            // Kiểm tra dữ liệu đầu vào
            if (empty($maSV)) {
                $errors[] = 'Mã sinh viên không được để trống';
            }

            if (!empty($errors)) {
                include 'app/views/login/index.php';
                return;
            }

            // Kiểm tra MSSV trong cơ sở dữ liệu
            $sinhVien = $this->sinhVienModel->login($maSV);

            if ($sinhVien) {
                // Lưu thông tin sinh viên vào session
                $_SESSION['sinhvien'] = [
                    'MaSV' => $sinhVien->MaSV,
                    'HoTen' => $sinhVien->HoTen,
                    'GioiTinh' => $sinhVien->GioiTinh,
                    'NgaySinh' => $sinhVien->NgaySinh,
                    'Hinh' => $sinhVien->Hinh,
                    'MaNganh' => $sinhVien->MaNganh
                ];
                header('Location: /GiuaKyPHP/SinhVien');
            } else {
                $errors[] = 'Mã sinh viên không tồn tại';
                include 'app/views/login/index.php';
            }
        }
    }

    public function logout()
    {
        // Xóa session và chuyển hướng về trang đăng nhập
        unset($_SESSION['sinhvien']);
        session_destroy();
        header('Location: /GiuaKyPHP/Login');
    }
}
