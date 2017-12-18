<?php 
// $page = get_page_by_title( 'Sản phẩm' );
// echo $GLOBALS['wp_query']->request;

//echo '<a href="'. get_page_link($page->ID) . '">Map</a>';
// echo '<li class="current-menu-item"><a href="' . esc_url(get_term_link(2,  "chuyen-muc") ) . '">Sản phẩm</a></li>';
// echo get_query_var( 'taxonomy' );
// echo get_query_var( 'term' );
// echo get_queried_object()->term_id;
get_header(); ?>

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
	// if (get_query_var( 'term' ) == "san-pham") {
	// 	include get_template_directory() . '/inc/archive_parent.php';
	// } else {
		include get_template_directory() . '/inc/archive_child.php';
	// }
?>

<?php
// if ( have_posts() ) : 
// 			the_archive_title( '<h1 class="page-title">', '</h1>' );
// 			the_archive_description( '<div class="archive-description">', '</div>' );
// 	while ( have_posts() ) : the_post();
// 		get_template_part( 'template-parts/content', get_post_format() );
// 	endwhile;
// 	the_posts_navigation();
// endif;

// get_sidebar();
get_footer();
