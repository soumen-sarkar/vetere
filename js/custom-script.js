jQuery(window).load(function(){
	//Background Image carousel
	$('.carousel').carousel({
		//interval: 4000
	})
	
	//Script of equal height
	$(function(cash) {
		$('.equal').responsiveEqualHeightGrid(); 
	});
	
	//Testimonials carousel
	var testimonials = $("#testimonial");

      testimonials.owlCarousel({
	  //autoPlay : 3000,
      items : 2, //10 items above 1000px browser width
      itemsDesktop : [1024,2], //5 items between 1000px and 901px
      itemsDesktopSmall : [767,2], // 3 items betweem 900px and 601px
      itemsTablet: [480,1], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        testimonials.trigger('owl.next');
      })
      $(".prev").click(function(){
        testimonials.trigger('owl.prev');
      });
	
	// Script for lightBox  
	$(document).ready(function(){
	$("area[rel^='prettyPhoto']").prettyPhoto();
	
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'dark_square', slideshow:3000, autoplay_slideshow: false});
	$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
	
	/*$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
		custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
		changepicturecallback: function(){ initialize(); }
	});
	
	$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
		custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
		changepicturecallback: function(){ _bsap.exec(); }
	});*/
	});
	
});
