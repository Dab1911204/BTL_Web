<?php
session_start();
if (!isset($_SESSION['taikhoan'])) {
  header("location:login.php");
}
?>
<?php
include "ketnoi.php"; // Kết nối database
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Xử lý và kiểm tra các trường nhập liệu
  if (empty(trim($_POST['tennhacungcap']))) {
    $errors['tennhacungcap'] = 'Tên nhà cung cấp không được để trống';
  } else {
    $tenncc = test_input($_POST['tennhacungcap']);
  }
  if (empty(trim($_POST['diachi']))) {
    $errors['diachi'] = 'Địa chỉ không được để trống';
  } else {
    $diachi = test_input($_POST['diachi']);
  }
  if (empty(trim($_POST['email']))) {
    $errors['email'] = 'Email không được để trống';
  } else {
    $email = test_input($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email không đúng định dạng";
    } else {
      // Kiểm tra trùng lặp email
      $sql_check_email = "SELECT * FROM nhacungcap WHERE email = ?";
      $stmt_check_email = mysqli_prepare($conn, $sql_check_email);
      mysqli_stmt_bind_param($stmt_check_email, "s", $email);
      mysqli_stmt_execute($stmt_check_email);
      mysqli_stmt_store_result($stmt_check_email);
      if (mysqli_stmt_num_rows($stmt_check_email) > 0) {
        $errors['email'] = 'Email đã tồn tại';
      }
      mysqli_stmt_close($stmt_check_email);
    }
  }
  if (empty(trim($_POST['sodienthoai']))) {
    $errors['sodienthoai'] = 'Số điện thoại không được để trống';
  } else {
    $sdt = test_input($_POST['sodienthoai']);
    if (!preg_match("/^(0\d{9})$/", $sdt)) {
      $errors['sodienthoai'] = 'Số điện thoại không đúng định dạng. Số điện thoại phải bắt đầu bằng số 0 và có tổng cộng 10 chữ số.';
    } else {
      // Kiểm tra trùng lặp số điện thoại
      $sql_check_sdt = "SELECT * FROM nhacungcap WHERE soDienThoai = ?";
      $stmt_check_sdt = mysqli_prepare($conn, $sql_check_sdt);
      mysqli_stmt_bind_param($stmt_check_sdt, "s", $sdt);
      mysqli_stmt_execute($stmt_check_sdt);
      mysqli_stmt_store_result($stmt_check_sdt);
      if (mysqli_stmt_num_rows($stmt_check_sdt) > 0) {
        $errors['sodienthoai'] = 'Số điện thoại đã tồn tại';
      }
      mysqli_stmt_close($stmt_check_sdt);
    }
  }
  // Ghi chú có thể để trống, không cần xử lý lỗi
  // Nếu không có lỗi, thêm dữ liệu vào cơ sở dữ liệu
  if (empty($errors)) {
    $ghichu = isset($_POST['ghichu']) ? test_input($_POST['ghichu']) : '';
    // Sử dụng prepared statement để thêm dữ liệu
    $sql_insert = "INSERT INTO nhacungcap (tenNhaCungCap, diaChi, email, soDienThoai, ghiChu) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "sssss", $tenncc, $diachi, $email, $sdt, $ghichu);
    if (mysqli_stmt_execute($stmt_insert)) {
      header("Location: hienthi.php"); // Chuyển hướng sau khi thêm thành công
      exit();
    } else {
      echo "Thêm dữ liệu không thành công";
    }
    mysqli_stmt_close($stmt_insert);
  }
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
  <link href="../assets/fonts/font-awesome-pro-v6-6.2.0/css/all.min.css" rel="stylesheet" type="text/css" />
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
        urls: ["../assets/css/fonts.min.css"],
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
            <li class="nav-item active">
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
      <h2>Thêm nhà cung cấp</h2>
      <form method="POST">
        <div class="form-group">
          <label for="tennhacungcap">Tên nhà cung cấp</label>
          <input type="text" name="tennhacungcap" class="form-control" value="<?php if (isset($tenncc)) echo $tenncc; ?>">
          <?php if (!empty($errors['tennhacungcap'])) echo '<p class="alert-danger">' . $errors['tennhacungcap'] . '</p>'; ?>
        </div>
        <div class="form-group">
          <label for="diachi">Địa chỉ</label>
          <input type="text" name="diachi" class="form-control" value="<?php if (isset($diachi)) echo $diachi; ?>">
          <?php if (!empty($errors['diachi'])) echo '<p class="alert-danger">' . $errors['diachi'] . '</p>'; ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control" value="<?php if (isset($email)) echo $email; ?>">
          <?php if (!empty($errors['email'])) echo '<p class="alert-danger">' . $errors['email'] . '</p>'; ?>
        </div>
        <div class="form-group">
          <label for="sodienthoai">Số điện thoại</label>
          <input type="text" name="sodienthoai" class="form-control" value="<?php if (isset($sdt)) echo $sdt; ?>">
          <?php if (!empty($errors['sodienthoai'])) echo '<p class="alert-danger">' . $errors['sodienthoai'] . '</p>'; ?>
        </div>
        <div class="form-group">
          <label for="ghichu">Ghi chú</label>
          <input type="text" name="ghichu" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
      </form>
    </div>
  </div>
</body>

</html>