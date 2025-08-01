<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link text-center">
    <img src="./assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=danh-muc' ?>" class="nav-link">
          <i class="fas fa-folder"></i>

            <p>
              Danh mục
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="nav-link">
          <i class="fas fa-box"></i>


            <p>
              Sản phẩm
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Tài khoản
            </p>
            <i class="fas fa-angle-left right"></i>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản quản trị</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản Khách hàng</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản cá nhân</p>
                </a>
              </li>
            </ul>
          
        </li>

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>