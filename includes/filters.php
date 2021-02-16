<?php 
	/**
	 *	Housico WordPress Theme
	 */

	if ( !defined('ABSPATH') ) exit();

	class Housico_Filters {
		function __construct() {
			add_filter( 'widget_text', 'do_shortcode' ); // Allow Shortcodes to be used on Text Widgets
			add_filter( 'redux/field/housico_theme_options/value', array($this, 'housico_redux_field_value'), 10, 2 );
			add_filter( 'wp_title', array($this, 'housico_wp_title'), 10, 2 );
			add_filter( 'document_title_separator', array($this, 'housico_document_title_separator') );
			add_filter( 'body_class', array($this, 'housico_body_class') );
			add_filter( 'the_content', array($this, 'housico_the_content') );
			add_filter( 'nav_menu_link_attributes', array($this, 'housico_nav_menu_link_attributes'), 10, 3 );
			add_filter( 'wp_nav_menu_items', array($this, 'housico_wp_nav_menu_items'), 10, 2);
			add_filter( 'wp_nav_menu', array($this, 'housico_wp_nav_menu'), 10, 2 );
			add_filter( 'upload_mimes', array($this, 'housico_upload_mimes') );
			add_filter( 'wp_check_filetype_and_ext', array($this, 'housico_wp_check_filetype_and_ext'), 75, 4 );
			add_filter( 'comment_form_fields', array($this, 'housico_comment_form_fields') );
			add_filter( 'wpcf7_ajax_loader', array($this, 'housico_wpcf7_ajax_loader') );
		}
		
		// Filter redux filed value before output dynamic css
		function housico_redux_field_value($value, $field) {
			$keys = array('body-background', 'top-bar-bg-color', 'top-bar-text-color', 'header-padding', 'header-fixed-padding', 'footer-background', 'footer-background', 'footer-text-color', 'subfooter-bg-color', 'subfooter-text-color');

			if ( isset($field['id']) && in_array($field['id'], $keys) ) {
				$housico_get_page_options = housico_get_page_options();

				if ( $housico_get_page_options != false && isset($housico_get_page_options[$field['id']]) && is_array($housico_get_page_options[$field['id']]) ) {
					foreach ($housico_get_page_options[$field['id']] as $k => $v) {
						if ( isset($value[$k]) && trim($v) != '' ) {
							$value[$k] = $v;
						}
					}
				}
			}

			return $value;
		}
		
		// Filter wp_title
		function housico_wp_title( $title, $sep ) {
			$title = get_bloginfo('name') ." ". $sep ." ". ((is_home() || is_front_page()) ? get_bloginfo('description') : $title);

			return $title;
		}
		
		// Filter document_title_separator
		function housico_document_title_separator( $sep ) {
			return '|';
		}
		
		// Add specific CSS class by filter
		function housico_body_class( $classes ) {
			// Skin
			if ( housico_get_option('site-skin', 'light') == 'light' ) {
				$classes[] = 'vu_site-skin-light';
			} else {
				$classes[] = 'vu_site-skin-dark';
			}

			// Layout
			if ( housico_get_option('boxed-layout') == true ) {
				$classes[] = 'vu_site-layout-boxed';
			} else {
				$classes[] = 'vu_site-layout-full';
			}

			// Search Icon
			if ( housico_get_option('header-nav-search-icon-show', false) == true ) {
				$classes[] = 'vu_site-with-search-icon';
			}

			return $classes;
		}
		
		// Fix VC bug if page content has '<!--nextpage-->'
		function housico_the_content( $content ) {
			global $multipage;

			if ( is_page() and $multipage ) {
				global $page;

				$_content = strip_tags($content);

				if ( $page >= 2 ) {
					if ( housico_string_starts_with($_content, '[/vc_column_text]') ) {
						$content = preg_replace('/(\[\/vc_column_text]\[\/vc_column]\[\/vc_row\])/', '', $content, 1);
					}

					if ( housico_string_starts_with($_content, '[/vc_section]') ) {
						$content = preg_replace('/(\[\/vc_section\])/', '', $content, 1);
					}
				}
			}

			return $content;
		}

		// Add 'itemprop' attribute for links in menu
		function housico_nav_menu_link_attributes( $atts, $item, $args ) {
			$atts['itemprop'] = 'url';
			return $atts;
		}
		
		// Show search icon in menu
		function housico_wp_nav_menu_items( $items, $args ) {
			if ( ($args->theme_location == 'main-menu-full' or $args->theme_location == 'main-menu-right') and housico_get_option('header-nav-search-icon-show', false) == true ) {

				ob_start(); ?>
					<li class="vu_search-menu-item">
						<a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
					</li>
				<?php

				$items .= ob_get_contents();
				ob_end_clean();
			}

			return $items;
		}

		// Add Font Awesome icons to menu - (https://wordpress.org/plugins/font-awesome-4-menus/)
		function housico_wp_nav_menu( $nav ) {
			$menu_item = preg_replace_callback(
				'/(<li[^>]+class=")([^"]+)("?[^>]+>[^>]+>)([^<]+)<\/a>/',
				array($this, 'housico_wp_nav_menu_replace'),
				$nav
			);
			return $menu_item;
		}
		
		function housico_wp_nav_menu_replace( $a ) {
			$start = $a[ 1 ];
			$classes = $a[ 2 ];
			$rest = $a[ 3 ];
			$text = $a[ 4 ];
			$before = true;
			
			$class_array = explode( ' ', $classes );
			$fontawesome_classes = array();

			foreach( $class_array as $key => $val ){
				if( 'fa' == substr( $val, 0, 2 ) ){
					if( 'fa' == $val ){
						unset( $class_array[ $key ] );
					} elseif( 'fa-after' == $val ){
						$before = false;
						unset( $class_array[ $key ] );
					} else {
						$fontawesome_classes[] = $val;
						unset( $class_array[ $key ] );
					}
				}
			}
			
			if( !empty( $fontawesome_classes ) ){
				$fontawesome_classes[] = 'fa';
				if( $before ){
					$newtext = '<i class="'.implode( ' ', $fontawesome_classes ).'"></i><span>'.$text.'</span>';
				} else {
					$newtext = '<span>'.$text.'</span><i class="'.implode( ' ', $fontawesome_classes ).'"></i>';
				}
			} else {
				$newtext = $text;
			}
			
			$item = $start.implode( ' ', $class_array ).$rest.$newtext.'</a>';

			return $item;
		}

		// Allow uploading SVG Files
		function housico_upload_mimes($mimes){
			$mimes['svg'] = 'image/svg+xml';

			return $mimes;
		}

		function housico_wp_check_filetype_and_ext( $data = null, $file = null, $filename = null, $mimes = null ) {
			$ext = isset( $data['ext'] ) ? $data['ext'] : '';

			if ( strlen( $ext ) < 1 ) {
				$ext = strtolower( end( explode( '.', $filename ) ) );
			}

			if ( $ext === 'svg' ) {
				$data['type'] = 'image/svg+xml';
				$data['ext']  = 'svg';
			}

			return $data;
		}

		// Moving the Comment Text Field to Bottom
		function housico_comment_form_fields($fields) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
			return $fields;
		}

		// Contact Form 7 change ajax loader image
		function housico_wpcf7_ajax_loader($url) {
			return 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHdpZHRoPScyOHB4JyBoZWlnaHQ9JzI4cHgnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0idWlsLXJpbmctYWx0Ij48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0ibm9uZSIgY2xhc3M9ImJrIj48L3JlY3Q+PGNpcmNsZSBjeD0iNTAiIGN5PSI1MCIgcj0iNDAiIHN0cm9rZT0iI2RkZCIgZmlsbD0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIj48L2NpcmNsZT48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjNDQ0NDQ0IiBmaWxsPSJub25lIiBzdHJva2Utd2lkdGg9IjYiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCI+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0ic3Ryb2tlLWRhc2hvZmZzZXQiIGR1cj0iMnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiBmcm9tPSIwIiB0bz0iNTAyIj48L2FuaW1hdGU+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0ic3Ryb2tlLWRhc2hhcnJheSIgZHVyPSIycyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHZhbHVlcz0iMTUwLjYgMTAwLjQ7MSAyNTA7MTUwLjYgMTAwLjQiPjwvYW5pbWF0ZT48L2NpcmNsZT48L3N2Zz4=';
		}
	}

	$Housico_Filters = new Housico_Filters();
?>