<?php
include '../models/NganhModel.php';

class NganhController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new NganhModel($dbConnection);
    }

    public function index() {
        return $this->model->getAll();
    }

    public function detail($MaNganh) {
        return $this->model->getById($MaNganh);
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($data) {
        return $this->model->update($data);
    }

    public function delete($MaNganh) {
        return $this->model->delete($MaNganh);
    }
}
?>