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
 <article class="post">
    <h4 class="entry-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h4>
    <p class="entry-description hidden"><?php echo nautica_fnc_excerpt(25,'...');; ?></p>
    <div class="entry-meta-2">
        <span class="category'"><?php echo trim($post_category); ?></span> <span class="symbol"> . </span> <span> <?php the_time( 'M d, Y' ); ?> </span>
     </div>
</article>