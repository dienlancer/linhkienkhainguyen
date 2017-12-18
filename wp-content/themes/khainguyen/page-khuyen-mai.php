<?php
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15 ">
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

				<div class="row">
			<?php
				$terms =  wp_get_object_terms( $current_id, 'chuyen-muc', array('fields'=>'ids'));

				global $query_string;
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 20;
				$first_post = ($page_-1)*$posts_per_page_;   
		        global $post;

		        //$query = "cat= $cat_paths[0]";
		        // query_posts("paged=$page_&posts_per_page=$posts_per_page_&" . $query_string);
				
				//query_posts( $query_string . '&posts_per_page=28'); 

		        $ar  = array(
						// 'cat' => $catid, 
						'posts_per_page' => '20',
						// 'post__not_in' => array( $current_id),
						'post_type' => 'san-pham',
						'meta_key'     => 'gia_sp_sau_khi_giam',
						'meta_value'   => '0',
						'meta_compare' => '!=',		
						'paged'	=> $page_
					);

				$sps = new WP_Query( $ar );
				$i = 1;
				while ( $sps->have_posts() ) {
					$sps->the_post();
			?>
					<div class="col-lg-3 product-detail pr-tablet pr-mobile">
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
					if ($i % 5 == 0) {
						if ($i % 4 == 0) {
							echo '<div class="clearfix"></div>';
						} else {
							echo '<div class="clearfix hidden-md hidden-sm hidden-xs"></div>';
						}
					} elseif ($i % 4 == 0) {
						echo '<div class="clearfix hidden-lg"></div>';
					} elseif ($i % 2 == 0) {
						echo '<div class="clearfix hidden-lg hidden-md hidden-sm"></div>';
					}
					$i++;
				}
				 
			?>
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

<?php
//get_sidebar();
get_footer();