<?php 
	get_header();
	
	$housico_page_sidebar = housico_get_blog_sidebar();

	$has_sidebar = housico_has_sidebar( $housico_page_sidebar ); ?>
	
	<!-- Content -->
	<div class="vu_container vu_blog-single-post <?php echo ($has_sidebar == true) ? 'vu_with-sidebar' : 'vu_no-sidebar'; ?> clearfix">
		<div class="container">
			<div class="row">
				<div class="vu_content col-xs-12 col-sm-12 col-md-<?php echo ($has_sidebar == true) ? (12 - absint($housico_page_sidebar['layout'])) . (($housico_page_sidebar['position'] == 'left') ? ' col-md-push-'. absint($housico_page_sidebar['layout']) : '') : '12'; ?>">
					<div class="vu_bsp-content">
						<?php 
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								get_template_part( 'includes/post-templates/entry', get_post_format() );
							endwhile; endif;
						?>

						<?php wp_link_pages(); ?>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div class="vu_bsp-comments clearfix">
								<?php comments_template(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			
				<?php 
					if( $has_sidebar == true ) {
						get_sidebar();
					}
				?>
			</div>
		</div>
	</div>
	<!-- /Content -->

<?php get_footer(); ?>