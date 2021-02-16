<form role="search" method="get" class="vu_search-form search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<div class="vu_sf-wrapper">
		<input type="search" class="vu_sf-input form-control" placeholder="<?php esc_attr_e('Type and hit enter', 'housico'); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"/>
		<button type="submit" class="vu_sf-submit search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		<?php do_action('housico_search_form'); ?>
	</div>
</form>