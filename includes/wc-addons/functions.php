<?php 
	/**
	 *	Housico WordPress Theme
	 */

	// Check is woocommece page
	if( !function_exists('housico_is_woocommerce') ) {
		function housico_is_woocommerce() {
			if ( is_woocommerce() or is_cart() or is_checkout() ) {
				return true;
			}

			return false;
		}
	}

	// Get Product Category or Product Tags
	if( !function_exists('housico_wc_product_terms') ) {
		function housico_wc_product_terms($post_id, $echo = true, $implode = ", ", $slug = false, $taxonomy = 'product_cat') {
			$terms = get_the_terms( $post_id, $taxonomy );

			$return = '';
								
			if ( $terms && ! is_wp_error( $terms ) ) {
				$terms_return = array();

				foreach ( $terms as $term ) {
					if( $slug ){
						$terms_return[] = $term->slug;
					} else {
						$terms_return[] = $term->name;
					}
				}
				
				$return = implode( $implode, $terms_return );
			}

			if ( $echo ) {
				echo ($return);
			} else {
				return $return;
			}
		}
	}

	// Get Product Format Price
	if( !function_exists('housico_wc_product_format_price') ) {
		function housico_wc_product_format_price($price) {
			extract( apply_filters( 'wc_price_args', array(
			'decimal_separator' => wc_get_price_decimal_separator(),
			'thousand_separator' => wc_get_price_thousand_separator(),
			'decimals' => wc_get_price_decimals(),
			'price_format' => get_woocommerce_price_format(),
			) ) );

			return number_format( $price, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	// Check if single product has sidebar
	if( !function_exists('housico_wc_single_product_has_sidebar') ) {
		function housico_wc_single_product_has_sidebar() {
			$shop_sidebar = housico_get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'housico_page_sidebar' );

			if ( function_exists('is_product') && is_product() && (housico_get_option('shop-show-sidebar-single-product', false) == false) ) {
				return false;
			}

			return housico_has_sidebar($shop_sidebar);
		}
	}

	// YWCTM: Checks if "Add to cart" needs to be hidden from loop page
	if( !function_exists('housico_wc_ywctm_check_hide_add_cart_loop') ) {
		function housico_wc_ywctm_check_hide_add_cart_loop() {
			if ( class_exists('YITH_WC_Catalog_Mode') ) {
				global $YITH_WC_Catalog_Mode;

				if ( method_exists($YITH_WC_Catalog_Mode, 'check_hide_add_cart_loop') and $YITH_WC_Catalog_Mode->check_hide_add_cart_loop() ) {
					return true;
				}
			}

			return false;
		}
	}
?>