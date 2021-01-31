<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Lukani_Theme
 * @since Lukani 1.0
 */

$lukani_opt = get_option( 'lukani_opt' );

get_header();

$lukani_blogstyle = Lukani_Class::lukani_show_style_blog();

$lukani_bloglayout = 'sidebar';
if(isset($lukani_opt['blog_layout']) && $lukani_opt['blog_layout']!=''){
	$lukani_bloglayout = $lukani_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$lukani_bloglayout = $_GET['layout'];
}
$lukani_blogsidebar = 'right'; 
if(isset($lukani_opt['sidebarblog_pos']) && $lukani_opt['sidebarblog_pos']!=''){
	$lukani_blogsidebar = $lukani_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$lukani_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$lukani_bloglayout = 'blog-nosidebar';
}
switch($lukani_bloglayout) {
	case 'sidebar':
		$lukani_blogclass = 'blog-sidebar';
		$lukani_blogcolclass = 9;
		break;
	default:
		$lukani_blogclass = 'blog-nosidebar'; //for both fullwidth and no sidebar
		$lukani_blogcolclass = 12;
		$lukani_blogsidebar = 'none';
} 
?>
<div class="main-container page-wrapper">
	<div class="title-breadcrumb">
		<div class="container">
			<div class="title-breadcrumb-inner">  
				<?php Lukani_Class::lukani_breadcrumb(); ?>
			</div>
		</div>
		
	</div>
	<div class="container">
		<div class="row">

			<?php
			$customsidebar = get_post_meta( $post->ID, '_lukani_custom_sidebar', true );
			$customsidebar_pos = get_post_meta( $post->ID, '_lukani_custom_sidebar_pos', true );

			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col col-lg-3"><div class="sidebar-inner">';
						dynamic_sidebar( $customsidebar );
					echo '</div></div>';
				} 
			} else {
				if($lukani_blogsidebar=='left') {
					get_sidebar('blog-page');
				}
			} ?>
			
			<div class="col-12 <?php echo 'col-lg-'.esc_attr($lukani_blogcolclass); ?>">
				<div class="page-content blog-page single <?php echo esc_attr($lukani_blogclass.' '.$lukani_blogstyle); if($lukani_blogsidebar=='left') {echo ' left-sidebar'; } elseif($lukani_blogsidebar=='right') {echo ' right-sidebar'; } else { echo ' none-sidebar'; } ?>">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php comments_template( '', true ); ?> 
						
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-md-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($lukani_blogsidebar=='right') {
					get_sidebar('blog-page');
				}
			} ?>
		</div>
	</div> 
</div>

<?php get_footer(); ?>