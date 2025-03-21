<?php
class HocPhanModel
{
    private $conn;
    private $table_name = "HocPhan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT MaHP, TenHP, SoTinChi FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($maHP)
    {
        $query = "SELECT MaHP, TenHP, SoTinChi FROM " . $this->table_name . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maHP);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($maHP, $tenHP, $soTinChi)
    {
        $errors = [];
        if (empty($maHP)) $errors['maHP'] = 'Mã học phần không được để trống';
        if (empty($tenHP)) $errors['tenHP'] = 'Tên học phần không được để trống';
        if (!is_numeric($soTinChi) || $soTinChi <= 0) $errors['soTinChi'] = 'Số tín chỉ không hợp lệ';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (MaHP, TenHP, SoTinChi) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maHP);
        $stmt->bindParam(2, $tenHP);
        $stmt->bindParam(3, $soTinChi);
        return $stmt->execute();
    }

    public function update($maHP, $tenHP, $soTinChi)
    {
        $query = "UPDATE " . $this->table_name . " SET TenHP = ?, SoTinChi = ? WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tenHP);
        $stmt->bindParam(2, $soTinChi);
        $stmt->bindParam(3, $maHP);
        return $stmt->execute();
    }

    public function delete($maHP)
    {
        $query = "SELECT COUNT(*) as dk_count FROM ChiTietDangKy WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maHP);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($result->dk_count > 0) {
            $hp = $this->getById($maHP);
            return ['error' => 'Không thể xóa học phần "' . $hp->TenHP . '" vì vẫn còn ' . $result->dk_count . ' đăng ký liên quan.'];
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maHP);
        return $stmt->execute();
    }
    // Lấy tất cả học phần của một ngành cụ thể
    public function getByNganh($maNganh)
    {
        // Lọc học phần có MaHP bắt đầu bằng MaNganh
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP LIKE :maNganh";
        $stmt = $this->conn->prepare($query);
        $maNganhPattern = $maNganh . '%'; // Thêm % để khớp với MaHP = MaNganh + số thứ tự
        $stmt->bindParam(':maNganh', $maNganhPattern);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createChiTietDangKy($maDK, $maHP)
    {
        $errors = [];
        if (empty($maDK)) $errors['maDK'] = 'Mã đăng ký không được để trống';
        if (empty($maHP)) $errors['maHP'] = 'Mã học phần không được để trống';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . "ChiTietDangKy" . " (MaDK, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        $stmt->bindParam(2, $maHP);
        return $stmt->execute();
    }
    public function decreaseQuantity($maHP)
    {
        $query = "UPDATE " . $this->table_name . " SET SoLuong = SoLuong - 1 WHERE MaHP = ? AND SoLuong > 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maHP);
        return $stmt->execute();
    }
}
