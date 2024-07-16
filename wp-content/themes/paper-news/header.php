<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Paper News
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'paper-news' ); ?></a>
    <div class="wrapper" id="custom-background-css">
    <?php do_action('newsair_action_side_menu_section'); ?>
      <!--header--> 
<!--mainfeatured start-->
<header class="bs-headthree cont">
    <?php //do_action('newsair_action_header_section'); ?>
    <!-- Main Menu Area-->
    <?php $background_image = get_theme_support( 'custom-header', 'default-image' );
    $papernews_header_overlay_color = get_theme_mod('papernews_header_overlay_color', '');
    $remove_header_image_overlay = get_theme_mod('remove_header_image_overlay',false);
    $subs_title  = get_theme_mod('subs_news_title','Subscribe');
    $subsc_link = get_theme_mod('newsair_subsc_link', '#'); 
    $subsc_open_in_new  = get_theme_mod('subsc_open_in_new',true);
    $subsc_icon  = get_theme_mod('subsc_icon_layout','play');
    $banner_ad_image = newsair_get_option('banner_ad_image');
    if ( has_header_image() ) {
      $background_image = get_header_image();
    } ?>
    <div class="bs-header-main" style='background-image: url("<?php echo esc_url( $background_image ); ?>" );'>
    
        <div class="inner<?php if($remove_header_image_overlay == true) { echo ' overlay' ;} ; if(empty($banner_ad_image)){ echo ' responsive';};?>" style="background-color:<?php echo esc_attr($papernews_header_overlay_color);?>;" >
          <div class="container">
          <div class="row align-items-center d-none d-lg-flex">
            <!-- col-lg-4 -->
            <div class="col-lg-4 d-lg-flex justify-content-start"> 
              <?php do_action('newsair_action_header_social_section'); ?>
            </div>
            <!-- //col-lg-4 -->
            <!-- col-lg-4 -->
            <div class="col-lg-4 text-center">
              <div class="navbar-header d-none d-lg-block">
                <?php the_custom_logo(); 
                  if (display_header_text()) { ?>
                  <div class="site-branding-text"> 
                    <?php } else { ?>
                      <div class="site-branding-text d-none"> 
                   <?php } ?>
                  <?php if (is_front_page() || is_home()) { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></h1>
                    <?php } else { ?>
                    <p class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></p>
                    <?php } ?>
                    <p class="site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></p>
                  </div>
              </div>
            </div>
          <!-- //col-lg-4 -->
           <!-- col-lg-4 -->
            <div class="col-lg-4 d-lg-flex justify-content-end align-items-center">
              <?php newsair_date_display_type(); ?> 
              <div class="info-right right-nav d-flex align-items-center justify-content-center justify-content-md-end">
                <a href="<?php echo esc_attr($subsc_link) ?>" class="subscribe-btn" <?php if($subsc_open_in_new == true){ echo ' target="_blank"'; } ?>><i class="fas fa-<?php echo esc_html($subsc_icon) ?>"></i> 
                <?php if(!empty($subs_title)){ ?>
                  <span><?php echo esc_html($subs_title); ?></span>
                <?php } ?>
                </a>
              </div>
            </div>
          <!-- //col-lg-4 -->
            <?php //do_action('newsair_action_banner_advertisement'); ?>
          </div><!-- /row-->
          <div class="d-lg-none">
            <?php do_action('newsair_action_banner_advertisement'); ?>
          </div>
        </div><!-- /container-->
      </div><!-- /inner-->
    </div><!-- /Main Menu Area-->
    <?php do_action('papernews_action_header_menu_section');  ?>
  </header>
<!--mainfeatured start-->
<div class="mainfeatured<?php if (!empty($main_banner_section_background_image)) { echo ' over mt-0'; }?>">
    <div class="featinner">
        <!--container-->
        <div class="container">
            <!--row-->
             <div class="row">              
                <?php
                    do_action('papernews_action_front_page_main_section_1');
                ?>  
            </div><!--/row-->
        </div><!--/container-->
    </div>
</div>
<!--mainfeatured end-->