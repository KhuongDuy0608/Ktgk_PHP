<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/NganhHocModel.php');

class NganhHocController
{
    private $nganhHocModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->nganhHocModel = new NganhHocModel($this->db);
    }

    public function list()
    {
        $nganhhoc = $this->nganhHocModel->getAllNganhHoc();

        if (!is_array($nganhhoc)) {
            $nganhhoc = [];
        }
        include 'app/views/nganhhoc/list.php';
    }

    public function add()
    {
        include 'app/views/nganhhoc/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $TenNganh = $_POST['TenNganh'] ?? '';

            if (empty($TenNganh)) {
                $error = "Tên ngành không được để trống.";
                include 'app/views/nganhhoc/add.php';
                return;
            }

            $this->nganhHocModel->addNganhHoc($TenNganh);
            header('Location: /QLSV/NganhHoc');
        }
    }

    public function edit($MaNganh)
    {
        $nganhhoc = $this->nganhHocModel->getNganhHocById($MaNganh);
        if ($nganhhoc) {
            include 'app/views/nganhhoc/edit.php';
        } else {
            echo "Ngành không tồn tại.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaNganh = $_POST['MaNganh'];
            $TenNganh = $_POST['TenNganh'];

            if (empty($name)) {
                $error = "Tên ngành không được để trống.";
                $nganhhoc = (object) ['MaNganh' => $MaNganh, 'name' => $TenNganh]; 
                include 'app/views/nganhhoc/edit.php';
                return;
            }

            $this->nganhHocModel->updateNganhHoc($MaNganh, $TenNganh);
            header('Location: /QLSV/NganhHoc');
        }
    }

    public function delete($MaNganh)
    {
        $this->nganhHocModel->deleteNganhHoc($MaNganh);
        header('Location: /QLSV/NganhHoc');
    }
}
?>