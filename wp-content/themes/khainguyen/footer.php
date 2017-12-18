<div class="container-fluid group-special-footers">
	<div class="wrap wrap-special-footers">
		<div class="row">
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-7 col-special-footer col-md-50">
				<i class="fa fa-truck"></i>
				<div class="special-title">
					<?php echo get_option('td_footer_1'); ?>
				</div>
				<div class="special-details">
					<?php echo stripslashes(html_entity_decode(get_option('nd_footer_1'))); ?>
				</div>
			</div>
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-8 col-special-footer col-md-50">
				<i class="fa fa-gift"></i>
				<div class="special-title">
					<?php echo get_option('td_footer_2'); ?>
				</div>
				<div class="special-details">
					<?php echo stripslashes(html_entity_decode(get_option('nd_footer_2'))); ?>
				</div>
			</div>
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-7 col-special-footer col-md-50">
				<i class="fa fa-refresh"></i>
				<div class="special-title">
					<?php echo get_option('td_footer_3'); ?>
				</div>
				<div class="special-details">
					<?php echo stripslashes(html_entity_decode(get_option('nd_footer_3'))); ?>
				</div>
			</div>
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-8 col-special-footer col-md-50">
				<i class="fa fa-phone" aria-hidden="true"></i>
				<div class="special-title">
					<?php echo get_option('td_footer_4'); ?>
				</div>
				<div class="special-details">
					<?php echo stripslashes(html_entity_decode(get_option('nd_footer_4'))); ?>
				</div>
			</div>
		</div>
		<!-- <img class="hidden-xs hidden-sm hidden-md" style="position: absolute; bottom: -2px; left: -114px;" src="<?php //echo esc_url(get_template_directory_uri() . '/images/nhap-hang-tq.png') ?>" > -->
	</div>
</div>

<!-- footer -->
<div class="container-fluid group-footers">
	<div class="wrap group-footer">
		<div class="row">
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-7 footer-col-1 col-md-50">
				<div class="footer-title">
					KHAI NGUYÊN
				</div>
				<div style="margin-top: 10px; font-size: 18px;">
					<?php echo get_option('gioi_thieu'); ?>
				</div>
				<div class="footer-address">
					<i class="fa fa-map-marker fa-2x" aria-hidden="true" style="margin-right: 12px;"></i>
					<?php echo get_option('address'); ?>
				</div>
				<div class="footer-address">
					<i class="fa fa-envelope-o fa-2x" aria-hidden="true" style="margin-right: 5px;"></i>
					<?php echo get_option('email'); ?>
				</div>
				<div class="footer-address">
					<i class="fa fa-phone fa-2x" aria-hidden="true" style="margin-right: 11px;"></i>
					<?php echo get_option('phone_number'); ?> - <?php echo get_option('phone_number_2'); ?>
				</div>

				<div class="footer-address">
					<i class="fa fa-phone fa-2x" aria-hidden="true" style="margin-right: 11px;"></i>
					<?php echo get_option('phone_number_3'); ?> - <?php echo get_option('phone_number_4'); ?>
				</div>
			</div>

			<div class="col-lg-3 col-xs-15 col-sm-15 col-md-8 footer-col-2 col-md-50">
				<div class="footer-small-title">
					Chính sách
				</div>
				<?php wp_nav_menu(array(
						'menu' => "Footer Menu",
						'container' => '',
						'menu_class' => "chinhsach"
					)); ?>

				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/dang-ky-bo-cong-thuong.png') ?>" style="margin-top: 20px;">
			</div>

			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-7 footer-col-3 col-md-50">
				<div class="footer-small-title">
					Tài khoản ngân hàng
				</div>
				<p style="margin-top: 20px;">Tên TK: Lưu Gia Bửu</p>
				<ul class="chinhsach" style="margin-top: 5px;">
					<li>Ngân hàng Sacombank
						<p style="margin-left: 12px;">Số TK: 060117363735</p>
					</li>
					<li>Ngân hàng ACB – PGD Lê Văn Quới
						<p style="margin-left: 12px;">Số TK: 903931708</p>
					</li>
					<li>Ngân hàng VCB - CN Đông Sài Gòn
						<p style="margin-left: 12px;">Số TK: 0181000423808</p>
					</li>
					<li>Agribank Lý Thường kiệt
						<p style="margin-left: 12px;">Số TK: 1603 205 531 524</p>
					</li>
					<li>Techcombank – CN Minh Phụng
						<p style="margin-left: 12px;">Số TK: 1902 82157 46014</p>
					</li>
				</ul>
			</div>
			<div class="col-lg-4 col-xs-15 col-sm-15 col-md-8 footer-col-4 col-md-50">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/bansikhainguyen/" data-tabs="timeline" data-width="300" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bansikhainguyen/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bansikhainguyen/">Linh Kiện Khai Nguyên</a></blockquote></div>


				<div class="group-socials">
					<a href="<?php echo stripslashes(html_entity_decode(get_option('urlimg'))); ?>"><i class="fa fa-camera-retro"></i></a>
					<a href="<?php echo stripslashes(html_entity_decode(get_option('urlyoutube'))); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
					<a href="<?php echo stripslashes(html_entity_decode(get_option('urlinstagram'))); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="#"><div class="vow-icon-to-top"><i class="fa fa-chevron-up fa-2x"></i></div></a>
<?php echo stripslashes(html_entity_decode(get_option('ket_thuc_body'))); ?>

<a href="https://m.me/bansikhainguyen" target="_blank"><img class="icon-fb" src="<?php echo esc_url(get_template_directory_uri() . '/images/fb.png') ?>"></a>
<div class="icon-zalo">
	<img class="" src="<?php echo esc_url(get_template_directory_uri() . '/images/zalo.png') ?>">
	<div class="number-list">
	<?php 
		if (get_option('phone_number')) {
			echo '<div class="number-ph">' . get_option('phone_number') . "</div>";
		}

		if (get_option('phone_number_2')) {
			echo '<div class="number-ph">' . get_option('phone_number_2') . "</div>";
		}

		if (get_option('phone_number_3')) {
			echo '<div class="number-ph">' . get_option('phone_number_3') . "</div>";
		}

		if (get_option('phone_number_4')) {
			echo '<div class="number-ph">' . get_option('phone_number_4') . "</div>";
		}
	?>
	</div>
</div>
<div class="icon-phone">
	<img class="" style="width: 65px; height: 65px;" src="<?php echo esc_url(get_template_directory_uri() . '/images/phone-header-large.png') ?>">

	<div class="phone-number-list">
		<div class="number-ph">CSKH TP Ms. Chi: <br/>0903131708 / 0961808688</div>
		<div class="number-ph">CSKH TINH Ms. Ngân: <br/>0939933168 / 0901406756</div>
	</div>
	
</div>
<a href="http://linhkienkhainguyen.com/order-si-tai-trung-quoc/">
<img class="chuyen-hang-trung-quoc" src="<?php echo esc_url(get_template_directory_uri() . '/images/nhap-hang-tq.png') ?>" >
</a>

<style type="text/css">
	.icon-phone {
		z-index: 90;
	}
	.icon-zalo {
		z-index: 91;
	}
	.number-list, .phone-number-list {
		position: absolute;
		bottom: 70px;
		right: 0px;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		display: none;
		min-width: 120px;
		background-color: #fff;
	}

	.phone-number-list {
		min-width: 250px;
	}
	.number-ph {
		font-size: 14px;
		font-weight: bold;
		color: #333;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function () {
	    jQuery(window).scroll(function () {
	        if (jQuery(this).scrollTop() > 100) {
	            jQuery('.vow-icon-to-top').fadeIn();
	        } else {
	            jQuery('.vow-icon-to-top').fadeOut();
	        }
	    });

	    jQuery('.vow-icon-to-top').click(function () {
	        jQuery("html, body").animate({
	            scrollTop: 0
	        }, 600);
	        return false;
	    });
		jQuery(".icon-zalo").click(function(){
			jQuery(".number-list").toggle("slow");
		});

		jQuery(".icon-phone").click(function(){
			jQuery(".phone-number-list").toggle("slow");
		});

	});
</script>
</body>
</html>
