<?php
/**
 * Newsair functions related to adding files.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsair
 *
 * @since   Newsair 0.0.1
 */ 

	define( 'NEWSAIR_THEME_DIR', get_template_directory() . '/' );
	define( 'NEWSAIR_THEME_URI', get_template_directory_uri() . '/' );
	
	$newsair_theme_path = get_template_directory() . '/inc/ansar/';

	require( $newsair_theme_path . '/newsair-custom-navwalker.php' );
	require( $newsair_theme_path . '/default_menu_walker.php' );
	require( $newsair_theme_path . '/font/font.php');
	require( $newsair_theme_path . '/template-tags.php');
	require( $newsair_theme_path . '/template-functions.php');
	require( $newsair_theme_path. '/widgets/widgets-common-functions.php');
	require( $newsair_theme_path . '/custom-control/custom-control.php');
	require( $newsair_theme_path . '/custom-control/font/font-control.php');
	require_once get_template_directory() . '/inc/ansar/customizer-admin/newsair-admin-plugin-install.php';
	require_once( trailingslashit( get_template_directory() ) . 'inc/ansar/customize-pro/class-customize.php' );

	// Theme version.
	$newsair_theme = wp_get_theme();
	define( 'NEWSAIR_THEME_VERSION', $newsair_theme->get( 'Version' ) );
	define( 'NEWSAIR_THEME_NAME', $newsair_theme->get( 'Name' ) );

	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $newsair_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer Layout*/
	/* ----------------------------------------------------------------------------------- */
	require( $newsair_theme_path . '/custom-control/customize_layout.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	require( $newsair_theme_path . '/customize/customizer.php');

	/* ----------------------------------------------------------------------------------- */
	/* Widget */
	/* ----------------------------------------------------------------------------------- */

	require( $newsair_theme_path  . '/widgets/widgets-init.php');

	/* ----------------------------------------------------------------------------------- */
	/* Hook Init */
	/* ----------------------------------------------------------------------------------- */

	require( $newsair_theme_path  . '/hooks/hooks-init.php');

    /* Customizer Theme Color*/
	require get_template_directory().'/inc/ansar/customize/customize-theme-style.php';

	/* custom-color file. */
	require( get_template_directory() . '/css/colors/theme-options-color.php');

	/* Header Type*/
	require get_template_directory().'/inc/ansar/hooks/blocks/header/header-init.php';

	/* Slider Type*/
	require get_template_directory().'/inc/ansar/hooks/blocks/slider/slider-init.php';

	/* Post Format*/
	require_once  get_template_directory()  . '/post-format/post-format.php';

	/* Style For Sidebar*/
	require_once  get_template_directory()  . '/css/custom-style.php';

	/* Typography*/
	require get_template_directory().'/inc/ansar/customize/customizer_typography.php';


if ( ! function_exists( 'newsair_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newsair_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on newsair, use a find and replace
	 * to change 'newsair' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'newsair', get_template_directory() . '/languages' );

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

	// Add featured image sizes
        add_image_size('newsair-slider-full', 1280, 720, true); // width, height, crop
        add_image_size('newsair-featured', 1024, 0, false ); // width, height, crop
        add_image_size('newsair-medium', 720, 380, true); // width, height, crop

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'newsair' ), 
        'footer' => __( 'Footer Menu', 'newsair' ),
	) );



	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	$args = array(
    'default-color' => '#eee',
    'default-image' => '',
	);
	add_theme_support( 'custom-background', $args );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');

     // Woocommerce Gallery Support
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

    // Added theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/* Add theme support for gutenberg block */
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	//Custom logo
	add_theme_support( 'custom-logo');
	
	// custom header Support
			$args = array(
			'default-image'		=>  get_template_directory_uri() .'/images/head-back.jpg',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
			'default-text-color'	=> '000',
			'wp-head-callback'       => 'newsair_header_color',
		);
		add_theme_support( 'custom-header', $args );


	/*
     * Enable support for Post Formats on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array( 'image', 'video', 'gallery', 'audio' ) );
}
endif;
add_action( 'after_setup_theme', 'newsair_setup' );


	function newsair_the_custom_logo() {
	
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

	add_filter('get_custom_logo','newsair_logo_class');


	function newsair_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsair_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newsair_content_width', 640 );
}
add_action( 'after_setup_theme', 'newsair_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsair_widgets_init() {
 	
	$newsair_footer_column_layout = esc_attr(get_theme_mod('newsair_footer_column_layout',3));
	
	$newsair_footer_column_layout = 12 / $newsair_footer_column_layout;

	register_sidebar( array(
		'name'          => esc_html__( 'Menu Sidebar Widget Area', 'newsair' ),
		'id'            => 'menu-sidebar-content',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'newsair' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );

	
	register_sidebar( array(
		'name'          => esc_html__( 'Front-Page Left Sidebar Section', 'newsair'),
		'id'            => 'front-left-page-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front-page Content Section', 'newsair'),
		'id'            => 'front-page-content',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front-Page Right Sidebar Section', 'newsair'),
		'id'            => 'front-right-page-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'newsair' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$newsair_footer_column_layout.' rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>',
	) );


}
add_action( 'widgets_init', 'newsair_widgets_init' );

//Editor Styling 
add_editor_style( array( 'css/editor-style.css') );


/*-----------------------------------------------------------------------------------*/
/*  custom background
/*-----------------------------------------------------------------------------------*/
function newsair_custom_background_function()
{
	$page_bg_image_url = get_theme_mod('newsair_default_bg_image','');
	if($page_bg_image_url!='')
	{
	echo '<style>body{ background-image:url("'.get_template_directory_uri().'/images/bg-pattern/'.$page_bg_image_url.'");}</style>';
	}
}
add_action('wp_head','newsair_custom_background_function',10,0);

/* Category Js */
if(!function_exists('newsair_category_js')):
    function newsair_category_js(){
        if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
            return;
        }
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }
endif;
add_action( 'admin_enqueue_scripts', 'newsair_category_js' );

if(!function_exists('newsair_colorpicker_init_inline')):
    function newsair_colorpicker_init_inline() {
        if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
            return;
        }
        ?>
        <script>
            jQuery( document ).ready( function( $ ) {
                jQuery( '.colorpicker' ).wpColorPicker();
            } );

        </script>
        <?php
    }
endif;
add_action( 'admin_print_scripts', 'newsair_colorpicker_init_inline', 999 );