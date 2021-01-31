<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

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
<div class="shop-products products row <?php if(is_shop()) { echo esc_attr($lukani_viewmode).' '.esc_attr($shoplayout); } else {  echo esc_attr($lukani_viewmode); }?>">