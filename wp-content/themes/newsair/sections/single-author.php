<?php $newsair_enable_single_admin_details = esc_attr(get_theme_mod('newsair_enable_single_admin_details','true'));
if($newsair_enable_single_admin_details == true) { ?>
    <div class="bs-info-author-block py-4 px-3 mb-4 flex-column justify-content-center text-center">
    <a class="bs-author-pic mb-3" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?></a>
        <div class="flex-grow-1">
            <h4 class="title"><?php echo esc_html('By','newsair'); ?> <a href ="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
            <p><?php the_author_meta( 'description' ); ?></p>
        </div>
        </div>
<?php } ?>