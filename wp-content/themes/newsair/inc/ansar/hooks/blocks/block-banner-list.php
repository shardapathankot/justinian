<?php
$newsair_slider_category = newsair_get_option('select_slider_news_category');
$newsair_number_of_slides = newsair_get_option('number_of_slides');
$newsair_all_posts_main = newsair_get_posts($newsair_number_of_slides, $newsair_slider_category);
$newsair_count = 1;

if ($newsair_all_posts_main->have_posts()) :
    while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();
        newsair_slider_default_section(); 
    endwhile;
endif;
wp_reset_postdata(); ?>