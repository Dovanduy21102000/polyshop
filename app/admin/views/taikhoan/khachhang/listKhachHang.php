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
          <h1>Quản lí tài khoản khách hàng</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh đại diện</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listKhachHang as $key => $khachHang): ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $khachHang['ho_ten'] ?></td>
                      <td>
                        <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="width: 100px;" alt=""
                          onerror="this.onerror=null; this.src='https://cdn.pixabay.com/photo/2013/07/13/12/07/avatar-159236_640.png' ">
                      </td>
                      <td><?= $khachHang['email'] ?></td>
                      <td><?= $khachHang['so_dien_thoai'] ?></td>
                      

                      <td>
                        <div class="btn-group">

                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $khachHang['id'] ?>">
                            <button class="btn btn-success">Chi Tiết</button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khachHang['id'] ?>">
                            <button class="btn btn-warning">Sửa</button>
                          </a>

                          <a href="<?= BASE_URL_ADMIN . '?act=reset-password&id_quan_tri=' . $khachHang['id'] ?>" onclick="return confirm('Bạn có chắc chắn không ? ')">
                            <button class="btn btn-danger">Reset</button>
                          </a>
                        </div>

                      </td>


                    </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh đại diện</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>