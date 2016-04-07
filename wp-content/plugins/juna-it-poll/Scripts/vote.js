	jQuery(document).ready(function(){
		GetFont_Size_of_Question();

		var cook=document.cookie;
		var f=cook.indexOf("customer");
		if(cook.indexOf("customer")>=0)
		{			
			var quest=jQuery('#JunaITPollQuestion').html();
			if(cook.indexOf(quest.trim())<0)
			{				
				return false;
			}	

			var ajaxurl = object.ajaxurl;
		  	var data = {
		    	action: 'GetResults', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: quest, // translates into $_POST['foobar'] in PHP				
			};
			jQuery.post(ajaxurl, data, function(response) {	

					if(parseInt(jQuery('#p_id').html())==1 && parseInt(cook[f+8])==1)
					{
						setTimeout(function() {
							jQuery('#widgetDiv').css('display','inline');
							jQuery('#answers_div').css('display','inline');
						},200)

						var ans_color=jQuery('#span_ans_id').css('color');
						var ans_font_family=jQuery('#span_ans_id').css('font-family');
						var ans_font_size=jQuery('#span_ans_id').css('font-size');

						var k=0;

					 	jQuery(':radio').each(function() {
					 		k++;
					 	});					

					 	var answers = [];

					 	for(i=1; i<=k; i++)
					 	{
					 		answers[answers.length]=jQuery('#answer'+i).val();
					 	}	
					 	var hoplo=response.split('%^&^%');
					 	var counts=hoplo[2].split("^");

					 	var results=[];

					 	for(i=0; i<counts.length; i++)
					 	{
					 		if(counts[i]=="")
					 		{
					 			continue;
					 		}
					 		else
					 		{
					 			results[results.length]=counts[i];
					 		}
					 	}

					 	var sum=0;
					 	var widths = [];
					 	for(i=0; i<results.length; i++)
					 	{
					 		sum=sum+parseInt(results[i]);
					 	}

					 	if(sum==0) sum=1;

					 	for(i=0; i<results.length; i++)
					 	{			
					 		widths[widths.length]=(results[i]*100)/sum;	
					 	}

					 	if(hoplo[0]=='percent')
					 	{	 		
						 	jQuery('#answers_div').empty();		 						 	

						 	for(i=1; i<=k; i++)
						 	{
						 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>("+ (parseFloat(widths[i-1]).toFixed(1)+'%') + ")</i> </span>" + "<br> <div style='margin-top:4px;border-radius:5px; background-color:" + hoplo[1] + "; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
						 	}	
						 	
						 	jQuery('#widgetDiv').fadeIn();
					 	}
					 	else if(hoplo[0]=='vote')
					 	{
						 	jQuery('#answers_div').empty();		 						 	

						 	for(i=1; i<=k; i++)
						 	{
						 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>"+ (parseInt(results[i-1])+' votes') + "</i> </span>" + "<br> <div style='margin-top:4px; border-radius:5px; background-color:"+hoplo[1]+"; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
						 	}	
						 	
						 	jQuery('#widgetDiv').fadeIn();
					 	}
					 	else
					 	{
						 	jQuery('#answers_div').empty();		 						 	

						 	for(i=1; i<=k; i++)
						 	{
						 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>"+ parseFloat(widths[i-1]).toFixed(1)+'%' +' ('+ (parseInt(results[i-1])+' votes') + ')' + "</i> </span>" + "<br> <div style='border-radius:5px; margin-top:4px; background-color:"+hoplo[1]+"; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
						 	}	
						 	
						 	jQuery('#widgetDiv').fadeIn();
					 	}						 		
					}
			});
		}
	})
function Vote_Click()
{
	var Active_question=document.getElementById('JunaITPollQuestion').innerHTML;
	var x;		
	jQuery(':radio').each(function() {
		if(jQuery(this).is(':checked'))
		{			
			x=jQuery(this).val();
		}
	});
	var t=Active_question+'^'+x;

	if(typeof x === 'undefined')
	{
	 	alert("Please Select Answer");
		return false;
	}	

	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'Vote_Click', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: t, // translates into $_POST['foobar'] in PHP				
	};
	jQuery.post(ajaxurl, data, function(response){

		var ans_color=jQuery('#span_ans_id').css('color');
		var ans_font_family=jQuery('#span_ans_id').css('font-family');
		var ans_font_size=jQuery('#span_ans_id').css('font-size');

		/* answers */
		var k=0;

		jQuery(':radio').each(function() {
			k++;
		});					

		var answers = [];

		for(i=1; i<=k; i++)
		{
			answers[answers.length]=jQuery('#answer'+i).val();
		}

		setTimeout(function() {
	 		jQuery('#widgetDiv').fadeOut();
	 	},100);

	 	/* Results Data from Ajax */
	 	var hoplo=response.split('%^&^%');
		var counts=hoplo[2].split("^");

		var results=[];

	 	for(i=0; i<counts.length; i++)
	 	{
	 		if(counts[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			results[results.length]=counts[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var sum=0;
	 	var widths = [];
	 	for(i=0; i<results.length; i++)
	 	{
	 		sum=sum+parseInt(results[i]);
	 	}

	 	if(sum==0) sum=1;
		
	 	for(i=0; i<results.length; i++)
	 	{			
	 		widths[widths.length]=(results[i]*100)/sum;	
	 	}

	 	window.clearInterval();
	 	if(hoplo[0]=='percent')
	 	{	 		
	 		setTimeout(function() {
			 	jQuery('#answers_div').empty();		 						 	

			 	for(i=1; i<=k; i++)
			 	{
			 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>("+ (parseFloat(widths[i-1]).toFixed(1)+'%') + ")</i> </span>" + "<br> <div style='margin-top:4px;border-radius:5px; background-color:" + hoplo[1] + "; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
			 	}	
			 	
			 	jQuery('#widgetDiv').fadeIn();

	 		},500);
	 	}
	 	else if(hoplo[0]=='vote')
	 	{
	 		setTimeout(function() {
			 	jQuery('#answers_div').empty();		 						 	

			 	for(i=1; i<=k; i++)
			 	{
			 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>"+ (parseInt(results[i-1])+' votes') + "</i> </span>" + "<br> <div style='margin-top:4px; border-radius:5px; background-color:"+hoplo[1]+"; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
			 	}	
			 	
			 	jQuery('#widgetDiv').fadeIn();

	 		},500);
	 	}
	 	else
	 	{
	 		setTimeout(function() {
			 	jQuery('#answers_div').empty();		 						 	

			 	for(i=1; i<=k; i++)
			 	{
			 		jQuery('#answers_div').append("<span  style='color:"+ans_color+";font-family:"+ans_font_family+";font-size:"+ans_font_size+"'>"+ answers[i-1] + "</span>" + "<span style='margin-left:5px; color:"+hoplo[1]+"'> &nbsp; <i>"+ parseFloat(widths[i-1]).toFixed(1)+'%' +' ('+ (parseInt(results[i-1])+' votes') + ')' + "</i> </span>" + "<br> <div style='border-radius:5px; margin-top:4px; background-color:"+hoplo[1]+"; width:" + (parseFloat(widths[i-1]).toFixed(1)+'%') + "; height:10px; '> </div>");				 		
			 	}	
			 	
			 	jQuery('#widgetDiv').fadeIn();

	 		},500);	 		
	 	}
		document.cookie="username=customer1"+Active_question.trim()+";";
	});
}
function GetFont_Size_of_Question()
{
	var Question_Font_Size=jQuery('#JunaITPollQuestion').css('font-size');
	var Questions_Font_Size=Question_Font_Size.split('px');
	if(Questions_Font_Size[0]<20)
	{
		jQuery('#JunaITPollQuestion').css('margin-top','10px');
	}
	else
	{
		jQuery('#JunaITPollQuestion').css('margin-top','0px');
	}
}