<?php 
// Adding customizer home page setting
function papernews_style_customizer( $wp_customize ){
    $papernews_default = papernews_get_default_theme_options();
//Header Background Color
$wp_customize->add_setting(
    'papernews_header_overlay_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color','default' => '',
    
) );
$wp_customize->add_control(new Newsair_Customize_Alpha_Color_Control( $wp_customize,'papernews_header_overlay_color', array(
   	'label'      => __('Background Color', 'paper-news' ),
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


// Featured Slider Tab
$wp_customize->add_setting(
    'slider_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'slider_tabs',
    array(
        'label'                 => '',
        'priority' 				=> 9,
        'type' => 'custom-tab-control',
        'section'               => 'frontpage_main_banner_section_settings',
        'controls_general'      => json_encode( array(  
                                                        '#customize-control-show_main_banner_section', 
                                                        '#customize-control-main_banner_section_background_image',
                                                        '#customize-control-main_slider_section_title', 
                                                        '#customize-control-select_slider_news_category', 
                                                        '#customize-control-main_trending_post_section_title', 
                                                        '#customize-control-select_trending_news_category',
                                                        '#customize-control-main_editor_post_section_title', 
                                                        '#customize-control-select_editor_news_category',
                                                        '#customize-control-newsair_header_layout',
                                                        '#customize-control-recent_post_section_title',
                                                        '#customize-control-select_recent_post_category',
        ) ),
        'controls_design'       => json_encode( array(  
                                                        '#customize-control-main_slider_section_title',
                                                        '#customize-control-newsair_slider_title_font_size',
                                                        '#customize-control-slider_meta_enable',
                                                        '#customize-control-tren_edit_section_title',
                                                        '#customize-control-newsair_tren_edit_title_font_size',
        ) ),
    )
));


$wp_customize->get_control( 'main_trending_post_section_title')->priority = 24;
$wp_customize->get_control( 'select_trending_news_category')->priority = 24;
$wp_customize->get_control( 'main_editor_post_section_title')->priority = 24;
$wp_customize->get_control( 'select_editor_news_category')->priority = 24;
$wp_customize->remove_section( 'featured_story_section_settings');

//Recent Post Section
//section title
$wp_customize->add_setting('recent_post_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Newsair_Section_Title($wp_customize,
    'recent_post_section_title',
    array(
        'label'             => esc_html__( 'Recent Post Section', 'paper-news' ),
        'section'           => 'frontpage_main_banner_section_settings', 
        'active_callback' => 'newsair_main_banner_section_status',
		'priority' => 100
    )
));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_recent_post_category',
    array(
        'default' => $papernews_default['select_recent_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(new Newsair_Dropdown_Taxonomies_Control($wp_customize, 'select_recent_post_category',
    array(
        'label' => esc_html__('Category', 'paper-news'),
        'description' => esc_html__('Posts to be shown on Recent post section', 'paper-news'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies', 
        'taxonomy' => 'category', 
        'active_callback' => 'newsair_main_banner_section_status',
		'priority' => 100,
    )
));
$wp_customize->remove_control('body_background_color');

//Theme Background Color
$wp_customize->add_setting(
	'body_background_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color','default' => '#fff',
	
) );
$wp_customize->add_control(new Newsair_Customize_Alpha_Color_Control( $wp_customize,'body_background_color', array(
	'label'      => __('Background Color', 'paper-news' ),
	'palette' => true,
	'section' => 'colors',
	'settings' => 'body_background_color'
	)
) );
}
add_action( 'customize_register', 'papernews_style_customizer' );