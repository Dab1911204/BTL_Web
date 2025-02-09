<?php
session_start();
include "connect.php";
if (isset($_POST['dangnhaptk'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM khachhang WHERE email = '$email' AND matKhau = '$password'";
	$result = mysqLi_query($conn, $sql);
	if (mysqLi_num_rows($result) == 1) {
		$row = mysqLi_fetch_array($result);
		$_SESSION["maKhachHang"] = $row['maKhachHang'];
		header("location:index.php");
	} else {
		echo "<script>alert('Email hoặc mật khẩu sai. Vui lòng nhập lại.')</script>";
	}
}
?>
<?php 
	require_once('khachxem.php');	
?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Đăng nhập -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li style="display: inline;"><a href="index.php">Trang chủ</a></li>
					<li class='active'>Đăng nhập</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->
	<div class="body-content">
		<div class="container">
			<div class="sign-in-page">
				<div class="row">
					<!-- Sign-in -->
					<div class="col-md-6 col-sm-6 sign-in">
						<h4 class="">Đăng nhập</h4>
						<!-- <p class="">Hello, Welcome to your account.</p> -->
						<form action="sign-in.php" class="register-form outer-top-xs" role="form" method="post" enctype="multipart/form-data" target="hidden_iframe">
							<div class="form-group">
								<label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" required>
							</div>
							<div class="form-group">
								<label class="info-title" for="exampleInputPassword1">Mật khẩu <span>*</span></label>
								<input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password" required>
							</div>
							<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="dangnhaptk">Đăng
								nhập</button>
						</form>
					</div>
					<!--End Sign-in -->
					<!-- create a new account -->
					<div class="col-md-6 col-sm-6 create-new-account">
						<h4 class="checkout-subtitle">Tạo tài khoản mới</h4>

						<form action="sign-in.php" class="register-form outer-top-xs" role="form" method="post" enctype="multipart/form-data" target="hidden_iframe">
							<div class="form-group">
								<label class="info-title" for="exampleInputEmail2">Email <span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="emaildk" required>
							</div>
							<div class="form-group">
								<label class="info-title">Họ tên <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" name="name" required>
							</div>
							<div class="form-group">

								<label class="info-title">SĐT <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="phone" name="phone" required>
								<span id="phoneError" class="error" style="display: none;">Số điện thoại không hợp lệ.</span>
							</div>
							<div class="form-group">
								<label class="info-title">Mật khẩu <span>*</span></label>
								<input type="password" class="form-control unicase-form-control text-input" name="passworddk" required>
							</div>
							<div class="form-group">
								<label class="info-title">Nhập lại mật khẩu
									<span>*</span></label>
								<input type="password" class="form-control unicase-form-control text-input" name="passworddk1" required>
							</div>
							<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="dangky">Đăng
								ký</button>
						</form>
						<?php
						include "connect.php";
						if (isset($_POST['dangky'])) {
							$Khachhang = "KH";
							$sql1 = "SELECT COUNT(*) as id FROM khachhang";
							$result = mysqli_query($conn, $sql1);
							$data = mysqli_fetch_assoc($result)['id'];
							$id = $data + 1;
							$maKhachhang = $Khachhang . $id;
							$emaildk = $_POST['emaildk'];
							$name = $_POST['name'];
							$phone = $_POST['phone'];
							$passworddk = $_POST['passworddk'];
							$passworddk1 = $_POST['passworddk1'];

							if ($passworddk != $passworddk1) {
								echo "<script>alert('Mật khẩu nhập lại không đúng')</script>";
							} else if (strlen($passworddk) < 6) {
								echo "<script>alert('Mật khẩu phải từ 6 ký tự')</script>";
							} else if (!preg_match('/^0[0-9]{9}$/', $phone)) {
								echo "<script>alert('Số điện thoại không hợp lệ.')</script>";
							} else {
								$sql_check_email = "SELECT * FROM khachhang WHERE email = '$emaildk'";
								$result_check_email = mysqli_query($conn, $sql_check_email);

								if (mysqli_num_rows($result_check_email) > 0) {
									echo "<script>alert('Email đã tồn tại')</script>";
								} else {
									$sql = "INSERT INTO khachhang(maKhachHang, tenKhachhang, soDienThoai, email, matKhau) VALUES ('$maKhachhang', '$name', '$phone', '$emaildk','$passworddk')";
									mysqLi_query($conn, $sql);
									echo "<script>alert('Đăng ký thành công')</script>";
								}
							}
						}
						?>
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
	</div><!-- /.body-content -->
	<!-- ============================================================= FOOTER ============================================================= -->
	<footer id="footer" class="footer color-bg">
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Contact Us</h4>
						</div><!-- /.module-heading -->

						<div class="module-body">
							<ul class="toggle-footer">
								<li class="media">
									<div class="pull-left">
										<span class="icon fa-stack fa-lg">
											<i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
										</span>
									</div>
									<div class="media-body">
										<p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
									</div>
								</li>

								<li class="media">
									<div class="pull-left">
										<span class="icon fa-stack fa-lg">
											<i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
										</span>
									</div>
									<div class="media-body">
										<p>+(888) 123-4567<br>+(888) 456-7890</p>
									</div>
								</li>

								<li class="media">
									<div class="pull-left">
										<span class="icon fa-stack fa-lg">
											<i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
										</span>
									</div>
									<div class="media-body">
										<span><a href="#">flipmart@themesground.com</a></span>
									</div>
								</li>

							</ul>
						</div><!-- /.module-body -->
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Customer Service</h4>
						</div><!-- /.module-heading -->

						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a href="#" title="Contact us">My Account</a></li>
								<li><a href="#" title="About us">Order History</a></li>
								<li><a href="#" title="faq">FAQ</a></li>
								<li><a href="#" title="Popular Searches">Specials</a></li>
								<li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
							</ul>
						</div><!-- /.module-body -->
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Corporation</h4>
						</div><!-- /.module-heading -->

						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a title="Your Account" href="#">About us</a></li>
								<li><a title="Information" href="#">Customer Service</a></li>
								<li><a title="Addresses" href="#">Company</a></li>
								<li><a title="Addresses" href="#">Investor Relations</a></li>
								<li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
							</ul>
						</div><!-- /.module-body -->
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Why Choose Us</h4>
						</div><!-- /.module-heading -->

						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a href="#" title="About us">Shopping Guide</a></li>
								<li><a href="#" title="Blog">Blog</a></li>
								<li><a href="#" title="Company">Company</a></li>
								<li><a href="#" title="Investor Relations">Investor Relations</a></li>
								<li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
							</ul>
						</div><!-- /.module-body -->
					</div>
				</div>
			</div>
		</div>

		<div class="copyright-bar">
			<div class="container">
				<div class="col-xs-12 col-sm-6 no-padding social">
					<ul class="link">
						<li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
						<li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
						<li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
						<li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
						<li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a>
						</li>
						<li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a>
						</li>
						<li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 no-padding">
					<div class="clearfix payment-methods">
						<ul>
							<li><img src="assets\images\payments\1.png" alt=""></li>
							<li><img src="assets\images\payments\2.png" alt=""></li>
							<li><img src="assets\images\payments\3.png" alt=""></li>
							<li><img src="assets\images\payments\4.png" alt=""></li>
							<li><img src="assets\images\payments\5.png" alt=""></li>
						</ul>
					</div><!-- /.payment-methods -->
				</div>
			</div>
		</div>
	</footer>
	<!-- ============================================================= FOOTER : END============================================================= -->


	<!-- For demo purposes – can be removed on production -->

	<!-- For demo purposes – can be removed on production : End -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="assets\js\jquery-1.11.1.min.js"></script>

	<script src="assets\js\bootstrap.min.js"></script>

	<script src="assets\js\bootstrap-hover-dropdown.min.js"></script>
	<script src="assets\js\owl.carousel.min.js"></script>

	<script src="assets\js\echo.min.js"></script>
	<script src="assets\js\jquery.easing-1.3.min.js"></script>
	<script src="assets\js\bootstrap-slider.min.js"></script>
	<script src="assets\js\jquery.rateit.min.js"></script>
	<script type="text/javascript" src="assets\js\lightbox.min.js"></script>
	<script src="assets\js\bootstrap-select.min.js"></script>
	<script src="assets\js\wow.min.js"></script>
	<script src="assets\js\scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
		$(document).ready(function() {
			$(".changecolor").switchstylesheet({
				seperator: "color"
			});
			$('.show-theme-options').click(function() {
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
			$('.show-theme-options').delay(2000).trigger('click');
		});


		document.getElementById("phone").addEventListener("input", function() {
			var phone = this.value;
			var phoneRegex = /^0[0-9]{9}$/; // Định dạng số điện thoại bắt đầu bằng số 0 và có 10 chữ số
			var errorElement = document.getElementById("phoneError");

			if (!phoneRegex.test(phone)) {
				errorElement.style.display = "inline";
			} else {
				errorElement.style.display = "none";
			}
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

</body>

</html>