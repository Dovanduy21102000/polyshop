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

    public function postAddQuanTri()
{
    // Kiểm tra phương thức submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start(); // Đảm bảo session hoạt động

        // Lấy dữ liệu từ form
        $ho_ten = trim($_POST['ho_ten'] ?? '');
        $email = trim($_POST['email'] ?? '');

        // Mảng lỗi
        $errors = [];

        if (empty($ho_ten)) {
            $errors['ho_ten'] = "Tên không được để trống";
        }

        if (empty($email)) {
            $errors['email'] = "Email không được để trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng.";
        }

        $_SESSION['error'] = $errors;

        // Nếu không có lỗi -> tiến hành insert
        if (empty($errors)) {

            // Đặt mật khẩu mặc định
            $password = password_hash('123456', PASSWORD_DEFAULT);

            // Giá trị mặc định cho các cột khác
            $so_dien_thoai = '';
            $dia_chi = '';
            $chuc_vu_id = 1;          // Mặc định tài khoản quản trị
            $ngay_sinh = date('Y-m-d'); // Mặc định hôm nay
            $gioi_tinh = 1;           // 1 = Nam
            $anh_dai_dien = null;     // Chưa có ảnh

            // Gọi model insert với đủ tham số
            $this->modelTaiKhoan->insertTaiKhoan(
                $ho_ten,
                $email,
                $password,
                $so_dien_thoai,
                $dia_chi,
                $chuc_vu_id,
                $ngay_sinh,
                $gioi_tinh,
                $anh_dai_dien
            );

            // Chuyển hướng về danh sách
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        } else {
            // Lưu flash để hiện lỗi
            $_SESSION['flash'] = true;
            header('Location: ' . BASE_URL_ADMIN . '?act=form-them-quan-tri');
            exit();
        }
    }
}


    public function formEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];

        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);

        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }


    public function postEditQuanTri()
    {
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu

            // Lấy ra dữ liệu cũ của sản phẩm
            $quan_tri_id = $_POST['quan_tri_id'];
            $avtOld = $this->modelTaiKhoan->getDetailTaiKhoan($quan_tri_id);
            $old_file = $avtOld['anh_dai_dien']; //Lấy ảnh cũ để phục vụ cho sửa ảnh

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';

            $dia_chi = '';

            //khia báo chức vụ
            $chuc_vu_id = 1;

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            // var_dump($_FILES);die;






            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên ko được để trống";
            }
            if (empty($email)) {
                $errors['email'] = "Email ko được để trống";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng email.";
            }

            // if(empty($so_dien_thoai)){
            //     $errors['so_dien_thoai'] = "Số điện thoại ko được để trống";
            // }

            // logic sửa ảnh


            if (isset($anh_dai_dien) && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {

                $new_file = uploadFile($anh_dai_dien, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {

                $new_file = $old_file;
            }

            // var_dump($new_file);die;






            $_SESSION['error'] = $errors;

            // nếu ko lỗi tiến hành thêm sản phẩm
            if (empty($errors)) {
                //  var_dump('abc');die;

                //Nếu ko lỗi tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updateTaiKhoan(
                    $quan_tri_id,
                    $ho_ten,
                    $new_file,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,


                    //khia báo chức vụ
                    $chuc_vu_id



                );


                // var_dump($status);die;




                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {

                //trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
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

                header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
        }
    }
    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123@123ab', PASSWORD_BCRYPT);
        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
        if ($status && $tai_khoan['chuc_vu_id'] == 1) {
            header("Location: " . BASE_URL_ADMIN . 'list-tai-khoan-quan-tri');
            exit();
        } elseif ($status && $tai_khoan['chuc_vu_id'] == 2) {
            header("Location: " . BASE_URL_ADMIN . 'list-tai-khoan-khach-hang');
            exit();
        } else {
            var_dump('Lỗi khi kết tài khoản');
        }
    }

    public function formEditCaNhanQuanTri()
    {
        $email = $_SESSION['user_admin'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFormEmail($email);

        require_once './views/taikhoan/canhan/editCaNhan.php';
        deleteSessionError();
    }

    public function postEditCaNhanQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $avtOld = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
            $old_file = $avtOld['anh_dai_dien'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $chuc_vu_id = 1;

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;



            // $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);

            // var_dump($_POST,$_FILES);die;


            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên ko được để trống";
            }
            if (empty($email)) {
                $errors['email'] = "Email ko được để trống";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng email.";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Tên ko được để trống";
            }

            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ ko được để trống";
            }

            if (isset($anh_dai_dien) && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {

                $new_file = uploadFile($anh_dai_dien, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {

                $new_file = $old_file;
            }

            $_SESSION['error'] = $errors;

            // var_dump($_POST,$_FILES);die;

            if (empty($errors)) {
                $status = $this->modelTaiKhoan->updateTaiKhoan2(
                    $tai_khoan_id,
                    $ho_ten,
                    $new_file,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,
                    $ngay_sinh,
                    $gioi_tinh,
                    $chuc_vu_id,

                );
                if ($status) {
                    $_SESSION['complete'] = "Thay đổi thông tin thành công";
                    $_SESSION['flash'] = true;

                    header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                }
            } else {

                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit();
            }
        }
    }



    public function postEditMatKhauCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];



            // Lấy thông tin user từ SESSION
            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);

            $checkPass = password_verify($old_pass, $user['mat_khau']);

            $errors = [];

            if (!$checkPass) {
                $errors['old_pass'] = "Mật khẩu người dùng không đúng";
            }
            if ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = "Mật khẩu nhập lại không trùng khớp";
            }
            if (empty($old_pass)) {
                $errors['old_pass'] = "Pass ko được để trống";
            }
            if (empty($new_pass)) {
                $errors['new_pass'] = "Pass ko được để trống";
            }
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = "Pass ko được để trống";
            }


            $_SESSION['error'] = $errors;

            if (!$errors) {
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                if ($status) {
                    $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                    $_SESSION['flash'] = true;

                    header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                }
            } else {
                // Lỗi thì lưu vào session


                $_SESSION['flash'] = true;

                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit();
            }
        }
    }


    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);

        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    public function formEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }

    public function postEditKhachHang()
    {
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu

            // Lấy ra dữ liệu cũ của sản phẩm
            $khach_hang_id = $_POST['khach_hang_id'];

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $chuc_vu_id = 2;







            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên ko được để trống";
            }
            if (empty($email)) {
                $errors['email'] = "Email ko được để trống";
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại ko được để trống";
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = "Ngày sinh ko được để trống";
            }



            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ ko được để trống";
            }










            $_SESSION['error'] = $errors;

            // nếu ko lỗi tiến hành thêm sản phẩm
            if (empty($errors)) {
                //  var_dump('abc');die;

                //Nếu ko lỗi tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updateKhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $chuc_vu_id = 2,



                );

                // var_dump('12');die;000




                header('Location: ' . BASE_URL_ADMIN . 'list-tai-khoan-khach-hang');
                exit();
            } else {

                //trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . 'form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }

    public function detailKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);

        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }

}