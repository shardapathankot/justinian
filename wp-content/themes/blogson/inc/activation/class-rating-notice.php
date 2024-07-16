<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Blogson_Rating_Notice {
    private $past_date;

    public function __construct() {
        $this->past_date = false == get_option('blogson_maybe_later_time') ? strtotime( '-5 days' ) : strtotime('-15 days');

        if ( current_user_can('administrator') ) {
            if ( empty(get_option('blogson_rating_dismiss_notice')) && empty(get_option('blogson_rating_already_rated')) ) {
                add_action( 'admin_init', [$this, 'check_theme_install_time'] );
            }
        }

        if ( is_admin() ) {
            add_action( 'admin_head', [$this, 'enqueue_scripts' ] );
        }

        add_action( 'wp_ajax_blogson_rating_dismiss_notice', [$this, 'blogson_rating_dismiss_notice'] );
        add_action( 'wp_ajax_blogson_rating_already_rated', [$this, 'blogson_rating_already_rated'] );
        add_action( 'wp_ajax_blogson_rating_maybe_later', [$this, 'blogson_rating_maybe_later'] );
    }

    public function check_theme_install_time() {   
        $install_date = get_option('blogson_activation_time');

        if ( false !== $install_date && $this->past_date >= $install_date ) {
            add_action( 'admin_notices', [$this, 'blogson_render_rating_notice' ]);
        }
    }

    public function blogson_rating_maybe_later() {
        update_option('blogson_maybe_later_time', true);
        update_option('blogson_activation_time', strtotime('now'));
    }
    
    public function blogson_rating_dismiss_notice() {
        update_option( 'blogson_rating_dismiss_notice', true );
    }

    function blogson_rating_already_rated() {    
        update_option( 'blogson_rating_already_rated' , true );
    }

    public function blogson_render_rating_notice() {
        if ( is_admin() ) {

            echo '<div class="notice blogson-rating-notice is-dismissible" style="border-left-color: #0073aa!important; display: flex; align-items: center;">
                        <div class="blogson-rating-notice-logo">
                        <img class="blogson-logo" src="'.get_theme_file_uri().'/inc/activation/img/logo-spiracle.png">
                        </div>
                        <div>
                            <h3>Thank you for using BlogSon WordPress Theme to build this website!</h3>
                            <p>Could you please do us a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.</p>
                            <p>
                                <a href="https://wordpress.org/support/theme/blogson/reviews/?filter=5" target="_blank" class="blogson-you-deserve-it button button-primary">OK, you deserve it!</a>
                                <a class="blogson-maybe-later"><span class="dashicons dashicons-clock"></span> Maybe Later</a>
                                <a class="blogson-already-rated"><span class="dashicons dashicons-yes"></span> I Already did</a>
                            </p>
                        </div>
                </div>';
        }
    }

    public function enqueue_scripts() { 
        echo "
        <script>
        jQuery( document ).ready( function() {

            jQuery(document).on( 'click', '.blogson-rating-notice .notice-dismiss', function(e) {
                e.preventDefault();
                jQuery(document).find('.blogson-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'blogson_rating_dismiss_notice',
                    }
                })
            });

            jQuery(document).on( 'click', '.blogson-maybe-later', function() {
                jQuery(document).find('.blogson-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'blogson_rating_maybe_later',
                    }
                })
            });
        
            jQuery(document).on( 'click', '.blogson-already-rated', function() {
                jQuery(document).find('.blogson-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'blogson_rating_already_rated',
                    }
                })
            });
        });
        </script>

        <style>
            .blogson-rating-notice {
              padding: 0 15px;
            }

            .blogson-rating-notice-logo {
                margin-right: 20px;
                width: 100px;
                height: 100px;
            }

            .blogson-rating-notice-logo img {
                max-width: 100%;
            }

            .blogson-rating-notice h3 {
              margin-bottom: 0;
            }

            .blogson-rating-notice p {
              margin-top: 3px;
              margin-bottom: 15px;
            }

            .blogson-already-rated,
            .blogson-maybe-later {
              text-decoration: none;
              margin-left: 12px;
              font-size: 14px;
              cursor: pointer;
            }

            .blogson-already-rated .dashicons,
            .blogson-maybe-later .dashicons {
              vertical-align: sub;
            }

            .blogson-logo {
                height: 100%;
                width: auto;
            }

        </style>
        ";
    }
}

new Blogson_Rating_Notice();