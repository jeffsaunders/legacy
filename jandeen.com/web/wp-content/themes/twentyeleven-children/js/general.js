jQuery(document).ready(function($) {

function onAfter(curr, next, opts) {	
	
    var index = opts.currSlide;
    if(this.firstChild)
      $('#attachment-title').html(this.firstChild.alt); 
    else
      $('#attachment-title').html(this.alt);
    $('#prev')[index == 0 ? 'hide' : 'show']();
    $('#next')[index == opts.slideCount - 1 ? 'hide' : 'show']();
    
    $(this).parent().height($(curr).height());
    
    
    var ht = $(this).height();
  //set the container's height to that of the current slide
  $(this).parent().animate({height: ht});
}



if($('#pauseSlide').length){

	var homeSlide = $('#homeSlide').cycle({ 
		
		    fx:     'scrollHorz', 
			fit: 1,
			width:839,
			height: 472,
		    prev:   '#prevSlide', 
		    next:   '#nextSlide',
		    paused: function(cont, opts, byHover) {
				$('#playSlide').show();
				$('#pauseSlide').hide();
			},
			resumed: function(cont, opts, byHover) {
				$('#playSlide').hide();
				$('#pauseSlide').show();
			}, 
		    fx:  'fade',// name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle') 	 
		    after:   onAfter, 	
		    timeout:4000	    
		    
	});
	
	$('.home #pauseSlide').click(function() { 
  	      $('#homeSlide').cycle('pause');
  	      return false;   	    
	});
	
	$('.home #playSlide').click(function() { 		
        $('#homeSlide').cycle('resume');	     
        return false;
	});
	
	$('#portfoliosSlide').cycle({ 
		
	    slideResize: 1,
	    prev:   '#prevSlide', 
	    next:   '#nextSlide', 
	    onPagerEvent: function() { 
            console.log(opts)
       },
	    delay:1,
	    fastOnEvent: 1,
	    paused: function(cont, opts, byHover) {
			$('#playSlide').show();
			$('#pauseSlide').hide();
		},
		resumed: function(cont, opts, byHover) {
			$('#playSlide').hide();
			$('#pauseSlide').show();
		}, 
	    fx:            'fade',// name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle') 	 
	    after:   onAfter, 
	    height: 355,
	    fit: 1,
	    timeout:4000
	    
	});
	
	$('.portfolios #pauseSlide').click(function() { 
  	      $('#portfoliosSlide').cycle('pause');   	    
  	      return false;
	});
	
	$('.portfolios #playSlide').click(function() { 		
        $('#portfoliosSlide').cycle('resume');	     
        return false;
	});		
}


	//acordion menu
	$(".children").hide();
	$(".children").prev('a').addClass('head');
	$('.head').mouseenter(function() {
      	$(this).next('.children').slideDown('fast').show();
      	return false;
	});
	
	
	//fix footer
	
	fixfooter()
	
	function fixfooter(){
	  if( $(window).height() >= $('#page').height() ){
		$('#page').css('margin-bottom', '-30px');
	  }else{
	  	$('#page').css('margin-bottom', '');
	  }
	}
	
	
	$(window).resize(function() {
		fixfooter()
	});
	
	//contact form
	if($('.wpcf7-form').length){
		$('.wpcf7-form input[type="text"], .wpcf7-form textarea ').focus(function(){
			$(this).parent().parent().find('label').hide();
		})
		
		$('.wpcf7-form input[type="text"], .wpcf7-form textarea').focusout(function(){
			$(this).parent().parent().find('label').show();
		})
	}

	
	//to top
    if($('#toTop').length){
	$('#toTop').click(function(){$('body,html').animate({scrollTop:0},1000);return false;});

	  //TO TOP buttton
	  $(window).scroll(function() {
			if($(window).scrollTop() != 0) {
				$('#toTop').fadeIn();	
			} else {
				$('#toTop').fadeOut();
			}
	   });
	 } 

	//iframe z-index fix
	if( $('iframe').length ){
	  $('iframe').each(function(){
	  	if($.browser.msie&&$.browser.version=="6.0") return false;
	  	
	    $(this).attr({'src': $(this).attr("src") + '?wmode=transparent' });
	  });
	}
	
});



