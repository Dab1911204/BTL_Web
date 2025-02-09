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

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li style="display: inline;"><a href="./index.php">Trang chủ</a></li>
                <li class='active'>Giỏ hàng</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Xóa</th>
                                    <th class="cart-description item">Hình ảnh</th>
                                    <th class="cart-product-name item">Tên sản phẩm</th>
                                    <th class="cart-qty item">Số lượng</th>
                                    <th class="cart-sub-total item">Giá</th>
                                    <th class="cart-total last-item">Tổng tiền</th>
                                </tr>
                            </thead><!-- /thead -->

                            <form action="" method="post" target="hidden_iframe">
                                <tbody>
                                    <?php
                                    $sqlhienthigh = "SELECT gh.maSanPham, sp.tenSanPham, sp.donGia ,sp.anhSanPham, gh.soLuong,sp.soLuong as soLuongSanPham FROM giohang as gh inner join sanpham as sp on gh.maSanPham = sp.maSanPham where gh.maKhachHang = '$maKhachhang'";
                                    $result = mysqli_query($conn, $sqlhienthigh);
                                    $tongthanhtoan = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $soluong = $row['soLuong'];
                                        $tongGia = $soluong * $row['donGia'];
                                        $maSanPham_in_cart = $row['maSanPham'];
                                        $soluongSanPham = $row['soLuongSanPham'];
                                        $tongthanhtoan = $tongthanhtoan + $tongGia;
                                        
                                    ?>

                                        <tr>
                                            <td class="romove-item"><a href="remove-cart.php?id=<?php echo $maSanPham_in_cart?>" class="btn icon" style="background-color: red; color:#fff;"><i class="fa fa-trash-o"></i></a></td>

                                            <td class="cart-image">
                                                <a class="entry-thumbnail" href="chitietsp.php">
                                                    <img src="../imgchung/<?php echo $row['anhSanPham'] ?>" alt="">
                                                </a>
                                            </td>
                                            <td class="cart-product-name-info">
                                                <h4 class='cart-product-description'><a href="chitietsp.php"><?php echo $row['tenSanPham'] ?></a></h4>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="input-group" style="max-width: 300px; margin-bottom: 20px;">
                                                    <input type="number" id="quantity-<?php echo $maSanPham_in_cart; ?>" data-makh="<?php echo $maKhachhang; ?>" data-masp="<?php echo $maSanPham_in_cart; ?>" value="<?php echo $soluong ?>" min="1" max="<?php echo $soluongSanPham?>" class="form-control quantity-input" style="font-size: 18px; text-align: center;">
                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo number_format($row['donGia'], 0, '', '.') . " VNĐ" ?></span></td>
                                            <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo number_format($tongGia, 0, '', '.') . " VNĐ"  ?> </span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="6">
                                            <div class="shopping-cart-btn">
                                                <span class="">
                                                    <a href="./index.php" class="btn btn-upper btn-primary outer-left-xs">Về lại trang chủ</a>
                                                    <a href="./dathang.php" class="btn btn-upper btn-primary pull-right outer-right-xs">Thanh toán</a>
                                                    <h4 class="pull-right" style="margin-right: 30px;"><?php echo number_format($tongthanhtoan, 0, '', '.') . " VNĐ"?> </h4>
                                                    <h4 class="pull-right" style="margin-right: 10px;">Tổng thanh toán:</h4>
                                                </span>
                                            </div><!-- /.shopping-cart-btn -->
                                        </td>
                                    </tr>
                                </tbody><!-- /tbody -->

                            </form>


                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
<br>
<br>
<?php
require_once('footer.php');
?>





<!-- AJAX Script to handle quantity update -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.quantity-input').on('change', function() {
            var maKhachHang = $(this).data('makh');
            var maSanPham = $(this).data('masp');
            var soLuongMoi = $(this).val();

            $.ajax({
                url: 'update_cart.php',
                type: 'POST',
                data: {
                    maKhachHang: maKhachHang,
                    maSanPham: maSanPham,
                    soLuongMoi: soLuongMoi
                },
                success: function(response) {
                    if (response == 'success') {
                        location.reload(); // Tải lại trang để cập nhật hiển thị giỏ hàng
                    } else {
                        alert('Cập nhật số lượng thất bại. Vui lòng thử lại.');
                    }
                }
            });
        });
    });
</script>