<?php
/**
 * Brilliant Insurance — Theme Functions
 *
 * This file is intentionally kept as a loader only.
 * All feature logic lives in the files under inc/.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Brilliant_Insurance
 * @since   1.0
 */

// ── Theme setup ────────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/setup.php' );      // Post formats, editor style

// ── Asset enqueueing ───────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/enqueue.php' );    // Frontend & block styles

// ── Blocks ─────────────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/blocks.php' );        // Custom block registration
require_once get_theme_file_path( 'inc/block-styles.php' );  // Core block style variations
require_once get_theme_file_path( 'inc/extensions.php' );    // Block editor extensions
require_once get_theme_file_path( 'inc/kadence-table.php' ); // Kadence Table mobile labels

// ── Icon library ───────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/my-icons.php' );      // Site-wide saved SVG icons

// ── Editor taxonomy ────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/categories.php' ); // Block & pattern categories

// ── Gravity Forms ──────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/gravity-forms.php' ); // Gravity Forms styles & submit button
require_once get_theme_file_path( 'inc/form-panel.php' ); // Slide-in quote form panel & settings

// ── Shortcodes ─────────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/shortcode.php' ); // Posts grid shortcode

// ── Documentation ──────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/docs.php' );      // Appearance → Brilliant Insurance

// ── Admin UI ───────────────────────────────────────────────────────────────────
require_once get_theme_file_path( 'inc/admin.php' );     // Post ID column


/**
 * Set WordPress excerpt length to 25 words.
 */
function bnti_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'bnti_excerpt_length' );

/**
 * Customize excerpt more text.
 */
function bnti_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'bnti_excerpt_more' );