<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
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

						<?php
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							 *
							 * We reset this later so we can run the loop
							 * properly with a call to rewind_posts().
							 */
							the_post();
						?>

						<header class="archive-header">
							<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'lukani' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
						</header><!-- .archive-header -->

						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						?>

						<?php
						// If a user has filled out their description, show a bio on their entries.
						if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-info archives">
							<div class="author-avatar">
								<?php
								/**
								 * Filter the author bio avatar size.
								 *
								 * @since Lukani 1.0
								 *
								 * @param int $size The height and width of the avatar in pixels.
								 */
								$author_bio_avatar_size = apply_filters( 'lukani_author_bio_avatar_size', 68 );
								echo ''.get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
								?>
							</div><!-- .author-avatar -->
							<div class="author-description">
								<h2><?php printf( __( 'About %s', 'lukani' ), get_the_author() ); ?></h2>
								<p><?php the_author_meta( 'description' ); ?></p>
							</div><!-- .author-description	-->
						</div><!-- .author-info -->
						
						<?php endif; ?>

						<div class="post-container">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
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