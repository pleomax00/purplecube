<?php
	add_action( 'wp_ajax_Vote_Click', 'Vote_Click_callback' );
	add_action( 'wp_ajax_nopriv_Vote_Click', 'Vote_Click_callback' ); // for use outside admin

	function Vote_Click_callback()
	{
		$data =array();
 
		$data=explode('^',$_POST['foobar']);

		$question=sanitize_text_field($data[0]);
		$answer=sanitize_text_field(trim($data[1]));

		global $wpdb;

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
		$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

		$selected_quest=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s", $data[0]));

		$selected_ans=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID= %d AND Juna_IT_Poll_Answers_Input= %s", $selected_quest, $answer));
		
		$count=$wpdb->get_var($wpdb->prepare("SELECT Juna_IT_Poll_Count FROM $table_name3 WHERE Juna_IT_Poll_Answers_InputID= %s AND Juna_IT_Poll_Add_Question_FieldID= %s", $selected_ans, $selected_quest));
		
		$count=$count+1;

		$ID=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID= %s AND Juna_IT_Poll_Answers_InputID= %s", $selected_quest, $selected_ans));

		$wpdb->query($wpdb->prepare("UPDATE  $table_name3 set Juna_IT_Poll_Count= %s WHERE  id= %d ",$count, $ID));

		//Sending data to Ajax

		$counts_array=$wpdb->get_results($wpdb->prepare("SELECT Juna_IT_Poll_Count FROM $table_name3 WHERE id in (SELECT id FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID= %s)", $selected_quest ));

		$vote_type=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Juna_IT_Poll_Add_Question_FieldID= %s", $selected_quest));

		echo  $vote_type[0]->Juna_IT_Poll_Votes_Type_Radio . '%^&^%' . $vote_type[0]->Juna_IT_Poll_Input_Vote_Color . '%^&^%' . $answer_count;

		for($i=0; $i<count($counts_array); $i++)
		{
			echo $counts_array[$i]->Juna_IT_Poll_Count."^";
		}

		die(); // this is required to return a proper result
	}
	
	add_action( 'wp_ajax_GetResults', 'GetResults_callback' );
	add_action( 'wp_ajax_nopriv_GetResults', 'GetResults_callback' );

	function GetResults_callback()
	{
		global $wpdb;

		$data=sanitize_text_field($_POST["foobar"]); 

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
		$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";
		
		$selected_quest=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s", $data ));

		$answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID= %s", $selected_quest));

		$results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID= %s", $selected_quest));

		$vote_type=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Juna_IT_Poll_Add_Question_FieldID= %s", $selected_quest));

		echo  $vote_type[0]->Juna_IT_Poll_Votes_Type_Radio . '%^&^%' . $vote_type[0]->Juna_IT_Poll_Input_Vote_Color . '%^&^%' . $answer_count;

		for($i=0;$i<count($answers);$i++)
		{
			$answer_count=$results[$i]->Juna_IT_Poll_Count . "^";
			echo $answer_count;
		}

		die();
	} 
	
	add_action( 'wp_ajax_Delete_Juna_IT_Poll_Click', 'Delete_Juna_IT_Poll_Click_Callback' );
	add_action( 'wp_ajax_nopriv_Delete_Juna_IT_Poll_Click', 'Delete_Juna_IT_Poll_Click_Callback' );

	function Delete_Juna_IT_Poll_Click_Callback()
	{
		$Delete_Juna_IT_Poll_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;		

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";	
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
		$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id= %d", $Delete_Juna_IT_Poll_id));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Delete_Juna_IT_Poll_id));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Delete_Juna_IT_Poll_id));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name4 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Delete_Juna_IT_Poll_id));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name7 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Delete_Juna_IT_Poll_id));

		die();
	}
	add_action( 'wp_ajax_Edit_Juna_IT_Poll_Click', 'Edit_Juna_IT_Poll_Click_Callback' );
	add_action( 'wp_ajax_nopriv_Edit_Juna_IT_Poll_Click', 'Edit_Juna_IT_Poll_Click_Callback' );

	function Edit_Juna_IT_Poll_Click_Callback()
	{
		$Edit_Juna_IT_Poll_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;		

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
		$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

		$Edited_Quest=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id= %d", $Edit_Juna_IT_Poll_id));
		$Edited_Answer=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Edit_Juna_IT_Poll_id));
		$Edited_Results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Edit_Juna_IT_Poll_id));
		$Edited_Sets=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Juna_IT_Poll_Add_Question_FieldID= %d", $Edit_Juna_IT_Poll_id));

		echo $Edited_Quest[0]->Juna_IT_Poll_Add_Question_Field . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Question_Font_Family . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Question_Font_Size . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Input_Bg_Color . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Input_Color . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Question_Border_Style . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Question_Border_Width . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Question_Border_Radius . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Input_Border_Color . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Answer_Font_Family . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Answer_Font_Size . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Input_Answer_Bg_Color . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Input_Answer_Color . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Answer_Border_Style . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Answer_Border_Width . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Answer_Border_Radius . '%^&^%' . 
			 $Edited_Results[0]->Juna_IT_Poll_Input_Answer_Border_Color . '%^&^%' . $Edited_Results[0]->Juna_IT_Poll_Between_Answer . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Widget_Width . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Input_Background_Color . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Widget_Border_Width . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Widget_Border_Radius . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Input_Border_Color . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Widget_Border_Style . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Votes_Type_Radio . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Input_Vote_Color . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Input_Vote_Button_Color . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Input_Vote_Button_Color_Color . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Margin_Right . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Button_Width . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Button_Border_Radius . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Button_Font_Family . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Button_Font_Size . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Button_Text . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Image_Width . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Image_Height . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Image_Border_Width . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Image_Border_Radius . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Div_Border_Radius . '%^&^%' . $Edited_Sets[0]->Juna_IT_Poll_Input_Image_Border_Color . '%^&^%' . 
			 $Edited_Sets[0]->Juna_IT_Poll_Image_Border_Style . '%^&^%' . count($Edited_Answer) . '%^&^%' . $Edited_Quest[0]->id . '$#@#$' . $Edited_Answers;
		
		for($i=0;$i<count($Edited_Answer);$i++)
		{
			if($Edited_Answer[$i]->Juna_IT_Poll_Upload_File=='')
			{
				$Edited_Answer[$i]->Juna_IT_Poll_Upload_File='none';
			}
			echo $Edited_Answers=$Edited_Answer[$i]->Juna_IT_Poll_Answers_Input . '%***%' . $Edited_Answer[$i]->Juna_IT_Poll_Upload_File . '%***%' . $Edited_Answer[$i]->Juna_IT_Poll_Input_Add_Answer_Bg . ')^%^(';
		}

		die();
	}
	add_action( 'wp_ajax_Search_Juna_IT_Poll_Click', 'Search_Juna_IT_Poll_Click_Callback' );
	add_action( 'wp_ajax_nopriv_Search_Juna_IT_Poll_Click', 'Search_Juna_IT_Poll_Click_Callback' );

	function Search_Juna_IT_Poll_Click_Callback()
	{
		$Search_Juna_IT_Poll_Question = strtolower(sanitize_text_field($_POST['foobar']));
		global $wpdb;		

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";

		$Searched_Juna_IT_Quest=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d",1));

		for($i=0;$i<count($Searched_Juna_IT_Quest);$i++)
		{
			for($j=1;$j<strlen($Searched_Juna_IT_Quest[$i]->Juna_IT_Poll_Add_Question_Field);$j++)
			{
				if($Search_Juna_IT_Poll_Question==substr(strtolower($Searched_Juna_IT_Quest[$i]->Juna_IT_Poll_Add_Question_Field),0,$j))
				{
					echo $Searched_Juna_IT_Quest[$i]->id . "^%^" . $Searched_Juna_IT_Quest[$i]->Juna_IT_Poll_Add_Question_Field . "^%^" . $Searched_Juna_IT_Quest[$i]->Juna_IT_Poll_Plugin_Type_Text_Readonly . ')&*&(';
				}
				else
				{
					echo "";
				}
			}
		}
		die();
	}
?>