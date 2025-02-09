<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['maKhachHang'])) {
    header('location:sign-in.php');
    require_once('khachxem.php');
    
} else {
    $maKhachhang = $_SESSION['maKhachHang'];
    require_once('header.php');
}
?>
?>
<?php
$sql = "SELECT * FROM khachhang WHERE maKhachHang = '$maKhachhang'";
$query = mysqLi_query($conn, $sql);
$row = mysqLi_fetch_assoc($query);
if (isset($_POST['luuthaydoi'])) {
	$tenkhachhang = $_POST['tenkhachhang'];
	$sdt = $_POST['sdt'];
	$email = $_POST['email'];
	$sql = "UPDATE khachhang SET tenKhachhang = '$tenkhachhang', soDienThoai = '$sdt' WHERE maKhachhang = '$maKhachhang'";
	mysqLi_query($conn, $sql);
	echo "<script>alert('Thay đổi thông tin thành công');
	window.location.href='index.php';
		</script>";
}
?>


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li style="display: inline;"><a href="index.php">Trang chủ</a></li>
				<li class="active">Tài khoản cá nhân</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div>
<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Thông tin tài khoản của bạn</h4>
					<!-- <p class="">Hello, Welcome to your account.</p> -->

					<form action="taikhoancuatoi.php" method="post" class="register-form outer-top-xs" role="form">
						<div class="form-group">
							<label class="info-title" for="exampleInputPassword1">Tên khách hàng <span>*</span></label>
							<input type="text" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="tenkhachhang" value="<?php echo $row['tenKhachhang']; ?>" required>
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputPassword1">SĐT <span>*</span></label>
							<input type="text" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="sdt" value="<?php echo $row['soDienThoai'] ?>" required>
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Email <span></span></label>
							<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" value="<?php echo $row['email'] ?>" readonly>
						</div>
						<button type="submit" name="luuthaydoi" class="btn-upper btn btn-primary checkout-page-button">Lưu thay đổi</button>
					</form>
				</div>
				<!-- Sign-in -->

				<?php
				if (isset($_POST['submit'])) {

					$matkhau = $_POST['matkhau'];
					$matkhau1 = $_POST['matkhau1'];
					$matkhau2 = $_POST['matkhau2'];

					// Kiểm tra mật khẩu hiện tại
					$sql = "SELECT * FROM khachhang WHERE maKhachHang = '$maKhachhang' AND matKhau = '$matkhau'";
					$query = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($query);

					if (mysqli_num_rows($query) == 1) {
						// Nếu mật khẩu hiện tại đúng, tiến hành cập nhật mật khẩu mới
						if ($matkhau1 == $matkhau2) {
							$sql_update = "UPDATE khachhang SET matKhau = '$matkhau1' WHERE maKhachHang = '$maKhachhang'";
							mysqli_query($conn, $sql_update);
							echo "<script>alert('Đổi mật khẩu thành công');
							window.location.href='index.php';</script>";
						} else {
							echo "<script>alert('Mật khẩu mới không trùng nhau');</script>";
						}
					} else {
						// Nếu mật khẩu hiện tại không đúng
						echo "<script>alert('Mật khẩu hiện tại không đúng');</script>";
					}
				}
				?>


				<!-- create a new account -->
				<div class="col-md-6 col-sm-6 create-new-account">
					<h4 class="checkout-subtitle">Đổi mật khẩu</h4>
					<form action="taikhoancuatoi.php" method="post" class="register-form outer-top-xs" role="form">
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail2">Mật khẩu hiện tại <span>*</span></label>
							<input type="password" name="matkhau" class="form-control unicase-form-control text-input" id="" required>
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">mật khẩu mới <span>*</span></label>
							<input type="password" name="matkhau1" class="form-control unicase-form-control text-input" id="" required>
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Nhập lại mật khẩu mới <span>*</span></label>
							<input type="password" name="matkhau2" class="form-control unicase-form-control text-input" id="" required>
						</div>
						<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Đổi mật khẩu</button>
					</form>


				</div>
				<!-- create a new account -->
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		<div id="brands-carousel" class="logo-slider wow fadeInUp">

			<div class="logo-slider-inner">
				<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
					<div class="item m-t-15">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item m-t-10">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
						</a>
					</div><!--/.item-->
				</div><!-- /.owl-carousel #logo-slider -->
			</div><!-- /.logo-slider-inner -->

		</div><!-- /.logo-slider -->
		<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
	</div><!-- /.container -->
</div>
<?php
require_once('footer.php');
?>