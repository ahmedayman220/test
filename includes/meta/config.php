<?php 
	/**
	 * Housico WordPress Theme
	 */
	
	/**
	 * This file is used to save the data of meta boxes
 	 *
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
	 */

	if( !function_exists('housico_save_meta_box') ) {
		function housico_save_meta_box( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
				return;

			if ( wp_is_post_revision( $post_id ) )
				return;

			if ( !isset($_POST['vu_field']) or empty($_POST['vu_field']) or !wp_verify_nonce( $_POST['vu_metabox_nonce'], 'vu_metabox_nonce' ) )
				return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
					return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
					return;
			}

			foreach ( $_POST['vu_field'] as $key => $value ) {
				housico_update_post_meta( $post_id, $key, $value );
			}
		}

		add_action( 'save_post', 'housico_save_meta_box' );
	}

	// Update Post Meta Data
	if( !function_exists('housico_update_post_meta') ) {
		function housico_update_post_meta( $post_id, $meta_key, $meta_value, $prev_value = null ) {
			if( is_array($meta_value) )
				$meta_value = housico_json_encode( $meta_value );

			update_post_meta( $post_id, $meta_key, $meta_value, $prev_value );
		}
	}

	// Get Post Meta Data
	if( !function_exists('housico_get_post_meta') ) {
		function housico_get_post_meta( $post_id, $key, $json = true ){
			$return = get_post_meta( $post_id, $key, true );

			if ( $json )
				$return = housico_json_decode( $return );

			return $return;
		}
	}

	// JSON Encode
	if( !function_exists('housico_json_encode') ) {
		function housico_json_encode( $array ) {
			return wp_slash(json_encode($array));
		}
	}

	// JSON Decode
	if( !function_exists('housico_json_decode') ) {
		function housico_json_decode( $json ) {
			return ( !empty($json) ? wp_unslash(json_decode($json, true)) : false );
		}
	}
?>