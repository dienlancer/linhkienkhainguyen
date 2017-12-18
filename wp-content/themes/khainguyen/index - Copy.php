<?php
get_header(); ?>

<div class="container-fluid">
	<div class="wrap main-content home-main">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<style type="text/css">
					.banners img {
						width: 100%;
						height: auto;
					}

					.banner-left {
						width: 33.33%;
						float: left;
						padding-right: 24px;						
					}

					.banner-right {
						width: 66.67%;
						float: left;
						padding-left: 6px;
					}

					.child-banner-left {
						width: 50%;
						float: left;
						padding-right: 15px;	
						padding-top: 0px;					
					}

					.child-banner-bottom .child-banner-left:first-child {
						padding-top: 30px;
					}

					.child-banner-right {
						width: 50%;
						float: left;
						padding-left: 15px;
						padding-top: 0px;
					}

					.child-banner-bottom .child-banner-right:first-child {
						padding-top: 30px;
					}

					@media (max-width: 1200px) { 
						.child-banner img {
							max-width: none !important;
						}
						.banner-left {
							width: calc(50% - 20px);
							padding-right: 0px;	
							margin-right: 20px;					
						}

						.banner-right {
							width: 50%;
							padding-left: 0px;
						}

						.child-banner-left {
							width: calc(50% - 10px);
							margin-right: 10px;
							overflow: hidden;
							padding-right: 0px;
							padding-top: 0px;
						}

						.child-banner-right {
							width: calc(50% - 10px);
							margin-left: 10px;
							padding-left: 0px;
							overflow: hidden;
							padding-top: 0px;
						}

						.child-banner-bottom .child-banner-left:first-child {
							padding-top: 20px;
						}

						.child-banner-bottom .child-banner-right:first-child {
							padding-top: 20px;							
						}

					}

					@media (max-width: 768px) { 
						.banner-left {
							width: 100%;
							padding-right: 0px;
							margin-right: 0px;
						} 

						.banner-right { 
							width: 100%;
							padding-left: 0px;
						}

						.child-banner-right, .child-banner-left {
							margin-top: 20px; 
							padding-top: 0px !important;
						}

						.child-banner img {
							max-width: none;
						}

					}
				</style>

				
				<?php  
					$hinhanh = get_option('__images_banner_large', array());
					$hinh_small = get_option('__images_banner_small', array());
					if ($hinhanh) { 
				?>
				<div class="banners visible-lg hidden-md hidden-sm hidden-xs">
				<!-- <div class="banners hidden-lg visible-md visible-sm visible-xs"> -->
					<div class="banner-left">
						<a href=""><img src="<?php echo esc_url($hinhanh[0]) ?>"></a>
					</div>				

					<div class="banner-right">
						<div class="child-banner child-banner-top">
							<a href="">
								<div class="child-banner-left">
									<img src="<?php echo esc_url($hinhanh[1]) ?>">
								</div>
							</a>
							<a href="">
								<div class="child-banner-right">
									<img src="<?php echo esc_url($hinhanh[2]) ?>">
								</div>
							</a>
							<div class=""></div>
						</div>

						<div class="child-banner child-banner-bottom">
							<a href="">
								<div class="child-banner-left">
									<img src="<?php echo esc_url($hinhanh[3]) ?>">
								</div>
							</a>
							<a href="">
								<div class="child-banner-right">
									<img src="<?php echo esc_url($hinhanh[4]) ?>">
								</div>
							</a>

						</div>
					</div>

					<div class="clearfix"></div>
				</div>
			<?php } 
				if ($hinh_small) { 
			?>
				<div class="banners hidden-lg visible-md visible-sm visible-xs">
				<!-- <div class="banners visible-lg hidden-md hidden-sm hidden-xs"> -->
					<div class="banner-left banner-left-mobile">
						<a href=""><img src="<?php echo esc_url($hinh_small[0]) ?>"></a>
					</div>				

					<div class="banner-right">
						<div class="child-banner child-banner-mobile child-banner-top">
							<a href="">
								<div class="child-banner-left">
									<img src="<?php echo esc_url($hinh_small[1]) ?>">
								</div>
							</a>
							<a href="">
								<div class="child-banner-right">
									<img src="<?php echo esc_url($hinh_small[2]) ?>">
								</div>
							</a>
							<div class=""></div>
						</div>

						<div class="child-banner child-banner-mobile child-banner-bottom">
							<a href="">
								<div class="child-banner-left">
									<img src="<?php echo esc_url($hinh_small[3]) ?>">
								</div>
							</a>
							<a href="">
								<div class="child-banner-right">
									<img src="<?php echo esc_url($hinh_small[4]) ?>">
								</div>
							</a>

						</div>
					</div>

					<div class="clearfix"></div>
				</div>
			<?php } ?>

				<script type="text/javascript">
					jQuery( document ).ready(function() { 
						var screen = jQuery('.container-fluid').width();
						// var screen = jQuery(document).width();
						// alert(screen);

						// Desktop
						// if (screen < 1200 && screen > 700 ) {
						// 	var heigth = jQuery('.banner-left img').width() - 20;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						//     });	
						// } else {
						// 	var heigth = jQuery('.banner-left img').width() - 30;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						//     });	
						// }
						if (screen >= 1200) {
							var heigth = jQuery('.banner-left img').width() - 30;
							heigth = heigth / 2;
							jQuery('.child-banner img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						    });	
						}
						// End Desktop

						// Mobile
						// if (screen < 1200 && screen > 700 ) {
						// 	var heigth = jQuery('.banner-left-mobile img').width() - 20;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner-mobile img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						//     });	
						// } else {
						// 	var heigth = jQuery('.banner-left-mobile img').width() - 30;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner-mobile img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						//     });	
						// }	
						if (screen < 1200 && screen > 700 ) {
							var heigth = jQuery('.banner-left-mobile img').width() - 20;
							heigth = heigth / 2;
							jQuery('.child-banner-mobile img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						    });	
						} 
						if (screen <= 700) {
							var heigth = jQuery('.banner-left-mobile img').width() - 30;
							heigth = heigth / 2;
							jQuery('.child-banner-mobile img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						    });	
						}								
					});
					jQuery( window ).resize(function() {
						var screen = jQuery(document).width();
						var screen = jQuery('.container-fluid').width();
						// Desktop
						// if (screen < 1200 && screen > 700  ) {
						// 	var heigth = jQuery('.banner-left img').width() - 20;
						// 	heigth = heigth / 2;

						// 	jQuery('.child-banner img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						//     });						
						// } else {
						// 	var heigth = jQuery('.banner-left img').width() - 30;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						//     });							
						// }

						if (screen >= 1200) {
							var heigth = jQuery('.banner-left img').width() - 30;
							heigth = heigth / 2;
							jQuery('.child-banner img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						    });	
						}
						// End Desktop

						// Mobile
						// if (screen < 1200 && screen > 700  ) {
						// 	var heigth = jQuery('.banner-left-mobile img').width() - 20;
						// 	heigth = heigth / 2;

						// 	jQuery('.child-banner-mobile img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						//     });						
						// } else {
						// 	var heigth = jQuery('.banner-left-mobile img').width() - 30;
						// 	heigth = heigth / 2;
						// 	jQuery('.child-banner img').each(function(){
						// 		jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						//     });							
						// }
						if (screen < 1200 && screen > 700 ) {
							var heigth = jQuery('.banner-left-mobile img').width() - 20;
							heigth = heigth / 2;
							jQuery('.child-banner-mobile img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto', 'max-width' : 'none'});
						    });	
						} 
						if (screen <= 700) {
							var heigth = jQuery('.banner-left-mobile img').width() - 30;
							heigth = heigth / 2;
							jQuery('.child-banner-mobile img').each(function(){
								jQuery(this).css({'height' : heigth, 'width' : 'auto'});
						    });	
						}	
					});	
				</script>

				<?php 
					// include get_template_directory() . '/inc/san-pham-widget-content.php';
				?>

				<?php if ( is_active_sidebar( 'index-san-pham-chuyen-muc' ) ) : ?>
					<!-- <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary"> -->
					<?php dynamic_sidebar( 'index-san-pham-chuyen-muc' ); ?>
					<!-- </div> -->
				<?php endif; ?>


				<!-- Thương hiệu -->
				<div class="index-thuong-hieu">
					<div class="title">
						<div class="title-content">Thương hiệu</div>
					</div>

					<div id="carousel-thuonghieu-desktop" class="carousel slide slider-thuonghieu hidden-md hidden-sm hidden-xs" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">

					<?php 
						$hinhanh = get_option('__images', array());
						$ten_thuong_hieu = get_option('__ten_thuong_hieu', array());

					// if(is_array($hinhanh)) {
						foreach ($hinhanh as $i=> $img) {
							if ($i % 5 == 0) {
								if ($i == 0) {
									echo '<div class="item active ">';
								} else {
									echo '<div class="item">';
								}								
								echo '<div class="row">';
							}
					?>
									<div class="col-lg-3 col-md-5 col-sm-5 col-xs-7 col-thuonghieu">
										<a href="<?php echo get_term_link(get_term_by('name', $ten_thuong_hieu[$i], 'chuyen-muc')); ?>"><img src="<?php echo $img ?>" class=""></a>
									</div>								
					<?php 
							if (($i + 1) % 5 == 0) {
								echo '</div></div>';
							}
						} 

						if (($i + 1) % 5 != 0) {
							echo '</div></div>';
						}
						// } 
					?>						
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-thuonghieu-desktop" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-thuonghieu-desktop" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
						</a>
					</div>
					<!-- End Desktop -->


					<div id="carousel-thuonghieu-tablet" class="carousel slide slider-thuonghieu hidden-lg hidden-xs" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">

					<?php 
						$hinhanh = get_option('__images', array());
						$ten_thuong_hieu = get_option('__ten_thuong_hieu', array());

						foreach ($hinhanh as $i=> $img) {
							if ($i % 3 == 0) {
								if ($i == 0) {
									echo '<div class="item active">';
								} else {
									echo '<div class="item">';
								}								
								echo '<div class="row">';
							}
					?>
									<div class="col-lg-3 col-md-5 col-sm-5 col-xs-7 col-thuonghieu">
										<a href="<?php echo get_term_link(get_term_by('name', $ten_thuong_hieu[$i], 'chuyen-muc')); ?>"><img src="<?php echo $img ?>" class="" /></a>
									</div>								
						<?php 
								if (($i + 1) % 3 == 0) {
									echo '</div></div>';
								}
							} 
							if (($i + 1) % 3 != 0) {
								echo '</div></div>';
							}
							// } 
						?>
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-thuonghieu-tablet" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-thuonghieu-tablet" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
						</a>
					</div>
					<!-- End Tablet -->

					<div id="carousel-thuonghieu-mobile" class="carousel slide slider-thuonghieu hidden-lg hidden-md hidden-sm" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">

					<?php 
						$hinhanh = get_option('__images', array());
						$ten_thuong_hieu = get_option('__ten_thuong_hieu', array());

						foreach ($hinhanh as $i=> $img) {
							if ($i % 2 == 0) {
								if ($i == 0) {
									echo '<div class="item active">';
								} else {
									echo '<div class="item">';
								}								
								echo '<div class="row">';
							}
					?>
									<div class="col-lg-3 col-md-5 col-sm-5 col-xs-7 col-thuonghieu">
										<a href="<?php echo get_term_link(get_term_by('name', $ten_thuong_hieu[$i], 'chuyen-muc')); ?>"><img src="<?php echo $img ?>" class="" /></a>
									</div>								
					<?php 
							if (($i + 1) % 2 == 0) {
								echo '</div></div>';
							}

						} 
						if (($i + 1) % 2 != 0) {
							echo '</div></div>';
						}
						// } 
					?>
	
						<!-- End Tablet -->
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-thuonghieu-mobile" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-thuonghieu-mobile" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
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
