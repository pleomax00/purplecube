<?php

/**
 * Adds WeblizarTestimonial widget.
 */
class WeblizarTestimonial extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'weblizar_testimonial', // Base ID
            'Testimonial By WebLizar', // Widget Name
            array( 'description' => __( 'Activate this widget in any sidebar or footer widget area to display your customer testimonials.', WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $args; $instance;
        $Title = apply_filters( 'weblizar_testimonial_title', $instance['Title'] );
        /**
         * css scripts
         */
        wp_enqueue_style('responsiveslides', PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.css');
        wp_enqueue_style('font-awesome.min.css', PLUGIN_URL.'/admin/assets/css/font-awesome.min.css');
        /**
         * js scripts
         */
        wp_enqueue_script('responsiveslides',PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.js',array('jquery'));
        wp_enqueue_script('responsiveslides-min',PLUGIN_URL.'/admin/assets/responsive-slides-js-css/responsiveslides.min', array('jquery'));

        ?>
        <div class="row">
            <h3 class="testimonial-header"><i class="icon-quote-left smaller-80"></i> <?php echo $Title; ?></h3>
            <ul class="rslides-2 weblizar-custom">
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
                                    <em><strong>&#8212; <?php echo ucwords($Name); ?></strong></em><br>
                                </small>
                                <cite title="Source Title">
                                    <em>
                                    <?php if($Email) { echo "$Email<br>"; } ?>
                                    <?php if($Designation) { echo "<strong>".ucwords($Designation)."</strong> ";  echo _e("at", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); } ?> <a href="<?php echo $Website; ?>" target="_blank"><?php echo $Website; ?></a>
                                    </em>
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
            .rslides-2 {
                position: relative;
                list-style: none;
                overflow: hidden;
                width: 100%;
                margin: 0;
            }

            .rslides-2 li {
                -webkit-backface-visibility: hidden;
                position: absolute;
                display: none;
                width: 96%;
                left: 0;
                top: 0;
                list-style: none !important;
                padding: 10px;
            }

            .rslides-2 li:first-child {
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

                /* border effect*/
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
            }
        </style>

        <script>
            jQuery(function() {
                jQuery(".rslides-2").responsiveSlides();
            });
            jQuery(".rslides-2").responsiveSlides({
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
                namespace: "rslides-2",   // String: Change the default namespace used
                before: function(){},   // Function: Before callback
                after: function(){}     // Function: After callback
            });
        </script>
        <?php
    } //end of count if else

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $Title = __("What Customers Says", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN);
        if ( isset( $instance[ 'Title' ] ) ) {
            $Title = $instance[ 'Title' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e( 'Widget Title' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'Title' ); ?>" name="<?php echo $this->get_field_name( 'Title' ); ?>" type="text" value="<?php echo esc_attr( $Title ); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $old_instance;
        $instance['Title'] = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';

        return $instance;
    }

} // class WeblizarTestimonial

// register WeblizarTestimonial widget
function WeblizarTestimonialWidget() {
    register_widget( 'WeblizarTestimonial' );
}
add_action( 'widgets_init', 'WeblizarTestimonialWidget' );