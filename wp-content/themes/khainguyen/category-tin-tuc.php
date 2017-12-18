<?php get_header(); ?>
<div class="container-fluid groups-link-path">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-xs-15">
				<div class="group-link-path">
					<div class="link-path">
						<a href="">Trang chủ</a>
					</div>
					<div class="link-path active">
						<?php single_cat_title(); ?>
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


<div class="container-fluid groups-detail-giasi">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-10">
				<div class="row hidden-xs">
					<div class="col-lg-7">
				<?php 
					$category_id = get_cat_ID('Tin tức');
			        $tin_tucs = new WP_Query(array(
			        		'cat' => $category_id,
			        		'posts_per_page' => 1,
		        			'ignore_sticky_posts' => 1
			        	));
					if ($tin_tucs->have_posts() ) :
					while ($tin_tucs->have_posts()) : $tin_tucs->the_post();
				?>
						<a class="special-tin-tuc" href="<?php the_permalink(); ?>">
							<img class="img-responsive img-khuyen-mai" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>">
							<div class="title-sidebar-khuyen-mai">								
								<?php the_title(); ?>
							</div>
						</a>
						<div class="common-p special-tin-tuc-excerpt">
							<?php the_excerpt() ?>
						</div>
				<?php endwhile; endif; wp_reset_postdata(); ?>		
					</div>

					<div class="col-lg-8">
						<ul class="tin-tuc-right-group">
				<?php 
					$category_id = get_cat_ID('Tin tức');
			        $tin_tucs = new WP_Query(array(
			        		'cat' => $category_id,
			        		'posts_per_page' => 5,
			        		'offset' => 1,
		        			'ignore_sticky_posts' => 1
			        	));
					if ($tin_tucs->have_posts() ) :
					while ($tin_tucs->have_posts()) : $tin_tucs->the_post();
				?>
							<li class="tin-tuc-right-li"><a class="tin-tuc-right-a" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_postdata(); ?>		
						</ul>
					</div>
				</div>

				<!-- Main tin tức -->
				<div class="special-tin-tuc-border"></div>

			<?php 
				$page_ = 1;
				if (isset($wp_query->query_vars['page'])) {
					$page_ = $wp_query->query_vars['page'];
					if ($page_ <= 0) $page_ = 1;
				} 
				$posts_per_page_ = 10;
				// $first_post = ($page_-1)*$posts_per_page_;   
				$first_post = ($page_-1)* ($posts_per_page_ + 6);   

				$category_id = get_cat_ID('Tin tức');
		        $tin_tucs = new WP_Query(array(
		        		'cat' => $category_id,
		        		'posts_per_page' => $posts_per_page_,
		        		'offset' => 6,
		        		'ignore_sticky_posts' => 1
		        	));
				if ($tin_tucs->have_posts() ) :
				while ($tin_tucs->have_posts()) : $tin_tucs->the_post();
			?>

				<div class="row">
					<div class="col-xs-15 col-lg-5">
						<a class="" href="<?php the_permalink(); ?>">
							<img class="img-responsive img-khuyen-mai" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>">
						</a>
					</div>

					<div class="col-xs-15 col-lg-10">
						<a class="" href="">
							<div class="title-content-khuyen-mai">								
								<?php the_title(); ?>
							</div>
						</a>
						<div class="common-p special-tin-tuc-excerpt">
							<?php the_excerpt() ?>
						</div>
					</div>
				</div>
				<div class="special-tin-tuc-border"></div>
			<?php 
				endwhile;   
			?>		
				<nav aria-label="Page navigation" class="main-pagination">
					<ul class="pagination">
						<?php 
							$query_pg = new WP_Query(array(
				        		'cat' => $category_id,
				        		'posts_per_page' => -1,
				        		'offset' => 1,
			        			'ignore_sticky_posts' => 1
				        	));
							paging($query_pg, $page_, $posts_per_page_); 
						?>
					</ul>

				</nav>
				<?php 
					endif;
					wp_reset_postdata(); 
				?>
			</div>
				
			<!-- Tin khuyến mãi -->
			<div class="col-lg-5 hidden-xs" >
				<div class="tin-khuyen-mai">TIN KHUYẾN MÃI</div>
				<?php 
					$category_id = get_cat_ID('Tin khuyến mãi');
			        $tin_khuyen_mais = new WP_Query(array(
			        		'cat' => $category_id,
			        		'posts_per_page' => 5
			        	));
					if ($tin_khuyen_mais->have_posts() ) :
					while ($tin_khuyen_mais->have_posts()) : $tin_khuyen_mais->the_post();
				?>
				<div class="group-khuyen-mai">
					<a class="" href="<?php the_permalink(); ?>">
					<img class="img-responsive img-khuyen-mai" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>">
						<div class="title-sidebar-khuyen-mai">								
							<?php the_title(); ?>
						</div>
					</a>
				</div>

				<?php endwhile; endif; wp_reset_postdata(); ?>	
			</div>

		</div>
	</div>
</div>


<div style="margin-bottom: 100px;"></div>

<style type="text/css">
	.tin-khuyen-mai {
		font-weight: bold;
		font-size: 18px;
		color: #2b2b2b;
		border-bottom: 1px solid #333;
	}

	.group-khuyen-mai {
		margin-top: 20px;
		padding-bottom: 10px;
	}

	.img-khuyen-mai {
		width: 100%;
		height: auto;
	}

	.title-sidebar-khuyen-mai {
		font-weight: bold;
		color: #2b2b2b !important;
		font-size: 18px;
		display: block;
		margin-top: 15px;
		line-height: normal;
	}

	.special-tin-tuc > .title-sidebar-khuyen-mai {
		text-transform: uppercase;
	}

	.tin-tuc-right-group {
		list-style-type: none;
		margin: 0px;
		padding: 0px;
	}

	.tin-tuc-right-a {
		display: block;
		font-size: 18px;
		color: #2b2b2b !important;
		padding: 15px 0px;
		line-height: normal;
		font-weight: bold;
	}

	.tin-tuc-right-a:first-child {
		padding-top: 5px;
	}

	.tin-tuc-right-li {
		border-bottom: 1px solid #c5c4c4;
	}

	.tin-tuc-right-li:last-child {
		border-bottom: 0px;
	}

	.special-tin-tuc-excerpt {
		color: #2b2b2b;
		margin-top: 15px;
	}

	.special-tin-tuc-border {
		margin-top: 20px;
		margin-bottom: 20px;
		border-bottom: 1px solid #b7b7b7;
	}

	.special-tin-tuc-border:last-child {
		margin-bottom: 20px;
		border-bottom: 0px;
	}

	.title-content-khuyen-mai {
		font-weight: bold;
		color: #2b2b2b;
		font-size: 18px;
		line-height: normal;
	}
</style>
<?php get_footer();