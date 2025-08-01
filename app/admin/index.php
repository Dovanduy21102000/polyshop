<?php 
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';
//require file controller
require_once './controllers/AdminHomeController.php';
require_once './controllers/AdminCategoryController.php';
require_once './controllers/AdminProductController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminCommentController.php';
//require file model
require_once './models/AdminCategory.php';
require_once './models/AdminProduct.php';
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminComment.php';

//route
$act = $_GET['act'] ?? '/';
// if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin'){
//     checkLoginAdmin();
//  }
match($act){
    '/' => (new AdminCategoryController())->danhSachDanhMuc(),
   // route auth 
   'login-admin' => (new AdminTaiKhoanController())->formLogin(),
   'check-login-admin' => (new AdminTaiKhoanController())->login(),
   'logout-admin' => (new AdminTaiKhoanController())->logout(),
    //route danh muc
   'danh-muc' => (new AdminCategoryController())->danhSachDanhMuc(),
   'form-them-danh-muc' => (new AdminCategoryController())->formAddDanhMuc(),
   'them-danh-muc' => (new AdminCategoryController())->postAddDanhMuc(),
   'form-sua-danh-muc' => (new AdminCategoryController())->formEditDanhMuc(),
   'sua-danh-muc' => (new AdminCategoryController())->postEditDanhMuc(),
   'xoa-danh-muc' => (new AdminCategoryController())->deleteDanhMuc(),

   //route sản phẩm
//    'san-pham' => (new AdminProductController())->danhSachSanPham(),
//    'form-them-san-pham' => (new AdminProductController())->formAddSanPham(),
//    'them-san-pham' => (new AdminProductController())->postAddSanPham(),
//    'form-sua-san-pham' => (new AdminProductController())->formEditSanPham(),
//    'sua-san-pham' => (new AdminProductController())->postEditSanPham(),
//    'sua-album-anh-san-pham' => (new AdminProductController())->postEditAnhSanPham(),
//    'xoa-san-pham' => (new AdminProductController())->deleteSanPham(),
//    'chi-tiet-san-pham' => (new AdminProductController())->detailSanPham(),

};