<?php 
/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
function nautica_fnc_woocommerce_query($type,$post_per_page=-1,$cat=''){
    global $woocommerce, $wp_query;
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $orderby = (get_query_var('orderby')) ? get_query_var('orderby') : null;
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
        'paged' => $paged,
        'orderby'   => $orderby
    );

    if ( isset( $args['orderby'] ) ) {
        if ( 'price' == $args['orderby'] ) {
            $args = array_merge( $args, array(
                'meta_key'  => '_price',
                'orderby'   => 'meta_value_num'
            ) );
        }
        if ( 'featured' == $args['orderby'] ) {
            $args = array_merge( $args, array(
                'meta_key'  => '_featured',
                'orderby'   => 'meta_value'
            ) );
        }
        if ( 'sku' == $args['orderby'] ) {
            $args = array_merge( $args, array(
                'meta_key'  => '_sku',
                'orderby'   => 'meta_value'
            ) );
        }
    }

 

    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts']=1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = array(
                         'key' => '_featured',
                         'value' => 'yes'
                     );
            $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'top_rate':
            add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'recent_product':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            break;
        case 'deals': 
            
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['meta_query'][] =  array(
                
                array( // Variable products type
                    'key'           => '_sale_price_dates_to',
                    'value'         => time(),
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            );


            break;     
        case 'on_sale':
            $product_ids_on_sale    = wc_get_product_ids_on_sale();
            $product_ids_on_sale[]  = 0;
            $args['post__in'] = $product_ids_on_sale;
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC";
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                if(!in_array($re->comment_post_ID, $_pids))
                    $_pids[] = $re->comment_post_ID;
                if(count($_pids) == $_limit)
                    break;
            }

            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['post__in'] = $_pids;

            break;
    }

    if($cat!=''){
        $args['product_cat']= $cat;
    }
     return new WP_Query($args);
   
}

function nautica_fnc_get_review_counting(){

    global $post; 
    $output = array();

    for($i=1; $i <= 5; $i++){
         $args = array(
            'post_id'      => ( $post->ID ),
            'meta_query' => array(
              array(
                'key'   => 'rating',
                'value' => $i
              )
            ),      
            'count' => true
        );
        $output[$i] = get_comments( $args );
    }
    return $output;
}

function nautica_fnc_price( $price ){
    return $price;
}


function nautica_fnc_woocommerce_getcategorychilds( $parent_id, $pos, $array, $level, &$dropdown ) {

    for ( $i = $pos; $i < count( $array ); $i ++ ) {
        if ( isset($array[ $i ]) && $array[ $i ]->category_parent == $parent_id ) {
            $data = array(
                str_repeat( "- ", $level ) . $array[ $i ]->name . '('.  $array[ $i ]->term_id .')' => $array[ $i ]->slug,
            );
            $dropdown = array_merge( $dropdown, $data );
            nautica_fnc_woocommerce_getcategorychilds( $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
        }
    }
}


if ( ! function_exists( 'woocommerce_content' ) ) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     */
    function woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();
                $detail_template = nautica_fnc_product_template();
                if($detail_template) if(is_file( get_template_directory().'/inc/vendors/woocommerce/templates/single-templates/content-single-product-'.$detail_template.'.php')) {
                    get_template_part('inc/vendors/woocommerce/templates/single-templates/content-single-product-'.$detail_template);
                }
                else wc_get_template_part( 'content', 'single-product' );

            endwhile;

        } else { ?>

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php do_action('woocommerce_before_shop_loop'); ?>

                <div class="childrens">
                    <?php woocommerce_product_subcategories(); ?>  
                </div>

                <?php woocommerce_product_loop_start(); ?>

                   
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action('woocommerce_after_shop_loop'); ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;


        }
    }
}
