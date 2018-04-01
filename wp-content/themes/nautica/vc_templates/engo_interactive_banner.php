<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img = wp_get_attachment_image_src($banner,'full');
$style = $style ? 'effect-'.$style:"";
$title_color = $title_color?'style="color:'. $title_color .';"' : "";
$banner_link_url = $link_url?$link_url:"#";
?>
<div class="interactive-banner  wpb_content_element vc_align_<?php echo $banner_alignment;?>  <?php echo esc_attr($style); ?> <?php echo esc_attr($el_class) ?> <?php echo esc_attr($title_align); ?>">
    <div class="interactive-banner-body">
        <a href="<?php echo esc_url($link_url); ?>"><img src="<?php echo esc_url_raw($img[0]);?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive"></a>
        <?php if( $title ) { ?>
            <div class="interactive-banner-profile text-center">
                <div class="banner-title">
                    <?php if( $subtitle ) { ?>
                        <small><?php echo esc_html($subtitle); ?></small>
                    <?php } ?>
                    <h2 <?php echo trim( $title_color); ?>><?php echo esc_attr($title); ?></h2>
                </div>
                <p class="action"><?php echo esc_html($information );?></p>
            </div>
        <?php } ?>
    </div>
</div>

