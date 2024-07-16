<?php
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header single_newsHeader">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content single_newsContent">
                <div class="news_image">
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php the_content(); ?>
            </div>
        </article>
    </main>
</div>
<?php get_footer(); ?>
