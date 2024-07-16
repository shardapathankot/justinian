<?php
/**
 * Custom template hooks for this theme.
 *
 *
 * @package blogson
 */


/**
 * Before title meta hook
 */
if ( ! function_exists( 'blogson_before_title' ) ) :
function blogson_before_title() {
	do_action('blogson_before_title');
}
endif;

/**
 * After title meta hook
 */
if ( ! function_exists( 'blogson_after_title' ) ) :
function blogson_after_title() {
	do_action('blogson_after_title');
}
endif;

/**
 * Highlight area after content hook
 */
if ( ! function_exists( 'blogson_highlight_area_after_content' ) ) :
function blogson_highlight_area_after_content() {
	do_action('blogson_highlight_area_after_content');
}
endif;

/**
 * Featured area after content hook
 */
if ( ! function_exists( 'blogson_featured_area_after_content' ) ) :
function blogson_featured_area_after_content() {
	do_action('blogson_featured_area_after_content');
}
endif;

/**
 * Posts Layout 1 area after meta hook
 */
if ( ! function_exists( 'blogson_posts_layout_1_after_meta' ) ) :
function blogson_posts_layout_1_after_meta() {
	do_action('blogson_posts_layout_1_after_meta');
}
endif;

/**
 * Single post content after meta hook
 */
if ( ! function_exists( 'blogson_single_post_after_content' ) ) :
function blogson_single_post_after_content($postID) {
	do_action('blogson_single_post_after_content',$postID);
}
endif;