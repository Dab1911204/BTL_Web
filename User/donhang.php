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
// Truy vấn thông tin khách hàng từ bảng khachhang
$sql_khachhang = "SELECT tenKhachHang, soDienThoai FROM khachhang WHERE maKhachHang = ?";
$stmt_khachhang = $conn->prepare($sql_khachhang);
$stmt_khachhang->bind_param('s', $maKhachHang);
$stmt_khachhang->execute();
$result_khachhang = $stmt_khachhang->get_result();
$row_khachhang = $result_khachhang->fetch_assoc();

// Truy vấn thông tin đơn hàng từ bảng donhang
$sql_donhang = "SELECT * FROM donhang WHERE maKhachHang = ? ORDER BY thoiGianDat DESC";
$stmt_donhang = $conn->prepare($sql_donhang);
$stmt_donhang->bind_param('s', $maKhachHang);
$stmt_donhang->execute();
$result_donhang = $stmt_donhang->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee House</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./assets/css/donhang.css">
</head>

<body>
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                <li style="display: inline;"><a href="./index.php">Trang chủ</a></li>
                    <li class='active'>Đơn hàng của tôi</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <main class="checkout-section container">
        <div class="container open" id="order-history">
            <div class="main-account">
                <div class="main-account-header">
                    <h3>Quản lý đơn hàng của bạn</h3>
                    <p>Xem chi tiết, trạng thái của những đơn hàng đã đặt.</p>
                </div>
                <div class="main-account-body">
                    <div class="order-history-section">
                        <?php
                        // Kiểm tra và hiển thị danh sách đơn hàng
                        if ($result_donhang->num_rows > 0) {
                            while ($row_donhang = $result_donhang->fetch_assoc()) {
                                $maDonhang = $row_donhang['maDonhang'];
                                $thoiGianDat = $row_donhang['thoiGianDat'];
                                $diaChiKhachHang = $row_donhang['diaChiKhachHang'];
                                $tongGiaTri = $row_donhang['tongGiaTri'];
                                $ghiChu = $row_donhang['ghiChu'];
                                $tinhTrang = $row_donhang['tinhTrang'];

                                // Truy vấn chi tiết đơn hàng từ bảng chitietdonhang và sanpham
                                $sql_chitietdonhang = "SELECT ct.*, sp.tenSanPham, sp.anhSanPham FROM chitietdonhang ct JOIN sanpham sp ON ct.maSanPham = sp.maSanPham WHERE ct.maDonhang = ?";
                                $stmt_chitietdonhang = $conn->prepare($sql_chitietdonhang);
                                $stmt_chitietdonhang->bind_param('s', $maDonhang);
                                $stmt_chitietdonhang->execute();
                                $result_chitietdonhang = $stmt_chitietdonhang->get_result();

                                // Hiển thị mỗi đơn hàng và chi tiết của nó

                        ?>
                                <div class="order-history-group">
                                    <?php
                                    while ($row_chitietdonhang = $result_chitietdonhang->fetch_assoc()) {
                                    ?>
                                        <div class="order-history">

                                            <div class="order-history-left">
                                                <img src="../imgchung/<?php echo $row_chitietdonhang['anhSanPham']; ?>" alt="">
                                                <div class="order-history-info">
                                                    <h4><?php echo htmlspecialchars($row_chitietdonhang['tenSanPham']); ?></h4>
                                                    <p class="order-history-note"><i class="fa-solid fa-pen"></i> <?php echo htmlspecialchars($row_donhang['ghiChu']); ?></p>
                                                    <p class="order-history-quantity">x<?php echo $row_chitietdonhang['soLuong']; ?></p>
                                                </div>
                                            </div>
                                            <div class="order-history-right">
                                                <div class="order-history-price">
                                                    <span class="order-history-current-price"><?php echo number_format($row_chitietdonhang['donGia']) . '&nbsp;₫'; ?></span>
                                                </div>
                                            </div>

                                        </div>
                                    <?php } ?>
                                    <div class="order-history-control">
                                        <div class="order-history-status">
                                            <span class="order-history-status-sp" >
                                                <i class="fa-solid fa-spinner" ></i>
                                                <?php echo htmlspecialchars($row_donhang['tinhTrang']); ?>
                                            </span>
                                            <button type="button" id="order-history-detail" data-toggle="modal" data-target="#myModal<?php echo $maDonhang; ?>" style="background-color: #85cc47; color: white;">
                                                <i class="fa-regular fa-eye"></i> Xem chi tiết
                                            </button>
                                            <button class="order-history-status-sp" type="button" id="cancel-order" data-order-id="<?php echo $maDonhang; ?>" <?php echo $tinhTrang !== 'Chờ xử lý' ? 'disabled' : ''; ?> style="background-color: red; color: white;">
                                                <i class="fa-solid fa-ban"></i> Hủy Đơn
                                            </button>

                                        </div>
                                        <div class="order-history-total">
                                            <span class="order-history-total-desc">Tổng tiền: </span>
                                            <span class="order-history-toltal-price"><?php echo number_format($tongGiaTri) . '&nbsp;₫'; ?></span>
                                        </div>
                                    </div>
                                </div>
                        <?php

                            }
                        } else {
                            echo '<p>Bạn chưa có đơn hàng nào.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <?php
    // Hiển thị modal cho từng đơn hàng
    $result_donhang->data_seek(0); // Đưa con trỏ về đầu kết quả
    while ($row_donhang = $result_donhang->fetch_assoc()) {
        $maDonhang = $row_donhang['maDonhang'];
    ?>
        <div class="modal fade" id="myModal<?php echo $maDonhang; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel">Thông tin đơn hàng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="modal-container mdl-cnt">
                            <div class="detail-order-content">
                                <ul class="detail-order-group">
                                    <li class="detail-order-item">
                                        <span class="detail-order-item-left"><i class="fa-solid fa-calendar-days"></i></i> Ngày đặt hàng</span>
                                        <span class="detail-order-item-right"><?php echo htmlspecialchars($row_donhang['thoiGianDat']); ?></span>
                                    </li>
                                    <li class="detail-order-item">
                                        <span class="detail-order-item-left"><i class="fa-solid fa-location-dot"></i> Địa điểm nhận</span>
                                        <span class="detail-order-item-right"><?php echo htmlspecialchars($row_donhang['diaChiKhachHang']); ?></span>
                                    </li>
                                    <li class="detail-order-item">
                                        <span class="detail-order-item-left"><i class="fa-solid fa-person"></i> Người nhận</span>
                                        <span class="detail-order-item-right"><?php echo htmlspecialchars($row_khachhang['tenKhachHang']); ?></span>
                                    </li>
                                    <li class="detail-order-item">
                                        <span class="detail-order-item-left"><i class="fa-solid fa-phone"></i> Số điện thoại nhận</span>
                                        <span class="detail-order-item-right"><?php echo htmlspecialchars($row_khachhang['soDienThoai']); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script>
        document.querySelectorAll('#cancel-order').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.getAttribute('data-order-id');
                if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                    // Gửi yêu cầu hủy đơn hàng đến máy chủ
                    fetch(`cancel_order.php?order_id=${orderId}`, {
                            method: 'GET',
                            credentials: 'same-origin'
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            location.reload(); // Tải lại trang để cập nhật danh sách đơn hàng
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>


    <?php require_once('footer.php'); ?>
</body>

</html>