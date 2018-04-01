<div class="testimonials-body">
    <div class="testimonials-avatar radius-x">
        <a href="#"><?php the_post_thumbnail('widget', '', 'class="radius-x"');?></a>
    </div>
    <div class="testimonials-description"><?php the_content() ?></div>
    <div class="testimonials-meta">
        <h5 class="testimonials-name">
             <?php the_title(); ?>
        </h5>  
        <div class="job"><?php the_excerpt(); ?></div>
    </div>
</div>