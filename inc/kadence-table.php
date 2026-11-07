<?php
/**
 * Kadence Table — mobile labels.
 *
 * On mobile the theme shows a Kadence Table as stacked cards (one card per
 * row, Figma "Inner / Table" mobile), with each cell's column heading as a
 * small label above its value. CSS can't know the heading text, so this copies
 * the header row's text onto every body cell as `data-label`, which the CSS
 * prints with `attr(data-label)` (assets/css/blocks.css, "Kadence Table").
 *
 * Only tables whose first row is a header row get labels.
 *
 * @package Brilliant_Insurance
 */

if ( ! function_exists( 'bnti_kadence_table_add_data_labels' ) ) :
	/**
	 * Adds `data-label="<column heading>"` to the body cells of a Kadence Table.
	 *
	 * @param string $block_content The rendered block HTML.
	 * @param array  $block         The block data including name and attributes.
	 * @return string Modified block HTML.
	 */
	function bnti_kadence_table_add_data_labels( $block_content, $block ) {
		if ( 'kadence/table' !== ( $block['blockName'] ?? '' ) || empty( $block_content ) ) {
			return $block_content;
		}

		if ( ! preg_match_all( '#<tr\b[^>]*>.*?</tr>#s', $block_content, $rows ) || count( $rows[0] ) < 2 ) {
			return $block_content;
		}

		// Column headings come from the first row's <th> cells.
		if ( ! preg_match_all( '#<th\b[^>]*>(.*?)</th>#s', $rows[0][0], $heads ) ) {
			return $block_content;
		}
		$labels = array_map(
			static function ( $html ) {
				return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $html ) ) );
			},
			$heads[1]
		);

		foreach ( array_slice( $rows[0], 1 ) as $row ) {
			$column  = 0;
			$labeled = preg_replace_callback(
				'#<td\b(?![^>]*\bdata-label=)#',
				static function () use ( &$column, $labels ) {
					$label = $labels[ $column ] ?? '';
					++$column;
					return '' === $label ? '<td' : '<td data-label="' . esc_attr( $label ) . '"';
				},
				$row
			);
			$block_content = str_replace( $row, $labeled, $block_content );
		}

		return $block_content;
	}
endif;
add_filter( 'render_block', 'bnti_kadence_table_add_data_labels', 10, 2 );
