<?php
require_once('app/config/database.php');
require_once('app/models/HocPhanModel.php');
require_once('app/models/DangKyModel.php');
require_once('app/models/ChiTietDangKyModel.php');

class HocPhanController
{
    private $hocPhanModel;
    private $dangKyModel;
    private $chiTietDangKyModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->hocPhanModel = new HocPhanModel($this->db);
        $this->dangKyModel = new DangKyModel($this->db);
        $this->chiTietDangKyModel = new ChiTietDangKyModel($this->db);
    }

    public function index()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        // Lấy MaNganh của sinh viên từ session
        $maNganh = $_SESSION['sinhvien']['MaNganh'];
        $hocPhans = $this->hocPhanModel->getByNganh($maNganh);
        include 'app/views/hocphan/list.php';
    }

    public function show($maHP)
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        $hocPhan = $this->hocPhanModel->getById($maHP);
        if ($hocPhan) {
            include 'app/views/hocphan/show.php';
        } else {
            echo "Không tìm thấy học phần.";
        }
    }

    public function add()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        include 'app/views/hocphan/add.php';
    }

    public function save()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maHP = $_POST['maHP'] ?? '';
            $tenHP = $_POST['tenHP'] ?? '';
            $soTinChi = $_POST['soTinChi'] ?? '';

            $errors = [];
            if (empty($maHP)) $errors[] = 'Mã học phần không được để trống';
            if (empty($tenHP)) $errors[] = 'Tên học phần không được để trống';
            if (!is_numeric($soTinChi) || $soTinChi <= 0) $errors[] = 'Số tín chỉ không hợp lệ';

            if (!empty($errors)) {
                include 'app/views/hocphan/add.php';
                return;
            }

            $result = $this->hocPhanModel->create($maHP, $tenHP, $soTinChi);
            if ($result) {
                header('Location: /GiuaKyPHP/HocPhan');
            } else {
                $errors[] = 'Lỗi khi thêm học phần';
                include 'app/views/hocphan/add.php';
            }
        }
    }

    public function edit($maHP)
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        $hocPhan = $this->hocPhanModel->getById($maHP);
        if ($hocPhan) {
            include 'app/views/hocphan/edit.php';
        } else {
            echo "Không tìm thấy học phần.";
        }
    }

    public function update()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maHP = $_POST['maHP'] ?? '';
            $tenHP = $_POST['tenHP'] ?? '';
            $soTinChi = $_POST['soTinChi'] ?? '';

            $errors = [];
            if (empty($maHP)) $errors[] = 'Mã học phần không được để trống';
            if (empty($tenHP)) $errors[] = 'Tên học phần không được để trống';
            if (!is_numeric($soTinChi) || $soTinChi <= 0) $errors[] = 'Số tín chỉ không hợp lệ';

            if (!empty($errors)) {
                include 'app/views/hocphan/edit.php';
                return;
            }

            $result = $this->hocPhanModel->update($maHP, $tenHP, $soTinChi);
            if ($result) {
                header('Location: /GiuaKyPHP/HocPhan');
            } else {
                echo "Cập nhật thất bại";
            }
        }
    }

    public function delete($maHP)
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }
        $result = $this->hocPhanModel->delete($maHP);
        if (is_array($result) && isset($result['error'])) {
            $error = $result['error'];
            $hocPhans = $this->hocPhanModel->getAll();
            include 'app/views/hocphan/list.php';
        } else {
            header('Location: /GiuaKyPHP/HocPhan');
        }
    }

    // Thêm phương thức để đăng ký học phần
    public function register($maHP)
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        $hocPhan = $this->hocPhanModel->getById($maHP);
        if ($hocPhan) {
            // Lấy danh sách học phần đã chọn từ cookie (nếu có)
            $registered = isset($_COOKIE['registered_hocphan']) ? json_decode($_COOKIE['registered_hocphan'], true) : [];

            // Thêm học phần vào danh sách nếu chưa có
            if (!in_array($maHP, array_column($registered, 'MaHP'))) {
                $registered[] = [
                    'MaHP' => $hocPhan->MaHP,
                    'TenHP' => $hocPhan->TenHP,
                    'SoTinChi' => $hocPhan->SoTinChi
                ];
                // Lưu lại vào cookie, hết hạn sau 1 giờ
                setcookie('registered_hocphan', json_encode($registered), time() + 3600, '/');
            }
        }
        header('Location: /GiuaKyPHP/HocPhan');
    }

    // Hiển thị danh sách học phần đã chọn
    public function registered()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        $registered = isset($_COOKIE['registered_hocphan']) ? json_decode($_COOKIE['registered_hocphan'], true) : [];
        include 'app/views/hocphan/registered.php';
    }

    // Xóa học phần khỏi danh sách đã chọn
    public function remove($maHP)
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        $registered = isset($_COOKIE['registered_hocphan']) ? json_decode($_COOKIE['registered_hocphan'], true) : [];
        $registered = array_filter($registered, function ($item) use ($maHP) {
            return $item['MaHP'] !== $maHP;
        });
        setcookie('registered_hocphan', json_encode(array_values($registered)), time() + 3600, '/');
        header('Location: /GiuaKyPHP/HocPhan/registered');
    }

    public function saveRegistration()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        $registered = isset($_COOKIE['registered_hocphan']) ? json_decode($_COOKIE['registered_hocphan'], true) : [];
        if (empty($registered)) {
            $error = "Không có học phần nào để lưu.";
            include 'app/views/hocphan/registered.php';
            return;
        }

        $maSV = $_SESSION['sinhvien']['MaSV'];
        $ngayDK = date('Y-m-d');

        $this->db->beginTransaction();
        try {
            // Tạo bản ghi trong DangKy và lấy MaDK
            $maDK = $this->dangKyModel->create($ngayDK, $maSV);
            if ($maDK === false || is_array($maDK)) {
                $errorMsg = is_array($maDK) ? implode(", ", $maDK) : "Lỗi khi tạo bản ghi đăng ký";
                throw new Exception($errorMsg);
            }

            // Thêm từng học phần vào ChiTietDangKy và giảm SoLuong
            foreach ($registered as $hocPhan) {
                // Thêm vào ChiTietDangKy
                $resultChiTiet = $this->chiTietDangKyModel->create($maDK, $hocPhan['MaHP']);
                if (is_array($resultChiTiet)) {
                    throw new Exception("Lỗi khi lưu chi tiết đăng ký cho học phần " . $hocPhan['MaHP'] . ": " . implode(", ", $resultChiTiet));
                }

                // Giảm SoLuong trong HocPhan
                $resultUpdate = $this->hocPhanModel->decreaseQuantity($hocPhan['MaHP']);
                if (!$resultUpdate) {
                    throw new Exception("Lỗi khi giảm số lượng học phần " . $hocPhan['MaHP'] . ": Số lượng đã hết hoặc không tồn tại.");
                }
            }

            $this->db->commit();
            setcookie('registered_hocphan', '', time() - 3600, '/');
            header('Location: /GiuaKyPHP/HocPhan');
            exit();
        } catch (Exception $e) {
            $this->db->rollBack();
            $error = $e->getMessage();
            include 'app/views/hocphan/registered.php';
        }
    }

    public function removeAll()
    {
        if (!isset($_SESSION['sinhvien'])) {
            header('Location: /GiuaKyPHP/Login');
            exit();
        }

        // Xóa cookie registered_hocphan
        setcookie('registered_hocphan', '', time() - 3600, '/');
        header('Location: /GiuaKyPHP/HocPhan/registered');
        exit();
    }
}
