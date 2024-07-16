<?php
if (!function_exists('newsair_side_menu_section')) :
/**
 *  Header
 *
 * @since newsair
 *
 */
function newsair_side_menu_section() { ?>
  <div class="sidenav offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel"> </h5>
      <span class="btn_close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i></span>
    </div>
    <div class="offcanvas-body">
      <?php if( is_active_sidebar('menu-sidebar-content')){
        get_template_part('sidebar','newsairmenu');
      }  else {
        wp_nav_menu( array(
          'theme_location' => 'sidebar_menu',
          'container'  => '',
          'menu_class' => 'nav navbar-nav sm sm-vertical',
          'fallback_cb' => 'newsair_fallback_page_menu',
          'walker' => new newsair_nav_walker()
        ) );

      }?>
    </div>
  </div>
  <?php 
}
endif;
add_action('newsair_action_side_menu_section', 'newsair_side_menu_section', 5);