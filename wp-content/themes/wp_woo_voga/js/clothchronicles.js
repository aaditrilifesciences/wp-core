jQuery(document).ready(function(){
	var windowHeight = jQuery(window).height();
	var headerHeight = document.getElementById('header').offsetHeight;
	var mainContainer = document.getElementById('main-module-container').offsetHeight;
	var footer = document.getElementById('footer').offsetHeight;
	var extraHeight = 0;
	var totalHeightOfComponents = headerHeight + mainContainer + footer;
	var topPadding = 0;
	var bottomPadding = 0;
	if(totalHeightOfComponents < windowHeight )
	{
		extraHeight = windowHeight - totalHeightOfComponents;
		topPadding = extraHeight/2;
		bottomPadding = extraHeight/2;
	}
	jQuery('#main-module-container').css('padding-bottom',topPadding+'px');
	jQuery('#main-module-container').css('padding-top',bottomPadding+'px');
		console.log('window height = ',windowHeight);
		console.log('mainContainer height = ',mainContainer);
		console.log('headerr height = ',headerHeight);
		console.log('footer height = ',footer);
		console.log('extraHeight applied = ',extraHeight);
	
	/* image height for main page*/
	var imgOneHeight = jQuery('#main_section_two .column1 img').height();
	var windowWidth = jQuery(window).width();
	if(windowWidth > '740')
		jQuery('#main_section_two .column2 img').css('height',imgOneHeight+'px');
	//alert(imgOneHeight);
	
	/*checkout section*/
	jQuery('#stripe').css('display','none');
	jQuery('#ppec_paypal').css('display','none');
	jQuery('#place_order').css('display','none');
	
	
	});
	
	function submitPaymentForm(method)
	{
		//if(method != 'payment_method_stripe')
		{
			jQuery('#'+method).attr('checked','checked');
			jQuery('#place_order').trigger('click');
		}	
	}
	
	function checkoutbutton(button)
	{
		if(button == 'user')
		{
			jQuery('#clothchronicles_user').attr('checked','checked');
			jQuery('#createaccount').attr('checked','checked');
			jQuery('#createaccount').trigger('onchange');
		}
		if(button == 'guest')
		{
			jQuery('#clothchronicles_guest').attr('checked','checked');
			jQuery('#createaccount').attr('checked',false);
			jQuery('#createaccount').trigger('onchange');
			jQuery('#clothchronicles_continue_account_create').trigger('click');
		}	
		
	}
