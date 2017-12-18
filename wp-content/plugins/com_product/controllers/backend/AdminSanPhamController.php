<?php
class AdminSanPhamController{		
	private $_metabox_id="zendvn-sp-sanpham";
	private $_prefix_id="zendvn-sp-sanpham-";	
	private $_prefix_key="_zendvn_sp_sanpham_";
	public function __construct(){
		global $zController;				
		preg_match('#(?:.+\/)(.+)#', $_SERVER['SCRIPT_NAME'],$matches);
		$phpFile = $matches[1];		
		if($zController->getParams("post_type")=="san-pham"){
			if($phpFile == 'post.php' || $phpFile == 'post-new.php'){
				add_action("add_meta_boxes",array($this,"display"));								
				if($zController->isPost()){
					add_action("save_post",array($this,"save"));
				}
			}			
		}				
	}	
	public function display(){
		add_meta_box($this->_metabox_id,"Images of product",array($this,"thumbnail"),"san-pham");		
	}
	public function save($post_id){

		global $zController,$zendvn_sp_settings;	
		$width=$zendvn_sp_settings["product_width"];	
		$height=$zendvn_sp_settings["product_height"];			
		$arrParam = $zController->getParams();
		$wpnonce_name = $this->_metabox_id . '-nonce';
		$wpnonce_action = $this->_metabox_id;
		$thumbnail_id 	= get_post_thumbnail_id($post_id);			
		$imgThumbnailHelper=$zController->getHelper("ImgThumbnail");	
		$arrImgUrl=		$arrParam[$this->create_id('img-url')];				
		if(count($arrImgUrl) > 0){			
			foreach ($arrImgUrl as $key => $value) {				
				if(!empty($value)){
					$imgThumbnailHelper->resizeImage($value,$width,$height);
				}
			}
		}		
		
		//zendvn-sp-zsproduct-nonce
		if(!isset($arrParam[$wpnonce_name])) return $post_id;
		
		if(!wp_verify_nonce($arrParam[$wpnonce_name],$wpnonce_action)) return $post_id;
		
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
		if(!current_user_can('edit_post')) return $post_id;
		
		$arrData =  array(			
			'img-ordering' 	=> array_map('absint',$arrParam[$this->create_id('img-ordering')]),
			'img-url' 		=> $arrParam[$this->create_id('img-url')],											
		);
		if(!isset($arrParam['save'])){
			$arrData['view'] = 0;
		}
		foreach ($arrData as $key => $val){
			update_post_meta($post_id, $this->create_key($key), $val);
		}				
	}
	public function thumbnail(){
		global $zController;
		wp_nonce_field($this->_metabox_id,$this->_metabox_id . "-nonce");
		$zController->_data["controller"]=$this;
		$zController->getView("/backend/sanpham/thumbnail.php");
	}
	public function create_id($val){
		return $this->_prefix_id . $val;
	}
	public function create_key($val){
		return $this->_prefix_key . $val;
	}
}