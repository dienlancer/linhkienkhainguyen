<?php
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
					<li class="active"><?php the_title(); ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_REQUEST['MaDonHang'])) {
	$ma = sanitize_text_field($_REQUEST['MaDonHang']);
	global $wpdb;
    $cart = $wpdb->get_row("SELECT * FROM ls_cart WHERE madonhang = '" . $ma . "'");
    if(isset($cart->id) && $cart->trangthai != "-1"){
    	$ngaydat = $cart->ngaydat;
    	$nnhoten = $cart->nnhoten;
    	$nntinhthanh = $cart->nntinhthanh;
    	$nnquanhuyen = $cart->nnquanhuyen;
    	$nndiachi = $cart->nndiachi;
    	$nndienthoai = $cart->nndienthoai;
    	$ghichu = $cart->ghichu;
    	$giagiam = $cart->giagiam;
    	$magiam = $cart->magiamgia;
    	
    	switch ($cart->trangthai) {
    		case -1:
    			$trangthai = "Đã hủy";
    			$matrangthai = -1;
    			break;

			case 1:
    			$trangthai = "Đã xác nhận";
    			$matrangthai = 1;
    			break;

    		case 2:
    			$trangthai = "Đang chờ";
    			$matrangthai = 2;
    			break;

    		case 3:
    			$trangthai = "Đang vận chuyển";
    			$matrangthai = 3;
    			break;

			case 4:
    			$trangthai = "Đã giao hàng";
    			$matrangthai = 4;
    			break;
    		case 5:
    			$trangthai = "Hoàn thành";
    			$matrangthai = 5;
    			break;
    		
    		case 0:
    			$trangthai = "Đơn hàng mới";
    			break;
    	}

        $cart_details = $wpdb->get_results('select * from ls_cart_detail where idgiohang = ' . $cart->id);
    }    
}
?>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				
			<?php 
			if (isset($_GET['MaDonHang'])) { ?>
				<div style="margin-bottom: 40px;">
					<a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) . "?sec=don-hang" ); ?>" style="color: #4885ed; font-size: 14px;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>TRỞ LẠI TRANG QUẢN LÝ TÀI KHOẢN</a>
				</div>
			<?php } else { ?>
				<div class="title">
					<h1 class="title-content"><?php the_title(); ?></h1>
				</div>
			

				<div class="main-detail">

					<div class="row">
						<div class="col-lg-7 col-lg-offset-4 col-md-7 col-md-offset-4 col-sm-7 col-sm-offset-4 col-xs-15">
						<?php if (isset($trangthai) && $trangthai == "Đã hủy") { ?>
								<p class="common-p" style="font-size: 32px; font-weight: bold;">Đơn hàng đã hủy!</p>
						<?php } ?>
							<form method="POST" style="text-align: center;">
								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="MaDonHang" placeholder="Nhập Mã đơn hàng">
								</div>
								<button type="submit" class="btn btn-info button-mua-tiep" style="width: 150px; margin-bottom: 40px;">Kiểm Tra</button>
							</form>
							
						</div>
					</div>

				<?php } ?>
					

					<div style="padding-right: 15px; padding-left: 15px;">						
						<div class="row visible-lg hidden-md hidden-sm hidden-xs confirm-detail">
							<div class="col-lg-3">Mã đơn hàng</div>
							<div class="col-lg-3">Ngày đặt hàng</div>
							<div class="col-lg-3">Sản phẩm</div>
							<div class="col-lg-3">Tổng tiền</div>
							<div class="col-lg-3">Trạng thái</div>
						
						</div>

						<div class="row visible-lg hidden-md hidden-sm hidden-xs border-lrb">
							<div class="col-lg-3 link-red-color"><?php echo $ma ?></div>
							<div class="col-lg-3 common-p" style="font-weight: bold;"><?php echo date('d-m-Y') ?></div>
							<div class="col-lg-3">
						<?php 
							$sum_cost = 0;
					        foreach($cart_details as $cart_detail) {
					        	$sum_cost += $cart_detail->soluong * $cart_detail->gia;
					   //          global $post;
								// $post = get_post($cart_detail->proid); 
						?>
								<p class="p-detail-confirm"><?php echo get_the_title($cart_detail->proid); ?></p>
							<?php } ?>
							</div>
							<div class="col-lg-3 link-red-color" style="font-weight: bold;"><?php show_cost($sum_cost) ?></div>
							<div class="col-lg-3 link-color"><?php echo $trangthai ?></div>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="wrap border-lrbt visible-xs visible-md visible-sm hidden-lg">
						<div class="row">
						
							<div class="col-md-4 col-xs-6 col-sm-4 border-lrbt-col">Mã đơn hàng</div>
							<div class="col-md-11 col-xs-9 col-sm-11 border-lrbt-col link-red-color" style="font-weight: bold;">
								<?php echo $ma ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Ngày đặt hàng</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col common-p">
								<?php echo $ngaydat ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Sản phẩm</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col">
						<?php 
					        foreach($cart_details as $cart_detail) {
					   //          global $post;
								// $post = get_post($cart_detail->proid); 
						?>
								<p class="p-detail-confirm"><?php echo get_the_title($cart_detail->proid); ?></p>
							<?php } ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Tổng tiền</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col " style="font-weight: bold;">
								<?php show_cost($sum_cost) ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Trạng thái</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col link-color">
								<?php echo $trangthai ?>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>QUY TRÌNH VẬN CHUYỂN</div>
					<div class="row visible-lg hidden-md hidden-sm hidden-xs">
						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/don-hang-moi.png') ?>">
							<div class="quy-trinh-text quy-trinh-text-active">Đơn hàng mới</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh line-quytrinh-active">&nbsp;</div>
						</div>


						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-xac-nhan.png') ?>">
							<div class="quy-trinh-text <?php if (in_array($matrangthai, array(1, 3, 4))) {
								echo 'quy-trinh-text-active';
							} ?>">Đã xác nhận</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh <?php if (in_array($matrangthai, array(1, 3, 4))) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-van-chuyen.png') ?>">
							<div class="quy-trinh-text <?php if (in_array($matrangthai, array(3, 4))) {
								echo 'quy-trinh-text-active';
							} ?>">Đang vận chuyển</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh <?php if (in_array($matrangthai, array(3, 4))) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-giao-hang.png') ?>">
							<div class="quy-trinh-text <?php if ($matrangthai == 4) {
								echo 'quy-trinh-text-active';
							} ?>">Đã giao hàng</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<div class="line-quytrinh <?php if ($matrangthai == 4) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title-last">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/hoan-thanh.png') ?>">
							<div class="quy-trinh-text <?php if ($matrangthai == 5) {
								echo 'quy-trinh-text-active';
							} ?>">Hoàn thành</div>
						</div>
					</div>

					<div class="row mobile-quytrinh-vanchuyen visible-xs visible-md visible-sm hidden-lg">
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/don-hang-moi.png') ?>">
							<span class="quy-trinh-text-mobile quy-trinh-text-active">Đơn hàng mới</span>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh line-quytrinh-active">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-xac-nhan.png') ?>">
							<span class="quy-trinh-text-mobile <?php if (in_array($matrangthai, array(1, 3, 4))) {
								echo 'quy-trinh-text-active';
							} ?>">Đã xác nhận</span>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh <?php if (in_array($matrangthai, array(1, 3, 4))) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-van-chuyen.png') ?>">
							<span class="quy-trinh-text-mobile <?php if (in_array($matrangthai, array(3, 4))) {
								echo 'quy-trinh-text-active';
							} ?>">Đang vận chuyển</span>
						</div>
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh <?php if (in_array($matrangthai, array(3, 4))) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-giao-hang.png') ?>">
							<span class="quy-trinh-text-mobile <?php if ($matrangthai == 4) {
								echo 'quy-trinh-text-active';
							} ?>">Đã giao hàng</span>
						</div>
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh <?php if ($matrangthai == 4) {
								echo 'line-quytrinh-active';
							} ?>">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/hoan-thanh.png') ?>">
							<span class="quy-trinh-text-mobile <?php if ($matrangthai == 5) {
								echo 'quy-trinh-text-active';
							} ?>">Hoàn thành</span>
						</div>						
					</div>

					<p class="common-p" style="margin-bottom: 40px; margin-top: 40px;">Chuyển sản phẩm đến địa chỉ của Người nhận khác (Khác với địa chỉ của chủ tài khoản)</p>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THÔNG TIN NGƯỜI NHẬN</div>

					<div class="row hoan-thanh-dia-chi">
						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Họ và tên</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $nnhoten ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Tỉnh | Thành phố</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $nntinhthanh ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Địa chỉ</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $nndiachi . ", " . $nnquanhuyen ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Số điện thoại</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $nndienthoai ?></div>
							</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="hoan-thanh-dia-chi-title">
								Ghi chú đơn hàng
							</div>
							<div class="hoan-thanh-dia-chi-text-special">
								<?php echo $ghichu ?>
							</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="hoan-thanh-dia-chi-title">
								Phương thức thanh toán
							</div>
							<div class="hoan-thanh-dia-chi-text">
								Thanh toán tại địa chỉ nhận sản phẩm (COD).
							</div>
							<a href="" class="link-color">Xem chi tiết Phương thức thanh toán</a>
						</div>
					</div>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>GIỎ HÀNG CỦA BẠN</div>

					<div class="row main-detail">
						<div class="col-lg-11 col-sm-9 col-xs-15 cart-left">
							<div class="row cart-detail-title">
								<div class="col-lg-6 col-sm-15 col-xs-15">Thông tin sản phẩm</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Đơn giá</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Số lượng</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Thành tiền</div>
							</div>

					<?php 
						$sum_cost = 0;
                    	foreach($cart_details as $cart_detail) {
                    		$sum_cost_id = $cart_detail->gia * $cart_detail->soluong;
                    		$sum_cost += $sum_cost_id;
      //                   global $post;
						// $post = get_post($cart_detail->proid);
					?>
						<div class="row cart-detail">
							<div class="col-lg-6 col-sm-15 col-xs-15 col-left-top-portable">
								<div class="col-left-cart">
									<img src="<?php echo get_the_post_thumbnail_url($cart_detail->proid, 'full') ?>" class="img-cart">
								</div>

								<div class="col-right-cart">
									<a href="<?php echo get_permalink($cart_detail->proid) ?>"><div class="detail-title-product"><?php echo get_the_title($cart_detail->proid); ?></div></a>
									<!-- <div class="detail-meta-product">Kích cỡ: 14</div> -->
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Đơn giá</div>
								<div class="col-for-portable-right"><?php show_cost($cart_detail->gia); ?></div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Số lượng</div>
								<div class="col-for-portable-right">
									<?php echo $cart_detail->soluong; ?>
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Thành tiền</div>
								<div class="col-for-portable-right thanh-toan-sum" id="sp-<?php echo $product_id ?>" data-gia="<?php echo $dongia; ?>"><?php show_cost($sum_cost_id); ?></div>
							</div>
						</div>
						<?php }  ?>
					
						</div>

						<div class="col-lg-4 col-sm-6 col-xs-15 cart-right">
							<div class="row detail-price">
								<div class="col-lg-8 col-sm-8 col-xs-8 price-label" style="margin-top: 0px;">Tạm tính</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content" style="margin-top: 0px;"><?php show_cost($sum_cost); ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Phí vận chuyển</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content">0đ</div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Mã giảm giá</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php echo $magiam ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Giá giảm</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php show_cost($giagiam); ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 sum-price-label">TỔNG TIỀN</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 sum-price-content"><?php show_cost($sum_cost - $giagiam); ?></div>
							</div>
						</div>						
					</div>
				</div> <!-- End Content -->
			</div>
		</div>
	</div>
</div>



<?php
//get_sidebar();
get_footer();
