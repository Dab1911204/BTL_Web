<?php
session_start();   
 $maKhachhang = $_SESSION['maKhachHang'];
require_once('connect.php');
require_once('header.php');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section" style="background: url('img/breadcrumb.jpg') no-repeat center center; background-size: cover; padding: 80px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2 style="color: #333; font-size: 36px; margin-bottom: 10px;">Hoàn thành đơn hàng</h2>
                    <p style="color: #555; font-size: 18px;">Cảm ơn bạn đã đặt hàng trên hệ thống của chúng tôi.</p>
                    <p style="color: #555; font-size: 18px;">Đơn hàng của bạn sẽ được xử lý trong thời gian sớm nhất.</p>
                    <a href="index.php" class="btn btn-primary" style="margin-top: 20px;">Quay về trang chủ</a>
                    <a href="donhang.php" class="btn btn-primary" style="margin-top: 20px;">Xem đơn hàng của tôi</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once('footer.php');
?>
