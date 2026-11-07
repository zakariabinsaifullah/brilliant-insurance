<?php
/**
 * Gravity Forms: theme styles and the block-button submit.
 *
 * @package Brilliant_Insurance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Enqueue front-end styles ───────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'bnti_gravity_forms_assets' );

function bnti_gravity_forms_assets() {
	wp_enqueue_style(
		'bnti-gravity-forms',
		get_theme_file_uri( 'assets/css/gravity-forms.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}

// ── Gravity Forms submit button ────────────────────────────────────────────────

add_filter( 'gform_submit_button', 'bnti_gform_submit_button', 10, 2 );

/**
 * Renders the Gravity Forms submit button as the theme's default block button.
 *
 * Gravity Forms ships the submit as `<input type="submit">`. It is rebuilt here
 * as a `<button>` with the same attributes (id, classes and GF's `onclick`
 * submission handler are all preserved, so GF's own JS still finds and drives
 * it), carrying the block button's element classes and wrapped in the same
 * `.wp-block-button` markup a core button block produces.
 *
 * Colours, typography and metrics are restated in assets/css/gravity-forms.css,
 * which has to out-specify Gravity Forms' own button CSS.
 *
 * Image buttons (`<input type="image">`) are left exactly as Gravity Forms
 * rendered them.
 *
 * @param string $button The button HTML.
 * @param array  $form   The current form.
 * @return string Button HTML.
 */
function bnti_gform_submit_button( $button, $form ) {
	$processor = new WP_HTML_Tag_Processor( $button );

	if ( ! $processor->next_tag( array( 'tag_name' => 'INPUT' ) ) || 'submit' !== $processor->get_attribute( 'type' ) ) {
		return $button;
	}

	$label = $processor->get_attribute( 'value' );

	// The block element classes carry the theme's button styling; Gravity Forms'
	// own `gform_button button` classes come along with the copied attributes.
	$classes = trim( ( $processor->get_attribute( 'class' ) ?? '' ) . ' wp-block-button__link wp-element-button' );
	$attrs   = sprintf( ' class="%s"', esc_attr( $classes ) );

	foreach ( $processor->get_attribute_names_with_prefix( '' ) as $name ) {
		// `type` is restated below, `value` becomes the button's text content,
		// and `class` is handled above.
		if ( in_array( $name, array( 'type', 'value', 'class' ), true ) ) {
			continue;
		}

		$value = $processor->get_attribute( $name );

		if ( true === $value ) {
			$attrs .= ' ' . esc_attr( $name );
		} elseif ( is_string( $value ) ) {
			$attrs .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
		}
	}

	return sprintf(
		'<div class="wp-block-button bnti-gform-button"><button type="submit"%1$s>%2$s</button></div>',
		$attrs,
		esc_html( $label )
	);
}
