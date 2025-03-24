<?php
class NganhHocModel
{
    private $conn;
    private $table_name = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllNganhHoc()
    {
        $query = "SELECT MaNganh, TenNganh FROM nganhhoc";
        $stmt = $this->conn->prepare($query);

        if (!$stmt->execute()) {
            error_log("Lỗi thực thi truy vấn: " . implode(" - ", $stmt->errorInfo()));
        }

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (!$result) {
            error_log("Không có ngành học nào được trả về.");
        }

        return $result;
    }


    public function getNganhHocById($MaNganh)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addNganhHoc($TenNganh)
    {
        $query = "INSERT INTO " . $this->table_name . " (TenNganh) VALUES (:TenNganh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':TenNganh', $TenNganh);
        return $stmt->execute();
    }


    public function updateNganhHoc($MaNganh, $TenNganh)
    {
        $query = "UPDATE " . $this->table_name . " SET TenNganh = :TenNganh WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':TenNganh', $TenNganh);
        $stmt->bindParam(':MaNganh', $MaNganh);
        return $stmt->execute();
    }

    public function deleteNganhHoc($MaNganh)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaNganh = :MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaNganh', $MaNganh);
        return $stmt->execute();
    }
}
?>
