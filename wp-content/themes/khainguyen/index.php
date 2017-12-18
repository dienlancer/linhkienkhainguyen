<?php get_header(); ?>

<div class="container-fluid group-danhmuc-slider">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-4 col-md-4 hidden-xs hidden-sm">
				<div class="group-danhmuc">
					<div class="title-danhmuc">
						<span><i class="fa fa-align-justify" aria-hidden="true"></i></span>
						<span>TẤT CẢ DANH MỤC</span>
					</div>
					<?php 
					wp_nav_menu(array(
						'menu' => "Danh mục",
						'container' => '',
						'menu_class' => "body-danhmuc"
					)); 
					?>
<!-- 					<ul class="body-danhmuc">
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Điện thoại', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/dien-thoai.png') ?>"></span>Điện thoại</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Đồng hồ', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/dong-ho.png') ?>"></span>Đồng hồ</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Cóc sạc/Pin sạc', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/coc-sac-pin-sac.png') ?>"></span>Cóc sạc/Pin sạc</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Loa/Tai nghe', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tai-nghe.png') ?>"></span>Loa/Tai nghe</a>
							<ul class="sub-menu">
								<li>
									<a href="<?php //echo get_term_link(get_term_by('name', 'Tai nghe/Head phone', 'chuyen-muc')); ?>">Tai nghe/Head phone</a>
								</li>
								<li>
									<a href="<?php //echo get_term_link(get_term_by('name', 'Tai nghe Bluetooth', 'chuyen-muc')); ?>">Tai nghe Bluetooth</a>
								</li>
								<li>
									<a href="<?php //echo get_term_link(get_term_by('name', 'Loa Bluetooth', 'chuyen-muc')); ?>">Loa Bluetooth</a>
								</li>
								<li>
									<a href="<?php //echo get_term_link(get_term_by('name', 'Loa USB', 'chuyen-muc')); ?>">Loa USB</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Máy chiếu', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/may-chieu.png') ?>"></span>Máy chiếu</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Camera', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/camera.png') ?>"></span>Camera</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Đồ chơi công nghệ', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/do-choi-cong-nghe.png') ?>"></span>Đồ chơi công nghệ</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Phụ kiện máy tính', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/phu-kien-may-tinh.png') ?>"></span>Phụ kiện máy tính</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Phụ kiện điện thoại', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/phu-kien-dien-thoai.png') ?>"></span>Phụ kiện điện thoại</a>
						</li>
						<li>
							<a href="<?php //echo get_term_link(get_term_by('name', 'Đồ điện gia dụng', 'chuyen-muc')); ?>"><span><img src="<?php //echo esc_url(get_template_directory_uri() . '/images/do-dien-gia-dung.png') ?>"></span>Đồ điện gia dụng</a>
						</li>

					</ul> -->
				</div>
			</div>

			<div class="col-lg-11 col-md-11 col-xs-15 col-sm-15">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">					
					<?php  
					$hinhanh = get_option('__images_banner_large', array());
					$urls = get_option('__images_banner_url', array());
					$n_count = count($hinhanh);
					if (is_array($values) || is_object($values)){
						?>
						<ol class="carousel-indicators">
							<?php 						
							foreach ($hinhanh as $key => $value) {
								if ($key == 0) {
									echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
								} else {
									echo '<li data-target="#carousel-example-generic" data-slide-to="' . $key . '"></li>';
								} 
							}
							?>
						</ol>		
						<?php
					}
					if (is_array($values) || is_object($values)){
						?>
						<div class="carousel-inner" role="listbox">
							<?php 
							foreach ($hinhanh as $key => $value) {
								if ($key == 0) { 
									?>
									<div class="item active">
										<a href="<?php echo esc_url($urls[$key]) ?>"><img src="<?php echo esc_url($value) ?>" alt=""></a>
									</div>
									<?php 
								} else { 
									?>
									<div class="item">
										<a href="<?php echo esc_url($urls[$key]) ?>"><img src="<?php echo esc_url($value) ?>" alt=""></a>
									</div>
									<?php 
								} 
							} 
							?>						
						</div>
						<?php
					}
					?>												
				</div>
			</div>

			<div class="hidden-lg hidden-md col-xs-15 col-sm-15 group-danhmuc-mobile">
				<div class="title-danhmuc-mobile">
					<span class="left">TẤT CẢ DANH MỤC</span>
					<span class="right">+</span>
				</div>
				<?php 
				wp_nav_menu(array(
						'menu' => "Danh mục",
						'container' => '',
						'menu_class' => "body-danhmuc-mobile"
					)); 
				?>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(".title-danhmuc-mobile").click(function(){
		jQuery(".title-danhmuc-mobile").find(".right").html("&minus;");
		jQuery(".body-danhmuc-mobile").toggle("slow");
	});	
</script>

<?php if ( is_active_sidebar( 'index-san-pham-chuyen-muc' ) ) : ?>
	<?php dynamic_sidebar( 'index-san-pham-chuyen-muc' ); ?>
<?php endif; ?>

<!-- Main -->




<!-- Trên footer -->
<div class="container-fluid group-pre-footers hidden">
	<div class="wrap">
		<div class="row">
			<div class="col-xs-15 col-lg-15 pre-footer-title">
				<i class="fa fa-user-md fa-3x" aria-hidden="true" style="margin-right: 5px;"></i>
				<span style="font-weight: bold; font-size: 24px; color: #09c6d9;">TIN TỨC NỔI BẬT | SỰ KIỆN KHUYẾN MÃI</span>
			</div>
		</div>

	</div>
</div>
<div class="container-fluid group-pre-footers-content hidden">
	<div class="wrap footer-full-height">
		<div class="row">
		<?php 
			$category_id = get_cat_ID('Tin tức');
			$args = array(
				'cat' => $category_id,
				'posts_per_page'      => 3,
				'post__in'            => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1,
			);
			$tin_tucs = new WP_Query( $args );
			if ($tin_tucs->have_posts() ) :
				$i = 1;
				while ($tin_tucs->have_posts()) : $tin_tucs->the_post();
				if ($i == 1 || $i == 2) {
		?>
			<div class="col-lg-4 col-xs-15 col-pre-footer">
				<div class="footer-news">
					<a href="<?php the_permalink(); ?>" class="footer-news-title">
						<?php the_title() ?>
					</a>
					<a href="<?php the_permalink(); ?>" class="footer-news-img">
						<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>">
					</a>
					<p class="footer-news-excerpt">
						<?php the_excerpt(); ?>
					</p>
					<a href="<?php the_permalink(); ?>">
						<div class="readmore">
							Xem thêm
						</div>
					</a>
					
				</div>
			</div>
		<?php } else { ?>
			<div class="col-lg-7 col-xs-15 col-pre-footer-right">
				<div class="footer-detail-news">
					<a href="<?php the_permalink(); ?>" class="footer-news-title">
						<?php the_title() ?>
					</a>
					<div class="main-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<a href="<?php the_permalink(); ?>">
						<div class="readmore special-readmore">
							Xem thêm
						</div>
					</a>
				</div>
			</div>	
		<?php } $i++; ?>	
		<?php endwhile; endif; wp_reset_postdata(); ?>	
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
		var w = jQuery( window ).width();
		if(w > 1023) {
			var i_w = 0;
			jQuery(".col-pre-footer").each(function() {
				var i_wr = parseInt(jQuery(this).height());
				if (i_w < i_wr) {
					i_w = i_wr;
				}
				i_w = i_w + 40;
				jQuery(".col-pre-footer-right").height(i_w);
			});
		}

		jQuery( window ).resize(function() {
			var w = parseInt(jQuery( this ).width());
			if(w > 1023) {
				var i_w = 0;
				jQuery(".col-pre-footer").each(function() {
					var i_wr = parseInt(jQuery(this).height());
					if (i_w < i_wr) {
						i_w = i_wr;
					}
					i_w = i_w + 40;
					jQuery(".col-pre-footer-right").height(i_w);
				});
			} else if(w < 1024) {
				jQuery(".col-pre-footer-right").each(function( index ) {
					jQuery(this).removeAttr("style");
				});
			}
		});
		
	});
	
</script>

<?php get_footer();