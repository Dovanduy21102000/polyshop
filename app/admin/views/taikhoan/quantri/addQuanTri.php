<!-- header  -->
<?php include './views/layouts/header.php'; ?>
<!-- end header -->

<!-- Navbar -->
<?php include './views/layouts/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layouts/slidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thêm tài khoản quản trị</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form thêm quản trị</h3>
            </div>

            <form action="<?= BASE_URL_ADMIN . '?act=them-quan-tri' ?>" method="POST">
              <div class="card-body">
                
                <!-- Họ tên -->
                <div class="form-group">
                  <label>Họ tên</label>
                  <input type="text" class="form-control" name="ho_ten" placeholder="Nhập họ tên">
                  <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                  <?php } ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Nhập email">
                  <?php if (isset($_SESSION['error']['email'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                  <?php } ?>
                </div>

                <!-- Các trường ẩn với giá trị mặc định -->
                <input type="hidden" name="mat_khau" value="123456">
                <input type="hidden" name="so_dien_thoai" value="">
                <input type="hidden" name="dia_chi" value="">
                <input type="hidden" name="ngay_sinh" value="<?= date('Y-m-d') ?>">
                <input type="hidden" name="gioi_tinh" value="1">
                <input type="hidden" name="chuc_vu_id" value="1">
                <input type="hidden" name="anh_dai_dien" value="">

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Footer -->
<?php include './views/layouts/footer.php'; ?>
<!-- end footer  -->
