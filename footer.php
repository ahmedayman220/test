		<?php do_action('housico_before_footer'); ?>

		<!-- Footer -->
		<footer id="vu_main-footer" class="vu_main-footer<?php echo ( housico_get_option('footer-fullwidth') == true ) ? ' vu_mf-fullwidth' : ''; ?>" role="contentinfo" itemscope="itemscope" itemtype="https://schema.org/WPFooter">
			<?php if ( housico_get_option('footer-show') == true ) : ?>
				<?php if ( housico_get_option('footer-type') == 'widgetized' and housico_footer_sidebars_has_widgets() ) : ?>
					<!-- Footer Widgets -->
					<div class="vu_mf-widgets">
						<div class="container">
							<div class="row">
								<?php 
									$footer_layout = @explode( '-', housico_get_option('footer-layout', '3-3-3-3') );

									for ( $i = 1; $i <= count($footer_layout); $i++ ) {
										echo '<div class="vu_mf-footer-'. $i .' col-md-'. absint($footer_layout[$i - 1]) .' col-sm-6 col-xs-12">';
										dynamic_sidebar('footer-'. $i);
										echo '</div>';
									}
								?>
							</div>
						</div>
					</div>
					<!-- /Footer Widgets -->
				<?php elseif ( housico_get_option('footer-type') == 'page' and trim( housico_get_option('footer-page') ) != '' ) : ?>
					<?php 
						$footer_page = get_post( housico_get_option('footer-page') );

						if ( !empty($footer_page) ) {
							echo apply_filters( 'the_content', $footer_page->post_content );
						}
					?>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if ( housico_get_option('subfooter-show') == true ) : ?>
				<!-- Subfooter -->
				<div class="vu_mf-subfooter">
					<div class="container">
						<?php if ( housico_get_option('subfooter-layout') == '1' ) : ?>
							<div class="vu_row row">
								<div class="vu_r-wrapper">
									<div class="vu_r-content">
										<div class="col-xs-12">
											<div class="vu_mf-sf-content text-<?php echo esc_attr( housico_get_option('subfooter-alignment', 'center') ); ?>">
												<?php echo do_shortcode( wp_kses_post( housico_get_option('subfooter-full-content') ) ); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php else : ?>
							<div class="vu_row row">
								<div class="vu_r-wrapper vu_r-equal-height">
									<div class="vu_r-content">
										<div class="col-sm-7 vu_c-valign-middle">
											<div class="vu_mf-sf-content vu_mf-sf-content-left">
												<?php echo do_shortcode( wp_kses_post( housico_get_option('subfooter-left-content') ) ); ?>
											</div>
										</div>

										<div class="col-sm-5 vu_c-valign-middle">
											<div class="vu_mf-sf-content vu_mf-sf-content-right text-right">
												<?php echo do_shortcode( wp_kses_post( housico_get_option('subfooter-right-content') ) ); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<!-- /Subfooter Bottom -->
			<?php endif; ?>

			<?php if ( housico_get_option('back-to-top-show') == true ) : ?>
				<a href="#" class="vu_back-to-top">
					<i class="vu_fp-keyboard_arrow_up"></i>
				</a>
			<?php endif; ?>
		</footer>
		<!-- /Footer -->

		<?php do_action('housico_after_footer'); ?>

	</div><!-- /Main Container -->

	<?php wp_footer(); ?>
</body>
</html>