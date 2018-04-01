window.jQuery = window.$ = jQuery;
var engo_customizer = {
    start: function() {
        "use strict";
        this.showField();
    },
    showField: function() {
        "use strict";
        var api = wp.customize;
        api.controlConstructor.showtextfield = api.Control.extend({
            ready: function () {
                $(".engoj_show_field").each(function(){
                    var this_field = $(this).attr("data-merge");
                    if($(this).is(':checked')) {
                        $("div[data-show='"+this_field+"']").show();
                    }
                    $(this).on('change', function() {
                        if ( $(this).is(':checked') ) {
                            $("div[data-show='"+this_field+"']").show();
                        } else {
                            $("div[data-show='"+this_field+"']").hide();
                        }
                    });
                });

            }
        });


    }
}
engo_customizer.start();
