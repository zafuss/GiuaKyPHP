<?php
class DangKyModel
{
    private $conn;
    private $table_name = "DangKy";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT dk.MaDK, dk.NgayDK, dk.MaSV, sv.HoTen 
                  FROM " . $this->table_name . " dk 
                  LEFT JOIN SinhVien sv ON dk.MaSV = sv.MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($maDK)
    {
        $query = "SELECT MaDK, NgayDK, MaSV FROM " . $this->table_name . " WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($ngayDK, $maSV)
    {
        $errors = [];
        if (empty($ngayDK)) $errors['ngayDK'] = 'Ngày đăng ký không được để trống';
        if (empty($maSV)) $errors['maSV'] = 'Mã sinh viên không được để trống';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (NgayDK, MaSV) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $ngayDK);
        $stmt->bindParam(2, $maSV);

        if ($stmt->execute()) {
            // Lấy MaDK vừa được tạo
            return $this->conn->lastInsertId();
        }
        return false; // Trả về false nếu thất bại
    }

    public function update($maDK, $ngayDK, $maSV)
    {
        $query = "UPDATE " . $this->table_name . " SET NgayDK = ?, MaSV = ? WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $ngayDK);
        $stmt->bindParam(2, $maSV);
        $stmt->bindParam(3, $maDK);
        return $stmt->execute();
    }

    public function delete($maDK)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        return $stmt->execute();
    }
}
