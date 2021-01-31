<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
		Lukani_Class::lukani_post_thumbnail_size('lukani-category-thumb');
		break;
	case 'largeimage':
		$lukani_blogclass = 'blog-large';
		$lukani_blogcolclass = 9;
		Lukani_Class::lukani_post_thumbnail_size('lukani-category-thumb');
		break;
	case 'grid':
		$lukani_blogclass = 'grid';
		$lukani_blogcolclass = 9;
		Lukani_Class::lukani_post_thumbnail_size('lukani-category-thumb');
		break;
	default:
		$lukani_blogclass = 'blog-nosidebar';
		$lukani_blogcolclass = 12;
		$lukani_blogsidebar = 'none';
		Lukani_Class::lukani_post_thumbnail_size('lukani-post-thumb');
} 

?>

<div class="main-container"> 
	<div class="title-breadcrumb">
		<div class="container">
			<div class="title-breadcrumb-inner">
				<header class="entry-header title-blog">
					<h1 class="entry-title"><?php if(isset($lukani_opt['blog_header_text']) && ($lukani_opt['blog_header_text'] !='')) { echo esc_html($lukani_opt['blog_header_text']); } else{ esc_html_e('Blog', 'lukani');}  ?></h1>
				</header> 
				<?php Lukani_Class::lukani_breadcrumb(); ?> 
			</div>
		</div>
	</div>
	<div class="container">
		
		<div class="row">
			<?php if($lukani_blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-12 <?php if ( is_active_sidebar( 'sidebar-1' ) && ($lukani_blogsidebar != 'none') ) { echo 'col-lg-'.esc_attr($lukani_blogcolclass);} ?>">
			
				<div class="page-content blog-page <?php echo esc_attr($lukani_blogclass.' '.$lukani_blogstyle); if($lukani_blogsidebar=='left') {echo ' left-sidebar'; } elseif($lukani_blogsidebar=='right') {echo ' right-sidebar'; } else { echo ' none-sidebar'; } ?>">
					<?php if ( have_posts() ) : ?>
						<div class="post-container">
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							
							<?php get_template_part( 'content', get_post_format() ); ?>
							
						<?php endwhile; ?>
						</div>
						<div class="pagination">
							<?php Lukani_Class::lukani_pagination(); ?>
						</div>
					<?php else : ?>

						<article id="post-0" class="post no-results not-found">

						<?php if ( current_user_can( 'edit_posts' ) ) :
							// Show a different message to a logged-in user who can add posts.
						?>
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'No posts to display', 'lukani' ); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'lukani' ), array('a'=>array('href'=>array()))), admin_url( 'post-new.php' ) ); ?></p>
							</div><!-- .entry-content -->

						<?php else :
							// Show the default message to everyone else.
						?>
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'lukani' ); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'lukani' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						<?php endif; // end current_user_can() check ?>

						</article><!-- #post-0 -->

					<?php endif; // end have_posts() check ?>
				</div> 
			</div>
			<?php if( $lukani_blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div> 
</div>
<?php get_footer(); ?>