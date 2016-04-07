<?php global $options;
			foreach ($options as $value) {
    			if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
			}
		?>
<footer>
	<div class="container">	
		<?php echo stripslashes($fw_footer_text) ?>
	</div>
</footer>
<?php echo stripslashes($fw_ga_code) ?>