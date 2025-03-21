<?php
class ChiTietDangKyModel
{
    private $conn;
    private $table_name = "ChiTietDangKy";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT ctdk.MaDK, ctdk.MaHP, hp.TenHP 
                  FROM " . $this->table_name . " ctdk 
                  LEFT JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($maDK, $maHP)
    {
        $query = "SELECT MaDK, MaHP FROM " . $this->table_name . " WHERE MaDK = ? AND MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        $stmt->bindParam(2, $maHP);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($maDK, $maHP)
    {
        $errors = [];
        if (empty($maDK)) $errors['maDK'] = 'Mã đăng ký không được để trống';
        if (empty($maHP)) $errors['maHP'] = 'Mã học phần không được để trống';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (MaDK, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        $stmt->bindParam(2, $maHP);
        return $stmt->execute();
    }

    public function delete($maDK, $maHP)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ? AND MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maDK);
        $stmt->bindParam(2, $maHP);
        return $stmt->execute();
    }
}
