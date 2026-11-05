<?php
/**
 * Theme Setup
 *
 * Handles core theme setup tasks that run on the `after_setup_theme` hook:
 * post format support and editor stylesheet registration.
 *
 * @package Brilliant_Insurance
 */

if ( ! function_exists( 'bnti_post_format_setup' ) ) :
	/**
	 * Declares support for the post formats used by this theme.
	 */
	function bnti_post_format_setup() {
		add_theme_support(
			'post-formats',
			array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' )
		);
	}
endif;
add_action( 'after_setup_theme', 'bnti_post_format_setup' );


if ( ! function_exists( 'bnti_editor_style' ) ) :
	/**
	 * Loads the editor stylesheet so the editing canvas matches the front end.
	 */
	function bnti_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'bnti_editor_style' );


if ( ! function_exists( 'bnti_page_excerpts' ) ) :
	/**
	 * Enables excerpts on pages. The attorney bio pages under Our Team use the
	 * excerpt for their role ("Attorney, Mobile, Alabama"), which the About Us
	 * mega menu's team list shows under each name.
	 */
	function bnti_page_excerpts() {
		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'init', 'bnti_page_excerpts' );
