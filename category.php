<?php 
	get_header();

	$housico_page_sidebar = housico_get_blog_sidebar();

	$has_sidebar = housico_has_sidebar( $housico_page_sidebar ); ?>
	
	<!-- Container -->
	<div class="vu_container vu_category-page <?php echo ($has_sidebar == true) ? 'vu_with-sidebar' : 'vu_no-sidebar'; ?> clearfix">
		<div class="container">
			<div class="row">
				<div class="vu_content col-xs-12 col-sm-12 col-md-<?php echo ($has_sidebar == true) ? (12 - absint($housico_page_sidebar['layout'])) . (($housico_page_sidebar['position'] == 'left') ? ' col-md-push-'. absint($housico_page_sidebar['layout']) : '') : '12'; ?>">
					<?php if ( have_posts() ) :  ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="row">
								<div class="col-xs-12">
									<?php get_template_part( 'includes/post-templates/entry', get_post_format() ); ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php else : ?>
						<p><?php esc_html_e('No posts found', 'housico'); ?></p>
					<?php endif; ?>
					
					<?php housico_pagination(); ?>
				</div>

				<?php 
					if( $has_sidebar == true ) {
						get_sidebar();
					}
				?>
			</div>
		</div>
	</div>
	<!-- /Container -->

<?php get_footer(); ?>