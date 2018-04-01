<?php
 /**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Engotheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */


function nautica_custom_customize_enqueue() {
    wp_enqueue_script( 'custom-customize', get_template_directory_uri() . '/js/engo.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'nautica_custom_customize_enqueue' );

function nautica_customizer_css() {
    ?>
    <style type="text/css">
        .customize-control-image img {
            width: auto;
        }
        .customize-control-image .actions {
            margin-bottom: 10px;
        }
    </style>
    <?php
}
add_action( 'customize_controls_print_styles', 'nautica_customizer_css' );

/**
 * Engotheme Category Drop Down List Class
 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
 *
 * @since Engotheme v1.0
 */
if(  class_exists("WP_Customize_Control") ){

    nautica_engo_includes(  get_template_directory() . '/inc/customizer/*.php' );
    
    class Nautica_Sidebar_DropDown extends WP_Customize_Control{
     
        public function render_content(){
            
            global $wp_registered_sidebars;
            
            $output = array();
            
            $output[] = '<option value="">'.esc_html__( 'No Sidebar', 'nautica' ).'</option>';

            foreach( $wp_registered_sidebars as $sidebar ){ 
                $selected = ($this->value() == $sidebar['id'])?' selected="selected" ': '';
                $output[] = '<option value="'.$sidebar['id'].'" '.$selected.'>'.$sidebar['name'].'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
     
        }
    }

    ///
    class Nautica_Layout_DropDown extends WP_Customize_Control{
        public $type="ENGO_Layout";
        public function render_content(){
            
            $layouts = array(
                '' => esc_html__('Auto', 'nautica'),
                'mainfullwidth' => esc_html__('Main full width', 'nautica'),
                'leftmain' => esc_html__('Left - Main Sidebar', 'nautica'),
                'mainright' => esc_html__('Main - Right Sidebar', 'nautica'),
                'leftmainright' => esc_html__('Left - Main - Right Sidebar', 'nautica'),
        
            );
             printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span>',
                 $this->label
               
            );
            ?>
            <div class="page-layout">
               

            <?php
            $output = array();
            
            foreach( $layouts as $key => $layout ){ 
                $v = $this->value() ? $this->value() : 'fullwidth' ;   
                $selected = ( $v == $key)?' selected="selected" ': '';
                $output[] = '<option value="'.$key.'" '.$selected.'>'.$layout.'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '%s</label>',
                
                $dropdown
            ).'</div>';
        }
    }

    class Nautica_Detail_Layout_DropDown extends WP_Customize_Control{
        public function render_content(){

            $layouts = array(
                '' => esc_html__('Default', 'nautica'),
                'v1' => esc_html__('Product detail version 1', 'nautica'),
                'v2' => esc_html__('Product detail version 2', 'nautica'),
                'v3' => esc_html__('Product detail version 3', 'nautica'),

            );
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span>',
                $this->label

            );
            ?>
            <div class="page-layout">


            <?php
            $output = array();

            foreach( $layouts as $key => $layout ){
                $v = $this->value() ? $this->value() : 'default' ;
                $selected = ( $v == $key)?' selected="selected" ': '';
                $output[] = '<option value="'.$key.'" '.$selected.'>'.$layout.'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '%s</label>',

                $dropdown
            ).'</div>';
        }
    }
    class Nautica_Mini_Cart_Layout_DropDown extends WP_Customize_Control{
        public function render_content(){

            $layouts = array(
                '' => esc_html__('Default', 'nautica'),
                'white_version' => esc_html__('Version white', 'nautica'),
                'black_version' => esc_html__('Version black', 'nautica'),
                'fit_white_version' => esc_html__('Version Fit white', 'nautica'),
                'fit_black_version' => esc_html__('Version Fit black', 'nautica'),

            );
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span>',
                $this->label

            );
            ?>
            <div class="page-layout">


            <?php
            $output = array();

            foreach( $layouts as $key => $layout ){
                $v = $this->value() ? $this->value() : 'default' ;
                $selected = ( $v == $key)?' selected="selected" ': '';
                $output[] = '<option value="'.$key.'" '.$selected.'>'.$layout.'</option>';
            }

            $dropdown = '<select>'.implode( " ", $output ).'</select>';
            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '%s</label>',

                $dropdown
            ).'</div>';
        }
    }

}
if ( class_exists( 'WP_Customize_Control' ) ) {
    class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
        public $type = 'dropdown-categories';	

        public function render_content() {
            $dropdown = wp_dropdown_categories( 
                array( 
                    'name'             => '_customize-dropdown-categories-' . $this->id,
                    'echo'             => 0,
                    'hide_empty'       => false,
                    'show_option_none' => '&mdash; ' . esc_html__('Select', 'nautica') . ' &mdash;',
                    'hide_if_empty'    => false,
                    'selected'         => $this->value(),
                )
            );

            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

            printf( 
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}

/**
 * Engotheme TextArea Control Class
 * create custom textarea input field
 *
 * @since Engotheme v1.0
 **/

if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class ENGOTextAreaControl extends WP_Customize_Control {
        public $type = 'textarea'; # can change to 'number' for input[type=number] field
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => esc_html__( 'Default', 'nautica' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<label>
                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>
                <textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>
                </label>';
        }
    }

}
/**
 * Engotheme show if active Control
 *
 * @since Engotheme v1.0
 **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    class EngoCheckboxActionControl extends WP_Customize_Control {
        public $type = 'checkboxaction'; # can change to 'number' for input[type=number] field
        public function __construct( $manager, $id, $args = array() ) {
            $this->merge = $args['merge'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            ?>
            <label>
                <input type="checkbox" class="engoj_show_field" data-merge="<?php echo $this->merge;?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                <?php echo esc_html( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
            </label>
            <?php
        }
    }

}


if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class EngoShowTextfieldControl extends WP_Customize_Control {
        public $type = 'showtextfield'; # can change to 'number' for input[type=number] field
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => esc_html__( 'Default', 'nautica' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<div style="display:none;" data-show="'.$this->id.'"><label>
                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>
                <textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>
                </label></div><hr/>';
        }
    }

}

if (  class_exists( 'WP_Customize_Control' ) ) {
     

    /**
     * Class to create a custom tags control
     */
    class Text_Editor_Custom_Control extends WP_Customize_Control
    {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content()
           {
                ?>
                    <label>
                      <span class="customize-text_editor"><?php echo esc_html( $this->label ); ?></span>
                      <?php
                        $settings = array(
                          'textarea_name' => $this->id
                          );

                        wp_editor($this->value(), $this->id, $settings );
                      ?>
                    </label>
                <?php
           }
    }

}

/**
 * Engotheme Google Front Control Class
 *
 * @since Engotheme v2.1
 **/
if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class Nautica_GoogleFontControl extends WP_Customize_Control {
    
        private $fonts = false;

        public function __construct($manager, $id, $args = array(), $options = array()){
            $this->fonts = get_transient( 'google_font_names_');

            if ( ! is_array( $this->fonts ) )
                $this->fonts = $this->get_font_names();

            if ( ! $this->fonts ) return;
            
            parent::__construct( $manager, $id, $args );

        }
    
        public function render_content() {
            if(!empty($this->fonts)) { ?>
                <label>
                    <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                <?php
                foreach ( $this->fonts as $key => $value ) {
                    printf('<option value="%s">%s</option>',
                        $key,
                        $value);
                }
                ?>
                    </select>
                </label>
            <?php
            }
        }

        public function get_font_names() {
            
            $font_name_list = get_transient( 'google_font_names_');

            if ( $font_name_list )
                return $font_name_list;

            $json_name_list = @wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBWVfrVgpz5SYM-inIZL4SpzCzTPi4Dhrg' );

            if ( !isset( $json_name_list ) )
                return;

            $decoded_name_list = @json_decode( $json_name_list[ 'body'] );

            $font_name_list[ 'none' ] = 'none';

            if ( is_object( $decoded_name_list ) )
                foreach ( $decoded_name_list->items as $font_name )
                    $font_name_list[ str_replace( ' ', '+', $font_name->family ) ] = $font_name->family;

            set_transient( 'google_font_names_', $font_name_list, 60 * 60 *24 );
            return $font_name_list;
        }
    }
}
?>
<?php
/**
 * EngoTheme Customizer support
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */

/**
 * Implement Customizer additions and adjustments.
 *
 * @since EngoTheme 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function nautica_fnc_customize_register( $wp_customize ) {
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'nautica' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'nautica' );

	// Add custom description to Colors and Background controls or sections.
	if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
		$wp_customize->get_control( 'background_color' )->description = esc_html__( 'May only be visible on wide screens.', 'nautica' );
		$wp_customize->get_control( 'background_image' )->description = esc_html__( 'May only be visible on wide screens.', 'nautica' );
	} else {
		$wp_customize->get_section( 'colors' )->description           = esc_html__( 'Background may only be visible on wide screens.', 'nautica' );
		$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Background may only be visible on wide screens.', 'nautica' );
	} 


    $wp_customize->add_setting('topbar_bg', array( 
        'default'    => get_option('topbar_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('topbar_bg', array( 
        'label'    => esc_html__('Topbar Background', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );
    
    $wp_customize->add_setting('topbar_color', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('topbar_color', array( 
        'label'    => esc_html__('Topbar Text Color', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    ///// 
    $wp_customize->add_setting('page_bg', array( 
        'default'    => get_option('page_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('page_bg', array( 
        'label'    => esc_html__('Page Container Background', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
        'default'   => '#FFFFFF'
    ) );
    
    //

    $wp_customize->add_setting('footer_bg', array( 
        'default'    => get_option('footer_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_bg', array( 
        'label'    => esc_html__('Footer Background', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );

    $wp_customize->add_setting('footer_heading_color', array( 
        'default'    => get_option('footer_heading_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_heading_color', array( 
        'label'    => esc_html__('Footer Heading Color', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    $wp_customize->add_setting('footer_color', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('footer_color', array( 
        'label'    => esc_html__('Footer Text Color', 'nautica'),
        'section'  => 'colors',
        'type'      => 'color',
    ) );


    ///

    $wp_customize->add_setting('header_image_link', array( 
        'default'    => get_option('footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
        'default'   => '#'
    ) );
    
    $wp_customize->add_control('header_image_link', array( 
        'label'    => esc_html__('Image Link', 'nautica'),
        'section'  => 'header_image',
        'type'      => 'text',
        'default'   => '#'
    ) );



}

add_action( 'customize_register', 'nautica_fnc_customize_register' );


function nautica_sanitize_textarea( $content ){
    return wp_kses_post( force_balance_tags( $content ) );
}
function nautica_sanitize_textarea_html( $content ){
    return $content;
}

/**
 *
 */
add_action( 'customize_register', 'nautica_fnc_cst_customizer' );

function nautica_fnc_cst_customizer($wp_customize){

    # General Settings
    // Panel Header
    $wp_customize->add_section('engo_cst_general_settings', array(
        'title'      => esc_html__('General Settings', 'nautica'),
        'description'    => esc_html__('Website General Settings', 'nautica'),
        'transport'  => 'postMessage',
        'priority'   => 10,
    ));

    // Parameter Options
    $wp_customize->add_setting('blogname', array( 
        'default'    => get_option('blogname'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('blogname', array( 
        'label'    => esc_html__('Site Title', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'priority' => 1,
    ) );
     
    //
    $wp_customize->add_setting('blogdescription', array( 
        'default'    => get_option('blogdescription'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('blogdescription', array( 
        'label'    => esc_html__('Tagline', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'priority' => 2,
    ) );

    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
        //
        $wp_customize->add_setting('engo_theme_options[favicon]', array(
            'default'    => '',
            'type'       => 'option',
            'capability' => 'manage_options',
            'sanitize_callback' => 'esc_url_raw',
        ) );

            
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'engo_theme_options[favicon]', array(
            'label'    => esc_html__('Favicon', 'nautica'),
            'section'  => 'engo_cst_general_settings',
            'settings' => 'engo_theme_options[favicon]',
            'priority' => 5,
        ) ) );

    }
    // 
    $wp_customize->add_setting('display_header_text', array( 
        'default'    => 1,
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );    
    $wp_customize->add_control( 'display_header_text', array(
        'settings' => 'header_textcolor',
        'label'    => esc_html__( 'Show Title & Tagline', 'nautica' ),
        'section'  => 'engo_cst_general_settings',
        'type'     => 'checkbox',
        'priority' => 4,
    ) );


    /* 
     * Custom Logo 
     */

     $wp_customize->add_setting('engo_theme_options[header_default_logo]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'engo_theme_options[header_default_logo]', array(
        'label'    => esc_html__('Logo', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'settings' => 'engo_theme_options[header_default_logo]',
        'priority' => 10,
    ) ) );
    
     /* 
     * Custom payment 
     */
     $wp_customize->add_setting('engo_theme_options[image-payment]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'engo_theme_options[image-payment]', array(
        'label'    => esc_html__('Payment Logo', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'settings' => 'engo_theme_options[image-payment]',
        'priority' => 11,
    ) ) );

    $wp_customize->add_setting('engo_theme_options[nautica_hotline]', array(
        'default'    => '',
        'type'       => 'option',
        'transport'=>'refresh',
        'sanitize_callback' => 'nautica_sanitize_textarea',
    ) );

    $wp_customize->add_control('nautica_hotline', array(
        'label'    => __('Hotline number', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'settings' => 'engo_theme_options[nautica_hotline]',
        'type' => 'text',
        'priority' => 12,
    ) );

    $wp_customize->add_setting('engo_theme_options[copyright_text]', array(
        'default'    => 'Copyright 2015 - Engotheme - All Rights Reserved.',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'nautica_sanitize_textarea',
    ) );

    $wp_customize->add_control( new ENGOTextAreaControl( $wp_customize, 'engo_theme_options[copyright_text]', array(
        'label'    => esc_html__('Copyright text', 'nautica'),
        'section'  => 'engo_cst_general_settings',
        'settings' => 'engo_theme_options[copyright_text]',
        'priority' => 12,
    ) ) );


   /***************************************************************************
    * Theme Settings 
    ***************************************************************************/

    $wp_customize->add_section( 'ts_general_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Themes And Layouts Setting', 'nautica' ),
        'description' => '',
    ) );

    //
    $wp_customize->add_setting( 'engo_theme_options[skin]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => 'default',
         'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[skin]', array(
        'label'      => esc_html__( 'Active Skin', 'nautica' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
        'choices'    => nautica_fnc_cst_skins(),
    ) );

     $wp_customize->add_setting( 'engo_theme_options[headerlayout]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[headerlayout]', array(
        'label'      => esc_html__( 'Header Layout Style', 'nautica' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
         'choices' => array(''=>'Default'), 
         'choices'    => nautica_fnc_get_header_layouts(),
    ) );


    $wp_customize->add_setting('engo_theme_options[nautica_sticky_header]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options[nautica_sticky_header]', array(
        'settings'  => 'engo_theme_options[nautica_sticky_header]',
        'label'     =>  esc_html__( 'Sticky Header', 'nautica' ),
        'section'   => 'ts_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );



    $wp_customize->add_setting( 'engo_theme_options[footer-style]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => 'default'   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'engo_theme_options[footer-style]', array(
        'label'      => esc_html__( 'Footer Styles Builder', 'nautica' ),
        'section'    => 'ts_general_settings',
        'type'       => 'select',
        'choices'    => nautica_fnc_get_footer_profiles()
    ) );

    /** Custom logo each header **/

    $headers_layout = nautica_fnc_get_header_layouts_to_array();
    if($headers_layout) {
        $prio = 11;
        foreach ($headers_layout as $key => $value) {
            $wp_customize->add_setting("engo_theme_options[header_".$key."_logo]", array(
                'default'    => '',
                'type'       => 'option',
                'capability' => 'manage_options',
                'sanitize_callback' => 'esc_url_raw',
            ) );

            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "engo_theme_options[header_".$key."_logo]", array(
                'label'    => sprintf(esc_html__("%s Logo", 'nautica'), $value),
                'section'  => 'ts_general_settings',
                'settings' => "engo_theme_options[header_".$key."_logo]",
                'priority' => $prio,
            ) ) );


            $wp_customize->add_setting("engo_theme_options[header_".$key."_logo_retina]", array(
                'capability' => 'edit_theme_options',
                'type'       => 'option',
                'default'   => 0,
                'checked' => 1,
                'sanitize_callback' => 'sanitize_text_field'
            ) );

            $wp_customize->add_control(new EngoCheckboxActionControl ( $wp_customize,"engo_theme_options[header_".$key."_logo_retina]", array(
                'settings'  => "engo_theme_options[header_".$key."_logo_retina]",
                'label'     =>  sprintf(esc_html__("Use retina logo for %s", 'nautica'), $value),
                'section'   => 'ts_general_settings',
                'type'      => 'checkboxaction',
                'merge' => "engo_theme_options[header_".$key."_logo_retina_text_field]",
                'priority' => $prio,
            ) ));


            $wp_customize->add_setting("engo_theme_options[header_".$key."_logo_retina_text_field]", array(
                'default'    => '',
                'type'       => 'option',
                'transport'=>'refresh',
                'sanitize_callback' => 'nautica_sanitize_textarea_html',
            ) );
            $wp_customize->add_control( new EngoShowTextfieldControl ( $wp_customize, "engo_theme_options[header_".$key."_logo_retina_text_field]", array(
                'label'    => esc_html__('SVG code', 'nautica'),
                'description' => sprintf(esc_html__("Use retina logo for %s", 'nautica'), $value),
                'section'  => 'ts_general_settings',
                'settings' => "engo_theme_options[header_".$key."_logo_retina_text_field]",
                'priority' => $prio,
            ) ) );

            $prio++;
        }
    }


     
 

    /******************************************************************
     * Social share
     ******************************************************************/
    $wp_customize->add_section( 'social_share_settings', array(
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Social Share setting', 'nautica' ),
        'description' => '',
    ) );

    // Share facebook
    nautica_social_config( $wp_customize, 'facebook_share_blog', esc_html__('Share facebook ', 'nautica'), 'social_share_settings');
    //share twitter
    nautica_social_config( $wp_customize, 'twitter_share_blog', esc_html__('Share twitter ', 'nautica'), 'social_share_settings');
    //share linkedin
    nautica_social_config( $wp_customize, 'linkedin_share_blog', esc_html__('Share linkedin ', 'nautica'), 'social_share_settings');
    //share tumblr
    nautica_social_config( $wp_customize, 'tumblr_share_blog', esc_html__('Share tumblr ', 'nautica'), 'social_share_settings');
    //share google plus
    nautica_social_config( $wp_customize, 'google_share_blog', esc_html__('Share google plus ', 'nautica'), 'social_share_settings');
    //share pinterest
    nautica_social_config( $wp_customize, 'pinterest_share_blog', esc_html__('Share pinterest ', 'nautica'), 'social_share_settings');
    //share mail
    nautica_social_config( $wp_customize, 'mail_share_blog', esc_html__('Share mail ', 'nautica'), 'social_share_settings');


    /******************************************************************
     * Navigation
     ******************************************************************/

     # Sticky Top Bar Option
    $wp_customize->add_setting('engo_theme_options[verticalmenu]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options[verticalmenu]', array(
        'settings'  => 'engo_theme_options[verticalmenu]',
        'label'     => esc_html__('Vertical Megamenu', 'nautica'),
        'section'   => 'nav',
        'type'      => 'select',
        'choices' => nautica_fnc_get_menugroups(),
    ) );
    


    # Sticky Top Bar Option
    $wp_customize->add_setting('engo_theme_options[megamenu-is-sticky]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options[megamenu-is-sticky]', array(
        'settings'  => 'engo_theme_options[megamenu-is-sticky]',
        'label'     => esc_html__('Sticky Top Bar', 'nautica'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );   
 
    $wp_customize->add_setting( 'engo_theme_options[megamenu-duration]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '300',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[megamenu-duration]', array(
        'label'      => esc_html__(  'Megamenu Duration', 'nautica' ),
        'section'    => 'nav',
        'type'    => 'text'
    ) );

    /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'static_front_page', array(
        'title'          => esc_html__( 'Front Page Settings', 'nautica' ),
        'priority'       => 120,
        'description'    => esc_html__( 'Your theme supports a static front page', 'nautica'),
    ) );

    $wp_customize->add_setting( 'engo_theme_options[sidebar_position]', array(
        'default' => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
 
    $wp_customize->add_control( 'engo_theme_options[sidebar_position]', array(
        'type' => 'radio',
        'label' => 'Sidebar Position',
        'section' => 'static_front_page',
        'priority' => 1,
        'choices' => array(
            'left' => esc_html__( 'Left', 'nautica' ),
            'right' => esc_html__( 'Right', 'nautica' ),
        ),
    ) );

    $wp_customize->add_setting( 'show_on_front', array(
        'default'        => get_option( 'show_on_front' ),
        'capability'     => 'manage_options',
        'type'           => 'option',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'show_on_front', array(
        'label'   => esc_html__( 'Front page displays', 'nautica' ),
        'section' => 'static_front_page',
        'type'    => 'radio',
        'choices' => array(
            'posts' => esc_html__( 'Your latest posts', 'nautica' ),
            'page'  => esc_html__( 'A static page', 'nautica' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'page_on_front', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_on_front', array(
        'label'      => esc_html__( 'Front page', 'nautica' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );

    $wp_customize->add_setting( 'page_for_posts', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_for_posts', array(
        'label'      => esc_html__( 'Posts page', 'nautica' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );


    /* 
     /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'pages_setting', array(
        'title'          => esc_html__( 'Pages Settings', 'nautica' ),
        'priority'       => 120,
        'description'    => esc_html__( 'Your theme supports a static front page', 'nautica'),
    ) );

     
    $wp_customize->add_setting( 'engo_theme_options[404_post]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => ''   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'engo_theme_options[404_post]', array(
        'label'      => esc_html__( '404 Page', 'nautica' ),
        'section'    => 'pages_setting',
        'type'       => 'dropdown-pages',
    ) );

     // 
}


function nautica_social_config( $wp_customize, $id, $name_social, $section){
    $wp_customize->add_setting('engo_theme_options['.$id.']', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options['.$id.']', array(
        'settings'  => 'engo_theme_options['.$id.']',
        'label'     => $name_social,
        'section'   => $section,
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
}



 
add_action( 'customize_register', 'nautica_fnc_blog_settings' );
function nautica_fnc_blog_settings( $wp_customize ){
    
    $wp_customize->add_panel( 'panel_blog', array(
        'priority' => 80,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Blog & Post', 'nautica' ),
        'description' =>esc_html__( 'Make default setting for page, general', 'nautica' ),
    ) );


 
   

  


    /**
     * General Setting
     */
    $wp_customize->add_section( 'blog_general_settings', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'General Setting', 'nautica' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    

    /**
     * Archive Setting
     */
    $wp_customize->add_section( 'archive_general_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Archive & Categgory Setting', 'nautica' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    $wp_customize->add_setting('engo_theme_options[blog-archive-view-mode]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[blog-archive-view-mode]', array(
        'label'      => esc_html__( 'Select view mod', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            'grid' => esc_html__('Grid', 'nautica' ),
            'list' => esc_html__('List - default', 'nautica' ),
            'list-left' => esc_html__('List - image left', 'nautica' ),
            'list-right' => esc_html__('List - image right', 'nautica' ),
            'masonry' => esc_html__('Masonry', 'nautica' ),

        )
    ) );
    $wp_customize->add_setting('engo_theme_options[blog-archive-column]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[blog-archive-column]', array(
        'label'      => esc_html__( 'Select column', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            '1' => esc_html__('1 column', 'nautica' ),
            '2' => esc_html__('2 column', 'nautica' ),
            '3' => esc_html__('3 column', 'nautica' ),
        )
    ) );


    $wp_customize->add_setting( 'engo_theme_options[post_archive_header_layout]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[post_archive_header_layout]', array(
        'label'      => esc_html__( 'Header Layout Style', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'    => 'select',
        'choices' => array(''=>'Default'),
        'choices'    => nautica_fnc_get_header_layouts(),
        'priority' => 1
    ) );

    $wp_customize->add_setting( 'engo_theme_options[nautica-blog-archive-header-position]', array(
        'type'       => 'option',
        'default'    => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'engo_theme_options[nautica-blog-archive-header-position]', array(
        'label'      => esc_html__( 'Header position', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            '' => esc_html__('Default', 'nautica' ),
            'inherit' => esc_html__('Inherit', 'nautica' ),
            'relative' => esc_html__('Relative', 'nautica' ),
            'absolute' => esc_html__('Absolute', 'nautica' ),
        ),
        'priority' => 2
    ) );

    $wp_customize->add_setting( 'engo_theme_options[post_archive_footer_layout]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => 'default'   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );

    $wp_customize->add_control( 'engo_theme_options[post_archive_footer_layout]', array(
        'label'      => esc_html__( 'Footer Styles Builder', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'    => nautica_fnc_get_footer_profiles(),
        'priority' => 2
    ) );

    $wp_customize->add_setting('engo_theme_options[archive_breadcrumbs_images]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'engo_theme_options[archive_breadcrumbs_images]', array(
        'label'    => esc_html__('Breadcrumbs image', 'nautica'),
        'section'  => 'archive_general_settings',
        'settings' => 'engo_theme_options[archive_breadcrumbs_images]',
        'priority' => 3,
    ) ) );


      ///  Archive layout setting
    $wp_customize->add_setting( 'engo_theme_options[blog-archive-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'mainright',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new Nautica_Layout_DropDown( $wp_customize, 'engo_theme_options[blog-archive-layout]', array(
        'settings'  => 'engo_theme_options[blog-archive-layout]',
        'label'     => esc_html__('Archive Layout', 'nautica'),
        'section'   => 'archive_general_settings',
        'priority' => 3

    ) ) );
    $wp_customize->add_setting( 'engo_theme_options[blog-archive-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize, 'engo_theme_options[blog-archive-left-sidebar]', array(
        'settings'  => 'engo_theme_options[blog-archive-left-sidebar]',
        'label'     => esc_html__('Archive Left Sidebar', 'nautica'),
        'section'   => 'archive_general_settings',
        'priority' => 4
    ) ) );
    $wp_customize->add_setting( 'engo_theme_options[blog-archive-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize, 'engo_theme_options[blog-archive-right-sidebar]', array(
        'settings'  => 'engo_theme_options[blog-archive-right-sidebar]',
        'label'     => esc_html__('Archive Right Sidebar', 'nautica'),
        'section'   => 'archive_general_settings',
        'priority' => 5
    ) ) );

    $wp_customize->add_setting('engo_theme_options[blog-archive-post-thumbnail]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'engo_theme_options[blog-archive-post-thumbnail]', array(
        'label'      => esc_html__( 'Select thumbnail view mod', 'nautica' ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            'post-thumbnail' => esc_html__('Thumbnail size', 'nautica' ),
            'nautica-post-fullwidth' => esc_html__('Full size', 'nautica' ),
        )
    ) );

    /**
     * Single post Setting
     */
    $wp_customize->add_section( 'blog_single_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__( 'Single post Setting', 'nautica' ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    $wp_customize->add_setting('engo_theme_options[blog-show-share-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options[blog-show-share-post]', array(
        'settings'  => 'engo_theme_options[blog-show-share-post]',
        'label'     => esc_html__('Show share post', 'nautica'),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('engo_theme_options[nautica-blog-show-related-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('engo_theme_options[nautica-blog-show-related-post]', array(
        'settings'  => 'engo_theme_options[nautica-blog-show-related-post]',
        'label'     => esc_html__('Show related post', 'nautica'),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
    
/*
    $wp_customize->add_setting( 'engo_theme_options[engo-related-blog-items-show]', array(
        'type'       => 'option',
        'default'    => 4,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'engo_theme_options[engo-related-blog-items-show]', array(
        'label'      => esc_html__( 'Number Of post to show', 'nautica' ),
        'section'    => 'blog_single_settings',
        'type'       => 'select',
        'choices'     => array(
            '3' => esc_html__('3 posts', 'nautica' ),
            '6' => esc_html__('6 posts', 'nautica' ),
            '9' => esc_html__('9 posts', 'nautica' ),
            '12' => esc_html__('12 posts', 'nautica' ),
        )
    ) );   
*/

       ///  single layout setting

    $wp_customize->add_setting( 'engo_theme_options[blog-single-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'mainleft',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Nautica_Layout_DropDown( $wp_customize, 'engo_theme_options[blog-single-layout]', array(
        'settings'  => 'engo_theme_options[blog-single-layout]',
        'label'     => esc_html__('Single Blog Layout', 'nautica'),
        'section'   => 'blog_single_settings',
        'priority' => 5
    ) ) );
    $wp_customize->add_setting( 'engo_theme_options[blog-single-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize, 'engo_theme_options[blog-single-left-sidebar]', array(
        'settings'  => 'engo_theme_options[blog-single-left-sidebar]',
        'label'     => esc_html__('Single blog Left Sidebar', 'nautica'),
        'section'   => 'blog_single_settings',
        'priority' => 6
    ) ) );

    $wp_customize->add_setting( 'engo_theme_options[blog-single-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-right',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize,  'engo_theme_options[blog-single-right-sidebar]', array(
        'settings'  => 'engo_theme_options[blog-single-right-sidebar]',
        'label'     => esc_html__('Single blog Right Sidebar', 'nautica'),
        'section'   => 'blog_single_settings' ,
        'priority' => 7
    ) ) );
}


/**
 * Sanitize the Featured Content layout value.
 *
 * @since EngoTheme 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function nautica_fnc_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
		$layout = 'grid';
	}

	return $layout;
}

/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_customize_preview_js() {
	wp_enqueue_script( 'nautica_fnc_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'nautica_fnc_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'nautica',
		'title'   => 'Nautica',
		'content' =>
			'<ul>' .
				'<li>' . sprintf( wp_kses( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by a <a href="%1$s">tag</a>; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'nautica' ), array('a' => array('href' => array(),'title' => array()))), esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'nautica' ), admin_url( 'edit.php' ) ) ), admin_url( 'customize.php' ), admin_url( 'edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( wp_kses( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. EngoTheme uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'nautica' ),array('a' => array('href' => array(),'title' => array()))), 'https://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( wp_kses( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">EngoTheme support</a>.', 'nautica' ),array('a' => array('href' => array(),'title' => array()))), 'http://support.engotheme.com/') . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'nautica_fnc_contextual_help' );
add_action( 'admin_head-edit.php',   'nautica_fnc_contextual_help' );
