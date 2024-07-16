<?php if (!function_exists('newsair_footer_missed_section')) :
/**
 *  Header
 *
 * @since newsair
 *
 */
function newsair_footer_missed_section()
{
$you_missed_enable = newsair_get_option('you_missed_enable',);
$you_missed_title = newsair_get_option('you_missed_title');
$missed_slider_post_order_by = newsair_get_option('you_missed_post_order_by');
$missed_number_of_post = newsair_get_option('you_missed_number_of_post');
$missed_all_posts_main = newsair_get_posts($missed_number_of_post, $missed_slider_post_order_by);
if($you_missed_enable == 'true')
{ ?>
<!--==================== Missed ====================-->
<div class="missed">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="wd-back position-relative">
          <?php if($you_missed_title) { ?>
          <div class="bs-widget-title">
            <h2 class="title"><?php echo esc_html($you_missed_title); ?></h2>
          </div>
          <?php } ?>
          <div class="missedslider col-grid-4">
              <?php 
                if ( $missed_all_posts_main->have_posts() ) :
                while ( $missed_all_posts_main->have_posts() ) : $missed_all_posts_main->the_post(); 
                global $post;
                $url = newsair_get_freatured_image_url($post->ID, 'newsair-featured'); ?> 
                  <div class="bs-blog-post three md back-img bshre mb-0" <?php if(has_post_thumbnail()) { ?> style="background-image: url('<?php echo esc_url($url); ?>'); <?php } ?>">
                    <a class="link-div" href="<?php the_permalink(); ?>"></a>
                    <div class="inner">
                      <?php newsair_post_categories(); ?>
                      <h4 class="title sm mb-0"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>"> <?php the_title(); ?></a> </h4> 
                    </div>
                  </div> 
              <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
        </div><!-- end wd-back -->
      </div><!-- end col12 -->
    </div><!-- end row -->
  </div><!-- end container -->
</div> 
<!-- end missed -->
<?php 
} }
endif;
add_action('newsair_action_footer_missed_section','newsair_footer_missed_section'); ?>