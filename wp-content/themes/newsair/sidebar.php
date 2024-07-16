<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newsair
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$sticky_sidebar = get_theme_mod('sticky_sidebar_toggle', true) == true ? ' bs-sticky' : ''; ?>

<div id="sidebar-right" class="bs-sidebar<?php echo esc_attr($sticky_sidebar); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>