<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['maKhachHang'])) {
    require_once('khachxem.php');
} else {
    $maKhachhang = $_SESSION['maKhachHang'];
    require_once('header.php');
}

?>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li style="display: inline;"><a href="index.php">Trang chủ</a></li>
                <li class='active'>Chi tiết tin tức</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md">
                    <?php
                    include "connect.php";
                    $matintuc = $_GET['matintuc'];
                    $sql = "SELECT * FROM tintuc WHERE maTintuc = '$matintuc'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="blog-post outer-top-bd wow fadeInUp">
                            <a href="blog-details.php"><img class="img-responsive" src="../imgchung/<?php echo $row['anhTinTuc']; ?>" style="width = 1500px, height = 500px;width: 1500px;height: 500px;" alt=""></a>
                            <h1><a href="blog-details.php"><?php echo $row['tieuDe']; ?></a></h1>
                            <p><?php echo $row['noiDung']; ?></p>
                            <span class="datetime"><?php echo $row['ngayThang']; ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================= FOOTER ============================================================= -->
<?php
require_once('footer.php');
?>