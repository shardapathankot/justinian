<?php $newsair_enable_single_post_comments = esc_attr(get_theme_mod('newsair_enable_single_post_comments',true));
if($newsair_enable_single_post_comments == true) {
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif; 
} ?>