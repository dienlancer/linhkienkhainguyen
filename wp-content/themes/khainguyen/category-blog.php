<?php
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="remove-hover">Trang chủ</a></li>
					<!-- <li><a href="#">Library</a></li> -->
					<li class="active">Blog</li>
				</ol>
			</div>
		</div>
	</div>
</div>



<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row" >
			<div class="col-lg-15 col-sm-15 col-xs-15">
			<?php 
			global $query_string;
			$page_ = 1;
			if (isset($wp_query->query_vars['page'])) {
				$page_ = $wp_query->query_vars['page'];
				if ($page_ <= 0) $page_ = 1;
			} 
			$posts_per_page_ = 10;
			$first_post = ($page_-1)*$posts_per_page_;   

	        global $post;
	        query_posts("paged=$page_&posts_per_page=$posts_per_page_&" . $query_string);

			while ( have_posts() ) : the_post(); ?>
				<div class="blog-groups">
					<div class="row blog-group-img">
						<div class="col-lg-10 col-lg-offset-3 col-sm-15 col-xs-15">
							<a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" class="blog-img"></a>
						</div>
					</div>

					<div class="row blog-group-content">
						<div class="col-lg-8 col-lg-offset-4 col-sm-15 col-xs-15">
							<a href="<?php the_permalink() ?>" class="blog-title"><?php the_title() ?></a>
							<div class="blog-date">Ngày <?php the_date('d/m/Y') ?></div>
							<div class="blog-excerpt"><?php the_excerpt(); ?></div>
						</div>
					</div>
						
					<div class="row" style="padding-left: 15px; padding-right: 15px;">
						<div class="col-lg-10 col-lg-offset-3 col-sm-15 col-xs-15 blog-group-bottom"></div>
					</div>					

				</div>
			<?php endwhile; 
				if ( have_posts() ) {
			?>
				<nav aria-label="Page navigation" class="main-pagination">
					<ul class="pagination">
						<?php paging($query_string."&posts_per_page=-1", $page_, $posts_per_page_); ?>
					</ul>
				</nav>
			<?php } ?>

			</div>
		</div>
	</div>
</div>



<?php
//get_sidebar();
get_footer();
