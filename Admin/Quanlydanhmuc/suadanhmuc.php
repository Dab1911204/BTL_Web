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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
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

    <hr />
    <?php
    $id = $_GET['id'];
    require_once 'ketnoi.php';
    $danhmuc = array();
    $sql = "select * from danhmuc where maDanhMuc = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $q1 = "select * from danhmuc where danhMucCha = -1";// hiện danh sách danh mục cha
    $result1 = mysqli_query($conn, $q1);
    if (mysqli_num_rows($result1)>  0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $danhmuc[] = $row1;
        }
    }
    ?>
    <hr />;
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $errors = [];
        if (empty(trim($_POST['txtDanhMuc']))) {
            $errors['txtDanhMuc'] = 'Tên danh mục không được để trống';
            // } else {
            //     $tenDanhMuc = test_input($_POST['txtDanhMuc']);
            //     $sql1 = "SELECT * FROM danhmuc Where tenDanhMuc = '$tenDanhMuc'";
            //     $result = mysqli_query($conn, $sql1);
            //     if(mysqli_num_rows($result) > 0)
            //     {
            //         $errors['txtDanhMuc'] = 'Tên danh mục đã tồn tại';
            //     }
            //     else
            $txtDanhMuc = $_POST['txtDanhMuc'];
        }
        if (empty(trim($_POST['txtDuongDan']))) {
            $errors['txtDuongDan'] = 'Không được để trống đường dẫn';
        } else {
            $txtDuongDan = $_POST['txtDuongDan'];
        }
        if (!empty($_POST['txtDmCha'])) {
            $txtDmCha = $_POST['txtDmCha'];
        } else {
            $txtDmCha = -1;
        }
        if (!empty($errors)) {
            var_dump($errors);
            $mess = 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại';
    ?>
            <div class="alert">
                <?php echo $mess; ?>
            </div>
    <?php
        } else {
            $tenDanhMuc = $_POST['txtDanhMuc'];
            $url = $_POST['txtDuongDan'];
            $danhMucCha = ($_POST['txtDmCha'] != 0 && $_POST['txtDmCha'] != $id) ? $_POST['txtDmCha'] : -1;
            $query = "UPDATE danhmuc SET tenDanhMuc= '$tenDanhMuc', duongDan= '$url',
                danhMucCha= '$danhMucCha' WHERE maDanhMuc= $id";
            var_dump($query);
            $result = mysqli_query($conn, $query);
            if ($result > 0) {
                echo 'Sửa thành công';
                header('location: hienthi.php');
            } else
                echo 'Lỗi thêm mới';
        }
    }
    function test_input($data)
    {
        $data = trim($data);// 
        $data = stripslashes($data);// loại bỏ kí tự gạch chéo từ 1 chuỗi
        $data = htmlspecialchars($data);// để chuyển đổi các ký tự đặc biệt thành các thẻ HTML tương ứng
        return $data;
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
            <div class="sidebar-wrapper scrollbar scrollbar-inner scroll-content scroll-scrolly_visible"
                 style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 427px;">
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
        <div class="container">
            <h2>Sửa danh mục</h2>
            <form method="POST">
                <!-- <div class="form-group">
                    <label for="inputEmail4">Mã danh mục</label>
                    <input disabled type="text" class="form-control" name="txtMa" value=<?php echo $id ?>>
                </div> -->

                <div class="form-group">
                    <label for="inputAddress">Tên danh mục</label>
                    <input type="text" class="form-control" id="txtDanhMuc" name="txtDanhMuc" placeholder="Tên danh mục" oninput="updateInput2()" value="<?php echo $row['tenDanhMuc'] ?>">
                    <?php
                    echo (!empty($errors['txtDanhMuc'])) ? '<span class="error">' . $errors['txtDanhMuc'] . '</span>' : false;
                    ?>
                </div>

                <div class="form-group">
                    <label for="inputAddress2"> Đường dẫn </label>
                    <input type="text" class="form-control" id="txtDuongDan" name="txtDuongDan" placeholder="Đường dẫn" value="<?php echo $row['duongDan'] ?>">
                    <?php
                    echo (!empty($errors['txtDuongDan'])) ? '<span class="error">' . $errors['txtDuongDan'] . '</span>' : false;
                    ?>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="inputState">Danh mục cha</label>
                        <select id="inputState" class="form-control" name="txtDmCha">
                            <option name="txtDmCha" value="-1">Danh mục cha</option>
                            <?php
                            foreach ($danhmuc as $key => $item) {
                                if ($item['danhMucCha'] == $row["maDanhMuc"])
                                    echo '<option name="txtDmCha" selected value= ' . $item['maDanhMuc'] . '>' . $item['tenDanhMuc'] . '</option>';
                                else
                                    echo '<option name="txtDmCha" value= ' . $item['maDanhMuc'] . '>' . $item['tenDanhMuc'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sửa danh mục</button>
            </form>
        </div>
    </div>
    <script>
        function convertToSlug(str) {
            // Chuyển các ký tự có dấu thành không dấu và chuyển sang chữ thường
            str = str.toLowerCase().replace(/ă/g, 'a').replace(/â/g, 'a').replace(/đ/g, 'd').replace(/ê/g, 'e').replace(
                /ô/g, 'o').replace(/ơ/g, 'o').replace(/ư/g, 'u').replace(/ơ/g, 'o').replace(/ư/g, 'u').replace(/ /g,
                '-');
            return str;
        }

        function removeAccents(str) {
            return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');// chuyển sắc huyền, ngã,..
        }

        function updateInput2() {
            var input1Value = document.getElementById("txtDanhMuc").value;
            document.getElementById("txtDuongDan").value = removeAccents(convertToSlug(input1Value));
        }
    </script>
</body>

</html>