<?php
/**
 * Core Block Styles
 *
 * Registers custom style variations for core (and third-party) blocks.
 *
 * @package Brilliant_Insurance
 */

if ( ! function_exists( 'bnti_block_styles' ) ) :
	/**
	 * Registers all custom block style variations for the theme.
	 */
	function bnti_block_styles() {
		register_block_style(
			'core/group',
			array(
				'name'  => 'wrap-mobile',
				'label' => __( 'Wrap Mobile', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/group',
			array(
				'name'  => 'plain-links',
				'label' => __( 'Plain Links', 'brilliant-insurance' ),
			)
		);


		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'has-arrow',
				'label' => __( 'Has Arrow', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/list',
			array(
				'name'  => 'dots',
				'label' => __( 'Dots', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/list',
			array(
				'name'  => 'mega-links',
				'label' => __( 'Mega Links', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/list',
			array(
				'name'  => 'mega-links-large',
				'label' => __( 'Mega Links: Large', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/post-template',
			array(
				'name'  => 'card-grid',
				'label' => __( 'Card Grid', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/button',
			array(
				'name'  => 'alternative',
				'label' => __( 'Alternative', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/button',
			array(
				'name'  => 'link',
				'label' => __( 'Link', 'brilliant-insurance' ),
			)
		);

		register_block_style(
			'core/accordion',
			array(
				'name'  => 'numbered',
				'label' => __( 'Numbered', 'brilliant-insurance' ),
			)
		);
	}
endif;
add_action( 'init', 'bnti_block_styles' );
