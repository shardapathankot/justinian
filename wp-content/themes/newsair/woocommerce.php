<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * @package Newsair
 */
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->

<!-- #main -->
<main id="content">
	<div class="container">
		<div class="row">
		<!--==================== breadcrumb section ====================-->
		<?php do_action('newsair_breadcrumb_content'); ?>
			<div class="col-md-12">
				<?php woocommerce_content(); ?>
			</div>
		</div><!-- .container -->
	</div>	
</main><!-- #main -->
<?php get_footer(); ?>