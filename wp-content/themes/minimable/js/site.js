jQuery(document).ready(function($) {
	$('.section-page').last().addClass('last-section');	
	$(".swipebox").swipebox( {
		hideBarsDelay : 0
	});
});
//navigation
var lastId,
    topMenu = $(".top-nav,#nav-home ul"),
    scrollDown = $(".scroll-down"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).parent().not('.custom-link').children().attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items

menuItems.add(scrollDown).click(function(e){
	var href = this.hash,
	offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+55;
  	$('html, body').stop().animate({ 
      scrollTop: offsetTop
  	}, 3000, 'easeInOutExpo');
  	e.preventDefault();
});

var ismobile=navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i);
if( (ismobile)) {
	$('.nav-collapse a').click(function(e) {
		$('.nav-collapse').slideUp(400, function () {
			$('.nav-collapse').css('height','0');
			$('.btn-navbar').click(function() {
				$('.nav-collapse').addClass('menu-height');
				$('.nav-collapse').slideDown(400);
			});
		});
	});
}
var id = $('.page-1').attr('id');
$('#mini-logo a').attr("href","#"+id);
$('.home-link a, #mini-logo a').add(scrollDown).click(function(e) {
	var href = this.hash,
	offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight;
  	$('html, body').stop().animate({ 
      scrollTop: offsetTop
  	}, 3000, 'easeInOutExpo');
  	e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=#"+id+"]").parent().addClass("active");
   }                   
});

// sticky menu
var stickyHeaderTop = 100;

jQuery(window).scroll(function(){
	if( jQuery(window).scrollTop() > stickyHeaderTop ) {
        jQuery('header').fadeIn();
    } else {
        jQuery('header').fadeOut();
    }
});	