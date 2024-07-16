<?php
/**
 * Template part for displaying header menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogson
 */

?>

<?php
	$page_val = is_front_page() ? 'home' : 'page' ;
?>
<header id="<?php echo esc_attr($page_val); ?>-inner" class="elementor-menu-anchor theme-menu-wrapper full-width-menu style1 page" role="banner">
	<?php
		if(true===get_theme_mod('blogson_enable_highlight_area',true) && is_front_page()) {
			?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogson' ); ?></a><?php
		}
		else{
			?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'blogson' ); ?></a><?php
		}
	?>
	<div id="header-main" class="header-wrapper">
		<div class="logo">
			<div class="container">
       			<?php 
       				if (has_custom_logo()){
	                	blogson_custom_logo();
	                }	                		                	
                ?>
                <?php 
                    $alt_logo=esc_url(get_theme_mod( 'blogson_sticky_logo' ));
                	if(!empty($alt_logo)) {
	                	?>
	                		<a id="logo-alt" class="logo-alt" href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo esc_url( get_theme_mod( 'blogson_sticky_logo' ) ); ?>" alt="logo"></a>
	                	<?php
	                }		                
	            ?>
	            <?php
	                $show_title   = ( true === get_theme_mod( 'blogson_display_site_title_tagline', true ) );
					$header_class = $show_title ? 'site-title' : 'screen-reader-text';
					if(!empty(get_bloginfo( 'name' ))) {
						if ( is_front_page() || is_home() ) {
					        ?>
	                			<h1 class="<?php echo esc_attr( $header_class ); ?>">
							        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
							    </h1>

							<?php

							if(true === get_theme_mod( 'blogson_display_site_title_tagline', true )) {
								$description = esc_html(get_bloginfo( 'description', 'display' ));
						        if ( $description || is_customize_preview() ) { 
						            ?>
						                <p class="site-description"><?php echo $description; ?></p>
						            <?php 
						        }
							}
						}
						else {
							?>
								<p class="<?php echo esc_attr( $header_class ); ?>">
							        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
							    </p>
							<?php

							if(true === get_theme_mod( 'blogson_display_site_title_tagline', true )) {
								$description = esc_html(get_bloginfo( 'description', 'display' ));
						        if ( $description || is_customize_preview() ) { 
						            ?>
						                <p class="site-description"><?php echo $description; ?></p>
						            <?php 
						        }
							}
						}
					}
                ?>
			</div>
		</div>
		<div class="top-menu-wrapper">
			<div class="container">
				<div class="menu-sidebar">
					<?php
						if(true===get_theme_mod('blogson_enable_menu_left_sidebar',false)) :
							?>
								<ul class="menu-left-modal">
									<li>
										<label class="modal-left" data-toggle="modal" data-target="#pmModal">
			    							<span class="sr-only"></span>
									      	<span class="icon-bar"></span>
									       	<span class="icon-bar"></span>
									       	<span class="icon-bar"></span>
		    							</label>
		    						</li>
	    						</ul>
							<?php
						endif;
					?>
				</div>
				<nav class="top-menu" role="navigation" aria-label="<?php esc_attr_e( 'primary', 'blogson' ); ?>">
					<div class="menu-header">
						<span><?php esc_html_e('MENU','blogson'); ?> </span>
				     	<button type="button" class="hd-bar-opener navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
					       	<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'blogson' ); ?></span>
					      	<span class="icon-bar"></span>
					       	<span class="icon-bar"></span>
					       	<span class="icon-bar"></span>
				     	</button>
				   	</div>
					<div class="navbar-collapse collapse clearfix" id="navbar-collapse-1">
				   		<?php
			                wp_nav_menu( array(			                  	
			                  	'theme_location'    => 'primary',
			                  	'depth'             => 3,
			                  	'container'         => 'ul',
			                  	'container_class'   => 'navigation',
			                  	'container_id'      => 'menu-primary',
			                  	'menu_class'        => 'navigation',
			                  	)
			                );
		             	?>							
				   	</div>
				</nav>
			</div>
        </div>
    </div>
</header>

<?php
	if(true===get_theme_mod('blogson_enable_menu_left_sidebar',false)) {
		/**
        * Hook - blogson_action_left_modal_content
        *
        * @hooked blogson_left_modal_content - 10
        */
        do_action( 'blogson_action_left_modal_content' );
	}
?>

<!-- Side Bar -->
<section id="hd-left-bar" class="hd-bar left-align mCustomScrollbar" data-mcs-theme="dark">
    <div class="hd-bar-closer">
        <button><span class="qb-close-button"></span></button>
    </div>
    <div class="hd-bar-wrapper">
        <div class="side-menu">
        	<?php
		    	/**
		        * Hook - blogson_action_search_content
		        *
		        * @hooked blogson_search_content - 10
		        */
		        do_action( 'blogson_action_search_content' );
		    ?>
        	<nav role="navigation">
	            <div class="side-navigation clearfix" id="navbar-collapse-2">
			   		<?php
		                wp_nav_menu( array(			                  	
		                  	'theme_location'    => 'primary',
		                  	'depth'             => 3,
		                  	'container'         => 'ul',
		                  	'container_class'   => 'navigation',
		                  	'container_id'      => 'menu-primary-mobile',
		                  	'menu_class'        => 'navigation',
		                  	)
		                );
	             	?>							
			   	</div>
			</nav>
        </div>
    </div>
</section>

<div class="clearfix"></div>
<div id="content" class="elementor-menu-anchor"></div>

<?php
	if(true===get_theme_mod('blogson_enable_highlight_area',true)) {
		/**
	    * Hook - blogson_action_highlight_area
	    *
	    * @hooked blogson_highlight_area - 10
	    */
	    do_action( 'blogson_action_highlight_area' );
	}
?>
<div class="content-wrap">
	<div class="container">