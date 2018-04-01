<?php 
/**
 * Class EngoTheme Woocommerce
 *
 */
class Nautica_Woocommerce{

    /**
     * Constructor to create an instance of this for processing logics render content and modules.
     */
	public function __construct(){
		add_action( 'customize_register',  array( $this, 'registerCustomizer' ), 9 );
        add_action( 'wp_enqueue_scripts', array( $this, 'loadThemeStyles' ), 15 );


        if( nautica_fnc_theme_options('is-quickview',true) ){
            add_action( 'wp_ajax_nautica_quickview', array($this,'quickview') );
            add_action( 'wp_ajax_nopriv_nautica_quickview', array($this,'quickview') );
            add_action( 'wp_footer', array($this,'quickviewModal') );
	    }

        $category_page = get_option( 'wc_ajax_add_to_cart_variable_category_page' );

        if(isset($category_page) && $category_page == "yes" ) {
            $this->nautica_woocommerce_template_loop_add_to_cart();
        }


        /** Using Ajax **/
        add_action( 'wp_ajax_engo_add_to_cart_variable', array($this,'addToCardToAllProductType') );
        add_action( 'wp_ajax_nopriv_engo_add_to_cart_variable', array($this,'addToCardToAllProductType') );

        remove_action( 'woocommerce_shortcode_before_product_cat_loop', 'wc_print_notices', 10 );
        remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
        remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

        /** Setting to enabled ajax in product archive page
        add_filter( 'woocommerce_get_sections_products', array($this,'wc_ajax_add_to_cart_variable_add_section' ));
        add_filter( 'woocommerce_get_settings_products', array($this,'wc_ajax_add_to_cart_variable_all_settings', 10, 2 ));**/

    }
    function addToCardToAllProductType() {
        ob_start();
        $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
        $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
        $variation_id = $_POST['variation_id'];
        $variation  = $_POST['variation'];
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {
            do_action( 'woocommerce_ajax_added_to_cart', $product_id );
            if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
                wc_add_to_cart_message( $product_id );
            }

            // Return fragments
            WC_AJAX::get_refreshed_fragments();
        } else {
            //$this->json_headers();
            header('Content-Type: application/json');
            $all_notices  = WC()->session->get( 'wc_notices', array() );

            // If there was an error adding to the cart, redirect to the product page to show any errors
            $data = array(
                'error' => true,
                'messages' => $all_notices,
                'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
            );
            wc_clear_notices();
            echo json_encode( $data );
        }

        wp_die();
    }

    function nautica_woocommerce_template_loop_add_to_cart() {
        global $product;

        if ($product->product_type == "variable" ) {
            woocommerce_variable_add_to_cart();
        }
        else {
            woocommerce_get_template( 'loop/add-to-cart.php' );
        }
    }
    /**
     * Create the section beneath the products tab
     **/


    function wc_ajax_add_to_cart_variable_add_section( $sections ) {

        $sections['wc_ajax_add_to_cart_variable'] = esc_html__( 'WC Ajax for Variable Products', 'nautica' );
        return $sections;

    }


    function wc_ajax_add_to_cart_variable_all_settings( $settings, $current_section ) {

        /**
         * Check the current section is what we want
         **/

        if ( $current_section == 'wc_ajax_add_to_cart_variable' ) {

            $settings_slider = array();

            // Add Title to the Settings
            $settings_slider[] = array( 'name' => esc_html__( 'WC Ajax for Variable Products Settings', 'nautica' ), 'type' => 'title', 'desc' => esc_html__( 'The following options are used to configure WC Ajax for Variable Products', 'nautica' ), 'id' => 'wc_ajax_add_to_cart_variable' );

            // Add first checkbox option
            $settings_slider[] = array(

                'name'     => esc_html__( 'Add Selection option to Category Page', 'nautica' ),
                'desc_tip' => esc_html__( 'This will automatically insert variable selection options on product Category Archive Page', 'nautica' ),
                'id'       => 'wc_ajax_add_to_cart_variable_category_page',
                'type'     => 'checkbox',
                'css'      => 'min-width:300px;',
                'desc'     => esc_html__( 'Enable Varition select option on Category Archive page', 'nautica' ),

            );

            $settings_slider[] = array( 'type' => 'sectionend', 'id' => 'wc_ajax_add_to_cart_variable' );

            return $settings_slider;

            /**
             * If not, return the standard settings
             **/

        } else {

            return $settings;

        }

    }

    /**
     * Load woocommerce styles follow theme skin actived
     *
     * @static
     * @access public
     * @since EngoTheme 1.0
     */
    public function loadThemeStyles() {
        $current = nautica_fnc_theme_options( 'skin','default' );
        if($current == 'default'){
            $path =  get_template_directory_uri() .'/woocommerce.css';
        }else{
            $path =  get_template_directory_uri() .'/skins/'.$current.'/woocommerce.css';
        }
        wp_enqueue_style( 'nautica-woocommerce', $path , 'nautica-woocommerce-front' , NAUTICA_THEME_VERSION, 'all' );
    }

	/**
	 * Add settings to the Customizer.
	 *
	 * @static
	 * @access public
	 * @since EngoTheme 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	public function registerCustomizer( $wp_customize ){
		$wp_customize->add_panel( 'panel_woocommerce', array(
    		'priority' => 70,
    		'capability' => 'edit_theme_options',
    		'theme_supports' => '',
    		'title' => 'Woocommerce',
    		'description' =>esc_html__( 'Make default setting for page, general', 'nautica' ),
    	) );

        /**
         * General Setting
         */
        $wp_customize->add_section( 'wc_general_settings', array(
            'priority' => 1,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'General Setting', 'nautica' ),
            'description' => '',
            'panel' => 'panel_woocommerce',
        ) );

        //config mini cart
        $wp_customize->add_setting('engo_theme_options[woo-show-minicart]', array(
            'capability' => 'manage_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('engo_theme_options[woo-show-minicart]', array(
            'settings'  => 'engo_theme_options[woo-show-minicart]',
            'label'     => esc_html__('Enable Mini Basket', 'nautica'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'priority' => 1
        ) );

        $wp_customize->add_setting( 'engo_theme_options[woo-mini-cart-template]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'white_version',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( new Nautica_Mini_Cart_Layout_DropDown( $wp_customize,  'engo_theme_options[woo-mini-cart-template]', array(
            'settings'  => 'engo_theme_options[woo-mini-cart-template]',
            'label'     => esc_html__('Mini cart templates', 'nautica'),
            'section'   => 'wc_general_settings',
            'priority' => 2

        ) ) );

        
        $wp_customize->add_setting('engo_theme_options[is-quickview]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('engo_theme_options[is-quickview]', array(
            'settings'  => 'engo_theme_options[is-quickview]',
            'label'     => esc_html__('Enable QuickView', 'nautica'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'transport' => 4,
            'priority' => 3
        ) );



        $wp_customize->add_setting('engo_theme_options[is-swap-effect]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('engo_theme_options[is-swap-effect]', array(
            'settings'  => 'engo_theme_options[is-swap-effect]',
            'label'     => esc_html__('Enable Swap Image', 'nautica'),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'transport' => 4,
            'priority' => 4
        ) );





        /**
         * Archive Page Setting
         */
        $wp_customize->add_section( 'wc_archive_settings', array(
            'priority' => 2,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Archive Page Setting', 'nautica' ),
            'description' => 'Configure categories, search, shop page setting',
            'panel' => 'panel_woocommerce',
        ) );

         ///  Archive layout setting
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-archive-layout]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'mainright',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( new Nautica_Layout_DropDown( $wp_customize,  'engo_theme_options[woocommerce-archive-layout]', array(
            'settings'  => 'engo_theme_options[woocommerce-archive-layout]',
            'label'     => esc_html__('Archive Layout', 'nautica'),
            'section'   => 'wc_archive_settings',
            'priority' => 1

        ) ) );

        $wp_customize->add_setting( 'engo_theme_options[woo_archive_header_layout]', array(
            'type'       => 'option',
            'capability' => 'edit_theme_options',
            'default'  => '',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[woo_archive_header_layout]', array(
            'label'      => esc_html__( 'Archive Header Layout Style', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'    => 'select',
            'choices' => array(''=>'Default'),
            'choices'    => nautica_fnc_get_header_layouts(),
            'priority' => 2
        ) );

        $wp_customize->add_setting( 'engo_theme_options[nautica-product-archive-header-position]', array(
            'type'       => 'option',
            'default'    => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( 'engo_theme_options[nautica-product-archive-header-position]', array(
            'label'      => esc_html__( 'Header position', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                '' => esc_html__('Default', 'nautica' ),
                'inherit' => esc_html__('Inherit', 'nautica' ),
                'relative' => esc_html__('Relative', 'nautica' ),
                'absolute' => esc_html__('Absolute', 'nautica' ),
            ),
            'priority' => 2
        ) );


        $wp_customize->add_setting( 'engo_theme_options[woo_archive_footer_layout]', array(
            'type'           => 'option',
            'capability'     => 'manage_options',
            'default'        => 'default'   ,
            'sanitize_callback' => 'sanitize_text_field'
            //  'theme_supports' => 'static-front-page',
        ) );

        $wp_customize->add_control( 'engo_theme_options[woo_archive_footer_layout]', array(
            'label'      => esc_html__( 'Footer Styles Builder', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'    => nautica_fnc_get_footer_profiles(),
            'priority' => 2
        ) );



        $wp_customize->add_setting( 'engo_theme_options[woo-archive-image-position-init]', array(
            'type'       => 'option',
            'default'    => 'before_list',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( 'engo_theme_options[woo-archive-image-position-init]', array(
            'label'      => esc_html__( 'Category image position', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                'before_list' => esc_html__('Display before list', 'nautica' ),
                'breadcrumbs' => esc_html__('Display in breadrumbs', 'nautica' ),
            ),
            'priority' => 3
        ) );
       //sidebar archive left
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-archive-left-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-left',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize,  'engo_theme_options[woocommerce-archive-left-sidebar]', array(
            'settings'  => 'engo_theme_options[woocommerce-archive-left-sidebar]',
            'label'     => esc_html__('Archive Left Sidebar', 'nautica'),
            'section'   => 'wc_archive_settings' ,
             'priority' => 4
        ) ) );
        //sidebar archive right
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-archive-right-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-right',
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize,  'engo_theme_options[woocommerce-archive-right-sidebar]', array(
            'settings'  => 'engo_theme_options[woocommerce-archive-right-sidebar]',
            'label'     => esc_html__('Archive Right Sidebar', 'nautica'),
            'section'   => 'wc_archive_settings' ,
            'priority' => 5
        ) ) );
        //list-grid  style archive
        $wp_customize->add_setting( 'engo_theme_options[wc_listgrid]', array(
            'type'       => 'option',
            'default'    => 'product',
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( 'engo_theme_options[wc_listgrid]', array(
            'label'      => esc_html__( 'List Grid', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                'product-list' => esc_html__('List', 'nautica' ),
                'product' => esc_html__('Grid', 'nautica' ),
            ),
            'description' => 'Select default layout archive product',
            'priority' => 6
        ) );
        //number product per page
        $wp_customize->add_setting( 'engo_theme_options[woo-number-page]', array(
            'type'       => 'option',
            'default'    => 12,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        $wp_customize->add_control( 'engo_theme_options[woo-number-page]', array(
            'label'      => esc_html__( 'Number of Products Per Page', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                '8' => esc_html__('8 Items - Only 2 or 4 items per row', 'nautica' ),
                '9' => esc_html__('9 Items - Only 3 items per row', 'nautica' ),
                '10' => esc_html__('10 Items - Only 2 items per row', 'nautica' ),
                '12' => esc_html__('12 Items - Only 3 or 6 items per row', 'nautica' ),
                '16' => esc_html__('16 Items - Only 2 or 4 items per row', 'nautica' ),
                '18' => esc_html__('18 Items - Only 2, 3 or 6 items per row', 'nautica' ),
                '24' => esc_html__('24 Items - Only 2, 3, 4 or 6 items per row', 'nautica' ),
            ),
            'priority' => 7
        ) );

        //number product per row
        $wp_customize->add_setting( 'engo_theme_options[wc_itemsrow]', array(
            'type'       => 'option',
            'default'    => 4,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[wc_itemsrow]', array(
            'label'      => esc_html__( 'Number of Products Per Row', 'nautica' ),
            'section'    => 'wc_archive_settings',
            'type'       => 'select',
            'choices'     => array(
                '2' => esc_html__('2 Items', 'nautica' ),
                '3' => esc_html__('3 Items', 'nautica' ),
                '4' => esc_html__('4 Items', 'nautica' ),
                '6' => esc_html__('6 Items', 'nautica' ),
            ),
            'priority' => 8
        ) );
    	

        /**
    	 * Product Single Setting
    	 */
    	$wp_customize->add_section( 'wc_product_settings', array(
    		'priority' => 12,
    		'capability' => 'edit_theme_options',
    		'theme_supports' => '',
    		'title' => esc_html__( 'Single Product Page Setting', 'nautica' ),
    		'description' => 'Configure single product page',
    		'panel' => 'panel_woocommerce',
    	) );
        ///  single layout setting
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-single-layout]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'mainright',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Select layout
        $wp_customize->add_control( new Nautica_Layout_DropDown( $wp_customize,  'engo_theme_options[woocommerce-single-layout]', array(
            'settings'  => 'engo_theme_options[woocommerce-single-layout]',
            'label'     => esc_html__('Product Detail Layout', 'nautica'),
            'section'   => 'wc_product_settings',
            'priority' => 1
        ) ) );

        $wp_customize->add_setting( 'engo_theme_options[woo_detail_header_layout]', array(
            'type'       => 'option',
            'capability' => 'edit_theme_options',
            'default'  => '',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[woo_detail_header_layout]', array(
            'label'      => esc_html__( 'Detail Header Layout Style', 'nautica' ),
            'section'    => 'wc_product_settings',
            'type'    => 'select',
            'choices' => array(''=>'Default'),
            'priority' => 2,
            'choices'    => nautica_fnc_get_header_layouts(),
        ) );

        $wp_customize->add_setting( 'engo_theme_options[woo_detail_footer_layout]', array(
            'type'       => 'option',
            'capability' => 'edit_theme_options',
            'default'  => '',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[woo_detail_footer_layout]', array(
            'label'      => esc_html__( 'Detail Footer Layout Style', 'nautica' ),
            'section'    => 'wc_product_settings',
            'type'    => 'select',
            'choices' => array(''=>'Default'),
            'priority' => 2,
            'choices'    => nautica_fnc_get_footer_profiles(),
        ) );

       
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-single-left-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Sidebar left
        $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize,  'engo_theme_options[woocommerce-single-left-sidebar]', array(
            'settings'  => 'engo_theme_options[woocommerce-single-left-sidebar]',
            'label'     => esc_html__('Product Detail Left Sidebar', 'nautica'),
            'section'   => 'wc_product_settings',
            'priority' => 2 
        ) ) );

         $wp_customize->add_setting( 'engo_theme_options[woocommerce-single-right-sidebar]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'sidebar-right',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        //Sidebar right
        $wp_customize->add_control( new Nautica_Sidebar_DropDown( $wp_customize,  'engo_theme_options[woocommerce-single-right-sidebar]', array(
            'settings'  => 'engo_theme_options[woocommerce-single-right-sidebar]',
            'label'     => esc_html__('Product Detail Right Sidebar', 'nautica'),
            'section'   => 'wc_product_settings',
            'priority' => 3 
        ) ) );

        /**Product Detail template**/
        $wp_customize->add_setting( 'engo_theme_options[woocommerce-single-template]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 'default',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        /**Product Detail template Select template **/
        $wp_customize->add_control( new Nautica_Detail_Layout_DropDown( $wp_customize,  'engo_theme_options[woocommerce-single-template]', array(
            'settings'  => 'engo_theme_options[woocommerce-single-template]',
            'label'     => esc_html__('Product Detail template', 'nautica'),
            'section'   => 'wc_product_settings',
            'priority' => 1
        ) ) );

        //Show related product
        $wp_customize->add_setting('engo_theme_options[wc_show_related]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 0,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('engo_theme_options[wc_show_related]', array(
            'settings'  => 'engo_theme_options[wc_show_related]',
            'label'     => esc_html__('Disable show related product', 'nautica'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'priority' => 4
        ) );
         //Show upsells product
        $wp_customize->add_setting('engo_theme_options[wc_show_upsells]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 0,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('engo_theme_options[wc_show_upsells]', array(
            'settings'  => 'engo_theme_options[wc_show_upsells]',
            'label'     => esc_html__('Disable show upsells product', 'nautica'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'transport' => 3,
            'priority' => 5
        ) );

        //number of product per row 
        $wp_customize->add_setting( 'engo_theme_options[product-number-columns]', array(
            'type'       => 'option',
            'default'    => 3,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[product-number-columns]', array(
            'label'      => esc_html__( 'Number of Product Per Row', 'nautica' ),
            'section'    => 'wc_product_settings',
            'type'       => 'select',
            'choices'     => array(
                '2' => esc_html__('2 Items', 'nautica' ),
                '3' => esc_html__('3 Items', 'nautica' ),
                '4' => esc_html__('4 Items', 'nautica' ),
                '5' => esc_html__('5 Items', 'nautica' ),
                '6' => esc_html__('6 Items', 'nautica' )
            ),
            'priority' => 6
        ) );
        
        //Number of product to show 
        $wp_customize->add_setting( 'engo_theme_options[woo-number-product-single]', array(
            'type'       => 'option',
            'default'	 => 6,
            'capability' => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'engo_theme_options[woo-number-product-single]', array(
            'label'      => esc_html__( 'Number of Products to Show', 'nautica' ),
            'section'    => 'wc_product_settings',
            'priority' => 7
        ) );

         //Show Social share product
        $wp_customize->add_setting('engo_theme_options[wc_show_share_social]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control('engo_theme_options[wc_show_share_social]', array(
            'settings'  => 'engo_theme_options[wc_show_share_social]',
            'label'     => esc_html__('Show Social share product', 'nautica'),
            'section'   => 'wc_product_settings',
            'type'      => 'checkbox',
            'priority' => 8
        ) );
	}


    public function quickview(){
        $args = array(
                'post_type'=>'product',
                'product'=>$_GET['productslug']
            );
        $query = new WP_Query($args);
        if($query->have_posts()){
            while($query->have_posts()): $query->the_post(); global $product;
                if(is_file( get_template_directory().'/woocommerce/quickview.php')){
                    require( get_template_directory().'/woocommerce/quickview.php' );
                }
            endwhile;
        }

        wp_reset_query();
        wp_die();
    }

    public function quickviewModal(){
    ?>
    <div class="modal fade" id="engo-quickview-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body"><span class="spinner loading"></span></div>
                </div>
            </div>
        </div>

    <?php    
    }
}

new Nautica_Woocommerce();