<?php /**
 * AJAX handler to store the state of dismissible notices.
 */
function newsair_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

add_action( 'wp_ajax_newsair_dismissed_notice_handler', 'newsair_ajax_notice_handler' );

function newsair_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
               <div class="newsair-notice-started updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="newsair-notice clearfix">
                    <div class="newsair-notice-content">
                        
                        <div class="newsair-notice_text">
                        <div class="newsair-hello">
                            <?php esc_html_e( 'Hello, ', 'newsair' ); 
                            $current_user = wp_get_current_user();
                            echo esc_html( $current_user->display_name );
                            ?>
                            <img draggable="false" role="img" class="emoji" alt="👋🏻" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f44b-1f3fb.svg">                
                        </div>
                        <h1><?php
                                $theme_info = wp_get_theme();
                                printf( esc_html__('Welcome to %1$s', 'newsair'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) ); ?>
                        </h1>
                        
                        <p><?php esc_html_e("Thank you for choosing Newsair theme. To take full advantage of the complete features of the theme click the Import Demo and Install and Activate the plugin then use the demo importer and install the Newsair Demo according to your need.", "newsair"); ?></p>

                        <div class="panel-column-6">
                        <a class="newsair-btn-get-started button button-primary button-hero newsair-button-padding" href="#" data-name="" data-slug=""><?php esc_html_e( 'Import Demo', 'newsair' ) ?></a>

                        <a class="newsair-btn-get-started-customize button button-primary button-hero newsair-button-padding" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>" data-name="" data-slug=""><?php esc_html_e( 'Customize Site', 'newsair' ) ?></a>

                        <div class="newsair-documentation">
                        <span aria-hidden="true" class="dashicons dashicons-external"></span>
                         <a class="newsair-documentation" href="<?php echo esc_url('https://docs.themeansar.com/docs/newsair-pro')?>" data-name="" data-slug=""><?php esc_html_e( 'View Documentation', 'newsair' ) ?></a>
                        </div>

                        <div class="newsair-demos">
                        <span aria-hidden="true" class="dashicons dashicons-external"></span>
                        <a class="newsair-demos" href="<?php echo esc_url('https://demos.themeansar.com/newsair-demos/')?>" data-name="" data-slug=""><?php esc_html_e( 'View Demos', 'newsair' ) ?></a>
                        </div>

                        </div>
                        </div>
                        <div class="newsair-notice_image">
                             <img class="newsair-screenshot" src="<?php echo esc_url( get_template_directory_uri() . '/images/newsair.customize.webp' ); ?>" alt="<?php esc_attr_e( 'Newsair', 'newsair' ); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        <?php }
}

add_action( 'admin_notices', 'newsair_deprecated_hook_admin_notice' );

/* Plugin Install */

add_action( 'wp_ajax_install_act_plugin', 'newsair_admin_info_install_plugin' );

function newsair_admin_info_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/ansar-import' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'ansar-import' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'ansar-import/ansar-import.php' );
    }
}