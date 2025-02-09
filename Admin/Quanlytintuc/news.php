<?php
session_start();

include 'connect.php';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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


    <!-- phân trang -->
    <?php
    include 'connect.php';
    $sql_laytt = "SELECT COUNT(*) as total FROM tintuc";
    $result = mysqli_query($conn, $sql_laytt);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $page_hientai = isset($_GET['trang']) ? $_GET['trang'] : 1;
    $item_page = 5;
    $sotrang = ceil($total_records / $item_page);
    if ($page_hientai > $sotrang) {
        $page_hientai = $sotrang;
    } else if ($page_hientai < 1) {
        $page_hientai = 1;
    }
    // tìm điểm bắt đầu
    $start = ($page_hientai - 1) * $item_page;
    ?>

    <div class="main-panel">
        <div class="container">
            <div class="container">
                <h2>Danh sách tin tức</h2>
                <a href="add_news.php" class="btn btn-success"> Thêm tin tức</a>

                <div class="text-muted">
                    <div class="d-search">
                        <input type="text" id="search" class="m-2 form-control" aria-label="Search invoice" placeholder="Nhập tiêu đề tin tức muốn tìm...">
                    </div>
                </div>
                <div id="body_table">
                    <?php
                    include 'connect.php';
                    $sql = "SELECT * FROM tintuc ORDER BY maTintuc DESC LIMIT $start, $item_page";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="list">
                            <div class="list-left">
                                <img src="/Demo/imgchung/<?php echo $row['anhTinTuc']; ?>" alt="">
                                <div class="list-info">
                                    <h4><?php echo $row['tieuDe']; ?></h4>
                                    <span class="list-category"><?php echo $row['ngayThang'] ?></span>
                                </div>
                            </div>
                            <div class="list-right">
                                <div class="list-control">
                                    <div class="list-tool">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $row['maTintuc']; ?>">Xem thêm</button>

                                        <a href="edit_news.php?matintuc=<?php echo $row['maTintuc']; ?>" class="btn btn-success" style="margin: 0px 10px;"><i class="far fa-edit"></i></a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này không?');" href="delete_news.php?matintuc=<?php echo $row['maTintuc']; ?>" class="btn-delete" style="border-radius: 4px;"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Scrollable modal -->
                        <div class="modal fade" id="exampleModal_<?php echo $row['maTintuc']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="blog-post outer-top-bd wow fadeInUp">
                                            <a href=""><img class="img-responsive" src="/Demo/imgchung/<?php echo $row['anhTinTuc']; ?>" width=900px height=500px alt=""></a>
                                            <h1><a href=""><?php echo $row['tieuDe']; ?></a></h1>
                                            <p><?php echo $row['noiDung']; ?></p>
                                            <span class="datetime"><?php echo $row['ngayThang']; ?></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <div id="notfound">

            </div>
            <input type="hidden" id="current_page" value=<?php echo $page_hientai ?>>
            <ul class="pagination justify-content-center">
                <?php
                if ($page_hientai > 1 && $sotrang > 1) {
                    $x = $page_hientai - 1;
                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$x'>Trước</a></li>";
                }

                for ($i = 1; $i <= $sotrang; $i++) {
                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$i'>$i</a></li>";
                }
                if ($page_hientai < $sotrang && $sotrang > 1) {
                    $y = $page_hientai + 1;
                    echo "<li class='page-item'><a class='page-link' 
                    href='?trang=$y'>Tiếp theo</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>


</body>
<script type='text/javascript'>
    const current_page = +document.getElementById("current_page").value;
    const inputField = document.getElementById("search");
    inputField.addEventListener('input', function() {
        var form_data = new FormData();
        form_data.append('key', this.value);
        form_data.append('page', 5);
        form_data.append('current_page', current_page);
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST', 'timkiem.php');
        ajax_request.send(form_data);
        ajax_request.onreadystatechange = function() {
            if (ajax_request.responseText === '') {
                document.getElementById('notfound').innerHTML = '<h3 style="text-align:center;">Không có dữ liệu</h3>'
                document.getElementById('body_table').innerHTML = ''
            } else {
                document.getElementById('body_table').innerHTML = ajax_request.responseText;
                document.getElementById('notfound').innerHTML = ''
            }
        }
    });
</script>

</html>