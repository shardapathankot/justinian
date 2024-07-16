<?php
if (!class_exists('newsair_Latest_Post')) :
    /**
     * Adds newsair_Latest_Post widget.
     */
    class newsair_Latest_Post extends Newsair_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsair-categorised-posts-title', 'newsair-posts-number');
            $this->select_fields = array('newsair-select-category');

            $widget_ops = array(
                'classname' => 'latstpost-widget hori',
                'description' => __('Displays posts from selected category in single column.', 'newsair'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsair_latest_post', __('AR: Latest News Post', 'newsair'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['newsair-categorised-posts-title'], $instance, $this->id_base);
            $category = isset($instance['newsair-select-category']) ? $instance['newsair-select-category'] : '0';
            $number_of_posts = isset($instance['newsair-posts-number']) ? $instance['newsair-posts-number'] : '5';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title) || !empty($subtitle)): ?>
             <!-- bs-posts-sec bs-posts-modul-6 -->
            <div class="latest-post-widget">
                <!-- bs-sec-title -->
                <div class="bs-widget-title">
                <?php if (!empty($title)): ?>
                    <h4 class="title"><?php echo esc_html($title); ?></h4>
                <?php endif; ?>
                </div>
                <!-- // bs-sec-title -->
                <?php endif; ?>
                <?php
                $all_posts = newsair_get_posts($number_of_posts, $category);
                ?>
                <!-- bs-posts-sec-inner -->
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post; ?>
                            <div class="bs-blog-post list-blog">  
                            <?php newsair_post_image_display_type($post); ?>
                            <article class="small">
                              <?php $newsair_global_category_enable = get_theme_mod('newsair_global_category_enable','true');
                                    if($newsair_global_category_enable == 'true') {
                                    newsair_post_categories(); } ?>
                                <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                <?php newsair_post_meta(); ?>
                                <?php newsair_posted_content(); wp_link_pages( ); 
                                    $newsair_readmore_excerpt=get_theme_mod('newsair_blog_content','excerpt');
                                    $read_more_title = get_theme_mod('newsair_post_read_more_title','Read More'); 
                                    $post_btn_disable = get_theme_mod('newsair_post_read_more_disable',true);
                                    if (  ($newsair_readmore_excerpt=="excerpt") && ($post_btn_disable == true) ){?>
                                    <p><a href="<?php the_permalink();?>" class="more-link"><?php echo esc_html($read_more_title); ?></a></p>
                                <?php } ?>
                               
                            </article>
                          </div>
                              
                    <?php endwhile; ?>
                <?php endif;
                wp_reset_postdata(); ?>
                 <!-- // bs-posts-sec-inner -->
            </div> <!-- // bs-posts-sec block_6 -->
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
           

            $categories = newsair_get_terms();
            $number_of_posts = isset($instance['newsair-posts-number']) ? $instance['newsair-posts-number'] : '5';
         
          

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsair_generate_text_input('newsair-categorised-posts-title', 'Title', 'Latest News');
                echo parent::newsair_generate_select_options('newsair-select-category', __('Select Category', 'newsair'), $categories);

                echo parent::newsair_generate_text_input('newsair-posts-number', __('Number of Post to Show', 'newsair'), $number_of_posts);

               
            }
            //print_pre($terms);


        }

    }
endif;