<?php 
// Adding customizer layout manager settings
function newsair_slider_layout_manager_customizer( $wp_customize ){

	class WP_newsair_layout_Customize_Control extends WP_Customize_Control {	

		public $type = 'new_menu';
		
		public $id;

		public $data_id;

		public $data_default;
		// public $setting;
			
		public function enqueue(){
		
			wp_enqueue_style('custom_control_css', get_template_directory_uri().'/css/customizer-controls.css');
		
		}
		public function render_content() {
			
			$front_page = get_theme_mod($this->data_id, $this->data_default);
			$data_enable = explode(",",$front_page);	
			$defaultenableddata= $this->data_default;
			$layout_disable=array_diff($data_enable,$data_enable); ?>
			
			<h3><?php _e('Enable','newsair'); ?></h3>
			<ul class="sortable customizer_layout" id="enable">
				<?php if( !empty($data_enable[0]) )    { foreach( $data_enable as $value ){ ?>
					<li class="ui-state" id="<?php echo $value; ?>"><?php echo $value; ?></li>
				<?php } } ?>
			</ul>
	
			<h3><?php _e('Disable','newsair'); ?></h3> 
			<ul class="sortable customizer_layout" id="disable">
				<?php if(!empty($layout_disable)){ foreach($layout_disable as $val){ ?>
					<li class="ui-state" id="<?php echo $val; ?>"><?php echo $val; ?></li>
				<?php } } ?>
			</ul>

			<script>
			jQuery(document).ready(function($) {
				$( ".sortable" ).sortable({
					connectWith: '.sortable'
				});
			});
			
			jQuery(document).ready(function($){	
				
				// Get items id you can chose
				function themeansarItems(themeansar)
				{
					var columns = [];
					$(themeansar + ' #enable').each(function(){
						columns.push($(this).sortable('toArray').join(','));
					});
					return columns.join('|');
				}
				
				function themeansarItems_disable(themeansar)
				{
					var columns = [];
					$(themeansar + ' #disable').each(function(){
						columns.push($(this).sortable('toArray').join(','));
					});
					return columns.join('|');
				}
				
				//onclick check id
				$('#enable .ui-state,#disable .ui-state').mouseleave(function(){ 
					var enable = themeansarItems('#customize-control-<?php echo $this->id; ?>');
					$("#customize-control-<?php echo $this->data_id ?> input[type = 'text']").val(enable);
					$("#customize-control-<?php echo $this->data_id ?> input[type = 'text']").change();		
				});

			});
			</script>
		<?php } 
	} 
}
add_action( 'customize_register', 'newsair_slider_layout_manager_customizer' );