<article id="post-<?php the_ID(); ?>" <?php post_class('vu_blog-post vu_bp-type-link'); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting">
	<div class="vu_bp-content-wrapper">
		<?php $housico_post_format_settings = housico_get_post_meta( $post->ID, 'housico_post_format_settings' ); ?>
		<header class="vu_bp-header">
			<?php if( !is_single() ) : ?>
				<h3 class="vu_bp-title entry-title" itemprop="name">
					<a href="<?php echo (!empty($housico_post_format_settings['link']['url'])) ? esc_url($housico_post_format_settings['link']['url']) : '#'; ?>" itemprop="url" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
				</h3>
			<?php else : ?>
				<h1 class="vu_bp-title entry-title" itemprop="name">
					<a href="<?php echo (!empty($housico_post_format_settings['link']['url'])) ? esc_url($housico_post_format_settings['link']['url']) : '#'; ?>" itemprop="url" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
				</h1>
			<?php endif; ?>
			<div class="clear"></div>
		</header>

		<div class="vu_bp-content">
			<div class="vu_bp-content-excerpt" itemprop="description">
				<?php echo wpautop($housico_post_format_settings['link']['url']); ?>
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