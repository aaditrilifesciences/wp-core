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

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( $term_id && !empty($term_id) ){ 
    $term = get_term_by( 'slug', $term_id, 'product_cat' );
    if( empty($term) ){ return ; }
    $term_id = $term->term_id; 
    $args = array(
              'taxonomy'     => 'product_cat',
              'child_of'     => 0,
              'parent'       => $term_id,
              'number'       => $number,
            );
    $sub_cats = get_categories( $args );
    if( $image_cat && !empty( $image_cat ))
        $image = wp_get_attachment_image_src( $image_cat, 'postthumb-grid');
    else {
        $thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_image_src( $thumbnail_id, 'postthumb-grid');
    }

?>
<?php if($term):
     $category_link = get_term_link( $term->term_id, 'product_cat' );
 ?>
    <div class="widget <?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
        <div class="widget-content">
            <div class=" engo-category-filter">
                <h4 class="category-filter-title">
                        <span><?php echo trim($term->name); ?></span>
                </h4>
                 <small><?php echo trim($term->count); ?> <?php esc_html_e( 'Products', 'woocommerce' );?></small>

                <div class="category-filter-content">
                    <div class="filter-head">
                         <h4 class="category-filter-title">
                        <span><?php echo trim($term->name); ?></span>
                        </h4>
                         <small><?php echo trim($term->count); ?> <?php esc_html_e( 'Products' ,'woocommerce');?></small>
                    </div>     

                    <?php
                    if( $sub_cats && !empty($sub_cats)) { ?>
                        <ul class="list-unstyled category-filter-list">
                            <?php
                                foreach( $sub_cats as $cat){
                                    $sub_link = get_term_link( $cat->slug, 'product_cat');
                                    $cat_name = $cat->name ;// .' ('. $cat->count .')';
                                ?>
                                <li class="category-filter-list-item">
                                    <a href="<?php echo esc_url( $sub_link ); ?>">
                                        <?php echo trim( $cat_name ); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <div class="category-filter-link">
                        <a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo esc_html__( 'more', 'nautica'); ?>" class=""><?php echo esc_html__( '+ more...', 'nautica' ); ?></a>
                    </div>
                </div>

                <?php if( $image ) { ?>
                    <div class="category-image">
                        <img src="<?php echo esc_url_raw( $image[0] ); ?>" title="<?php echo esc_attr($term->name); ?>" style="max-width: 100%" alt="">
                    </div>
                <?php } ?>




        </div>
        </div>
    </div>
<?php endif; ?>
<?php } ?>    
