<?php
require_once('app/config/database.php');
require_once('app/models/NganhHocModel.php');

class NganhHocController
{
    private $nganhHocModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->nganhHocModel = new NganhHocModel($this->db);
    }

    public function index()
    {
        $nganhHocs = $this->nganhHocModel->getAll();
        include 'app/views/nganhhoc/list.php';
    }

    public function show($maNganh)
    {
        $nganhHoc = $this->nganhHocModel->getById($maNganh);
        if ($nganhHoc) {
            include 'app/views/nganhhoc/show.php';
        } else {
            echo "Không tìm thấy ngành học.";
        }
    }

    public function add()
    {
        include 'app/views/nganhhoc/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maNganh = $_POST['maNganh'] ?? '';
            $tenNganh = $_POST['tenNganh'] ?? '';

            $errors = [];
            if (empty($maNganh)) $errors[] = 'Mã ngành không được để trống';
            if (empty($tenNganh)) $errors[] = 'Tên ngành không được để trống';

            if (!empty($errors)) {
                include 'app/views/nganhhoc/add.php';
                return;
            }

            $result = $this->nganhHocModel->create($maNganh, $tenNganh);
            if ($result) {
                header('Location: /NganhHoc');
            } else {
                $errors[] = 'Lỗi khi thêm ngành học';
                include 'app/views/nganhhoc/add.php';
            }
        }
    }

    public function edit($maNganh)
    {
        $nganhHoc = $this->nganhHocModel->getById($maNganh);
        if ($nganhHoc) {
            include 'app/views/nganhhoc/edit.php';
        } else {
            echo "Không tìm thấy ngành học.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maNganh = $_POST['maNganh'] ?? '';
            $tenNganh = $_POST['tenNganh'] ?? '';

            $errors = [];
            if (empty($maNganh)) $errors[] = 'Mã ngành không được để trống';
            if (empty($tenNganh)) $errors[] = 'Tên ngành không được để trống';

            if (!empty($errors)) {
                include 'app/views/nganhhoc/edit.php';
                return;
            }

            $result = $this->nganhHocModel->update($maNganh, $tenNganh);
            if ($result) {
                header('Location: /NganhHoc');
            } else {
                echo "Cập nhật thất bại";
            }
        }
    }

    public function delete($maNganh)
    {
        $result = $this->nganhHocModel->delete($maNganh);
        if (is_array($result) && isset($result['error'])) {
            $error = $result['error'];
            $nganhHocs = $this->nganhHocModel->getAll();
            include 'app/views/nganhhoc/list.php';
        } else {
            header('Location: /NganhHoc');
        }
    }
}
