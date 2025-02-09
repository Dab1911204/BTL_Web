<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>HYG thực phẩm sạch</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets\css\main.css">
    <link rel="stylesheet" href="assets\css\blue.css">
    <link rel="stylesheet" href="assets\css\owl.carousel.css">
    <link rel="stylesheet" href="assets\css\owl.transitions.css">
    <link rel="stylesheet" href="assets\css\animate.min.css">
    <link rel="stylesheet" href="assets\css\rateit.css">
    <link rel="stylesheet" href="assets\css\bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets\css\font-awesome.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="CSS\cart.css">
</head>

<body>
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->

        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo"> <a href="index.php"> <img src="./img/Remove-bg.ai_1718180807563.png" alt="logo" style="height: 65px;width: 250px;"> </a> </div>
                        <!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6"></div>

                    <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                        <div class="dropdown dropdown-cart" style="margin-left: 10px;">
                            <div class="items-cart-inner dropdown-toggle lnk-cart ">
                                <form action="" method="post">
                                    <button class="btn btn-primary" type="submit" name="dangnhap">
                                        <div class=""> <i class="fa-solid fa-user style_icon"></i> Đăng nhập</div>
                                    </button>
                                </form>
                                <?php
                                if (isset($_POST['dangnhap']) || isset($_POST['giohang'])) {
                                    header("location:sign-in.php");
                                }
                                ?>
                            </div>
                        </div>
                        <div class="dropdown dropdown-cart">
                            <div class="items-cart-inner dropdown-toggle lnk-cart">
                                <button class="btn btn-primary" type="button" name="giohang">
                                    <a href="cart.php" style="color: #fff;">
                                        <div class="basket ">
                                            <i class="glyphicon glyphicon-shopping-cart style_icon"></i>
                                            Giỏ hàng
                                        </div>
                                    </a>
                                </button>
                            </div>
                            <!-- /.dropdown-cart -->
                            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================== NAVBAR ============================================== -->
            <div class="header-nav animate-dropdown">
                <div class="container" style="height: 42px">
                    <div class="yamm navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div class="nav-bg-class">
                            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                                <div class="nav-outer">
                                    <ul class="nav navbar-nav">
                                        <li class="active dropdown yamm-fw"> <a href="index.php">Trang chủ</a></li>
                                        <li class="dropdown hidden-sm"> <a href="blog.php">Tin tức</a> </li>
                                        <li class="dropdown hidden-sm"> <a href="dieukhoan.php">Điều khoản & điều kiện</a> </li>
                                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                                            <ul class="dropdown-menu pages">
                                                <li>
                                                    <div class="yamm-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-menu">
                                                                <ul class="links">
                                                                    <li><a href="index.php">Trang chủ</a></li>
                                                                    <li><a href="cart.php">Giỏ hàng</a></li>
                                                                    <li><a href="dathang.php">Thanh toán</a></li>
                                                                    <li><a href="blog.php">Tin tức</a></li>
                                                                    <li><a href="dieukhoan.php">Điều khoản & điều kiện</a></li>
                                                                    <li><a href="donhang.php">Trạng thái đơn hàng</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <div class="col-xs-12 col-sm-12 col-md-4 top-search-holder navbar-right">
                                            <!-- ============================================================= SEARCH AREA ============================================================= -->
                                            <div class="search-area">
                                                <form action="timkiem.php" method="get">
                                                    <div class="control-group">
                                                        <input class="search-field" name="tukhoa" placeholder="Tìm kiếm tại đây..." style="height: 42px">
                                                        <a class="search-button" style="height: 42px"></a>
                                                    </div>
                                                </form>
                                            </div>
                                    </ul>
                                    <!-- /.navbar-nav -->
                                </div>
                                <!-- /.nav-outer -->
                            </div>
                            <!-- /.navbar-collapse -->

                        </div>
                        <!-- /.nav-bg-class -->
                    </div>
                    <!-- /.navbar-default -->
                </div>
                <!-- /.container-class -->

            </div>
            <!-- /.header-nav -->
            <!-- ============================================== NAVBAR : END ============================================== -->
    </header>