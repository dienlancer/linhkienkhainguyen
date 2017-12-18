<?php
session_start();
if (isset($_SESSION['user']['id'])) {
	wp_redirect(esc_url( home_url( '/' )));
	// wp_redirect(esc_url( $_SERVER['HTTP_REFERER']));
	exit();
}
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
	require_once get_template_directory() . "/inc/phpmailer_5/class.phpmailer.php";

	if (isset($_GET['verify'])) {
		$code = sanitize_text_field($_GET['verify']);
		$id = text2number($_GET['id']);
		
		$verify = false;
		global $wpdb;
	    $user_db = $wpdb->get_row("SELECT * FROM ls_guest WHERE id = " . $id);
	    if(isset($user_db->id)){
	    	if ($user_db->xacnhan == $code) {	    		
	            $wpdb->update( 
	                    'ls_guest', 
	                    array( 
	                        'kichhoat' => 1,
	                        'xacnhan' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20)                       
	                    ), 
	                    array(                         
	                        'id' => $id
	                    )
	                );
	            $verify = true;

	            $_SESSION['user']['id'] = $user_db->id;                 
		        $_SESSION['user']['HoTen'] = $user_db->hoten;
		        $_SESSION['user']['TinhThanh'] = $user_db->tinhthanh;
		        $_SESSION['user']['QuanHuyen'] = $user_db->quanhuyen;
		        $_SESSION['user']['DiaChi'] = $user_db->diachi;
		        $_SESSION['user']['DienThoai'] = $user_db->dienthoai;
		        $_SESSION['user']['Email'] = $user_db->email;
		        $_SESSION['user']['GhiChu'] = $user_db->ghichu;
		        $_SESSION['user']['DiemNhan'] = "ChuTaiKhoan";

		    }
	    } 
	}
	if (isset($_POST['Standard-Form'])) {
		$hoten = sanitize_text_field($_POST['HoTen']);
		$email = sanitize_email($_POST['Email']);
		$matkhau = sanitize_text_field($_POST['MatKhau']);
		$maxacnhan = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
		global $wpdb;
        $wpdb->insert( 
        	'ls_guest', 
        	array( 
        		'email' => $email, 
        		'matkhau' => md5($matkhau),
                'hoten' => $hoten,
                'tinhthanh' => "",
                'quanhuyen' => "",
                'diachi' => "",
                'dienthoai' => "",
                // 'ngay_sinh' => "",
                'ngaydangky' => date("Y-m-d"),
                'kichhoat' => 0,
                'ghichu' => "",
                'xacnhan' => $maxacnhan,
                'diemtichluy' => 0,
                'capnhat' => 0,
                'gioitinh' => "Nam",
                // 'ngaysinh'=>
        	)
        );
        
        $id = $wpdb->insert_id;

        if($id > 0) {
         //    $_SESSION['vow_user_id'] = $id;                 
         //    $_SESSION['vow_user_name'] = $hoten;

         //    $_SESSION['tk_ho_ten'] = $hoten;
         //    $_SESSION['tk_email'] = $email;

        	// wp_redirect( get_permalink(get_page_by_path('tai-khoan-cua-ban')));        
         //    exit;
        	$message = true;

        	$mail = new PHPMailer();
    			
			$mail->CharSet = 'UTF-8';
			
			//Khai báo gửi mail bằng SMTP
			$mail->IsSMTP();
			//Tắt mở kiểm tra lỗi trả về, chấp nhận các giá trị 0 1 2
			// 0 = off không thông báo bất kì gì, tốt nhất nên dùng khi đã hoàn thành.
			// 1 = Thông báo lỗi ở client
			// 2 = Thông báo lỗi cả client và lỗi ở server
			$mail->SMTPDebug  = 0;
			
			$mail->Debugoutput = "html"; // Lỗi trả về hiển thị với cấu trúc HTML
			$mail->Host       = "ssl://" . get_option('letsop-SMTP'); //host smtp để gửi mail
			$mail->Port       = get_option('letsop-Port'); // cổng để gửi mail //465 ssl - 587 tls
			$mail->SMTPSecure = get_option('letsop-SMTPSecure'); //Phương thức mã hóa thư - ssl hoặc tls
			$mail->SMTPAuth   = true; //Xác thực SMTP
			$mail->Username   = get_option('letsop-Sendemail'); // Tên đăng nhập tài khoản Gmail
			$mail->Password   = get_option('letsop-Passemail'); //Mật khẩu của gmail
			$mail->SetFrom(get_option('letsop-Sendemail'), "The BeaLux - Beauty and Luxury"); // Thông tin người gửi
			$mail->AddReplyTo(get_option('letsop-Sendemail'), "The BeaLux - Beauty and Luxury");// Ấn định email sẽ nhận khi người dùng reply lại.
			/*Gửi cho khách*/        
			$mail->AddAddress($email, "");//Email của người nhận
			
			$link = "https://www.thebealux.com/dang-ky-tai-khoan/?verify=" . $maxacnhan . "&id=" . $id;
			$body = "The BeaLux - Beauty and Luxury xin kính chào Quý khách!<br/>Để xác nhận đăng ký tài khoản, Quý khách vui lòng nhấp vào link sau:<br/><a href=\"$link\">$link</a>";
			
			$mail->Subject = "Xác thực tài khoản"; //Tiêu đề của thư
			$mail->MsgHTML($body); //Nội dung của bức thư.
			// Gửi thư với tập tin html
			$mail->AltBody = "Xác thực đăng ký tài khoản tại The BeaLux";//Nội dung rút gọn hiển thị bên ngoài thư mục thư.
			
			//Tiến hành gửi email và kiểm tra lỗi			  
			$mail->Send();

        } else {
        	$message = false;
        }
	}
?>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">			
				
				<h1 class="title-tai-khoan"><i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right: 10px;"></i><?php the_title(); ?></h1>
				
				<div class="main-detail">
					<p class="common-p <?php if (!isset($message) || $message != true) { echo 'hidden'; } ?>">
						Chúng tôi đã gửi cho bạn đường dẫn xác thực tài khoản đến email mà bạn vừa đăng ký. Bạn vui lòng kiểm tra và xác thực. Nếu không thấy trong thư mục thư đến, bạn vui lòng kiểm tra trong mục Spam / Bulk.
					</p>
				<?php 
					if (isset($_POST['Standard-Form']) && empty($message)) { ?>
					<p class="common-p">
						Rất tiếc! Email này đã được đăng ký. Hãy thử email khác hoặc sử dụng trang <a href="<?php $page = get_page_by_title( 'Quên mật khẩu' ); echo esc_url( get_page_link($page->ID) ); ?>" class="color-link">Quên mật khẩu</a> để lấy lại mật khẩu.
					</p>
					
				<?php } ?>
					<p class="common-p <?php if (!isset($verify) || $verify != true) { echo 'hidden'; } ?>">
						Xin chúc mừng! Bạn đã đăng ký thành công tài khoản!<br/>
						Bạn có thể vào trang <a href="<?php $page = get_page_by_title( 'Quản lý tài khoản' ); echo esc_url( get_page_link($page->ID) ); ?>" class="link-color" style="text-decoration: underline;">Quản lý tài khoản</a> để bổ sung những thông tin cần thiết trước khi mua sắm bạn nhé.
					</p>

					<?php if (isset($verify) && !$verify ) {  ?>
					<p class="common-p">
						Mã xác nhận không hợp lệ!
					</p>
					<?php } ?>
					<div class="row hidden">
						<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
							Bạn vui lòng cập nhật mật khẩu để hoàn tất quá trình đăng ký.
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15 ">
							<form>
								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="HoTen" placeholder="Họ và tên">
								</div>

								<div class="form-group">
									<input disabled="" type="email" class="form-control new-padding-info" name="Email">
								</div>	

								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="MatKhau" placeholder="Mật khẩu">
								</div>

								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="ReMatKhau" placeholder="Nhập lại mật khẩu">
								</div>
								<button type="button" class="btn btn-info button-mua-tiep" style="width: 200px;">Cập nhật</button>
							</form>
						</div>
					</div>

					<div class="row dang-ky-tai-khoan <?php if (isset($message) || $message == true || isset($verify) || $verify == true) { echo 'hidden'; } ?>">
						<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
							Hãy ĐĂNG KÝ thành viên để nhận được những ưu đãi và thông tin khuyễn mãi từ chúng tôi.
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15">
							<?php if (isset($message) && $message == false) : ?>
			                    <div id="ls-register-alert" class="alert alert-danger common-p">Email của Bạn đã được đăng ký!</div>
			                    <script>
				                    setTimeout(function() {
				                        jQuery("#ls-register-alert").hide(600);    
				                    }, 3000);
			                    </script>
			                <?php endif; ?>
							<form method="POST" id="Standard-Form">
								<div class="form-group">
									<input type="text" class="form-control new-padding-info" name="HoTen" placeholder="Họ và tên" required="" id="HoTen">
								</div>
								<div class="alert alert-danger common-p" style="display: none;" id="alert-hoten" role="alert">Vui lòng nhập tên!</div>

								<div class="form-group">
									<input type="email" class="form-control new-padding-info" name="Email" placeholder="Email đăng nhập" required="" id="Email">
								</div>	
								<div class="alert alert-danger common-p" style="display: none;" id="alert-email" role="alert">Vui lòng nhập email!</div>

								<div class="form-group">
									<input type="password" class="form-control new-padding-info" name="MatKhau" placeholder="Mật khẩu" id="MatKhau" required="">
								</div>
								<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau-length" role="alert">Mật khẩu quá ngắn!</div>

								<div class="form-group">
									<input type="password" class="form-control new-padding-info" name="ReMatKhau" placeholder="Nhập lại mật khẩu" id="ReMatKhau" required="">
								</div>
								<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau" role="alert">Mật khẩu không khớp!</div>

								<?php the_content() ?>

								<input type="hidden" name="Standard-Form" value="Standard-Form">

								<button type="button" id="DangKy" class="btn btn-info button-mua-tiep" style="width: 200px;">ĐĂNG KÝ</button>

								<p class="common-p" style="margin-top: 20px;">Tôi đã đọc và đồng ý với <a href="<?php $page = get_page_by_title( 'Chính sách' ); echo esc_url( get_page_link($page->ID) ); ?>" style="text-decoration: underline;" class="link-color">chính sách</a> của Lolotica.</p>
							</form>
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15 hidden">
							<p class="common-p mobile-dk-mang-xa-hoi">Hoặc Đăng ký nhanh bằng tài khoản mạng xã hội.</p>
							<p class="common-p" style="margin-top: 10px;">Lolotica sẽ không bao giờ gửi thông tin hoặc chia sẻ thông tin mà không có sự đồng ý của Bạn.</p>
							<!-- <button type="button" class="btn btn-default" style="width: 100%; height: 40px; margin-top: 30px; background-color: #3b5998; color: #fff; text-align: left;"><i class="fa fa-facebook" aria-hidden="true" style="margin-right: 30px;"></i>Đăng ký bằng Facebook</button>

							<button type="button" class="btn btn-default" style="width: 100%; height: 40px; margin-top: 20px; background-color: #db3236; color: #fff; text-align: left;"><i class="fa fa-google-plus" aria-hidden="true" style="margin-right: 20px;"></i>Đăng ký bằng Google+</button> -->
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready(function(){
		jQuery("#DangKy").click(function(){
			if (jQuery("#HoTen").val() == "") {
				jQuery("#alert-hoten").show(); 
				setTimeout(function() {
                    jQuery("#alert-hoten").hide(600);    
                }, 3000);
			}

			if (jQuery("#Email").val() == "") {
				jQuery("#alert-email").show(); 
				setTimeout(function() {
                    jQuery("#alert-matkhau").hide(600);    
                }, 3000);
			}
			var matkhau = jQuery("#MatKhau").val();
			var rematkhau = jQuery("#ReMatKhau").val();

			if (matkhau.length < 6 ) {
				jQuery("#alert-matkhau-length").show(); 
				setTimeout(function() {
                    jQuery("#alert-matkhau-length").hide(600);    
                }, 3000);
			}

			if (matkhau == rematkhau  && matkhau.length >= 6) {
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
