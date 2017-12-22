<?php get_header(); 
$term_slug="";
$post_id=0;
$term=array();
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
					<?php 
					while ( have_posts() ) : the_post();
						$post_id=get_the_id(); 											
						$term = wp_get_object_terms( $post_id,  'chuyen-muc' );                    			            
					?>
					<div class="col-lg-5 col-xs-15 col-sp-detail">
						<h1 class="title-detail-product visible-xs hidden-lg"><?php the_title(); ?></h1>
						<a data-fancybox="gallery" class="fancybox-a-thumbnail" href="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>"><img class="img-detail-product" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'full') ?>" /></a>

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
						<div class="titan">
							<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){
					jQuery(".product-thumbnail-ds").owlCarousel({
						autoplay:false,                    
						loop:true,
						margin:10,                        
						nav:true,            
						mouseDrag:true,
						touchDrag: false,                                
						responsiveClass:true,
						responsive:{
							0:{
								items:1
							},
							600:{
								items:5
							},
							1000:{
								items:5
							}
						}
					});					
					var chevron_left='<i class="fa fa-chevron-left"></i>';
					var chevron_right='<i class="fa fa-chevron-right"></i>';
					jQuery("div.product-thumbnail-ds div.owl-prev").html(chevron_left);
					jQuery("div.product-thumbnail-ds div.owl-next").html(chevron_right);
				});                
			</script>
						<div class="owl-carousel product-thumbnail-ds owl-theme">
							<?php 
							$thumbnail_1=get_post_meta($post_id,"thumbnail_1",true);
							$thumbnail_2=get_post_meta($post_id,"thumbnail_2",true);
							$thumbnail_3=get_post_meta($post_id,"thumbnail_3",true);
							$thumbnail_4=get_post_meta($post_id,"thumbnail_4",true);
							$thumbnail_5=get_post_meta($post_id,"thumbnail_5",true);
							$thumbnail_6=get_post_meta($post_id,"thumbnail_6",true);
							$thumbnail_7=get_post_meta($post_id,"thumbnail_7",true);

							$featureImg_1=wp_get_attachment_image_src($thumbnail_1,"single-post-thumbnail");			
							$featureImg_2=wp_get_attachment_image_src($thumbnail_2,"single-post-thumbnail");			
							$featureImg_3=wp_get_attachment_image_src($thumbnail_3,"single-post-thumbnail");									
							$featureImg_4=wp_get_attachment_image_src($thumbnail_4,"single-post-thumbnail");			
							$featureImg_5=wp_get_attachment_image_src($thumbnail_5,"single-post-thumbnail");			
							$featureImg_6=wp_get_attachment_image_src($thumbnail_6,"single-post-thumbnail");									
							$featureImg_7=wp_get_attachment_image_src($thumbnail_7,"single-post-thumbnail");	
							$featureImgMain=get_the_post_thumbnail_url(get_the_id(), 'full');				

							if(count($featureImg_1) > 0) {
								if(!empty($featureImg_1[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_1[0]; ?>');"><img src="<?php echo $featureImg_1[0]; ?>" /></a></center>
										</div>
									</div>											
									<?php	
								}									
							}
							if(count($featureImg_2) > 0) {
								if(!empty($featureImg_2[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_2[0]; ?>');"><img src="<?php echo $featureImg_2[0]; ?>" /></a></center>
										</div>
									</div>											
									<?php
								}									
							}
							if(count($featureImg_3) > 0) {
								if(!empty($featureImg_3[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_3[0]; ?>');"><img src="<?php echo $featureImg_3[0]; ?>" /></a></center>
										</div>
									</div>
									
									<?php
								}									
							}
							if(count($featureImg_4) > 0) {
								if(!empty($featureImg_4[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_4[0]; ?>');"><img src="<?php echo $featureImg_4[0]; ?>" /></a></center>
										</div>
									</div>
									
									<?php	
								}									
							}
							if(count($featureImg_5) > 0) {
								if(!empty($featureImg_5[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_5[0]; ?>');"><img src="<?php echo $featureImg_5[0]; ?>" /></a></center>
										</div>
									</div>											
									<?php
								}									
							}
							if(count($featureImg_6) > 0) {
								if(!empty($featureImg_6[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_6[0]; ?>');"><img src="<?php echo $featureImg_6[0]; ?>" /></a></center>
										</div>
									</div>
									
									<?php
								}									
							}
							if(count($featureImg_7) > 0) {
								if(!empty($featureImg_7[0])){
									?>
									<div>
										<div class="product-detail-thumbnail-terran">
											<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImg_7[0]; ?>');"><img src="<?php echo $featureImg_7[0]; ?>" /></a></center>
										</div>
									</div>
									
									<?php
								}									
							}
							if(!empty($featureImgMain)){
								?>
								<div>
									<div class="product-detail-thumbnail-terran">
										<center><a href="javascript:void(0);" onclick="changeThumbnail('<?php echo $featureImgMain; ?>');"><img src="<?php echo $featureImgMain; ?>" /></a></center>
									</div>
								</div>											
								<?php
							}	
							?>			
						</div>
						</div>						
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

						<div class="product-detail-status">
							<?php 							
							$tinh_trang_hang=get_post_meta($post_id,"tinh_trang_hang",true);
							$tinh_trang_text="";
							switch ($tinh_trang_hang) {
								case 'con_hang':
								$tinh_trang_text="Còn hàng";
								break;
								case 'hang_ve_lai':
								$tinh_trang_text="Hàng về lại";
								break;
								case 'tam_het':
								$tinh_trang_text="Tạm hết";
								break;
								case 'hang_sap_ve':
								$tinh_trang_text="Hàng sắp về";
								break;
								default :
								$tinh_trang_text="Còn hàng";
								break;
							}
							?>
							Tình trạng : <span class="midu"><b><?php echo $tinh_trang_text; ?></b></span>
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
		<div class="row main-detail">
			<div class="col-lg-15 col-xs-15">
				<div class="border-lg">
					<div class="title-main-detail">
						SẢN PHẨM LIÊN QUAN
					</div>
					<div class="format-main-detail">
						<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){
					jQuery(".related-featured").owlCarousel({
						autoplay:false,                    
						loop:true,
						margin:10,                        
						nav:true,            
						mouseDrag:true,
						touchDrag: false,                                
						responsiveClass:true,
						responsive:{
							0:{
								items:1
							},
							600:{
								items:3
							},
							1000:{
								items:5
							}
						}
					});					
					var chevron_left='<i class="fa fa-chevron-left"></i>';
					var chevron_right='<i class="fa fa-chevron-right"></i>';
					jQuery("div.related-featured div.owl-prev").html(chevron_left);
					jQuery("div.related-featured div.owl-next").html(chevron_right);
				});                
			</script>
						<div class="owl-carousel related-featured owl-theme">
							<?php							
							$arrID=array(); 
							if(count($term) > 0){
								foreach ($term as $key => $value) {
									$arrID[]=$value->term_id;
								}
							}
							$args = array(
								'post_type' => 'san-pham',  
								'orderby' => 'date',
								'order'   => 'DESC',  
								'posts_per_page' => $product_number,        
								'post__not_in'=>array($post_id),
								'tax_query' => array(
									array(
										'taxonomy' => 'chuyen-muc',
										'field'    => 'term_id',
										'terms'    => $arrID,					
									),
								),
							);       
							$the_query=new WP_Query($args);							
							if($the_query->have_posts()){
								while ($the_query->have_posts()) {
									$the_query->the_post();
									$postID=$the_query->post->ID;
									$title=get_the_title($postID);
									$maintitle=$title;
									$title=SubTitle($title);
									$permalink=get_the_permalink($postID);
									$featureImg=get_the_post_thumbnail_url($postID, 'full');

									$tinh_trang_hang=get_post_meta($postID,"tinh_trang_hang",true);
									$masp=get_post_meta($postID, "ma_sp", true);
									$thoi_han_bh=get_post_meta($postID, "thoi_gianbao_hanh", true);									
									$check_gia = get_post_meta($postID, "gia_si", true);
									$gia_si_new = get_post_meta($postID, "gia_si_new", true);
									$tinh_trang_text="";
									switch ($tinh_trang_hang) {
										case 'con_hang':
											$tinh_trang_text="Còn hàng";
											break;
										case 'hang_ve_lai':
											$tinh_trang_text="Hàng về lại";
											break;
										case 'tam_het':
											$tinh_trang_text="Tạm hết";
											break;
										case 'hang_sap_ve':
											$tinh_trang_text="Hàng sắp về";
											break;
										default :
											$tinh_trang_text="Còn hàng";
											break;
									}

									?>
									<div class="box-product">
										<a href="<?php echo $permalink; ?>" class="a-product">
											<img class="" src="<?php echo $featureImg; ?>">
											
										</a>										
										<div class="title-product" data-toggle="tooltip" data-placement="top" title="<?php echo $maintitle; ?>">
												<?php echo $title; ?>
											</div>
										<div class="id-product">
										Mã SP: 	<?php echo $masp; ?>						</div>
										<div class="id-product">
										Bảo hành: <?php echo $thoi_han_bh; ?>							</div>
										<div class="price-product">											
											Giá lẻ: 
											<span class="price-vnd">
												<?php												
												if ($check_gia == 0) {
													echo "Liên hệ";
												} else {
													show_cost($check_gia);
												}										 
												?>										
											</span>
											<?php //} else { ?>
											<!-- Giá lẻ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true)) ?></span> -->
											<?php //} ?>
										</div>
										<div class="price-product">											
											Giá sỉ: 
											<span class="price-vnd">
												<?php												
												if ($gia_si_new === "" ) {
													echo "Liên hệ";
												} elseif ($gia_si_new == 0) {
													show_cost($check_gia * get_option('ti_le_phan_tram') / 100);
												} else {
													show_cost($gia_si_new);
												}									 
												?>										
											</span>
											<?php //} else { ?>
											<!-- Giá sỉ: <span class="price-vnd"><?php //show_cost(get_post_meta($id, "gia_si_khuyen_mai", true) * 0.7) ?></span> -->
											<?php //} ?>
										</div>
										
										<div class="hang-hoa-status">
								Tình trạng : <span class="midu"><b><?php echo $tinh_trang_text; ?></b></span>
							</div>
									</div>
									<?php
								}
								wp_reset_postdata();         
							}							
							?>											
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();