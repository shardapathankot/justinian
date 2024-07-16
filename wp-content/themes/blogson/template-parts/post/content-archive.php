<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogson
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="blog-post">
            <div class="image">
            	<a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark">
	                <?php
	                    if ( has_post_thumbnail()) {
	                        the_post_thumbnail('full');
	                    }
	                ?>
	            </a>
            </div>
            <div class="content">
                <h5 class="entry-title">
                    <?php
                        if ( is_sticky() && is_home() ) :
                            echo "<i class='fas fa-thumbtack'></i>";
                        endif;
                    ?>
                    <a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h5>
            </div>
        </div>
    </article>
    