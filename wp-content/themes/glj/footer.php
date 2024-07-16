<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

</div><!-- #content-border -->
<br />

</div><!-- .site-content -->

</div><!-- .site -->
<footer id="colophon" class="site-footer" role="contentinfo" style="clear:both;text-align:center;margin:auto">
<hr>
<br>
	<div class="site-info">
		<p>COPYRIGHT © 2024, LAW PRESS OF AUSTRALIA.</p>
		<a href="<?php site_url(); ?>">FRONT PAGE</a> |
		<a href="<?php echo site_url().'/news/'?>">NEWS</a> |
		<a href="<?php echo site_url().'/columnists/'?>">COLUMNISTS</a> |
		<a href="<?php echo site_url().'/bloggers/'?>">BLOGGERS</a>|
		<a href="<?php echo site_url().'/featurettes/'?>">FEATURETTES</a> |
		<a href="<?php echo site_url().'/archive/'?>">ARCHIVE</a> |
		<a href="<?php echo site_url().'/membership-account/membership-levels/'?>">SUBSCRIBE</a>
	</div><!-- .site-info -->

	<div class="site-info">
		<a href="<?php echo site_url().'/terms-and-conditions/'?>">TERMS & CONDITIONS</a> |
		<a href="https://fonts.adobe.com/colophons/fod3cwr?ref=tk.com">JUSTINIAN TYPEFACES</a> |
		<a href="<?php echo site_url().'/feedback/'?>">FEEDBACK</a>
		<br /><br />@JUSTINIANNEWS<br />

	</div><!-- .site-info -->
</footer><!-- .site-footer -->
<?php wp_footer(); ?>


</body>

</html>