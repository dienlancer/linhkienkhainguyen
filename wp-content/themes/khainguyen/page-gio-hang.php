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



<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<div class="title">
					<h1 class="title-content"><?php the_title(); ?></h1>
				</div>

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
									<a href="" class="cart-del" data-id="<?php echo $product_id; ?>">Xóa</a>

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
									<div class="design-number">
										<span class="sub-number">-</span>
										<input type="text" class="value-number" value="<?php echo $so_luong; ?>" name="number[]" data-id="<?php echo $product_id; ?>" maxlength="2" max-value="<?php echo get_post_meta($product_id, "so_luong_con_lai", true) ?>">
										<span class="add-number">+</span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Thành tiền</div>
								<div class="col-for-portable-right thanh-toan-sum" id="sp-<?php echo $product_id ?>" data-gia="<?php echo $dongia; ?>"><?php show_cost($sum_cost_id); ?></div>
							</div>
						</div>
						<?php } } ?>


						<script type="text/javascript">
							jQuery( document ).ready(function() {
								jQuery('.sub-number').click(function() {
									var value = jQuery(this).parent().find('.value-number').val();
									value = parseInt(value) - 1;
									if (value < 1) {
										jQuery(this).parent().find('.value-number').val(1);
										value = 1;
									} else {
										jQuery(this).parent().find('.value-number').val(value);
									}

									var id = jQuery(this).parent().find('.value-number').attr('data-id');
									var dongia = parseInt(jQuery("#sp-" + id ).attr('data-gia'));
									var tt = dongia * value;
									jQuery("#sp-" + id ).html(addCommas(tt).toString());
									sumTongTien();

									jQuery.post( "<?php the_permalink() ?>", {"add" : "update", "id-sp" : id, "number" : value } );
								});

								jQuery('.add-number').click(function() {
									var max_value = jQuery(this).parent().find('.value-number').attr('max-value');
									max_value = parseInt(max_value);
									var value = jQuery(this).parent().find('.value-number').val();
									value = parseInt(value) + 1;

									if (value > max_value) {
										jQuery(this).parent().find('.value-number').val(max_value);
										value = max_value;
									} else {
										jQuery(this).parent().find('.value-number').val(value);
									}

									var id = jQuery(this).parent().find('.value-number').attr('data-id');
									var dongia = parseInt(jQuery("#sp-" + id ).attr('data-gia'));
									var tt = dongia * value;
									// console.log(dongia);
									jQuery("#sp-" + id ).html(addCommas(tt).toString());
									sumTongTien();

									jQuery.post( "<?php the_permalink() ?>", {"add" : "update", "id-sp" : id, "number" : value } );
								});

								jQuery('.value-number').change(function() {
									var value = jQuery(this).val();
									if (value == 0) {
										jQuery(this).val(1);
										// value = 1;
									} 
									var max_value = jQuery(this).attr('max-value');
									max_value = parseInt(max_value);

									if (value > max_value) {
										jQuery(this).val(max_value);
										// value = max_value;
									} 
									value = jQuery(this).val();
									var id = jQuery(this).parent().find('.value-number').attr('data-id');
									var dongia = parseInt(jQuery("#sp-" + id ).attr('data-gia'));
									var tt = dongia * value;
									// console.log(dongia);
									jQuery("#sp-" + id ).html(addCommas(tt).toString());
									sumTongTien();

									jQuery.post( "<?php the_permalink() ?>", {"add" : "update", "id-sp" : id, "number" : value } );
								});

								jQuery(".value-number").keydown(function (e) {
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

							    jQuery('.cart-del').click(function() {
							    	var r = confirm('Bạn chắc chắn muốn xóa?');
							    	if (r) {
							    		jQuery(this).parent().parent().parent().remove();
							    		sumTongTien();
							    		var giohang = parseInt(jQuery('#gio-hang').attr('data-giohang')) - 1;

							    		jQuery('#gio-hang').attr('data-giohang', giohang);

										jQuery('#gio-hang').html(giohang + " sản phẩm");
										var id = jQuery(this).attr('data-id');
										jQuery.post( "<?php the_permalink() ?>", {"add" : "del", "id-sp" : id } );
							    	}
							    	
							    	return false;
							    });

							    function addCommas(nStr) {
								    nStr += '';
								    x = nStr.split(',');
								    x1 = x[0];
								    x2 = x.length > 1 ? ',' + x[1] : '';
								    var rgx = /(\d+)(\d{3})/;
								    while (rgx.test(x1)) {
								        x1 = x1.replace(rgx, '$1' + '.' + '$2');
								    }
								    return x1 + x2 + "đ";
								}

								function sumTongTien() {
									var tong = 0;
									jQuery('.thanh-toan-sum').each(function(){
										var str = jQuery(this).html();
										console.log(str);
										str = str.replace("đ", "");
										str = str.replace(/\./g, "");
										console.log(str);
										tong += parseInt(str);
							    	});

							    	tong -= parseInt(<?php echo $_SESSION['code']['gia_giam_ls'] ?>);

							    	jQuery('#tam-tinh').html(addCommas(tong.toString()));
							    	jQuery('#tong-tien').html(addCommas(tong.toString()));
								}
															    
							});
						</script>						
					</div>

					<div class="col-lg-4 col-sm-6 col-xs-15 cart-right">
						<form class="form-horizontal" method="POST">
							<div class="row">
								<div class="col-lg-10 col-sm-9 col-xs-10">
									<input type="text" class="form-control" name="sale-off-code" placeholder="Mã giảm giá">
								</div>
								<div class="col-lg-5 col-sm-6 col-xs-5" style="padding-left: 0px;">
									<button type="submit" class="btn btn-default design-button">Áp dụng</button>
								</div>
							</div>
						</form>

						<div class="row detail-price">
							<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Tạm tính</div>
							<div class="col-lg-7 col-sm-7 col-xs-7 price-content" id="tam-tinh"><?php show_cost($gia_tri); ?></div>

							<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Phí vận chuyển</div>
							<div class="col-lg-7 col-sm-7 col-xs-7 price-content">0đ</div>

							<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Mã giảm giá<br/><span style="font-size: 12px;">(Bỏ trống và Áp dụng để Xóa)</span></div>
							<div class="col-lg-7 col-sm-7 col-xs-7 price-content" data-giamgia="<?php echo $_SESSION['code']['gia_giam_ls']; ?>"><?php if (isset($_SESSION['code']['thong_bao'])) { echo $_SESSION['code']['thong_bao']; unset($_SESSION['code']['thong_bao']); } else show_cost($_SESSION['code']['gia_giam_ls']); ?></div>

							<div class="col-lg-8 col-sm-8 col-xs-8 sum-price-label">TỔNG TIỀN</div>
							<div class="col-lg-7 col-sm-7 col-xs-7 sum-price-content" id="tong-tien"><?php show_cost($gia_tri - $_SESSION['code']['gia_giam_ls']); ?></div>
						</div>
					</div>

					<div class="col-lg-15 col-sm-15 col-xs-15 group-button-thanhtoan">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="remove-hover">
							<button type="button" class="btn btn-info button-mua-tiep"><i class="fa fa-long-arrow-left" aria-hidden="true" style="margin-right: 5px;"></i>CHỌN THÊM SẢN PHẨM</button>
						</a>
						<a href="<?php $page = get_page_by_title( 'Thông tin khách hàng' ); echo esc_url( get_page_link($page->ID) ); ?>">
							<button type="button" class="btn btn-danger button-thanh-toan">TIẾN HÀNH THANH TOÁN</button>
						</a>
					</div>

					
				</div>
			
			</div>
		</div>
	</div>
</div>



<?php
//get_sidebar();
get_footer();
