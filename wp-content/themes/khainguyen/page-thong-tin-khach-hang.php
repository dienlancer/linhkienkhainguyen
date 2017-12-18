<?php
// session_start();
// if (isset($_SESSION['user']['id'])) {
// 	wp_redirect(esc_url( home_url( '/' )));
// 	// wp_redirect(esc_url( $_SERVER['HTTP_REFERER']));
// 	exit();
// }
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

if (empty($_SESSION['user'])) {
	// $_SESSION['user']['id'] = "";
	$_SESSION['user']['HoTen'] = "";
	$_SESSION['user']['TinhThanh'] = "";
	$_SESSION['user']['QuanHuyen'] = "";
	$_SESSION['user']['DiaChi'] = "";
	$_SESSION['user']['DienThoai'] = "";
	$_SESSION['user']['Email'] = "";

	$_SESSION['user']['NNHoTeN'] = "";
	$_SESSION['user']['NNTinhThanh'] = "";
	$_SESSION['user']['NNQuanHuyen'] = "";
	$_SESSION['user']['NNDiaChi'] = "";
	$_SESSION['user']['NNDienThoai'] = "";
	$_SESSION['user']['Giau'] = "";
	$_SESSION['user']['GhiChu'] = "";
	$_SESSION['user']['DiemNhan'] = "ChuTaiKhoan";
}
// unset($_SESSION['user']);
?>


<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">			
				<div class="title">
					<h1 class="title-content"><?php the_title(); ?></h1>
				</div>
				<div class="main-detail">
					<p class="hidden-sm hidden-xs hidden-md visible-lg">
						Nếu bạn đã có tài khoản, xin vui lòng <a href="<?php $page = get_page_by_title( 'Đăng nhập' ); echo esc_url( get_page_link($page->ID) ); ?>" class="link-color">ĐĂNG NHẬP</a> để mua hàng. Nếu bạn chưa là thành viên của The Bealux, hãy <a href="<?php $page = get_page_by_title( 'Đăng ký tài khoản' ); echo esc_url( get_page_link($page->ID) ); ?>" class="link-red-color">ĐĂNG KÝ</a> để có những ưu đãi dành riêng cho thành viên. Xem thêm <a href="<?php $page = get_page_by_title( 'Chính sách thành viên' ); echo esc_url( get_page_link($page->ID) ); ?>" class="link-color">Chính sách thành viên</a>.
					</p>
					<p class="hidden-sm hidden-xs hidden-md visible-lg" style="margin-bottom: 0px;">Bạn cũng có thể mua hàng nhanh mà <b>không cần đăng ký thành viên</b>, chỉ cần điền đầy đủ thông tin bên dưới để chúng tôi xác nhận và giao hàng.</p>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>CHỌN ĐỊA ĐIỂM NHẬN SẢN PHẨM</div>
					<?php $page = get_page_by_title( 'Hoàn thành đơn hàng' );  ?>
					<form method="POST" action="<?php echo esc_url( get_page_link($page->ID) ) ?>">
						<div class="radio disabled">
							<label class="thong-tin-khach-hang-lable">
								<input type="radio" class="DiaDiem" name="DiaDiem" value="Shop" disabled>
								Nhận sản phẩm tại địa chỉ Shop The Bealux
							</label>
						</div>

						<div class="radio">
							<label class="thong-tin-khach-hang-lable">
								<input type="radio" class="DiaDiem" name="DiaDiem" value="ChuTaiKhoan" >
								Chuyển sản phẩm đến địa chỉ của Người mua
							</label>
						</div>

						<div class="radio">
							<label class="thong-tin-khach-hang-lable">
								<input type="radio" class="DiaDiem" name="DiaDiem" value="Khac">
								Chuyển sản phẩm đến địa chỉ của Người nhận khác
							</label>
						</div>

						<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THÔNG TIN CẦN BIẾT</div>					

						<div class="row">
							<div class="col-lg-5 col-sm-15 col-xs-15">
								<div class="thong-tin-khach-hang-title">
									Thông tin Người mua
								</div>
								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="HoTen" placeholder="Họ và tên" value="<?php echo $_SESSION['user']['HoTen'] ?>">
								</div>

								<div class="form-group">
									<select class="form-control" name="City" id="Tinh-ThanPho">
									<?php // if(isset($_SESSION['user']['TinhThanh'])) { 
					//	echo '<option value="' . $_SESSION['user']['TinhThanh'] . '">' . $_SESSION['user']['TinhThanh'] . '</option>'; }?>
									</select>
								</div>

								<div class="form-group">
									<select class="form-control" name="District" id="Quan-Huyen">
									<?php //if(isset($_SESSION['user']['QuanHuyen'])) { 
						//echo '<option value="' . $_SESSION['user']['QuanHuyen'] . '">' . $_SESSION['user']['QuanHuyen'] . '</option>'; }?>
									</select>
								</div>

								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="DiaChi" placeholder="Số nhà, tên đường" value="<?php echo $_SESSION['user']['DiaChi'] ?>">
								</div>

								<div class="form-group">
									<input type="text" class="form-control new-padding-info DienThoai" name="DienThoai" placeholder="Số điện thoại" value="<?php echo $_SESSION['user']['DienThoai'] ?>">
								</div>

								<div class="form-group">
									<input type="email" class="form-control new-padding-info" name="Email" placeholder="Email" value="<?php echo $_SESSION['user']['Email'] ?>" <?php if (isset($_SESSION['user']['id'])) {echo "disabled";} ?>>
								</div>								

							</div>

							<div class="col-lg-5 col-sm-15 col-xs-15">
								<div class="Info-NguoiNhan">								
								
									<div class="thong-tin-khach-hang-title thong-tin-khach-hang-title-portable">
										Thông tin Người nhận
									</div>
									<div class="form-group">
										<input type="text" class="form-control new-padding-info" name="NNHoTen" placeholder="Họ và tên" value="<?php echo $_SESSION['user']['NNHoTen'] ?>">
									</div>

									<div class="form-group">
										<select class="form-control" name="NNCity" id="Tinh-ThanPhoNN">
										<?php //if(isset($_SESSION['user']['NNTinhThanh'])) { 
						//echo '<option value="' . $_SESSION['user']['NNTinhThanh'] . '">' . $_SESSION['user']['NNTinhThanh'] . '</option>'; }?>
										</select>
									</div>

									<div class="form-group">
										<select class="form-control" name="NNDistrict" id="Quan-HuyenNN">
										<?php //if(isset($_SESSION['user']['NNQuanHuyen'])) { 
						//echo '<option value="' . $_SESSION['user']['NNQuanHuyen'] . '">' . $_SESSION['user']['NNQuanHuyen'] . '</option>'; }?>
										</select>
									</div>

									<div class="form-group">
										<input type="text" class="form-control new-padding-info" name="NNDiaChi" placeholder="Số nhà, tên đường" value="<?php echo $_SESSION['user']['NNDiaChi'] ?>">
									</div>

									<div class="form-group">
										<input type="text" class="form-control new-padding-info DienThoai" name="NNDienThoai" placeholder="Số điện thoại" value="<?php echo $_SESSION['user']['NNDienThoai'] ?>">
									</div>
									<div class="form-group">
										<div class="checkbox">
											<label class="thong-tin-khach-hang-lable">
												<input type="checkbox" value="checked" <?php echo $_SESSION['user']['Giau'] ?> name="GiauThongTin">
												Giấu thông tin người gửi
											</label>
										</div>
									</div>
								</div>

								<div class="thong-tin-khach-hang-title thong-tin-khach-hang-title-portable">
									Ghi chú đơn hàng
								</div>
								<div class="form-group">
									<textarea class="form-control" rows="4" name="GhiChu"><?php echo $_SESSION['user']['GhiChu'] ?></textarea>
								</div>
								
							</div>

							<div class="col-lg-5 col-sm-15 col-xs-15">
								<div class="thong-tin-khach-hang-title thong-tin-khach-hang-title-portable">
									Phương thức thanh toán
								</div>
								<p>Thanh toán tại đỉa chỉ nhận sản phẩm (COD)</p>
								<p>Xem chi tiết <a href="<?php $page = get_page_by_title( 'Phương thức thanh toán' ); echo esc_url( get_page_link($page->ID) ); ?>" class="link-color">Phương thức thanh toán</a></p>
								
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
						$gia_tri = 0;
						if(count($_SESSION['cart'])){
							foreach ($_SESSION['cart'] as $product_id=>$r) {  

							    $sum_cost_id = 0;
							    $so_luong = $r['number'];

							    if(is_sale_off($product_id)){
							        $dongia = get_stand_cost($product_id);                     
							    } else {
							        $dongia = get_ori_stand_cost($product_id);
							    }


							    $sum_cost_id = $so_luong * $dongia; 
							    $gia_tri += $sum_cost_id;
					?>
						<div class="row cart-detail">
							<div class="col-lg-6 col-sm-15 col-xs-15 col-left-top-portable">
								<div class="col-left-cart">
									<img src="<?php echo get_the_post_thumbnail_url($product_id, 'full') ?>" class="img-cart">
								</div>

								<div class="col-right-cart">
									<a href="<?php echo get_permalink($product_id) ?>"><div class="detail-title-product"><?php echo get_the_title($product_id); ?></div></a>
									<!-- <div class="detail-meta-product">Kích cỡ: 14</div> -->
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Đơn giá</div>
								<div class="col-for-portable-right"><?php show_cost($dongia); ?></div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Số lượng</div>
								<div class="col-for-portable-right">
									<?php echo $so_luong; ?>
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Thành tiền</div>
								<div class="col-for-portable-right thanh-toan-sum" id="sp-<?php echo $product_id ?>" data-gia="<?php echo $dongia; ?>"><?php show_cost($sum_cost_id); ?></div>
							</div>
						</div>
						<?php } } ?>

					
							</div> 

							<div class="col-lg-4 col-sm-6 col-xs-15 cart-right">
								<div class="row detail-price">
									<div class="col-lg-8 col-sm-8 col-xs-8 price-label" style="margin-top: 0px;">Tạm tính</div>
									<div class="col-lg-7 col-sm-7 col-xs-7 price-content" style="margin-top: 0px;"><?php show_cost($gia_tri); ?></div>

									<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Phí vận chuyển</div>
									<div class="col-lg-7 col-sm-7 col-xs-7 price-content">0đ</div>

									<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Mã giảm giá</div>
									<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php echo $_SESSION['code']['code_ls']; ?></div>

									<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Giá giảm</div>
									<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php show_cost($_SESSION['code']['gia_giam_ls']); ?></div>

									<div class="col-lg-8 col-sm-8 col-xs-8 sum-price-label">TỔNG TIỀN</div>
									<div class="col-lg-7 col-sm-7 col-xs-7 sum-price-content"><?php show_cost($gia_tri - $_SESSION['code']['gia_giam_ls']); ?></div>
								</div>
							</div>

							<div class="col-lg-15 col-sm-15 col-xs-15 group-button-thanhtoan">
								<a href="<?php $page = get_page_by_title( 'Giỏ hàng của bạn' ); echo esc_url( get_page_link($page->ID) ); ?>">
								<button type="button" class="btn btn-default button-quay-ve-gio-hang">QUAY VỀ GIỎ HÀNG</button></a>
								<button type="submit" class="btn btn-success button-gui-don-hang">GỬI ĐƠN HÀNG</button>
							</div>

							
						</div>
				
					</form>
						

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
		var thanh_phos = <?php json_tinh_thanh()?>;
		for (var tp in thanh_phos) {
			jQuery("#Tinh-ThanPho").append("<option value='"+tp+"'>"+tp+"</option>");
			jQuery("#Tinh-ThanPhoNN").append("<option value='"+tp+"'>"+tp+"</option>");
		}
		jQuery('#Tinh-ThanPho option[value="<?php echo $_SESSION['user']['TinhThanh'] ?>"]').prop('selected', true);

		jQuery("#Tinh-ThanPho").change(function() {				
			var key_tp = jQuery(this).val();
			jQuery("#Quan-Huyen").html("");
			if(key_tp.length > 1) {
				var phuongs = thanh_phos[key_tp];			
				for (var i=0; i< phuongs.length; i++) {
					jQuery("#Quan-Huyen").append("<option value='" +phuongs[i]+ "'>"+phuongs[i]+"</option>");
				}
			}
		}).change();

		jQuery('#Quan-Huyen option[value="<?php echo $_SESSION['user']['QuanHuyen'] ?>"]').prop('selected', true);

		jQuery('#Tinh-ThanPhoNN option[value="<?php echo $_SESSION['user']['NNTinhThanh'] ?>"]').prop('selected', true);

		jQuery("#Tinh-ThanPhoNN").change(function() {				
			var key_tp = jQuery(this).val();
			// alert(key_tp);
			var phuongs = thanh_phos[key_tp];
			jQuery("#Quan-HuyenNN").html("");

			for (var i=0; i< phuongs.length; i++) {
				jQuery("#Quan-HuyenNN").append("<option value='" +phuongs[i]+ "'>"+phuongs[i]+"</option>");
			}
		}).change();

		jQuery('#Quan-HuyenNN option[value="<?php echo $_SESSION['user']['NNQuanHuyen'] ?>"]').prop('selected', true);

		jQuery(".Info-NguoiNhan").hide();

		jQuery("input.DiaDiem[value='<?php echo $_SESSION['user']['DiemNhan']?>']").prop( "checked", true );

	    jQuery(".DiaDiem").change(function(){
	    	if (jQuery(this).val() == "Shop" || jQuery(this).val() == "ChuTaiKhoan") {
	    		jQuery(".Info-NguoiNhan").hide();
	    	} else {
	    		jQuery(".Info-NguoiNhan").show();
	    	};

	    });

	    var vcheck = jQuery(".DiaDiem:checked").val();

		if (vcheck == "Shop" || vcheck == "ChuTaiKhoan") {
			jQuery(".Info-NguoiNhan").hide();
		} else {
			jQuery(".Info-NguoiNhan").show();
		};

		jQuery(".DienThoai").keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl/cmd+A
	            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: Ctrl/cmd+C
	            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: Ctrl/cmd+X
	            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
	});
</script>

<?php
//get_sidebar();
get_footer();
