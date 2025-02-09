<?php
include 'connect.php';
require_once 'khachxem.php';

// lấy từ khoá tìm kiếm
$tukhoa = $_GET['tukhoa'];
$danhmuc = isset($_GET['danhmuc']) ? $_GET['danhmuc'] : '*';

?>

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            
            <div class="col-xs-12 col-sm-12  homebanner-holder">
                <!-- Your content here -->

                <?php
                // Prepare the SQL query based on the selected category
                if ($danhmuc == '*') {
                    $sql = "SELECT * FROM sanpham WHERE
                        tenSanPham LIKE ? 
                        OR donGia LIKE ?
                        OR moTaSanPham LIKE ?
                        OR tinhTrang LIKE ?
                    ORDER BY maSanPham";
                } else {
                    $sql = "SELECT * FROM sanpham WHERE
                        (danhMucID = ?) 
                        AND 
                        (tenSanPham LIKE ? 
                        OR donGia LIKE ?
                        OR moTaSanPham LIKE ?
                        OR tinhTrang LIKE ?)
                    ORDER BY maSanPham";
                }

                // Prepare the statement
                $stmt = mysqli_prepare($conn, $sql);

                // Bind the parameters
                $likeTukhoa = '%' . $tukhoa . '%';
                if ($danhmuc == '*') {
                    mysqli_stmt_bind_param($stmt, 'ssss', $likeTukhoa, $likeTukhoa, $likeTukhoa, $likeTukhoa);
                } else {
                    mysqli_stmt_bind_param($stmt, 'issss', $danhmuc, $likeTukhoa, $likeTukhoa, $likeTukhoa, $likeTukhoa);
                }

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);
                $num_rows = mysqli_num_rows($result);
                ?>

                <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
                    <div id="raula" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix text-center">
                            <h3 class="new-product-title">Kết quả tìm kiếm</h3>
                            <p>
                                <?php
                                if ($num_rows > 0) {
                                    echo "Có $num_rows sản phẩm được tìm thấy.";
                                } else {
                                    echo "Không có sản phẩm nào được tìm thấy.";
                                }
                                ?>
                            </p>
                        </div>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                        <?php if ($num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
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
                                                                    <div class="col-md-3" style="padding-top: 22px">
                                                                        <form action="" method="post">
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
                                        <?php } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
    </div>
</div>
<?php
if (isset($_POST['addcart'])) {
    if (!isset($_SESSION['maKhachHang'])) {
        echo "<script>alert('Vui lòng đăng nhập để mua hàng!')</script>";
        echo "<script>window.location.href='sign-in.php'</script>";
    } else {
        $tenspgiohang = $_POST['spgiohang'];
        $maspgiohang = $_POST['mspgiohang'];
        $slgiohang = $_POST['slgiohang'];

        // Kiểm tra nếu sản phẩm đã tồn tại, cập nhật số lượng
        $sqlcheckproduct = "SELECT * FROM giohang WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
        $resultcheckproduct = mysqli_query($conn, $sqlcheckproduct);
        if (mysqli_num_rows($resultcheckproduct) > 0) {
            $row_giohang = mysqli_fetch_assoc($resultcheckproduct);
            $soLuongMoi = $row_giohang['soLuong'] + $slgiohang;
            $sqlsuagiohang = "UPDATE giohang SET soLuong = '$soLuongMoi' WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
            mysqli_query($conn, $sqlsuagiohang);
            echo "<script>alert('Sản phẩm đã được cập nhật thêm vào giỏ hàng!')</script>";
        } else {
            // Thêm sản phẩm vào giỏ hàng
            $sqladdcart = "INSERT INTO giohang (maKhachHang, maSanPham, tenSanPham, soLuong) VALUES ('$maKhachhang', '$maspgiohang', '$tenspgiohang', '$slgiohang')";
            mysqli_query($conn, $sqladdcart);
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!')</script>";
        }

        // Điều hướng trở lại trang hiện tại
        echo "<script>window.location.href='index.php'</script>";
    }
}

require_once('footer.php');
?>