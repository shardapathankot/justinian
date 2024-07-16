<?php 
function papernews_custom_style()
{
$header_color = get_theme_mod('papernews_header_overlay_color','rgba(0, 2, 79, 0.7)');
$body_background_color = get_theme_mod( 'body_background_color','#fff' );
$remove_header_image_overlay = get_theme_mod('remove_header_image_overlay',false); 
?>
<style type="text/css">
  .wrapper{
    background: <?php echo esc_attr($body_background_color); ?>
  }
  html[data-theme='dark'] .wrapper {
    background-color: #000;
  }
<?php if($remove_header_image_overlay == false ) { ?>
  <style>
  .bs-default .bs-header-main .inner{
    background-color:<?php echo esc_attr($header_color);?>
  }
  </style>
<?php } else { ?>
 <style> 
  .bs-default .bs-header-main .inner{
    background-color: transparent;
  }
 </style>
<?php } } add_action('wp_head','papernews_custom_style',10,0); 