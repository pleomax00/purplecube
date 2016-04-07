jQuery(document).ready(function() {	
	Juna_IT_Poll_Width();
});

function Juna_IT_Poll_Add_Answers(answers_count)
{
	for(i=1; i<=10; i++)
	{
		if(i<=answers_count)
		{
			jQuery(".Juna_IT_Poll_PT1_Div"+i).fadeIn();
			jQuery("#Juna_IT_Poll_PT2_Answer_"+i).fadeIn();	
			jQuery("#Juna_IT_Poll_PT3_Div"+i).fadeIn();
			jQuery("#Juna_IT_Poll_PT4_Div"+i).fadeIn();
		}
		else
		{					
			jQuery(".Juna_IT_Poll_PT1_Div"+i).fadeOut();
			jQuery("#Juna_IT_Poll_PT2_Answer_"+i).fadeOut();	
			jQuery("#Juna_IT_Poll_PT3_Div"+i).fadeOut();
			jQuery("#Juna_IT_Poll_PT4_Div"+i).fadeOut();
		}
	}		
}

function Juna_IT_Poll_Create_New_Poll_Clicked()
{
	jQuery('#Juna_IT_Poll_main_first_div').fadeOut();
	jQuery('#Juna_IT_Poll_hidden_Button').val('Save');
	jQuery('#Juna_IT_Poll_Save_Button').val('Save Poll');
	setTimeout(function(){
		jQuery('#Juna_IT_Poll_main_second_div').fadeIn(); 
	}, 500);
}
function Delete_Juna_IT_Poll(Juna_IT_Poll_id)
{
	var ajaxurl = object.ajaxurl;
	var data = {
	action: 'Delete_Juna_IT_Poll_Click', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
	foobar: Juna_IT_Poll_id, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		location.reload();
	});
}
function Edit_Juna_IT_Poll(Juna_IT_Poll_id,Juna_IT_Poll_PluginType)
{
	jQuery('#Juna_IT_Poll_main_first_div').fadeOut();
	Juna_IT_Poll_Image_Fieldset(Juna_IT_Poll_PluginType);	
	jQuery('#Juna_IT_Poll_Plugin_Type_Text_Readonly').val(Juna_IT_Poll_PluginType);
	jQuery('#Juna_IT_Poll_hidden_Button').val('Update');
	jQuery('#Juna_IT_Poll_Save_Button').val('Update');
	setTimeout(function(){
		jQuery('#Juna_IT_Poll_main_second_div').fadeIn(); 
		var ajaxurl = object.ajaxurl;
		var data = {
		action: 'Edit_Juna_IT_Poll_Click', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: Juna_IT_Poll_id, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			var question_and_params=response.split('$#@#$');
			var quest_and_set=question_and_params[0].split('%^&^%');
			// question
			jQuery('#question_id').val(quest_and_set[0]);
				jQuery('.Juna_IT_Poll_Question_Field_Span').html(quest_and_set[0]);
				jQuery('#Juna_IT_Poll_Add_Question_Field').val(quest_and_set[0]);
			// Question font family
			jQuery('#Juna_IT_Poll_Question_Font_Family').val(quest_and_set[1]);
				jQuery('.Juna_IT_Poll_Question_Field_Span').css('font-family',quest_and_set[1]);
			// Question font size
			var Quest_font_size=quest_and_set[2].split('px');
			jQuery('#Juna_IT_Poll_Question_Font_Size_Range').val(Quest_font_size[0]);
			jQuery('#Juna_IT_Poll_Question_Font_Size_Number').val(Quest_font_size[0]);			
				jQuery('.Juna_IT_Poll_Question_Field_Span').css('font-size',quest_and_set[2]);
			// Question background color
			jQuery('#Juna_IT_Poll_Question_Bg_Text').val(quest_and_set[3]);
			jQuery('#Juna_IT_Poll_Question_Bg_Color').val(quest_and_set[3]);
				jQuery('.questions_title').css('background-color',quest_and_set[3]);
			//Question color
			jQuery('#Juna_IT_Poll_Question_Text').val(quest_and_set[4]);
			jQuery('#Juna_IT_Poll_Question_Color').val(quest_and_set[4]);
				jQuery('.Juna_IT_Poll_Question_Field_Span').css('color',quest_and_set[4]);
			// Question border style
			jQuery('#Juna_IT_Poll_Question_Border_Style').val(quest_and_set[5]);
				jQuery('.questions_title').css('border-style',quest_and_set[5]);
			// Question border width
			var Quest_border_width=quest_and_set[6].split('px');
			jQuery('#Juna_IT_Poll_Question_Border_Width_Range').val(Quest_border_width[0]);
			jQuery('#Juna_IT_Poll_Question_Border_Width_Number').val(Quest_border_width[0]);			
				jQuery('.questions_title').css('border-width',quest_and_set[6]);
			// Question border radius
			var Quest_border_radius=quest_and_set[7].split('px');
			jQuery('#Juna_IT_Poll_Question_Border_Radius_Range').val(Quest_border_radius[0]);
			jQuery('#Juna_IT_Poll_Question_Border_Radius_Number').val(Quest_border_radius[0]);			
				jQuery('.questions_title').css('border-radius',quest_and_set[7]);
			//Question border color
			jQuery('#Juna_IT_Poll_Question_Border_Text').val(quest_and_set[8]);
			jQuery('#Juna_IT_Poll_Question_Border_Color').val(quest_and_set[8]);
				jQuery('.questions_title').css('border-color',quest_and_set[8]);
			// Answer font family
			jQuery('#Juna_IT_Poll_Answer_Font_Family').val(quest_and_set[9]);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('font-family',quest_and_set[9]);
			// Answer font size
			var Ans_font_size=quest_and_set[10].split('px');
			jQuery('#Juna_IT_Poll_Answer_Font_Size_Range').val(Ans_font_size[0]);
			jQuery('#Juna_IT_Poll_Answer_Font_Size_Number').val(Ans_font_size[0]);			
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('font-size',quest_and_set[10]);
			// Answer background color	
			jQuery('#Juna_IT_Poll_Answer_Bg_Text').val(quest_and_set[11]);
			jQuery('#Juna_IT_Poll_Answer_Bg_Color').val(quest_and_set[11]);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('background-color',quest_and_set[11]);
				jQuery('.Juna_IT_Poll_PT3_Div').css('background-color',quest_and_set[11]);
			// Answer color
			jQuery('#Juna_IT_Poll_Answer_Text').val(quest_and_set[12]);
			jQuery('#Juna_IT_Poll_Answer_Color').val(quest_and_set[12]);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('color',quest_and_set[12]);
			// Answer border style
			jQuery('#Juna_IT_Poll_Answer_Border_Style').val(quest_and_set[13]);
				jQuery('.Juna_IT_Poll_Answer_Div').css('border-style',quest_and_set[13]);
			// Answer border width
			var Ans_border_width=quest_and_set[14].split('px');
			jQuery('#Juna_IT_Poll_Answer_Border_Width_Range').val(Ans_border_width[0]);
			jQuery('#Juna_IT_Poll_Answer_Border_Width_Number').val(Ans_border_width[0]);
				jQuery('.Juna_IT_Poll_Answer_Div').css('border-width',quest_and_set[14]);
			// Answer border radius
			var Ans_border_radius=quest_and_set[15].split('px');
			jQuery('#Juna_IT_Poll_Answer_Border_Radius_Range').val(Ans_border_radius[0]);
			jQuery('#Juna_IT_Poll_Answer_Border_Radius_Number').val(Ans_border_radius[0]);
				jQuery('.Juna_IT_Poll_Answer_Div').css('border-radius',quest_and_set[15]);
				for(var i=1;i<=10;i++)
				{
					jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-top-right-radius',quest_and_set[15]);
					jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-bottom-right-radius',quest_and_set[15]);
				}
			// Answer border color
			jQuery('#Juna_IT_Poll_Answer_Border_Text').val(quest_and_set[16]);
			jQuery('#Juna_IT_Poll_Answer_Border_Color').val(quest_and_set[16]);
				jQuery('.Juna_IT_Poll_Answer_Div').css('border-color',quest_and_set[16]);
			// Answer Between
			var Ans_between=quest_and_set[17].split('px');
			jQuery('#Juna_IT_Poll_Between_Answer_Range').val(Ans_between[0]);
			jQuery('#Juna_IT_Poll_Between_Answer_Number').val(Ans_between[0]);			
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('margin-top',quest_and_set[17]);
				jQuery('.Juna_IT_Poll_PT3_Div').css('margin-top',quest_and_set[17]);
			// Widget width
			var Widget_width=quest_and_set[18].split('px');
			jQuery('#Juna_IT_Poll_Widget_Width_Range').val(Widget_width[0]);
			jQuery('#Juna_IT_Poll_Widget_Width_Number').val(Widget_width[0]);			
				jQuery('.plugins_type').css('width',quest_and_set[18]);
			// Widget background color
			jQuery('#Juna_IT_Poll_Background_Text').val(quest_and_set[19]);
			jQuery('#Juna_IT_Poll_Background_Color').val(quest_and_set[19]);
				jQuery('.plugins_type').css('background-color',quest_and_set[19]);
			// Widget border width
			var Widget_border_width=quest_and_set[20].split('px');
			jQuery('#Juna_IT_Poll_Widget_Border_Width_Range').val(Widget_border_width[0]);
			jQuery('#Juna_IT_Poll_Widget_Border_Width_Number').val(Widget_border_width[0]);			
				jQuery('.plugins_type').css('border-width',quest_and_set[20]);
			// Widget border radius
			var Widget_border_radius=quest_and_set[21].split('px');
			jQuery('#Juna_IT_Poll_Widget_Border_Radius_Range').val(Widget_border_radius[0]);
			jQuery('#Juna_IT_Poll_Widget_Border_Radius_Number').val(Widget_border_radius[0]);			
				jQuery('.plugins_type').css('border-radius',quest_and_set[21]);
			// Widget border color
			jQuery('#Juna_IT_Poll_Border_Text').val(quest_and_set[22]);
			jQuery('#Juna_IT_Poll_Border_Color').val(quest_and_set[22]);
				jQuery('.plugins_type').css('border-color',quest_and_set[22]);
			// Widget border style
			jQuery('#Juna_IT_Poll_Widget_Border_Style').val(quest_and_set[23]); 
				jQuery('.plugins_type').css('border-style',quest_and_set[23]);
			// Votes Type radio
			jQuery(':radio').each(function(){
				if(jQuery(this).val()==quest_and_set[24])
				{					
					jQuery(this).attr('checked','checked');
				}
			})
			// Vote Color
			jQuery('#Juna_IT_Poll_Vote_Text').val(quest_and_set[25]);
			jQuery('#Juna_IT_Poll_Vote_Color').val(quest_and_set[25]);
			// Vote Button Color
			jQuery('#Juna_IT_Poll_Vote_Button_Text').val(quest_and_set[26]);
			jQuery('#Juna_IT_Poll_Vote_Button_Color').val(quest_and_set[26]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('background-color',quest_and_set[26]);
			// Vote Button Text Color
			jQuery('#Juna_IT_Poll_Vote_Button_Color_Text').val(quest_and_set[27]);
			jQuery('#Juna_IT_Poll_Vote_Button_Color_Color').val(quest_and_set[27]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('color',quest_and_set[27]);	
			// Margin Right
			var But_Margin_Right=quest_and_set[28].split('px');
			jQuery('#Juna_IT_Poll_Margin_Right_Range').val(But_Margin_Right[0]);
			jQuery('#Juna_IT_Poll_Margin_Right_Number').val(But_Margin_Right[0]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('margin-right',quest_and_set[28]);
			// Button Width
			var But_Width=quest_and_set[29].split('px');
			jQuery('#Juna_IT_Poll_Button_Width_Range').val(But_Width[0]);
			jQuery('#Juna_IT_Poll_Button_Width_Number').val(But_Width[0]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('width',quest_and_set[29]);
			// Button Border Radius
			var But_Border_Radius=quest_and_set[30].split('px');
			jQuery('#Juna_IT_Poll_Button_Border_Radius_Range').val(But_Border_Radius[0]);
			jQuery('#Juna_IT_Poll_Button_Border_Radius_Number').val(But_Border_Radius[0]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('border-radius',quest_and_set[30]);
			// Button Font Family
			jQuery('#Juna_IT_Poll_Button_Font_Family').val(quest_and_set[31]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('font-family',quest_and_set[31]);
			// Button Font Size
			var But_Font_Size=quest_and_set[32].split('px');
			jQuery('#Juna_IT_Poll_Button_Font_Size_Range').val(But_Font_Size[0]);
			jQuery('#Juna_IT_Poll_Button_Font_Size_Number').val(But_Font_Size[0]);
				jQuery('#Juna_IT_Poll_Vote_Button').css('font-size',quest_and_set[32]);
			// Button Text
			jQuery('#Juna_IT_Poll_Button_Text').val(quest_and_set[33].toUpperCase());
				jQuery('#Juna_IT_Poll_Vote_Button').val(quest_and_set[33].toUpperCase());
			// Images Width
			var Images_Width=quest_and_set[34].split('px');
			jQuery('#Juna_IT_Poll_Image_Width_Range').val(Images_Width[0]);
			jQuery('#Juna_IT_Poll_Image_Width_Number').val(Images_Width[0]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('width',quest_and_set[34]);
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('width',quest_and_set[34]);
			}
			// Images Height
			var Images_Height=quest_and_set[35].split('px');
			jQuery('#Juna_IT_Poll_Image_Height_Range').val(Images_Height[0]);
			jQuery('#Juna_IT_Poll_Image_Height_Number').val(Images_Height[0]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('height',quest_and_set[35]);
			}
			// Image Border Width
			var Images_Border_Width=quest_and_set[36].split('px');
			jQuery('#Juna_IT_Poll_Image_Border_Width_Range').val(Images_Border_Width[0]);
			jQuery('#Juna_IT_Poll_Image_Border_Width_Number').val(Images_Border_Width[0]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-width',quest_and_set[36]);
			}
			// Image Border Radius
			var Images_Border_Radius=quest_and_set[37].split('px');
			jQuery('#Juna_IT_Poll_Image_Border_Radius_Range').val(Images_Border_Radius[0]);
			jQuery('#Juna_IT_Poll_Image_Border_Radius_Number').val(Images_Border_Radius[0]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('border-radius',quest_and_set[37]);
			}
			// Image Div Border Radius
			var Div_Images_Border_Radius=quest_and_set[38].split('px');
			jQuery('#Juna_IT_Poll_Div_Border_Radius_Range').val(Div_Images_Border_Radius[0]);
			jQuery('#Juna_IT_Poll_Div_Border_Radius_Number').val(Div_Images_Border_Radius[0]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-radius',quest_and_set[38]);
			}
			// Image Border Color
			jQuery('#Juna_IT_Poll_Image_Border_Color_Text').val(quest_and_set[39]);
			jQuery('#Juna_IT_Poll_Image_Border_Color_Color').val(quest_and_set[39]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-color',quest_and_set[39]);
			}
			// Image Border Style
			jQuery('#Juna_IT_Poll_Image_Border_Style').val(quest_and_set[40]);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-style',quest_and_set[40]);
			}

			var answer_and_ansset=question_and_params[1].split(')^%^(');

			// quest_and_set[41] count answer
			Juna_IT_Poll_Add_Answers(quest_and_set[41]);
			jQuery('#Juna_IT_Poll_hidden_Field_for_Number').val(quest_and_set[42]);

			jQuery('#Juna_IT_Poll_Hidden_Value').val(quest_and_set[41]);
			if(quest_and_set[41]>2)
			{
				jQuery('#Juna_IT_Poll_Remove_Answer_Button').css('display','inline');
			}

			for(i=0;i<quest_and_set[41];i++)
			{
				if(parseInt(i+1)>2)
				{
					jQuery('.Juna_IT_Poll_Answer_'+parseInt(i+1)).fadeIn();
				}	
				Juna_IT_Poll_Width();	

				answers_and_anssets=answer_and_ansset[i].split('%***%');

				// answers
				jQuery('#Juna_IT_Poll_Answers_Input_'+parseInt(i+1)).val(answers_and_anssets[0]);
					jQuery('#Juna_IT_Poll_PT1_Answer_'+parseInt(i+1)).text(answers_and_anssets[0]);
					jQuery('#Juna_IT_Poll_PT2_Answer_'+parseInt(i+1)).text(answers_and_anssets[0]);
					jQuery('#Juna_IT_Poll_PT3_Answer_'+parseInt(i+1)).text(answers_and_anssets[0]);
					jQuery('#Juna_IT_Poll_PT4_Answer_'+parseInt(i+1)).text(answers_and_anssets[0]);
				// Answer_bg_color
				jQuery('#Juna_IT_Poll_Add_Answer_Bg_Text'+parseInt(i+1)).val(answers_and_anssets[2]);
					jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color'+parseInt(i+1)).val(answers_and_anssets[2]);
					jQuery('#Juna_IT_Poll_PT2_Answer_'+parseInt(i+1)).css('background-color',answers_and_anssets[2]);
					jQuery('#Juna_IT_Poll_Set_Color_'+parseInt(i+1)).css('background-color',answers_and_anssets[2]);
					jQuery('#Juna_IT_Poll_PT4_Div'+parseInt(i+1)).css('border-color',answers_and_anssets[2]);
				// file
				if(answers_and_anssets[1]!='none')
				{
					jQuery('#Juna_IT_Poll_Upload_Image_'+parseInt(i+1)).val(answers_and_anssets[1]);
					jQuery('#Juna_IT_Poll_Image_'+parseInt(i+1)+'').attr('src',answers_and_anssets[1]);
				}
			}
		});
	}, 500);
}
function Juna_IT_Poll_Search_Question()
{
	setInterval(function(){
		var Juna_IT_Poll_Searched_Question=jQuery('#Juna_IT_Poll_search_text_field').val();
		if(Juna_IT_Poll_Searched_Question!='')
		{
			var ajaxurl = object.ajaxurl;
			var data = {
			action: 'Search_Juna_IT_Poll_Click', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: Juna_IT_Poll_Searched_Question, // translates into $_POST['foobar'] in PHP
			};
			jQuery.post(ajaxurl, data, function(response) {
				if(response=='')
				{
					jQuery('#searched_question_does_not_exist').html('* Requested Question does not exist!');
					jQuery('.Juna_IT_Poll_Table1').hide();
					jQuery('.Juna_IT_Poll_Table').show();
				}
				else
				{
					jQuery('#searched_question_does_not_exist').html('');
					jQuery('.Juna_IT_Poll_Table').hide();
					jQuery('.Juna_IT_Poll_Table1').show();
					jQuery('.Juna_IT_Poll_Table1').empty();

					var searched_params=response.split(')&*&(');
					for(i=0;i<parseInt(searched_params.length-1);i++)
					{
						searched_params_callback=searched_params[i].split("^%^");
						if(searched_params_callback[2]==1)
						{
							var plugins_type_span='Standart Poll';
						}
						else if(searched_params_callback[2]==2)
						{
							var plugins_type_span='Pie Chart';
						}
						else if(searched_params_callback[2]==3)
						{
							var plugins_type_span='Image/Video';
						}
						else
						{
							var plugins_type_span='Column Chart';
						}

						jQuery('.Juna_IT_Poll_Table1').append("<tr><td class='Juna_IT_Poll_id_item'><B><I>"+parseInt(i+1)+"</I></B></td><td class='Juna_IT_Poll_title_item'><B><I>"+searched_params_callback[1]+"</I></B></td><td class='Juna_IT_Poll_type_item'><B><I>"+plugins_type_span+"</I></B></td><td class='Juna_IT_Poll_edit_item' onclick='Edit_Juna_IT_Poll("+searched_params_callback[0]+','+searched_params_callback[2]+")'><B><I>Edit</I></B></td><td class='Juna_IT_Poll_delete_item' onclick='Delete_Juna_IT_Poll("+searched_params_callback[0]+")'><B><I>Delete</I></B></td></tr>");
					}
				}
			});
		}
		else
		{
			jQuery('.Juna_IT_Poll_Table1').hide();
			jQuery('.Juna_IT_Poll_Table').show();
		}
	}, 600);
}
function Juna_IT_Poll_Reset_Button_Clicked()
{
	jQuery('#Juna_IT_Poll_search_text_field').val('');
	jQuery('#searched_question_does_not_exist').html('');
	jQuery('.Juna_IT_Poll_Table1').hide();
	jQuery('.Juna_IT_Poll_Table').show();
}
//Stepan//
function Juna_IT_Poll_Buttons_Clicked(Button_Number)
{
	for(var i=1;i<=5;i++)
	{
		if(i==Button_Number)
		{
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('border-color','#f68935');
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('color','#f68935');
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('box-shadow','0px 0px 30px #f68935');
		}
		else
		{
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('border-color','#0073aa');
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('color','white');
			jQuery('#Juna_IT_Poll_Admin_Menu_Button_'+i).css('box-shadow','0px 0px 30px white');
		}
	}
	if(Button_Number==1)
	{
		jQuery('#Juna_IT_Poll_Question_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Answers_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Widget_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answers_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Select_Poll_Type').css('display','inline');
		jQuery('#Juna_IT_Poll_Save_Button').fadeOut();
		for(var i=1;i<=4;i++)
		{
			jQuery('#plugins_type'+i).css('display','none');
		}
	}
	else if(Button_Number==2)
	{
		jQuery('#Juna_IT_Poll_Question_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Answers_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Widget_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answers_Field').css('display','inline');
		jQuery('#Juna_IT_Poll_Save_Button').fadeIn();
		jQuery('#Juna_IT_Poll_Select_Poll_Type').css('display','none');		
	}	
	else if(Button_Number==3)
	{
		jQuery('#Juna_IT_Poll_Question_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Answers_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Widget_Style_Field').css('display','inline');
		jQuery('#Juna_IT_Poll_Add_Answers_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Save_Button').fadeIn();
		jQuery('#Juna_IT_Poll_Select_Poll_Type').css('display','none');		
	}	
	else if(Button_Number==4)
	{
		jQuery('#Juna_IT_Poll_Question_Style_Field').css('display','inline');
		jQuery('#Juna_IT_Poll_Answers_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Widget_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answers_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Save_Button').fadeIn();
		jQuery('#Juna_IT_Poll_Select_Poll_Type').css('display','none');		
	}
	else if(Button_Number==5)
	{
		jQuery('#Juna_IT_Poll_Question_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Answers_Style_Field').css('display','inline');
		jQuery('#Juna_IT_Poll_Widget_Style_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answers_Field').css('display','none');
		jQuery('#Juna_IT_Poll_Save_Button').fadeIn();
		jQuery('#Juna_IT_Poll_Select_Poll_Type').css('display','none');	
	}
	if(Button_Number!=1)
	{
		var Juna_IT_Poll_Plugin_Type=jQuery('#Juna_IT_Poll_Plugin_Type_Text_Readonly').val();

		if(Juna_IT_Poll_Plugin_Type!=1)
		{
			jQuery('#Juna_IT_Poll_Free_Span_1').css('display','inline');
			jQuery('#Juna_IT_Poll_Free_Span_2').css('display','inline');
			jQuery('#Juna_IT_Poll_Free_Span_3').css('display','none');
			jQuery('#Juna_IT_Poll_Save_Button').hide();
			jQuery('.Juna_IT_Poll_Hidden_Span').hide();
		}
		else
		{
			jQuery('#Juna_IT_Poll_Free_Span_1').css('display','none');
			jQuery('#Juna_IT_Poll_Free_Span_2').css('display','none');
			jQuery('#Juna_IT_Poll_Free_Span_3').css('display','block');
			jQuery('#Juna_IT_Poll_Save_Button').show();
			jQuery('.Juna_IT_Poll_Hidden_Span').show();
		}
		for(var i=1;i<=4;i++)
		{
			if(i==Juna_IT_Poll_Plugin_Type)
			{
				jQuery('#plugins_type'+i).css('display','inline');
			}
			else
			{
				jQuery('#plugins_type'+i).css('display','none');
			}
		}
	}
	else
	{
		jQuery('.plugins_type').css('display','none');
	}	
}
function Juna_IT_Poll_Image_Fieldset(number)
{
	for(var i=1;i<=4;i++)
	{
		if(i==number)
		{
			jQuery('.Juna_IT_Poll_Image_Class'+number+'').css('border-color','#f68935');
			jQuery('.Juna_IT_Poll_Image_Legend_Class'+number+'').css('color','#f68935');
		}
		else
		{
			jQuery('.Juna_IT_Poll_Image_Class'+i+'').css('border-color','#0073aa');
			jQuery('.Juna_IT_Poll_Image_Legend_Class'+i+'').css('color','#0073aa');
		}		
	}
	if(number==1)
	{
		jQuery('#Juna_IT_Poll_Vote_Type_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Vote_Button_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Image_Style_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answer_File_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Border_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_bg_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_Border_Color_Table').css('display','inline');
	}
	else if(number==2)
	{
		jQuery('#Juna_IT_Poll_Vote_Type_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Vote_Button_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Image_Style_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Add_Answer_File_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Border_Table').css('display','inline');	
		jQuery('#Juna_IT_Poll_Answer_Border_Color_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_bg_Table').css('display','none');
	}	
	else if(number==3)
	{
		jQuery('#Juna_IT_Poll_Vote_Type_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Vote_Button_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Image_Style_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answer_File_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_bg_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_Border_Color_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Border_Table').css('display','none');		
	}
	else
	{
		jQuery('#Juna_IT_Poll_Vote_Type_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Vote_Button_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Image_Style_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Add_Answer_File_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Answer_bg_Table').css('display','inline');
		jQuery('#Juna_IT_Poll_Answer_Border_Color_Table').css('display','none');
		jQuery('#Juna_IT_Poll_Border_Table').css('display','inline');		
	}	
	jQuery('#Juna_IT_Poll_Plugin_Type_Text_Readonly').val(number);
	Juna_IT_Poll_Buttons_Clicked(2);
}
function Juna_IT_Poll_Change_Button_Text()
{
	setInterval(function(){
		var Juna_IT_Poll_Button_Text_Field=jQuery('#Juna_IT_Poll_Button_Text').val();
		if(Juna_IT_Poll_Button_Text_Field!='')
		{
			jQuery('#Juna_IT_Poll_Vote_Button').val(Juna_IT_Poll_Button_Text_Field.toUpperCase());
		}
		else
		{
			jQuery('#Juna_IT_Poll_Vote_Button').val('VOTE');
		}
	},100)
}
function Juna_IT_Poll_Add_Question_Field_Click()
{
	setInterval(function(){
		var Juna_IT_Poll_Add_Question_Field=jQuery('#Juna_IT_Poll_Add_Question_Field').val();
		if(Juna_IT_Poll_Add_Question_Field!='')
		{
			jQuery('.Juna_IT_Poll_Question_Field_Span').html(Juna_IT_Poll_Add_Question_Field);
		}
		else
		{
			jQuery('.Juna_IT_Poll_Question_Field_Span').html('Question?');
		}
	},100)
}
function Juna_IT_Poll_Add_Answer(Which_Answer)
{
	setInterval(function(){
		var Juna_IT_Poll_Add_Answer_Field=jQuery('#Juna_IT_Poll_Answers_Input_'+Which_Answer+'').val();
		if(Juna_IT_Poll_Add_Answer_Field!='')
		{
			jQuery('#Juna_IT_Poll_PT1_Answer_'+Which_Answer+'').html(Juna_IT_Poll_Add_Answer_Field);
			jQuery('#Juna_IT_Poll_PT2_Answer_'+Which_Answer+'').html(Juna_IT_Poll_Add_Answer_Field);
			jQuery('#Juna_IT_Poll_PT3_Answer_'+Which_Answer+'').html(Juna_IT_Poll_Add_Answer_Field);
			jQuery('#Juna_IT_Poll_PT4_Answer_'+Which_Answer+'').html(Juna_IT_Poll_Add_Answer_Field);
		}
		else
		{
			jQuery('#Juna_IT_Poll_PT1_Answer_'+Which_Answer+'').html('Answer'+Which_Answer+'');
			jQuery('#Juna_IT_Poll_PT2_Answer_'+Which_Answer+'').html('Answer'+Which_Answer+'');
			jQuery('#Juna_IT_Poll_PT3_Answer_'+Which_Answer+'').html('Answer'+Which_Answer+'');
			jQuery('#Juna_IT_Poll_PT4_Answer_'+Which_Answer+'').html('Answer'+Which_Answer+'');
		}
	},100)
}
function Juna_IT_Poll_Change_Font(Change_What)
{
	if(Change_What=='Question')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Question_Font_Family').val();
		jQuery('.Juna_IT_Poll_Question_Field_Span').css('font-family',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Border_Style')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Question_Border_Style').val();
		jQuery('.questions_title').css('border-style',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Answer')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Answer_Font_Family').val();
		jQuery('.Juna_IT_Poll_Answer_Div_P').css('font-family',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Border_Style_Widget')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Widget_Border_Style').val();
		jQuery('.plugins_type').css('border-style',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Border_Style_Answer')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Answer_Border_Style').val();
		jQuery('.Juna_IT_Poll_Answer_Div').css('border-style',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Button_Font_Family')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Button_Font_Family').val();
		jQuery('#Juna_IT_Poll_Vote_Button').css('font-family',Juna_IT_Poll_Font);
	}
	else if(Change_What=='Border_Style_Image')
	{
		var Juna_IT_Poll_Font=jQuery('#Juna_IT_Poll_Image_Border_Style').val();
		for(var i=1;i<=10;i++)
		{
			jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-style',Juna_IT_Poll_Font);
		}
	}
}
function Juna_IT_Poll_Change_Size(What_Size,type)
{
	if(type=='true')
	{
		if(What_Size=='Question')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Question_Font_Size_Number').val();
			jQuery('#Juna_IT_Poll_Question_Font_Size_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Question_Field_Span').css('font-size',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Question_Border_Width_Number').val();
			jQuery('#Juna_IT_Poll_Question_Border_Width_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.questions_title').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Question_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Question_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.questions_title').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Font_Size_Number').val();
			jQuery('#Juna_IT_Poll_Answer_Font_Size_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('font-size',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Width_Answer') 
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Border_Width_Number').val();
			jQuery('#Juna_IT_Poll_Answer_Border_Width_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Radius_Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Answer_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-radius',Juna_IT_Poll_Font_size+'px');
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-top-right-radius',Juna_IT_Poll_Font_size+'px');
				jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-bottom-right-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Between_Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Between_Answer_Number').val();
			jQuery('#Juna_IT_Poll_Between_Answer_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('margin-top',Juna_IT_Poll_Font_size+'px');
			jQuery('.Juna_IT_Poll_PT3_Div').css('margin-top',Juna_IT_Poll_Font_size+'px');
			jQuery('.Juna_IT_Poll_PT4_Span_p').css('margin','5px');
		}
		else if(What_Size=='Widget_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Width_Number').val();
			jQuery('#Juna_IT_Poll_Widget_Width_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Widget_Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Border_Width_Number').val();
			jQuery('#Juna_IT_Poll_Widget_Border_Width_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Widget_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Widget_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Margin_Right')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Margin_Right_Number').val();
			jQuery('#Juna_IT_Poll_Margin_Right_Range').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('margin-right',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Width_Number').val();
			jQuery('#Juna_IT_Poll_Button_Width_Range').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Button_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Font_Size')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Font_Size_Number').val();
			jQuery('#Juna_IT_Poll_Button_Font_Size_Range').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('font-size',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Image_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Width_Number').val();
			jQuery('#Juna_IT_Poll_Image_Width_Range').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('width',Juna_IT_Poll_Font_size+'px');
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('width',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Height')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Height_Number').val();
			jQuery('#Juna_IT_Poll_Image_Height_Range').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('height',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Border_Width_Number').val();
			jQuery('#Juna_IT_Poll_Image_Border_Width_Range').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-width',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Image_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('border-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Div_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Div_Border_Radius_Number').val();
			jQuery('#Juna_IT_Poll_Div_Border_Radius_Range').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
	}
	else
	{
		if(What_Size=='Question')
		{
			var Font_size=jQuery('#Juna_IT_Poll_Question_Font_Size_Range').val();
			jQuery('#Juna_IT_Poll_Question_Font_Size_Number').val(Font_size);
			jQuery('.Juna_IT_Poll_Question_Field_Span').css('font-size',Font_size+'px');
		}
		else if(What_Size=='Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Question_Border_Width_Range').val();
			jQuery('#Juna_IT_Poll_Question_Border_Width_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.questions_title').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Question_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Question_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.questions_title').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Font_Size_Range').val();
			jQuery('#Juna_IT_Poll_Answer_Font_Size_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('font-size',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Width_Answer') 
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Border_Width_Range').val();
			jQuery('#Juna_IT_Poll_Answer_Border_Width_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Border_Radius_Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Answer_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Answer_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-radius',Juna_IT_Poll_Font_size+'px');
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-top-right-radius',Juna_IT_Poll_Font_size+'px');
				jQuery('#Juna_IT_Poll_Set_Color_'+i).css('border-bottom-right-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Between_Answer')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Between_Answer_Range').val();
			jQuery('#Juna_IT_Poll_Between_Answer_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('margin-top',Juna_IT_Poll_Font_size+'px');
			jQuery('.Juna_IT_Poll_PT3_Div').css('margin-top',Juna_IT_Poll_Font_size+'px');
			jQuery('.Juna_IT_Poll_PT4_Span_p').css('margin','5px');
		}
		else if(What_Size=='Widget_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Width_Range').val();
			jQuery('#Juna_IT_Poll_Widget_Width_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Widget_Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Border_Width_Range').val();
			jQuery('#Juna_IT_Poll_Widget_Border_Width_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('border-width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Widget_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Widget_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Widget_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			jQuery('.plugins_type').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Margin_Right')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Margin_Right_Range').val();
			jQuery('#Juna_IT_Poll_Margin_Right_Number').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('margin-right',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Width_Range').val();
			jQuery('#Juna_IT_Poll_Button_Width_Number').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('width',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Button_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('border-radius',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Button_Font_Size')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Button_Font_Size_Range').val();
			jQuery('#Juna_IT_Poll_Button_Font_Size_Number').val(Juna_IT_Poll_Font_size);
			jQuery('#Juna_IT_Poll_Vote_Button').css('font-size',Juna_IT_Poll_Font_size+'px');
		}
		else if(What_Size=='Image_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Width_Range').val();
			jQuery('#Juna_IT_Poll_Image_Width_Number').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('width',Juna_IT_Poll_Font_size+'px');
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('width',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Height')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Height_Range').val();
			jQuery('#Juna_IT_Poll_Image_Height_Number').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('height',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Border_Width')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Border_Width_Range').val();
			jQuery('#Juna_IT_Poll_Image_Border_Width_Number').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-width',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Image_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Image_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Image_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_Image_'+i+'').css('border-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
		else if(What_Size=='Div_Border_Radius')
		{
			var Juna_IT_Poll_Font_size=jQuery('#Juna_IT_Poll_Div_Border_Radius_Range').val();
			jQuery('#Juna_IT_Poll_Div_Border_Radius_Number').val(Juna_IT_Poll_Font_size);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-radius',Juna_IT_Poll_Font_size+'px');
			}
		}
		
	}
}
function Juna_IT_Poll_Change_Color(pickerID,type)
{

	var Juna_IT_Poll_Colors = ["aliceblue:#f0f8ff","antiquewhite:#faebd7","aqua:#00ffff",
	"aquamarine:#7fffd4","azure:#f0ffff", "beige:#f5f5dc","bisque:#ffe4c4",
	"black:#000000","blanchedalmond:#ffebcd","blue:#0000ff","blueviolet:#8a2be2",
	"brown:#a52a2a","burlywood:#deb887", "cadetblue:#5f9ea0","chartreuse:#7fff00",
	"chocolate:#d2691e","coral:#ff7f50","cornflowerblue:#6495ed","cornsilk:#fff8dc",
	"crimson:#dc143c","cyan:#00ffff", "darkblue:#00008b","darkcyan:#008b8b",
	"darkgoldenrod:#b8860b","darkgray:#a9a9a9","darkgreen:#006400","darkkhaki:#bdb76b",
	"darkmagenta:#8b008b","darkolivegreen:#556b2f", "darkorange:#ff8c00","darkorchid:#9932cc",
	"darkred:#8b0000","darksalmon:#e9967a","darkseagreen:#8fbc8f","darkslateblue:#483d8b",
	"darkslategray:#2f4f4f","darkturquoise:#00ced1", "darkviolet:#9400d3","deeppink:#ff1493",
	"deepskyblue:#00bfff","dimgray:#696969","dodgerblue:#1e90ff", "firebrick:#b22222",
	"floralwhite:#fffaf0","forestgreen:#228b22","fuchsia:#ff00ff", "gainsboro:#dcdcdc",
	"ghostwhite:#f8f8ff","gold:#ffd700","goldenrod:#daa520","gray:#808080","green:#008000",
	"greenyellow:#adff2f", "honeydew:#f0fff0","hotpink:#ff69b4", "indianred :#cd5c5c",
	"indigo:#4b0082","ivory:#fffff0","khaki:#f0e68c", "lavender:#e6e6fa","lavenderblush:#fff0f5",
	"lawngreen:#7cfc00","lemonchiffon:#fffacd","lightblue:#add8e6","lightcoral:#f08080",
	"lightcyan:#e0ffff","lightgoldenrodyellow:#fafad2", "lightgrey:#d3d3d3","lightgreen:#90ee90",
	"lightpink:#ffb6c1","lightsalmon:#ffa07a","lightseagreen:#20b2aa","lightskyblue:#87cefa",
	"lightslategray:#778899","lightsteelblue:#b0c4de", "lightyellow:#ffffe0",
	"lime:#00ff00","limegreen:#32cd32","linen:#faf0e6", "magenta:#ff00ff","maroon:#800000",
	"mediumaquamarine:#66cdaa","mediumblue:#0000cd","mediumorchid:#ba55d3","mediumpurple:#9370d8",
	"mediumseagreen:#3cb371","mediumslateblue:#7b68ee", "mediumspringgreen:#00fa9a","mediumturquoise:#48d1cc",
	"mediumvioletred:#c71585","midnightblue:#191970","mintcream:#f5fffa","mistyrose:#ffe4e1",
	"moccasin:#ffe4b5", "navajowhite:#ffdead","navy:#000080", "oldlace:#fdf5e6","olive:#808000",
	"olivedrab:#6b8e23","orange:#ffa500","orangered:#ff4500","orchid:#da70d6", "palegoldenrod:#eee8aa",
	"palegreen:#98fb98","paleturquoise:#afeeee","palevioletred:#d87093","papayawhip:#ffefd5","peachpuff:#ffdab9",
	"peru:#cd853f","pink:#ffc0cb","plum:#dda0dd","powderblue:#b0e0e6","purple:#800080", "red:#ff0000",
	"rosybrown:#bc8f8f","royalblue:#4169e1", "saddlebrown:#8b4513","salmon:#fa8072","sandybrown:#f4a460",
	"seagreen:#2e8b57","seashell:#fff5ee","sienna:#a0522d","silver:#c0c0c0","skyblue:#87ceeb","slateblue:#6a5acd",
	"slategray:#708090","snow:#fffafa","springgreen:#00ff7f","steelblue:#4682b4", "tan:#d2b48c","teal:#008080",
	"thistle:#d8bfd8","tomato:#ff6347","turquoise:#40e0d0", "violet:#ee82ee", "wheat:#f5deb3","white:#ffffff",
	"whitesmoke:#f5f5f5", "yellow:#ffff00","yellowgreen:#9acd32"];   

	if(type=='false')
	{
		if(pickerID=='Question_Bg')
		{
			var Question_Bg=jQuery('#Juna_IT_Poll_Question_Bg_Color').val();
			jQuery('#Juna_IT_Poll_Question_Bg_Text').val(Question_Bg);
			jQuery('.questions_title').css('background-color',Question_Bg);			
		}	
		else if(pickerID=='Question_Color')
		{
			var Question_Color=jQuery('#Juna_IT_Poll_Question_Color').val();
			jQuery('#Juna_IT_Poll_Question_Text').val(Question_Color);
			jQuery('.Juna_IT_Poll_Question_Field_Span').css('color',Question_Color);
		}	
		else if(pickerID=='Border_Color')
		{
			var Border_Color=jQuery('#Juna_IT_Poll_Question_Border_Color').val();
			jQuery('#Juna_IT_Poll_Question_Border_Text').val(Border_Color);
			jQuery('.questions_title').css('border-color',Border_Color);
		}
		else if(pickerID=='Answer_Bg')
		{
			var Answer_Bg=jQuery('#Juna_IT_Poll_Answer_Bg_Color').val();
			jQuery('#Juna_IT_Poll_Answer_Bg_Text').val(Answer_Bg);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('background-color',Answer_Bg);
			jQuery('.Juna_IT_Poll_PT3_Div').css('background-color',Answer_Bg);
		}
		else if(pickerID=='Answer_Color')
		{
			var Answer_Color=jQuery('#Juna_IT_Poll_Answer_Color').val();
			jQuery('#Juna_IT_Poll_Answer_Text').val(Answer_Color);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('color',Answer_Color);
		}
		else if(pickerID=='Border_Color_Answer')
		{
			var Border_Color_Answer=jQuery('#Juna_IT_Poll_Answer_Border_Color').val();
			jQuery('#Juna_IT_Poll_Answer_Border_Text').val(Border_Color_Answer);
			jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-color',Border_Color_Answer);
		}
		else if(pickerID=='Background')
		{
			var Background=jQuery('#Juna_IT_Poll_Background_Color').val();
			jQuery('#Juna_IT_Poll_Background_Text').val(Background);
			jQuery('.plugins_type').css('background-color',Background);
		}
		else if(pickerID=='Widget_Border_Color')
		{
			var Border_Color=jQuery('#Juna_IT_Poll_Border_Color').val();
			jQuery('#Juna_IT_Poll_Border_Text').val(Border_Color);
			jQuery('.plugins_type').css('border-color',Border_Color);
		}
		else if(pickerID=='Vote_Color')
		{
			var Vote_Color=jQuery('#Juna_IT_Poll_Vote_Color').val();
			jQuery('#Juna_IT_Poll_Vote_Text').val(Vote_Color);
		}
		else if(pickerID=='Vote_Button_Color')
		{
			var Vote_Button_Color=jQuery('#Juna_IT_Poll_Vote_Button_Color').val();
			jQuery('#Juna_IT_Poll_Vote_Button_Text').val(Vote_Button_Color);
			jQuery('#Juna_IT_Poll_Vote_Button').css('background-color',Vote_Button_Color);			
		}
		else if(pickerID=='Vote_Button_Color_Color')
		{
			var Vote_Button_Color_Color=jQuery('#Juna_IT_Poll_Vote_Button_Color_Color').val();
			jQuery('#Juna_IT_Poll_Vote_Button_Color_Text').val(Vote_Button_Color_Color);
			jQuery('#Juna_IT_Poll_Vote_Button').css('color',Vote_Button_Color_Color);			
		}
		else if(pickerID=='Image_Border_Color')
		{
			var Image_Border_Color=jQuery('#Juna_IT_Poll_Image_Border_Color_Color').val();
			jQuery('#Juna_IT_Poll_Image_Border_Color_Text').val(Image_Border_Color);
			for(var i=1;i<=10;i++)
			{
				jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-color',Image_Border_Color);
			}
		}
		for(var i=1;i<=10;i++)
		{
			if(pickerID=='Add_Answer_Bg'+i)
			{
				var Add_Answer_Bg=jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color'+i).val();
				jQuery('#Juna_IT_Poll_Add_Answer_Bg_Text'+i).val(Add_Answer_Bg);
				
				jQuery('#Juna_IT_Poll_PT2_Answer_'+i).css('background-color',Add_Answer_Bg);
				jQuery('#Juna_IT_Poll_Set_Color_'+i).css('background-color',Add_Answer_Bg);
				jQuery('#Juna_IT_Poll_PT4_Div'+i).css('border-color',Add_Answer_Bg);
			}
		}		
	}
	else
	{
		if(pickerID=='Question_Bg')
		{
			var Question_Bg=jQuery('#Juna_IT_Poll_Question_Bg_Text').val().toLowerCase();

			if(Question_Bg[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Question_Bg_Color').val(Question_Bg);
				jQuery('.questions_title').css('background-color',Question_Bg);		
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Question_Bg)
					{	
						jQuery('#Juna_IT_Poll_Question_Bg_Color').val(k[1]);
						jQuery('.questions_title').css('background-color',k[1]);	
						break;
					}
					else
					{
						continue;
					}
				}
			}		
		}
		else if(pickerID=='Question_Color')
		{
			var Question_Color=jQuery('#Juna_IT_Poll_Question_Text').val().toLowerCase();

			if(Question_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Question_Color').val(Question_Color);
				jQuery('.Juna_IT_Poll_Question_Field_Span').css('color',Question_Color);		
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Question_Color)
					{	
						jQuery('#Juna_IT_Poll_Question_Color').val(k[1]);
						jQuery('.Juna_IT_Poll_Question_Field_Span').css('color',k[1]);	
						break;
					}
					else
					{
						continue;
					}
				}
			}		
		}
		else if(pickerID=='Widget_Border_Color')
		{
			var Border_Color=jQuery('#Juna_IT_Poll_Question_Border_Text').val().toLowerCase();

			if(Border_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Question_Border_Color').val(Border_Color);
				jQuery('.questions_title').css('border-color',Border_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Border_Color)
					{	
						jQuery('#Juna_IT_Poll_Question_Border_Color').val(k[1]);
						jQuery('.questions_title').css('border-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}		
		}
		else if(pickerID=='Answer_Bg')
		{
			var Answer_Bg=jQuery('#Juna_IT_Poll_Answer_Bg_Text').val().toLowerCase();

			if(Answer_Bg[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Answer_Bg_Color').val(Answer_Bg);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('background-color',Answer_Bg);
				jQuery('.Juna_IT_Poll_PT3_Div').css('background-color',Answer_Bg);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Answer_Bg)
					{	
						jQuery('#Juna_IT_Poll_Answer_Bg_Color').val(k[1]);
						jQuery('.Juna_IT_Poll_Answer_Div_P').css('background-color',k[1]);
						jQuery('.Juna_IT_Poll_PT3_Div').css('background-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}	
		}
		else if(pickerID=='Answer_Color')
		{
			var Answer_Color=jQuery('#Juna_IT_Poll_Answer_Text').val().toLowerCase();

			if(Answer_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Answer_Color').val(Answer_Color);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('color',Answer_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Answer_Color)
					{	
						jQuery('#Juna_IT_Poll_Answer_Color').val(k[1]);
						jQuery('.Juna_IT_Poll_Answer_Div_P').css('color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}	
		}
		else if(pickerID=='Border_Color_Answer')
		{
			var Border_Color_Answer=jQuery('#Juna_IT_Poll_Answer_Border_Text').val().toLowerCase();
			
			if(Border_Color_Answer[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Answer_Border_Color').val(Border_Color_Answer);
				jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-color',Border_Color_Answer);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Border_Color_Answer)
					{	
						jQuery('#Juna_IT_Poll_Answer_Border_Color').val(k[1]);
						jQuery('.Juna_IT_Poll_Answer_Div_P').css('border-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Background')
		{
			var Background=jQuery('#Juna_IT_Poll_Background_Text').val().toLowerCase();			

			if(Background[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Background_Color').val(Background);
				jQuery('.plugins_type').css('background-color',Background);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Background)
					{	
						jQuery('#Juna_IT_Poll_Background_Color').val(k[1]);
						jQuery('.plugins_type').css('background-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Border_Color')
		{
			var Border_Color=jQuery('#Juna_IT_Poll_Border_Text').val().toLowerCase();			

			if(Border_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Border_Color').val(Border_Color);
				jQuery('.plugins_type').css('border-color',Border_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Border_Color)
					{	
						jQuery('#Juna_IT_Poll_Border_Color').val(k[1]);
						jQuery('.plugins_type').css('border-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Vote_Color')
		{
			var Vote_Color=jQuery('#Juna_IT_Poll_Vote_Text').val().toLowerCase();

			if(Vote_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Vote_Color').val(Vote_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Vote_Color)
					{	
						jQuery('#Juna_IT_Poll_Vote_Color').val(k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Vote_Button_Color')
		{
			var Vote_Button_Color=jQuery('#Juna_IT_Poll_Vote_Button_Text').val().toLowerCase();

			if(Vote_Button_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Vote_Button_Color').val(Vote_Button_Color);
				jQuery('#Juna_IT_Poll_Vote_Button').css('background-color',Vote_Button_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Vote_Button_Color)
					{	
						jQuery('#Juna_IT_Poll_Vote_Button_Color').val(k[1]);
						jQuery('#Juna_IT_Poll_Vote_Button').css('background-color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Vote_Button_Color_Color')
		{
			var Vote_Button_Color_Color=jQuery('#Juna_IT_Poll_Vote_Button_Color_Text').val().toLowerCase();

			if(Vote_Button_Color_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Vote_Button_Color_Color').val(Vote_Button_Color_Color);
				jQuery('#Juna_IT_Poll_Vote_Button').css('color',Vote_Button_Color_Color);
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Vote_Button_Color_Color)
					{	
						jQuery('#Juna_IT_Poll_Vote_Button_Color_Color').val(k[1]);
						jQuery('#Juna_IT_Poll_Vote_Button').css('color',k[1]);
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		else if(pickerID=='Image_Border_Color')
		{
			var Image_Border_Color=jQuery('#Juna_IT_Poll_Image_Border_Color_Text').val().toLowerCase();
			
			if(Image_Border_Color[0]=="#")
			{
				jQuery('#Juna_IT_Poll_Image_Border_Color_Color').val(Image_Border_Color);
				for(var i=1;i<=10;i++)
				{
					jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-color',Image_Border_Color);
				}
			}	
			else
			{
				for(i=0; i<Juna_IT_Poll_Colors.length;i++)
				{
					var k=Juna_IT_Poll_Colors[i].split(':');
					if(k[0]==Image_Border_Color)
					{	
						jQuery('#Juna_IT_Poll_Image_Border_Color_Color').val(k[1]);
						for(var i=1;i<=10;i++)
						{
							jQuery('#Juna_IT_Poll_PT3_Div'+i+'').css('border-color',k[1]);
						}
						break;
					}
					else
					{
						continue;
					}
				}
			}
		}
		for(var i=1;i<=10;i++)
		{
			if(pickerID=='Add_Answer_Bg'+i)
			{
				var Add_Answer_Bg=jQuery('#Juna_IT_Poll_Add_Answer_Bg_Text'+i).val().toLowerCase();

				if(Add_Answer_Bg[0]=="#")
				{
					jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color'+i).val(Add_Answer_Bg);
					jQuery('#Juna_IT_Poll_PT2_Answer_'+i).css('background-color',Add_Answer_Bg);
					jQuery('#Juna_IT_Poll_Set_Color_'+i).css('background-color',Add_Answer_Bg);
					jQuery('#Juna_IT_Poll_PT4_Div'+i).css('border-color',Add_Answer_Bg);
				}	
				else
				{
					for(j=0; j<Juna_IT_Poll_Colors.length;j++)
					{
						var k=Juna_IT_Poll_Colors[j].split(':');
						if(k[0]==Add_Answer_Bg)
						{	

							jQuery('#Juna_IT_Poll_Add_Answer_Bg_Color'+i).val(k[1]);
							jQuery('#Juna_IT_Poll_PT2_Answer_'+i).css('background-color',k[1]);
							jQuery('#Juna_IT_Poll_Set_Color_'+i).css('background-color',k[1]);
							jQuery('#Juna_IT_Poll_PT4_Div'+i).css('border-color',k[1]);
							break;
						}
						else
						{
							continue;
						}
					}
				}
			}
		}		
	}
}
function Juna_IT_Poll_Add_Answer_Button_Click()
{
	var Juna_IT_Poll_Answers_Count=jQuery('#Juna_IT_Poll_Hidden_Value').val();
	Juna_IT_Poll_Answers_Count=parseInt(parseInt(Juna_IT_Poll_Answers_Count)+1);
	jQuery('#Juna_IT_Poll_Hidden_Value').val(Juna_IT_Poll_Answers_Count);
	Juna_IT_Poll_Add_Answers(Juna_IT_Poll_Answers_Count);

	if(Juna_IT_Poll_Answers_Count<10)
	{
		jQuery('.Juna_IT_Poll_Answer_'+Juna_IT_Poll_Answers_Count).fadeIn();
		jQuery('#Juna_IT_Poll_Remove_Answer_Button').css('display','inline');
	}
	else
	{
		jQuery('.Juna_IT_Poll_Answer_'+Juna_IT_Poll_Answers_Count).fadeIn();
		jQuery('#Juna_IT_Poll_Add_Answer_Button').css('display','none');
	}
	Juna_IT_Poll_Width();
}
function Juna_IT_Poll_Remove_Answer_Button_Click()
{
	var Juna_IT_Poll_Answers_Count=jQuery('#Juna_IT_Poll_Hidden_Value').val();
	
	for(i=1; i<=10; i++)
	{
		if(i<Juna_IT_Poll_Answers_Count)
		{
			jQuery(".Juna_IT_Poll_PT1_Div"+i).fadeIn();
			jQuery("#Juna_IT_Poll_PT2_Answer_"+i).fadeIn();	
			jQuery("#Juna_IT_Poll_PT3_Div"+i).fadeIn();
			jQuery("#Juna_IT_Poll_PT4_Div"+i).fadeIn();
		}
		else
		{					
			jQuery(".Juna_IT_Poll_PT1_Div"+i).fadeOut();
			jQuery("#Juna_IT_Poll_PT2_Answer_"+i).fadeOut();	
			jQuery("#Juna_IT_Poll_PT3_Div"+i).fadeOut();
			jQuery("#Juna_IT_Poll_PT4_Div"+i).fadeOut();
		}
	}		

	if(Juna_IT_Poll_Answers_Count>3)
	{
		jQuery('.Juna_IT_Poll_Answer_'+Juna_IT_Poll_Answers_Count).fadeOut();
		jQuery('#Juna_IT_Poll_Add_Answer_Button').css('display','inline');
	}
	else
	{
		jQuery('.Juna_IT_Poll_Answer_'+Juna_IT_Poll_Answers_Count).fadeOut();
		jQuery('#Juna_IT_Poll_Remove_Answer_Button').css('display','none');
	}

	Juna_IT_Poll_Answers_Count=parseInt(parseInt(Juna_IT_Poll_Answers_Count)-1);
	jQuery('#Juna_IT_Poll_Hidden_Value').val(Juna_IT_Poll_Answers_Count);
}
function Juna_IT_Poll_Width()
{
	var Juna_IT_Poll_Window_width=jQuery(window).width();

	jQuery('.Juna_IT_Poll_Add_Question_Field').css('width',Juna_IT_Poll_Window_width*0.28+'px');
	jQuery('.Juna_IT_Poll_Select_Poll_Type').css('width','1180px');
	jQuery('.Juna_IT_Poll_Image').css('width','250px');
	jQuery('.Juna_IT_Poll_Style_Table td:nth-child(1)').css('width',Juna_IT_Poll_Window_width*0.14+'px');
	jQuery('.Juna_IT_Poll_Style_Table td:nth-child(2)').css('width',Juna_IT_Poll_Window_width*0.113+'px');
	jQuery('.Juna_IT_Poll_Answers_Input').css('width',Juna_IT_Poll_Window_width*0.17+'px');
}