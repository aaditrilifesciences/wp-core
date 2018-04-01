(function($){
	
	$.fn.ENGO_CountDown = function( options ) {
	 	return this.each(function() { 
			// get instance of the ENGO_CountDown.
			new  $.ENGO_CountDown( this, options );
		});
 	 }
	$.ENGO_CountDown = function( obj, options ){
		
		this.options = $.extend({
				autoStart			: true,
				LeadingZero:true,
				DisplayFormat:"<div><span>%%D%%</span> Days</div><div><span>%%H%%</span> Hours</div><div><span>%%M%%</span> Mins</div><div><span>%%S%%</span> Secs</div>",
				FinishMessage:"Expired",
				CountActive:true,
				TargetDate:null
		}, options || {} );
		if( this.options.TargetDate == null || this.options.TargetDate == '' ){
			return ;
		}
		this.timer  = null;
		this.element = obj;
		this.CountStepper = -1;
		this.CountStepper = Math.ceil(this.CountStepper);
		this.SetTimeOutPeriod = (Math.abs(this.CountStepper)-1)*1000 + 990;
		var dthen = new Date(this.options.TargetDate);
		var dnow = new Date();
		if( this.CountStepper > 0 ) {
			ddiff = new Date(dnow-dthen);
		}
		else {
			 ddiff = new Date(dthen-dnow);
		}
		gsecs = Math.floor(ddiff.valueOf()/1000); 
		this.CountBack(gsecs, this);

	};
	 $.ENGO_CountDown.fn =  $.ENGO_CountDown.prototype;
     $.ENGO_CountDown.fn.extend =  $.ENGO_CountDown.extend = $.extend;
	 $.ENGO_CountDown.fn.extend({
		calculateDate:function( secs, num1, num2 ){
			  var s = ((Math.floor(secs/num1))%num2).toString();
			  if ( this.options.LeadingZero && s.length < 2) {
					s = "0" + s;
			  }
			  return "<b>" + s + "</b>";
		},
		CountBack:function( secs, self ){
			 if (secs < 0) {
				self.element.innerHTML = '<div class="labelexpired"> '+self.options.FinishMessage+"</div>";
				return;
			  }
			  clearInterval(self.timer);
			  DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate( secs,86400,100000) );
			  DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs,3600,24));
			  DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs,60,60));
			  DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs,1,60));
			  self.element.innerHTML = DisplayStr;
			  if (self.options.CountActive) {
				   self.timer = null;
				 self.timer =  setTimeout( function(){
					self.CountBack((secs+self.CountStepper),self);			
				},( self.SetTimeOutPeriod ) );
			 }
		}
					
	});


	$(document).ready(function(){
		/** Countdown **/
		$('[data-countdown="countdown"]').each(function(index, el) {
            var $this = $(this);
            var $date = $this.data('date').split("-");
            $this.ENGO_CountDown({
                TargetDate:$date[0]+"/"+$date[1]+"/"+$date[2]+" "+$date[3]+":"+$date[4]+":"+$date[5],
                DisplayFormat:"<div class=\"countdown-times\"><div class=\"day\"><span>%%D%%</span> DAYS </div><div class=\"hours\"><span>%%H%%</span> HOURS </div><div class=\"minutes\"><span>%%M%%</span> MINS </div><div class=\"seconds\"><span>%%S%%</span> SECS </div></div>",
                FinishMessage: "Expired"
            });
        });

		/** Ajax QuickView **/
		var modal_w = $(this).find(".modal-content").outerWidth()/2;
		var modal_h = $(this).find(".modal-content").outerHeight()/2;
		$(this).find(".spinner").css({"top":modal_h,"left":modal_w});
		$('#engo-quickview-modal').on('hidden.bs.modal',function(){
			$(this).find('.modal-body').empty().append('<span class="spinner loading" style="top:'+modal_h+'px; left:'+modal_w+'px;"></span>');
		});
		$('a.quickview').click(function (e) {
			e.preventDefault();
			var productslug = $(this).data('productslug');
			var url = nauticaAjax.ajaxurl + '?action=nautica_quickview&productslug=' + productslug;
			$.get(url,function(data,status){
				$('#engo-quickview-modal .modal-body').append(data).find(".spinner").remove();
			});
		});


	});

})(jQuery)