<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_date(); ?>
		<?php
			if ( is_single() || get_the_content() == '') :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
<?php $meta = get_post_meta( get_the_ID() ); ?>
      <table class="entry-damage">
      	<tr>
      		<th>State:</th>
      		<td><?php echo $meta['wpcf-state'][0] ?></td>
      	</tr>
      	<tr>
      		<th>Summary:</th>
      		<td><?php echo $meta['wpcf-summary'][0] ?></td>
      	</tr>
      	<tr>
      		<th>Award:</th>
      		<td><?php echo $meta['wpcf-award'][0] ?></td>
      	</tr>
      	<tr>
      		<th>Add. Information</th>
      		<td><?php echo $meta['wpcf-addinfo'][0] ?></td>
      	</tr>
      </table>


		<?php


			/* translators: %s: Name of current post */
			//the_content( sprintf(
			//	__( 'Continue reading %s', 'twentyfifteen' ),
			//	the_title( '<span class="screen-reader-text">', '</span>', false )
			//) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php


		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">


		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
<hr />
