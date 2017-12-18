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
						<?php the_title(); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<style type="text/css">
	.groups-link-path {
		margin-top: 10px;
		margin-bottom: 20px;
	}
	.group-link-path {
		color: #2b2b2b;
		font-size: 14px;
		font-style: italic;
	}

	.link-path {
		display: inline-block;
		font-size: 14px;
		font-style: italic;
	}

	.link-path > a {
		color: #2b2b2b;
	}
	.link-path:after {
		content: ">";
		margin-right: 2px;
		margin-left: 2px;
	}
	.link-path:last-child:after {
		content: "";
		margin-right: 0px;
		margin-left: 0px;
	}
</style>

<div class="container-fluid ">
	<div class="wrap">
		<div class="row">
			<?php get_sidebar(); ?>

			<div class="col-lg-12 col-xs-15">
				<div class="row row-sp-detail">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-lg-5 col-xs-15 col-sp-detail">
						<h1 class="title-detail-product visible-xs hidden-lg"><?php the_title(); ?></h1>
						<img class="img-detail-product" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" />

					<!-- 	<div id="carousel-example-generic" class="carousel slide hidden-xs slide-show" data-ride="carousel">

							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<div class="row">
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
									</div>
									
								</div>
								<div class="item"> -->
									<!-- <div class="row slide-show hidden-xs">
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div>
										<div class="col-lg-3">
											<img src="<?php //echo esc_url(get_template_directory_uri() . '/images/tin-tuc.jpg') ?>" alt="...">
										</div> -->
									<!-- </div>
								</div>
							</div>
 -->
						<!-- </div> -->

					</div>
					<div class="col-lg-10 col-xs-15 col-sp-detail ">
						<h1 class="title-detail-product hidden-xs"><?php the_title(); ?></h1>
						<div class="content-right-detail">
							<?php get_post_meta($id, "mo_ta_san_pham", true) ?>
						</div>
						<div class="price-detail-right">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/icon-san-pham-khuyen-mai.png') ?>">
							<?php 
							// if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) {
								echo '<span class="price new-price">Giá lẻ: </span>';
								echo '<span class="price new-price">';

								$check_gia = get_post_meta($id, "gia_si", true);
								if ($check_gia == 0) {
									echo "Liên hệ";
								} else {
									show_cost($check_gia);
								}										 

								 // . get_show_cost(get_post_meta($id, "gia_si", true)) . 
								echo '</span>';
							// } else {
							// 	echo '<span class="price old-price">Giá lẻ cũ: </span>';
							// 	echo '<span class="price old-price-cost">' . get_show_cost(get_post_meta($id, "gia_si", true)) . '</span>';
							// 	echo '<span class="price new-price">Giá lẻ mới: </span>';
							// 	echo '<span class="price old-price-cost">' . get_show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) . '</span>';
							// }
							?>
						</div>

						<div class="price-detail-right">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/icon-san-pham-khuyen-mai.png') ?>">
							<?php 
							// if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) {
								echo '<span class="price new-price">Giá sỉ: </span>';
								echo '<span class="price new-price">';

								$check_gia = get_post_meta($id, "gia_si", true);
								$gia_si_new = get_post_meta($id, "gia_si_new", true);
								// if ($check_gia == 0) {
								// 	echo "Liên hệ";
								// } else {
									if ($gia_si_new === "") {
										echo "Liên hệ";
									} elseif ($gia_si_new == 0) {
										show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
									} else {
										show_cost($gia_si_new);
									}									
								// }										 

								 // . get_show_cost(get_post_meta($id, "gia_si", true)) . 
								echo '</span>';
							// } else {
							// 	echo '<span class="price old-price">Giá sỉ cũ: </span>';
							// 	echo '<span class="price old-price-cost">' . get_show_cost(get_post_meta($id, "gia_si", true) * 0.7) . '</span>';
							// 	echo '<span class="price new-price">Giá sỉ mới: </span>';
							// 	echo '<span class="price old-price-cost">' . get_show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) . '</span>';
							// }
							?>
						</div>

						<div class="import-detail-right">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/nhap-hang-trung-quoc-header.png') ?>">
							<span style="font-size: 18px; font-style: italic; font-weight: bold; color: #2b2b2b; margin-left: 15px;">Nhập hàng Trung Quốc</span>
						</div>
					</div>
				</div>

				<div class="row main-detail">
					<div class="col-lg-15 col-xs-15">
						<div class="border-lg">
							<div class="title-main-detail">
								THÔNG TIN SẢN PHẨM
							</div>
							<div class="format-main-detail">
								<?php the_content(); ?>
							</div>

						</div>
					</div>
				</div>
				<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();