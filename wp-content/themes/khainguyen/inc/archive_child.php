<?php 
	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));

	// Get ID by Term
	function GetIDByTerm($_slug) {
		$_TermOB = get_term_by( 'slug', 'san-pham', 'chuyen-muc');
		return $_TermOB->term_id;
	}

	// Set chuyên mục, thương hiệu và giá mặc định
	if (empty($_SESSION['GiaSP'])) {
		$_SESSION['GiaSP'] = "all";
	}

	if (empty($_SESSION['CMSP'])) {
		$_SESSION['CMSP'] = GetIDByTerm('san-pham');
	}

	if (empty($_SESSION['THSP'])) {
		$_SESSION['THSP'] = GetIDByTerm('thuong-hieu');
	}

	// Kiểm tra active cho giá
	function IsCurrentPrice($_check) {
		if ($_SESSION['GiaSP'] == $_check) {
			echo 'current-menu-item';
		} else {
			echo '';
		}
	}

	function IsCurrentPriceMobile($_check) {
		if ($_SESSION['GiaSP'] == $_check) {
			echo 'selected';
		} else {
			echo '';
		}
	}

	function IsCurrentCategory($_check)
	{
		if ($_SESSION['CMSP'] == $_check) {
			return 'selected';
		} else {
			return '';
		}
	}

	function IsCurrentBrand($_check)
	{
		if ($_SESSION['THSP'] == $_check) {
			return 'selected';
		} else {
			return '';
		}
	}

	// Kiểm tra chuyên mục hiện tại có phải là chuyên mục con của chuyên mục Parent
	function IsChildOfTerm($_childTerm, $_parentTermID) {
		$term_children = get_term_children( $_parentTermID, 'chuyen-muc' );
		foreach ( $term_children as $child ) {
			if ($child == $_childTerm) {
				return TRUE;
				break;
			}
		}
		return FALSE;
	}

	// if(IsChildOfTerm(get_queried_object()->term_id, GetIDByTerm('thuong-hieu'))) {
	// 	$_SESSION['THSP'] = "thuong-hieu";
	// };

	if(IsChildOfTerm(get_queried_object()->term_id, GetIDByTerm('san-pham')) || get_query_var( 'term' ) == 'san-pham') {
		$_SESSION['CMSP'] = get_queried_object()->term_id;
	} 

	if (isset($_REQUEST['tim-thuong-hieu'])) {
		$_SESSION['THSP'] = text2number($_REQUEST['tim-thuong-hieu']);
	}

	if (isset($_REQUEST['tim-theo-gia'])) {
		$_SESSION['GiaSP'] = sanitize_text_field($_REQUEST['tim-theo-gia']);
	}
?>
<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-3 cat-content-left hidden-xs">
				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>DANH MỤC</div>
				<ul class="sidebar-danhmuc">					
				<?php 
					$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
					if ($_SESSION['CMSP'] == $parent->term_id) {
						echo '<li class="current-menu-item"><a href="' . esc_url(get_term_link($parent->term_id,  "chuyen-muc") ) . '">Tất cả</a></li>';
					} else {
						echo '<li class=""><a href="' . esc_url(get_term_link($parent->term_id,  "chuyen-muc") ) . '">Tất cả</a></li>';
					}

					$categories = get_terms( 'chuyen-muc', array(
					    'hide_empty' => 0,
					    'child_of' => $parent->term_id
					) );

					foreach ($categories as $term) {
						if ($_SESSION['CMSP'] == $term->term_id) {
							echo '<li class="current-menu-item"><a href="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</a></li>';	
						} else {
							echo '<li class=""><a href="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</a></li>';	
						}				
					} 
				?>
				</ul>

				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>GIÁ SẢN PHẨM</div>
				<ul class="sidebar-danhmuc">
					<li class="<?php IsCurrentPrice('all') ?>"><a href="?tim-theo-gia=all">Tất cả</a></li>
					<li class="<?php IsCurrentPrice('100') ?>"><a href="?tim-theo-gia=100">&le; 100.000đ</a></li>
					<li class="<?php IsCurrentPrice('200') ?>"><a href="?tim-theo-gia=200">100.000 - 200.000đ</a></li>
					<li class="<?php IsCurrentPrice('500') ?>"><a href="?tim-theo-gia=500">200.000 - 500.000đ</a></li>
					<li class="<?php IsCurrentPrice('1000') ?>"><a href="?tim-theo-gia=1000">500.000 - 1.000.000đ</a></li>
					<li class="<?php IsCurrentPrice('>1000') ?>"><a href="?tim-theo-gia=>1000">&ge; 1.000.000đ</a></li>
				</ul>
				
				<!-- <div class="sidebar-gia" data="100">&le; 100.000đ</div>
				<div class="sidebar-gia" data="200">100.000 - 200.000đ</div>
				<div class="sidebar-gia" data="500">200.000 - 500.000đ</div>
				<div class="sidebar-gia" data="1000">500.000 - 1.000.000đ</div>
				<div class="sidebar-gia" data=">1000">&ge; 1.000.000đ</div> -->


				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THƯƠNG HIỆU</div>
				<ul class="sidebar-danhmuc">
			<?php 
				$parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
				if ($_SESSION['THSP'] == $parent->term_id) {
					echo '<li class="current-menu-item"><a href="?tim-thuong-hieu=' . $parent->term_id . '">Tất cả</a></li>';	
				} else {
					echo '<li class=""><a href="?tim-thuong-hieu=' . $parent->term_id . '">Tất cả</a></li>';	
				}
				
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
			?>
			<?php
				foreach ($categories as $term) {
					if ($_SESSION['THSP'] == $term->term_id) {
						echo '<li class="current-menu-item"><a href="?tim-thuong-hieu=' . $term->term_id . '">' . $term->name . '</a></li>';	
					} else {
						echo '<li class=""><a href="?tim-thuong-hieu=' . $term->term_id . '">' . $term->name . '</a></li>';	
					}		
				} 
			?>
				</ul>
			</div>


			<!-- Mobile -->
			<div class="col-lg-12 cat-content-right col-xs-15">
				<form class="hidden-lg hidden-sm hidden-md visible-xs" style="margin-bottom: 25px;">
					<div class="form-group">
						<select class="form-control no-border" id="Select-CMSP">
							
			<?php
				$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				echo '<option ' . IsCurrentCategory($parent->term_id) . ' value="' . esc_url(get_term_link($parent->term_id) ) . '">Tất cả</option>';
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {
					echo '<option ' . IsCurrentCategory($term->term_id) . ' value="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</option>';				
				} 
			?>
						</select>
					</div>

					<div class="form-group">
						<select class="form-control no-border" id="Select-Gia">
							<option <?php IsCurrentPriceMobile("all") ?> value="<?php echo $current_url ?>?tim-theo-gia=all">Tất cả</option>
							<option <?php IsCurrentPriceMobile("100") ?> value="<?php echo $current_url ?>?tim-theo-gia=100">&le; 100.000đ</option>
							<option <?php IsCurrentPriceMobile("200") ?> value="<?php echo $current_url ?>?tim-theo-gia=200">100.000 - 200.000đ</option>
							<option <?php IsCurrentPriceMobile("500") ?> value="<?php echo $current_url ?>?tim-theo-gia=500">200.000 - 500.000đ</option>
							<option <?php IsCurrentPriceMobile("1000") ?> value="<?php echo $current_url ?>?tim-theo-gia=1000">500.000 - 1.000.000đ</option>
							<option <?php IsCurrentPriceMobile(">1000") ?> value="<?php echo $current_url ?>?tim-theo-gia=>1000">&ge; 1.000.000đ</option>
						</select>
					</div>

					<div class="form-group">
						<select class="form-control no-border" id="Select-Brand">					
			<?php
				$parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
				echo '<option value="' . esc_url($current_url) . '?tim-thuong-hieu=' . $parent->term_id . '">Tất cả</option>';
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {
					echo '<option ' . IsCurrentBrand($term->term_id) . ' value="' . $current_url . "?tim-thuong-hieu=" . $term->term_id . '">' . $term->name . '</option>';				
				} 
			?>
						</select>
					</div>
				</form>

				<div class="title">
					<h1 class="title-content"><?php single_cat_title( '' ) ?></h1>
					<!-- <span class="title-content-link"><a href="">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></span> -->
				</div>

				<div class="row">
			<?php
				// $terms =  wp_get_object_terms( get_the_id(), 'chuyen-muc', array('fields'=>'ids'));

				global $query_string;
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 20;
				$first_post = ($page_-1)*$posts_per_page_;   
		        global $post;

		        if ($_SESSION['GiaSP'] == "all") {
		        	$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',
						'meta_key'     => 'so_luong_con_lai',
						'meta_value'   => '0',
						'meta_compare' => '!=',		
						'paged'	=> $page_
					);
		        } elseif ($_SESSION['GiaSP'] == "100") {
		        	$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'so_luong_con_lai',
								'value'   => '0',
								'compare' => '!=',
							),
			                array(
		                        'relation' => 'OR',
		                        array(
	                                'key' => 'gia_sp_sau_khi_giam',
									'value'   => array( 1, 100001 ),
									'type'    => 'numeric',
									'compare' => 'BETWEEN',
		                        ),
		                        array(
	                                'key' => 'sp_gia',
	                                'value' => 100001,
	                                'compare' => '<',
		                        ),
							),
						)
					);
		        } elseif ($_SESSION['GiaSP'] == "200") {
		        	$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
							'relation' => 'AND',
								array(
									'key'     => 'so_luong_con_lai',
									'value'   => '0',
									'compare' => '!=',
								),
				                array(
			                        'relation' => 'OR',
			                        array(
		                                'key' => 'gia_sp_sau_khi_giam',
										'value'   => array( 100000, 200001 ),
										'type'    => 'numeric',
										'compare' => 'BETWEEN',
			                        ),
			                        array(
		                                'key' => 'sp_gia',
		                                'value'   => array( 100000, 200001 ),
										'type'    => 'numeric',
										'compare' => 'BETWEEN',
			                        ),
								),
						)
					);
		        } elseif ($_SESSION['GiaSP'] == "500") {
		        	$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'so_luong_con_lai',
								'value'   => '0',
								'compare' => '!=',
							),
			                array(
		                        'relation' => 'OR',
		                        array(
	                                'key' => 'gia_sp_sau_khi_giam',
									'value'   => array( 200001, 500001),
									'type'    => 'numeric',
									'compare' => 'BETWEEN',
		                        ),
		                        array(
	                                'key' => 'sp_gia',
	                                'value'   => array( 200001, 500001),
									'type'    => 'numeric',
									'compare' => 'BETWEEN',
		                        ),
							),
						)
					);
		        } elseif ($_SESSION['GiaSP'] == "1000") {
		        	$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'so_luong_con_lai',
								'value'   => '0',
								'compare' => '!=',
							),
			                array(
		                        'relation' => 'OR',
		                        array(
	                                'key' => 'gia_sp_sau_khi_giam',
									'value'   => array( 500000, 1000001 ),
									'type'    => 'numeric',
									'compare' => 'BETWEEN',
		                        ),
		                        array(
	                                'key' => 'sp_gia',
	                                'value'   => array( 500000, 1000001 ),
									'type'    => 'numeric',
									'compare' => 'BETWEEN',
		                        ),
							),
						)
					);
		        } else {	
					$ar  = array(
						'post_type' => 'san-pham',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['CMSP'],
							),
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $_SESSION['THSP'],
							),
						),

						'posts_per_page' => '20',	
						'paged'	=> $page_,
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'so_luong_con_lai',
								'value'   => '0',
								'compare' => '!=',
							),
			                // array(
		                        // 'relation' => 'AND',
		       //                  array(
	        //                         'key' => 'gia_sp_sau_khi_giam',
									// 'value' => 1000000,
	        //                         'compare' => '>=',
		       //                  ),
		                        array(
	                                'key' => 'sp_gia',
	                                'value' => 1000000,
	                                'compare' => '>=',
		                        ),
							// ),
						)
					);
		        }

		        

				$sps = new WP_Query( $ar );
				$i = 1;
				while ( $sps->have_posts() ) {
					$sps->the_post();
			?>
					<div class="product-desktop col-sm-5 product-detail pr-mobile">
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
					if ($i % 4 == 0) {
						if ($i % 3 == 0) {
							echo '<div class="clearfix"></div>';
						} else {
							echo '<div class="clearfix hidden-md hidden-sm"></div>';
						}
					} elseif ($i % 3 == 0) {
						echo '<div class="clearfix hidden-lg hidden-xs"></div>';
					} elseif ($i % 2 == 0) {
						echo '<div class="clearfix hidden-lg hidden-md hidden-sm"></div>';
					}
					$i++;
				} ?>		
					
				</div>

				<?php 
			if ($sps->post_count > 0) { ?>
				<nav aria-label="Page navigation" class="main-pagination">
					<ul class="pagination">
						<?php 
							$ar['posts_per_page'] = -1;
							paging($ar, $page_, $posts_per_page_); 
						?>
					</ul>
				</nav>
			<?php } 
				wp_reset_postdata(); 
			?>		

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery("#Select-CMSP").change(function() {
			var url = jQuery(this).val();
			window.location.href = url;
		});

		jQuery("#Select-Gia").change(function() {
			var val = jQuery(this).val();
			window.location.href = val;
		});
		jQuery("#Select-Brand").change(function() {
			var val = jQuery(this).val();
			window.location.href = val;
		});
	});
</script>