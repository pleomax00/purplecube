<div class="wrap">
  <h2>Testimonial Options</h2>
  <br/>
  <?php $parameters =$this->getParameters(self::$table_params);
$selected = "selected='selected'";
$checked= "checked='checked'";
?>
  <div style="color: red;"><?php echo isset($_GET["msg"]) ? "Your Setting has been " . $_GET["msg"] . " Successfully" : "";?></div>
  <br/>
  <form action="" method="post" enctype="multipart/form-data" id="myForm">
    <div class="fields">
      <h3>Basic Setting</h3>
      <p> <span class="field"><b>Title:</b>
        <input type="text" name="testimonial_title" id="testimonial_title" value="<?php echo $parameters->title;?>" size="22">
        </span> </p>
      <p> <span class="field"><b>Display Title:</b>&nbsp;
        <input type="radio" name="display_plugin_title" value="yes"<?php if($parameters->display_plugin_title == "yes"){echo $checked;}?>>
        yes &nbsp;&nbsp;
        <input type="radio" name="display_plugin_title" value="no" <?php if($parameters->display_plugin_title == "no"){echo $checked;}?>>
        no </span> </p>
      <p> <span class="field"><b>Width:</b>
        <input type="text" name="testimonial_width" id="testimonial_width" value="<?php if($parameters->width == ""){echo $parameters->width =500;} else {echo $parameters->width;}?>" size="2">
        px</span> <span class="field"> <b>Height:</b>
        <input type="text" name="testimonial_height" id="testimonial_height" value="<?php if($parameters->height == ""){echo $parameters->width =170;} else {echo $parameters->height;}?>" size="2">
        px</span></p>
      <p><span class="field"><b>Effects</b>
        <select name="effect" id="effect">
          <option value="scrollUp" <?php if($parameters->effect == "scrollUp"){echo $selected;}?>>scrollUp</option>
          <option value="scrollLeft" <?php if($parameters->effect == "scrollLeft"){echo $selected;}?>>scrollLeft</option>
          <option value="scrollDown"<?php if($parameters->effect == "scrollDown"){echo $selected;}?>>scrollDown</option>
          <option value="scrollRight"<?php if($parameters->effect == "scrollRight"){echo $selected;}?>>scrollRight</option>
          <option value="blindX" <?php if($parameters->effect == "blindX"){echo $selected;}?>>blindX</option>
          <option value="blindY" <?php if($parameters->effect == "blindY"){echo $selected;}?>>blindY</option>
          <option value="blindZ" <?php if($parameters->effect == "blindZ"){echo $selected;}?>>blindZ</option>
          <option value="cover" <?php if($parameters->effect == "cover"){echo $selected;}?>>cover</option>
          <option value="curtainY" <?php if($parameters->effect == "curtainY"){echo $selected;}?>>curtainY</option>
          <option value="fade" <?php if($parameters->effect == "fade"){echo $selected;}?>>fade</option>
          <option value="fadeZoom" <?php if($parameters->effect == "fadeZoom"){echo $selected;}?>>fadeZoom</option>
          <option value="growX" <?php if($parameters->effect == "growX"){echo $selected;}?>>growX</option>
          <option value="growY" <?php if($parameters->effect == "growY"){echo $selected;}?>>growY</option>
          <option value="none" <?php if($parameters->effect == "none"){echo $selected;}?>>none</option>
          <option value="scrollHorz" <?php if($parameters->effect == "scrollHorz"){echo $selected;}?>>scrollHorz</option>
          <option value="scrollVert"<?php if($parameters->effect == "scrollVert"){echo $selected;}?> >scrollVert</option>
          <option value="shuffle"<?php if($parameters->effect == "shuffle"){echo $selected;}?> >shuffle</option>
          <option value="slideX" <?php if($parameters->effect == "slideX"){echo $selected;}?>>slideX</option>
          <option value="slideY"<?php if($parameters->effect == "slideY"){echo $selected;}?>>slideY</option>
          <option value="toss" <?php if($parameters->effect == "toss"){echo $selected;}?>>toss</option>
          <option value="turnUp" <?php if($parameters->effect == "turnUp"){echo $selected;}?>>turnUp</option>
          <option value="turnDown" <?php if($parameters->effect == "turnDown"){echo $selected;}?>>turnDown</option>
          <option value="turnLeft" <?php if($parameters->effect == "turnLeft"){echo $selected;}?>>turnLeft</option>
          <option value="turnRight" <?php if($parameters->effect == "turnRight"){echo $selected;}?>>turnRight</option>
          <option value="uncover" <?php if($parameters->effect == "uncover"){echo $selected;}?>>uncover</option>
          <option value="ipe" <?php if($parameters->effect == "ipe"){echo $selected;}?>>ipe</option>
          <option value="zoom" <?php if($parameters->effect == "zoom"){echo $selected;}?>>zoom</option>
        </select>
        </span> </p>
      <p><span class="field"><b>Pagination Button:</b>
        <select name="pagination" id="pagination">
          <option value="Yes" <?php if($parameters->pagination == "Yes"){echo $selected;}?>>Yes</option>
          <option value="No" <?php if($parameters->pagination == "No"){echo $selected;}?>>No</option>
        </select>
        </span></p>
      <p><span class="field"><b>Enter Testimonial Ids:</b>
        <input type="text" name="monial_ids" id="monial_ids" size="9" value="<?php echo $parameters->testimonial_ids;?>">
        <br/>
        <span class="field">(e.g 1,5,7,13)</span></span></p>
      <p><span class="field"><b>Background Color:</b>&nbsp;
        <input type="text" name="plugin_background" id="plugin_background" value="<?php echo $parameters->plugin_background;?>" size="11" class="color">
        </span></p>
        
      <p><span class="field"><b>Transition Speed:</b>&nbsp;
		<input type="text" name="transition_speed" id="transition_speed" value="<?php if($parameters->transition_speed == " "){echo 2000;} else {echo $parameters->transition_speed;}?>" size="11">
   		</span>
      </p>
      
      <p><span class="field"><b>Transition Timeout:</b>&nbsp;
		<input type="text" name="transition_timeout" id="transition_timeout" value="<?php if($parameters->transition_timeout == ""){echo 2000;} else {echo $parameters->transition_timeout;}?>" size="11">
   		</span>
      </p>
        
    </div>
    <div class="fields">
      <h3>Testimonial Content Setting</h3>
      <p><span class="field"><b>Content Font Size:</b>
        <input type="text" name="p_font_size" id="p_font_size" value="<?php echo $parameters->p_font_size;?>" size="1">
        px</span></p>
      <p><span class="field"><b>Content Font Color:</b>
        <input type="text" name="p_font_color" id="p_font_color" value="<?php echo $parameters->p_font_color;?>" size="5" class="color">
        </span></p>
      <p><span class="field"><b>Content Font Style:</b>
        <select name="p_font_style" id="p_font_style">
          <option value="Select Style">-select style</option>
          <option value="inherit" <?php if($parameters->p_font_style == "inherit"){echo $selected;}?>>inherit</option>
          <option value="italic" <?php if($parameters->p_font_style == "italic"){echo $selected;}?>>italic</option>
          <option value="normal"<?php if($parameters->p_font_style == "normal"){echo $selected;}?>>normal</option>
          <option value="oblique"<?php if($parameters->p_font_style == "oblique"){echo $selected;}?>>oblique</option>
        </select>
        </span></p>
      <p><span class="field"><b>Content Font Weight:</b>
        <select name="p_font_weight" id="p_font_weight">
          <option value="select">-select-</option>
          <option value="bold" <?php if($parameters->p_font_weight == "bold"){echo $selected;}?>>bold</option>
          <option value="bolder" <?php if($parameters->p_font_weight == "bolder"){echo $selected;}?>>bolder</option>
          <option value="normal"<?php if($parameters->p_font_weight == "normal"){echo $selected;}?>>normal</option>
          <option value="lighter"<?php if($parameters->p_font_weight == "lighter"){echo $selected;}?>>lighter</option>
        </select>
        </span></p>
    </div>
    <div class="fields">
      <h3>Testimonial Author Setting</h3>
      <p><span class="field"><b>Author Font Size:</b>
        <input type="text" name="a_font_size" id="a_font_size" value="<?php echo $parameters->a_font_size;?>" size="1">
        px</span></p>
      <p><span class="field"><b>Author Font Color:</b>
        <input type="text" name="a_font_color" id="a_font_color" value="<?php echo $parameters->a_font_color;?>" size="5" class="color">
        </span></p>
      <p><span class="field"><b>Author Font Style:</b>
        <select name="a_font_style" id="a_font_style">
          <option value="Select Style">-select style</option>
          <option value="inherit" <?php if($parameters->a_font_style == "inherit"){echo $selected;}?>>inherit</option>
          <option value="italic" <?php if($parameters->a_font_style == "italic"){echo $selected;}?>>italic</option>
          <option value="normal"<?php if($parameters->a_font_style == "normal"){echo $selected;}?>>normal</option>
          <option value="oblique"<?php if($parameters->a_font_style == "oblique"){echo $selected;}?>>oblique</option>
        </select>
        </span></p>
      <p><span class="field"><b>Author Font Weight:</b>
        <select name="a_font_weight" id="a_font_weight">
          <option value="select">-select-</option>
          <option value="bold" <?php if($parameters->a_font_weight == "bold"){echo $selected;}?>>bold</option>
          <option value="bolder" <?php if($parameters->a_font_weight == "bolder"){echo $selected;}?>>bolder</option>
          <option value="normal"<?php if($parameters->a_font_weight == "normal"){echo $selected;}?>>normal</option>
          <option value="lighter"<?php if($parameters->a_font_weight == "lighter"){echo $selected;}?>>lighter</option>
        </select>
        </span></p>
    </div>
    <div class="fields border-none">
      <p><span class="field">
        <input type="submit" name="save_changes" value="Save Changes" class="button button-primary button-large">
        </span></p>
        
        <p><span class="field">
        <input type="submit" name="reset_changes" value="Reset All Settings" class="button button-primary button-large">
        </span></p>
        
    </div>
  </form>
</div>
</font>