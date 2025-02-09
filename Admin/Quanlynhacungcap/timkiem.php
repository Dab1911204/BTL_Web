<?php   
    include 'ketnoi.php';
    $keysearch = $_POST['key'];
    $records_per_page = $_POST['page']; // số bản ghi trên 1 page
    $current_page = $_POST['current_page']; // page hiện tại
    $start= ($current_page - 1) * $records_per_page;
    if($keysearch=="")
    {
        $query= "select * from nhacungcap LIMIT $start, $records_per_page";
    }
    else{
        // tìm kiếm theo tên nhà cung cấp, nếu muốn tmf kiếm theo địa chỉ cần thêm " or diaChi like '%E$keysearch%'" vào trước limit
        $query= "select * from nhacungcap where tenNhaCungCap like '%$keysearch%' LIMIT $start, $records_per_page"; // limit là giới hạn bản ghi
    }
    $html='';
    $result= mysqli_query($conn, $query);  
    if(mysqli_num_rows($result)>0)
    {       
        while ($row = mysqli_fetch_assoc($result))
        {
            $html.= '<tr>
                        <td>'.$row["tenNhaCungCap"].'</td>
                        <td>'. $row['diaChi'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'. $row['soDienThoai'].'</td>
                        <td>'. $row['ghiChu'].'</td>
                        <td> <a href="suanhacungcap.php?id='. $row['maNhaCungCap'].'" class="btn btn-info">Sửa</a>
                            <a onclick="return confirm(\'Bạn có muốn xóa sinh viên này không\');"
                                href="xoanhacungcap.php?id='. $row['maNhaCungCap'].'"
                                class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>';
        }
    };
    echo $html;
?>