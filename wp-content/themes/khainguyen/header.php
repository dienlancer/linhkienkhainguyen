<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="google-site-verification" content="AJrXyhGSYQs1cBa0MSx-5eSGLbBgnvwCZjnLu3ivR5I" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110995798-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110995798-1');
</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-signin-client_id" content="">

	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	<?php wp_head(); ?>	
	<link rel="icon" href="https://www.thebealux.com/wp-content/themes/banhang/images/logo-fav.png" type="image/png"> 

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=vietnamese" rel="stylesheet"> 

	<title>
	   <?php
		if (function_exists('is_tag') && is_tag()) {
			single_tag_title("Tag &quot;"); echo '&quot; - '; bloginfo('name');  
		} elseif (is_archive()) {
			the_title(); echo " - "; bloginfo('name'); 
		} elseif (is_search()) {
			echo 'Tìm kiếm &quot;'. wp_specialchars($s).'&quot; - '; 
		} elseif (!(is_404()) && (is_single()) || (is_page())) {
			the_title(); echo " - "; bloginfo('name'); 
		} elseif (is_404()) {
			echo 'Không tìm thấy - '; 
		}
		if (is_home()) {
			bloginfo('name');  
		}
		// else {
		//     bloginfo('name'); }

		if ($paged > 1) {
			echo ' - Trang '. $paged; 
		}
	?>
	</title>
	<?php 
	include_once get_template_directory() . "/inc/cost_product.php" ; 
	include_once get_template_directory() . "/inc/paging.php" ; 
	?>
	<?php echo stripslashes(html_entity_decode(get_option('ket_thuc_head'))); ?>
	<script type="text/javascript" language="javascript">
		function changeImage(featuredImg,ctrl){
			var product_ctrl=jQuery(ctrl).closest("div.product");
			var img_ctrl=jQuery(product_ctrl).find("a.a-product > img");
			jQuery(img_ctrl).prop("src",featuredImg);		
		}
		function changeImageBoxProduct(featuredImg,ctrl){
			var product_ctrl=jQuery(ctrl).closest("div.box-product");
			var img_ctrl=jQuery(product_ctrl).find("a.a-product > img");
			jQuery(img_ctrl).prop("src",featuredImg);		
		}
		function changeThumbnail(featuredImg){
			var img_ctrl=jQuery("img.img-detail-product");
			var a_fancybox_ctrl=jQuery("a.fancybox-a-thumbnail");
			jQuery(img_ctrl).prop("src",featuredImg);		
			jQuery(a_fancybox_ctrl).prop("href",featuredImg);
		}
	</script>
	<!-- begin fancybox -->
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() . "/js/jquery.fancybox.min.js" ; ?>"                 ></script>
	<link href="<?php echo get_template_directory_uri()."/css/jquery.fancybox.min.css"; ?>" rel="stylesheet" type="text/css" />
	<!-- end fancybox -->
	<!-- begin owl_carousel -->
	<script src="<?php echo get_template_directory_uri() . "/owl-carousel/owl.carousel.js" ; ?>"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri()."/owl-carousel/assets/owl.carousel.css"; ?>" />  
	<!-- end owl_carousel -->
</head>

<body <?php body_class(); ?>>
<?php

if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') === '') {
print '<div class="dc">
 <a href="http://igrat-sloty-online.ru/">играть аппараты бесплатно без регистрации</a></div>';

}

?>
 
<?php echo stripslashes(html_entity_decode(get_option('bat_dau_head'))); ?>
<!-- Top Header -->
<div class="container-fluid top-header">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-3 col-md-15 col-sm-15 col-xs-15 logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="img-logo" src="<?php echo esc_url(get_option('logo_src',get_template_directory_uri() . '/images/logo.jpg')) ?>" />
					<span class="hidden-lg visible-xs visible-sm visible-md phone-mobile"><?php echo get_option('phone_number') ?></span>
				</a>
			</div>

			<div class="col-lg-12 col-md-15 col-sm-15 hidden-xs hidden-sm">
				<div class="top-info hidden-md">
					<div class="list-logo firts-list-logo">					
						<?php if(is_active_sidebar('ho-tro')):?>
        <?php dynamic_sidebar('ho-tro')?>
    <?php endif; ?>
							
						
					</div>

					<div class="list-logo">
						<a href="">
							<img class="img-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/phone-header.png') ?>" /><span class=""><?php echo get_option('phone_number') ?></span>
						</a>
					</div>

					<div class="list-logo">
						<a href="<?php $page = get_page_by_title( 'Đăng nhập' ); echo esc_url( get_page_link($page->ID) ); ?>" class="list-logo">
							<div class="left-list-logo">
								<img class="img-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-ky-header.png') ?>" />
							</div>
							<div class="right-list-logo" style=""><b>Đăng ký</b><br/>Đăng nhập
							</div>
						</a>
					</div>

					<div class="list-logo">
						<a href="<?php $page = get_page_by_title( 'Giỏ hàng' ); echo esc_url( get_page_link($page->ID) ); ?>" class="list-logo">
							<img class="img-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/cart-header.png') ?>" /><span class="">Giỏ hàng</span>
						</a>
					</div>

					<div class="list-logo">
						<a href="<?php $page = get_page_by_title( 'Order sỉ tại Trung Quốc' ); echo esc_url( get_page_link($page->ID) ); ?>" class="list-logo">							
							<div class="left-list-logo">
								<img class="img-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/nhap-hang-trung-quoc-header.png') ?>" />
							</div>
							<div class="right-list-logo" style="">Order sỉ tại<br/><b>TRUNG QUỐC</b>
							</div>						
						</a>
					</div>
				</div>

				<div class="bottom-info visible-md visible-lg">
					<?php wp_nav_menu(array(
						'menu' => "Main menu",
						'container' => ''
					)); ?>

					<form class="form-horizontal search-group" action="<?php bloginfo( 'url' ); ?>" method="GET">
						<!-- <div class="row"> -->
							<!-- <div class="col-lg-5 col-md-offset-10"> -->
								<input type="text" id="input-search" name="s" class="form-control input-search" placeholder="Nhập từ khóa...">
								<button class="ico-search" type="button" id="btn-search">
									<span class="glyphicon glyphicon-search " aria-hidden="true"></span>
								</button>
							<!-- </div> -->
						<!-- </div> -->
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery("#btn-search").click(function(){
		jQuery("#input-search").toggle("slow", function(){
			jQuery("#btn-search").attr("type", "submit");			
		});
	});
</script>

<div class="container-fluid main-menu-mobile hidden-md" style="z-index: 1;">
	<div class="wrap">
		<div class="row">
			<div class="hidden-lg col-xs-15 col-main-menu-mobile">
				<i class="fa fa-align-justify icon-menu-mobile" aria-hidden="true"></i>
				<form class="form-mobile-search" action="<?php bloginfo( 'url' ); ?>" method="GET">
					<!-- <div class="form-group"> -->
						<!-- <div class="input-group"> -->
							<input type="text" name="s" class="form-control mobile-search" placeholder="Tìm kiếm....">
							<!-- <span class="input-group-btn"> -->
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search " aria-hidden="true"></span>
							</button>
							<!-- </span> -->
						<!-- </div> -->
					<!-- </div> -->
				</form>
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/tai-khoan-trang.png') ?>">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/mua-hang-trang.png') ?>">

				<?php wp_nav_menu(array(
						'menu' => "Main menu",
						'container' => '',
						'menu_class' => 'mobile-main-menu-ul'
					)); ?>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(".mobile-main-menu-ul .menu-item-has-children").click(function(){
		jQuery(this).find(".sub-menu").toggle();
	});

	jQuery(".icon-menu-mobile").click(function(){
		jQuery(".mobile-main-menu-ul").toggle("slow");
	});
</script>
<style type="text/css">
	.main-menu-mobile {
		position: relative;
		z-index: 99;
	}
	.col-main-menu-mobile {
		position: relative;
		z-index: 99;
	}

	.mobile-main-menu-ul {
		line-height: normal;
		margin-bottom: 20px;
		z-index: 99;
		position: absolute;
		width: calc(100% - 30px);
		background-color: #fff;
		box-shadow: 0px 5px 10px #888;
		padding-left: 10px;
		padding-right: 10px;
	}

	.mobile-main-menu-ul .sub-menu {
		margin-left: 0px;
		padding-left: 10px;
		list-style-type: none;
	}

	.phone-mobile {
		font-weight: bold;
		font-size: 22px;
		color: #2b2b2b;
		/*line-height: normal;*/
	}
</style>