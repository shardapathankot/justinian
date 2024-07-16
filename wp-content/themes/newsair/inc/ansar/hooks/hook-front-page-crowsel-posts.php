<?php
if (!function_exists('newsair_posts_crowsel')):
  /**
   * Ticker Slider
   *
   * @since newsair 1.0.0
   *
   */
   function newsair_posts_crowsel(){
    $newsair_enable_featured_story = newsair_get_option('show_featured_news_section');
    $newsair_featured_category = newsair_get_option('featured_story_category');
    $newsair_number_of_slides = newsair_get_option('featured_number_of_story');
    $featured_story_order_by = newsair_get_option('featured_story_order_by');
    $newsair_all_posts_main = newsair_get_posts($newsair_number_of_slides, $newsair_featured_category, $featured_story_order_by); 
    $newsair_count = 1; 
    if ($newsair_enable_featured_story == 1) { ?>
    <!-- featured-news-section  -->
    <div class="featured-news-section mt-5">
      <!--container-->
      <div class="container">
        <!--row-->
        <div class="row">
          <!--col-md-12-->
          <div class="col-md-12">
            <!-- crousel-widget -->
            <div class="crousel-widget wd-back mb-0 position-relative">
              <?php $featured_story_section_title = newsair_get_option('featured_story_section_title');
              if($featured_story_section_title) { ?> 
              <div class="bs-widget-title st1">
                <h4 class="title"><?php echo esc_html($featured_story_section_title); ?></h4>
              </div>
              <?php } ?>
              <div class="postcrousel bs swiper-container">
                <div class="swiper-wrapper">
                  <?php 
                  if ($newsair_all_posts_main->have_posts()) :
                  while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();
                  global $post;
                  $newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
                  $meta_enable = newsair_get_option('featured_story_meta_enable');
                  ?>
                  <!-- /swiper-slide -->
                  <div class="swiper-slide">
                        <div class="bs-blog-post three md back-img bshre mb-0" <?php if (!empty($newsair_url)): ?>
                        style="background-image: url('<?php echo esc_url($newsair_url); ?>');"
                        <?php endif; ?>>
                        <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                          <div class="inner">
                          <?php if ($meta_enable == true ) {
                           newsair_post_categories(); 
                          } ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if ($meta_enable == true ) {
                              newsair_post_meta(); 
                            } ?>
                          </div>
                      </div>
                  </div>
                  <!-- /item -->
                <?php
                  endwhile;
                endif;
                wp_reset_postdata(); ?>
                  
                </div><!-- /swiper-wrapper -->
                <!-- Add Arrows --> 
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> 
              </div><!-- /swiper-container -->
                <!-- Add Pagination -->
              <div class="crousel-swiper-pagination d-none d-md-block"></div>
            </div>
            <!-- /crousel-widget --> 
          </div>
          <!--/col-md-12-->
        </div>
        <!--/row-->
        </div>
      </div>
    <!-- end featured-news-section  -->
    <?php } 
  }
endif;

add_action('newsair_action_posts_crowsel', 'newsair_posts_crowsel', 10);