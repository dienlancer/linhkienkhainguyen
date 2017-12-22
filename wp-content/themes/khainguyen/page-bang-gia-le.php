<?php get_header(); 
?>

<div class="container-fluid groups-link-path">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-xs-15">
				<div class="group-link-path">
					<div class="link-path">
						<a href="">Trang chủ</a>
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

<div class="container-fluid groups-detail-giasi">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 col-md-15">
				<div style="font-weight: bold; color: #2b2b2b; font-size: 24px; margin-bottom: 20px;">BẢNG GIÁ SỈ</div>

				<?php while ( have_posts() ) : the_post(); ?>
					<div class="common-p">
						<?php the_content(); ?>		
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid groups-tim-gia-si hidden-lg hidden-md">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15">
				<form class="form-inline" method="GET" action="<?php the_permalink() ?>">
					<div class="form-group">
						<div class="input-group search-gia-si">
							<input type="text" class="form-control" placeholder="Nhập tên sản phẩm cần tìm...." name="ten-gia-si">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search " aria-hidden="true"></span>
								</button>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
if (empty($_GET['ten-gia-si'])) {	
	$categories = array();
	$categories[] = get_term_by('name', 'Sản phẩm mới', 'chuyen-muc');
	$categories[] = get_term_by('name', 'ĐỒ CHƠI CÔNG NGHỆ', 'chuyen-muc');
	$categories[] = get_term_by('name', 'HÀNG CHÍNH HÃNG', 'chuyen-muc');
	$categories[] = get_term_by('name', 'TAI NGHE / HEADPHONE BLUETOOTH', 'chuyen-muc');
	$categories[] = get_term_by('name', 'PHỤ LINH KIỆN ĐIỆN THOẠI / VI TÍNH', 'chuyen-muc');
	$categories[] = get_term_by('name', 'LOA NGHE NHẠC', 'chuyen-muc');
	$categories[] = get_term_by('name', 'CAMERA/ ĐIỆN THOẠI', 'chuyen-muc');
	$categories[] = get_term_by('name', 'THẺ NHỚ /USB / ĐỌC THẺ', 'chuyen-muc');
	$categories[] = get_term_by('name', 'ĐỒ ĐIỆN GIA DỤNG', 'chuyen-muc');
	$categories[] = get_term_by('name', 'BAO DA / ỐP LƯNG', 'chuyen-muc');

	foreach ($categories as $term) {
?>
<div class="container-fluid groups-tim-gia-si">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 ">
				<div class="title-giasi">
					<?php echo $term->name ?>			
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid group-list-products">
	<div class="wrap">
		<table class="table table-bordered">
						<tr>
							<td class="td-1">
								<div class="title-list-pro">
									HÌNH ẢNH
								</div></td>
							
							<td class="td-3 hidden-xs hidden-sm hidden-md"> 
								<div class="title-list-pro">
									MÃ SP
								</div>
							</td>
							<td class="td-2 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									TÊN SẢN PHẨM
								</div>
							</td>
							<td class="td-4 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									BH
								</div>
							</td>
							<td class="td-5" style="text-align: left;">
								<div class="title-list-pro">
									GIÁ LẺ
								</div>
							</td>
							<td class="td-6">
								<div class="title-list-pro">
									SỐ LƯỢNG
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md" style="text-align: left;">
								<div class="title-list-pro">
									THÀNH TIỀN
								</div>
							</td>
							<td class="td-8">
								<div class="title-list-pro">
									TÌNH TRẠNG
								</div>
							</td>
						</tr>
				
					<?php 
				        $sanphams = new WP_Query(array(
				        		'posts_per_page' => -1,
			        			'ignore_sticky_posts' => 1,
								'post_type' => 'san-pham',
								'tax_query' => array(
									array(
										'taxonomy' => 'chuyen-muc',
										'field'    => 'term_id',
										'terms'    => $term->term_id,
									),
								),
				        	));
						if ($sanphams->have_posts() ) :
						while ($sanphams->have_posts()) : $sanphams->the_post();
							$id = get_the_id();
							$tinh_trang_hang=get_post_meta($id,"tinh_trang_hang",true);
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
							}
					?>
						<tr>
							<td>
								<div class="title-list-pro">
									<img class="img-responsive-cus" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'medium') ?>" >
								</div>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p" >
									<?php echo get_post_meta($id, "ma_sp", true) ?> 
								</span>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p" >
									<?php the_title() ?>
								</span>
							</td>
							
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php echo get_post_meta($id, "thoi_gianbao_hanh", true); ?>
								</span>
							</td>
							<td class="td-5">
								<span class="common-p">
									<?php 
										// if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) {
											$gia_si = get_post_meta($id, "gia_si", true);
											if ($gia_si == 0) {
												echo "Liên hệ";
											} else {
												show_cost($gia_si);
											}
										// } else {
										// 	$gia_si = get_post_meta($id, "gia_si_khuyen_mai", true);
										// 	show_cost($gia_si);									
										// }
									?>
								</span>
							</td>
							<td>
								<div class="form-group common-p">
									<input type="text" value="1" class="form-control wholesale-price" id="">
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md"">
								<span class="common-p">
									<?php
										if ($gia_si == 0) {
											echo "Liên hệ";
										} else {
											show_cost($gia_si);
										}
									?>
								</span>
							</td>
							<td>
								<div class="hang-hoa-status">
									<b><?php echo $tinh_trang_text; ?></b>
								</div>
							</td>
						</tr>
						
					<?php endwhile; endif; wp_reset_postdata(); ?>		
					</table>
		
	</div>
</div>
<?php } 
} else {
	$tag = sanitize_text_field($_GET['ten-gia-si']);
	add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2 );
	function wpse18703_posts_where( $where, &$wp_query )
	{
	    global $wpdb;
	    if ( $wpse18703_title = $wp_query->get( 's' ) ) {
	        $where .= ' OR ' . $wpdb->posts . '.post_name LIKE \'%' . esc_sql( $wpdb->esc_like( sanitize_title($wpse18703_title) ) ) . '%\'';
	    }
	    return $where;
	}

	$tags = new WP_Query( array('s' => $tag, 'post_type' => 'san-pham', 'posts_per_page' => -1 ) );
	
	if ($tags->have_posts() ) :
?>
<div class="container-fluid groups-tim-gia-si">
	<div class="wrap">
		<div class="row">
			<div class="col-lg-15 ">
				<div class="title-giasi">
					<?php echo $tag ?>			
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid group-list-products">
	<div class="wrap">
		<div class="tab-bang-gia-group">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#gia-le" aria-controls="gia-le" role="tab" data-toggle="tab">Giá lẻ</a>
				</li>
				<li role="presentation">
					<a href="#gia-si" aria-controls="gia-si" role="tab" data-toggle="tab">Giá sỉ</a>
				</li>
			</ul>

			<div class="tab-content custom-tab-banggias">
				<div role="tabpanel" class="tab-pane active custom-tab-banggias" id="gia-le">
					<table class="table table-bordered">
						<tr>
							<td class="td-1">
								<div class="title-list-pro">
									HÌNH ẢNH
								</div></td>
							
							<td class="td-3 hidden-xs hidden-sm hidden-md"> 
								<div class="title-list-pro">
									MÃ SP
								</div>
							</td>
							<td class="td-2 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									TÊN SẢN PHẨM
								</div>
							</td>
							<td class="td-4 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									BH
								</div>
							</td>
							<td class="td-5" style="text-align: left;">
								<div class="title-list-pro">
									GIÁ LẺ
								</div>
							</td>
							<td class="td-6">
								<div class="title-list-pro">
									SỐ LƯỢNG
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md" style="text-align: left;">
								<div class="title-list-pro">
									THÀNH TIỀN
								</div>
							</td>
							<td class="td-8">
								<div class="title-list-pro">
									TÌNH TRẠNG
								</div>
							</td>
						</tr>
				
					<?php 
						while ($tags->have_posts()) : $tags->the_post();
						$id = get_the_id();
						$tinh_trang_hang=get_post_meta($id,"tinh_trang_hang",true);
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
				}
						if ( in_category('tin-tuc') || in_category("hinh-quang-cao") || in_category('tin-khuyen-mai') || get_post_meta($id, "ma_sp", true) == null) {
						    continue;
						}
					?>
						<tr>
							<td>
								<div class="title-list-pro">
									<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'thumbnail') ?>" >
								</div>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php echo get_post_meta($id, "ma_sp", true) ?> 
								</span>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php the_title() ?>
								</span>
							</td>
							
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php echo get_post_meta($id, "thoi_gianbao_hanh", true); ?>
								</span>
							</td>
							<td class="td-5">
								<span class="common-p">
									<?php 
										// if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) {
										// 	$gia_si = get_post_meta($id, "gia_si", true);
										// 	show_cost($gia_si);
										// } else {
										// 	$gia_si = get_post_meta($id, "gia_si_khuyen_mai", true);
										// 	show_cost($gia_si);
										// }
										$gia_si = get_post_meta($id, "gia_si", true);
										if ($gia_si == 0) {
											echo "Liên hệ";
										} else {
											show_cost($gia_si);
										}
									?>
								</span>
							</td>
							<td>
								<div class="form-group common-p">
									<input type="text" value="1" class="form-control wholesale-price" id="">
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md"">
								<span class="common-p">
								<?php 
									if ($gia_si == 0) {
										echo "Liên hệ";
									} else {
										show_cost($gia_si);
									} 
								?>
								</span>
							</td>
							<td>
								<div class="hang-hoa-status">
									<b><?php echo $tinh_trang_text; ?></b>
								</div>
							</td>
						</tr>
						
					<?php 
						endwhile; wp_reset_postdata(); 
					?>		
					</table>
				</div>

				<div role="tabpanel" class="tab-pane" id="gia-si">
					<table class="table table-bordered">
						<tr>
							<td class="td-1">
								<div class="title-list-pro">
									HÌNH ẢNH
								</div></td>
							
							<td class="td-3 hidden-xs hidden-sm hidden-md"> 
								<div class="title-list-pro">
									MÃ SP
								</div>
							</td>
							<td class="td-2 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									TÊN SẢN PHẨM
								</div>
							</td>
							<td class="td-4 hidden-xs hidden-sm hidden-md">
								<div class="title-list-pro">
									BH
								</div>
							</td>
							<td class="td-5" style="text-align: left;">
								<div class="title-list-pro">
									GIÁ SỈ
								</div>
							</td>
							<td class="td-6">
								<div class="title-list-pro">
									SỐ LƯỢNG
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md" style="text-align: left;">
								<div class="title-list-pro">
									THÀNH TIỀN
								</div>
							</td>
							<td class="td-8">
								<div class="title-list-pro">
									TÌNH TRẠNG
								</div>
							</td>
						</tr>
				
					<?php 
						while ($tags->have_posts()) : $tags->the_post();
						$id = get_the_id();
						$tinh_trang_hang=get_post_meta($id,"tinh_trang_hang",true);
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
				}
						if ( in_category('tin-tuc') || in_category("hinh-quang-cao") || in_category('tin-khuyen-mai') || get_post_meta($id, "ma_sp", true) == null) {
						    continue;
						}
					?>
						<tr>
							<td>
								<div class="title-list-pro">
									<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url(get_the_id(), 'thumbnail') ?>" >
								</div>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php echo get_post_meta($id, "ma_sp", true) ?> 
								</span>
							</td>
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php the_title() ?>
								</span>
							</td>
							
							<td class="hidden-xs hidden-sm hidden-md">
								<span class="common-p">
									<?php echo get_post_meta($id, "thoi_gianbao_hanh", true); ?>
								</span>
							</td>
							<td class="td-5">
								<span class="common-p">
									<?php 
										// if (get_post_meta($id, "gia_si_khuyen_mai", true) == 0) {
										// 	$gia_si = get_post_meta($id, "gia_si", true);
										// 	show_cost($gia_si * 0.7);
										// } else {
										// 	$gia_si = get_post_meta($id, "gia_si_khuyen_mai", true);
										// 	show_cost($gia_si * 0.7);
										// }
										$gia_si = get_post_meta($id, "gia_si", true);
										$gia_si_new = get_post_meta($id, "gia_si_new", true);
										if ($gia_si_new === "") {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($gia_si * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}	
									?>
								</span>
							</td>
							<td>
								<div class="form-group common-p">
									<input type="text" value="5" class="form-control wholesale-price" id="">
								</div>
							</td>
							<td class="td-7 hidden-xs hidden-sm hidden-md"">
								<span class="common-p">
								<?php 
									if ($gia_si_new === "") {
											echo "Liên hệ";
										} elseif ($gia_si_new == 0) {
											show_cost($gia_si * 5 * get_option('ti_le_phan_tram') / 100);
										} else {
											show_cost($gia_si_new);
										}	
								?>
								</span>
							</td>
							<td>
								<div class="hang-hoa-status">
									<b><?php echo $tinh_trang_text; ?></b>
								</div>
							</td>
						</tr>
						
					<?php 
						endwhile; wp_reset_postdata(); 
					?>		
					</table>
				</div>
			</div>
		</div>
		<!-- End nav tab giá sỉ, giá lẻ -->
	</div>
</div>
<?php 
	endif; 
}
?>
<style type="text/css">
	table tr td {
		text-align: center;
	}

	table tr td .common-p {
		font-size: 18px !important;
		font-weight: normal;
	}

	.title-list-pro {
		font-size: 18px;
	}

	/*.tab-bang-gia-group {
		margin-top: 20px;
	}*/

	.tab-bang-gia-group a {
		font-size: 18px;
		font-weight: bold;
	}

	.tab-bang-gia-group > ul {
		margin-left: 0px;
	}

	.custom-tab-banggias > div {
		padding: 10px 0px;
	}

	.nav-tabs > li.active > a,
	.nav-tabs > li.active > a:hover,
	.nav-tabs > li.active > a:focus {
		background-color: #f5f5f5;;
	}
</style>
<?php get_footer();