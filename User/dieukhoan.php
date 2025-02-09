<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['maKhachHang'])) {
	require_once('khachxem.php');
} else {
	$maKhachhang = $_SESSION['maKhachHang'];
	$maKhachHang = $_SESSION['maKhachHang']; // Lấy mã khách hàng từ session
	require_once('header.php');
}


?>

<body>
	<!-- ============================================== HEADER : END ============================================== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
				<li style="display: inline;"><a href="./index.php">Trang chủ</a></li>
					<li class='active'>Điều khoản & Điều kiện</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content">
		<div class="container">
			<div class="terms-conditions-page">
				<div class="row">
					<div class="col-md-12 terms-conditions">
						<h2 class="heading-title">Điều khoản & Điều kiện</h2>
						<div class="">
							<h3>1. Giới thiệu</h3>
							<ol>
								<li>Chào mừng quý khách hàng đến với Trang TMĐT CPFoods - cpfoods.vn</li>
								<li>Sàn giao dịch thương mại điện tử thông qua website cpfoods.vn (Sau đây gọi là CPFoods) và đã được đăng ký chính thức với Bộ Công Thương Việt Nam.</li>
								<li>Khi truy cập vào website của chúng tôi, có nghĩa là quý khách đã đồng ý với các điều khoản này. Chúng tôi có quyền chỉnh sửa, thay đổi, lược bỏ hoặc thêm vào bất kỳ phần nào trong Điều khoản sử dụng này vào bất cứ lúc nào. Sau khi được thay đổi, các thông tin sẽ có hiệu lực ngay khi được đăng trên trang web mà không thông báo trước. Khi quý khách tiếp tục sử dụng website sau khi các điều khoản thay đổi được đăng tải, đồng nghĩa với việc quý khách chấp nhận các thay đổi đó. Do đó, quý khách hàng vui lòng kiểm tra Điều khoản sử dụng thường xuyên để cập nhật những thay đổi của chúng tôi</li>
							</ol>
							<h3>2. Hướng dẫn sử dụng website</h3>
							<ol>
								<li>Khi truy cập vào website của chúng tôi, khách hàng phải đảm bảo đủ 18 tuổi, hoặc có thể truy cập dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp. Khách hàng đảm bảo có đầy đủ hành vi dân sự để thực hiện các giao dịch mua bán hàng hóa theo quy định hiện hành của pháp luật Việt Nam.</li>
								<li>Quý khách hàng sẽ không phải đăng ký tài khoản để có thể truy cập vào web chúng tôi. Tuy nhiên, các thông tin mua hàng phải là thông tin xác thực nhằm phục vụ cho việc giao hàng được diễn ra hiệu quả. Trong trường hợp quý khách hàng có tạo tài khoản trên web của chúng tôi, thông tin truy cập của quý khách phải là thông tin xác thực về bản thân và cần cập nhật lại nếu có thay đổi. Mỗi người truy cập phải có trách nhiệm với mật khẩu, tài khoản và hoạt động của mình trên web. Hơn nữa, khi tài khoản bị truy cập trái phép, quý khách hàng phải thông báo cho chúng tôi biết. Chúng tôi không chịu bất kỳ trách nhiệm nào, dù trực tiếp hay gián tiếp, đối với những thiệt hại hoặc mất mát gây ra do quý khách không tuân thủ quy định.</li>
								<li>Nếu không được chúng tôi cho phép bằng văn bản, việc sử dụng bất kỳ phần nào của website này với mục đích thương mại hoặc nhân danh bất kỳ đối tác thứ ba nào đều hoàn toàn bị nghiêm cấm. Nếu vi phạm bất cứ điều nào trong đây, tài khoản của quý khách sẽ bị chúng tôi hủy mà không cần báo trước</li>
							</ol>
							<h3>3. Chấp nhận đơn hàng và giá cả</h3>
							<p>Chúng tôi có thể liên hệ với quý khách hỏi thêm về số điện thoại và địa chỉ trước khi xác nhận đơn hàng. Vì bất kỳ lý do gì liên quan đến lỗi kỹ thuật, hệ thống một cách khách quan vào bất kỳ lúc nào, chúng tôi có quyền từ chối hoặc hủy đơn hàng của quý khách.</p>
							<h3>4. Thương hiệu và bản quyền</h3>
							<p>Mọi quyền sở hữu trí tuệ (đã đăng ký hoặc chưa đăng ký), nội dung thông tin và tất cả các thiết kế, văn bản, đồ họa, phần mềm, hình ảnh, video, âm nhạc, âm thanh, biên dịch phần mềm, mã nguồn và phần mềm cơ bản đều là tài sản của chúng tôi. Toàn bộ nội dung của trang web được bảo vệ bởi luật bản quyền của Việt Nam và các công ước quốc tế. Bản quyền đã được bảo lưu.</p>
						</div>
					</div>
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
</body>
<?php require_once('footer.php'); ?>