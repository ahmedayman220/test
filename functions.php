<?php
	/**
	 * Housico WordPress Theme
	 */

	// Constants
	define('HOUSICO_THEME_DIR', get_template_directory() .'/');
	define('HOUSICO_THEME_URL', get_template_directory_uri() .'/');
	define('HOUSICO_THEME_ASSETS', HOUSICO_THEME_URL .'assets/');
	define('HOUSICO_THEME_ADMIN_ASSETS', HOUSICO_THEME_URL .'includes/admin/');
	define('HOUSICO_THEME_VERSION', '1.0');

	// Core Files
	require_once(HOUSICO_THEME_DIR .'includes/helpers.php');
	require_once(HOUSICO_THEME_DIR .'includes/functions.php');
	require_once(HOUSICO_THEME_DIR .'includes/license.php');
	require_once(HOUSICO_THEME_DIR .'includes/actions.php');
	require_once(HOUSICO_THEME_DIR .'includes/filters.php');

	// Meta
	require_once(HOUSICO_THEME_DIR .'includes/meta/config.php');
	require_once(HOUSICO_THEME_DIR .'includes/meta/page-options.php');
	require_once(HOUSICO_THEME_DIR .'includes/meta/post-meta.php');

	// Library Files
	require_once(HOUSICO_THEME_DIR .'includes/lib/breadcrumbs.php');
	require_once(HOUSICO_THEME_DIR .'includes/lib/class-tgm-plugin-activation.php');

	// Custom CSS
	require_once(HOUSICO_THEME_DIR .'includes/custom-css.php');

	// VC Files
	if ( in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		require_once(HOUSICO_THEME_DIR .'includes/vc-addons/config.php');
		require_once(HOUSICO_THEME_DIR .'includes/vc-addons/params.php');
		require_once(HOUSICO_THEME_DIR .'includes/vc-addons/modify.php');
	} else {
		require_once(HOUSICO_THEME_DIR .'includes/vc-addons/functions.php');
	}

	// WC Files
	if ( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
		require_once(HOUSICO_THEME_DIR .'includes/wc-addons/custom-css.php');
		require_once(HOUSICO_THEME_DIR .'includes/wc-addons/functions.php');
		require_once(HOUSICO_THEME_DIR .'includes/wc-addons/actions.php');
		require_once(HOUSICO_THEME_DIR .'includes/wc-addons/filters.php');
	}

	// ------------------------------ Functions ------------------------------

	// Main Menu Wrap
	if ( !function_exists('housico_main_menu_wrap') ) {
		function housico_main_menu_wrap() {
			$wrap  = '<ul id="%1$s" class="%2$s'. (trim(housico_get_option( array('nav-submenu-typography', 'text-align') )) != '' ? ' vu_mm-submenu-'. housico_get_option( array('nav-submenu-typography', 'text-align') ) : '') .'">';
			$wrap .= '%3$s';

			$wrap .= '</ul>';

			return $wrap;
		}
	}

	// Main Menu fallback_cb
	if ( !function_exists('housico_main_menu_fallback_cb') ) {
		function housico_main_menu_fallback_cb($menu_location = 'main-menu-full') {
			$nav_menu_locations = get_theme_mod('nav_menu_locations');
			
			if ( !isset($nav_menu_locations[$menu_location]) or $nav_menu_locations[$menu_location] == 0 ) {
				$menu = wp_page_menu(
					array(
						'menu_id'     => 'vu_mm-top',
						'menu_class'  => 'vu_mm-list vu_mm-top list-unstyled',
						'container'   => 'ul',
						'echo'        => false,
						'before'      => '',
						'after'       => ''
					)
				);

				$menu = preg_replace("/class='children'/", "class='children sub-menu'", $menu );

				$menu = preg_replace("/page_item_has_children/", "page_item_has_children menu-item-has-children", $menu );

				echo preg_replace("/current_page_item/", "current_page_item current-menu-item", $menu );
			}
		}
	}

	// Get theme option value
	if ( !function_exists('housico_get_option') ) {
		function housico_get_option($option, $default = '') {
			global $housico_theme_options;

			if ( (empty($housico_theme_options) or !isset($housico_theme_options['last_tab'])) and !isset($housico_theme_options['default-options']) ) {
				$housico_theme_options = housico_default_theme_options();
			}

			if ( is_array($option) ) {
				$count = count($option);

				switch ($count) {
					case 2:
						return isset($housico_theme_options[$option[0]][$option[1]]) ? $housico_theme_options[$option[0]][$option[1]] : $default;
						break;
					case 3:
						return isset($housico_theme_options[$option[0]][$option[1]][$option[2]]) ? $housico_theme_options[$option[0]][$option[1]][$option[2]] : $default;
						break;
						
					default:
						return isset($housico_theme_options[$option[0]]) ? $housico_theme_options[$option[0]] : $default;
						break;
				}
			} else {
				return isset($housico_theme_options[$option]) ? $housico_theme_options[$option] : $default;
			}
		}
	}
?>