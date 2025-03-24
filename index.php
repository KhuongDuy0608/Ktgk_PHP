<?php
require_once 'app/config/database.php';
require_once 'app/controllers/SinhVienController.php';
require_once 'app/controllers/NganhHocController.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = str_replace('QLSV/', '', $uri); 



if ($uri == 'SinhVien' || $uri == 'SinhVien/index') {
    $controller = new SinhVienController();
    $controller->index();
} elseif ($uri == 'SinhVien/add') {
    $controller = new SinhVienController();
    $controller->add();
} elseif ($uri == 'SinhVien/save') {
    $controller = new SinhVienController();
    $controller->save();
} elseif ($uri == 'SinhVien/update') {
    $controller = new SinhVienController();
    $controller->update();
} 
elseif (preg_match('/SinhVien\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new SinhVienController();
    $controller->edit($matches[1]);
} elseif (preg_match('/SinhVien\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new SinhVienController();
    $controller->delete($matches[1]);
} elseif ($uri == 'NganhHoc' || $uri == 'NganhHoc/list') {
    $controller = new NganhHocController();
    $controller->list();
} elseif ($uri == 'NganhHoc/add') {
    $controller = new NganhHocController();
    $controller->add();
} elseif ($uri == 'NganhHoc/save') {
    $controller = new NganhHocController();
    $controller->save();
} elseif (preg_match('/NganhHoc\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new NganhHocController();
    $controller->edit($matches[1]);
} elseif (preg_match('/NganhHoc\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new NganhHocController();
    $controller->delete($matches[1]);
} else {
    echo "404 - Không tìm thấy trang";
}
?>
