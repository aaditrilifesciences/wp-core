<?php

/**
 * Created by PhpStorm.
 * User: ManhTienpt
 * Date: 1/29/2016
 * Time: 2:22 PM
 */
class Nautica_Mailchimp
{
    public function __construct()
    {
        add_action( 'customize_register',  array( $this, 'registerCustomizer' ),9);
        if(nautica_fnc_theme_options('has_mailchimp_popup') && !isset($_COOKIE["checkCookiesMailChimpPopup"]) && !isset($_COOKIE['MailChimpPopup_has_viewed'])) {
            add_action('wp_footer', array($this,'nautica_fnc_newsletter_popup'));
            add_action( 'wp_enqueue_scripts', array( $this, 'loadThemeAssets' ), 15 );
        }
    }
    public function loadThemeAssets() {
        $path =  get_template_directory_uri() .'/inc/vendors/mailchimp/assets/';
        wp_enqueue_style( 'engo-mailchimp-popup-css', $path.'mailchimp_popup.css' , 'engo-front' , NAUTICA_THEME_VERSION, 'all' );
        wp_enqueue_script( 'engo-jquery-cookies-script', $path.'jquery.cookie.js', array( 'jquery' ), '20160129', true );
        wp_enqueue_script( 'engo-mailchimp-popup-script', $path.'mailchimp_popup.js', array( 'jquery' ), '20160129', true );
        wp_localize_script( 'engo-mailchimp-popup-script', 'engo_this_domain', $_SERVER['SERVER_NAME']);
    }
    public function nautica_fnc_popup() {
        echo do_shortcode("[mc4wp_form]");
    }
    public function registerCustomizer($wp_customize) {
        $wp_customize->add_setting('engo_theme_options[has_mailchimp_popup]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('engo_theme_options[has_mailchimp_popup]', array(
            'settings'  => 'engo_theme_options[has_mailchimp_popup]',
            'label'     => esc_html__('Show Mailchimp popup', 'nautica'),
            'section'   => 'social_share_settings',
            'type'      => 'checkbox',
            'transport' => 4,
        ) );

    }
    public function nautica_fnc_newsletter_popup(){
        ?>
        <div class="modal fade" id="engo-newsletter-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content mailchimp-modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body mailchimp-modal-body">
                        <h4 class="popup-title">Newsletter</h4>
                        <div class="popup-des">
                            <?php printf(esc_html__('Subscribe to the %s mailing list to receive updates on new arrivals, special offers and other discount information.','nautica'), get_bloginfo('name')); ?>
                        </div>
                        <?php
                           $this->nautica_fnc_popup();
                        ?>
                        <div class="setting-popup">
                            <a class="mailchimp_popup_setting" id="mailchimp_popup_setting" href="javascript://"><i class="fa"></i> <?php esc_html_e("Don't show this popup again", 'nautica')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
new Nautica_Mailchimp();