<?php
// include TEMPLATEPATH . '/single-blog.php';
// exit();
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
					<!-- <li><a href="#">Library</a></li> -->
					<li class="active"><?php the_title(); ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>



<div class="container-fluid">
	<div class="wrap main-content single-page">
		<div class="row">
			<div class="col-lg-11 col-sm-15 col-xs-15">
		<?php
		if ( have_posts() ) :
			$current_id = get_the_id();
			while ( have_posts() ) : the_post();
			set_post_views(get_the_ID());
		?>

				<div class="row">
					<div class="col-lg-7 col-sm-7 detail-sm col-xs-15">
						<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" class="img-detail">

					</div>

					<div class="col-lg-8 col-sm-8 detail-sm col-xs-15">
						<h1 class="detail-title"><?php the_title(); ?></h1>
						<div class="sku">SKU: <?php echo get_post_meta($id, "sku", true); ?></div>
						<p class="meta-info"><?php echo get_post_meta($id, "thong_tin_them", true); ?></p>
					<?php 
						if (is_sale_off(get_the_id())) {
					?>
						<div class="detail-price"><?php show_cost(get_stand_cost(get_the_id())) ?><span class="detail-price-sale"><?php percent_cost(get_the_id()) ?></span></div>
						<div class="detail-cost-sale"><?php show_cost(get_ori_stand_cost(get_the_id())) ?></div>
					<?php 
						} else {
							echo '<div class="detail-price">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</div>';
						}

						if (get_post_meta($id, "so_luong_con_lai", true) > 0) {
							echo '<div class="con-hang">CÒN HÀNG</div>';
					?>
						<div class="design-number">
							<span class="size-title">Chọn số lượng</span>
							<span class="sub-number">-</span>
							<input type="text" class="value-number" maxlength="2" value="1" name="number" id="number">
							<span class="add-number">+</span>
						</div>
					
						
						
						<!-- <div class="size">
							<span class="size-title">Chọn kích cỡ</span>
							<span class="size-number size-number-active">38</span>
							<span class="size-number">38</span>
						</div> -->

						

						<input type="hidden" name="id-sp" id="id-sp" value="<?php the_ID(); ?>">
						<button type="button" id="add" class="btn btn-danger button-them-hang"><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right: 10px;"></i>THÊM VÀO GIỎ HÀNG</button>
					<?php
						} else {
							echo '<div class="het-hang">HẾT HÀNG</div>';
						}
					?>

						<div class="social clearfix">
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>

							<div class="fb-send" data-href="<?php the_permalink() ?>"></div>
							<div class="fb-like" data-href="<?php the_permalink() ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
							<div class="google">
								<g:plusone ></g:plusone>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-15 col-xs-15 col-detail-right">
				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>HỖ TRỢ MUA HÀNG</div>

				<a href="tel:<?php echo get_option('phone_number') ?>" class="single-hotro">			
					<button type="button" class="btn btn-info button-header-phone"><i class="fa fa-mobile" aria-hidden="true"></i><?php echo get_option('phone_number') ?></button>
				</a>

				<a href="" class="single-hotro">					
					<button type="button" class="btn btn-info button-header-phone button-support "><img src="<?php echo esc_url(get_template_directory_uri() . '/images/zalo-icon.png') ?>">Gửi tin nhắn Zalo</button>
				</a>

				<a href="" class="single-hotro">					
					<button type="button" class="btn btn-info button-header-phone button-support "><img src="<?php echo esc_url(get_template_directory_uri() . '/images/facebook-messenger-icon.png') ?>">Gửi tin nhắn Facebook</button>
				</a>
				

				<a href="<?php $page = get_page_by_title( 'Hướng dẫn mua hàng' ); echo esc_url( get_page_link($page->ID) ); ?>" class="detail-link-huong-dan link-light-gray-color">Hướng dẫn mua hàng</a>
				<a href="<?php $page = get_page_by_title( 'Chi phí vận chuyển' ); echo esc_url( get_page_link($page->ID) ); ?>" class="detail-link-huong-dan link-light-gray-color">Chi phí vận chuyển</a>

				<a href="<?php $page = get_page_by_title( 'Chính sách đổi trả' ); echo esc_url( get_page_link($page->ID) ); ?>" class="detail-link-huong-dan link-light-gray-color">Chính sách đổi trả</a>
				<a href="<?php $page = get_page_by_title( 'Thông tin thanh toán' ); echo esc_url( get_page_link($page->ID) ); ?>" class="detail-link-huong-dan link-light-gray-color">Thông tin thanh toán</a>

				<p style="color: #333; font-size: 14px; margin-top: 20px;">Nếu bạn có nhu cầu mua sỉ hoặc hợp tác với chúng tôi, vui lòng liên hệ qua enail: <span style="color: #4885ed;"><?php echo get_option('email') ?></span></p>

			</div>
		</div>

		<div class="row meta-detail-section">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THÔNG TIN SẢN PHẨM</div>
				<?php the_content() ?>
			</div>
		</div>
	<?php 
		endwhile; 
		wp_reset_postdata();
		endif;
	?>
		<script type="text/javascript">
			jQuery( document ).ready(function() {
				jQuery('#add').click(function() {
					var id = jQuery('#id-sp').val();
					var sl = jQuery('#number').val();

					// var giohang = parseInt(<?php echo count($_SESSION['cart']); ?>);// + 1;
					// alert(id + " " + sl);
					jQuery.post( "<?php the_permalink() ?>", {"add" : "add", "id-sp" : id, "number" : sl } ).done(function( data ) {
    					jQuery('#gio-hang').html(data + " sản phẩm");
  					});;
					jQuery('#success-buy').show("low");
					setTimeout(function(){ 
						jQuery('#success-buy').fadeOut() 
					}, 5000);

					// var giohang = parseInt(<?php echo count($_SESSION['cart']); ?>) + 1;
					
				});


				jQuery('.sub-number').click(function() {
					var value = jQuery(this).parent().find('.value-number').val();
					value = parseInt(value) - 1;
					if (value < 1) {
						jQuery(this).parent().find('.value-number').val(1);
					} else {
						jQuery(this).parent().find('.value-number').val(value);
					}
				});

				var max_value = "<?php echo get_post_meta($id, "so_luong_con_lai", true) ?>";
				max_value = parseInt(max_value);

				jQuery('.add-number').click(function() {
					var value = jQuery(this).parent().find('.value-number').val();
					value = parseInt(value) + 1;
					if (value > max_value) {
						jQuery(this).parent().find('.value-number').val(max_value);
					} else {
						jQuery(this).parent().find('.value-number').val(value);
					}
				});

				jQuery('.value-number').change(function() {
					var value = jQuery(this).val();
					if (value == 0) {
						jQuery(this).val(1);
					} 

					if (value > max_value) {
						jQuery(this).val(max_value);
					} 
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

			});
		</script>	

		<div class="row meta-detail-section">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<div class="title">
					<div class="title-content">Sản phẩm cùng loại</div>
				</div>

				<div class="row">
		<?php
			// $catid = get_queried_object()->term_id;
			$terms =  wp_get_object_terms( $current_id, 'chuyen-muc', array('fields'=>'ids'));
			// print_r($terms);
			$ar  = array(
						// 'cat' => $catid, 
						'posts_per_page' => '5',
						'post__not_in' => array( $current_id),
						'post_type' => 'san-pham',
						'tax_query' => array(
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $terms[0],
							),
						),
					);
			$sps = new WP_Query( $ar );
			$i = 0;
			while ( $sps->have_posts() ) {
				$sps->the_post();
				if ($i == 4) {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile hidden-md hidden-sm hidden-xs">';
				} else {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile">';
				}
		?>
					
						<div class="product-contain">
							<a href="<?php the_permalink() ?>">								
								<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" class="pr-image">
							</a>
							<?php 
							if (is_sale_off(get_the_id())) {
								echo '<div class="sale-off">' . get_percent_cost(get_the_id()) . '</div>';
								echo '<div class="price">' . get_show_cost(get_stand_cost(get_the_id())) . '<span class="price-sale">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</span></div>';
							} else {
								echo '<div class="price">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</div>';
							}
						?>
							<div class="pr-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
						</div>
						
					</div>
		<?php 
			$i++;
			}
			wp_reset_postdata();
		?>

				</div>
				<!-- End Sản phẩm cùng loại -->

				<div class="title margin-top-40">
					<div class="title-content">Quan tâm nhiều nhất</div>
				</div>

				<div class="row">
		<?php
			// $terms =  wp_get_object_terms( $current_id, 'chuyen-muc', array('fields'=>'ids'));
			// print_r($terms);
			$ar  = array(
						// 'cat' => $catid, 
						'posts_per_page' => '5',
						'post__not_in' => array( $current_id),
						'post_type' => 'san-pham',
						// 'tax_query' => array(
						// 	array(
						// 		'taxonomy' => 'chuyen-muc',
						// 		'field'    => 'term_id',
						// 		'terms'    => $terms[0],
						// 	),
						// ),
						'meta_key' => 'post_views_count', 
						'orderby' => 'meta_value_num', 
						'order' => 'DESC'
					);
			$sps = new WP_Query( $ar );
			$i = 0;
			while ( $sps->have_posts() ) {
				$sps->the_post();
				if ($i == 4) {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile hidden-md hidden-sm hidden-xs">';
				} else {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile">';
				}
		?>
					
						<div class="product-contain">
							<a href="<?php the_permalink() ?>">								
								<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" class="pr-image">
							</a>
							<?php 
							if (is_sale_off(get_the_id())) {
								echo '<div class="sale-off">' . get_percent_cost(get_the_id()) . '</div>';
								echo '<div class="price">' . get_show_cost(get_stand_cost(get_the_id())) . '<span class="price-sale">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</span></div>';
							} else {
								echo '<div class="price">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</div>';
							}
						?>
							<div class="pr-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
						</div>
						
					</div>
		<?php 
			$i++;
			}
			wp_reset_postdata();
		?>

				</div>
				<!-- End Quan tâm nhiều nhất -->

		<?php  
			$terms =  wp_get_object_terms( $current_id, 'chuyen-muc', array('fields'=>'ids'));
			// print_r($terms);
			$ar  = array(
						// 'cat' => $catid, 
						'posts_per_page' => '5',
						'post__not_in' => array( $current_id),
						'post_type' => 'san-pham',
						'meta_key'     => 'gia_sp_sau_khi_giam',
						'meta_value'   => '0',
						'meta_compare' => '!=',						
					);
			$sps = new WP_Query( $ar );
			if ($sps->post_count > 0) {
		?>

				<div class="title margin-top-40">
					<div class="title-content">Sản phẩm khuyến mãi</div>
				</div>

				<div class="row">
		<?php
			
			$i = 0;
			while ( $sps->have_posts() ) {
				$sps->the_post();
				if ($i == 4) {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile hidden-md hidden-sm hidden-xs">';
				} else {
					echo '<div class="col-lg-3 product-detail pr-tablet pr-mobile">';
				}
		?>
					<!-- <div class="col-lg-3 product-detail pr-tablet pr-mobile"> -->
						<div class="product-contain">
							<a href="<?php the_permalink() ?>">								
								<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" class="pr-image">
							</a>
							<?php 
							if (is_sale_off(get_the_id())) {
								echo '<div class="sale-off">' . get_percent_cost(get_the_id()) . '</div>';
								echo '<div class="price">' . get_show_cost(get_stand_cost(get_the_id())) . '<span class="price-sale">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</span></div>';
							} else {
								echo '<div class="price">' . get_show_cost(get_ori_stand_cost(get_the_id())) . '</div>';
							}
						?>
							<div class="pr-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
						</div>
						
					</div>
			<?php
					$i++; 
				}
				wp_reset_postdata();
			?>
				</div>
			<?php } ?>
				<!-- End Sản phẩm khuyến mãi -->

			</div>
		</div>

	</div>
</div>



<?php
//get_sidebar();
get_footer();
