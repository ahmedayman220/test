<?php
	/**
	 *	Housico WordPress Theme
	 */

	if ( !defined('ABSPATH') ) exit();

	class Housico_WC_Actions {
		function __construct() {
			add_action( 'init', array($this, 'housico_init') );
			add_action( 'wp_enqueue_scripts', array($this, 'housico_wp_enqueue_scripts') );
			add_action( 'wp_head', array($this, 'housico_wp_head') );
			add_action( 'wp_footer', array($this, 'housico_wp_footer') );
			add_action( 'woocommerce_share', array($this, 'housico_woocommerce_share') );
			add_action( 'housico_wc_show_responsive_basket_icon', array($this, 'housico_wc_show_responsive_basket_icon') );

			add_action('wp_ajax_housico_get_cart_contents_count', array($this, 'housico_get_cart_contents_count'));
			add_action('wp_ajax_nopriv_housico_get_cart_contents_count', array($this, 'housico_get_cart_contents_count'));
		}

		// Theme initialization
		function housico_init() {
			wp_register_style('housico-woocommerce', HOUSICO_THEME_ASSETS . 'css/woocommerce.css', array('housico-main'), HOUSICO_THEME_VERSION);
			wp_register_script('housico-woocommerce', HOUSICO_THEME_ASSETS . 'js/woocommerce.js', array('jquery', 'housico-main'), HOUSICO_THEME_VERSION, true);
			
			// Config Object
			wp_localize_script( 'housico-woocommerce', 'housico_wc_config',
				array(
					'shop_url' => esc_url(wc_get_page_permalink('shop')),
					'cart_url' => esc_url(wc_get_cart_url()),
					'checkout_url' => esc_url(wc_get_checkout_url()),
					'version' => HOUSICO_THEME_VERSION
				)
			);
		}

		// Enqueue Scripts
		function housico_wp_enqueue_scripts() {
			wp_enqueue_style('housico-woocommerce');
		}

		// Head Init
		function housico_wp_head() {
			echo '<style type="text/css" id="housico_wc-custom-css">'. housico_wc_custom_css() .'</style>';
		}

		// Footer Init
		function housico_wp_footer() {
			wp_enqueue_script('housico-woocommerce');
		}
		
		// Print Product Socials Networks
		function housico_woocommerce_share() {
			global $post;

			$url = get_permalink();
			$title = get_the_title();
			$post_id = get_the_ID();

			if ( housico_get_option('shop-show-product-socials') ) : ?>
				<div class="vu_wc-product-social-networks vu_product-social-networks clearfix">
					<ul class="list-unstyled">
					<?php if ( housico_get_option( array('shop-product-socials','facebook') ) == '1' ) { ?>
						<li>
							<a href="#" class="vu_social-link" data-href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($url); ?>&amp;t=<?php echo urlencode($title); ?>"><i class="fa fa-facebook"></i></a>
						</li>
					<?php } if ( housico_get_option( array('shop-product-socials','twitter') ) == '1' ) { ?>
						<li>
							<a href="#" class="vu_social-link" data-href="https://twitter.com/share?text=<?php echo urlencode($title); ?>&amp;url=<?php echo esc_url($url); ?>"><i class="fa fa-twitter"></i></a>
						</li>
					<?php } if ( housico_get_option( array('shop-product-socials','google-plus') ) == '1' ) { ?>
						<li>
							<a href="#" class="vu_social-link" data-href="https://plus.google.com/share?url=<?php echo esc_url($url); ?>"><i class="fa fa-google-plus"></i></a>
						</li>
					<?php } if ( housico_get_option( array('shop-product-socials','pinterest') ) == '1' ) { ?>
						<li>
							<a href="#" class="vu_social-link" data-href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($url); ?>&amp;description=<?php echo urlencode($title); ?>&amp;media=<?php echo housico_get_attachment_image_src($post_id, array(705, 470)); ?>"><i class="fa fa-pinterest"></i></a>
						</li>
					<?php } if ( housico_get_option( array('shop-product-socials','linkedin') ) == '1' ) { ?>
						<li>
							<a href="#" class="vu_social-link" data-href="http://linkedin.com/shareArticle?mini=true&amp;title=<?php echo urlencode($title); ?>&amp;url=<?php echo esc_url($url); ?>"><i class="fa fa-linkedin"></i></a>
						</li>
					<?php } ?>
					</ul>
				</div>
		<?php 
			endif;
		}

		// Show responsive basket icon
		function housico_wc_show_responsive_basket_icon() { 
			if ( housico_get_option('shop-show-basket-icon', false) == true ) :
				ob_start(); ?>

				<div class="vu_wc-menu-item vu_wc-responsive">
					<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="vu_wc-cart-link"><span><i class="fa fa-shopping-cart"></i><span class="vu_wc-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span></a>
					
					<div class="vu_wc-menu-container">
						<div class="vu_wc-cart-notification"><span class="vu_wc-item-name"></span><?php esc_html_e("was successfully added to your cart.", 'housico'); ?></div>
						<div class="vu_wc-cart widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
					</div>
				</div>
				
			<?php 
				$output = ob_get_contents();
				ob_end_clean();

				echo ($output);
			endif;
		}

		// Get number of products in cart
		function housico_get_cart_contents_count() { 
			echo WC()->cart->get_cart_contents_count(); exit();
		}
	}

	$Housico_WC_Actions = new Housico_WC_Actions();
?>