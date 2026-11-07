<?php
/**
 * Block & Pattern Categories
 *
 * Registers custom block categories and block pattern categories
 * used throughout this theme.
 *
 * @package Brilliant_Insurance
 */

if ( ! function_exists( 'bnti_block_categories' ) ) :
	/**
	 * Adds the "Brilliant Blocks" category to the block inserter.
	 *
	 * @param  array                   $block_categories     Existing block categories.
	 * @param  WP_Block_Editor_Context $block_editor_context Current editor context.
	 * @return array
	 */
	function bnti_block_categories( $block_categories, $block_editor_context ) {
		return array_merge(
			array(
				array(
					'slug'  => 'bnti',
					'title' => __( 'Brilliant Insurance', 'brilliant-insurance' ),
				),
			),
			$block_categories

		);
	}
endif;
add_filter( 'block_categories_all', 'bnti_block_categories', 10, 2 );


if ( ! function_exists( 'bnti_pattern_categories' ) ) :
	/**
	 * Registers the "Brilliant Insurance" block pattern category.
	 */
	function bnti_pattern_categories() {
		register_block_pattern_category(
			'bnti',
			array(
				'label'       => __( 'Brilliant Insurance', 'brilliant-insurance' ),
				'description' => __( 'A collection of Brilliant Insurance patterns.', 'brilliant-insurance' ),
			)
		);
	}
endif;
add_action( 'init', 'bnti_pattern_categories' );


// ── ID column on the Categories admin screen ──────────────────────────────────

if ( ! function_exists( 'bnti_category_columns' ) ) :
	/**
	 * Adds an "ID" column to the Categories list table.
	 *
	 * @param  array $columns Existing column definitions.
	 * @return array
	 */
	function bnti_category_columns( $columns ) {
		$columns['bnti_id'] = __( 'ID', 'brilliant-insurance' );
		return $columns;
	}
endif;
add_filter( 'manage_edit-category_columns', 'bnti_category_columns' );

/**
 * Caps the ID column width on the Categories list table.
 */
function bnti_category_column_width() {
	?>
	<style>
		.wp-list-table .column-bnti_id {
			width: 100px;
			max-width: 100px;
		}
	</style>
	<?php
}
add_action( 'admin_head-edit-tags.php', 'bnti_category_column_width' );


if ( ! function_exists( 'bnti_category_column_content' ) ) :
	/**
	 * Outputs the term ID for the custom column.
	 *
	 * @param  string $content      Column content.
	 * @param  string $column_name  Column key.
	 * @param  int    $term_id      Term ID.
	 * @return string
	 */
	function bnti_category_column_content( $content, $column_name, $term_id ) {
		if ( 'bnti_id' === $column_name ) {
			return (string) $term_id;
		}
		return $content;
	}
endif;
add_filter( 'manage_category_custom_column', 'bnti_category_column_content', 10, 3 );
