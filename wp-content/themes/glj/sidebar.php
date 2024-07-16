<?php

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

if (has_nav_menu('primary') || has_nav_menu('social') || is_active_sidebar('sidebar-1')) : ?>
	<div id="secondary" class="secondary">
		<!-- <div class="moduleContent">
			<div class="caption">SEARCH</div>
			<p class="noicesText">
				This area does not yet contain any content.
			</p>
			<div id="" class="widget-area" role="complementary">
				<aside id="" class="widget widget_block widget_search">
					<form role="search" method="get" action="" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
						<div class="wp-block-search__inside-wrapper  ">
							<input class="wp-block-search__input" id="" placeholder="" value="" type="search" name="s" required="">
							<button aria-label="Search" class="wp-block-search__button wp-element-button" type="submit">Search</button>
						</div>
					</form>
				</aside>
			</div>
		</div>
		<div class="moduleContent">
			<div class="caption">JUSTINIAN NEWS</div>
			<img style="width: 125px;" src="<?php //echo esc_url(get_template_directory_uri()); ?>/img/News_dink_130+copy.gif" alt="">
			<p class="noicesText">
				<strong>Secret corners of the law</strong> ... Lay associate ... Back in the game ...Serious criminal priors ...
				Embarrassment ... Law Society sits on its hands ... Conditions attached ...
				Identity suppressed ... All is forgiven ... Thank you ball-boys, thank you NCAT ... <a href="#!">Read more ...</a>
			</p>

		</div>
		<div class="moduleContent">
			<div class="caption">POLITICS MEDIA LAW SOCIETY</div>
			<img src="<?php //echo esc_url(get_template_directory_uri()); ?>/img/500_Mast_220.gif" alt="">
			<p class="noicesText">
				<strong>Gaza stripped</strong> ... Doxxing and its exceptions … Bombing underway – no complaints, please …
				Cancellations through the roof … Never be negative about a useful war …
				Edicts to bend news reporting … Uday Murdoch on the spot … Apartheid apparatus goes rogue ...
				<a href="#!">Read on ...</a>
			</p>

		</div>
		<div class="moduleContent moduleContent_left">
			<div class="caption">EDITOR'S CHOICE</div>
			<div class="article">
				Articles, Opinions, Notions & Cases
			</div>
			<ul>
				<li>
					<div class="title">
						<a href="#!">The Australian</a>
					</div>
					<div class="descriptiopn">
						Following criticism from judges the NSW DPP Sally Dowling warns prosecutors about bringing "meritless" rape cases
					</div>
				</li>
				<li>
					<div class="title">
						<a href="#!">The Washington Post</a>
					</div>
					<div class="descriptiopn">
						Supreme Court aids Trump's bid for his January 6 prosecution to be held after the 2024 election
					</div>
				</li>
				<li>
					<div class="title">
						<a href="#!">The New Yorker</a>
					</div>
					<div class="descriptiopn">
						A fresh scandal envelops Clarence Thomas ... Racist texts from his new law clerk ... And an implausible excuse
					</div>
				</li>
				<li>
					<div class="title">
						<a href="#!">The Australian</a>
					</div>
					<div class="descriptiopn">
						Victorian DPP Kerri Judd launches another judicial complaint ... This time it's County Court judge Geoff Chettle
					</div>
				</li>
				<li>
					<div class="title">
						<a href="#!">The New York Times</a>
					</div>
					<div class="descriptiopn">
						Large law firms shedding space even as they expand ... Remote working has taken a foothold
					</div>
				</li>
			</ul>
			<hr>
		</div>
		<div class="moduleContent news_letter">
			<div class="caption">FREE NEWSLETTER</div>
			<div id="" class="widget-area" role="complementary">
				<aside id="" class="widget widget_block widget_search">
					<form role="search" method="get" action="" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
						<div class="wp-block-search__inside-wrapper  ">
							<input class="wp-block-search__input" id="" placeholder="email address" value="" type="search" name="s" required="">
							<button aria-label="Search" class="wp-block-search__button wp-element-button" type="submit">subscribe</button>
						</div>
					</form>
				</aside>
			</div>
		</div>
		<div class="moduleContent">
			<div class="caption">JUSTINIAN COLUMNISTS</div>
			<img src="<?php //echo esc_url(get_template_directory_uri()); ?>/img/columnists_new_dink_230.gif" alt="">
			<p class="noicesText">
				<strong>Danger ahead - falling rocks</strong> ... Voting in America ... Gerrymanders and voter suppression
				give Republicans a whopping advantage ... The 14th amendment and its possibilities ...
				The post-Civil War reconstruction amendments ... Trump and the suspension of the Constitution ...
				Our Man in Washington <strong>Roger Fitch</strong> explains ...
				<a href="#!">Read more ...</a>
			</p>

		</div> -->
		<?php if (has_nav_menu('social')) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
				// Social links navigation menu.
				wp_nav_menu(array(
					'theme_location' => 'social',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				));
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<?php if (is_active_sidebar('sidebar-1')) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div><!-- .secondary -->

<?php endif; ?>