<?php
if (isset($_REQUEST['ls_type'])) {
	if ($_REQUEST['ls_type'] == 'update') {
		$hinhanh = $_REQUEST['hinhanh'];
		update_option('__images', $hinhanh);
		$ten_thuong_hieu = $_REQUEST['ten-thuong-hieu'];
		update_option('__ten_thuong_hieu', $ten_thuong_hieu);

		echo '<script>location="?page='. $_REQUEST['page'] .'"</script>';
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

<form method="POST">
	<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>">
	<div style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
        <a href="#them" style="margin-right: 20px"><button type="button" class="button">Thêm thương hiệu</button></a>
        <button type="submit"  class="button" name="ls_type" value="update">Lưu</button>
    </div>
	<table class="wp-list-table widefat fixed striped posts test">
		<thead>
			<tr>
				<th style="width: 5%; text-align: left">STT</th>
				<th style="width: 30%; text-align: left">URL</th>
				<th style="width: 20%; text-align: left">Hình ảnh</th>
				<th style="width: 40%; text-align: left">Tên thương hiệu</th>
				<th style="width: 5%; text-align: left">Xóa</th>
			</tr>
		</thead>

		<tbody>
			<tr class="template">
				<td>&#9913;</td>
				<td><input style="width: 90%" id="newimg" data-img="newing" class="img" type="text" name="hinhanh[]" disabled="disabled"></td>
				<td><img id="img-newimg" class="img"></td>
				<td><input style="width: 90%" type="text" disabled name="ten-thuong-hieu[]"></td>
				<td><a class="remove-this" onclick="jQuery(this).parent().parent().remove()">&times;</td>
			</tr>

			<?php  
			$hinhanh = get_option('__images', array());

			$ten_thuong_hieu = get_option('__ten_thuong_hieu', array());

			if(is_array($hinhanh)) {
				foreach ($hinhanh as $i=> $img) {
					echo '<tr>';
					echo '<td>' . ($i + 1) . '</td>';
					echo '<td><input style="width: 90%" id="loaded-'. $i .'" class="img doscript" data-img="loaded-'. $i .'" type="text" name="hinhanh[]" value="'. $img .'"></td>';
					echo '<td><img id="img-loaded-'. $i .'" data-img="loaded-'. $i .'" src="'. $img .'"></td>';
					echo '<td><input style="width: 90%" type="text" name="ten-thuong-hieu[]" value="' . $ten_thuong_hieu[$i] . '"/></td>';
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
	jQuery(newO).find('input.img, img').attr('data-img', 'gen-'+ (i++)).addClass('doscript').removeAttr('disabled');
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

	jQuery('table.test input[data-img]').click(function() {
		var data_img = jQuery(this).attr('data-img');
		var me = jQuery(this);

		// tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		// window.send_to_editor = function(html) {
		// 	imgurl = jQuery('img',html).attr('src');

		// 	jQuery(me).val(imgurl);
		// 	jQuery('img[data-img="'+ data_img +'"]').attr("src", imgurl);
		// 	tb_remove();
		// } 
		// return false;

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
} 

doscript();


</script>