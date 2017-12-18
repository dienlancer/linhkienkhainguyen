<?php get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
					<!-- <li><a href="#">Library</a></li> -->
					<li class="active"><?php single_cat_title( '' ) ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php 
	// echo get_queried_object()->term_id; 
	include get_template_directory() . '/inc/archive_parent.php';
?>

<?php
get_footer();
