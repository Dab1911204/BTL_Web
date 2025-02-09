<?php
session_start();

include 'connect.php';
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
<div class="main-panel">
  <div class="container">
    <?php
    include_once "connect.php";
    $sql_nguoi_dung = "SELECT * FROM khachhang";
    $sql_kho_hang = "SELECT * FROM khohang";
    $sql_thu_nhap = "SELECT sum(tongGiaTri) as thuNhap FROM donhang WHERE tinhTrang = 'Đã giao'";
    $sql_bill = "SELECT * FROM donhang WHERE tinhTrang = 'Đã giao'";
    $result_nguoi_dung = mysqli_query($conn, $sql_nguoi_dung);
    $result_kho_hang = mysqli_query($conn, $sql_kho_hang);
    $result_thu_nhap = mysqli_query($conn, $sql_thu_nhap);
    $result_bill = mysqli_query($conn, $sql_bill);
    $soLuongNguoiDung = mysqLi_num_rows($result_nguoi_dung);
    $sanPhamTrongKho = mysqli_num_rows($result_kho_hang);
    $tongThuNhap = mysqli_fetch_assoc($result_thu_nhap)['thuNhap'];
    $soLuongDonHang = mysqLi_num_rows($result_bill);
    $sql_kho_hang_moi = "SELECT * FROM khohang WHERE tinhTrang = 'Hàng mới'";
    $result_kho_hang_moi = mysqli_query($conn, $sql_kho_hang_moi);
    $soLuongKhoHangMoi = mysqli_num_rows($result_kho_hang_moi);
    $sql_kho_hang_ton = "SELECT * FROM khohang WHERE tinhTrang = 'Hàng cũ'";
    $result_kho_hang_ton = mysqli_query($conn, $sql_kho_hang_ton);
    $soLuongKhoHangTon = mysqli_num_rows($result_kho_hang_ton);
    $sql_kho_hang_hong = "SELECT * FROM khohang WHERE tinhTrang = 'Hỏng'";
    $result_kho_hang_hong = mysqli_query($conn, $sql_kho_hang_hong);
    $soLuongKhoHangHong = mysqli_num_rows($result_kho_hang_hong);
    ?>
    <div class="page-inner">
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <a class="col-icon" style="cursor: pointer;" href="/Demo/Admin/Quanlykhachhang/hienthi.php">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <i class="fas fa-users"></i>
                  </div>
                </a>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Người Dùng</p>
                    <h4 class="card-title"><?php echo $soLuongNguoiDung; ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <a class="col-icon" style="cursor: pointer;" href="/Demo/Admin/Quanlykhohang/Khohang.php">
                  <div class="icon-big text-center icon-info bubble-shadow-small">
                    <i class="fa-solid fa-box-archive"></i>
                  </div>
                </a>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Kho </p>
                    <h4 class="card-title"><?php echo $sanPhamTrongKho ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-success bubble-shadow-small">
                    <i class="fas fa-luggage-cart"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Doanh Thu</p>
                    <h4 class="card-title"><?= number_format($tongThuNhap, 0, '', '.') . " VNĐ" ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <a class="col-icon" style="cursor: pointer;" href="/Demo/Admin/Quanlydonhang/donhoanthanh.php">
                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                    <i class="fa-solid fa-receipt"></i>
                  </div>
                </a>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Hóa Đơn</p>
                    <h4 class="card-title"><?php echo $soLuongDonHang ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-inner">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-round">
            <div class="mt-2 option-thongKe">
              <div>
                <div class="thoiGianThongKe" id="thoiGianThongKe-nam" style="display: none;">
                  <form action="/Demo/Admin/chucnangthongke/Chart_nam.php" method="post" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                    <div class="year" id="year-thongke-nam">
                      Năm:<select name="yearSelect_nam" id="yearSelect_nam">
                        <script>
                          const currentYear_nam = new Date().getFullYear();
                          document.write('<option value="' + currentYear_nam + '">' + currentYear_nam + '</option>');
                          for (let i = currentYear_nam; i >= 1900; i--) {
                            if (i == currentYear_nam) {
                              continue;
                            } else {
                              document.write('<option value="' + i + '">' + i + '</option>');
                            }
                          }
                        </script>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-outline-success ms-5">Xem biểu đồ</button>
                  </form>
                </div>
                <div class="thoiGianThongKe" id="thoiGianThongKe-thang" style="flex-direction: row;">
                  <form action="/Demo/Admin/chucnangthongke/Chart_thang.php" method="post" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                    <div class="year" id="year-thongke-thang">
                      Năm:<select name="yearSelect_thang" id="yearSelect_thang">
                        <script>
                          const currentYear = new Date().getFullYear();
                          document.write('<option value="' + currentYear + '">' + currentYear + '</option>');
                          for (let i = currentYear; i >= 1900; i--) {
                            if (i == currentYear) {
                              continue;
                            } else {
                              document.write('<option value="' + i + '">' + i + '</option>');
                            }
                          }
                        </script>
                      </select>
                    </div>
                    <div class="month" id="month-thongke">
                      Tháng:<select name="monthSelect" id="monthSelect">
                        <script>
                          const currentMonth = new Date().getMonth() + 1;
                          document.write('<option value="' + currentMonth + '">' + currentMonth + '</option>');
                          for (let i = 1; i <= 12; i++) {
                            document.write('<option value="' + i + '">' + i + '</option>');
                          }
                        </script>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-outline-success ms-5">Xem biểu đồ</button>
                  </form>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-outline-primary" id="btn-thongke-thang" style="display:none;">Thống kê tháng</button>
                <button type="button" class="btn btn-outline-info" id="btn-thongke-nam">Thống kê năm</button>
              </div>
            </div>
            <hr>
            <div id="bangThongKe">
              <div id="thongKe_nam" style="display: none;">
              </div>
              <div id="thongKe_thang">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-primary card-round " style="background-color: #b64acf !important;">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Đơn chưa hoàn thành</div>
                <div class="card-tools">
                  <i class="fa-solid fa-rotate" style="font-size: 30px;"></i>
                </div>
              </div>
              <div class="card-category">
                <div class="card-tools" style="display: flex; flex-direction: row;">
                  <h5>Ngày:</h5>
                  <input type="date" name="" id="dayDonChuaHoanThanh" class="inputdate">
                  <script>
                    const ngayDonChuaHoanThanh = document.getElementById('dayDonChuaHoanThanh');
                    const todayDonChuaHoanThanh = new Date();
                    const formattedDateDonChuaHoanThanh = todayDonChuaHoanThanh.toISOString().split('T')[0];
                    ngayDonChuaHoanThanh.value = formattedDateDonChuaHoanThanh;
                  </script>
                </div>
              </div>
            </div>
            <div class="card-body pb-0">
              <div class="mb-4 mt-2">
                <h1 id="donChuaHoanThanh"></h1>
              </div>
            </div>
          </div>
          <div class="card card-primary card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Lợi nhuận</div>
                <div class="card-tools">
                  <i class="fa-solid fa-dollar-sign" style="font-size: 30px;"></i>
                </div>
              </div>
              <div class="card-category">
                <div class="card-tools" style="display: flex; flex-direction: row;">
                  <h5>Ngày:</h5>
                  <input type="date" name="" id="dayThongKe" class="inputdate">
                  <script>
                    const ngayThongKe = document.getElementById('dayThongKe');
                    const todayThongKe = new Date();
                    const formattedDateThongKe = todayThongKe.toISOString().split('T')[0];
                    ngayThongKe.value = formattedDateThongKe;
                  </script>
                </div>
              </div>
            </div>
            <div class="card-body pb-0">
              <div class="mb-4 mt-2">
                <div id="thongKeLoiNhuan"></div>
              </div>
            </div>
          </div>
          <div class="card card-primary card-round bg-success">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Kho hàng</div>
                <div class="card-tools">
                  <i class="fa-solid fa-box-archive" style="font-size: 30px;"></i>
                </div>
              </div>
              <div class="card-category">
                <div class="card-tools" style="display: flex; flex-direction: row;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Hàng mới</th>
                        <th>Hàng tồn</th>
                        <th>Hàng hỏng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <div>
                        <td><?php echo $soLuongKhoHangMoi ?></td>
                        <td><?php echo $soLuongKhoHangTon ?></td>
                        <td><?php echo $soLuongKhoHangHong ?></td>
                      </div>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-body pb-0">
              <div class="mb-4 mt-2">
                <div id="thongKeLoiNhuan"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/Demo/Admin/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="/Demo/Admin/assets/js/core/popper.min.js"></script>
<script src="/Demo/Admin/assets/js/core/bootstrap.min.js"></script>
<script>
  //button thông kê năm
  document.getElementById('btn-thongke-nam').addEventListener('click', function() {
    document.getElementById('btn-thongke-thang').style.display = 'block';
    document.getElementById('btn-thongke-nam').style.display = 'none';
    document.getElementById('thongKe_nam').style.display = 'block';
    document.getElementById('thongKe_thang').style.display = 'none';
    document.getElementById('thoiGianThongKe-thang').style.display = 'none';
    document.getElementById('thoiGianThongKe-nam').style.display = 'block';
  });
  //button thông kê tháng
  document.getElementById('btn-thongke-thang').addEventListener('click', function() {
    document.getElementById('btn-thongke-nam').style.display = 'block';
    document.getElementById('btn-thongke-thang').style.display = 'none';
    document.getElementById('thongKe_thang').style.display = 'block';
    document.getElementById('thongKe_nam').style.display = 'none';
    document.getElementById('thoiGianThongKe-thang').style.display = 'flex';
    document.getElementById('thoiGianThongKe-nam').style.display = 'none';
  });


  //thống kê năm
  document.getElementById('yearSelect_nam').addEventListener('change', DataYear_donhang);
  document.addEventListener('DOMContentLoaded', DataYear_donhang_load);

  function DataYear_donhang_load() {
    var year = document.getElementById('yearSelect_nam').value;
    var form_data = new FormData();
    form_data.append('year', year);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKe_bang-nam.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('thongKe_nam').innerHTML = xhr.responseText;
    }
  }

  function DataYear_donhang() {
    var year = document.getElementById('yearSelect_nam').value;
    var form_data = new FormData();
    form_data.append('year', year);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKe_bang-nam.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('thongKe_nam').innerHTML = xhr.responseText;
      document.getElementById('btn-thongke-thang').style.display = 'block';
      document.getElementById('btn-thongke-nam').style.display = 'none';
      document.getElementById('thongKe_nam').style.display = 'block';
      document.getElementById('thongKe_thang').style.display = 'none';
      document.getElementById('thoiGianThongKe-thang').style.display = 'none';
      document.getElementById('thoiGianThongKe-nam').style.display = 'block';
    }
  }

  //thống kê tháng
  document.getElementById('yearSelect_thang').addEventListener('change', DataMonth_donhang);
  document.getElementById('monthSelect').addEventListener('change', DataMonth_donhang);
  document.addEventListener('DOMContentLoaded', DataMonth_donhangload);

  function DataMonth_donhangload() {
    var year = document.getElementById('yearSelect_thang').value;
    var month = document.getElementById('monthSelect').value;
    var form_data = new FormData();
    form_data.append('year', year);
    form_data.append('month', month);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKe_bang-thang.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('thongKe_thang').innerHTML = xhr.responseText;
    }
  }

  function DataMonth_donhang() {
    var year = document.getElementById('yearSelect_thang').value;
    var month = document.getElementById('monthSelect').value;
    var form_data = new FormData();
    form_data.append('year', year);
    form_data.append('month', month);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKe_bang-thang.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('thongKe_thang').innerHTML = xhr.responseText;
      document.getElementById('btn-thongke-nam').style.display = 'block';
      document.getElementById('btn-thongke-thang').style.display = 'none';
      document.getElementById('thongKe_thang').style.display = 'block';
      document.getElementById('thongKe_nam').style.display = 'none';
      document.getElementById('thoiGianThongKe-thang').style.display = 'flex';
      document.getElementById('thoiGianThongKe-nam').style.display = 'none';
    }
  }

  document.getElementById('dayThongKe').addEventListener('input', thongKeLoiNhuan);
  document.addEventListener('DOMContentLoaded', thongKeLoiNhuan);

  function thongKeLoiNhuan() {
    var day = document.getElementById('dayThongKe').value;
    var form_data = new FormData();
    form_data.append('day', day);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKeLoiNhuan.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('thongKeLoiNhuan').innerHTML = xhr.responseText;
    }
  }
  //Đơn chưa hoàn thành
  document.getElementById('dayDonChuaHoanThanh').addEventListener('input', thongKeDonChuaHoanThanh);
  document.addEventListener('DOMContentLoaded', thongKeDonChuaHoanThanh);

  function thongKeDonChuaHoanThanh() {
    var day = document.getElementById('dayDonChuaHoanThanh').value;
    var form_data = new FormData();
    form_data.append('day', day);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/thongKeDonChuaHoanThanh.php');
    xhr.send(form_data);
    xhr.onreadystatechange = function() {
      document.getElementById('donChuaHoanThanh').innerHTML = xhr.responseText;
    }
  }
  document.addEventListener('DOMContentLoaded', capNhatKhoHang);

  function capNhatKhoHang() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/dohong.php');
    xhr.send();
    xhr.onreadystatechange = function() {
      console.log(xhr.responseText);
    }
  }
  document.addEventListener('DOMContentLoaded', capNhatSoLuongSanPham);

  function capNhatSoLuongSanPham() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Demo/Admin/chucnangthongke/updateSLSP.php');
    xhr.send();
    xhr.onreadystatechange = function() {
      console.log(xhr.responseText);
    }
  }
  
</script>
</body>

</html>