 <?php
  $post_category = "";
  $categories = get_the_category();
  $separator = ' ';
  $output = '';
  if($categories){
    foreach($categories as $category) {
      $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'nautica' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
    }
  $post_category = trim($output, $separator);
  }      
?>

  <article class="media post">
      <div class="media-left">
             <figure class="entry-thumb"> 
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="entry-image zoom-2">
                     <?php the_post_thumbnail('thumbnail');?>
                </a>
           </figure>
      </div>
      <div class="media-body">
        <div class="media-heading entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> </div>
        <div class="entry-meta-2">
           <span class="category'"><?php echo trim($post_category); ?></span> <span class="symbol"> . </span> <span> <?php the_time( 'M d, Y' ); ?> </span>
        </div>
      </div>
  </article>