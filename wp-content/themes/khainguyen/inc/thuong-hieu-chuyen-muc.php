<?php
/**
 * @autdor Forever and one!
 * @copyright 2013
 */
if (is_ssl()) {
    $current_page = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
} else {
    $current_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
}
 
// echo $current_page . "<br/>" ;
if (isset($_POST['update'])) {
    // $reqs = $_POST;
    // unset($reqs['update']);
    // foreach ($reqs as $key => $value) {
    //     echo $key . "<br/>";
    //     // print_r($value);
    //     // update_option($key, $value);
    // }
    $categories = get_terms( 'chuyen-muc', array(
        'hide_empty' => 0,
        'child_of' => $parent->term_id
    ) );

    foreach ($categories as $term) { 
        $_name = "TH-CM-" . $term->slug;
        if (isset($_POST[$_name])) {
            update_option($_name, $_POST[$_name]);
        } else {
            update_option($_name, "");
        }
    }
}

function CheckInArray($_arr, $_id) {
    if (in_array($_id, $_arr)) {
        echo "checked";
    } 
}
?>
<style type="text/css">
    .format_brand {
        float: left;
        width: 250px;
    }

    tr:nth-child(even) {
        background: #ecf0f1;
    }
</style>
<div class="wrap" id="letsop_options">
    <h2 style="margin-bottom: 40px;">Sản phẩm - Thương hiệu</h2>
    
    <form id="letsop_setting" method="POST" action="<?php echo $current_page ?>">
        <!-- <input type="hidden" name="page" value="<?php //echo $_REQUEST['page'] ?>"> -->

        <table class="letsop wp-list-table widefat fixed posts" style="width: 100%">
        <?php
            $parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
            $categories = get_terms( 'chuyen-muc', array(
                'hide_empty' => 0,
                'child_of' => $parent->term_id
            ) );
            foreach ($categories as $term) { ?>      
            <tr valign="top">
                <td scope="row" style="width: 15%; font-weight: bold; padding: 10px"><?php echo $term->name ?></td>
                <td>
                    <?php
                        $_opName = "TH-CM-" . $term->slug;
                        $ar_ids = get_option($_opName);
                        // print_r($ar_ids);
                        $par = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
                        $cates = get_terms( 'chuyen-muc', array(
                            'hide_empty' => 0,
                            'child_of' => $par->term_id
                        ) );
                        foreach ($cates as $ter) { ?>
                            <div class="format_brand">
                                <input type="checkbox" <?php CheckInArray($ar_ids, $ter->term_id)?> value="<?php echo $ter->term_id; ?>" name="<?php echo $_opName . "[]" ?>" /><?php echo $ter->name; ?>
                            </div>   
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>            

            <tr>
                <td><button class="button" name="update">Cập nhật</button></td>
                <td></td>
            </tr>
            
        </table>
        <?php //submit_button();?>
    </form>
</div>