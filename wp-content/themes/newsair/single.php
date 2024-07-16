<!-- =========================
  Page Breadcrumb   
============================== -->
<?php get_header(); ?>
<main id="content" class="single-class content">
<div class="container"> 
      <!--row-->
      <div class="row">
        <!--==================== breadcrumb section ====================-->
		  <?php do_action('newsair_breadcrumb_content'); ?>
        <!--col-md-->
        <?php $newsair_single_page_layout = get_theme_mod('newsair_single_page_layout','single-align-content-right');
              $newsair_single_post_tag = esc_attr(get_theme_mod('newsair_single_post_tag','true'));
            if($newsair_single_page_layout == "single-align-content-left") { ?>
        	<aside class="col-lg-3 sidebar-left">
            	<?php get_sidebar();?>
        	</aside>
        <?php } ?>
		<?php if($newsair_single_page_layout == "single-align-content-right"){ ?>
			<div class="col-lg-9 single content-right">
		<?php } elseif($newsair_single_page_layout == "single-align-content-left") { ?>
        	<div class="col-lg-9 single content-right">
		<?php } elseif($newsair_single_page_layout == "single-full-width-content") { ?>
			<div class="col-md-12">
    	<?php } ?>
          <?php if(have_posts())
            {
          while(have_posts()) { the_post(); ?>
            <div class="bs-blog-post single"> 
              <div class="bs-header">
                <?php $newsair_single_post_category = esc_attr(get_theme_mod('newsair_single_post_category','true'));
                      $newsair_single_post_date_format = esc_attr(get_theme_mod('newsair_single_post_date_format', 'default-date'));
                  if($newsair_single_post_category == true){ ?>
               
                      <?php newsair_post_categories(); ?>
                
                <?php } ?>
                <h1 class="title">
                  <?php the_title(); ?>
                </h1>

                <div class="bs-info-author-block">
                  <div class="bs-blog-meta mb-0">
                  <?php $newsair_single_post_admin_details = esc_attr(get_theme_mod('newsair_single_post_admin_details','true'));
                  if($newsair_single_post_admin_details == true){ ?>
                    <span class="bs-author"><a class="auth" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"> <?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?></a> <?php esc_html_e('By','newsair'); ?>
                      <a class="ms-1" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a>
                    </span>
                  <?php } 
                    $newsair_single_post_date = esc_attr(get_theme_mod('newsair_single_post_date','true'));
                    if($newsair_single_post_date == true){ ?>
                    <span class="bs-blog-date">
                      <?php if($newsair_single_post_date_format == 'default-date'){?>
                        <?php echo get_the_date('M'); ?> <?php echo get_the_date('j,'); ?> <?php echo get_the_date('Y'); ?>
                    <?php  }else{ ?>
                      <?php echo esc_html(get_the_time(get_option('date_format'), get_the_ID())); ?>
                    <?php  } ?>
                      </span>
                    <?php } ?>
                    <?php
                    $tag_list = get_the_tag_list();
                    $tags = get_the_tags();
                    if($newsair_single_post_tag == true){
                      if($tag_list){ ?>
                       <span class="newsair-tags tag-links">
                        <?php foreach ($tags as $tag) {
                          $tag_link = get_tag_link($tag->term_id);
                          echo '#<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a> ';
                        } ?>
                      </span>
                      <?php } } ?>
                  </div>
                </div>
              </div>
              <?php
              $single_show_featured_image = esc_attr(get_theme_mod('single_show_featured_image','true'));
              if($single_show_featured_image == true) {
                if(has_post_thumbnail()){
                echo '<a class="bs-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
                the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
                echo '</a>';
                  
                $thumbnail_id = get_post_thumbnail_id();
                $caption = get_post($thumbnail_id)->post_excerpt;

                  if (!empty($caption)) {
                    echo '<span class="featured-image-caption">' . esc_html($caption) . '</span>';
                  }
                } 
              } ?>
              <article class="small single">
                <div class="entry-content">
                  <?php the_content(); ?>
                  <?php newsair_edit_link(); ?>
                  <?php  newsair_social_share_post($post); ?>
                  <div class="clearfix mb-3"></div>
                  <?php
                  if(is_rtl()){
                    the_post_navigation(array( 
                    'prev_text' => '%title <div class="fa fa-angle-double-left"></div><span></span>',
                    'next_text' => '<div class="fa fa-angle-double-right"></div><span></span> %title', 
                    'in_same_term' => true,
                    ));
                  } else {
                    the_post_navigation(array(
                      'prev_text' => '<div class="fa fa-angle-double-left"></div><span></span> %title ',
                        'next_text' => ' %title <div class="fa fa-angle-double-right"></div><span></span>',
                        'in_same_term' => true,
                    ));
                  } 
                  wp_link_pages(array(
                  'before' => '<div class="single-nav-links">',
                  'after' => '</div>',
                  ));
                ?>
                </div>
              </article>
            </div>
          <?php }
            get_template_part('sections/single','author');

            get_template_part('sections/single','related');

            get_template_part('sections/single','comment');

        } ?>
      </div>
       <?php if($newsair_single_page_layout == "single-align-content-right") { ?>
      <!--sidebar-->
          <!--col-lg-3-->
            <aside class="col-lg-3 sidebar-right">
                  <?php get_sidebar();?>
            </aside>
          <!--/col-lg-3-->
      <!--/sidebar-->
      <?php } ?>
    </div>
    <!--/row-->
</div>
<!--/container-->
</main> 
<?php get_footer(); ?>