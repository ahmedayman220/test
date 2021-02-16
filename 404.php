<?php get_header(); ?>

	<!-- Container -->
	<div class="vu_container clearfix">
		<div class="container">
			<div class="row">
				<div class="vu_content col-xs-12">
					<div class="vu_error-page">
						<div class="vu_ep-404"><?php esc_html_e("404!", 'housico'); ?></div>

						<div class="vu_ep-content clearfix">
							<h2 class="vu_ep-title"><?php esc_html_e("The requested page cannot be found", 'housico'); ?></h2>

							<p class="vu_ep-desc">
								<?php esc_html_e("Sorry but the page you are looking for cannot be found.", 'housico')?>
								<br>
								<?php esc_html_e("Please make sure you have typed the correct url.", 'housico'); ?>
							</p>
							
							<a href="<?php echo esc_url( home_url('/') ); ?>" class="vu_ep-btn vu_button vu_b-shape-square vu_b-size-normal vu_b-normal-color-secondary vu_b-hover-color-primary"><?php esc_html_e("Return to home", 'housico'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Container -->

<?php get_footer(); ?>