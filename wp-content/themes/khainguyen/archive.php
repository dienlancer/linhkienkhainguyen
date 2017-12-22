<?php get_header(); 
?>

<script type="text/javascript">
	jQuery(".title-danhmuc-mobile").click(function(){
		// console.log("D");
		jQuery(".body-danhmuc-mobile").toggle("slow");
	});
	jQuery(".body-danhmuc-mobile .menu-item-has-children").click(function(){
		// console.log("D");
		jQuery(this).find(".sub-menu").toggle();
	});
</script>
<div class="container-fluid groups-link-path">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-xs-15">
				<div class="group-link-path">
					<div class="link-path">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
					</div>
					<div class="link-path active">
						<?php single_cat_title(); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php if (empty($_POST['Filter'])) { ?>
<div class="container-fluid ">
	<div class="wrap">
		<div class="row">
			<?php get_sidebar(); ?>

			<div class="col-lg-12 col-xs-15">
			<h1 class="title"><?php single_cat_title(); ?></h1>
			<div class="row row-sps">
			<?php
				global $query_string;
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 28;
				$first_post = ($page_-1)*$posts_per_page_;   
		        global $post;
		        // echo $query_string;
		        $pos = strpos($query_string, "chuyen-muc=san-pham-moi");
		        if ($pos !== false) {
		        	query_posts("paged=$page_&posts_per_page=$posts_per_page_&post_type=san-pham");
		        } else {
		        	query_posts("paged=$page_&posts_per_page=$posts_per_page_&" . $query_string);        	
		        }
				
				if (have_posts() ) :
				$i = 1;
				while (have_posts()) : the_post();
					$tinh_trang_hang=get_post_meta(get_the_id(),"tinh_trang_hang",true);
				$tinh_trang_text="";
				switch ($tinh_trang_hang) {
					case 'con_hang':
						$tinh_trang_text="Còn hàng";
						break;
					case 'hang_ve_lai':
						$tinh_trang_text="Hàng về lại";
						break;
					case 'tam_het':
						$tinh_trang_text="Tạm hết";
						break;
					case 'hang_sap_ve':
						$tinh_trang_text="Hàng sắp về";
						break;
					default :
								$tinh_trang_text="Còn hàng";
								break;
				}				
			?>
							
					<div class="col-lg-4 col-xs-7 col-sp br-product <?php echo (($i % 2) == 0 ? 'xs-remove-line' : ''); ?>">
						<div class="product">
							<a href="<?php the_permalink(); ?>" class="a-product">
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
										// if ($check_gia == 0) {
										// 	echo "Liên hệ";
										// } else {
										// 	show_cost($check_gia * 0.7);
										// }	
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "") {
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
							<div class="hang-hoa-status">
								Tình trạng : <span class="midu"><b><?php echo $tinh_trang_text; ?></b></span>
							</div>
						</div>
					</div>
					<?php if ($i % 4 == 0 ) {
						echo '<div class="clearfix line-sp"></div>';
					} elseif ($i % 2 == 0) {
						echo '<div class="clearfix line-sp hidden-lg"></div>';
					} 
					$i++;
					?>
				<?php endwhile; ?>
				<div class="clearfix"></div>
				<nav aria-label="Page navigation" class="main-pagination">
					<ul class="pagination">
						<?php 
						$pos = strpos($query_string, "chuyen-muc=san-pham-moi");
		        		if ($pos !== false) {
				        	paging("posts_per_page=-1&post_type=san-pham", $page_, $posts_per_page_); 
				        } else {
				        	// query_posts("paged=$page_&posts_per_page=$posts_per_page_&" . $query_string);
				        	paging($query_string."&posts_per_page=-1&post_type=san-pham", $page_, $posts_per_page_);         	
				        }

						?>
					</ul>
				</nav>
			<?php endif; wp_reset_query(); ?>			

				</div> <!--End row-->
			</div>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="container-fluid ">
	<div class="wrap">
		<div class="row">
			<?php get_sidebar(); ?>

			<div class="col-lg-12 col-xs-15">
			<h1 class="title"><?php single_cat_title(); ?></h1>
			<div class="row row-sps">
			<?php
				global $query_string;
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 20;
				$first_post = ($page_-1)*$posts_per_page_;   
		        global $post;

		        $gia = sanitize_key($_POST['loc-gia']);
		        $cm = $_POST['loc-sp'];
		        // print_r($_POST);

		        if ($gia == "100") {
		        	$ar  = array(
						'post_type' => 'san-pham',

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(							
	                        'relation' => 'OR',
	                        array(
                                'key' => 'gia_si_khuyen_mai',
								'value'   => array( 1, 100001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
	                        array(
                                'key' => 'gia_si',
                                'value'   => array( 0, 100001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
						),
					);
		        } elseif ($gia == "200") {
		        	$ar  = array(
						'post_type' => 'san-pham',

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(							
	                        'relation' => 'OR',
	                        array(
                                'key' => 'gia_si_khuyen_mai',
								'value'   => array( 100000, 200001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
	                        array(
                                'key' => 'gia_si',
                                'value'   => array( 100000, 200001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
						)
					);
		        } elseif ($gia == "500") {
		        	$ar  = array(
						'post_type' => 'san-pham',

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(							
	                        'relation' => 'OR',
	                        array(
                                'key' => 'gia_si_khuyen_mai',
								'value'   => array( 200000, 500001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
	                        array(
                                'key' => 'gia_si',
                                'value'   => array( 200000, 500001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
						)
					);
		        } elseif ($gia == "1000") {
		        	$ar  = array(
						'post_type' => 'san-pham',

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(							
	                        'relation' => 'OR',
	                        array(
                                'key' => 'gia_si_khuyen_mai',
								'value'   => array( 500001, 1000001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
	                        array(
                                'key' => 'gia_si',
                                'value'   => array( 500001, 1000001 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
						)
					);
		        } elseif ($gia == "1001") {
		        	$ar  = array(
						'post_type' => 'san-pham',

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
	                        array(
                                'key' => 'gia_si',
                                'value'   => array( 1000001, 100000000 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN',
	                        ),
						),

					);
		        } 

		        if ($cm) {
		        	$ar['tax_query'] = array(
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $cm
							)
						);
		        }
		        // print_r($ar);


				$sps = new WP_Query( $ar );
				if ($sps->have_posts() ) :
				$i = 1;				
				while ( $sps->have_posts() ) :
					$sps->the_post();
					$tinh_trang_hang=get_post_meta(get_the_id(),"tinh_trang_hang",true);
					$tinh_trang_text="";
					switch ($tinh_trang_hang) {
						case 'con_hang':
						$tinh_trang_text="Còn hàng";
						break;
						case 'hang_ve_lai':
						$tinh_trang_text="Hàng về lại";
						break;
						case 'tam_het':
						$tinh_trang_text="Tạm hết";
						break;
						case 'hang_sap_ve':
						$tinh_trang_text="Hàng sắp về";
						break;
						default :
								$tinh_trang_text="Còn hàng";
								break;
					}
			?>
							
					<div class="col-lg-4 col-xs-7 col-sp br-product <?php echo (($i % 2) == 0 ? 'xs-remove-line' : ''); ?>">
						<div class="product">
							<a href="<?php the_permalink(); ?>" class="a-product">
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
										if ($gia_si_new === "") {
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
							
							<div class="hang-hoa-status">
								Tình trạng : <span class="midu"><b><?php echo $tinh_trang_text; ?></b></span>
							</div>
						</div>
					</div>
					<?php if ($i % 4 == 0) {
						echo '<div class="clearfix line-sp"></div>';
					} elseif ($i % 2 == 0) {
						echo '<div class="clearfix line-sp hidden-lg"></div>';
					} 
					$i++;
					?>
				<?php endwhile; ?>
				<div class="clearfix"></div>
				<nav aria-label="Page navigation" class="main-pagination">
					<ul class="pagination">
						<?php //paging($query_string."&posts_per_page=-1", $page_, $posts_per_page_); ?>
					</ul>
				</nav>
			<?php endif; wp_reset_query(); ?>			

				</div> <!--End row-->
			</div>
		</div>
	</div>
</div>
<?php } ?>
<?php get_footer();