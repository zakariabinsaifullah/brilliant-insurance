<?php
/**
 * Block Editor Extensions
 *
 * Enqueues assets for block editor extensions that live in build/extensions/
 * (Group Full Height, Text Max Width, Iconic Button).
 * Extensions are different from custom blocks — they extend existing blocks
 * rather than registering new block types.
 *
 * @package Brilliant_Insurance
 */


// =============================================================================
// Group – Force Full Height Extension
// =============================================================================

if ( ! function_exists( 'bnti_enqueue_group_full_height_editor_assets' ) ) :
	/**
	 * Enqueues the group-full-height extension script and editor stylesheet.
	 * Runs on `enqueue_block_editor_assets` (editor only).
	 */
	function bnti_enqueue_group_full_height_editor_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/group-full-height/index.asset.php' );

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_script(
			'bnti-group-full-height-extension',
			get_theme_file_uri( 'build/extensions/group-full-height/index.js' ),
			$assets['dependencies'],
			wp_get_theme()->get( 'Version' ),
			true
		);

		$editor_css = get_theme_file_path( 'build/extensions/group-full-height/index.css' );
		if ( file_exists( $editor_css ) ) {
			wp_enqueue_style(
				'bnti-group-full-height-extension',
				get_theme_file_uri( 'build/extensions/group-full-height/index.css' ),
				array(),
				wp_get_theme()->get( 'Version' )
			);
		}
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bnti_enqueue_group_full_height_editor_assets' );


if ( ! function_exists( 'bnti_enqueue_group_full_height_frontend_assets' ) ) :
	/**
	 * Enqueues the group-full-height frontend stylesheet.
	 * Runs on `enqueue_block_assets` (editor + front end).
	 */
	function bnti_enqueue_group_full_height_frontend_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/group-full-height/index.asset.php' );
		$style_file = get_theme_file_path( 'build/extensions/group-full-height/style-index.css' );

		if ( ! file_exists( $asset_file ) || ! file_exists( $style_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_style(
			'bnti-group-full-height-extension-style',
			get_theme_file_uri( 'build/extensions/group-full-height/style-index.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'enqueue_block_assets', 'bnti_enqueue_group_full_height_frontend_assets' );


if ( ! function_exists( 'bnti_render_group_full_height' ) ) :
	/**
	 * Injects the `has-force-full-height` class into core/group blocks on the frontend
	 * when the `forceFullHeight` attribute is enabled.
	 *
	 * @param string $block_content The rendered block HTML.
	 * @param array  $block         The block data including name and attributes.
	 * @return string Modified block HTML.
	 */
	function bnti_render_group_full_height( $block_content, $block ) {
		if ( 'core/group' !== $block['blockName'] ) {
			return $block_content;
		}

		if ( empty( $block['attrs']['forceFullHeight'] ) ) {
			return $block_content;
		}

		if ( empty( $block_content ) ) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor( $block_content );
		if ( $processor->next_tag() ) {
			$processor->add_class( 'has-force-full-height' );
			return $processor->get_updated_html();
		}

		return $block_content;
	}
endif;
add_filter( 'render_block', 'bnti_render_group_full_height', 10, 2 );

// =============================================================================
// Heading & Paragraph – Max Width Extension
// =============================================================================

if ( ! function_exists( 'bnti_enqueue_text_max_width_editor_assets' ) ) :
	/**
	 * Enqueues the text-max-width extension script and editor stylesheet.
	 * Runs on `enqueue_block_editor_assets` (editor only).
	 */
	function bnti_enqueue_text_max_width_editor_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/text-max-width/index.asset.php' );

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_script(
			'bnti-text-max-width-extension',
			get_theme_file_uri( 'build/extensions/text-max-width/index.js' ),
			$assets['dependencies'],
			wp_get_theme()->get( 'Version' ),
			true
		);

		$editor_css = get_theme_file_path( 'build/extensions/text-max-width/index.css' );
		if ( file_exists( $editor_css ) ) {
			wp_enqueue_style(
				'bnti-text-max-width-extension',
				get_theme_file_uri( 'build/extensions/text-max-width/index.css' ),
				array(),
				wp_get_theme()->get( 'Version' )
			);
		}
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bnti_enqueue_text_max_width_editor_assets' );


if ( ! function_exists( 'bnti_enqueue_text_max_width_frontend_assets' ) ) :
	/**
	 * Enqueues the text-max-width frontend stylesheet.
	 * Runs on `enqueue_block_assets` (editor + front end).
	 */
	function bnti_enqueue_text_max_width_frontend_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/text-max-width/index.asset.php' );
		$style_file = get_theme_file_path( 'build/extensions/text-max-width/style-index.css' );

		if ( ! file_exists( $asset_file ) || ! file_exists( $style_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_style(
			'bnti-text-max-width-extension-style',
			get_theme_file_uri( 'build/extensions/text-max-width/style-index.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'enqueue_block_assets', 'bnti_enqueue_text_max_width_frontend_assets' );


if ( ! function_exists( 'bnti_render_text_max_width' ) ) :
	/**
	 * Injects the `has-max-width` class and `--max-width` CSS custom property
	 * into supported blocks on the frontend when the maxWidth attribute is set.
	 *
	 * @param string $block_content The rendered block HTML.
	 * @param array  $block         The block data including name and attributes.
	 * @return string Modified block HTML.
	 */
	function bnti_render_text_max_width( $block_content, $block ) {
		$supported = array( 'core/heading', 'core/paragraph' );

		if ( ! in_array( $block['blockName'], $supported, true ) ) {
			return $block_content;
		}

		$attrs = $block['attrs'] ?? array();

		if ( empty( $attrs['maxWidth'] ) ) {
			return $block_content;
		}

		if ( empty( $block_content ) ) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor( $block_content );
		if ( $processor->next_tag() ) {
			$processor->add_class( 'has-max-width' );

			$existing_style = $processor->get_attribute( 'style' ) ?? '';
			$new_style      = rtrim( $existing_style, '; ' );
			if ( $new_style ) {
				$new_style .= ';';
			}
			$new_style .= '--max-width:' . intval( $attrs['maxWidth'] ) . 'px';
			$processor->set_attribute( 'style', $new_style );

			return $processor->get_updated_html();
		}

		return $block_content;
	}
endif;
add_filter( 'render_block', 'bnti_render_text_max_width', 10, 2 );


// =============================================================================
// Button – Iconic Button Extension
// =============================================================================

if ( ! function_exists( 'bnti_enqueue_iconic_button_editor_assets' ) ) :
	/**
	 * Enqueues the iconic-button extension script and editor stylesheet.
	 * Runs on `enqueue_block_editor_assets` (editor only).
	 */
	function bnti_enqueue_iconic_button_editor_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/iconic-button/index.asset.php' );

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_script(
			'bnti-iconic-button-extension',
			get_theme_file_uri( 'build/extensions/iconic-button/index.js' ),
			$assets['dependencies'],
			wp_get_theme()->get( 'Version' ),
			true
		);

		$editor_css = get_theme_file_path( 'build/extensions/iconic-button/index.css' );
		if ( file_exists( $editor_css ) ) {
			wp_enqueue_style(
				'bnti-iconic-button-extension',
				get_theme_file_uri( 'build/extensions/iconic-button/index.css' ),
				array(),
				wp_get_theme()->get( 'Version' )
			);
		}
	}
endif;
add_action( 'enqueue_block_editor_assets', 'bnti_enqueue_iconic_button_editor_assets' );

if ( ! function_exists( 'bnti_enqueue_iconic_button_frontend_assets' ) ) :
	/**
	 * Enqueues the iconic-button extension frontend stylesheet.
	 * Runs on `enqueue_block_assets` (editor + front end).
	 */
	function bnti_enqueue_iconic_button_frontend_assets() {
		$asset_file = get_theme_file_path( 'build/extensions/iconic-button/index.asset.php' );
		$style_file = get_theme_file_path( 'build/extensions/iconic-button/style-index.css' );

		if ( ! file_exists( $asset_file ) || ! file_exists( $style_file ) ) {
			return;
		}

		$assets = require $asset_file;

		wp_enqueue_style(
			'bnti-iconic-button-extension-style',
			get_theme_file_uri( 'build/extensions/iconic-button/style-index.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'enqueue_block_assets', 'bnti_enqueue_iconic_button_frontend_assets' );

if ( ! function_exists( 'bnti_iconic_button_svg_kses_args' ) ) :
	/**
	 * Allowed SVG tags/attributes for icons rendered inside the iconic-button markup.
	 *
	 * @return array Kses args for wp_kses().
	 */
	function bnti_iconic_button_svg_kses_args() {
		// Presentation attributes shared by most SVG shape elements — stroke-based
		// icon sets (Feather, Lucide, Heroicons outline, Tabler, etc.) rely on these
		// alongside fill, so omitting any of them renders the icon invisible.
		$presentation_attrs = array(
			'fill'             => true,
			'fill-rule'        => true,
			'fill-opacity'     => true,
			'clip-rule'        => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-dasharray' => true,
			'stroke-dashoffset' => true,
			'stroke-miterlimit' => true,
			'stroke-opacity'   => true,
			'opacity'          => true,
			'transform'        => true,
		);

		// Reference attributes needed for icons exported with <defs>/<clipPath>/<mask>
		// (a common Figma/Illustrator export pattern). Without these, wp_kses strips
		// the wrapping <defs>/<clipPath> tags but keeps their child shapes, which then
		// render as visible elements instead of staying invisible clip/mask definitions.
		$reference_attrs = array(
			'id'        => true,
			'clip-path' => true,
			'mask'      => true,
		);

		return array(
			'svg'       => array_merge(
				array(
					'class'           => true,
					'aria-hidden'     => true,
					'aria-labelledby' => true,
					'role'            => true,
					'xmlns'           => true,
					'width'           => true,
					'height'          => true,
					'viewbox'         => true,
				),
				$presentation_attrs,
				$reference_attrs
			),
			'defs'      => array( 'id' => true ),
			'clippath'  => array( 'id' => true, 'clippathunits' => true ),
			'mask'      => array_merge(
				array(
					'id'          => true,
					'maskunits'   => true,
					'x'           => true,
					'y'           => true,
					'width'       => true,
					'height'      => true,
				),
				$presentation_attrs
			),
			'path'      => array_merge( array( 'd' => true ), $presentation_attrs, $reference_attrs ),
			'g'         => array_merge( $presentation_attrs, $reference_attrs ),
			'circle'    => array_merge(
				array(
					'cx' => true,
					'cy' => true,
					'r'  => true,
				),
				$presentation_attrs,
				$reference_attrs
			),
			'rect'      => array_merge(
				array(
					'x'      => true,
					'y'      => true,
					'width'  => true,
					'height' => true,
					'rx'     => true,
					'ry'     => true,
				),
				$presentation_attrs,
				$reference_attrs
			),
			'polygon'   => array_merge( array( 'points' => true ), $presentation_attrs, $reference_attrs ),
			'polyline'  => array_merge( array( 'points' => true ), $presentation_attrs, $reference_attrs ),
			'line'      => array_merge(
				array(
					'x1' => true,
					'y1' => true,
					'x2' => true,
					'y2' => true,
				),
				$presentation_attrs,
				$reference_attrs
			),
			'ellipse'   => array_merge(
				array(
					'cx' => true,
					'cy' => true,
					'rx' => true,
					'ry' => true,
				),
				$presentation_attrs,
				$reference_attrs
			),
		);
	}
endif;

if ( ! function_exists( 'bnti_render_iconic_button' ) ) :
	/**
	 * Injects the icon SVG markup and size/gap/padding/background CSS custom
	 * properties into core/button blocks on the frontend when the iconic button
	 * feature is enabled.
	 *
	 * @param string $block_content The rendered block HTML.
	 * @param array  $block         The block data including name and attributes.
	 * @return string Modified block HTML.
	 */
	function bnti_render_iconic_button( $block_content, $block ) {
		if ( 'core/button' !== ( $block['blockName'] ?? '' ) ) {
			return $block_content;
		}

		$attrs = $block['attrs'] ?? array();

		if ( empty( $attrs['iconicButtonEnabled'] ) || empty( $attrs['iconicButtonUniqueClass'] ) ) {
			return $block_content;
		}

		$icon_svg = ! empty( $attrs['iconicButtonCustomSvg'] ) ? $attrs['iconicButtonCustomSvg'] : ( $attrs['iconicButtonIcon'] ?? '' );

		if ( empty( $icon_svg ) ) {
			return $block_content;
		}

		if ( empty( $block_content ) ) {
			return $block_content;
		}

		// Merge icon size/gap/padding/background CSS custom properties into the outer wrapper's style attribute.
		$css_vars = array();
		if ( ! empty( $attrs['iconicButtonIconSize'] ) ) {
			$css_vars[] = '--bnti-icon-size:' . esc_attr( $attrs['iconicButtonIconSize'] );
		}
		if ( ! empty( $attrs['iconicButtonIconGap'] ) ) {
			$css_vars[] = '--bnti-icon-gap:' . esc_attr( $attrs['iconicButtonIconGap'] );
		}
		if ( ! empty( $attrs['iconicButtonIconPadding'] ) ) {
			$css_vars[] = '--bnti-icon-padding:' . esc_attr( $attrs['iconicButtonIconPadding'] );
		}
		if ( ! empty( $attrs['iconicButtonIconBgColor'] ) ) {
			$css_vars[] = '--bnti-icon-bg-color:' . esc_attr( $attrs['iconicButtonIconBgColor'] );
		}

		if ( ! empty( $css_vars ) ) {
			$processor = new WP_HTML_Tag_Processor( $block_content );
			if ( $processor->next_tag() ) {
				$existing_style = $processor->get_attribute( 'style' ) ?? '';
				$new_style      = rtrim( $existing_style, '; ' );
				if ( $new_style ) {
					$new_style .= ';';
				}
				$new_style .= implode( ';', $css_vars );
				$processor->set_attribute( 'style', $new_style );
				$block_content = $processor->get_updated_html();
			}
		}

		// Build the icon markup and inject it after the link's inner content.
		// Before/after visual ordering is handled entirely by CSS (flex-direction: row-reverse
		// on the .bnti-icon-before class), so the DOM position is always icon-after-text.
		$icon_html = '<span class="bnti-icon-button-svg">' . wp_kses( $icon_svg, bnti_iconic_button_svg_kses_args() ) . '</span>';

		$block_content = preg_replace_callback(
			'/(<a[^>]*class="[^"]*wp-block-button__link[^"]*"[^>]*>)(.*?)(<\/a>)/s',
			function ( $matches ) use ( $icon_html ) {
				$content = trim( $matches[2] );
				return $matches[1] . $content . $icon_html . $matches[3];
			},
			$block_content
		);

		return $block_content;
	}
endif;
add_filter( 'render_block', 'bnti_render_iconic_button', 10, 2 );
