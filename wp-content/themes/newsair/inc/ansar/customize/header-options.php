<?php 
/**
 * Header Option Panel
 *
 * @package Newsair
 */

$newsair_default = newsair_get_default_theme_options();

class Newsair_Custom_Radio_Default_Image_Control extends WP_Customize_Control {
        
    /**
     * Declare the control type.
     *
     * @access public
     * @var string
     */
    public $type = 'radio-image';
    
    public $is_text = false;
    /**
     * Enqueue scripts and styles for the custom control.
     * 
     * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
     * 
     * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
     * at 'customize_controls_print_styles'.
     *
     * @access public
     */

    public function enqueue() {
        wp_enqueue_script( 'jquery-ui-button' );
    }
    
    /**
     * Render the control to be displayed in the Customizer.
     */
    public function render_content() {
        if ( empty( $this->choices ) ) {
            return;
        }           
        // $is_text;
        $name = '_customize-radio-' . $this->id;
        ?>
        <span class="customize-control-title">
            <?php echo esc_attr( $this->label ); ?>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>
        </span>
        <div id="input_<?php echo $this->id; ?>" class="custom-radio-control text-center image">
            <?php if ($this->is_text == true ){ ?>
                <?php foreach ( $this->choices as $key => $value ) : ?>
                <label class="radio-button-label"  value="<?php echo esc_attr( $key ); ?>">
                    <input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                    <span><?php echo esc_html( $value ); ?>
                        <span class="radio-tooltip normal">Unset</span>
                        <span class="radio-tooltip italic">Italic</span>
                        <span class="radio-tooltip none">None</span>
                        <span class="radio-tooltip capitalize">Capitalize</span>
                        <span class="radio-tooltip lowercase">Lowercase</span>
                        <span class="radio-tooltip Uppercase">Uppercase</span>
                    </span>
                </label>
                <?php endforeach; ?>
            <?php } else { ?>
                    <?php foreach ( $this->choices as $value => $label ) : ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                    <label for="<?php echo $this->id . $value; ?>">
                        <img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                    </label>
                    </input>
                    <?php endforeach; ?>
            <?php } ?> 
        </div>
        <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
        <?php
    }
}

/**
 * Frontpage options section
 *
 * @package newsair
*/

$wp_customize->add_section( 'header_options' , array(
        'title' => __('Top Bar', 'newsair'),
        'capability' => 'edit_theme_options',
        //'panel' => 'header_option_panel',
        'priority' => 1,
    ) 
);

$wp_customize->add_setting(
    'top_bar_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'top_bar_tabs',
    array(
        'label'                 => '',
        'type' => 'custom-tab-control',
        'section'               => 'header_options',
        'controls_general'      => json_encode( array( 
                                                    '#customize-control-breaking_news_settings', 
                                                    '#customize-control-brk_news_enable',
                                                    '#customize-control-breaking_news_title',
                                                    '#customize-control-date_settings',
                                                    '#customize-control-header_data_enable', 
                                                    '#customize-control-newsair_date_time_show_type', 
                                                    '#customize-control-social_icon_settings',  
                                                    '#customize-control-header_social_icon_enable',
                                                    '#customize-control-newsair_header_social_icons',
                                                    '#customize-control-newsair_social_upgrade_to_pro',
        ) ),
        'controls_design'       => json_encode( array( 
                                                    '#customize-control-top_bar_header_background_color',
                                                    '#customize-control-',
        ) ),
    )
));

$wp_customize->add_setting(
    'breaking_news_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'breaking_news_settings',
    array(
        'type' => 'hidden',
        'label' => __('Breaking','newsair'),
        'section' => 'header_options',
    )
);

$wp_customize->add_setting('brk_news_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'brk_news_enable', 
    array(
        'label' => esc_html__('Hide / Show', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_options',
    )
));
$wp_customize->add_setting(
'breaking_news_title',
    array(
        'default' => $newsair_default['breaking_news_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ) 
);
$wp_customize->add_control(
'breaking_news_title',
    array(
        'label' => __('Title','newsair'),
        'section' => 'header_options',
        'type' => 'text',
    )
);   

$wp_customize->add_setting(
    'date_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'date_settings',
    array(
        'type' => 'hidden',
        'label' => __('Date','newsair'),
        'section' => 'header_options',
    )
);

$wp_customize->add_setting('header_data_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'header_data_enable', 
    array(
        'label' => esc_html__('Hide / Show Date', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_options',
    )
));

// date in header display type
$wp_customize->add_setting( 'newsair_date_time_show_type', array(
    'default'           => 'newsair_default',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'newsair_sanitize_select',
) );

$wp_customize->add_control( 'newsair_date_time_show_type', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Date in Header Display Type:', 'newsair' ),
    'choices'  => array(
        'newsair_default'          => esc_html__( 'Theme Default Setting', 'newsair' ),
        'wordpress_date_setting' => esc_html__( 'From WordPress Setting', 'newsair' ),
    ),
    'section'  => 'header_options',
    'settings' => 'newsair_date_time_show_type',
) );

$wp_customize->add_setting(
    'social_icon_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'social_icon_settings',
    array(
        'type' => 'hidden',
        'label' => __('Social Icons','newsair'),
        'section' => 'header_options',
    )
);

$wp_customize->add_setting('header_social_icon_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'header_social_icon_enable', 
    array(
        'label' => esc_html__('Hide / Show', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_options',
    )
));

$wp_customize->add_setting(
    'newsair_header_social_icons',
    array(
        'default'           => newsair_get_social_icon_default(),
        'sanitize_callback' => 'newsair_repeater_sanitize'
    )
);
$wp_customize->add_control(
    new newsair_Repeater_Control(
        $wp_customize,
        'newsair_header_social_icons',
        array(
            'label'                            => esc_html__( 'Social Icons', 'newsair' ),
            'section'                          => 'header_options',
            'add_field_label'                  => esc_html__( 'Add New Social', 'newsair' ),
            'item_name'                        => esc_html__( 'Social', 'newsair' ),
            'customizer_repeater_icon_control' => true,
            'customizer_repeater_link_control' => true,
            'customizer_repeater_checkbox_control' => true,
        )
    )
);

//Pro Button
class newsair_social_section_upgrade extends WP_Customize_Control {
    public function render_content() { ?>
        <div class="upgrade-to-pro-box customizer_newsair_social_upgrade_to_pro" style="display: none;">
            <h3 class="upgrade-to-pro-title">
            <span class="title"><span class="dashicons dashicons-warning"></span><?php echo esc_html('To Add More','newsair'); ?></span><br>
                <a class="btn" href="<?php echo esc_url( 'https://themeansar.com/themes/newsair-pro/' ); ?>" target="_blank">
                    <?php echo esc_html('Upgrade to Pro','newsair'); ?> 
                </a>  
            </h3>
        </div>
    <?php
    }
}

$wp_customize->add_setting( 'newsair_social_upgrade_to_pro', array(
    'capability'            => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));
$wp_customize->add_control(
    new newsair_social_section_upgrade(
    $wp_customize,
    'newsair_social_upgrade_to_pro',
        array(
            'section'               => 'header_options',
            'settings'              => 'newsair_social_upgrade_to_pro',
        )
    )
);

// STYLE
// top bar bg color
$wp_customize->add_setting(
    'top_bar_header_background_color',
    array(
        'default'           => '',
        'sanitize_callback' => 'newsair_sanitize_alpha_color',
    )
);
$wp_customize->add_control(
    new newsair_Customize_Alpha_Color_Control(
        $wp_customize,
        'top_bar_header_background_color',
        array(
            'label'    => esc_html__( 'Background Color', 'newsair' ),
            'section'  => 'header_options',
            'priority'      => 10,
        )
    )
);

// Theme Header Panel
$wp_customize->add_panel('header_option_panel',
    array(
        'title' => esc_html__('Theme Header', 'newsair'),
        'priority' => 6,
        'capability' => 'edit_theme_options',
    )
);
// Advertisement Section.
$wp_customize->add_section( 'header_advert_section' , 
    array(
        'title' => __('Banner Advertisement', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'header_option_panel',
        'priority' => 3,
    ) 
);

// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_ad_image',
    array(
        'default' => $newsair_default['banner_ad_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_ad_image',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'newsair'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newsair'), 930, 100),
            'section' => 'header_advert_section',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_ad_url',
    array(
        'default' => $newsair_default['banner_ad_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_ad_url',
    array(
        'label' => esc_html__('Link', 'newsair'),
        'section' => 'header_advert_section',
        'type' => 'url',
        'priority' => 130,
    )
);

$wp_customize->add_setting('newsair_open_on_new_tab',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_open_on_new_tab', 
    array(
        'label' => esc_html__('Open link in a new tab', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_advert_section',
        'priority' => 140,
    )
)); 


//Menu Settings
$wp_customize->add_section( 'main_menu_options' , 
    array(
        'title' => __('Menu', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'header_option_panel',
        'priority' => 4,
    ) 
);
$wp_customize->add_setting('newsair_home_icon',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_home_icon', 
    array(
        'label' => esc_html__('Hide / Show Home Icon', 'newsair'),
        'type' => 'toggle',
        'section' => 'main_menu_options', 
    )
)); 

// Header Rightbar
$wp_customize->add_section( 'header_rightbar' , 
    array(
        'title' => __('Header Rightbar', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'header_option_panel',
        'priority' => 5,
    ) 
);
$wp_customize->add_setting(
'header_rightbar_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'header_rightbar_settings',
    array(
        'type' => 'hidden',
        'label' => __('Header Rightbar','newsair'),
        'section' => 'header_rightbar',
    )
);
$wp_customize->add_setting('newsair_menu_search',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_menu_search', 
    array(
        'label' => esc_html__('Hide / Show Search', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_rightbar',
    )
));

$wp_customize->add_setting('newsair_lite_dark_switcher',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_lite_dark_switcher', 
    array(
        'label' => esc_html__('Hide / Show Dark and Lite Mode Switcher', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_rightbar',
    )
));

// Subscribe Section Heading
$wp_customize->add_setting(
'subscriber_btn_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'subscriber_btn_settings',
    array(
        'type' => 'hidden',
        'label' => __('Subscribe','newsair'),
        'section' => 'header_rightbar',
    )
);

// Hide/Show Subscribe
$wp_customize->add_setting('newsair_menu_subscriber',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_menu_subscriber', 
    array(
        'label' => esc_html__('Hide/Show Subscribe', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_rightbar',
    )
));

// Subscribe Icon Layout
$wp_customize->add_setting(
    'subsc_icon_layout', array(
    'default' => 'play',
    'sanitize_callback' => 'newsair_sanitize_radio'
) );
$wp_customize->add_control(
    new Newsair_Custom_Radio_Default_Image_Control( 
        // $wp_customize object
        $wp_customize,
        // $id
        'subsc_icon_layout',
        // $args
        array( 
            'section'       => 'header_rightbar',
            'label' => esc_html__('Icon', 'newsair'),
            'choices'       => array(
                'bell' => get_template_directory_uri() . '/images/subs1.svg',
                'play'    => get_template_directory_uri() . '/images/subs3.svg', 
             
            ),
            'active_callback'   => 'newsair_menu_subscriber_section_status',
        )
    )
);

$wp_customize->add_setting(
    'subs_news_title',
    array(
        'default' => esc_html__('Subscribe','newsair'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ) 
);
$wp_customize->add_control(
'subs_news_title',
    array(
        'label' => __('Title','newsair'),
        'section' => 'header_rightbar',
        'type' => 'text',
        'active_callback'   => 'newsair_menu_subscriber_section_status',
    )
);   
// Subscribe Link
$wp_customize->add_setting('newsair_subsc_link', 
    array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('newsair_subsc_link',
    array(
        'label' => esc_html__('Link', 'newsair'),
        'section' => 'header_rightbar',
        'type' => 'text',
        'active_callback'   => 'newsair_menu_subscriber_section_status',

    )
);

// Subscribe Open in New Tab
$wp_customize->add_setting('subsc_open_in_new',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'subsc_open_in_new', 
    array(
        'label' => esc_html__('Open link in a new tab', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_rightbar',
        'active_callback'   => 'newsair_menu_subscriber_section_status',
    )
)); 
if( class_exists( 'WooCommerce' ) ) { 
    // Cart Icon Section Heading
    $wp_customize->add_setting(
        'subscriber_btn_settings',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'newsair_sanitize_text',
            'priority' => 1,
        )
    );
    $wp_customize->add_control(
    'subscriber_btn_settings',
    array(
        'type' => 'hidden',
            'label' => __('Shopping Cart','newsair'),
            'section' => 'header_rightbar',
        )
    );

    // Cart Hide/Show
    $wp_customize->add_setting('newsair_cart_enable',
        array(
            'default' => true,
            'sanitize_callback' => 'newsair_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_cart_enable', 
        array(
            'label' => esc_html__('Hide/Show Cart', 'newsair'),
            'type' => 'toggle',
            'section' => 'header_rightbar',
        )
    ));
}

// Menu Sidebar Section Heading
$wp_customize->add_setting(
    'menu_sidebar_btn_settings',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'newsair_sanitize_text',
        'priority' => 1,
    )
);
$wp_customize->add_control(
'menu_sidebar_btn_settings',
    array(
        'type' => 'hidden',
        'label' => __('Menu Sidebar','newsair'),
        'section' => 'header_rightbar',
    )
);

// Hide/Show Menu Sidebar
$wp_customize->add_setting('newsair_menu_sidebar',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'newsair_menu_sidebar', 
    array(
        'label' => esc_html__('Hide/Show Menu Sidebar', 'newsair'),
        'type' => 'toggle',
        'section' => 'header_rightbar',
    )
));

// Sticky Header
$wp_customize->add_section( 'sticky_header' , 
    array(
        'title' => __('Sticky Header', 'newsair'),
        'capability' => 'edit_theme_options',
        'panel' => 'header_option_panel',
        'priority' => 6,
    ) 
);

$wp_customize->add_setting('sticky_header_toggle',
    array(
        'default' => true,
        'sanitize_callback' => 'newsair_sanitize_checkbox',
    )
);
$wp_customize->add_control(new newsair_Toggle_Control( $wp_customize, 'sticky_header_toggle', 
    array(
        'label' => esc_html__('On / Off', 'newsair'),
        'type' => 'toggle',
        'section' => 'sticky_header',
    )
));