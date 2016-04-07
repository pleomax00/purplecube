<?php

// WRAPPER
echo "<div class=\"slide slide{$slide_count} testimonial_rotator_slide hreview itemreviewed item {$has_image} cf-tr\">\n";		

// POST THUMBNAIL
if ( $has_image )
{ 
	echo "	<div class=\"testimonial_rotator_img img\">" . get_the_post_thumbnail( get_the_ID(), $img_size) . "</div>\n"; 
}

// DESCRIPTION
echo "	<div class=\"text testimonial_rotator_description\">\n";

// IF SHOW TITLE
if($show_title) echo "	<{$title_heading} class=\"testimonial_rotator_slide_title\">" . get_the_title() . "</{$title_heading}>\n";

// RATING
if($rating)
{
	echo "<div class=\"testimonial_rotator_stars cf-tr\">\n";
	for($r=1; $r <= $rating; $r++)
	{
		echo "	<span class=\"testimonial_rotator_star testimonial_rotator_star_$r\"><i class=\"fa {$testimonial_rotator_star}\"></i></span>";
	}
	echo "</div>\n";
}

// CONTENT
echo "<div class=\"testimonial_rotator_quote\">\n";
echo ($show_size == "full") ? do_shortcode(nl2br(get_the_content(' '))) : get_the_excerpt();
echo "</div>\n";

// AUTHOR INFO
if( $cite )
{
	echo "<div class=\"testimonial_rotator_author_info cf-tr\">\n";
	echo wpautop($cite);
	echo "</div>\n";				
}

echo "	</div>\n";

// MICRODATA 
if($show_microdata)
{
	$global_rating = $global_rating + $rating;

	echo "	<div class=\"testimonial_rotator_microdata\">\n";

		if($itemreviewed) echo "\t<div class=\"fn\">{$itemreviewed}</div>\n";
		if($rating) echo "\t<div class=\"rating\">{$rating}.0</div>\n";

		echo "	<div class=\"dtreviewed\"> " . get_the_date('c') . "</div>";
		echo "	<div class=\"reviewer\"> ";
			echo "	<div class=\"fn\"> " . wpautop($cite) . "</div>";
			if ( has_post_thumbnail() ) { echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array('class' => 'photo' )); }
		echo "	</div>";
		echo "	<div class=\"summary\"> " . wp_trim_excerpt(get_the_excerpt()) . "</div>";
		echo "	<div class=\"permalink\"> " . get_permalink() . "</div>";
	
	echo "	</div> <!-- .testimonial_rotator_microdata -->\n";
}

echo "</div>\n";