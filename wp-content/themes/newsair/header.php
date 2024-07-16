<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Newsair
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<?php 
$theme_layout = get_theme_mod('newsair_theme_layout_options','wide');
if($theme_layout == "boxed")
{ $class="boxed bodyback"; }
else
{ $class="wide"; } ?>
<body <?php body_class($class); ?> >
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php echo esc_html( 'Skip to content', 'newsair' ); ?></a>

<!--wrapper-->
<div class="wrapper" id="custom-background-css">
<!--==================== TOP BAR ====================-->
<?php do_action('newsair_action_newsair_header_type_section');
  $show_popular_tags_title = newsair_get_option('show_popular_tags_title');
  $select_popular_tags_mode = newsair_get_option('select_popular_tags_mode');
  $number_of_popular_tags = newsair_get_option('number_of_popular_tags');
  $newsair_enable_main_slider = newsair_get_option('show_main_banner_section');
  $popular_tags = esc_attr(get_theme_mod('show_popular_tags_section',true))== true ? '' : ' mt-40';
  $slider_position = get_theme_mod('main_slider_position', 'left') == 'left' ? '': ' flex-row-reverse'; 

if(is_home() || is_front_page()) { 
    echo'<!--top tags start-->';        
        newsair_list_popular_taxonomies($select_popular_tags_mode, $show_popular_tags_title, $number_of_popular_tags);
    echo'<!--top tags end-->';
    ?>

<?php if($newsair_enable_main_slider){ ?>
<!--mainfeatured start-->
<div class="mainfeatured<?php if (!empty($main_banner_section_background_image)) { echo ' over mt-0'; } echo esc_attr($popular_tags);?>">
    <div class="featinner">
        <!--container-->
        <div class="container">
            <!--row-->
             <div class="row gx-1<?php echo esc_attr($slider_position);?>">              
                <?php
                    do_action('newsair_action_front_page_main_section_1');
                ?>  
            </div><!--/row-->
        </div><!--/container-->
    </div>
</div>
<!--mainfeatured end-->
<?php } do_action('newsair_action_posts_crowsel');
if(is_active_sidebar('magazine-content')){
 get_template_part('sidebar','magazine');
}
do_action('newsair_action_featured_ads_section');
} ?>