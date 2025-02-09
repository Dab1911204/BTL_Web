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
    $nam = $_POST['yearSelect_thang'];
    $thang = $_POST['monthSelect'];
    $sql_donhang_thang = "SELECT DAY(`thoiGianDat`) AS day, SUM(`tongGiaTri`) AS total_amount, MONTH(`thoiGianDat`) AS month 
        FROM donhang WHERE MONTH(`thoiGianDat`) = '$thang' AND YEAR(`thoiGianDat`) = '$nam' 
        GROUP BY DAY(`thoiGianDat`), MONTH(`thoiGianDat`) ORDER BY MONTH(`thoiGianDat`), DAY(`thoiGianDat`)";
    $result_donhang_thang = mysqli_query($conn, $sql_donhang_thang);
    $data_donhang_thang = [];
    while ($row_donhang_thang = mysqli_fetch_array($result_donhang_thang)) {
      $data_donhang_thang[] = $row_donhang_thang;
    };
    $thang_31_ngay = [1, 3, 5, 7, 8, 10, 12];
    $thang_30_ngay = [4, 6, 9, 11];
    if ($thang == 2) {
      if (($nam % 4 == 0 && $nam % 100 != 0) || $nam % 400 == 0) {
        $days_in_month_29 = range(1, 29);
        $labels_donhang_thang = $days_in_month_29;
        $values_donhang_thang = array_fill(0, 29, 0); // Khởi tạo tất cả các giá trị bằng 0
        foreach ($data_donhang_thang as $entry) {
          $day = $entry['day'];
          $total_amount = $entry['total_amount'];
          $month = $entry['month'];
          $values_donhang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
        }
      } else {
        $days_in_month_28 = range(1, 28);
        $labels_donhang_thang = $days_in_month_28;
        $values_donhang_thang = array_fill(0, 28, 0);
        foreach ($data_donhang_thang as $entry) {
          $day = $entry['day'];
          $total_amount = $entry['total_amount'];
          $month = $entry['month'];
          $values_donhang_thang[$day - 1] = $total_amount;
        }
      }
    } else if (in_array($thang, $thang_31_ngay)) {
      $days_in_month_31 = range(1, 31);
      $labels_donhang_thang = $days_in_month_31;
      $values_donhang_thang = array_fill(0, 31, 0); // Khởi tạo tất cả các giá trị bằng 0
      foreach ($data_donhang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_donhang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
      }
    } else if (in_array($thang, $thang_30_ngay)) {
      $days_in_month_30 = range(1, 30);
      $labels_donhang_thang = $days_in_month_30;
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
        $days_in_month_29 = range(1, 29);
        $labels_khohang_thang = $days_in_month_29;
        $values_khohang_thang = array_fill(0, 29, 0); // Khởi tạo tất cả các giá trị bằng 0
        foreach ($data_khohang_thang as $entry) {
          $day = $entry['day'];
          $total_amount = $entry['total_amount'];
          $month = $entry['month'];
          $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
        }
      } else {
        $days_in_month_28 = range(1, 28);
        $labels_khohang_thang = $days_in_month_28;
        $values_khohang_thang = array_fill(0, 28, 0);
        foreach ($data_khohang_thang as $entry) {
          $day = $entry['day'];
          $total_amount = $entry['total_amount'];
          $month = $entry['month'];
          $values_khohang_thang[$day - 1] = $total_amount;
        }
      }
    } else if (in_array($thang, $thang_31_ngay)) {
      $days_in_month_31 = range(1, 31);
      $labels_khohang_thang = $days_in_month_31;
      $values_khohang_thang = array_fill(0, 31, 0); // Khởi tạo tất cả các giá trị bằng 0
      foreach ($data_khohang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
      }
    } else if (in_array($thang, $thang_30_ngay)) {
      $days_in_month_30 = range(1, 30);
      $labels_khohang_thang = $days_in_month_30;
      $values_khohang_thang = array_fill(0, 30, 0); // Khởi tạo tất cả các giá trị bằng 0
      foreach ($data_khohang_thang as $entry) {
        $day = $entry['day'];
        $total_amount = $entry['total_amount'];
        $month = $entry['month'];
        $values_khohang_thang[$day - 1] = $total_amount; // Trừ 1 để chuyển đổi ngày thành chỉ số mảng
      }
    }
    ?>
    <div class="main-panel">
      <div class="container">
        <div id="chart_thang">
          <div class="header_chart">
            <h4 id=thongkethang>THỐNG KÊ THÁNG</h4>
          </div>
          <canvas style="width: 100%;" id="myChart_thang"></canvas>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script>
      const labels_thang = <?php echo json_encode($labels_donhang_thang) ?>;
      const dataThunhap_thang = <?php echo json_encode($values_donhang_thang) ?>;
      const dataKho_thang = <?php echo json_encode($values_khohang_thang) ?>;
      const data_thang = {
        labels: labels_thang,
        datasets: [{
            label: "Doanh Thu",
            data: dataThunhap_thang,
            fill: true,
            backgroundColor: "rgb(75, 192, 192,0.2)",
            borderColor: "rgb(75, 192, 192)",
            maxWidth: 1180,
            tension: 0.3
          },
          {
            label: "Chi phí nhập",
            data: dataKho_thang,
            fill: true,
            backgroundColor: "rgb(255, 120, 124,0.2)",
            borderColor: "rgb(255, 120, 124)",
            maxWidth: 1180,
            tension: 0.3
          }
        ]
      };
      const config_thang = {
        type: "line",
        data: data_thang,
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
      var myChart_thang = new Chart(document.getElementById("myChart_thang"), config_thang);
    </script>

</body>

</html>