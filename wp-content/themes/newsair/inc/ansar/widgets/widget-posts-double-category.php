<?php
if (!class_exists('newsair_Dbl_Col_Cat_Posts')) :
    /**
     * Adds Newsair_Dbl_Col_Cat_Posts widget.
     */
    class newsair_Dbl_Col_Cat_Posts extends Newsair_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsair-categorised-posts-title-1', 'newsair-categorised-posts-title-2', 'newsair-posts-number-1', 'newsair-posts-number-2');
            $this->select_fields = array('newsair-select-category-1', 'newsair-select-category-2', 'newsair-select-layout-1', 'newsair-select-layout-2');

            $widget_ops = array(
                'classname' => 'newsair_dbl_col_cat_posts',
                'description' => __('Displays posts from 2 selected categories in double column.', 'newsair'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsair_dbl_col_cat_posts', __('AR: Double Categories Posts', 'newsair'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {

            $instance = parent::newsair_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $title_1 = apply_filters('widget_title', $instance['newsair-categorised-posts-title-1'], $instance, $this->id_base);
            $title_2 = apply_filters('widget_title', $instance['newsair-categorised-posts-title-2'], $instance, $this->id_base);
            $category_1 = isset($instance['newsair-select-category-1']) ? $instance['newsair-select-category-1'] : '0';
            $category_2 = isset($instance['newsair-select-category-2']) ? $instance['newsair-select-category-2'] : '0';
            $layout_1 = isset($instance['newsair-select-layout-1']) ? $instance['newsair-select-layout-1'] : 'full-plus-list';
            $layout_2 = isset($instance['newsair-select-layout-2']) ? $instance['newsair-select-layout-2'] : 'list';
            $number_of_posts_1 =  4;
            $number_of_posts_2 =  4;


            // open the widget container
            echo $args['before_widget'];
            ?>


            <div class="double-category-posts col-grid-2">
                <div class="colinn <?php echo esc_attr($layout_1); ?>">
                    <?php if (!empty($title_1)): ?>
                        <div class="bs-widget-title">
                        <h4 class="title"><?php echo esc_html($title_1); ?> </h4>
                        </div>
                    <?php endif; ?>
                    <?php $all_posts = newsair_get_posts($number_of_posts_1, $category_1); ?>
                    <?php
                    $count_1 = 1;

                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            if ($count_1 == 1) {
                                $thumbnail_size = 'newsair-medium';
                            } else {
                                $thumbnail_size = 'thumbnail';
                            }
                            global $post;
                            $url = newsair_get_freatured_image_url($post->ID, $thumbnail_size);

                            if ($url == '') {
                                $img_class = 'no-image';
                            }
                            global $post; ?>
                            
                            <div class="small-post clearfix bs-post-<?php echo esc_attr($count_1); ?>">
                                <!-- small_post -->
                                <div class="img-small-post">
                                    <!-- img-small-post -->
                                    <img class="back-img" src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>">
                                </div>
                                <!-- // img-small-post -->
                                <div class="small-post-content">
                                    <?php newsair_post_categories(); ?>
                                    <!-- small-post-content -->
                                    <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <?php if($count_1 == 1) { ?>
                                    <?php newsair_post_meta(); ?>
                                    <!-- // title_small_post -->
                                    <?php newsair_posted_content(); wp_link_pages( ); 
                                        $newsair_readmore_excerpt=get_theme_mod('newsair_blog_content','excerpt');
                                        $read_more_title = get_theme_mod('newsair_post_read_more_title','Read More'); 
                                        $post_btn_disable = get_theme_mod('newsair_post_read_more_disable',true);
                                        if (  ($newsair_readmore_excerpt=="excerpt") && ($post_btn_disable == true) ){?>
                                        <p><a href="<?php the_permalink();?>" class="more-link"><?php echo esc_html($read_more_title); ?></a></p>
                                    <?php } } else { ?>
                                    <div class="bs-blog-meta">
                                        <?php newsair_date_content(); ?>
                                    </div>
                                    <?php } ?>
                                    <!-- // title_small_post -->
                                </div>
                                <!-- // small-post-content -->
                            </div>
                            <!-- // small_post -->
                            <?php
                            $count_1++;
                        endwhile; ?>
                    <?php endif;
                wp_reset_postdata(); ?>
                </div>

                <div class="colinn <?php echo esc_attr($layout_2); ?>">
                    <?php if (!empty($title_2)): ?>
                    <!-- bs-sec-title -->
                    <div class="bs-widget-title">
                        <h4 class="title"><?php echo esc_html($title_2); ?></h4>
                    </div>
                    <!-- // bs-sec-title -->
                    <?php endif; ?>
                        <?php $all_posts = newsair_get_posts($number_of_posts_2, $category_2); ?>
                        <?php
                        $count_2 = 1;
                        if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                if ($count_2 == 1) {
                                    $thumbnail_size = 'newsair-medium';
                                } else {
                                    $thumbnail_size = 'thumbnail';
                                }

                                global $post;
                                $url = newsair_get_freatured_image_url($post->ID, $thumbnail_size);

                                if ($url == '') {
                                    $img_class = 'no-image';
                                }

                                global $post;?>

                                <div class="small-post clearfix bs-post-<?php echo esc_attr($count_2); ?>">
                                    <!-- small_post -->
                                    <div class="img-small-post">
                                        <!-- img-small-post -->
                                        <img class="back-img" src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <!-- // img-small-post -->
                                    <div class="small-post-content">
                                        <?php newsair_post_categories(); ?>
                                        <!-- small-post-content -->
                                        <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <?php if($count_2 == 1) { ?>
                                        <?php newsair_post_meta(); ?>
                                        <!-- // title_small_post -->
                                        <?php newsair_posted_content(); wp_link_pages( ); 
                                            $newsair_readmore_excerpt=get_theme_mod('newsair_blog_content','excerpt');
                                            $read_more_title = get_theme_mod('newsair_post_read_more_title','Read More');  
                                            $post_btn_disable = get_theme_mod('newsair_post_read_more_disable',true);
                                            if (  ($newsair_readmore_excerpt=="excerpt") && ($post_btn_disable == true) ){?>
                                            <p><a href="<?php the_permalink();?>" class="more-link"><?php echo esc_html($read_more_title); ?></a></p>
                                        <?php } } else { ?>
                                        <div class="bs-blog-meta">
                                            <?php newsair_date_content(); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!-- // small-post-content -->                                         
                                </div> <!-- // small_post -->                                   
                                <?php $count_2++;
                            endwhile;
                        endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>

            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;

            //print_pre($terms);
            $categories = newsair_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsair_generate_text_input('newsair-categorised-posts-title-1', __('Title 1', 'newsair'), 'Double Categories Posts 1');
                echo parent::newsair_generate_select_options('newsair-select-category-1', __('Select category 1', 'newsair'), $categories);
                echo parent::newsair_generate_text_input('newsair-categorised-posts-title-2', __('Title 2', 'newsair'), 'Double Categories Posts 2');
                echo parent::newsair_generate_select_options('newsair-select-category-2', __('Select category 2', 'newsair'), $categories);
            }

            //print_pre($terms);


        }

    }
endif;