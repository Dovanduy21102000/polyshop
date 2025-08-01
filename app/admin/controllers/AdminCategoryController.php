<?php 
class AdminCategoryController{
    public  $modelDanhMuc;

    public function __construct(){
        $this->modelDanhMuc = new AdminCategory();
    }
    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/category/listDanhMuc.php';
    }

    public function formAddDanhMuc(){
        //hàm này dùng để hiển thị form nhập
        require_once './views/category/addDanhMuc.php';
    }

    public function postAddDanhMuc(){
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = "Tên danh mục ko được để trống";
            }
            
            $_SESSION['error'] = $errors;

            // nếu ko lỗi tiến hành thêm danh mục
            if(empty($errors)){
                //Nếu ko lỗi tiến hành thêm danh mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc,$mo_ta);
                header('Location: '. BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }else{
                //trả về form và lỗi
                require_once './views/category/addDanhMuc.php';
            }
        }
        // var_dump($_POST);
    }


    public function formEditDanhMuc(){
        //hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhMuc){
            require_once './views/category/editDanhMuc.php';
        }else{
            header('Location: '. BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
        
    }

    public function postEditDanhMuc(){
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // lấy ra dữ liệu
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = "Tên danh mục ko được để trống";
            }

            // nếu ko lỗi tiến hành sửa danh mục
            if(empty($errors)){
                //Nếu ko lỗi tiến hành sửa danh mục
                $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc,$mo_ta);
                header('Location: '. BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }else{
                //trả về form và lỗi
                $danhMuc = ['id' => $id , 'ten_danh_muc' => $ten_danh_muc , 'mo_ta'=>$mo_ta];
                require_once './views/category/editDanhMuc.php';
            }
        }
        // var_dump($_POST);
    }

    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);

        if($danhMuc){
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        header('Location: '. BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }
}