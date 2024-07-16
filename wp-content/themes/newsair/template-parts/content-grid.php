<?php
/**
 * The template for displaying the content.
 * @package Newsair
 */
?>
<div id="grid" class="row" >
        <?php $newsair_content_layout = esc_attr(get_theme_mod('newsair_content_layout','grid-right-sidebar'));
        while(have_posts()){ the_post(); ?>
                <?php get_template_part('sections/content','dataGrid'); ?>
        <?php } ?>
        <div class="col-md-12 text-center d-md-flex justify-content-center">
        <?php 
                //Previous / next page navigation
                $prev_text =  (is_rtl()) ? "right" : "left";
                $next_text =  (is_rtl()) ? "left" : "right";
                
                the_posts_pagination( array(
                        'prev_text'          => '<i class="fas fa-angle-'.$prev_text.'"></i>',
                        'next_text'          => '<i class="fas fa-angle-'.$next_text.'"></i>',
                        ) 
                );
        ?>
        </div>
</div>