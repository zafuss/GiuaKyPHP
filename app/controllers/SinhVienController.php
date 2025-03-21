<?php
require_once('app/config/database.php');
require_once('app/models/SinhVienModel.php');
require_once('app/models/NganhHocModel.php');

class SinhVienController
{
    private $sinhVienModel;
    private $nganhHocModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
        $this->nganhHocModel = new NganhHocModel($this->db);
    }

    public function index()
    {
        $sinhViens = $this->sinhVienModel->getAll();
        include 'app/views/sinhvien/list.php';
    }

    public function show($maSV)
    {
        $sinhVien = $this->sinhVienModel->getById($maSV);
        if ($sinhVien) {
            include 'app/views/sinhvien/show.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }

    public function add()
    {
        $nganhHocs = $this->nganhHocModel->getAll();
        include 'app/views/sinhvien/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSV = $_POST['maSV'] ?? '';
            $hoTen = $_POST['hoTen'] ?? '';
            $gioiTinh = $_POST['gioiTinh'] ?? '';
            $ngaySinh = $_POST['ngaySinh'] ?? '';
            $maNganh = $_POST['maNganh'] ?? '';
            $image = $_FILES['hinh'] ?? null;

            $errors = [];

            // Kiểm tra dữ liệu đầu vào
            if (empty($maSV)) {
                $errors[] = 'Mã sinh viên không được để trống';
            }
            if (empty($hoTen)) {
                $errors[] = 'Họ tên không được để trống';
            }
            if (empty($maNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }
            if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Vui lòng chọn ảnh sinh viên';
            }

            // Nếu có lỗi, quay lại trang thêm sinh viên
            if (!empty($errors)) {
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/add.php';
                return;
            }

            // Xử lý upload ảnh
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/images/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0775, true)) {
                    $errors[] = 'Không thể tạo thư mục upload: ' . $uploadDir;
                    $nganhHocs = $this->nganhHocModel->getAll();
                    include 'app/views/sinhvien/add.php';
                    return;
                }
            }

            $imageName = time() . '_' . basename($image['name']);
            $uploadFile = $uploadDir . $imageName;

            if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                $errors[] = 'Lỗi: Không thể di chuyển file ảnh.';
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/add.php';
                return;
            }

            // Gọi model để lưu sinh viên
            $result = $this->sinhVienModel->create($maSV, $hoTen, $gioiTinh, $ngaySinh, $imageName, $maNganh);

            if ($result) {
                header('Location: /GiuaKyPHP/SinhVien');
            } else {
                $errors[] = 'Lỗi khi thêm sinh viên';
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/add.php';
            }
        }
    }

    public function edit($maSV)
    {
        $sinhVien = $this->sinhVienModel->getById($maSV);
        $nganhHocs = $this->nganhHocModel->getAll();
        if ($sinhVien) {
            include 'app/views/sinhvien/edit.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSV = $_POST['maSV'] ?? '';
            $hoTen = $_POST['hoTen'] ?? '';
            $gioiTinh = $_POST['gioiTinh'] ?? '';
            $ngaySinh = $_POST['ngaySinh'] ?? '';
            $maNganh = $_POST['maNganh'] ?? '';
            $image = $_FILES['hinh'] ?? null;

            // Kiểm tra lỗi
            $errors = [];
            if (empty($maSV)) {
                $errors[] = 'Mã sinh viên không được để trống';
            }
            if (empty($hoTen)) {
                $errors[] = 'Họ tên không được để trống';
            }
            if (empty($maNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }

            // Xử lý upload ảnh mới nếu có
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imageName = time() . '_' . basename($image['name']);
                $uploadFile = $uploadDir . $imageName;

                if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    $errors[] = 'Lỗi khi tải ảnh lên';
                }
            } else {
                $imageName = $_POST['old_hinh'] ?? ''; // Giữ ảnh cũ nếu không tải ảnh mới
            }

            // Nếu có lỗi, quay lại trang chỉnh sửa
            if (!empty($errors)) {
                $sinhVien = $this->sinhVienModel->getById($maSV);
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/edit.php';
                return;
            }

            $result = $this->sinhVienModel->update($maSV, $hoTen, $gioiTinh, $ngaySinh, $imageName, $maNganh);
            if ($result) {
                header('Location: /GiuaKyPHP/SinhVien');
            } else {
                $errors[] = 'Đã xảy ra lỗi khi cập nhật sinh viên.';
                $sinhVien = $this->sinhVienModel->getById($maSV);
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/edit.php';
            }
        }
    }

    public function delete($maSV)
    {
        if ($this->sinhVienModel->delete($maSV)) {
            header('Location: /GiuaKyPHP/SinhVien');
        } else {
            echo "Đã xảy ra lỗi khi xóa sinh viên.";
        }
    }
}
