<?php 
function sanpham_chuyen_muc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sản phẩm theo chuyên mục - Index', 'banhang' ),
		'id'            => 'index-san-pham-chuyen-muc',
		'description'   => esc_html__( 'Thêm widget sản phẩm theo chuyên mục vào trang chủ.', 'banhang' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'sanpham_chuyen_muc_widgets_init' );
class Sanpham_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'index_sanpham_widget', // Base ID
			esc_html__( 'Sản phẩm', 'banhang' ), // Name
			array( 'description' => esc_html__( 'Hiển thị sản phẩm theo chuyên mục', 'banhang' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// echo $args['before_widget'];
		// if ( ! empty( $instance['title'] ) ) {
		// 	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		// }
		// echo esc_html__( 'Hello, World!', 'banhang' );
		// echo $args['after_widget'];
		include get_template_directory() . '/inc/san-pham-widget-content.php';
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'banhang' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Tên chuyên mục:', 'banhang' ); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'id_chuyen_muc' ) ); ?>">
				<?php esc_attr_e( 'Chọn chuyên mục:', 'banhang' ); ?>
			</label> 
			 <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id_chuyen_muc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id_chuyen_muc' ) ); ?>">
		<?php
				$parent = get_term_by('name', 'Thương hiệu', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				// if ("banchay" == $instance['id_chuyen_muc']) {
				// 	echo '<option value="banchay" selected >Sản phẩm bán chạy</option>';
				// } else {
				// 	echo '<option value="banchay" >Sản phẩm bán chạy</option>';				
				// }
				if ("MoiNhat" == $instance['id_chuyen_muc']) {
					echo '<option value="MoiNhat" selected >Sản phẩm hot</option>';
				} else {
					echo '<option value="MoiNhat" >Sản phẩm hot</option>';				
				}
				foreach ($categories as $term) {
					if ($term->term_id == $instance['id_chuyen_muc']) {
						echo '<option value="' . $term->term_id . '" selected >' . $term->name . '</option>';
					} else {
						echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';				
					}
				} 

				$parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    'child_of' => $parent->term_id
				) );
				foreach ($categories as $term) {
					if ($term->term_id == $instance['id_chuyen_muc']) {
						echo '<option value="' . $term->term_id . '" selected >' . $term->name . '</option>';
					} else {
						echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';				
					}
				} 
		?>
			</select> 
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'full_row' ) ); ?>">
				<?php esc_attr_e( 'Có quảng cáo:', 'banhang' ); ?>
			</label>
			<input class="widefat" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'full_row' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'full_row' ) ); ?>" value="true" <?php echo ($instance['full_row']) ? 'checked':''; ?>>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'id_quang_cao' ) ); ?>">
				<?php esc_attr_e( 'Chọn ảnh quảng cáo:', 'banhang' ); ?>
			</label> 
			 <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id_quang_cao' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id_quang_cao' ) ); ?>">
		<?php
				$category_id = get_cat_ID('Hình quảng cáo');
				global $post;
				$args = array( 'posts_per_page' => -1, 'category' => $category_id );

				$quangcaos = get_posts( $args );
				foreach ( $quangcaos as $post ) : setup_postdata( $post ); 
					if (get_the_id() == $instance['id_quang_cao']) {
						echo '<option value="' . get_the_id() . '" selected >' . get_the_title() . '</option>';
					} else {
						echo '<option value="' . get_the_id() . '">' . get_the_title() . '</option>';				
					}
				 endforeach; 
				wp_reset_postdata();
		?>
			</select> 
		</p>
<?php 

	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['id_chuyen_muc'] = ( ! empty( $new_instance['id_chuyen_muc'] ) ) ? strip_tags( $new_instance['id_chuyen_muc'] ) : '';
		$instance['full_row'] = ( ! empty( $new_instance['full_row'] ) ) ? strip_tags( $new_instance['full_row'] ) : '';

		$instance['id_quang_cao'] = ( ! empty( $new_instance['id_quang_cao'] ) ) ? strip_tags( $new_instance['id_quang_cao'] ) : '';

		return $instance;
	}

}

function register_san_pham_widget() {
    register_widget( 'Sanpham_Widget' );
}
add_action( 'widgets_init', 'register_san_pham_widget' );