<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Newsair
 */
?>
  <!-- </main> -->
    <?php do_action('newsair_action_footer_missed_section'); ?>
    <!--==================== FOOTER AREA ====================-->
    <?php $newsair_footer_widget_background = get_theme_mod('newsair_footer_widget_background');
    $newsair_footer_overlay_color = get_theme_mod('newsair_footer_overlay_color'); 
   if($newsair_footer_widget_background != '') { ?>
    <footer class="back-img" style="background-image:url('<?php echo esc_url($newsair_footer_widget_background);?>');">
     <?php } else { ?>
    <footer> 
    <?php } ?>
        <div class="overlay" style="background-color: <?php echo esc_html($newsair_footer_overlay_color);?>;">
            <!--Start bs-footer-widget-area-->
            <?php if ( is_active_sidebar( 'footer_widget_area' ) ) { ?>
            <div class="bs-footer-widget-area">
                <div class="container">
                    <div class="row">
                        <?php  dynamic_sidebar( 'footer_widget_area' ); ?>
                    </div>
                    <!--/row-->
                </div>
                <!--/container-->
            </div>
            <?php } ?>
            <div class="bs-footer-bottom-area">
                <div class="container">
                    <div class="divide-line"></div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="footer-logo text-xs">
                                <?php the_custom_logo(); 
                                if (display_header_text()) { ?>
                                    <div class="site-branding-text">
                                        <p class="site-title-footer"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                        <p class="site-description-footer mb-3"><?php bloginfo('description'); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--col-md-3-->
                        <div class="col-md-6">
                            <?php do_action('newsair_action_footer_social_section'); ?>
                        </div>
                        <!--/col-md-3-->
                    </div>
                    <!--/row-->
                </div>
                <!--/container-->
            </div>
            <!--End bs-footer-widget-area-->
            <?php $hide_copyright = esc_attr(get_theme_mod('hide_copyright','true'));
                if ($hide_copyright == true ) { ?>
                <div class="bs-footer-copyright">
                    <div class="container">
                        <div class="row">
                          <?php if ( has_nav_menu( 'footer' ) ) {
                           ?>
                            <div class="col-md-6 text-md-start text-xs">
                              <p class="mb-0">
                                <?php $newsair_footer_copyright = get_theme_mod( 'newsair_footer_copyright','Copyright &copy; All rights reserved' );
                                  echo esc_html($newsair_footer_copyright);
                                ?>
                                <span class="sep"> | </span>
                                <?php  printf(esc_html__('%1$s by %2$s.', 'newsair'), '<a href="https://themeansar.com/free-themes/newsair/" target="_blank">Newsair</a>', '<a href="https://themeansar.com" target="_blank">Themeansar</a>'); ?>
                                 </a>
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end text-xs">
                                  <?php wp_nav_menu( array(
                                  'theme_location' => 'footer',
                                  'container'  => 'nav-collapse collapse navbar-inverse-collapse',
                                  'menu_class' => 'info-right',
                                  'fallback_cb' => 'newsair_fallback_page_menu',
                                  'walker' => new newsair_nav_walker()
                                     ) ); 
                                   ?>
                            </div>
                          <?php } else { ?>
                             <div class="col-md-12 text-center">
                              <p class="mb-0">
                                <?php $newsair_footer_copyright = get_theme_mod( 'newsair_footer_copyright','Copyright &copy; All rights reserved' );
                                  echo esc_html($newsair_footer_copyright);
                                ?>
                                <span class="sep"> | </span>
                                <?php  printf(esc_html__('%1$s by %2$s.', 'newsair'), '<a href="https://themeansar.com/free-themes/newsair/" target="_blank">Newsair</a>', '<a href="https://themeansar.com" target="_blank">Themeansar</a>'); ?>
                                 </a>
                                </p>
                            </div>
                          <?php } ?>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php } ?>
        </div>
        <!--/overlay-->
    </footer>
    <!--/footer-->
</div>
<!--/wrapper-->
<?php 
  //Scroll To Top 
  newsair_scrolltoup();
  //Search Popup
  newsair_search_popup();
  //wp_footer
  wp_footer();
?>
</body>
</html>