<?php
session_start();

include 'connect.php';
if (!isset($_SESSION['taikhoan'])) {
  header("location:login.php");
}
$matintuc = $_GET['matintuc'];
echo $matintuc;
$sql = "SELECT * FROM tintuc WHERE maTintuc = $matintuc";
$query = mysqLi_query($conn, $sql);
$row = mysqLi_fetch_assoc($query);
if (isset($_POST['submit'])) {
  $tieude = $_POST['tieude'];
  $noidung = $_POST['noidung'];
  $date = date('Y-m-d H:i:s');
  if (isset($_POST['hinhanh'])) {
    $hinhanh = $_FILES['hinhanh']['name'];
  } else {
    $hinhanh = $_POST['hinhanhcu'];
  }

  $hinhanh_tmp_name = $_FILES['hinhanh']['tmp_name'];
  move_uploaded_file($hinhanh_tmp_name, '/XAMPP/htdocs/Demo/imgchung/' . $hinhanh);
  $sql = "UPDATE tintuc SET tieuDe = '$tieude', anhTinTuc = '$hinhanh', noiDung = '$noidung',ngayThang = '$date' WHERE maTintuc = $matintuc";
  mysqLi_query($conn, $sql);
  header("location: news.php");
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
  <script src="ckeditor/ckeditor.js"></script>
  <script src="ckeditor/ckfinder/ckfinder.js"></script>
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
            <li class="nav-item">
              <a href="/Demo/Admin/Quanlykhohang/Khohang.php">
                <i class="far fa-chart-bar"></i>
                <p>Quản lý Kho hàng</p>
              </a>
            </li>
            <li class="nav-item active">
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
      <h2>Sửa tin tức</h2>
      <form method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
          <label class="btn">Chọn hình ảnh</label>
          <input type="hidden" name="hinhanhcu" value="<?php echo $row['anhTinTuc']; ?>">
          <input type="file" name="hinhanh" class="form-control">

          <div class="edit_img">
            <span><img src="/Demo/imgchung/<?php echo $row['anhTinTuc']; ?> " style="height: 300px;"></span>
          </div>
        </div>
        <div class="form-group">
          <label class="btn">Tiêu đề</label>
          <input type="text" name="tieude" class="form-control" value="<?php echo $row['tieuDe']; ?>" required>
        </div>
        <div class="form-group">
          <label for="noidung" class="btn">Nội dung</label>
          <textarea name="noidung" class="form-control" required><?php echo $row['noiDung']; ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Sửa</button>
      </form>
    </div>

  </div>
</body>
<script>
  CKEDITOR.replace('noidung');
</script>

</html>