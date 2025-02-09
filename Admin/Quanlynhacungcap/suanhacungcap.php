<?php
session_start();
if (!isset($_SESSION['taikhoan'])) {
    header("location:login.php");
}
?>
<?php
// lấy id cần sửa
$id = $_GET['id'];
// kêt nối
require_once 'ketnoi.php';
// Câu lệnh lấy thông tin ncc có id = $id
$sql = "SELECT * FROM nhacungcap WHERE maNhaCungCap= $id";
// Thực thi câu lệnh
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // nhận dữ liệu từ form
    $tenncc = $_POST['tennhacungcap'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $sdt = $_POST['sodienthoai'];
    $ghichu = $_POST['ghichu'];
    // viết câu lệnh sql để sửa dữ liệu
    $sqlsua = "UPDATE nhacungcap SET tenNhacungcap= '$tenncc', diaChi= '$diachi',
        email= '$email', soDienThoai= '$sdt', ghiChu= '$ghichu' WHERE maNhaCungCap= $id";
    // thực thi câu lệnh
    $errors = [];
    if (empty(trim($_POST['tennhacungcap']))) {
        $errors['tennhacungcap'] = 'Tên nhà cung cấp không được để trống';
    } else {
        if (strlen(trim($_POST['tennhacungcap'])) < 5) {
            $errors['tennhacungcap'] = 'Tên nhà cung cấp phải lớn hơn 5 ký tự';
        } else {
            $tenncc = $_POST['tennhacungcap'];
        }
    }
    if (empty(trim($_POST['diachi']))) {
        $errors['diachi'] = 'Địa chỉ không được để trống';
    } else {
        $diachi = $_POST['diachi'];
    }
    /// kiểm tra email
    if (empty(trim($_POST['email']))) {
        $errors['email'] = 'Email không được để trống';
    } else {
        $email1 = test_input($_POST["email"]);
        if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        } else {
            $email = $_POST['email'];
        }
        // kiểm tra số điện thoại
    }
    if (empty(trim($_POST['sodienthoai']))) {
        $errors['sodienthoai'] = 'Số điện thoại không được để trống';
    } else {
        $sdt = $_POST['sodienthoai'];
        if (!preg_match("/^(0\d{9})$/", $sdt)) {
            $errors['sodienthoai'] = 'Số điện thoại không đúng định dạng';
        } else if (strlen(trim($_POST['sodienthoai'])) == 10) {   // kiểm tra trùng dt
            $sql1 = "SELECT * From nhacungcap WHERE soDienThoai='$sdt'";
            $result = mysqli_query($conn, $sql1);
            if (empty($result) && $result > 0) {
                $errors['sodienthoai'] = 'Số điện thoại đã tồn tại';
            } else {
                $sdt = $_POST['sodienthoai'];
            }
        } else {
            $errors['sodienthoai'] = 'Số điện thoại phải đủ 10 kí tự';
        }
    }
    if (empty($errors)) {
        mysqli_query($conn, $sqlsua);
        header('location: hienthi.php');
    } else {
        echo "Sửa thất bại";
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
    <link href="../assets/fonts/font-awesome-pro-v6-6.2.0/css/all.min.css" rel="stylesheet" type="text/css" />
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
            <h2>Sửa nhà cung cấp</h2>
            <form method="POST">
                <input type="hidden" name='id' value="<?php echo $row['maNhaCungCap'] ?>" id="">
                <div class="form-group">
                    <label for="tennhacungcap" class="btn">Tên nhà cung cấp</label>
                    <input type="text" name="tennhacungcap" class="form-control" name="tennhacungcap" value="<?php echo $row['tenNhaCungCap'] ?>">
                    <?php
                    if (!empty($errors)) {
                        if (!empty($errors['tennhacungcap'])) {
                            echo '<p class="alert-danger">' . $errors['tennhacungcap'] . '</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="diachi" class="btn">Địa chỉ</label>
                    <input type="text" name="diachi" class="form-control" name="diachi" value="<?php echo $row['diaChi'] ?>">
                    <?php
                    if (!empty($errors)) {
                        if (!empty($errors['diachi'])) {
                            echo '<p class="alert-danger">' . $errors['diachi'] . '</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email" class="btn">Email</label>
                    <input type="text" name="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                    <?php
                    if (!empty($errors)) {
                        if (!empty($errors['email'])) {
                            echo '<p class="alert-danger">' . $errors['email'] . '</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="sodienthoai" class="btn">Số điện thoại</label>
                    <input type="text" name="sodienthoai" class="form-control" name="sodienthoai" value="<?php echo $row['soDienThoai'] ?>">
                    <?php
                    if (!empty($errors)) {
                        if (!empty($errors['sodienthoai'])) {
                            echo '<p class="alert-danger">' . $errors['sodienthoai'] . '</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="ghichu" class="btn">Ghi chú</label>
                    <input type="text" name="ghichu" class="form-control" name="ghichu" value="<?php echo $row['ghiChu'] ?>">
                </div>

                <button name="submit" class="btn btn-success">Cập nhật thông tin</button>
            </form>
        </div>
    </div>
</body>

</html>