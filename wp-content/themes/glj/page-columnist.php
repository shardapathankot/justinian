<?php
/*
Template Name: Columnist Page
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="news">
            <div class="row_news"> <!-- Start the initial row -->
                <?php
                $args = array(
                    'post_type' => 'columnists',
                    'posts_per_page' => -1
                );
                $news_query = new WP_Query( $args );

                $count = 0;
                while ( $news_query->have_posts() ) {
                    $news_query->the_post();
                    if ($count % 3 == 0 && $count != 0) {
                        echo ''; // Close the previous row and start a new row after every 3 news items
                    }
                    ?>
                    <div class="col"> <!-- Start a new column for each news item -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
                            <div class="entry-content">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="excerpt"><?php echo get_post_meta(get_the_ID(), 'excerpt', true); ?></div> 
                                    <div class="content"><?php the_content(); ?></div>
                                </header>
                            </div>
                        </article>
                    </div>
                    <?php
                    $count++;
                }
                wp_reset_postdata();

                // Close the final row if the total number of news items is not divisible by 3
                if ($count % 3 != 0) {
                    echo '';
                }
                ?>
            </div> <!-- Close the final row -->
        </section>
    </main>
</div>
<?php get_footer(); ?>
