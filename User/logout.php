<?php
    session_start();
    if (isset($_SESSION['maKhachHang'])){
        unset($_SESSION['maKhachHang']);
    }
    header('location:index.php');
?>