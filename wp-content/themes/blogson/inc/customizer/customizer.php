<?php
/**
 * BlogSon Theme Customizer
 *
 * @package blogson
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! function_exists( 'blogson_customize_register' ) ) :
function blogson_customize_register( $wp_customize ) {

    // Add custom controls.
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-title-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/radio-images/class-radio-image-control.php' );

    // Register the custom control type.
    $wp_customize->register_control_type( 'BlogSon_Toggle_Control' );


    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'blogson_site_title_callback',
            'fallback_refresh'    => false,
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'blogson_site_description_callback',
            'fallback_refresh'    => false, 
        ) );
    }

    // Display Site Title and Tagline
    $wp_customize->add_setting( 
        'blogson_display_site_title_tagline', 
        array(
            'default'           => true,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'blogson_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control( 
        new BlogSon_Toggle_Control( $wp_customize, 'blogson_display_site_title_tagline', 
        array(
            'label'       => esc_html__( 'Display Site Title and Tagline', 'blogson' ),
            'section'     => 'title_tagline',
            'type'        => 'blogson-toggle',
            'settings'    => 'blogson_display_site_title_tagline',
        ) 
    ));
}
endif;
add_action( 'customize_register', 'blogson_customize_register' );

//menu sidebar settings
get_template_part( 'inc/customizer/options/section-menusidebar' );

//blog settings
get_template_part( 'inc/customizer/options/section-blog' );

//footer settings
get_template_part( 'inc/customizer/options/section-footer' );

//preloader settings
get_template_part( 'inc/customizer/options/section-preloader' );

//customizer helper
get_template_part( 'inc/customizer/customizer-helpers' );

//data sanitization
get_template_part( 'inc/customizer/data-sanitization' );



/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'blogson_enqueue_customizer_stylesheets' ) ) :
function blogson_enqueue_customizer_stylesheets() {
    wp_register_style( 'blogson-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/css/customizer.css', array(), '1.0.9', 'all' );
    wp_enqueue_style( 'blogson-customizer-css' );
    wp_enqueue_script( 'blogson-customizer-js', get_template_directory_uri(). '/inc/customizer/assets/js/customizer.js' , array('jquery'), false, true);
}
endif;
add_action( 'customize_controls_print_styles', 'blogson_enqueue_customizer_stylesheets' );