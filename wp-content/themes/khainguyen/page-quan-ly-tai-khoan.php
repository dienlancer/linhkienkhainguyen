<?php
session_start();
if (empty($_SESSION['user']['id'])) {
	wp_redirect(esc_url( home_url( '/' )));
	// wp_redirect(esc_url( $_SERVER['HTTP_REFERER']));
	exit();
}
get_header(); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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



<div class="container-fluid">
	<div class="wrap main-content qltk-main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">
				<div class="row quan-ly-tai-khoan">
					<div class="col-lg-5 col-sm-15 col-xs-15 qltk-col-1">
						<div class="qltk-groups">
							<i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right: 10px; color: #f588b2; font-size: 50px;"></i>
							<div class="qltk-group">
								<div class="qltk-info-top">Tài khoản của</div>
								<div class="qltk-info-bottom"><?php echo $_SESSION['user']['HoTen'] ?></div>
							</div>
						</div>

						<div class="row group-quanly">
							<div class="col-lg-15 col-md-4 col-sm-4 col-xs-15 g-quanly common-p">
								<i class="fa fa-cog mgr-5" aria-hidden="true"></i><a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) ); ?>" class=" common-p link-color">Thông tin tài khoản</a>
							</div>

							<div class="col-lg-15 col-md-4 col-sm-4 col-xs-15 g-quanly common-p">
								<i class="fa fa-file-text-o mgr-5" aria-hidden="true"></i><a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) . '?sec=don-hang' ); ?>" class=" common-p">Đơn hàng của bạn</a>
							</div>

							<div class="col-lg-15 col-md-4 col-sm-4 col-xs-15 g-quanly common-p">
								<i class="fa fa-key mgr-5" aria-hidden="true"></i><a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) . '?sec=mat-khau' ); ?>" class=" common-p">Thay đổi mật khẩu</a>
							</div>

							<div class="col-lg-15 col-md-3 col-sm-3 col-xs-15 g-quanly common-p">
								<i class="fa fa-diamond mgr-5" aria-hidden="true"></i><a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) . '?sec=diem' ); ?>" class=" common-p">Điểm tích lũy</a>
							</div>
						</div>

						<div class="hidden-lg visible-md visible-sm visible-xs" style="margin-top: 25px; border-top: 2px solid #ccc;"></div>
					</div>

					<div class="col-lg-10 col-sm-15 col-xs-15 qltk-col-2 qltk-border-left">
						<div class="<?php if (empty($_GET['sec']) || (isset($_GET['sec']) && $_GET['sec'] != "diem" ) ) { echo 'hidden'; } ?>">	
							<div class="danhmuc-title mobile-mg-top"><span class="border-danhmuc-title"></span>ĐIỂM TÍCH LŨY</div>
						<?php 
							$diem_quy_doi = get_option("ls_diem_quy_doi", 100000);
							global $wpdb;
							$query = 'select * from ls_cart where `idnguoidat` = ' . $_SESSION['user']['id'];
        					$carts = $wpdb->get_results($query);
        					$tongtien = 0;
        					foreach ($carts as $cart) {
        						$tongtien += $cart->tongtien;
        					}        					
						?>

							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 common-p">
									CẤP ĐỘ TÀI KHOẢN
								</div>
								<div class="col-lg-12 col-md-12 col-sm-11 col-xs-10 link-color">
									
								<?php 
									if ($tongtien < 10000000) {
										echo "USER";
									} elseif ($tongtien < 20000000) {
										echo "SILVER USER";
									} elseif ($tongtien < 50000000) {
										echo "GOLD USER";
									} else {
										echo "PREMIUM USER";
									}
								?>
								</div>

								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 common-p" style="margin-top: 10px;">
									TỔNG TIỀN ĐÃ MUA
								</div>
								<div class="col-lg-12 col-md-12 col-sm-11 col-xs-10 link-red-color" style="margin-top: 10px;">
									<?php show_cost($tongtien); ?>
								</div>
							</div>

							<div class="group-tichdiem">
								<img class="tichdiem-imge" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-60-icons-08.png') ?>"/>
								<div class="child-group-tichdiem">
									<div class="child-tichdiem-top common-p">
										Bạn có số điểm tích lũy
									</div>

									<div class="child-tichdiem-bottom">
										<?php 
											// echo $_SESSION['user']['DiemTichLuy'];
											echo floor($tongtien / $diem_quy_doi);

										?>
									</div>
								</div>
							</div>

							<a href="<?php $page = get_page_by_title( 'Chính sách thành viên' ); echo esc_url( get_page_link($page->ID) ); ?>" class="common-p link-color" style="display: block; margin-top: 40px; margin-bottom: 10px;">Chính sách thành viên</a>
							<a href="<?php $page = get_page_by_title( 'Chính sách tích lũy điểm' ); echo esc_url( get_page_link($page->ID) ); ?>" class="common-p link-color" style="display: block; margin-bottom: 40px;">Chính sách tích lũy điểm</a>

							<p class="common-p" style="margin-bottom: 20px;">Lịch sử tích lũy điểm</p>
						<?php 
							foreach ($carts as $cart) { 
						?>
							<div class="lich-su-tich-diem">
								<div class="lstd-col-left">
									<?php echo "+" . floor($cart->tongtien / $diem_quy_doi);  ?>
								</div>

								<div class="lstd-col-right">
									<?php echo $cart->madonhang; ?>
								</div>
							</div>
						<?php } ?>
						</div>

						<!-- <div style="height: 100px;"></div> -->
					<?php 
						if (isset($_POST['Standard-Form'])) {
							$matkhau = sanitize_text_field($_POST['MatKhau']);
							$matkhaumoi = sanitize_text_field($_POST['MatKhauMoi']);
							if ($matkhau == $matkhaumoi) {					
								global $wpdb;
								$user_db = $wpdb->get_row("SELECT * FROM ls_guest WHERE `id` = " . $_SESSION['user']['id'] . " and `matkhau` = '" . md5($matkhau) . "'");
	    						if(isset($user_db->id)){
									$wpdb->update( 
					                    'ls_guest', 
					                    array( 
					                        'matkhau' => md5($matkhaumoi)
					                    ), 
					                    array(                         
					                        'id' => $_SESSION['user']['id']
					                    )
					                );
					                $update = true;
								}
							}
						}
					?>

						<div class="<?php if (empty($_GET['sec']) || (isset($_GET['sec']) && $_GET['sec'] != "mat-khau" ) ) { echo 'hidden'; } ?>">	
							<div class="danhmuc-title mobile-mg-top"><span class="border-danhmuc-title"></span>THAY ĐỔI MẬT KHẨU</div>

							<p class="common-p <?php if (empty($update) || (isset($update) && !$update)) {
								echo "hidden";
							} ?>" style="margin-bottom: 30px;"><i class="fa fa-check-circle" aria-hidden="true" style="color: #3cba54; margin-right: 5px;"></i>Bạn đã thay đổi mật khẩu thành công.</p>

							<div class="row">
								<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
									Bạn vui lòng cập nhật mật khẩu mới tại đây.
								</div>

								<div class="col-lg-5 col-sm-15 col-xs-15">
									<form method="POST" id="Standard-Form">
										<input type="hidden" name="Standard-Form" value="Standard-Form">
										<div class="form-group">
											<input type="password" class="form-control new-padding-info" name="MatKhau" id="MatKhau" placeholder="Mật khẩu cũ">
										</div>
										<div class="alert alert-danger common-p" style="display: none;" id="alert-MatKhau" role="alert">Vui lòng nhập mật khẩu cũ!</div>

										<div class="form-group">
											<input type="password" class="form-control new-padding-info" name="MatKhauMoi" id="MatKhauMoi" placeholder="Mật khẩu mới">
										</div>
										<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau-length" role="alert">Mật khẩu quá ngắn!</div>

										<div class="form-group">
											<input type="password" class="form-control new-padding-info" name="ReMatKhauMoi" id="ReMatKhauMoi" placeholder="Nhập lại mật khẩu">
										</div>	
										<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau" role="alert">Mật khẩu không khớp!</div>

										<button type="button" id="DangKy" class="btn btn-info button-mua-tiep" style="width: 200px;">CẬP NHẬT MẬT KHẨU</button>
									</form>
								</div>						
							</div>
						</div>


						<!-- <div style="height: 100px;"></div> -->

						<div class="<?php if (empty($_GET['sec']) || (isset($_GET['sec']) && $_GET['sec'] != "don-hang" ) ) { echo 'hidden'; } ?>">	

							<div class="danhmuc-title mobile-mg-top"><span class="border-danhmuc-title"></span>LỊCH SỬ ĐƠN HÀNG</div>
							<p class="common-p" style="margin-bottom: 30px;">
								Dưới đây là Lịch sử đơn hàng của Bạn<br/>
								Bấm chọn Mã đơn hàng để xem chi tiết đơn hàng đó.
							</p>
						<?php 
							global $wpdb;
							$query = 'select * from ls_cart where `idnguoidat` = ' . $_SESSION['user']['id'];
        					$carts = $wpdb->get_results($query);
        					foreach ($carts as $cart) {
        					
						?>

							<div class="border-lrbt visible-xs visible-md visible-sm visible-lg">
								<div class="row">						
									<div class="col-lg-4 col-md-4 col-xs-6 col-sm-4 border-lrbt-col">Mã đơn hàng</div>
									<div class="col-lg-11 col-md-11 col-xs-9 col-sm-11 border-lrbt-col " >
										<a href="<?php $page = get_page_by_title( 'Kiểm tra đơn hàng' ); echo esc_url( get_page_link($page->ID) . "?MaDonHang=" . $cart->madonhang ); ?>" class="common-p link-red-color" style="font-weight: bold;"><?php echo $cart->madonhang ?></a>
									</div>

									<div class="col-lg-4 col-xs-6 col-sm-4 border-lrbt-col">Ngày đặt hàng</div>
									<div class="col-lg-11 col-xs-9 col-sm-11 border-lrbt-col common-p">
										<?php echo $cart->ngaydat ?>
									</div>

									<div class="col-lg-4 col-xs-6 col-sm-4 border-lrbt-col">Sản phẩm</div>
									<div class="col-lg-11 col-xs-9 col-sm-11 border-lrbt-col">
								<?php 
				                    $cart_details = $wpdb->get_results('select * from ls_cart_detail where idgiohang = ' . $cart->id);
				                    // $sum_cost = 0;
				                    foreach($cart_details as $cart_detail) {
				                    	// $sum_cost += $cart_detail->soluong * $cart_detail->gia;
				                    	switch ($cart->trangthai) {
								    		case -1:
								    			$trangthai = "Đã hủy";
								    			$matrangthai = -1;
								    			break;

											case 1:
								    			$trangthai = "Đã xác nhận";
								    			$matrangthai = 1;
								    			break;

								    		case 2:
								    			$trangthai = "Đang chờ";
								    			$matrangthai = 2;
								    			break;

								    		case 3:
								    			$trangthai = "Đang vận chuyển";
								    			$matrangthai = 3;
								    			break;

											case 4:
								    			$trangthai = "Đã giao hàng";
								    			$matrangthai = 4;
								    			break;
								    		case 5:
								    			$trangthai = "Hoàn thành";
								    			$matrangthai = 5;
								    			break;
								    		
								    		case 0:
								    			$trangthai = "Đơn hàng mới";
								    			break;
								    	}
				                        global $post;
										$post = get_post($cart_detail->proid);
				                ?>
										<p class="p-detail-confirm"><?php the_title() ?></p>
								<?php } ?>
				
									</div>

									<div class="col-lg-4 col-xs-6 col-sm-4 border-lrbt-col">Tổng tiền</div>
									<div class="col-lg-11 col-xs-9 col-sm-11 border-lrbt-col " style="font-weight: bold;">
										<?php show_cost($cart->tongtien); ?>
									</div>

									<div class="col-lg-4 col-xs-6 col-sm-4 border-lrbt-col">Trạng thái</div>
									<div class="col-lg-11 col-xs-9 col-sm-11 border-lrbt-col link-color">
										<?php echo $trangthai; ?>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<?php } ?>
						</div>


						<!-- <div style="height: 100px;"></div> -->
					<?php 
						if (isset($_POST['HoTen'])) {
							$hoten = sanitize_text_field($_POST['HoTen']);
							$dienthoai = text2number($_POST['DienThoai']);
							$tinhthanh = sanitize_text_field($_POST['City']);
							$quanhuyen = sanitize_text_field($_POST['District']);
							$ngaysinh = sanitize_text_field($_POST['NgaySinh']);
							$diachi = sanitize_text_field($_POST['DiaChi']);
							$gioitinh = sanitize_text_field($_POST['GioiTinh']);

							global $wpdb;
							$wpdb->update( 
			                    'ls_guest', 
			                    array( 
			                        'hoten' => $hoten,
			                        'tinhthanh' => $tinhthanh,
			                        'quanhuyen' => $quanhuyen,
			                        'diachi' => $diachi,
			                        'dienthoai' => $dienthoai,
			                        'ngaysinh' => $ngaysinh,
			                        'gioitinh' => $gioitinh,
			                        'capnhat' => 1
			                    ), 
			                    array(                         
			                        'id' => $_SESSION['user']['id']
			                    )
			                );

		                	$m = true;
		                	$_SESSION['user']['HoTen'] = $hoten;
					        $_SESSION['user']['TinhThanh'] = $tinhthanh;
					        $_SESSION['user']['QuanHuyen'] = $quanhuyen;
					        $_SESSION['user']['DiaChi'] = $diachi;
					        $_SESSION['user']['DienThoai'] = $dienthoai;
					        $_SESSION['user']['CapNhat'] = 1;
					        $_SESSION['user']['GioiTinh'] = $gioitinh;
					        $_SESSION['user']['NgaySinh'] = $ngaysinh;

						}
					?>

						<div class="<?php if (isset($_GET['sec'])) { echo 'hidden'; } ?>">					
							<p class="common-p <?php if (empty($m) || (isset($m) && !$m)) {
								echo "hidden";
							} ?>" style="margin-bottom: 30px;"><i class="fa fa-check-circle" aria-hidden="true" style="color: #3cba54; margin-right: 5px;"></i>Thông tin tài khoản của bạn đã được cập nhật! :)</p>

							<div class="danhmuc-title mobile-mg-top "><span class="border-danhmuc-title"></span>THÔNG TIN TÀI KHOẢN</div>
							<?php //if ($_SESSION['user']['CapNhat'] == 0) { ?>
								<p class="common-p" style="margin-bottom: 30px;">
									Bạn nên cập nhật chính xác thông tin tài khoản của mình để chúng tôi phục vụ Bạn tốt hơn. :) <br/>
									Lưu ý: những mục có dấu <span style="color: #f588b2">*</span> là bắt buộc.
								</p>
							<?php //} ?>

							<form method="POST">
								<div class="row">
									<div class="col-lg-7 col-sm-15 col-xs-15">
										<div class="form-group">
											<label for="" class="common-p">Họ và tên <span style="color: #f588b2">*</span></label>
											<input type="text" required="" class="form-control" id="" placeholder="" name="HoTen" value="<?php echo $_SESSION['user']['HoTen']; ?>">
										</div>
										<div class="form-group">
											<label for="" class="common-p">Email</label>
											<input type="email" disabled="" class="form-control" id="" placeholder="" name="Email" value="<?php echo $_SESSION['user']['Email']; ?>">
										</div>

										<div class="form-group common-p">
											<label class="common-p" style="margin-right: 20px;">Giới tính</label>
											<label class="radio-inline common-p" style="margin-right: 20px;">
												<input type="radio" name="GioiTinh" class="GioiTinh" value="Nam" > Nam
											</label>
											<label class="radio-inline common-p" style="">
												<input type="radio" name="GioiTinh" class="GioiTinh" value="Nữ" > Nữ
											</label>
										</div>
										<div class="form-group">
											<label for="" class="common-p">Số điện thoại</label>
											<input type="text" class="form-control" id="DienThoai" placeholder="" name="DienThoai" value="<?php echo $_SESSION['user']['DienThoai']; ?>">
										</div>
									</div>

									<div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>

									<div class="col-lg-7 col-sm-15 col-xs-15">
										<div class="form-group">
											<label for="" class="common-p">Ngày sinh</label>
											<input type="text" class="form-control" id="letsop-filter-ngaydat" placeholder="" name="NgaySinh"  value="<?php echo $_SESSION['user']['NgaySinh']; ?>">
										</div>

										<div class="form-group">
											<label for="" class="common-p">Tỉnh | Thành phố</label>
											<select class="form-control" name="City" id="Tinh-ThanPho">
											</select>
										</div>

										<div class="form-group">
											<label for="" class="common-p">Quận | Huyện | Thị xã</label>
											<select class="form-control" name="District" id="Quan-Huyen">
											</select>
										</div>

										<div class="form-group">
											<label for="" class="common-p">Địa chỉ</label>
											<textarea class="form-control" rows="4" name="DiaChi"><?php echo $_SESSION['user']['DiaChi']; ?></textarea>
										</div>
									</div>

									<div class="col-xs-15 col-sm-15 col-lg-15" style="text-align: center; margin-top: 30px;">
										<button type="submit" class="btn btn-info button-mua-tiep" style="width: 200px;">CẬP NHẬT</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery( document ).ready(function() {
		var thanh_phos = <?php json_tinh_thanh()?>;
		for (var tp in thanh_phos) {
			jQuery("#Tinh-ThanPho").append("<option value='"+tp+"'>"+tp+"</option>");
			jQuery("#Tinh-ThanPhoNN").append("<option value='"+tp+"'>"+tp+"</option>");
		}
		jQuery('#Tinh-ThanPho option[value="<?php echo $_SESSION['user']['TinhThanh'] ?>"]').prop('selected', true);

		jQuery("#Tinh-ThanPho").change(function() {				
			var key_tp = jQuery(this).val();
			jQuery("#Quan-Huyen").html("");
			if(key_tp.length > 1) {
				var phuongs = thanh_phos[key_tp];			
				for (var i=0; i< phuongs.length; i++) {
					jQuery("#Quan-Huyen").append("<option value='" +phuongs[i]+ "'>"+phuongs[i]+"</option>");
				}
			}
		}).change();

		jQuery('#Quan-Huyen option[value="<?php echo $_SESSION['user']['QuanHuyen'] ?>"]').prop('selected', true);

		var start_time;
		jQuery("#letsop-filter-ngaydat").datepicker({ dateFormat: "yy-mm-dd", changeYear: true, yearRange: "-70:-14", changeMonth: true, autoSize: true, monthNamesShort: [ "Thg 1", "Thg 2", "Thg 3", "Thg 4", "Thg 5", "Thg 6", "Thg 7", "Thg 8", "Thg 9", "Thg 10", "Thg 11", "Thg 12" ]}).focus(function() {
			start_time = jQuery("#letsop-filter-ngaydat").val();

		}).change(function() {
			if (jQuery(this).val() != '') {
				var patt = /\d{4}-\d{1,2}-\d{1,2}/gi;
				if (!patt.test(jQuery(this).val())) {
					jQuery("#letsop-filter-ngaydat").val(start_time);
				}
			}
		});

		jQuery("input.GioiTinh[value='<?php echo $_SESSION['user']['GioiTinh']?>']").prop( "checked", true );

		jQuery("#DienThoai").keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl/cmd+A
	            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: Ctrl/cmd+C
	            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: Ctrl/cmd+X
	            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });

	    jQuery("#letsop-filter-ngaydat").keydown(function (e) {
	        e.preventDefault();
	    });

	    jQuery("#DangKy").click(function(){
		    if (jQuery("#MatKhau").val() == "") {
					jQuery("#alert-MatKhau").show(); 
					setTimeout(function() {
	                    jQuery("#alert-matkhau").hide(600);    
	                }, 3000);
				}
			var matkhau = jQuery("#MatKhauMoi").val();
			var rematkhau = jQuery("#ReMatKhauMoi").val();

			if (matkhau.length < 6 ) {
				jQuery("#alert-matkhau-length").show(); 
				setTimeout(function() {
	                jQuery("#alert-matkhau-length").hide(600);    
	            }, 3000);
			}

			if (matkhau == rematkhau && matkhau.length >= 6) {
				jQuery("#Standard-Form").submit();
			} else {
				jQuery("#alert-matkhau").show(); 
				setTimeout(function() {
	                jQuery("#alert-matkhau").hide(600);    
	            }, 3000);
			}
		});
	});
</script>


<?php
//get_sidebar();
get_footer();
