<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Cta
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->buildTemplate( $atts, $content );

$template = $atts['cta_templates']?"engo-".$atts['cta_templates']:"";
$img = wp_get_attachment_image_src($atts['photo'],'full');
$cta_photo_position = $atts['cta_photo_position'];
$photo_align_top = $photo_align_bottom = $photo_align_left = $photo_align_right = '';
if($img[0]) {
	if(!$cta_photo_position) {
		$single_image = "<div class='cta-photo'><img src='".$img[0]."' /></div>";
	} else {
		$single_image = '';
		$photo_align_top = ($cta_photo_position == 'top')?"<div class='cta-photo' style='margin-bottom: 10px;'><img src='".$img[0]."' /></div>":'';
		$photo_align_bottom = ($cta_photo_position == 'bottom')?"<div class='cta-photo' style='margin-top: 10px;'><img src='".$img[0]."' /></div>":'';
		$photo_align_left = ($cta_photo_position == 'left')?"<div class='cta-photo' style='float:left; margin-right: 10px;'><img src='".$img[0]."' /></div>":'';
		$photo_align_right = ($cta_photo_position == 'right')?"<div class='cta-photo' style='float:right; margin-left: 10px;'><img src='".$img[0]."' /></div>":'';;
	}
}

?>
<section
	class="engo-calltoaction vc_cta3-container <?php echo $template; ?> <?php echo esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ); ?>">
	<div class="vc_general <?php echo esc_attr( implode( ' ', $this->getTemplateVariable( 'css-class' ) ) ); ?>"<?php
	if ( $this->getTemplateVariable( 'inline-css' ) ) {
		echo ' style="' . esc_attr( implode( ' ', $this->getTemplateVariable( 'inline-css' ) ) ) . '"';
	}
	?>>
		<?php echo $this->getTemplateVariable( 'icons-top' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-left' ); ?>
		<?php echo $single_image;?>
		<?php echo $photo_align_top;?>
		<?php echo $photo_align_left;?>
		<?php echo $photo_align_right;?>
		<div class="vc_cta3_content-container">
			<?php echo $this->getTemplateVariable( 'actions-top' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-left' ); ?>
			<div class="vc_cta3-content">
				<header class="vc_cta3-content-header">
					<?php echo $this->getTemplateVariable( 'heading2' ); ?>
					<?php echo $this->getTemplateVariable( 'heading1' ); ?>
				</header>
				<div class="cta-cont">
					<?php echo $this->getTemplateVariable( 'content' ); ?>
				</div>
			</div>
			<?php echo $this->getTemplateVariable( 'actions-bottom' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-right' ); ?>
		</div>
		<?php echo $this->getTemplateVariable( 'icons-bottom' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-right' ); ?>
		<?php echo $photo_align_bottom;?>
	</div>
</section><?php echo $this->endBlockComment( $this->getShortcode() ); ?>

