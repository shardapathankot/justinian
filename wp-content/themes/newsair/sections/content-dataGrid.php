<?php  $newsair_content_layout = esc_attr(get_theme_mod('newsair_content_layout','grid-right-sidebar'));
       $newsair_global_category_enable = get_theme_mod('newsair_global_category_enable','true');
       $newsair_blog_content = get_theme_mod('newsair_blog_content', 'excerpt'); ?>
<div id="post-<?php the_ID(); ?>" <?php if($newsair_content_layout == "grid-fullwidth") { echo post_class('col-md-4'); } else { echo post_class('col-md-6'); } ?>>
<!-- bs-posts-sec bs-posts-modul-6 -->
    <div class="bs-blog-post grid-card"> 
            <?php   
            $url = newsair_get_freatured_image_url($post->ID, 'newsair-medium');
            newsair_post_image_display_type($post); 
            ?>
        <article class="small">
            <?php if($newsair_global_category_enable == 'true') { newsair_post_categories(); } ?>
                <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                <?php newsair_post_meta(); 
                newsair_posted_content(); ?> 
         </article>
    </div>
</div>
<?php