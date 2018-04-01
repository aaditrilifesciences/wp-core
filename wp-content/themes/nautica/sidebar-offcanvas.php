<div id="engo-off-canvas" class="engo-off-canvas sidebar-offcanvas hidden-lg hidden-md">
    <div class="engo-off-canvas-body">
        <div class="offcanvas-head bg-primary">
             <span><?php esc_html_e( 'Menu', 'nautica' ); ?></span>
        </div>
         <?php if( class_exists("Nautica_Megamenu_Offcanvas") ){ ?>
        <nav class="navbar navbar-offcanvas navbar-static" data-role="navigation">
            <?php
            $args = array(  'theme_location' => 'primary',
                            'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                            'menu_class' => 'nav navbar-nav',
                            'fallback_cb' => '',
                            'menu_id'         => 'main-menu-offcanvas',
                            'walker'          => new Nautica_Megamenu_Offcanvas()
            );
            wp_nav_menu($args);
            ?>
        </nav> <?php } ?>   
        
        <?php // dynamic_sidebar('offcanvas'); ?>

    </div>
</div>