<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Newsair
 */
get_header(); ?>
  <div id="content" class="container">
  <!--container--> 
    <!--row-->
    <div class="row">
      <?php do_action('newsair_breadcrumb_content'); ?>
      <!--container-->
      <div class="col-md-12 text-center bs-section"> 
        <!--mg-error-404-->
        <div class="bs-error-404">
          <h1><?php echo esc_html('4','newsair'); ?><i class="fa fa-ban"></i>4</h1>
          <h4><?php echo esc_html(get_theme_mod('newsair_404_title', 'Oops! Page not found')); ?></h4>
          <p><?php echo esc_html(get_theme_mod('newsair_404_desc','We are sorry, but the page you are looking for does not exist.')); ?></p>
          <a href="<?php echo esc_url(home_url());?>" onClick="history.back();" class="btn btn-theme">
          <?php echo esc_html(get_theme_mod('newsair_404_btn_title','Go Back')); ?></a> </div>
        <!--/mg-error-404--> 
      </div>
      <!--/col-md-12--> 
    </div>
    <!--/row--> 
  <!--/container-->
</div>
<?php
get_footer();