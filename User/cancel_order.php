<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['maKhachHang'])) {
    echo "Bạn cần đăng nhập để hủy đơn hàng.";
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $maKhachHang = $_SESSION['maKhachHang'];

    // Kiểm tra xem đơn hàng có thuộc về khách hàng hiện tại không và trạng thái đơn hàng
    $sql_check_order = "SELECT * FROM donhang WHERE maDonhang = ? AND maKhachHang = ?";
    $stmt_check_order = $conn->prepare($sql_check_order);
    $stmt_check_order->bind_param('ss', $order_id, $maKhachHang);
    $stmt_check_order->execute();
    $result_check_order = $stmt_check_order->get_result();

    if ($result_check_order->num_rows > 0) {
        $row_check_order = $result_check_order->fetch_assoc();
        $orderStatus = $row_check_order['tinhTrang'];
    } else {
        echo "Đơn hàng không tồn tại hoặc không thuộc về bạn.";
        exit();
    }

    // Chỉ cho phép hủy nếu trạng thái đơn hàng là "Chờ xử lý"
    if ($orderStatus === 'Chờ xử lý') {
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $sql_cancel_order = "UPDATE donhang SET tinhTrang = 'Đã hủy' WHERE maDonhang = ?";
        $stmt_cancel_order = $conn->prepare($sql_cancel_order);
        $stmt_cancel_order->bind_param('s', $order_id);

        if ($stmt_cancel_order->execute()) {
            // Lấy thông tin chi tiết đơn hàng
            $sql_order_details = "SELECT * FROM chitietdonhang WHERE maDonhang = ?";
            $stmt_order_details = $conn->prepare($sql_order_details);
            $stmt_order_details->bind_param('s', $order_id);
            $stmt_order_details->execute();
            $result_order_details = $stmt_order_details->get_result();

            while ($row = $result_order_details->fetch_assoc()) {
                
                $soLuong = $row['soLuong'];
                $maSanPham = $row['maSanPham'];

                // Lấy lô hàng cũ nhất của sản phẩm để cộng lại số lượng
                $sql_get_oldest_stock = "SELECT * FROM khohang WHERE maSanPham = ? AND tinhTrang != 'Hỏng' ORDER BY ngayNhap ASC LIMIT 1";
                $stmt_get_oldest_stock = $conn->prepare($sql_get_oldest_stock);
                $stmt_get_oldest_stock->bind_param('i', $maSanPham);
                $stmt_get_oldest_stock->execute();
                $result_oldest_stock = $stmt_get_oldest_stock->get_result();

                if ($result_oldest_stock->num_rows > 0) {
                    $row_oldest_stock = $result_oldest_stock->fetch_assoc();
                    $oldest_stock_id = $row_oldest_stock['maLoai'];

                    // Cộng lại số lượng vào lô hàng cũ nhất
                    $sql_update_stock = "UPDATE khohang SET soLuong = soLuong + ? WHERE maLoai = ?";
                    $stmt_update_stock = $conn->prepare($sql_update_stock);
                    $stmt_update_stock->bind_param('is', $soLuong, $oldest_stock_id);

                    if (!$stmt_update_stock->execute()) {
                        echo "Có lỗi xảy ra khi cập nhật kho hàng. Vui lòng thử lại sau.";
                        exit();
                    }
                } else {
                    echo "Không tìm thấy lô hàng để cập nhật.";
                    exit();
                }
            }

            echo "Đơn hàng đã được hủy thành công.";
        } else {
            echo "Có lỗi xảy ra khi hủy đơn hàng. Vui lòng thử lại sau.";
        }
    } else {
        echo "Chỉ có thể hủy đơn hàng ở trạng thái 'Chờ xử lý'.";
    }
} else {
    echo "Không tìm thấy mã đơn hàng.";
}
?>
