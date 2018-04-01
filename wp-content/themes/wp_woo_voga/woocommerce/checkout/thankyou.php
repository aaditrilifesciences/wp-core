<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="bold"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'wpdance' ); ?></p>

		<p class="bold"><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'wpdance' );
			else
				_e( 'Please attempt your purchase again.', 'wpdance' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'wpdance' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'wpdance' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p class="bold thankyou_desc"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Your order has been received, thank you for your purchase!', 'wpdance' ), $order ); ?></p>

		<ul class="order_details">
			<li class="image_thankyou"><img title="<?php _e('order received','wpdance') ?>" alt="<?php _e('order received','wpdance') ?>" src="<?php echo get_template_directory_uri().'/images/bg-order-received.png' ?>" /></li>
			<li class="order">
				<span><?php _e( 'Your order number is :', 'wpdance' ); ?></span>
				<span class="bold"><?php echo $order->get_order_number(); ?></span>
			</li>
			<li class="date">
				<span><?php _e( 'Date:', 'wpdance' ); ?></span>
				<span class="bold"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></span>
			</li>
			<li class="total">
				<span><?php _e( 'Total:', 'wpdance' ); ?></span>
				<span class="bold"><?php echo $order->get_formatted_order_total(); ?></span>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<span><?php _e( 'Payment method:', 'wpdance' ); ?></span>
				<span class="bold"><?php echo $order->payment_method_title; ?></span>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<!--  Custom Detail -->

<?php 
$order_email = $order->billing_email;
$first_name = $order->billing_first_name;
$last_name = $order->billing_last_name;
$street1 = $order->billing_address_1;
$street2 = $order->billing_address_2;
$city = $order->billing_city;
$country = $order->billing_country;
$state = $order->billing_state;
$phone = $order->billing_phone;
$company = $order->billing_company;
$postcode = $order->billing_postcode;
$order_id = $order->get_order_number();

$orderCheck = wc_get_order( $order_id );
$variationProduct = 0;
foreach($orderCheck->get_items() as $item)
{
if ($item['variation_id']) { $variationProduct = 1;}
}	

if($variationProduct == 0):
?>
<?php $page_title = apply_filters( 'woocommerce_find_tilors_title', __( 'Get in touch with nearby Tailors', 'wpdance' ) );?>
<div class="wd_findtailors">
	<header class="title-wrapper"><h3 class="heading-title"><?php echo $page_title; ?></h3></header>
</div>

<div class='measurement_workspace' style='width:100%; float:left'>
	<div class='customer_all_measurement' id='customer_all_measurement'>
		<button class='button' id='all_measurement_button' onclick='getallmeasurement("<?php echo $order_email?>")'>Get All Previous Measurement</button>
		<img id="ajax_loader_all" src="<?php echo admin_url('images/loading.gif'); ?>" style="display:none;">
		
	
	</div>
	<div class="find_tailor_container" id="find_tailor_container">
		<button class='button' id='find_tailor_button'>Find Tailor</button>
		<img id="ajax_loader" src="<?php echo admin_url('images/loading.gif'); ?>" style="display:none;">
		
		<div id='nearby_tailors'>
		</div>
		
	</div>
</div>
<?php endif;?>
	
	<!--  End of Custom Detail -->
	
	
	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __('Thank you. Your order has been received.', 'wpdance'), null ); ?></p>

<?php endif; ?>

<script type='text/javascript'>
jQuery(document).ready(function(){
	//alert('787');
	jQuery('#find_tailor_button').click(function(){
		
		jQuery('#ajax_loader').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'post_type_search_callback',
				order_email: '<?php echo $order_email?>',
				first_name: '<?php echo $first_name?>',
				last_name: '<?php echo $last_name?>',
				street1: '<?php echo $street1?>',
				street2: '<?php echo $street2?>',
				city: '<?php echo $city?>',
				country: '<?php echo $country?>',
				state: '<?php echo $state?>',
				phone: '<?php echo $phone?>',
				company: '<?php echo $company?>',
				postcode: '<?php echo $postcode?>',
				order_id: '<?php echo $order_id?>'		// enter in anyname here instead of variable, you will need to catch this value using $_POST['variable'] in your php function.
			},
			success: function (output) {
				jQuery('#find_tailor_button').hide();
				jQuery('#ajax_loader').hide();
				
				jQuery('#nearby_tailors').html(output);
				//jQuery('#myModal').modal('show');
				
			   
			}
		});
	});
	
});

function assign(id)
{
	//alert('assign');
		jQuery('#ajax_loader_'+id).show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'assign_tailor',
				id: id,
				order_id:'<?php echo $order->id?>',
				url:'<?php echo get_home_url().'/orderComplete.php'?>',
				email: '<?php echo $order_email ?>'	// enter in anyname here instead of variable, you will need to catch this value using $_POST['variable'] in your php function.
			},
			success: function (output) {
				jQuery('#ajax_loader_'+id).hide();
				//alert(output);
				//alert(output);
				jQuery('#tailor_'+id).html(output);
				//jQuery('#myModal-1').show();
				//jQuery('.modal-body-1').html(output);
				//jQuery('#myModal').modal('show');
				
			   
			}
		});
	
}




function getallmeasurement(email)
{
		jQuery('#ajax_loader_all').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'get_all_measurement',
				email: email // enter in anyname here instead of variable, you will need to catch this value using $_POST['variable'] in your php function.
			},
			success: function (output) {
				jQuery('#ajax_loader_all').hide();
				jQuery('#customer_all_measurement').html(output);

			}
		});
	
}


function satisfy()
{
		jQuery('#ajax_loader_satisfy').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'customer_satisfy',
				order_id: <?php echo $order->get_order_number(); ?>// enter in anyname here instead of variable, you will need to catch this value using $_POST['variable'] in your php function.
			},
			success: function (output) {
				jQuery('#ajax_loader_satisfy').hide();
				jQuery('#customer_all_measurement').html(output);
				
			   
			}
		});
	
}



function notsatisfy()
{
		jQuery('#ajax_loader_notsatisfy').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'customer_notsatisfy', // enter in anyname here instead of variable, you will need to catch this value using $_POST['variable'] in your php function.
			},
			success: function (output) {
				jQuery('#ajax_loader_notsatisfy').hide();
				jQuery('#customer_all_measurement').html(output);
				
			   
			}
		});
	
}

</script>

<head>
  <title>Nearby Tailors</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<div class="container">
<div id="myModal-1" class="modal-1" role="dialog" style='display:none'>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-1">
      <div class="modal-header-1">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title-1">Modal Header</h4>
      </div>
      <div class="modal-body-1">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer-1">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>

  </div>
</div>
