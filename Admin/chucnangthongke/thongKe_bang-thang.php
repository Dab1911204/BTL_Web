<?php
include 'connect.php';
$nam = $_POST['year'];
$thang = $_POST['month'];
//thống kê đơn hàng
$sql_donhang_thang = "SELECT DAY(`thoiGianDat`) AS day, SUM(`tongGiaTri`) AS total_amount, MONTH(`thoiGianDat`) AS month 
  FROM donhang WHERE MONTH(`thoiGianDat`) = '$thang' AND YEAR(`thoiGianDat`) = '$nam' AND `tinhTrang` = 'Đã giao'
  GROUP BY DAY(`thoiGianDat`), MONTH(`thoiGianDat`) ORDER BY MONTH(`thoiGianDat`), DAY(`thoiGianDat`)";
$result_donhang_thang = mysqli_query($conn, $sql_donhang_thang);
$data_donhang_thang = [];
while ($row_donhang_thang = mysqli_fetch_array($result_donhang_thang)) {
    $data_donhang_thang[] = $row_donhang_thang;
};
$sql_khohang_thang = "SELECT DAY(`ngayNhap`) AS day, SUM(`tongTienNhap`) AS total_amount, MONTH(`ngayNhap`) AS month 
  FROM khohang WHERE MONTH(`ngayNhap`) = '$thang' AND YEAR(`ngayNhap`) = '$nam' 
  GROUP BY DAY(`ngayNhap`), MONTH(`ngayNhap`) ORDER BY MONTH(`ngayNhap`), DAY(`ngayNhap`);";
$result_khohang_thang = mysqli_query($conn, $sql_khohang_thang);
$data_khohang_thang = [];
while ($row_khohang_thang = mysqli_fetch_array($result_khohang_thang)) {
    $data_khohang_thang[] = $row_khohang_thang;
};
$thang_31_ngay = [1, 3, 5, 7, 8, 10, 12];
$thang_30_ngay = [4, 6, 9, 11];
if ($thang == 2) {
    if (($nam % 4 == 0 && $nam % 100 != 0) || $nam % 400 == 0) {
        $ngay_trong_thang = 29;
        $values_donhang_thang = array_fill(0, 29, 0); // Khởi tạo tất cả các giá trị bằng 0
        foreach ($data_donhang_thang as $entry) {
            $day = $entry['day'];
            $total_amount = $entry['total_amount'];
            $month = $entry['month'];
            $values_donhang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
        }
    } else {
        $ngay_trong_thang = 28;
        $values_donhang_thang = array_fill(0, 28, 0);
        foreach ($data_donhang_thang as $entry) {
            $day = $entry['day'];
            $total_amount = $entry['total_amount'];
            $month = $entry['month'];
            $values_donhang_thang[$day - 1] = $total_amount;
        }
    }
} else if (in_array($thang, $thang_31_ngay)) {
    $ngay_trong_thang = 31;
    $values_donhang_thang = array_fill(0, 31, 0); // Khởi tạo tất cả các giá trị bằng 0
    foreach ($data_donhang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_donhang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
    }
} else if (in_array($thang, $thang_30_ngay)) {
    $ngay_trong_thang = 30;
    $values_donhang_thang = array_fill(0, 30, 0); // Khởi tạo tất cả các giá trị bằng 0
    foreach ($data_donhang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_donhang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
    }
}

// Thống kê theo kho hàng
$sql_khohang_thang = "SELECT DAY(`ngayNhap`) AS day, SUM(`tongTienNhap`) AS total_amount, MONTH(`ngayNhap`) AS month 
  FROM khohang WHERE MONTH(`ngayNhap`) = '$thang' AND YEAR(`ngayNhap`) = '$nam' 
  GROUP BY DAY(`ngayNhap`), MONTH(`ngayNhap`) ORDER BY MONTH(`ngayNhap`), DAY(`ngayNhap`);";
$result_khohang_thang = mysqli_query($conn, $sql_khohang_thang);
$data_khohang_thang = [];
while ($row_khohang_thang = mysqli_fetch_array($result_khohang_thang)) {
    $data_khohang_thang[] = $row_khohang_thang;
};
if ($thang == 2) {
    if (($nam % 4 == 0 && $nam % 100 != 0) || $nam % 400 == 0) {
        $values_khohang_thang = array_fill(0, 29, 0); // Khởi tạo tất cả các giá trị bằng 0
        foreach ($data_khohang_thang as $entry) {
            $day = $entry['day'];
            $total_amount = $entry['total_amount'];
            $month = $entry['month'];
            $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
        }
    } else {
        $values_khohang_thang = array_fill(0, 28, 0);
        foreach ($data_khohang_thang as $entry) {
            $day = $entry['day'];
            $total_amount = $entry['total_amount'];
            $month = $entry['month'];
            $values_khohang_thang[$day - 1] = $total_amount;
        }
    }
} else if (in_array($thang, $thang_31_ngay)) {
    $values_khohang_thang = array_fill(0, 31, 0); // Khởi tạo tất cả các giá trị bằng 0
    foreach ($data_khohang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
    }
} else if (in_array($thang, $thang_30_ngay)) {
    $values_khohang_thang = array_fill(0, 30, 0); // Khởi tạo tất cả các giá trị bằng 0
    foreach ($data_khohang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
    }
}

$html = '
                    <div class="header_chart">
                      <h4 id="thongkenam">THỐNG KÊ THÁNG</h4>
                    </div>
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th>Ngày</th>
                          <th>Doanh Thu</th>
                          <th>Chi phí nhập hàng</th>
                          <th>Lợi nhuận</th>
                        </tr>
                      </thead>
                      <tbody id="body_table">';
for ($i = 1; $i <= $ngay_trong_thang; $i++) {
    $loinhuan = $values_donhang_thang[$i - 1] - $values_khohang_thang[$i - 1];
    $html .= '<tr>
                <td>' . $i . '</td>
                <td>' . number_format($values_donhang_thang[$i - 1], 0, '', '.') . " VNĐ" . '</td>
                <td>' . number_format($values_khohang_thang[$i - 1], 0, '', '.') . " VNĐ" . '</td>
                <td>' . number_format($loinhuan, 0, '', '.') . " VNĐ" . '</td>
            </tr>';
}
$html .= '</tbody>
                    </table>';
echo $html;
