<?php 
include_once get_template_directory() . "/inc/cost_product.php" ; 
// var_dump($category);
	$category = get_term_by('id', $instance['id_chuyen_muc'], 'chuyen-muc');
	$title = ! empty( $instance['title'] ) ? $instance['title'] : $category->name;

	$sticky = get_option( 'sticky_posts' );
	// if ("3" == $instance['id_chuyen_muc']) {
	// 	$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');

	// 	$sanphams = new WP_Query( array(
	// 		'posts_per_page'=>10,
	// 		'post_type' => 'san-pham',
	// 		'post__in'            => $sticky,
	// 		// 'ignore_sticky_posts' => 1,
	// 		// 'tax_query' => array(
	// 		// 	array(
	// 		// 		'taxonomy' => 'chuyen-muc',
	// 		// 		'field'    => 'term_id',
	// 		// 		'terms'    => $parent->term_id,
	// 		// 	),
	// 		// ),
	// 	) );
	// } else {
		if (empty($instance['full_row']) || !$instance['full_row']) {
			$sanphams = new WP_Query( array(
				'posts_per_page'=>10,
				'post_type' => 'san-pham',
				'post__in'            => $sticky,
				'ignore_sticky_posts' => 1,
				'tax_query' => array(
					array(
						'taxonomy' => 'chuyen-muc',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					),
				),
			) );
		} else {
			$sanphams = new WP_Query( array(
				'posts_per_page'=>6,
				'post_type' => 'san-pham',
				'post__in'            => $sticky,
				'ignore_sticky_posts' => 1,
				'tax_query' => array(
					array(
						'taxonomy' => 'chuyen-muc',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					),
				),
			) );
		}
	// }

	$n = $sanphams->post_count;
	if ( $sanphams->have_posts() ) {

	?>
		<?php 
			if ("3" == $instance['id_chuyen_muc']) { 
				$page = get_page_by_title( 'Sản phẩm mới' ); 
				$link_term = get_term_link($category->term_id);//esc_url( get_page_link($page->ID) );				 
			} else {
				$link_term = get_term_link($category->term_id);				
			}
			if (empty($instance['full_row']) || !$instance['full_row']) {
		?>
<div class="container-fluid full-width">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-md-15 col-sm-15 col-xs-15">
				<div class="index-new-section">

					<div class="title">
					<?php //if ("MoiNhat" == $instance['id_chuyen_muc']) {
						//echo '<div class="title-content">'. $title .'</div>';
					//} else {
						//echo '<div class="title-content">'. $title .'</div>';
					//}
					?>	
						<div class="title-content">
						<?php 
							echo '<img class="img-index-main-content" src="' . esc_url(get_template_directory_uri() . '/images/icon-san-pham-chinh-hang.png') . '">';

						?>
						
						<?php echo $title ?>
						</div>	
						<span class="title-content-link title-content-link-hot"><a href="<?php echo $link_term; ?>">Xem tất cả <i class="fa fa-angle-right" aria-hidden="true"></i></a></span>
					</div>
				</div>

				<div class="index-list-pro">
					<div class="row">
		<?php 			
			$i = 1;
			while ( $sanphams->have_posts() ) {
				$sanphams->the_post();	
				$id = get_the_id();		
		?>
		<?php 
			if ($i == 1 || $i == 3) { ?>
				<div class="col-lg-3 col-xs-7 col-md-7 col-sm-7 xs-index-pro br-product">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title())?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}									 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div>
								<center>
									<?php 
								$thumbnail_1=get_post_meta($id,"thumbnail_1",true);
								$thumbnail_2=get_post_meta($id,"thumbnail_2",true);
								$thumbnail_3=get_post_meta($id,"thumbnail_3",true);								
								$featureImg_1=wp_get_attachment_image_src($thumbnail_1,"single-post-thumbnail");			
								$featureImg_2=wp_get_attachment_image_src($thumbnail_2,"single-post-thumbnail");			
								$featureImg_3=wp_get_attachment_image_src($thumbnail_3,"single-post-thumbnail");										
								if(count($featureImg_1) > 0) {
									if(!empty($featureImg_1[0])){
										?>
										<div class="product-thumbnail">
											<center><a href="javascript:void(0);" onclick="changeImage('<?php echo $featureImg_1[0]; ?>');"><img src="<?php echo $featureImg_1[0]; ?>" /></a></center>
										</div>
										<?php	
									}									
								}
								if(count($featureImg_2) > 0) {
									if(!empty($featureImg_2[0])){
										?>
										<div class="product-thumbnail">
											<center><a href="javascript:void(0);" onclick="changeImage('<?php echo $featureImg_2[0]; ?>');"><img src="<?php echo $featureImg_2[0]; ?>" /></a></center>
										</div>
										<?php
									}									
								}
								if(count($featureImg_3) > 0) {
									if(!empty($featureImg_3[0])){
										?>
										<div class="product-thumbnail">
											<center><a href="javascript:void(0);" onclick="changeImage('<?php echo $featureImg_3[0]; ?>');"><img src="<?php echo $featureImg_3[0]; ?>" /></a></center>
										</div>
										<?php
									}									
								}
								?>					
								</center>																
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
		<?php	} elseif ($i == 2 || $i == 4) { ?>
				<div class="col-lg-3 col-xs-8 col-md-8 col-sm-8 xs-index-pro br-product xs-remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}												 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
					<?php if ($i==2) {
						echo '<div class="clearfix line-sp hidden-lg"></div>';
					} ?>
					
		<?php } elseif ($i == 5) { ?>
			<div class="col-lg-3 hidden-xs hidden-sm hidden-md br-product remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

					<div class="clearfix line-sp"></div>
		<?php } elseif ($i == 6 || $i == 7 || $i == 8 || $i == 9) { ?>
			<div class="col-lg-3 hidden-xs hidden-sm hidden-md br-product">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
		<?php } elseif ($i == 10) { ?>
			<div class="col-lg-3 hidden-xs hidden-sm hidden-md br-product remove-line">
						<div class="product ">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
		<?php } 
		$i++;
		?>
					
					<?php } 
	wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
// } 
} else { ?>
<div class="container-fluid full-width">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-md-15 col-xs-15">
				<div class="index-new-section">
					<div class="title">
						<div class="title-content">
						<?php 
							if ($category->term_id == 22) {
								echo '<img class="img-index-main-content" src="' . esc_url(get_template_directory_uri() . '/images/icon-san-pham-chinh-hang.png') . '">';
							} elseif ($category->term_id == 10) {
								echo '<img class="img-index-main-content" src="' . esc_url(get_template_directory_uri() . '/images/icon-do-choi-cong-nghe.png') . '">';
							} else {
								echo '<img class="img-index-main-content" src="' . esc_url(get_template_directory_uri() . '/images/icon-san-pham-khuyen-mai.png') . '">';
							}
						?>
						
						<?php echo $title ?>
						</div>					
						<span class="title-content-link"><a href="<?php echo $link_term; ?>">Xem tất cả <i class="fa fa-angle-right" aria-hidden="true"></i></a></span>
					</div>
				</div>


				<div class="index-list-pro">
					<div class="row">
						<div class="col-lg-6 hidden-xs hidden-md hidden-sm">
							<img class="img-responsive" src="<?php echo esc_url( get_the_post_thumbnail_url($instance['id_quang_cao'], 'full')) ?>" />
						</div>

						<div class="col-lg-9 col-xs-15 col-md-15 col-sm-15">
							<div class="row">
					<?php $i = 1;
			while ( $sanphams->have_posts() ) {
				$sanphams->the_post();	
				$id = get_the_id(); 
			?>

				<?php if ($i == 1) { ?>
					<div class="col-lg-5 col-xs-7 col-sm-7 col-md-7 xs-index-pro br-product">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
				<?php } elseif ($i == 2) { ?>
					<div class="col-lg-5 col-xs-8 col-sm-8 col-md-8 xs-index-pro br-product xs-remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

					<div class="clearfix line-sp hidden-lg"></div>
				<?php } elseif ($i == 3) { ?>
					<div class="col-lg-5 col-xs-7 col-sm-7 col-md-7 xs-index-pro br-product">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

					<div class="clearfix line-sp hidden-xs hidden-sm hidden-md"></div>
				<?php } elseif ($i == 4) { ?>
					<div class="col-lg-5 col-xs-8 col-sm-8 col-md-8 xs-index-pro br-product xs-remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
				<?php } else { ?>
								
					<div class="col-lg-5 hidden-xs hidden-md hidden-sm br-product <?php echo (($i == 6) ? 'remove-line' : ''); ?>">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php the_title() ?>">
									<?php echo SubTitle(get_the_title()) ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá lẻ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										if ($check_gia == 0) {
											echo "Liên hệ";
										} else {
											show_cost($check_gia);
										}										 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
								<?php //} ?>
							</div>

							<div class="price-product">
								<?php //if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) { ?>
								Giá sỉ: 
									<span class="price-vnd">
									<?php
										$check_gia = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "" ) {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}											 
									?>										
									</span>
								<?php //} else { ?>
								<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
								<?php //} ?>
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

								
				<?php } ?>

								
					<?php $i++; } wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
				</div>

			</div>
		</div>
	</div>
</div>

<?php }} ?>