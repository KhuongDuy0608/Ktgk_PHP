<?php
class SinhVienModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAll() {
        $sql = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh 
                FROM SinhVien sv
                LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Lỗi truy vấn: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($MaSV) {
        $sql = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh 
                FROM SinhVien sv
                LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
                WHERE sv.MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $data['MaSV'],
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'],
            $data['MaNganh']
        );
        return $stmt->execute();
    }

    public function update($data) {
        $sql = "UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? 
                WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'],
            $data['MaNganh'],
            $data['MaSV']
        );
        return $stmt->execute();
    }

    public function delete($MaSV) {
        $sql = "DELETE FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        return $stmt->execute();
    }
}
?>