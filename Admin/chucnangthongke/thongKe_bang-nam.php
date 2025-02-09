<?php
include 'connect.php';
$nam = $_POST['year'];
$sql_donhang = "WITH months AS (
                            SELECT 1 AS month UNION ALL
                            SELECT 2 UNION ALL
                            SELECT 3 UNION ALL
                            SELECT 4 UNION ALL
                            SELECT 5 UNION ALL
                            SELECT 6 UNION ALL
                            SELECT 7 UNION ALL
                            SELECT 8 UNION ALL
                            SELECT 9 UNION ALL
                            SELECT 10 UNION ALL
                            SELECT 11 UNION ALL
                            SELECT 12
                        )
                        SELECT m.month, COALESCE(SUM(dg.`tongGiaTri`), 0) AS total_amount
                        FROM months m
                        LEFT JOIN donhang dg
                        ON m.month = MONTH(dg.`thoiGianDat`) AND YEAR(dg.`thoiGianDat`) = '$nam' AND dg.`tinhTrang` = 'Đã giao'
                        GROUP BY m.month
                        ORDER BY m.month;";
$result_donhang = mysqli_query($conn, $sql_donhang);
while ($row_donhang = mysqli_fetch_array($result_donhang)) {
    $data_donhang[] = $row_donhang['total_amount'];
};
$sql_khohang = "WITH months AS (
                          SELECT 1 AS month UNION ALL
                          SELECT 2 UNION ALL
                          SELECT 3 UNION ALL
                          SELECT 4 UNION ALL
                          SELECT 5 UNION ALL
                          SELECT 6 UNION ALL
                          SELECT 7 UNION ALL
                          SELECT 8 UNION ALL
                          SELECT 9 UNION ALL
                          SELECT 10 UNION ALL
                          SELECT 11 UNION ALL
                          SELECT 12
                      )
                      SELECT m.month, COALESCE(SUM(kh.`tongTienNhap`), 0) AS total_amount
                      FROM months m
                      LEFT JOIN khohang kh
                      ON m.month = MONTH(kh.`ngayNhap`) AND YEAR(kh.`ngayNhap`) = '$nam'
                      GROUP BY m.month
                      ORDER BY m.month;";
$result_khohang = mysqli_query($conn, $sql_khohang);
while ($row_khohang = mysqli_fetch_array($result_khohang)) {
    $data_khohang[] = $row_khohang['total_amount'];
}
$html = '
                    <div class="header_chart">
                      <h4 id="thongkenam">THỐNG KÊ NĂM</h4>
                    </div>
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th>Tháng</th>
                          <th>Doanh Thu</th>
                          <th>Chi phí nhập hàng</th>
                          <th>Lợi nhuận</th>
                        </tr>
                      </thead>
                      <tbody id="body_table">';
for ($i = 1; $i <= 12; $i++) {
    $loinhuan = $data_donhang[$i - 1] - $data_khohang[$i - 1];
    $html .= '<tr>
                <td>' . $i . '</td>
                <td>' . number_format($data_donhang[$i - 1], 0, '', '.') . " VNĐ" . '</td>
                <td>' . number_format($data_khohang[$i - 1], 0, '', '.') . " VNĐ" . '</td>
                <td>' . number_format($loinhuan, 0, '', '.') . " VNĐ" . '</td>
            </tr>';
}
$html .= '</tbody>
                    </table>';
echo $html;
