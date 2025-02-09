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
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container" style="position: relative">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Danh mục</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            <?php
                            include 'connect.php';
                            $sql = "SELECT * FROM danhmuc where danhMucCha = -1";
                            $resul = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($resul)) {
                            ?>
                                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row["tenDanhMuc"]; ?></a>
                                    <?php
                                    $sql1 = "SELECT * FROM danhmuc where danhMucCha = " . $row["maDanhMuc"];
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) > 0) {
                                    ?>
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <!-- <div class="row"> -->
                                                <div class="col-sm-12 col-md-3">
                                                    <ul class="links list-unstyled">
                                                        <?php
                                                        while ($row1 = mysqli_fetch_array($result1)) {
                                                        ?>
                                                            <li><a href="#<?php echo $row1["duongDan"]; ?>"><?php echo $row1["tenDanhMuc"]; ?></a>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                </li>

                        <?php
                                    }
                                }
                        ?>
                        <!-- /.megamenu-horizontal -->
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        <div class="item" style="background-image: url(https://media.istockphoto.com/id/1043062396/photo/assortment-of-fresh-vegetables.jpg?s=612x612&w=0&k=20&c=dK487uoD7az9ZD4QYZNqM-wdATdQ_vMfuf3KfhZnClw=);">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="slider-header fadeInDown-1">Đạt chuẩn VIETGAP</div>
                                    <div class="big-text fadeInDown-1"> Thực phẩm sạch </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>An toàn đến tay người tiêu
                                            dùng.</span> </div>
                                    <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item" style="background-image: url(https://i.pinimg.com/originals/e8/a9/fe/e8a9fe4045af2575be6028938fe56310.jpg);">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center  text-left">
                                    <div class="slider-header fadeInDown-1"> Thực phẩm</div>
                                    <div class="big-text fadeInDown-1">Gia <span class="highlight">Vị</span> </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>Với sứ mệnh mang đến những bữa ăn
                                            an tâm – trọn
                                            vị. </span> </div>
                                    <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Tư vấn</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Hỗ trợ 24/24</h6>
                                </div>
                            </div>
                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Freeship</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Freeship từ 100.000đ</h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Siêu ưu đãi</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Giảm 5% từ 150.000đ </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="more-info-tab clearfix ">
                    <?php
                    $server = 'localhost';
                    $user = 'root';
                    $pass = '';
                    $database = 'btl_web';
                    $conn = mysqli_connect($server, $user, $pass, $database);
                    // Lấy danh sách các danh mục
                    $sql_danhmuc = "SELECT * FROM danhmuc where danhMucCha != -1";
                    $result_danhmuc = $conn->query($sql_danhmuc);
                    while ($row_category = $result_danhmuc->fetch_assoc()) {
                    ?>
                        <div id=<?php echo $row_category["duongDan"] ?> class="scroll-tabs outer-top-vs wow fadeInUp" style="padding-top: 130px">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-left"><?php echo $row_category["tenDanhMuc"] ?></h3>
                                <!-- /.nav-tabs -->
                            </div>
                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                            <?php
                                            $maDanhMuc = $row_category['maDanhMuc'];
                                            $sql = "SELECT * FROM sanpham where maDanhMuc = $maDanhMuc ORDER BY maSanPham DESC limit 6 ";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) { ?>
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image"> <a href="chitietsp.php?id=<?= $row['maSanPham'] ?>"><img src="../imgchung/<?php echo $row['anhSanPham'] ?>" alt="" style="width: 262px; height: 147px;"></a>
                                                                </div>
                                                                <!-- /.image -->
                                                                <div class="tag new"><span>new</span></div>
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <div class="row">
                                                                    <div class="col-md-9"><br>
                                                                        <h3 class="name"><a href="chitietsp.php?id=<?= $row['maSanPham'] ?>"><?php echo $row['tenSanPham'] ?></a></h3>
                                                                        <div class="description"></div>
                                                                        <div class="product-price"> <span class="price"><?php echo number_format($row['donGia'], 0, '', ','); ?>đ</span></div>
                                                                    </div>
                                                                    <div class="col-md-3 " style="padding-top: 22px;">
                                                                        <form action="" method="post" target="hidden_iframe">
                                                                            <input type="hidden" name="spgiohang" value="<?php echo $row['tenSanPham'] ?>">
                                                                            <input type="hidden" name="mspgiohang" value="<?php echo $row['maSanPham'] ?>">
                                                                            <input type="hidden" name="slgiohang" value="1">
                                                                            <button class="btn btn-primary" type="submit" name="addcart"><i class="fa fa-shopping-cart"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.product-info -->
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product -->
                                                    </div>
                                                    <!-- /.products -->
                                                </div>
                                            <?php } ?>
                                            <!-- /.item -->
                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    <?php } ?>
                    <!-- /.scroll-tabs -->
                </div>
            </div>

        </div>
    </div>
    <script>
        console.log();
    </script>
</div>

<?php
if (isset($_POST['addcart'])) {

    if (!isset($_SESSION['maKhachHang'])) {
        echo "<script>alert('Vui lòng đăng nhập để mua hàng!')</script>";
        echo "<script>window.location.href='sign-in.php'</script>";
    } else {
        $tenspgiohang = $_POST['spgiohang'];
        $maspgiohang = $_POST['mspgiohang'];
        $slgiohang = $_POST['slgiohang']; //số lượng = 1
        //Lấy thông tin sản phẩm để lấy số lượng sản phẩm còn
        $sqlcheckproduct1 = "SELECT * FROM sanpham WHERE maSanPham = '$maspgiohang' ";
        $resultcheckproduct1 = mysqli_query($conn, $sqlcheckproduct1);
        $row_sanpham = mysqli_fetch_assoc($resultcheckproduct1);
        // Kiểm tra nếu sản phẩm đã tồn tại, cập nhật số lượng mới
        $sqlcheckproduct = "SELECT * FROM giohang WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
        $resultcheckproduct = mysqli_query($conn, $sqlcheckproduct);
        if (mysqli_num_rows($resultcheckproduct) > 0) {
            $row_giohang = mysqli_fetch_assoc($resultcheckproduct);
            $soLuongMoi = $row_giohang['soLuong'] + $slgiohang; // số lượng mới
        }
        // Kiểm tra số lượng hàng còn trong kho
        if ($soLuongMoi > $row_sanpham['soLuong'] || $row_sanpham['soLuong'] == 0) { //hết hàng,không đủ hàng
            echo "<script>alert('Sản phẩm đã hết hàng!')</script>";
        } else { //còn hàng
            // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của khách hàng hiện tại
            if (mysqli_num_rows($resultcheckproduct) > 0) {
                $slqsuagiohang = "UPDATE giohang SET soLuong = '$soLuongMoi' 
                WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
                mysqli_query($conn, $slqsuagiohang);
                echo "<script>alert('Sản phẩm đã được cập nhật thêm vào giỏ hàng!')</script>";
            } else {
                // Thêm sản phẩm vào giỏ hàng
                $sqladdcart = "INSERT INTO giohang (maKhachHang, maSanPham, tenSanPham, soLuong) 
                VALUES ('$maKhachhang', '$maspgiohang', '$tenspgiohang', '$slgiohang')";
                mysqli_query($conn, $sqladdcart);
                echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!')</script>";
            }
        }

        // Điều hướng trở lại trang hiện tại
        echo "<script>window.location.href='index.php'</script>";
    }
}

require_once('footer.php');
?>