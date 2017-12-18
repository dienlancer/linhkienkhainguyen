<?php
if (isset($_POST['ls_type'])) {
	// echo $_POST['ls_type'];
	// print_r($_POST['hinhanh_large']);
	// print_r($_POST['hinhanh_small']);
	if ($_POST['ls_type'] == 'update') {
		$hinhanh_large = $_POST['hinhanh_large'];
		update_option('__images_banner_large', $hinhanh_large);

		$urls = $_POST['url'];
		update_option('__images_banner_url', $urls);

		echo '<script>location="?page='. $_POST['page'] .'"</script>';
	}
} 
?>

<style type="text/css">
table {
	width: 100%;
}

img {
	width: 100px;
	height: auto;
}

.template {
	display: none;
}
</style>
<h2 style="color: #9f1f63; margin-bottom: 0px;">Quản lý Banner - Index</h2>
<!-- <p style="margin-top: 5px;"><span style="color: red; font-weight: bold;">Lưu ý:</span> chỉ cần 5 hình</p> -->
<form method="POST">
	<input type="hidden" name="page" value="<?php echo $_GET['page'] ?>">
	<div style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
        <a href="#them" style="margin-right: 20px"><button type="button" class="button">Thêm Banner</button></a>
        <button type="submit"  class="button" name="ls_type" value="update">Lưu</button>
    </div>
	<table class="wp-list-table widefat fixed striped posts test">
		<thead>
			<tr>
				<th style="width: 5%; text-align: left">STT</th>
				<th style="width: 40%; text-align: left">URL Hình lớn</th>
				<th style="width: 15%; text-align: left">Hình lớn</th>
<!-- 				<th style="width: 25%; text-align: left">URL Hình nhỏ</th>
				<th style="width: 10%; text-align: left">Hình nhỏ</th> -->
				<th style="width: 35%; text-align: left">URL</th>
				<th style="width: 5%; text-align: left">Xóa</th>
			</tr>
		</thead>

		<tbody>
			<tr class="template">
				<td>&#9913;</td>
				<td><input style="width: 90%" id="newimg" data-img="newing" class="img" type="text" name="hinhanh_large[]" disabled="disabled"></td>
				<td><img id="img-newimg" class="img"></td>
				<!-- <td><input style="width: 90%" id="newimg" data-img-2="newing" class="img-2" type="text" name="hinhanh_small[]" disabled="disabled"></td>
				<td><img id="img-newimg-small" class="img-2"></td> -->
				<td><input style="width: 90%" type="text" name="url[]" disabled="disabled"></td>
				<td><a class="remove-this" onclick="jQuery(this).parent().parent().remove()">&times;</td>
			</tr>

		<?php  
			$hinhanh = get_option('__images_banner_large', array());
			// print_r($hinhanh);
			// $hinh_small = get_option('__images_banner_small', array());
			$urls = get_option('__images_banner_url', array());

			if(is_array($hinhanh)) {
				foreach ($hinhanh as $i=> $img) {
					echo '<tr>';
					echo '<td>' . ($i + 1) . '</td>';
					echo '<td><input style="width: 90%" id="loaded-'. $i .'" class="img doscript" data-img="loaded-'. $i .'" type="text" name="hinhanh_large[]" value="'. $img .'"></td>';
					echo '<td><img class="img" id="img-loaded-'. $i .'" data-img="loaded-'. $i .'" src="'. $img .'"></td>';

					// echo '<td><input style="width: 90%" id="loaded-small-'. $i .'" class="img-2 doscript" data-img-2="loaded-'. $i .'" type="text" name="hinhanh_small[]" value="'. $hinh_small[$i] .'"></td>';
					// echo '<td><img class="img-2" id="img-loaded-small-'. $i .'" data-img-2="loaded-'. $i .'" src="'. $hinh_small[$i] .'"></td>';
					echo '<td><input style="width: 90%" type="text" name="url[]" value="'. $urls[$i] .'"/></td>';
					echo '<td><a class="remove-this" onclick="jQuery(this).parent().parent().remove()">&times;</td>';
					echo '</tr>';
				}
			}
			?>
		</tbody>

		<!-- <tfoot>
			<tr>
				<td colspan="6"><a href="#them" style="margin-right: 20px"><button type="button" class="button">Thêm thương hiệu</button></a>
				<button type="submit"  class="button" name="ls_type" value="update">Lưu</button></td>
			</tr>
		</tfoot> -->
	</table>
</form>

<script type="text/javascript">
var i = 0;

jQuery('a[href="#them"]').click(function() {
	var newO = jQuery('.template').clone();
	jQuery(newO).show().attr('class', 'clone');
	jQuery(newO).find('input.img, img.img').attr('data-img', 'gen-'+ (i++)).addClass('doscript').removeAttr('disabled');

	// jQuery(newO).find('input.img-2, img.img-2').attr('data-img-2', 'gen-'+ (i++)).addClass('doscript').removeAttr('disabled');
	jQuery(newO).find('input').removeAttr('disabled');

	jQuery('table.test tbody').append(newO);
	doscript();
});

function doscript() {

	jQuery('table.test input[data-img].doscript').change(function() {
		var data_img = jQuery(this).attr('data-img');
		var src = jQuery(this).val();

		jQuery('img[data-img="'+ data_img +'"]').attr('src', src);
	}).removeClass('doscript');

	// jQuery('table.test input[data-img-2].doscript').change(function() {
	// 	var data_img = jQuery(this).attr('data-img-2');
	// 	var src = jQuery(this).val();

	// 	jQuery('img[data-img-2="'+ data_img +'"]').attr('src', src);
	// }).removeClass('doscript');

	jQuery('table.test input[data-img]').click(function() {
		var data_img = jQuery(this).attr('data-img');
		var me = jQuery(this);

		var custom_uploader;
		//If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Chọn hình',
            button: {
                text: 'Chọn hình'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();

			jQuery(me).val(attachment.url);
			jQuery('img[data-img="'+ data_img +'"]').attr("src", attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
	});

	// jQuery('table.test input[data-img-2]').click(function() {
	// 	var data_img = jQuery(this).attr('data-img-2');
	// 	var me = jQuery(this);

	// 	var custom_uploader;
	// 	//If the uploader object has already been created, reopen the dialog
 //        if (custom_uploader) {
 //            custom_uploader.open();
 //            return;
 //        }
 
 //        //Extend the wp.media object
 //        custom_uploader = wp.media.frames.file_frame = wp.media({
 //            title: 'Chọn hình',
 //            button: {
 //                text: 'Chọn hình'
 //            },
 //            multiple: false
 //        });
 
 //        //When a file is selected, grab the URL and set it as the text field's value
 //        custom_uploader.on('select', function() {
 //            attachment = custom_uploader.state().get('selection').first().toJSON();

	// 		jQuery(me).val(attachment.url);
	// 		jQuery('img[data-img-2="'+ data_img +'"]').attr("src", attachment.url);
 //        });
 
 //        //Open the uploader dialog
 //        custom_uploader.open();
	// });
} 

doscript();


</script>