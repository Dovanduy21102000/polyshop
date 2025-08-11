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

    public function postlogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form 

            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // xử lý kiểm tra thông tin đăng nhập 
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // TRường hợp đăng nhập thành công
                // Lưu thông tin vào session 
                $_SESSION['user_client'] = $user;
                // var_dump($_SESSION['user_client'],$user);

                // die;
                header("Location: " . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;

                $_SESSION['flash'] == true;

                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }
        }
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

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'] ?? '';
            $mat_khau_confirm = $_POST['mat_khau_confirm'] ?? '';
            $so_dien_thoai = '';
            $dia_chi = '';
            $chuc_vu_id = 2;

            
            $errors = []; 
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên không được để trống.";
            }
            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = "Mật khẩu không được để trống.";
            }
            if (empty($mat_khau_confirm)) {
                $errors['mat_khau_confirm'] = "Xác nhận mật khẩu không được để trống.";
            }

            // Kiểm tra xem mật khẩu và xác nhận mật khẩu có trùng khớp không
            if (!empty($mat_khau) && !empty($mat_khau_confirm) && $mat_khau !== $mat_khau_confirm) {
                $errors['mat_khau_confirm'] = "Mật khẩu và xác nhận mật khẩu không khớp.";
            }

            
            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
            } else {
                unset($_SESSION['error']);
            }



            if (empty($errors)) {
                $password = password_hash($mat_khau, PASSWORD_BCRYPT);

                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $so_dien_thoai, $dia_chi, $chuc_vu_id);
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            } else {

                require_once './views/auth/formRegister.php';
            }
        }
    }

}
