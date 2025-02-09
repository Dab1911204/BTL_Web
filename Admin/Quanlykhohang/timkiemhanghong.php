<?php
include 'connect.php';
$keysearch = $_POST['key'];
$records_per_page = $_POST['page'];
$current_page = $_POST['current_page'];
$start = ($current_page - 1) * $records_per_page;
if ($keysearch == "") {
    $query = "select * from khohang  WHERE tinhTrang = 'Hỏng' LIMIT $start, $records_per_page";
} else {
    $query = "select * from khohang where tenSanPham like '%$keysearch%'  AND tinhTrang = 'Hỏng' LIMIT $start, $records_per_page";
}
$html = '';
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $i = $current_page;
    while ($row = mysqli_fetch_assoc($result)) {
        $sql1 = "SELECT * FROM nhacungcap where maNhaCungCap =" . $row['maNhaCungCap'];
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $html .= '<tr>
                <td>' . $row['tenSanPham'] . '</td>
                <td>' . $row1['tenNhaCungCap'] . '</td>
                <td>' . $row['soLuong'] . '</td>
                <td>' . $row['ngayNhap'] . '</td>
                <td>' . $row['hanSuDung'] . '</td>
                <td>' . number_format($row['giaNhap'], 0, '', '.') . " VNĐ" . '</td>
                <td>' . number_format($row['tongTienNhap'], 0, '', '.') . " VNĐ" . '</td>
                <td>' . $row['tinhTrang'] . '</td>
                <td> <a href="Suakho.php?id= ' . $row['maLoai'] . '" class="btn btn-info">Sửa</a>
                  <a onclick="return confirm(\'Bạn có muốn xóa sản phẩm này không\');" href="Xoakhohang.php?id=' . $row['maLoai'] . '" class="btn btn-danger">Xóa</a>
                </td>
              </tr>';
    }
};
echo $html;
