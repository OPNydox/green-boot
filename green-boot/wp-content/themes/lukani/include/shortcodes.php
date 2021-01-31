<?php 

function lukani_logo_shortcode( $atts ) {
	$lukani_opt = get_option( 'lukani_opt' );

	$atts = shortcode_atts( array(
							'logo_main' => '',
							'w_logo' => '',
							), $atts, 'roadlogo' );
	$html = '';
	$wl = '';
	if( isset($atts['w_logo']) && $atts['w_logo']!='') {
		$wl = $atts['w_logo'];
	}

	if( isset($atts['logo_main']) && $atts['logo_main']!=''){ 
		$html .= '<div class="logo">'; 
			$html .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'; 
			$html .= '<img src="'.wp_get_attachment_url( $atts['logo_main']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" width="'.esc_attr($wl).'" />'; 
			$html .= '</a>';  
		$html .= '</div>'; 
	} else {
		$html .= '<h1 class="logo">'; 
			$html .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'; 
				$html .= bloginfo( 'name' ); 
			$html .= '</a>';  
		$html .= '</h1>';
	}
	
	return $html;
}

function lukani_mainmenu_shortcode( $atts ) {
	$lukani_opt = get_option( 'lukani_opt' );

	$atts = shortcode_atts( array( 
							'sticky_logoimage' => '',
							'w_logo_sticky' => '',
							), $atts, 'roadmainmenu' );
	$html = '';
	$wl_sticky = '';
	if( isset($atts['w_logo_sticky']) && $atts['w_logo_sticky']!='') {
		$wl_sticky = $atts['w_logo_sticky'];
	}
	
	ob_start(); ?>
	<div class="main-menu-wrapper"> 
		<div class="<?php if(isset($lukani_opt['sticky_header']) && $lukani_opt['sticky_header']) {echo 'header-sticky';} ?> <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
			<div class="nav-container"> 
				<?php if( isset($atts['sticky_logoimage']) && $atts['sticky_logoimage']!=''){ ?>
					<div class="logo-sticky"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo  esc_url(wp_get_attachment_url( $atts['sticky_logoimage']));?>" alt=" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> " width="<?php echo esc_attr($wl_sticky); ?>" /></a></div>
				<?php } ?>
				<div class="horizontal-menu visible-large">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?> 
				</div> 
			</div> 
		</div>  
	</div>	
	<?php
	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function lukani_mainmenumobile_shortcode( $atts ) {
	$lukani_opt = get_option( 'lukani_opt' );

	$atts = shortcode_atts( array( 
							), $atts, 'roadmainmenumobile' );
	$html = '';
	
	ob_start(); ?>  
		<div class="visible-small mobile-menu"> 
			<div class="mbmenu-toggler"><?php echo esc_html($lukani_opt['mobile_menu_label']);?><span class="mbmenu-icon"><i class="fa fa-bars"></i></span></div>
			<div class="clearfix"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
		</div>  
	<?php
	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}
 

function lukani_roadcategoriesmenu_shortcode ( $atts ) {

	$lukani_opt = get_option( 'lukani_opt' );

	$html = '';

	ob_start();

	$cat_menu_class = '';

	if(isset($lukani_opt['categories_menu_home']) && $lukani_opt['categories_menu_home']) {
		$cat_menu_class .=' show_home';
	}
	if(isset($lukani_opt['categories_menu_sub']) && $lukani_opt['categories_menu_sub']) {
		$cat_menu_class .=' show_inner';
	}
	?>
	<div class="categories-menu visible-large <?php echo esc_attr($cat_menu_class); ?>">
		<div class="catemenu-toggler"><span><?php if(isset($lukani_opt)) { echo esc_html($lukani_opt['categories_menu_label']); } else { esc_html_e('Category', 'lukani'); } ?></span></div>
		<div class="menu-inner">
			<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'categories-menu' ) ); ?>
			<div class="morelesscate">
				<span class="morecate"><?php if ( isset($lukani_opt['categories_more_label']) && $lukani_opt['categories_more_label']!='' ) { echo esc_html($lukani_opt['categories_more_label']); } else { esc_html_e('More Categories', 'lukani'); } ?></span>
				<span class="lesscate"><?php if ( isset($lukani_opt['categories_less_label']) && $lukani_opt['categories_less_label']!='' ) { echo esc_html($lukani_opt['categories_less_label']); } else { esc_html_e('Close Menu', 'lukani'); } ?></span>
			</div>
		</div> 
	</div>
	<?php

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

 

function lukani_roadminicart_shortcode( $atts ) {

	$html = '';

	ob_start();

	if ( class_exists( 'WC_Widget_Cart' ) ) {
		the_widget('WC_Widget_Cart');
	}

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
} 

function lukani_roadproductssearch_shortcode( $atts ) {

 $html = '';

 ob_start();

 if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
  <div class="header-search">  
  	<div class="search-categories-container">
		<div class="cate-toggler"><?php esc_html_e('All Categories', 'lukani');?></div>
			<?php the_widget('WC_Widget_Product_Categories', array('hierarchical' => true, 'title' => 'All Categories', 'orderby' => 'order')); ?>
	
	</div>
   	<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
  </div>
 <?php }

 $html .= ob_get_contents();

 ob_end_clean();
 
 return $html;
} 

 
function lukani_brands_shortcode( $atts ) {
	global $lukani_opt;
	$brand_index = 0;  
	if(isset($lukani_opt['brand_logos'])) {
		$brandfound = count($lukani_opt['brand_logos']);
	} 
	wp_localize_script('lukani-theme', 'brands_options', array(
			'atts' => $atts
		)
	);	
	$atts = shortcode_atts( array(
							'rowsnumber' => '1',
							'colsnumber' => '5',
							'enable_slider' => false,
							), $atts, 'ourbrands' );

	$style = '';
	if ($atts["enable_slider"] == true) {
		$style = 'slide owl-carousel owl-theme';
	} 
	$html = '';
	
	if(isset($lukani_opt['brand_logos']) && $lukani_opt['brand_logos']) {
		$html .= '<div class="brands-carousel '.esc_attr($style).'" data-col="'.esc_attr($atts['colsnumber']).'">';
			foreach($lukani_opt['brand_logos'] as $brand) {
				if(is_ssl()){
					$brand['image'] = str_replace('http:', 'https:', $brand['image']);
				}
				$brand_index ++;
				if ( (0 == ( $brand_index - 1 ) % $atts['rowsnumber'] ) || $brand_index == 1) {
					$html .= '<div class="group">';
				}
				$html .= '<div class="item-col">';
				$html .= '<a href="'.esc_url($brand['url']).'" title="'.esc_attr($brand['title']).'">';
					$html .= '<img src="'.esc_url($brand['image']).'" alt="'.esc_attr($brand['title']).'"  />';
				$html .= '</a>';
				$html .= '</div>';
				if ( ( ( 0 == $brand_index % $atts['rowsnumber'] || $brandfound == $brand_index ))  ) {
					$html .= '</div>';
				}
			}
		$html .= '</div>';
	}
	
	return $html;
}

function lukani_counter_shortcode( $atts ) {
	
	$atts = shortcode_atts( array(
							'image' => '',
							'number' => '100',
							'text' => 'Demo text',
							), $atts, 'lukani_counter' );
	$html = '';
	$html.='<div class="lukani-counter">';
		$html.='<div class="counter-image">';
			$html.='<img src="'.wp_get_attachment_url($atts['image']).'" alt="'.esc_attr_e('image','lukani').'" />';
		$html.='</div>';
		$html.='<div class="counter-info">';
			$html.='<div class="counter-number">';
				$html.='<span>'.esc_html($atts['number']).'</span>';
			$html.='</div>';
			$html.='<div class="counter-text">';
				$html.='<span>'.esc_html($atts['text']).'</span>';
			$html.='</div>';
		$html.='</div>';
	$html.='</div>';
	
	return $html;
}
 
function lukani_categoriescarousel_shortcode( $atts ) {
	global $lukani_opt;
	$categories_index = 0; 
	if(isset($lukani_opt['cate_images'])){
		$categoriesfound = count($lukani_opt['cate_images']);
	}
	wp_localize_script('lukani-theme', 'categoriescarousel_options', array(
			'atts' => $atts
		)
	);	
	$atts = shortcode_atts( array(
							'rowsnumber' => '1',
							'colsnumber' => '6',
							'enable_slider' => false,
							), $atts, 'categoriescarousel' ); 
	$style = '';
	if ($atts["enable_slider"] == true) {
		$style = 'slide owl-carousel owl-theme'; 
	} 
	$html = '';
	if(isset($lukani_opt['cate_images'])){
		$html .= '<div class="categories-carousel '.esc_attr($style).' " data-col="'.esc_attr($atts['colsnumber']).'">'; 
			foreach($lukani_opt['cate_images'] as $categories) {
				if(is_ssl()){
					$categories['image'] = str_replace('http:', 'https:', $categories['image']);
				}
				$categories_index ++;
				if ( (0 == ( $categories_index - 1 ) % $atts['rowsnumber'] ) || $categories_index == 1) {
					$html .= '<div class="group">';
				}
					$html .= '<div class="item-col">';
						$html .= '<div class="item-inner">';
							$html .= '<a href="'.esc_url($categories['url']).'" class="image" title="'.esc_attr($categories['title']).'">';
								$html .= '<img src="'.esc_url($categories['image']).'" alt="'.esc_attr($categories['title']).'" />';
							$html .= '</a>';
								$html .= '<h5 class="title"><a href="'.esc_url($categories['url']).'">'.esc_html($categories['title']).'</a></h5>';
								$html .= '<div class="description">'.esc_html($categories['description']).'</div>';
						$html .= '</div>';
					$html .= '</div>';
				if ( ( ( 0 == $categories_index % $atts['rowsnumber'] || $categoriesfound == $categories_index ))  ) {
					$html .= '</div>';
				}
			}
		$html .= '</div>';
	}
	
	return $html;
}

function lukani_timesale_shortcode( $atts ) {  
	global $lukani_opt;

	$atts = shortcode_atts( array(
		'date' => '',  
		'image' => '',   
		'description' => '', 
		'url' => '', 
	), $atts, 'timesale' );
	$html = '';
	$html.='<div class="sale-date">';
		$html.='<div class="image">';
			$html.='<img src="'.wp_get_attachment_url($atts['image']).'" alt="'.esc_attr($atts['image']).'" />';
		$html.='</div>';
		$html.='<div class="sale-info">';
			$html.='<div class="description">'.esc_html($atts['description']).'</div>';
			$html.='<div class="countdownsale" data-time="'.esc_attr($atts['date']).'"></div>';
			$html.='<a href="'.esc_url($atts['url']).'" class="shopping-now">'.esc_html__('shopping now','lukani').'</a>';
		$html.='</div>';
	$html.='</div>'; 
	
	return $html;
}

function lukani_latestposts_shortcode( $atts ) { 
	global $lukani_opt;
	$post_index = 0; 
	wp_localize_script('lukani-theme', 'latestposts_options', array(
			'atts' => $atts
		)
	);	
	$atts = shortcode_atts( array(
		'posts_per_page' => 5,
		'order' => 'DESC',
		'orderby' => 'post_date',  
		'length' => 20,
		'enable_slider' => false,
		'rowsnumber' => '1',
		'colsnumber' => '4',  
	), $atts, 'latestposts' );
	 
	$imagesize = 'lukani-post-thumb';  
	 
		
	$style = '';
	if ($atts["enable_slider"] == true) {
		$style = 'slide owl-carousel owl-theme';
	} 
	 
	$html = '';

	$postargs = array(
		'posts_per_page'   => $atts['posts_per_page'],
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => $atts['orderby'],
		'order'            => $atts['order'],
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	
	$postslist = get_posts( $postargs );
	$postscount = count($postslist); 
	$html.='<div class="posts-carousel '.esc_attr($style).'" data-col="'.esc_attr($atts['colsnumber']).'">';

			foreach ( $postslist as $post ) {
				$post_index ++;
				if ( (0 == ( $post_index - 1 ) % $atts['rowsnumber'] ) || $post_index == 1) {
					$html .= '<div class="group">';
				}
				$html.='<div class="item-col">';
					$html.='<div class="post-wrapper">';
						// author link
						$author_id = $post->post_author;
						$author_url = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
						$author_name = get_the_author_meta( 'user_nicename', $author_id ); 
						
						$html.='<div class="post-thumb">'; 
							$html.='<a href="'.get_the_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, $imagesize).'</a>';
						$html.='</div>'; 
						$html.='<div class="post-info">'; 
							$html.='<h3 class="post-title"><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h3>';

							$html.='<div class="author-date">';
								$html.='<span class="post-author"><label>'.esc_html__('By','lukani').'</label> <span>'.esc_html($author_name).'</span></span>';
								$html.='<span class="separator"> / </span>'; 
								$date = get_the_date('', $post->ID); 
								$html.='<span class="post-date">'.esc_html($date).'</span>'; 
							$html.='</div>';
							$cate_list = get_the_category_list( ', ' ); 
							$html.= '<span class="post-category">'.esc_html($cate_list).'</span>';  
									 
							$num_comments = (int)get_comments_number($post->ID); 

							$html.='<div class="post-excerpt">';
								$html.= Lukani_Class::lukani_excerpt_by_id($post, $length = $atts['length']);
							$html.='</div>';   

							$html.='<a href="'.get_the_permalink($post->ID).'" class="post-read-more">'.esc_html__('Continue Reading','lukani').'</a>';
							$html.= '<span class="post-num-comments">'.esc_html($num_comments).'</span>'; 
						$html.='</div>';

					$html.='</div>';
				$html.='</div>';
				if ( ( ( 0 == $post_index % $atts['rowsnumber'] || $atts['posts_per_page'] == $post_index || $postscount == $post_index ))  ) {
					$html .= '</div>';
				}
			}
	$html.='</div>';

	wp_reset_postdata();
	
	return $html;
}

 
function lukani_magnifier_options($att) {
	$enable_slider 	= get_option('yith_wcmg_enableslider') == 'yes' ? true : false;
	$slider_items = get_option( 'yith_wcmg_slider_items', 3 ); 
	if ( !isset($slider_items) || ( $slider_items == null ) ) $slider_items = 3;
	wp_enqueue_script('lukani-magnifier', get_template_directory_uri() . '/js/product-magnifier-var.js'); 
	wp_localize_script('lukani-magnifier', 'lukani_magnifier_vars', array(
		
			'responsive' => get_option('yith_wcmg_slider_responsive') == 'yes' ? 'true' : 'false',
			'circular' => get_option('yith_wcmg_slider_circular') == 'yes' ? 'true' : 'false',
			'infinite' => get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false',

			'visible' => esc_js(apply_filters( 'woocommerce_product_thumbnails_columns', $slider_items )),

			'zoomWidth' => get_option('yith_wcmg_zoom_width'),
			'zoomHeight' => get_option('yith_wcmg_zoom_height'),
			'position' => get_option('yith_wcmg_zoom_position'),

			'lensOpacity' => get_option('yith_wcmg_lens_opacity'),
			'softFocus' => get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false',
			'phoneBehavior' => get_option('yith_wcmg_zoom_mobile_position'),
			'loadingLabel' => stripslashes(get_option('yith_wcmg_loading_label')),
		)
	); 
} ?>