<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();


$layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

switch($layout) {
    case "news_grid":
        $view_mode = "grid";
        break;
    case "news_list":
        $view_mode = "list";
        break;
    case "news_masonry":
        $view_mode = "masonry";
        break;
    default:
        $view_mode = "grid";
        break;

}


$column_class = $view_mode."-".$grid_columns;
$classes[] = $view_mode.'-item';
$columns = 12/$grid_columns;
$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' col-xs-12';
$classes[] = $thumbnai_position;

$post_per_pages = isset($post_per_page)?$post_per_page:10;

if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

if(is_front_page()){
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
else{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$args['paged'] = $paged;
$posts_per_page = $args['posts_per_page'];

$loop = new WP_Query($args);

?>

    <section class="widget  widget-style frontpage-blog section-blog layout-<?php echo esc_attr($layout); ?>  <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
        <?php
        if($title!=''){ ?>
            <h3 class="widget-title visual-title <?php echo esc_attr($size).' '.$alignment; ?>">
                <span><?php echo trim(esc_attr($title)); ?></span>
            </h3>
        <?php }
        ?>
        <div class="widget-content">
            <?php
            /**
             * $loop
             * $class_column
             *
             */

            $_count =1;

            $colums = '3';
            $bscol = floor( 12/$colums );
            $end = $loop->post_count;

            ?>
            <div class="site-content row view-mode <?php echo $view_mode;?> <?php echo $column_class;?>">
                <?php
                $i = 0;
                while($loop->have_posts()){
                    $loop->the_post();
                    ?>
                    <div <?php post_class( $classes ); ?>>
                        <?php
                        if(get_post_format()) {
                            nautica_fnc_get_template('content-'.get_post_format().".php", array("post_thumbnail" => $thumbsize));
                        } else {
                            nautica_fnc_get_template('content.php', array("post_thumbnail" => $thumbsize));
                        }
                        ?>
                    </div>
                <?php
                    }
                ?>
            </div>

        </div>
        <?php if( isset($show_pagination) && $show_pagination ): ?>
            <div class="w-pagination"><?php nautica_fnc_pagination_nav( $post_per_pages,$loop->found_posts,$loop->max_num_pages ); ?></div>
        <?php endif ; ?>
    </section>
<?php wp_reset_query(); ?>