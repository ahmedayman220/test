<?php 
	// Custom CSS
	if( !function_exists('housico_custom_css') ){
		function housico_custom_css($echo = false){
			// Primary Color - Default : #eeb10b
			$primary_color_hex = esc_attr(housico_get_option('primary-color', '#eeb10b'));
			$primary_color_rgb = esc_attr(housico_hex2rgb($primary_color_hex, true));

			// Secondary Color - Default : #303745
			$secondary_color_hex = esc_attr(housico_get_option('secondary-color', '#303745'));
			$secondary_color_rgb = esc_attr(housico_hex2rgb($secondary_color_hex, true));

			ob_start();
		?>

			/* Main */
			::-moz-selection {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			::selection {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			a:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			a.vu_link-inverse {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			a.vu_link-inverse:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-header.vu_mh-transparent .vu_menu-affix:not(.affix) .vu_main-menu > ul > li:not(.current-menu-item):not(.current-menu-parent):not(.current-menu-ancestor) > a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_top-bar {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_top-bar a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_tb-list .sub-menu li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_top-bar .vu_social-icon a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-menu > ul > li > a {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-menu > ul > li.vu_mm-button > a {
			  color: <?php echo ($primary_color_hex); ?> !important;
			  border: 2px solid <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_main-menu > ul > li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-menu li.menu-item-has-children:hover > a,
			.vu_main-menu li.active > a,
			.vu_main-menu li.current-menu-parent > a,
			.vu_main-menu li.current-menu-ancestor > a,
			.vu_main-menu li.current-menu-item > a {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-menu ul li ul.sub-menu li a:hover,
			.vu_main-menu ul li ul.sub-menu li.active > a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-menu ul.sub-menu li:hover > a,
			.vu_main-menu ul.sub-menu li.active > a,
			.vu_main-menu ul.sub-menu li.current-menu-parent > a,
			.vu_main-menu ul.sub-menu li.current-menu-ancestor > a,
			.vu_main-menu ul.sub-menu li.current-menu-item > a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-menu .vu_mm-label-new > a:after,
			.vu_main-menu .vu_mm-label-unique > a:after {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-menu .vu_mm-label-unique > a:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_mega-menu .vu_mm-item-title > a {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_mobile-menu ul li.current-menu-item > a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_mobile-menu ul li a:hover,
			.vu_mobile-menu ul li.current-menu-item > a:hover,
			.vu_mobile-menu .vu_mm-remove:hover {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_mm-open:hover,
			.vu_mm-open:focus,
			.vu_search-icon.vu_si-responsive:hover,
			.vu_search-icon.vu_si-responsive:focus,
			.vu_wc-menu-item.vu_wc-responsive:hover,
			.vu_wc-menu-item.vu_wc-responsive:focus {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_title-bar.vu_tb-with-border:before {
			  -webkit-box-shadow: inset 0 0 0 2px <?php echo ($secondary_color_hex); ?>, inset 0 0 0 8px #fff, inset 0 0 0 10px <?php echo ($secondary_color_hex); ?>;box-shadow: inset 0 0 0 2px <?php echo ($secondary_color_hex); ?>, inset 0 0 0 8px #fff, inset 0 0 0 10px <?php echo ($secondary_color_hex); ?>;
			}
			.vu_title-bar.vu_tb-style-1 .vu_tb-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_title-bar.vu_tb-style-1 .vu_tb-breadcrumbs .divider i {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_title-bar.vu_tb-style-1 .vu_tb-breadcrumbs a span {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_title-bar.vu_tb-style-1 .vu_tb-breadcrumbs a:hover,
			.vu_title-bar.vu_tb-style-1 .vu_tb-breadcrumbs a:hover span {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_title-bar.vu_tb-style-2 .vu_tb-title:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.widget_nav_menu ul li a:hover,
			.widget_nav_menu ul li.current-menu-parent > a,
			.widget_nav_menu ul li.current-menu-ancestor > a,
			.widget_nav_menu ul li.current-menu-item > a {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_container .widget_nav_menu .menu li > a:before {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_datepicker-wrap .ui-datepicker-calendar .ui-state-highlight {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_datepicker-wrap td a.ui-state-active,
			.vu_datepicker-wrap td a.ui-state-active.ui-state-hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.select2-container--default.select2-container--open .select2-selection--single,
			.select2-container--default.select2-container--open .select2-selection--multiple {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.select2-container--default .select2-selection--single .select2-selection__clear {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.select2-container--default .select2-search--dropdown .select2-search__field:focus {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.select2-dropdown {
			  border: 1px solid <?php echo ($secondary_color_hex); ?>;
			}
			.select2-container--default .select2-results__option[aria-selected=true] {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_accordion .vu_a-wrapper .vu_a-header a {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_accordion .vu_a-wrapper .vu_a-header.ui-state-active a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_accordion .vu_a-wrapper .ui-state-default .ui-icon,
			.vu_accordion .vu_a-wrapper .ui-state-active .ui-icon {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_accordion .vu_a-wrapper .ui-state-active .ui-icon {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_toggle .vu_t-title .fa {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_toggle .vu_t-title h4 {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_toggle.vc_toggle_active .vu_t-title h4 {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_tabs .vu_t-nav li a {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_tabs .vu_t-nav li.ui-tabs-active a {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_tour .vu_t-wrapper .vu_t-nav a {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_tour .vu_t-nav li.ui-tabs-active a {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_progress-bar .vu_pb-bar {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_countdown .countdown-section {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_countdown .countdown-period {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_widget-nav li.active > a,
			.vu_widget-nav a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_image-box .vu_ib-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_image-box .vu_ib-read-more {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-bottom: 2px solid <?php echo ($primary_color_hex); ?>;
			}
			.vu_image-box .vu_ib-read-more:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_team-member .vu_tm-social-networks a {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_team-member .vu_tm-social-networks a:hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-1:hover .vu_tm-container {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-1 .vu_tm-name {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-1 .vu_tm-position {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-1 .vu_tm-social-networks {
			  background-color: rgba(<?php echo ($primary_color_rgb); ?>,0.6);
			}
			.vu_team-member.vu_tm-style-2:after {
			  background-color: rgba(<?php echo ($primary_color_rgb); ?>,0.8);
			}
			.vu_team-member.vu_tm-style-2 .vu_tm-position {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-3 .vu_tm-name {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-3 .vu_tm-position {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_team-member.vu_tm-style-3 .vu_tm-social-networks {
			  background-color: rgba(<?php echo ($primary_color_rgb); ?>,0.6);
			}
			.vu_testimonial .vu_t-author .vu_t-author-name {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_testimonial .vu_t-author .vu_t-author-position {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_before-after .twentytwenty-handle {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.form-control:focus {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_contact-form-7.vu_cf7-style-inverse .vu_cf7-frm .form-control:focus {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.wpcf7-form:not(.vu_cf7-frm) .wpcf7-form-control:not(.wpcf7-submit):focus {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_filterable .vu_f-filters.vu_f-filters-style-1 .vu_f-filter .vu_f-filter-icon {
			  -webkit-box-shadow: inset 0 0 0 3px <?php echo ($secondary_color_hex); ?>;box-shadow: inset 0 0 0 3px <?php echo ($secondary_color_hex); ?>;
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_filterable .vu_f-filters.vu_f-filters-style-1 .vu_f-filter:hover .vu_f-filter-icon,
			.vu_filterable .vu_f-filters.vu_f-filters-style-1 .vu_f-filter.active .vu_f-filter-icon {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_filterable .vu_f-filters.vu_f-filters-style-2 .vu_f-filter:hover .vu_f-filter-name,
			.vu_filterable .vu_f-filters.vu_f-filters-style-2 .vu_f-filter.active .vu_f-filter-name {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_mailchimp-form.vu_mcf-style-inverse .form-control:focus {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box .vu_ib-icon {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			  border: 2px solid <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-style-none .vu_ib-icon {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box .vu_ib-content .vu_ib-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-primary .vu_ib-content .vu_ib-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-primary .vu_ib-icon {
			  background-color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-primary:hover .vu_ib-icon {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-primary[class*="-outline"] .vu_ib-icon {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-primary[class*="-outline"]:hover .vu_ib-icon {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-secondary .vu_ib-content .vu_ib-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-secondary .vu_ib-icon {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-secondary:hover .vu_ib-icon {
			  background-color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-secondary[class*="-outline"] .vu_ib-icon {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-secondary[class*="-outline"]:hover .vu_ib-icon {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-gray .vu_ib-icon {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-gray:hover .vu_ib-icon {
			  background-color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_icon-box.vu_ib-color-white .vu_ib-content .vu_ib-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_timeline .vu_t-date {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_timeline .vu_t-date:before {
			  -webkit-box-shadow: 0 0 0 1px #fff, 0 0 0 3px <?php echo ($primary_color_hex); ?>, 0 0 0 8px #f9f9f9;box-shadow: 0 0 0 1px #fff, 0 0 0 3px <?php echo ($primary_color_hex); ?>, 0 0 0 8px #f9f9f9;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_timeline .vu_t-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-1 .vu_s-bullet {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-1 .vu_s-bullet[data-number="2"] {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-2 .vu_s-line:before {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-3 .vu_s-line:before {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-4 .vu_s-line:before,
			.vu_separator.vu_s-style-4 .vu_s-line:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-5 .vu_s-line-left,
			.vu_separator.vu_s-style-5 .vu_s-line-center,
			.vu_separator.vu_s-style-5 .vu_s-line-right {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_separator.vu_s-style-5 .vu_s-line-center {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_carousel .owl-pagination .owl-page.active span {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_carousel .owl-pagination .owl-page .owl-numbers {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_carousel .owl-buttons .owl-prev,
			.vu_carousel .owl-buttons .owl-next {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_carousel .owl-buttons .owl-prev:hover,
			.vu_carousel .owl-buttons .owl-next:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_heading .vu_h-heading {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_heading .vu_h-heading:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_heading.vu_h-style-2 .vu_h-heading span {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_pricing-table {
			  border: 1px solid <?php echo ($primary_color_hex); ?>;
			}
			.vu_pricing-table.vu_pt-active {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pricing-table .vu_pt-title {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_pricing-table.vu_pt-active .vu_pt-title {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pricing-table .vu_pt-currency {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pricing-table .vu_pt-amount {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pricing-table .vu_pt-button a {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pricing-table.vu_pt-active .vu_pt-button a {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_button {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_button.vu_b-normal-color-primary {
			  border-color: <?php echo ($primary_color_hex); ?>;
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_button.vu_b-normal-color-secondary {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_button.vu_b-normal-color-gray {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_button.vu_b-normal-color-white {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_button.vu_b-hover-color-primary:hover {
			  border-color: <?php echo ($primary_color_hex); ?> !important;
			  background-color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_button.vu_b-hover-color-secondary:hover {
			  border-color: <?php echo ($secondary_color_hex); ?> !important;
			  background-color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_button.vu_b-hover-color-gray:hover {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_button.vu_b-hover-color-white:hover {
			  color: <?php echo ($secondary_color_hex); ?> !important;
			}
			.vu_gallery .vu_g-filters .vu_g-filter {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery .vu_g-filters.vu_g-filters-style-1 .vu_g-filter.active,
			.vu_gallery .vu_g-filters.vu_g-filters-style-1 .vu_g-filter:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery .vu_g-filters.vu_g-filters-style-2 .vu_g-filter {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery .vu_g-filters.vu_g-filters-style-2 .vu_g-filter.active,
			.vu_gallery .vu_g-filters.vu_g-filters-style-2 .vu_g-filter:hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery .vu_g-filters.vu_g-filters-style-3 .vu_g-filter {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery .vu_g-filters.vu_g-filters-style-3 .vu_g-filter.active,
			.vu_gallery .vu_g-filters.vu_g-filters-style-3 .vu_g-filter:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-2 .vu_gi-details .vu_gi-content .vu_gi-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-2 .vu_gi-details .vu_gi-content-container:hover .vu_gi-content .vu_gi-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-3 .vu_gi-details .vu_gi-content .vu_gi-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-3 .vu_gi-details .vu_gi-content-container:hover .vu_gi-content .vu_gi-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-4 .vu_gi-details .vu_gi-content .vu_gi-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_gallery-item.vu_gi-style-4 .vu_gi-details .vu_gi-content-container:hover .vu_gi-content .vu_gi-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_gallery-widget .vu_gw-item .vu_gw-image {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_animated-svg .vu_as-svg svg path[stroke] {
			  stroke: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_animated-svg .vu_as-content .vu_as-title {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_animated-svg .vu_as-content .vu_as-title a:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_counter {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_counter .vu_c-holder:after {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_counter .vu_c-label {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_image-slider .owl-buttons .owl-prev,
			.vu_image-slider .owl-buttons .owl-next {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_image-slider .owl-buttons .owl-prev:hover,
			.vu_image-slider .owl-buttons .owl-next:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_image-slider .owl-controls .owl-pagination .owl-page span:before {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_image-slider .owl-controls .owl-pagination .owl-page.active span,
			.vu_image-slider .owl-controls .owl-pagination .owl-page:hover span {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-title a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-meta .vu_bi-m-item .fa {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-meta .vu_bi-m-item a:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-read-more {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-bottom: 2px solid <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog .vu_blog-item .vu_bi-read-more:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-title a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-m-item a:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-m-item i {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-read-more {
			  color: <?php echo ($primary_color_hex); ?>;
			  border-bottom: 2px solid <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog-post .vu_bp-read-more:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post.vu_bp-type-audio .vu_bp-image .mejs-controls .mejs-time-rail .mejs-time-current {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog-post.vu_bp-type-link:before {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post.vu_bp-type-quote .vu_bp-quote:before {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_blog-post.vu_bp-type-quote .vu_bp-quote > blockquote,
			.vu_blog-post.vu_bp-type-quote .vu_bp-quote .vu_bp-q-content {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_blog-post.vu_bp-type-quote .vu_bp-quote > blockquote cite,
			.vu_blog-post.vu_bp-type-quote .vu_bp-quote .vu_bp-q-author {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_bp-social-tags-container .vu_bp-tags {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_bp-social-tags-container .vu_bp-tags a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_bp-social-networks a {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_bp-social-networks a:hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_comments .vu_c-count,
			.vu_comments .vu_c-text {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_comments .vu_c-a-author {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_comments .vu_c-a-m-item a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_comments .vu_c-a-edit a,
			.vu_comments .vu_c-a-reply a {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_comments .vu_c-a-edit a {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_comments .vu_c-a-edit a:hover {
			  color: <?php echo ($primary_color_hex); ?> !important;
			}
			.vu_comments .vu_c-a-content .vu_c-a-moderation {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.comment-reply-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.comment-reply-title small a {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.comment-reply-title small a:hover {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.comment-form .form-control:focus {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_pagination .vu_p-list a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_pagination .vu_p-list .current {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_recent-posts .vu_rp-item .vu_rp-title a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_working-hours .vu_wh-item.active .vu_wh-day,
			.vu_working-hours .vu_wh-item.active .vu_wh-hours {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_social-networks .vu_social-icon a {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_social-networks .vu_social-icon a:hover {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_error-page .vu_ep-404 {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_error-page .vu_ep-title {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.widget_title,
			.widgettitle {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.widget .vu_social-icon a {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.widget .vu_social-icon a:hover {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_search-form .vu_sf-wrapper .vu_sf-submit {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.widget .form-control:focus,
			.widget input[type="text"]:focus,
			.widget input[type="search"]:focus {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_latest-tweets ul li:before {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_main-footer .vu_latest-tweets a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_sidebar .widget.widget_recent_comments li a {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_sidebar .widget.widget_recent_comments li a.url {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.widget.widget_archive li a:hover,
			.widget.widget_pages li a:hover,
			.widget.widget_recent_comments li a:hover,
			.widget.widget_recent_entries li a:hover,
			.widget.widget_meta li a:hover,
			.widget.widget_categories li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.widget.widget_tag_cloud a {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.widget.widget_tag_cloud a.active,
			.widget.widget_tag_cloud a:hover {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.widget.widget_rss .rss-date {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_highlight {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_list-with-icon li a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_list-with-icon li:before {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_list-with-icon[data-color="primary"] li a:hover,
			.vu_list-with-icon[data-color="primary"] li:before {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_list-with-icon[data-color="secondary"] li a:hover,
			.vu_list-with-icon[data-color="secondary"] li:before {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-footer .vu_mf-subfooter {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_main-footer .vu_mf-subfooter a:hover {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_primary-text-color {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_primary-border-color {
			  border-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_primary-bg-color {
			  background-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_secondary-text-color {
			  color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_secondary-border-color {
			  border-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_secondary-bg-color {
			  background-color: <?php echo ($secondary_color_hex); ?>;
			}
			.vu_with-icon > i.fa {
			  color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_arrow-down:after {
			  border-top-color: <?php echo ($primary_color_hex); ?>;
			}
			.vu_arrow-down.vu_secondary-bg-color:after {
			  border-top-color: <?php echo ($secondary_color_hex); ?>;
			}


			/* Logo */

			.vu_main-header:not(.vu_mh-type-3) .vu_main-menu-container .vu_logo-container,
			.vu_main-header.vu_mh-type-3 .vu_main-menu-container .vu_logo-container .vu_site-logo {
			  width:<?php echo absint(housico_get_option('logo-width')); ?>px;
			}
			.vu_main-menu-container .vu_logo-container img {
			  max-width:<?php echo absint(housico_get_option('logo-width')); ?>px;
			}


			/* Fixed Header Logo */

			.vu_main-header:not(.vu_mh-type-3) .vu_menu-affix.affix .vu_main-menu-container .vu_logo-container,
			.vu_main-header.vu_mh-type-3 .vu_menu-affix.affix .vu_main-menu-container .vu_logo-container .vu_site-logo {
			  width:<?php echo absint(housico_get_option('header-fixed-logo-width')); ?>px;
			}
			.vu_menu-affix.affix .vu_main-menu-container .vu_logo-container img {
			  max-width:<?php echo absint(housico_get_option('header-fixed-logo-width')); ?>px;
			}


			/* Submenu width */

			.vu_main-menu ul li ul.sub-menu { width:<?php echo housico_get_option('header-nav-submenu-width', '200'); ?>px; }


			/* Megamenu */

			/*.vu_main-menu .vu_mega-menu > a:before { height: calc(<?php echo housico_get_option(array('header-padding', 'padding-bottom'), '100%'); ?> + 2px); }*/


			/* Hamburger Menu */

			@media (max-width: <?php echo absint(housico_get_option('header-hamburger-menu')); ?>px) {
			  .vu_main-menu-container .vu_logo-container {
			    height: 100px;
			  }
			  .vu_main-menu {
			    display: none !important;
			  }
			  .vu_mm-open,
			  .vu_search-icon.vu_si-responsive,
			  .vu_wc-menu-item.vu_wc-responsive {
			    display: block !important;
			  }
			  .vu_main-menu-container .vu_logo-container {
			    padding-right: 68px !important;
			  }
			  .vu_site-with-search-icon .vu_main-menu-container .vu_logo-container {
			    padding-right: 130px !important;
			  }
			  .vu_wc-with-basket-icon .vu_main-menu-container .vu_logo-container {
			    padding-left: 68px !important;
			  }
			  .vu_site-with-search-icon.vu_wc-with-basket-icon .vu_main-menu-container .vu_logo-container {
			    padding-left: 130px !important;
			  }
			}
		<?php 
			$custom_css = ob_get_contents();
			ob_end_clean();

			// Preloader Image
			if( housico_get_option('preloader') == true and trim(housico_get_option( array('preloader-image', 'url') )) != '' ) {
				$custom_css .= '#vu_preloader { background-image: url('. housico_get_option( array('preloader-image', 'url') ) .'); }';
			}

			// Custom CSS from Theme Options
			if( trim(housico_get_option('custom-css')) != '' ) {
				$custom_css .= housico_get_option('custom-css');
			}

			if( $echo ){
				echo housico_css_compress($custom_css);
			} else {
				return housico_css_compress($custom_css);
			}
		}
	}
?>