<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

global $wp_query, $woocommerce_loop;

$lukani_opt = get_option( 'lukani_opt' );

$shoplayout = 'sidebar';
if(isset($lukani_opt['shop_layout']) && $lukani_opt['shop_layout']!=''){
	$shoplayout = $lukani_opt['shop_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$shoplayout = $_GET['layout'];
}
$shopsidebar = 'left';
if(isset($lukani_opt['sidebarshop_pos']) && $lukani_opt['sidebarshop_pos']!=''){
	$shopsidebar = $lukani_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-shop' ) )  {
	$shoplayout = 'fullwidth';
}
switch($shoplayout) {
	case 'fullwidth':
		Lukani_Class::lukani_shop_class('shop-fullwidth');
		$shopcolclass = 12;
		$shopsidebar = 'none';
		$productcols = 4;
		break;
	default:
		Lukani_Class::lukani_shop_class('shop-sidebar');
		$shopcolclass = 9;
		$productcols = 3;
}

$lukani_viewmode = Lukani_Class::lukani_show_view_mode();
?>
<div class="main-container">
	<div class="page-content">  
		<div class="shop_content">
			<div class="title-breadcrumb"> 
				<div class="container"> 
					<div class="title-breadcrumb-inner"> 
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<header class="entry-header">
								<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
							</header>
						<?php endif; ?>
						<?php
							/**
							 * woocommerce_before_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */
							do_action( 'woocommerce_before_main_content' );
						?>    
					</div>
				</div>  
			</div>
			<div class="container"> 
				<div class="row">
					<?php if( $shopsidebar == 'left' ) :?>
						<?php get_sidebar('shop'); ?>
					<?php endif; ?>
					<div id="archive-product" class="col-12 <?php echo 'col-lg-'.$shopcolclass; ?>">
						<?php if (is_product_category()) { ?>
							<div class="category-desc <?php echo esc_attr($shoplayout);?>">
								<div class="category_header">   
									<div class="category-desc-inner"> 
										<?php do_action( 'woocommerce_archive_description' ); ?> 
									</div> 
								</div> 
							</div>
						<?php } ?>  
						<div class="archive-border">
								
							<?php
								/**
								* remove message from 'woocommerce_before_shop_loop' and show here
								*/
								do_action( 'woocommerce_show_message' );
							?>
							
							<?php if ( have_posts() ) : ?>	
								<?php if ( woocommerce_products_will_display() ) { ?>
									<div class="toolbar">
										<div class="toolbar-inner">  
											<div class="view-mode">
												<label><?php esc_html_e('View on', 'lukani');?></label>
												<a href="#" class="grid <?php if($lukani_viewmode=='grid-view'){ echo ' active';} ?>" title="<?php echo esc_attr__( 'Grid', 'lukani' ); ?>"></a>
												<a href="#" class="list <?php if($lukani_viewmode=='list-view'){ echo ' active';} ?>" title="<?php echo esc_attr__( 'List', 'lukani' ); ?>"></a>
											</div>
											<?php
												/**
												 * woocommerce_before_shop_loop hook
												 * 
												 * @hooked woocommerce_result_count - 20
												 * @hooked woocommerce_catalog_ordering - 30
												 */
												do_action( 'woocommerce_before_shop_loop' );
											?>  
											<div class="clearfix"></div>
										</div>
									</div>
								<?php } ?>
								<?php woocommerce_product_loop_start(); ?>
								
									
									<?php $woocommerce_loop['columns'] = $productcols; ?>
									
									<?php woocommerce_product_subcategories();
									//reset loop
									$woocommerce_loop['loop'] = 0; ?> 
									<?php while ( have_posts() ) : the_post(); ?>

										<?php wc_get_template_part( 'content', 'product-archive' ); ?>

									<?php endwhile; // end of the loop. ?> 
								<?php woocommerce_product_loop_end(); ?>
								
								<?php if ( woocommerce_products_will_display() ) { ?>
								<div class="toolbar tb-bottom">
									<?php
										/**
										 * woocommerce_before_shop_loop hook
										 *
										 * @hooked woocommerce_pagination - 10
										 */
										do_action( 'woocommerce_after_shop_loop' ); 
									?>
									<div class="clearfix"></div>
								</div>
								<?php } ?>
								
							<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

								<?php wc_get_template( 'loop/no-products-found.php' ); ?>

							<?php endif; ?>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>

						<?php
							/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
						?>
						</div>
					</div>
					<?php if($shopsidebar == 'right') :?>
						<?php get_sidebar('shop'); ?>
					<?php endif; ?>
				</div>
			</div>  
		</div>
	</div>
</div>
<?php get_footer( 'shop' ); ?>