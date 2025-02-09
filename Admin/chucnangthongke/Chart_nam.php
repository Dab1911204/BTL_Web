<?php
session_start();
if (!isset($_SESSION['taikhoan'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/Demo/Admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <link rel="icon" href="/Demo/Admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="stylesheet" href="/Demo/Admin/assets1/main.css">

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="/Demo/Admin/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/Demo/Admin/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="/Demo/Admin/assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="/Demo/Admin/assets/css/demo.css" />
  <title>Document</title>
</head>

<body>

  <div class="wrapper">
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="/Demo/Admin/trangchu.php" class="logo">
            <img src="/Demo/Admin/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20">
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="scroll-wrapper sidebar-wrapper scrollbar scrollbar-inner" style="position: relative;">
        <div class="sidebar-wrapper scrollbar scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 427px;">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a href="/Demo/Admin/trangchu.php" class="collapsed" aria-expanded="false">
                  <i class="fas fa-home"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <!-- <h4 class="text-section">Components</h4> -->
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlydanhmuc/hienthi.php">
                  <i class="fas fa-layer-group"></i>
                  <p>Quản lý danh mục</p>
                </a>

              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlysanpham/hienthi.php">
                  <i class="fas fa-th-list"></i>
                  <p>Quản lý sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlydonhang/hienthi.php">
                  <i class="fas fa-pen-square"></i>
                  <p>Quản lý đơn hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlynhacungcap/hienthi.php">
                  <i class="fas fa-table"></i>
                  <p>Quản lý nhà cung cấp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlykhachhang/hienthi.php">
                  <i class="fas fa-table"></i>
                  <p>Quản lý khách hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlykhohang/Khohang.php">
                  <i class="far fa-chart-bar"></i>
                  <p>Quản lý Kho hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/Quanlytintuc/news.php">
                  <i class="fa-regular fa-envelope"></i>
                  <p>Quản lý tin tức</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Demo/Admin/logout.php">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <p>Đăng xuất</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="scroll-element scroll-x scroll-scrolly_visible">
          <div class="scroll-element_outer">
            <div class="scroll-element_size"></div>
            <div class="scroll-element_track"></div>
            <div class="scroll-bar" style="width: 0px;"></div>
          </div>
        </div>
        <div class="scroll-element scroll-y scroll-scrolly_visible">
          <div class="scroll-element_outer">
            <div class="scroll-element_size"></div>
            <div class="scroll-element_track"></div>
            <div class="scroll-bar" style="height: 318px; top: 0px;"></div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include "connect.php";
    $nam = $_POST['yearSelect_nam'];
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
    ?>
    <div class="main-panel">
      <div class="container">
        <div id="chart_nam">
          <div class="header_chart">
            <h4 id="thongkenam">THỐNG KÊ NĂM</h4>
          </div>
          <canvas style="width: 100%;" id="myChart_nam"></canvas>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script>
      const labels_nam = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
      const dataThunhap_nam = <?php echo json_encode($data_donhang) ?>;
      const dataKho_nam = <?php echo json_encode($data_khohang) ?>;

      const data_nam = {
        labels: labels_nam,
        datasets: [{
            label: "Doanh Thu",
            data: dataThunhap_nam,
            fill: true,
            backgroundColor: "rgb(75, 192, 192,0.2)",
            borderColor: "rgb(75, 192, 192)",
            maxWidth: 1180,
            tension: 0.3
          },
          {
            label: "Chi phí nhập",
            data: dataKho_nam,
            fill: true,
            backgroundColor: "rgb(255, 120, 124,0.2)",
            borderColor: "rgb(255, 120, 124)",
            maxWidth: 1180,
            tension: 0.3
          }
        ]
      };
      const config_nam = {
        type: "line",
        data: data_nam,
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value, index, values) {
                  return value.toLocaleString("vi-VN") + " VNĐ";
                }
              }
            }
          }
        }
      };
      var myChart_nam = new Chart(document.getElementById("myChart_nam"), config_nam);
    </script>

</body>

</html>