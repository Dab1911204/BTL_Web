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
    <!-- phân trang -->
    <?php
    include 'ketnoi.php';
    $sql_laykh = "SELECT COUNT(*) as total FROM khachhang";
    $result = mysqli_query($conn, $sql_laykh);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $page_hientai = isset($_GET['trang']) ? $_GET['trang'] : 1;
    $item_page = 15;
    $sotrang = ceil($total_records / $item_page);
    if ($page_hientai > $sotrang) {
        $page_hientai = $sotrang;
    } else if ($page_hientai < 1) {
        $page_hientai = 1;
    }
    // tìm điểm bắt đầu
    $start = ($page_hientai - 1) * $item_page;
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
                        <li class="nav-item active">
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
        <div class="container" style="margin-top: 10px">
            <h1 align="center"> DANH SÁCH KHÁCH HÀNG</h1>
            <div class="text-muted">
                Search:
                <div class="d-search">
                    <input type="text" id="search" class="ms-2 form-control" aria-label="Search invoice">
                </div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Mật khẩu</th>
                        <th>Tổng số đơn</th>
                        <th>Đơn hoàn thành</th>
                        <th>Đơn hủy</th>
                        <th>Tổng tiền đã mua</th>
                    </tr>
                </thead>
                <tbody id="body_table">
                    <?php
                    // kết nối
                    require_once 'ketnoi.php';
                    // câu lệnh
                    $sql = "SELECT kh.*, COUNT(dh.maDonhang) as TongDH,
                    sum(CASE WHEN tinhTrang = 'Đã giao' THEN 1 ELSE 0 END) as DonHangĐG,
                    sum(CASE WHEN tinhTrang = 'Đã hủy' THEN 1 ELSE 0 END) as DonHangĐH,
                    sum( tongGiaTri ) as TongGiaTri
            FROM khachhang kh LEFT JOIN donhang dh on kh.maKhachHang = dh.maKhachHang
            GROUP BY kh.maKhachHang LIMIT $start, $item_page ";
                    // thực thi câu lệnh
                    $result = mysqli_query($conn, $sql);
                    //duyệt qua result và un ra
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td> <?php echo $row['maKhachHang']; ?></td>
                            <td> <?php echo $row['tenKhachhang']; ?></td>
                            <td> <?php echo $row['email']; ?></td>
                            <td> <?php echo $row['soDienThoai']; ?></td>
                            <td> <?php echo $row['matkhau']; ?></td>
                            <td> <?php echo $row['TongDH']; ?></td>
                            <td> <?php echo $row['DonHangĐG']; ?></td>
                            <td> <?php echo $row['DonHangĐH']; ?></td>
                            <td> <?php echo $row['TongGiaTri']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </div>
    </div>
    </table>
    <?php
    echo '<div id="notfound">';
    if (mysqli_num_rows($result) == 0) {
        echo '<h3 style="text-align: center; margin-top: -21px;"> Không có dữ liệu </h3>';
    }
    echo '</div>';
    ?>
    <input type="hidden" id="current_page" value=<?php echo $page_hientai ?>>
    <ul class="pagination justify-content-end">
        <?php
        if ($page_hientai > 1 && $sotrang > 1) {
            $x = $page_hientai - 1;
            echo "<li class='page-item'><a class='page-link' href='?trang=$x'>Previous</a></li>";
        }
        for ($i = 1; $i <= $sotrang; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?trang=$i'>$i</a></li>";
        }
        if ($page_hientai < $sotrang && $sotrang > 1) {
            $y = $page_hientai + 1;
            echo "<li class='page-item'><a class='page-link' href='?trang=$y'>Next</a></li>";
        }
        ?>
    </ul>
</body>
<script type='text/javascript'>
    const current_page = +document.getElementById("current_page").value;
    console.log(current_page);
    const inputField = document.getElementById("search");
    inputField.addEventListener('input', function() {
        console.log('Giá trị mới:', this.value);
        var form_data = new FormData();
        form_data.append('key', this.value);
        form_data.append('page', 9);
        form_data.append('current_page', current_page);
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST', 'timkiem.php');
        ajax_request.send(form_data);
        ajax_request.onreadystatechange = function() {
            if (ajax_request.responseText === '') {
                document.getElementById('notfound').innerHTML = '<h3 style="text-align:center;margin-top: -21px;">Không có dữ liệu</h3>'
                document.getElementById('body_table').innerHTML = ''
            } else {
                document.getElementById('body_table').innerHTML = ajax_request.responseText;
                document.getElementById('notfound').innerHTML = ''
            }
        }
    });
</script>

</html>