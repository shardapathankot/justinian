<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) ) {
class Responsive_slider_control extends WP_Customize_Control {
		

	public $type = 'custom-slider-control';

	public $is_responsive = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	public function enqueue(){

	  wp_enqueue_style('responsive_slider_control_css', get_template_directory_uri().'/inc/ansar/custom-control/responsive_slider_control/css/responsive_slider_control.css','4.0.13', 'all');
   
      wp_enqueue_style('','','4.0.13', 'all');
   

   
      wp_enqueue_script( 'responsive_slider_control_js', get_template_directory_uri().'/inc/ansar/custom-control/responsive_slider_control/js/responsive_slider_control.js', array('jquery'), false, true );


	}

	public function render_content() {


		$desktop_default = $this->settings['desktop_input']->default;

		$responsive = '';
		if ( $this->is_responsive == true ) {
			$responsive = 'responsive';
			$tablet_default = $this->settings['tablet_input']->default;
        	$mobile_default = $this->settings['mobile_input']->default;
		}else{
			$responsive = 'noresponsive';
		}

		
	?>

	<div class = "maincls responsive-range-control">	


	<div class="device-heading">				
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if ( $this->is_responsive ) : ?>
		<ul class="select-devices-preview">
			<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
			<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
			<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
		</ul>
		<?php endif; ?>
	</div>

	<div class="responsive_slider <?php echo esc_attr( $responsive ); ?>-desktop-slider active ">
	
		<div class="slide-control">
			
			<input <?php $this->input_attrs(); ?> id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value('desktop_input') ); ?>" <?php $this->link('desktop_input'); ?> type="range"  min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"  class="slider" id="myRange">
			
			<input type="number" class="number-in"  name="quantity" value="<?php echo esc_attr( $this->value('desktop_input') ); ?>" <?php $this->link('desktop_input'); ?> type="range"  min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $this->input_attrs['step'] ); ?>" >	
			
			<input class="unit-class" type="button" value="PX" >
			
		</div>
		<p class="reset-default" reset-value="<?php echo esc_attr( $desktop_default ); ?>"><i class="fas fa-sync"></i></p>	
	</div>
	<?php if ( $this->is_responsive ) : ?>
	<div class="responsive_slider <?php echo esc_attr( $responsive ); ?>-tablet-slider ">

		<div class="slide-control">

		<input <?php $this->input_attrs(); ?> id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value('tablet_input') ); ?>" <?php $this->link('tablet_input'); ?> type="range" min="0" max="300" step="1" class="slider" id="myRange">

		<input type="number" class="number-in" style="  " name="quantity" min="0" max="300" step="1" value="1" >	

		<input class="unit-class" type="button" value="PX" style="">

		</div>
		<p class="reset-default" reset-value="<?php echo esc_attr( $tablet_default ); ?>"><i class="fas fa-sync"></i></p>	
	</div>

	<div class="responsive_slider <?php echo esc_attr( $responsive ); ?>-mobile-slider ">

		<div class="slide-control">

		<input <?php $this->input_attrs(); ?> id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value('mobile_input') ); ?>" <?php $this->link('mobile_input'); ?> type="range" min="0" max="300" step="1" class="slider" id="myRange">

		<input type="number" class="number-in"  name="quantity" min="0" max="300" step="1" value="1" >	

		<input class="unit-class" type="button" value="PX">

		</div>
		<p class="reset-default" reset-value="<?php echo esc_attr( $mobile_default ); ?>"><i class="fas fa-sync"></i></p>	
	</div>

	<?php endif; ?>	

	</div>
	
	<?php
	}
}

}
