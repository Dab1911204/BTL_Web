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
  <link href="../assets/fonts/font-awesome-pro-v6-6.2.0/css/all.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="../assets/css/kaiadmin.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <?php
  include 'ketnoi.php';
  if (isset($_POST['them'])) {
    // Khởi tạo một mảng để lưu trữ thông báo lỗi

    $errors = [];

    // nhận dữ liệu từ form
    $tensp = $_POST['tenSanPham'];
    $mancc = $_POST['nhacungcap'];
    $madm = $_POST['danhMuc'];
    $dg = $_POST['donGia'];
    $mtsp = $_POST['moTaSanPham'];
    $hinhanh_name = $_FILES['hinhanh']['name'];
    $hinhanh_tmp_name = $_FILES['hinhanh']['tmp_name'];

    // Xác thực đầu vào
    if (!is_numeric($dg) || $dg <= 0) {
      $errors[] = "Đơn giá phải là một số dương.";
    }
    // Kiểm tra xem hình ảnh đã được tải lên thành công chưa
    if (!move_uploaded_file($hinhanh_tmp_name, '/XAMPP/htdocs/Demo/imgchung/' . $hinhanh_name)) {
      $errors[] = "Lỗi khi tải lên ảnh sản phẩm.";
    }
    // Nếu không có lỗi thì tiến hành chèn cơ sở dữ liệu
    if (empty($errors)) {
      // viết lệnh sql để thêm dữ liệu
      $sql = "INSERT INTO sanpham (tenSanPham, maNhaCungCap, maDanhMuc, donGia, tinhTrang, moTaSanPham, anhSanPham) 
                VALUES ('$tensp', '$mancc', '$madm', '$dg', 'Hết hàng ', '$mtsp', '$hinhanh_name')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        header("Location: hienthi.php");
      } else {
        echo "Thêm thất bại: " . mysqli_error($conn);
      }
    } else {
      // Lỗi hiển thị
      foreach ($errors as $error) {
        echo "<script>alert('".$error."')</script>";
      }
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
            <li class="nav-item active">
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
      <h2>Thêm sản phẩm</h2>
      <form action="themsanpham.php" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
          <label for="tenSanPham" class="btn">Tên sản phẩm</label>
          <input type="text" id="tenSanPham" class="form-control" name="tenSanPham" required>
        </div>
        <div class="form-group">
          <label for="" class="btn">Nhà cung cấp</label>
          <select name="nhacungcap" class="form-control">
            <?php
            $sql = "SELECT * FROM nhacungcap";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) { ?>
              <option value="<?php echo $row['maNhaCungCap']; ?>"><?php echo $row['tenNhaCungCap']; ?></option>
            <?php
            }
            ?>
          </select>


        </div>
        <div class="form-group">
          <label for="" class="btn">Danh mục</label>
          <select name="danhMuc" class="form-control">
            <?php
            $sql = "SELECT * FROM danhmuc";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) { ?>
              <option value="<?php echo $row['maDanhMuc']; ?>"><?php echo $row['tenDanhMuc']; ?></option>
            <?php
            }
            ?>
          </select>


        </div>
        <div class="form-group">
          <label for="donGia" class="btn">Đơn giá</label>
          <input type="number" id="donGia" class="form-control" name="donGia" required>
        </div>
        <div class="form-group">
          <label for="moTaSanPham" class="btn">Mô tả sản phẩm</label>
          <input type="text" id="moTaSanPham" class="form-control" name="moTaSanPham" required>
        </div>
        <div class="form-group">
          <label for="hinhanh" class="btn">Ảnh sản phẩm</label>
          <input type="file" class="form-control" name="hinhanh" required>
        </div>
        <!-- Add any other form fields you need here -->
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary" name="them">Thêm</button>
      </form>
    </div>
  </div>
  <form action="themsanpham.php" method="POST" role="form" enctype="multipart/form-data" onsubmit="return validateForm()">
    <!-- form fields -->
  </form>

  <script>
    function validateForm() {
      let donGia = document.getElementById("donGia").value;
      if (isNaN(donGia) || donGia <= 0) {
        alert("Đơn giá phải là một số dương.");
        return false;
      }
      return true;
    }
  </script>

</body>

</html>