<?php 
	get_header();

	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$housico_page_sidebar = housico_get_page_sidebar( $post->ID );

		$has_sidebar = housico_has_sidebar( $housico_page_sidebar ); ?>
		
		<!-- Container -->
		<div class="vu_container<?php echo has_shortcode( $post->post_content, 'vc_row' ) ? ' vu_c-type-fullwidth' : ''; ?> <?php echo ($has_sidebar == true) ? 'vu_with-sidebar' : 'vu_no-sidebar' ?> clearfix">
			<div class="container">
				<div class="row">
					<div class="vu_content col-xs-12 col-sm-12 col-md-<?php echo ($has_sidebar == true) ? (12 - absint($housico_page_sidebar['layout'])) . (($housico_page_sidebar['position'] == 'left') ? ' col-md-push-'. absint($housico_page_sidebar['layout']) : '') : '12'; ?>">
						<?php the_content(); ?>

						<?php housico_wp_link_pages(); ?>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div class="clear"></div>
							<div class="vu_page-comments container m-t-30">
								<?php comments_template(); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if( $has_sidebar == true ) : ?>
						<aside class="vu_sidebar vu_s-<?php echo esc_attr($housico_page_sidebar['sidebar']); ?> col-xs-12 col-sm-6 col-md-<?php echo absint($housico_page_sidebar['layout']) . (($housico_page_sidebar['position'] == 'left') ? ' col-md-pull-'. (12 - absint($housico_page_sidebar['layout'])) : ''); ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
							<?php housico_dynamic_sidebar( $housico_page_sidebar['sidebar'] ); ?>
						</aside>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- /Container -->

	<?php endwhile; endif;

	get_footer();
?>