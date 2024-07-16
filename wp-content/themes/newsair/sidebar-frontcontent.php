<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newsair
 */
if ( ! is_active_sidebar( 'front-page-content' ) ) {
	return;
}
$rtActive = is_active_sidebar('front-right-page-sidebar');
$ltActive = is_active_sidebar('front-left-page-sidebar');
?>
<div class="<?php if($ltActive && $rtActive){ echo 'col-lg-6'; }

elseif(!$rtActive && !$ltActive) {
  
  echo 'col-lg-12';

}

if(!$rtActive && $ltActive)
{
	echo 'col-lg-8';
}

if($rtActive && !$ltActive)
{
	echo 'col-lg-8';
}

?>">
	<?php dynamic_sidebar( 'front-page-content' ); ?>
</div>