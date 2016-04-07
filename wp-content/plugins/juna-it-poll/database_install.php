<?php

	global $wpdb;

	$table_name  =  $wpdb->prefix . "poll_wp_Questions";
	$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
	$table_name3 =  $wpdb->prefix . "poll_wp_Results";
	$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
	$table_name5 =  $wpdb->prefix . "poll_wp_position";
	$table_name6 =  $wpdb->prefix . "poll_wp_font_family";
	$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

	if( $wpdb->get_var('SHOW TABLES LIKE' . $table_name) != $table_name )
	{
		$sql = 'CREATE TABLE ' .$table_name . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Juna_IT_Poll_Add_Question_Field VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Plugin_Type_Text_Readonly INTEGER(10) UNSIGNED NOT NULL,			
			PRIMARY KEY  (id) )';

		$sql1 = 'CREATE TABLE ' .$table_name2 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Juna_IT_Poll_Answers_Input VARCHAR(255) NOT NULL,	
			Juna_IT_Poll_Upload_File VARCHAR(255),
			Juna_IT_Poll_Input_Add_Answer_Bg VARCHAR(255) NOT NULL, 	
			Juna_IT_Poll_Add_Question_FieldID INTEGER(10),
			PRIMARY KEY  (id) )';

		$sql2 = 'CREATE TABLE ' .$table_name3 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Juna_IT_Poll_Add_Question_FieldID INTEGER(10) NOT NULL,					
			Juna_IT_Poll_Answers_InputID INTEGER(10) NOT NULL,
			Juna_IT_Poll_Count INTEGER(10) NOT NULL, 					
			PRIMARY KEY  (id) )';	

		$sql3 = 'CREATE TABLE ' .$table_name4 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Juna_IT_Poll_Question_Font_Family VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Question_Font_Size VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Bg_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Question_Border_Style VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Question_Border_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Question_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Border_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Answer_Font_Family VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Answer_Font_Size VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Answer_Bg_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Answer_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Answer_Border_Style VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Answer_Border_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Answer_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Answer_Border_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Between_Answer VARCHAR(255) NOT NULL,				
			Juna_IT_Poll_Add_Question_FieldID INTEGER(10),
			PRIMARY KEY  (id) )';

		$sql4 = 'CREATE TABLE ' .$table_name5 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Position VARCHAR(255) NOT NULL,
			PRIMARY KEY  (id) )';
		$sql5 = 'CREATE TABLE ' .$table_name6 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Font_family VARCHAR(255) NOT NULL,
			PRIMARY KEY  (id) )';
		$sql6 = 'CREATE TABLE ' .$table_name7 . '(
			id INTEGER(10) UNSIGNED AUTO_INCREMENT,
			Juna_IT_Poll_Widget_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Background_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Widget_Border_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Widget_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Border_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Widget_Border_Style VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Votes_Type_Radio VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Vote_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Vote_Button_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Vote_Button_Color_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Margin_Right VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Button_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Button_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Button_Font_Family VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Button_Font_Size VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Button_Text VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Image_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Image_Height VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Image_Border_Width VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Image_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Div_Border_Radius VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Input_Image_Border_Color VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Image_Border_Style VARCHAR(255) NOT NULL,
			Juna_IT_Poll_Add_Question_FieldID INTEGER(10),
			PRIMARY KEY  (id) )';
	
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);
		dbDelta($sql1);
		dbDelta($sql2);
		dbDelta($sql3);
		dbDelta($sql4);
		dbDelta($sql5);
		dbDelta($sql6);

		DefaultData();

		add_option('poll-wp_database_version','1.0'); 
 	}
	function DefaultData()
	{
		global $wpdb;

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";	
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
		$table_name5 =  $wpdb->prefix . "poll_wp_position";
		$table_name6 =  $wpdb->prefix . "poll_wp_font_family";
		$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name5 (id, Position) VALUES (%d, %s)", '','float:left'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name (id, Juna_IT_Poll_Add_Question_Field, Juna_IT_Poll_Plugin_Type_Text_Readonly) VALUES (%d, %s, %d)", '','Do You Like Our Plugin?', 1));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Juna_IT_Poll_Answers_Input, Juna_IT_Poll_Upload_File, Juna_IT_Poll_Input_Add_Answer_Bg, Juna_IT_Poll_Add_Question_FieldID) VALUES (%d, %s, %s, %s, %d)", '', 'Yes', '', '#F5F5F5', 1));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Juna_IT_Poll_Answers_Input, Juna_IT_Poll_Upload_File, Juna_IT_Poll_Input_Add_Answer_Bg, Juna_IT_Poll_Add_Question_FieldID) VALUES (%d, %s, %s, %s, %d)", '', 'No', '', '#F5F5F5', 1));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Juna_IT_Poll_Answers_Input, Juna_IT_Poll_Upload_File, Juna_IT_Poll_Input_Add_Answer_Bg, Juna_IT_Poll_Add_Question_FieldID) VALUES (%d, %s, %s, %s, %d)", '', 'Not at All', '', '#F5F5F5', 1));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Juna_IT_Poll_Answers_Input, Juna_IT_Poll_Upload_File, Juna_IT_Poll_Input_Add_Answer_Bg, Juna_IT_Poll_Add_Question_FieldID) VALUES (%d, %s, %s, %s, %d)", '', 'Great', '', '#F5F5F5', 1));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Juna_IT_Poll_Add_Question_FieldID, Juna_IT_Poll_Answers_InputID, Juna_IT_Poll_Count) VALUES (%d, %d, %d, %d)", '', 1, 1, 100));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Juna_IT_Poll_Add_Question_FieldID, Juna_IT_Poll_Answers_InputID, Juna_IT_Poll_Count) VALUES (%d, %d, %d, %d)", '', 1, 2, 20));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Juna_IT_Poll_Add_Question_FieldID, Juna_IT_Poll_Answers_InputID, Juna_IT_Poll_Count) VALUES (%d, %d, %d, %d)", '', 1, 3, 15));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Juna_IT_Poll_Add_Question_FieldID, Juna_IT_Poll_Answers_InputID, Juna_IT_Poll_Count) VALUES (%d, %d, %d, %d)", '', 1, 4, 150));
		
		$family = array('Abadi MT Condensed Light','Aharoni','Aldhabi','Andalus','Angsana New',' AngsanaUPC','Aparajita','Arabic Typesetting','Arial','Arial Black',
			'Batang','BatangChe','Browallia New','BrowalliaUPC','Calibri','Calibri Light','Calisto MT','Cambria','Candara','Century Gothic','Comic Sans MS','Consolas',
			'Constantia','Copperplate Gothic','Copperplate Gothic Light','Corbel','Cordia New','CordiaUPC','Courier New','DaunPenh','David','DFKai-SB','DilleniaUPC',
			'DokChampa','Dotum','DotumChe','Ebrima','Estrangelo Edessa','EucrosiaUPC','Euphemia','FangSong','Franklin Gothic Medium','FrankRuehl','FreesiaUPC','Gabriola',
			'Gadugi','Gautami','Georgia','Gisha','Gulim','GulimChe','Gungsuh','GungsuhChe','Impact','IrisUPC','Iskoola Pota','JasmineUPC','KaiTi','Kalinga','Kartika',
			'Khmer UI','KodchiangUPC','Kokila','Lao UI','Latha','Leelawadee','Levenim MT','LilyUPC','Lucida Console','Lucida Handwriting Italic','Lucida Sans Unicode',
			'Malgun Gothic','Mangal','Manny ITC','Marlett','Meiryo','Meiryo UI','Microsoft Himalaya','Microsoft JhengHei','Microsoft JhengHei UI','Microsoft New Tai Lue',
			'Microsoft PhagsPa','Microsoft Sans Serif','Microsoft Tai Le','Microsoft Uighur','Microsoft YaHei','Microsoft YaHei UI','Microsoft Yi Baiti','MingLiU_HKSCS',
			'MingLiU_HKSCS-ExtB','Miriam','Mongolian Baiti','MoolBoran','MS UI Gothic','MV Boli','Myanmar Text','Narkisim','Nirmala UI','News Gothic MT','NSimSun','Nyala',
			'Palatino Linotype','Plantagenet Cherokee','Raavi','Rod','Sakkal Majalla','Segoe Print','Segoe Script','Segoe UI Symbol','Shonar Bangla','Shruti','SimHei','SimKai',
			'Simplified Arabic','SimSun','SimSun-ExtB','Sylfaen','Tahoma','Times New Roman','Traditional Arabic','Trebuchet MS','Tunga','Utsaah','Vani','Vijaya');
		foreach ($family as $font_family) 
		{
			$wpdb->query($wpdb->prepare("INSERT INTO $table_name6 (id, Font_family) VALUES (%d, %s)",  '', $font_family));
		}

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, Juna_IT_Poll_Question_Font_Family, Juna_IT_Poll_Question_Font_Size, 
			Juna_IT_Poll_Input_Bg_Color, Juna_IT_Poll_Input_Color, Juna_IT_Poll_Question_Border_Style, Juna_IT_Poll_Question_Border_Width, 
			Juna_IT_Poll_Question_Border_Radius, Juna_IT_Poll_Input_Border_Color, Juna_IT_Poll_Answer_Font_Family, Juna_IT_Poll_Answer_Font_Size, 
			Juna_IT_Poll_Input_Answer_Bg_Color, Juna_IT_Poll_Input_Answer_Color, Juna_IT_Poll_Answer_Border_Style, Juna_IT_Poll_Answer_Border_Width, 
			Juna_IT_Poll_Answer_Border_Radius, Juna_IT_Poll_Input_Answer_Border_Color, Juna_IT_Poll_Between_Answer, Juna_IT_Poll_Add_Question_FieldID) 
		VALUES (%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%d) ", '', 'Gabriola', '25px', 
		'#ffffff', '#0073aa', 'none', '0px', '0px', '#ffffff', 'Gabriola', '25px', '#ffffff', '#0073aa', 'dotted', '1px', 
		'7px', '#0073aa', '3px', 1));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name7 (id, Juna_IT_Poll_Widget_Width, Juna_IT_Poll_Input_Background_Color, 
			Juna_IT_Poll_Widget_Border_Width, Juna_IT_Poll_Widget_Border_Radius, Juna_IT_Poll_Input_Border_Color, Juna_IT_Poll_Widget_Border_Style, 
			Juna_IT_Poll_Votes_Type_Radio, Juna_IT_Poll_Input_Vote_Color, Juna_IT_Poll_Input_Vote_Button_Color, 
			Juna_IT_Poll_Input_Vote_Button_Color_Color, Juna_IT_Poll_Margin_Right, Juna_IT_Poll_Button_Width, 
			Juna_IT_Poll_Button_Border_Radius, Juna_IT_Poll_Button_Font_Family, Juna_IT_Poll_Button_Font_Size, Juna_IT_Poll_Button_Text, 
			Juna_IT_Poll_Image_Width, Juna_IT_Poll_Image_Height, Juna_IT_Poll_Image_Border_Width, Juna_IT_Poll_Image_Border_Radius, Juna_IT_Poll_Div_Border_Radius, 
			Juna_IT_Poll_Input_Image_Border_Color, Juna_IT_Poll_Image_Border_Style, Juna_IT_Poll_Add_Question_FieldID) 
		VALUES (%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%d) ", '', '300px', '#ffffff', 
		'1px', '10px', '#0073aa', 'solid', 'percent', '#ff0000', '#0073aa', '#ffffff', '40px', '100px', '15px', 'Arial', '14px', 'VOTE', '', 
		'', '', '', '', '', '', 1));
	}
?>