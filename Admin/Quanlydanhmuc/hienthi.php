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
    <?php
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $errors = [];
    //     if (empty(trim($_POST['txtDanhMuc']))) {
    //         $errors['txtDanhMuc'] = 'Tên danh mục không được để trống';
    //     } else {
    //         $txtDanhMuc = $_POST['txtDanhMuc'];
    //     }
    //     if (empty(trim($_POST['txtDuongDan']))) {
    //         $errors['txtDuongDan'] = 'Không được để trống đường dẫn';
    //     } else {
    //         $txtDuongDan = $_POST['txtDuongDan'];
    //     }
    //     if (!empty($_POST['txtDmCha'])) {
    //         $txtDmCha = $_POST['txtDmCha'];
    //     } else {
    //         $txtDmCha = -1;
    //     }
    //     if (!empty($errors)) {
    //         $mess = 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại';
     ?>
            <!-- <div class="alert">
                <?php echo $mess; ?>
            </div> -->
    <?php
    //     }
    // }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // hiển thị tên danh mục cha của danh mục con
    function getTenDanhMuc($id)
    {
        $tendanhmuccha = '';
        if ($id != -1) {// nếu danh mục cha
            $q1 = "select tenDanhMuc from danhmuc where maDanhMuc = '" . $id . "'";
            $result1 = mysqli_query(mysqli_connect("localhost", "root", "", "btl_web"), $q1);
            if (mysqli_num_rows($result1) > 0) {
                $tendanhmuccha = mysqli_fetch_assoc($result1)['tenDanhMuc'];// lấy giá trị của dòng ra
            }
        }
        return $tendanhmuccha;
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
                        <li class="nav-item active">
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
            <h1 align="center">DANH SÁCH DANH MỤC</h1>
            <a href="themdanhmuc.php" class="btn btn-success"> Thêm danh muc</a>
            <div class="text-muted">
                Search:
                <div class="d-search">
                    <input type="text" id="search" class="ms-2 form-control" aria-label="Search invoice">
                </div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>MÃ DANH MỤC</th>
                        <th>TÊN DANH MỤC</th>
                        <th>DANH MỤC CHA</th>
                        <th>ĐƯỜNG DẪN</th>
                        <th>THAO TÁC</th>
                    </tr>
                </thead>
                <tbody id="body_table">
                    <?php
                    // kết nối
                    require_once 'ketnoi.php';
                    // câu lệnh
                    $sql = "SELECT * FROM danhmuc";
                    // thực thi câu lệnh
                    $resul = mysqli_query($conn, $sql);
                    $danhmuc = array();
                    // duyệt qua resul và in ra
                    while ($row = mysqli_fetch_array($resul)) { // cái này là lưu mảng danh mục
                        $danhmuc[] = $row;
                    }
                    function showCategories($danhmuc, $parent_id = -1, $char = '')
                    {
                        foreach ($danhmuc as $key => $item) {
                            // Nếu là chuyên mục con thì hiển thị
                            // đầu tiên sẽ hiển thị danh mục có parent_id = -1
                            if ($item['danhMucCha'] == $parent_id) {
                    ?>
                                <tr>
                                    <td><?php echo $item['maDanhMuc']; ?></td>
                                    <td><?php echo $char . $item['tenDanhMuc']; ?></td>
                                    <td><?php echo getTenDanhMuc($item["danhMucCha"]) ?></td>
                                    <td><?php echo $item['duongDan']; ?></td>
                                    <td> <a href="suadanhmuc.php?id=<?php echo $item['maDanhMuc']; ?>" class="btn btn-info">Sửa</a>
                                        <a onclick="return confirm('Bạn có muốn xóa danh muc này không');" href="xoadanhmuc.php?id=<?php echo $item['maDanhMuc']; ?>" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                    <?php
                                // Xóa chuyên mục đã lặp( xóa danh mục đã được hiên thị)
                                unset($danhmuc[$key]);
                                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp ( hiển thị thằng con)
                                showCategories($danhmuc, $item['maDanhMuc'], $char . '|____');
                            }
                        }
                    }
                    showCategories($danhmuc);
                    ?>
                </tbody>
            </table>
            <?php
            echo '<div id="notfound">';
            if (mysqli_num_rows($resul) == 0) {
                echo '<h3 style="text-align:center;margin-top: -21px;">Không có dữ liệu</h3>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
</body>
<script type='text/javascript'>
    const inputField = document.getElementById("search");// lấy giá trị khi nhập vào ô tìm kiếm
    inputField.addEventListener('input', function() {
        console.log('Giá trị mới:', this.value);
        var form_data = new FormData();
        form_data.append('key', this.value);// nội dung tìm kiếm
        var ajax_request = new XMLHttpRequest();

        ajax_request.open('POST', 'timkiem.php');// mở file tìm kiếm

        ajax_request.send(form_data);// gửi thồng tin tìm kiếm

        ajax_request.onreadystatechange = function() {

            if (ajax_request.responseText === '') {
                document.getElementById('notfound').innerHTML =
                    '<h3 style="text-align:center;margin-top: -21px;">Không có dữ liệu</h3>'
                document.getElementById('body_table').innerHTML = ''// kết quả tìm kiếm đc
            } else {
                document.getElementById('body_table').innerHTML = ajax_request.responseText;
                document.getElementById('notfound').innerHTML = ''
            }
        }
    });
</script>

</html>