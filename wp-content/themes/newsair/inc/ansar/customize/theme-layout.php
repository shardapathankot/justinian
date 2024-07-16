<?php /*** Option Panel
 *
 * @package newsair
 */
$newsair_default = newsair_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/ansar/customize/frontpage-options.php';


//Sidebar Layout
$wp_customize->add_section( 'newsair_theme_sidebar_setting' , array(
    'title' => __('Sidebar Width', 'newsair'),
    'priority' => 11,
    //'panel' => 'themes_layout',
) );

// Sidebar Width
$wp_customize->add_setting('newsair_theme_sidebar_width',array(

    'default' => 310,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_theme_sidebar_width', array(

    'label' => __('Sidebar Width', 'newsair'),
    'section' => 'newsair_theme_sidebar_setting',
    'settings' => [ 'desktop_input' => 'newsair_theme_sidebar_width' ],
    'is_responsive' => false,
    'input_attrs' => array(
        'min' => 10,
        'max' => 1200,
        'step' => 1,
    ),
    
) ) );

$wp_customize->add_setting(
    'newsair_single_page_sidebar_width_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 10,
    )
);
$wp_customize->add_control(
'newsair_single_page_sidebar_width_heading',
    array(
        'type' => 'hidden',
        'label' => __('Single Pages','newsair'),
        'section' => 'newsair_theme_sidebar_setting',
    )
);

// Sidebar Width
$wp_customize->add_setting('newsair_single_page_sidebar_width',array(

    'default' => 310,
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint'

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_single_page_sidebar_width', array(

    'label' => __('Sidebar Width' , 'newsair'),
    'section' => 'newsair_theme_sidebar_setting',
    'settings' => [ 'desktop_input' => 'newsair_single_page_sidebar_width' ],
    'is_responsive' => false,
    'input_attrs' => array(
        'min' => 10,
        'max' => 1200,
        'step' => 1,
    ),
    
) ) );   

//Theme Layout
$wp_customize->add_section( 'newsair_theme_layout_setting' , array(
    'title' => __('Theme Layout', 'newsair'),
    'priority' => 12,
    //'panel' => 'themes_layout',
) );

$wp_customize->add_control( 'newsair_theme_layout_options', array(
    'type' => 'select',
    'label' => __('Select Theme layout Type','newsair'),
    'section' => 'newsair_theme_layout_setting',
    'choices' => array('wide'=>__('Wide', 'newsair'), 'boxed'=>__('Boxed', 'newsair')),
) );

// Add Theme Layout Panel.
$wp_customize->add_panel('themes_layout',
    array(
        'title' => esc_html__('Theme Layout', 'newsair'),
        'priority' => 13,
        'capability' => 'edit_theme_options',
    )
);

// Content Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Content Layout', 'newsair'),
        'priority' => 13,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
    )
);   

$wp_customize->add_setting(
    'newsair_archive_page_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);

$wp_customize->add_control(
'newsair_archive_page_heading',
    array(
        'type' => 'hidden',
        'label' => __('Archive Pages Layout','newsair'),
        'section' => 'site_layout_settings',
    )
);

$wp_customize->add_setting(
    'newsair_content_layout', array(
    'default'           => 'grid-right-sidebar',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );

$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'newsair_content_layout',
        // $args
        array(
            'settings'      => 'newsair_content_layout',
            'section'       => 'site_layout_settings',
            'choices'       => array(
                'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                'grid-left-sidebar' => get_template_directory_uri() . '/images/grid-left-sidebar.png',
                'grid-fullwidth' => get_template_directory_uri() . '/images/grid-fullwidth.png',
                'grid-right-sidebar' => get_template_directory_uri() . '/images/grid-right-sidebar.png',
            )
        )
    )
);

// Single Page Layout Setting
$wp_customize->add_section('newsair_single_page_setting',
    array(
        'title' => esc_html__('Single Page', 'newsair'),
        'priority' => 13,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
    )
);

$wp_customize->add_setting(
    'newsair_single_blog_page_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'newsair_single_blog_page_heading',
    array(
        'type' => 'hidden',
        'label' => __('Single Blog Pages','newsair'),
        'section' => 'newsair_single_page_setting',
    )
);

$wp_customize->add_setting(
    'newsair_single_page_layout', array(
    'default'           => 'single-align-content-right',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );
$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'newsair_single_page_layout',
        // $args
        array(
            'settings'      => 'newsair_single_page_layout',
            'section'       => 'newsair_single_page_setting',
            'choices'       => array(
                'single-align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',
                'single-full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                'single-align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
            )
        )
    )
);

// Page Layout Setting
$wp_customize->add_section('page_layout_section',
    array(
        'title' => esc_html__('Page Layout', 'newsair'),
        'priority' => 14,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
    )
);
$wp_customize->add_setting(
    'newsair_pro_page_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'newsair_pro_page_heading',
    array(
        'type' => 'hidden',
        'label' => __('Page','newsair'),
        'section' => 'page_layout_section',
    )
);

$wp_customize->add_setting(
    'newsair_page_layout', array(
    'default'           => 'page-align-content-right',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );
$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'newsair_page_layout',
        // $args
        array(
            'settings'      => 'newsair_page_layout',
            'section'       => 'page_layout_section',
            'choices'       => array(
                'page-align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',
                'page-full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                'page-align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
            )
        )
    )
);