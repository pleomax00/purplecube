<?php

	class  Juna_IT_Poll extends WP_Widget
 	{
 		function __construct()
	 	  {
	 			$params=array('name'=>'Juna_IT_Poll','description'=>'This is the widget of poll-wp plugin');
				parent::__construct('Juna_IT_Poll','',$params);
	 	  }

	 	  public function update( $new_instance, $old_instance )
	 	   {
				$instance = $old_instance;
		              
				$instance['Juna_IT_Poll_Add_Question_Field'] = $new_instance['Juna_IT_Poll_Add_Question_Field']; 	
				return $instance;
		   }

 		 function form($instance)
 		 {
 		 		$defaults = array('Juna_IT_Poll_Add_Question_Field'=>'');
			    $instance=wp_parse_args((array)$instance, $defaults);

			   	$Question =$instance['Juna_IT_Poll_Add_Question_Field'];
			   
			   	?>
			   	<div>			  
			   	<p >

			   		Question:
			   		<select name="<?php echo $this->get_field_name('Juna_IT_Poll_Add_Question_Field'); ?>" class="widefat" > 
				   		<?php

				   			global $wpdb;

				   			$table_name=$wpdb->prefix . "poll_wp_Questions";	

				   			$questions=$wpdb->get_results($wpdb->prepare("SELECT Juna_IT_Poll_Add_Question_Field FROM $table_name WHERE id > %d", 0));

				   			foreach ($questions as $quest)
				   			{
				   				?> <option value="<?php echo $quest->Juna_IT_Poll_Add_Question_Field;  ?>">  <?php echo  $quest->Juna_IT_Poll_Add_Question_Field;  ?>  </option> <?php 
				   			}

				   		 ?>			   		
			   		</select>
			   	</p>
			   
			   	</div>
			   	<?php
 		 }

 		 function widget($args, $instance)
 		 {
 		 	extract($args);
 		  	$Question=empty($instance['Juna_IT_Poll_Add_Question_Field']) ? '' : $instance['Juna_IT_Poll_Add_Question_Field'];
 		 	echo $before_widget;
 		 		global $wpdb;
				$table_name5  =  $wpdb->prefix . "poll_wp_position";
				$t = $selected_quest=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE id= %d", 1));
 		 	?> 	
 		 	 	
 		 	<form method="post" id="WidgetForm" onsubmit="return false;" action=''>
 		 	<div style="width:100%;float:left">
 		 	<div id="widgetDiv" class="widget_div"  style="position:relative; margin: 5px 10px 5px 0; <?php echo  $t[0]->Position; ?>; 
 		 		width:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Widget_Width', $instance); ?>; 
 		 		background-color:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Input_Background_Color', $instance); ?>; 
 		 		border-width:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Widget_Border_Width', $instance); ?>; 
 		 		border-radius:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Widget_Border_Radius', $instance); ?>; 
 		 		border-color:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Input_Border_Color', $instance); ?>; 
 		 		border-style:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Widget_Border_Style', $instance); ?>;">

 		 	<div id="ActiveQuestion" class="Question" style="padding:5px; margin-top:10px;text-align:center; font-family:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Question_Font_Family', $instance); ?>; 
 		 		font-size:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Question_Font_Size', $instance); ?>; 
 		 		background-color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Bg_Color', $instance); ?>; 
 		 		color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Color', $instance); ?>; 
 		 		border-style:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Question_Border_Style', $instance); ?>; 
 		 		border-width:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Question_Border_Width', $instance); ?>; 
 		 		border-radius:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Question_Border_Radius', $instance); ?>; 
 		 		border-color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Border_Color', $instance); ?>;text-align:center;">
 		 			<span style="word-wrap: break-word;line-height: 25px; position:relative; width:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Widget_Width', $instance); ?>;" id="JunaITPollQuestion"><?php echo $Question; ?></span>
 		 	</div>
 		 				 		
 		 		<?php

 		 			global $wpdb;

 		 			$table_name  =  $wpdb->prefix . "poll_wp_Questions";
					$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
					$table_name3 =  $wpdb->prefix . "poll_wp_Results";
					$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
					$table_name5 =  $wpdb->prefix . "poll_wp_position";
					$table_name6 =  $wpdb->prefix . "poll_wp_font_family";
					$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

					$q=addslashes($Question);

					$selected_quest=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s", $q));
				   
				   	$selected_quest=$selected_quest[0]->id;

				   	$answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID= %s", $selected_quest));
				   
				   	$sum=$wpdb->get_var($wpdb->prepare("SELECT Sum(Count) FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s)", $q));

				   	$result_data=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s)", $q));

 		 		 	$plugintype=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s", $q));
 		 		 	?>
 		 		 		<p id="p_id" style="display:none;"><?php echo $plugintype[0]->Juna_IT_Poll_Plugin_Type_Text_Readonly; ?></p>
 		 		 	<?php

 		 		 	if($plugintype[0]->Juna_IT_Poll_Plugin_Type_Text_Readonly==1)
 		 		 	{
 		 		 		?>	
 		 		 		<script>
					   		var cook =document.cookie;
 		 					var cookie_question = jQuery('#ActiveQuestion').html();
 		 					if(cook.indexOf(cookie_question.trim())>=0 && cook.indexOf('customer1')>=0)
 		 					{ 		
 		 						jQuery('#widgetDiv').css('display','none');
 		 						jQuery('#answers_div').css('display','none');
 		 					}
 		 		 		</script>

 		 		 		<div id="answers_div" style="position:relative; margin-top:0px;"> 
	 		 		 	<?php 
					    for($i=0; $i<count($answers); $i++)
					    {
					   		?>
					   			<div style="font-family:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Answer_Font_Family', $instance); ?>; 
					   				font-size:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Answer_Font_Size', $instance); ?>; 
					   				background-color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Answer_Bg_Color', $instance); ?>; 
					   				color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Answer_Color', $instance); ?>; 
					   				border-style:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Answer_Border_Style', $instance); ?>; 
					   				border-width:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Answer_Border_Width', $instance); ?>; 
					   				border-radius:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Answer_Border_Radius', $instance); ?>; 
					   				border-color:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Input_Answer_Border_Color', $instance); ?>; 
					   				margin-top:<?php echo Juna_IT_Poll_Get_Settings('Juna_IT_Poll_Between_Answer', $instance); ?>; height:40px;"> 
						   			<input type="radio" id="<?php echo 'answer' . ($i+1); ?>" name="answer"	value="<?php echo $answers[$i]->Juna_IT_Poll_Answers_Input; ?>" > 
						   			<span id="span_ans_id"> <?php echo $answers[$i]->Juna_IT_Poll_Answers_Input; ?> </span>
						   		</div>
					   				<script>
	 		 		 					var cook =document.cookie;
	 		 		 				
	 		 		 					if(cook.indexOf(jQuery('#ActiveQuestion').html())>=0  && cook.indexOf('customer1')>=0)
	 		 		 					{
 		 		 							jQuery('#widgetDiv').css('display','none');
 		 		 							jQuery('#answers_div').css('display','none');
	 		 		 					} 		 		 				
 		 		 					</script>		
					   		<?php 
					   	}
					    ?>	
 		 				
 		 				<input type="submit" value="<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Button_Text', $instance); ?>" id="voteButton" onclick="Vote_Click()" 
 		 					style="position:relative; height:40px; float:right; margin-right:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Margin_Right', $instance); ?>; 
 		 						width:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Button_Width', $instance); ?>; 
 		 						border-radius:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Button_Border_Radius', $instance); ?>; 
 		 						font-family:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Button_Font_Family', $instance); ?>; 
 		 						font-size:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Button_Font_Size', $instance); ?>; 
 		 						background-color:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Input_Vote_Button_Color', $instance); ?>; 
 		 						color:<?php echo Juna_IT_Poll_Get_Params('Juna_IT_Poll_Input_Vote_Button_Color_Color', $instance); ?>;
 		 						padding:0px;margin-bottom:10px;margin-top:15px;"/>

 		 				</div> 
 		 				<?php
 		 		 	}		 		 	
 		 		 	?>
 		 	</div></div>
 		 	</form>

 		 	<?php		 	

 		 	echo $after_widget;
 		 }			
 	}


function Juna_IT_Poll_Get_Settings($col, $instance)
{
	global $wpdb;

	$Question=empty($instance['Juna_IT_Poll_Add_Question_Field']) ? '' : $instance['Juna_IT_Poll_Add_Question_Field'];
	$q=addslashes($Question);

 	$table_name1=$wpdb->prefix . "poll_wp_Questions";	
 	$table_name2=$wpdb->prefix . "poll_wp_Settings";

 	$settings=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name1 WHERE Juna_IT_Poll_Add_Question_Field= %s)",$q));

 	return $settings[0]->$col;	 		
}
function Juna_IT_Poll_Get_Params($col, $instance)
{
	global $wpdb;

	$Question=empty($instance['Juna_IT_Poll_Add_Question_Field']) ? '' : $instance['Juna_IT_Poll_Add_Question_Field'];
	$q=addslashes($Question);

 	$table_name1=$wpdb->prefix . "poll_wp_Questions";	
 	$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

 	$settings=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name1 WHERE Juna_IT_Poll_Add_Question_Field= %s)",$q));

 	return $settings[0]->$col;	 		
}
?>