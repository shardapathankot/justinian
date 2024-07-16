<?php
if (!function_exists('newsair_header_top_section')) :
/**
 *  Header
 *
 * @since newsair
 *
 */
function newsair_header_top_section() { ?>
  <!--/top-bar-->
  <div class="bs-head-detail d-none d-lg-block">
    <div class="container">
      <div class="row align-items-center">
        <?php $brk_news_enable = newsair_get_option('brk_news_enable'); 
            if($brk_news_enable == true) {  ?>
            <div class="col-md-7 col-xs-12">
              <div class="mg-latest-news">
                <?php
                  $category = newsair_get_option('select_flash_news_category');
                  $newspaper_number_of_post = newsair_get_option('newspaper_number_of_post');
                  $slider_post_order_by = newsair_get_option('slider_post_order_by');
                  $breaking_news_title = newsair_get_option('breaking_news_title');
                  $all_posts = newsair_get_posts($newspaper_number_of_post, $category, $slider_post_order_by);
                  $count = 1;
                  ?>
                  <!-- mg-latest-news -->
                    <div class="bn_title">
                      <h5 class="title"><i class="fas fa-bolt"></i><?php if (!empty($breaking_news_title)){ echo '<span>'.$breaking_news_title.'</span>'; } ?></h5>
                    </div>
                 <!-- mg-latest-news_slider -->
                 <div class="mg-latest-news-slider bs swiper-container">
                    <div class="swiper-wrapper">
                      <?php if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
                          <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>">
                              <span><?php the_title(); ?></span>
                            </a>
                          </div> 
                          <?php $count++;
                        endwhile;
                      endif;
                      wp_reset_postdata(); ?> 
                    </div>
                  </div>
                  <!-- // mg-latest-news_slider --> 
                </div>
              </div>
              <!--/col-md-6-->
              <div class="col-md-5 col-xs-12">
              <div class="d-flex flex-wrap align-items-center justify-content-end">
            <?php } else { ?>
              <!--col-md-5-->
            <div class="col-md-12 col-xs-12">
              <div class="d-flex flex-wrap align-items-center justify-content-between">
                <?php  } newsair_date_display_type(); 
                do_action('newsair_action_header_social_section'); ?>
              </div>
            </div>
            <!--/col-md-6-->
          </div>
        </div>
  </div>
<?php }
endif;
add_action('newsair_action_header_section', 'newsair_header_top_section', 5);


if (!function_exists('newsair_header_social_section')) :
/**
 *  Header
 *
 * @since newsair pro
 *
 */
function newsair_header_social_section()
{ 

  $header_social_icon_enable = get_theme_mod('header_social_icon_enable','1');
  if($header_social_icon_enable == 1) { ?>
    <ul class="bs-social d-flex justify-content-center justify-content-lg-end">
    <?php
      $social_icons = get_theme_mod( 'newsair_header_social_icons', newsair_get_social_icon_default() );
      $social_icons = json_decode( $social_icons );
      if ( $social_icons != '' ) {
        foreach ( $social_icons as $social_item ) {
          $social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'newsair_translate_single_string', $social_item->icon_value, 'Header section' ) : '';
          $open_new_tab = ! empty( $social_item->open_new_tab ) ? apply_filters( 'newsair_translate_single_string', $social_item->open_new_tab, 'Header section' ) : '';
          $social_link = ! empty( $social_item->link ) ? apply_filters( 'newsair_translate_single_string', $social_item->link, 'Header section' ) : '';
          ?>
          <li>
            <a <?php if ($open_new_tab == 'yes') { echo 'target="_blank"';} ?> href="<?php echo esc_url( $social_link ); ?>">
              <i class="<?php echo esc_attr( $social_icon ); ?>"></i>
            </a>
          </li>
          <?php
        }
      }
    ?>
  </ul>
  <?php }
}
endif;
add_action('newsair_action_header_social_section', 'newsair_header_social_section', 2);

