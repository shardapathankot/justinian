<?php
if (!class_exists('newsair_Posts_Carousel')) :
    /**
     * Adds newsair_Posts_Carousel widget.
     */
    class newsair_Posts_Carousel extends Newsair_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 0.1
         */
        function __construct()
        {
            $this->text_fields = array('newsair-posts-slider-title', 'newsair-posts-slider-subtitle');
            $this->select_fields = array('newsair-select-category');

            $widget_ops = array(
                'classname' => 'bs-slider-widget mt-3 mb-3',
                'description' => __('Displays posts carousel from selected category.', 'newsair'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsair_posts_carousel', __('TA: Posts Carousel', 'newsair'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['newsair-posts-slider-title'], $instance, $this->id_base);
            $number_of_posts = '5';
            $slide_to_show = '1';
            $slider_duration = '3000';
            $category = isset($instance['newsair-select-category']) ? $instance['newsair-select-category'] : '0';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <!-- bs-posts-sec bs-posts-modul-3 -->
            <div class="bs-slider-widget">
                <?php if (!empty($title)): ?>
                <!-- bs-sec-title -->
                <div class="bs-widget-title">
                    <?php if (!empty($title)): ?>
                        <h4 class="title"><?php echo esc_html($title);  ?></h4>
                    <?php endif; ?>
                </div> <!-- // bs-sec-title -->
                <?php endif; ?>                    
                <?php
                $all_posts = newsair_get_posts($number_of_posts, $category);
                ?>
                <!-- bs-posts-sec-inner -->
                <div class="bs-posts-sec-inner">
                    <!-- featured_cat_slider -->
                    <div class="featured_cat_slider bs swiper-container">
                        <div class="swiper-wrapper ">
                            <?php
                            if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                global $post;
                                $url = newsair_get_freatured_image_url($post->ID, 'newsair-medium'); ?>
                                <!-- item -->
                                <div class="swiper-slide">
                                    <!-- blog -->
                                    <div class="bs-blog-post bshre">
                                        <div class="bs-blog-thumb">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>"></a>
                                        </div>
                                        <article class="small">
                                            <?php newsair_post_categories(); ?>
                                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <?php newsair_post_meta(); ?>
                                        </article>
                                    </div>
                                    <!-- blog -->
                                </div>
                                <!-- // item -->
                            <?php
                            endwhile;
                            endif;
                            wp_reset_postdata(); ?>   
                            <input class="sld-dure" type="hidden" value="<?php echo $slider_duration; ?>" />
                            <input class="sld-slide" type="hidden" value="<?php echo $slide_to_show; ?>" />
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div> <!-- // featured_cat_slider -->
                </div> <!-- // bs-posts-sec-inner -->
            </div>
            <!-- // bs-posts-sec bs-posts-modul-3 --> 

            <?php
            //print_pre($all_posts);

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

            $categories = newsair_get_terms();
            
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsair_generate_text_input('newsair-posts-slider-title', __('Title', 'newsair'), 'Posts Slider');

                echo parent::newsair_generate_select_options('newsair-select-category', __('Select category', 'newsair'), $categories);

            }
        }
    }
endif;