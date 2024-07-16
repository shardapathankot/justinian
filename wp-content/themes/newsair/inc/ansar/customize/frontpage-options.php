<?php

/**
 * Option Panel
 *
 * @package Newsair
 */

$newsair_default = newsair_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package Newsair
 */

//Top tags Section.
$wp_customize->add_section('newsair_popular_tags_section_settings',
    array(
        'title' => esc_html__('Top Tags', 'newsair'),
        'priority' => 15,
        'capability' => 'edit_theme_options',
        //'panel' => 'frontpage_option_panel',
    )
);

// Enable Top Tags
$wp_customize->add_setting('show_popular_tags_section',
    array(
        'default' => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'show_popular_tags_section', 
    array(
        'label' => __('Hide/Show Top Tags', 'newsair'),
        'type' => 'toggle',
        'section' => 'newsair_popular_tags_section_settings',
    )
));

// Setting - show_popular_tags_title.
$wp_customize->add_setting('show_popular_tags_title',
    array(
        'default' => $newsair_default['show_popular_tags_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    )
);
$wp_customize->add_control('show_popular_tags_title',
    array(
        'label' => esc_html__('Section Title', 'newsair'),
        'section' => 'newsair_popular_tags_section_settings',
        'type' => 'text',
    )
);

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Featured Slider', 'newsair'),
        'priority' => 16,
       //'panel' => 'frontpage_option_panel',
        'capability' => 'edit_theme_options',
    )
);

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
                                                        '#customize-control-main_slider_position',
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

// Setting - show_main_banner_section.
$wp_customize->add_setting('show_main_banner_section',
    array(
        'default' => $newsair_default['show_main_banner_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_main_banner_section',
    array(
        'label' => esc_html__('Enable Slider Banner Section', 'newsair'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox', 
        'priority' => 10,
    ) 
);

$wp_customize->add_setting(
    'main_slider_position', array(
    'default'           => 'left',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );
$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'main_slider_position',
        // $args
        array(
            'settings'      => 'main_slider_position',
            'section'       => 'frontpage_main_banner_section_settings', 
            'choices'       => array(
                'left' => 'Slider Left',
                'right' => 'Slider Right',
            ),
            'is_text' => 'true',
            'priority' => 15,
            'active_callback' => 'newsair_main_banner_section_status',
        ),
    )
);	

// Setting main_banner_section_background_image.
$wp_customize->add_setting('main_banner_section_background_image',
    array(
        'default' => $newsair_default['main_banner_section_background_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'main_banner_section_background_image',
        array(
            'label' => esc_html__('Background image', 'newsair'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newsair'), 1200, 720),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1200,
            'height' => 720,
            'flex_width' => true,
            'priority' => 20,
            'flex_height' => true, 
            'active_callback' => 'newsair_main_banner_section_status'
        )
    )
); 
//Slider Section title
$wp_customize->add_setting('main_slider_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Newsair_Section_Title(
        $wp_customize,
        'main_slider_section_title',
        array(
            'label'             => esc_html__( 'Slider Section', 'newsair' ),
            'section'           => 'frontpage_main_banner_section_settings', 
            'priority' => 25,
            'active_callback' => 'newsair_main_banner_section_status'
        )
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $newsair_default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(new Newsair_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Category', 'newsair'),
        'description' => esc_html__('Posts to be shown on banner slider section', 'newsair'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'priority' => 30,
        'taxonomy' => 'category', 
        'active_callback' => 'newsair_main_banner_section_status'
    )
));

//Trending Post Section title
$wp_customize->add_setting('main_trending_post_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Newsair_Section_Title($wp_customize,
    'main_trending_post_section_title',
    array(
        'label'             => esc_html__( 'Trending Post Section', 'newsair' ),
        'section'           => 'frontpage_main_banner_section_settings', 
        'priority' => 35,
        'active_callback' => 'newsair_main_banner_section_status'
    )
));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_news_category',
    array(
        'default' => $newsair_default['select_trending_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(new Newsair_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_news_category',
    array(
        'label' => esc_html__('Category', 'newsair'),
        'description' => esc_html__('Posts to be shown on trending post section', 'newsair'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'priority' => 40,
        'taxonomy' => 'category', 
        'active_callback' => 'newsair_main_banner_section_status'
    )
));

//Editor Post Section
//section title
$wp_customize->add_setting('main_editor_post_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Newsair_Section_Title($wp_customize,
    'main_editor_post_section_title',
    array(
        'label'             => esc_html__( 'Editor Post Section', 'newsair' ),
        'section'           => 'frontpage_main_banner_section_settings', 
        'priority' => 45,
        'active_callback' => 'newsair_main_banner_section_status'
    )
));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_editor_news_category',
    array(
        'default' => $newsair_default['select_editor_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(new Newsair_Dropdown_Taxonomies_Control($wp_customize, 'select_editor_news_category',
    array(
        'label' => esc_html__('Category', 'newsair'),
        'description' => esc_html__('Posts to be shown on Editor post section', 'newsair'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'priority' => 50,
        'taxonomy' => 'category', 
        'active_callback' => 'newsair_main_banner_section_status'
    )
));

// Slider Title Font Size

// For Desktop   
$wp_customize->add_setting('slider_title_fontsize_desktop',array(

    'default' => $newsair_default['slider_title_fontsize_desktop'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('slider_title_fontsize_tablet',array(

    'default' => $newsair_default['slider_title_fontsize_tablet'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('slider_title_fontsize_mobile',array(

    'default' => $newsair_default['slider_title_fontsize_mobile'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));

$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_slider_title_font_size', array(

    'label' => __('Title Font Size', 'newsair' ),
    'section' => 'frontpage_main_banner_section_settings',
    'settings' => [
    'desktop_input' => 'slider_title_fontsize_desktop',
    'tablet_input'  => 'slider_title_fontsize_tablet',
    'mobile_input'  => 'slider_title_fontsize_mobile',
    ],
    'is_responsive' => true,
    'priority' => 55,
    'input_attrs' => array(
    'min' => 10,
    'max' => 120,
    'step' => 1,
    ),
    
) ) );

// Hide / Show Category
$wp_customize->add_setting('slider_meta_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'slider_meta_enable', 
    array(
        'label' => esc_html__('Hide / Show Meta', 'newsair'),
        'type' => 'toggle',
        'priority' => 60,
        'section' => 'frontpage_main_banner_section_settings',
    )
));

//Trending/Editor Section title
$wp_customize->add_setting('tren_edit_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Newsair_Section_Title(
        $wp_customize,
        'tren_edit_section_title',
        array(
            'label'             => esc_html__( 'Trending/Editor Post Section', 'newsair' ),
            'section'           => 'frontpage_main_banner_section_settings', 
            'priority' => 65,
            'active_callback' => 'newsair_main_banner_section_status'
        )
    )
);
// Trending/Editor Title Font Size

// For Desktop   
$wp_customize->add_setting('newsair_trend_title_fontsize_desktop',array(

'default' => 22,
'capability' => 'edit_theme_options',
'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('newsair_trend_title_fontsize_tablet',array(

    'default' => 17,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('newsair_trend_title_fontsize_mobile',array(

    'default' => 14,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_tren_edit_title_font_size', array(

    'label' => __('Title Font Size','newsair' ),
    'section' => 'frontpage_main_banner_section_settings',
    'settings' => [
    'desktop_input' => 'newsair_trend_title_fontsize_desktop',
    'tablet_input'  => 'newsair_trend_title_fontsize_tablet',
    'mobile_input'  => 'newsair_trend_title_fontsize_mobile',
    ],
    'is_responsive' => true,
    'priority' => 70,
    'input_attrs' => array(
    'min' => 10,
    'max' => 120,
    'step' => 1,
    ),
    
) ) );