<?php
if (!function_exists('newsair_front_page_banner_section')) :
  /**
   *
   * @since newsair
   *
   */
  function newsair_front_page_banner_section() {
    if (is_front_page() || is_home()) {
          
      $slider_post_order_by = newsair_get_option('slider_post_order_by','date-desc');
      $newsair_slider_category = newsair_get_option('select_slider_news_category');
      $newsair_number_of_post = newsair_get_option('newsair_number_of_post');
      $newsair_all_posts_main = newsair_get_posts($newsair_number_of_post, $newsair_slider_category, $slider_post_order_by);
      $newsair_count = 1;
      ?>
      <!-- end slider-section -->
      <!--==================== main content section ====================-->
      <!--row-->
        <div class="col-lg-6">
          <div class="mb-0">
            <div class="homemain bs swiper-container">
              <div class="swiper-wrapper">
                <?php get_template_part('inc/ansar/hooks/blocks/block','banner-list'); ?>
              </div>
              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>

              <!-- <div class="swiper-pagination"></div> -->
            </div>
            <!--/swipper-->
          </div>
        </div>
        <!--/col-12-->
        <?php
        $select_trending_news_category = newsair_get_option('select_trending_news_category');
        $trending_news_number = newsair_get_option('trending_news_number');
        $newsair_all_posts_main = newsair_get_posts($trending_news_number, $select_trending_news_category);
        $meta_enable = get_theme_mod('slider_meta_enable','true');
        ?>
        <div class="col-lg-6">
          <div class="multi-post-widget mb-0">
            <!-- variation one -->
            <?php if ($newsair_all_posts_main->have_posts()) : 
              while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();
              global $post;
              $newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
                ?>
              <div class="col-12">
                <div class="bs-blog-post three sm back-img bshre mb-1" <?php if (!empty($newsair_url)): ?>
                      style="background-image: url('<?php echo esc_url($newsair_url); ?>');"
                      <?php endif; ?>>
                  <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                  <div class="inner">
                    <?php if($meta_enable == true) {
                      newsair_post_categories(); ?>
                      <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <?php newsair_post_meta();
                    } else { ?>
                      <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php endwhile;
            endif;
          wp_reset_postdata(); ?>
          <div class="row gx-1">
              <?php
              $select_editor_news_category = newsair_get_option('select_editor_news_category');
              $editor_news_number = newsair_get_option('editor_news_number');
              $newsair_all_posts_main = newsair_get_posts($editor_news_number, $select_editor_news_category);
              if ($newsair_all_posts_main->have_posts()) :
                while ($newsair_all_posts_main->have_posts()) : $newsair_all_posts_main->the_post();
                global $post;
                $newsair_url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full');
                ?>
                <div class="col-sm-6">
                  <div class="bs-blog-post three sm back-img bshre mb-0" <?php if (!empty($newsair_url)): ?>
                      style="background-image: url('<?php echo esc_url($newsair_url); ?>');"
                      <?php endif; ?>>
                    <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                    <div class="inner">    
                      <?php if($meta_enable == true) {
                        newsair_post_categories(); ?>
                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <?php newsair_post_meta();
                      } else { ?>
                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php endwhile;
              endif;
            wp_reset_postdata(); ?>
          </div>
          <!-- variation one -->
          </div>
        </div>
    <?php }
  }
endif;
add_action('newsair_action_front_page_main_section_1', 'newsair_front_page_banner_section', 40); 