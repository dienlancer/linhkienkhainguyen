<?php get_header(); ?>

<div class="container-fluid groups-link-path">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-xs-15">
				<div class="group-link-path">
					<div class="link-path">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
					</div>
					<div class="link-path active">
						Tìm kiếm
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15 col-md-15">
			<div class="common-p" style="margin-bottom: 25px;">Kết quả tìm kiếm từ khóa: <b><?php echo $wp_query->query_vars['s'] ?></b></div>
			<?php 
				global $query_string;
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 10;
				$first_post = ($page_-1)*$posts_per_page_;   
		        // global $post;
		        $keyword = sanitize_text_field($_GET['s']);

		 //        $ars = new WP_Query( array(
			// 		'posts_per_page'=>$posts_per_page_,
			// 		'post_type' => 'san-pham',
			// 		's' => $keyword
			// 	) );

			// $searchs = new WP_Query( $ars );

			// $q1 = get_posts(array(
		 //        'fields' => 'ids',
		 //        'post_type' => 'san-pham',
		 //        's' => $keyword
			// ));

			// $q2 = get_posts(array(
		 //        'fields' => 'ids',
		 //        'post_type' => 'san-pham',
		 //        'meta_query' => array(
		 //            array(
		 //               'key' => 'ma_sp',
		 //               'value' => $keyword,
		 //               'compare' => 'LIKE'
		 //            )
		 //         )
			// ));

			// $unique = array_unique( array_merge( $q1->posts, $q2->posts ) );
			// $unique = array_unique( $q1->posts );

			// $posts = get_posts(array(
			//     'post_type' => 'san-pham',
			//     'post__in' => $unique,
			//     'post_status' => 'publish',
			//     'posts_per_page' => -1
			// ));
			// print_r($unique);

			// print_r($posts);
		    add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2 );
function wpse18703_posts_where( $where, &$wp_query )
{
    global $wpdb;
    if ( $wpse18703_title = $wp_query->get( 's' ) ) {
        $where .= ' OR ' . $wpdb->posts . '.post_name LIKE \'%' . esc_sql( $wpdb->esc_like( sanitize_title($wpse18703_title) ) ) . '%\'';
    }
    return $where;
}

// echo $sql;
	$searchs = new WP_Query( array('s' => $keyword, 'post_type' => 'san-pham', 'posts_per_page' => -1 ) );

			if ( $searchs->have_posts() ) : 
			// if( $posts ) :
				$i = 1;
				while ( $searchs->have_posts() ) {
				// foreach( $posts as $post ) :
					$searchs->the_post();
					// setup_postdata($post);
					if ( in_category('tin-tuc') || in_category("hinh-quang-cao") || in_category('tin-khuyen-mai') || get_post_meta($id, "ma_sp", true) == null) {
					    continue;
					}

				if ($i%10 == 1 || $i%10 == 3 || $i%10 == 7 || $i%10 == 9) { ?>
					<div class="col-lg-3 col-xs-7 col-md-7 col-sm-7 xs-index-pro br-product">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product">
									<?php the_title() ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
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
							</div>

							<div class="price-product">
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
							</div>

							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
		<?php	} elseif ($i%10 == 2 || $i%10 == 4 || $i%10 == 6 || $i%10 == 8) { ?>
				<div class="col-lg-3 col-xs-8 col-md-8 col-sm-8 xs-index-pro br-product xs-remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product">
									<?php the_title() ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
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
							</div>

							<div class="price-product">
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
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>
					<?php if ($i%2 == 0) {
						echo '<div class="clearfix line-sp hidden-lg"></div>';
					} ?>
					
		<?php } elseif ($i%10 == 5) { ?>
			<div class="col-lg-3 col-xs-7 col-md-7 col-sm-7 xs-index-pro br-product remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product">
									<?php the_title() ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
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
							</div>

							<div class="price-product">
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
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

					<div class="hidden-xs hidden-sm hidden-md clearfix line-sp"></div>
		<?php } elseif ($i%10 == 0) { ?>
			<div class="col-lg-3 col-xs-8 col-md-8 col-sm-8 xs-index-pro br-product remove-line">
						<div class="product">
							<a href="<?php the_permalink() ?>" class="a-product">
								<img class="" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />
								<div class="title-product">
									<?php the_title() ?>
								</div>
							</a>
							<div class="id-product">
								Mã SP: <?php echo get_post_meta($id, "ma_sp", true) ?>
							</div>
							<div class="id-product">
								Bảo hành: <?php echo get_post_meta($id, "thoi_gianbao_hanh", true) ?>
							</div>
							<div class="price-product">
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
							</div>

							<div class="price-product">
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
							</div>
							<div class="purchase-product">
								<i class="fa fa-cart-arrow-down fa-4x" aria-hidden="true"></i>
								<span class="slash-purchase">&nbsp;</span>
								<a class="btn btn-default" href="#" role="button">ORDER</a>
							</div>
						</div>
					</div>

					<div class="clearfix line-sp"></div>
		<?php }

				$i++;
		 } wp_reset_postdata(); 
			// endforeach; 
		?>
			<?php 
				// echo '</div>';
				// echo '<nav aria-label="Page navigation" class="main-pagination">';
				// 	echo '<ul class="pagination">';
				// 			$ars = array(
				// 				'posts_per_page'=> -1,
				// 				'post_type' => 'san-pham',
				// 				's' => $keyword
				// 			);
				// 			paging($ars, $page_, $posts_per_page_); 
				// 	echo '</ul>';
				// echo '</nav>';
			else :
			?>
				<div style="font-size: 18px; color: #333; min-height: 150px; margin-top: 20px;">
					Không có sản phẩm nào được tìm thấy. Vui lòng tìm sản phẩm khác!
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer();