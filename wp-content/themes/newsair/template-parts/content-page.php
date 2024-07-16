<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Newsair
 */

?>
<!--==================== main content section ====================-->

		<!-- Page Area -->
		<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
				<div class="col-md-12">
					<div class="mg-card-box wd-back">
				<?php if (have_posts()) {  while (have_posts()) : the_post(); ?>
			<?php the_content(); endwhile; } } else { ?>

				<?php $newsair_page_layout = get_theme_mod('newsair_page_layout','page-align-content-right');
				if($newsair_page_layout == "page-align-content-left"){ ?>
				<aside class="col-md-4 sidebar-left">
					<?php get_sidebar();?>
				</aside>
				<?php } ?>
				<?php if($newsair_page_layout == "page-align-content-right") { ?>
					<div class="col-md-8 content-right">
				<?php } elseif($newsair_page_layout == "page-align-content-left") { ?>
					<div class="col-md-8 content-right">
				<?php } elseif($newsair_page_layout == "page-full-width-content") { ?>
					<div class="col-md-12">
				<?php } ?>
						<div class="mg-card-box wd-back">
							<?php if( have_posts()) :  the_post(); ?>
							<?php 
								the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
								the_content(); ?>
							<?php endif; 
								while ( have_posts() ) : the_post();
								// Include the page
								the_content();
								comments_template( '', true ); // show comments 
								endwhile; 
								newsair_edit_link();
								?>	
						</div>
					</div>
					<!--Sidebar Area-->
					<?php if($newsair_page_layout == "page-align-content-right") { ?>
					<!--sidebar-->
					<!--col-md-4-->
					<aside class="col-md-4 sidebar-right">
						<?php get_sidebar(); ?>
					</aside>
					<!--/col-md-4-->
					<!--/sidebar-->
					<?php } ?>
				<?php } ?>
			<!--Sidebar Area-->
<?php