<?php 
/**
 * Enqueue scripts and styles.
 */

 function newsair_scripts() {

 	wp_enqueue_style('all-css',get_template_directory_uri().'/css/all.css');

	wp_enqueue_style('dark', get_template_directory_uri() . '/css/colors/dark.css');

	wp_enqueue_style('default', get_template_directory_uri() . '/css/colors/default.css');

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_style_add_data('bootstrap', 'rtl', 'replace' );

	wp_enqueue_style('newsair-style', get_stylesheet_uri() );

	wp_style_add_data('newsair-style', 'rtl', 'replace' );
	
	wp_enqueue_style('swiper-bundle-css', get_template_directory_uri() . '/css/swiper-bundle.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

	wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');	

	/* Js script */

	wp_enqueue_script( 'newsair-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));

	wp_enqueue_script('bootstrap_script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

	wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/js/swiper-bundle.js', array('jquery'));

	wp_enqueue_script('sticky-js', get_template_directory_uri() . '/js/hc-sticky.js' , array('jquery'));
	
	wp_enqueue_script('sticky-header-js', get_template_directory_uri() . '/js/jquery.sticky.js' , array('jquery'));

	wp_enqueue_script('smartmenus-js', get_template_directory_uri() . '/js/jquery.smartmenus.js');

	wp_enqueue_script('bootstrap-smartmenus-js', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'newsair_scripts');
function newsair_admin_enqueue( $hook ) {

	wp_enqueue_script( 'media-upload' );

	wp_enqueue_media();

	wp_enqueue_style( 'newsair-admin-style', get_template_directory_uri() . '/css/admin-style.css' );

}
add_action( 'admin_enqueue_scripts', 'newsair_admin_enqueue' );
//Custom Color
function newsair_custom_js() {
    
	wp_enqueue_script('newsair-dark', get_template_directory_uri() . '/js/dark.js' , array('jquery'));

	theme_options_color();

}
add_action('wp_footer','newsair_custom_js');


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function newsair_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'newsair_skip_link_focus_fix' );

//Footer widget text color
function newsair_footer_text_color()
{
$newsair_footer_text_color = get_theme_mod('newsair_footer_text_color');
if($newsair_footer_text_color)
{ ?>
	<style>
		footer .bs-widget p, footer .site-title a, footer .site-title a:hover , footer .site-description, footer .site-description:hover, footer .bs-widget h6, footer .mg_contact_widget .bs-widget h6 {
			color: <?php echo esc_attr($newsair_footer_text_color); ?>;
		}

	</style>
<?php }
$newsair_footer_copy_bg = get_theme_mod('newsair_footer_copy_bg');
if($newsair_footer_copy_bg){ ?>
	<style>
		footer .bs-footer-copyright {
    		background: <?php echo esc_attr($newsair_footer_copy_bg); ?>;
		}
	</style>
<?php }
$newsair_footer_copy_text = get_theme_mod('newsair_footer_copy_text');
if($newsair_footer_copy_text)
{ ?>
	<style>
		footer .bs-footer-copyright p, footer .bs-footer-copyright a {
    		color: <?php echo esc_attr($newsair_footer_copy_text); ?>;
		}
	</style>
<?php } }
add_action('wp_footer','newsair_footer_text_color');

?>
<?php
function newsair_footer_js()
{
wp_enqueue_script('newsair_custom-js', get_template_directory_uri() . '/js/custom.js' , array('jquery'));
}  
add_action('wp_footer','newsair_footer_js');


if ( ! function_exists( 'newsair_admin_scripts' ) ) :
function newsair_admin_scripts() {
    wp_enqueue_script( 'newsair-admin-script', get_template_directory_uri() . '/inc/ansar/customizer-admin/js/newsair-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'newsair-admin-script', 'newsair_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style('newsair-admin-style-css', get_template_directory_uri() . '/css/customizer-controls.css');
}
endif;
add_action( 'admin_enqueue_scripts', 'newsair_admin_scripts' );

// Add Function For Dark & Light
function newsair_theme_skin_js() {

	$newsair_skin_mode = get_theme_mod('newsair_skin_mode','defaultcolor');
	
	if($newsair_skin_mode == "defaultcolor") {?>
		<script type="text/javascript">
		(function($) {
		"use strict";
		
			document.documentElement.setAttribute("data-theme", " ")
			//document.getElementById("switch").checked = false;
			localStorage.setItem("data-theme", '')
		
		})(jQuery); 
		</script>
	<?php 
	} else { ?>
		<script type="text/javascript">
		(function($) {
		"use strict";
		
			document.documentElement.setAttribute("data-theme", "dark")
			//document.getElementById("switch").checked = true;
			localStorage.setItem("data-theme", "dark")
		
		})(jQuery); 
		</script>
	<?php } ?>
	<?php
}
add_action('wp_footer','newsair_theme_skin_js');
	
function newsair_toggle_color() {
	$header_textcolor = get_theme_mod('header_textcolor', "000");
	$header_text_dark_color = get_theme_mod('header_text_dark_color', "#fff"); ?>

	<script type="text/javascript">
	let theme = localStorage.getItem('data-theme');
	const checkbox = document.getElementById("switch");
	const changeThemeToDark = () =>{
		document.documentElement.setAttribute("data-theme", "dark")
		document.getElementById("switch").checked = true;
		localStorage.setItem("data-theme", "dark");
		document.querySelector(".site-title a").style.color = '<?php echo $header_text_dark_color; ?>';
		document.querySelector(".site-description").style.color = '<?php echo $header_text_dark_color; ?>';
	
		// For Responsive
		document.querySelector(".m-header .site-title a").style.color = '<?php echo esc_attr($header_text_dark_color); ?>';
		document.querySelector(".m-header .site-description").style.color = '<?php echo esc_attr($header_text_dark_color); ?>';

	}
	
	const changeThemeToLight = () =>{
		document.documentElement.setAttribute("data-theme", "")
		localStorage.setItem("data-theme", '')
		document.querySelector(".site-title a").style.color = '#<?php echo $header_textcolor; ?>';
		document.querySelector(".site-description").style.color = '#<?php echo $header_textcolor; ?>'; 
	
		// For Responsive
		document.querySelector(".m-header .site-title a").style.color = '#<?php echo esc_attr($header_textcolor); ?>';
		document.querySelector(".m-header .site-description").style.color = '#<?php echo esc_attr($header_textcolor); ?>';
	}
	
	if(theme === 'dark'){
		changeThemeToDark()
	}else{
		changeThemeToLight()
	}
	
	checkbox.addEventListener('change', ()=> {
		let theme = localStorage.getItem('data-theme');
		if (theme ==='dark'){
			changeThemeToLight()
		}else{
			changeThemeToDark()
		}
	   
	});
		  
	</script>
	<?php
}
add_action('wp_footer','newsair_toggle_color');

//Cusotm colors
function newsair_title_tagline_color() { 
	$newsair_skin_mode = get_theme_mod('newsair_skin_mode','defaultcolor');
	
	if($newsair_skin_mode == "defaultcolor") {?>
		<style>
		.site-description , .site-title a {
			color: <?php echo esc_attr(get_theme_mod('header_textcolor')); ?>;
		}
		</style>
		<?php 
	} else { ?>
		<style>
		.site-description , .site-title a{
			color: <?php echo esc_attr(get_theme_mod('header_text_dark_color', "#fff")); ?>;
		}
		</style>
	<?php } 
}
add_action('wp_footer','newsair_title_tagline_color');

//Custom Typography Enable
function enable_custom_typography() {
    $enable_custom_typography = get_theme_mod('enable_custom_typography',false);
    if( $enable_custom_typography == 'true') {
		custom_typography_function();
    }
}
add_action('wp_footer','enable_custom_typography');