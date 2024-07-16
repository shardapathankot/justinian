<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'papernews_theme_fonts',1 );
add_action( 'enqueue_block_editor_assets', 'papernews_theme_fonts',1 );
add_action( 'customize_preview_init', 'papernews_theme_fonts', 1 );

function papernews_theme_fonts() {
        $fonts_url = papernews_fonts_url();
        // Load Fonts if necessary.
        if ( $fonts_url ) {
            require_once get_theme_file_path( 'inc/ansar/font/wptt-webfont-loader.php' );
            wp_enqueue_style( 'papernews-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20201110' );
        }
}

function papernews_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('DM Sans:400,500,700|Inter Tight:100,200,300,400,500,600,700,800,900&display=swap|Kalam|Open Sans|Rokkitt|Jost|Poppins|Lato|Noto Serif|Raleway|Roboto|IBM Plex Serif|Rubik|PT Serif');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
    return apply_filters( 'papernews_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );

    return $fonts_url;
}