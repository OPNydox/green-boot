<?php 

if( ! function_exists( 'road_get_slider_setting' ) ) {
	function road_get_slider_setting() {
		$status_opt = array(
			'',
			__( 'Yes', 'lukani' ) => true,
			__( 'No', 'lukani' ) => false,
		);
		
		$effect_opt = array(
			'',
			__( 'Fade', 'lukani' ) => 'fade',
			__( 'Slide', 'lukani' ) => 'slide',
		);
	 
		return array( 
			array(
				'type' => 'checkbox',
				'heading' => __( 'Enable slider', 'lukani' ),
				'param_name' => 'enable_slider',
				'value' => true,
				'save_always' => true, 
				'group' => __( 'Slider Options', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items Large Screen', 'lukani' ),
				'param_name' => 'item_large',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 6,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items Default', 'lukani' ),
				'param_name' => 'items',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 5,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Desktop', 'lukani' ),
				'param_name' => 'item_desktop',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 4,
			), 
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Small', 'lukani' ),
				'param_name' => 'item_small',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 3,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Tablet', 'lukani' ),
				'param_name' => 'item_tablet',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 2,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Mobile', 'lukani' ),
				'param_name' => 'item_mobile',
				'group' => __( 'Slider Options', 'lukani' ),
				'value' => 1,
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Navigation', 'lukani' ),
				'param_name' => 'navigation',
				'value' => $status_opt,
				'save_always' => true,
				'group' => __( 'Slider Options', 'lukani' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Pagination', 'lukani' ),
				'param_name' => 'pagination',
				'value' => $status_opt,
				'save_always' => true,
				'group' => __( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Speed sider', 'lukani' ),
				'param_name' => 'speed',
				'value' => '500',
				'save_always' => true,
				'group' => __( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Slider Auto', 'lukani' ),
				'param_name' => 'auto',
				'value' => false, 
				'group' => __( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Slider loop', 'lukani' ),
				'param_name' => 'loop',
				'value' => false, 
				'group' => __( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Slider center', 'lukani' ),
				'param_name' => 'center',
				'value' => false, 
				'dependency' => array(
				    'element' => 'loop',
				    'value' => array ('true'),
				    'not_empty' => true,
				),
				'group' => __( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Effects', 'lukani' ),
				'param_name' => 'effect',
				'value' => $effect_opt,
				'save_always' => true,
				'group' => __( 'Slider Options', 'lukani' )
			), 
		);
	}
}