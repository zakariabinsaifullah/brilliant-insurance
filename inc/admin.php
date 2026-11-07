<?php
/**
 * Admin UI tweaks.
 *
 * @package Brilliant_Insurance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Post ID column ────────────────────────────────────────────────────────────

add_filter( 'manage_posts_columns', 'bnti_admin_add_id_column' );

if ( ! function_exists( 'bnti_admin_add_id_column' ) ) :
	/**
	 * Adds an ID column to the posts list table.
	 *
	 * Saves opening a post just to read its ID out of the address bar. Sits
	 * directly after the checkbox so it reads as part of the row's identity
	 * rather than as data.
	 *
	 * @param array $columns List table columns.
	 * @return array Columns with the ID column inserted.
	 */
	function bnti_admin_add_id_column( $columns ) {
		$updated = array();

		foreach ( $columns as $key => $label ) {
			$updated[ $key ] = $label;

			if ( 'cb' === $key ) {
				$updated['bnti_post_id'] = __( 'ID', 'brilliant-insurance' );
			}
		}

		// Screens without a checkbox column (bulk actions disabled) get it appended.
		if ( ! isset( $updated['bnti_post_id'] ) ) {
			$updated['bnti_post_id'] = __( 'ID', 'brilliant-insurance' );
		}

		return $updated;
	}
endif;

add_action( 'manage_posts_custom_column', 'bnti_admin_render_id_column', 10, 2 );

if ( ! function_exists( 'bnti_admin_render_id_column' ) ) :
	/**
	 * Outputs the post ID.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID for the current row.
	 */
	function bnti_admin_render_id_column( $column, $post_id ) {
		if ( 'bnti_post_id' === $column ) {
			echo (int) $post_id;
		}
	}
endif;

add_action( 'admin_head-edit.php', 'bnti_admin_id_column_style' );

if ( ! function_exists( 'bnti_admin_id_column_style' ) ) :
	/**
	 * Caps the ID column's width.
	 *
	 * Inline rather than a stylesheet: a few declarations on one screen aren't
	 * worth a request. `width` and `max-width` are both needed — the list table
	 * lays out with `table-layout: fixed`, where `max-width` alone is ignored —
	 * and `box-sizing` makes 60px the whole column rather than 60px plus the
	 * cell's 10px of padding either side.
	 */
	function bnti_admin_id_column_style() {
		echo '<style>.column-bnti_post_id{box-sizing:border-box;width:60px;max-width:60px;overflow:hidden;}</style>';
	}
endif;
