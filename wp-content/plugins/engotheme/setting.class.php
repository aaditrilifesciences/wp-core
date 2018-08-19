<?php
class EngoThemeSetting
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Engo Settings',
            'Engo Theme',
            'manage_options',
            'engotheme-setting-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'engo_theme_posttype' );
        ?>
        <div class="wrap">

            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'engo_postype_group' );
                do_settings_sections( 'engotheme-setting-admin' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'engo_postype_group', // Option group
            'engo_theme_posttype', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );



        add_settings_section(
            'setting_section_id', // ID
            __('Post Types Settings', 'engotheme'), // Title
            array( $this, 'print_section_info' ), // Callback
            'engotheme-setting-admin' // Page
        );

        add_settings_field(
            'enable_brand', // ID
            'Enable Brand', // Title ,
            array( $this, 'enable_brand_callback' ), // Callback
            'engotheme-setting-admin', // Page
            'setting_section_id' // Section
        );


        add_settings_field(
            'enable_woobrand',
            'Enable Woocomerce Brand',
            array( $this, 'enable_woobrand_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_team',
            'Enable Team',
            array( $this, 'enable_team_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );



        add_settings_field(
            'enable_video',
            'Enable Video',
            array( $this, 'enable_video_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_testimonials',
            'Enable Testimonials',
            array( $this, 'enable_testimonials_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_portfolio',
            'Enable Portfolio',
            array( $this, 'enable_portfolio_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_gallery',
            'Enable Gallery',
            array( $this, 'enable_gallery_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );


        add_settings_field(
            'enable_faq',
            'Enable FAQ',
            array( $this, 'enable_faq_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_megamenu',
            'Enable Megamenu',
            array( $this, 'enable_megamenu_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'enable_footer',
            'Enable Footer',
            array( $this, 'enable_footer_callback' ),
            'engotheme-setting-admin',
            'setting_section_id'
        );

        do_action( 'engotheme_add_setting_field' );
    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        foreach( $input as $key => $value ){
            $new_input[$key] = sanitize_text_field( $value );
        }
        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function enable_brand_callback()
    {


        printf(
            '<input type="checkbox" id="enable_brand" name="engo_theme_posttype[enable_brand]"  %s />',
            isset( $this->options['enable_brand'] ) && $this->options['enable_brand'] ?  'checked="checked"'  : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function enable_woobrand_callback()
    {
        printf(
            '<input type="checkbox" id="enable_woobrands" name="engo_theme_posttype[enable_woobrands]"    %s />',
            isset( $this->options['enable_woobrands'] ) && $this->options['enable_woobrands'] ?  'checked="checked"'  : ''
        );
    }


    public function enable_video_callback()
    {
        printf(
            '<input type="checkbox" id="enable_video" name="engo_theme_posttype[enable_video]"    %s />',
            isset( $this->options['enable_video'] ) && $this->options['enable_video'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_team_callback(){
        printf(
            '<input type="checkbox" id="enable_team" name="engo_theme_posttype[enable_team]"    %s />',
            isset( $this->options['enable_team'] ) && $this->options['enable_team'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_testimonials_callback()
    {
        printf(
            '<input type="checkbox" id="enable_testimonials" name="engo_theme_posttype[enable_testimonials]"    %s />',
            isset( $this->options['enable_testimonials'] ) && $this->options['enable_testimonials'] ?  'checked="checked"'  : ''
        );
    }



    /**
     *
     */
    public function enable_portfolio_callback()
    {
        printf(
            '<input type="checkbox" id="enable_portfolio" name="engo_theme_posttype[enable_portfolio]"    %s />',
            isset( $this->options['enable_portfolio'] ) && $this->options['enable_portfolio'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_gallery_callback()
    {
        printf(
            '<input type="checkbox" id="enable_gallery" name="engo_theme_posttype[enable_gallery]"    %s />',
            isset( $this->options['enable_gallery'] ) && $this->options['enable_gallery'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_faq_callback()
    {
        printf(
            '<input type="checkbox" id="enable_faq" name="engo_theme_posttype[enable_faq]"    %s />',
            isset( $this->options['enable_faq'] ) && $this->options['enable_faq'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_footer_callback()
    {
        printf(
            '<input type="checkbox" id="enable_footer" name="engo_theme_posttype[enable_footer]"    %s />',
            isset( $this->options['enable_footer'] ) && $this->options['enable_footer'] ?  'checked="checked"'  : ''
        );
    }

    /**
     *
     */
    public function enable_megamenu_callback()
    {
        printf(
            '<input type="checkbox" id="enable_megamenu" name="engo_theme_posttype[enable_megamenu]"    %s />',
            isset( $this->options['enable_megamenu'] ) && $this->options['enable_megamenu'] ?  'checked="checked"'  : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new EngoThemeSetting();