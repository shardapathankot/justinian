<?php
/**
 * Default theme options.
 *
 * @package Newsair
 */

if (!function_exists('newsair_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function newsair_get_default_theme_options() {

    $defaults = array();

    // Site Title
    $defaults['newsair_title_fontsize_desktop'] = 40;
    $defaults['newsair_title_fontsize_tablet'] = 35;
    $defaults['newsair_title_fontsize_mobile'] = 30;
    
    // Header options section
    $defaults['brk_news_enable'] = true;
    $defaults['breaking_news_title'] = __('Breaking','newsair');


    $defaults['select_brk_news_category'] = 0;
    $defaults['number_of_brk_news'] = 10;
    $defaults['header_layout'] = 'header-layout-1';
    $defaults['banner_ad_image'] = '';
    $defaults['banner_ad_url'] = '#';
    $defaults['newsair_open_on_new_tab'] = 1;
    $defaults['banner_advertisement_scope'] = 'front-page-only';

    //Menu
    $defaults['newsair_menu_align_setting'] = 'me-auto';

    // Frontpage Section.
    $defaults['show_popular_tags_title'] = __('Top Tags', 'newsair');
    $defaults['number_of_popular_tags'] = 7;
    $defaults['select_popular_tags_mode'] = 'post_tag';
    $defaults['flash_news_title'] = __('Hot News', 'newsair');
    $defaults['select_flash_news_category'] = 0;
    $defaults['number_of_flash_news'] = 5;
    $defaults['select_flash_new_mode'] = 'flash-slide-left';
    $defaults['banner_flash_news_scope'] = 'front-page-only';
    $defaults['show_main_banner_section'] = 1;
    $defaults['select_main_banner_section_mode'] = 'default';
    $defaults['select_vertical_slider_news_category'] = 0;
    $defaults['vertical_slider_number_of_slides'] = 15;
    $defaults['select_slider_news_category'] = 0; 

    $defaults['slider_title_fontsize_desktop'] = 28;
    $defaults['slider_title_fontsize_tablet'] = 24;
    $defaults['slider_title_fontsize_mobile'] = 20;
    

    $defaults['select_trending_news_category'] = 0;
    $defaults['trending_news_number'] = 1;

    $defaults['select_editor_news_category'] = 0;
    $defaults['editor_news_number'] = 2;

    //Featured Story
    $defaults['show_featured_news_section'] = 1; 
    $defaults['featured_story_section_title'] = __('Featured Story','newsair');
    $defaults['featured_story_category'] = 0;
    $defaults['featured_number_of_story'] = 5;
    $defaults['featured_story_title_fontsize_desktop'] = 24;
    $defaults['featured_story_title_fontsize_tablet'] = 18;
    $defaults['featured_story_title_fontsize_mobile'] = 14; 
    $defaults['featured_story_meta_enable'] = 1;
    $defaults['select_tabbed_thumbs_section_mode'] = 'tabbed';
    $defaults['select_tab_section_mode'] = 'default';
    $defaults['select_thumbs_news_category'] = 0;
    $defaults['number_of_slides'] = 5; 
    $defaults['featured_news_section_title'] = __('Featured Story', 'newsair');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 6;
    $defaults['main_banner_section_background_image']= '';
    $defaults['select_editor_choice_category'] = 0;


    //Featured Ads Section
    $defaults['show_editors_pick_section'] = 1;
    $defaults['frontpage_content_alignment'] = 'align-content-left';

    //layout options
    $defaults['newsair_content_layout'] = 'grid-right-sidebar';
    $defaults['global_post_date_author_setting'] = 'show-date-author';
    $defaults['global_hide_post_date_author_in_list'] = 1;
    $defaults['global_widget_excerpt_setting'] = 'trimmed-content';
    $defaults['global_date_display_setting'] = 'theme-date';
    
    $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'newsair');
    $defaults['frontpage_latest_posts_category'] = 0;
    $defaults['number_of_frontpage_latest_posts'] = 4;

    //Single
    $defaults['single_show_featured_image'] = true;

    // filter.
    $defaults = apply_filters('newsair_filter_default_theme_options', $defaults);
    $defaults['single_show_share_icon'] = true;

    // You Missed Section.
    $defaults['you_missed_enable'] = true;
    $defaults['you_missed_title'] = __('You Missed', 'newsair'); 
    $defaults['you_missed_number_of_post'] = 4;

    // You Missed Section.
    $defaults['hide_copyright'] = true;
    $defaults['newsair_footer_copyright'] = __('Copyright &copy; All rights reserved','newsair');
    
	return $defaults;
}

endif;