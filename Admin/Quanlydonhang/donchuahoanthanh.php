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
            <div>
                <?php
                include 'ketnoi.php';
                $sql_layncc = "SELECT COUNT(*) as total FROM donhang WHERE `tinhTrang` != 'Đã hủy' AND `tinhTrang` != 'Đã giao';";
                $result = mysqli_query($conn, $sql_layncc);
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];
                $page_hientai = isset($_GET['trang']) ? $_GET['trang'] : 1;
                $item_page = 7;
                $sotrang = ceil($total_records / $item_page);
                if ($page_hientai > $sotrang) {
                    $page_hientai = $sotrang;
                } else if ($page_hientai < 1) {
                    $page_hientai = 1;
                }
                // tìm điểm bắt đầu
                $start = ($page_hientai - 1) * $item_page;
                ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="khoangCach">
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý đơn hàng</h6>

                            <div>
                                <a href="hienthi.php" class="btn btn-success mb-3"> Tất cả</a>
                                <a href="donhoanthanh.php" class="btn btn-success mb-3"> Đơn hoàn thành</a>
                                <a href="donhuy.php" class="btn btn-success mb-3"> Đơn hủy</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-muted">
                        Search:
                        <div class="d-search">
                            <input type="text" id="search" class="ms-2 form-control" aria-label="Search invoice">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Xem</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </tfoot>
                                <tbody id="body_table">
                                    <?php
                                    require('ketnoi.php');
                                    $sql_str = "SELECT 
                                            * from donhang WHERE `tinhTrang` != 'Đã hủy' AND `tinhTrang` != 'Đã giao'
                                            order by thoiGianDat limit $start, $item_page";

                                    $result = mysqli_query($conn, $sql_str);
                                    $stt = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $stt++;
                                    ?>


                                        <tr>
                                            <td><?= $stt ?></td>
                                            <td><?= $row['maDonhang'] ?></td>
                                            <td><?= $row['thoiGianDat'] ?></td>
                                            <td><span class='tinhTrang'><?= $row['tinhTrang'] ?></span></td>
                                            <td><a class="btn btn-warning" href="vieworders.php?id=<?= $row['maDonhang'] ?>">Xem</a></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            echo '<div id="notfound">';
                            if (mysqli_num_rows($result) == 0) {
                                echo '<h3 style="text-align:center;margin-top: -21px;">Không có dữ liệu</h3>';
                            }
                            echo '</div>';
                            ?>
                            <input type="hidden" id="current_page" value=<?php echo $page_hientai ?>>
                            <ul class="pagination justify-content-end">
                                <?php
                                if ($page_hientai > 1 && $sotrang > 1) {
                                    $x = $page_hientai - 1;
                                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$x'>Previous</a></li>";
                                }

                                for ($i = 1; $i <= $sotrang; $i++) {
                                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$i'>$i</a></li>";
                                }
                                if ($page_hientai < $sotrang && $sotrang > 1) {
                                    $y = $page_hientai + 1;
                                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$y'>Next</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        const current_page = +document.getElementById("current_page").value;
        console.log(current_page);
        const inputField = document.getElementById("search");
        inputField.addEventListener('input', function() {
            console.log('Giá trị mới:', this.value);
            var form_data = new FormData();
            form_data.append('key', this.value);
            form_data.append('page', 10);
            form_data.append('current_page', current_page);
            var ajax_request = new XMLHttpRequest();

            ajax_request.open('POST', 'timkiemchuahoanthanh.php');

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