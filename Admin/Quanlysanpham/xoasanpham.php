<?php
    // lấy id dữ liệu cần xóa
    $id = $_GET['id'];
    // kêt nối
    require_once 'ketnoi.php';
    // câu lệnh
    $sql = "DELETE FROM sanpham WHERE maSanPham = $id";
    // thực thi câu lệnh
    mysqli_query($conn, $sql);
    // chuyển trang
    header('location: hienthi.php');

