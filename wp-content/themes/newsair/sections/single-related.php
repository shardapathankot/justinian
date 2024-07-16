<?php 
$newsair_enable_related_post = esc_attr(get_theme_mod('newsair_enable_related_post','true'));
$newsair_enable_single_post_category = get_theme_mod('newsair_enable_single_post_category','true');
$newsair_enable_single_post_date = get_theme_mod('newsair_enable_single_post_date','true');
$newsair_enable_single_post_admin_details = get_theme_mod('newsair_enable_single_post_admin_details','true');
$newsair_related_post_title = get_theme_mod('newsair_related_post_title', 'Related Post');

if($newsair_enable_related_post == true){ ?>
    <div class="single-related-post py-4 px-3 mb-4 bs-card-box ">
        <!--Start bs-realated-slider -->
        <div class="bs-widget-title mb-3">
            <!-- bs-sec-title -->
            <h4 class="title"><?php echo esc_html($newsair_related_post_title);?></h4>
        </div>
        <!-- // bs-sec-title -->
        <div class="row">
            <!-- featured_post -->
            <?php global $post;
            $categories = get_the_category($post->ID);
            $number_of_related_posts = 3; 
                if ($categories) {
                    $cat_ids = array();
                        foreach ($categories as $category) $cat_ids[] = $category->term_id;
                        $args = array(
                            'category__in' => $cat_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                            'ignore_sticky_posts' => 1
                        );
                        $related_posts = new wp_query($args);
                        while ($related_posts->have_posts()) {
                            $related_posts->the_post();
                            global $post;
                            $url = newsair_get_freatured_image_url($post->ID, 'newsair-featured');
                            ?>
                            <!-- blog -->
                            <div class="col-md-4">
                                <div class="bs-blog-post three md back-img bshre mb-md-0" <?php if(has_post_thumbnail()) { ?> style="background-image: url('<?php echo esc_url($url); ?>');" <?php } ?>>
                                    <a class="link-div" href="<?php the_permalink(); ?>"></a>
                                    <div class="inner">
                                        <?php if($newsair_enable_single_post_category == true) { 
                                            newsair_post_categories();
                                        } 
                                        $newsair_enable_single_post_admin_details = esc_attr(get_theme_mod('newsair_enable_single_post_admin_details','true')); ?>
                                        <h4 class="title sm mb-0">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>">
                                            <?php the_title(); ?>
                                            </a>
                                        </h4> 
                                        <div class="bs-blog-meta">
                                            <?php if($newsair_enable_single_post_admin_details == true){  newsair_author_content(); } ?>
                                            <?php if($newsair_enable_single_post_date == true) { ?>
                                                <span class="bs-blog-date"> <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"> <?php echo esc_html(get_the_date('M j, Y')); ?></a></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- blog -->
                        <?php }
                }
                wp_reset_postdata();
                ?>
        </div>        
    </div>
    <!--End bs-realated-slider -->
<?php }