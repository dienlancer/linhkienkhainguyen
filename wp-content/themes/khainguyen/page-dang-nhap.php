<?php 
session_start();
if (isset($_SESSION['user']['id'])) {
	wp_redirect(esc_url( home_url( '/' )));
	// wp_redirect(esc_url( $_SERVER['HTTP_REFERER']));
	exit();
}

if (isset($_POST['Email'])) {
	$email = sanitize_email($_POST['Email']);
	$matkhau = sanitize_text_field($_POST['MatKhau']);

	global $wpdb;
    $user_db = $wpdb->get_row("SELECT * FROM ls_guest WHERE email = '" . $email . "' and matkhau = '" . md5($matkhau) . "'");
    if(isset($user_db->id)){
        $_SESSION['user']['id'] = $user_db->id;                 
        $_SESSION['user']['HoTen'] = $user_db->hoten;
        $_SESSION['user']['TinhThanh'] = $user_db->tinhthanh;
        $_SESSION['user']['QuanHuyen'] = $user_db->quanhuyen;
        $_SESSION['user']['DiaChi'] = $user_db->diachi;
        $_SESSION['user']['DienThoai'] = $user_db->dienthoai;
        $_SESSION['user']['Email'] = $user_db->email;
        $_SESSION['user']['GhiChu'] = $user_db->ghichu;
        $_SESSION['user']['DiemTichLuy'] = $user_db->diemtichluy;
        $_SESSION['user']['CapNhat'] = $user_db->capnhat;
        $_SESSION['user']['GioiTinh'] = $user_db->gioitinh;
        $_SESSION['user']['NgaySinh'] = $user_db->ngaysinh;

        $_SESSION['user']['DiemNhan'] = "ChuTaiKhoan";

        if(is_page("dang-nhap")) {
            wp_redirect(esc_url( home_url( '/' )));
            exit;
        }
    } else {
    	$message = "Tài khoản hoặc mật khẩu không đúng. Vui lòng kiểm tra lại!";
    }
}

// Facebook App
if (isset($_REQUEST['access_token'])) {
	$access_token = $_REQUEST['access_token'];
	$graph_url = 'https://graph.facebook.com/oauth/access_token_info?'
	  . 'client_id=438587903169464&access_token=' . $access_token;

	// 'https://graph.facebook.com/me?access_token=EAAGO5LQr07gBABIm8LaX1FjZBQjULhGkQe3UwXZC0zBHaezmp3gCCDmbwGRk9iH0WaG04a5XXvNdzVMIUalodrN0mtOfqoFvyQ7M8rEjP3c1GC9nO6rOAko7WGCNUrZCZApr7Q3pSTLZBfM4wgZAJa5Cw96Xn0XLvqOmAZBFnNw5HkziUKIoYfGEJ7dgJ1hGQ7nBfhGQhEridOdvz7tXrfKAUTTqWoe2B4ZD'
	$access_token_info = json_decode(file_get_contents($graph_url));
	// echo $access_token_info;

	// function nonceHasBeenUsed($auth_nonce) {
		// Here you would check your database to see if the nonce
		// has been used before. For the sake of this example, we'll
		// just assume the answer is "no".
		// $_SESSION['user']['G'] = $access_token_info->auth_nonce;
	// }

	// if (nonceHasBeenUsed($access_token_info->auth_nonce) != true) {
	// 	echo '1';
	// } else {
	// 	echo '0';
	// }
	exit;
}
// echo "::" . $_SESSION['user']['G'] . "::";

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



<div class="container-fluid">;
	<div class="wrap main-content">
		<div class="row">
			<div class="col-lg-15 col-sm-15 col-xs-15">			
				<h1 class="title-tai-khoan"><i class="fa fa-user-circle-o" aria-hidden="true" style="margin-right: 10px;"></i><?php the_title(); ?></h1>
				<div class="main-detail">
					<div class="row">
						<div class="col-lg-5 col-sm-15 col-xs-15 common-p" style="margin-bottom: 25px;">
							Nếu Bạn đã có tài khoản, vui lòng Đăng nhập để có thể sử dụng dịch vụ của chúng tôi một cách tốt nhất.
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15">
							<?php if (isset($message)) : ?>
			                    <div id="vow-register-alert" class="alert alert-danger common-p"><?php echo $message ?></div>
			                    <script>
				                    setTimeout(function() {
				                        jQuery("#vow-register-alert").hide(600);    
				                    }, 3000);
			                    </script>
			                <?php endif; ?>
							<form method="POST">
								<div class="form-group">
									<input type="email" class="form-control new-padding-info" name="Email" placeholder="Email đăng nhập">
								</div>	

								<div class="form-group">
									<input type="password" class="form-control new-padding-info" name="MatKhau" placeholder="Mật khẩu">
								</div>

								<div class="g-recaptcha" data-sitekey="6LeoUSwUAAAAAPLt1h51zH5X-8-mL5VTd-7VxpcM" style="margin-bottom: 20px;"></div>

								<button type="submit" class="btn btn-info button-mua-tiep" style="width: 200px;">Đăng Nhập</button>

								<p class="common-p" style="margin-top: 15px;"><a href="<?php $page = get_page_by_title( 'Quên mật khẩu' ); echo esc_url( get_page_link($page->ID) ); ?>" class="color-link">Quên mật khẩu</a></p>

								<p class="common-p">Bạn chưa có tài khoản thành viên? <a href="<?php $page = get_page_by_title( 'Đăng ký tài khoản' ); echo esc_url( get_page_link($page->ID) ); ?>" class="color-link">Đăng ký ngay!</a></p>
							</form>
						</div>

						<div class="col-lg-5 col-sm-15 col-xs-15">
							<p class="common-p mobile-dk-mang-xa-hoi">Hoặc Đăng nhập nhanh bằng tài khoản mạng xã hội.</p>
							<button onclick="checkLoginState();" type="button" class="btn btn-default" style="width: 100%; height: 40px; margin-top: 5px; background-color: #3b5998; color: #fff; text-align: left; max-width: 350px;"><i class="fa fa-facebook" aria-hidden="true" style="margin-right: 30px;"></i>Đăng nhập bằng Facebook</button>

							<!-- <button type="button" class="btn btn-default" style="width: 100%; height: 40px; margin-top: 20px; background-color: #db3236; color: #fff; text-align: left;" onclick=""><i class="fa fa-google-plus" aria-hidden="true" style="margin-right: 20px;"></i>Đăng nhập bằng Google+</button> -->

							<!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
							<!-- In the callback, you would hide the gSignInWrapper element on a
  successful sign in -->
  <div id="gSignInWrapper">
    <!-- <span class="label">Sign in with:</span>
    <div id="customBtn" class="customGPlusSignIn">
      <span class="icon"><i class="fa fa-google-plus" aria-hidden="true" style="margin-right: 20px;"></i></span>
      <span class="buttonText">Google</span>
    </div> -->
    <button id="customBtn" type="button" class="btn btn-default" style="width: 100%; height: 40px; margin-top: 20px; background-color: #db3236; color: #fff; text-align: left; max-width: 350px;"><i class="fa fa-google-plus" aria-hidden="true" style="margin-right: 20px;"></i>Đăng nhập bằng Google+</button>
  </div>
  <div id="name"></div>
  <script>startApp();</script>

							<!-- <div id="my-signin2"></div> -->
  <script>
    function onSuccess(googleUser) {
      var profile = googleUser.getBasicProfile();

      console.log('Logged in as: ' + profile.getName());

      console.log('ID: ' + profile.getId());
	  console.log('Full Name: ' + profile.getName());
	  console.log('Given Name: ' + profile.getGivenName());
	  console.log('Family Name: ' + profile.getFamilyName());
	  console.log('Image URL: ' + profile.getImageUrl());
	  console.log('Email: ' + profile.getEmail());

    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 250,
        'height': 40,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>



							<!-- <fb:login-button 
								scope="public_profile,email"
								onlogin="checkLoginState();">
							</fb:login-button> -->
							<!-- <div id="fb-root"></div>
							<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div> -->

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>



<?php
//get_sidebar();
get_footer();
