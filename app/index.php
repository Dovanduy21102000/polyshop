<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/Product.php';
require_once './models/Comment.php';
require_once './models/Category.php';

require_once './models/User.php';


// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'=>(new HomeController())->home(),

    'all-san-pham' => (new HomeController())->allSanPham(),
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'san-pham-trong-danh-muc' => (new HomeController())->danhSachSanPhamTheoDanhMuc(),

    //auth
    'login' => (new HomeController())->formLogin(),
    'logout' => (new HomeController())->logout(),
    'check-login' => (new HomeController())->postLogin(),
    'register' => (new HomeController())->formRegister(),
    'dang-ky' => (new HomeController())->postRegister(),

    //binh luan
    'dang-binh-luan' => (new HomeController())->postBinhLuan(),
};