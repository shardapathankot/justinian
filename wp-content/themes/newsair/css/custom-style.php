<?php 
function newsair_custom_style()
{
$newsair_archive_page_sidebar_width = get_theme_mod('newsair_theme_sidebar_width');
$newsair_single_page_sidebar_width = get_theme_mod('newsair_single_page_sidebar_width');
$newsair_header_overlay_size = get_theme_mod('newsair_header_overlay_size','');
$background_image = get_theme_support( 'custom-header', 'default-image' ); 
$remove_header_image_overlay = get_theme_mod('remove_header_image_overlay',false); 
$header_color = get_theme_mod('newsair_header_overlay_color','');
$main_banner_section_background_image = get_theme_mod('main_banner_section_background_image', ''); 
function get_main_banner_section_background_image_url() {
  if ( get_theme_mod( 'main_banner_section_background_image' ) > 0 ) {
    return wp_get_attachment_url( get_theme_mod( 'main_banner_section_background_image' ) );
  }
}
if ( has_header_image() ) {
  $background_image = get_header_image();
} if(!empty($main_banner_section_background_image)){ ?>
<style>
.mainfeatured {
  background-image: url("<?php echo esc_attr( get_main_banner_section_background_image_url() ); ?>"); 
}
.mainfeatured .featinner {
  padding-bottom: 30px;
  padding-top: 30px;
  background-color: rgba(18,16,38,0.6);
}
.mainfeatured {
  margin-top: 0;
  margin-bottom: 40px;
}
section.mg-tpt-tag-area.mb-n4 {
  margin-bottom: 0;
}
</style>
<?php } ?>
<style>
.bs-header-main {
  background-image: url("<?php echo esc_url( $background_image ); ?>" );
}
</style>
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
<?php }if($newsair_archive_page_sidebar_width){ ?>
<style>
.archive-class .sidebar-right, .archive-class .sidebar-left , .index-class .sidebar-right, .index-class .sidebar-left{
    flex: 100;
    width:<?php echo esc_attr($newsair_archive_page_sidebar_width).'px'; ?> !important;
  }
  .archive-class .content-right , .index-class .content-right {
    width: calc((1130px - <?php echo esc_attr($newsair_archive_page_sidebar_width).'px'; ?>)) !important;
  }
</style>
<?php } 

if( $newsair_single_page_sidebar_width ){ ?>
  <style>
  .single-class .sidebar-right, .single-class .sidebar-left{
    flex: 100;
    width:<?php echo esc_attr($newsair_single_page_sidebar_width).'px'; ?> !important;
  }
  .single-class .content-right {
    width: calc((1130px - <?php echo esc_attr($newsair_single_page_sidebar_width).'px'; ?>)) !important;
  }
</style>
<?php } ?>
<style>
  .bs-default .bs-header-main .inner, .bs-headthree .bs-header-main .inner{ 
    height:<?php echo esc_attr(get_theme_mod('desktop_header_image_height','')).'px'; ?>; 
  }

  @media (max-width:991px) {
    .bs-default .bs-header-main .inner, .bs-headthree .bs-header-main .inner{ 
      height:<?php echo esc_attr(get_theme_mod('tablet_header_image_height','')).'px'; ?>; 
    }
  }
  @media (max-width:576px) {
    .bs-default .bs-header-main .inner, .bs-headthree .bs-header-main .inner{ 
      height:<?php echo esc_attr(get_theme_mod('mobile_header_image_height','')).'px'; ?>; 
    }
  }
</style>
<?php } add_action('wp_head','newsair_custom_style',10,0); 
