<?php   
    include 'ketnoi.php';
    $keysearch = $_POST['key'];
    $records_per_page = $_POST['page'];
    $current_page = $_POST['current_page'];
    $start= ($current_page - 1) * $records_per_page;
    if($keysearch=="")
    {
        $query= "select * from donhang WHERE `tinhTrang` != 'Đã hủy' AND `tinhTrang` != 'Đã giao' LIMIT $start, $records_per_page";
    }
    else{
        // tìm kiếm theo tên nhà cung cấp, nếu muốn tmf kiếm theo địa chỉ cần thêm " or diaChi like '%E$keysearch%'" vào trước limit
        $query= "select * from donhang where maDonhang like '%$keysearch%' AND `tinhTrang` != 'Đã hủy' AND `tinhTrang` != 'Đã giao' LIMIT $start, $records_per_page";
    }
    $html='';
    $result= mysqli_query($conn, $query);
    $num = 1;
    if(mysqli_num_rows($result)>0)
     {
    //     $i=1;
    //     while ($row = mysqli_fetch_assoc($result))
    //     {
    //         $html.= '<tr>
    //                     <td>'.$row["maDonhang"].'</td>
    //                     <td>'. $row['thoiGianDat'].'</td>
    //                     <td>'.$row['tinhTrang'].'</td>
    //                     <td>'. $row['Xem'].'</td>
    //                     <td>'. $row['ghiChu'].'</td>
                        
    //                 </tr>';
    //     }
                                $stt = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $stt++;
                                    $html.= '<tr>
                                        <td> '.$stt.'</td>
                                        <td>'.$row['maDonhang'].'</td>
                                        <td> '.$row['thoiGianDat'].'</td>
                                        <td><span>'.$row['tinhTrang'].'</span></td>
                                        <td><a class="btn btn-warning" href="vieworders.php?id='.$row['maDonhang'].'">Xem</a></td>

                                    </tr>';
                                };
    echo $html;
}
?>