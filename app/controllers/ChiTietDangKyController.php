<?php
require_once('app/config/database.php');
require_once('app/models/ChiTietDangKyModel.php');
require_once('app/models/DangKyModel.php');
require_once('app/models/HocPhanModel.php');

class ChiTietDangKyController
{
    private $chiTietDangKyModel;
    private $dangKyModel;
    private $hocPhanModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->chiTietDangKyModel = new ChiTietDangKyModel($this->db);
        $this->dangKyModel = new DangKyModel($this->db);
        $this->hocPhanModel = new HocPhanModel($this->db);
    }

    public function index()
    {
        $chiTietDangKys = $this->chiTietDangKyModel->getAll();
        include 'app/views/chitietdangky/list.php';
    }

    public function show($maDK, $maHP)
    {
        $chiTietDangKy = $this->chiTietDangKyModel->getById($maDK, $maHP);
        if ($chiTietDangKy) {
            include 'app/views/chitietdangky/show.php';
        } else {
            echo "Không tìm thấy chi tiết đăng ký.";
        }
    }

    public function add()
    {
        $dangKys = $this->dangKyModel->getAll();
        $hocPhans = $this->hocPhanModel->getAll();
        include 'app/views/chitietdangky/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maDK = $_POST['maDK'] ?? '';
            $maHP = $_POST['maHP'] ?? '';

            $errors = [];
            if (empty($maDK)) $errors[] = 'Mã đăng ký không được để trống';
            if (empty($maHP)) $errors[] = 'Mã học phần không được để trống';

            if (!empty($errors)) {
                $dangKys = $this->dangKyModel->getAll();
                $hocPhans = $this->hocPhanModel->getAll();
                include 'app/views/chitietdangky/add.php';
                return;
            }

            $result = $this->chiTietDangKyModel->create($maDK, $maHP);
            if ($result) {
                header('Location: /ChiTietDangKy');
            } else {
                $errors[] = 'Lỗi khi thêm chi tiết đăng ký';
                $dangKys = $this->dangKyModel->getAll();
                $hocPhans = $this->hocPhanModel->getAll();
                include 'app/views/chitietdangky/add.php';
            }
        }
    }

    public function delete($maDK, $maHP)
    {
        if ($this->chiTietDangKyModel->delete($maDK, $maHP)) {
            header('Location: /ChiTietDangKy');
        } else {
            echo "Xóa thất bại";
        }
    }
}
