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

<article class="media post post-single-v4">
  <div class="image">
      <figure class="entry-thumb"> 
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="entry-image zoom-2">
          <?php the_post_thumbnail('thumbnail');?>
        </a>
      </figure>
      <div class="category-highlight hidden">
        <?php echo trim($post_category); ?>
      </div>
  </div>

  <div class="post-body">
    <div class="entry-category">
        <?php echo trim($post_category); ?>
    </div>
    <div class="media-heading entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> </div>
  </div>
</article>