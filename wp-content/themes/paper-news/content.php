<?php
/**
 * The template for displaying the content.
 * @package Newsair
 */
?>
<div class="row">
     <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php 
       while(have_posts()){ the_post(); ?>
       <!--col-md-12-->
<div class="col-md-12 fadeInDown wow" data-wow-delay="0.1s">
    <!-- bs-posts-sec-inner -->
    <?php $blog_layout = get_theme_mod('blog_layout','default');  
        $newsair_global_category_enable = get_theme_mod('newsair_global_category_enable','true'); 
        $newsair_readmore_excerpt=get_theme_mod('newsair_blog_content','excerpt');?>
        <div class="bs-blog-post list-blog">
            <?php
               $url = newsair_get_freatured_image_url($post->ID, 'newsair-medium');
                newsair_post_image_display_type($post); 
             ?>
            <article class="small col">
                <?php if($newsair_global_category_enable == 'true') { newsair_post_categories(); } ?>
                <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                <?php newsair_post_meta(); ?>
                <?php newsair_posted_content(); wp_link_pages( ); ?>
            </article>
        </div>
    <!-- // bs-posts-sec block_6 -->
</div>
        <?php } newsair_page_pagination(); ?>
    </div>
</div>