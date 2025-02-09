<?php
include 'connect.php';

if (isset($_POST['maKhachHang']) && isset($_POST['maSanPham']) && isset($_POST['soLuongMoi'])) {
    $maKhachHang = $_POST['maKhachHang'];
    $maSanPham = $_POST['maSanPham'];
    $soLuongMoi = $_POST['soLuongMoi'];

    $sql_update_product_new = "UPDATE giohang SET soLuong = '$soLuongMoi' WHERE maKhachHang = '$maKhachHang' and maSanPham = '$maSanPham'";
    if (mysqli_query($conn, $sql_update_product_new)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
