<?php
/**
 * Theme information BlogSon
 *
 * @package blogson
 */


if ( ! class_exists( 'BlogSon_About_Page' ) ) {
	/**
	 * Singleton class used for generating the about page of the theme.
	 */
	class BlogSon_About_Page {
		/**
		 * Define the version of the class.
		 *
		 * @var string $version The BlogSon_About_Page class version.
		 */
		private $version = '1.0.0';
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 *
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 *
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug ( theme folder name ).
		 *
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 *
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Holds the theme version.
		 *
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;		
		/**
		 * Define the html notification content displayed upon activation.
		 *
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of BlogSon_About_Page
		 *
		 * @var BlogSon_About_Page $instance The BlogSon_About_Page instance.
		 */
		private static $instance;
		/**
		 * The Main BlogSon_About_Page instance.
		 *
		 * We make sure that only one instance of BlogSon_About_Page exists in the memory at one time.
		 *
		 * @param array $config The configuration array.
		 */
		public static function blogson_init( $config ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof BlogSon_About_Page ) ) {
				self::$instance = new BlogSon_About_Page;				
				self::$instance->config = $config;
				self::$instance->blogson_setup_config();	
			}
		}

		/**
		 * Setup the class props based on the config array.
		 */
		public function blogson_setup_config() {
			$theme = wp_get_theme();
			if ( is_child_theme() ) {
				$this->theme_name = $theme->parent()->get( 'Name' );
				$this->theme      = $theme->parent();
			} else {
				$this->theme_name = $theme->get( 'Name' );
				$this->theme      = $theme->parent();
			}
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug    = $theme->get_template();			
				
		}	
		

	}
}


/**
 *  Adding a About page 
 */
add_action('admin_menu', 'blogson_add_menu');

function blogson_add_menu() {
     add_theme_page(esc_html__('About BlogSon Theme','blogson'), esc_html__('BlogSon Info','blogson'),'manage_options', esc_html__('blogson-theme-info','blogson'), esc_html__('blogson_theme_info','blogson'));
}

/**
 *  Callback
 */
function blogson_theme_info() {
?>
	<div class="theme-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h2><?php esc_html_e( 'Thank you for using BlogSon Free WordPress theme', 'blogson' ); ?></h2>
						<div class="title-content">
							<p><?php esc_html_e( 'Are you looking for a WordPress theme to easily customize all aspects of your website? Look no further than BlogSon WordPress Theme and Elementor Page Builder. This powerful combination allows users to easily customize the fundamental elements of their WordPress website with no coding needed. BlogSon is an attractive and modern theme, allowing users to create beautiful websites in minutes. It features a mobile-friendly design, responsive layout, easy customization options, unlimited color schemes, a large collection of fonts and much more. With Elementor Page Builder users can quickly design stunning pages that look professional. Users have full control over what content is displayed where on their site as well as being able to create custom landing pages with ease. All this without writing any code!', 'blogson' ); ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-visibility"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW DEMO', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-format-aside"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_DOC_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW DOCUMENTATION', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-video-alt2"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_VIDEOS_URL); ?>" target="_blank"><?php esc_html_e( 'VIDEO TUTORIALS', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-sos"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_SUPPORT_URL); ?>" target="_blank"><?php esc_html_e( 'ASK FOR SUPPORT', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
			
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-star-filled"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_RATINGS_URL); ?>" target="_blank"><?php esc_html_e( 'RATE OUR THEME', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
				<div class="col-md-2">
					<div class="section-box">
						<div class="icon">
							<span class="dashicons dashicons-admin-tools"></span>
						</div>
						<div class="heading">
							<h3><a href="<?php echo esc_url(BLOGSON_THEME_CHANGELOGS_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW CHANGELOGS', 'blogson' ); ?></a></h3>
						</div>						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="comp-box">
						<center><h2 class="table-heading"><?php esc_html_e( 'Why should you Upgrade to our PRO Addon ?', 'blogson' ); ?></h2></center>
						<div class="comp-table">
							<table>
								<thead> 
									<tr> 
									 	<td class="thead-column1"><strong><h4><?php esc_html_e( 'Feature', 'blogson' ); ?></h4></strong></td>
										<td class="thead-column2"><strong><h4><?php esc_html_e( 'BlogSon Free', 'blogson' ); ?></h4></strong></td>
										<td class="thead-column3"><strong><h4><?php esc_html_e( 'Pro Addon Plugin', 'blogson' ); ?></h4></strong></td>
									</tr> 
								</thead>
								<tbody>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Favicon, Logo, Title and Tagline Customization', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Customizer Theme Options', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Post Category Widgets', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( '2 & 3 Columns Layout', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Highlight Boxes', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Preloader', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Responsive Design', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Sidebar Options (Full, Left and Right)', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( '1 Click Demo Import', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Gutenberg Compatible', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Color Settings', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Light and Dark Mode', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( '800+ Google Fonts', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Social Sharing Icons', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Author Details in Single Post', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Author Widget with Social Icons', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'WooCommerce Settings', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Sticky Header', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Breadcrumb Display', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Related Posts', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( '3 Posts Slider', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'MailChimp Newsletter Integration', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Footer Columns Widgets', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Popular Posts Widget', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Extra PRO Demos', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr>
									<tr> 
					 					<td class="tbody-column1"><?php esc_html_e( 'Priority Support', 'blogson' ); ?></td>
					 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
					 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
									</tr> 
									<tr class="last-row"> 
					 					<td class="tbody-column1"></td>
					 					<td class="tbody-column2"></td>
					 					<td class="tbody-column3"><a class="button button-primary button-large" href="https://www.spiraclethemes.com/blogson-pro-addons/" target="_blank"><?php esc_html_e( 'Upgrade to PRO', 'blogson' ); ?></a></td>
									</tr> 
				   				</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<div class="review-content">
							<p><?php esc_html_e( ' Please ', 'blogson' )  ?><a href="<?php echo esc_url(BLOGSON_THEME_RATINGS_URL); ?>" target="_blank"><?php esc_html_e( 'rate our theme', 'blogson' ); ?></a>
							<?php esc_html_e( '★★★★★ to help us spread the word. Thank you from the Spiracle Themes team!', 'blogson' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
<?php
}
