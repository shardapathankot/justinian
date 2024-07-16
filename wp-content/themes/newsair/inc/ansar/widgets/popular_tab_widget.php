<?php

class popular_tab_Widget extends  Newsair_Widget_Base
{
	/**
	 * Sets up a new widget instance.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{
		$this->text_fields = array('newsair-tabbed-popular-posts-title', 'newsair-tabbed-latest-posts-title', 'newsair-tabbed-categorised-posts-title', 'newsair-excerpt-length', 'newsair-posts-number');

		$this->select_fields = array('newsair-show-excerpt', 'newsair-enable-categorised-tab', 'newsair-select-category');

		$widget_options = array(
			'classname'   => 'popular_tab_Widget',
			'description' => __( 'Popular Tab', 'newsair' ),
		);
		parent::__construct( 'popular_tab_Widget', __( 'AR: Popular Tab', 'newsair' ), $widget_options );
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
		$tab_id = 'tabbed-' . $this->number;


		/** This filter is documented in wp-includes/default-widgets.php */

		$show_excerpt = 'false';
		$excerpt_length = '20';
		$number_of_posts =  '4';


		$popular_title = isset($instance['newsair-tabbed-popular-posts-title']) ? $instance['newsair-tabbed-popular-posts-title'] : __('Popular', 'newsair');
		$latest_title = isset($instance['newsair-tabbed-latest-posts-title']) ? $instance['newsair-tabbed-latest-posts-title'] : __('Latest', 'newsair');


		$enable_categorised_tab = isset($instance['newsair-enable-categorised-tab']) ? $instance['newsair-enable-categorised-tab'] : 'true';
		$categorised_title = isset($instance['newsair-tabbed-categorised-posts-title']) ? $instance['newsair-tabbed-categorised-posts-title'] : __('Trending', 'newsair');
		$category = isset($instance['newsair-select-category']) ? $instance['newsair-select-category'] : '0';


		// open the widget container
		echo $args['before_widget'];
		?>
		<!-- Popular Tab widget start-->

		<div class="tabarea-area wd-back">	
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-home" role="tab" aria-controls="home" aria-selected="true">
					<i class="fa fa-bolt me-1"></i>
					<?php echo esc_html($latest_title); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-profile" role="tab" aria-controls="profile" aria-selected="false">
					<i class="fa fa-fire me-1"></i><?php echo esc_html($popular_title); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-contact" role="tab" aria-controls="contact" aria-selected="false">
					<i class="fa fa-bolt me-1"></i>
					<?php echo esc_html($categorised_title); ?>
				</a>
			</li>
			</ul>
	

					<?php if ($enable_categorised_tab == 'true'): ?>
					
					<?php endif; ?>
				
			<!-- Start Tabs -->	
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="<?php echo esc_attr($tab_id); ?>-home" role="tabpanel" aria-labelledby="home-tab">
					<?php
					newsair_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);
					?>
				</div>
				<div class="tab-pane fade" id="<?php echo esc_attr($tab_id); ?>-profile" role="tabpanel" aria-labelledby="profile-tab">
					<?php
					newsair_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts);
					?>
				</div>
				<?php if ($enable_categorised_tab == 'true'): ?>
					<div class="tab-pane fade" id="<?php echo esc_attr($tab_id); ?>-contact" role="tabpanel" aria-labelledby="contact-tab">
						<?php
						newsair_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);
						?>
					</div>
				<?php endif; ?>
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
		$enable_categorised_tab = array(
			'true' => __('Yes', 'newsair'),
			'false' => __('No', 'newsair')

		);



		// generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
		?><h4><?php _e('Latest Posts', 'newsair'); ?></h4><?php
		echo parent::newsair_generate_text_input('newsair-tabbed-latest-posts-title', __('Title', 'newsair'), __('Latest', 'newsair'));

		?><h4><?php _e('Popular Posts', 'newsair'); ?></h4><?php
		echo parent::newsair_generate_text_input('newsair-tabbed-popular-posts-title', __('Title', 'newsair'), __('Popular', 'newsair'));

		$categories = newsair_get_terms();
		if (isset($categories) && !empty($categories)) {
			?><h4><?php _e('Categorised Posts', 'newsair'); ?></h4>
			<?php
			echo parent::newsair_generate_select_options('newsair-enable-categorised-tab', __('Enable Categorised Tab', 'newsair'), $enable_categorised_tab);
			echo parent::newsair_generate_text_input('newsair-tabbed-categorised-posts-title', __('Title', 'newsair'), __('Trending', 'newsair'));
			echo parent::newsair_generate_select_options('newsair-select-category', __('Select category', 'newsair'), $categories);

		}

	}
}