<?php
    // lấy id dữ liệu cần xóa
    $maLoai = $_GET['id'];
    // kêt nối
    include 'connect.php';
    // câu lệnh
    $sql_select_kho = "SELECT * FROM khohang WHERE maLoai = $maLoai";
    $result_select_kho = mysqli_query($conn,$sql_select_kho);
    $row_select_kho = mysqli_fetch_assoc($result_select_kho);
    $soluong = $row_select_kho['soLuong'];
    $maSanPham = $row_select_kho['maSanPham'];
    // cập nhật lại số lượng sản phẩm trong kho
    $sql_select_sp = "SELECT * FROM sanpham WHERE maSanPham = '$maSanPham'";
    $result_select_sp = mysqli_query($conn,$sql_select_sp);
    $row_select_sp = mysqli_fetch_assoc($result_select_sp);
    $soluongmoi = $row_select_sp['soLuong'] - $soluong;
    $sql_update_sp = "UPDATE sanpham SET soLuong = $soluongmoi WHERE maSanPham = '$maSanPham'";
    mysqli_query($conn, $sql_update_sp);
    $sql = "DELETE FROM khohang WHERE maLoai = $maLoai";
    // thực thi câu lệnh
    mysqli_query($conn, $sql);
    // chuyển trang
    header('location: khohang.php');

?>