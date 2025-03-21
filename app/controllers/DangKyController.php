<?php
require_once('app/config/database.php');
require_once('app/models/DangKyModel.php');
require_once('app/models/SinhVienModel.php');

class DangKyController
{
    private $dangKyModel;
    private $sinhVienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->dangKyModel = new DangKyModel($this->db);
        $this->sinhVienModel = new SinhVienModel($this->db);
    }

    public function index()
    {
        $dangKys = $this->dangKyModel->getAll();
        include 'app/views/dangky/list.php';
    }

    public function show($maDK)
    {
        $dangKy = $this->dangKyModel->getById($maDK);
        if ($dangKy) {
            include 'app/views/dangky/show.php';
        } else {
            echo "Không tìm thấy đăng ký.";
        }
    }

    public function add()
    {
        $sinhViens = $this->sinhVienModel->getAll();
        include 'app/views/dangky/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ngayDK = $_POST['ngayDK'] ?? '';
            $maSV = $_POST['maSV'] ?? '';

            $errors = [];
            if (empty($ngayDK)) $errors[] = 'Ngày đăng ký không được để trống';
            if (empty($maSV)) $errors[] = 'Mã sinh viên không được để trống';

            if (!empty($errors)) {
                $sinhViens = $this->sinhVienModel->getAll();
                include 'app/views/dangky/add.php';
                return;
            }

            $result = $this->dangKyModel->create($maDK, $ngayDK, $maSV);
            if ($result) {
                header('Location: /DangKy');
            } else {
                $errors[] = 'Lỗi khi thêm đăng ký';
                $sinhViens = $this->sinhVienModel->getAll();
                include 'app/views/dangky/add.php';
            }
        }
    }

    public function edit($maDK)
    {
        $dangKy = $this->dangKyModel->getById($maDK);
        $sinhViens = $this->sinhVienModel->getAll();
        if ($dangKy) {
            include 'app/views/dangky/edit.php';
        } else {
            echo "Không tìm thấy đăng ký.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maDK = $_POST['maDK'] ?? '';
            $ngayDK = $_POST['ngayDK'] ?? '';
            $maSV = $_POST['maSV'] ?? '';

            $errors = [];
            if (empty($ngayDK)) $errors[] = 'Ngày đăng ký không được để trống';
            if (empty($maSV)) $errors[] = 'Mã sinh viên không được để trống';

            if (!empty($errors)) {
                $sinhViens = $this->sinhVienModel->getAll();
                include 'app/views/dangky/edit.php';
                return;
            }

            $result = $this->dangKyModel->update($maDK, $ngayDK, $maSV);
            if ($result) {
                header('Location: /DangKy');
            } else {
                echo "Cập nhật thất bại";
            }
        }
    }

    public function delete($maDK)
    {
        if ($this->dangKyModel->delete($maDK)) {
            header('Location: /DangKy');
        } else {
            echo "Xóa thất bại";
        }
    }
}
