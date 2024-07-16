<?php
/**
 * Implement theme metabox.
 *
 * @package newsair
 */

if (!function_exists('newsair_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function newsair_add_theme_meta_box()
    {

        $screens = array('post', 'page');

        foreach ($screens as $screen) {
            add_meta_box(
                'newsair-theme-settings',
                esc_html__('Layout Options', 'newsair'),
                'newsair_render_layout_options_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action('add_meta_boxes', 'newsair_add_theme_meta_box');

if (!function_exists('newsair_render_layout_options_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function newsair_render_layout_options_metabox($post, $metabox)
    {

        $post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'newsair_meta_box_nonce');
        // Fetch Options list.
        $content_layout = get_post_meta($post_id, 'newsair-meta-content-alignment', true);

        if (empty($content_layout)) {
            $content_layout = newsair_get_option('newsair_content_layout');
        }


        ?>
        <div id="newsair-settings-metabox-container" class="newsair-settings-metabox-container">
            <div id="newsair-settings-metabox-tab-layout">
                <div class="newsair-row-content">
                    <!-- Select Field-->
                    <p>

                        <select name="newsair-meta-content-alignment" id="newsair-meta-content-alignment">

                            <option value="" <?php selected('', $content_layout); ?>>
                                <?php _e('Set as global layout', 'newsair') ?>
                            </option>
                            <option value="align-content-left" <?php selected('align-content-left', $content_layout); ?>>
                                <?php _e('Content - Primary Sidebar', 'newsair') ?>
                            </option>
                            <option value="align-content-right" <?php selected('align-content-right', $content_layout); ?>>
                                <?php _e('Primary Sidebar - Content', 'newsair') ?>
                            </option>
                            <option value="full-width-content" <?php selected('full-width-content', $content_layout); ?>>
                                <?php _e('Full width content', 'newsair') ?>
                            </option>
                        </select>
                    </p>

                </div><!-- .newsair-row-content -->
            </div><!-- #newsair-settings-metabox-tab-layout -->
        </div><!-- #newsair-settings-metabox-container -->

        <?php
    }

endif;


if (!function_exists('newsair_save_layout_options_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function newsair_save_layout_options_meta($post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['newsair_meta_box_nonce']) || !wp_verify_nonce($_POST['newsair_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if (empty($_POST['post_ID']) || $_POST['post_ID'] != $post_id) {
            return;
        }

        // Check permission.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $content_layout = isset($_POST['newsair-meta-content-alignment']) ? $_POST['newsair-meta-content-alignment'] : '';
        update_post_meta($post_id, 'newsair-meta-content-alignment', sanitize_text_field($content_layout));


    }

endif;

add_action('save_post', 'newsair_save_layout_options_meta', 10, 2);

if (!function_exists('save_taxonomy_color_class_meta')) :
// Save extra taxonomy fields callback function.
    function save_taxonomy_color_class_meta($term_id)
    {
        if (isset($_POST['term_meta'])) {
            $t_id = $term_id;
            $term_meta = get_option("category_color_$t_id");
            $cat_keys = array_keys($_POST['term_meta']);
            foreach ($cat_keys as $key) {
                if (isset ($_POST['term_meta'][$key])) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option("category_color_$t_id", $term_meta);
        }
    }

endif;
add_action('edited_category', 'save_taxonomy_color_class_meta', 10, 2);
add_action('create_category', 'save_taxonomy_color_class_meta', 10, 2);