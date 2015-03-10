jQuery(document).ready(function($) {
	"use strict";
	////////////////////////////////////tab
	$(function(){
		$('#tab-container').easytabs();
	});
	
	////////////////////////////////////mainnav
	$(function(){ 
		var touch 	= $('#touch-menu');
		var menu 	= $('.menu');

		$(touch).on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});
		
		$(window).resize(function(){
			var w = $(window).width();
			if(w > 767 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	});
	
	////////////////////////////////////Home Slider
	$(function() {
		var owl = $("#home-slider");
		  owl.owlCarousel({
		  autoPlay: 5000,
		  goToFirstSpeed : 3000,
		  singleItem : true,
		  transitionStyle:"goDown",
		  stopOnHover : true,
		  pagination : false
		  });

		  // Custom Navigation Events
		  $(".slider-next").click(function(){
			owl.trigger('owl.next');
		  });
		  $(".slider-prev").click(function(){
			owl.trigger('owl.prev');
		  })
    });
	
	////////////////////////////////////Home Sidebar Carousel
	$(function() {
      var owl = $("#job-opening-carousel");

      owl.owlCarousel({
	  autoPlay: 5000,
      singleItem : true
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      });
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
	});
	
$(function() {
      var owl = $("#testimonial-carousel");

      owl.owlCarousel({
	  autoPlay: 5000,
      singleItem : true
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      });
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
	});
	////////////////////////////////////Home Company Carousel
	$(function() {
      var owl = $("#company-post-list");
      owl.owlCarousel({

      items : 6, //10 items above 1000px browser width
	  autoPlay: 3000
	  
      });
    });
	
	////////////////////////////////////Testimony Home Carousel
	$(function() {
     
		var sync1 = $("#sync1");
		var sync2 = $("#sync2");
		 
		sync1.owlCarousel({
			singleItem : true,
			slideSpeed : 1000,
			navigation: false,
			pagination:false,
			mouseDrag: false,
			touchDrag: false,
			afterAction : syncPosition,
			responsiveRefreshRate : 200,
			transitionStyle : "goDown"
		});
     
		sync2.owlCarousel({
			items : 9,
			itemsDesktop : [1000,5], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,3], // betweem 900px and 601px
			itemsTablet: [600,2], //2 items between 600 and 0
			itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
			pagination:false,
			
			afterInit : function(el){
			el.find(".owl-item").eq(0).addClass("synced");
			}
		});
     
		function syncPosition(el){
			var current = this.currentItem;
			$("#sync2")
			.find(".owl-item")
			.removeClass("synced")
			.eq(current)
			.addClass("synced");
			if($("#sync2").data("owlCarousel") !== undefined){
			center(current)
			}
		}
		 
		$("#sync2").on("click", ".owl-item", function(e){
			e.preventDefault();
			var number = $(this).data("owlItem");
			sync1.trigger("owl.goTo",number);
		});
		 
		function center(number){
			var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
			var num = number;
			var found = false;
			for(var i in sync2visible){
			if(num === sync2visible[i]){
				var found = true;
			}
			}
			 
			if(found===false){
			if(num>sync2visible[sync2visible.length-1]){
			sync2.trigger("owl.goTo", num - sync2visible.length+2)
			}else{
				if(num - 1 === -1){
					num = 0;
				}
				sync2.trigger("owl.goTo", num);
			}
			} else if(num === sync2visible[sync2visible.length-1]){
				sync2.trigger("owl.goTo", sync2visible[1])
			} else if(num === sync2visible[0]){
				sync2.trigger("owl.goTo", num-1)
			}
		}
    });
	
	////////////////////////////////////Page Slider
	$(function() {
		var owl = $("#page-slider");
		owl.owlCarousel({
		singleItem : true,

		});
	});
	
	////////////////////////////////////Page Joblisting Carousel
	$(function(){
      var owl = $("#job-listing-carousel");

      owl.owlCarousel({
	  autoPlay: 5000,
      items : 3 //10 items above 1000px browser width
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      });
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
	});
	
	
});