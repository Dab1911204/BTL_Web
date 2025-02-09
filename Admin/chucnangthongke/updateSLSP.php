<?php
    include 'connect.php';
    $sqlMaSP = "SELECT maSanPham,soLuong FROM sanpham";
    $resultMaSP = mysqli_query($conn, $sqlMaSP);
    foreach ($resultMaSP as $maSP) {
        $sqlTimSoLuong = "SELECT SUM(soLuong) FROM khohang WHERE maSanPham = '".$maSP['maSanPham']."' AND tinhTrang != 'Hỏng'";
        $resultSoLuongSP = mysqli_query($conn, $sqlTimSoLuong);
        if (mysqli_num_rows($resultSoLuongSP) == 0) {
            $soLuong = 0;
            $sqlUpdateSoLuong = "UPDATE sanpham SET soLuong = '$soLuong',tinhTrang = 'Hết hàng' WHERE maSanPham = '$maSanPham'";
            mysqli_query($conn, $sqlUpdateSoLuong);
        }else {
            $soLuong = mysqli_fetch_array($resultSoLuongSP);
            if($soLuong[0] == 0){
                $sqlUpdateSoLuong = "UPDATE sanpham SET soLuong = '".$soLuong[0]."',tinhTrang = 'Hết hàng' WHERE maSanPham = '".$maSP['maSanPham']."'";
                mysqli_query($conn, $sqlUpdateSoLuong);
            }else{
                $sqlUpdateSoLuong = "UPDATE sanpham SET soLuong = '".$soLuong[0]."',tinhTrang = 'Còn hàng' WHERE maSanPham = '".$maSP['maSanPham']."'";
                mysqli_query($conn, $sqlUpdateSoLuong);
            }
        }
        
    }
    
?>