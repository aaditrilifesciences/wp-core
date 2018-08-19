<?php

/**
 * Theme function
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme  Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			class Engotheme_WooBrands {

				/**
				 * Constructor
				 */
				public function __construct() {

					add_action( 'init', array( $this, 'create_taxonomies' ) );

				 

					/* Add form */
					add_action( 'wooproduct_brand_add_form_fields', array( $this, 'add_brands_fields' ) );
					add_action( 'wooproduct_brand_edit_form_fields', array( $this, 'edit_brands_fields' ), 10, 2 );
					add_action( 'created_term', array( $this, 'save_brands_fields' ), 10, 3 );
					add_action( 'edit_term', array( $this, 'save_brands_fields' ), 10, 3 );
				 
					/* Add columns */
					add_filter( 'manage_edit-wooproduct_brand_columns', array( $this, 'brands_columns' ) );
					add_filter( 'manage_wooproduct_brand_custom_column', array( $this, 'brands_column' ), 10, 3 );


					//add_action( 'woocommerce_single_product_summary', array( $this, 'single_product' ) , 9999 );
				}
			 
				/**
				 *
				 *
				 */
				public function create_taxonomies() {
			 	
					$labels = array(
						'name'              => __( 'Brands', 'engotheme' ),
						'singular_name'     => __( 'Brands', 'engotheme' ),
						'search_items'      => __( 'Search Genres', 'engotheme' ),
						'all_items'         => __( 'All Brands', 'engotheme' ),
						'parent_item'       => __( 'Parent Brands', 'engotheme'),
						'parent_item_colon' => __( 'Parent Brands:', 'engotheme' ),
						'edit_item'         => __( 'Edit Brands', 'engotheme'),
						'update_item'       => __( 'Update Brands', 'engotheme'),
						'add_new_item'      => __( 'Add New Brands', 'engotheme'),
						'new_item_name'     => __( 'New Brands Name', 'engotheme'),
						'menu_name'         => 'Brands',
					);
				
					$args =  array(
						     'hierarchical' => true,
						     'labels' => $labels,
						   	 'show_ui' => true,
				    		 'query_var' => true,
						     'rewrite' => array( 'slug' => 'brands', 'with_front' => true ),
						     'show_admin_column' => true
					     );
				 
					register_taxonomy( 'wooproduct_brand', array('product'), apply_filters( 'register_taxonomy_wooproduct_brand',$args ));	
				}  
			 
			 
				/**
				 *
				 *
				 */
				public function add_brands_fields() {
						$image="";
					?>
					<div class="">
						<label for="display_type"><?php _e( 'Featured', 'engotheme' ); ?></label>
			            <input type="checkbox" name="featured" />
					</div>

				 
					<div class="form-field">
						<label><?php _e( 'Thumbnail', 'woocommerce' ); ?></label>
						<div id="wooproduct_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
						<div style="line-height: 60px;">
							<input type="hidden" id="wooproduct_brand_thumbnail_id" name="wooproduct_brand_thumbnail_id" />
							<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
							<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
						</div>
						<script type="text/javascript">

							// Only show the "remove image" button when needed
							if ( ! jQuery( '#wooproduct_brand_thumbnail_id' ).val() ) {
								jQuery( '.remove_image_button' ).hide();
							}

							// Uploading files
							var file_frame;

							jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

								event.preventDefault();

								// If the media frame already exists, reopen it.
								if ( file_frame ) {
									file_frame.open();
									return;
								}

								// Create the media frame.
								file_frame = wp.media.frames.downloadable_file = wp.media({
									title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
									button: {
										text: '<?php _e( "Use image", "woocommerce" ); ?>'
									},
									multiple: false
								});

								// When an image is selected, run a callback.
								file_frame.on( 'select', function() {
									var attachment = file_frame.state().get( 'selection' ).first().toJSON();

									jQuery( '#wooproduct_brand_thumbnail_id' ).val( attachment.id );
									jQuery( '#wooproduct_brand_thumbnail img' ).attr( 'src', attachment.sizes.thumbnail.url );
									jQuery( '.remove_image_button' ).show();
								});

								// Finally, open the modal.
								file_frame.open();
							});

							jQuery( document ).on( 'click', '.remove_image_button', function() {
								jQuery( '#wooproduct_brand_thumbnail img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
								jQuery( '#wooproduct_brand_thumbnail_id' ).val( '' );
								jQuery( '.remove_image_button' ).hide();
								return false;
							});

						</script>
						<div class="clear"></div>
					</div>

					<?php
				}

				/**
				 *
				 *
				 */
				public function edit_brands_fields( $term, $taxonomy ) {
					$display_type	= get_woocommerce_term_meta( $term->term_id, 'featured', true );
					$image 			= '';
					$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
					if ( $thumbnail_id )
						$image = wp_get_attachment_thumb_url( $thumbnail_id );
					else
					{
						$image = wc_placeholder_img_src();	
					}
					?>
					<tr class="">
						<th scope="row" valign="top"><label><?php _e( 'Featured', 'engotheme' ); ?></label></th>
						<td>
				  			 <input type="checkbox" name="featured" <?php checked( $display_type, 1 ); ?>/>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'woocommerce' ); ?></label></th>
						<td>
							<div id="wooproduct_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
							<div style="line-height: 60px;">
								<input type="hidden" id="wooproduct_brand_thumbnail_id" name="wooproduct_brand_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
								<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
								<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
							</div>
							<script type="text/javascript">

								// Only show the "remove image" button when needed
								if ( '0' === jQuery( '#wooproduct_brand_thumbnail_id' ).val() ) {
									jQuery( '.remove_image_button' ).hide();
								}

								// Uploading files
								var file_frame;

								jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

									event.preventDefault();

									// If the media frame already exists, reopen it.
									if ( file_frame ) {
										file_frame.open();
										return;
									}

									// Create the media frame.
									file_frame = wp.media.frames.downloadable_file = wp.media({
										title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
										button: {
											text: '<?php _e( "Use image", "woocommerce" ); ?>'
										},
										multiple: false
									});

									// When an image is selected, run a callback.
									file_frame.on( 'select', function() {
										var attachment = file_frame.state().get( 'selection' ).first().toJSON();

										jQuery( '#wooproduct_brand_thumbnail_id' ).val( attachment.id );
										jQuery( '#wooproduct_brand_thumbnail img' ).attr( 'src', attachment.sizes.thumbnail.url );
										jQuery( '.remove_image_button' ).show();
									});

									// Finally, open the modal.
									file_frame.open();
								});

								jQuery( document ).on( 'click', '.remove_image_button', function() {
									jQuery( '#wooproduct_brand_thumbnail img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
									jQuery( '#wooproduct_brand_thumbnail_id' ).val( '' );
									jQuery( '.remove_image_button' ).hide();
									return false;
								});

							</script>
							<div class="clear"></div>
						</td>
					</tr>
					<?php
				}

				/**
				 *
				 *
				 */
				public function save_brands_fields( $term_id, $tt_id, $taxonomy ) {
					if ( isset( $_POST['featured'] ) ){

						update_woocommerce_term_meta( $term_id, 'featured', 1);
					}
					else{	
						update_woocommerce_term_meta( $term_id, 'featured', 0);
					}

					if ( isset( $_POST['wooproduct_brand_thumbnail_id'] ) && 'wooproduct_brand' === $taxonomy ) {
						update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['wooproduct_brand_thumbnail_id'] ) );
					}

					delete_transient( 'wc_term_counts' );
				}

				/**
				 *
				 *
				 */
				public function brands_columns( $columns ) {
						
					$new_columns          = array();
					$new_columns['cb']    = $columns['cb'];
					$new_columns['name'] =__('Name','engotheme');
					$new_columns['featured'] = __( 'featured', 'engotheme' );
					unset( $columns['cb'] );

					return array_merge( $new_columns, $columns );
					
				}

				/**
				 *
				 *
				 */
				public function brands_column( $columns, $column, $id ) {

					if( $column == "featured" ){

						$display_type = get_woocommerce_term_meta( $id, 'featured', true );
						if( $display_type == "1" ){
							$columns.= __( 'yes', 'engotheme');
						}	
						else {		
							$columns.= __( 'no', 'engotheme');
						}
					}
					return $columns;
				}


				public function single_product( $post ){
					global $post;
					$product_id = $post->ID;	
					$brands  =  wp_get_object_terms( $product_id, 'wooproduct_brand' );
					$output = '';
					if( count($brands) ){
						
						$output = '<div class="product-brand"><span>' .__( 'Brand: ', 'engotheme' ).'</span>';

						foreach( $brands as $brand ){

							$thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
							$image = $brand->name; 

							if ( $thumbnail_id ){
								$image = wp_get_attachment_thumb_url( $thumbnail_id );
								$image = '<img src="'.$image.'"/>';
							}	

							$output .= '<a href="'.get_term_link( $brand->slug, 'wooproduct_brand' ).'" title="'.esc_attr($brand->name).'">'.$image.'</a> ';
						}
						$output .= '</div>';	
					}

					echo $output;
				}
			}
			new Engotheme_WooBrands();
}
?>