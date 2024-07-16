<?php

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen 
 * @since Twenty Fifteen 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
	<![endif]-->
	<script>
		(function() {
			document.documentElement.className = 'js'
		})();
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="header">
			<div id="logo"><a href="<?php echo esc_url(get_site_url()); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/master_transparent.gif" alt="logo" /></a></div>
			<div id="header-menu">
				<table>
					<tr>
						<td>
							<?php
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container'      => false,
								'menu_class'     => '',
								'fallback_cb'    => '__return_false',
							));
							?>
						</td>
						<!-- <td style="width:100px; vertical-align:middle; text-align:left">&nbsp;</td> -->
					</tr>
				</table>
			</div>
		</div>


		<div id="sidebar-1" class="sidebar-1">
			<header id="masthead" class="site-header" role="banner">
			</header><!-- .site-header -->
			<?php get_sidebar(); ?>
		</div><!-- .sidebar -->

		<?php //if ( is_active_sidebar( 'sidebar-2' ) && is_home() ) : 
		?>
		<div id="sidebar-2" class="sidebar-2">
			<?php dynamic_sidebar('sidebar-2'); ?>
			<!-- <div class="moduleContent">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/Button-Login.gif" alt="">
			</div>
			<div class="moduleContent	">
				<h2>Blow the whistle</h2>
			</div>
			<div class="moduleContent">
				<div class="caption">NEWS SNIPS ...</div>
				<hr>
				<p class="noicesText">
					This area does not yet contain any content.
				</p>
			</div>
			<div class="moduleContent">
				<div class="caption">JUSTINIAN'S BLOGGERS</div>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/bloggers_dink_230.gif" alt="">
				<p class="noicesText">
					<strong>News from Blighty</strong> ... Noises off render Assange hearing inaudible ...
					Image merchants throwing the copyright book at AI - Parliamentary Digital Committee reports ...
					Slow headway with costly plan to pack asylum seekers to spooky African regime ...
					<strong>Floyd Alexander-Hunt</strong> reports ... <a href="#!">Read more ...</a>
				</p>

			</div>
			<div class="moduleContent">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/category-flatulance-sml.gif" alt="">
				<blockquote>
					<p>"God created government and the fact that we have let it go into the possession of others is heartbreaking." </p>
				</blockquote>
				<p class="noicesText">
					<strong>Tom Parker, Chief Justice of the Alabama Supreme Court, who ruled that frozen embryos are people ...
						February 16, 2024 ...</strong> <a href="#!">Read more ...</a>
				</p>
			</div>
			<div class="moduleContent">
				<hr>
			</div>
			<div class="moduleContent">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/glj-logo.gif" alt="">
				<p class="noicesText">
					For the latest developments in media law …<a href="#!">www.glj.com.au </a>
				</p>
				<hr>

			</div>
			<div class="moduleContent">
				<div class="caption">JUSTINIAN FEATURETTES</div>	
				<p class="right_img">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/featurette_dink_150.gif" alt="">
				</p>
				<p class="noicesText">
					<strong>Veneto Verona Vino</strong> ... Know your Valpolicellas ...
					Justinian's wine correspondent let loose in the vineyards of Veneto ...
					Thomas Becket and Mozart get together ... The perfect drop with stew and polenta ...
					Lots going on in the mouth ... <strong>Gabriel Wendler</strong> gets back to Italy ... <a href="#!">Read more ...</a>
				</p>
				<hr>
			</div> -->
		</div><!-- .widget-area -->
		<?php // endif; 
		?>

		<div id="content" class="site-content">
			<div id="content-border">