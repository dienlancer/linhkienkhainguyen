<?php
/**
 * @autdor Forever and one!
 * @copyright 2013
 */
if (isset($_REQUEST['update'])) {
    update_option('ti_le_phan_tram', $_REQUEST['ti-le-phan-tram']);
    update_option('phone_number', $_REQUEST['phone-number']);
    update_option('phone_number_2', $_REQUEST['phone-number-2']);
    update_option('phone_number_3', $_REQUEST['phone-number-3']);
    update_option('phone_number_4', $_REQUEST['phone-number-4']);
    update_option('email', $_REQUEST['email']);

    update_option('address', $_REQUEST['address']);        
    update_option('footer_text', $_REQUEST['footer-text']);     

    update_option('gioi_thieu', $_REQUEST['gioi-thieu']);  
    update_option('cap_nhat_gia', $_REQUEST['cap-nhat-gia']);  

    update_option('ket_thuc_head', htmlentities($_REQUEST['ket-thuc-head']));  
    update_option('bat_dau_head', htmlentities($_REQUEST['bat-dau-body']));  
    update_option('ket_thuc_body', htmlentities($_REQUEST['ket-thuc-body']));  
    update_option('fb_page', htmlentities($_REQUEST['fb-page']));  

    // update_option('letsop-Sendemail', $_REQUEST['letsop-Sendemail']);
    // update_option('letsop-Passemail', $_REQUEST['letsop-Passemail']);
    // update_option('letsop-SMTP', $_REQUEST['letsop-SMTP']);
    // update_option('letsop-Port', $_REQUEST['letsop-Port']);
    // update_option('letsop-SMTPSecure', $_REQUEST['letsop-SMTPSecure']);

    // update_option('company_name', $_REQUEST['company-name']);  
    
    // update_option('phone_number_2', $_REQUEST['phone-number-2']);
    // update_option('truso', $_REQUEST['truso']);
    
    update_option('urlimg', $_REQUEST['urlimg']);  
    update_option('urlyoutube', $_REQUEST['urlyoutube']);  
    update_option('urlinstagram', $_REQUEST['urlinstagram']);  

    update_option('logo_src', $_REQUEST['logo-src']); 

    update_option('td_footer_1', $_REQUEST['td_footer_1']); 
    update_option('nd_footer_1', htmlentities($_REQUEST['nd_footer_1'])); 
    update_option('td_footer_2', $_REQUEST['td_footer_2']); 
    update_option('nd_footer_2', htmlentities($_REQUEST['nd_footer_2'])); 
    update_option('td_footer_3', $_REQUEST['td_footer_3']); 
    update_option('nd_footer_3', htmlentities($_REQUEST['nd_footer_3'])); 
    update_option('td_footer_4', $_REQUEST['td_footer_4']); 
    update_option('nd_footer_4', htmlentities($_REQUEST['nd_footer_4']));     

}
?>
<div class="wrap" id="letsop_options">
    <h2 style="margin-bottom: 40px;">Thông tin tùy chỉnh</h2>
    
    <form id="letsop_setting" metdod="POST" >
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>">

        <table class="letsop wp-list-table widefat fixed posts" style="width: 100%"> 
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Tỉ lệ % giá sỉ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('ti_le_phan_tram'); ?>" name="ti-le-phan-tram" /></td>
            </tr> 
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Số điện thoại 1</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('phone_number'); ?>" name="phone-number" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Số điện thoại 2</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('phone_number_2'); ?>" name="phone-number-2" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Số điện thoại 3</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('phone_number_3'); ?>" name="phone-number-3" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Số điện thoại 4</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('phone_number_4'); ?>" name="phone-number-4" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Email</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('email'); ?>" name="email" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Địa chỉ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('address'); ?>" name="address" /></td>
            </tr>
            
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Footer text</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('footer_text'); ?>" name="footer-text" /></td>
            </tr>
            
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Giới thiệu</td>
                <!-- <input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php //echo get_option('gioi_thieu'); ?>" name="gioi-thieu" /> -->
                <td>
                    <textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="gioi-thieu" ><?php echo stripslashes(html_entity_decode(get_option('gioi_thieu'))); ?></textarea>
                </td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Ngày cập nhật giá sỉ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('cap_nhat_gia'); ?>" name="cap-nhat-gia" /></td>
            </tr>
            
             <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Trước &lt;&sol;head&gt;</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="ket-thuc-head" ><?php echo stripslashes(html_entity_decode(get_option('ket_thuc_head'))); ?></textarea></td>
            </tr>


            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Sau &lt;boby&gt;</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="bat-dau-body" ><?php echo stripslashes(html_entity_decode(get_option('bat_dau_head'))); ?></textarea></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Trước &lt;&sol;boby&gt;</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="ket-thuc-body" ><?php echo stripslashes(html_entity_decode(get_option('ket_thuc_body'))); ?></textarea></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Fanpage</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="fb-page" ><?php echo stripslashes(html_entity_decode(get_option('fb_page'))); ?></textarea></td>
            </tr>

            <!-- <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Email gửi thông tin</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 50%;" value="<?php //echo get_option('letsop-Sendemail'); ?>" name="letsop-Sendemail" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Mật khẩu</td>
                <td><input type="password" style = "min-width: 250px; padding: auto 10px; width: 50%;" value="<?php //echo get_option('letsop-Passemail'); ?>" name="letsop-Passemail" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">SMTP</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 50%;" placeholder="smtp.gmail.com" value="<?php //echo get_option('letsop-SMTP'); ?>" name="letsop-SMTP" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Port</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 50%;" placeholder="465 or 587" value="<?php //echo get_option('letsop-Port'); ?>" name="letsop-Port" /></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Kiểu bảo mật</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 50%;" placeholder="SSL or TLS" value="<?php //echo get_option('letsop-SMTPSecure'); ?>" name="letsop-SMTPSecure" /></td>
            </tr> -->
            
            <!-- <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Địa chỉ trụ sở</td>
                <td>
                    <input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" name="truso" value="<?php //echo stripslashes(get_option('truso')); ?>" />
                </td>
            </tr> -->
            
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">URL Image</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('urlimg'); ?>" name="urlimg" /></td>
            </tr>
                            
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">URL Youtube</td>
                <td>
                    <input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('urlyoutube'); ?>" name="urlyoutube" />
                </td>
            </tr> 

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">URL Youtube</td>
                <td>
                    <input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('urlinstagram'); ?>" name="urlinstagram" />
                </td>
            </tr> 

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Logo</td>
                <td class="img">
                    <label for="upload_image" >
                        <input id="upload_image_ad_1" type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" name="logo-src" value="<?php echo get_option('logo_src'); ?>" />
                        <input id="upload_image_button_ad_1" type="button" class="button" value="Tải hình lên" /> 
                        <br />Dán URL hoặc tải ảnh lên để làm logo.
                    </label>
                    <img id = "upload_review_ad_1" src="<?php echo get_option('logo_src'); ?>" style = "max-height: 50px; display: block; width: auto;">
                </td>
            </tr> 

            <!-- 4 icon footer  -->
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 1 - TĐ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('td_footer_1'); ?>" name="td_footer_1" /></td>
            </tr>
            
             <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 1 - ND</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="nd_footer_1" ><?php echo stripslashes(html_entity_decode(get_option('nd_footer_1'))); ?></textarea></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 2 - TĐ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('td_footer_2'); ?>" name="td_footer_2" /></td>
            </tr>
            
             <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 2 - ND</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="nd_footer_2" ><?php echo stripslashes(html_entity_decode(get_option('nd_footer_2'))); ?></textarea></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 3 - TĐ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('td_footer_3'); ?>" name="td_footer_3" /></td>
            </tr>
            
             <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 3 - ND</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="nd_footer_3" ><?php echo stripslashes(html_entity_decode(get_option('nd_footer_3'))); ?></textarea></td>
            </tr>

            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 4 - TĐ</td>
                <td><input type="text" style = "min-width: 250px; padding: auto 10px; width: 80%;" value="<?php echo get_option('td_footer_4'); ?>" name="td_footer_4" /></td>
            </tr>
            
             <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px">Icon Footer 4 - ND</td>
                <td><textarea rows="5" style = "min-width: 250px; padding: auto 10px; width: 50%;"  name="nd_footer_4" ><?php echo stripslashes(html_entity_decode(get_option('nd_footer_4'))); ?></textarea></td>
            </tr>
            
            <tr>
                <td><button class="button" name="update">Cập nhật</button></td>
                <td></td>
            </tr>
            
        </table>
        <?php //submit_button();?>
    </form>
</div>