<?php
/**
 * @package WordPress
 * @subpackage Voga
 * @since voga
 **/
$_template_path = get_template_directory();
require_once $_template_path."/framework/abstract.php";
$theme = new WdTheme(array(
	'theme_name'	=>	"Voga",
	'theme_slug'	=>	'voga'
));
$theme->init();
require_once ('admin/index.php');
?>
<?php
 global $product;
	$apiUrl = 'http://clothchronicles.com/index.php/api/soap/?wsdl';
 //$apiUrl = 'http://localhost/demo/magento/index.php/api/soap/?wsdl';
 $soapApiKey = 'medma1234';
 $soapUserName = 'apiuser';
add_action( 'woocommerce_order_status_completed', 'my_function' );
/*
 * Do something after WooCommerce sets an order on completed
 */
function my_function($order_id) {
	

	//echo 'hiii'.$order_id;
	//echo '<pre>';
	$order = new WC_Order( $order_id );
	//$items = $order->get_items();
	/*$product = array();
	$product[]
	*/
	
	foreach($order->get_items() as $item)
{                

 $product_variation_id = $item['variation_id'];
  // Check if product has variation.
  if ($product_variation_id) { 
    $product = new WC_Product($item['variation_id']);
    $json[$product->get_sku()] = array (
        'variation' => '1',
		'color' => get_post_meta($item['variation_id'], 'attribute_pa_color', true),
        'size' => get_post_meta($item['variation_id'], 'attribute_pa_size', true), // Here appear the name of the product
        'qty' => $item['qty'], // here the quantity of the product
   );
  } else {
    $product = new WC_Product($item['product_id']);
   $json[$product->get_sku()] = array (
		'variation' => '0',
		'color' => 'BLACK',
        'size' => 'XL', // Here appear the name of the product
        'qty' => $item['qty'], // here the quantity of the product
   );
  }

  // Get SKU
 // $sku = $product->get_sku();
   
}
	
	/*echo '<pre>';
	print_r($json);
	exit;
	*/
	/*foreach ( $items as $item ) {
		  $product[] = $item['product_id'];
		  $product_name = $item['name'];
			// $product_variation_id = $item['variation_id'];
		  // etc
	}
	*/
	
	
	$arr = array();
	$arr['orderarr']['customer_info']['email']=$order->billing_email;
	$arr['orderarr']['customer_info']['firstname']= $order->billing_first_name;
	$arr['orderarr']['customer_info']['lastname']=$order->billing_last_name;
	$arr['orderarr']['customer_address']['street'] = array('0'=>$order->billing_address_1,'1'=>$order->billing_address_2);
	$arr['orderarr']['customer_address']['city'] = $order->billing_city;
	$arr['orderarr']['customer_address']['country'] = ' ';
	$arr['orderarr']['customer_address']['country_id'] = $order->billing_country;
	$arr['orderarr']['customer_address']['region'] = '';
	$arr['orderarr']['customer_address']['region_id']=$order->billing_state;
	$arr['orderarr']['customer_address']['telephone'] = $order->billing_phone;
	$arr['orderarr']['customer_address']['fax'] = ' ';
	$arr['orderarr']['customer_address']['company'] = $order->billing_company;
	$arr['orderarr']['customer_address']['postcode'] = $order->billing_postcode;
	$arr['orderarr']['customer_address']['payment_method'] = $order->payment_method;
	$arr['orderarr']['product_id'] = $json;
	
	
	//echo '<pre>---/*/*/*';
	//print_r($arr);
	//exit;
	ini_set("soap.wsdl_cache_enabled", "0");
	$soap_user = $GLOBALS['soapUserName']; // Soap User
	$soap_key = $GLOBALS['soapApiKey']; // Soap key.
	$usermail = 'corp@medma.in';
	$proxy = new SoapClient($GLOBALS['apiUrl']);
	echo $sessionId = $proxy->login($soap_user, $soap_key);
	$collection = $proxy->call($sessionId, 'sales_order.createordercustom', $arr);
	print_r($collection);		
			
	
	
	exit;
	
	/*
	$billing_address = $order->billing_first_name();
	$billing_address = $order->billing_last_name();
	$billing_address = $order->billing_email();
	$billing_address = $order->billing_address_1();
	$billing_address = $order->billing_address_2();
	$billing_address = $order->billing_city();
	$billing_address = $order->billing_state();
	$billing_address = $order->billing_postcode();
	$billing_address = $order->billing_phone();
	*/
	//$items = $order->get_items();
/*	foreach ( $items as $item ) {
  $product_id = $item['product_id'];
  $product_name = $item['name'];
  $product_variation_id = $item['variation_id'];
  // etc
}*/
	/*print_r($billing_address);
	print_r($order->billing_first_name);
	
	echo '---';
	echo $user_id = get_post_meta( $order_id, '_customer_user', true );
	*/exit;
	// order object (optional but handy)
//	$order = new WC_Order( $order_id );

	// do some stuff here
	
}

add_action('wp_ajax_post_type_search_callback', 'getnearbycustomer');
//for not logged in users
add_action('wp_ajax_nopriv_post_type_search_callback', 'getnearbycustomer');

function getnearbycustomer() {
    $order_email= $_POST['order_email'];
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $street1= $_POST['street1'];
    $street2= $_POST['street2'];
    $city= $_POST['city'];
    $country= $_POST['country'];
    $state= $_POST['state'];
    $phone= $_POST['phone'];
    $company= $_POST['company'];
    $postcode= $_POST['postcode'];
    $order_id= $_POST['order_id'];
	$order = new WC_Order( $order_id );
		foreach($order->get_items() as $item)
		{                
		 $product_variation_id = $item['variation_id'];

		  // Check if product has variation.
		  if ($product_variation_id) { 
			$product = new WC_Product($item['variation_id']);
		  } else {
			$product = new WC_Product($item['product_id']);
		  }
		   $json[$product->get_sku()] = array (
				'color' => 'Black',
				'size' => 'XL', // Here appear the name of the product
				'qty' => $item['qty'], // here the quantity of the product
		   );
		}
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			$email = 'test321@gmail.com';
			
			
			$arr = array();
			$arr['orderarr']['customer_info']['email']= $order_email;//'test321@gmail.com';
			$arr['orderarr']['customer_info']['firstname']=$first_name;//'shshank';
			$arr['orderarr']['customer_info']['lastname']=$last_name;//'mishra';
			$arr['orderarr']['customer_address']['street'] = array('0'=>$street1,'1'=> $street2);
			$arr['orderarr']['customer_address']['city'] = $city;//'lucknow';
			$arr['orderarr']['customer_address']['country'] = ' ';// 'Canada';
			$arr['orderarr']['customer_address']['country_id'] = $country;
			$arr['orderarr']['customer_address']['region'] = ' ';
			$arr['orderarr']['customer_address']['region_id']= $state; //'region id';
			$arr['orderarr']['customer_address']['telephone'] = $phone;//'123456789';
			$arr['orderarr']['customer_address']['fax'] = '123456';//'456789';
			$arr['orderarr']['customer_address']['company'] = $company;
			$arr['orderarr']['customer_address']['postcode'] = $postcode;
			$arr['orderarr']['product_id'] = $json;

			/*echo '<pre>';
			print_r($arr);
			exit;*/
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.getNearByTailor',$arr);			
			foreach($collection as $key=>$val)
			{
				$tailor_id = $key;
				$tailor_name = $val['name'];
				$tailor_company = $val['company'];
				$tailor_address = $val['street'].'</br>'.$val['city'].', '.$val['postcode'].' '.$val['region'];
				$tailor_distance = $val['distance'];
				
				
				echo '<div class="tailor_detail" id="tailor_'.$tailor_id.'">
						<div class="tailor_info_set">
							<div class="tailor_label">Tailor Name: </div>
							<div class="tailor_name tailor_info">'.$tailor_name.'</div>
						</div>
						<div class="tailor_info_set">
							<div class="tailor_label">Company : </div>
							<div class="tailor_company tailor_info">'.$tailor_company.'</div>
						</div>
						<div class="tailor_info_set">
							<div class="tailor_label">Address: </div>
							<div class="tailor_address tailor_info">'.$tailor_address.'</div>
						</div>
						<div class="tailor_info_set">	
							<div class="tailor_label">Distance: </div>
							<div class="tailor_distance tailor_info">'.$tailor_distance.'</div>
						</div>
						<div class="tailor_info_set">	
							<button class="button" id="assign_button_'.$tailor_id.'" onclick="assign('.$tailor_id.')">Select</button>
							<img id="ajax_loader_'.$tailor_id.'" src="'.admin_url("images/loading.gif").'" style="display:none;">
						</div>
						<div class="assign_tailor_msg" id="assign_tailor_msg_'.$tailor_id.'">
						</div>
					</div>';
			}
exit();
}



add_action('wp_ajax_assign_tailor', 'assigntailor');
//for not logged in users
add_action('wp_ajax_nopriv_assign_tailor', 'assigntailor');

function assigntailor() {
    $id= $_POST['id'];
    $email= $_POST['email'];
    $order_id= $_POST['order_id'];
    $url= $_POST['url'];
	
	
			$soap_user =$GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			//$email = 'test321@gmail.com';
			$data = array();
			$data['info']['email'] = $email;
			$data['info']['tailor_id'] = $id;
			$data['info']['order_id'] = $order_id;
			$data['info']['url'] = $url;

			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.assignCustomer',$data);			
				
	echo $collection;
exit();
}





add_action('wp_ajax_check_measured', 'checkmeasured');
//for not logged in users
add_action('wp_ajax_nopriv_check_measured', 'checkmeasured');

function checkmeasured() {
   // $data= $_POST['variable'];
    $email= $_POST['email'];
	
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			$email = $email;//'test321@gmail.com';
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.checkCustomerMeasured',$email);
				
	echo $collection;
//print_r($collection) ;
   // $output= 'i was returned with ajax';
    //need to echo output and exit here
	//echo '<pre>';
//print_r($collection) ;
exit();
}




add_action('wp_ajax_get_all_measurement', 'getallmeasurement');
//for not logged in users
add_action('wp_ajax_nopriv_get_all_measurement', 'getallmeasurement');

function getallmeasurement() {
    $email= $_POST['email'];
	
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			//$email = 'test321@gmail.com';
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.checkCustomerMeasured',$email);
			//~ echo '---<pre>';
			//~ print_r($collection);
			//~ exit;
			//~ if(is_array($collection))
			if($collection)
			{
					$all_measurement = $proxy->call($sessionId, 'sales_order.getCustomerMeasurementsAllCategories',$email);
				/*	echo '<pre>';
						print_r($all_measurement);
					echo '</pre>';
					*/foreach($all_measurement as $key=> $val)
					{
						//echo '//'.$key;
						//exit;
						if($key =='garment_measurements')
						{
							$heading = 'Garment Measurement Detail';
							echo '<div class="garment_measurements_detail">';
							echo '<p><strong><u>'.$heading.'</u></strong></p>';
							
							foreach($val as $key1=> $val1)
							{
								echo '<p><strong>Category : '.$key1.'</strong></p>';
								foreach($val1 as $key2=> $val2)
								{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$val2["name"].'
											</div>
											<div class="measurement_value">
												'.$val2["value"].'
											</div>
										</div>';
								}
							}
							echo '</div>';
						}else if($key == 'body_measurements')
						{
							$heading = 'Body Measurement Detail';
							
							echo '<div class="body_measurements_detail">';
							echo '<p><strong><u>'.$heading.'</u></strong></p>';
							
							foreach($val as $key1=> $val1)
							{
								if(is_array($val1))
								{
								echo '<p><strong>'.$key1.'</strong></p>';
								
									foreach($val1 as $key2=> $val2)
									{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$key2.'
											</div>
											<div class="measurement_value">
												'.$val2.'
											</div>
										</div>';
									}	
								}else
								{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$key1.'
											</div>
											<div class="measurement_value">
												'.$val1.'
											</div>
										</div>';
								}
							}
							echo '</div>';
							
						}
					}
					
					echo '<div id="confirm_button_group"><button class="button satisfy" onclick="satisfy()">Satisfy</button>
							<img id="ajax_loader_satisfy" src="'.admin_url('images/loading.gif').'" style="display:none;">
							
							<button class="button notsatisfy" onclick="notsatisfy()">Not Satisfy</button>
							<img id="ajax_loader_notsatisfy" src="'.admin_url('images/loading.gif').'" style="display:none;"></div>';
					
					
		
			
			}else
			{
				echo 'You have no measurement yet. Please click on Find Tailor button to get measured.';
			}
	
exit();
}


add_action('wp_ajax_customer_satisfy', 'satisfy');
//for not logged in users
add_action('wp_ajax_nopriv_customer_satisfy', 'satisfy');

function satisfy() {
   // $data= $_POST['variable'];
    $order_id= $_POST['order_id'];
	$order = new WC_Order($order_id);
	if (!empty($order)) {
		$order->update_status( 'completed' );
		echo 'Your order has been completed';
	}else{
		echo 'There is some error...';
	}
exit();
}

add_action('wp_ajax_customer_notsatisfy', 'notsatisfy');
//for not logged in users
add_action('wp_ajax_nopriv_customer_notsatisfy', 'notsatisfy');

function notsatisfy() {
	
	echo 'Please click on Find Tailor button and choose your favourite tailor for measurement.';
	exit();
}


add_action('wp_ajax_import_product', 'importproduct');
//for not logged in users
add_action('wp_ajax_nopriv_import_product', 'importproduct');

function importproduct() {
	 $email= $_POST['email'];
		//$customer_email = $_POST['customer_email'];
        $apiuser=$GLOBALS['soapUserName']; //webservice user login
        $apikey = $GLOBALS['soapApiKey']; //webservice user pass
		$remote = $GLOBALS['apiUrl']; // remote address
		$client = new SoapClient($remote); //soap handle
		
		$sessionId = $client->login($apiuser, $apikey);
		$collections = $client->call($sessionId, 'sales_order.showalldata', trim($email));
		$response['response'] = $collections;
		header( "Content-Type: application/json" );
		//echo '+';
		echo json_encode($response);
	/*	echo '+';
		print_r($collections);
		exit;*/
exit();	
}



add_action('wp_ajax_create_category', 'createCategory');
//for not logged in users
add_action('wp_ajax_nopriv_create_category', 'createCategory');

function createCategory() {
	 $category= $_POST['category'];
		echo 'createCategory';
		print_r($category);
		foreach($category as $key=>$val)
		{
			$cat_name = $val;
				$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
				$term = get_term_by('name', trim($cat_name) , 'product_cat');
				if(!$term)
				{
					$slug = strtolower($cat_name);
					 $cid = wp_insert_term(
						$cat_name, // the term 
						'product_cat', // the taxonomy
						array(
								'description'=> ' ',
								'slug' => $slug,
								'parent' => '-1'
							)
					);
				}
		}
		echo 'ok';
exit();	
}



add_action('wp_ajax_create_product', 'createSimpleProduct');
//for not logged in users
add_action('wp_ajax_nopriv_create_product', 'createSimpleProduct');

function createSimpleProduct() {
	 $p_name= $_POST['p_name'];
	 $p_cat= $_POST['p_cat'];
	 $p_image= $_POST['p_image'];
	 $p_price= $_POST['p_price'];
	 $p_sku= $_POST['p_sku'];
	 $p_dis= $_POST['p_dis'];
	 $p_short_dis= $_POST['p_short_dis'];
	
	$imgurl = $p_image; 
	global $wpdb;
	/*echo '-->'.*/$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' ORDER BY post_id DESC", $p_sku ) );
	/*echo 'status-->'.*/$product_status = $wpdb->get_var( $wpdb->prepare( "SELECT post_status FROM $wpdb->posts WHERE ID='%d'", $product_id ) );
	
	
	
	if ($product_id == null || $product_status != 'publish')
	{
	// echo 'in if';
		$new_post = array(
						'post_title' => $p_name,
						'post_content' => ' ',
						'post_status' => 'publish',
						'post_type' => 'product'
						// 'post_category' => array(26)
					);
					$sku = $p_sku;
					$price = $p_price;
					$qty = 10;
					$post_id = wp_insert_post($new_post);
					update_post_meta($post_id, '_sku', $sku );
					update_post_meta( $post_id, '_regular_price', $price);
					update_post_meta( $post_id, '_price', $price);
					update_post_meta( $post_id, '_manage_stock', true );
					update_post_meta( $post_id, '_stock', $qty );
						//update_post_meta( $post_id, '_visibility', 'visible' );
					
					if (((int)$product['Qty']) > 0)
					{
						update_post_meta( $post_id, '_stock_status', 'instock');
					}
					update_post_meta( $post_id, '_visibility', 'visible' );
					// assign product to category..
					$cat_name = $p_cat;
					$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
					$term = get_term_by('name', trim($cat_name) , 'product_cat');
					if($term)
					{
						wp_set_object_terms($post_id, $term->term_id, 'product_cat');
						
					}
					//	echo 'ok';
					/*--------image upload--------------*/
					require_once(ABSPATH . 'wp-admin/includes/file.php');
					require_once(ABSPATH . 'wp-admin/includes/media.php');
					$thumb_url = $p_image;

					// Download file to temp location
					$tmp = download_url( $thumb_url );

					// Set variables for storage
					// fix file name for query strings
					preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumb_url, $matches);
					$file_array['name'] = basename($matches[0]);
					$file_array['tmp_name'] = $tmp;

					// If error storing temporarily, unlink
					if ( is_wp_error( $tmp ) ) {
					@unlink($file_array['tmp_name']);
					$file_array['tmp_name'] = '';
					$logtxt .= "Error: download_url error - $tmp\n";
					}else{
					$logtxt .= "download_url: $tmp\n";
					}

					//use media_handle_sideload to upload img:
					$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
					// If error storing permanently, unlink
					if ( is_wp_error($thumbid) ) {
					@unlink($file_array['tmp_name']);
					//return $thumbid;
					$logtxt .= "Error: media_handle_sideload error - $thumbid\n";
					}else{
					$logtxt .= "ThumbID: $thumbid\n";
					}

					set_post_thumbnail($post_id, $thumbid);
					
					/*----------------------*/	
				exit();	
	}
}


add_action('wp_ajax_create_variable_product', 'createVariableProduct');
//for not logged in users
add_action('wp_ajax_nopriv_create_variable_product', 'createVariableProduct');

function createVariableProduct() {
	$p_name= $_POST['p_name'];
	 $p_cat= $_POST['p_cat'];
	 $p_image= $_POST['p_image'];
	 $p_price= $_POST['p_price'];
	 $p_sku= $_POST['p_sku'];
	 $p_dis= $_POST['p_dis'];
	 $p_short_dis= $_POST['p_short_dis'];
	 $p_variation= $_POST['p_variation'];
	 global $wpdb;
	$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' ORDER BY post_id DESC", $p_sku ) );
	$product_status = $wpdb->get_var( $wpdb->prepare( "SELECT post_status FROM $wpdb->posts WHERE ID='%d'", $product_id ) );
	
	
	if ($product_id == null || $product_status != 'publish')
	{
	/* echo '<pre>';
	 print_r($p_variation);
	 
	exit;*/
	echo 'variable';
	$imgurl = $p_image; 
	$new_post = array(
						'post_title' => $p_name,
						'post_content' => ' ',
						'post_status' => 'publish',
						'post_type' => 'product'
						// 'post_category' => array(26)
					);
					$sku = $p_sku;
					$price = $p_price;
					echo $post_id = wp_insert_post($new_post);
					update_post_meta($post_id, '_sku', $sku );
					update_post_meta( $post_id, '_visibility', 'visible' );
					// assign product to category..
					$cat_name = $p_cat;
					$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
					$term = get_term_by('name', trim($cat_name) , 'product_cat');
					if($term)
					{
						wp_set_object_terms($post_id, $term->term_id, 'product_cat');
						
					}
					wp_set_object_terms ($post_id,'variable','product_type');
					
		$a =0;				
		foreach($p_variation as $variations)
		{
			foreach($variations as $variation)
			{
				$avail_color[$a] = $variation['color'];
				$avail_size[$a] = $variation['size'];
				$a++;
			}
		}
		// echo '<pre>';
		 print_r($avail_color);
		 print_r($avail_size);
		 print_r(array_unique($avail_color));
		 print_r(array_unique($avail_size));
		// exit;
		$avail_color =  array_unique($avail_color);
		$avail_size =  array_unique($avail_size);
		wp_set_object_terms($post_id, $avail_size, 'pa_size');/*add attribute for products*/
		wp_set_object_terms($post_id, $avail_color, 'pa_color');/*add attribute for products*/
		
		$thedata['pa_size'] = Array(
					'name'=>'pa_size',
					'value'=>'',
					'is_visible' => '1', 
					'is_variation' => '1',
					'is_taxonomy' => '1'
					);
		$thedata['pa_color'] = Array(
					'name'=>'pa_color',
					'value'=>'',
					'is_visible' => '1', 
					'is_variation' => '1',
					'is_taxonomy' => '1'
					);
					
		update_post_meta( $post_id,'_product_attributes',$thedata);/*assign this attribute to new variable products...*/

						foreach ($p_variation as $variations)
						{
							foreach ($variations as $variation)
							{
								$post_name = 'product-' . $post_id . '-color-size-' . $variation['qty'];
								$post_variation_sku = $variation['sku'];
								$my_post = array(
										'post_title' => $post_name,//'Color ' . $color . ' for #' . $post_id,
										'post_name' => $post_name,
										'post_status' => 'publish',
										'post_parent' => $post_id,
										'post_type' => 'product_variation',
										'guid' => home_url() . '/?product_variation=' . $post_name
									);
						
						
								$attID = wp_insert_post($my_post);
								update_post_meta($attID, 'attribute_pa_color', strtolower($variation['color']));
								update_post_meta($attID, 'attribute_pa_size', strtolower($variation['size']));
								//	echo $variation['color'].'-----'.$variation['size'];
					
								//exit;
								update_post_meta($attID, '_price', 100);
								update_post_meta($attID, '_regular_price', 100);
								update_post_meta($attID, '_sku', $post_variation_sku);
								update_post_meta($attID, '_stock', $variation['qty']);
								update_post_meta($attID, '_virtual', 'no');
								update_post_meta($attID, '_downloadable', 'no');
								update_post_meta($attID, '_manage_stock', 'yes');
								update_post_meta($attID, '_stock_status', 'instock');
							//	$i++;
							}
						}
						WC_Product_Variable::sync( $post_id );
										
						echo 'ok';
							
							/*--------image upload--------------*/
						require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/media.php');
						$thumb_url = $p_image;

						// Download file to temp location
						$tmp = download_url( $thumb_url );

						// Set variables for storage
						// fix file name for query strings
						preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumb_url, $matches);
						$file_array['name'] = basename($matches[0]);
						$file_array['tmp_name'] = $tmp;

						// If error storing temporarily, unlink
						if ( is_wp_error( $tmp ) ) {
						@unlink($file_array['tmp_name']);
						$file_array['tmp_name'] = '';
						$logtxt .= "Error: download_url error - $tmp\n";
						}else{
						$logtxt .= "download_url: $tmp\n";
						}

						//use media_handle_sideload to upload img:
						$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
						// If error storing permanently, unlink
						if ( is_wp_error($thumbid) ) {
						@unlink($file_array['tmp_name']);
						//return $thumbid;
						$logtxt .= "Error: media_handle_sideload error - $thumbid\n";
						}else{
						$logtxt .= "ThumbID: $thumbid\n";
						}

						set_post_thumbnail($post_id, $thumbid);
						
						/*----------------------*/		
							
	}
}
?>
