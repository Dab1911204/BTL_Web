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
                <li class='active'>Tin tức</li>
            </ul>
        </div>
    </div>
</div>
<!-- phân trang -->
<?php
include 'connect.php';
$sql_layncc = "SELECT COUNT(*) as total FROM tintuc";
$result = mysqli_query($conn, $sql_layncc);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$page_hientai = isset($_GET['trang']) ? $_GET['trang'] : 1;
$item_page = 5;
$sotrang = ceil($total_records / $item_page);
if ($page_hientai > $sotrang) {
    $page_hientai = $sotrang;
} else if ($page_hientai < 1) {
    $page_hientai = 1;
}
// tìm điểm bắt đầu
$start = ($page_hientai - 1) * $item_page;
?>
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md">
                    <?php
                    include "connect.php";
                    $sql = "SELECT * FROM tintuc LIMIT $start, $item_page";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="blog-post outer-top-bd wow fadeInUp">
                            <a href="blog-details.php">
                                <img class="img-responsive" src="../imgchung/<?php echo $row['anhTinTuc']; ?>" style="width = 1000px, height = 400px;width: 1500px;height: 500px;" alt=""></a>
                            <h1><a href="blog-details.php?matintuc=<?php echo $row['maTintuc']; ?>"><?php echo $row['tieuDe']; ?></a></h1>
                            <span class="datetime"><?php echo $row['ngayThang']; ?></span>

                            <a href="blog-details.php?matintuc=<?php echo $row['maTintuc']; ?>" class="btn btn-upper btn-primary read-more">xem thêm</a>
                        </div>
                    <?php } ?>
                    <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <?php
                                    echo '<div id="notfound">';
                                    if (mysqli_num_rows($result) == 0) {
                                        echo '<h3 style="text-align:center;margin-top: -21px;">Không có dữ liệu</h3>';
                                    }
                                    echo '</div>';
                                    ?>
                                    <input type="hidden" id="current_page" value=<?php echo $page_hientai ?>>
                                    <ul class="pagination justify-content-center">
                                        <?php
                                        if ($page_hientai > 1 && $sotrang > 1) {
                                            $x = $page_hientai - 1;
                                            echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$x'>Trước</a></li>";
                                        }

                                        for ($i = 1; $i <= $sotrang; $i++) {
                                            echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$i'>$i</a></li>";
                                        }
                                        if ($page_hientai < $sotrang && $sotrang > 1) {
                                            $y = $page_hientai + 1;
                                            echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$y'>Tiếp theo</a></li>";
                                        }
                                        ?>

                                    </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container -->
                </div>

            </div>
        </div>
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">

            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                        </a>
                    </div><!--/.item-->
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->

        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>

</div>
<!-- ============================================================= FOOTER ============================================================= -->
<?php
require_once('footer.php');
?>