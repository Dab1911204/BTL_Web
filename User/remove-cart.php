<?php
session_start();
$maKhachhang = $_SESSION['maKhachHang'];
include "connect.php";
$id = $_GET['id'];

$sql = "DELETE FROM giohang WHERE maKhachHang = '$maKhachhang' AND maSanPham = '$id'";

mysqli_query($conn, $sql);

header("Location: cart.php");
?>
