<?php 
class AdminTaiKhoanController{
    public $modelTaiKhoan;

    public $modelSanPham;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
       

        $this->modelSanPham = new AdminProduct();
    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);

        require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';

        deleteSessionError();
    }


    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        exit();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form 

            $email = $_POST['email'];
            $password = $_POST['password'];

            // xử lý kiểm tra thông tin đăng nhập 
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // TRường hợp đăng nhập thành công
                // Lưu thông tin vào session 
                $_SESSION['user_admin'] = $user;
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else {
                // Lỗi thì lưu vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;

                $_SESSION['flash'] == true;

                header('Location: ' . BASE_URL_ADMIN . 'login-admin');
                exit();
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header('Location: ' . BASE_URL_ADMIN . 'login-admin');
        }
    }



}