<?php

/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if (!isset($content_width)) {
  $content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
  require get_template_directory() . '/inc/back-compat.php';
}


// ===================================================================================
// custom added stuff


// add signed-up user to newsletter
function handle_change_membership_level($level_id = NULL, $user_id = NULL)
{
}
add_action("pmpro_after_change_membership_level", "handle_change_membership_level", 10, 2);
/*
// redirect after login
function login_redirect($redirect_to, $request, $user) {
  if (isset($user->roles) 
  && is_array($user->roles)) {
    return home_url();
  }
  else {
    return $redirect_to;
  }
}
add_filter('login_redirect', 'login_redirect', 10, 3);
*/
//add my_print to query vars
function add_print_query_vars($vars)
{
  // add my_print to the valid list of variables
  $new_vars = array('my_print');
  $vars = $new_vars + $vars;
  return $vars;
}
add_filter('query_vars', 'add_print_query_vars');
add_action("template_redirect", 'my_template_redirect_2322');

// Template selection
function my_template_redirect_2322()
{
  global $wp;
  global $wp_query;
  if (isset($wp->query_vars["my_print"])) {
    include(TEMPLATEPATH . '/my_print_template.php');
    die();
  }
}

function my_pmprorh_init()
{
  if (!function_exists("pmprorh_add_registration_field")) {
    return false;
  }

  $fields = array();

  $fields[] = new PMProRH_Field(
    "first_name",
    "text",
    array(
      "size" => 40,
      "required" => true,
      "label" => 'First Name',
      "profile" => true
    )
  );

  $fields[] = new PMProRH_Field(
    "last_name",
    "text",
    array(
      "size" => 40,
      "required" => true,
      "label" => 'Surname',
      "profile" => true
    )
  );

  $fields[] = new PMProRH_Field(
    "address_line_1",
    "text",
    array(
      "size" => 40,
      "required" => true,
      "label" => 'Billing address Line 1',
      "profile" => true
    )
  );

  $fields[] = new PMProRH_Field(
    "address_line_2",
    "text",
    array(
      "size" => 40,
      "required" => true,
      "label" => 'Billing address Line 2',
      "profile" => true
    )
  );

  //add the fields into a new checkout_boxes are of the checkout page
  foreach ($fields as $field) {
    pmprorh_add_registration_field("checkout_boxes", $field);
  }
}
add_action("init", "my_pmprorh_init");

add_filter('tiny_mce_before_init', 'myformatTinyMCE');
function myformatTinyMCE($in)
{

  $in['wordpress_adv_hidden'] = FALSE;

  return $in;
}


add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles');
function cssmenumaker_scripts_styles()
{
  wp_enqueue_style('cssmenu-styles', get_template_directory_uri() . '/cssmenu/styles.css');
  wp_enqueue_script('cssmenu-scripts', get_template_directory_uri() . '/cssmenu/script.js');
}


function namespace_add_custom_types($query)
{
  if ($query->get('post_type') != 'nav_menu_item' && $query->is_main_query() && !is_admin() && (is_year() || is_category() || is_tag() && empty($query->query_vars['suppress_filters']))) {

    $query->set('post_type', array(
      'post', 'damage'
    ));
    return $query;
  }
}
add_filter('pre_get_posts', 'namespace_add_custom_types');



//add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2); 
function add_login_logout_link($items, $args)
{
  ob_start();
  wp_loginout('index.php');
  $loginoutlink = ob_get_contents();
  ob_end_clean();
  $items .= '<li>' . $loginoutlink . '</li>';
  return $items;
}


function insert_state_filter($query)
{

  if (!is_admin() && $query->is_main_query()) {
    if (get_query_var('state') != '' && get_query_var('state') != 'All') {
      $query->set('meta_key', 'wpcf-state');
      $query->set('meta_value', get_query_var('state', 'NSW'));
    }
  }
}
add_action('pre_get_posts', 'insert_state_filter');


// make wp aware of own query params
function wpd_query_vars($query_vars)
{
  $query_vars[] = 'state';
  return $query_vars;
}
add_filter('query_vars', 'wpd_query_vars');

/*
	Add the PMPro meta box to a CPT
*/
function my_page_meta_wrapper()
{
  //duplicate this row for each CPT
  add_meta_box('pmpro_page_meta', 'Require Membership', 'pmpro_page_meta', 'damage', 'side');
}
function pmpro_cpt_init()
{
  if (is_admin()) {
    add_action('admin_menu', 'my_page_meta_wrapper');
  }
}
add_action("init", "pmpro_cpt_init", 20);

add_filter('show_admin_bar', '__return_false');



class CSS_Menu_Maker_Walker extends Walker
{

  var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

  function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }

  function end_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {

    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;

    /* Add active class */
    if (in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }

    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names . '>';

    $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '><span>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function end_el(&$output, $item, $depth = 0, $args = array())
  {
    $output .= "</li>\n";
  }
}

// ===================================================================================

//var_dump(add_post_meta( 7504, 'State', 'BW', true));

if (!function_exists('twentyfifteen_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   *
   * @since Twenty Fifteen 1.0
   */
  function twentyfifteen_setup()
  {

    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
    load_theme_textdomain('twentyfifteen', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
    add_theme_support('post-thumbnails');
    //set_post_thumbnail_size( 250, 275, true );
    set_post_thumbnail_size(725, 250, true);

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
      'primary' => __('Primary Menu',      'twentyfifteen'),
      'social'  => __('Social Links Menu', 'twentyfifteen'),
    ));

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support('html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    /*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
    add_theme_support('post-formats', array(
      'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ));

    $color_scheme  = twentyfifteen_get_color_scheme();
    $default_color = trim($color_scheme[0], '#');

    // Setup the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('twentyfifteen_custom_background_args', array(
      'default-color'      => $default_color,
      'default-attachment' => 'fixed',
    )));

    /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
    add_editor_style(array('css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url()));
  }
endif; // twentyfifteen_setup
add_action('after_setup_theme', 'twentyfifteen_setup');

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Left widget area', 'twentyfifteen'),
    'id'            => 'sidebar-1',
    'description'   => __('Add widgets here to appear in your sidebar.', 'twentyfifteen'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));

  register_sidebar(array(
    'name'          => __('Right widget area', 'twentyfifteen'),
    'id'            => 'sidebar-2',
    'description'   => __('Add widgets here to appear in your right sidebar.', 'twentyfifteen'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'twentyfifteen_widgets_init');



if (!function_exists('twentyfifteen_fonts_url')) :
  /**
   * Register Google fonts for Twenty Fifteen.
   *
   * @since Twenty Fifteen 1.0
   *
   * @return string Google fonts URL for the theme.
   */
  function twentyfifteen_fonts_url()
  {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Noto Sans font: on or off', 'twentyfifteen')) {
      $fonts[] = 'Noto Sans:400italic,700italic,400,700';
    }

    /* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Noto Serif font: on or off', 'twentyfifteen')) {
      $fonts[] = 'Noto Serif:400italic,700italic,400,700';
    }

    /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentyfifteen')) {
      $fonts[] = 'Inconsolata:400,700';
    }

    /* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
    $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen');

    if ('cyrillic' == $subset) {
      $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ('greek' == $subset) {
      $subsets .= ',greek,greek-ext';
    } elseif ('devanagari' == $subset) {
      $subsets .= ',devanagari';
    } elseif ('vietnamese' == $subset) {
      $subsets .= ',vietnamese';
    }

    if ($fonts) {
      $fonts_url = add_query_arg(array(
        'family' => urlencode(implode('|', $fonts)),
        'subset' => urlencode($subsets),
      ), '//fonts.googleapis.com/css');
    }

    return $fonts_url;
  }
endif;

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts()
{
  // Add custom fonts, used in the main stylesheet.
  wp_enqueue_style('twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null);

  // Add Genericons, used in the main stylesheet.
  wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2');

  // Load our main stylesheet.
  wp_enqueue_style('twentyfifteen-style', get_stylesheet_uri());

  // Load the Internet Explorer specific stylesheet.
  wp_enqueue_style('twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array('twentyfifteen-style'), '20141010');
  wp_style_add_data('twentyfifteen-ie', 'conditional', 'lt IE 9');

  // Load the Internet Explorer 7 specific stylesheet.
  wp_enqueue_style('twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array('twentyfifteen-style'), '20141010');
  wp_style_add_data('twentyfifteen-ie7', 'conditional', 'lt IE 8');

  wp_enqueue_script('twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if (is_singular() && wp_attachment_is_image()) {
    wp_enqueue_script('twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20141010');
  }

  //wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141212', true );
  wp_localize_script('twentyfifteen-script', 'screenReaderText', array(
    'expand'   => '<span class="screen-reader-text">' . __('expand child menu', 'twentyfifteen') . '</span>',
    'collapse' => '<span class="screen-reader-text">' . __('collapse child menu', 'twentyfifteen') . '</span>',
  ));
}
add_action('wp_enqueue_scripts', 'twentyfifteen_scripts');

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background()
{
  if (!is_single()) {
    return;
  }

  $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
  $next     = get_adjacent_post(false, '', false);
  $css      = '';

  if (is_attachment() && 'attachment' == $previous->post_type) {
    return;
  }

  if ($previous &&  has_post_thumbnail($previous->ID)) {
    $prevthumb = wp_get_attachment_image_src(get_post_thumbnail_id($previous->ID), 'post-thumbnail');
    $css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url($prevthumb[0]) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
  }

  if ($next && has_post_thumbnail($next->ID)) {
    $nextthumb = wp_get_attachment_image_src(get_post_thumbnail_id($next->ID), 'post-thumbnail');
    $css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url($nextthumb[0]) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
  }

  wp_add_inline_style('twentyfifteen-style', $css);
}
add_action('wp_enqueue_scripts', 'twentyfifteen_post_nav_background');

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description($item_output, $item, $depth, $args)
{
  if ('primary' == $args->theme_location && $item->description) {
    $item_output = str_replace($args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output);
  }

  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4);

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.js
 */
function twentyfifteen_search_form_modify($html)
{
  return str_replace('class="search-submit"', 'class="search-submit screen-reader-text"', $html);
}
add_filter('get_search_form', 'twentyfifteen_search_form_modify');

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0

require get_template_directory() . '/inc/custom-header.php';
 */

add_theme_support('custom-header');

function glj_custom_header_setup()
{
  $defaults = array(
    // Default Header Image to display
    'default-image'         => get_template_directory_uri() . '/images/headers/default.jpg',
    // Display the header text along with the image
    'header-text'           => false,
    // Header text color default
    'default-text-color'        => '000',
    // Header image width (in pixels)
    'width'             => 1000,
    // Header image height (in pixels)
    'height'            => 198,
    // Header image random rotation default
    'random-default'        => false,
    // Enable upload of image file in admin 
    'uploads'       => false,
    // function to be called in theme head section
    'wp-head-callback'      => 'wphead_cb',
    //  function to be called in preview page head section
    'admin-head-callback'       => 'adminhead_cb',
    // function to produce preview markup in the admin screen
    'admin-preview-callback'    => 'adminpreview_cb',
  );
}
add_action('after_setup_theme', 'glj_custom_header_setup');

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';

// Register custom post type for News
function create_news_post_type()
{
  register_post_type(
    'news',
    array(
      'labels' => array(
        'name' => __('News'),
        'singular_name' => __('News')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'news'),
      'supports' => array('title', 'editor', 'thumbnail','excerpt'),
      'taxonomies' => array('category'), // Add taxonomy to post type
    )
  );
}
add_action('init', 'create_news_post_type');

// // Register Custom Taxonomy
// function create_news_taxonomy()
// {
//   register_taxonomy(
//     'news_category',  // Taxonomy slug
//     'news',           // Post type to which this taxonomy applies
//     array(
//       'hierarchical' => true,
//       'labels' => array(
//         'name' => __('News Categories'),
//         'singular_name' => __('News Category')
//       ),
//       'public' => true,
//       'rewrite' => array('slug' => 'news-category'), // Slug for the taxonomy archive page
//     )
//   );
// }
// add_action('init', 'create_news_taxonomy');

function add_default_categories_to_news() {
    // Get all categories from default posts
    $default_categories = get_categories();

    // Loop through each category and add its name as a term to the 'news' custom post type
    foreach ($default_categories as $category) {
        wp_set_post_categories($category->term_id, array('news'), true);
    }
}
add_action('init', 'add_default_categories_to_news');



function display_news_shortcode($atts)
{
    $atts = shortcode_atts( array(
        'categories' => '', // Default empty categories parameter
    ), $atts );

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'news',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $news_query = new WP_Query($args);
    if ($news_query->have_posts()) {
        $output = '<div class="news">';
        while ($news_query->have_posts()) {
            $news_query->the_post();
            $output .= '<div class="news-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            if (is_user_logged_in()) {
              $moreHref = get_permalink();
          } else {
              $moreHref = "/membership-account/membership-levels/?redirect_to=";
              $moreHref .= urlencode(get_permalink());
          }
          
            // $output .= '<p>' . $content .'<a href="' . $moreHref . '" class="read-more">Read More...</a></p>';
            $output .= '<p>' . $content .'<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            // $output .= '<a href="' . get_permalink() . '" class="read-more">Read More...</a>';
            $output .= '</div>';  
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_news', 'display_news_shortcode');


// Register custom post type for Editor

function create_editors_post_type()
{
  register_post_type(
    'editors_choice',
    array(
      'labels' => array(
        'name' => __('Editors Choice'),
        'singular_name' => __('Editors Choice')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'editors-choice'),
      'supports' => array('title', 'editor', 'thumbnail'),
      'taxonomies' => array('category'), // Add taxonomy to post type
    )
  );
}
add_action('init', 'create_editors_post_type');


function add_default_categories_to_editors() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('Editors Choice'), true);
  }
}
add_action('init', 'add_default_categories_to_editors');

// Shortcode to display polices media posts
function display_editors_choice_shortcode()
{
  $args = array(
    'post_type' => 'editors_choice',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC' // Display oldest posts first
  );
  $polices_media_query = new WP_Query($args);
  if ($polices_media_query->have_posts()) {
    $output = '<div class="polices-media">';
    while ($polices_media_query->have_posts()) {
      $polices_media_query->the_post();
      $output .= '<div class="polices-media-item">';
      $output .= '<h2>' . get_the_content() . '</a></h2>';
      $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    return $output;
  } else {
    return '<p>No Editors Choice found</p>';
  }
}
add_shortcode('display_polices_media', 'display_editors_choice_shortcode');

// Create Columnists Post Type
function create_columnists_post_type()
{
    register_post_type(
        'columnists',
        array(
            'labels' => array(
                'name' => __('Columnists'),
                'singular_name' => __('Columnist')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'columnists'),
            'supports' => array('title', 'editor', 'thumbnail','excerpt'),
            'taxonomies' => array('category'), // Add taxonomy to post type
        )
    );
}
add_action('init', 'create_columnists_post_type');

// Register Custom Taxonomy for Columnists
// function create_columnists_taxonomy()
// {
//     register_taxonomy(
//         'columnists_category',  // Taxonomy slug
//         'columnists',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('Columnists Categories'),
//                 'singular_name' => __('Columnist Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'columnists-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_columnists_taxonomy');

function add_default_categories_to_columnists() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('columnists'), true);
  }
}
add_action('init', 'add_default_categories_to_columnists');

// Shortcode to Display Columnists
function display_columnists_shortcode($atts)
{
    $atts = shortcode_atts( array(
        'categories' => '', // Default empty categories parameter
    ), $atts );

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'columnists',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $columnists_query = new WP_Query($args);
    if ($columnists_query->have_posts()) {
        $output = '<div class="columnists">';
        while ($columnists_query->have_posts()) {
            $columnists_query->the_post();
            $output .= '<div class="columnist-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content .'<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            $output .= '</div>';  
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_columnists', 'display_columnists_shortcode');

// Create Custom Post Type for Bloggers..................................
function create_bloggers_post_type()
{
    register_post_type(
        'bloggers',
        array(
            'labels' => array(
                'name' => __('Bloggers'),
                'singular_name' => __('Blogger')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'bloggers'),
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
            'taxonomies' => array('category'), // Add taxonomy to post type
            'show_in_rest' => true, // Enable block editor
            'rest_base' => 'bloggers', // Base slug for REST API endpoints
        )
    );
}
add_action('init', 'create_bloggers_post_type');


function add_default_metaboxes_to_bloggers() {
  global $wp_meta_boxes;

  // Get all default post type meta boxes
  $default_post_type = 'post';
  $default_metaboxes = $wp_meta_boxes[$default_post_type];

  // Add default meta boxes to custom post type
  $custom_post_type = 'bloggers';
  foreach ($default_metaboxes as $context => $sections) {
      foreach ($sections as $priority => $section) {
          foreach ($section as $id => $box) {
              // Check if the meta box is not already added to the custom post type
              if (!isset($wp_meta_boxes[$custom_post_type][$context][$priority][$id])) {
                  add_meta_box($id, $box['title'], $box['callback'], $custom_post_type, $context, $priority, $box['callback_args']);
              }
          }
      }
  }
}
add_action('add_meta_boxes', 'add_default_metaboxes_to_bloggers');


// Register Custom Taxonomy for Bloggers
// function create_bloggers_taxonomy()
// {
//     register_taxonomy(
//         'bloggers_category',  // Taxonomy slug
//         'bloggers',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('Bloggers Categories'),
//                 'singular_name' => __('Blogger Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'bloggers-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_bloggers_taxonomy');

function add_default_categories_to_bloggers() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('news'), true);
  }
}
add_action('init', 'add_default_categories_to_bloggers');

// Shortcode to Display Bloggers
function display_bloggers_shortcode($atts)
{
    $atts = shortcode_atts( array(
        'categories' => '', // Default empty categories parameter
    ), $atts );

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'bloggers',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
        'order' => 'DESC', // Display posts in ascending order
    );

    $bloggers_query = new WP_Query($args);
    if ($bloggers_query->have_posts()) {
        $output = '<div class="bloggers">';
        while ($bloggers_query->have_posts()) {
            $bloggers_query->the_post();
            $output .= '<div class="blogger-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content . '<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_bloggers', 'display_bloggers_shortcode');

// Register Custom Post Type for Featurettes...............................
function create_featurette_post_type()
{
    register_post_type(
        'featurette',
        array(
            'labels' => array(
                'name' => __('Featurettes'),
                'singular_name' => __('Featurette')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'featurettes'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('category','post_tag') // Add taxonomy to post type
        )
    );
}
add_action('init', 'create_featurette_post_type');

// Register Custom Taxonomy for Featurette Categories
// function create_featurette_taxonomy()
// {
//     register_taxonomy(
//         'featurette_category',  // Taxonomy slug
//         'featurette',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('Featurette Categories'),
//                 'singular_name' => __('Featurette Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'featurette-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_featurette_taxonomy');

function add_default_categories_to_featurette() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('featurette'), true);
  }
}
add_action('init', 'add_default_categories_to_featurette');


// Shortcode to Display Featurettes
function display_featurettes_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'categories' => '', // Default empty categories parameter
    ), $atts);

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'featurette',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $featurette_query = new WP_Query($args);
    if ($featurette_query->have_posts()) {
        $output = '<div class="featurettes">';
        while ($featurette_query->have_posts()) {
            $featurette_query->the_post();
            $output .= '<div class="featurette-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content . '<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_featurettes', 'display_featurettes_shortcode');

// Register Custom Post Type for Jenny Coopes LawToons
function create_lawtoons_post_type()
{
    register_post_type(
        'lawtoons',
        array(
            'labels' => array(
                'name' => __('Jenny Coopes LawToons'),
                'singular_name' => __('Jenny Coopes LawToon')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'lawtoons'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('category','post_tag') // Add taxonomy to post type
        )
    );
}
add_action('init', 'create_lawtoons_post_type');

// Register Custom Taxonomy for Jenny Coopes LawToons Categories
// function create_lawtoons_taxonomy()
// {
//     register_taxonomy(
//         'lawtoons_category',  // Taxonomy slug
//         'lawtoons',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('LawToons Categories'),
//                 'singular_name' => __('LawToon Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'lawtoon-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_lawtoons_taxonomy');

function add_default_categories_to_lawtoons() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('lawtoons'), true);
  }
}
add_action('init', 'add_default_categories_to_lawtoons');

// Shortcode to Display Jenny Coopes LawToons
function display_lawtoons_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'categories' => '', // Default empty categories parameter
    ), $atts);

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'lawtoons',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $lawtoons_query = new WP_Query($args);
    if ($lawtoons_query->have_posts()) {
        $output = '<div class="lawtoons">';
        while ($lawtoons_query->have_posts()) {
            $lawtoons_query->the_post();
            $output .= '<div class="lawtoon-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content . '<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_lawtoons', 'display_lawtoons_shortcode');


// Register Custom Post Type for Justinian Columnists
function create_justinian_columnists_post_type()
{
    register_post_type(
        'justinian_columnists',
        array(
            'labels' => array(
                'name' => __('Justinian Columnists'),
                'singular_name' => __('Justinian Columnist')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'justinian-columnists'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('category') // Add taxonomy to post type
        )
    );
}
add_action('init', 'create_justinian_columnists_post_type');

// Register Custom Taxonomy for Justinian Columnists Categories
// function create_justinian_columnists_taxonomy()
// {
//     register_taxonomy(
//         'justinian_columnists_category',  // Taxonomy slug
//         'justinian_columnists',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('Justinian Columnists Categories'),
//                 'singular_name' => __('Justinian Columnist Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'justinian-columnist-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_justinian_columnists_taxonomy');

function add_default_categories_to_justinian_columnists() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('justinian_columnists'), true);
  }
}
add_action('init', 'add_default_categories_to_justinian_columnists');


// Shortcode to Display Justinian Columnists
function display_justinian_columnists_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'categories' => '', // Default empty categories parameter
    ), $atts);

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'justinian_columnists',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $columnists_query = new WP_Query($args);
    if ($columnists_query->have_posts()) {
        $output = '<div class="justinian-columnists">';
        while ($columnists_query->have_posts()) {
            $columnists_query->the_post();
            $output .= '<div class="columnist-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content . '<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_justinian_columnists', 'display_justinian_columnists_shortcode');

// Register Custom Post Type for Achive

function create_achive_post_type()
{
    register_post_type(
        'achives',
        array(
            'labels' => array(
                'name' => __('Archives'),
                'singular_name' => __('Achive')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'archive'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('category', 'post_tag') // Add taxonomy to post type
        )
    );
}
add_action('init', 'create_achive_post_type');

// Register Custom Taxonomy for Achives Categories
// function create_achives_taxonomy()
// {
//     register_taxonomy(
//         'achives_category',  // Taxonomy slug
//         'achives',           // Post type to which this taxonomy applies
//         array(
//             'hierarchical' => true,
//             'labels' => array(
//                 'name' => __('Achives Categories'),
//                 'singular_name' => __('Achive Category')
//             ),
//             'public' => true,
//             'rewrite' => array('slug' => 'achive-category'), // Slug for the taxonomy archive page
//         )
//     );
// }
// add_action('init', 'create_achives_taxonomy');


function add_default_categories_to_archives() {
  // Get all categories from default posts
  $default_categories = get_categories();

  // Loop through each category and add its name as a term to the 'news' custom post type
  foreach ($default_categories as $category) {
      wp_set_post_categories($category->term_id, array('archives'), true);
  }
}
add_action('init', 'add_default_categories_to_archives');

// Shortcode to Display Achives
function display_achives_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'categories' => '', // Default empty categories parameter
    ), $atts);

    $categories = explode(',', $atts['categories']); // Convert comma-separated categories to array

    $args = array(
        'post_type' => 'achives',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Taxonomy slug
                'field'    => 'slug',
                'terms'    => $categories, // Array of category slugs
                'operator' => 'IN',
            ),
        ),
    );

    $columnists_query = new WP_Query($args);
    if ($columnists_query->have_posts()) {
        $output = '<div class="achives">';
        while ($columnists_query->have_posts()) {
            $columnists_query->the_post();
            $output .= '<div class="columnist-item">';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';

            // Truncate content
            $content = get_the_content();
            $content = wp_trim_words($content, 30, '...');

            $output .= '<p>' . $content . '<a href="' . get_permalink() . '" class="read-more">Read More...</a></p>';
              // Get and display tags
              $tags = get_the_tags();
              if ($tags) {
                  $output .= '<div class="post-tags">';
                  foreach ($tags as $tag) {
                      $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                  }
                  $output .= '</div>';
              }
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>This area does not yet contain any content.</p>';
    }
}
add_shortcode('display_achives', 'display_achives_shortcode');

function restrict_specific_urls() {
  // List of URLs to restrict
  $restricted_urls = array(
      '/news/',
      '/columnists/'
  );

  // Check if the current URL matches any of the restricted URLs
  if (in_array($_SERVER['REQUEST_URI'], $restricted_urls)) {
      // Check if user is not logged in
      if (!is_user_logged_in()) {
          // Redirect to login page
          auth_redirect();
      }
  }
}
add_action('template_redirect', 'restrict_specific_urls');


// Add class to current-menu-items
function custom_active_item_classes($classes = array(), $menu_item = false){
  global $post;
  $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item active' : '';
  return $classes;
  }
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );

// add_action( 'template_redirect', 'check_category_subscription_and_redirect' );

function check_category_subscription_and_redirect() {
    if ( is_single() && ! is_user_logged_in() ) {
        $post_categories = get_the_category();
        $user_id = get_current_user_id();

        foreach ( $post_categories as $category ) {
            if ( ! user_has_subscription_for_category( $user_id, $category->term_id ) ) {
                // The user does not have a subscription for this category.
                // Build the URL to the subscription page, appending a query arg
                // for the required package/category. Adjust as needed.
                $subscription_page_url = home_url( '/subscription/' );
                $redirect_url = add_query_arg( 'package', $category->slug, $subscription_page_url );

                // Redirect the user to the subscription page.
                wp_redirect( $redirect_url );
                exit;
            }
        }
    }
}

/**
 * Check if a user has an active subscription for a given category.
 * This is a placeholder function. Implement your actual subscription logic here.
 *
 * @param int $user_id The user ID.
 * @param int $category_id The category ID.
 * @return bool True if the user has an active subscription for the category, false otherwise.
 */
function user_has_subscription_for_category( $user_id, $category_id ) {
    // Implement your subscription check logic here.
    // Return true if the user has an active subscription for the category, false otherwise.
    return false; // Placeholder return statement.
}

add_action('wp', 'get_current_post_categories');

function get_current_post_categories() {

	if (is_single()) 
	{
		global $wpdb;

        $post_id            = get_the_ID(); 

        $moreHref           = "/membership-account/membership-levels/?redirect_to=";

        $moreHref           .= urlencode(get_permalink());

		$levels             = $wpdb->get_results( "SELECT * FROM {$wpdb->pmpro_membership_levels}", OBJECT );

		foreach ($levels as $key => $value) {
		
			$level_categories = $wpdb->get_col($wpdb->prepare(
			"
					SELECT c.category_id
					FROM $wpdb->pmpro_memberships_categories c
					WHERE c.membership_id = %d",
			$value->id
			));

			$post_categories = wp_get_post_categories($post_id); 

            foreach ($post_categories as $post_categories_key => $post_categories_value) {
				
				if ( in_array( $post_categories_value, $level_categories ) ) 
				{

                    if( !is_user_logged_in() )
                    {
                        wp_redirect( $moreHref );
                        exit;
                    }
                    else if( !current_user_can( 'administrator' ) )
                    {
                        $vjcu_current_user = get_current_user_id();

                        $user_membership_levels = pmpro_getMembershipLevelForUser($vjcu_current_user);

                        if( empty( $user_membership_levels ) || $value->id != $user_membership_levels->ID )
                        {
                            wp_redirect( $moreHref );
                            exit;
                        }
                    }
				}
			}

		}

        $membership_levels = pmpro_getAllLevels( true, true );

        $membership_levels = pmpro_sort_levels_by_order( $membership_levels );

        $page_levels      = $wpdb->get_col( "SELECT membership_id FROM {$wpdb->pmpro_memberships_pages} WHERE page_id = '" . intval( $post_id ) . "'" );

        if( !is_user_logged_in() && !empty( $page_levels ) )
        {
            wp_redirect( $moreHref );
            exit;
        }
        else if( !empty( $page_levels ) && !current_user_can( 'administrator' ) )
        {
            $vjcu_current_user = get_current_user_id();

            $user_membership_levels = pmpro_getMembershipLevelForUser($vjcu_current_user);

            if( empty( $user_membership_levels ) || !in_array( $user_membership_levels->ID, $page_levels ) )
            {
                wp_redirect( $moreHref );
                exit;
            }
        }
	}
}

function pmpro_restrictable_post_types( $post_types ){
    
    $post_types             = get_post_types( array( 'public' => true ), 'names' );

    $excluded_post_types    = array( 'attachment', 'revision', 'nav_menu_item' );

    $post_types             = array_diff( $post_types, $excluded_post_types );

    return $post_types;
}

add_filter( 'pmpro_restrictable_post_types', 'pmpro_restrictable_post_types', 99, 1 );

function custom_upload_dir( $upload ) {
  $upload['subdir'] = '/storage' . $upload['subdir']; // Change '/storage' to your desired path
  $upload['path'] = $upload['basedir'] . $upload['subdir'];
  $upload['url'] = $upload['baseurl'] . $upload['subdir'];

  return $upload;
}
add_filter( 'upload_dir', 'custom_upload_dir' );

function custom_attachment_url( $url, $post_id ) {
  // Get the attachment metadata
  $attachment = get_post( $post_id );

  // Get the upload directory
  $upload_dir = wp_upload_dir();

  // Check if the attachment belongs to the uploads directory
  if ( strpos( $attachment->guid, $upload_dir['baseurl'] ) === 0 ) {
      // Modify the URL to reflect the custom upload directory
      $url = str_replace( $upload_dir['baseurl'], $upload_dir['baseurl'] . '/storage', $url );
  }

  return $url;
}
add_filter( 'wp_get_attachment_url', 'custom_attachment_url', 10, 2 );
?>