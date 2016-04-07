(function($) {
	
		
	/// VARS
	var loaded = false;
	
	/// DETECT MOBILE
	var $doc = $(document),
	Modernizr = window.Modernizr;

	/// BACK BUTTONS ACTIVE
	$(window).bind('popstate', function(event) {
		if (!Modernizr.touch) {
			if(!loaded) {
				loaded = true;
				return;	
			}else{
				window.location =location.pathname;
			}
		}
	});
	
	
	var bid = 1;
	
	function updatelinks(m) { 
		if(history.pushState && history.replaceState) {
			bid++;
			history.pushState({"id":bid}, '', m);
		}	
	}
	
	/// LOAD SOCIAL SHARING PLUGINS
	function socialRevive() {
		$.ajax({ url: 'http://platform.twitter.com/widgets.js', dataType: 'script', cache:true});
		$.ajax({ url: 'http://platform.tumblr.com/v1/share.js', dataType: 'script', cache:true});
		$.ajax({ url: 'http://assets.pinterest.com/js/pinit.js', dataType: 'script', cache:true}); 
		$.ajax({ url: 'https://apis.google.com/js/plusone.js', dataType: 'script', cache:true}); 
	}

			
	/// SCROLL TO
	function goToByScroll(id){
     	$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
	}
	
	/// CLOSE MOBILE MENU 
	var menuclosed = true;
	function closeMobileMenu() { 
		$('.mobilemenu').animate({ left: '-75%' }, 0 );
	    $('a.navbarbutton').find('i').removeClass('menu-remove');
	    $('a.navbarbutton').find('i').addClass('menu-icon');
		menuclosed = true;
	}
	
	/// RESPONSIVE IMG
	function responsiveIMG() {
			$('#post-list img').each(function() { 
				var smalls = $(this).attr('data-small');
				var large = $(this).attr('data-large');
				if($(window).width() < 767) {
					$(this).attr('src',large);
				}else{
					$(this).attr('src',smalls);
				}
			});
	}
	
	
	/// POST COMMENT AJAX
	function postCommentAjax() {
	var commentform=$('#commentform'); // find the comment form
	$('<div class="statusmsg alert hidden" style="width:90%"><a href="#" class="closealert"><i class="icon-remove"></i></a><span></span></div>').insertBefore('#commentform p.form-submit'); // add info panel before the form to provide feedback or errors
	var statusdivmain=$('#commentform .statusmsg');
	var statusdiv=$('#commentform .statusmsg span'); // define the infopanel
	statusdivmain.hide();
	
	commentform.submit(function(){
	//serialize and store form data in a variable
	var formdata=commentform.serialize();
	//Add a status message
	statusdivmain.fadeIn();
	statusdiv.html('Processing...');
	//Extract action URL from commentform
	var formurl=commentform.attr('action');
	//Post Form with data
		$.ajax({
		type: 'post',
		url: formurl,
		data: formdata,
		error: function(XMLHttpRequest, textStatus, errorThrown){
		statusdiv.html('You might have left one of the fields blank, or be posting too quickly');
		statusdivmain.removeClass('alert-green');
		statusdivmain.addClass('alert-red');
		},
			success: function(data, textStatus){
				if(data=="success") {
					statusdiv.html('Thanks for your comment. We appreciate your response.');
					statusdivmain.removeClass('alert-red');
					statusdivmain.addClass('alert-green');
					setTimeout('location.reload(true)',2200);
				}else{
					statusdiv.html('Please wait a while before posting your next comment');
					statusdivmain.removeClass('alert-green');
					statusdivmain.addClass('alert-red');
				}
			}
		});
	return false;
	
	});
	}
	
	
	
$(function() { 	
       
		/// TRIGGER RESPONSIVE IMG ONLOAD
		responsiveIMG() 
		
		/// RESIZE EVENTS
		var wwidth = $(window).width();
		$(window).resize(function() {
			if(wwidth != $(window).width()) {
				closeMobileMenu();
				responsiveIMG();
				wwidth = $(window).width();
			}
		});
		
		/// CLOSE ALERT
		$('.closealert').live('click', function(e) { 
			$(this).parent().slideUp(); 
			e.preventDefault();
		})
		 
		///	BACK TO TOP
		$(window).scroll(function() {
			if($(this).scrollTop() > 800) {
				if (!Modernizr.touch) {
					$('a.backtotop').fadeIn();
				}
			} else {
				if (!Modernizr.touch) {
				$('a.backtotop').fadeOut();
				}
			}
		});
		$('a.backtotop').live('click',function(e) { 
			$('html, body').animate({scrollTop:0}, 1000, "easeInOutExpo"); 
			e.preventDefault(); 
		});
		
		
		/// WORKS ROLLOVER EFFECT  
		$('#post-list .project-item .imgdiv a').hover(function() { 
			$('span',this).stop().animate({"opacity": .4}); 
		},function() { 
			$('span',this).stop().animate({"opacity": 0}); 
		});   
	
	
		/// GET POSTS
		$('a.getworks').live('click',function(e) { 
		var id = $(this).attr('data-id');
		var token = $(this).attr('data-token');
		var murl = $(this).attr('href');
		var type = $(this).attr('data-type');
		
		$('html, body').animate({scrollTop:0}, 'slow', "easeInOutExpo");
		$('.ajaxloader').fadeIn();
		$('.sliderdiv').slideUp();
		
		$.post(mdajaxurl.ajax,{action:'md_work_post',token:token,id:id, type:type},function(data) {
			if(data!=0) { 
			$('#post-list').fadeOut('normal',function() { 
				updatelinks(murl);
				$('.navibg.withall').hide();
				$('.works-single').hide().html(data).fadeIn('normal');
				$(".fitvids").fitVids();
				$('.ajaxloader').fadeOut(); 
				socialRevive(); 
				if(type=='blog') {
				postCommentAjax();  
				}
			});
			}
		});
		e.preventDefault();
		});
		
		
		$('a.gohome').live('click',function(e) { 
		var token = $(this).attr('data-token');
		var type = $(this).attr('data-type');
		var murl = $(this).attr('href');
		
		$('.ajaxloader').fadeIn();
		$.post(mdajaxurl.ajax,{action:'md_work_all_post',token:token, type:type},function(data) {
			if(data!=0) { 
			$('#singlecontent').fadeOut('normal',function() { 
				updatelinks(murl);
				$('#singlecontent').html(data).fadeIn('normal');
				$(".fitvids").fitVids();
				$('.ajaxloader').fadeOut();
				socialRevive();
				responsiveIMG();
			});
			}
		});
		e.preventDefault();
		});	
		
		
		$('a.getworks-nextback').live('click',function(e) { 
		var id = $(this).attr('data-id');
		var token = $(this).attr('data-token');
		var murl = $(this).attr('href');
		var type = $(this).attr('data-type');
		
		$('.ajaxloader').fadeIn();
		$.post(mdajaxurl.ajax,{action:'md_work_post',token:token,id:id, type:type},function(data) {
			if(data!=0) { 
			$('#singlecontent .showajaxcontent').fadeOut('normal',function() { 
				updatelinks(murl);
				$('#singlecontent').html(data)
				$('#singlecontent .showajaxcontent').hide().fadeIn('normal');
				$(".fitvids").fitVids();
				$('.ajaxloader').fadeOut();
				socialRevive();
			});
			}
		});
		e.preventDefault();
		});
		
		$('a.getworks-showmsg').live({
			mouseenter:function() { 
			var title = $(this).attr('title');
				if($(window).width() > 500) {
					$(this).parent().find('span.pname').html(title);
				}
			},mouseleave:function() { 
			$(this).parent().find('span.pname').html('');
		}});
		
		
		
		
		/// POST FILTER
		$('#portfolio-cats a').live('click',function(e) { 
			var cat = $(this).attr('data-rel');
			var murl = $(this).attr('href');
			var th = $(this).attr('data-th');
			
			$('br.rowseperator').remove();
			$('#portfolio-cats a').removeClass('selected');
			$('#post-list div.project-item').stop(true, true).hide();
				if(cat=="all") {
					var wh = 'project-item';
				}else{
					var wh = cat;
				}
					var s=1;
					if (Modernizr.touch) {
					$('#post-list div.'+wh).show();
					}else{
					$('#post-list div.'+wh).each(function(index) {
						$(this).delay(250*index).fadeIn(300);
						if(s==th) {
						$('<br class="clear rowseperator" />').insertAfter(this);	
						s=0;
						}
						s++;
					});
					}	
					
			$(this).addClass('selected');
			if(murl) {
			updatelinks(murl);
			}
			e.preventDefault();
			return false;
		});
		
		$('select.reschangeblog').live('change',function(e) {
			window.location= $(this).val();
		});	
		
		$('select.reschange').live('change',function(e) { 
			var cat = $(this).val();
			var th = 0
			
			$('br.rowseperator').remove();
			$('#portfolio-cats a').removeClass('selected');
			$('#post-list div.project-item').stop(true, true).hide();
				if(cat=="all") {
					var wh = 'project-item';
				}else{
					var wh = cat;
				}
					var s=1;
					if (Modernizr.touch) {
					$('#post-list div.'+wh).show();
					}else{
					$('#post-list div.'+wh).each(function(index) {
						$(this).delay(250*index).fadeIn(300);
						if(s==th) {
						$('<br class="clear rowseperator" />').insertAfter(this);	
						s=0;
						}
						s++;
					});
					}	
					
			e.preventDefault();
			return false;
		});
		
		
		/// POST COMMENT
		postCommentAjax();
		
		
		/// RESPONSIVE VIDEO
		$(".fitvids").fitVids();
		
		
		$('a.navbarbutton').live('click',
		function(e) { 
		   if(menuclosed) {
		   $('.mobilemenu').css('left','0');
		   $(this).find('i').removeClass('menu-icon');
		   $(this).find('i').addClass('menu-remove');
		   menuclosed = false;
		   }else{
		   $('.mobilemenu').css('left','-75%');
		   $(this).find('i').removeClass('menu-remove');
		   $(this).find('i').addClass('menu-icon');
		   menuclosed = true;
		   }
		   e.preventDefault();
		});
	

	})

})(jQuery)


// Hide address bar on mobile devices
/*
	var $doc = $(document),
	Modernizr = window.Modernizr;

 if (Modernizr.touch) {
    $(window).load(function () {
      setTimeout(function () {
        window.scrollTo(0, 1);
      }, 0);
    });
  }
*/ 