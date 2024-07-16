<?php
/**
 * Theme Customizer Controls
 *
 * @package blogson
 */


if ( ! function_exists( 'blogson_customizer_blog_register' ) ) :
function blogson_customizer_blog_register( $wp_customize ) {
	
	$wp_customize->add_panel(
        'blogson_blog_settings_panel',
        array (
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Blog Settings', 'blogson' ),
        )
    );

	// Section Posts
    $wp_customize->add_section(
        'blogson_posts_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Posts', 'blogson' ),
            'panel'          => 'blogson_blog_settings_panel',
        )
    ); 


    // Title label
	$wp_customize->add_setting( 
		'blogson_label_post_category_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_post_category_show', 
		array(
		    'label'       => esc_html__( 'Posts Category', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_post_category_show',
		) 
	));

	// Add an option to enable the category
	$wp_customize->add_setting( 
		'blogson_enable_posts_cat', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_posts_cat', 
		array(
		    'label'       => esc_html__( 'Show Category', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_posts_cat',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'blogson_label_post_meta_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_post_meta_show', 
		array(
		    'label'       => esc_html__( 'Posts Meta', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_post_meta_show',
		) 
	));

	// Add an option to enable the date
	$wp_customize->add_setting( 
		'blogson_enable_posts_meta_date', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_posts_meta_date', 
		array(
		    'label'       => esc_html__( 'Show Date', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_posts_meta_date',
		) 
	));

	// Add an option to enable the author
	$wp_customize->add_setting( 
		'blogson_enable_posts_meta_author', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_posts_meta_author', 
		array(
		    'label'       => esc_html__( 'Show Author', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_posts_meta_author',
		) 
	));

	// Add an option to enable the comments
	$wp_customize->add_setting( 
		'blogson_enable_posts_meta_comments', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_posts_meta_comments', 
		array(
		    'label'       => esc_html__( 'Show Comments', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_posts_meta_comments',
		) 
	));


	// Title label
	$wp_customize->add_setting( 
		'blogson_label_post_meta_content_settings', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_post_meta_content_settings', 
		array(
		    'label'       => esc_html__( 'Posts Meta Text Settings', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_post_meta_content_settings',
		) 
	));

	// add Posted by textbox
    $wp_customize->add_setting(
        'blogson_post_posted_by_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Posted by', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_post_posted_by_text',
        array(
            'settings'      => 'blogson_post_posted_by_text',
            'section'       => 'blogson_posts_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Posted by Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Author Posted by text displayed in the posts meta and blog posts meta', 'blogson' ),
        )
    );

	// add Posted on textbox
    $wp_customize->add_setting(
        'blogson_post_posted_on_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Posted on', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_post_posted_on_text',
        array(
            'settings'      => 'blogson_post_posted_on_text',
            'section'       => 'blogson_posts_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Posted on Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Date Posted by text displayed in the posts meta and blog posts meta', 'blogson' ),
        )
    );

    // add comments textbox
    $wp_customize->add_setting(
        'blogson_post_comments_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Comments', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_post_comments_text',
        array(
            'settings'      => 'blogson_post_comments_text',
            'section'       => 'blogson_posts_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Comments Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Comments text displayed in the posts meta and blog posts meta', 'blogson' ),
        )
    );


	// Title label
	$wp_customize->add_setting( 
		'blogson_label_sidebar_layout', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_sidebar_layout', 
		array(
		    'label'       => esc_html__( 'Sidebar', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_sidebar_layout',
		) 
	));

	// Sidebar layout
    $wp_customize->add_setting(
        'blogson_blog_sidebar_layout',
        array(
            'default'			=> 'right',
            'type'				=> 'theme_mod',
            'capability'		=> 'edit_theme_options',
            'sanitize_callback'	=> 'blogson_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new BlogSon_Radio_Image_Control( $wp_customize,'blogson_blog_sidebar_layout',
            array(
                'settings'		=> 'blogson_blog_sidebar_layout',
                'section'		=> 'blogson_posts_settings',
                'label'			=> esc_html__( 'Sidebar Layout', 'blogson' ),
                'choices'		=> array(
                    'right'	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cr.png',
                    'left' 	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cl.png',
                    'no' 	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cn.png',
                )
            )
        )
    );


    // Title label
	$wp_customize->add_setting( 
		'blogson_label_blog_excerpt', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_blog_excerpt', 
		array(
		    'label'       => esc_html__( 'Post Excerpt', 'blogson' ),
		    'section'     => 'blogson_posts_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_blog_excerpt',
		) 
	));

	// add post excerpt textbox
    $wp_customize->add_setting(
        'blogson_posts_excerpt_length',
        array(
            'type' => 'theme_mod',
            'default'           => 70,
            'sanitize_callback' => 'blogson_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'blogson_posts_excerpt_length',
        array(
            'settings'      => 'blogson_posts_excerpt_length',
            'section'       => 'blogson_posts_settings',
            'type'          => 'number',
            'label'         => esc_html__( 'Post Excerpt Length', 'blogson' ),
        )
    );

    // add readmore textbox
    $wp_customize->add_setting(
        'blogson_posts_readmore_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'READ MORE', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_posts_readmore_text',
        array(
            'settings'      => 'blogson_posts_readmore_text',
            'section'       => 'blogson_posts_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Read More Text', 'blogson' ),
        )
    );

    //=========================================================================

	// Section Single Post
    $wp_customize->add_section(
        'blogson_single_post_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Single Post', 'blogson' ),
            'panel'          => 'blogson_blog_settings_panel',
        )
    ); 


    // Title label
	$wp_customize->add_setting( 
		'blogson_label_single_post_category_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_single_post_category_show', 
		array(
		    'label'       => esc_html__( 'Post Category', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_single_post_category_show',
		) 
	));

	// Add an option to enable the category
	$wp_customize->add_setting( 
		'blogson_enable_single_post_cat', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_cat', 
		array(
		    'label'       => esc_html__( 'Show Category', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_cat',
		) 
	));

	// add category textbox
    $wp_customize->add_setting(
        'blogson_single_post_category_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Category:', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_category_text',
        array(
            'settings'      => 'blogson_single_post_category_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Category Text', 'blogson' ),
        )
    );


	// Title label
	$wp_customize->add_setting( 
		'blogson_label_single_post_tag_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_single_post_tag_show', 
		array(
		    'label'       => esc_html__( 'Post Tags', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_single_post_tag_show',
		) 
	));

	// Add an option to enable the tags
	$wp_customize->add_setting( 
		'blogson_enable_single_post_tags', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_tags', 
		array(
		    'label'       => esc_html__( 'Show Tags', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_tags',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'blogson_label_single_pos_meta_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_single_pos_meta_show', 
		array(
		    'label'       => esc_html__( 'Post Meta', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_single_pos_meta_show',
		) 
	));

	// Add an option to enable the date
	$wp_customize->add_setting( 
		'blogson_enable_single_post_meta_date', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_meta_date', 
		array(
		    'label'       => esc_html__( 'Show Date', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_meta_date',
		) 
	));

	// Add an option to enable the author
	$wp_customize->add_setting( 
		'blogson_enable_single_post_meta_author', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_meta_author', 
		array(
		    'label'       => esc_html__( 'Show Author', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_meta_author',
		) 
	));

	// Add an option to enable the comments
	$wp_customize->add_setting( 
		'blogson_enable_single_post_meta_comments', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_meta_comments', 
		array(
		    'label'       => esc_html__( 'Show Comments', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_meta_comments',
		) 
	));


	// Title label
	$wp_customize->add_setting( 
		'blogson_label_single_post_content_settings', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_single_post_content_settings', 
		array(
		    'label'       => esc_html__( 'Text Settings', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_single_post_content_settings',
		) 
	));

	// add Posted by textbox
    $wp_customize->add_setting(
        'blogson_single_post_posted_by_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Posted by', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_posted_by_text',
        array(
            'settings'      => 'blogson_single_post_posted_by_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Posted by Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Author Posted by text displayed in the single posts meta and blog posts meta', 'blogson' ),
        )
    );

    // add Posted on textbox
    $wp_customize->add_setting(
        'blogson_single_post_posted_on_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Posted on', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_posted_on_text',
        array(
            'settings'      => 'blogson_single_post_posted_on_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Posted on Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Date Posted by text displayed in the single posts meta and blog posts meta', 'blogson' ),
        )
    );

    // add comments textbox
    $wp_customize->add_setting(
        'blogson_single_post_comments_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Comments', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_comments_text',
        array(
            'settings'      => 'blogson_single_post_comments_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Comments Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the Comments text displayed in the single posts meta and blog posts meta', 'blogson' ),
        )
    );

    // add next article textbox
    $wp_customize->add_setting(
        'blogson_single_post_next_article_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Next Article', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_next_article_text',
        array(
            'settings'      => 'blogson_single_post_next_article_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Next Article Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the text displayed in the single post navigation', 'blogson' ),
        )
    );

    // add previous article textbox
    $wp_customize->add_setting(
        'blogson_single_post_previous_article_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Previous Article', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_previous_article_text',
        array(
            'settings'      => 'blogson_single_post_previous_article_text',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Previous Article Text', 'blogson' ),
            'description'         => esc_html__( 'You can change the text displayed in the single post navigation', 'blogson' ),
        )
    );


	// Title label
	$wp_customize->add_setting( 
		'blogson_label_single_sidebar_layout', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_single_sidebar_layout', 
		array(
		    'label'       => esc_html__( 'Sidebar', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_single_sidebar_layout',
		) 
	));

	// Sidebar layout
    $wp_customize->add_setting(
        'blogson_blog_single_sidebar_layout',
        array(
            'default'			=> 'no',
            'type'				=> 'theme_mod',
            'capability'		=> 'edit_theme_options',
            'sanitize_callback'	=> 'blogson_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new BlogSon_Radio_Image_Control( $wp_customize,'blogson_blog_single_sidebar_layout',
            array(
                'settings'		=> 'blogson_blog_single_sidebar_layout',
                'section'		=> 'blogson_single_post_settings',
                'label'			=> esc_html__( 'Sidebar Layout', 'blogson' ),
                'choices'		=> array(
                    'right'	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cr.png',
                    'left' 	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cl.png',
                    'no' 	        => BLOGSON_DIR_URI . '/inc/customizer/assets/images/cn.png',
                )
            )
        )
    );

    //single post width options
    $wp_customize->add_setting(
        'blogson_single_post_width',
        array(
            'type' => 'theme_mod',
            'default'           => 65,
            'sanitize_callback' => 'blogson_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'blogson_single_post_width',
        array(
            'settings'      => 'blogson_single_post_width',
            'section'       => 'blogson_single_post_settings',
            'type'          => 'number',
            'label'         => esc_html__( 'Post Layout Width (%)', 'blogson' ),
            'description'   => esc_html__( 'Default is 65', 'blogson' ),
            'active_callback' => 'blogson_single_post_no_sidebar_enable_full_width_disable',
        )
    );
    

    // full width single post
    $wp_customize->add_setting( 
		'blogson_enable_single_post_full_width', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_single_post_full_width', 
		array(
		    'label'       => esc_html__( 'Show Full Width Post', 'blogson' ),
		    'section'     => 'blogson_single_post_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_single_post_full_width',
		    'active_callback'  => 'blogson_single_post_no_sidebar_enable',
		) 
	));

	//=========================================================================

	// Section archive Post
    $wp_customize->add_section(
        'blogson_archive_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Archives', 'blogson' ),
            'panel'          => 'blogson_blog_settings_panel',
        )
    ); 


    // Title label
	$wp_customize->add_setting( 
		'blogson_label_category_archives_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_category_archives_show', 
		array(
		    'label'       => esc_html__( 'Category Archives', 'blogson' ),
		    'section'     => 'blogson_archive_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_category_archives_show',
		) 
	));

	// Add an option to enable the category archive settings
	$wp_customize->add_setting( 
		'blogson_enable_cat_archive_settings', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'blogson_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Toggle_Control( $wp_customize, 'blogson_enable_cat_archive_settings', 
		array(
		    'label'       => esc_html__( 'Show Category Title Options', 'blogson' ),
		    'section'     => 'blogson_archive_settings',
		    'type'        => 'blogson-toggle',
		    'settings'    => 'blogson_enable_cat_archive_settings',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'blogson_label_category_archives_title_show', 
		array(
		    'sanitize_callback' => 'blogson_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new BlogSon_Title_Info_Control( $wp_customize, 'blogson_label_category_archives_title_show', 
		array(
		    'label'       => esc_html__( 'Category Title Settings', 'blogson' ),
		    'section'     => 'blogson_archive_settings',
		    'type'        => 'blogson-title',
		    'settings'    => 'blogson_label_category_archives_title_show',
		    'active_callback'  => 'blogson_cat_archive_enable',
		) 
	));

	// add category title textbox
    $wp_customize->add_setting(
        'blogson_cat_archive_title_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Category:', 'blogson' ),
            'sanitize_callback' => 'blogson_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blogson_cat_archive_title_text',
        array(
            'settings'      => 'blogson_cat_archive_title_text',
            'section'       => 'blogson_archive_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Text Before Title', 'blogson' ),
            'active_callback'  => 'blogson_cat_archive_enable',
        )
    );

    $wp_customize->add_setting( 
        'blogson_label_cat_archive_title_info_settings', 
        array(
            'sanitize_callback' => 'blogson_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new BlogSon_Info_Control( $wp_customize, 'blogson_label_cat_archive_title_info_settings', 
        array(
            'label'       => esc_html__( "If you do not see any changes in preview after changing options then click on publish button and then refresh the page again. ", 'blogson' ),
            'section'     => 'blogson_archive_settings',
            'type'        => 'blogson-title',
            'settings'    => 'blogson_label_cat_archive_title_info_settings',
        ) 
    ));

}
endif;

add_action( 'customize_register', 'blogson_customizer_blog_register' );