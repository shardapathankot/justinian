<?php /*** Footer Option Panel
 *
 * @package Newsair
 */

$newsair_default = newsair_get_default_theme_options();
/*General option panel info*/
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

//You Missed seciton
$wp_customize->add_section('you_missed_section',
    array(
        'title' => esc_html__('You Missed', 'newsair'),
        'priority' => 24,
        'capability' => 'edit_theme_options',
        // 'panel' => 'footer_option_panel',
    )
);

// you missed heading
$wp_customize->add_setting(
    'newsair_you_missed_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'newsair_you_missed_settings',
    array(
        'type' => 'hidden',
        'label' => __('You Missed','newsair'),
        'section' => 'you_missed_section',
    )
);

// you missed toggle
$wp_customize->add_setting('you_missed_enable',
    array(
        'default' => $newsair_default['you_missed_enable'],
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'you_missed_enable', 
    array(
        'label' => esc_html__('Hide / Show', 'newsair'),
        'type' => 'toggle',
        'section' => 'you_missed_section',
    )
));

// you missed title
$wp_customize->add_setting(
'you_missed_title',
    array(
        'default' => $newsair_default['you_missed_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(
'you_missed_title',
    array(
        'label' => __('Title','newsair'),
        'section' => 'you_missed_section',
        'type' => 'text',
    )
);

// Add Footer Option Section
$wp_customize->add_section('footer_options', array(
    'title' => __('Footer','newsair'),
    'priority' => 25,
    //'panel' => 'footer_option_panel',
) );

//Footer logo Section
$wp_customize->add_setting('footer_logo_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Newsair_Section_Title(
        $wp_customize,
        'footer_logo_title',
        array(
            'label'             => esc_html__( 'Footer Logo', 'newsair' ),
            'section'           => 'footer_options', 
        )
    )
);

// For Desktop   
$wp_customize->add_setting('desktop_newsair_footer_logo_width',array(

    'default' => '210',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('tablet_newsair_footer_logo_width',array(

    'default' => '170',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('mobile_newsair_footer_logo_width',array(

    'default' => '130',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_footer_main_logo_width', array(
    'label' => __('Logo Width', 'newsair' ),
    'section' => 'footer_options',
    'settings' => [

    'desktop_input' => 'desktop_newsair_footer_logo_width',
    'tablet_input' => 'tablet_newsair_footer_logo_width',
    'mobile_input' => 'mobile_newsair_footer_logo_width',
    ],
    'is_responsive' => true,
    'input_attrs' => array(
    'min' => 0,
    'max' => 500,
    'step' => 1,
    ),
    
) ) );

// For Desktop   
$wp_customize->add_setting('desktop_newsair_footer_logo_height',array(

    'default' => '70',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Tablet   
$wp_customize->add_setting('tablet_newsair_footer_logo_height',array(

    'default' => '50',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
// For Mobile   
$wp_customize->add_setting('mobile_newsair_footer_logo_height',array(

    'default' => '40',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',

));
$wp_customize->add_control( new Responsive_slider_control( $wp_customize, 'newsair_footer_main_logo_height', array(
    'label' => __('Logo Height' , 'newsair' ),
    'section' => 'footer_options',
    'settings' => [

    'desktop_input' => 'desktop_newsair_footer_logo_height',
    'tablet_input' => 'tablet_newsair_footer_logo_height',
    'mobile_input' => 'mobile_newsair_footer_logo_height',
    ],
    'is_responsive' => true,
    'input_attrs' => array(
    'min' => 0,
    'max' => 300,
    'step' => 1,
    ),
    
) ) );

//Footer Content
$wp_customize->add_setting('footer_content_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Newsair_Section_Title(
        $wp_customize,
        'footer_content_title',
        array(
            'label'             => esc_html__( 'Footer Content', 'newsair' ),
            'section'           => 'footer_options', 
        )
    )
);

//Footer Background image
$wp_customize->add_setting( 
    'newsair_footer_widget_background', array(
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'newsair_footer_widget_background', array(
    'label'    => __( 'Background Image', 'newsair' ),
    'section'  => 'footer_options',
    'settings' => 'newsair_footer_widget_background',
) ) );

//Background Overlay 
$wp_customize->add_setting(
    'newsair_footer_overlay_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color', 
) );
$wp_customize->add_control(new newsair_Customize_Alpha_Color_Control( $wp_customize,'newsair_footer_overlay_color', array(
    'label'      => __('Overlay Color', 'newsair' ),
    'palette' => true,
    'section' => 'footer_options')
) );

//Text Color 
$wp_customize->add_setting(
    'newsair_footer_text_color', array( 'sanitize_callback' => 'newsair_sanitize_alpha_color',
) );
$wp_customize->add_control( new newsair_Customize_Alpha_Color_Control( $wp_customize, 'newsair_footer_text_color', array(
    'label'      => __('Text Color', 'newsair' ),
    'palette' => true,
    'section' => 'footer_options')
));

// footer column layout
$wp_customize->add_setting(
    'newsair_footer_column_layout', array(
    'default' => 3,
    'sanitize_callback' => 'newsair_sanitize_select',
) );
$wp_customize->add_control(
    'newsair_footer_column_layout', array(
    'type' => 'select',
    'label' => __('Select Column Layout','newsair'),
    'section' => 'footer_options',
    'choices' => array(1=>1, 2=>2,3=>3,4=>4),
) );

//Enable and disable social icon
$wp_customize->add_setting('footer_social_icon_enable',
array(
    'default' => true,
    'sanitize_callback' => 'newsair_sanitize_checkbox',
)
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'footer_social_icon_enable', 
    array(
        'label' => esc_html__('Hide / Show Social Icon', 'newsair'),
        'type' => 'toggle',
        'section' => 'footer_options',
    )
));

// Social Icon Repaeter
$wp_customize->add_setting(
    'newsair_footer_social_icons',
    array(
        'default'           => newsair_get_social_icon_default(),
        'sanitize_callback' => 'newsair_repeater_sanitize'
    )
);
$wp_customize->add_control(
    new newsair_Repeater_Control(
        $wp_customize,
        'newsair_footer_social_icons',
        array(
            'label'                            => esc_html__( 'Social Icons', 'newsair' ),
            'section'                          => 'footer_options',
            'add_field_label'                  => esc_html__( 'Add New Social', 'newsair' ),
            'item_name'                        => esc_html__( 'Social', 'newsair' ),
            'customizer_repeater_icon_control' => true,
            'customizer_repeater_link_control' => true,
            'customizer_repeater_checkbox_control' => true,
        )
    )
);

$wp_customize->add_setting( 'newsair_footer_social_upgrade_to_pro', array(
    'capability'            => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));
$wp_customize->add_control(
    new newsair_social_section_upgrade(
    $wp_customize,
    'newsair_footer_social_upgrade_to_pro',
        array(
            'section'               => 'footer_options',
            'settings'              => 'newsair_footer_social_upgrade_to_pro',
        )
    )
);

//Footer Copyright Section
$wp_customize->add_section('footer_copyright', array(
    'title' => __('Copyright','newsair'),
    'priority' => 27,
    //'panel' => 'footer_option_panel',
) );

//Enable and disable copyright
$wp_customize->add_setting('hide_copyright',
    array(
        'default' =>  $newsair_default['hide_copyright'],
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new Newsair_Toggle_Control( $wp_customize, 'hide_copyright', 
    array(
        'label' => esc_html__('Hide / Show', 'newsair'),
        'type' => 'toggle',
        'section' => 'footer_copyright',
    )
));

// Copyright Text
$wp_customize->add_setting('newsair_footer_copyright', array(
    'default' =>  $newsair_default['newsair_footer_copyright'],
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control('newsair_footer_copyright', array(
    'label' => __('Copyright Text','newsair'),
    'section' => 'footer_copyright',
    'type' => 'text',
) );

// Copyright bg color
$wp_customize->add_setting(
    'newsair_footer_copy_bg', array( 'sanitize_callback' => 'sanitize_hex_color',
    
) );
$wp_customize->add_control( 'newsair_footer_copy_bg', array(
    'label'      => __('Background Color', 'newsair' ),
    'type' => 'color',
    'section' => 'footer_copyright')
);

// Copyright text color
$wp_customize->add_setting(
    'newsair_footer_copy_text', array( 'sanitize_callback' => 'sanitize_hex_color',

));
$wp_customize->add_control( 'newsair_footer_copy_text', array(
    'label'      => __('Text Color', 'newsair' ),
    'type' => 'color',
    'section' => 'footer_copyright'
));