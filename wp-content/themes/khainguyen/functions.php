<?php
/**
 * banhang functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package banhang
 */
// add_post_type_support( 'san-pham', 'excerpt' );
function SubTitle($_str) {
	if (strlen($_str) > 22) {
		$pos = strpos($_str, " ", 22);
		if ($pos !== false) {
		    return substr($_str, 0, $pos) . "...";
		}
		// return substr($_str, 0, 60) . "...";
	}
	return $_str;
}

// Query var
function add_query_vars_filter( $vars ){
  // $vars[] = "tim_chuyen_muc";
  $vars[] = "tim-theo-gia";
  $vars[] = "tim-thuong-hieu";
  
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

include_once get_template_directory() . "/inc/post-type-custom.php" ;
// update_option("ls_diem_quy_doi", 100000);

// Footer Admin
function wpexplorer_remove_footer_admin () {
	echo '<span id="footer-thankyou">Được xây dựng bởi <a href="http://www.letsop.com/" target="_blank">LetSop  Solutions</a></span>';
}
add_filter( 'admin_footer_text', 'wpexplorer_remove_footer_admin' );

// Remove Widget - Admin
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
}
add_action( 'admin_init', 'remove_dashboard_meta' );

// Remove comment Menu
function remove_menus(){
  remove_menu_page( 'edit-comments.php' );          //Comments  
}
add_action( 'admin_menu', 'remove_menus' );

// Add Widget - Amind
function wpexplorer_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'wpexplorer_dashboard_widget', // Widget slug.
		'Hướng dẫn sử dụng', // Title.
		'wpexplorer_dashboard_widget_function' // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'wpexplorer_add_dashboard_widgets' );
function wpexplorer_dashboard_widget_function() {
	echo "Đang cập nhật.";
}

function letsop_enqueu_script_style() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.3.7', false ); 
	wp_enqueue_style('fotn-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0', false );
	// wp_enqueue_style('googleFont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=vietnamese', array(), '1.0', false);	
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0', false);
	

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array(), '3.3.7', false);
}
add_action( 'wp_enqueue_scripts', 'letsop_enqueu_script_style' );

//  Crop Image
add_image_size( 'client-thumb', 600, 400, array('center', 'center') );

//  Length Excerpt
function custom_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// Add Menu Admin
add_action( 'admin_menu', 'register_manage_options_menu_page' );
function register_manage_options_menu_page() {
    add_menu_page( 'QL Thông tin', 'QL Thông tin', 
        'administrator', 
        'manage_info_option.php', 'Letsop_setting_page', 'dashicons-admin-generic', 6 );

    //Thương hiệu
	// add_submenu_page( "manage_info_option.php", "Thương hiệu", "Thương hiệu", "manage_options", "thuong-hieu.php", function() {
	// 	include_once (TEMPLATEPATH . '/inc/thuong-hieu.php');
	// });

	//Quảng cáo Index
	add_submenu_page( "manage_info_option.php", "Banner - Index", "Banner - Index", "manage_options", "banner.php", function() {
		include_once (TEMPLATEPATH . '/inc/banner.php');
	});

	// Mã giảm giá
	// add_submenu_page( "manage_info_option.php", "Mã giảm giá", "Mã giảm giá", "manage_options", "letsop-quan-ly-code.php", function() {
	// 		include_once (TEMPLATEPATH . '/inc/ma-giam-gia.php');
	// });

	// Quản lý mua hàng online
	// add_submenu_page( "manage_info_option.php", "Quản lý mua hàng", "Quản lý mua hàng", "manage_options", "ls-mua-hang.php", function(){
	// 	include_once (TEMPLATEPATH . '/inc/sale_onl.php');
	// });

	// Quản lý sản phẩm - thương hiệu
	// add_submenu_page( "manage_info_option.php", "Thương hiệu - chuyên mục", "Thương hiệu - chuyên mục", "manage_options", "thuong-hieu-chuyen-muc.php", function(){
	// 	include get_template_directory() . '/inc/thuong-hieu-chuyen-muc.php';
	// });
}

function Letsop_setting_page() {
	include get_template_directory() . '/inc/options.php';
}

// Widget
include get_template_directory() . '/inc/san-pham-widget.php';

// Format Number
function text2number($_str) {
	return preg_replace( '/[^0-9]/', '', $_str );
}

function manage_theme_options_scripts() {
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'letsop-upload', get_template_directory_uri() . '/inc/letsop_option.js', array(), '1.0', false);
}	 
function manage_theme_options_styles() {
	wp_enqueue_style('thickbox');
}			

if (isset($_GET['page'])){
	if($_GET['page'] == 'manage_info_option.php' || $_GET['page'] == 'thuong-hieu.php' || $_GET['page'] == 'banner.php') 		{
		add_action('admin_print_scripts', 'manage_theme_options_scripts');
		add_action('admin_print_styles', 'manage_theme_options_styles');
	} 
}

function json_tinh_thanh(){    
    global $wpdb;
    $results = $wpdb->get_results( "SELECT tinh_thanh, quan_huyen FROM ls_tinh_thanh" );
    $out = array();
    foreach ($results as $tp) {  
        if (!isset($out[$tp->tinh_thanh])) {
            $out[$tp->tinh_thanh] = array();
        }
        $out[$tp->tinh_thanh][] = $tp->quan_huyen;
    }
    
    $out = json_encode($out);
    echo $out;
}

// Count View
function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Quản lý cột ở admin
// Mã sản phẩm
// ADD NEW COLUMN 
function label_columns_head($defaults) {
	$new = array();
    $ma_sp = $defaults['ma_sp'];  // save the ma_sp column
    unset($defaults['ma_sp']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='taxonomy-chuyen-muc') {  // when we find the date column
           $new['ma_sp'] = $ma_sp;  // put the ma_sp column before it
        }    
        $new[$key]=$value;
    }   

    $new['ma_sp'] = 'Mã SP';
    return $new;
}
 
// SHOW THE FEATURED IMAGE
function label_columns_content($column_name, $post_ID) {
    if ($column_name == 'ma_sp') {
        $post_featured_ma_sp = get_post_meta($post_ID, "ma_sp", true);
        if ($post_featured_ma_sp) {
        	echo $post_featured_ma_sp;
            // echo number_format((float)$post_featured_ma_sp,0,",","."). "đ";
        }
    }
}

add_filter('manage_san-pham_posts_columns', 'label_columns_head');
add_action('manage_san-pham_posts_custom_column', 'label_columns_content', 10, 2);

// 
function price_columns_head($defaults) {
	$new = array();
    $ma_sp = $defaults['gia_si'];  // save the ma_sp column
    unset($defaults['gia_si']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='taxonomy-chuyen-muc') {  // when we find the date column
           $new['gia_si'] = $ma_sp;  // put the ma_sp column before it
        }    
        $new[$key]=$value;
    }  


    $new['gia_si'] = 'Giá SP';
    return $new;
}
 
// SHOW THE FEATURED IMAGE
function price_columns_content($column_name, $post_ID) {
    if ($column_name == 'gia_si') {
        $post_featured_ma_sp = get_post_meta($post_ID, "gia_si", true);
        if ($post_featured_ma_sp) {
        	echo '<p style="text-align: right;">';
            echo number_format($post_featured_ma_sp,0,",","."). "đ";
            echo '</p>';
        }
    }
}

add_filter('manage_san-pham_posts_columns', 'price_columns_head');
add_action('manage_san-pham_posts_custom_column', 'price_columns_content', 10, 2);

// Hình
add_image_size('featured_preview', 55, 55, true);
function get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function img_columns_head($defaults) {
    $defaults['featured_image'] = 'Hình ảnh';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function img_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img style="width: 50px; height: auto;" src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_san-pham_posts_columns', 'img_columns_head');
add_action('manage_san-pham_posts_custom_column', 'img_columns_content', 10, 2);


//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

////////////////////////////////////////////////////////////

if ( ! function_exists( 'banhang_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function banhang_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on banhang, use a find and replace
	 * to change 'banhang' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'banhang', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'banhang' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'banhang_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'banhang_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function banhang_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'banhang_content_width', 640 );
}
add_action( 'after_setup_theme', 'banhang_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function banhang_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'banhang' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'banhang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'banhang_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function banhang_scripts() {
	// wp_enqueue_style( 'banhang-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'banhang-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	// wp_enqueue_script( 'banhang-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
// add_action( 'wp_enqueue_scripts', 'banhang_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
