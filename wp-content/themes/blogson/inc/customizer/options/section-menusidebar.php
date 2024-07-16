<?php
/**
 * Theme Customizer Controls
 *
 * @package blogson
 */


if ( ! function_exists( 'blogson_customizer_menusidebar_register' ) ) :
function blogson_customizer_menusidebar_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'blogson_menusidebar_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Menu Sidebar Settings', 'blogson' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'blogson_label_menusidebar_settings_title', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_menusidebar_settings_title', 
		array(
		    'label'       => esc_html__( 'Menu Sidebar Settings', 'blogson' ),
		    'section'     => 'blogson_menusidebar_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_menusidebar_settings_title',
		) 
	));

	// Add an option to enable the menu sidebar
	$wp_customize->add_setting( 
		'blogson_enable_menu_left_sidebar', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_menu_left_sidebar', 
		array(
		    'label'       => esc_html__( 'Show Menu Sidebar', 'blogson' ),
		    'section'     => 'blogson_menusidebar_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_menu_left_sidebar',
		) 
	));


	// Info label
	$wp_customize->add_setting( 
		'blogson_label_menusidebar_content_info', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Info_Control( $wp_customize, 'blogson_label_menusidebar_content_info', 
		array(
		    'label'       => esc_html__( 'Note: After enabling this, Go to Appearance -> Widgets and put the widgets on Menu Left Sidebar', 'blogson' ),
		    'section'     => 'blogson_menusidebar_settings',
		    'type'        => 'blogson-info',
		    'settings'    => 'blogson_label_menusidebar_content_info',
		    'active_callback'  => 'blogson_menu_sidebar_enable',
		) 
	));


	// Info label
	$wp_customize->add_setting( 
		'blogson_label_menusidebar_info', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Info_Control( $wp_customize, 'blogson_label_menusidebar_info', 
		array(
		    'label'       => esc_html__( 'Note: Refresh the page if you do not see any changes', 'blogson' ),
		    'section'     => 'blogson_menusidebar_settings',
		    'type'        => 'blogson-info',
		    'settings'    => 'blogson_label_menusidebar_info',
		) 
	));

}
endif;

add_action( 'customize_register', 'blogson_customizer_menusidebar_register' );