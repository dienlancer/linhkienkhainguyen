<?php 
function show_cost($cost) {
    if(is_numeric($cost)) {
		echo number_format($cost,0,",","."). "đ";
	} else {
		echo '0đ';
	}
}

function get_show_cost($cost) {
    if(is_numeric($cost)) {
		return number_format($cost,0,",","."). "đ";
	} else {
		return '0đ';
	}
}

function is_sale_off($id = null) {
    if(get_ori_stand_cost($id) == get_stand_cost($id))
    	return false;
    return true;
}

//Giá gốc
function get_ori_stand_cost($id = null) {   
    if(empty($id))
        $id = get_the_id();
    $cost = get_post_meta($id, "gia_si", true);
    // if($cost == 0) return 0;
    return $cost;
}

//giá hiện tại đã tính cả khuyến mãi
function get_stand_cost($id = null) {
    if(empty($id))
        $id = get_the_id();
    $cost = get_post_meta($id, "gia_si_khuyen_mai", true);
    $pos = strpos($cost,"%");
    if( $pos !== false) {
    	$temp = trim(substr($cost, 0, $pos));
    	$ori = get_ori_stand_cost($id);
    	$cost =  $ori - $temp * $ori / 100;
    }
    return ($cost > 0) ? $cost : get_ori_stand_cost($id);
}

function get_percent_cost($id = null){
    $cost = get_ori_stand_cost($id);
    $sale_cost = get_stand_cost($id);

    return "-" . (100 - ceil($sale_cost / $cost * 100)) . "%";
}

function percent_cost($id = null){
    $cost = get_ori_stand_cost($id);
    $sale_cost = get_stand_cost($id);

    echo "-" . (100 - ceil($sale_cost / $cost * 100)) . "%";
}
?>