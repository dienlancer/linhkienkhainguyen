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
	// Nhận email, tạo code verify và gửi link khôi phục
	if (isset($_POST['Email'])) {
		$email = sanitize_email($_POST['Email']);

		$send = true;
		$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
		global $wpdb;
		$wpdb->update( 
            'ls_guest', 
            array( 
                'kichhoat' => 2,
                'xacnhan' =>  $token                     
            ), 
            array(                         
                'email' => $email
            )
        );

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
		
		$link = "https://www.thebealux.com/quen-mat-khau?token=" . $token . "&userid=" . $email;
		$body = "The BeaLux - Beauty and Luxury xin kính chào Quý khách!<br/>Để xác nhận khôi phục mật khẩu, Quý khách vui lòng nhấp vào link sau:<br/><a href=\"$link\">$link</a>";
		
		$mail->Subject = "Khôi phục mật khẩu"; //Tiêu đề của thư
		$mail->MsgHTML($body); //Nội dung của bức thư.
		// Gửi thư với tập tin html
		$mail->AltBody = "Khôi phục tài khoản tại The BeaLux";//Nội dung rút gọn hiển thị bên ngoài thư mục thư.
		
		//Tiến hành gửi email và kiểm tra lỗi			  
		$mail->Send();
	}

	// Nhận đường dẫn từ mail, xác nhận và chuyển trang cập nhật mật khẩu
	if (isset($_GET['userid']) && empty($_POST['MatKhau'])) {
		$email = sanitize_email($_GET['userid']);
		$token = sanitize_text_field($_GET['token']);

		global $wpdb;
	    $user_db = $wpdb->get_row("SELECT * FROM ls_guest WHERE `email` = '" . $email . "' and `xacnhan` = '" . $token . "' and `kichhoat` = 2");
	    if(isset($user_db->id)){ 
	    	$wpdb->update( 
            'ls_guest', 
	            array( 
	                'kichhoat' => 1,
	                'xacnhan' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20)                       
	            ), 
	            array(                         
	                'email' => $email
	            )
	        );
	    	$success = true;
	    }
	}


	// Cập nhật pass mới
    if (isset($_POST['MatKhau'])) {
    	$email = sanitize_email($_POST['userid']);
		$token = sanitize_text_field($_POST['token']);
		$matkhau = sanitize_text_field($_POST['MatKhau']);
		$rematkhau = sanitize_text_field($_POST['ReMatKhau']);
		$update = false;
		if ($matkhau == $rematkhau) {
			global $wpdb;
			$user_db = $wpdb->get_row("SELECT * FROM ls_guest WHERE `email` = '" . $email . "' and `xacnhan` = '" . $token . "' and `kichhoat` = 2");
			if(isset($user_db->id)){
				$wpdb->update( 
                    'ls_guest', 
                    array( 
                        'matkhau' => md5($rematkhau),
                        'kichhoat' => 1,
                        'xacnhan' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20)
                    ), 
                    array(                         
                        'email' => $email
                    )
                );
                $update = true;
			}
		}
    }
?>

<div class="container-fluid">
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">			
				<h1 class="title-tai-khoan"><i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right: 10px;"></i><?php the_title(); ?></h1>
				<div class="main-detail">
				<?php if (isset($update) && $update == true) { ?>
					<p class="common-p " style="margin-bottom: 30px;"><i class="fa fa-check-circle" aria-hidden="true" style="color: #3cba54; margin-right: 5px;"></i>Bạn đã khôi phục mật khẩu thành công. Hãy tiếp tục mua sắm nhé! :)</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="reset-matkhau "><button type="button" class="btn btn-info button-mua-tiep" style="width: 200px;">TRANG CHỦ</button></a>
				<?php } ?>


					<?php if (isset($success) && $success == true) { ?>
					<div class="row">
						<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
							Bạn vui lòng cập nhật mật khẩu mới tại đây.
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15">
							<form method="POST" id="Standard-Form" action="<?php $page = get_page_by_title( 'Quên mật khẩu' ); echo esc_url( get_page_link($page->ID) ); ?>">
								<input type="hidden" name="userid" value="<?php echo $email ?>">
								<input type="hidden" name="token" value="<?php echo $token ?>">
								<div class="form-group">
									<input type="password" class="form-control new-padding-info" name="MatKhau" placeholder="Mật khẩu" id="MatKhauMoi">
								</div>
								<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau-length" role="alert">Mật khẩu quá ngắn!</div>

								<div class="form-group">
									<input type="password" class="form-control new-padding-info" name="ReMatKhau" placeholder="Nhập lại mật khẩu" id="ReMatKhauMoi">
								</div>	
								<div class="alert alert-danger common-p" style="display: none;" id="alert-matkhau" role="alert">Mật khẩu không khớp!</div>

								<button type="button" id="DangKy" class="btn btn-info button-mua-tiep" style="width: 200px;">CẬP NHẬT MẬT KHẨU</button>
							</form>
						</div>						
					</div>
					<script type="text/javascript">
						jQuery("#DangKy").click(function(){
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
					</script>
					<?php } ?>

					<?php if (isset($_POST['Email'])) { ?>

				<?php //} ?>
		
					<?php //if (isset($send) || $send == true) {  ?>
					<p class="common-p ">Chúng tôi đã gửi liên kết để đặt lại mật khẩu vào email <span  class="link-color"><?php if (isset($email)) { echo $email; } ?></span> của bạn.</p>
					<p class="common-p ">Nếu bạn có thắc mắc về chính sách thành viên, xin vui lòng liên hệ bộ phận <a href="<?php $page = get_page_by_title( 'Chăm sóc khách hàng' ); echo esc_url( get_page_link($page->ID) ); ?>" class="color-link" style="text-decoration: underline;">Chăm sóc khách hàng</a> của chúng tôi.</p>
					<?php } ?>


					<?php if (empty($send) && empty($success) && empty($update) && empty($_POST['MatKhau'])) { ?>
					<?php //if ($send) { echo 'hidden'; } ?>
					<div class="row ">
						<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
							Chúng tôi sẽ gửi đường dẫn khôi phục mật khẩu qua email mà bạn đã dùng để đăng ký tài khoản.
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15">
							<form method="POST">
								<div class="form-group">
									<input type="email" class="form-control new-padding-info" name="Email" placeholder="Email đăng nhập">
								</div>	

								<button type="submit" class="btn btn-info button-mua-tiep" style="width: 200px;">LẤY LẠI MẬT KHẨU</button>
							</form>
						</div>						
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
//get_sidebar();
get_footer();
