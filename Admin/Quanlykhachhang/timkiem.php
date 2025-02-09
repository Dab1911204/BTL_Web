<?php
include 'ketnoi.php';
$keysearch = $_POST['key'];
$records_per_page= $_POST['page'];
$current_page = $_POST['current_page'];
$start = ($current_page - 1) * $records_per_page;
if($keysearch == "")
{
    $query = "SELECT kh.*, COUNT(dh.maDonhang) as TongDH,
		sum(CASE WHEN tinhTrang = 'ht' THEN 1 ELSE 0 END) as DonHangĐG,
		sum(CASE WHEN tinhTrang = 'bh' THEN 1 ELSE 0 END) as DonHangĐH
        FROM khachhang kh LEFT JOIN donhang dh on kh.maKhachHang = dh.maKhachHang
        GROUP BY kh.maKhachHang LIMIT $start, $records_per_page";
}
else
{
    $query = "SELECT kh.*, COUNT(dh.maDonhang) as TongDH,
		sum(CASE WHEN tinhTrang = 'Đã giao' THEN 1 ELSE 0 END) as DonHangĐG,
		sum(CASE WHEN tinhTrang = 'Đã hủy' THEN 1 ELSE 0 END) as DonHangĐH
        FROM khachhang kh LEFT JOIN donhang dh on kh.maKhachHang = dh.maKhachHang
         where tenKhachhang like '%$keysearch%' GROUP BY kh.maKhachHang
          LIMIT $start, $records_per_page";        
    }
$html='';
$result= mysqli_query($conn,$query);
$num= 1;
if(mysqli_num_rows($result)>0)
{
    $i=1;
    while($row = mysqli_fetch_assoc($result))
    {
        $html.= '<tr>
                        <td>'.$row["maKhachHang"].'</td>
                        <td>'.$row['tenKhachhang'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['soDienThoai'].'</td>                  
                        <td>'.$row['matkhau'].'</td>
                        <td>'.$row['TongDH'].'</td>
                        <td>'.$row['DonHangĐG'].'</td>
                        <td>'.$row['DonHangĐH'].'</td>
                    </tr>';
    }
};
echo $html;
?>