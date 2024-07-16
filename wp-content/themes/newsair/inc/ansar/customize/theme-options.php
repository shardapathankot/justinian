<?php /*** Option Panel
 *
 * @package Newsair
 */

$newsair_default = newsair_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/ansar/customize/frontpage-options.php';

/**
 * Create a Radio-Image control
 * 
 * This class incorporates code from the Kirki Customizer Framework and from a tutorial
 * written by Otto Wood.
 * 
 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later).
 * 
 * @link https://github.com/reduxframework/kirki/
 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 */
/**
 * Layout options section
 *
 * @package newsair
 */


//========== Add General Options Panel. ===============
$wp_customize->add_panel('general_option_panel',
    array(
        'title' => esc_html__('General', 'newsair'),
        'priority' => 7,
        'capability' => 'edit_theme_options',
    )
);

//Breadcrumb Settings
$wp_customize->add_section('newsair_breadcrumb_settings',
    array(
        'title' => esc_html__('Breadcrumb', 'newsair'),
        // 'priority' => 7,
        'capability' => 'edit_theme_options',
        'panel' => 'general_option_panel',
    )
);

// Hide/Show Breadcrumb
$wp_customize->add_setting('breadcrumb_settings', array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
));
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'breadcrumb_settings', 
    array(
        'label' => esc_html__('Hide/Show Breadcrumb', 'newsair'),
        'type' => 'toggle',
        'section' => 'newsair_breadcrumb_settings',
        
    )
));

//Type Of Bredcrumb 
$wp_customize->add_setting( 'newsair_site_breadcrumb_type', array(
   'sanitize_callback' => 'newsair_sanitize_select',
    'default'   => 'default',
));
$wp_customize->add_control( 'newsair_site_breadcrumb_type', array(
    'type'      => 'select',
    'section'   => 'newsair_breadcrumb_settings',
    'label'     => esc_html__( 'Breadcrumb type', 'newsair' ),
    'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'newsair' ),
    'choices'   => array(
        'default' => __( 'Default', 'newsair' ),
        'navxt'  => __( 'NavXT', 'newsair' ),
        'yoast'  => __( 'Yoast SEO', 'newsair' ),
        'rankmath'  => __( 'Rank Math', 'newsair' )
    )
));

// Post Image Section
$wp_customize->add_section( 'post_image_options' , array(
    'title' => __('Post Image', 'newsair'),
    'capability' => 'edit_theme_options',
    'panel' => 'general_option_panel',
    // 'priority' => 14,
) );

// Post Image Type
$wp_customize->add_setting( 'post_image_type', array(
    'default'           => 'newsair_post_img_hei',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'newsair_sanitize_select',
) );
$wp_customize->add_control( 'post_image_type', array(
    'type'     => 'radio',
    'label'    => esc_html__( 'Post Image display type:', 'newsair' ),
    'choices'  => array(
        'newsair_post_img_hei'          => esc_html__( 'Fix Height Post Image', 'newsair' ),
        'newsair_post_img_acc' => esc_html__( 'Auto Height Post Image', 'newsair' ),
    ),
    'section'  => 'post_image_options',
    'settings' => 'post_image_type',
) );

//Scroller  Section
$wp_customize->add_section( 'scroller_options' , 
    array(
        'title' => __('Scroller', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'general_option_panel',
        // 'priority' => 15,
    ) 
);

$wp_customize->add_setting(
'newsair_scroll_to_top_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'newsair_scroll_to_top_settings',
    array(
        'type' => 'hidden',
        'label' => __('Scroll To Top','newsair'),
        'section' => 'scroller_options',
    )
);

$wp_customize->add_setting('newsair_scrollup_enable', array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
));
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_scrollup_enable', 
    array(
        'label' => esc_html__('Hide / Show', 'newsair'),
        'type' => 'toggle',
        'section' => 'scroller_options',
        
    )
));

$wp_customize->add_setting(
'scrollup_layout', 
    array(
    'default' => 'default',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'newsair_sanitize_radio'
    ) 
);
$wp_customize->add_control(new Newsair_Custom_Radio_Default_Image_Control( $wp_customize,'scrollup_layout', 
    array(
        'settings'      => 'scrollup_layout',
        'section'       => 'scroller_options',
        'choices'       => array(
            'default' => get_template_directory_uri() . '/images/fu1.svg',
            'two'    => get_template_directory_uri() . '/images/fu2.svg',
            'three'    => get_template_directory_uri() . '/images/fu3.svg',
            'four'    => get_template_directory_uri() . '/images/fu4.svg',
        )
    )
));

//========== Add Pages Panel. ===============
$wp_customize->add_panel('pages_panel',
    array(
        'title' => esc_html__('Pages', 'newsair'),
        'priority' => 8,
        'capability' => 'edit_theme_options',
    )
);  
//404 Page Section
$wp_customize->add_section( '404_options' , array(
    'title' => __('404 Page', 'newsair'),
    'capability' => 'edit_theme_options',
    'panel' => 'pages_panel',
    // 'priority' => 8,
) );

// 404 page title
$wp_customize->add_setting('newsair_404_title', array(
    'default' => __('Oops! Page not found','newsair'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage',
) );
$wp_customize->add_control('newsair_404_title', array(
    'label' => __('Title','newsair'),
    'section' => '404_options',
    'type' => 'text',
) );

// 404 page desc
$wp_customize->add_setting('newsair_404_desc', array(
    'default' => __('We are sorry, but the page you are looking for does not exist.','newsair'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage',
) );
$wp_customize->add_control('newsair_404_desc', array(
    'label' => __('Description','newsair'),
    'section' => '404_options',
    'type' => 'textarea',
) );

// 404 page btn title
$wp_customize->add_setting('newsair_404_btn_title', array(
    'default' => __('Go Back','newsair'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage',
) );
$wp_customize->add_control('newsair_404_btn_title', array(
    'label' => __('Button Title','newsair'),
    'section' => '404_options',
    'type' => 'text',
) );

//========== Theme Option Panel ===============
// Blog Page Section.
$wp_customize->add_section('site_post_date_author_settings',
    array(
        'title' => esc_html__('Blog Page', 'newsair'),
        // 'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'pages_panel',
    )
);

$wp_customize->add_setting(
    'newsair_post_meta_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
    'newsair_post_meta_heading',
    array(
        'type' => 'hidden',
        'label' => __('Post Meta','newsair'),
        'section' => 'site_post_date_author_settings',
    )
);
                                                                
// Settings = Drop Caps
$wp_customize->add_setting('newsair_drop_caps_enable',
    array(
        'default' => false,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_drop_caps_enable', 
    array(
        'label' => esc_html__('Drop Caps (First Big Letter)', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

// Setting - global content alignment of news.
$wp_customize->add_setting('newsair_global_category_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_global_category_enable', 
    array(
        'label' => esc_html__('Category', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));

$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default' => $newsair_default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_select',
    )
);
$wp_customize->add_control('global_post_date_author_setting',
    array(
        'label' => esc_html__('Date and Author', 'newsair'),
        'section' => 'site_post_date_author_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'newsair'),
            'show-date-only' => esc_html__('Show Date Only', 'newsair'),
            'show-author-only' => esc_html__('Show Author Only', 'newsair'),
            'hide-date-author' => esc_html__('Hide All', 'newsair'),
        ),
    )
);

$wp_customize->add_setting('newsair_global_comment_enable',
    array(
        'default' => false,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_global_comment_enable', 
    array(
        'label' => esc_html__('Comments', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
    )
));
$wp_customize->add_setting(
    'newsair_blog_content_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'newsair_blog_content_settings',
    array(
        'type' => 'hidden',
        'label' => __('Choose Content Option','newsair'),
        'section' => 'site_post_date_author_settings',
    )
);

$wp_customize->add_setting('newsair_blog_content', 
    array(
        'default'           => __('excerpt','newsair'),
        'sanitize_callback' => 'newsair_sanitize_select',
    )
);
$wp_customize->add_control('newsair_blog_content', 
    array(            
        'section'   => 'site_post_date_author_settings',
        'type'      => 'radio',
        'choices'   =>  array(
            'excerpt'   => __('Excerpt', 'newsair'),
            'content'   => __('Full Content', 'newsair'),
        )
    )
);

$wp_customize->add_setting(
    'newsair_post_pagination_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'newsair_post_pagination_heading',
    array(
        'type' => 'hidden',
        'label' => __('Pagination','newsair'),
        'section' => 'site_post_date_author_settings',
        'active_callback'   => 'newsair_content_layout_status',
    )
);
$wp_customize->add_setting('newsair_pagination_remove',
array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
)
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_pagination_remove', 
    array(
        'label' => esc_html__('Hide/Show Next Pagination', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_post_date_author_settings',
        'active_callback'   => 'newsair_content_layout_status',
    )
));
//========== single posts options ===============
// Single Section.
$wp_customize->add_section('site_single_posts_settings',
    array(
        'title' => esc_html__('Single Page', 'newsair'),
        // 'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'pages_panel',
    )
);

// Single Page heading
$wp_customize->add_setting(
    'newsair_single_page_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'newsair_single_page_heading',
    array(
        'type' => 'hidden',
        'label' => __('Single Post','newsair'),
        'section' => 'site_single_posts_settings',
    )
);

// Single Page category
$wp_customize->add_setting('newsair_single_post_category',
array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
)
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_single_post_category', 
    array(
        'label' => esc_html__('Hide/Show Categories', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page admin details
$wp_customize->add_setting('newsair_single_post_admin_details',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_single_post_admin_details', 
    array(
        'label' => esc_html__('Hide/Show Author Details', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page date
$wp_customize->add_setting('newsair_single_post_date',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_single_post_date', 
    array(
        'label' => esc_html__('Hide/Show Date', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page tag
$wp_customize->add_setting('newsair_single_post_tag',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_single_post_tag', 
    array(
        'label' => esc_html__('Hide/Show Tag', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page image
$wp_customize->add_setting('single_show_featured_image',
    array(
        'default' => $newsair_default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'single_show_featured_image', 
    array(
        'label' => __('Hide/Show Featured Image', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page social icon
$wp_customize->add_setting('newsair_blog_post_icon_enable',
    array(
        'default' => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_blog_post_icon_enable', 
    array(
        'label' => __('Hide/Show Sharing Icons', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

// Single Page Author
$wp_customize->add_setting(
    'newsair_single_post_author_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
    )
); 
$wp_customize->add_control(
    'newsair_single_post_author_heading',
    array(
        'type' => 'hidden',
        'label' => __('Author','newsair'),
        'section' => 'site_single_posts_settings',
    )
);

// Single Page Author enable
$wp_customize->add_setting('newsair_enable_single_admin_details',
    array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_single_admin_details', 
    array(
        'label' => esc_html__('Hide/Show Author Details', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//Related Post haeding
$wp_customize->add_setting(
    'newsair_single_related_post_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'newsair_single_related_post_heading',
    array(
        'type' => 'hidden',
        'label' => __('Related Post','newsair'),
        'section' => 'site_single_posts_settings',
    )
);

//Related Post enable
$wp_customize->add_setting('newsair_enable_related_post',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_related_post', 
    array(
        'label' => esc_html__('Enable Related Posts', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//Related Post title
$wp_customize->add_setting('newsair_related_post_title', 
    array(
        'default' => esc_html__('Related Posts', 'newsair'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control('newsair_related_post_title', 
    array(
        'label' => esc_html__('Related Post Title', 'newsair'),
        'type' => 'text',
        'section' => 'site_single_posts_settings',
    )
);

//Related Post category
$wp_customize->add_setting('newsair_enable_single_post_category',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_single_post_category', 
    array(
        'label' => esc_html__('Hide/Show Categories', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//Related Post admin
$wp_customize->add_setting('newsair_enable_single_post_admin_details',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_single_post_admin_details', 
    array(
        'label' => esc_html__('Hide/Show Author Details', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//Related Post date
$wp_customize->add_setting('newsair_enable_single_post_date',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_single_post_date', 
    array(
        'label' => esc_html__('Hide/Show Date', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));

//Related Post comment
$wp_customize->add_setting('newsair_enable_single_post_comments',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'newsair_enable_single_post_comments', 
    array(
        'label' => esc_html__('Hide/Show Comments', 'newsair'),
        'type' => 'toggle',
        'section' => 'site_single_posts_settings',
    )
));
//========== Add Sidebar Option Panel. ===============

// Sticky Sidebar
$wp_customize->add_section( 'sticky_sidebar_section' , 
    array(
        'title' => __('Sidebar', 'newsair'),
        'capability' => 'edit_theme_options',
        'priority' => 9,
    ) 
);
//Sticky Sidebar haeding
$wp_customize->add_setting(
    'sticky_sidebar_heading',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'sticky_sidebar_heading',
    array(
        'type' => 'hidden',
        'label' => __('Sticky Sidebar','newsair'),
        'section' => 'sticky_sidebar_section',
    )
);
$wp_customize->add_setting('sticky_sidebar_toggle',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'sticky_sidebar_toggle', 
    array(
        'label' => esc_html__('On / Off', 'newsair'),
        'type' => 'toggle',
        'section' => 'sticky_sidebar_section',
    )
));

//========== Add Theme colors Panel. ===============
$wp_customize->add_panel('Theme_colors_panel',
    array(
        'title' => esc_html__('Theme Colors', 'newsair'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
    )
);  
//Add Category Color Section
$wp_customize->add_section( 'newsair_cat_color_setting', array(
    'capability'     => 'edit_theme_options',
    'title'      => __('Category Colors','newsair'),
    'panel' => 'Theme_colors_panel', 
    'priority' => 1,
) );
$newsairAllCats = get_categories();
if( $newsairAllCats ) :
    foreach( $newsairAllCats as $singleCat ) :
        // category colors control
        $wp_customize->add_setting( 'category_' .absint($singleCat->term_id). '_color', array(
            'default'   => '#005aff',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control( 'category_' .absint($singleCat->term_id). '_color', array(
                'label'     => esc_html($singleCat->name),
                'section'   => 'newsair_cat_color_setting',
                'type' => 'color',
                'settings'  => 'category_' .absint($singleCat->term_id). '_color'
            )
        );
    endforeach;
endif;
  
//Add Site Title/Tagline Color Section
$wp_customize->add_section( 'newsair_site_title_color_section', array(
    'capability'     => 'edit_theme_options',
    'title'      => __('Site Title/Tagline Color','newsair'),
    'panel' => 'Theme_colors_panel', 
) );
// Site Title/Tagline Color Heading
$wp_customize->add_setting(
    'site_title_tagline_title',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'site_title_tagline_title',
    array(
        'type' => 'hidden',
        'label' => __('Site Title/Tagline','newsair'),
        'section' => 'newsair_site_title_color_section', 
    )
);	
$wp_customize->get_control( 'header_textcolor')->label = __( 'Color', 'newsair' );
$wp_customize->get_control( 'header_textcolor')->section = 'newsair_site_title_color_section';   
$wp_customize->get_control( 'header_textcolor')->priority = 41; 

$wp_customize->add_setting('header_text_dark_color',
array(
    'default' => '#fff',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control('header_text_dark_color',
    array(
        'label' => esc_html__('Color (Dark Mode)', 'newsair'),
        'section' => 'newsair_site_title_color_section',
        'type' => 'color', 
        'priority' => 41,
    )
);

//Add Theme Mode Section
$wp_customize->add_section( 'newsair_skin_section', array(
    'capability'     => 'edit_theme_options',
    'title'      => __('Theme Mode','newsair'),
    'panel' => 'Theme_colors_panel', 
) );
// Own Color Heading
$wp_customize->add_setting(
    'newsair_skin_mode_title',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text', 
    )
);
$wp_customize->add_control(
'newsair_skin_mode_title',
    array(
        'type' => 'hidden',
        'label' => __('Theme Mode','newsair'),
        'section' => 'newsair_skin_section',
    )
);
$wp_customize->add_setting(
    'newsair_skin_mode', array(
    'default'           => 'defaultcolor',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );
$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'newsair_skin_mode',
        // $args
        array(
            'settings'      => 'newsair_skin_mode',
            'section'       => 'newsair_skin_section',
            'priority' => 43,
            'choices'       => array(
                'defaultcolor'    => get_template_directory_uri() . '/images/color/white.png',
                'dark' => get_template_directory_uri() . '/images/color/black.png',
            )
        )
    )
);	
//Menu Settings
$wp_customize->add_section( 'menu_options' , 
    array(
        'title' => __('Menu', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'Theme_colors_panel', 
    ) 
);
$wp_customize->add_setting(
'menu_area_settings',
array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'newsair_sanitize_text',
    'priority' => 1,
    )
);
$wp_customize->add_control(
    'menu_area_settings',
    array(
        'type' => 'hidden',
        'label' => __('Primary Menu','newsair'),
        'section' => 'menu_options',
    )
);

$wp_customize->add_setting('menu_area_bg_color', array(
    'default' => '',
    'sanitize_callback' => 'newsair_sanitize_alpha_color',
) );
$wp_customize->add_control(new newsair_Customize_Alpha_Color_Control(
    $wp_customize,'menu_area_bg_color', array(
    'label' => __('Background Color', 'newsair' ),
    'section' => 'menu_options',
    'settings' => 'menu_area_bg_color',) 
) );