<!-- header  -->
<?php
include './views/layouts/header.php';
?>
<!-- end header -->
<!-- Navbar -->
<?php
include './views/layouts/navbar.php';
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php
include './views/layouts/slidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->



    <section class="content">
        <div class="container">

            <div class="row">
                <!-- left column -->

                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= BASE_URL . $thongTin['anh_dai_dien'] ?> " class="avatar img-circle" alt="avatar" style="width: 100px;" onerror="this.onerror=null; this.src='https://cdn.pixabay.com/photo/2013/07/13/12/07/avatar-159236_640.png' ">

                        <h6 class="mt-2">Họ tên: <?= $thongTin['ho_ten'] ?></h6>
                        <h6 class="mt-2">Chức vụ: <?= $thongTin['chuc_vu_id'] == 1 ? 'Admin' : 'Khách hàng' ?></h6>
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">


                    <hr>
                    <div class="form-group">
                        <h1> Thông tin Admin :<?= $thongTin['ho_ten'] ?></h1>

                    </div>


                    <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" method="POST" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['complete'])) { ?>
                            <div class="alert alert-success alert-dismissable">
                                <a class="panel-close close" data-dismiss="alert">×</a>
                                <i class="fa fa-coffee"></i>
                                <?= $_SESSION['complete'] ?>
                            </div>
                        <?php } ?>
                        <?php unset($_SESSION['complete']); ?>

                        <div class="form-group">
                            <input type="hidden" name="tai_khoan_id" value="<?= $thongTin['id'] ?>">
                            <label for="ho_ten">Họ tên</label>
                            <input type="text" id="ho_ten" name="ho_ten" class="form-control" value="<?= $thongTin['ho_ten'] ?>">
                            <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>

                            <?php } ?>

                        </div>

                        <div class="form-group">
                            <input type="hidden" name="quan_tri_id" value="<?= $thongTin['id'] ?>">
                            <label for="ho_ten">Ảnh đại diện</label>
                            <input type="file" class="form-control" name="anh_dai_dien" id="display-name" />
                            <img src="<?= BASE_URL . $thongTin['anh_dai_dien'] ?>" alt="ảnh lỗi rồi" width="100px">
                            <?php if (isset($_SESSION['error']['anh_dai_dien'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['anh_dai_dien'] ?></p>

                            <?php } ?>

                        </div>

                        <div class="form-group">
                            <label for="display-name" class="required">Ngày Sinh</label>
                            <input type="date" class="form-control" name="ngay_sinh" value="<?= $thongTin['ngay_sinh'] ?>" id="display-name" placeholder="Ngày sinh" />
                        </div>




                        <?php

                        if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 'admin@poly.com') { ?>
                            <div class="form-group">

                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="<?= $thongTin['email'] ?>" readonly>

                            </div>
                        <?php } else { ?>
                            <div class="form-group">

                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="<?= $thongTin['email'] ?>" >

                            </div>
                        <?php } ?>
                        





                        <div class="form-group">

                            <label for="so_dien_thoai">Số điện thoại</label>
                            <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control" value="<?= $thongTin['so_dien_thoai'] ?>">

                        </div>

                        <div class="form-group">
                            <label>Giới tính</label>

                            <select class="form-control" name="gioi_tinh">
                                <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                                <option <?= $thongTin['gioi_tinh'] == 2 ? 'selected' : '' ?> value="2">Nữ</option>


                            </select>
                        </div>

                        <div class="form-group">

                            <label for="dia_chi">Địa chỉ</label>
                            <input type="text" id="dia_chi" name="dia_chi" class="form-control" value="<?= $thongTin['dia_chi'] ?>">

                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value=" Lưu thay đổi">

                            </div>
                        </div>


                    </form>


                    <hr>
                    <h3>Đổi mật khẩu</h3>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a>
                            <i class="fa fa-coffee"></i>
                            <?= $_SESSION['success'] ?>
                        </div>
                    <?php } ?>


                    <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="old_pass" value="">
                            </div>
                            <?php if (isset($_SESSION['error']['old_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['old_pass'] ?></p>

                            <?php } ?>

                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="new_pass" value="">
                            </div>
                            <?php if (isset($_SESSION['error']['new_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['new_pass'] ?></p>

                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="confirm_pass" value="">
                            </div>
                            <?php if (isset($_SESSION['error']['confirm_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['confirm_pass'] ?></p>

                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value=" Lưu thay đổi">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php
include './views/layouts/footer.php';
?>
<!-- end footer  -->


</body>

</html>