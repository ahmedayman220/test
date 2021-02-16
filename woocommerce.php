<?php 
	/*
		Template Name: WooCommerce
	*/

	get_header();

	$housico_shop_sidebar = housico_get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'housico_page_sidebar' );

	$has_sidebar = (function_exists('is_product') && is_product() && (housico_get_option('shop-show-sidebar-single-product', false) == false)) ? false : housico_has_sidebar($housico_shop_sidebar); ?>

	<!-- Container -->
	<div class="vu_container vu_wc-page <?php echo ($has_sidebar == true) ? 'vu_with-sidebar' : 'vu_no-sidebar' ?> clearfix">
		<div class="container">
			<div class="row">
				<div class="vu_content col-xs-12 col-sm-12 col-md-<?php echo ($has_sidebar == true) ? (12 - absint($housico_shop_sidebar['layout'])) . (($housico_shop_sidebar['position'] == 'left') ? ' col-md-push-'. absint($housico_shop_sidebar['layout']) : '') : '12'; ?>">
					<?php if( function_exists('woocommerce_content') ) { woocommerce_content(); } ?>
				</div>

				<?php if( $has_sidebar == true ) : ?>
					<aside class="vu_sidebar vu_wc-sidebar vu_s-<?php echo esc_attr($housico_shop_sidebar['sidebar']); ?> col-xs-12 col-md-<?php echo absint($housico_shop_sidebar['layout']) . (($housico_shop_sidebar['position'] == 'left') ? ' col-md-pull-'. (12 - absint($housico_shop_sidebar['layout'])) : ''); ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
						<?php housico_dynamic_sidebar( $housico_shop_sidebar['sidebar'] ); ?>
					</aside>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- /Container -->
	
<?php get_footer(); ?>