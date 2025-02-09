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
    // lấy id cần sửa
    $id = $_GET['id'];

    // kêt nối
    require_once 'ketnoi.php';

    // Câu lệnh lấy thông tin ncc có id = $id
    $sql = "SELECT * FROM sanpham WHERE maSanPham= $id";

    // Thực thi câu lệnh

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {
        // nhận dữ liệu từ form
        $checkError = false;
        $tensp = $_POST['tenSanPham'];
        $mancc = $_POST['nhacungcap'];
        $madm = $_POST['maDanhMuc'];
        $dg = $_POST['donGia'];
        $mtsp = $_POST['moTaSanPham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp_name = $_FILES['hinhanh']['tmp_name'];
        move_uploaded_file($hinhanh_tmp_name, '/XAMPP/htdocs/Demo/imgchung/' . $hinhanh);
        if ($dg <= 0) {
            echo "<script>alert('Đơn giá phải lớn hơn 0')</script>";
            $checkError = true;
        }
        if ($checkError) {
            exit;
        }
        // viết câu lệnh sql để sửa dữ liệu
        $sqlsua = "UPDATE sanpham SET tenSanPham= '$tensp',maNhaCungCap= '$mancc',
        maDanhMuc= '$madm', donGia= '$dg', moTaSanPham = '$mtsp', anhSanPham = '$hinhanh'   WHERE maSanPham = $id";
        $khohang = "update khohang set maNhaCungCap =  $mancc where maSanPham = $id";
        // thực thi câu lệnh
        if (mysqli_query($conn, $sqlsua)) {
            header('location: hienthi.php');
        } else {
            echo "<script> ('Sửa thất bại') </script>";
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

            <h2>Sửa sản phẩm</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name='id' value="<?php echo $row['maSanPham'] ?>" id="">
                <div class="form-group">
                    <label for="tenSanPham" class="btn">Tên sản phẩm</label>
                    <input type="text" name="tenSanPham" class="form-control" name="tenSanPham" value="<?php echo $row['tenSanPham'] ?>">
                </div>
                <div class="form-group">
                    <label for="" class="btn">Nhà cung cấp</label>
                    <select name="nhacungcap" id="" class="form-control">
                        <option value="<?php echo $row['maNhaCungCap'] ?>">
                            <?php
                            $sql_ncc = "SELECT * FROM nhacungcap where maNhaCungCap =" . $row['maNhaCungCap'];
                            $result_ncc = mysqli_query($conn, $sql_ncc);
                            $row_ncc = mysqli_fetch_assoc($result_ncc);
                            echo $row_ncc['tenNhaCungCap'];
                            ?>
                        </option>
                        <?php
                        $sql = "SELECT * FROM nhacungcap";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $row['maNhaCungCap']; ?>"><?php echo $row['tenNhaCungCap'] ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="btn">Danh Mục</label>
                    <select name="maDanhMuc" id="" class="form-control">
                        <?php
                        $sql = "SELECT * FROM danhmuc";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $row['maDanhMuc']; ?>"><?php echo $row['tenDanhMuc'] ?></option>

                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="donGia" class="btn">Đơn giá</label>
                    <input type="number" name="donGia" class="form-control" name="donGia" value="">
                </div>  

                <div class="form-group">
                    <label for="moTaSanPham" class="btn">Mô tả sản phẩm</label>
                    <input type="text" name="moTaSanPham" class="form-control" name="moTaSanPham">
                </div>

                <div class="form-group">
                    <label class="btn">Ảnh sản phẩm</label>
                    <input type="file" name="hinhanh" class="form-control">
                </div>

                <button name="submit" class="btn btn-success">Cập nhật thông tin</button>
            </form>
        </div>
    </div>
</body>

</html>