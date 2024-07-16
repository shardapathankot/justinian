<?php
if (!class_exists('newsair_Design_Slider')) :
    /**
     * Adds newsair_Design_Slider widget.
     */
    class newsair_Design_Slider extends Newsair_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsair-posts-design-slider-title', 'newsair-excerpt-length');
            $this->select_fields = array('newsair-select-category');

            $widget_ops = array(
                'classname' => 'newsair_posts_design_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'newsair'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsair_design_slider', __('AR: 3 Column Posts Slider', 'newsair'), $widget_ops);
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
            $title = apply_filters('widget_title', $instance['newsair-posts-design-slider-title'], $instance, $this->id_base);
            $category = isset($instance['newsair-select-category']) ? $instance['newsair-select-category'] : 0;
            $number_of_posts = 5;
            $slider_duration = '3000';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="slider-widget mb-4<?php if (!empty($title)) { echo ' wd-back'; } ?> design-slider-widget">
                <?php if (!empty($title)): ?>
                <!-- bs-sec-title -->
                <div class="bs-widget-title">
                    <h4 class="title"><?php echo esc_html($title); ?></h4>
                </div>
                <!-- // bs-sec-title -->
                <?php endif; ?>
                <?php $all_posts = newsair_get_posts($number_of_posts, $category); ?>

                <div class="colmnthree bs swiper-container">

                    <div class="swiper-wrapper">
                    <!-- item -->
                    <?php if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                global $post;
                                $url = newsair_get_freatured_image_url($post->ID, 'newsair-slider-full'); ?>
                            <div class="swiper-slide">
                                <div class="bs-blog-post three lg back-img bshre" style="background-image: url('<?php echo esc_url($url); ?>');">
                                    <a class="link-div" href="<?php the_permalink(); ?>"></a>
                                    <div class="inner">
                                    <?php newsair_post_categories(); ?>
                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <?php newsair_post_meta(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            endif;
                            wp_reset_postdata(); ?>
                    </div>
                    <input class="sld-dure" type="hidden" value="<?php echo $slider_duration; ?>" />
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    
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
            $options = array(
                'true' => __('Yes', 'newsair'),
                'false' => __('No', 'newsair')

            );
            $categories = newsair_get_terms();

            if (isset($categories) && !empty($categories)) {
                
                echo parent::newsair_generate_text_input('newsair-posts-design-slider-title', __('Title', 'newsair'), 'Posts 3 Column Slider');

                echo parent::newsair_generate_select_options('newsair-select-category', __('Select category', 'newsair'), $categories);

            }
        }
    }
endif;