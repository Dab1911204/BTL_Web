<?php
include 'connect.php';
    $homnay = date("Y-m-d");
    $sql_udate_khohang = "UPDATE khohang SET `tinhTrang` = 'Hỏng' WHERE DATE(`hanSuDung`) < '$homnay'";
    mysqli_query($conn, $sql_udate_khohang);
    $sql_sanpham = 'SELECT * FROM sanpham';
    $result_sanpham = mysqli_query($conn, $sql_sanpham);
    while($row_sanpham = mysqli_fetch_array($result_sanpham)) {
        $masanpham[] = $row_sanpham['maSanPham'];
        $soluong[] = $row_sanpham['soLuong'];
    }
    for($i = 0; $i < mysqli_num_rows($result_sanpham); $i++) {
        $ma = $masanpham[$i];
        echo "Mã:";
        echo $ma;
        echo "<br>";
        $soLuong_sanPham = $soluong[$i];
        echo "Số lượng:";
        echo $soLuong_sanPham;
        echo "<br>";
        $sql_so_sp_hong = "Select * from khohang where maSanPham = $ma AND tinhTrang = 'Hỏng'";
        $result_so_sp_hong = mysqli_query($conn, $sql_so_sp_hong);
        while($row_so_sp_hong = mysqli_fetch_array($result_so_sp_hong)){
            echo"Số lượng sản phẩn trong kho".$row_so_sp_hong['soLuong'];
            echo "<br>";
            $soLuong_sanPham = $soLuong_sanPham - $row_so_sp_hong['soLuong'];
        }
        echo "Số lượng mới:";
        echo $soLuong_sanPham;
        echo "<br>";
        $sql_udate_so_luong = "Update sanpham set soLuong = '$soLuong_sanPham' WHERE maSanPham = '$ma'";
        $sql_udate_so_luong_hong = "Update khohang set soLuong = '0' WHERE maSanPham = '$ma' AND `tinhTrang` = 'Hỏng'";
        mysqli_query($conn, $sql_udate_so_luong);
        mysqli_query($conn, $sql_udate_so_luong_hong);
        $sql_udate_so_luong_sanPham = "Update sanpham set tinhTrang = 'Hết hàng' WHERE soLuong = '0'";
        mysqli_query($conn, $sql_udate_so_luong_sanPham);
        
    }
    echo"success";  
?>