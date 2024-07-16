<?php
/**
 * The template for displaying editor choice section.
 *
 * @package Newsair
 */
if( is_active_sidebar('before_footer_widget_area')) { ?>
<!--Start Before Footer -->
<div class="col-md-12">
   <?php dynamic_sidebar( 'before_footer_widget_area' ); ?>
<!--/End Before footer -->
</div>
<?php } ?>