<?php 
	// Custom CSS
	if( !function_exists('housico_wc_custom_css') ){
		function housico_wc_custom_css($echo = false){
			// Primary Color - Default : #fdb822
			$primary_color_hex = esc_attr(housico_get_option('primary-color', '#fdb822'));
			$primary_color_rgb = esc_attr(housico_hex2rgb($primary_color_hex, true));

			// Secondary Color - Default : #684f40
			$secondary_color_hex = esc_attr(housico_get_option('secondary-color', '#684f40'));
			$secondary_color_rgb = esc_attr(housico_hex2rgb($secondary_color_hex, true));

			ob_start();
		?>
			/* WooCommerce */

			.vu_wc-heading {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-heading:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce input.button,
			.woocommerce button.button,
			.woocommerce a.button {
			  border: 2px solid <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-footer .woocommerce input.button,
			.vu_main-footer .woocommerce button.button,
			.vu_main-footer .woocommerce a.button {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce input.button:hover,
			.woocommerce button.button:hover,
			.woocommerce a.button:hover {
			  color: <?php echo ($primary_color_hex); ?> !important;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-footer .woocommerce input.button:hover,
			.vu_main-footer .woocommerce button.button:hover,
			.vu_main-footer .woocommerce a.button:hover {
			  color: <?php echo ($primary_color_hex); ?> !important;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce .button.checkout,
			.woocommerce input.alt,
			.woocommerce button.alt,
			.woocommerce a.alt {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-footer .woocommerce .button.checkout,
			.vu_main-footer .woocommerce input.alt,
			.vu_main-footer .woocommerce button.alt,
			.vu_main-footer .woocommerce a.alt {
			  color: <?php echo ($primary_color_hex); ?> !important;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce .button.checkout:hover,
			.woocommerce input.alt:hover,
			.woocommerce button.alt:hover,
			.woocommerce a.alt:hover {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			  background-color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_main-footer .woocommerce .button.checkout:hover,
			.vu_main-footer .woocommerce input.alt:hover,
			.vu_main-footer .woocommerce button.alt:hover,
			.vu_main-footer .woocommerce a.alt:hover {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_dropdown {
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_dropdown:after {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_dropdown .vu_dd-options {
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce div.product .product_title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce .woocommerce-product-rating .star-rating {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce .woocommerce-product-rating .woocommerce-review-link {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce .woocommerce-product-rating .woocommerce-review-link:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce div.product p.price,
			.woocommerce div.product span.price {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-product-social-networks a {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-product-social-networks a:hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce #reviews #comments ol.commentlist li .star-rating {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce #review_form #respond #reply-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce #review_form #respond p.stars a,
			.woocommerce #review_form #respond p.stars .active {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce-cart table.cart td.actions input[name="update_cart"] {
			  border-color: <?php echo ($secondary_color_hex); ?> !important;
			  background-color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.woocommerce-cart table.cart td.actions input[name="update_cart"]:hover {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			  border-color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.woocommerce-cart .cart-collaterals .cart_totals table .cart-subtotal th,
			.woocommerce-cart .cart-collaterals .cart_totals table .cart-subtotal td {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce-cart .cart-collaterals .cart_totals table .order-total th,
			.woocommerce-cart .cart-collaterals .cart_totals table .order-total td {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce .woocommerce-validated .select2-container .select2-selection {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce table.order_details tfoot tr:last-child th,
			.woocommerce table.order_details tfoot tr:last-child td,
			.woocommerce table.woocommerce-checkout-review-order-table tfoot tr:last-child th,
			.woocommerce table.woocommerce-checkout-review-order-table tfoot tr:last-child td {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.woocommerce table.woocommerce-checkout-review-order-table tfoot .cart-subtotal th,
			.woocommerce table.woocommerce-checkout-review-order-table tfoot .cart-subtotal td {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.woocommerce form .form-row .required {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-cart-link:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-count {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-cart-notification {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-cart-notification:before {
			  border-bottom-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-cart-notification .vu_wc-item-name {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-menu-item .vu_wc-cart .widget_shopping_cart_content {
			  border-bottom: 3px solid <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce.widget_shopping_cart .widget_shopping_cart_content .cart_list li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce.widget_shopping_cart .widget_shopping_cart_content .total .amount {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-footer .woocommerce.widget_shopping_cart .widget_shopping_cart_content .total .amount {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce-product-search:after {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce-product-search input[type="search"] {
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce.widget_product_categories a:hover,
			.woocommerce.widget_product_categories a:hover + .count,
			.woocommerce.widget_layered_nav a:hover,
			.woocommerce.widget_layered_nav a:hover + .count {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-footer .woocommerce ul.cart_list li a:hover,
			.vu_main-footer .woocommerce ul.product_list_widget li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce ul.cart_list li a:hover .product-title,
			.woocommerce ul.product_list_widget li a:hover .product-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce ul.cart_list li .star-rating,
			.woocommerce ul.product_list_widget li .star-rating {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce.widget_product_tag_cloud a {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.woocommerce.widget_product_tag_cloud a.active,
			.woocommerce.widget_product_tag_cloud a:hover {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce.widget_price_filter .ui-slider .ui-slider-handle {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-products.vu_p-type-carousel .vu_p-carousel .owl-buttons .owl-prev,
			.vu_wc-products.vu_p-type-carousel .vu_p-carousel .owl-buttons .owl-next {
			  color: <?php echo ($secondary_color_hex); ?>;
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-products.vu_p-type-carousel .vu_p-carousel .owl-buttons .owl-prev:hover,
			.vu_wc-products.vu_p-type-carousel .vu_p-carousel .owl-buttons .owl-next:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-product.vu_p-style-1,
			.vu_wc-product.vu_p-style-3 {
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-product.vu_p-style-1 .vu_p-content,
			.vu_wc-product.vu_p-style-2 .vu_p-content {
			  background-color: rgba(<?php echo ($primary_color_rgb); ?>,0.9);
			}
			.vu_wc-product .vu_p-icon {
			  color: <?php echo ($primary_color_hex); ?>;
			  border: 2px solid <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-product.vu_p-style-3 .vu_p-icon,
			.vu_wc-product.vu_p-style-4 .vu_p-icon {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-product .vu_p-icon:hover {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-product.vu_p-style-3 .vu_p-name,
			.vu_wc-product.vu_p-style-4 .vu_p-name {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-product.vu_p-style-3 .vu_p-price,
			.vu_wc-product.vu_p-style-4 .vu_p-price {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-categories.vu_c-type-carousel .vu_c-carousel .owl-buttons .owl-prev,
			.vu_wc-categories.vu_c-type-carousel .vu_c-carousel .owl-buttons .owl-next {
			  color: <?php echo ($secondary_color_hex); ?>;
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-categories.vu_c-type-carousel .vu_c-carousel .owl-buttons .owl-prev:hover,
			.vu_wc-categories.vu_c-type-carousel .vu_c-carousel .owl-buttons .owl-next:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-category a {
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-category a:hover {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_wc-category .vu_c-name,
			.vu_wc-category .vu_c-count {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_wc-category .vu_c-count {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			
		<?php 
			$custom_css = ob_get_contents();
			ob_end_clean();

			if( $echo ){
				echo housico_css_compress($custom_css);
			} else {
				return housico_css_compress($custom_css);
			}
		}
	}
?>