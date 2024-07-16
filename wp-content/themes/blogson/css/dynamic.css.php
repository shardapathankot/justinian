<?php
/**
 * BlogSon : Dynamic CSS Stylesheet
 *
 */


function blogson_dynamic_css_stylesheet() {

    $link_color= sanitize_hex_color(get_theme_mod( 'blogson_link_color','#555' ));
    $link_hover_color= sanitize_hex_color(get_theme_mod( 'blogson_link_hover_color','#000' ));
    $heading_color= sanitize_hex_color(get_theme_mod( 'blogson_headings_title_color','#000' ));
	$single_post_width= absint(get_theme_mod( 'blogson_single_post_width',65));

    $css = '

    a{
        color: ' . $link_color . ';
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    a:hover,a:focus{
        color: ' . $link_hover_color . ';
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    h1,h2,h3,h4,h5,h6{
        color: ' . $heading_color . ';
    }

    .pagination .nav-links .current{
        background: ' . $link_hover_color . ' !important;
    }

    .top-menu .navigation > li > a:hover {
    	color: ' . $link_hover_color . ';
    }


    form.wpcf7-form input,
    form.wpcf7-form textarea,
    form.wpcf7-form radio,
    form.wpcf7-form checkbox{
        border: 1px solid #d0d0d0;
        color: #555;
    }

    form.wpcf7-form input::placeholder,
    form.wpcf7-form textarea::placeholder{
        color: #555;
    }

    form.wpcf7-form input[type="submit"]{
        color: #fff;
    }

    form.wpcf7-form label{
        color: #555;
    }

    button.navbar-toggle,
    button.navbar-toggle:hover{
        background: none !important;
        box-shadow: none;
    }

    .menu-social li a{
        color: ' . $link_color . ';
    }

    .menu-social li a:hover{
        color: ' . $link_hover_color . ';
    }

    aside h4.widget-title:hover{
        color: inherit;
    }

    .single h1.entry-title a,
    .cat-item a,
    .latest-posts-area-content a{
        color: #555;
        transition: all 0.3s ease-in-out;
    }

    .cat-item a:hover,
    .latest-posts-area-content a:hover,
    .layout-1-area-content .title h3 a:hover{
        color: #000;
        transition: all 0.3s ease-in-out;
    }

    .blog.single-no-sidebar article{
        width: 49%;
    }

    .single article .title, 
    .single article .content,
    .single article #comments {
        width: ' . $single_post_width . '%;
        margin: 0 auto;
    }

    .container {
	    width: 95%;
	    margin: 0 auto;
	}

';

if(false===get_theme_mod( 'blogson_display_site_title_tagline',true)){
    $css .='
        h1.site-title,
        p.site-description{
        	display: none;
        }
    ';
}


if(false===get_theme_mod( 'blogson_enable_posts_cat',true)){
    $css .='
        ul.post-categories {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_posts_meta_date',true)){
    $css .='
        span.separator,
        span.date {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_posts_meta_author',true)){
    $css .='
        span.author,
        span.by{
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_posts_meta_comments',true)){
    $css .='
        span.comments{
        	display: none;
        }
    ';
}


if(false===get_theme_mod( 'blogson_enable_single_post_cat',true)){
    $css .='
        .single div.post-categories {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_single_post_tags',true)){
    $css .='
        .single div.post-tags {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_single_post_meta_date',true)){
    $css .='
        .single span.date-single {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_single_post_meta_author',true)){
    $css .='
        .single span.author-single {
        	display: none;
        }
    ';
}

if(false===get_theme_mod( 'blogson_enable_single_post_meta_comments',true)){
    $css .='
        .single span.comments-single {
        	display: none;
        }
    ';
}

if('both-sidebars'===esc_html(get_theme_mod('blogson_home_page_layout','both-sidebars'))) {
    if ( is_active_sidebar( 'blogson-hp-left-section' ) && is_active_sidebar( 'blogson-hp-right-section' ) ) {
        $css .='
	        .both-sidebars .container {
	        	width: 90%;
	        	margin: 0 auto;
	        }
	    ';   
    }
    $css .='
        .home.elementor-page.both-sidebars .container {
        	width: 90%;
        	margin: 0 auto;
        }

        .home.elementor-page.both-sidebars .elementor-section.elementor-section-boxed>.elementor-container {
        	width: 90% !important;
        	max-width: 90% !important;
        }
    ';
}

if('no-sidebars'===esc_html(get_theme_mod('blogson_home_page_layout','both-sidebars'))) {
    if ( is_active_sidebar( 'blogson-hp-left-section' ) && is_active_sidebar( 'blogson-hp-right-section' ) ) {
        $css .='
	        .no-sidebar .container {
	        	width: 90%;
	        	margin: 0 auto;
	        }
	    ';   
    }
    $css .='
        .home.elementor-page.no-sidebar .container {
        	width: 90%;
        	margin: 0 auto;
        }

        .home.elementor-page.no-sidebar .elementor-section.elementor-section-boxed>.elementor-container {
        	width: 90% !important;
        	max-width: 90% !important;
        }
    ';
}


if(true===get_theme_mod( 'blogson_enable_single_post_full_width',false)){
    $css .='
        .single .title, 
        .single .content,
        .single #comments {
        	width: 100%;
        	margin: 0 auto;
        }
    ';
}

return apply_filters( 'blogson_dynamic_css_stylesheet', blogson_minimize_css($css));

}