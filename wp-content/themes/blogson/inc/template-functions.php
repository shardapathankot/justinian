<?php
/**
 * @package blogson
 */


/**
 * Header
 */

if ( ! function_exists( 'blogson_header_menu_styles' ) ) :
function blogson_header_menu_styles() {
    get_template_part( 'inc/header-menu/content',esc_html(get_theme_mod('blogson_header_menu_style','style1')));
}
endif;
add_action( 'blogson_action_header', 'blogson_header_menu_styles' );   


/**
 * Footer
 */

if ( ! function_exists( 'blogson_footer_copyrights' ) ) :
function blogson_footer_copyrights() {
	?>
		<div class="row">
            <div class="copyrights">
                <p>
                    <?php

                        if("" != esc_html(get_theme_mod( 'blogson_footer_copyright_text'))) {
                            echo esc_html(get_theme_mod( 'blogson_footer_copyright_text')); 
                            if(get_theme_mod('blogson_en_footer_credits',true)) {
                                ?><span><?php esc_html_e(' | Theme by ','blogson') ?><a href="<?php echo esc_url(BLOGSON_THEME_AUTH); ?>" target="_blank"><?php esc_html_e('Spiracle Themes','blogson') ?></a></span>
                                <?php   
                            }
                        }
                        else{
                            echo date_i18n(
                                /* translators: Copyright date format, see https://secure.php.net/date */
                                _x( 'Y', 'copyright date format', 'blogson' )
                            );
                            ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                <span><?php esc_html_e(' | Theme by ','blogson') ?><a href="<?php echo esc_url(BLOGSON_THEME_AUTH); ?>" target="_blank"><?php esc_html_e('Spiracle Themes','blogson') ?></a></span>
                            <?php
                        }
                    ?>
                </p>
            </div>
        </div>
	<?php
}
endif;
add_action( 'blogson_action_footer', 'blogson_footer_copyrights' );	


/**
* Custom excerpt length.
*/
if ( ! function_exists( 'blogson_my_excerpt_length' ) ) :
function blogson_my_excerpt_length($length) {
	if ( is_admin() ) {
		return $length;
	}
  	return absint(get_theme_mod( 'blogson_posts_excerpt_length',70));
}
endif;
add_filter('excerpt_length', 'blogson_my_excerpt_length');



/**
 * Category list
 */

if( !function_exists( 'blogson_category_list' ) ):
    function blogson_category_list() {
        $pm_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $pm_cat_lists = get_categories( $pm_args );
        $pm_cat_list = array('' => esc_html__('--Select--','blogson'));
        foreach( $pm_cat_lists as $category ) {
            $pm_cat_list[esc_html( $category->slug )] = esc_html( $category->name );
        }
        return $pm_cat_list;
    }
endif;


/**
 * Get Page Title
 */

if( !function_exists( 'blogson_get_title' ) ):
    function blogson_get_title() {
    	if(!is_front_page()) :
    		?>
	            <div class="page-title">
	                <h1 class="main-title"><?php the_title(); ?></h1>
	            </div>
	        <?php
    	endif;
    }
endif;


/**
 * Adding blog sidebar classes to body
 */
if ( ! function_exists( 'blogson_add_blog_sidebar_classes_to_body' ) ) :
function blogson_add_blog_sidebar_classes_to_body($classes = '') {
    if('right'===esc_html(get_theme_mod('blogson_blog_single_sidebar_layout','no'))) {
        $classes[] = 'single-right-sidebar';
    }
    else if('left'===esc_html(get_theme_mod('blogson_blog_single_sidebar_layout','no'))){
        $classes[] = 'single-left-sidebar';   
    }
    else{
        $classes[] = 'single-no-sidebar';
    }
    return $classes;
}
endif;
add_filter('body_class', 'blogson_add_blog_sidebar_classes_to_body');


/**
 * Menu Search
 */
if ( ! function_exists( 'blogson_menu_search' ) ) :
function blogson_menu_search($items, $args) {
    if( $args->theme_location == 'primary' )
        return $items.'<li class="menu-header-search">
                            <button class="search-btn"><i class="fas fa-search"></i></button>
                    </li>
                    <!-- Popup Search -->
                    <div id="searchOverlay" class="overlay">
                        <div class="overlay-content">
                            <form method="get" class="searchformmenu" action="'. esc_url(home_url( '/' )) . '">
                                <div class="search">
                                    <input type="text" value="" class="blog-search" name="s" placeholder="'. esc_attr__( 'Search here','blogson' ) .'">
                                    <label for="searchsubmit" class="search-icon"><i class="fas fa-search"></i></label>
                                    <input type="submit" class="searchsubmitmenu" value="'. esc_attr__( 'Search','blogson' ) .'">
                                </div>
                            </form>
                        </div>
                        <button class="search-closebtn" title="'. esc_attr__('Close','blogson') .'" > <i class="fas fa-times"></i></button>
                    </div>
                    ';
    return $items;
}
endif;

if ( ! function_exists( 'blogson_filter_menu_search_hook' ) ) :
function blogson_filter_menu_search_hook() {
    add_filter('wp_nav_menu_items','blogson_menu_search', 10, 2);
}
endif;
add_action( 'wp', 'blogson_filter_menu_search_hook' );


/**
 * Preconnect Fonts
 */
function blogson_preconnect_fonts() {
    ?> 
        <link rel="dns-prefetch" href="https://fonts.gstatic.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <?php
}
add_action( 'wp_head', 'blogson_preconnect_fonts' ); 


/**
 * Search Form
 */
if ( ! function_exists( 'blogson_search_content' ) ) :
function blogson_search_content() {
    ?>  
        <div class="search-form-wrapper">
            <form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="form-group search">
                    <label class="screen-reader-text" for="searchsubmit"><?php esc_html_e('Search for:', 'blogson'); ?></label>
                    <input type="search" id="pm-search-field" class="search-field"   placeholder="<?php esc_attr_e('Search here','blogson') ?>" value="<?php echo get_search_query(); ?>" name="s"/>
                    <button type="submit" value=""><?php esc_html_e('Search','blogson') ?></button>
                </div>
            </form>
        </div>
    <?php
}
endif;
add_action('blogson_action_search_content', 'blogson_search_content');


/**
 * Left Modal
 */
if ( ! function_exists( 'blogson_left_modal_content' ) ) :
function blogson_left_modal_content() {
    ?>  
        <div class="modal left fade" id="pmModal" tabindex="-1" role="dialog" aria-labelledby="pmModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
					</div>
					<div class="modal-body">
						<aside id="menuleftsidebar" class="widget-area" role="complementary">
							<?php
								if ( is_active_sidebar('menuleftsidebar')) {
									dynamic_sidebar('menuleftsidebar');
								}
							?>
						</aside>
					</div>
				</div>
			</div>
		</div>
    <?php
}
endif;
add_action('blogson_action_left_modal_content', 'blogson_left_modal_content');


/**
 * Function for storing activation time
 */   
function blogson_activation_time() {
    if ( false === get_option( 'blogson_activation_time' ) ) {
        add_option( 'blogson_activation_time', strtotime('now') );
    }
}
add_action( 'after_switch_theme', 'blogson_activation_time');
add_action('after_setup_theme', 'blogson_activation_time');


/**
 * Function for Minimizing dynamic CSS
 */
function blogson_minimize_css($css){
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css);
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}


/**
 * Adding class to body
 */
if ( ! function_exists( 'blogson_add_classes_to_body' ) ) :
function blogson_add_classes_to_body($classes = '') {
    $classes[] = 'theme-blogson';
    return $classes;
}
endif;
add_filter('body_class', 'blogson_add_classes_to_body');


/**
 * Function for changing category archive title
 */
function blogson_get_archive_title($title) {
    if ( is_category() ) {
        $title_text = esc_html(get_theme_mod( 'blogson_cat_archive_title_text', esc_html__('Category:','blogson'))). " ";
        $title = single_cat_title($title_text);
    }
    return $title;
}
if(true===get_theme_mod( 'blogson_enable_cat_archive_settings',false)) :
    add_filter( 'get_the_archive_title', 'blogson_get_archive_title');    
endif;


/** 
* Disable Plugin Redirect
*/
function blogson_prevent_plugins_redirect() {
    delete_transient( 'elementor_activation_redirect' );
}
add_action('admin_init', 'blogson_prevent_plugins_redirect');