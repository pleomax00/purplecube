<?php
	if( is_admin()){
		wp_enqueue_script( 'jquery-ui', 'http://code.jquery.com/ui/1.10.3/jquery-ui.js');
    wp_enqueue_script( 'farbtastic' );
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'my-theme-options', get_template_directory_uri() . '/admin/js/theme-options.js');
	}

$themename = "Minimable";
$shortname = "fw";
$options = array (
    array( "name" => $themename." Options",
           "type" => "title"),
    array( "type" => "open"),
    
    /* General Settings */
    array( "name" => "Documentation",
    	   	 "id" => "sec-documentation",
           "type" => "section"),
           
    array( "name" => "",
           "desc" => "",
           "id" => "",
           "type" => "docs",
           "std" => ""),
           
		array( "type" => "end-section"),
	       
    array( "name" => "General Settings",
    		   "id" => "sec-general",
           "type" => "section"),
           
   	array( "name" => "Logo",
           "desc" => "Upload your logo image or copy and paste its image url if you have just uploaded it. <br/>The height must be 45px.",
           "id" => $shortname."_logo",
           "type" => "image",
           "std" => ''.get_bloginfo('template_directory').'/img/logo.png'),
           
    array( "name" => "Logo Menu Bar",
           "desc" => "Upload your mini logo image that appears on sticky menu. The height must be 14px",
           "id" => $shortname."_logo_mini",
           "type" => "image",
           "std" => ''.get_bloginfo('template_directory').'/img/logo-mini.png'),
           
    array( "name" => "Favicon",
           "desc" => "Upload the image. Then copy and paste the image url in the field on top.",
           "id" => $shortname."_favicon",
           "type" => "image",
           "std" => ''.get_bloginfo('template_directory').'/img/favicon.ico'),
           
    array( "name" => "Main Color",
           "desc" => "Set the main color of your site",
           "id" => $shortname."_main_color",
           "type" => "color",
           "std" => '#01a3b2'),
           
    array( "name" => "Number of Pages",
           "desc" => "How many pages do you use in your site?",
           "id" => $shortname."_page_number",
           "type" => "input-slider",
           "std" => '5'),
           
   	array( "name" => "Label for Portfolio Link",
           "desc" => "Insert the label for the Portfolio link",
           "id" => $shortname."_label_portfolio_link",
           "type" => "text",
           "std" => 'Go to work'),
           
    array( "name" => "Enable/Disable Scrollorama",
           "desc" => "If you don't like Scrollorama effect, you can disable it.",
           "id" => $shortname."_onoff_scrollorama",
           "type" => "checkbox",
           "std" => 'checked'),
     
    array( "name" => "Enable/Disable Animation Big Title",
           "desc" => "If you don't like animation text effect, you can disable it.",
           "id" => $shortname."_onoff_animation_title",
           "type" => "checkbox",
           "std" => 'checked'),     
	
		array( "name" => "Enable/Disable Custom Css",
           "desc" => "If you want to add some extra style, enable custom css and edit custom.css file.",
           "id" => $shortname."_onoff_custom_css",
           "type" => "checkbox",
           "std" => 'checked'),
    
    array( "name" => "Enable/Disable Custom Javascript",
           "desc" => "If you want to add some extra javascript function, enable custom javascriot and edit custom.js file, in js directory.",
           "id" => $shortname."_onoff_custom_js",
           "type" => "checkbox",
           "std" => 'checked'),  
    array( "type" => "submit"),       
    
    array( "type" => "end-section"),         
   	
    /* Social Settings */       
    array( "name" => "Footer Settings",
           "id" => "sec-social",
           "type" => "section"),
    
    array( "name" => "Footer text",
           "desc" => "Enter text used in the right side of the footer. It can be HTML.",
           "id" => $shortname."_footer_text",
           "type" => "text",
           "std" => ""),
           
    /* Analytics Code */       
		array( "name" => "Google Analytics Code",
           "desc" => "Paste your Google Analytics or other tracking code in this box.",
           "id" => $shortname."_ga_code",
           "type" => "textarea",
           "std" => ""),
    array( "type" => "submit"),       
    array( "type" => "end-section"),
    array( "type" => "close"));

    
function mytheme_add_admin() {
 
	global $themename, $shortname, $options;
	 
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
		 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
		 
		foreach ($options as $value) {
		if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
		 
		header("Location: themes.php?page=theme-options.php&saved=true");
		die;
		 
		} else if( 'reset' == $_REQUEST['action'] ) {
		 
		foreach ($options as $value) {
		delete_option( $value['id'] ); }
		 
		header("Location: themes.php?page=theme-options.php&reset=true");
		die;
		 
		}
	}
 	add_menu_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {  
	$file_dir=get_bloginfo('template_directory');  
	wp_enqueue_style("functions", $file_dir."/admin/css/theme-option.css", false, "1.0", "all");  
} 

function mytheme_admin() {
 
	global $themename, $shortname, $options;
	 
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	 
?>

	<div class="wrap">
		<h2><?php echo $themename; ?> Settings</h2>
	 	<form method="post">
		<?php foreach ($options as $value) {
			switch ( $value['type'] ) {
				case "open":
		?>
			<div style="width:800px">
		<?php break;
		 case "close":
		?>
		 	</div>
		 
		<?php break;
		
		case "section" :
		?>
			<div class="accordion <?php echo $value['id']; ?>">
				<h3 class="title-section"><?php echo $value['name']; ?></h3>
				<div id="options-<?php echo $value['id']; ?>" class="options">
		<?php break;
	
		case "end-section" :
		?>
				</div>
			</div>
		<?php break;
		
		case "subsection" :
		?>
			<div class="subsection">
				<h4><?php echo $value['name']; ?></h4>
		<?php break;
		case "end-subsection" : ?>
		</div>
		<?php break;
		case 'text':
		?>
			<div class="text <?php echo $value['id']; ?>">
				<h4><?php echo $value['name']; ?></h4>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( stripslashes(esc_attr(get_settings($value['id']))) != "") { echo stripslashes(esc_attr(get_settings((esc_attr($value['id']) )))); } else { echo $value['std']; } ?>" /><br/>
				<small><?php echo $value['desc']; ?></small>
			</div>
		<?php
		break;
		case 'input-slider':
		?>
			<div class="text <?php echo $value['id']; ?>">
				<h4><?php echo $value['name']; ?></h4>
				<div class="slider-container">
					<div class="slider"></div>
				</div>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( stripslashes(esc_attr(get_settings($value['id']))) != "") { echo stripslashes(esc_attr(get_settings((esc_attr($value['id']) )))); } else { echo $value['std']; } ?>" /><br/>
				<small><?php echo $value['desc']; ?></small>
			</div>
			<script>
				jQuery(".slider").slider({
					min: 1, //minimum value
			    max: 20, //maximum value
			    range: "min",
			    value: <?php if ( stripslashes(esc_attr(get_settings($value['id']))) != "") { echo stripslashes(esc_attr(get_settings((esc_attr($value['id']) )))); } else { echo $value['std']; } ?>, //default value
			      slide: function(event, ui) {
			          jQuery("#fw_page_number").val(ui.value);
			          }
			      });
  		jQuery("#fw_page_number").val(jQuery(".slider").slider("value"));
  		jQuery( "#fw_page_number" ).change(function() {
    		jQuery( ".slider" ).slider( "value", jQuery(this).val() );
			});
			</script>
		<?php
		break;
		
		case 'color':
		?>
			<h4 class="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></h4>
			<div class="changecolor" id="<?php echo $value['id']; ?>-pick">
				<input type="text" name="<?php echo $value['id']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
				<input type='button' class='pickcolor button-secondary' value='Select Color' />
				<div class='colorpicker'></div>
				
			</div>
			<small><?php echo $value['desc']; ?></small>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#<?php echo $value['id']; ?>-pick').each(function() {
						var divPicker = $(this).find('.colorpicker');
						var inputPicker = $(this).find('input[type=text]');
						divPicker.farbtastic(inputPicker);
						divPicker.hide();
			        $('.pickcolor', this).click(function(){
			           divPicker.fadeToggle('fast'); 
			        });
					});
				});
			</script>	
			<?php 
		break;
		
		case 'image' :
		?>
			<div class="fw_upload">
				<h4><?php echo $value['name']; ?></h4>
				<input style="width:400px;" class="upload_image" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
				<input class="upload_image_button" type="button" value="Upload Image" />
				<br /><small><?php echo $value['desc']; ?></small>
			</div>
		<?php
		break;
		
		case 'textarea':
		?>
			<h4><?php echo $value['name']; ?></h4>
			<div class="areatesto">
				<textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( stripslashes(get_settings( $value['id'] )) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea><br/>
				<small><?php echo $value['desc']; ?></small>
			</div>
		<?php
		break;
		case 'title-font':
		?>
		<h4><?php echo $value['name']; ?></h4>
		<?php
		break;
		case 'select-google-font':
		?>
      <?php error_reporting(E_ERROR | E_PARSE); 
      $fontsSeraliazed = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCy3G6e01tIPse5spXzhvS-r8QrrN7dk_U&sort=alpha');
      $fontArray = json_decode($fontsSeraliazed);
      $fonts = $fontArray->items;
      if( !empty( $fonts ) ) { ?>
      <div class="select-wrapper font-family">
				<select class="select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'];?>>
				<?php
				foreach ( $fonts as $font )
					echo '<option value="' . esc_attr( $font->family ) . '"' . selected( get_option($value['id']), $font->family, false ) . '>' . $font->family . '</option>';			
				
				echo '</select></div>';
			} else { ?>
				<div class="select-wrapper">
					<span style="position:relative;">you must be connect</span>
				</div>
			<?php } 
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>'; ?>
					<script type="text/javascript">
						jQuery(document).ready(function($){
						var select_value = function() {
			        var value = $(this).children("option:selected").text();
			        
			        if( value == '' )
			            value = $(this).children().children("option:selected").text();
			        
			                                                                        
			        if ( $(this).parent().find('span').length <= 0 ) {  
			            $(this).before('<span></span>');
			        }
			        
			        $(this).parent().children('span').replaceWith('<span>'+value +'</span>'); 
			    };                
			    $('.select-wrapper select').each(select_value).change(select_value);
				});
					</script>
					<?php
		break;
		case 'font-size'
		?>
		<div class="spinner_container">
    	<input class="number" type="text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] ?>-size" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
   		<div class="input-controls">
		    <a href="#" id="<?php echo $value['id']; ?>-up" class="inc">+</a>
				<a href="#" id="<?php echo $value['id']; ?>-down" class="dec">-</a> 
	    </div>
    </div>
    
    <script type="text/javascript">
    	jQuery(document).ready( function($) {
			  var el = $('#<?php echo $value['id'] ?>-size');
			  function change( amt ) {
			    el.val( parseInt( el.val(), 10 ) + amt );
			  }
			  $('#<?php echo $value['id']; ?>-up').click( function(e) {
			    change( 1 );
			    e.preventDefault();
			  } );
			  $('#<?php echo $value['id']; ?>-down').click( function(e) {
			    change( -1 );
			    e.preventDefault();
			  } );
			} );	
    </script> 
    <?php
    break;
		case 'checkbox'
		?>
			<div id="<?php echo $value['id']; ?>-container" class="check">  
				<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>   
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="on_off" value="1" <?php checked( get_option( $value['id'] ), true ); ?> />
				<span></span>  
			    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  
			</div>
			<script type="text/javascript">
				jQuery( document ).ready( function( $ ) {
					$( '#<?php echo $value['id']; ?>-container span' ).click( function() {
						var input = $( this ).prev( 'input' );
						var checked = input.attr( 'checked' );
						if( checked ) {
							input.attr( 'checked', false ).attr( 'value', 0 ).removeClass('onoffchecked');
						} else {
							input.attr( 'checked', true ).attr( 'value', 1 ).addClass('onoffchecked');
						}
						input.change();
					} );
				} );
		</script>  
		<?php break;
		case 'docs' :
		?>
			<p>Read documentation before using the theme. Go to the <a href="http://minimable.fedeweb.net/docs" target="_blank">Minimable Docs</a> Page.</p>
		<?php 
		break;
		case 'submit':
		?>
			<p class="submit">
				<input name="save" type="submit" value="Save changes" />
				<input type="hidden" name="action" value="save" />
			</p>
		</form>
		<?php
		break;
		}
	}
?>
	</form>
	<form method="post">
		<p class="submit">
			<input name="reset" type="submit" value="Reset" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>
</div>

<?php
}

add_action('admin_menu', 'mytheme_add_admin');
add_action('admin_init', 'mytheme_add_init'); 
?>