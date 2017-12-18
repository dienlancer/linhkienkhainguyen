<!-- <script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery.min.js"></script> -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php 
    $current_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ; 
    include TEMPLATEPATH . "/inc/paging.php";
?>

<?php
    if(isset($_POST['letsop_submit']))
    {
        $letsop_sub = $_POST['letsop_submit'];
        if($letsop_sub == "Thêm")
        {
            $letsop_code = sanitize_text_field($_POST['letsop_code']);
            $letsop_start = sanitize_text_field($_POST['letsop_start']);
            $letsop_end = sanitize_text_field($_POST['letsop_end']);
            $letsop_giam_gia = text2number($_POST['letsop_giam_gia']);
            $letsop_duoc_dung = text2number($_POST['letsop_duoc_dung']);
            $letsop_da_dung = text2number($_POST['letsop_da_dung']);
           
            global $wpdb;
            $wpdb->insert( 
            	'wp_sale_off_code', 
            	array( 
            		'code' => $letsop_code,
                    'start_date' => $letsop_start,
                    'end_date' => $letsop_end,
                    'gia_giam' => $letsop_giam_gia,
                    'so_lan_su_dung' => $letsop_duoc_dung,
                    'so_lan_da_dung' => $letsop_da_dung
            	)
            );
        } 
        if($letsop_sub == "Xóa")
        {
            $letsop_id = text2number($_POST['letsop_id']);
            global $wpdb;
            $wpdb->delete( 'wp_sale_off_code', array( 'id' => $letsop_id ) );
        } 

        if($letsop_sub == "Xem"){
            $letsop_id = text2number($_POST['letsop_id']);
            global $wpdb;
            $letsop_views = $wpdb->get_row("SELECT * FROM wp_sale_off_code WHERE id =" . $letsop_id);
        } 

        if($letsop_sub == "Sửa")
        {
            $letsop_id = text2number($_POST['letsop_id']);
            $letsop_code = sanitize_text_field($_POST['letsop_code']);
            $letsop_start = sanitize_text_field($_POST['letsop_start']);
            $letsop_end = sanitize_text_field($_POST['letsop_end']);
            $letsop_giam_gia = text2number($_POST['letsop_giam_gia']);
            $letsop_duoc_dung = text2number($_POST['letsop_duoc_dung']);
            $letsop_da_dung = text2number($_POST['letsop_da_dung']);
                    
            global $wpdb;
            $wpdb->update( 
            	'wp_sale_off_code', 
            	array( 
            		'code' => $letsop_code,
                    'start_date' => $letsop_start,
                    'end_date' => $letsop_end,
                    'gia_giam' => $letsop_giam_gia,
                    'so_lan_su_dung' => $letsop_duoc_dung,
                    'so_lan_da_dung' => $letsop_da_dung
            	),
                array( 
            		'id' => $letsop_id
            	)
            );
        } 
    }
?>
<script> 
    function xoa(id)
    {
    	if(confirm('Bạn chắc chắn muốn xóa?'))
    	{
    		location =  <?php echo "'" . $current_page . "'";?> + '&letsop_submit=Xóa&letsop_id=' + id ;
    	}
    }
</script>
<style>
	.td_onl {text-align: center;}
</style>
<div class="wrap">
    <h2 style="color: #9f1f63">Quản lý mã giảm giá</h2>
    <form id="letsop_letsops" method="POST" action="" enctype="multipart/form-data">
        <table class="wp-list-table widefat fixed posts">
		<thead>
            <tr valign="top">
                <th scope="row" class="manage-column" style="width: 5%; padding:10px; font-weight:bold">STT</th>
                <th scope="row" class="manage-column" style="width: 20%; padding:10px; font-weight:bold">Mã</th>
                <th scope="row" class="manage-column" style="width: 10%; padding:10px; font-weight:bold">Giá giảm</th>
                <th scope="row" class="manage-column" style="width: 15%; padding:10px; font-weight:bold">Ngày bắt đầu</th>
                <th scope="row" class="manage-column" style="width: 15%; padding:10px; font-weight:bold">Ngày kết thúc</th>
                <th scope="row" class="manage-column" style="width: 10%; padding:10px; font-weight:bold">Được dùng (lần)</th>
                <th scope="row" class="manage-column" style="width: 10%; padding:10px; font-weight:bold">Đã dùng</th>
                <th scope="row" class="manage-column td_onl"  style="width: 15%; padding:10px; font-weight:bold">Tùy chỉnh</th>
            
            </tr>
		</thead>
        <tr id="tr_edit" style="text-align: center;">
            <td></td>
            <td style="text-align: left;"><input type="text" style="width:90%;" required value="<?php echo $letsop_views->code;?>" name="letsop_code" id="letsop_code"/></td>
            <td style="text-align: left;"><input type="text" required style="width:100%;" value="<?php echo $letsop_views->gia_giam;?>" name="letsop_giam_gia" id="letsop_giam_gia"/></td>
            <td style="text-align: left;"><input type="text" style="width:90%;" required value="<?php echo $letsop_views->start_date;?>" name="letsop_start" id="letsop_start"/></td>
            <td style="text-align: left;"><input type="text" required style="width:90%;" value="<?php echo $letsop_views->end_date;?>" name="letsop_end" id="letsop_end"/></td>        
            <td style="text-align: left;"><input type="text" style="width:100%;" required value="<?php echo($letsop_views ? $letsop_views->so_lan_su_dung : '1');?>" name="letsop_duoc_dung" /></td>
            <td style="text-align: left;"><input type="text" required style="width:100%;" value="<?php echo($letsop_views ? $letsop_views->so_lan_da_dung : '0'); ?>" name="letsop_da_dung" /></td>    

            <td style="text-align: left;"><input type="submit" class="button" name="letsop_submit" value="<?php if($_POST['letsop_submit'] == "Xem") echo "Sửa"; else echo "Thêm";?>" style="width: 70px; "/>
            <?php if($_POST['letsop_submit'] == "Xem") { ?>
                <button type="button" class="button" onclick="javascript:document.location='?letsop_id=5&page=letsop-quan-ly-code'">Hủy</button>
            <?php } ?></td>
        </tr>   
        <input name="letsop_id" value="<?php echo $letsop_views->id;?>" style="display: none;"/>
        <input name="page" value="letsop-quan-ly-code" style="display: none;"/>

    <?php
    	$page_ = 1;
    	if (isset($_POST['pp'])) {
    		$page_ = $_POST['pp'];
    		if ($page_ <= 0) $page_ = 1;
    	} 
    	$posts_per_page_ = 20;  
    	$first_post = ($page_-1)*$posts_per_page_;
        $query = "SELECT * FROM wp_sale_off_code ORDER BY ID DESC";
    	$query_l = $query . " LIMIT ".$first_post.", $posts_per_page_";    
                
    	global $wpdb;
    	$i = 1;
    	$codes = $wpdb->get_results($query_l);
    	foreach ( $codes as $code ) 
    	{
    ?>
            <tr <?php if($i % 2 == 1) echo 'class="alternate"' ?>>
                <td class="td_onl"><?php echo $i++ ?></td>
                <td><?php echo $code->code; ?></td>
                <td style="text-align: right;"><?php echo $code->gia_giam; ?></td>
                <td><?php echo $code->start_date; ?></td>
                <td><?php echo $code->end_date ?></td>
                <td style="text-align: center;"><?php echo $code->so_lan_su_dung; ?></td>
                <td style="text-align: center;"><?php echo $code->so_lan_da_dung ?></td>
            
                <td class="td_onl"><a href="<?php echo $current_page . "&letsop_submit=Xem&letsop_id=" . $code->id;?>" title="Sửa"><img style="width: 18px; height: 18px;" src="<?php echo bloginfo('template_directory');?>/images/sua.png" /> </a>
                <a onclick="xoa('<?php echo $code->id;?>')" title="Xóa" style="padding-left: 10px;"> <img style="width: 18px; height: 18px;" src="<?php echo bloginfo('template_directory');?>/images/delete.png"/></a></td>
            </tr>     
    <?php    	
        }
    ?>
            
        </table>
        <?php //submit_button();?>
    </form>
    <div class="pagination-centered">	
	<ul class="pagination">
        <?php admin_pagination($query, $page_, $posts_per_page_, 'pp', true);  ?>
    </ul>
</div>
</div>
<script type="text/javascript">
    jQuery(function() {
        var letsop_start;
        var letsop_end;
        jQuery("#letsop_start").datepicker({ dateFormat: "yy-mm-dd" }).focus(function() {
            letsop_start = jQuery("#letsop_start").val();
            end_time = jQuery("#end_time").val();
        }).change(function() {
            if (jQuery(this).val() != '') {
                var patt = /\d{4}-\d{1,2}-\d{1,2}/gi;
                if (!patt.test(jQuery(this).val())) {
                    jQuery("#letsop_start").val(letsop_start);
                }
            }
        });

        jQuery("#letsop_end").datepicker({ dateFormat: "yy-mm-dd" }).focus(function() {
            letsop_end = jQuery("#letsop_end").val();
            end_time = jQuery("#end_time").val();
        }).change(function() {
            if (jQuery(this).val() != '') {
                var patt = /\d{4}-\d{1,2}-\d{1,2}/gi;
                if (!patt.test(jQuery(this).val())) {
                    jQuery("#letsop_end").val(letsop_end);
                }
            }
        });
    });
</script>