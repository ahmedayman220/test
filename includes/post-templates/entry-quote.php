<article id="post-<?php the_ID(); ?>" <?php post_class('vu_blog-post vu_bp-type-quote'); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting">
	<div class="vu_bp-content-wrapper">
		<div class="vu_bp-content">
			<div class="vu_bp-content-full">
				<?php 
					$housico_post_format_settings = housico_get_post_meta( $post->ID, 'housico_post_format_settings' );

					if( !empty($housico_post_format_settings['quote']['content']) ) {
						echo '<div class="vu_bp-quote">';
						echo '<blockquote class="vu_bp-q-content">';
						echo wpautop( esc_html($housico_post_format_settings['quote']['content']) );
						echo '<div class="vu_bp-q-author">'. esc_html($housico_post_format_settings['quote']['author']) .'</div>';
						echo '</blockquote>';
						echo '</div>';
					} else {
						the_content();
					}
				?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</article>

<?php if( is_single() ) : ?>
	<div class="vu_bp-social-tags-container">
		<div class="row">
			<div class="col-sm-6">
				<?php if( housico_get_option('blog-single-show-tags') and has_tag() ) : ?>
					<div class="vu_bp-tags">
						<?php the_tags('<span>'. esc_html__('Tags:', 'housico') .'</span>', ', ', ''); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-6">
				<?php housico_blog_social_networks( get_permalink(), get_the_title(), $post->ID ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>