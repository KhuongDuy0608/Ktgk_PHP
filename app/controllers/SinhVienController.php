<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/SinhVienModel.php');
require_once('app/models/NganhHocModel.php');

class SinhVienController
{
    private $sinhVienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->sinhVienModel = new SinhVienModel($this->db);
    }

    public function index()
    {
        $products = $this->sinhVienModel->getAllSinhVien();

        if (!is_array($products)) {
            $products = [];
        }
    
        include 'app/views/SinhVien/index.php';
    }

    public function show($MaSV)
    {
        $product = $this->sinhVienModel->getSinhVienById($MaSV);
        if ($product) {
            include 'app/views/SinhVien/detail.php';
        } else {
            echo "Không thấy sinh viên.";
        }
    }

    public function add()
    {
        $nganhhoc = (new NganhHocModel($this->db))->getAllNganhHoc();
        include_once 'app/views/SinhVien/create.php';
    }

    public function save()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $MaSV = $_POST['MaSV'] ?? '';
        $HoTen = $_POST['HoTen'] ?? '';
        $GioiTinh = $_POST['GioiTinh'] ?? '';
        $NgaySinh = $_POST['NgaySinh'] ?? '';
        $nganhhoc_MaNganh = $_POST['nganhhoc_MaNganh'] ?? null;
        $imagePath = null;

        if (!empty($_FILES['Hinh']['name'])) {
            $targetDir = __DIR__ . "/../../public/uploads/"; 
            

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $imageFileType = strtolower(pathinfo($_FILES["Hinh"]["name"], PATHINFO_EXTENSION));
            $imageName = uniqid() . "." . $imageFileType;
            $targetFile = $targetDir . $imageName;

            echo "Saving to: " . $targetFile . "<br>";

            if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFile)) {
                $imagePath = "uploads/" . $imageName;
            } else {
                die("Lỗi khi lưu file. Kiểm tra quyền thư mục 'uploads/' hoặc đường dẫn file.");
            }
        }

        $result = $this->sinhVienModel->addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $nganhhoc_MaNganh, $imagePath);

        if (is_array($result)) {
            $errors = $result;
            $nganhhoc = (new NganhHocModel($this->db))->getAllNganhHoc();
            include 'app/views/SinhVien/create.php';
        } else {
            header('Location: /QLSV/SinhVien');
        }
    }
}

    public function edit($id)
    {
        $sinhvien = $this->sinhVienModel->getSinhVienById($id);
        $nganhhoc = (new NganhHocModel($this->db))->getAllNganhHoc();
        
        if ($sinhvien) {
            include 'app/views/SinhVien/edit.php';
        } else {
            echo "Không thấy sinh viên.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $nganhhoc_MaNganh = $_POST['nganhhoc_MaNganh'];

            $sinhvien = $this->sinhVienModel->getSinhVienById($MaSV);
            $imagePath = $sinhvien->Hinh;

            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . "/../../public/uploads/";

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                $imageName = uniqid() . "." . $imageFileType;
                $targetFile = $targetDir . $imageName;


                if (!empty($imagePath) && file_exists(__DIR__ . "/../../public/" . $imagePath)) {
                    unlink(__DIR__ . "/../../public/" . $imagePath);
                }

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $imagePath = "uploads/" . $imageName; 
                } else {
                    die("Lỗi khi lưu file. Kiểm tra quyền thư mục 'uploads/' hoặc đường dẫn file.");
                }
            }

            $edit = $this->sinhVienModel->updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $nganhhoc_MaNganh, $imagePath);

            if ($edit) {
                header('Location: /QLSV/SinhVien');
                exit;
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }


    public function delete($id)
    {
        if ($this->sinhVienModel->deleteSinhVien($id)) {
            header('Location: /QLSV/SinhVien');
        } else {
            echo "Đã xảy ra lỗi khi xóa sinh viên.";
        }
    }
}
?>