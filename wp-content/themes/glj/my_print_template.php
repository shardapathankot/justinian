<?php
  $post = get_post();
  //echo '<h1>'.$post->post_title.'</h1>';
  echo apply_filters('the_content', get_post()->post_content);
?>
