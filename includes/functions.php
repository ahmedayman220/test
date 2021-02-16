<?php
	/**
	 *	Housico WordPress Theme
	 */

	// Print Title Bar
	if ( !function_exists('housico_title_bar') ) {
		function housico_title_bar($post_id, $title = null, $subtitle = null, $bg = null) {
			if ( housico_get_option('title-bar-show') == false ) {
				return;
			}

			$title_bar_style = housico_get_option('title-bar-style');

			if ( empty($title) ) {
				$title_bar_title = housico_get_option('title-bar-title');

				if ( !empty($title_bar_title) ) {
					$title = $title_bar_title;
				} else if ( is_front_page() and is_home() ) {
					$title = esc_html__('Latest Posts', 'housico');
				} else if ( is_single() and get_post_type() != 'product' ) {
					$title = ( get_option('page_for_posts', false) != false ) ? get_the_title( get_option('page_for_posts') ) : esc_html__('Latest Posts', 'housico');
				} else {
					$title = get_the_title($post_id);
				}
			}

			if ( empty($subtitle) ) {
				$subtitle = housico_get_option('title-bar-subtitle');
			}

			if ( empty($bg) ) {
				$bg = absint( housico_get_option( array('title-bar-bg-image', 'id') ) );
			}

			$parallax = housico_get_option('title-bar-parallax');

			$color_overlay = housico_get_option('title-bar-color-overlay');
			?>
				<!-- Title Bar -->
				<section class="vu_title-bar vu_tb-style-<?php echo esc_attr($title_bar_style); ?><?php echo ( !empty($bg) ) ? ' vu_tb-with-bg' : ''; ?><?php echo ( !empty($bg) && $parallax != true ) ? ' vu_lazy-load' : ''; ?>"<?php echo ( !empty($bg) && $parallax == true ) ? ' data-parallax="scroll" data-image-src="'. housico_get_attachment_image_src($bg, 'full') .'"' : ' data-img="'. housico_get_attachment_image_src($bg, 'full') .'"'; ?>>
					<style>
						.vu_title-bar { height: <?php echo absint(housico_get_option('title-bar-height')); ?>px; }
						<?php echo ( !empty($color_overlay) && !empty($bg) ) ? '.vu_title-bar.vu_tb-with-bg:before { background-color: '.esc_attr($color_overlay) .'; }' : ''; ?>
					</style>
					<div class="vu_tb-container">
						<div class="vu_tb-content">
							<div class="container">
								<?php if ( !empty($title) ) : ?>
									<h1 class="vu_tb-title" itemprop="headline"><?php echo esc_html($title); ?></h1>
								<?php endif; ?>

								<?php if ( $title_bar_style == '1' && housico_get_option('title-bar-breadcrumbs', false) != true ) : ?>
									<div class="vu_tb-breadcrumbs">
										<?php housico_breadcrumbs(); ?>
									</div>
								<?php endif; ?>

								<?php if ( $title_bar_style == '2' && !empty($subtitle) ) : ?>
									<span class="vu_tb-subtitle"><?php echo nl2br($subtitle); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>
				<!-- /Title Bar -->
			<?php 
		}
	}

	// Get Title Bar Background
	if ( !function_exists('housico_get_title_bar_bg') ) {
		function housico_get_title_bar_bg($page_id) {
			$housico_page_options = housico_get_post_meta( $page_id, 'housico_page_options' );

			if ( isset($housico_page_options['title-bar-bg-image']['id']) and !empty($housico_page_options['title-bar-bg-image']['id']) ) {
				return absint($housico_page_options['title-bar-bg-image']['id']);
			}

			return false;
		}
	}

	// Print Pagination
	if ( !function_exists('housico_pagination') ) {
		function housico_pagination($query = null) {
			global $wp_query, $wp_rewrite;

			if ( !empty($query) ) {
				$wp_query = $query;
			}

			$current_page = max(1, $wp_query->query_vars['paged']);
			$total_pages = $wp_query->max_num_pages;

			if ($total_pages > 1) {
				$permalink_structure = get_option('permalink_structure');
				$query_type = (count($_GET)) ? '&' : '?';
				$format = empty( $permalink_structure ) ? $query_type .'paged=%#%' : 'page/%#%/';
			
				echo '<div class="row"><div class="col-xs-12"><div class="vu_pagination">';
				
				$paginate_links = paginate_links(array(
					'base' => esc_url_raw(str_replace(999999999, '%#%', get_pagenum_link(999999999, false))),
					'format' => $format,
					'current' => $current_page,
					'total' => $total_pages,
					'type' => 'list',
					'prev_text' => '<i class="vu_fp-arrow_back" aria-hidden="true"></i>',
					'next_text' => '<i class="vu_fp-arrow_forward" aria-hidden="true"></i>',
					'before_page_number' => '',
					'after_page_number' => ''
				));

				echo str_replace("<ul class='page-numbers'>", '<ul class="vu_p-list list-unstyled">', $paginate_links);
				
				echo  '</div></div></div>';
			}
		}
	}

	// Print Pages Links
	if( !function_exists('housico_wp_link_pages') ) {
		function housico_wp_link_pages( $args = '' ) {
			$defaults = array(
				'before' => '<div class="row"><div class="col-xs-12"><div class="vu_pagination"><ul class="vu_p-list list-unstyled">', 
				'after' => '</ul></div></div></div>',
				'text_before' => '',
				'text_after' => '',
				'next_or_number' => 'number',
				'nextpagelink' => '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
				'previouspagelink' => '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
				'pagelink' => '%',
				'echo' => 1
			);

			$r = wp_parse_args( $args, $defaults );
			$r = apply_filters( 'wp_link_pages_args', $r );
			extract( $r, EXTR_SKIP );

			global $page, $numpages, $multipage, $more, $pagenow;

			$output = '';
			if ( $multipage ) {
				if ( 'number' == $next_or_number ) {
					$output .= $before;
					for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
						$j = str_replace( '%', $i, $pagelink );
						$output .= ' ';
						if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
							$output .= '<li>'. str_replace( '<a ', '<a class="page-numbers" ', _wp_link_page( $i ) );
						else
							$output .= '<li><span class="page-numbers current">';

						$output .= $text_before . $j . $text_after;
						if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
							$output .= '</a></li>';
						else
							$output .= '</span></li>';
					}
					$output .= $after;
				} else {
					if ( $more ) {
						$output .= $before;
						$i = $page - 1;
						if ( $i && $more ) {
							$output .= '<li>'. str_replace( '<a ', '<a class="prev page-numbers" ', _wp_link_page( $i ) );
							$output .= $text_before . $previouspagelink . $text_after . '</a></li>';
						}
						$i = $page + 1;
						if ( $i <= $numpages && $more ) {
							$output .= '<li>'. str_replace( '<a ', '<a class="next page-numbers" ', _wp_link_page( $i ) );
							$output .= $text_before . $nextpagelink . $text_after . '</a></li>';
						}
						$output .= $after;
					}
				}
			}

			if ( $echo )
				echo ($output);

			return $output;
		}
	}

	// Print Blog Social Networks
	if ( !function_exists('housico_blog_social_networks') ) {
		function housico_blog_social_networks($url, $title = null, $post_id = null) {
			if ( housico_get_option('blog-social-show') ) : ?>
				<div class="vu_bp-social-networks">
					<ul class="list-unstyled">
						<?php if ( housico_get_option( array('blog-social-networks', 'facebook') ) == '1' ) { ?>
							<li>
								<a href="#" class="vu_social-link" data-href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($url); ?>&amp;t=<?php echo urlencode($title); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							</li>
						<?php } if ( housico_get_option( array('blog-social-networks', 'twitter') ) == '1' ) { ?>
							<li>
								<a href="#" class="vu_social-link" data-href="https://twitter.com/share?text=<?php echo urlencode($title); ?>&amp;url=<?php echo esc_url($url); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
							</li>
						<?php } if ( housico_get_option( array('blog-social-networks', 'google-plus') ) == '1' ) { ?>
							<li>
								<a href="#" class="vu_social-link" data-href="https://plus.google.com/share?url=<?php echo esc_url($url); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
							</li>
						<?php } if ( housico_get_option( array('blog-social-networks', 'pinterest') ) == '1' ) { ?>
							<li>
								<a href="#" class="vu_social-link" data-href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($url); ?>&amp;description=<?php echo urlencode($title); ?>&amp;media=<?php echo housico_get_attachment_image_src($post_id, array(705, 470)); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
							</li>
						<?php } if ( housico_get_option( array('blog-social-networks', 'linkedin') ) == '1' ) { ?>
							<li>
								<a href="#" class="vu_social-link" data-href="http://linkedin.com/shareArticle?mini=true&amp;title=<?php echo urlencode($title); ?>&amp;url=<?php echo esc_url($url); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
							</li>
						<?php } ?>
					</ul>
				</div>
		<?php 
			endif;
		}
	}

	// Single Comment Template
	if ( !function_exists('housico_comments') ) {
		function housico_comments($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class('clearfix'); ?> id="vu_c-comment-<?php comment_ID(); ?>">
			<?php if ( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) : ?>
				<?php edit_comment_link(esc_html__('Edit', 'housico'), '<span class="vu_c-a-m-item vu_c-a-edit">', '</span>' ); ?>
				<p><?php echo esc_html__( 'Pingback:', 'housico' ); ?> <?php comment_author_link(); ?></p>
			<?php else : ?>
				<article id="comment-<?php comment_ID(); ?>" class="vu_c-article">
					<div class="vu_c-a-avatar">
						<?php echo get_avatar( get_comment_author_email() ); ?>
					</div>

					<div class="vu_c-a-container">
						<header class="vu_c-a-header">
							<h5 class="vu_c-a-author">
								<?php $comment_author_url = get_comment_author_url(); ?>

								<?php if ( !empty($comment_author_url) ) : ?>
									<a href="<?php comment_author_url(); ?>" rel="external nofollow"><?php comment_author(); ?></a>
								<?php 
									else :
										comment_author();
									endif;
								?>
							</h5>

							<div class="vu_c-a-meta">
								<span class="vu_c-a-m-item vu_c-a-date">
									<time datetime="<?php comment_date('c'); ?>"><?php comment_date(get_option('date_format')) ?> <?php esc_html_e('at', 'housico'); ?> <?php comment_date(get_option('time_format')); ?></time>
								</span>

								<?php edit_comment_link(esc_html__('Edit', 'housico'), '<span class="vu_c-a-m-item vu_c-a-edit">', '</span>' ); ?>

								<span class="vu_c-a-m-item vu_c-a-reply">
									<a href="#" class="vu_c-a-reply-link" data-id="<?php comment_ID(); ?>"><?php esc_html_e('Reply', 'housico'); ?></a>
								</span>
							</div>
						</header>
						
						<div class="vu_c-a-content">
							<?php if ($comment->comment_approved == '0') : ?>
								<p><em class="vu_c-a-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'housico'); ?></em></p>
							<?php endif; ?>

							<?php comment_text(); ?>
						</div>
					</div>
				</article>
			<?php endif; ?>
		<?php 
		}
	}

	// Get Page Options
	if ( !function_exists('housico_get_page_options') ) {
		function housico_get_page_options($page_id = null) {
			if ( empty($page_id) ) {
				global $post;

				if ( empty($post) ) {
					return false;
				}

				$page_id = $post->ID;
			}

			return housico_get_post_meta( $page_id, 'housico_page_options' );
		}
	}

	// Get Page Sidebar
	if ( !function_exists('housico_get_page_sidebar') ) {
		function housico_get_page_sidebar($page_id) {
			$housico_page_options = housico_get_post_meta( $page_id, 'housico_page_options' );

			$defaults = array(
				'sidebar' => '',
				'layout' => '',
				'position' => ''
			);

			return array_merge($defaults, array('sidebar' => $housico_page_options['sidebar'], 'layout' => $housico_page_options['sidebar-layout'], 'position' => $housico_page_options['sidebar-position'])); 
		}
	}

	// Get Blog Sidebar
	if ( !function_exists('housico_get_blog_sidebar') ) {
		function housico_get_blog_sidebar() {
			$page_id = get_option( 'page_for_posts' );

			$housico_page_options = housico_get_post_meta( $page_id, 'housico_page_options' );

			if ( $housico_page_options == false ) {
				return array(
					'sidebar' => 'blog-sidebar',
					'layout' => '3',
					'position' => 'right'
				);
			} else {
				return housico_get_page_sidebar( $page_id );
			} 
		}
	}
	
	// Check If Has Sidebar
	if ( !function_exists('housico_has_sidebar') ) {
		function housico_has_sidebar($data) {
			if ( !isset($data['sidebar']) or $data['sidebar'] == 'none' or empty($data['sidebar']) or !is_active_sidebar($data['sidebar']) ) {
				return false;
			}

			return true;
		}
	}
	
	// Print Dynamic Sidebar
	if ( !function_exists('housico_dynamic_sidebar') ) {
		function housico_dynamic_sidebar($sidebar) {
			if ( $sidebar == 'none' ) {
				return;
			}

			if ( !empty($sidebar) ) {
				dynamic_sidebar( $sidebar );
			}
		}
	}
	
	// Check if footer sidebars has widgets
	if ( !function_exists('housico_footer_sidebars_has_widgets') ) {
		function housico_footer_sidebars_has_widgets() {
			$footer_layout = @explode( '-', housico_get_option('footer-layout', '3-3-3-3') );

			for ( $i = 1; $i <= count($footer_layout); $i++ ) {
				if ( is_active_sidebar('footer-'. $i) ) {
					return true;
				}
			}

			return false;
		}
	}
	
	// Get Footer Custom CSS
	if ( !function_exists('housico_get_vc_page_custom_css') ) {
		function housico_get_vc_page_custom_css($page_id) {
			$custom_css = '';

			// Shortcodes custom css
			$shortcodes_custom_css = get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
			
			if ( !empty($shortcodes_custom_css) ) {
				$custom_css .= strip_tags($shortcodes_custom_css);
			}

			// Post custom css
			$post_custom_css = get_post_meta( $page_id, '_wpb_post_custom_css', true );
			
			if ( !empty($post_custom_css) ) {
				$custom_css .= strip_tags($post_custom_css);
			}

			return $custom_css;
		}
	}
	
	// Get Current URL
	if ( !function_exists('housico_get_current_url') ) {
		function housico_get_current_url() {
			global $wp;
			return home_url( add_query_arg( array() , $wp->request ) );
		}
	}

	/* ----------------------------------------------------------------------------------
	 * The following functions are also declared in the Housico Shortcodes Plugin.
	 * If you want to modify any of these functions you may need to make the same changes
	 * to the functions in Housico Shortcodes Plugin as well.
	 * ---------------------------------------------------------------------------------- */
	
	// Default theme options
	if ( !function_exists('housico_default_theme_options') ) {
		function housico_default_theme_options() {
			return json_decode('{"last_tab":"","logo-dark":{"url":"'. get_template_directory_uri() .'/assets/img/housico-logo-dark.png","id":"","height":"85","width":"443","thumbnail":"","title":"","caption":"","alt":"","description":""},"logo-light":{"url":"'. get_template_directory_uri() .'/assets/img/housico-logo-light.png","id":"","height":"85","width":"443","thumbnail":"","title":"","caption":"","alt":"","description":""},"logo-width":"140","preloader":"","preloader-image":{"url":"'. get_template_directory_uri() .'/assets/img/preloader.svg","id":"","height":"","width":"","thumbnail":"","title":"","caption":"","alt":"","description":""},"site-mode":"normal","site-mode-page":"","primary-color":"#eeb10b","secondary-color":"#303745","boxed-layout":"","body-background":{"background-color":"#ffffff","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"body-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"16px","line-height":"24px","color":"#595959"},"nav-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"17px","line-height":"24px","color":"#303745"},"nav-submenu-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"latin","text-transform":"none","font-size":"16px","line-height":"22px","color":"#595959"},"h1-typography":{"font-family":"Rubik","font-options":"","google":"true","font-weight":"500","font-style":"","subsets":"latin","text-transform":"none","font-size":"42px","line-height":"44px","color":"#303745"},"h2-typography":{"font-family":"Rubik","font-options":"","google":"true","font-weight":"300","font-style":"","subsets":"latin","text-transform":"none","font-size":"34px","line-height":"38px","color":"#303745"},"h3-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"24px","line-height":"30px","color":"#303745"},"h4-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"20px","line-height":"24px","color":"#303745"},"h5-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"16px","line-height":"20px","color":"#303745"},"h6-typography":{"font-family":"Rubik","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-transform":"none","font-size":"12px","line-height":"14px","color":"#303745"},"top-bar-show":"0","top-bar-layout":"boxed","top-bar-bg-color":{"background-color":"#303745"},"top-bar-text-color":"#ffffff","top-bar-left-content":"<span><i class=\"fa fa-phone-square\"></i>+1 0123 456 789</span><span><i class=\"fa fa-envelope-o\"></i> info@housicotheme.com</span>","top-bar-right-content":"<div class=\"vu_social-icon\"><a href=\"#\" target=\"_self\"><i class=\"fa fa-facebook\"></i></a></div><div class=\"vu_social-icon\"><a href=\"#\" target=\"_self\"><i class=\"fa fa-twitter\"></i></a></div><div class=\"vu_social-icon\"><a href=\"#\" target=\"_self\"><i class=\"fa fa-youtube\"></i></a></div><div class=\"vu_social-icon m-r-0\"><a href=\"#\" target=\"_self\"><i class=\"fa fa-instagram\"></i></a></div>","header-type":"1","header-layout":"boxed","header-padding":{"padding-top":"35px","padding-bottom":"30px","units":"px"},"header-transparent":"","header-nav-search-icon-show":"","header-nav-search-scope":"all","header-nav-submenu-width":"200","header-hamburger-menu":"1200","header-fixed":"1","header-fixed-offset":"150","header-fixed-logo-width":"150","header-fixed-padding":{"padding-top":"22px","padding-bottom":"17px","units":"px"},"title-bar-show":"1","title-bar-style":"1","title-bar-breadcrumbs":"1","title-bar-height":"180","title-bar-bg-image":{"url":"","id":"","height":"","width":"","thumbnail":"","title":"","caption":"","alt":"","description":""},"title-bar-parallax":"1","title-bar-color-overlay":"#000000","title-bar-color-overlay-opacity":"0.5","blog-social-show":"0","blog-social-networks":{"facebook":"1","twitter":"1","google-plus":"1","pinterest":"1","linkedin":""},"blog-show-date":"1","blog-show-author":"","blog-show-comments-number":"1","blog-show-categories":"","blog-show-tags":"","blog-single-show-tags":"1","map-google-api-key":"","map-center-lat":"","map-center-lng":"","map-zoom-level":"","map-height":"580","map-type":"roadmap","map-style":"","map-tilt-45":"","map-use-marker-img":"","map-marker-img":{"url":"","id":"","height":"","width":"","thumbnail":"","title":"","caption":"","alt":"","description":""},"map-enable-animation":"","map-others-options":{"draggable":"1","zoomControl":"","disableDoubleClickZoom":"","scrollwheel":"","panControl":"","fullscreenControl":"1","mapTypeControl":"","scaleControl":"","streetViewControl":""},"map-number-of-locations":"1","map-point-1":"","map-lat-1":"","map-lng-1":"","map-info-1":"","map-point-2":"","map-lat-2":"","map-lng-2":"","map-info-2":"","map-point-3":"","map-lat-3":"","map-lng-3":"","map-info-3":"","map-point-4":"","map-lat-4":"","map-lng-4":"","map-info-4":"","map-point-5":"","map-lat-5":"","map-lng-5":"","map-info-5":"","map-point-6":"","map-lat-6":"","map-lng-6":"","map-info-6":"","map-point-7":"","map-lat-7":"","map-lng-7":"","map-info-7":"","map-point-8":"","map-lat-8":"","map-lng-8":"","map-info-8":"","map-point-9":"","map-lat-9":"","map-lng-9":"","map-info-9":"","map-point-10":"","map-lat-10":"","map-lng-10":"","map-info-10":"","map-point-11":"","map-lat-11":"","map-lng-11":"","map-info-11":"","map-point-12":"","map-lat-12":"","map-lng-12":"","map-info-12":"","map-point-13":"","map-lat-13":"","map-lng-13":"","map-info-13":"","map-point-14":"","map-lat-14":"","map-lng-14":"","map-info-14":"","map-point-15":"","map-lat-15":"","map-lng-15":"","map-info-15":"","map-point-16":"","map-lat-16":"","map-lng-16":"","map-info-16":"","map-point-17":"","map-lat-17":"","map-lng-17":"","map-info-17":"","map-point-18":"","map-lat-18":"","map-lng-18":"","map-info-18":"","map-point-19":"","map-lat-19":"","map-lng-19":"","map-info-19":"","map-point-20":"","map-lat-20":"","map-lng-20":"","map-info-20":"","map-point-21":"","map-lat-21":"","map-lng-21":"","map-info-21":"","map-point-22":"","map-lat-22":"","map-lng-22":"","map-info-22":"","map-point-23":"","map-lat-23":"","map-lng-23":"","map-info-23":"","map-point-24":"","map-lat-24":"","map-lng-24":"","map-info-24":"","map-point-25":"","map-lat-25":"","map-lng-25":"","map-info-25":"","map-point-26":"","map-lat-26":"","map-lng-26":"","map-info-26":"","map-point-27":"","map-lat-27":"","map-lng-27":"","map-info-27":"","map-point-28":"","map-lat-28":"","map-lng-28":"","map-info-28":"","map-point-29":"","map-lat-29":"","map-lng-29":"","map-info-29":"","map-point-30":"","map-lat-30":"","map-lng-30":"","map-info-30":"","map-point-31":"","map-lat-31":"","map-lng-31":"","map-info-31":"","map-point-32":"","map-lat-32":"","map-lng-32":"","map-info-32":"","map-point-33":"","map-lat-33":"","map-lng-33":"","map-info-33":"","map-point-34":"","map-lat-34":"","map-lng-34":"","map-info-34":"","map-point-35":"","map-lat-35":"","map-lng-35":"","map-info-35":"","map-point-36":"","map-lat-36":"","map-lng-36":"","map-info-36":"","map-point-37":"","map-lat-37":"","map-lng-37":"","map-info-37":"","map-point-38":"","map-lat-38":"","map-lng-38":"","map-info-38":"","map-point-39":"","map-lat-39":"","map-lng-39":"","map-info-39":"","map-point-40":"","map-lat-40":"","map-lng-40":"","map-info-40":"","map-point-41":"","map-lat-41":"","map-lng-41":"","map-info-41":"","map-point-42":"","map-lat-42":"","map-lng-42":"","map-info-42":"","map-point-43":"","map-lat-43":"","map-lng-43":"","map-info-43":"","map-point-44":"","map-lat-44":"","map-lng-44":"","map-info-44":"","map-point-45":"","map-lat-45":"","map-lng-45":"","map-info-45":"","map-point-46":"","map-lat-46":"","map-lng-46":"","map-info-46":"","map-point-47":"","map-lat-47":"","map-lng-47":"","map-info-47":"","map-point-48":"","map-lat-48":"","map-lng-48":"","map-info-48":"","map-point-49":"","map-lat-49":"","map-lng-49":"","map-info-49":"","map-point-50":"","map-lat-50":"","map-lng-50":"","map-info-50":"","footer-show":"1","footer-type":"page","footer-layout":"3-3-3-3","footer-page":"123","footer-background":{"background-color":"#1a1a1a","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"footer-text-color":"#ffffff","subfooter-show":"1","subfooter-layout":"2","subfooter-alignment":"center","subfooter-full-content":"Copyright &copy; 2018 <a href=\"http://themeforest.net/user/flexipress/portfolio\" target=\"_blank\">FlexiPress</a>. All Rights Reserved.","subfooter-left-content":"Copyright &copy; 2018 <a href=\"http://themeforest.net/user/flexipress/portfolio\" target=\"_blank\">FlexiPress</a>. All Rights Reserved.","subfooter-right-content":"","subfooter-bg-color":{"background-color":"#303745"},"subfooter-text-color":"#ffffff","back-to-top-show":"1","sidebars":[],"google-analytics-tracking-code":"","twitter-consumer-key":"","twitter-consumer-secret":"","twitter-user-token":"","twitter-user-secret":"","custom-css":"body{line-height:26px;}.vu_main-menu>ul>li>a{padding:35px 7px 30px !important}.vu_blog-post .vu_bp-image img{width:auto;}.vu_pagination{margin-bottom:0;}.vu_main-footer{margin-top:70px;}#attachment_906.wp-caption.aligncenter{clear:both;padding-top:20px;}","custom-js":"","default-options":"1"}', true);
		}
	}

	// Remove wpautop
	if ( !function_exists('housico_remove_wpautop') ) {
		function housico_remove_wpautop($content, $autop = false) {
			if ( $autop ) {
				$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
			}

			return do_shortcode( shortcode_unautop($content) );
		}
	}

	// Shortcode atts
	if ( !function_exists('housico_shortcode_atts') ) {
		function housico_shortcode_atts($pairs, $atts, $shortcode = '') {
			$atts = shortcode_atts($pairs, $atts, $shortcode);

			return housico_prepare_atts($atts);
		}
	}

	// Prepare shortcode atts
	if ( !function_exists('housico_prepare_atts') ) {
		function housico_prepare_atts($atts) {
			$return = array();

			if ( is_array( $atts ) ) {
				foreach ( $atts as $key => $val ) {
					$return[ $key ] = str_replace( array(
						'`{`',
						'`}`',
						'``',
					), array(
						'[',
						']',
						'"',
					), $val );
				}
			}

			return $return;
		}
	}

	// Convert shortcode atts to string
	if ( !function_exists('housico_shortcode_atts_to_str') ) {
		function housico_shortcode_atts_to_str($atts) {
			$return = '';

			foreach ($atts as $key => $value) {
				$return .= ' '. $key .'="'. esc_attr($value) .'"';
			}

			return $return;
		}
	}

	// Generate shortcode as string
	if ( !function_exists('housico_generate_shortcode') ) {
		function housico_generate_shortcode($tag, $atts, $content = null) {
			$return = '['. $tag . housico_shortcode_atts_to_str($atts) .']';

			if ( !empty($content) ) {
				$return .= $content .'[/'. $tag .']';
			}

			return $return;
		}
	}

	// Extra class for shortcode
	if ( !function_exists('housico_extra_class') ) {
		function housico_extra_class($class, $echo = true) {
			$return = ((!empty($class)) ? ' '. trim(esc_attr($class)) : '');

			if ( $echo == true ) {
				echo ($return);
			} else {
				return $return;
			}
		}
	}

	// Custom/Random class for shortcode
	if( !function_exists('housico_custom_class') ) {
		function housico_custom_class() {
			return esc_attr('vu_custom_'. rand(1000000,9999999));
		}
	}

	// Get the URL (src) for an image attachment
	if ( !function_exists('housico_get_attachment_image_src') ) {
		function housico_get_attachment_image_src($attachment_id, $size = 'thumbnail', $icon = false, $return = 'url') {
			$image_attributes = wp_get_attachment_image_src( $attachment_id, $size, $icon );
			
			if ( $image_attributes ) {
				switch ($return) {
					case 'all':
						return $image_attributes;
						break;
					case 'url':
						return esc_url( $image_attributes[0] );
						break;
					case 'width':
						return $image_attributes[1];
						break;
					case 'height':
						return $image_attributes[2];
						break;
					case 'resized ':
						return $image_attributes[3];
						break;
				}
			} else {
				return false;
			}
		}
	}

	// Get image ratios
	if ( !function_exists('housico_get_image_ratios') ) {
		function housico_get_image_ratios() {
			return array(
				"1:1" => "1:1",
				"2:1" => "2:1",
				"3:2" => "3:2",
				"3:4" => "3:4",
				"4:3" => "4:3",
				"16:9" => "16:9"
			);
		}
	}

	// Print Excerpt with Custom Length
	if ( !function_exists('housico_the_excerpt') ) {
		function housico_the_excerpt($num_of_words, $post_excerpt = null) {
			$excerpt = empty($post_excerpt) ? get_the_excerpt() : $post_excerpt;

			$exwords = explode( ' ', trim( mb_substr( $excerpt, 0, mb_strlen($excerpt) - 5 ) ) );

			if ( count($exwords) > $num_of_words ) {
				$excerpt = array();

				$i = 0;
				foreach ($exwords as $value) {
					if ( $i >= $num_of_words ) break;
					array_push($excerpt, $value);
					$i++;
				}

				echo implode(' ', $excerpt) . ' [...]';
			} else {
				echo ($excerpt);
			}
		}
	}

	// Get Map Options from Theme Options
	if( !function_exists('housico_get_map_options') ) {
		function housico_get_map_options() {
			$map_options = array(
				'zoom_level' => esc_attr(housico_get_option('map-zoom-level')),
				'center_lat' => esc_attr(housico_get_option('map-center-lat')),
				'center_lng' => esc_attr(housico_get_option('map-center-lng')),
				"map_type" => esc_attr(housico_get_option('map-type')),
				"tilt_45" => esc_attr(housico_get_option('map-tilt-45')),
				'others_options' => array(
					"draggable" => esc_attr(housico_get_option( array('map-others-options', 'draggable') )),
					"zoomControl" => esc_attr(housico_get_option( array('map-others-options', 'zoomControl') )),
					"disableDoubleClickZoom" => esc_attr(housico_get_option( array('map-others-options', 'disableDoubleClickZoom') )),
					"scrollwheel" => esc_attr(housico_get_option( array('map-others-options', 'scrollwheel') )),
					"panControl" => esc_attr(housico_get_option( array('map-others-options', 'panControl') )),
					"fullscreenControl" => esc_attr(housico_get_option( array('map-others-options', 'fullscreenControl') )),
					"mapTypeControl" => esc_attr(housico_get_option( array('map-others-options', 'mapTypeControl') )),
					"scaleControl" => esc_attr(housico_get_option( array('map-others-options', 'scaleControl') )),
					"streetViewControl" => esc_attr(housico_get_option( array('map-others-options', 'streetViewControl') ))
				),
				'use_custom_marker' => esc_attr(housico_get_option('map-use-marker-img')),
				'custom_marker' => esc_attr(housico_get_option( array('map-marker-img', 'url') )),
				'enable_animation' => esc_attr(housico_get_option('map-enable-animation')),
				'locations' => array()
			);

			$number_of_locations = housico_get_option('number-of-locations');

			for($i=1; $i<=$number_of_locations; $i++) {
				if( housico_get_option('map-point-'. $i) != false ) {
					array_push($map_options['locations'], array('lat' => esc_attr(housico_get_option('map-lat-'. $i)), 'lng' => esc_attr(housico_get_option('map-lng-'. $i)), 'info' => esc_attr(housico_get_option('map-info-'. $i))));
				}
			}

			return $map_options;
		}
	}

	// Get Map Style
	if ( !function_exists('housico_get_map_style') ) {
		function housico_get_map_style($map_style) {
			switch ($map_style) {
				case '1':
					return '[{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]}]';
				case '2':
					return '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]';
				case '3':
					return '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]';
				case '4':
					return '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
				case '5':
					return '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]';
				case '6':
					return '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]';
				case '7':
					return '[{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}]';
				case '8':
					return '[{"featureType":"all","elementType":"all","stylers":[{"saturation":-100},{"gamma":0.5}]}]';
				case '9':
					return '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]';
				case '10':
					return '[{"elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#f5f5f2"},{"visibility":"on"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ffffff"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#71c8d4"}]},{"featureType":"landscape","stylers":[{"color":"#e5e8e7"}]},{"featureType":"poi.park","stylers":[{"color":"#8ba129"}]},{"featureType":"road","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"color":"#c7c7c7"},{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#a0d3d3"}]},{"featureType":"poi.park","stylers":[{"color":"#91b65d"}]},{"featureType":"poi.park","stylers":[{"gamma":1.51}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","stylers":[{"visibility":"simplified"}]},{"featureType":"road"},{"featureType":"road"},{},{"featureType":"road.highway"}]';
				case '11':
					return '[{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#b5cbe4"}]},{"featureType":"landscape","stylers":[{"color":"#efefef"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#83a5b0"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#bdcdd3"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e3eed3"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}]';
				case '12':
					return '[{"stylers":[{"hue":"#2c3e50"},{"saturation":250}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}]';
				case '13':
					return '[{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]';
				case '14':
					return '[{"featureType":"all","stylers":[{"saturation":0},{"hue":"#e7ecf0"}]},{"featureType":"road","stylers":[{"saturation":-70}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"simplified"},{"saturation":-60}]}]';
				case '15':
					return '[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-77}]},{"featureType":"road"}]';
				case '16':
					return '[{"stylers":[{"hue":"#dd0d0d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]}]';
				case '17':
					return '[{"featureType":"landscape","stylers":[{"hue":"#FFA800"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FBFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#00FFFD"},{"saturation":0},{"lightness":30},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00BFFF"},{"saturation":6},{"lightness":8},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#679714"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]}]';
				case '18':
					return '[{"stylers":[{"hue":"#16a085"},{"saturation":0}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}]';
				case '19':
					return '[{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#fffffa"}]},{"featureType":"water","stylers":[{"lightness":50}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"lightness":40}]}]';
				case '20':
					return '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]';
				case '21':
					return '[{"stylers":[{"visibility":"on"},{"saturation":-100}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":100},{"hue":"#00ffe6"}]},{"featureType":"road","elementType":"geometry","stylers":[{"saturation":100},{"hue":"#00ffcc"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]}]';
				case '22':
					return '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#fcfcfc"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#fcfcfc"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]}]';
				case '23':
					return '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#0465b0"},{"visibility":"on"}]}]';

				default:
					return "";
			}
		}
	}
?>