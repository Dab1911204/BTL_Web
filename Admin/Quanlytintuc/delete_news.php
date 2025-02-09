<?php
    // lấy id dữ liệu cần xóa
    $matintuc = $_GET['matintuc'];
    // kêt nối
    include 'connect.php';
    // câu lệnh
    $sql = "DELETE FROM tintuc WHERE maTintuc = $matintuc";
    // thực thi câu lệnh
    mysqli_query($conn, $sql);
    // chuyển trang
    header('location: news.php');
?>