<?php
include 'connect.php';
$ngay = $_POST['day'];

$sql_tong_donhang = "SELECT SUM(`tongGiaTri`) AS total_amount
                    FROM donhang WHERE DATE(thoiGianDat) = '$ngay'";
$result_tong_donhang = mysqli_query($conn, $sql_tong_donhang);
while ($row_tong_donhang = mysqli_fetch_assoc($result_tong_donhang)) {
    $tong_donhang = $row_tong_donhang['total_amount'];
}
$sql_tong_khohang = "SELECT SUM(`tongTienNhap`) AS total_amount
                  FROM khohang WHERE DATE(ngayNhap) = '$ngay'";
$result_tong_khohang = mysqli_query($conn, $sql_tong_khohang);
while ($row = mysqli_fetch_assoc($result_tong_khohang)) {
    $tong_kho = $row['total_amount'];
}
$tong_loi_nhuan = $tong_donhang - $tong_kho;

echo '<h1>'.number_format($tong_loi_nhuan, 0, '', '.')." VNĐ".'</h1>';
?>