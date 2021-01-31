<?php

if( ! function_exists( 'lukani_get_slider_setting' ) ) {
	function lukani_get_slider_setting() {
		$status_opt = array(
			'',
			esc_html__( 'Yes', 'lukani' ) => true,
			esc_html__( 'No', 'lukani' ) => false,
		);
		
		$effect_opt = array(
			'',
			esc_html__( 'Fade', 'lukani' ) => 'fade',
			esc_html__( 'Slide', 'lukani' ) => 'slide',
		);
	 
		return array( 
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Enable slider', 'lukani' ),
				'param_name' => 'enable_slider',
				'value' => true,
				'save_always' => true, 
				'group' => esc_html__( 'Slider Options', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Items Default', 'lukani' ),
				'param_name' => 'items',
				'group' => esc_html__( 'Slider Options', 'lukani' ),
				'value' => 5,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item Desktop', 'lukani' ),
				'param_name' => 'item_desktop',
				'group' => esc_html__( 'Slider Options', 'lukani' ),
				'value' => 4,
			), 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item Small', 'lukani' ),
				'param_name' => 'item_small',
				'group' => esc_html__( 'Slider Options', 'lukani' ),
				'value' => 3,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item Tablet', 'lukani' ),
				'param_name' => 'item_tablet',
				'group' => esc_html__( 'Slider Options', 'lukani' ),
				'value' => 2,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item Mobile', 'lukani' ),
				'param_name' => 'item_mobile',
				'group' => esc_html__( 'Slider Options', 'lukani' ),
				'value' => 1,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation', 'lukani' ),
				'param_name' => 'navigation',
				'value' => $status_opt,
				'save_always' => true,
				'group' => esc_html__( 'Slider Options', 'lukani' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination', 'lukani' ),
				'param_name' => 'pagination',
				'value' => $status_opt,
				'save_always' => true,
				'group' => esc_html__( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Speed sider', 'lukani' ),
				'param_name' => 'speed',
				'value' => '500',
				'save_always' => true,
				'group' => esc_html__( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Slider Auto', 'lukani' ),
				'param_name' => 'auto',
				'value' => false, 
				'group' => esc_html__( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Slider loop', 'lukani' ),
				'param_name' => 'loop',
				'value' => false, 
				'group' => esc_html__( 'Slider Options', 'lukani' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Effects', 'lukani' ),
				'param_name' => 'effect',
				'value' => $effect_opt,
				'save_always' => true,
				'group' => esc_html__( 'Slider Options', 'lukani' )
			), 
		);
	}
}
//Shortcodes for Visual Composer

add_action( 'vc_before_init', 'lukani_vc_shortcodes' );
function lukani_vc_shortcodes() { 
	//Site logo
	vc_map( array(
		'name' => esc_html__( 'Logo', 'lukani'),
		'base' => 'roadlogo',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Upload logo image', 'lukani' ),
				'param_name' => 'logo_main',
				'value' => '',
			), 
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Width of logo', 'lukani' ),
				'param_name' => 'w_logo', 
			),
		)
	) );
 

	//Main Menu
	vc_map( array(
		'name' => esc_html__( 'Main Menu', 'lukani'),
		'base' => 'roadmainmenu',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'), 
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Upload sticky logo image', 'lukani' ),
				'param_name' => 'sticky_logoimage',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Width of logo sticky', 'lukani' ),
				'param_name' => 'w_logo_sticky', 
			),
		)
	) );

	//Main Menu Mobile
	vc_map( array(
		'name' => esc_html__( 'Main Menu Mobile', 'lukani'),
		'base' => 'roadmainmenumobile',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'), 
		'params' => array()
	) );

	//Categories Menu
	vc_map( array(
		'name' => esc_html__( 'Categories Menu', 'lukani'),
		'base' => 'roadcategoriesmenu',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
		)
	) );
  

	//Mini Cart
	vc_map( array(
		'name' => esc_html__( 'Mini Cart', 'lukani'),
		'base' => 'roadminicart',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
		)
	) );

	//Products Search
	vc_map( array(
		'name' => esc_html__( 'Product Search', 'lukani'),
		'base' => 'roadproductssearch',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
		)
	) ); 
 
	//Brand logos
	vc_map( array(
		'name' => esc_html__( 'Brand Logos', 'lukani' ),
		'base' => 'ourbrands',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array_merge( 
			array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of columns', 'lukani' ),
					'param_name' => 'colsnumber',
					'value' => esc_html__( '6', 'lukani' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of rows', 'lukani' ),
					'param_name' => 'rowsnumber',
					'value' => array(
							'1'	=> '1',
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
						),
				),
			),lukani_get_slider_setting()
		)

	) );
 

	//Categories carousel
	vc_map( array(
		'name' => esc_html__( 'Categories Carousel', 'lukani' ),
		'base' => 'categoriescarousel',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array_merge(
			array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of columns', 'lukani' ),
					'param_name' => 'colsnumber',
					'value' => esc_html__( '6', 'lukani' ),
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of rows', 'lukani' ),
					'param_name' => 'rowsnumber',
					'value' => array(
							'1'	=> '1',
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
						),
				),
			), lukani_get_slider_setting() 
		)
	) );
 
	
	//MailPoet Newsletter Form
	vc_map( array(
		'name' => esc_html__( 'Newsletter Form (MailPoet)', 'lukani' ),
		'base' => 'wysija_form',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Form ID', 'lukani' ),
				'param_name' => 'id',
				'value' => '',
				'description' => esc_html__( 'Enter form ID here', 'lukani' ),
			),
		)
	) );

	//Timesale
	vc_map( array(
		'name' => esc_html__( 'Time Sale', 'lukani' ),
		'base' => 'timesale',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array( 
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Date Sale', 'lukani' ),
				'description' => esc_html__( 'Date Sale M-D-Y. example: 06-16-2030', 'lukani' ),
				'param_name' => 'date', 
			),
			array(
			  "type" => "attach_image",
			  "class" => "",
			  "heading" => esc_html__( "The image", "lukani" ),
			  "param_name" => "image",
			  "value" => '',
			  "description" => esc_html__( "Enter description.", "lukani" )
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Short description', 'lukani' ),
				'param_name' => 'description', 
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'URL', 'lukani' ),
				'description' => esc_html__( 'Link go to sale page', 'lukani' ),
				'param_name' => 'url', 
			), 
		)
	) );
	
	//Latest posts
	vc_map( array(
		'name' => esc_html__( 'Latest posts', 'lukani' ),
		'base' => 'latestposts',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' =>  array_merge(array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of posts', 'lukani' ),
				'param_name' => 'posts_per_page',
				'value' => esc_html__( '5', 'lukani' ),
			),
			  
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Excerpt length', 'lukani' ),
				'param_name' => 'length',
				'value' => esc_html__( '20', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of columns', 'lukani' ),
				'param_name' => 'colsnumber',
				'value' => esc_html__( '4', 'lukani' ),
			), 
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of rows', 'lukani' ),
				'param_name' => 'rowsnumber',
				'value' => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			), 
		),lukani_get_slider_setting() )
	) );
	
	//Testimonials
	vc_map( array(
		'name' => esc_html__( 'Testimonials', 'lukani' ),
		'base' => 'woothemes_testimonials',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of testimonial', 'lukani' ),
				'param_name' => 'limit',
				'value' => esc_html__( '10', 'lukani' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display Author', 'lukani' ),
				'param_name' => 'display_author',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display Avatar', 'lukani' ),
				'param_name' => 'display_avatar',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Avatar image size', 'lukani' ),
				'param_name' => 'size',
				'value' => '',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 50', 'lukani' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display URL', 'lukani' ),
				'param_name' => 'display_url',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Category', 'lukani' ),
				'param_name' => 'category',
				'value' => esc_html__( '0', 'lukani' ),
				'description' => esc_html__( 'ID/slug of the category. Default is 0', 'lukani' ),
			),
		)
	) );
	
	
	//Rotating tweets
	vc_map( array(
		'name' => esc_html__( 'Rotating tweets', 'lukani' ),
		'base' => 'rotatingtweets',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Twitter user name', 'lukani' ),
				'param_name' => 'screen_name',
				'value' => '',
			),
		)
	) );

	//Twitter feed
	vc_map( array(
		'name' => esc_html__( 'Twitter feed', 'lukani' ),
		'base' => 'AIGetTwitterFeeds',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Your Twitter Name(Without the "@" symbol)', 'lukani' ),
				'param_name' => 'ai_username',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number Of Tweets', 'lukani' ),
				'param_name' => 'ai_numberoftweets',
				'value' => '',
			), 
		)
	) );
	
	//Google map
	vc_map( array(
		'name' => esc_html__( 'Google map', 'lukani' ),
		'base' => 'lukani_map',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Map Height', 'lukani' ),
				'param_name' => 'map_height',
				'value' => esc_html__( '400', 'lukani' ),
				'description' => esc_html__( 'Map height in pixels. Default is 400', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Map Zoom', 'lukani' ),
				'param_name' => 'map_zoom',
				'value' => esc_html__( '17', 'lukani' ),
				'description' => esc_html__( 'Map zoom level, min 0, max 21. Default is 17', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Latitude', 'lukani' ),
				'param_name' => 'lat1',
				'value' => '',
				'group' => 'Marker 1'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Longtitude', 'lukani' ),
				'param_name' => 'long1',
				'value' => '',
				'group' => 'Marker 1'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Address', 'lukani' ),
				'param_name' => 'address1',
				'value' => '',
				'description' => esc_html__( 'If you donot enter coordinate, enter address here', 'lukani' ),
				'group' => 'Marker 1'
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Marker image', 'lukani' ),
				'param_name' => 'marker1',
				'value' => '',
				'description' => esc_html__( 'Upload marker image, image size: 40x46 px', 'lukani' ),
				'group' => 'Marker 1'
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Description', 'lukani' ),
				'param_name' => 'description1',
				'value' => '',
				'description' => esc_html__( 'Allowed HTML tags: a, i, em, br, strong, h1, h2, h3', 'lukani' ),
				'group' => 'Marker 1'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Latitude', 'lukani' ),
				'param_name' => 'lat2',
				'value' => '',
				'group' => 'Marker 2'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Longtitude', 'lukani' ),
				'param_name' => 'long2',
				'value' => '',
				'group' => 'Marker 2'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Address', 'lukani' ),
				'param_name' => 'address2',
				'value' => '',
				'description' => esc_html__( 'If you donot enter coordinate, enter address here', 'lukani' ),
				'group' => 'Marker 2'
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Marker image', 'lukani' ),
				'param_name' => 'marker2',
				'value' => '',
				'description' => esc_html__( 'Upload marker image', 'lukani' ),
				'group' => 'Marker 2'
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Description', 'lukani' ),
				'param_name' => 'description2',
				'value' => '',
				'description' => esc_html__( 'Allowed HTML tags: a, i, em, br, strong, p, h2, h2, h3', 'lukani' ),
				'group' => 'Marker 2'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Latitude', 'lukani' ),
				'param_name' => 'lat3',
				'value' => '',
				'group' => 'Marker 3'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Longtitude', 'lukani' ),
				'param_name' => 'long3',
				'value' => '',
				'group' => 'Marker 3'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Address', 'lukani' ),
				'param_name' => 'address3',
				'value' => '',
				'description' => esc_html__( 'If you donot enter coordinate, enter address here', 'lukani' ),
				'group' => 'Marker 3'
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Marker image', 'lukani' ),
				'param_name' => 'marker3',
				'value' => '',
				'description' => esc_html__( 'Upload marker image', 'lukani' ),
				'group' => 'Marker 3'
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Description', 'lukani' ),
				'param_name' => 'description3',
				'value' => '',
				'description' => esc_html__( 'Allowed HTML tags: a, i, em, br, strong, p, h3, h3, h3', 'lukani' ),
				'group' => 'Marker 3'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Latitude', 'lukani' ),
				'param_name' => 'lat4',
				'value' => '',
				'group' => 'Marker 4'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Longtitude', 'lukani' ),
				'param_name' => 'long4',
				'value' => '',
				'group' => 'Marker 4'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Address', 'lukani' ),
				'param_name' => 'address4',
				'value' => '',
				'description' => esc_html__( 'If you donot enter coordinate, enter address here', 'lukani' ),
				'group' => 'Marker 4'
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Marker image', 'lukani' ),
				'param_name' => 'marker4',
				'value' => '',
				'description' => esc_html__( 'Upload marker image', 'lukani' ),
				'group' => 'Marker 4'
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Description', 'lukani' ),
				'param_name' => 'description4',
				'value' => '',
				'description' => esc_html__( 'Allowed HTML tags: a, i, em, br, strong, p, h4, h4, h4', 'lukani' ),
				'group' => 'Marker 4'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Latitude', 'lukani' ),
				'param_name' => 'lat5',
				'value' => '',
				'group' => 'Marker 5'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Longtitude', 'lukani' ),
				'param_name' => 'long5',
				'value' => '',
				'group' => 'Marker 5'
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Address', 'lukani' ),
				'param_name' => 'address5',
				'value' => '',
				'description' => esc_html__( 'If you donot enter coordinate, enter address here', 'lukani' ),
				'group' => 'Marker 5'
			),
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Marker image', 'lukani' ),
				'param_name' => 'marker5',
				'value' => '',
				'description' => esc_html__( 'Upload marker image', 'lukani' ),
				'group' => 'Marker 5'
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Description', 'lukani' ),
				'param_name' => 'description5',
				'value' => '',
				'description' => esc_html__( 'Allowed HTML tags: a, i, em, br, strong, p, h5, h5, h5', 'lukani' ),
				'group' => 'Marker 5'
			),
		)
	) );
	
	//Counter
	vc_map( array(
		'name' => esc_html__( 'Counter', 'lukani' ),
		'base' => 'lukani_counter',
		'class' => '',
		'category' => esc_html__( 'Theme', 'lukani'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Image icon', 'lukani' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Upload icon image', 'lukani' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number', 'lukani' ),
				'param_name' => 'number',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Text', 'lukani' ),
				'param_name' => 'text',
				'value' => '',
			),
		)
	) );
}
?>