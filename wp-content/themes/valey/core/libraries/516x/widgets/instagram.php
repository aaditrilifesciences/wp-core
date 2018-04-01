<?php
/**
 * Instagram widget.
 *
 * @since   1.0.0
 * @package Valey
 */

class FX_Valey_Widget_Instagram extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'description' => esc_html__( 'Show off your favorite Instagram photos', 'valey' )
		);
		$control_ops = array(
			'width'  => 'auto',
			'height' => 'auto'
		);
		parent::__construct( 'fx_valey_instagram', esc_html__( 'Valey - Instagram', 'valey' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title   = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$id      = empty($instance['id']) ? '' : $instance['id'];
		$limit   = empty( $instance['limit'] ) ? 4 : ( int ) $instance['limit'];
		$columns = empty( $instance['columns'] ) ? 2 : ( int ) $instance['columns'];

		echo $before_widget;
		
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		if ( intval( $id ) === 0 ) {
			return '<p>No user ID specified.</p>';
		}
		
		$transient_var = $id . '_' . $limit;
		
		if ( false === ( $items = get_transient( $transient_var ) ) ) {
		
			$response = wp_remote_get( 'https://api.instagram.com/v1/users/' . $id . '/media/recent/?access_token=2993933518.1677ed0.d3d8b54b26dd4eb4ae182d84506f879b&count=' . esc_attr( $limit ) );
		
			$response_body = json_decode( $response['body'] );
			
			if ( $response_body->meta->code !== 200 ) {
				return '<p>Incorrect user ID specified.</p>';
			}
			
			$items_as_objects = $response_body->data;
			$items = array();
			foreach ( $items_as_objects as $item_object ) {
				$item['link'] = $item_object->link;
				$item['src']  = $item_object->images->low_resolution->url;
				$items[]      = $item;
			}
			
			set_transient( $transient_var, $items, 60 * 60 );
		}
		
		$output = '<div class="fx-instagram clearfix columns-' . esc_attr( $columns ) . '">';
		
		foreach ( $items as $item ) {
			$link  = $item['link'];
			$image = $item['src'];
			$output	.= '<div class="item"><a href="' . esc_url( $link ) .'"><img width="320" height="320" src="' . esc_url( $image ) . '" alt="Instagram" /></a></div>';
		}
		
		$output .= '</div>';

		echo $output . $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['id']      = $new_instance['id'];
		$instance['limit']   = strip_tags( $new_instance['limit'] );
		$instance['columns'] = strip_tags( $new_instance['columns'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title' => '', 'id' => '', 'limit' => 4, 'columns' => 2 ) );
		$title    = strip_tags( $instance['title'] );
		$id       = isset( $instance['id'] ) ? $instance['id'] : array();
		$limit    = ( int ) $instance['limit'];
		$columns  = ( int ) $instance['columns'];
		$url      = 'http://jelled.com/instagram/lookup-user-id';
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'valey' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php printf( wp_kses_post( 'Instagram user ID (<a href="%s" target="_blank">Lookup your User ID</a>)', 'valey' ), $url ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" type="text" value="<?php echo esc_attr( $id ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php echo esc_html__( 'Number of Photos:', 'valey' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" min="1" value="<?php echo esc_attr( $limit ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php echo esc_html__( 'Columns (1-4):', 'valey' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" type="number" min="1" max="4" step="1" value="<?php echo esc_attr( $columns ); ?>" />
		</p>

	<?php
	}
}