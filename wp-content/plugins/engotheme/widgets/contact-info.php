<?php

class Engotheme_Contact_Info_Widget extends Engotheme_Widget {

    
    private $params;
    public function __construct() {
        parent::__construct(
            // Base ID of your widget
            'engo_contact_info',
            // Widget name will appear in UI
            __('ENGO Contact Info Widget', 'engotheme'),
            // Widget description
            array( 'description' => __( 'Add contact information. ', 'engotheme' ), )
        );
        $this->widgetName = 'contact-info';
        
        $this->params = array(
            'title' => __('Title', 'engotheme'),
            'description' => __('Description', 'engotheme'),
            'company' => __('Company', 'engotheme'),
            'country' => __('Country', 'engotheme'),
            'locality' => __('Locality', 'engotheme'),
            'region' => __('Region', 'engotheme'),
            'street' => __('Street', 'engotheme'),
            'working-days' => __('Working Days', 'engotheme'),
            'working-hours' => __('Working Hours', 'engotheme'),
            'phone' => __('Phone', 'engotheme'),
            'mobile' => __('Mobile', 'engotheme'),
            'fax' => __('Fax', 'engotheme'),
            'skype' => __('Skype', 'engotheme'),
            'email-address' => __('Email Address', 'engotheme'),
            'email' => __('Email', 'engotheme'),
            'website-url' => __('Website URL', 'engotheme'),
            'website' => __('Website', 'engotheme')
        );
    }


    function widget($args, $instance) {
        extract( $args );
        extract( $instance );

        $title = apply_filters('widget_title', $instance['title']);
        echo    $before_widget;
            require($this->renderLayout( 'default'));
        echo    $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        foreach ($this->params as $key => $value){
            $instance[$key] = $new_instance[$key];
            $instance[$key.'_class'] = $new_instance[$key.'_class'];
        }
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Contact Info', 'engotheme'));
        $instance = wp_parse_args((array) $instance, $defaults);
        $array_class = array('phone', 'mobile', 'fax', 'skype', 'email', 'website' );
        foreach ($this->params as $key => $value) :
        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id($key) ); ?>"><?php echo trim($value); ?>:</label>
                <?php if(in_array($key, $array_class)):?>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php if (isset($instance[$key])) echo esc_attr( $instance[$key] ); ?>" />
                    <label for="<?php echo esc_attr($this->get_field_id($key.'_class')); ?>"><?php echo 'Icon class '.$value ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($key.'_class')); ?>" name="<?php echo esc_attr($this->get_field_name($key.'_class')); ?>" type="text" value="<?php if (isset($instance[$key.'_class'])) echo esc_attr( $instance[$key.'_class'] ); ?>" />
                <?php else: ?>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php if (isset($instance[$key])) echo esc_attr( $instance[$key] ); ?>" />
                <?php endif; ?>
            </p>
        <?php endforeach; ?>
        <script type="application/javascript">
        jQuery('.checkbox').on('click',function(){
            jQuery('.'+this.id).toggle();
        });
    </script>
    <?php
    }
}

register_widget( 'Engotheme_Contact_Info_Widget' );