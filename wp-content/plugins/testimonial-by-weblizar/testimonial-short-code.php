<?php
/**
 * File: Weblizar Testimonial Short-code
 */
add_shortcode( 'WLT', 'WeblizarTestimonialShortCode' );
function WeblizarTestimonialShortCode() { ob_start();

    //default settings
    $Title = __("What Our Customer Says", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN);

    //Get all settings
    $Settings = unserialize(get_option('weblizar_testimonial_settings'));
    if(count($Settings)) {
        $Title = $Settings['short_code_title'];
    }
    ?>
    <div class="row">
        <h3 class="testimonial-header"><i class="icon-quote-left smaller-80"></i> <?php echo $Title; ?></h3>
        <ul class="rslides weblizar-custom">
            <?php
            global $wpdb;
            $TestimonialTable = $wpdb->prefix . "weblizar_testimonials";
            $Testimonials = $wpdb->get_results("SELECT * FROM `$TestimonialTable` WHERE `status` = 'published'");
            //print_r($Testimonials);
                if(count($Testimonials)) {
                    foreach($Testimonials as $Testimonial) {
                        $Id = $Testimonial->id;
                        $Name = $Testimonial->name;
                        $Designation = $Testimonial->designation;
                        $Email = $Testimonial->email;
                        $Website = $Testimonial->website;
                        $TestimonialText = $Testimonial->testimonial;
                        ?>
                            <li>
                                <p>
                                    <?php echo ucfirst(wp_strip_all_tags($TestimonialText)); ?><br>
                                    <small>
                                        <strong>&#8212; <?php echo ucwords($Name); ?></strong><br>
                                    </small>
                                    <cite title="Source Title">
                                        <?php if($Email) { echo "$Email<br>"; } ?>
                                        <?php if($Designation) { echo "<strong>".ucwords($Designation)."</strong> ";  echo _e("at", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); } ?> <a href="<?php echo $Website; ?>" target="_blank"><?php echo $Website; ?></a>
                                    </cite>
                                </p>
                            </li>
                        <?php
                    } //end of foreach
                } else {
                    ?>
                    <li>
                        <?php _e('Sorry! No Testimonials is Published.', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?>
                    </li>
                    <?php
                }//end of count if else
                ?>
        </ul>
    </div>


    <style>
        .rslides {
            position: relative;
            list-style: none;
            overflow: hidden;
            width: 96%;
            margin-bottom: 8px;
        }

        .rslides li {
            -webkit-backface-visibility: hidden;
            position: absolute;
            display: none;
            width: auto;
            left: 0;
            top: 0;
            list-style: none !important;;
            padding: 12px;
        }

        .rslides li:first-child {
            position: relative;
            display: block;
            float: left;
        }

        .testimonial-header {
            color: #478FCA !important;
            font-weight: lighter;
        }
        .weblizar-custom {
            /* shadow effect*/
            -moz-box-shadow: 0px 0px 8px #888;
            -webkit-box-shadow: 0px 0px 8px #888;
            box-shadow: 0px 0px 8px #888;

            /* boder effect*/
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }
    </style>

    <script>
        jQuery(function() {
            jQuery(".rslides").responsiveSlides();
        });
        jQuery(".rslides").responsiveSlides({
         auto: true,             // Boolean: Animate automatically, true or false
         speed: 600,            // Integer: Speed of the transition, in milliseconds
         timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
         pager: false,           // Boolean: Show pager, true or false
         nav: false,             // Boolean: Show navigation, true or false
         random: false,          // Boolean: Randomize the order of the slides, true or false
         pause: false,           // Boolean: Pause on hover, true or false
         pauseControls: true,    // Boolean: Pause when hovering controls, true or false
         prevText: "Previous",   // String: Text for the "previous" button
         nextText: "Next",       // String: Text for the "next" button
         maxwidth: "",           // Integer: Max-width of the slide-show, in pixels
         navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
         manualControls: "",     // Selector: Declare custom pager navigation
         namespace: "rslides",   // String: Change the default namespace used
         before: function(){},   // Function: Before callback
         after: function(){}     // Function: After callback
         });
    </script>
    <?php
    $Output = ob_get_contents();
    ob_end_clean();
    return $Output;
} //end of short-code function
?>