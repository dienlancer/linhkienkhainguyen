<?php 
// add_action('init', 'custom_taxonomy_flush_rewrite');
// function custom_taxonomy_flush_rewrite() {
//     global $wp_rewrite;
//     $wp_rewrite->flush_rules();
// }

// Post type sản phẩm
function sanpham_custom_init() {
	$labels = array(
		'name'               => 'Sản phẩm',
		'singular_name'      => 'Sản phẩm',
		'menu_name'          => 'Sản phẩm',
		'name_admin_bar'     => 'Sản phẩm',
		'add_new'            => 'Thêm mới',
		'add_new_item'       => 'Thêm Sản phẩm mới',
		'new_item'           => 'Sản phẩm mới',
		'edit_item'          => 'Chỉnh sửa SP',
		'view_item'          => 'Xem sản phẩm',
		'all_items'          => 'Tất cả SP',
		'search_items'       => 'Tìm SP',
		'parent_item_colon'  => 'Parent Sản phẩm:',
		'not_found'          => 'Không tìm thấy sản phẩm',
		'not_found_in_trash' => 'Không tìm thấy sản phẩm trong thùng rác',
	);
	$args = array(
		'labels'             => $labels,
		'description'        => 'Quản lý sản phẩm',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'san-pham' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'   		=> 'dashicons-products',
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'san-pham', $args );
}
add_action( 'init', 'sanpham_custom_init' );

// Category sản phẩm
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'danhmuc_sanpham_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function danhmuc_sanpham_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => 'Chuyên mục',
		'singular_name'     => 'Chuyên mục',
		'search_items'      => 'Tìm chuyên mục',
		'all_items'         => 'Tất cả chuyên mục',
		'parent_item'       => 'Cha của chuyên mục',
		'parent_item_colon' => 'Cha của chuyên mục:',
		'edit_item'         => 'Chỉnh sửa chuyên mục',
		'update_item'       => 'Cập nhật chuyên mục',
		'add_new_item'      => 'Thêm chuyên mục mới',
		'new_item_name'     => 'Tên chuyên mục mới',
		'menu_name'         => 'Chuyên mục',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'chuyen-muc', 'with_front' => false ),
	);

	register_taxonomy( 'chuyen-muc', array( 'san-pham' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => 'Tag sản phẩm',
		'singular_name'              => 'Tag sản phẩm',
		'search_items'               => 'Tìm Tag sản phẩm',
		'popular_items'              => 'Tag sản phẩm phổ biến',
		'all_items'                  => 'Tất cả Tag sản phẩm',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Chỉnh sửa Tag sản phẩm',
		'update_item'                => 'Cập nhật Tag sản phẩm',
		'add_new_item'               => 'Thêm Tag SP mới',
		'new_item_name'              => 'Tên Tag sản phẩm mới',
		'separate_items_with_commas' => 'Phân cách Tag SP bằng dấu ,',
		'add_or_remove_items'        => 'Thêm hoặc xóa Tag SP',
		'choose_from_most_used'      => 'Chọn từ Tag SP dùng thường xuyên',
		'not_found'                  => 'Không tìm thấy Tag Sản phẩm',
		'menu_name'                  => 'Tag Sản phẩm',
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'tag-san-pham' ),
	);

	register_taxonomy( 'tag-san-pham', 'san-pham', $args );
}
?>