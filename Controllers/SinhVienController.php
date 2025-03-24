<?php
include '../models/SinhVienModel.php';

class SinhVienController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new SinhVienModel($dbConnection);
    }

    public function index() {
        return $this->model->getAll();
    }

    public function detail($MaSV) {
        return $this->model->getById($MaSV);
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($data) {
        return $this->model->update($data);
    }

    public function delete($MaSV) {
        return $this->model->delete($MaSV);
    }
}
?>