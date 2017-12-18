<?php
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
					<!-- <li><a href="#">Library</a></li> -->
					<li class="active">Thương hiệu</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<!-- <div class="col-lg-15 col-sm-15 col-xs-15 choose-sex">
				<a href="#" class="sex sex-active">NỮ</a>
				<a href="#" class="sex">NAM</a>
			</div> -->
		<?php
			$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
			$categories = get_terms( 'chuyen-muc', array(
			    'hide_empty' => 0,
			    'child_of' => $parent->term_id
			) );
			foreach ($categories as $term) {
				// echo '<li class=""><a href="' . esc_url(get_term_link($term->term_id) ) . '">' . $term->name . '</a></li>';			
				echo '<div class="col-lg-3 col-sm-5 col-xs-15 thuonghieu-title">' . $term->name . '</div>'; 
				echo '<div class="col-lg-12 col-sm-10 col-xs-15 thuonghieu-content">';
				$_opName = "TH-CM-" . $term->slug;
                $ar_ids = get_option($_opName);
                foreach ($ar_ids as $_id) {
                	$_term = get_term( $_id, 'chuyen-muc' );
                	// echo '<a class="brand-name" href="' . esc_url(get_term_link($_term->term_id) ) . '">' . $_term->name. '</a>';
                	echo '<a class="brand-name" href="' . esc_url(get_term_link($term->term_id) ) . '?tim-thuong-hieu=' . $_term->term_id . '&tim-theo-gia=all">' . $_term->name. '</a>';
				}
				echo '</div>';
			} 
		?>
			
			

			<!-- <div class="col-lg-3 col-sm-5 col-xs-15 thuonghieu-title">
				Son
			</div>
			<div class="col-lg-12 col-sm-10 col-xs-15 thuonghieu-content">
				<a class="brand-name">CK</a>
				<a class="brand-name">Chanel</a>
				<a class="brand-name">CK</a>
				<a class="brand-name">Chanel</a>
				<a class="brand-name">CK</a>
				<a class="brand-name">Chanel</a>
				<a class="brand-name">CK</a>
				<a class="brand-name">Chanel</a>
				<a class="brand-name">CK</a>
				<a class="brand-name">Chanel</a>
			</div> -->
		</div>
	</div>
</div>

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
