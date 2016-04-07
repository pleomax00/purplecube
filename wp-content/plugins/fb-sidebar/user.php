<?php
    wp_register_style( 'fb',  plugin_dir_url( __FILE__ ) . 'fb.css' );
    wp_enqueue_style( 'fb' );
     $options = get_option( 'fb_settings' );
     wp_enqueue_script("jquery");
?>

<div class="fb-plugin">
<a class="fba" href="<?php echo $options['fb_text_field_0']; ?>">
	<img class="fb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAYAAABXuSs3AAABPklEQVRoge3Xv0uCQQDGcf+yCvRPaAgyfBcnoSGCCFpqiYi2Bu0laLBQ+oE0vUFQETgFgS7aG4kkKSJiEiqv+j4tLXKvOvjm3cFz8N0O7gN3HHeBhdU4dCwgG0C4LhFOOOEztLJxgSsrj1KliU7XgeMM0Pzu4LPaQuGjjmDkRD344ekT+oMhJo2QYaoF3z6y4LoTzerBl9YSqNRa09WqwWO7mbHQ9k8P7+UG7L+UOuPHyawn+sB89HUd3+Hnt68C+qve9nWNf4FfWjkBnn+r6QnPFauE+wJfDMcR3bke6T5rC3C73BDmRbbS8uAhwxx79U0bs+6CNPjdc1FP+NnNi57w/cSDPHjQMNHt9UfyehEOXVeYF9vLyIN7pcV1SDjhhBNOOOGEE64bfHk9KXzTwpsp9eHzinDCCVc0wufdL1gFoizU/xQhAAAAAElFTkSuQmCC" alt="asdaef">
  <p class="fb-text"><?php echo $options['fb_text_field_1']; ?></p>
</a>

</div>
<script>
jQuery( ".fba" ).hover(
  function() {
    jQuery( this ).stop(false, true).animate({
    width: "+=200px",
  }, 300);
        jQuery( ".fb" ).stop(false, true).animate({
    right: "+=200px",
  }, 300);
        jQuery(".fb-text").stop(false, true).delay( 300 ).stop(false, true).fadeIn(600);
  }, function() {
        jQuery( this ).stop(false, true).animate({
    width: "-=200px",
  }, 300);
                jQuery( ".fb" ).stop(false, true).animate({
    right: "-=200px",
  }, 300);
                jQuery(".fb-text").stop(false, true).hide();
  }
);
</script>