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
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sửa tài khoản khách hàng: <?= $khachHang['ho_ten'] ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form </h3>
              </div>
              
              <form action="<?= BASE_URL_ADMIN . '?act=sua-khach-hang' ?>" method="POST">
                <input type="hidden" name="khach_hang_id" value="<?= $khachHang['id'] ?>">
                <div class="card-body">
                <div class="form-group">
                  <label>Họ tên</label>
                  <input type="text" class="form-control" name="ho_ten" value="<?= $khachHang['ho_ten'] ?>" placeholder="Mời nhập tên">
                  <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>

                  <?php } ?>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" value="<?= $khachHang['email'] ?>" placeholder="Mời nhập email">
                  <?php if (isset($_SESSION['error']['email'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>

                  <?php } ?>
                </div>

                <div class="form-group">
                  <label>Số điện thoại</label>
                  <input type="number" class="form-control" name="so_dien_thoai" value="<?= $khachHang['so_dien_thoai'] ?>" placeholder="Mời nhập số điện thoại">
                  <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>

                  <?php } ?>
                </div>

                <div class="form-group">
                  <label>Ngày sinh</label>
                  <input type="date" class="form-control" name="ngay_sinh" value="<?= $khachHang['ngay_sinh'] ?>" >
                  <?php if (isset($_SESSION['error']['ngay_sinh'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>

                  <?php } ?>
                </div>

                <div class="form-group">
                  <label>Giới tính</label>
                  <select class="form-control custom-select" name="gioi_tinh" id="">
                    <option <?= $khachHang['gioi_tinh']==1 ? 'selected': ''?> value="1">Nam</option>
                    <option <?= $khachHang['gioi_tinh']!==1 ? 'selected': ''?> value="2">Nu</option>
                   
                  </select>
                </div>

                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input type="text" class="form-control" name="dia_chi" value="<?= $khachHang['dia_chi'] ?>" placeholder="Mời nhập số địa chỉ">
                  <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>

                  <?php } ?>
                </div>

                

             

                

                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
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