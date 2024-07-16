<?php //Banner 4 Post 
if (is_front_page() || is_home()) {
       
        $number_of_posts = '4';
        $newsair_slider_category = newsair_get_option('select_recent_news_category');
        $newsair_all_posts_main = newsair_get_posts($number_of_posts, $newsair_slider_category);
        if ($newsair_all_posts_main->have_posts()) :
        while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();
        global $post;
        $newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
        ?>
                        
          <div class="col-md-6">
              <!-- // small-post -->
              <div class="bs-blog-post three sm back-img bshre" style="background-image: url('<?php echo esc_url($newsair_url); ?>');">
                   <a href="<?php the_permalink(); ?>" class="link-div"></a>
                <div class="inner">
                  <h4 class="title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </div>
              </div>
              <!-- // small-post -->
           </div>
<?php
    endwhile;
endif;
wp_reset_postdata();
?>
<?php }