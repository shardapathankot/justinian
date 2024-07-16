<?php function newsair_typography_customizer( $wp_customize ) {
    $newsair_default = newsair_get_default_theme_options();

    $wp_customize->add_section( 'newsair_typography_setting', array(
            'priority'       => 28,
            'capability'     => 'edit_theme_options',
            'title'      => __('Typography Settings','newsair'),
        ) 
    );

    //========== Typography ===============//

    $wp_customize->add_setting( 'enable_custom_typography',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'newsair_sanitize_checkbox'
        )
    ); 
    $wp_customize->add_control( new newsair_Toggle_Control( $wp_customize, 'enable_custom_typography',
        array(
            'label' => esc_html__( 'Typography Enable/Disable','newsair'),
            'section' => 'newsair_typography_setting'
        )
    ) );

    $wp_customize->add_setting('newsair_site_title_font',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new newsair_Section_Title(
            $wp_customize,
            'newsair_site_title_font',
            array(
                'label'             => esc_html__( 'Site Title Font', 'newsair' ),
                'section'           => 'newsair_typography_setting',
            )
        )
    );

    $font_family = array('Inter Tight'=> 'Inter Tight', 'Open Sans'=>'Open Sans', 'Kalam'=>'Kalam', 'Rokkitt'=>'Rokkitt', 'Jost' => 'Jost', 'Poppins' => 'Poppins', 'Lato' => 'Lato', 'Noto Serif'=>'Noto Serif', 'Raleway'=>'Raleway', 'Roboto' => 'Roboto');

    $font_weight = array('300' => '300', '500' => '500', '600' => '600', '700' => '700');

    $wp_customize->add_setting(
        'site_title_fontfamily',
        array(
            'default'           =>  'Inter Tight',
            'capability'        =>  'edit_theme_options',
            'sanitize_callback' =>  'sanitize_text_field',
        )   
    );
    $wp_customize->add_control('site_title_fontfamily', array(
        'label' => __('Font Family','newsair'),
        'section' => 'newsair_typography_setting',
        'setting' => 'site_title_fontfamily',
        'type'    =>  'select',
        'choices'=>$font_family,
    ));

    $wp_customize->add_setting(
        'site_title_fontweight',
        array(
            'default'           =>  '700',
            'capability'        =>  'edit_theme_options',
            'sanitize_callback' =>  'sanitize_text_field',
        )   
    );
    $wp_customize->add_control('site_title_fontweight', array(
        'label' => __('Font Weight','newsair'),
        'section' => 'newsair_typography_setting',
        'setting' => 'site_title_fontweight',
        'type'    =>  'select',
        'choices'=>$font_weight,
    ));


    $wp_customize->add_setting('newsair_menu_font',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new newsair_Section_Title(
            $wp_customize,
            'newsair_menu_font',
            array(
                'label'             => esc_html__( 'Menu Font', 'newsair' ),
                'section'           => 'newsair_typography_setting',
            )
        )
    );

    $wp_customize->add_setting(
        'newsair_menu_fontfamily',
        array(
            'default'           =>  'Inter Tight',
            'capability'        =>  'edit_theme_options',
            'sanitize_callback' =>  'sanitize_text_field',
        )   
    );
    $wp_customize->add_control('newsair_menu_fontfamily', array(
        'label' => __('Font Family','newsair'),
        'section' => 'newsair_typography_setting',
        'setting' => 'newsair_menu_fontfamily',
        'type'    =>  'select',
        'choices'=>$font_family,
    ));

}
add_action( 'customize_register', 'newsair_typography_customizer' );
?>