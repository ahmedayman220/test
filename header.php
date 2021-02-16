<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo("charset") ); ?>">

	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link rel="pingback" href="<?php echo esc_url( get_bloginfo("pingback_url") ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
	<?php do_action('housico_before_header'); ?>
	
	<!-- Main Container -->
	<div class="vu_main-container">
		<!-- Header -->
		<header id="vu_main-header" class="vu_main-header vu_mh-layout-<?php echo esc_attr(housico_get_option('header-layout', 'boxed')); ?> vu_mh-type-<?php echo esc_attr( housico_get_option('header-type', '1') ); ?><?php echo ( housico_get_option('header-transparent') == true ) ? ' vu_mh-transparent' : ''; ?>" role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<?php if ( housico_get_option('top-bar-show') ) : ?>
				<div class="vu_top-bar vu_tb-layout-<?php echo esc_attr(housico_get_option('top-bar-layout', 'boxed')); ?>">
					<div class="container">
						<div class="row">
							<div class="vu_tb-left col-md-7">
								<?php echo do_shortcode( wp_kses_post( housico_get_option('top-bar-left-content') ) ); ?>
							</div>
							<div class="vu_tb-right col-md-5">
								<?php echo do_shortcode( wp_kses_post( housico_get_option('top-bar-right-content') ) ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="container">
				<div id="vu_menu-affix" class="vu_menu-affix"<?php echo (housico_get_option('header-fixed')) ? ' data-spy="affix" data-offset-top="'. absint(housico_get_option('header-fixed-offset')) .'"' : ''; ?>>
					<div class="vu_main-menu-container">
						<div class="vu_d-tr">
							<?php if ( housico_get_option('header-type', '1') == '2' ) : ?>
								<nav class="vu_main-menu vu_mm-top-left vu_d-td text-right" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
									<?php 
										// Main Menu Left
										$main_menu_left = housico_get_option('main-menu-left', false);

										wp_nav_menu(
												array(
												'theme_location'  => 'main-menu-left',
												'menu'            => ( $main_menu_left != '' ) ? $main_menu_left : '',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-top-left',
												'menu_class'      => 'vu_mm-list vu_mm-top-left list-unstyled',
												'items_wrap'      => housico_main_menu_wrap(),
												'fallback_cb'     => housico_main_menu_fallback_cb('main-menu-left'),
											)
										);
									?>
								</nav>
							<?php endif; ?>

							<div class="vu_logo-container vu_d-td"> 
								<div class="vu_site-logo">
									<a href="<?php echo esc_url( home_url('/') ); ?>">
										<img class="vu_sl-dark" alt="<?php echo esc_attr( get_bloginfo("name") ); ?>" width="<?php echo esc_attr(housico_get_option( array('logo-dark', 'width') )); ?>" height="<?php echo esc_attr(housico_get_option( array('logo-dark', 'height') )); ?>" src="<?php echo esc_url(housico_get_option( array('logo-dark', 'url') )); ?>">
										<img class="vu_sl-light" alt="<?php echo esc_attr( get_bloginfo("name") ); ?>" width="<?php echo esc_attr(housico_get_option( array('logo-light', 'width') )); ?>" height="<?php echo esc_attr(housico_get_option( array('logo-light', 'height') )); ?>" src="<?php echo esc_url(housico_get_option( array('logo-light', 'url') )); ?>">
									</a>
								</div>
								
								<a href="#" class="vu_mm-toggle vu_mm-open"><i class="fa fa-bars" aria-hidden="true"></i></a>

								<?php if ( housico_get_option('header-nav-search-icon-show', false) == true ) : ?>
									<a href="#" class="vu_search-icon vu_si-responsive"><i class="fa fa-search" aria-hidden="true"></i></a>
								<?php endif; ?>

								<?php do_action('housico_wc_show_responsive_basket_icon'); ?>
							</div>

							<?php if ( housico_get_option('header-type', '1') == '2' ) : ?>
								<nav class="vu_main-menu vu_mm-top-right vu_d-td text-left" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
									<?php 
										// Main Menu Right
										$main_menu_right = housico_get_option('main-menu-right', false);

										wp_nav_menu(
												array(
												'theme_location'  => 'main-menu-right',
												'menu'            => ( $main_menu_right != '' ) ? $main_menu_right : '',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-top-right',
												'menu_class'      => 'vu_mm-list vu_mm-top-right list-unstyled',
												'items_wrap'      => housico_main_menu_wrap(),
												'fallback_cb'     => housico_main_menu_fallback_cb('main-menu-right'),
											)
										);
									?>
								</nav>
							<?php else : ?>
								<nav class="vu_main-menu vu_mm-top-full vu_d-td text-right" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
									<?php 
										// Main Menu Full
										$main_menu_full = housico_get_option('main-menu-full', false);

										wp_nav_menu(
												array(
												'theme_location'  => 'main-menu-full',
												'menu'            => ( $main_menu_full != '' ) ? $main_menu_full : '',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-top-full',
												'menu_class'      => 'vu_mm-list vu_mm-top-full list-unstyled',
												'items_wrap'      => housico_main_menu_wrap(),
												'fallback_cb'     => housico_main_menu_fallback_cb('main-menu-full'),
											)
										);
									?>
								</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="vu_menu-affix-height"></div>
			</div>
		</header><!-- /Header -->

		<?php do_action('housico_after_header'); ?>