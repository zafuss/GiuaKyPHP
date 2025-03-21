<?php
class SinhVienModel
{
    private $conn;
    private $table_name = "SinhVien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT s.MaSV, s.HoTen, s.GioiTinh, s.NgaySinh, s.Hinh, s.MaNganh, n.TenNganh 
                  FROM " . $this->table_name . " s 
                  LEFT JOIN NganhHoc n ON s.MaNganh = n.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($maSV)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh)
    {
        $errors = [];
        if (empty($maSV)) $errors['maSV'] = 'Mã sinh viên không được để trống';
        if (empty($hoTen)) $errors['hoTen'] = 'Họ tên không được để trống';
        if (empty($maNganh)) $errors['maNganh'] = 'Mã ngành không được để trống';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maSV);
        $stmt->bindParam(2, $hoTen);
        $stmt->bindParam(3, $gioiTinh);
        $stmt->bindParam(4, $ngaySinh);
        $stmt->bindParam(5, $hinh);
        $stmt->bindParam(6, $maNganh);
        return $stmt->execute();
    }

    public function update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh)
    {
        $query = "UPDATE " . $this->table_name . " SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $hoTen);
        $stmt->bindParam(2, $gioiTinh);
        $stmt->bindParam(3, $ngaySinh);
        $stmt->bindParam(4, $hinh);
        $stmt->bindParam(5, $maNganh);
        $stmt->bindParam(6, $maSV);
        return $stmt->execute();
    }

    public function delete($maSV)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maSV);
        return $stmt->execute();
    }

    public function login($maSV)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
