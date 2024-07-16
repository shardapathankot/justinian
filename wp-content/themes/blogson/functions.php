<?php
/**
 * BlogSon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blogson
 */

/**
 *  Defining Constants
 */

// Core Constants
define('BLOGSON_REQUIRED_PHP_VERSION', '5.6' );
define('BLOGSON_DIR_PATH', get_template_directory());
define('BLOGSON_DIR_URI', get_template_directory_uri());
define('BLOGSON_THEME_AUTH','https://www.spiraclethemes.com/');
define('BLOGSON_THEME_URL','https://www.spiraclethemes.com/blogson-free-wordpress-theme/');
define('BLOGSON_THEME_PRO_URL','https://www.spiraclethemes.com/blogson-pro-addons/');
define('BLOGSON_THEME_DOC_URL','https://www.spiraclethemes.com/blogson-documentation/');
define('BLOGSON_THEME_VIDEOS_URL','https://www.spiraclethemes.com/blogson-video-tutorials/');
define('BLOGSON_THEME_SUPPORT_URL','https://wordpress.org/support/theme/blogson/');
define('BLOGSON_THEME_RATINGS_URL','https://wordpress.org/support/theme/blogson/reviews/');
define('BLOGSON_THEME_CHANGELOGS_URL','https://themes.trac.wordpress.org/log/blogson/');
define('BLOGSON_THEME_CONTACT_URL','https://www.spiraclethemes.com/contact/');

/**
* Check for minimum PHP version requirement 
*
*/
function blogson_check_theme_setup( $oldtheme_name, $oldtheme ){
	// Compare versions.
	if ( version_compare(phpversion(), BLOGSON_REQUIRED_PHP_VERSION, '<') ) :
	// Theme not activated info message.
	add_action( 'admin_notices', 'blogson_php_admin_notice' );
	function blogson_php_admin_notice() {
		?>
			<div class="update-nag">
		  		<?php esc_html_e( 'You need to update your PHP version to a minimum of 5.6 to run BlogSon Theme.', 'blogson' ); ?> <br />
		  		<?php esc_html_e( 'Actual version is:', 'blogson' ) ?> <strong><?php echo phpversion(); ?></strong>, <?php esc_html_e( 'required is', 'blogson' ) ?> <strong><?php echo BLOGSON_REQUIRED_PHP_VERSION; ?></strong>
			</div>
		<?php
	}
	// Switch back to previous theme.
	switch_theme( $oldtheme->stylesheet );
		return false;
	endif;
}
add_action( 'after_switch_theme', 'blogson_check_theme_setup', 10, 2  );


if ( ! function_exists( 'blogson_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogson_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BlogSon, use a find and replace
	 * to change 'blogson' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blogson', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'blogson' ),
		'footer' => esc_html__( 'Footer', 'blogson' ),
		'social' => esc_html__( 'Sidebar Social', 'blogson' ),
		'footer-social' => esc_html__( 'Footer Social', 'blogson' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(		
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Remove theme support for new widgets block editor
	remove_theme_support( 'widgets-block-editor' );

	/**
	 * BlogSon theme info
	 */
	require get_template_directory() . '/inc/theme-info.php';

	/**
	 * BlogSon custom posts image size
	 */
	add_image_size( 'blogson-posts', 765, 500, true );

	/**
	 * BlogSon custom posts thumbs size
	 */
	add_image_size( 'blogson-posts-thumb', 150, 100, true );

	/*
	* About page instance
	*/
	$config = array();
	BlogSon_About_Page::blogson_init( $config );

}
endif;
add_action( 'after_setup_theme', 'blogson_setup' );


/**
* Custom Logo 
*
*/
function blogson_logo_setup() {
    add_theme_support( 'custom-logo', array(
	   'height'      => 65,
	   'width'       => 350,
	   'flex-height' => true,
	   'flex-width' => true,	   
	) );
}
add_action( 'after_setup_theme', 'blogson_logo_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogson_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogson_content_width', 640 );
}
add_action( 'after_setup_theme', 'blogson_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogson_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'blogson' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blogson' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if(true===get_theme_mod( 'blogson_enable_menu_left_sidebar',false)) :
        register_sidebar( array(
            'name'          => esc_html__( 'Menu Left Sidebar', 'blogson' ),
            'id'            => 'menuleftsidebar',
            'description'   => esc_html__( 'Add widgets here.', 'blogson' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
        ) );
    endif;

}
add_action( 'widgets_init', 'blogson_widgets_init' );


/**
* Admin Scripts
*/
if ( ! function_exists( 'blogson_admin_scripts' ) ) :
function blogson_admin_scripts($hook) {
  	wp_enqueue_style( 'blogson-info-css', get_template_directory_uri() . '/css/blogson-theme-info.css', false ); 
}
endif;
add_action( 'admin_enqueue_scripts', 'blogson_admin_scripts' );


/**
 * Display Dynamic CSS.
 */
function blogson_dynamic_css_wrap() {
	require_once( get_parent_theme_file_path( '/css/dynamic.css.php' ) );  
	?>
  		<style type="text/css" id="blogson-dynamic-style">
    		<?php echo blogson_dynamic_css_stylesheet(); ?>
  		</style>
	<?php 
}
add_action( 'wp_head', 'blogson_dynamic_css_wrap' );


/**
 * Enqueue Styles and Scripts
 */
function blogson_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7');
	wp_register_style( 'blogson-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	wp_style_add_data( 'blogson-style', 'rtl', 'replace' );
	wp_enqueue_style( 'blogson-style' );
	
	wp_register_style( 'blogson-blocks-frontend', get_template_directory_uri() . '/css/blocks-frontend.css', array(), wp_get_theme()->get('Version'));
	wp_style_add_data( 'blogson-blocks-frontend', 'rtl', 'replace' );
	wp_enqueue_style( 'blogson-blocks-frontend' );
	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome.css', array(), '5.10.1');
	wp_enqueue_style( 'm-customscrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array(), '3.1.5');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.7.2');
	wp_enqueue_style( 'poppins-google-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap', array(), '1.0');   
	wp_enqueue_style( 'spectral-google-font', 'https://fonts.googleapis.com/css?family=Spectral:400,700&display=swap', array(), '1.0');   

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array(), '3.3.7', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2', true );
	wp_enqueue_script( 'resize-sensor', get_template_directory_uri() . '/js/ResizeSensor.js',array(),'1.0.0', true );	
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js',array(),'1.7.0', true );
	wp_enqueue_script( 'm-customscrollbar-js', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js',array(),'3.1.5', true );
	wp_enqueue_script( 'blogson-script', get_template_directory_uri() . '/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true );		
	wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js',array(), '3.7.3');
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'blogson_scripts' );


/**
* Custom search form
*/
function blogson_search_form( $form ) {
    $form = '<form method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
    <div class="search">
      <input type="text" value="' . get_search_query() . '" class="blog-search" name="s" id="s" placeholder="'. esc_attr__( 'Search here','blogson' ) .'">
      <label for="searchsubmit" class="search-icon"><i class="fas fa-search"></i></label>
      <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','blogson' ) .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'blogson_search_form', 100 );


/** 
* Excerpt More
*/
function blogson_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
    return '&hellip;';
}
add_filter('excerpt_more', 'blogson_excerpt_more');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blogson_pingback_header() {
 	if ( is_singular() && pings_open() ) {
    	printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
  	}
}
add_action( 'wp_head', 'blogson_pingback_header' );


/**
 * Load our Block Editor styles to style the Editor like the front-end
 */
if ( ! function_exists( 'blogson_block_editor_width_styles' ) ) :
function blogson_block_editor_width_styles() {
	$blogson_layout_width = 1200;
	$styles = '';

	wp_register_style( 'blogson-blocks-style', trailingslashit( get_template_directory_uri() ) . 'css/blocks-style.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'blogson-blocks-style' );

	// Increase width of Title
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-post-title .editor-post-title__block {max-width: ' . esc_attr( $blogson_layout_width - 10 ) . 'px;}';

	// Increase width of all Blocks & Block Appender
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block {max-width: ' . esc_attr( $blogson_layout_width - 10 ) . 'px;}';
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-default-block-appender {max-width: ' . esc_attr( $blogson_layout_width - 10 ) . 'px;}';

	// Increase width of Wide blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="wide"] {max-width: ' . esc_attr( $blogson_layout_width - 10 + 400 ) . 'px;}';

	// Remove max-width on Full blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="full"] {max-width: none;}';

	// Output our styles into the <head> whenever our block styles are enqueued
	wp_add_inline_style( 'blogson-blocks-style', $styles );
}
endif;
add_action( 'enqueue_block_editor_assets', 'blogson_block_editor_width_styles' );


/**
 * Customizer additions.
 */
require get_parent_theme_file_path() . '/inc/customizer/customizer.php';

/**
 * Template functions
 */
require get_parent_theme_file_path() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom template hooks for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-hooks.php';

/**
 * Extra classes for this theme.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

/**
 * Load Widgets.
 */
require get_parent_theme_file_path() . '/inc/widgets.php';

/**
 * Notices
 */
require_once get_parent_theme_file_path( '/inc/activation/class-welcome-notice.php' );
require_once get_parent_theme_file_path( '/inc/activation/class-rating-notice.php' );

/**
 * Upgrade Pro
 */
require_once( trailingslashit( get_template_directory() ) . 'blogson-pro/class-customize.php' );