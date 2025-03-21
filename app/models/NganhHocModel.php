<?php
class NganhHocModel
{
    private $conn;
    private $table_name = "NganhHoc";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($maNganh)
    {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name . " WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maNganh);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($maNganh, $tenNganh)
    {
        $errors = [];
        if (empty($maNganh)) $errors['maNganh'] = 'Mã ngành không được để trống';
        if (empty($tenNganh)) $errors['tenNganh'] = 'Tên ngành không được để trống';
        if (count($errors) > 0) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (MaNganh, TenNganh) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maNganh);
        $stmt->bindParam(2, $tenNganh);
        return $stmt->execute();
    }

    public function update($maNganh, $tenNganh)
    {
        $query = "UPDATE " . $this->table_name . " SET TenNganh = ? WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tenNganh);
        $stmt->bindParam(2, $maNganh);
        return $stmt->execute();
    }

    public function delete($maNganh)
    {
        $query = "SELECT COUNT(*) as sv_count FROM SinhVien WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maNganh);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($result->sv_count > 0) {
            $nganh = $this->getById($maNganh);
            return ['error' => 'Không thể xóa ngành "' . $nganh->TenNganh . '" vì vẫn còn ' . $result->sv_count . ' sinh viên thuộc ngành này.'];
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maNganh);
        return $stmt->execute();
    }
}
