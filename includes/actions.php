<?php
	/**
	 *	Housico WordPress Theme
	 */

	if ( !defined('ABSPATH') ) exit();

	class Housico_Actions {
		function __construct() {
			add_action('init', array($this, 'housico_init'));
			add_action('init', array($this, 'housico_fonts'));
			add_action('after_setup_theme', array($this, 'housico_load_theme_textdomain'));
			add_action('after_setup_theme', array($this, 'housico_after_setup_theme'));
			add_action('after_setup_theme', array($this, 'housico_content_width'), 0);
			add_action('wp_enqueue_scripts', array($this, 'housico_wp_enqueue_scripts'));
			add_action('admin_enqueue_scripts', array($this, 'housico_admin_enqueue_scripts'));
			add_action('template_redirect', array($this, 'housico_site_mode'));
			add_action('template_redirect', array($this, 'housico_overwrite_theme_options'));
			add_action('wp_head', array($this, 'housico_wp_head'));
			add_action('wp_head', array($this, 'housico_custom_css'), 200);
			add_action('housico_before_header', array($this, 'housico_before_header'));
			add_action('housico_after_header', array($this, 'housico_after_header'));
			add_action('housico_search_form', array($this, 'housico_search_form'));
			add_action('wp_footer', array($this, 'housico_wp_footer'));
			add_action('wp_footer', array($this, 'housico_custom_js'), 200);
			add_action('widgets_init', array($this, 'housico_widgets_init'));

			if ( class_exists('Housico_License') and Housico_License::is_valid() ) {
				add_action('tgmpa_register', array($this, 'housico_tgmpa_register'));
			}
		}

		// Theme Initialization
		function housico_init() {
			// Font FlexiPress
			wp_register_style('font-flexipress', HOUSICO_THEME_ASSETS . 'lib/font-flexipress/css/font-flexipress.css', array(), '1.0');

			// Font Awesome
			wp_register_style('font-awesome', HOUSICO_THEME_ASSETS . 'lib/font-awesome/css/font-awesome.min.css', array(), '4.7.0');

			// Font Housico
			wp_register_style('font-housico', HOUSICO_THEME_ASSETS . 'lib/font-housico/css/font-housico.css', array(), HOUSICO_THEME_VERSION);

			// Bootstrap
			wp_register_style('bootstrap', HOUSICO_THEME_ASSETS . 'lib/bootstrap/css/bootstrap.min.css', array(), '3.3.6');
			wp_register_script('bootstrap', HOUSICO_THEME_ASSETS . 'lib/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.6', true);

			// Datepicker
			wp_register_style('bootstrap-datepicker', HOUSICO_THEME_ASSETS . 'lib/bootstrap-datepicker/bootstrap-datepicker.css', array(), '1.5');
			wp_register_script('bootstrap-datepicker', HOUSICO_THEME_ASSETS . 'lib/bootstrap-datepicker/bootstrap-datepicker.js', array('jquery'), '1.5', true);
			
			// Timepicker
			wp_register_style('bootstrap-timepicker', HOUSICO_THEME_ASSETS . 'lib/bootstrap-timepicker/bootstrap-timepicker.min.css', array(), '0.2.6');
			wp_register_script('bootstrap-timepicker', HOUSICO_THEME_ASSETS . 'lib/bootstrap-timepicker/bootstrap-timepicker.min.js', array('jquery'), '0.2.6', true);

			// Select2
			wp_register_style('select2', HOUSICO_THEME_ASSETS . 'lib/select2/css/select2.min.css', array(), '4.0.3');
			wp_register_script('select2', HOUSICO_THEME_ASSETS . 'lib/select2/js/select2.full.min.js', array('jquery'), '4.0.3', true);
			
			// Owl Carousel
			wp_register_style('owl-carousel', HOUSICO_THEME_ASSETS . 'lib/owl-carousel/owl.carousel.min.css', array(), '1.3.3');
			wp_register_script('owl-carousel', HOUSICO_THEME_ASSETS . 'lib/owl-carousel/owl.carousel.min.js', array('jquery'), '1.3.3', true);

			// Magnific Popup
			wp_register_style('magnific-popup', HOUSICO_THEME_ASSETS . 'lib/magnific-popup/magnific-popup.min.css', array(), '1.1.0');
			wp_register_script('magnific-popup', HOUSICO_THEME_ASSETS . 'lib/magnific-popup/magnific-popup.min.js', array('jquery'), '1.1.0', true);

			// jQuery Plugins
			wp_register_script('jquery-animate-css', HOUSICO_THEME_ASSETS . 'js/jquery.animate.css.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-wait', HOUSICO_THEME_ASSETS . 'js/jquery.wait.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-waypoints', HOUSICO_THEME_ASSETS . 'js/jquery.waypoints.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-counterup', HOUSICO_THEME_ASSETS . 'js/jquery.counterup.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-easyPieChart', HOUSICO_THEME_ASSETS . 'js/jquery.easyPieChart.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-imagesLoaded', HOUSICO_THEME_ASSETS . 'js/jquery.imagesLoaded.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-inview', HOUSICO_THEME_ASSETS . 'js/jquery.inview.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-ui-tabs-rotate', HOUSICO_THEME_ASSETS . 'js/jquery.ui-tabs-rotate.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-isotope', HOUSICO_THEME_ASSETS . 'js/jquery.isotope.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-countdown', HOUSICO_THEME_ASSETS . 'js/jquery.countdown.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-match-height', HOUSICO_THEME_ASSETS . 'js/jquery.match-height.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-parallax', HOUSICO_THEME_ASSETS . 'js/jquery.parallax.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-tweet', HOUSICO_THEME_ASSETS . 'js/jquery.tweet.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-flickrfeed', HOUSICO_THEME_ASSETS . 'js/jquery.flickrfeed.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-ytplayer', HOUSICO_THEME_ASSETS . 'js/jquery.ytplayer.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-gmap3', HOUSICO_THEME_ASSETS . 'js/jquery.gmap3.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-vivus', HOUSICO_THEME_ASSETS . 'js/jquery.vivus.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			wp_register_script('jquery-compare-images', HOUSICO_THEME_ASSETS . 'js/jquery.compare-images.js', array('jquery'), HOUSICO_THEME_VERSION, true);

			// Common
			wp_register_style('housico-common-css', HOUSICO_THEME_ASSETS . 'css/common.css', array(), HOUSICO_THEME_VERSION);
			
			// Main
			wp_register_style('housico-main', HOUSICO_THEME_URL . 'style.css', array('housico-common-css'), HOUSICO_THEME_VERSION);
			wp_register_script('housico-main', HOUSICO_THEME_ASSETS . 'js/main.js', array('jquery'), HOUSICO_THEME_VERSION, true);
			
			// Config Object
			wp_localize_script( 'housico-main', 'housico_config',
				array(
					'ajaxurl' => admin_url("admin-ajax.php"),
					'home_url' => esc_url( home_url('/') ),
					'version' => HOUSICO_THEME_VERSION,
					'google_maps_api_key' => housico_get_option('map-google-api-key', '')
				)
			);

			// Admin
			wp_register_style('housico-admin-style', HOUSICO_THEME_ADMIN_ASSETS . 'css/admin.css', array(), HOUSICO_THEME_VERSION);
			wp_register_script('housico-admin-script', HOUSICO_THEME_ADMIN_ASSETS . 'js/admin.js', array( 'jquery', 'wp-color-picker' ), HOUSICO_THEME_VERSION, true);

			// Editor Style
			add_editor_style('mce-editor-style.css');
		}

		// Register Fonts
		function housico_fonts() {
			$fonts_url = '';
			$fonts     = array();
			$subsets   = 'latin,latin-ext';

			/* translators: If there are characters in your language that are not supported by Rubik, translate this to 'off'. Do not translate into your own language. */
			if ( 'off' !== _x( 'on', 'Rubik font: on or off', 'housico' ) ) {
				$fonts[] = 'Rubik:300,400,400i,500,500i,700,700i';
			}

			if ( $fonts ) {
				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				), 'https://fonts.googleapis.com/css' );
			}

			wp_register_style('housico-fonts', $fonts_url, array(), HOUSICO_THEME_VERSION);
		}

		// Theme Textdomain
		function housico_load_theme_textdomain() {
			load_theme_textdomain('housico', get_template_directory() . '/languages');
		}

		// After Setup Theme
		function housico_after_setup_theme() {
			// Theme Support
			add_theme_support('widgets');
			add_theme_support('title-tag');
			add_theme_support('automatic-feed-links');
			add_theme_support('post-thumbnails');
			add_theme_support('featured-image');
			add_theme_support('woocommerce');
			add_theme_support('custom-header');
			add_theme_support('custom-background');
			add_theme_support('post-formats', array('image', 'audio', 'video', 'gallery', 'link', 'quote', 'aside') );

			// Attachment sizes
			add_image_size('housico_ratio-1:1', 600, 600, true);
			add_image_size('housico_ratio-2:1', 800, 400, true);
			add_image_size('housico_ratio-3:2', 800, 533, true);
			add_image_size('housico_ratio-3:4', 450, 600, true);
			add_image_size('housico_ratio-4:3', 800, 600, true);
			add_image_size('housico_ratio-16:9', 800, 450, true);
			
			// Register Menus
			register_nav_menus(
				array(
					'main-menu-full' => esc_html__('Main Menu Full', 'housico'),
					'main-menu-left' => esc_html__('Main Menu Left', 'housico'),
					'main-menu-right' => esc_html__('Main Menu Right', 'housico')
				)
			);
		}

		// Theme Content Width
		function housico_content_width() {
			$GLOBALS['content_width'] = apply_filters( 'housico_content_width', 1170 );
		}

		// Enqueue Scripts
		function housico_wp_enqueue_scripts() {
			// Styles
			wp_enqueue_style(
				array(
					'housico-fonts',
					'wp-mediaelement',
					'font-flexipress',
					'font-awesome',
					'font-housico',
					'bootstrap',
					'bootstrap-datepicker',
					'bootstrap-timepicker',
					'magnific-popup',
					'owl-carousel',
					'select2',
					'housico-common-css',
					'housico-main'
				)
			);

			// Comment Reply
			if ( is_singular() && comments_open() && get_option('thread_comments') ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		// Enqueue Admin Scritps
		function housico_admin_enqueue_scripts() {
			// Styles
			wp_enqueue_style(
				array(
					'font-flexipress',
					'font-awesome',
					'font-housico',
					'wp-color-picker',
					'housico-admin-style'
				)
			);

			//Media Frame
			wp_enqueue_media();

			// Scripts
			wp_enqueue_script( 'housico-admin-script' );
		}

		// Site Mode
		function housico_site_mode() {
			if ( housico_get_option('site-mode') == 'under_housico' and get_the_ID() != housico_get_option('site-mode-page') and !is_user_logged_in() ) {
				wp_redirect( get_permalink( absint(housico_get_option('site-mode-page')) ) ); exit;
			}
		}

		// Overwrite theme options with page options
		function housico_overwrite_theme_options() {
			global $housico_theme_options;

			// Combine color overlay with opacity
			if ( !empty($housico_theme_options['title-bar-color-overlay']) ) {
				$housico_theme_options['title-bar-color-overlay'] = 'rgba('. housico_hex2rgb( $housico_theme_options['title-bar-color-overlay'], true ) .','. $housico_theme_options['title-bar-color-overlay-opacity'] .')';
			}

			$housico_page_options = housico_get_page_options(get_the_ID());

			if ( $housico_page_options != false ) {
				$housico_theme_options = housico_array_merge_recursive($housico_theme_options, $housico_page_options);
			}

			//print_r($housico_theme_options);
		}

		// Head Init
		function housico_wp_head() {
			if ( !function_exists('_wp_render_title_tag') ) { ?><title><?php wp_title(''); ?></title><?php }

			echo '<meta name="generator" content="Powered by FlexiPress" />';

			if ( housico_get_option('footer-type') == 'page' and trim( housico_get_option('footer-page') ) != '' ) {
				$footer_custom_css = housico_get_vc_page_custom_css(housico_get_option('footer-page'));
				if ( ! empty( $footer_custom_css ) ) {
					echo '<style type="text/css" id="housico_footer-custom-css">'. $footer_custom_css .'</style>';
				}
			}
		}

		// Custom CSS form Theme Options
		function housico_custom_css() {
			echo '<style type="text/css" id="housico_custom-css">'. housico_custom_css() .'</style>';
		}

		// Before Header
		function housico_before_header() {
			if ( housico_get_option('preloader') == true ) {
				echo '<div id="vu_preloader"></div>';
			}
		}

		// After Header
		function housico_after_header() {
			global $post;

			$header_title = $header_subtitle = $header_bg = null;
			$post_id = !empty($post->ID) ? $post->ID : null;

			if ( is_home() or is_page() or is_single() and get_post_type() != 'product' ) {
				$post_id = (get_post_type() == 'post') ? get_option( 'page_for_posts' ) : $post_id;
			} else if ( is_tax() ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				$header_title = $term->name;

				// WooCommerce
				if ( $term->taxonomy == 'product_cat' ) {
					$header_subtitle = sprintf(__("All products from '%s' category", 'housico'), $term->name);

					if ( function_exists('get_woocommerce_term_meta') ) {
						$header_bg = housico_get_attachment_image_src( absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) ), 'full' );
					} else {
						$header_bg = housico_get_title_bar_bg( get_option( 'woocommerce_shop_page_id' ) );
					}
				} else if ( $term->taxonomy == 'product_tag' ) {
					$header_subtitle = sprintf(__("All products tagged with '%s'", 'housico'), $term->name);
					$header_bg = housico_get_title_bar_bg( get_option( 'woocommerce_shop_page_id' ) );
				}
			} else if ( is_tag() ) {
				$header_title = single_tag_title('', false);
				$header_subtitle = sprintf(__("All posts tagged with '%s'", 'housico'), single_tag_title('', false));
				$header_bg = housico_get_title_bar_bg( get_option( 'page_for_posts' ) );
			} else if ( is_category() ) {
				$header_title = single_cat_title('', false);
				$header_subtitle = sprintf(__("All posts from '%s' category", 'housico'), single_cat_title('', false));
				$header_bg = housico_get_title_bar_bg( get_option( 'page_for_posts' ) );
			} else if ( is_author() ) {
				$current_author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

				$header_title = $current_author->nickname;
				$header_subtitle = sprintf(__("Posts by '%s'", 'housico'), $current_author->nickname);
				$header_bg = housico_get_title_bar_bg( get_option( 'page_for_posts' ) );
			} else if ( is_archive() ) {
				if ( is_day() ) {
					$header_title = get_the_date();
				} else if ( is_month() ) {
					$header_title = get_the_date('F Y');
				} else {
					$header_title = get_the_date('Y');
				}

				$header_subtitle = sprintf(__("Archives from '%s'", 'housico'), $header_title);
				$header_bg = housico_get_title_bar_bg( get_option( 'page_for_posts' ) );

				if ( function_exists('is_shop') and is_shop() ) {
					$post_id = get_option( 'woocommerce_shop_page_id' );
					$header_title = $header_subtitle = $header_bg = null;
				}
			} else if ( is_search() ) {
				$post_id = null;
				$header_title = esc_html__('Search', 'housico');
				$header_subtitle = sprintf(__("Search results for: '%s'", 'housico'), get_search_query());

				if ( get_query_var('post_type') == 'portfolio-item' ) {
					$header_bg = housico_get_option( array('portfolio-header-bg', 'url') );
				} else {
					$header_bg = housico_get_title_bar_bg( get_option( 'page_for_posts' ) );
				}
			} else if ( is_404() ) {
				$post_id = get_option( 'page_for_posts' );
				$header_title = esc_html__('Page not found', 'housico');
				$header_bg = null;
				$header_subtitle = esc_html__('Opps something went wrong', 'housico');
			} else if ( function_exists('is_cart') and is_cart() ) {
				$post_id = get_option( 'woocommerce_cart_page_id' );
			} else if ( function_exists('is_product') and is_product() ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			} else if ( is_page() ) {
				$post_id = $post->ID;
			} else {
				$header_title = $header_subtitle = $header_bg = null;
			}

			housico_title_bar($post_id, $header_title, $header_subtitle, $header_bg);

			do_action('housico_after_title_bar');
		}

		// Search Form
		function housico_search_form() {
			if ( housico_get_option('header-nav-search-icon-show', false) == true ) {
				$search_type = housico_get_option('header-nav-search-scope', 'post');

				if ( !empty($search_type) and $search_type != 'all' ) {
					echo '<input type="hidden" name="post_type" value="'. esc_attr($search_type) .'">';
				}
			}
		}

		// Footer Init
		function housico_wp_footer() {
			// Scripts
			wp_enqueue_script(
				array(
					'wp-mediaelement',
					'jquery-ui-core',
					'jquery-ui-accordion',
					'jquery-ui-tabs',
					'bootstrap',
					'bootstrap-datepicker',
					'bootstrap-timepicker',
					'magnific-popup',
					'owl-carousel',
					'select2',
					'jquery-animate-css',
					'jquery-wait',
					'jquery-waypoints',
					'jquery-counterup',
					'jquery-easyPieChart',
					'jquery-imagesLoaded',
					'jquery-inview',
					'jquery-ui-tabs-rotate',
					'jquery-isotope',
					'jquery-countdown',
					'jquery-match-height',
					'jquery-parallax',
					'jquery-tweet',
					'jquery-flickrfeed',
					'jquery-ytplayer',
					'jquery-vivus',
					'jquery-compare-images',
					'housico-main'
				)
			);

			// Google Analytics Tracking Code
			if ( trim(housico_get_option('google-analytics-tracking-code')) !== '' ) {
				echo housico_get_option('google-analytics-tracking-code');
			}

			// Search Modal
			if ( housico_get_option('header-nav-search-icon-show', false) == true ) {
				?>
					<div class="vu_search-modal">
						<div class="vu_sm-content">
							<a href="#" class="vu_sm-close"><i class="fa fa-times" aria-hidden="true"></i></a>
							<?php get_search_form(); ?>
						</div>
					</div>
				<?php 
			}
		}

		// Custom JS form Theme Options
		function housico_custom_js() {
			if ( trim(housico_get_option('custom-js')) !== '' ) {
				echo '<scr'.'ipt>'. housico_get_option('custom-js') .'</scr'.'ipt>';
			}
		}

		// Widgets Init
		function housico_widgets_init() {
			// Blog Sidebar
			register_sidebar(
				array(
					'id' => 'blog-sidebar',
					'name' => esc_html__('Blog Sidebar', 'housico'),
					
					'before_widget' => '<div class="widget %2$s %1$s clearfix">',
					'after_widget' => '</div>',
					
					'before_title' => '<h3 class="widget_title">',
					'after_title' => '</h3>'
				)
			);

			// Footer #1
			register_sidebar(
				array(
					'id' => 'footer-1',
					'name' => esc_html__('Footer #1', 'housico'),
					
					'before_widget' => '<div class="widget %2$s %1$s clearfix">',
					'after_widget' => '</div>',
					
					'before_title' => '<h3 class="widget_title">',
					'after_title' => '</h3>'
				)
			);

			// Footer #2
			register_sidebar(
				array(
					'id' => 'footer-2',
					'name' => esc_html__('Footer #2', 'housico'),
					
					'before_widget' => '<div class="widget %2$s %1$s clearfix">',
					'after_widget' => '</div>',
					
					'before_title' => '<h3 class="widget_title">',
					'after_title' => '</h3>'
				)
			);

			// Footer #3
			register_sidebar(
				array(
					'id' => 'footer-3',
					'name' => esc_html__('Footer #3', 'housico'),
					
					'before_widget' => '<div class="widget %2$s %1$s clearfix">',
					'after_widget' => '</div>',
					
					'before_title' => '<h3 class="widget_title">',
					'after_title' => '</h3>'
				)
			);

			// Footer #4
			register_sidebar(
				array(
					'id' => 'footer-4',
					'name' => esc_html__('Footer #4', 'housico'),
					
					'before_widget' => '<div class="widget %2$s %1$s clearfix">',
					'after_widget' => '</div>',
					
					'before_title' => '<h3 class="widget_title">',
					'after_title' => '</h3>'
				)
			);

			// Custom Sidebars
			$sidebars = housico_get_option('sidebars');

			if ( is_array($sidebars) ) {
				foreach ($sidebars as $sidebar) {
					if ( !empty($sidebar) ){
						register_sidebar(
							array(
								'id' => sanitize_title($sidebar),
								'name' => $sidebar,
								
								'before_widget' => '<div class="widget %2$s %1$s clearfix">',
								'after_widget' => '</div>',
								
								'before_title' => '<h3 class="widget_title">',
								'after_title' => '</h3>'
							)
						);
					}
				}
			}
		}

		// Register Theme Plugins
		function housico_tgmpa_register() {
			$plugins = array(
				array(
					'name'                   => 'Housico Options',
					'slug'                   => 'housico-options',
					'source'                 => HOUSICO_THEME_DIR .'plugins/housico-options.zip',
					'required'               => true,
					'version'                => HOUSICO_THEME_VERSION,
					'force_activation'       => false,
					'force_deactivation'     => false,
				),
				array(
					'name'                   => 'Housico Shortcodes',
					'slug'                   => 'housico-shortcodes',
					'source'                 => HOUSICO_THEME_DIR .'plugins/housico-shortcodes.zip',
					'required'               => true,
					'version'                => HOUSICO_THEME_VERSION,
					'force_activation'       => false,
					'force_deactivation'     => false,
				),
				array(
					'name'                   => 'WPBakery Page Builder',
					'slug'                   => 'js_composer',
					'source'                 => HOUSICO_THEME_DIR .'plugins/js_composer.zip',
					'required'               => true,
					'version'                => '5.4.7',
					'force_activation'       => false,
					'force_deactivation'     => false,
				),
				array(
					'name'                   => 'Slider Revolution',
					'slug'                   => 'revslider',
					'source'                 => HOUSICO_THEME_DIR .'plugins/revslider.zip',
					'required'               => true,
					'version'                => '5.4.7.2',
					'force_activation'       => false,
					'force_deactivation'     => false,
				),
				array(
					'name'                   => 'Contact Form 7',
					'slug'                   => 'contact-form-7',
					'required'               => true
				),
				array(
					'name'                   => 'MailChimp for WordPress',
					'slug'                   => 'mailchimp-for-wp',
					'required'               => false
				)
			);
			
			$config = array(
				'domain'                              => 'housico', 
				'default_path'                        => '',
				'parent_slug'                         => 'themes.php',
				'capability'                          => 'edit_theme_options',
				'menu'                                => 'install-required-plugins',
				'has_notices'                         => true,
				'dismissable'                         => true,
				'is_automatic'                        => false,
				'message'                             => '',
				'strings'                             => array(
					'page_title'                         => esc_html__( 'Install Required Plugins', 'housico' ),
					'menu_title'                         => esc_html__( 'Install Plugins', 'housico' ),
					'installing'                         => esc_html__( 'Installing Plugin: %s', 'housico' ),
					'oops'                               => esc_html__( 'Something went wrong with the plugin API.', 'housico' ),
					'notice_can_install_required'        => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'housico' ),
					'notice_can_install_recommended'     => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'housico' ),
					'notice_cannot_install'              => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'housico' ),
					'notice_can_activate_required'       => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'housico' ),
					'notice_can_activate_recommended'    => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'housico' ), 
					'notice_cannot_activate'             => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'housico' ),
					'notice_ask_to_update'               => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'housico' ),
					'notice_cannot_update'               => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'housico' ),
					'install_link'                       => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'housico' ),
					'activate_link'                      => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'housico' ),
					'return'                             => esc_html__( 'Return to Required Plugins Installer', 'housico' ),
					'plugin_activated'                   => esc_html__( 'Plugin activated successfully.', 'housico' ),
					'complete'                           => esc_html__( 'All plugins installed and activated successfully. %s', 'housico' ), 
					'nag_type'                           => 'updated'
				)
			);

			tgmpa( $plugins, $config );
		}
	}

	$Housico_Actions = new Housico_Actions();
?>