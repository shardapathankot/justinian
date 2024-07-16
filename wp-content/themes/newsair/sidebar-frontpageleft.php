<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newsair
 */

if ( ! is_active_sidebar( 'front-left-page-sidebar' ) ) {
	return;
}

$sticky_sidebar = get_theme_mod('sticky_sidebar_toggle', true) == true ? ' bs-sticky' : '';

if ( is_active_sidebar( 'front-right-page-sidebar' ) ) { ?>
	<aside class="col-lg-3">
	<div id="sidebar-left" class="bs-sidebar<?php echo esc_attr($sticky_sidebar); ?>">
		<?php dynamic_sidebar( 'front-left-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->
<?php } else { ?>
<aside class="col-lg-4">
	<div id="sidebar-left" class="bs-sidebar<?php echo esc_attr($sticky_sidebar); ?>">
		<?php dynamic_sidebar( 'front-left-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->
<?php } ?>
