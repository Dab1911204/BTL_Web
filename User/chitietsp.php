<?php
session_start();

include 'connect.php';


?>
<?php
// Kiểm tra xem tham số id có tồn tại không
if (!isset($_GET['id'])) {
    echo "Thiếu tham số ID.";
    exit; // Kết thúc chương trình nếu thiếu tham số ID
}

// Kết nối cơ sở dữ liệu
// Lấy và làm sạch giá trị ID từ GET để tránh SQL injection
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Truy vấn để lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM sanpham WHERE maSanPham = '$id'";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả của truy vấn
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Không tìm thấy sản phẩm với ID đã cho.";
    exit; // Kết thúc chương trình nếu không tìm thấy sản phẩm
}

// Lấy thông tin sản phẩm từ kết quả truy vấn
$row = mysqli_fetch_assoc($result);

if (!isset($_SESSION['maKhachHang'])) {
    require_once('khachxem.php');
} else {
    $maKhachhang = $_SESSION['maKhachHang'];
    require_once('header.php');
}
?>

<!-- Phần HTML để hiển thị thông tin sản phẩm -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'><?= htmlspecialchars($row['tenSanPham']) ?></li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="container">
    <div class="page-header ">

        <h1 style="font-weight: bold; margin-bottom: 20px;"><?= htmlspecialchars($row['tenSanPham']) ?></h1>
    </div>
    <form action="" method="post" target="hidden_iframe">
        <div class="row wow fadeInUp">
            <div class="col-md-5 product-image gallery-holder">
                <?php if (!empty($row['anhSanPham'])) { ?>
                    <img class="img-responsive" src="../imgchung/<?= htmlspecialchars($row['anhSanPham']) ?>" class="img-responsive" alt="Ảnh sản phẩm">
                <?php } else { ?>
                    <p>Không có ảnh nào cho sản phẩm này.</p>
                <?php } ?>
            </div>
            <div class="col-md-7 product-info-block responsive">
                <h3 class="name" style="font-weight: bold; font-size: 24px; margin-bottom: 20px;">Thông tin sản phẩm</h3>
                <p class="product-price" style="font-size: 20px; color: #E74C3C;"><strong>Giá:</strong> <?= htmlspecialchars($row['donGia']) ?> VND</p>
                <p style="margin-bottom: 15px;"><strong>Mô tả:</strong><br><?= nl2br(htmlspecialchars($row['moTaSanPham'])) ?></p>
                <p style="margin-bottom: 15px;"><strong>Số lượng:</strong> <?= htmlspecialchars($row['soLuong']) ?></p>
                <p style="margin-bottom: 15px;"><strong>Tình trạng:</strong> <?= htmlspecialchars($row['tinhTrang']) ?></p>
                <!-- Các thông tin khác của sản phẩm -->
                <div class="product-actions" style="margin-top: 20px;">
                    <div class="input-group" style="max-width: 300px; margin-bottom: 20px;">
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= htmlspecialchars($row['soLuong']) ?>" class="form-control" style="font-size: 18px; text-align: center;">
                    </div>
                    <div class="team-btn" role="group" aria-label="Product Actions">
                        <button type="submit" name="btn-them-san-pham" class="btn btn-primary btn-action btn-chitiet" style="line-height: 27px;"><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right: 5px;"></i> Thêm vào giỏ hàng</button>
                        <button type="submit" name="btn-mua-ngay" class="btn btn-danger btn-action btn-chitiet" style="margin-left: 10px;"><i class="fa fa-bolt" aria-hidden="true" style="margin-right: 5px;"></i> Mua ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['btn-them-san-pham'])) {
        if (!isset($_SESSION['maKhachHang'])) {
            echo "<script>alert('Vui lòng đăng nhập để mua hàng!')</script>";
            echo "<script>window.location.href='sign-in.php'</script>";
        } else {
            $tenspgiohang = $row['tenSanPham'];
            $maspgiohang = $id;
            $slgiohang = $_POST['quantity'];
            // Kiểm tra nếu sản phẩm đã tồn tại, cập nhật số lượng
            $sqlcheckproduct = "SELECT * FROM giohang WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
            $resultcheckproduct = mysqli_query($conn, $sqlcheckproduct);
            $row_giohang = mysqli_fetch_assoc($resultcheckproduct);
            if (mysqli_num_rows($resultcheckproduct) > 0) {
                $soLuongMoi = $row_giohang['soLuong'] + $slgiohang;
                $sqlcheckproduct1 = "SELECT * FROM sanpham WHERE maSanPham = '$maspgiohang' ";
                $resultcheckproduct1 = mysqli_query($conn, $sqlcheckproduct1);
                $row_sanpham = mysqli_fetch_assoc($resultcheckproduct1);
                if ($soLuongMoi > $row_sanpham['soLuong']) {
                    echo "<script>alert('Không đủ hàng!')</script>";
                }else {
                $slqsuagiohang = "UPDATE giohang SET soLuong = '$soLuongMoi' WHERE maSanPham = '$maspgiohang' And maKhachHang = '$maKhachhang'";
                mysqli_query($conn, $slqsuagiohang);
                echo "<script>alert('Sản phẩm đã được cập nhật thêm vào giỏ hàng!')</script>";
                }
            } else {
                // Thêm sản phẩm vào giỏ hàng
                $sqladdcart = "INSERT INTO giohang (maKhachHang, maSanPham, tenSanPham, soLuong) VALUES ('$maKhachhang', '$maspgiohang', '$tenspgiohang', '$slgiohang')";
                mysqli_query($conn, $sqladdcart);
                echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng!')</script>";
            }
        }
    }
    ?>

    <!-- Các sản phẩm liên quan -->

    <div class="row related-products wow fadeInUp">
        <div class="col-md-12">
            <div class="page-header ">
                <h1 class="text-center" style="font-weight: bold; margin-bottom: 30px; font-size: 28px;">Các sản phẩm liên quan</h1>
            </div>
        </div>
        <?php
        // Truy vấn để lấy các sản phẩm liên quan
        $dmid = $row['maDanhMuc'];
        $sql_related = "SELECT * FROM sanpham WHERE maDanhMuc = $dmid AND maSanPham <> '$id' LIMIT 4";
        $result_related = mysqli_query($conn, $sql_related);
        if ($result_related && mysqli_num_rows($result_related) > 0) {
            while ($row_related = mysqli_fetch_assoc($result_related)) {
                // Lấy ảnh sản phẩm liên quan (nếu có)
                $related_image = !empty($row_related['anhSanPham']) ? $row_related['anhSanPham'] : 'placeholder.jpg';
        ?>
                <div class="col-md-3 col-sm-6 product-item">
                    <div class="thumbnail" style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                        <img src="../imgchung/<?= htmlspecialchars($related_image) ?>" alt="Sản phẩm liên quan" class="img-responsive" style="border-radius: 10px; width: 250px; height: 170px;">
                        <div class="caption text-center" style="padding-top: 10px;">
                            <h6 style="font-size: 18px; font-weight: bold; margin: 10px 0;"><a href="chitietsp.php?id=<?= htmlspecialchars($row_related['maSanPham']) ?>" style="color: #333; text-decoration: none;"><?= htmlspecialchars($row_related['tenSanPham']) ?></a></h6>
                            <h5 style="color: #E74C3C; font-size: 20px;"><?= htmlspecialchars($row_related['donGia']) ?> VND</h5>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>Không có sản phẩm liên quan.</p>";
        }
        ?>
    </div>
</div>

</div><!-- /.container -->
<?php require_once('footer.php'); ?>