<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['maKhachHang'])) {
    header('location:sign-in.php');
    require_once('khachxem.php');
} else {
    $maKhachhang = $_SESSION['maKhachHang'];
    require_once('header.php');
}
$maKhachHang = $_SESSION['maKhachHang']; // Lấy mã khách hàng từ session

// Query để lấy thông tin khách hàng
$sql_khachhang = "SELECT * FROM khachhang WHERE maKhachhang = ?";
$stmt_khachhang = $conn->prepare($sql_khachhang);
$stmt_khachhang->bind_param('s', $maKhachHang);
$stmt_khachhang->execute();
$result_khachhang = $stmt_khachhang->get_result();
$row_khachhang = $result_khachhang->fetch_assoc();

$product_id = null;
$is_buy_now = false;

if (isset($_GET['buy_now'])) {
    // Nếu là hành động "Mua ngay", lấy thông tin sản phẩm từ URL
    $product_id = $_GET['buy_now'];
    $is_buy_now = true;

    // Query để lấy thông tin sản phẩm từ bảng giohang với loaiGioHang là 'buynow'
    $sql_product = "SELECT giohang.*, sanpham.donGia, sanpham.tenSanPham 
                    FROM giohang 
                    JOIN sanpham ON giohang.maSanPham = sanpham.maSanPham 
                    WHERE giohang.maGioHang = ? AND giohang.loaiGioHang = 'buynow'";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param('i', $product_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product = $result_product->fetch_assoc();

    if ($product) {
        // Tạo giỏ hàng tạm thời
        $result_giohang = [$product];
        $total_price = $product['donGia'] * $product['soLuong'];
    } else {
        echo "<script>alert('Sản phẩm không tồn tại!')</script>";
        echo "<script>window.location.href='index.php'</script>";
        exit();
    }
} else {
    // Query để lấy thông tin giỏ hàng của khách hàng
    $sql_giohang = "SELECT giohang.*, sanpham.donGia, sanpham.tenSanPham 
                    FROM giohang 
                    JOIN sanpham ON giohang.maSanPham = sanpham.maSanPham 
                    WHERE giohang.maKhachHang = ?";
    $stmt_giohang = $conn->prepare($sql_giohang);
    $stmt_giohang->bind_param('s', $maKhachHang);
    $stmt_giohang->execute();
    $result_giohang = $stmt_giohang->get_result();

    // Tính tổng tiền đơn hàng
    $total_price = 0;
    if ($result_giohang->num_rows > 0) {
        $result_giohang_data = [];
        while ($row_giohang = $result_giohang->fetch_assoc()) {
            $total_price += $row_giohang['soLuong'] * $row_giohang['donGia'];
            $result_giohang_data[] = $row_giohang;
        }
        // Đặt lại con trỏ của kết quả về vị trí đầu tiên
        $result_giohang->data_seek(0);
    }
}

// Xử lý khi người dùng click "Đặt hàng"
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ghiChu = htmlspecialchars($_POST['ghiChu']);
    $tenKhachHang = htmlspecialchars($_POST['tenKhachHang']);
    $soDienThoai = htmlspecialchars($_POST['soDienThoai']);
    $diaChi = htmlspecialchars($_POST['diaChi']);

    if (empty($diaChi)) {
        $error_message = "Địa chỉ không được để trống.";
    } elseif ($result_giohang->num_rows == 0 && !$is_buy_now) {
        $error_message = "Không có sản phẩm nào trong giỏ hàng của bạn.";
    } else {
        $thoiGianDat = date('Y-m-d H:i:s');
        $tongGiaTri = $total_price + 30000; // Tổng tiền bao gồm phí vận chuyển
        $tinhTrang = 'Chờ xử lý'; // Trạng thái đơn hàng ban đầu

        // Insert vào bảng donhang
        $sql_insert_donhang = "INSERT INTO donhang (maKhachHang, thoiGianDat, diaChiKhachHang, tongGiaTri, ghiChu, tinhTrang) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert_donhang = $conn->prepare($sql_insert_donhang); //Chuẩn bị câu truy vấn
        $stmt_insert_donhang->bind_param('ssssss', $maKhachHang, $thoiGianDat, $diaChi, $tongGiaTri, $ghiChu, $tinhTrang); //Ràng buộc các tham số vào vị trí ? tương ứng
        $stmt_insert_donhang->execute(); //Thực thi câu truy vấn

        // Lấy mã đơn hàng vừa insert
        $maDonhang = $conn->insert_id;
        $sql_update_sanpham = "UPDATE sanpham SET soLuong = soLuong - ? WHERE maSanPham = ?";
        $stmt_update_sanpham = $conn->prepare($sql_update_sanpham);
        $stmt_update_sanpham->bind_param('ii', $soLuongMua, $maSanPham);

        foreach ($result_giohang as $item) {
            $maSanPham = $item['maSanPham'];
            $soLuongMua = $item['soLuong'];

            // Kiểm tra và cập nhật tình trạng hàng trong kho
            $sql_check_kho = "SELECT * FROM khohang WHERE maSanPham = ? ORDER BY ngayNhap ASC";
            $stmt_check_kho = $conn->prepare($sql_check_kho);
            $stmt_check_kho->bind_param('i', $maSanPham);
            $stmt_check_kho->execute();
            $result_check_kho = $stmt_check_kho->get_result(); // trả về kết quả câu truy vấn

            while ($row_kho = $result_check_kho->fetch_assoc()) { // lấy kết quả gán vào các cột được gọi ở phía dưới
                $soLuongKho = $row_kho['soLuong'];
                $ngayHetHan = $row_kho['hanSuDung'];
                $tinhTrang = $row_kho['tinhTrang'];

                // Kiểm tra ngày hết hạn
                $today = date('Y-m-d');
                if ($ngayHetHan < $today) {
                    // Cập nhật tình trạng thành "Hàng Hỏng"
                    $sql_update_kho = "UPDATE khohang SET tinhTrang = 'Hàng Hỏng' WHERE maLoai= ?";
                    $stmt_update_kho = $conn->prepare($sql_update_kho);
                    $stmt_update_kho->bind_param('i', $row_kho['maLoai']);
                    $stmt_update_kho->execute();
                    continue; // Bỏ qua lô hàng này vì đã hết hạn
                }

                if ($soLuongMua > $soLuongKho) {
                    // Nếu số lượng mua vượt quá số lượng trong kho, sử dụng hết số lượng hiện có
                    $soLuongMua -= $soLuongKho;
                    $sql_update_kho = "UPDATE khohang SET soLuong = 0 WHERE maLoai = ?";
                    $stmt_update_kho = $conn->prepare($sql_update_kho);
                    $stmt_update_kho->bind_param('i', $row_kho['maLoai']);
                    $stmt_update_kho->execute();
                } else {
                    // Nếu số lượng mua không vượt quá số lượng trong kho, trừ đi số lượng mua và thoát khỏi vòng lặp
                    $soLuongKhoMoi = $soLuongKho - $soLuongMua;
                    $sql_update_kho = "UPDATE khohang SET soLuong = ? WHERE maLoai = ?";
                    $stmt_update_kho = $conn->prepare($sql_update_kho);
                    $stmt_update_kho->bind_param('ii', $soLuongKhoMoi, $row_kho['maLoai']);
                    $stmt_update_kho->execute();
                    break;
                }
            }

            // Execute the update statement
            if (!$stmt_update_sanpham->execute()) {
                echo "Lỗi cập nhật số lượng sản phẩm: " . $stmt_update_sanpham->error;
                // Handle the error as needed
            }
        }

        if ($is_buy_now) {
            // Xử lý "Mua ngay"
            $maSanPham = $product['maSanPham'];
            $soLuong = $product['soLuong']; // Lấy số lượng từ giỏ hàng
            $donGia = $product['donGia'];
            $tongGia = $donGia * $soLuong;
            
            // Insert vào bảng chitietdonhang
            $sql_insert_chitietdonhang = "INSERT INTO chitietdonhang (maDonHang, maSanPham, soLuong, donGia, tongGia) VALUES (?, ?, ?, ?,?)";
            $stmt_insert_chitietdonhang = $conn->prepare($sql_insert_chitietdonhang);
            $stmt_insert_chitietdonhang->bind_param('iiiid', $maDonhang, $maSanPham, $soLuong, $donGia, $tongGia);
            $stmt_insert_chitietdonhang->execute();

            // Cập nhật số lượng sản phẩm trong bảng sanpham
            $soLuongMua = $soLuong;
            $stmt_update_sanpham->execute();

            // Xóa sản phẩm khỏi giỏ hàng
            $sql_delete_buynow = "DELETE FROM giohang WHERE maGioHang = ? AND loaiGioHang = 'buynow'";
            $stmt_delete_buynow = $conn->prepare($sql_delete_buynow);
            $stmt_delete_buynow->bind_param('i', $product_id);
            $stmt_delete_buynow->execute();
        } else {
            // Insert chi tiết đơn hàng cho tất cả sản phẩm trong giỏ hàng
            foreach ($result_giohang as $item) {
                $maSanPham = $item['maSanPham'];
                $soLuong = $item['soLuong'];
                $donGia = $item['donGia'];
                $tongGiaTri = $donGia * $soLuong;

                $sql_insert_chitietdonhang = "INSERT INTO chitietdonhang (maDonHang, maSanPham, soLuong, donGia) VALUES (?, ?, ?, ?)";
                $stmt_insert_chitietdonhang = $conn->prepare($sql_insert_chitietdonhang);
                $stmt_insert_chitietdonhang->bind_param('iiid', $maDonhang, $maSanPham, $soLuong, $donGia);
                $stmt_insert_chitietdonhang->execute();

                // Cập nhật số lượng sản phẩm trong bảng sanpham
                $soLuongMua = $soLuong;
                $stmt_update_sanpham->execute();
            }

            // Xóa giỏ hàng của khách hàng
            $sql_delete_giohang = "DELETE FROM giohang WHERE maKhachHang = ?";
            $stmt_delete_giohang = $conn->prepare($sql_delete_giohang);
            $stmt_delete_giohang->bind_param('s', $maKhachHang);
            $stmt_delete_giohang->execute();
        }

        // Đặt lại giỏ hàng tạm thời và tổng tiền
        $result_giohang = [];
        $total_price = 0;

        echo "<script>window.location.href='thankyou.php'</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee House</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./assets/css/dathang.css">
</head>

<body>
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                <li style="display: inline;"><a href="./index.php">Trang chủ</a></li>
                    <li class='active'>Đặt hàng</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
            <form action="" method="POST">
                <main class="checkout-section container">

                    <div class="checkout-col-left">
                        <div class="checkout-row">
                            <div class="checkout-col-title">Thông tin đơn hàng</div>
                            <div class="checkout-col-content">
                                <div class="content-group">
                                    <p class="checkout-content-label">Thời gian đặt</p>
                                    <div class="date-order" id="current-time"><?php echo date('d/m/Y H:i:s'); ?></div>
                                </div>
                                <div class="content-group">
                                    <p class="checkout-content-label">Ghi chú đơn hàng</p>
                                    <textarea type="text" class="note-order" placeholder="Nhập ghi chú" name="ghiChu"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-row">
                            <div class="checkout-col-title">Thông tin người nhận</div>
                            <div class="checkout-col-content">
                                <div class="content-group">
                                    <div class="form-group">
                                        <input id="tennguoinhan" name="tenKhachHang" type="text" value="<?php echo htmlspecialchars($row_khachhang['tenKhachhang']); ?>" placeholder="Tên người nhận" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input id="sdtnhan" name="soDienThoai" type="text" value="<?php echo htmlspecialchars($row_khachhang['soDienThoai']); ?>" placeholder="Số điện thoại nhận hàng" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input id="diachinhan" name="diaChi" type="text" placeholder="Địa chỉ nhận hàng" class="form-control chk-ship">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-col-right">
                        <p class="checkout-content-label">Đơn hàng</p>
                        <div class="bill-total" id="list-order-checkout">
                            <?php
                            // Kiểm tra và hiển thị danh sách sản phẩm trong giỏ hàng hoặc sản phẩm mua ngay
                            if ($is_buy_now) {
                            ?>
                                <div class="food-total">
                                    <div class="count"><?php echo htmlspecialchars($product['soLuong']); ?></div>
                                    <div class="info-food">
                                        <div class="name-food"><?php echo htmlspecialchars($product['tenSanPham']); ?></div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                if ($result_giohang->num_rows > 0) {
                                    while ($row_giohang = $result_giohang->fetch_assoc()) {
                                ?>
                                        <div class="food-total">
                                            <div class="count"><?php echo $row_giohang['soLuong'] . 'x'; ?></div>
                                            <div class="info-food">
                                                <div class="name-food"><?php echo htmlspecialchars($row_giohang['tenSanPham']); ?></div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                } else {
                                    echo '<p>Không có sản phẩm nào trong giỏ hàng của bạn.</p>';
                                }
                            }
                            ?>
                        </div>
                        <div class="bill-payment">
                            <div class="total-bill-order">
                                <?php
                                // Thiết lập biến tổng tiền hàng và phí vận chuyển (có thể cần tính toán từng trường hợp)
                                $shipping_fee = 30000; // Giả sử phí vận chuyển là 30,000 VNĐ
                                ?>
                                <div class="priceFlx">
                                    <div class="text">
                                        Tiền hàng
                                        <?php if ($is_buy_now) { ?>
                                            <span class="count">1 sản phẩm</span>
                                        <?php } else { ?>
                                            <span class="count"><?php echo $result_giohang->num_rows; ?> sản phẩm</span>
                                        <?php } ?>
                                    </div>
                                    <div class="price-detail">
                                        <span id="checkout-cart-total"><?php echo number_format($total_price) . '&nbsp;₫'; ?></span>
                                    </div>
                                </div>
                                <div class="priceFlx chk-ship">
                                    <div class="text">Phí vận chuyển</div>
                                    <div class="price-detail chk-free-ship">
                                        <span><?php echo number_format($shipping_fee) . '&nbsp;₫'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="policy-note">
                                Bằng việc bấm vào nút “Đặt hàng”, tôi đồng ý với <a href="#" target="_blank">chính sách hoạt động</a> của chúng tôi.
                            </div>
                        </div>
                        <div class="total-checkout">
                            <div class="text">Tổng tiền</div>
                            <div class="price-bill">
                                <div class="price-final" id="checkout-cart-price-final"><?php echo number_format($total_price + $shipping_fee) . '&nbsp;₫'; ?></div>
                            </div>
                        </div>
                        <button type="submit" class="complete-checkout-btn">Đặt hàng</button>
                        <?php if (!empty($error_message)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php } ?>
                    </div>


                </main>
            </form>
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/checkout.js"></script>
</body>

</html>