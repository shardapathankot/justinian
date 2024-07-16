<?php

/*select page for Featured slider*/
if (!function_exists('newsair_main_banner_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function newsair_main_banner_section_status($control)
    {

        if (true == $control->manager->get_setting('show_main_banner_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for Featured slider*/
if (!function_exists('newsair_featured_story_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function newsair_featured_story_section_status($control)
    {

        if (true == $control->manager->get_setting('show_featured_news_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

if (!function_exists('newsair_menu_subscriber_section_status')) :

    function newsair_menu_subscriber_section_status($control)
    {
        if ($control->manager->get_setting('newsair_menu_subscriber')->value() == true) {
            return true;
        } else {
            return false;
        }

    }

endif;

if (!function_exists('newsair_content_layout_status')) :

    function newsair_content_layout_status($control)
    {
        if ( ($control->manager->get_setting('newsair_content_layout')->value() == 'align-content-left') || ($control->manager->get_setting('newsair_content_layout')->value() == 'full-width-content') || ($control->manager->get_setting('newsair_content_layout')->value() == 'align-content-right')) {
            return true;
        } else {
            return false;
        }

    }

endif;