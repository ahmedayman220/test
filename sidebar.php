<?php 
	$housico_page_sidebar = housico_get_blog_sidebar();

	$has_sidebar = housico_has_sidebar( $housico_page_sidebar );

	if( $has_sidebar ) : ?>
		<aside class="vu_sidebar vu_s-<?php echo esc_attr($housico_page_sidebar['sidebar']); ?> col-xs-12 col-md-<?php echo absint($housico_page_sidebar['layout']) . (($housico_page_sidebar['position'] == 'left') ? ' vu_s-position-left col-md-pull-'. (12 - absint($housico_page_sidebar['layout'])) : ' vu_s-position-right'); ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
			<?php housico_dynamic_sidebar( $housico_page_sidebar['sidebar'] ); ?>
		</aside>
	<?php endif;
?>