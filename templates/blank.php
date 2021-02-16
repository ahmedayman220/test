<?php 
	/*
		Template Name: Blank
	*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo("charset") ); ?>">

	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link rel="pingback" href="<?php echo esc_url( get_bloginfo("pingback_url") ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
	<?php do_action('housico_before_header'); ?>
	
	<!-- Main Container -->
	<div class="vu_main-container<?php echo (housico_get_option('boxed-layout') == true) ? ' boxed' : ''; ?>">
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif;
		?>
	</div><!-- /Main Container -->

	<?php wp_footer(); ?>
</body>
</html>