<?php
/*
Plugin Name: Prism Highlight
Plugin URI: http://www.techelex.org/
Description: Highlight your code using Prism.JS .
Author: Shaikh Masood Alam
Author URI: http://www.techelex.org/
Version: 1.2
*/

add_action( 'wp_enqueue_scripts', 'wpsites_add_prism_css_js' );
/** Load all JavaScript to header  */
function wpsites_add_prism_css_js() {
	if ( ! is_admin() ) {
	
			wp_enqueue_script( 'prismjs', plugins_url( 'js/prism-highlight.js', __FILE__ ), '', '', true );
			wp_enqueue_style( 'prismcss', plugins_url( 'css/prism-highlight.css', __FILE__ ) );
			
		
	}
}

/**
 * Main API function for adding a button to Quicktags
 * @link http://codex.wordpress.org/Quicktags_API
 * Adds qt.Button or qt.TagButton depending on the args. The first three args are always required.
 * To be able to add button(s) to Quicktags, your script should be enqueued as dependent
 * on "quicktags" and outputted in the footer. If you are echoing JS directly from PHP,
 * use add_action( 'admin_print_footer_scripts', 'output_my_js', 100 ) or add_action( 'wp_footer', 'output_my_js', 100 )
 *
 * Minimum required to add a button that calls an external function:
 *     QTags.addButton( 'my_id', 'my button', my_callback );
 *     function my_callback() { alert('yeah!'); }
 *
 * Minimum required to add a button that inserts a tag:
 *     QTags.addButton( 'my_id', 'my button', '<span>', '</span>' );
 *     QTags.addButton( 'my_id2', 'my button', '<br />' );
 */

// Hook pre tag button in text editor to prettyprint script
function wpsites_add_prism_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
    QTags.addButton( 'eg_pre', 'prism', '<pre class="line-numbers"><code class="language-">', '</code></pre>', 'q', 'Code Pretty Tag', 111 );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'wpsites_add_prism_quicktags' );