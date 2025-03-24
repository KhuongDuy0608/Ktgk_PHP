<?php
class SinhVienModel
{
    private $conn;
    private $table_name = "sinhvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllSinhVien()
    {
        $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.MaNganh as nganhhoc_MaNganh
                  FROM " . $this->table_name . " sv
                  LEFT JOIN nganhhoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getSinhVienById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSv";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $nganhhoc_MaNganh)
    {
        $errors = [];
        if (empty($HoTen)) {
            $errors['HoTen'] = 'Tên sinh viên không được để trống';
        }
        if (empty($NgaySinh)) {
            $errors['NgaySinh'] = 'Ngày sinh không được để trống';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, nganhhoc_MaNganh) 
                  VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :nganhhoc_MaNganh)";
        $stmt = $this->conn->prepare($query);

        $MaSV = htmlspecialchars(strip_tags($MaSV));
        $HoTen = htmlspecialchars(strip_tags($HoTen));
        $GioiTinh = htmlspecialchars(strip_tags($GioiTinh));
        $NgaySinh = htmlspecialchars(strip_tags($NgaySinh));
        $Hinh = htmlspecialchars(strip_tags($Hinh));
        $nganhhoc_MaNganh = htmlspecialchars(strip_tags($nganhhoc_MaNganh));

        $stmt->bindParam(':MaSV', $MaSV);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':Hinh', $Hinh);
        $stmt->bindParam(':nganhhoc_MaNganh', $nganhhoc_MaNganh);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    public function updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $imagePath = null, $nganhhoc_MaNganh) {
        $sql = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, nganhhoc_MaNganh = :nganhhoc_MaNganh";
    
        if ($imagePath !== null) {
            $sql .= ", Hinh = :Hinh"; 
        }
    
        $sql .= " WHERE MaSV = :MaSV";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':NgaySinh', $NgaySinh);
        $stmt->bindParam(':nganhhoc_MaNganh', $nganhhoc_MaNganh);
        $stmt->bindParam(':MaSV', $MaSV);
    
        if ($imagePath !== null) {
            $stmt->bindParam(':Hinh', $imagePath);
        }
    
        if ($stmt->execute()) {
            echo "Cập nhật thành công! Đường dẫn ảnh mới: " . $imagePath;
            return true;
        } else {
            echo "Lỗi cập nhật!";
            return false;
        }
    }
    

    public function deleteSinhVien($MaSV)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $MaSV);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
