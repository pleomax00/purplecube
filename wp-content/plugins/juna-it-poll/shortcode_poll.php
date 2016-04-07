<?php
	function Juna_IT_Poll_GET_Shortcode_ID($atts, $content = null)
	{
		$atts=shortcode_atts(
			array(
				"id"=>"1"
			),$atts
		);

		return Juna_IT_Poll_Draw_Shortcode($atts['id']);
	}
	add_shortcode('Juna_IT_Poll', 'Juna_IT_Poll_GET_Shortcode_ID');
	function Juna_IT_Poll_Draw_Shortcode($Qid)
	{
		ob_start();	
			$args = shortcode_atts(array('name' => 'Widget Area','id'=>'hopar_1','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'1','widget_name'=>'Juna_IT_Poll'), $atts, 'Juna_IT_Poll' );
			$Juna_IT_Poll=new Juna_IT_Poll;
			global $wpdb;
			$table_name  =  $wpdb->prefix . "poll_wp_Questions";
			$Juna_IT_Poll_Question=$wpdb->get_var($wpdb->prepare("SELECT Juna_IT_Poll_Add_Question_Field FROM $table_name WHERE id=%d",$Qid));
			$instance=array('Juna_IT_Poll_Add_Question_Field'=>$Juna_IT_Poll_Question);
			$Juna_IT_Poll->widget($args,$instance);	
			$cont[]= ob_get_contents();
		ob_end_clean();	
		return $cont[0];		
	}
?>