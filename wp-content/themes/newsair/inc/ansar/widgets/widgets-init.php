<?php

// Load widget base.
require_once get_template_directory() . '/inc/ansar/widgets/widgets-base.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/ansar/widgets/widgets-common-functions.php';

/* Theme Widgets*/
require get_template_directory() . '/inc/ansar/widgets/widget-posts-carousel.php';

require get_template_directory() . '/inc/ansar/widgets/widget-latest-news.php';
require get_template_directory() . '/inc/ansar/widgets/widget-posts-list.php';
require get_template_directory() . '/inc/ansar/widgets/widget-posts-slider.php';
require get_template_directory() . '/inc/ansar/widgets/widget-design-slider.php';
require get_template_directory() . '/inc/ansar/widgets/widget-author-info.php';
require get_template_directory() . '/inc/ansar/widgets/widget-recent-post.php';
require get_template_directory() . '/inc/ansar/widgets/widget-social-icon.php';
require get_template_directory() . '/inc/ansar/widgets/widget-posts-double-category.php';
require get_template_directory() . '/inc/ansar/widgets/widget-featured-post-widget.php';
require get_template_directory() . '/inc/ansar/widgets/popular_tab_widget.php';

/* Register site widgets */
if ( ! function_exists( 'newsair_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function newsair_widgets() {
        register_widget( 'newsair_Posts_Carousel' );
        register_widget( 'newsair_Latest_Post' );
        register_widget( 'newsair_Posts_List' );
        register_widget( 'newsair_Posts_Slider' );
        register_widget( 'newsair_Design_Slider');
        register_widget( 'newsair_Dbl_Col_Cat_Posts');
        register_widget( 'newsair_author_info');
        register_widget( 'popular_tab_Widget');

    }
endif;
add_action( 'widgets_init', 'newsair_widgets' );



/**
 * newsair Widgets - Loader.
 *
 * @package newsair Widget
 * @since 1.0.0
 */

if ( ! class_exists( 'newsair_Widgets_Loader' ) ) {

    /**
     * Customizer Initialization
     *
     * @since 1.0.0
     */
    class newsair_Widgets_Loader {

        /**
         * Member Variable
         *
         * @var instance
         */
        private static $instance;

        /**
         *  Initiator
         */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         *  Constructor
         */
        public function __construct() {


            // Add Widget.

             add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        }
        
       
            
        function enqueue_admin_scripts() {
             

    wp_enqueue_style( 'wp-color-picker');

        }
        
        
    }
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
newsair_Widgets_Loader::get_instance();