<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Custom_Tab_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'custom-tab-control';

	public $controls_general;

	public $controls_design;

	public $controls_custom;

	public $controls_layout;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	public function enqueue(){

	wp_enqueue_style('custom_tab_control_css', get_template_directory_uri().'/inc/ansar/custom-control/custom_tab_control/css/custom_tab_control.css','4.0.13', 'all');
   
  	wp_enqueue_script( 'custom_tab_control_js', get_template_directory_uri().'/inc/ansar/custom-control/custom_tab_control/js/custom_tab_control.js', array('jquery'), false, true );

	}

	public function render_content() { ?>

		<div class="control-tabs">
		<?php if($this->controls_general != false || $this->controls_general != '' ) { ?>
			<div class="control-tab control-tab-general active" data-connected="<?php echo esc_attr( $this->controls_general ); ?>"><?php echo esc_html__( 'General','newsair' ); ?>
			</div>
		<?php } ?>	
		<?php if($this->controls_design != false  || $this->controls_design != '') { ?>
			<div class="control-tab control-tab-design" data-connected="<?php echo esc_attr( $this->controls_design ); ?>"><?php echo esc_html__( 'Style','newsair'); ?>
			</div>
		<?php } ?>	
		<?php if($this->controls_custom != false  || $this->controls_custom != '') { ?>
			<div class="control-tab control-tab-custom" data-connected="<?php echo esc_attr( $this->controls_custom ); ?>"><?php echo esc_html__( 'Sharing Icon','newsair'); ?>
			</div>
		<?php } ?>	
		<?php if($this->controls_layout != false  || $this->controls_layout != '') { ?>
			<div class="control-tab control-tab-layout" data-connected="<?php echo esc_attr( $this->controls_layout ); ?>"><?php echo esc_html__( 'Layout','newsair'); ?>
			</div>
		<?php } ?>
		</div>
		<?php
	}
}
