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
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- Fonts and icons -->
  <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../assets/css/demo.css" />
</head>

<body>
  <?php
  include "connect.php";
  $maLoai = $_GET['id'];
  $sql = "SELECT * FROM khohang WHERE maLoai = $maLoai";
  $query = mysqLi_query($conn, $sql);
  $row = mysqLi_fetch_assoc($query);
  if (isset($_POST['submit'])) {
    $maSanPham = $_POST['sanpham'];
    $checkError = false;
    $sql1 = "SELECT * FROM sanpham WHERE maSanPham = $maSanPham";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $tensanpham = $row1['tenSanPham'];
    $maNhaCungCap = $row1['maNhaCungCap'];
    $soluong = $_POST['soluong'];
    $ngaynhap = $_POST['ngaynhap'];
    $ngayhethan = $_POST['ngayhethan'];
    $gianhap = $_POST['gianhap'];
    $tonggianhap = $soluong * $gianhap;
    $tinhtrang = $row['tinhTrang'];
    if ($soluong <= 0) {
      echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
      $checkError = true;
    }
    if ($gianhap <= 0) {
      echo "<script>alert('Giá nhập phải lớn hơn 0')</script>";
      $checkError = true;
    }
    if ($ngaynhap > $ngayhethan) {
      echo "<script>alert('Ngày nhập phải nhỏ hơn ngày hết hạn')</script>";
      $checkError = true;
    }
    
    if (!$checkError) {
      $sql = "UPDATE khohang SET maSanPham = '$maSanPham', tenSanPham = '$tensanpham', maNhaCungCap = '$maNhaCungCap' ,soLuong = '$soluong', ngayNhap = '$ngaynhap', hanSuDung = '$ngayhethan', tongTienNhap = '$tonggianhap',giaNhap = '$gianhap',tinhTrang = '$tinhtrang' WHERE maLoai = $maLoai";
    $sql_select_sp = "SELECT * FROM sanpham WHERE maSanPham = $maSanPham";
    $result_select_sp = mysqli_query($conn, $sql_select_sp);
    $row_select_sp = mysqli_fetch_assoc($result_select_sp);
    $soluongcu = $row_select_sp['soLuong'] - $row['soLuong'];
    $soluongmoi = $soluongcu + $soluong;
    $sql_update = "UPDATE sanpham SET soLuong = '$soluongmoi' WHERE maSanPham = $maSanPham";
    mysqli_query($conn, $sql_update);
    mysqLi_query($conn, $sql);
    header("location: khohang.php");
    }
    
  }
  ?>
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
            <li class="nav-item">
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
            <li class="nav-item active">
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
      <h2>Thêm sản phẩm vào kho</h2>
      <form method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
          <label class="btn">Tên Sản phẩm</label>
          <select name="sanpham" id="" class="form-control" readonly>
            <?php
            $sql_nhacungcap = "SELECT * FROM nhacungcap WHERE maNhaCungCap = " . $row['maNhaCungCap'];
            $result_nhacungcap = mysqli_query($conn, $sql_nhacungcap);
            $row_nhacungcap = mysqli_fetch_assoc($result_nhacungcap);
            ?>
            <option value="<?php echo $row['maSanPham'] ?>"><?php echo $row['tenSanPham'] . " - " . $row_nhacungcap['tenNhaCungCap'] ?></option>
          </select>
          <br>
        </div>
        <div class="form-group">
          <label for="" class="btn">Số lượng</label>
          <input type="number" name="soluong" class="form-control" value="<?php echo $row['soLuong']; ?>" required>
        </div>

        <div class="form-group">
          <label for="" class="btn">Ngày nhập</label>
          <input type="date" name="ngaynhap" class="form-control" value="<?php echo $row['ngayNhap']; ?>" readonly>
        </div>

        <div class="form-group">
          <label for="" class="btn">Ngày hết hạng</label>
          <input type="date" name="ngayhethan" class="form-control" value="<?php echo $row['hanSuDung']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="" class="btn">Giá nhập</label>
          <input type="number" name="gianhap" class="form-control" value="<?php echo $row['giaNhap']; ?>" required>
        </div>
        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-success">Sửa</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>