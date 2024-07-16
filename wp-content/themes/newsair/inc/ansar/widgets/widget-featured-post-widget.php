<?php

class featured_post_Widget extends WP_Widget {
	/**
	 * Widget constructor.
	 */
	function __construct() {
		$widget_options = array(
			'classname'   => 'featured_post_Widget',
			'description' => __( 'Featured Posts List', 'newsair' ),
		);
		parent::__construct( 'featured_post_Widget', __( 'Featured Posts List', 'newsair' ), $widget_options );
	
	}

	// Creating widget front-end
  
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$args =  array(
			'posts_per_page' => 5,
			'post_type' => array('post'),
			'post__not_in' => get_option('sticky_posts'),
			'cat' => $instance['cat'] // Insert category ID here
		);	
		$query = new WP_Query( $args );
		
		// before and after widget arguments are defined by themes
		echo isset($args['before_widget']) ? $args['before_widget'] :'';	
		

		?>
		
		<div class="featured-widget<?php if (!empty($title)) { echo ' wd-back'; } ?>">
		<?php if ( ! empty( $title ) ) { ?>
			<div class="bs-widget-title">
                <h4 class="title"><?php echo $title; ?></h4>
			</div>
			<?php } ?>
			 
				<div class="featured-widget-content col-grid-2">
			<?php if ( $query->have_posts() ) : //loop for custom query ?>
				<?php $i=1; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php 
					$postID = $query->post->ID;
					$featured_img_url = get_the_post_thumbnail_url($postID, 'full');  
					$author_id = get_post_field ('post_author', $postID);
					$display_name = get_the_author_meta( 'display_name' , $author_id );
					?>
					<?php if($i == 1){  ?>
					 	
						<div class="bs-blog-post three lg back-img bshre" style="background-image: url('<?php echo $featured_img_url; ?>');"> 
							<a href="<?php echo get_permalink($postID); ?>" class="link-div"></a>
							<div class="inner">
				                <?php newsair_post_categories(); ?>
				                <h4 class="title"><a title="<?php echo get_the_title( $postID ); ?>" href="<?php echo get_permalink($postID); ?>"><?php echo get_the_title( $postID ); ?></a></h4>
				                <div class="bs-blog-meta">
									<?php newsair_author_content(); ?>
									<?php newsair_date_content(); ?>
									<span class="comments-link"> <a href="#"><?php echo get_comments_number($postID); ?> Comments</a> </span>
				                </div>    
							</div>
			         	</div>
			         	<div class="small-content">
					<?php } else { ?>
						<div class="small-post">
							<div class="img-small-post back-img hlgr" style="background-image: url('<?php echo $featured_img_url; ?>');">
								<a href="<?php echo get_permalink($postID); ?>" class="link-div"></a>
							</div>
							<!-- // img-small-post -->
							<div class="small-post-content">
								<?php newsair_post_categories(); ?>
								<!-- small-post-content -->
								<h5 class="title"><a title="<?php echo get_the_title( $postID ); ?>" href="<?php echo get_permalink($postID); ?>"><?php echo get_the_title( $postID ); ?></a></h5>
								<!-- // title_small_post -->
								<div class="bs-blog-meta">
								<?php newsair_date_content(); ?>
								</div>
							</div>
							<!-- // small-post-content -->
						</div>
					<?php } ?>	
				<?php $i++; endwhile; ?>
			<?php 
				else :

				    echo "No Post Found";

				endif; ?>
				</div>
			</div>
        </div>
		<?php
		echo isset($args['after_widget']) ? $args['after_widget'] :'';
	}

	public function form( $instance ) {
		
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Featured Posts', 'newsair' );
		$cat = ! empty( $instance['cat'] ) ? $instance['cat'] : esc_html__( 'All', 'newsair' );
		
		// Widget admin form
		?>
		<p>
			 <label for="<?php echo $this->get_field_id( 'title'); ?>">Title</label>
			 <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label>
				<?php esc_html_e( 'Select Category', 'newsair' ); ?>:
				<?php
					wp_dropdown_categories(
						array(
							'show_option_all' => __( 'All categories', 'newsair' ),
							'hide_empty'      => 0,
							'name'            => $this->get_field_name( 'cat' ),
							'selected'        => $cat,
						)
					);
				?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		 $instance = $old_instance;
		 $instance['title'] = strip_tags( $new_instance['title'] );
		 $instance['cat'] = strip_tags( $new_instance['cat'] );
		
		 return $instance;           

	}


}

function featured_post_register_widget() {

 	register_widget( 'featured_post_Widget' );
  
}
add_action( 'widgets_init', 'featured_post_register_widget' );
?>
