<?php
    include 'connect.php';
    $ngay = $_POST['day'];
    $sql_thu_nhap = "SELECT COUNT(*) as soLuong FROM donhang WHERE tinhTrang != 'Đã giao' AND thoiGianDat <= '$ngay'";
    $result_thu_nhap = mysqli_query($conn, $sql_thu_nhap);
    $row_so_luong = mysqli_fetch_assoc($result_thu_nhap);
    $soLuong  = $row_so_luong['soLuong'];
    echo $soLuong.'        <i class="fa-solid fa-receipt" ></i>';
?>