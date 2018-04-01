<section id="engo-topbar" class="engo-topbar">
	<div class="container"><div class="inner">
        <div class="pull-left hidden-lg hidden-md">
            <div class="btn-toggle-menu" data-toggle="offcanvas">
                <div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
            </div>
        </div>
        <div class="user-login pull-right">
            <ul class="list-inline">
                <?php if( !is_user_logged_in() ){ ?>
                    <?php //do_action('nautica-account-buttons'); ?>
                <?php }else{ ?>
                    <?php $current_user = wp_get_current_user(); ?>
                  <li>  <span class="hidden-xs"><?php echo esc_html__('Welcome ', 'nautica'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
                <?php } ?>
            </ul>                 
        </div>
        <div class="pull-left">
            <?php 
                 // WPML - Custom Languages Menu
            	nautica_fnc_wpml_language_buttons();
            ?>
            <?php if(has_nav_menu( 'topmenu' )): ?>
 
            <nav class="engo-topmenu" data-role="navigation">
                <?php
                    $args = array(
                        'theme_location'  => 'topmenu',
                        'menu_class'      => 'engo-menu-top list-inline list-square',
                        'fallback_cb'     => '',
                        'menu_id'         => 'main-topmenu'
                    );
                    wp_nav_menu($args);
                ?>
            </nav>
   
            <?php endif; ?>                            
        </div>
	</div></div>	
</section>