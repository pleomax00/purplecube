jQuery( document ).ready( function( $ ) {
	$('div.post-format-content').hover(
		function () {
			$( this ).find( '.content-wrap' ).addClass( 'showcontent' );
		},
		function () {
			//$( this ).find( '.gallery-caption' ).removeClass( 'show' ).addClass( 'hide' );
		}
	);

	/* Menu */
	var $masthead = $( '#main' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '#anchor.site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$masthead.find( '#anchor.site-navigation h1' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).unbind( 'click' ).click( function() {
			$masthead.find( 'ul.menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	// Determine menu style when loading
	var winWidth = $( window ).width();
	menuWidth = 0;

	$( '.site-navigation ul.menu > li.menu-item' ).each(function() {
		menuWidth2 = $( this ).outerWidth( true );
  		menuWidth = parseInt( menuWidth + menuWidth2 );
	});
	if( ( ( menuWidth ) > ( winWidth - 100 ) ) ) {
		$.fn.smallMenu();
	}

	var delay = (function(){
		var timer = 0;
		return function( callback, ms ) {
	    	clearTimeout( timer) ;
	    	timer = setTimeout( callback, ms );
	  	};
	})();

	// Determine menu style when resized
	$( window ).resize( function() {
		delay( function() {
			var winWidth = $( window ).width();
			if( ( ( menuWidth ) > ( winWidth - 100 ) ) ) {
				$.fn.smallMenu();
			} else {
			 	$masthead.find( '#anchor.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
				$masthead.find( '#anchor.site-navigation h1' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
			 	$masthead.find( 'ul.menu' ).removeAttr( 'style' );
			}
		}, 500);
	} );

});