<?php   
    include 'ketnoi.php';
    $keysearch = $_POST['key'];
    $records_per_page = $_POST['page'];
    $current_page = $_POST['current_page'];
    $start= ($current_page - 1) * $records_per_page;
    if($keysearch=="")
    {
        $query= "select * from sanpham LIMIT $start, $records_per_page";
    }
    else{
        // tìm kiếm theo tên nhà cung cấp, nếu muốn tmf kiếm theo địa chỉ cần thêm " or diaChi like '%E$keysearch%'" vào trước limit
        $query= "select * from sanpham where tenSanPham like '%$keysearch%' LIMIT $start, $records_per_page";
    }
    $html='';
    $result= mysqli_query($conn, $query);
    $num = 1;
    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while ($row = mysqli_fetch_assoc($result))
        {
           
            $sql1 = "SELECT * FROM nhacungcap where maNhaCungCap =" . $row['maNhaCungCap'];
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $sql2 = "SELECT * FROM danhmuc where maDanhMuc =" . $row['maDanhMuc'];
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
        
            $html.= '<tr>
                        <td>'. $row['tenSanPham'].'</td>
                        <td>'.$row1['tenNhaCungCap'].'</td>
                        <td>'.$row2['tenDanhMuc'].'</td>
                        <td>'.$row['soLuong'].'</td>
                        <td>'.number_format($row['donGia'], 0,'', '.')."VNĐ".'</td>
                        <td>'.$row['tinhTrang'].'</td>
                        <td>'.$row['moTaSanPham'].'</td>
                        <td><img class="img-responsive" src="/Demo (1)/imgchung/'.$row['anhSanPham'].'" width=150px height=100px alt=""></td>

                        <td> <a href="suasanpham.php?id= '.$row['maSanPham'].'" class="btn btn-info">Sửa</a>
                         <a onclick="return confirm(\'Bạn có muốn xóa sản phẩm này không\');" href="xoasanpham.php?id='.$row['maSanPham'].'" class="btn btn-danger">Xóa</a>
              </td>
                    </tr>';
        }
    };
    echo $html;
?>