<?php
if (!class_exists('Newsair_Posts_List')) :
    /**
     * Adds Newsair_Posts_List widget.
     */
    class Newsair_Posts_List extends Newsair_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsair-categorised-posts-title','newsair-posts-number');
            $this->select_fields = array('newsair-select-category', 'newsair-select-column');

            $widget_ops = array(
                'classname' => 'bs-posts-sec bs-posts-modul-2',
                'description' => __('Displays posts from selected category in a list.', 'newsair'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsair_posts_list', __('AR: Posts List', 'newsair'), $widget_ops);
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
            $number_of_posts = 10;
            $column = 6;


            // open the widget container
            echo $args['before_widget'];
            ?>
        <div class="small-post-list-widget wd-back">

            <?php if (!empty($title)): ?> 
                <div class="bs-widget-title">
                <!-- bs-sec-title -->
                <h4 class="title"><?php echo esc_html($title); ?></h4>
                </div>
            <?php endif; ?>

            <div class="small-post-list-inner col-grid-2">
                <?php $all_posts = newsair_get_posts($number_of_posts, $category);
                    $count = 1;
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                        global $post;
                        $url = newsair_get_freatured_image_url($post->ID, 'thumbnail');
                        
                        ?>
                            <!-- small-list-post -->
                            <div class="small-post">
                                <?php if($url) { ?>   
                                <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo esc_url($url); ?>');">
                                <a href="<?php the_permalink(); ?>" class="link-div"></a>
                                </div><?php } ?>
                                <!-- // img-small-post -->
                                <div class="small-post-content">
                                <?php newsair_post_categories(); ?>
                                <!-- small-post-content -->
                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="bs-blog-meta">
                                    <span class="bs-blog-date"><?php echo get_the_date( 'M j , Y' ); ?></span>
                                </div>
                                </div>
                            <!-- // small-post-content -->
                            </div>                            
                            <?php
                            $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
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

            $number_of_posts = isset($instance['newsair-posts-number']) ? $instance['newsair-posts-number'] : 10;

            $categories = newsair_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsair_generate_text_input('newsair-categorised-posts-title', __('Title', 'newsair'), __('Posts List', 'newsair'));

                echo parent::newsair_generate_select_options('newsair-select-category', __('Select category', 'newsair'), $categories); 

            }

            //print_pre($terms);


        }

    }
endif;