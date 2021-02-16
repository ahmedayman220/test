<?php
/**
 *	Housico WordPress Theme
 */

add_action( 'add_meta_boxes', 'housico_page_options_meta_box' );

function housico_page_options_meta_box() {
	add_meta_box(
		'vu_page-options',
		esc_html__( 'Page Options', 'housico' ),
		'housico_page_options_meta_box_content',
		'page',
		'normal',
		'core'
	);
}

function housico_page_options_meta_box_content() {
	global $post;

	//Get Page Options
	$housico_page_options = housico_get_post_meta( $post->ID, 'housico_page_options' );

	wp_nonce_field( 'vu_metabox_nonce', 'vu_metabox_nonce' ); ?>

	<div class="vu_metabox-container">
		<div class="vu_mb-tabs-container">
			<div class="vu_mb-tabs">
				<a href="#" data-id="general" class="vu_mb-tab active">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>General</span>
				</a>
				<a href="#" data-id="top-bar" class="vu_mb-tab">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Top Bar</span>
				</a>
				<a href="#" data-id="header" class="vu_mb-tab">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Header</span>
				</a>
				<a href="#" data-id="title-bar" class="vu_mb-tab">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Title Bar</span>
				</a>
				<a href="#" data-id="sidebar" class="vu_mb-tab">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Sidebar</span>
				</a>
				<a href="#" data-id="footer" class="vu_mb-tab">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Footer</span>
				</a>
			</div>

			<div class="vu_mb-panels">
				<div class="vu_mb-panel active" data-id="general">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_preloader"><?php esc_html_e('Preloader', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show preloader while page content is loading.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][preloader]" id="vu_field_preloader">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('preloader')); ?>"<?php echo (!isset($housico_page_options['preloader']) || $housico_page_options['preloader'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['preloader']) && $housico_page_options['preloader'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['preloader']) && $housico_page_options['preloader'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][preloader]" data-value="1">
							<td scope="row">
								<label><?php esc_html_e('Preloader Image', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Add a custom loading image.', 'housico'); ?></span>
							</td>
							<td>
								<img id="vu_img_preloader-image" class="vu_media-img" src="<?php echo (!empty($housico_page_options['preloader-image']['url'])) ? housico_get_attachment_image_src($housico_page_options['preloader-image']['url'], 'full') : ''; ?>">
								<input id="vu_field_preloader-image" name="vu_field[housico_page_options][preloader-image][url]" class="regular-text" type="hidden" value="<?php echo (!empty($housico_page_options['preloader-image']['url'])) ? absint($housico_page_options['preloader-image']['url']) : ''; ?>" />
								<a href="#" data-input="vu_field_preloader-image" data-img="vu_img_preloader-image" data-title="<?php esc_attr_e('Add Image', 'housico'); ?>" data-button="<?php esc_attr_e('Add Image', 'housico'); ?>" class="vu_open-media button button-default"><?php esc_html_e('Upload', 'housico'); ?></a>
								<a href="#" data-input="vu_field_preloader-image" data-img="vu_img_preloader-image" class="vu_remove-media button button-default"><?php esc_html_e('Remove', 'housico'); ?></a>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_boxed-layout"><?php esc_html_e('Boxed Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show preloader while page content is loading.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][boxed-layout]" id="vu_field_boxed-layout">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('boxed-layout')); ?>"<?php echo (!isset($housico_page_options['boxed-layout']) || $housico_page_options['boxed-layout'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['boxed-layout']) && $housico_page_options['boxed-layout'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['boxed-layout']) && $housico_page_options['boxed-layout'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_body-background-color"><?php esc_html_e('Background Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select page background color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_body-background-color" name="vu_field[housico_page_options][body-background][background-color]" class="vu_colorpicker" type="text" value="<?php echo (!empty($housico_page_options['body-background']['background-color'])) ? esc_attr($housico_page_options['body-background']['background-color']) : ''; ?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="vu_mb-panel" data-id="top-bar">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_top-bar-show"><?php esc_html_e('Show Top Bar', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show top bar.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][top-bar-show]" id="vu_field_top-bar-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('top-bar-show')); ?>"<?php echo (!isset($housico_page_options['top-bar-show']) || $housico_page_options['top-bar-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['top-bar-show']) && $housico_page_options['top-bar-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['top-bar-show']) && $housico_page_options['top-bar-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][top-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_top-bar-layout"><?php esc_html_e('Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select top bar layout.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][top-bar-layout]" id="vu_field_top-bar-layout">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('top-bar-layout')); ?>"<?php echo (empty($housico_page_options['top-bar-layout']) || $housico_page_options['top-bar-layout'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="boxed"<?php echo (!empty($housico_page_options['top-bar-layout']) && $housico_page_options['top-bar-layout'] == 'boxed') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Boxed', 'housico'); ?></option>
									<option value="fullwidth"<?php echo (!empty($housico_page_options['top-bar-layout']) && $housico_page_options['top-bar-layout'] == 'fullwidth') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Full Width', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][top-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_top-bar-bg-color"><?php esc_html_e('Background Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select top bar background color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_top-bar-bg-color" name="vu_field[housico_page_options][top-bar-bg-color][background-color]" class="vu_colorpicker" type="text" value="<?php echo (!empty($housico_page_options['top-bar-bg-color']['background-color'])) ? esc_attr($housico_page_options['top-bar-bg-color']['background-color']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][top-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_top-bar-text-color"><?php esc_html_e('Text Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select top bar text color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_top-bar-text-color" name="vu_field[housico_page_options][top-bar-text-color]" class="vu_colorpicker" type="text" value="<?php echo (!empty($housico_page_options['top-bar-text-color'])) ? esc_attr($housico_page_options['top-bar-text-color']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][top-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_top-bar-left-content"><?php esc_html_e('Left Content', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter top bar left side content. HTML code is allowed!', 'housico'); ?></span>
							</td>
							<td>
								<textarea id="vu_field_top-bar-left-content" name="vu_field[housico_page_options][top-bar-left-content]" class="regular-text" rows="4"><?php echo (isset($housico_page_options['top-bar-left-content'])) ? esc_attr($housico_page_options['top-bar-left-content']) : ''; ?></textarea>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][top-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_top-bar-right-content"><?php esc_html_e('Right Content', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter top bar right side content. HTML code is allowed!', 'housico'); ?></span>
							</td>
							<td>
								<textarea id="vu_field_top-bar-right-content" name="vu_field[housico_page_options][top-bar-right-content]" class="regular-text" rows="4"><?php echo (isset($housico_page_options['top-bar-right-content'])) ? esc_attr($housico_page_options['top-bar-right-content']) : ''; ?></textarea>
							</td>
						</tr>
					</table>
				</div>
				<div class="vu_mb-panel" data-id="header">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_header-type"><?php esc_html_e('Header Type', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select header type.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-type]" id="vu_field_header-type">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-type')); ?>"<?php echo (empty($housico_page_options['header-type']) || $housico_page_options['header-type'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (!empty($housico_page_options['header-type']) && $housico_page_options['header-type'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Type 1', 'housico'); ?></option>
									<option value="2"<?php echo (!empty($housico_page_options['header-type']) && $housico_page_options['header-type'] == '2') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Type 2', 'housico'); ?></option>
									<option value="3"<?php echo (!empty($housico_page_options['header-type']) && $housico_page_options['header-type'] == '3') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Type 3', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-layout"><?php esc_html_e('Header Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select header layout.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-layout]" id="vu_field_header-layout">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-layout')); ?>"<?php echo (empty($housico_page_options['header-layout']) || $housico_page_options['header-layout'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="boxed"<?php echo (!empty($housico_page_options['header-layout']) && $housico_page_options['header-layout'] == 'boxed') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Boxed', 'housico'); ?></option>
									<option value="fullwidth"<?php echo (!empty($housico_page_options['header-layout']) && $housico_page_options['header-layout'] == 'fullwidth') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Full Width', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-padding-top"><?php esc_html_e('Header Padding', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter header top and bottom padding.', 'housico'); ?></span>
							</td>
							<td style="font-size: 0; line-height: 0;">
								<input id="vu_field_header-padding-top" name="vu_field[housico_page_options][header-padding][padding-top]" style="width: calc(50% - 10px); margin: 0 20px 0 0; display: inline-block;" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-padding']['padding-top'])) ? esc_attr($housico_page_options['header-padding']['padding-top']) : ''; ?>" />
								<input id="vu_field_header-padding-bottom" name="vu_field[housico_page_options][header-padding][padding-bottom]" style="width: calc(50% - 10px); margin: 0; display: inline-block;" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-padding']['padding-bottom'])) ? esc_attr($housico_page_options['header-padding']['padding-bottom']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-transparent"><?php esc_html_e('Header Transparent', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Make header area transparent.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-transparent]" id="vu_field_header-transparent">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-transparent')); ?>"<?php echo (!isset($housico_page_options['header-transparent']) || $housico_page_options['header-transparent'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['header-transparent']) && $housico_page_options['header-transparent'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['header-transparent']) && $housico_page_options['header-transparent'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-type]" data-value="1|3">
							<td scope="row">
								<label for="vu_field_main-menu-full"><?php esc_html_e('Full Menu', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select page menu if you want to display other menu instead of default one.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_main-menu-full" name="vu_field[housico_page_options][main-menu-full]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['main-menu-full'])) ? esc_attr($housico_page_options['main-menu-full']) : ''; ?>">
									<option value=""><?php esc_html_e('Default Menu', 'housico'); ?></option>
									<?php 
										$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

										$registered_menus = get_registered_nav_menus();

										foreach ($menus as $menu) {
											if( $registered_menus['main-menu-full'] != $menu->name ) {
												echo '<option value="'. $menu->term_id .'">'. $menu->name .'</option>';
											}
										}
									?>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-type]" data-value="2">
							<td scope="row">
								<label for="vu_field_main-menu-left"><?php esc_html_e('Left Menu', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select page menu if you want to display other menu instead of default one.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_main-menu-left" name="vu_field[housico_page_options][main-menu-left]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['main-menu-left'])) ? esc_attr($housico_page_options['main-menu-left']) : ''; ?>">
								<option value=""><?php esc_html_e('Default Menu', 'housico'); ?></option>
								<?php 
									$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

									$registered_menus = get_registered_nav_menus();

									foreach ($menus as $menu) {
										if( $registered_menus['main-menu-left'] != $menu->name ) {
											echo '<option value="'. $menu->term_id .'">'. $menu->name .'</option>';
										}
									}
								?>
							</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-type]" data-value="2">
							<td scope="row">
								<label for="vu_field_main-menu-right"><?php esc_html_e('Right Menu', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select page menu if you want to display other menu instead of default one.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_main-menu-right" name="vu_field[housico_page_options][main-menu-right]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['main-menu-right'])) ? esc_attr($housico_page_options['main-menu-right']) : ''; ?>">
								<option value=""><?php esc_html_e('Default Menu', 'housico'); ?></option>
								<?php 
									$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

									$registered_menus = get_registered_nav_menus();

									foreach ($menus as $menu) {
										if( $registered_menus['main-menu-right'] != $menu->name ) {
											echo '<option value="'. $menu->term_id .'">'. $menu->name .'</option>';
										}
									}
								?>
							</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-nav-search-icon-show"><?php esc_html_e('Show Search Icon', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show search icon in main menu.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-nav-search-icon-show]" id="vu_field_header-nav-search-icon-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-nav-search-icon-show')); ?>"<?php echo (!isset($housico_page_options['header-nav-search-icon-show']) || $housico_page_options['header-nav-search-icon-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['header-nav-search-icon-show']) && $housico_page_options['header-nav-search-icon-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['header-nav-search-icon-show']) && $housico_page_options['header-nav-search-icon-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-nav-search-icon-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_header-nav-search-scope"><?php esc_html_e('Search Scope', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select search scope.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-nav-search-scope]" id="vu_field_header-nav-search-scope">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-nav-search-scope')); ?>"<?php echo (!isset($housico_page_options['header-nav-search-scope']) || $housico_page_options['header-nav-search-scope'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="all"<?php echo (isset($housico_page_options['header-nav-search-scope']) && $housico_page_options['header-nav-search-scope'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('All', 'housico'); ?></option>
									<option value="post"<?php echo (isset($housico_page_options['header-nav-search-scope']) && $housico_page_options['header-nav-search-scope'] == 'post') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Post', 'housico'); ?></option>
									<option value="page"<?php echo (isset($housico_page_options['header-nav-search-scope']) && $housico_page_options['header-nav-search-scope'] == 'page') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Page', 'housico'); ?></option>
									<option value="product"<?php echo (isset($housico_page_options['header-nav-search-scope']) && $housico_page_options['header-nav-search-scope'] == 'product') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Product', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-nav-submenu-width"><?php esc_html_e('Navigation Submenu Width', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter navigation submenu width in pixels.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_header-nav-submenu-width" name="vu_field[housico_page_options][header-nav-submenu-width]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-nav-submenu-width'])) ? esc_attr($housico_page_options['header-nav-submenu-width']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-hamburger-menu"><?php esc_html_e('Hamburger Menu', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter width in pixels by which hamburger menu will be shown.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_header-hamburger-menu" name="vu_field[housico_page_options][header-hamburger-menu]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-hamburger-menu'])) ? esc_attr($housico_page_options['header-hamburger-menu']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_header-fixed"><?php esc_html_e('Fixed Header on Scroll', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enable fixed header on scroll.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][header-fixed]" id="vu_field_header-fixed">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('header-fixed')); ?>"<?php echo (!isset($housico_page_options['header-fixed']) || $housico_page_options['header-fixed'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['header-fixed']) && $housico_page_options['header-fixed'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['header-transparent']) && $housico_page_options['header-transparent'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-fixed]" data-value="1">
							<td scope="row">
								<label for="vu_field_header-fixed-offset"><?php esc_html_e('Fixed Header Offset', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter distance in px by which fixed header is shown.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_header-fixed-offset" name="vu_field[housico_page_options][header-fixed-offset]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-fixed-offset'])) ?  esc_attr($housico_page_options['header-fixed-offset']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-fixed]" data-value="1">
							<td scope="row">
								<label for="vu_field_header-fixed-logo-width"><?php esc_html_e('Fixed Header Logo Width', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter logo width in px.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_header-fixed-logo-width" name="vu_field[housico_page_options][header-fixed-logo-width]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-fixed-logo-width'])) ?  esc_attr($housico_page_options['header-fixed-logo-width']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][header-fixed]" data-value="1">
							<td scope="row">
								<label for="vu_field_header-fixed-padding-top"><?php esc_html_e('Fixed Header Padding', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter fixed header top and bottom padding.', 'housico'); ?></span>
							</td>
							<td style="font-size: 0; line-height: 0;">
								<input id="vu_field_header-fixed-padding-top" name="vu_field[housico_page_options][header-fixed-padding][padding-top]" style="width: calc(50% - 10px); margin: 0 20px 0 0; display: inline-block;" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-fixed-padding']['padding-top'])) ? esc_attr($housico_page_options['header-fixed-padding']['padding-top']) : ''; ?>" />
								<input id="vu_field_header-fixed-padding-bottom" name="vu_field[housico_page_options][header-fixed-padding][padding-bottom]" style="width: calc(50% - 10px); margin: 0; display: inline-block;" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['header-fixed-padding']['padding-bottom'])) ? esc_attr($housico_page_options['header-fixed-padding']['padding-bottom']) : ''; ?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="vu_mb-panel" data-id="title-bar">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_title-bar-show"><?php esc_html_e('Show Title Bar', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show title bar.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][title-bar-show]" id="vu_field_title-bar-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('title-bar-show')); ?>"<?php echo (!isset($housico_page_options['title-bar-show']) || $housico_page_options['title-bar-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['title-bar-show']) && $housico_page_options['title-bar-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['title-bar-show']) && $housico_page_options['title-bar-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-style"><?php esc_html_e('Style', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select title bar style.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][title-bar-style]" id="vu_field_title-bar-style">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('title-bar-style')); ?>"<?php echo (empty($housico_page_options['title-bar-style']) || $housico_page_options['title-bar-style'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (!empty($housico_page_options['title-bar-style']) && $housico_page_options['title-bar-style'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Style 1', 'housico'); ?></option>
									<option value="2"<?php echo (!empty($housico_page_options['title-bar-style']) && $housico_page_options['title-bar-style'] == '2') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Style 2', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-title"><?php esc_html_e('Title', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter title bar title. Page name will be shown by default.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_title-bar-title" name="vu_field[housico_page_options][title-bar-title]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['title-bar-title'])) ? esc_attr($housico_page_options['title-bar-title']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-style]" data-value="2">
							<td scope="row">
								<label for="vu_field_title-bar-subtitle"><?php esc_html_e('Subtitle', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter title bar subtitle.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_title-bar-subtitle" name="vu_field[housico_page_options][title-bar-subtitle]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['title-bar-subtitle'])) ? esc_attr($housico_page_options['title-bar-subtitle']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-style]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-breadcrumbs"><?php esc_html_e('Hide Breadcrumbs?', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select whether or not to show breadcrumbs.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][title-bar-breadcrumbs]" id="vu_field_title-bar-breadcrumbs">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('title-bar-breadcrumbs')); ?>"<?php echo (!isset($housico_page_options['title-bar-breadcrumbs']) || $housico_page_options['title-bar-breadcrumbs'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['title-bar-breadcrumbs']) && $housico_page_options['title-bar-breadcrumbs'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['title-bar-breadcrumbs']) && $housico_page_options['title-bar-breadcrumbs'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-height"><?php esc_html_e('Height', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter title bar height in pixels. Height specified from theme options will be applied by default.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_title-bar-height" name="vu_field[housico_page_options][title-bar-height]" class="regular-text" type="text" value="<?php echo (!empty($housico_page_options['title-bar-height'])) ?  esc_attr($housico_page_options['title-bar-height']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label><?php esc_html_e('Background Image', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Upload title bar background image. The image should have minimum 1200px width and 300px height for best results.', 'housico'); ?></span>
							</td>
							<td>
								<img id="vu_img_title-bar-bg-image" class="vu_media-img" src="<?php echo (!empty($housico_page_options['title-bar-bg-image']['id'])) ? housico_get_attachment_image_src($housico_page_options['title-bar-bg-image']['id'], 'full') : ''; ?>">
								<input id="vu_field_title-bar-bg-image" name="vu_field[housico_page_options][title-bar-bg-image][id]" class="regular-text" type="hidden" value="<?php echo (!empty($housico_page_options['title-bar-bg-image']['id'])) ? absint($housico_page_options['title-bar-bg-image']['id']) : ''; ?>" />
								<a href="#" data-input="vu_field_title-bar-bg-image" data-img="vu_img_title-bar-bg-image" data-title="<?php esc_attr_e('Add Image', 'housico'); ?>" data-button="<?php esc_attr_e('Add Image', 'housico'); ?>" class="vu_open-media button button-default"><?php esc_html_e('Upload', 'housico'); ?></a>
								<a href="#" data-input="vu_field_title-bar-bg-image" data-img="vu_img_title-bar-bg-image" class="vu_remove-media button button-default"><?php esc_html_e('Remove', 'housico'); ?></a>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-parallax"><?php esc_html_e('Parallax Effect?', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select whether or not to enable parallax effect on title bar background image.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][title-bar-parallax]" id="vu_field_title-bar-parallax">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('title-bar-parallax')); ?>"<?php echo (!isset($housico_page_options['title-bar-parallax']) || $housico_page_options['title-bar-parallax'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['title-bar-parallax']) && $housico_page_options['title-bar-parallax'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['title-bar-parallax']) && $housico_page_options['title-bar-parallax'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][title-bar-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_title-bar-color-overlay"><?php esc_html_e('Color Overlay', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select title bar color overlay. Color specified from theme options will be applied by default.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_title-bar-color-overlay" name="vu_field[housico_page_options][title-bar-color-overlay]" class="vu_colorpicker" type="text" value="<?php echo (!empty($housico_page_options['title-bar-color-overlay'])) ? esc_attr($housico_page_options['title-bar-color-overlay']) : ''; ?>" />
							</td>
						</tr>
					</table>
				</div>
				<div class="vu_mb-panel" data-id="sidebar">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_sidebar"><?php esc_html_e('Sidebar', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select page sidebar.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_sidebar" name="vu_field[housico_page_options][sidebar]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['sidebar'])) ? esc_attr($housico_page_options['sidebar']) : ''; ?>">
									<option value=""><?php esc_html_e('No Sidebar', 'housico'); ?></option>
									<?php 
										foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
											echo '<option value="'. esc_attr($sidebar['id']) .'">'. esc_html($sidebar['name']) .'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_sidebar-layout"><?php esc_html_e('Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select sidebar layout.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_sidebar-layout" name="vu_field[housico_page_options][sidebar-layout]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['sidebar-layout'])) ? esc_attr($housico_page_options['sidebar-layout']) : '3'; ?>">
									<option value="4"><?php esc_html_e('1/3', 'housico'); ?></option>
									<option value="3"><?php esc_html_e('1/4', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_sidebar-position"><?php esc_html_e('Position', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select sidebar positon.', 'housico'); ?></span>
							</td>
							<td>
								<select id="vu_field_sidebar-position" name="vu_field[housico_page_options][sidebar-position]" class="regular-text vu_select-change" data-value="<?php echo (isset($housico_page_options['sidebar-position'])) ? esc_attr($housico_page_options['sidebar-position']) : 'right'; ?>">
									<option value="left"><?php esc_html_e('Left', 'housico'); ?></option>
									<option value="right"><?php esc_html_e('Right', 'housico'); ?></option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="vu_mb-panel" data-id="footer">
					<table class="form-table vu_metabox-table">
						<tr class="vu_bt-none">
							<td scope="row">
								<label for="vu_field_footer-show"><?php esc_html_e('Show Footer', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show footer.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][footer-show]" id="vu_field_footer-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('footer-show')); ?>"<?php echo (!isset($housico_page_options['footer-show']) || $housico_page_options['footer-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['footer-show']) && $housico_page_options['footer-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['footer-show']) && $housico_page_options['footer-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][footer-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_footer-type"><?php esc_html_e('Footer Type', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select footer type.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][footer-type]" id="vu_field_footer-type">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('footer-type')); ?>"<?php echo (empty($housico_page_options['footer-type']) || $housico_page_options['footer-type'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="widgetized"<?php echo (!empty($housico_page_options['footer-type']) && $housico_page_options['footer-type'] == 'widgetized') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Widgetized', 'housico'); ?></option>
									<option value="page"<?php echo (!empty($housico_page_options['footer-type']) && $housico_page_options['footer-type'] == 'page') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Page', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][footer-type]" data-value="widgetized">
							<td scope="row">
								<label for="vu_field_footer-layout"><?php esc_html_e('Footer Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select footer layout.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][footer-layout]" id="vu_field_footer-layout">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('footer-layout')); ?>"<?php echo (empty($housico_page_options['footer-layout']) || $housico_page_options['footer-layout'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="6-6"<?php echo (!empty($housico_page_options['footer-layout']) && $housico_page_options['footer-layout'] == '6-6') ? ' selected="selected"' : ''; ?>><?php esc_html_e('1/2 + 1/2', 'housico'); ?></option>
									<option value="4-4-4"<?php echo (!empty($housico_page_options['footer-layout']) && $housico_page_options['footer-layout'] == '4-4-4') ? ' selected="selected"' : ''; ?>><?php esc_html_e('1/3 + 1/3 + 1/3', 'housico'); ?></option>
									<option value="3-3-3-3"<?php echo (!empty($housico_page_options['footer-layout']) && $housico_page_options['footer-layout'] == '3-3-3-3') ? ' selected="selected"' : ''; ?>><?php esc_html_e('1/4 + 1/4 + 1/4 + 1/4', 'housico'); ?></option>
									<option value="5-2-5"<?php echo (!empty($housico_page_options['footer-layout']) && $housico_page_options['footer-layout'] == '5-2-5') ? ' selected="selected"' : ''; ?>><?php esc_html_e('5/12 + 2/12 + 5/12', 'housico'); ?></option>
									<option value="3-3-6"<?php echo (!empty($housico_page_options['footer-layout']) && $housico_page_options['footer-layout'] == '3-3-6') ? ' selected="selected"' : ''; ?>><?php esc_html_e('1/4 + 1/4 + 2/4', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][footer-type]" data-value="widgetized">
							<td scope="row">
								<label for="vu_field_footer-background"><?php esc_html_e('Footer Background Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select footer background color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_footer-background" name="vu_field[housico_page_options][footer-background][background-color]" class="vu_colorpicker" type="text" value="<?php echo (isset($housico_page_options['footer-background']['background-color'])) ? esc_attr($housico_page_options['footer-background']['background-color']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][footer-type]" data-value="widgetized">
							<td scope="row">
								<label for="vu_field_footer-text-color"><?php esc_html_e('Footer Text Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select footer text color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_footer-text-color" name="vu_field[housico_page_options][footer-text-color]" class="vu_colorpicker" type="text" value="<?php echo (isset($housico_page_options['footer-text-color'])) ? esc_attr($housico_page_options['footer-text-color']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][footer-type]" data-value="page">
							<td scope="row">
								<label for="vu_field_footer-page"><?php esc_html_e('Footer Page', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select footer page.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][footer-page]" id="vu_field_footer-page" class="vu_select-change" data-value="<?php echo (isset($housico_page_options['footer-page'])) ? esc_attr($housico_page_options['footer-page']) : ''; ?>">
									<option value="inherit"><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<?php 
										$footer_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/footer.php')); 
										foreach ( $footer_pages as $page ) {
											echo '<option value="'. esc_attr($page->ID) .'">'. esc_html($page->post_title) .'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_subfooter-show"><?php esc_html_e('Show Subfooter', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show subfooter.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][subfooter-show]" id="vu_field_subfooter-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('subfooter-show')); ?>"<?php echo (!isset($housico_page_options['subfooter-show']) || $housico_page_options['subfooter-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['subfooter-show']) && $housico_page_options['subfooter-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['subfooter-show']) && $housico_page_options['subfooter-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_subfooter-layout"><?php esc_html_e('Subfooter Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select subfooter layout.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][subfooter-layout]" id="vu_field_subfooter-layout">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('subfooter-layout')); ?>"<?php echo (empty($housico_page_options['subfooter-layout']) || $housico_page_options['subfooter-layout'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (!empty($housico_page_options['subfooter-layout']) && $housico_page_options['subfooter-layout'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('1 Column', 'housico'); ?></option>
									<option value="2"<?php echo (!empty($housico_page_options['subfooter-layout']) && $housico_page_options['subfooter-layout'] == '2') ? ' selected="selected"' : ''; ?>><?php esc_html_e('2 Columns', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-layout]" data-value="1">
							<td scope="row">
								<label for="vu_field_subfooter-alignment"><?php esc_html_e('Subfooter Layout', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select subfooter text alignment.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][subfooter-alignment]" id="vu_field_subfooter-alignment">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('subfooter-alignment')); ?>"<?php echo (empty($housico_page_options['subfooter-alignment']) || $housico_page_options['subfooter-alignment'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="left"<?php echo (!empty($housico_page_options['subfooter-alignment']) && $housico_page_options['subfooter-alignment'] == 'left') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Left', 'housico'); ?></option>
									<option value="center"<?php echo (!empty($housico_page_options['subfooter-alignment']) && $housico_page_options['subfooter-alignment'] == 'center') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Center', 'housico'); ?></option>
									<option value="right"<?php echo (!empty($housico_page_options['subfooter-alignment']) && $housico_page_options['subfooter-alignment'] == 'right') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Right', 'housico'); ?></option>
								</select>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-layout]" data-value="1">
							<td scope="row">
								<label for="vu_field_footer-full-content"><?php esc_html_e('Subfooter Full Content', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter subfooter content. HTML code is allowed!', 'housico'); ?></span>
							</td>
							<td>
								<textarea id="vu_field_footer-full-content" name="vu_field[housico_page_options][footer-full-content]" class="regular-text" rows="4"><?php echo (isset($housico_page_options['footer-full-content'])) ? esc_attr($housico_page_options['footer-full-content']) : ''; ?></textarea>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-layout]" data-value="2">
							<td scope="row">
								<label for="vu_field_footer-left-content"><?php esc_html_e('Subfooter Left Content', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter subfooter left side content. HTML code is allowed!', 'housico'); ?></span>
							</td>
							<td>
								<textarea id="vu_field_footer-left-content" name="vu_field[housico_page_options][footer-left-content]" class="regular-text" rows="4"><?php echo (isset($housico_page_options['footer-left-content'])) ? esc_attr($housico_page_options['footer-left-content']) : ''; ?></textarea>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-layout]" data-value="2">
							<td scope="row">
								<label for="vu_field_footer-right-content"><?php esc_html_e('Subfooter Right Content', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Enter subfooter right side content. HTML code is allowed!', 'housico'); ?></span>
							</td>
							<td>
								<textarea id="vu_field_footer-right-content" name="vu_field[housico_page_options][footer-right-content]" class="regular-text" rows="4"><?php echo (isset($housico_page_options['footer-right-content'])) ? esc_attr($housico_page_options['footer-left-content']) : ''; ?></textarea>
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_subfooter-bg-color"><?php esc_html_e('Subfooter Background Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select subfooter background color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_subfooter-bg-color" name="vu_field[housico_page_options][subfooter-bg-color][background-color]" class="vu_colorpicker" type="text" value="<?php echo (isset($housico_page_options['subfooter-bg-color']['background-color'])) ? esc_attr($housico_page_options['subfooter-bg-color']['background-color']) : ''; ?>" />
							</td>
						</tr>
						<tr class="vu_dependency" data-element="vu_field[housico_page_options][subfooter-show]" data-value="1">
							<td scope="row">
								<label for="vu_field_subfooter-text-color"><?php esc_html_e('Subfooter Text Color', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Select subfooter text color.', 'housico'); ?></span>
							</td>
							<td>
								<input id="vu_field_subfooter-text-color" name="vu_field[housico_page_options][subfooter-text-color]" class="vu_colorpicker" type="text" value="<?php echo (isset($housico_page_options['subfooter-text-color'])) ? esc_attr($housico_page_options['subfooter-text-color']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td scope="row">
								<label for="vu_field_back-to-top-show"><?php esc_html_e('Back to Top', 'housico'); ?></label>
								<span class="vu_desc"><?php esc_html_e('Show the back to top button.', 'housico'); ?></span>
							</td>
							<td>
								<select name="vu_field[housico_page_options][back-to-top-show]" id="vu_field_back-to-top-show">
									<option value="inherit" data-value="<?php echo esc_attr(housico_get_option('back-to-top-show')); ?>"<?php echo (!isset($housico_page_options['back-to-top-show']) || $housico_page_options['back-to-top-show'] == 'inherit') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Inherit from Theme Options', 'housico'); ?></option>
									<option value="1"<?php echo (isset($housico_page_options['back-to-top-show']) && $housico_page_options['back-to-top-show'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'housico'); ?></option>
									<option value="0"<?php echo (isset($housico_page_options['back-to-top-show']) && $housico_page_options['back-to-top-show'] == '0') ? ' selected="selected"' : ''; ?>><?php esc_html_e('No', 'housico'); ?></option>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}