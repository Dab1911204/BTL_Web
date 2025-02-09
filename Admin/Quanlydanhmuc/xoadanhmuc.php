<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $maDanhMuc=$_GET['id'];          
    $conn= mysqli_connect("localhost","root","","btl_web");
    if(!$conn)
    {
        echo 'Kết nối không thành công, lỗi:'.mysqli_connect_error();
    }
    else{
        //tìm danh muc con của thằng đang muốn xóa
        $query_Child = "select * from danhmuc where danhMucCha = $maDanhMuc";
        $result_Child = mysqli_query($conn, $query_Child);
        if(mysqli_num_rows($result_Child)>0)
        {
            while ($row = mysqli_fetch_assoc($result_Child)){
                //tìm thằng cha của thằng đang muốn xóa
                $maDMParant = $row["maDanhMuc"];
                $query_Parant = "select danhMucCha from danhmuc where maDanhMuc = $maDanhMuc";
                $result_Parant = mysqli_query($conn, $query_Parant);
                if(mysqli_num_rows($result_Parant)>0)
                {
                    $data = mysqli_fetch_assoc($result_Parant)['danhMucCha']; 
                    //tăng cấp cho mấy thằng con
                    $queryUpdate = "UPDATE danhmuc SET danhMucCha ='".$data."' where maDanhMuc = $maDMParant";
                    mysqli_query($conn, $queryUpdate);
                }
            }            
        } 
        // lấy sản phẩm có mã danh mục cần xóa
        $sql = "SELECT * FROM sanpham WHERE maDanhMuc = $maDanhMuc";
        $result_xoasp = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result_xoasp)> 0) // mysqli_num_rows là số dòng của kqua truy vấn
        {
            while ($row = mysqli_fetch_assoc($result_xoasp)){ // mysqli_fetch_assoc lấy từng dòng
                // xóa sản phẩm               
                $maSanPham = $row["maSanPham"];
                $sql_donhang = "SELECT * FROM chitietdonhang WHERE maSanPham = $maSanPham";
                $result_donhang= mysqli_query($conn, $sql_donhang);
                // xóa sản phẩm trong giỏ hàng                
                $sql_giohang = "SELECT * FROM giohang WHERE maSanPham = $maSanPham";
                
                $result_giohang = mysqli_query($conn, $sql_giohang);
                if(mysqli_num_rows($result_donhang)>0)
                {                  
                    $row_donhang = mysqli_fetch_assoc($result_donhang);
                    echo "Sản phẩm này đã có đơn hàng nên không thể xóa!";
                    header ('location: hienthi.php');
                     // trường hợp muốn xóa hết luôn
                       // $sql_donhang = "DELETE FROM donhang WHERE maSanPham= '$maSanPham'";
                        // // thực thi câu lệnh
                        // $result= mysqli_query($conn, $sql_donhang);
                    
                }
                else if(mysqli_num_rows($result_giohang)>0)
                {
                    $row_giohang = mysqli_fetch_assoc($result_giohang);
                    echo "Sản phẩm này đã có trong giỏ hàng nên không thể xóa!";
                    header ('location: hienthi.php');
                    // trư��ng h��p muốn xóa hết luôn
                    // $sql_giohang = "DELETE FROM giohang WHERE maSanPham= '$maSanPham'";
                    // thực thi câu lệnh
                    // $result= mysqli_query($conn, $sql_giohang);                  
                }
                else 
                {
                    $tenAnh = $row['anh'];
                    $path = "uploads/$tenAnh";
                    if(file_exists($path))
                    {
                        unlink($path);
                    }
                    // xóa sản phẩm trong danh mục cần xóa.
                    $sql_xoasp= "DELETE FROM sanpham WHERE maSanPham = $maSanPham";
                    // thực thi câu lệnh
                    $result= mysqli_query($conn, $sql_xoasp);
                }
        } 

        $sql="delete from danhmuc where maDanhMuc='$maDanhMuc'";            
        $result1= mysqli_query($conn, $sql);
        header('location: hienthi.php');
    }else{
        $sql="delete from danhmuc where maDanhMuc='$maDanhMuc'";            
        $result1= mysqli_query($conn, $sql);
        header('location: hienthi.php');
    }
    }   
    ?>  
</body>
</html>