 <?php

	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}

	global $wpdb;

		$table_name  =  $wpdb->prefix . "poll_wp_Questions";
		$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
		$table_name3 =  $wpdb->prefix . "poll_wp_Results";
		$table_name4 =  $wpdb->prefix . "poll_wp_Settings";	

	$questions=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d ", 0));	

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$quest=sanitize_text_field($_POST["Juna_IT_Poll_Add_Question_Field"]);

		$results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s)", $quest));
		
		$answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Juna_IT_Poll_Add_Question_FieldID=(SELECT id FROM $table_name WHERE Juna_IT_Poll_Add_Question_Field= %s)", $quest));

		$quest=sanitize_text_field(stripcslashes($_POST["Juna_IT_Poll_Add_Question_Field"]));

	}

	?>
<style>
	table, th, td 
	{
 	  	border:1px solid #0073aa;
 	  	border-radius:10px;	
	}
	tr:nth-child(odd)
	{
		background-color:white;		
	}
	tr:nth-child(even)
	{
		background-color:#ddf4fb;		
	}
	table
	{
		margin-top:30px;
		width:90%;
	}
	th
	{
		text-align:center;		
		vertical-align:center;
		padding:10px;
	}	

	select 
	{
		position:relative;
		border:1px solid white;
		background-color:#0073aa;
		color:white;
		border-radius:10px;
		margin: 5px auto;
		margin-top:20px;
	}	
	tr:nth-child(1)
	{
		font-size:20px;
		color:white;
		font-family: Consolas, Arial, Gabriola;
		background-color:#0073aa;
		width:100%;
	}
	#change_button
	{
		position:relative;
		border:1px solid white;
		background-color:#0073aa;
		color:white;
		border-radius:10px;
		margin: 5px auto;
	}
</style>
<script type="text/javascript">
	function Change_votes()
	{
		jQuery('#change_button').css('color','red');
		jQuery('#change_button').css('font-size','14px');
		jQuery('#change_button').html('* It`s working only with pro version (Click on logo to buy Pro version...)');
	}
</script>

	<form method="post">
	<br>
		<img style="float:left;" src="http://juna-it.com/image/icon.png">
		<Label style="font-size:18px; margin-left:10px;"><i> Select a Question</i></Label> <a href="http://juna-it.com/index.php/features/elements/juna-it-plugin/" target="_blank"><img src="http://juna-it.com/wp-content/uploads/2015/07/juna-logo.png" style="float:right; width:150px;height:70px; margin-right:10px;" <abbr title="Click to get Pro version"></a><br>
		<select name="Juna_IT_Poll_Add_Question_Field" onchange="this.form.submit()">
		<option> Select Question </option>
			<?php
				foreach($questions as $q)
				{											
					?>
						<option value="<?php echo $q->Juna_IT_Poll_Add_Question_Field ?>"> <?php echo $q->Juna_IT_Poll_Add_Question_Field; ?> </option> 
					<?php
				}
			?>
		</select>
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				?>
					 <table>
					 <tr>
					 <th colspan="3">
					  <?php echo $quest; ?> 
					  </th>
					 </tr>
				 	<tr>
				 		<th style="font-size:18px;"> <b> <i> ID </i> </b> </th>
				 		<th style="font-size:18px;"> <b> <i> Answer </i> </b> </th>
				 		<th style="font-size:18px;"> <b> <i> Votes  </i> </b> </th>	 		
				 	</tr>

				 	<?php
				 		for($i=0; $i<count($results); $i++) {
				 			?>
				 				<tr>
				 					<th> <?php echo $i+1; ?> </th>
				 					<th> 
				 						<?php echo $answers[$i]->Juna_IT_Poll_Answers_Input; ?> 
				 					</th>
				 					<th>  <?php echo $results[$i]->Juna_IT_Poll_Count; ?> </th> 
				 				</tr> 
				 			<?php
				 		}
				 	?>	
				 		<tr>
						 	<th colspan="3" id="change_button" onclick="Change_votes()" >Change Votes</th>
					 	</tr>
				 </table> 
				<?php
			}
		 ?>
	</form>
	