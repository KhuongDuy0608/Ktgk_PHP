<?php
class NganhModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAll() {
        $sql = "SELECT MaNganh, TenNganh FROM NganhHoc";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Lỗi truy vấn: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($MaNganh) {
        $sql = "SELECT MaNganh, TenNganh FROM NganhHoc WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaNganh);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $sql = "INSERT INTO NganhHoc (MaNganh, TenNganh) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $data['MaNganh'], $data['TenNganh']);
        return $stmt->execute();
    }

    public function update($data) {
        $sql = "UPDATE NganhHoc SET TenNganh = ? WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $data['TenNganh'], $data['MaNganh']);
        return $stmt->execute();
    }

    public function delete($MaNganh) {
        $sql = "DELETE FROM NganhHoc WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaNganh);
        return $stmt->execute();
    }
}
?>