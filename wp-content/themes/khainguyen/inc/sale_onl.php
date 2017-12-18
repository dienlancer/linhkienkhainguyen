<?php 
include (TEMPLATEPATH . "/inc/paging.php"); 
//require_once TEMPLATEPATH."/inc/admin/function_excel.php";

if (isset($_REQUEST['submit-type'])) {    
    switch ($_REQUEST['submit-type']) {
        case "waiting":
            global $wpdb;
            $wpdb->update( 
                'ls_cart', 
                array( 
                    'ngayduyet' => date("Y-m-d H:i:s"),
                    'trangthai' => 2                        
                ), 
                array(                         
                    'id' => text2number($_REQUEST['submit'])
                )
            );
            break;
        
        case "trash":
            global $wpdb;
            //$wpdb->delete( 'wp_carts', array( 'id' => $_REQUEST['submit'] ) );
            $wpdb->update( 
                'ls_cart', 
                array( 
                    'ngayduyet' => date("Y-m-d H:i:s"),
                    'trangthai' => -1                        
                ), 
                array(                         
                    'id' => text2number($_REQUEST['submit'])
                )
            );
            break;    
        case "accept":
            global $wpdb;
            $wpdb->update( 
                'ls_cart', 
                array( 
                    'ngayduyet' => date("Y-m-d H:i:s"),
                    'trangthai' => 1
                ), 
                array(                         
                    'id' => text2number($_REQUEST['submit'])
                )
            );
            break;
        case "new":
            global $wpdb;
            $wpdb->update( 
                'ls_cart', 
                array( 
                    'ngayduyet' => date("Y-m-d H:i:s"),
                    'trangthai' => 0
                ), 
                array(                         
                    'id' => text2number($_REQUEST['submit'])
                )
            );
            break;
    }
}
    $sql_r = "";
	if (isset($_POST["do-letsop-filter"])) {
		foreach ($_POST as $key=>$value) {
			if (strpos($key, "letsop-filter-") === 0) {
				$key = substr($key, strlen("letsop-filter-"));
                $value = sanitize_text_field($value);
				$sql_r .= " and $key like '%$value%'";
			}
		}
    }
?>
<!-- <script src="<?php echo bloginfo("template_url"); ?>/js/jquery.min.js"></script> -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<style>
table.table-primary {
	width: 100%;
	border-collapse: collapse;
}
table.table-primary > thead > tr > th {
	background-color: #666;
	color: #fff;
	border-left: 1px solid #ccc;
	line-height: 1.5;
    text-align: center;
    padding: 5px 10px;
}
table.table-primary > tbody > tr > td {
	border: 1px solid #999;
	line-height: 1.5;
}
tr.row-sub {
	display: none;
	background: #eee;
}
tr.row-sub tr {
	border: 1px solid #ccc;
}

tr.row-sub > td {
	padding: 5px 20px;
}

tr.row-sub td .table-primary tr td {
	border: none !important;
	text-align: center;
	background: #fff;
}
.row-primary td {
    padding: 5px 10px;
}

tr.wait td {
	font-weight: bold;
    color: #ff4e0a;
}

tr.accept td {
	font-weight: bold;
    color: blue;
}

td.cell-value {
	font-weight: bold;
	min-width: 100px;
}

tr.cancel td {
    font-weight: bold;
    color: #9f1f63;
}

td.row-sub-td {
    padding: 2px 10px;
}

table caption {
	font-weight: bold;
	color: #08c;
	font-size: 15px;
	margin-top: 5px;
	text-align: left;
}

.pagination-centered {
	text-align: center;
	margin-top: 20px;
}

#sub-table-details thead tr th, #sub-table-details tbody tr td{
    padding: 2px 10px;
    border: 1px solid #ccc;
    font-size: 15px;
}
p {
	line-height: 100%;
}
</style>

<div class="wrap">
	<h2 style="color: #9f1f63">Quản lý đơn hàng</h2>
    <form method="POST">
    <table class="wp-list-table">
		<thead><tr>
			<th style="width: 15%;">Mã ĐH</th>
			<th style="width: 15%;">Ngày Đặt</th>
			<th style="width: 15%;">Khách Hàng</th>
			<th style="width: 12%;">ĐIỆN THOẠI</th>
            <!-- <th style="width: 20%;">HT THANH TOÁN</th> -->
			<th style="width: 20%;">Email</th>
			<th style="width: 18%;">Tình Trạng</th>
            <th style="width: 5%;"></th>
		</tr></thead>
		<tbody>
            <td class="manage-column">
                <input type="text" name="letsop-filter-madonhang" placeholder="" style="width: 98%;"/>
            </td>
            <td class="manage-column">
                <input type="text" name="letsop-filter-ngaydat" id="letsop-filter-ngaydat" value="" style="width: 98%;"/></td>
            <td class="manage-column">
                <input type="text" name="letsop-filter-hoten" style="width: 98%;"/>
            </td>
            <td class="manage-column">
                <input type="text" name="letsop-filter-dienthoai" style="width: 98%;"/>
            </td>
            <td class="manage-column">
                <input type="text" name="letsop-filter-email" style="width: 98%;"/>
                <!-- <select name="letsop-filter-thanh_toan" style="width:100%;">
                    <option value="">[Tất cả]</option>
                    <option value="nhanhang">[Khi nhận hàng]</option>
                    <option value="chuyenkhoan">[Chuyển khoản]</option>
                </select> -->
            </td>
            <td class="manage-column">
                <select name="letsop-filter-trangthai" style="width:100%;">
					<option value="">[Tất cả]</option>
                    <option value="0">[Chưa xử lý]</option>
					<option value="2">[Đang chờ]</option>
                    <option value="-1">[Đã hủy]</option>
                    <option value="1">[Đã xử lý]</option>
				</select>
            </td>
            <td><input type="submit" name="do-letsop-filter" class="button" value="Lọc" style="width:50px;"/></td>
        </tbody>
    </table>
    </form>
    <br />
	<table class="wp-list-table table-primary">
		<thead>
            <tr>
    			<th style="width: 10%;">Mã HĐ</th>
    			<th style="width: 13%;">Ngày Đặt</th>
    			<th style="width: 16%;">Khách Hàng</th>
    			<th>Điện Thoại</th>
    			<th style="width: 17%;">Địa Chỉ</th>
    			<th style="width: 23%;">Ghi Chú</th>
                <th style="width: 10%;">Tình Trạng</th>
    		</tr>
        </thead>

		<tbody>
        
    <?php 
        global $wpdb; 
                
        $page_ = 1;
		if (isset($_REQUEST['pp'])) {
			$page_ = $_REQUEST['pp'];
			if ($page_ <= 0) $page_ = 1;
		} 
		$posts_per_page_ = 20;

		$first_post = ($page_-1)*$posts_per_page_;
        
        
        //trang_thai <> 2
        $query = 'select * from ls_cart where 1 ' . $sql_r . ' order by id desc';

        $query_hd = "$query LIMIT " . $first_post . ", $posts_per_page_";
        //echo $query_hd;
        $carts = $wpdb->get_results($query_hd);
        //print_r($carts);
        foreach ($carts as $cart) {
    ?>
            <tr class="row-primary <?php if ($cart->trangthai == 0 ) echo "wait"; elseif($cart->trangthai == 2) echo "accept"; elseif ($cart->trangthai == -1) echo "cancel"; ?>" cart-id="<?php echo $cart->id ?>">
    			<td class="manage-column" style=" text-align: center;"><?php echo $cart->madonhang ?></td>
    			<td class="manage-column" style=" text-align: center;"><?php echo $cart->ngaydat ?></td>
    			<td class="manage-column" style=" text-align: left;"><?php echo $cart->hoten ?></td>
    			<td class="manage-column" style=" text-align: right;"><?php echo $cart->dienthoai ?></td>
    			<td class="manage-column" style=" text-align: left;"><?php echo $cart->diachi ?></td>
    			<td class="manage-column" style=" text-align: left;"><?php echo $cart->ghichu ?></td>
                <td class="manage-column" style=" text-align: left;"><?php if ($cart->trangthai == 0 ) echo "Mới"; elseif($cart->trangthai == 2) echo "Chờ Duyệt"; elseif ($cart->trangthai == -1) echo "Đã Hủy"; else echo "Đã Xử Lý"; ?></td>
    		</tr>
                
            
            
            <tr class="row-sub" cart-id="<?php echo $cart->id ?>">
                <td colspan="7">
    				<h3 style="font-weight:normal; padding: 0px; margin: 0px;">
    					Mã đơn hàng: <strong><?php echo $cart->madonhang ?></strong>
                         <!-- <span style="display:block; float:right; ">
                            <input name="xuly" type="button" style="padding: 5px 20px; color: #9f1f63;" onclick="javascript:document.location='?page=ls-mua-hang.php&letsop_export=<?php echo $cart->id ?>'" value="Xuất excel"/>
                        </span> -->
    					<?php if ($cart->trangthai == 0 ){ ?>
    						<span style="display:block;float:right; margin-right: 20px;">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: red;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=accept&submit=<?php echo $cart->id ?>'" value="Duyệt"/>
                            </span>
                            <span style="display:block;float:right; margin-right: 20px; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: blue;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=waiting&submit=<?php echo $cart->id ?>'" value="Đang chờ"/>
                            </span>
                            <span style="display:block;float:right; margin-right: 20px; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: #ff4e0a;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=trash&submit=<?php echo $cart->id ?>'" value="Hủy"/>
                            </span>
    					<?php } elseif($cart->trangthai == 2){ ?>                        
                            <span style="display:block;float:right; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: red;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=accept&submit=<?php echo $cart->id ?>'" value="Duyệt"/>
                            </span>
                        <?php } elseif($cart->trangthai == 1) { ?> 
                            <span style="display:block;float:right; margin-right: 20px; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: blue;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=waiting&submit=<?php echo $cart->id ?>'" value="Đang chờ"/>
                            </span>
                            <span style="display:block;float:right; margin-right: 20px; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: #ff4e0a;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=new&submit=<?php echo $cart->id ?>'" value="Chưa xử lý"/>
                            </span>
                        <?php } else { ?>
                            <span style="display:block;float:right; margin-right: 20px; ">
                                <input name="xuly" type="button" style="padding: 5px 20px; color: #ff4e0a;" onclick="javascript:document.location='?page=ls-mua-hang.php&pp=<?php echo $page_ ?>&submit-type=new&submit=<?php echo $cart->id ?>'" value="Chưa xử lý"/>
                            </span>
                        <?php
                        }?>
                       
    				</h3>
                    <p><b>Mã giảm giá: </b><?php echo $cart->magiamgia ?></p>
                    <p><b>Giá giảm: </b><?php echo number_format($cart->giagiam , 0, ",", "."). " VNĐ";?></p>
                    <p><b>Thời gian đặt: </b><?php echo $cart->ngaydat ?></p>
                    
                    <p><b>Hình thức thanh toán: </b> COD
                       <!--  <?php if($cart->thanhtoan == "Shop") echo "Thanh toán tiền tại Shop hoa Violet On Wednesday"; elseif($cart->thanhtoan == "COD") echo "Thanh toán tại địa chỉ nhận sản phẩm (COD)"; else echo "Thanh toán qua chuyển khoản Ngân hàng";?> -->
                    </p>
                    <p><span style="color: red; font-weight: bold;">Ghi chú: </span><?php echo $cart->ghichu?></p>
                    <p><span style="color: red; font-weight: bold;">Yêu cầu giấu thông tin người gửi: </span><?php if($cart->giauthongtin == "checked") echo "CÓ"; else "Không"; ?></p>
    					
                    <table style="width: 100%;border-collapse: separate" class="wp-list-table">
                        <caption>THÔNG TIN KHÁCH HÀNG</caption>
						<tr>
							<td class="row-sub-td" style="width: 50px;">Người đặt</td>
							<td class="cell-value row-sub-td" style="width: 200px;"><?php echo $cart->hoten ?></td>
                            <td class="row-sub-td" style="width: 50px;">Địa chỉ</td>
    						<td class="cell-value row-sub-td" style="width: 200px;"><?php echo $cart->diachi ?></td>
						</tr>

    					<tr>
    						<td class="row-sub-td">Số điện thoại</td>
    						<td class="cell-value row-sub-td"><?php echo $cart->dienthoai ?></td>
                            <td class="row-sub-td">Quận - Huyện</td>
    						<td class="cell-value row-sub-td"><?php echo $cart->quanhuyen ?></td>
    					</tr>
    					<tr>
    						<td class="row-sub-td">Email</td>
    						<td class="cell-value row-sub-td"><?php echo $cart->email ?></td>
                            <td class="row-sub-td">Tỉnh / Thành phố</td>
    						<td class="cell-value row-sub-td"><?php echo $cart->tinhthanh ?></td>
    					</tr>
    					                       
				    </table>

                    <table style="width: 100%;border-collapse: separate" class="wp-list-table">
                        <caption>THÔNG TIN NGƯỜI NHẬN</caption>
                        <tr>
                            <td class="row-sub-td" style="width: 50px;">Người nhận</td>
                            <td class="cell-value row-sub-td" style="width: 200px;"><?php echo $cart->nnhoten ?></td>
                            <td class="row-sub-td" style="width: 50px;">Địa chỉ</td>
                            <td class="cell-value row-sub-td" style="width: 200px;"><?php echo $cart->nndiachi ?></td>
                        </tr>

                        <tr>
                            <td class="row-sub-td">Số điện thoại</td>
                            <td class="cell-value row-sub-td"><?php echo $cart->nndienthoai ?></td>
                            <td class="row-sub-td">Quận - Huyện</td>
                            <td class="cell-value row-sub-td"><?php echo $cart->nnquanhuyen ?></td>
                        </tr>
                        <tr>
                            <td class="row-sub-td"></td>
                            <td class="cell-value row-sub-td"></td>
                            <td class="row-sub-td">Tỉnh / Thành phố</td>
                            <td class="cell-value row-sub-td"> <?php echo $cart->nntinhthanh ?></td>
                        </tr>
                                               
                    </table>	
                    
                    <center>
                    <table width="100%" style="text-align: center;" id="sub-table-details" class="wp-list-table">
                        <caption>THÔNG TIN CHI TIẾT</caption>
                        <thead style="background:#888; color:#fff">
                            <tr>
                                <th style="width: 15%; text-align: center;">HÌNH</th>
                                <th style="width: 25%; text-align: center;">TÊN SP</th>
                                <th style="width: 10%; text-align: center;">LOẠI GIÁ</th>
                                <th style="width: 10%; text-align: center;">SỐ LƯỢNG</th>
                                <th style="width: 15%; text-align: center;">ĐƠN GIÁ</th>
                                <th style="width: 15%; text-align: center;">THÀNH TIỀN</th>
                            </tr>
                        </thead>
                        
                        <tbody style="background:#fff">
                <?php 
                    $cart_details = $wpdb->get_results('select * from ls_cart_detail where idgiohang = ' . $cart->id);
                    $sum_cost = 0;
                    foreach($cart_details as $cart_detail) {
                        global $post;
						$post = get_post($cart_detail->proid);
                ?>
                        <tr>
                            <td style=" text-align: center;"><img style="width:70%; height:auto" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($cart_detail->proid), "medium")[0] ?>"/></td> 
                            <td style=" text-align: left;"><?php the_title() ?></td>
                            <td style=" text-align: left;"><?php  echo $cart_detail->loaigia; ?></td>
                            <td style=" text-align: right;">
                                <?php echo $cart_detail->soluong  ?>
                            </td>
                            <td style=" text-align: right;"><?php echo number_format($cart_detail->gia, 0, ",", "."). " VNĐ" ?></td>
                            <td style=" text-align: right;"><?php $sum_cost += $cart_detail->soluong * $cart_detail->gia; echo number_format($cart_detail->soluong * $cart_detail->gia, 0, ",", "."). " VNĐ" ?></td>
                        </tr>
                          
                <?php } ?> 
                        <tr>
                            <td colspan="5">Cộng</td>
                            <td style=" text-align: right;"><?php echo number_format($sum_cost, 0, ",", "."). " VNĐ";?></td>
                        </tr>
                        <tr>
                            <td colspan="5">Giảm giá</td>
                            <td style=" text-align: right;"><?php echo number_format($cart->giagiam , 0, ",", "."). " VNĐ";?></td>
                        </tr>
                        <tr>
                            <td colspan="5">Tổng tiền thanh toán</td>
                            <td style=" text-align: right;"><?php echo number_format($sum_cost - $cart->giagiam , 0, ",", "."). " VNĐ";?></td>
                        </tr> 

                        </tbody>
                    </table>
                    </center> 
                    
                </td>
            </tr>
				
	   <?php }?>
		</tbody>
	</table>


    <div class="pagination-centered">	
		<ul class="pagination">
			<?php admin_pagination($query, $page_, $posts_per_page_, 'pp', true);  ?>
		</ul>
	</div>
	<!-- pagination -->


</div>
<!-- Quang Minh -->


<script type="text/javascript">
jQuery("tr.row-primary[cart-id]").click(function() {
	var cart_id = jQuery(this).attr("cart-id");

	if (jQuery("tr.row-sub[cart-id='"+cart_id+"']").css("display") == "none") {
		jQuery("tr.row-sub").stop().hide();
		jQuery("tr.row-sub[cart-id='"+cart_id+"']").stop().fadeIn(300);
	} else {
		jQuery("tr.row-sub").stop().hide();
	}
});

jQuery(function() {
	var start_time;
	jQuery("#letsop-filter-ngaydat").datepicker({ dateFormat: "yy-mm-dd" }).focus(function() {
		start_time = jQuery("#letsop-filter-ngaydat").val();

	}).change(function() {
		if (jQuery(this).val() != '') {
			var patt = /\d{4}-\d{1,2}-\d{1,2}/gi;
			if (!patt.test(jQuery(this).val())) {
				jQuery("#letsop-filter-ngaydat").val(start_time);
			}
		}
	});
});

</script>