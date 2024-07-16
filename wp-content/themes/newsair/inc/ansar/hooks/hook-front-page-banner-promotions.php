<?php
if (!function_exists('newsair_banner_advertisement')):
    /**
     *
     * @since newsair 1.0.0
     *
     */
    function newsair_banner_advertisement()
    {

        if (('' != newsair_get_option('banner_ad_image')) ) { ?>
                <?php if (('' != newsair_get_option('banner_ad_image'))):

                    $newsair_banner_advertisement = newsair_get_option('banner_ad_image');
                    $newsair_banner_advertisement = absint($newsair_banner_advertisement);
                    $newsair_banner_advertisement = wp_get_attachment_image($newsair_banner_advertisement, 'full');
                    $banner_ad_url = newsair_get_option('banner_ad_url');
                    $newsair_open_on_new_tab = newsair_get_option('newsair_open_on_new_tab');
                    $newsair_open_on_new_tab = ('' != $newsair_open_on_new_tab) ? '_blank' : '';
                    $center_logo = esc_attr(get_theme_mod('newsair_center_logo_title',false));

                    if($center_logo == false) { ?>
                    <div class="col-lg-8">
                        <div class="header-ads">
                    <?php } else { ?>
                    <div class="col-lg-12">
                       <div class="header-ads d-flex justify-content-center mt-3">
                    <?php } ?>

                   
                            <a class="header-ads-img img-fluid" href="<?php echo esc_url($banner_ad_url); ?>" target="<?php echo esc_attr($newsair_open_on_new_tab); ?>">
                                <?php echo $newsair_banner_advertisement; ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php
        }
    }
endif;

add_action('newsair_action_banner_advertisement', 'newsair_banner_advertisement', 10);