<?php
get_header(); ?>

<div class="container-fluid main-breadcrumb">
	<div class="wrap wrap-breadcrums">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<ol class="breadcrumb">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
					<li class="active"><?php the_title(); ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php 

$gia_tri = 0;
foreach ($_SESSION['cart'] as $product_id=>$r) {  
    $sum_cost_id = 0;
    $so_luong = $r['number'];

    if(is_sale_off($product_id)){
        $dongia = get_stand_cost($product_id);                     
    } else {
        $dongia = get_ori_stand_cost($product_id);
    }


    $sum_cost_id = $so_luong * $dongia; 
    $gia_tri += $sum_cost_id;
}

if (isset($_POST['HoTen'])) {
	// $_SESSION['user']['id'] = "";
	$_SESSION['user']['HoTen'] = sanitize_text_field( $_POST['HoTen'] );
	$_SESSION['user']['TinhThanh'] = sanitize_text_field( $_POST['City'] );
	$_SESSION['user']['QuanHuyen'] = sanitize_text_field( $_POST['District'] );
	$_SESSION['user']['DiaChi'] = sanitize_text_field( $_POST['DiaChi'] );
	$_SESSION['user']['DienThoai'] = sanitize_text_field( $_POST['DienThoai'] );
	$_SESSION['user']['Email'] = sanitize_text_field( $_POST['Email'] );

	$_SESSION['user']['DiemNhan'] = sanitize_text_field($_POST['DiaDiem'] );

	$_SESSION['user']['Giau'] = sanitize_text_field( $_POST['GiauThongTin'] );
	// echo $_POST['GiauThongTin'];
	// exit();
	$_SESSION['user']['GhiChu'] = sanitize_text_field( $_POST['GhiChu'] );

	if ($_SESSION['user']['DiemNhan'] == 'Khac') {
		$_SESSION['user']['NNHoTen'] = sanitize_text_field( $_POST['NNHoTen'] );
		$_SESSION['user']['NNTinhThanh'] = sanitize_text_field( $_POST['NNCity'] );
		$_SESSION['user']['NNQuanHuyen'] = sanitize_text_field( $_POST['NNDistrict'] );
		$_SESSION['user']['NNDiaChi'] = sanitize_text_field( $_POST['NNDiaChi'] );
		$_SESSION['user']['NNDienThoai'] = sanitize_text_field( $_POST['NNDienThoai'] );
	} else {
		$_SESSION['user']['NNHoTen'] = $_SESSION['user']['HoTen'];
		$_SESSION['user']['NNTinhThanh'] = $_SESSION['user']['TinhThanh'];
		$_SESSION['user']['NNQuanHuyen'] = $_SESSION['user']['QuanHuyen'];
		$_SESSION['user']['NNDiaChi'] = $_SESSION['user']['DiaChi'];
		$_SESSION['user']['NNDienThoai'] = $_SESSION['user']['DienThoai'];				
	}

	$id = "";
	if (isset($_SESSION['user']['id'])) {
		$id = $_SESSION['user']['id'];
	}

	// insert CSDL ls_cart
	$ma = date("dmY") . "_" . str_pad(get_option('letsop-ma-don-hang'), 6, "0", STR_PAD_LEFT);
	global $wpdb;
    $wpdb->insert( 
        'ls_cart', 
        array( 
            'madonhang' => $ma, 
            'idnguoidat' => $id,
            'hoten' => $_SESSION['user']['HoTen'],
            'tinhthanh' => $_SESSION['user']['TinhThanh'],
            'quanhuyen' => $_SESSION['user']['QuanHuyen'],
            'diachi' => $_SESSION['user']['DiaChi'],
            'dienthoai' => $_SESSION['user']['DienThoai'],
            'email' => $_SESSION['user']['Email'],

            'nnhoten' => $_SESSION['user']['NNHoTen'],
            'nntinhthanh' => $_SESSION['user']['NNTinhThanh'],
            'nnquanhuyen' => $_SESSION['user']['NNQuanHuyen'],
            'nndiachi' => $_SESSION['user']['NNDiaChi'],
            'nndienthoai' => $_SESSION['user']['NNDienThoai'],
            'giauthongtin' => $_SESSION['user']['Giau'],
            'ngaydat' => date("Y-m-d H:i:s"),
            'trangthai' => 0,
            'ngayduyet' => "",
            'ghichu' => $_SESSION['user']['GhiChu'],
            'thanhtoan' => "COD",
            'tongtien' => $gia_tri,
            'magiamgia' => $_SESSION['code']['code_ls'],
            'giagiam' => $_SESSION['code']['gia_giam_ls']
        )
    );
    $id_cart = $wpdb->insert_id;
	// $wpdb->show_errors();
	// $wpdb->print_error();
	// echo "Debug $id_cart";

    if($_SESSION['code']['code_ls'] != "") {
        global $wpdb;
        $result = $wpdb->update( 
                'wp_sale_off_code', 
                array( 
                    'so_lan_da_dung' => $_SESSION['code']['so_lan_da_dung_ls'] + 1                 
                ), 
                array(                         
                    'code' => $_SESSION['code']['code_ls'],
                )
            );
    }

    if(count($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $product_id=>$r) {  
            $sum_cost_id = 0;
            $so_luong = $r['number'];

            $loai = "";
		    if(is_sale_off($product_id)){
		        $dongia = get_stand_cost($product_id);  
		        $loai = "Khuyến mãi";
		    } else {
		        $dongia = get_ori_stand_cost($product_id);
		        $loai = "Chuẩn";
		    }

		    $sum_cost_id = $so_luong * $dongia; 
           
            global $wpdb;
            $wpdb->insert( 
                'ls_cart_detail', 
                array( 
                    'proid' => $product_id, 
                    'loaigia' => $loai,
                    'gia' => $dongia,
                    'soluong' => $so_luong,
                    'idgiohang' => $id_cart
                )
            );
            $id = $wpdb->insert_id;
        }           
    }

    update_option( 'letsop-ma-don-hang', get_option('letsop-ma-don-hang') + 1 );

    
}

?>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<div class="title">
					<h1 class="title-content"><?php the_title(); ?></h1>
				</div>
				
				<div class="main-detail">
					<p class="common-p">
						Xin chúc mừng! Bạn đã hoàn thành đơn đặt hàng. Chúng tôi sẽ liên lạc với Bạn ngay lập tức. Cảm ơn và mong Bạn luôn ủng hộ dịch vụ của chúng tôi. 
					</p>
					<p class="common-p" style="margin-bottom: 40px;">
						Bấm vào trở về <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  class="link-color">Trang chủ</a> để tiếp tục mua hàng.
					</p>

					<div style="padding-right: 15px; padding-left: 15px;">						
						<div class="row visible-lg hidden-md hidden-sm hidden-xs confirm-detail">
							<div class="col-lg-3">Mã đơn hàng</div>
							<div class="col-lg-3">Ngày đặt hàng</div>
							<div class="col-lg-3">Sản phẩm</div>
							<div class="col-lg-3">Tổng tiền</div>
							<div class="col-lg-3">Trạng thái</div>
						
						</div>

						<div class="row visible-lg hidden-md hidden-sm hidden-xs border-lrb">
							<div class="col-lg-3 link-red-color"><?php echo $ma ?></div>
							<div class="col-lg-3 common-p" style="font-weight: bold;"><?php echo date('d-m-Y') ?></div>
							<div class="col-lg-3">
							<?php foreach ($_SESSION['cart'] as $product_id=>$r) { ?>
								<p class="p-detail-confirm"><?php echo get_the_title($product_id); ?></p>
							<?php } ?>
							</div>
							<div class="col-lg-3 link-red-color" style="font-weight: bold;"><?php show_cost($gia_tri) ?></div>
							<div class="col-lg-3 link-color">Đơn hàng mới</div>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="wrap border-lrbt visible-xs visible-md visible-sm hidden-lg">
						<div class="row">
						
							<div class="col-md-4 col-xs-6 col-sm-4 border-lrbt-col">Mã đơn hàng</div>
							<div class="col-md-11 col-xs-9 col-sm-11 border-lrbt-col link-red-color" style="font-weight: bold;">
								<?php echo $ma ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Ngày đặt hàng</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col common-p">
								<?php echo date('d-m-Y') ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Sản phẩm</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col">
								<?php foreach ($_SESSION['cart'] as $product_id=>$r) { ?>
								<p class="p-detail-confirm"><?php echo get_the_title($product_id); ?></p>
							<?php } ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Tổng tiền</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col " style="font-weight: bold;">
								<?php show_cost($gia_tri) ?>
							</div>

							<div class="col-xs-6 col-sm-4 border-lrbt-col">Trạng thái</div>
							<div class="col-xs-9 col-sm-11 border-lrbt-col link-color">
								Đơn hàng mới
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>QUY TRÌNH VẬN CHUYỂN</div>
					<div class="row visible-lg hidden-md hidden-sm hidden-xs">
						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/don-hang-moi.png') ?>">
							<div class="quy-trinh-text quy-trinh-text-active">Đơn hàng mới</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh line-quytrinh-active">&nbsp;</div>
						</div>


						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-xac-nhan.png') ?>">
							<div class="quy-trinh-text">Đã xác nhận</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-van-chuyen.png') ?>">
							<div class="quy-trinh-text">Đang vận chuyển</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<div class="line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-lg-1 quy-trinh-van-chuyen-line">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-giao-hang.png') ?>">
							<div class="quy-trinh-text">Đã giao hàng</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title">
							<div class="line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-lg-2 quy-trinh-van-chuyen-title-last">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/hoan-thanh.png') ?>">
							<div class="quy-trinh-text">Hoàn thành</div>
						</div>
					</div>

					<div class="row mobile-quytrinh-vanchuyen visible-xs visible-md visible-sm hidden-lg">
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/don-hang-moi.png') ?>">
							<span class="quy-trinh-text-mobile quy-trinh-text-active">Đơn hàng mới</span>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh line-quytrinh-active">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-xac-nhan.png') ?>">
							<span class="quy-trinh-text-mobile">Đã xác nhận</span>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-van-chuyen.png') ?>">
							<span class="quy-trinh-text-mobile">Đang vận chuyển</span>
						</div>
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/da-giao-hang.png') ?>">
							<span class="quy-trinh-text-mobile">Đã giao hàng</span>
						</div>
						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-line">
							<div class="mobile-line-quytrinh">&nbsp;</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 mobile-quytrinh-step">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/images/hoan-thanh.png') ?>">
							<span class="quy-trinh-text-mobile">Hoàn thành</span>
						</div>						
					</div>

					<p class="common-p" style="margin-bottom: 40px; margin-top: 40px;">Chuyển sản phẩm đến địa chỉ của Người nhận khác (Khác với địa chỉ của chủ tài khoản)</p>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>THÔNG TIN NGƯỜI NHẬN</div>

					<div class="row hoan-thanh-dia-chi">
						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Họ và tên</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $_SESSION['user']['NNHoTeN'] ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Tỉnh | Thành phố</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $_SESSION['user']['NNTinhThanh'] ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Địa chỉ</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $_SESSION['user']['NNDiaChi'] . ", " . $_SESSION['user']['NNQuanHuyen'] ?></div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6 hoan-thanh-dia-chi-title">Số điện thoại</div>
								<div class="col-lg-9 col-md-11 col-sm-11 col-xs-9 hoan-thanh-dia-chi-text"><?php echo $_SESSION['user']['NNDienThoai'] ?></div>
							</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="hoan-thanh-dia-chi-title">
								Ghi chú đơn hàng
							</div>
							<div class="hoan-thanh-dia-chi-text-special">
								<?php echo $_SESSION['user']['GhiChu'] ?>
							</div>
						</div>

						<div class="col-sm-15 col-xs-15 col-md-15 col-lg-5">
							<div class="hoan-thanh-dia-chi-title">
								Phương thức thanh toán
							</div>
							<div class="hoan-thanh-dia-chi-text">
								Thanh toán tại địa chỉ nhận sản phẩm (COD).
							</div>
							<a href="" class="link-color">Xem chi tiết Phương thức thanh toán</a>
						</div>
					</div>

					<div class="danhmuc-title"><span class="border-danhmuc-title"></span>GIỎ HÀNG CỦA BẠN</div>

					<div class="row main-detail">
						<div class="col-lg-11 col-sm-9 col-xs-15 cart-left">
							<div class="row cart-detail-title">
								<div class="col-lg-6 col-sm-15 col-xs-15">Thông tin sản phẩm</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Đơn giá</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Số lượng</div>
								<div class="col-lg-3 hidden-md hidden-sm hidden-xs">Thành tiền</div>
							</div>

							<?php 
						$gia_tri = 0;
						if(count($_SESSION['cart'])){
							foreach ($_SESSION['cart'] as $product_id=>$r) {  
							    $sum_cost_id = 0;
							    $so_luong = $r['number'];

							    if(is_sale_off($product_id)){
							        $dongia = get_stand_cost($product_id);                     
							    } else {
							        $dongia = get_ori_stand_cost($product_id);
							    }

							    $sum_cost_id = $so_luong * $dongia; 
							    $gia_tri += $sum_cost_id;
					?>
						<div class="row cart-detail">
							<div class="col-lg-6 col-sm-15 col-xs-15 col-left-top-portable">
								<div class="col-left-cart">
									<img src="<?php echo get_the_post_thumbnail_url($product_id, 'full') ?>" class="img-cart">
								</div>

								<div class="col-right-cart">
									<a href="<?php echo get_permalink($product_id) ?>"><div class="detail-title-product"><?php echo get_the_title($product_id); ?></div></a>
									<!-- <div class="detail-meta-product">Kích cỡ: 14</div> -->
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Đơn giá</div>
								<div class="col-for-portable-right"><?php show_cost($dongia); ?></div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Số lượng</div>
								<div class="col-for-portable-right">
									<?php echo $so_luong; ?>
								</div>
							</div>
							<div class="col-lg-3 col-sm-15 col-xs-15 portable-margin-top">
								<div class="hidden-lg visible-md visible-sm visible-xs col-for-portable-left">Thành tiền</div>
								<div class="col-for-portable-right thanh-toan-sum" id="sp-<?php echo $product_id ?>" data-gia="<?php echo $dongia; ?>"><?php show_cost($sum_cost_id); ?></div>
							</div>
						</div>
						<?php } } ?>
					
						</div>

						<div class="col-lg-4 col-sm-6 col-xs-15 cart-right">
							<div class="row detail-price">
								<div class="col-lg-8 col-sm-8 col-xs-8 price-label" style="margin-top: 0px;">Tạm tính</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content" style="margin-top: 0px;"><?php show_cost($gia_tri); ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Phí vận chuyển</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content">0đ</div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Mã giảm giá</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php echo $_SESSION['code']['code_ls']; ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 price-label">Giá giảm</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 price-content"><?php show_cost($_SESSION['code']['gia_giam_ls']); ?></div>

								<div class="col-lg-8 col-sm-8 col-xs-8 sum-price-label">TỔNG TIỀN</div>
								<div class="col-lg-7 col-sm-7 col-xs-7 sum-price-content"><?php show_cost($gia_tri - $_SESSION['code']['gia_giam_ls']); ?></div>
							</div>
						</div>						
					</div>
				</div> <!-- End Content -->
			</div>
		</div>
	</div>
</div>



<?php
	unset($_SESSION['code']);
	unset($_SESSION['cart']);

    if (isset($_SESSION['user']['id'])) {
    	unset($_SESSION['user']['NNHoTen']);
	    unset($_SESSION['user']['NNTinhThanh']);
	    unset($_SESSION['user']['NNQuanHuyen']);
	    unset($_SESSION['user']['NNDiaChi']);
	    unset($_SESSION['user']['NNDienThoai']);
	    unset($_SESSION['user']['Giau']);
	} else {
		unset($_SESSION['user']);	
	}	
//get_sidebar();
get_footer();
