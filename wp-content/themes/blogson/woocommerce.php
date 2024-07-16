<?php
/**
 * @package blogson
 */

get_header();
blogson_before_title();
blogson_after_title();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    	<div class="content-inner">
    		<div class="page-content-area">
		        <?php
		            get_template_part( 'template-parts/shop/content', 'woocommerce' );           
		        ?>
	    	</div>
	    </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
	get_footer();
?>