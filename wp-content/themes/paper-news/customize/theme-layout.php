<?php  

$wp_customize->remove_control('newsair_content_layout');

$wp_customize->add_setting(
    'newsair_content_layout', array(
    'default'           => 'align-content-right',
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


$papernewsAllCats = get_categories();
if( $papernewsAllCats ) :
    foreach( $papernewsAllCats as $singleCat ) :
        // category colors control
        $wp_customize->add_setting( 'category_' .absint($singleCat->term_id). '_color', array(
            'default'   => '#ed1515',
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