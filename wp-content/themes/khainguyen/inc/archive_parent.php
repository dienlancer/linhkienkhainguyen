<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-3 cat-content-left hidden-xs">
				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>DANH MỤC</div>
				<ul class="sidebar-danhmuc">
					<!-- <li class="current-menu-item"><a href="">Tất cả</a></li> -->
			<?php
				$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {
					echo '<li class=""><a href="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</a></li>';				
				} 
			?>
				</ul>
				<!--
				<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THƯƠNG HIỆU</div>
			<?php
				// $parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
				// $categories = get_terms( 'chuyen-muc', array(
				//     'hide_empty' => 0,
				//     'child_of' => $parent->term_id
				// ) );
				// foreach ($categories as $term) {
				// 	echo '<div class="sidebar-thuonghieu" data="' . $term->term_id . '">' . $term->name . '</div>';				
				// } 
			?>
				<ul class="sidebar-danhmuc">
				<?php
					// $parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
					// $categories = get_terms( 'chuyen-muc', array(
					//     'hide_empty' => 0,
					//     'child_of' => $parent->term_id
					// ) );
					// foreach ($categories as $term) {
					// 	echo '<li class=""><a href="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</a></li>';				
					// } 
				?>
				</ul>
				-->
			</div>

			<div class="col-lg-12 cat-content-right col-xs-15">
				<form class="hidden-lg hidden-sm hidden-md visible-xs" style="margin-bottom: 25px;">
					<div class="form-group">
						<select class="form-control no-border" id="XemThuongHieu">
							<option value="<?php //echo esc_url(get_term_link(get_query_var( 'term' ), get_query_var( 'taxonomy' )) ) ?>">Xem theo chuyên mục</option>
			<?php
				$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {
					// echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';				
					echo '<option value="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</option>';				
				} 
			?>
						</select>
					</div>
					<!--
					<div class="form-group">
						<select class="form-control no-border">
							<option>Xem theo Thương hiệu</option>
			<?php
				// $parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
				// $categories = get_terms( 'chuyen-muc', array(
				//     'hide_empty' => 0,
				//     'child_of' => $parent->term_id
				// ) );
				// foreach ($categories as $term) {
				// 	echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';				
				// } 
			?>
						</select>
					</div>
					-->
				</form>
			<script type="text/javascript">
				jQuery("#XemThuongHieu").change(function(){
					var url = jQuery(this).val();
					window.location.href = url + "?tim-thuong-hieu=<?php echo $parent->term_id ?>" + "&tim-theo-gia=all" ;
				});
			</script>

			<?php
				$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {		
			?>

				<div class="title">
					<h1 class="title-content"><?php echo $term->name ?></h1>
					<span class="title-content-link"><a href="<?php echo esc_url(get_term_link($term->term_id) ) ?>">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></span>
				</div>

				<div class="row">
				<?php 
					$sanphams = new WP_Query( array(
						'posts_per_page'=>4,
						'post_type' => 'san-pham',
						'tax_query' => array(
							array(
								'taxonomy' => 'chuyen-muc',
								'field'    => 'term_id',
								'terms'    => $term->term_id,
							),
						),
					) );

					// $n = $sanphams->post_count;
					if ( $sanphams->have_posts() ) {
						while ( $sanphams->have_posts() ) {
							$sanphams->the_post();
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

							<div class="pr-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
						</div>						
					</div>
				<?php }
					wp_reset_postdata(); 
				}
				?>

				</div>
				<div style="margin-bottom: 40px;"></div>
			<?php } ?>

			</div>
		</div>
	</div>
</div>
<style type="text/css">
	@media (min-width: 768px) and (max-width: 1200px) {
		.row .product-detail:last-child {
			display: none;
		}
	}

</style>