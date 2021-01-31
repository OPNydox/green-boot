<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, lukani already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Lukani_Theme
 * @since Lukani 1.0
 */

$lukani_opt = get_option( 'lukani_opt' );

get_header();

$lukani_bloglayout = 'sidebar';
if(isset($lukani_opt['blog_layout']) && $lukani_opt['blog_layout']!=''){
	$lukani_bloglayout = $lukani_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$lukani_bloglayout = $_GET['layout'];
}
$lukani_blogstyle = Lukani_Class::lukani_show_style_blog();

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
		$lukani_postthumb = '';
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
				<?php Lukani_Class::lukani_breadcrumb(); ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			
			<?php if($lukani_blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-12 <?php if ( is_active_sidebar( 'sidebar-1' ) && ($lukani_blogsidebar != 'none')) { echo 'col-lg-'.esc_attr($lukani_blogcolclass);} ?>">
				<div class="page-content blog-page <?php echo esc_attr($lukani_blogclass.' '.$lukani_blogstyle); if($lukani_blogsidebar=='left') {echo ' left-sidebar'; } elseif($lukani_blogsidebar=='right') {echo ' right-sidebar'; } else { echo ' none-sidebar'; } ?>">
					<?php if ( have_posts() ) : ?>
						<header class="archive-header">
							<?php
								the_archive_title( '<h1 class="archive-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header>
						<div class="post-container">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/* Include the post format-specific template for the content. If you want to
								 * this in a child theme then include a file called called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );

							endwhile;
							?>
						</div>
					<div class="pagination">
						<?php Lukani_Class::lukani_pagination(); ?>
					</div>	
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div> 
			</div>
			<?php if( $lukani_blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div> 
</div>
<?php get_footer(); ?>