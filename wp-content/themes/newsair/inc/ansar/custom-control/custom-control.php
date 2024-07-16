<?php
if( ! function_exists( 'newsair_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function newsair_register_custom_controls( $wp_customize ) {

    require_once get_template_directory() . '/inc/ansar/custom-control/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/inc/ansar/custom-control/customizer-alpha-color-picker/class-newsair-customize-alpha-color-control.php';

    require_once  get_template_directory() . '/inc/ansar/custom-control/custom_tab_control/custom_tab_control_class.php';
    require_once  get_template_directory() . '/inc/ansar/custom-control/responsive_slider_control/responsive_slider_control_class.php';

    $wp_customize->register_control_type( 'Newsair_Toggle_Control' );

}
endif;
add_action( 'customize_register', 'newsair_register_custom_controls' );