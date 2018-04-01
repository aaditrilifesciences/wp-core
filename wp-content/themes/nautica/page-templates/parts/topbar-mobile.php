<div class="topbar-mobile  hidden-lg hidden-md">
    <nav class="navbar navbar-offcanvas">
            <div class="offcanvas-inner">
                <ul class="list-action nav nav-pills bg-success">
                   
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                           <span class="fa fa-search"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <div class="active-content">
                                <?php get_search_form(); ?>
                            </div>
                          </li>
                        </ul>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                          <span class="fa fa-user"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <div class="active-content">
                               <?php if(has_nav_menu( 'topmenu' )){ ?>
                                    <div class="pull-left">
                                        <?php
                                            $args = array(
                                                'theme_location'  => 'topmenu',
                                                'container_class' => '',
                                                'menu_class'      => 'menu-topbar'
                                            );
                                            wp_nav_menu($args);
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                          </li>
                        </ul>
                    </li>
                    <li role="presentation" class="dropdown mini-cart">
                          <div class="minibasket mini-basket-v2 dropdown">
                            <a class="dropdown-toggle mini-cart-button" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'nautica'); ?>">
                                <span class="text-skin cart-icon radius-6x">
                                    <i class="fa fa-shopping-cart"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                </ul>  
            </div>
    </nav>        
</div>