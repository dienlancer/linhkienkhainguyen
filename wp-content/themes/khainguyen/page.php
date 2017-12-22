<?php get_header();
 ?>

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


<div class="container-fluid ">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-xs-15">
				<div class="row row-sp-detail">
					<div class="col-lg-15 col-xs-15 col-sp-detail">
					<?php while ( have_posts() ) : the_post(); ?>
						<h1 class="title-detail-product" style="border-bottom: 0px;">
							<?php the_title(); ?>							
						</h1>
						<div class="format-main-detail">
							<?php the_content(); ?>		
						</div>
					<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>