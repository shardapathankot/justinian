<?php 
// Adding customizer home page setting
function newsair_style_customizer( $wp_customize ){
	
   class WP_line_break_Customize_Control extends WP_Customize_Control {
	public $type = 'new_menu';

		function render_content()
		{
			echo '<hr></hr>';
		} 
	}
	// Add Background Settings Section
    $wp_customize->add_section('background_image',
		array(
			'title' => esc_html__('Background Settings', 'newsair'),
			'priority' => 35,
			'capability' => 'edit_theme_options',
		)
    );

	// Background Color Heading
    $wp_customize->add_setting(
        'frontpage_slider_heading',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'newsair_sanitize_text',
            'priority' => 1,
        )
    );
    $wp_customize->add_control(
    'frontpage_slider_heading',
        array(
            'type' => 'hidden',
            'label' => __('Background Color','newsair'),
            'section' => 'colors',
        )
    );
	$wp_customize->add_control('background_color');

    //Theme Background Color
	$wp_customize->add_setting(
	    'body_background_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color','default' => '#eff2f7',
	    
	) );
	$wp_customize->add_control(new Newsair_Customize_Alpha_Color_Control( $wp_customize,'body_background_color', array(
	   'label'      => __('Background Color', 'newsair' ),
	    'palette' => true,
	    'section' => 'colors',
	    'settings' => 'body_background_color'
		)
	) );

    //Add  Section
    $wp_customize->add_section( 'header_image', array(
        'capability'     => 'edit_theme_options',
        'title'      => __('Header Image','newsair'),
        'priority' => 6,
    ) );
    // $wp_customize->get_control( 'header_image')->priority = 5; 

    	
// Enable/Disable Footer Widgets typography section
$wp_customize->add_setting(
    'remove_header_image_overlay',
    array(
        'default'           =>  false,
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' =>  'sanitize_text_field',
    ) );
	
$wp_customize->add_control('remove_header_image_overlay', array(
	'label' => __('Remove Overlay Color','newsair'),
    'section' => 'header_image', 
	'type'    =>  'checkbox'
));

//Theme Background Color
$wp_customize->add_setting(
    'newsair_header_overlay_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color','default' => '',
    
) );
$wp_customize->add_control(new Newsair_Customize_Alpha_Color_Control( $wp_customize,'newsair_header_overlay_color', array(
   	'label'      => __('Background Color', 'newsair' ),
    'palette' => true,
    'section' => 'header_image',
    'active_callback'   => function( $setting ) {
			if ( $setting->manager->get_setting( 'remove_header_image_overlay' )->value() == false ) {
				return true;
			}
			return false;
    	}
	)
) );

  //================ Header Image Height =================
// For Desktop   
$wp_customize->add_setting('desktop_header_image_height',
array(
'default' => '200',
'capability' => 'edit_theme_options',
'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('tablet_header_image_height',array(

    'default' => '150',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('mobile_header_image_height',array(

    'default' => '130',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'general_header_image_height', array(
    'label' => __('Height', 'newsair' ),
    'section' => 'header_image',
    'settings' => [

    'desktop_input' => 'desktop_header_image_height',
    'tablet_input' => 'tablet_header_image_height',
    'mobile_input' => 'mobile_header_image_height',
    ],
    'is_responsive' => true,
    'input_attrs' => array(
    'min' => 0,
    'max' => 500,
    'step' => 1,
    ),
    
) ) ); 

}


add_action( 'customize_register', 'newsair_style_customizer' );