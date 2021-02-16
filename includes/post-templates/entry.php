<article id="post-<?php the_ID(); ?>" <?php post_class('vu_blog-post vu_bp-type-standard'); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting">
	<?php if( has_post_thumbnail() ) : ?>
		<div class="vu_bp-image">
			<a href="<?php if( is_single() ) { echo housico_get_attachment_image_src(get_post_thumbnail_id(), 'full'); } else { echo esc_url( get_permalink() ); } ?>"<?php if( is_single() ) { echo ' class="vu_lightbox"'; } ?>>
				<?php the_post_thumbnail('housico_ratio-2:1', array('itemprop' => 'image')); ?>
			</a>
		</div>
	<?php endif; ?>
	
	<div class="vu_bp-content-wrapper">
		<header class="vu_bp-header">
			<?php if( !is_single() ) : ?>
				<h3 class="vu_bp-title entry-title" itemprop="name">
					<a href="<?php echo esc_url( get_permalink() ); ?>" itemprop="url" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
				</h3>
			<?php else : ?>
				<h1 class="vu_bp-title entry-title" itemprop="name"><?php the_title(); ?></h1>
			<?php endif; ?>
			
			<div class="vu_bp-meta">
				<?php if( housico_get_option('blog-show-date') ) : ?>
					<span class="vu_bp-m-item vu_bp-date">
						<i class="fa fa-calendar-o" aria-hidden="true"></i>
						<a href="<?php echo esc_url( get_permalink() ); ?>" itemprop="url" rel="bookmark">
							<time class="entry-date published" datetime="<?php echo esc_attr( get_the_time('c') ); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
						</a>
					</span>
				<?php endif; ?>

				<?php if( housico_get_option('blog-show-author') ) : ?>
					<span class="vu_bp-m-item vu_bp-author">
						<i class="fa fa-user-o" aria-hidden="true"></i>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php esc_attr_e('Posts by', 'housico'); ?> <?php the_author(); ?>" rel="author"><span itemprop="author"><?php the_author(); ?></span></a>
					</span>
				<?php endif; ?>

				<span class="vu_bp-m-item vu_bp-categories">
					<i class="fa fa-folder-open-o" aria-hidden="true"></i>
					<?php the_category(', '); ?>	
				</span>

				<span class="vu_bp-m-item vu_bp-comments">
					<i class="fa fa-comment-o" aria-hidden="true"></i>
					<a href="<?php comments_link(); ?>"><?php comments_number( esc_html__('No Comments', 'housico'), esc_html__('One Comment ', 'housico'), esc_html__('% Comments', 'housico') ); ?></a>
				</span>

				<?php if( !is_single() and housico_get_option('blog-show-tags') and has_tag() ) : ?>
					<span class="vu_bp-m-item vu_bp-tags">
						<i class="fa fa-tags" aria-hidden="true"></i>
						<?php the_tags('', ', ' ,''); ?>
					</span>
				<?php endif; ?>

				<div class="clear"></div>
			</div>					
			<div class="clear"></div>
		</header>

		<div class="vu_bp-content">
			<?php if( !is_single() ) : ?>
				<div class="vu_bp-content-excerpt" itemprop="description"><?php the_excerpt(); ?></div>
				<div class="clear"></div>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="vu_bp-read-more"><?php esc_html_e('Read More', 'housico'); ?></a>
			<?php else : ?>
				<div class="vu_bp-content-full entry-content" itemprop="articleBody">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
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