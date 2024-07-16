<?php
$newsair_slider_category = newsair_get_option('select_slider_news_category');
$newsair_number_of_slides = newsair_get_option('number_of_slides');
$newsair_all_posts_main = newsair_get_posts($newsair_number_of_slides, $newsair_slider_category);
$newsair_count = 1;

if ($newsair_all_posts_main->have_posts()) :
    while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();

    global $post;
    $newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
        
$newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
$slider_meta_enable = get_theme_mod('slider_meta_enable','true');

  ?>
  <div class="swiper-slide">
      <div class="bs-blog-post list-blog"> 
        <div class="bs-blog-post three lg back-img bshre" style="background-image: url('<?php echo esc_url($newsair_url); ?>');">
           <a href="<?php the_permalink(); ?>" class="link-div"></a>
        </div>
        <div class="inner">
              <?php if($slider_meta_enable == true) { ?><div class="bs-blog-category"><?php newsair_post_categories(); ?></div> <?php } ?>
              <h4 class="title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
              <?php if($slider_meta_enable == true) { newsair_post_meta(); } ?>
        </div>
      </div>
  </div>
         <?php 
    endwhile;
endif;
wp_reset_postdata();
?>