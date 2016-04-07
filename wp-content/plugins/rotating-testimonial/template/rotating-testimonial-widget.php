<?php $selected = "selected='selected'";
	$checked= "checked='checked'";
 ?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:', 'hybrid'); ?>
  </label>
  <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title'];?>" style="width:100%;" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('display_title'); ?>">
    <?php _e('Display Title:', 'hybrid'); ?>
  </label>
  <input type="radio" name="<?php echo $this->get_field_name('display_title'); ?>" value="yes"<?php if($instance['display_title'] == "yes" || $instance['display_title']==''){echo $checked;}?>>
  yes &nbsp;&nbsp;
  <input type="radio" name="<?php echo $this->get_field_name('display_title'); ?>" value="no" <?php if($instance['display_title'] == "no"){echo $checked;}?>>
  no </p>
<p>
  <label for="<?php echo $this->get_field_id('width'); ?>">
    <?php _e('Width :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>" value="<?php if($instance['width'] == ''):echo 240;else: echo $instance['width']; endif;?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('width'); ?>">
    <?php _e('Height :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php if($instance['height'] == ''):echo 130;else: echo $instance['height']; endif;?>"/>
</p>
<p>
  <label for="<?php echo $this->get_field_id('effect_type'); ?>">
    <?php _e('Effect Type:', 'hybrid'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('effect_type'); ?>">
    <option value="scrollUp" <?php if($instance['effect_type'] == "scrollUp"){echo $selected;}?>>scrollUp</option>
    <option value="scrollLeft" <?php if($instance['effect_type'] == "scrollLeft"){echo $selected;}?>>scrollLeft</option>
    <option value="scrollDown"<?php if($instance['effect_type'] == "scrollDown"){echo $selected;}?>>scrollDown</option>
    <option value="scrollRight"<?php if($instance['effect_type'] == "scrollRight"){echo $selected;}?>>scrollRight</option>
    <option value="blindX" <?php if($instance['effect_type'] == "blindX"){echo $selected;}?>>blindX</option>
    <option value="blindY" <?php if($instance['effect_type'] == "blindY"){echo $selected;}?>>blindY</option>
    <option value="blindZ" <?php if($instance['effect_type'] == "blindZ"){echo $selected;}?>>blindZ</option>
    <option value="cover" <?php if($instance['effect_type'] == "cover"){echo $selected;}?>>cover</option>
    <option value="curtainY" <?php if($instance['effect_type'] == "curtainY"){echo $selected;}?>>curtainY</option>
    <option value="fade" <?php if($instance['effect_type'] == "fade"){echo $selected;}?>>fade</option>
    <option value="fadeZoom" <?php if($instance['effect_type'] == "fadeZoom"){echo $selected;}?>>fadeZoom</option>
    <option value="growX" <?php if($instance['effect_type'] == "growX"){echo $selected;}?>>growX</option>
    <option value="growY" <?php if($instance['effect_type'] == "growY"){echo $selected;}?>>growY</option>
    <option value="none" <?php if($instance['effect_type'] == "none"){echo $selected;}?>>none</option>
    <option value="scrollHorz" <?php if($instance['effect_type'] == "scrollHorz"){echo $selected;}?>>scrollHorz</option>
    <option value="scrollVert"<?php if($instance['effect_type'] == "scrollVert"){echo $selected;}?> >scrollVert</option>
    <option value="shuffle"<?php if($instance['effect_type'] == "shuffle"){echo $selected;}?> >shuffle</option>
    <option value="slideX" <?php if($instance['effect_type'] == "slideX"){echo $selected;}?>>slideX</option>
    <option value="slideY"<?php if($instance['effect_type'] == "slideY"){echo $selected;}?>>slideY</option>
    <option value="toss" <?php if($instance['effect_type'] == "toss"){echo $selected;}?>>toss</option>
    <option value="turnUp" <?php if($instance['effect_type'] == "turnUp"){echo $selected;}?>>turnUp</option>
    <option value="turnDown" <?php if($instance['effect_type'] == "turnDown"){echo $selected;}?>>turnDown</option>
    <option value="turnLeft" <?php if($instance['effect_type'] == "turnLeft"){echo $selected;}?>>turnLeft</option>
    <option value="turnRight" <?php if($instance['effect_type'] == "turnRight"){echo $selected;}?>>turnRight</option>
    <option value="uncover" <?php if($instance['effect_type'] == "uncover"){echo $selected;}?>>uncover</option>
    <option value="ipe" <?php if($instance['effect_type'] == "ipe"){echo $selected;}?>>ipe</option>
    <option value="zoom" <?php if($instance['effect_type'] == "zoom"){echo $selected;}?>>zoom</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t_ids'); ?>" style="width:100%;" >
    <?php _e('Enter Testimonial Ids :', 'hybrid');?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('t_ids'); ?>" id="<?php echo $this->get_field_id('t_ids'); ?>" value="<?php echo $instance['t_ids'];?>" style="width:100%;" />
  (e.g 10,13,17) </p>
<p>
  <label for="<?php echo $this->get_field_id('content_font_size'); ?>" style="width:50%;">
    <?php _e('Content Font Size :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('content_font_size'); ?>" id="<?php echo $this->get_field_id('content_font_size'); ?>"
        value="<?php echo $instance['content_font_size']; ?>" placeholder="px" style="width:50%;"/>
</p>
<p>
  <label for="<?php echo $this->get_field_id('content_font_color'); ?>" >
    <?php _e('Content Font Color :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('content_font_color'); ?>" id="content_font_color" value="<?php echo $instance['content_font_color']; ?>" placeholder="Enter color code" class="color" size="14"/>
</p>
<p>
  <label for="<?php echo $this->get_field_id('content_font_style'); ?>">
    <?php _e('Content Font Style:', 'hybrid'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('content_font_style'); ?>">
    <option value="Select Style">-select style</option>
    <option value="inherit" <?php if($instance['content_font_style'] == "inherit"){echo $selected;}?>>inherit</option>
    <option value="italic" <?php if($instance['content_font_style'] == "italic"){echo $selected;}?>>italic</option>
    <option value="normal"<?php if($instance['content_font_style'] == "normal"){echo $selected;}?>>normal</option>
    <option value="oblique"<?php if($instance['content_font_style'] == "oblique"){echo $selected;}?>>oblique</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('content_font_weight'); ?>">
    <?php _e('Content Font Weight:', 'hybrid'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('content_font_weight'); ?>">
    <option value="Select Style">-select-</option>
    <option value="bold" <?php if($instance['content_font_weight'] == "bold"){echo $selected;}?>>bold</option>
    <option value="bolder" <?php if($instance['content_font_weight'] == "bolder"){echo $selected;}?>>bolder</option>
    <option value="normal"<?php if($instance['content_font_weight'] == "normal"){echo $selected;}?>>normal</option>
    <option value="lighter"<?php if($instance['content_font_weight'] == "lighter"){echo $selected;}?>>lighter</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('author_font_size'); ?>" style="width:50%;">
    <?php _e('Author Font Size :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('author_font_size'); ?>" id="<?php echo $this->get_field_id('author_font_size'); ?>"
        value="<?php echo $instance['author_font_size']; ?>" placeholder="px" style="width:50%;"/>
</p>
<p>
  <label for="<?php echo $this->get_field_id('author_font_color'); ?>" >
    <?php _e('Author Font Color :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('author_font_color'); ?>" id="<?php echo $this->get_field_id('author_font_color'); ?>" value="<?php echo $instance['author_font_color']; ?>" placeholder="Enter color code" class="color" size="15"/>
</p>
<p>
  <label for="<?php echo $this->get_field_id('author_font_style'); ?>">
    <?php _e('Author Font Style:', 'hybrid'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('author_font_style'); ?>">
    <option value="Select Style">-select style</option>
    <option value="inherit" <?php if($instance['author_font_style'] == "inherit"){echo $selected;}?>>inherit</option>
    <option value="italic" <?php if($instance['author_font_style'] == "italic"){echo $selected;}?>>italic</option>
    <option value="normal"<?php if($instance['author_font_style'] == "normal"){echo $selected;}?>>normal</option>
    <option value="oblique"<?php if($instance['author_font_style'] == "oblique"){echo $selected;}?>>oblique</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('author_font_weight'); ?>">
    <?php _e('Author Font Weight:', 'hybrid'); ?>
  </label>
  <select name="<?php echo $this->get_field_name('author_font_weight'); ?>">
    <option value="Select Style">-select-</option>
    <option value="bold" <?php if($instance['author_font_weight'] == "bold"){echo $selected;}?>>bold</option>
    <option value="bolder" <?php if($instance['author_font_weight'] == "bolder"){echo $selected;}?>>bolder</option>
    <option value="normal"<?php if($instance['author_font_weight'] == "normal"){echo $selected;}?>>normal</option>
    <option value="lighter"<?php if($instance['author_font_weight'] == "lighter"){echo $selected;}?>>lighter</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('widget_background'); ?>" >
    <?php _e('Background Color :', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('widget_background'); ?>" id="<?php echo $this->get_field_id('widget_background'); ?>" value="<?php echo $instance['widget_background']; ?>" placeholder="Enter color code" class="color" size="15"/>
</p>

<p>
  <label for="<?php echo $this->get_field_id('speed'); ?>" ><?php _e('Transition Speed:', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('speed'); ?>" id="<?php echo $this->get_field_id('speed'); ?>" value="<?php if($instance['speed'] == ''):echo 2000;else: echo $instance['speed']; endif;?>" placeholder="Enter Transition speed" size="17"/>
</p>

<p>
  <label for="<?php echo $this->get_field_id('timeout'); ?>" ><?php _e('Transition TimeOut:', 'hybrid'); ?>
  </label>
  <input type="text" name="<?php echo $this->get_field_name('timeout'); ?>" id="<?php echo $this->get_field_id('timeout'); ?>" value="<?php if($instance['timeout'] == ''):echo 2000;else: echo $instance['timeout']; endif;?>" placeholder="Enter Transition Time" size="17"/>
</p>

 


