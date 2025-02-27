<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
	
	<script>
		if (window.location.href.indexOf('/membership-levels/?redirect_to=') > -1) {
			var links = document.getElementById('main').getElementsByTagName('a');

			for (var i = 0; i < links.length; ++i) {
				if (links[i].href.indexOf('/login') > -1) {
					links[i].href += window.location.search;
					break;
				}
			}
		}
	</script>
<?php get_footer(); ?>
