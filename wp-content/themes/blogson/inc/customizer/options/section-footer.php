<?php
/**
 * Theme Customizer Controls
 *
 * @package blogson
 */


if ( ! function_exists( 'blogson_customizer_footer_register' ) ) :
function blogson_customizer_footer_register( $wp_customize ) {
 	
 	$wp_customize->add_section(
        'blogson_footer_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Footer Settings', 'blogson' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'blogson_label_footer_settings_title', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_footer_settings_title', 
		array(
		    'label'       => esc_html__( 'Footer Settings', 'blogson' ),
		    'section'     => 'blogson_footer_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_footer_settings_title',
		) 
	));

	// Copyright text
    $wp_customize->add_setting(
        'blogson_footer_copyright_text',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'blogson_sanitize_textarea_field'
        )
    );

    $wp_customize->add_control(
        'blogson_footer_copyright_text',
        array(
            'settings'      => 'blogson_footer_copyright_text',
            'section'       => 'blogson_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer Copyright Text', 'blogson' ),
            'description'   => esc_html__( 'Copyright text to be displayed in the footer. No HTML allowed.', 'blogson' )
        )
    ); 

}
endif;

add_action( 'customize_register', 'blogson_customizer_footer_register' );