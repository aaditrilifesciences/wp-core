<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(empty($loop)) return;
$grid_columns = 3; 

$this->getLoop($loop);
$args = $this->loop_args;
$colums = $grid_columns;
$bscol = floor( 12/$colums );
$id = rand();
?>
<?php wp_reset_query(); ?>
<section class="widget frontpage-posts section-blog widget-style layout-<?php echo esc_attr($layout); ?>  <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
    <?php
        if($title!=''){ ?>
            <h3 class="widget-title visual-title <?php echo esc_attr($size).' '.$alignment; ?>">
                <span><?php echo trim(esc_attr($title)); ?></span>
            </h3>
        <?php }
    ?>
    <div class="widget-content"> 

         <?php if( !isset($args['cat']) || empty($args['cat']) ){ ?>
         <?php esc_html_e( 'Please select category(ies) to show posts with tab style' , 'nautica' ); ?>
        <?php  } else {     $catids = explode( ",", $args['cat'] );  ?> 

        <div class="tab-v2 tabs-left">
            <ul class="nav nav-tabs nav-tabs-hover" role="tablist">
                <?php $i =0;  foreach( $catids as $catid ) { ?>
                <li <?php if($i++==0){ ?>class="active"<?php } ?>>
                    <a aria-expanded="false" href="#<?php echo $id.'-'.$catid; ?>" role="tab" data-toggle="tab"><i class="fa fa-heart"></i>  <?php echo get_cat_name( $catid ); ?>  </a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                            <?php  
                                $j=0;
                                foreach( $catids as $catid ) {
                                    $args['cat'] = $catid;
                                    $loop = new WP_Query( $args );
                            ?>  
                                <div class="posts-grid tab-pane<?php if($j++ == 0 ) { ?> active<?php } ?>" id="<?php echo trim($id.'-'.$catid); ?>">
                                    <?php
                                        $i =0; while($loop->have_posts()){  $loop->the_post(); ?>
                                         <?php $thumbsize = isset($thumbsize)? $thumbsize : 'thumbnail';?>

                                         <?php if(  $i++%$colums==0 ) {  ?>
                                        <div class="posts-grid"><div class="row">
                                        <?php } ?>
                                        <div class="col-sm-<?php echo esc_attr($bscol); ?>">
                                            <article class="post">
                                                <?php
                                                if ( has_post_thumbnail() ) {
                                                    ?>
                                                        <figure class="entry-thumb">
                                                            <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
                                                                <?php the_post_thumbnail( $thumbsize );?>
                                                            </a>
                                                            <!-- vote    -->
                                                            <?php do_action('nautica_fnc_rating') ?>
                                                        </figure>
                                                    <?php
                                                }
                                                ?>
                                                <div class="entry-content">
                                                   
                                                    <?php if (get_the_title()) { ?>
                                                        <h4 class="entry-title entry-title-sm">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h4>
                                                    <?php  } ?>
                                                </div>
                                            </article>
                                        </div>
                                        <?php if(  ($i%$colums==0) || $i == $loop->post_count) {  ?>
                                        </div></div>
                                        <?php } ?>
                                    <?php   }  ?>
                                </div>
                                <?php wp_reset_query(); ?>
                            <?php } ?>
            </div>
        </div>    
 
        <?php } ?>    
    </div>
    
</section>
