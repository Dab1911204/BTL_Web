<?php
    // lấy id dữ liệu cần xóa
    $id = $_GET['id'];
    // kêt nối
    require_once 'ketnoi.php';
    // câu lệnh xóa sản phẩm 
    $sql_xoasp = "DELETE FROM sanpham WHERE maNhaCungCap = '$id'";
    // thực thi câu lệnh
    $result1 = mysqli_query($conn, $sql_xoasp);
    // câu lệnh xóa kho hàng.
    $sql_xoakh = "DELETE FROM khohang WHERE maNhaCungCap = '$id'";
    // thực thi câu lệnh
    $result2 = mysqli_query($conn, $sql_xoakh);
    
    if($result1 > 0 || $result2 > 0 )
    {
        // câu lệnh xóa nhà cung cấp
        $sql = "DELETE FROM nhacungcap WHERE maNhaCungCap = '$id'";
        // thực thi câu lệnh
        $result3 = mysqli_query($conn, $sql);
        }
    else
    {
        echo "Xóa thất bại";
    }
    // chuyển trang
    header('location: hienthi.php');
?>