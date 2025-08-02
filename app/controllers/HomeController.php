<?php

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;

    public $modelDanhMuc;

    public $modelBinhLuan;

    public $modelGioHang;
    public $modelDonHang;


    public function __construct()
    {
        $this->modelSanPham = new Product();
        $this->modelTaiKhoan = new User();
        $this->modelDanhMuc = new Category();
        $this->modelBinhLuan = new Comment();
    }
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }


    public function allSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/products.php';
    }

    

    //login
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        exit();
    }


    
    public function logout()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            header('Location: ' . BASE_URL . '?act=/');
        }
    }

    public function formRegister()
    {
        require_once './views/auth/formRegister.php';

        exit();
    }

}
