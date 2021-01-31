<?php
$_SESSION["preset"] = 1;
/**
 * Template Name: Demo 4
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html> 
<html <?php language_attributes(); ?>> 
<head>
<?php global $lukani_opt; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11" />
<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
<?php
$jscomposer_templates_args = array(
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => 'templatera',
	'post_status'      => 'publish',
	'posts_per_page'   => 100,
);
$jscomposer_templates = get_posts( $jscomposer_templates_args );

if(count($jscomposer_templates) > 0) {
	foreach($jscomposer_templates as $jscomposer_template){
		if($jscomposer_template->post_title == 'Header 4' || $jscomposer_template->post_title == 'Footer 1' || $jscomposer_template->post_title == 'Header Mobile'){
			$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
			if(isset($jscomposer_template_css[0])){
				echo '<style>'.esc_html($jscomposer_template_css[0]).'</style>';
			}
		}
	}
} ?>
<?php wp_head(); ?>
</head>

<body <?php body_class('home'); ?>>
	<div id="yith-wcwl-popup-message"><div id="yith-wcwl-message"></div></div> 
	<div class="wrapper full-width">
		<div class="page-wrapper">
			<header class="header-container header-4">  
			 	<div class="header">  
					<div class="header-content">
						<?php
						if ( isset($lukani_opt['header_layout']) && $lukani_opt['header_layout']!="") {
							$jscomposer_templates_args = array(
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'templatera',
								'post_status'      => 'publish',
								'posts_per_page'      => 100,
							);
							$jscomposer_templates = get_posts( $jscomposer_templates_args );

							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == 'Header 4'){
										echo do_shortcode($jscomposer_template->post_content);
									}
								}
							}
						} 
						?>
					</div>
					<div class="header-mobile">
						<?php
						if ( isset($lukani_opt['header_mobile_layout']) && $lukani_opt['header_mobile_layout']!="") {
							$jscomposer_templates_args = array(
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'templatera',
								'post_status'      => 'publish',
								'posts_per_page'      => 100,
							);
							$jscomposer_templates = get_posts( $jscomposer_templates_args );

							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == 'Header Mobile'){
										echo do_shortcode($jscomposer_template->post_content);
									}
								}
							}
						} 
						?>  
					</div>  
				</div>  
				<div class="clearfix"></div>
			</header>
			<div class="main-container">
				<div class="page-content front-page">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>
					<?php endwhile; ?>
					
				</div>
			</div>
			<footer class="footer footer-1">
				<?php
				if ( isset($lukani_opt['footer_layout']) && $lukani_opt['footer_layout']!="" ) {

					$jscomposer_templates_args = array(
						'orderby'          => 'title',
						'order'            => 'ASC',
						'post_type'        => 'templatera',
						'post_status'      => 'publish',
					);
					$jscomposer_templates = get_posts( $jscomposer_templates_args );

					if(count($jscomposer_templates) > 0) {
						foreach($jscomposer_templates as $jscomposer_template){
							if($jscomposer_template->post_title == 'Footer 1'){
								echo do_shortcode($jscomposer_template->post_content);
							}
						}
					}
				}
				?>
			</footer>
		</div><!-- .page -->
	</div><!-- .wrapper --> 
	<div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>
	 
	<?php wp_footer(); ?>
</body>
</html>
<?php unset($_SESSION["preset"]); ?>