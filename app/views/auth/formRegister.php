<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>




<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">Đăng ký</h5>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p class="text-danger text-center "><?= is_array($_SESSION['error']) ? implode(', ', $_SESSION['error']) : $_SESSION['error'] ?></p>
                            <?php } else { ?>
                                <p class="login-box-msg">Nhập tài khoản của bạn</p>
                            <?php } ?>
                            <form action="<?= BASE_URL . '?act=dang-ky' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="text" name="ho_ten" placeholder="Mời nhập tên" required />
                                    <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                        <?php unset($_SESSION['error']['ho_ten']); // Xóa thông báo sau khi hiển thị 
                                        ?>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Mời nhập email" required />
                                    <?php if (isset($_SESSION['error']['email'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                        <?php unset($_SESSION['error']['email']); // Xóa thông báo sau khi hiển thị 
                                        ?>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="mat_khau" placeholder="Tạo mật khâu" required />
                                    <?php if (isset($_SESSION['error']['mat_khau'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['mat_khau'] ?></p>
                                        <?php unset($_SESSION['error']['mat_khau']); // Xóa thông báo sau khi hiển thị 
                                        ?>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="mat_khau_confirm" placeholder="Nhập lại mật khẩu" required />
                                    <?php if (isset($_SESSION['error']['mat_khau_confirm'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['mat_khau_confirm'] ?></p>
                                        <?php unset($_SESSION['error']['mat_khau_confirm']); // Xóa thông báo sau khi hiển thị 
                                        ?>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="<?= BASE_URL . '?act=login' ?>">Bạn đã có tài khoản?</a>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->


                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<?php require_once 'views/layout/footer.php'; ?>