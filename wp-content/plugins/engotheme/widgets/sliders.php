<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author      Team <engotheme@gmail.com >
 * @copyright  Copyright (C) 2015  engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */


class Engotheme_Sliders_Widget extends Engotheme_Widget{

    public function __construct() {
        parent::__construct(
            // Base ID of your widget
            'engo_sliders',
            // Widget name will appear in UI
            __('ENGO Sliders Widget', 'engotheme'),
            // Widget description
            array( 'description' => __( 'Adds support Slider. ', 'engotheme' ), )
        );
        $this->widgetName = 'sliders';
    }

    public function widget( $args, $instance ) {
        
        add_action('wp_enqueue_scripts', array( $this, 'initScripts' ));

        extract( $args );
        $tpl = $instance['layout'];
         echo ($before_widget);
        //Display the name
        require($this->renderLayout($tpl));
        echo ($after_widget);
    }

    //Update the widget
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['layout'] = $new_instance['layout'];
        return $instance;
    }


    public function form( $instance ) {
        //Set up some default widget settings.
        $defaults = array('layout' => 'default' , 'posttype' => 'post');
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'posttype' )); ?>">Type:</label>
            <br>
            <select name="<?php echo esc_attr($this->get_field_name( 'posttype' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'posttype' )); ?>">
                <?php foreach (get_post_types(array('public'=>true)) as $key => $value): ?>
                    <?php if( $key=='portfolio' || $key=='post' || $key=='sliders' ): ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['posttype'], $key ); ?>><?php echo esc_html( $value ); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'layout' )); ?>">Template Style:</label>
            <br>
            <select name="<?php echo esc_attr($this->get_field_name( 'layout' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'layout' )); ?>">
                <?php foreach ($this->selectLayout() as $key => $value): ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $instance['layout'], $value ); ?>><?php echo esc_html( $value ); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function initScripts(){
        $url = ENGO_THEME_THEME_URI.'/framework/widgets/sliders/assets/';
        wp_enqueue_script('camera_js',$url.'js/camera.min.js');
        wp_enqueue_script('kwicks_js',$url.'js/jquery.kwicks.min.js');

        wp_enqueue_style( 'camera_css', $url.'css/camera.css');
        wp_enqueue_style( 'kwicks_css', $url.'css/accordion.kwicks.min.css');
    }
}

register_widget( 'Engotheme_Sliders_Widget' );

?>