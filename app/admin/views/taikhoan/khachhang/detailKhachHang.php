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
          <h1>Tài khoản khách hàng: <?= $khachHang['ho_ten'] ?></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="width: 70%;" alt=""
            onerror="this.onerror=null; this.src='https://cdn.pixabay.com/photo/2013/07/13/12/07/avatar-159236_640.png' ">
        </div>
        <div class="col-6">
          <div class="container">
            <table class="table">
              <tbody style="font-size: large;">
                <tr>
                  <th>Họ tên: </th>
                  <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                </tr>

                <tr>
                  <th>Ngày sinh: </th>
                  <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                </tr>

                <tr>
                  <th>Email: </th>
                  <td><?= $khachHang['email'] ?? '' ?></td>
                </tr>

                <tr>
                  <th>Số điện thoại: </th>
                  <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                </tr>

                <tr>
                  <th>Giới tính: </th>
                  <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nu' ?></td>
                </tr>

                <tr>
                  <th>Địa chỉ: </th>
                  <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                </tr>

                
              </tbody>

            </table>
          </div>

        </div>
        <div class="col-12">
          <h2>Lịch sử mua hàng</h2>
          <hr>
          <div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên người nhận</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Tổng tiền</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listDonHang as $key => $donHang): ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $donHang['ma_don_hang'] ?></td>
                    <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                    <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                    <td><?= $donHang['ngay_dat'] ?></td>
                    <td><?= $donHang['tong_tien'] ?></td>
                    <td><?= $donHang['ten_trang_thai'] ?></td>

                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>">
                        <button class="btn btn-success"><i class="far fa-eye"></i></button>
                      </a>

                      <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>">
                        <button class="btn btn-warning"><i class="fas fa-cogs"></i></button>
                      </a>



                    </td>

                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên người nhận</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Tổng tiền</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>

                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="col-12">
          <h2>Lịch sử bình luận</h2>
          <hr>
          <div>
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>

                  <th>Tên sản phẩm</th>
                  <th>Ngày đăng</th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Thao Tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td>
                      <a target="_blank" href=" <?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id'] ?>">
                        <?= $binhLuan['ten_san_pham'] ?>
                      </a>
                    </td>
                    <td><?= $binhLuan['ngay_dang'] ?></td>
                    <td><?= $binhLuan['noi_dung'] ?></td>
                    <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn' ?></td>
                    <td>
                      <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                        <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                        <input type="hidden" name="name_view" value="detail_khach">
                        
                        <button onclick="return confirm('Bạn có muốn ẩn/bỏ ẩn bình luận này không ? ')" class="btn btn-warning">
                          <?=  $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ Ẩn' ?>
                        </button>
                      </form>
                    </td>

                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>STT</th>

                  <th>Tên sản phẩm</th>
                  <th>Ngày đăng</th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Thao Tác</th>

                </tr>
              </tfoot>
            </table>
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

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,

    });
  });
</script>

</html>