<?php 
if ( !defined('ABSPATH') ) exit();

if( !class_exists('Housico_VC_Params') ) {
	class Housico_VC_Params {
		public function __construct() {
			if ( method_exists('WpbakeryShortcodeParams', 'addField') ) {
				WpbakeryShortcodeParams::addField( 'image_select' , array($this, 'image_select') );
				WpbakeryShortcodeParams::addField( 'universal' , array($this, 'universal') );
				WpbakeryShortcodeParams::addField( 'media' , array($this, 'media') );
				WpbakeryShortcodeParams::addField( 'select2' , array($this, 'select2') );
			}
		}

		public function image_select($settings, $value) {
			if ( is_array($value) ) {
				$value = (isset($settings['std'])) ? $settings['std'] : key($settings['value']);
			}

			$output = '<div class="vu_param_image-select">';

			if ( !empty($settings['value']) ) {
				$output .= '<div class="vu_param_is-images vc_clearfix">';

				foreach ( $settings['value'] as $id => $image ) {
					$style = (isset($settings['width'])) ? 'width:'. $settings['width'] .';' : '';
					$style .= (isset($settings['height'])) ? 'height:'. $settings['height'] .';' : '';

					if ( is_array($image) && !empty($image) ) {
						$output .= '<span data-id="'. esc_attr($id) .'"'. (!empty($style) ? ' style="'. esc_attr($style) .'"' : '') . (($id == $value) ? ' class="selected"' : '') .'><img'. ((isset($image['title']) && !empty($image['title'])) ? ' title="'. esc_attr($image['title']) .'"' : '' ) .' src="'. esc_attr($image['image']) .'"></span>';
					} else {
						$output .= '<span data-id="'. esc_attr($id) .'"'. (!empty($style) ? ' style="'. esc_attr($style) .'"' : '') . (($id == $value) ? ' class="selected"' : '') .'><img src="'. esc_attr($image) .'"></span>';
					}
				}

				$output .= '</div>';
			}
					
			$output .= '<input name="'. esc_attr( $settings['param_name'] ) .'" class="vu_param_is-value wpb_vc_param_value '. $settings['param_name'] .' '. $settings['type'] .'" type="hidden" value="'. esc_attr($value) .'"/>';
			$output .= '</div>';

			return $output;
		}

		public function universal($settings, $value) {
			if( empty($value) ) {
				$value = '[]';
			}

			ob_start(); ?>
				<div class="vu_param_universal">
					<script type="text/html" id="vu_param_u-template">
						<div class="vu_param_u-item-container">
							<div class="vu_param_u-item-controls">
								<span class="vu_param_u-item-btn" data-control="delete" title="<?php esc_attr_e('Delete', 'housico'); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
								<span class="vu_param_u-item-btn" data-control="clone" title="<?php esc_attr_e('Clone', 'housico'); ?>"><i class="fa fa-files-o" aria-hidden="true"></i></span>
								<span class="vu_param_u-item-btn" data-control="move" title="<?php esc_attr_e('Move', 'housico'); ?>"><i class="fa fa-arrows" aria-hidden="true"></i></span>
								<span class="vu_param_u-item-btn" data-control="counter"></span>
							</div>
							<div class="vu_param_u-item vc_clearfix">
								<?php echo ($settings['template']); ?>
							</div>
						</div>
					</script>

					<div class="vu_param_u-items" data-count="1"></div>

					<button class="vu_param_u-add-item" title="<?php esc_attr_e('Add More', 'housico'); ?>"><i class="fa fa-plus-square" aria-hidden="true"></i></button>

					<input name="<?php echo esc_attr($settings['param_name']); ?>" class="vu_param_u-value wpb_vc_param_value" type="hidden" value="<?php echo esc_attr($value); ?>">
				</div>
			<?php

			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		}

		public function media($settings, $value) {
			if( empty($value) ) {
				$value = '{}';
			}

			$default = array(
				'title' => esc_html__('Add Image', 'housico'),
				'button' => esc_html__('Add Image', 'housico'),
				'upload' => esc_html__('Upload', 'housico'),
				'remove' => esc_html__('Remove', 'housico'),
				'placeholder' => esc_html__('No media selected', 'housico'),
				'preview' => true,
				'readonly' => true,
			);

			if ( !isset($settings['options']) or !is_array($settings['options']) ) {
				$settings['options'] = array();
			}

			$options = array_merge($default, $settings['options']);

			ob_start(); ?>
				<div class="vu_param_media vc_clearfix">
					<?php if ( $options['preview'] == true ) : ?>
						<div class="vu_param_m-img-holder">
							<span class="vu_param_m-img"></span>
						</div>
					<?php endif; ?>

					<div class="vu_param_m-content">
						<input type="hidden" class="vu_param_m-img-id">
						<input type="text" class="vu_param_m-img-url"<?php echo ($options['readonly'] == true) ? ' readonly="readonly"' : ''; ?> placeholder="<?php echo esc_attr($options['placeholder']); ?>">
						<button type="button" class="vu_param_m-btn vu_as-param" data-control="upload" data-title="<?php echo esc_attr($options['title']); ?>" data-button="<?php echo esc_attr($options['button']); ?>"><?php echo esc_html($options['upload']); ?></button>
						<button type="button" class="vu_param_m-btn vu_as-param" data-control="remove"><?php echo esc_attr($options['remove']); ?></button>
					</div>

					<input name="<?php echo esc_attr($settings['param_name']); ?>" class="vu_param_m-value wpb_vc_param_value" type="hidden" value="<?php echo esc_attr($value); ?>">
				</div>
			<?php

			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		}

		public function select2($settings, $value) {
			$value = (empty($value) && isset($settings['std'])) ? $settings['std'] : $value;

			$_value = @explode(',', $value);

			if ( isset($settings['options']['source']) ) {
				$settings['options']['source'] .= '&selected='. $value;
			}

			ob_start(); ?>
				<div class="vu_param_select2 vc_clearfix">
					<div class="vu_param_s2-content">
						<select<?php echo (isset($settings['multiple']) && $settings['multiple'] == true) ? ' multiple' : ''; ?> class="vu_param_s2-select" data-options="<?php echo esc_attr(json_encode($settings['options'])); ?>" data-value="<?php echo esc_attr($value); ?>">
							<?php
								foreach ($settings['value'] as $text => $val) {
									if ( is_array($val) ) {
										echo '<optgroup label="'. esc_attr($text) .'">';

										foreach ($val as $k => $v) {
											echo '<option value="'. esc_attr($v) .'"'. (in_array($v, $_value) ? ' selected="selected"' : '') .'>'. esc_html($k) .'</option>';
										}

										echo '</optgroup>';
									} else {
										echo '<option value="'. esc_attr($val) .'"'. (in_array($val, $_value) ? ' selected="selected"' : '') .'>'. esc_html($text) .'</option>';
									}
								}
							?>
						</select>
					</div>

					<input name="<?php echo esc_attr($settings['param_name']); ?>" class="vu_param_s2-value wpb_vc_param_value" type="hidden" value="<?php echo esc_attr($value); ?>">
				</div>
			<?php

			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		}
	}
}

if( class_exists('Housico_VC_Params') ) {
	$Housico_VC_Params = new Housico_VC_Params();
}
?>