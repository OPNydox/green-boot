<?php
/**
 * The template for displaying Search Results pages
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
				<header class="entry-header">
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
			
			<div class="col-12 <?php if ( is_active_sidebar( 'sidebar-1' ) &&($lukani_blogsidebar != 'none') ) { echo 'col-lg-'.esc_attr($lukani_blogcolclass);} ?>">
			
				<div class="page-content blog-page <?php echo esc_attr($lukani_blogclass); if($lukani_blogsidebar=='left') {echo ' left-sidebar'; } elseif($lukani_blogsidebar=='right') {echo ' right-sidebar'; } else { echo ' none-sidebar'; } ?>">
					<?php if ( have_posts() ) : ?>
						
						<header class="archive-header">
							<h1 class="archive-title"><?php printf( wp_kses(__( 'Search Results for: %s', 'lukani' ), array('span'=>array())), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .archive-header -->
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
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'lukani' ); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'lukani' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

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