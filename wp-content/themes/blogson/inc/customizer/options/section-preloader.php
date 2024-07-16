<?php
/**
 * Theme Customizer Controls
 *
 * @package blogson
 */


if ( ! function_exists( 'blogson_customizer_preloader_register' ) ) :
function blogson_customizer_preloader_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'blogson_preloader_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Preloader Settings', 'blogson' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'blogson_label_preloader_settings_title', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_preloader_settings_title', 
		array(
		    'label'       => esc_html__( 'Preloader Settings', 'blogson' ),
		    'section'     => 'blogson_preloader_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_preloader_settings_title',
		) 
	));

	// Add an option to enable the preloader
	$wp_customize->add_setting( 
		'blogson_enable_preloader', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_preloader', 
		array(
		    'label'       => esc_html__( 'Show Preloader', 'blogson' ),
		    'section'     => 'blogson_preloader_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_preloader',
		) 
	));

}
endif;

add_action( 'customize_register', 'blogson_customizer_preloader_register' );