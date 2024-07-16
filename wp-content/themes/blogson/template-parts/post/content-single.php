<?php
/**
 * Template part for displaying posts in a single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogson
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="blog-post">
        	<div class="title">
        		<h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
        	</div>
            <div class="meta">
                <?php
                    $postedon = esc_html(get_theme_mod( 'blogson_single_post_posted_on_text', esc_html__('Posted on','blogson')));
                    $postedby = esc_html(get_theme_mod( 'blogson_single_post_posted_by_text', esc_html__('Posted by','blogson')));
                    $comments = esc_html(get_theme_mod( 'blogson_single_post_comments_text', esc_html__('Comments','blogson')));
                ?>
                
                <span class="meta-item author-single"><?php echo $postedby ?><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span>
                <span class="meta-item date-single"><?php echo $postedon ?><?php the_time(get_option('date_format')) ?></span>
                <span class="meta-item comments-single"><?php echo $comments ?><a class="post-comments-url" href="<?php the_permalink() ?>#comments"><?php comments_number('0','1','%'); ?></a></span>
            </div>
            <?php
            	if(has_tag()){
            		?>
            			<div class="post-tags">
			                <i class="fas fa-tags"></i> <?php the_tags(); ?>
			            </div>
            		<?php
            	}
            ?>
            <div class="image">
                <?php
                    if ( has_post_thumbnail()) {
                        the_post_thumbnail('full');
                    }
                ?>
            </div>
            <div class="content">
                <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-link">' . esc_html__('Pages:','blogson'),
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    )); 
                ?>
                <div class="clearfix"></div>
                <div class="post-categories">
                    <?php $cat = esc_html(get_theme_mod( 'blogson_single_post_category_text', esc_html__('Category','blogson'))); ?>
                    <span><?php echo $cat ?></span><?php the_category(); ?>
                </div>
            </div>
        </div>
    </article>
    <?php esc_html(blogson_single_post_after_content($post->ID)); ?>
    