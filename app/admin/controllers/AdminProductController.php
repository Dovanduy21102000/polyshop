<?php 
class AdminProductController{
    public  $modelSanPham;
    public  $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminProduct();
        $this->modelDanhMuc = new AdminCategory();
    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/product/listSanPham.php';
    }

    public function formAddSanPham()
    {
        //hàm này dùng để hiển thị form nhập
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        require_once './views/product/addSanPham.php';
        //xóa session sau khi load trang
        deleteSessionError();
    }

    public function postAddSanPham()
    {
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            //Lưu hình ảnh vào 
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            //mảng hình ảnh
            $img_array = $_FILES['img_array'];

            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm ko được để trống";
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = "Giá sản phẩm ko được để trống";
            } elseif ($gia_san_pham < 0) {
                $errors['gia_san_pham'] = "Giá sản phẩm không được âm";
            }
            if (!empty($gia_khuyen_mai)) {
                if ($gia_khuyen_mai > $gia_san_pham) {
                    $errors['gia_khuyen_mai'] = "Giá khuyến mại không được lớn hơn giá sản phẩm";
                } elseif ($gia_khuyen_mai < 0) {
                    $errors['gia_khuyen_mai'] = "Giá khuyến mại không được âm";
                }
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = "Số lượng ko được để trống";
            } elseif ($so_luong < 0) {
                $errors['so_luong'] = "Số lượng sản phẩm không được âm";
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = "Ngày nhập ko được để trống";
            } elseif (!DateTime::createFromFormat('Y-m-d', $ngay_nhap)) {
                $errors['ngay_nhap'] = "Ngày nhập không hợp lệ. Vui lòng nhập theo định dạng YYYY-MM-DD.";
            } else {
                // Check if the input date is in the future
                $inputDate = DateTime::createFromFormat('Y-m-d', $ngay_nhap);
                $currentDate = new DateTime();

                if ($inputDate > $currentDate) {
                    $errors['ngay_nhap'] = "Ngày nhập không được là ngày trong tương lai.";
                }
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = "Danh mục phải được chọn";
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = "Trạng thái phải được chọn";
            }



            $_SESSION['error'] = $errors;



            // nếu ko lỗi tiến hành thêm sản phẩm
            if (empty($errors)) {
                //Nếu ko lỗi tiến hành thêm sản phẩm
                $san_pham_id =  $this->modelSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );

                // Xử lí thêm album ảnh sản phẩm img_aray
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]

                        ];

                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }

                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                //trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
        // var_dump($_POST);
    }


    public function formEditSanPham()
    {
        //hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        if ($sanPham) {
            require_once './views/product/editSanPham.php';
            deleteSessionError();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }

    public function postEditSanPham()
    {
        //hàm này dùng để xử lí thêm dữ liệu

        //ktra xem dữ liệu có được submit lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu

            // Lấy ra dữ liệu cũ của sản phẩm
            $san_pham_id = $_POST['san_pham_id'];
            // truy vấn 
            $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; //Lấy ảnh cũ để phục vụ cho sửa ảnh


            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            // var_dump($_FILES);die;




            //tạo một mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm ko được để trống";
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = "Giá sản phẩm ko được để trống";
            } elseif ($gia_san_pham < 0) {
                $errors['gia_san_pham'] = "Giá sản phẩm không được âm";
            }
            if (!empty($gia_khuyen_mai)) {
                if ($gia_khuyen_mai > $gia_san_pham) {
                    $errors['gia_khuyen_mai'] = "Giá khuyến mại không được lớn hơn giá sản phẩm";
                } elseif ($gia_khuyen_mai < 0) {
                    $errors['gia_khuyen_mai'] = "Giá khuyến mại không được âm";
                }
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = "Số lượng ko được để trống";
            } elseif ($so_luong < 0) {
                $errors['so_luong'] = "Số lượng sản phẩm không được âm";
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = "Ngày nhập ko được để trống";
            } elseif (!DateTime::createFromFormat('Y-m-d', $ngay_nhap)) {
                $errors['ngay_nhap'] = "Ngày nhập không hợp lệ. Vui lòng nhập theo định dạng YYYY-MM-DD.";
            } else {
                // Check if the input date is in the future
                $inputDate = DateTime::createFromFormat('Y-m-d', $ngay_nhap);
                $currentDate = new DateTime();

                if ($inputDate > $currentDate) {
                    $errors['ngay_nhap'] = "Ngày nhập không được là ngày trong tương lai.";
                }
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = "Danh mục phải được chọn";
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = "Trạng thái phải được chọn";
            }



            $_SESSION['error'] = $errors;

            // logic sửa ảnh


            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // Upload file ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) { //Nếu có ảnh cũ thì xóa
                    deleteFile($old_file);
                }
            } else {
                // Nếu không upload ảnh mới, giữ nguyên ảnh cũ
                $new_file = $old_file;
            }
            
            // nếu ko lỗi tiến hành thêm sản phẩm
            if (empty($errors)) {
                
                //Nếu ko lỗi tiến hành thêm sản phẩm
                $this->modelSanPham->updateSanPham(
                    $san_pham_id,
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $new_file
                );



                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                //trả về form và lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
        // var_dump($_POST);
    }

    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            //Lấy danh sách ảnh hiện tại của sản phẩm
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

            //Xử lí các ảnh được gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            //Khai báo mảng để lưu ảnh thêm mới hoặc thay thế
            $upload_file = [];

            // Upload ảnh thêm mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);

                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }

            // Lưu ảnh mới vào db và xóa ảnh cũ nếu có
            foreach ($upload_file as $file_info) {
                if ($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // cập nhật ảnh cũ
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // xóa ảnh cũ
                    deleteFile($old_file);
                } else {
                    // Thêm ảnh mới
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            //Xử lý xóa ảnh 
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    //Xóa ảnh
                    $this->modelSanPham->destroyAnhSanPham($anh_id);

                    //xóa file
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }




    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        if ($sanPham) {
            deleteFile($sanPham['hinh_anh']);
            $this->modelSanPham->destroySanPham($id);
        }

        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $key => $anhSP) {
                deleteFile($anhSP['link_hinh_anh']);
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }
        header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }

    public function detailSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        //binhluan
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        if ($sanPham) {
        require_once './views/product/detailSanPham.php';
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }

    public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $name_view = $_POST['name_view'];
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);

        if ($binhLuan) {
            $trang_thai_update = '';
            if ($binhLuan['trang_thai'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }
            $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
            if ($status) {
                if ($name_view == 'detail_khach') {
                    header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']);
                } else {
                    header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);
                }
            }
        }
    }
}