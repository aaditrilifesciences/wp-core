/**
 * Created by ManhTienpt on 1/29/2016.
 */
jQuery(document).ready(function(){
    /** Newsletter Popup **/
    $('#engo-newsletter-modal').on('hidden.bs.modal', function () {
        jQuery.cookie('MailChimpPopup_has_viewed', '1', {expires: 1, path: '/', domain: engo_this_domain});
    });
    jQuery(window).load(function(){
        if(jQuery(window).width() >= 1024) { /** Not show in small screen **/
        setTimeout(jQuery('#engo-newsletter-modal').modal('show'), 10000);
        }

    });
    checkCookiesMailChimpPopup();
});
function checkCookiesMailChimpPopup() {
    var cookies_mailchimp = jQuery.cookie('checkCookiesMailChimpPopup');
    var day_to_expire = 10;
    if(!cookies_mailchimp || cookies_mailchimp == null) {
        jQuery("body").on( 'click', "#mailchimp_popup_setting",function(){
            if(jQuery(this).hasClass('checked')) {
                jQuery("i",jQuery(this)).removeClass("fa-check");
                jQuery(this).removeClass("checked");
                jQuery.removeCookie('checkCookiesMailChimpPopup',{path: '/', domain: engo_this_domain});

            } else {
                jQuery("i",jQuery(this)).addClass("fa-check");
                jQuery(this).addClass("checked");
                jQuery.cookie('checkCookiesMailChimpPopup', '1', {expires: day_to_expire, path: '/', domain: engo_this_domain});
            }

        });

    }
}
