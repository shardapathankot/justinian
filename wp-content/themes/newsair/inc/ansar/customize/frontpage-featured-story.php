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

// Main banner Sider Section.
$wp_customize->add_section('featured_story_section_settings',
    array(
        'title' => esc_html__('Featured Story', 'newsair'),
        'priority' => 17,
        'capability' => 'edit_theme_options',
        //'panel' => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting(
    'featured_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'featured_tabs',
    array(
        'label'                 => '',
        'type' => 'custom-tab-control',
        'section'               => 'featured_story_section_settings',
        'controls_general'      => json_encode  ( array( 
                                                        '#customize-control-show_featured_news_section',
                                                        '#customize-control-featured_story_section_title', 
                                                        '#customize-control-featured_story_category',
                                                    ) 
                                                ),

        'controls_design'       => json_encode  ( array(  
                                                        '#customize-control-featured_story_title_font_size',
                                                        '#customize-control-featured_story_meta_enable',
                                                    ) 
                                                ),
    )                 
));

// Setting - show_main_banner_section.
$wp_customize->add_setting('show_featured_news_section',
    array(
        'default' => $newsair_default['show_featured_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_featured_news_section',
    array(
        'label' => esc_html__('Enable Featured Story Section', 'newsair'),
        'section' => 'featured_story_section_settings',
        'type' => 'checkbox',
        'priority' => 10,
    ) 
); 

//section title
$wp_customize->add_setting('featured_story_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => $newsair_default['featured_story_section_title'],
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control( 'featured_story_section_title', array(
    'label'      => __('Title', 'newsair' ),
    'type' => 'text',
    'section' => 'featured_story_section_settings',
    'sanitize_callback' => 'newsair_sanitize_checkbox',
    'active_callback' => 'newsair_featured_story_section_status'
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('featured_story_category',
    array(
        'default' => $newsair_default['featured_story_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
); 
$wp_customize->add_control(new Newsair_Dropdown_Taxonomies_Control($wp_customize, 'featured_story_category',
    array(
        'label' => esc_html__('Category', 'newsair'),
        'description' => esc_html__('Posts to be shown on Featured Story section', 'newsair'),
        'section' => 'featured_story_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'active_callback' => 'newsair_featured_story_section_status'
    )
)); 

// Featured Story Title Font Size
// For Desktop   
$wp_customize->add_setting('featured_story_title_fontsize_desktop',array(

    'default' => $newsair_default['featured_story_title_fontsize_desktop'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('featured_story_title_fontsize_tablet',array(

    'default' => $newsair_default['featured_story_title_fontsize_tablet'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('featured_story_title_fontsize_mobile',array(

    'default' => $newsair_default['featured_story_title_fontsize_mobile'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_setting( 'general_header_image_height',
    array(
        'default' => 200,
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'featured_story_title_font_size', 
    array(
        'label' => __('Title Font Size','newsair'),
        'section' => 'featured_story_section_settings',
        'settings' => [
            'desktop_input' => 'featured_story_title_fontsize_desktop',
            'tablet_input'  => 'featured_story_title_fontsize_tablet',
            'mobile_input'  => 'featured_story_title_fontsize_mobile',
        ],
        'is_responsive' => true,
        'input_attrs' => array(
            'min' => 10,
            'max' => 120,
            'step' => 1,
        ),
        
    ) 
));

$wp_customize->add_setting('featured_story_meta_enable',
    array(
        'default' => $newsair_default['featured_story_meta_enable'],
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'featured_story_meta_enable', 
    array(
        'label' => esc_html__('Hide / Show Meta', 'newsair'),
        'type' => 'toggle',
        'section' => 'featured_story_section_settings',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
));