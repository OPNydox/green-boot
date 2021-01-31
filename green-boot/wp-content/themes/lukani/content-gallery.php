<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Lukani_Theme
 * @since Lukani 1.0
 */

$lukani_opt = get_option( 'lukani_opt' );

$lukani_postthumb = Lukani_Class::lukani_post_thumbnail_size('');

if(Lukani_Class::lukani_post_odd_event() == 1){
	$lukani_postclass='even';
} else {
	$lukani_postclass='odd';
}
$lukani_blogstyle = Lukani_Class::lukani_show_style_blog();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($lukani_postclass); ?>>
	 
	<?php  if ( is_single() ) { ?> 
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1> 
			<div class="post-meta">
				<span class="post-author">
					<?php esc_html_e('By', 'lukani');?>
					<span class="post-by"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
				</span>
				<span class="post-separator">/</span>
				<span class="post-date">
					<?php esc_html_e('Date', 'lukani');?>
					<?php 
						$archive_year  = get_the_time('Y', $post->ID);
						$archive_month = get_the_time('m', $post->ID);
					?>
					<a href="<?php echo esc_url(get_month_link( $archive_year, $archive_month )); ?>"><?php echo get_the_date('F d, Y', $post->ID);?></a>
				</span>
				<?php  $categories_list = get_the_category_list( ', ' ); 
					if($categories_list != '') { ?>
						<span class="post-separator">/</span>
						<span class="post-category"> 
							<?php esc_html_e('Category:', 'lukani');?>
							<?php  echo wp_kses(($categories_list), array('a'=>array('href'=>array(), 'rel'=>array() ) ));?>
						</span>
				<?php } ?>
				
			</div>
		</header>  
		<div class="post-thumbnail">
			<?php echo do_shortcode(get_post_meta( $post->ID, '_lukani_post_intro', true )); ?>
			
		</div>
	<?php } ?>
	<?php if ( !is_single() ) { ?>
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail">
			<a href="<?php esc_url(the_permalink()); ?>"><?php the_post_thumbnail($lukani_postthumb); ?></a>  
			 
		</div>
		<?php } ?>
	<?php } ?> 
	
	<div class="postinfo-wrapper <?php if ( !has_post_thumbnail() ) { echo 'no-thumbnail';} ?>">
		<?php if ( !is_single() ) : ?> 
			<header class="entry-header">  
				<h2 class="entry-title">
					<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>     
			</header>
		<?php endif; ?>
		<div class="post-info"> 
			<?php if (is_home() && is_page_template('page-templates/front-page.php')){ ?>
				<header class="entry-header"> 
					<h1 class="entry-title">
						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1> 
				</header>
			<?php }?>
			<?php if ( is_single() ) : ?>
				<div class="entry-content">
					<?php the_content( wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'lukani' ), array('span'=>array('class'=>array())) )); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lukani' ), 'after' => '</div>', 'pagelink' => '<span>%</span>' ) ); ?>
				</div>
			<?php else : ?>
				<div class="post-meta">
					<span class="post-author">
						<?php esc_html_e('By', 'lukani');?>
						<span class="post-by"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
					</span>
					<span class="post-separator">/</span>
					<span class="post-date">
						<?php esc_html_e('Date', 'lukani');?>
						<?php 
							$archive_year  = get_the_time('Y', $post->ID);
							$archive_month = get_the_time('m', $post->ID);
						?>
						<a href="<?php echo esc_url(get_month_link( $archive_year, $archive_month )); ?>"><?php echo get_the_date('F d, Y', $post->ID);?></a>
					</span>
					<?php  $categories_list = get_the_category_list( ', ' ); 
						if($categories_list != '') { ?>
							<span class="post-separator">/</span>
							<span class="post-category"> 
								<?php esc_html_e('Category:', 'lukani');?>
								<?php  echo wp_kses(($categories_list), array('a'=>array('href'=>array(), 'rel'=>array() ) ));?>
							</span>
					<?php } ?>
					
				</div>
				<div class="entry-summary">
					<?php
						/* translators: %s: Name of current post */
						the_content( sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lukani' ),
							get_the_title()
						) );

						wp_link_pages( array(
							'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'lukani' ),
							'after'       => '</div>',
							'link_before' => '<span class="page-number">',
							'link_after'  => '</span>',
						) );
					?>
				</div>
			<?php endif; ?>  
		</div>
	</div>
	<?php if ( is_single() ) : ?>
		<footer class="entry-footer">
			<div class="meta-sharing">
				<?php  $tag_list = get_the_tag_list('', ', '); 
				if($tag_list != '') : ?>
					<span class="post-tag"> 
						<?php esc_html_e('Tags:', 'lukani');?>
						<?php  echo wp_kses(($tag_list), array('a'=>array('href'=>array(), 'rel'=>array() ) ));?>
					</span>
				<?php else : ?>
					<div class="empty-tag">
					<?php esc_html_e('There are no tags in this post !', 'lukani');?>
					</div>
				<?php  endif; ?>
				
				<?php if( function_exists('lukani_blog_sharing') ) { ?>
					<div class="social-sharing"><?php lukani_blog_sharing(); ?></div>
				<?php } ?>
			</div>
			<?php if(get_the_author_meta()!="") { ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						$author_bio_avatar_size = apply_filters( 'lukani_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div>
					<div class="author-description">
						<h3><?php esc_html_e( 'About the Author:', 'lukani'); printf( '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">%s</a>' , get_the_author()); ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div>
				</div>
			<?php } ?>

		</footer>  
	<?php endif; ?>
</article>