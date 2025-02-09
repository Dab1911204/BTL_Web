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
  include 'connect.php';

  if (isset($_POST['submit'])) {
    $maSanPham = $_POST['sanpham'];
    $checkError = false;
    // Lấy thông tin sản phẩm từ bảng sanpham
    $sql1 = "SELECT * FROM sanpham WHERE maSanPham = $maSanPham";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $tensanpham = $row1['tenSanPham'];
    $maNhaCungCap = $row1['maNhaCungCap'];

    // Lấy thông tin từ form
    $soluong = $_POST['soluong'];
    $ngaynhap = $_POST['ngaynhap'];
    $ngayhethan = $_POST['ngayhethan'];
    $gianhap = $_POST['gianhap'];
    $tongTienNhap = $gianhap * $soluong;
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
      // Chuyển đổi ngày nhập từ form về định dạng 'Y-m-d'
    $ngaynhap_format = date('Y-m-d', strtotime($ngaynhap));

    // Chuẩn bị câu lệnh SQL để thêm sản phẩm vào kho
    $sql = "INSERT INTO khohang (maSanPham, tenSanPham, maNhaCungCap, soLuong, ngayNhap, hanSuDung,tongTienNhap, giaNhap) 
            VALUES ('$maSanPham', '$tensanpham', '$maNhaCungCap', '$soluong', '$ngaynhap_format', '$ngayhethan','$tongTienNhap', '$gianhap')";

    // Kiểm tra xem sản phẩm đã tồn tại trong kho hay chưa
    $sql_check_kho = "SELECT * FROM khohang WHERE maSanPham = $maSanPham";
    $result_check_kho = mysqli_query($conn, $sql_check_kho);

    if (mysqli_num_rows($result_check_kho) > 0) {
      $row_check_kho = mysqli_fetch_assoc($result_check_kho);
      // Chuyển đổi ngày trong cơ sở dữ liệu về định dạng 'Y-m-d'
      $db_date = date('Y-m-d', strtotime($row_check_kho['ngayNhap']));

      $sql_check_ngay = "SELECT * FROM khohang WHERE ngayNhap = '$ngaynhap_format'";
      $result_check_ngay = mysqli_query($conn, $sql_check_ngay);
      if (mysqli_num_rows($result_check_ngay) > 0) {
        $soLuongMoi = $soluong + $row1['soLuong'];
        $sql_update = "UPDATE sanpham SET soLuong = '$soLuongMoi' WHERE maSanPham = '$maSanPham'";
        mysqli_query($conn, $sql_update);
        mysqli_query($conn, $sql);
      } else {
        $sql_update_kho = "UPDATE khohang SET tinhTrang = 'Hàng cũ' WHERE maSanPham = '$maSanPham' AND tinhTrang = 'Hàng mới'";
        mysqli_query($conn, $sql_update_kho);
        $soLuongMoi = $soluong + $row1['soLuong'];
        $sql_update = "UPDATE sanpham SET soLuong = '$soLuongMoi' WHERE maSanPham = '$maSanPham'";
        mysqli_query($conn, $sql_update);
        mysqli_query($conn, $sql);
      }
    } else {
      mysqli_query($conn, $sql);
      $sql_update = "UPDATE sanpham SET soLuong = '$soluong' WHERE maSanPham = '$maSanPham'";
      mysqli_query($conn, $sql_update);
    }
    header('location:khohang.php');
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
      <form action="Themkho.php" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
          <label class="btn">Tên Sản phẩm</label>
          <select name="sanpham" id="" class="form-control" required>
            <?php
            $sql = "SELECT sp.maSanPham, sp.tenSanPham, sp.maNhaCungCap,ncc.tenNhaCungCap FROM sanpham as sp inner join nhacungcap as ncc on sp.maNhaCungCap = ncc.maNhaCungCap";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) { ?>
              <option value="<?php echo $row['maSanPham']; ?>"><?php echo $row['tenSanPham'] . "  -  " . $row['tenNhaCungCap'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="" class="btn">Số lượng</label>
          <input type="number" name="soluong" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="" class="btn">Ngày nhập</label>
          <input type="date" name="ngaynhap" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="" class="btn">Ngày hết hạn</label>
          <input type="date" name="ngayhethan" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="" class="btn">Giá nhập</label>
          <input type="number" name="gianhap" class="form-control" required>
        </div>

        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-success">Thêm</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>