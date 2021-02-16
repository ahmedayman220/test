<?php 
	/**
	 *	Housico WordPress Theme
	 */

	if ( !defined('ABSPATH') ) exit();

	// Check if string starts with
	if ( !function_exists('housico_string_starts_with') ) {
		function housico_string_starts_with($haystack, $needle) {
			$length = strlen($needle);

			return (substr($haystack, 0, $length) === $needle);
		}
	}

	// Check if string ends with
	if ( !function_exists('housico_string_ends_with') ) {
		function housico_string_ends_with($haystack, $needle) {
			$length = strlen($needle);

			return $length === 0 || (substr($haystack, -$length) === $needle);
		}
	}
	
	// Convert Color from HEX to RGB
	if ( !function_exists('housico_hex2rgb') ) {
		function housico_hex2rgb($color, $string = false) {
			if ( empty($color) ) {
				return;
			}

			if ( $color[0] == '#' ) {
				$color = substr( $color, 1 );
			}

			if ( strlen( $color ) == 6 ) {
				list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return false;
			}

			$r = hexdec( $r );
			$g = hexdec( $g );
			$b = hexdec( $b );

			if ( $string == true ) {
				return $r.','.$g.','.$b;
			} else {
				return array( 'red' => $r, 'green' => $g, 'blue' => $b );
			}
		}
	}

	// Convert Color from RGB to HEX
	if ( !function_exists('housico_rgb2hex') ) {
		function housico_rgb2hex($r, $g=-1, $b=-1) {
			if (is_array($r) && sizeof($r) == 3) {
				list($r, $g, $b) = $r;
			}

			$r = intval($r); $g = intval($g);
			$b = intval($b);

			$r = dechex($r < 0 ? 0 : ($r > 255 ? 255 : $r));
			$g = dechex($g < 0 ? 0 : ($g > 255 ? 255 : $g));
			$b = dechex($b < 0 ? 0 : ($b > 255 ? 255 : $b));

			$color = (strlen($r) < 2 ? '0' : ''). $r;
			$color .= (strlen($g) < 2 ? '0' : ''). $g;
			$color .= (strlen($b) < 2 ? '0' : ''). $b;

			return '#'.$color;
		}
	}

	// Multidimensional array merge recursive
	if ( !function_exists('housico_array_merge_recursive') ) {
		function housico_array_merge_recursive(&$array1, &$array2){
			$merged = $array1;

			foreach ($array2 as $key => &$value) {
				if ( is_array($value) && isset($merged[$key]) && is_array($merged[$key]) ) {
					$merged[$key] = housico_array_merge_recursive($merged[$key], $value);
				} else {
					if ( $value != 'inherit' && $value != '' ) {
						$merged[$key] = $value;
					}
				}
			}

			return $merged;
		}
	}

	// Minify output
	if( !function_exists('housico_minify_output') ) {
		function housico_minify_output($output) {
			return str_replace(array("\n", "\r", "\t"), '', $output);
		}
	}

	// Compress the CSS
	if ( !function_exists('housico_css_compress') ) {
		//https://github.com/matthiasmullie/minify/blob/master/src/CSS.php
		function housico_css_compress($content) {
			// reusable bits of code throughout these regexes:
			// before & after are used to make sure we don't match lose unintended
			// 0-like values (e.g. in #000, or in http://url/1.0)
			// units can be stripped from 0 values, or used to recognize non 0
			// values (where wa may be able to strip a .0 suffix)
			$before = '(?<=[:(, ])';
			$after = '(?=[ ,);}])';
			$units = '(em|ex|%|px|cm|mm|in|pt|pc|ch|rem|vh|vw|vmin|vmax|vm)';
			// strip units after zeroes (0px -> 0)
			$content = preg_replace('/' . $before . '(-?0*(\.0+)?)(?<=0)' . $units . $after . '/', '\\1', $content);
			// strip 0-digits (.0 -> 0)
			$content = preg_replace('/' . $before . '\.0+' . $after . '/', '0', $content);
			// 50.00 -> 50, 50.00px -> 50px (non-0 can still be followed by units)
			$content = preg_replace('/' . $before . '(-?[0-9]+)\.0+' . $units . '?' . $after . '/', '\\1\\2', $content);
			// strip negative zeroes (-0 -> 0) & truncate zeroes (00 -> 0)
			$content = preg_replace('/' . $before . '-?0+' . $after . '/', '0', $content);

			//Shorthand hex color codes
			$content = preg_replace('/(?<![\'"])#([0-9a-z])\\1([0-9a-z])\\2([0-9a-z])\\3(?![\'"])/i', '#$1$2$3', $content);

			//Strip comments from source code
			$content = preg_replace('/\/\*.*?\*\//s', '', $content);

			// remove leading & trailing whitespace
			$content = preg_replace('/^\s*/m', '', $content);
			$content = preg_replace('/\s*$/m', '', $content);
			// replace newlines with a single space
			$content = preg_replace('/\s+/', ' ', $content);
			// remove whitespace around meta characters
			// inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
			$content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
			$content = preg_replace('/([\[(:])\s+/', '$1', $content);
			$content = preg_replace('/\s+([\]\)])/', '$1', $content);
			$content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);
			// whitespace around + and - can only be stripped in selectors, like
			// :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
			// like 3px -2px
			$content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);
			// remove semicolon/whitespace followed by closing bracket
			$content = preg_replace('/;}/', '}', $content);
			return trim($content);
		}
	}
?>