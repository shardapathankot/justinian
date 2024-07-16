<?php

/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<style>
  /* Hide the popup by default */
  #popup.hidden {
    display: none;
  }
</style>
<?php
$extra_post_class = (is_single() ? 'single' : null);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($extra_post_class); ?>>

  <header class="entry-header">
    <?php
    // Display the post thumbnail
    if (has_post_thumbnail()) {
      echo '<div class="post-thumbnail">';
      the_post_thumbnail();
      echo '</div>';
    }
    //the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
    ?>
    <?php
  $moreHref = get_permalink();
// if (is_user_logged_in()) {
  // $moreHref = get_permalink();
// } else {
//     $moreHref = "/just/membership-account/membership-levels/?redirect_to=";
//     $moreHref .= urlencode(get_permalink());
// }
?>

<h2 class="entry-title"><a href="<?php echo esc_url($moreHref); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    <span class="category">
      <?php $categories = get_the_category();
      echo $categories[0]->cat_name . '&nbsp;&nbsp;&nbsp;'; ?>
    </span>
    <span class="date">
      
      <?php
       echo date_i18n( 'l, F j, Y', strtotime( get_the_date() ) );
       ?>
          




  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php
    if ($post->post_excerpt == null && $post->post_type === 'damage') {
      $meta = get_post_meta(get_the_ID());

      if (!empty($meta['wpcf-excerpt'])) {
        $post->post_excerpt = $meta['wpcf-excerpt'][0];
      } else {
        $post->post_excerpt = $meta['wpcf-summary'][0];
      }
    }

    // $moreHref = '';
    // if (is_user_logged_in()) {
    //   $moreHref = get_permalink();
    // } else {
    //   $moreHref = get_permalink();
    //    $moreHref = "/just/membership-account/membership-levels/?redirect_to=";
    //    $moreHref .= urlencode(get_permalink());
    // }

    // $post->post_excerpt = $post->post_excerpt . ' <a href="' . $moreHref . '">Read more</a>';
    ?>
    
      <?php
      if(!(is_single())){
      $post->post_excerpt = $post->post_excerpt . '<div class="read_sub"> <a href="' . $moreHref . '">Read more</a> <span>|</span> <a href="' . site_url() . '/membership-account/membership-levels/">Subscribe</a></div>';
      }
      ?>
    
    <?php
    if (is_single()) {

      if (is_user_logged_in()) {
        echo '<hr><a class="print-link" target="_blank" href="' . get_permalink() . '?my_print=true">print this article</a><hr>';
        echo '<br><div class="excerpt">';
        echo explode("<a", $post->post_excerpt)[0];
        echo '</div><br><br>';
        the_content();
      } else {
        the_excerpt();
      }
    } else {
      the_excerpt();
    }

    // BW: pretty sure this can be deleted?
    wp_link_pages(array(
      'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfifteen') . '</span>',
      'after'       => '</div>',
      'link_before' => '<span>',
      'link_after'  => '</span>',
      'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>%',
      'separator'   => '<span class="screen-reader-text">, </span>',
    ));

    ?>
  </div><!-- .entry-content -->

  <?php
  // Post thumbnail.
  if (!is_single() && is_home()) {
    twentyfifteen_post_thumbnail();
  }
  ?>

  <div style="clear:both;height: 1px">&nbsp;</div>
  <?php

  // Author bio.
  if (is_single() && get_the_author_meta('description')) :
    get_template_part('author-bio');
  endif;
  ?>
  <?php
  $current_url = $_SERVER['REQUEST_URI'];
  if ($current_url === '/archive/') {
  ?>
    <div class="taged">
      <ul>
        <li>
          <a href="<?php get_permalink(); ?>" id="comment"><img src=" <?php site_url() ?>/wp-content/uploads/2024/03/comment.png"> Comment</a>
        </li>
        <li>
                <a href="javascript:void(0);" class="shareLink" data-target="popup_<?php echo get_the_ID(); ?>"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/share.png"> Share</a>

                <div id="popup_<?php echo get_the_ID(); ?>" class="share_popup" style="display: none;">
            <button class="closeButton">Close</button>
            <ul class="social-links">
              <li><a href="https://twitter.com/?logout=1711601231413" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/twitter-2.png" alt="">Twitter</a></li>
              <li><a href="https://www.facebook.com/share.php?u=https%3A%2F%2Fjustinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/facebook-1.png" alt="">Facebook</a></li>
              <li><a href="https://plusone.google.com/_/+1/confirm?hl=en&url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/google.png" alt="">Google</a></li>
              <li><a href="https://www.stumbleupon.com/submit?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/stumbleupon.png" alt="">Stumbleupon</a></li>
              <li><a href="https://digg.com/"><img src="http://justinian.inclusionsoft.com/wp-content/uploads/2024/03/digg.png" target="_blank" alt="">Digg</a></li>
              <li><a href="https://del.icio.us/post?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/delicious.png" alt="">Delicious</a></li>
              <li><a href="https://www.reddit.com/login/?dest=%2Fsubmit%3Furl%3Dhttps://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html%26title%3DLetter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/reddit.png" alt="">Reddit</a></li>
            </ul>
          </div>
        </li>
        <li>
          <?php echo do_shortcode("[printfriendly]"); ?>
        </li>
      </ul>
    </div>
    <?php
    // Assuming you have a custom post type called 'your_custom_post_type'
    $custom_post_type = 'bloggers';

    // Get the current post ID
    $post_id = get_the_ID();

    // Get the terms (tags) associated with the current post
    $tags = get_the_terms($post_id, 'post_tag');

    if ($tags && !is_wp_error($tags)) {
    ?>
      <div class="taged">
        <h5>Taged</h5>
      <?php
      echo '<ul>';
      foreach ($tags as $tag) {
        echo '<li><a href="' . get_term_link($tag) . '"><img src="' . site_url() . '/wp-content/uploads/2024/03/category.png">' . $tag->name . '</a></li>';
      }
      echo '</ul>';
    }
      ?>
    <?php
  }
    ?>
    <!-- For Bloogers -->
    <?php
    $current_url = $_SERVER['REQUEST_URI'];
    if ($current_url === '/bloggers/') {
    ?>
      <div class="taged">
        <ul>
          <li>
            <a href="<?php get_permalink(); ?>;" id="comment"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/comment.png"> Comment</a>
          </li>
          <li>
          <a href="javascript:void(0);" class="shareLink" data-target="popup_<?php echo get_the_ID(); ?>"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/share.png"> Share</a>

          <div id="popup_<?php echo get_the_ID(); ?>" class="share_popup" style="display: none;">
              <button class="closeButton">Close</button>
              <ul class="social-links">
              <li><a href="https://twitter.com/?logout=1711601231413" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/twitter-2.png" alt="">Twitter</a></li>
              <li><a href="https://www.facebook.com/share.php?u=https%3A%2F%2Fjustinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/facebook-1.png" alt="">Facebook</a></li>
              <li><a href="https://plusone.google.com/_/+1/confirm?hl=en&url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/google.png" alt="">Google</a></li>
              <li><a href="https://www.stumbleupon.com/submit?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/stumbleupon.png" alt="">Stumbleupon</a></li>
              <li><a href="https://digg.com/"><img src="http://justinian.inclusionsoft.com/wp-content/uploads/2024/03/digg.png" target="_blank" alt="">Digg</a></li>
              <li><a href="https://del.icio.us/post?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/delicious.png" alt="">Delicious</a></li>
              <li><a href="https://www.reddit.com/login/?dest=%2Fsubmit%3Furl%3Dhttps://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html%26title%3DLetter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/reddit.png" alt="">Reddit</a></li>
              </ul>
            </div>
          </li>
          <li>
            <?php echo do_shortcode("[printfriendly]"); ?>
          </li>
        </ul>
      </div>
      <?php
      // Assuming you have a custom post type called 'your_custom_post_type'
      $custom_post_type = 'bloggers';

      // Get the current post ID
      $post_id = get_the_ID();

      // Get the terms (tags) associated with the current post
      $tags = get_the_terms($post_id, 'post_tag');

      if ($tags && !is_wp_error($tags)) {
      ?>
        <div class="taged">
          <h5>Taged</h5>
        <?php
        echo '<ul>';
        foreach ($tags as $tag) {
          echo '<li><a href="' . get_term_link($tag) . '"><img src="' . site_url() . '/wp-content/uploads/2024/03/category.png">' . $tag->name . '</a></li>';
        }
        echo '</ul>';
      }
        ?>
      <?php
    }
      ?>

      <!-- //For Featurettes -->
      <?php
      $current_url = $_SERVER['REQUEST_URI'];
      if ($current_url === '/featurettes/') {
      ?>
        <div class="taged">
          <ul>
            <li>
              <a href="<?php get_permalink(); ?>" id="comment"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/comment.png"> Comment</a>
            </li>
            <li>
            <a href="javascript:void(0);" class="shareLink" data-target="popup_<?php echo get_the_ID(); ?>"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/share.png"> Share</a>

              <div id="popup_<?php echo get_the_ID(); ?>" class="share_popup" style="display: none;">
                <button class="closeButton">Close</button>
                <ul class="social-links">
                <li><a href="https://twitter.com/?logout=1711601231413" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/twitter-2.png" alt="">Twitter</a></li>
              <li><a href="https://www.facebook.com/share.php?u=https%3A%2F%2Fjustinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/facebook-1.png" alt="">Facebook</a></li>
              <li><a href="https://plusone.google.com/_/+1/confirm?hl=en&url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/google.png" alt="">Google</a></li>
              <li><a href="https://www.stumbleupon.com/submit?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/stumbleupon.png" alt="">Stumbleupon</a></li>
              <li><a href="https://digg.com/"><img src="http://justinian.inclusionsoft.com/wp-content/uploads/2024/03/digg.png" target="_blank" alt="">Digg</a></li>
              <li><a href="https://del.icio.us/post?url=https://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html&title=Letter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/delicious.png" alt="">Delicious</a></li>
              <li><a href="https://www.reddit.com/login/?dest=%2Fsubmit%3Furl%3Dhttps://justinian.com.au%2Fbloggers%2Fletter-from-london-2.html%26title%3DLetter%20from%20London%20" target="_blank"><img src="<?php site_url() ?>/wp-content/uploads/2024/03/reddit.png" alt="">Reddit</a></li>
                </ul>
              </div>
            </li>
            <li>
              <?php echo do_shortcode("[printfriendly]"); ?>
              <!-- <a href="javascript:void(0);" id="print"><img src="http://justinian.inclusionsoft.com/wp-content/uploads/2024/03/print.png"> Print</a> -->
            </li>
          </ul>
        </div>
        <?php
        // Assuming you have a custom post type called 'your_custom_post_type'
        $custom_post_type = 'featurette';

        // Get the current post ID
        $post_id = get_the_ID();

        // Get the terms (tags) associated with the current post
        $tags = get_the_terms($post_id, 'post_tag');

        if ($tags && !is_wp_error($tags)) {
        ?>
          <div class="taged">
            <h5>Taged</h5>
          <?php
          echo '<ul>';
          foreach ($tags as $tag) {
            echo '<li><a href="' . get_term_link($tag) . '"><img src="' . site_url() . '/wp-content/uploads/2024/03/category.png">' . $tag->name . '</a></li>';
          }
          echo '</ul>';
        }
          ?>
        <?php
      }
        ?>


        <footer class="entry-footer">
          <?php
          if (is_single()) {
            echo '<hr><a class="print-link" target="_blank" href="' . get_permalink() . '?my_print=true">print this article</a><hr>';
          }
          ?>
          <?php edit_post_link(__('Edit', 'twentyfifteen'), '<span class="edit-link">', '</span>'); ?>
        </footer><!-- .entry-footer -->

</article><!-- #post-## -->
<hr />

<script>
  // JavaScript to handle opening and closing of popups
  document.querySelectorAll('.shareLink').forEach(link => {
    link.addEventListener('click', function() {
      const targetId = this.getAttribute('data-target');
      const popup = document.getElementById(targetId);
      if (popup) {
        popup.style.display = 'block';
        popup.querySelector('.closeButton').addEventListener('click', function() {
          popup.style.display = 'none';
        });
      }
    });
  });
</script>