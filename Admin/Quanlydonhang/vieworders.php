<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />


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
    <?php
    // Kiểm tra nếu ID được cung cấp qua GET
    if (!isset($_GET['id'])) {
        die("Thiếu tham số ID.");
    }

    // Kết nối cơ sở dữ liệu
    require('./ketnoi.php');

    // Lấy và làm sạch giá trị ID từ GET để tránh SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Truy vấn chi tiết đơn hàng
    $sql_order = "SELECT * FROM donhang WHERE maDonhang = '$id'";
    $res_order = mysqli_query($conn, $sql_order);

    if (!$res_order) {
        die("Truy vấn thất bại: " . mysqli_error($conn));
    }

    $order = mysqli_fetch_array($res_order);

    // Lấy thông tin khách hàng từ bảng khachhang
    $customer_id = $order['maKhachHang'];
    $sql_customer = "SELECT tenKhachhang, soDienThoai FROM khachhang WHERE maKhachHang = '$customer_id'";
    $res_customer = mysqli_query($conn, $sql_customer);

    if (!$res_customer) {
        die("Truy vấn thông tin khách hàng thất bại: " . mysqli_error($conn));
    }

    $customer = mysqli_fetch_array($res_customer);

    // Xử lý khi form được submit
    if (isset($_POST['btnUpdate'])) {
        // Lấy và làm sạch giá trị từ form
        $tinhTrang = mysqli_real_escape_string($conn, $_POST['tinhTrang']);

        // Cập nhật trạng thái đơn hàng
        $update_sql = "UPDATE donhang SET tinhTrang = '$tinhTrang' WHERE maDonhang = '$id'";
        $update_res = mysqli_query($conn, $update_sql);

        if ($update_res) {
            // Kiểm tra nếu trạng thái là "Đã hủy"
            if ($tinhTrang == 'Đã hủy') {
                // Truy vấn chi tiết đơn hàng để lấy mã sản phẩm và số lượng
                $sql_order_details = "SELECT maSanPham, soLuong FROM chitietdonhang WHERE maDonHang = '$id'";
                $res_order_details = mysqli_query($conn, $sql_order_details);

                if ($res_order_details) {
                    while ($order_detail = mysqli_fetch_array($res_order_details)) {
                        $maSanPham = $order_detail['maSanPham'];
                        $soLuong = $order_detail['soLuong'];

                        // Truy vấn để tìm sản phẩm trong kho có ngày nhập kho cũ nhất
                        $sql_khohang_oldest = "SELECT maSanPham, soLuong FROM khohang WHERE maSanPham = '$maSanPham' ORDER BY ngayNhap ASC LIMIT 1";
                        $res_khohang_oldest = mysqli_query($conn, $sql_khohang_oldest);

                        if ($res_khohang_oldest) {
                            $khohang_oldest = mysqli_fetch_array($res_khohang_oldest);
                            $soLuongMoi = $khohang_oldest['soLuong'] + $soLuong;

                            // Cập nhật số lượng vào bảng khohang
                            $update_khohang_sql = "UPDATE khohang SET soLuong = $soLuongMoi WHERE maSanPham = '$maSanPham' AND ngayNhap = (SELECT ngayNhap FROM khohang WHERE maSanPham = '$maSanPham' ORDER BY ngayNhap ASC LIMIT 1)";
                            $update_khohang_res = mysqli_query($conn, $update_khohang_sql);

                            if (!$update_khohang_res) {
                                die("Cập nhật số lượng vào kho thất bại: " . mysqli_error($conn));
                            }
                        } else {
                            die("Truy vấn kho hàng thất bại: " . mysqli_error($conn));
                        }
                    }
                } else {
                    die("Truy vấn chi tiết đơn hàng thất bại: " . mysqli_error($conn));
                }
            }

            // Chuyển hướng sau khi cập nhật thành công
            header("Location: ./hienthi.php");
        } else {
            die("Cập nhật thất bại: " . mysqli_error($conn));
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
                        <li class="nav-item  active">
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
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart boby">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 mb-4 text-gray-800 text-center">Xem và cập nhật trạng thái đơn hàng</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <form class="user" method="post" action="">
                                                        <h5 class="card-title">Thông tin khách hàng</h5>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label for="customerName" class="col-sm-4 col-form-label text-md-right"">Khách hàng:</label>
                                            <div class=" col-md-8">
                                                                <?= htmlspecialchars($customer['tenKhachhang']) ?>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="customerAddress" class="col-sm-4 col-form-label text-md-right">Địa chỉ:</label>
                                                    <div class="col-md-8">
                                                        <?= htmlspecialchars($order['diaChiKhachHang']) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="customerPhone" class="col-sm-4 col-form-label text-md-right">Số điện thoại:</label>
                                                    <div class="col-md-8">
                                                        <?= htmlspecialchars($customer['soDienThoai']) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="orderStatus" class="col-sm-4 col-form-label text-md-right">Trạng thái đơn hàng:</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="tinhTrang">
                                                            <option style="  background-color: orange;" <?= $order['tinhTrang'] == 'Chờ xử lý' ? 'selected' : '' ?>>Chờ xử lý</option>
                                                            <option <?= $order['tinhTrang'] == ' Đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
                                                            <option <?= $order['tinhTrang'] == 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
                                                            <option <?= $order['tinhTrang'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
                                                            <option <?= $order['tinhTrang'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <br>
                                                <button class="btn btn-primary" type="submit" name="btnUpdate" <?php if ($order['tinhTrang'] == 'Đã hủy') echo 'disabled'; ?>>Cập nhật</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <h5 class="card-title">Chi tiết đơn hàng</h5>
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Sản phẩm</th>
                                                                <th>Giá</th>
                                                                <th>Số lượng</th>
                                                                <th>Tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql_details = "SELECT chitietdonhang.*, sanpham.tenSanPham AS pname, sanpham.donGia AS oprice 
                                                                FROM chitietdonhang 
                                                                JOIN sanpham ON chitietdonhang.maSanPham = sanpham.maSanPham 
                                                                WHERE chitietdonhang.maDonhang = '$id'";
                                                            $res_details = mysqli_query($conn, $sql_details);
                                                            $stt = 0;
                                                            $tongtien = 0;
                                                            while ($detail = mysqli_fetch_assoc($res_details)) {
                                                                $tongtien += $detail['soLuong'] * $detail['oprice'];
                                                            ?>
                                                                <tr>
                                                                    <td><?= ++$stt ?></td>
                                                                    <td><?= htmlspecialchars($detail['pname']) ?></td>
                                                                    <td><?= number_format($detail['oprice'], 0, '', '.') . " VNĐ" ?></td>
                                                                    <td><?= htmlspecialchars($detail['soLuong']) ?></td>
                                                                    <td><?= number_format($detail['soLuong'] * $detail['oprice'], 0, '', '.') . " VNĐ" ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4" class="text-right">Tổng tiền:</th>
                                                                <th><?= number_format($tongtien, 0, '', '.') . " VNĐ" ?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</body>

</html>