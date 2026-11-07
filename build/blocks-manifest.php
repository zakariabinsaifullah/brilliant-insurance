<?php
// This file is generated. Do not modify it manually.
return array(
	'icon' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bnti/icon',
		'version' => '0.0.5',
		'title' => 'Icon',
		'category' => 'bnti',
		'description' => 'Display SVG icons from library or upload custom SVGs.',
		'supports' => array(
			'reusable' => false,
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'color' => array(
				'__experimentalSkipSerialization' => true,
				'gradients' => true,
				'link' => false,
				'__experimentalDefaultControls' => array(
					'background' => true,
					'text' => true
				)
			),
			'__experimentalBorder' => array(
				'__experimentalSkipSerialization' => true,
				'color' => true,
				'radius' => true,
				'style' => true,
				'width' => true
			),
			'spacing' => array(
				'__experimentalSkipSerialization' => true,
				'margin' => true,
				'padding' => true,
				'__experimentalDefaultControls' => array(
					'margin' => false,
					'padding' => false
				)
			),
			'shadow' => array(
				'__experimentalSkipSerialization' => true
			)
		),
		'example' => array(
			
		),
		'attributes' => array(
			'listTitle' => array(
				'type' => 'string'
			),
			'listDesc' => array(
				'type' => 'string'
			),
			'resMode' => array(
				'type' => 'string',
				'default' => 'Desktop'
			),
			'blockStyle' => array(
				'type' => 'object'
			),
			'tagName' => array(
				'type' => 'string',
				'default' => 'div'
			),
			'iconName' => array(
				'type' => 'string',
				'default' => 'wordpress'
			),
			'customSvgCode' => array(
				'type' => 'string'
			),
			'iconType' => array(
				'type' => 'string',
				'default' => 'fill'
			),
			'strokeWidth' => array(
				'type' => 'number',
				'default' => 1.2
			),
			'sizes' => array(
				'type' => 'object',
				'default' => array(
					'Desktop' => 20
				)
			),
			'iconSize' => array(
				'type' => 'number',
				'default' => 20
			),
			'textColor' => array(
				'type' => 'string',
				'default' => 'bnti-white'
			),
			'backgroundColor' => array(
				'type' => 'string',
				'default' => 'bnti-premier'
			),
			'width' => array(
				'type' => 'number'
			),
			'justifyContent' => array(
				'type' => 'string'
			),
			'href' => array(
				'type' => 'string'
			),
			'linkTarget' => array(
				'type' => 'string'
			),
			'linkRel' => array(
				'type' => 'string'
			),
			'showTitle' => array(
				'type' => 'boolean',
				'default' => false
			),
			'heading' => array(
				'type' => 'string'
			),
			'headingTag' => array(
				'type' => 'string',
				'default' => 'p'
			),
			'listGap' => array(
				'type' => 'string'
			),
			'titleColor' => array(
				'type' => 'string'
			),
			'titleSize' => array(
				'type' => 'string'
			),
			'titleFontFamily' => array(
				'type' => 'string'
			),
			'iconVerticalAlign' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'iconPosition' => array(
				'type' => 'string',
				'default' => 'before'
			),
			'keepAspectRatio' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'brilliant-insurance',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css'
	),
	'social-share' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bnti/social-share',
		'version' => '0.0.5',
		'title' => 'Social Share',
		'category' => 'bnti',
		'icon' => 'share',
		'description' => 'Add social sharing buttons for the current post.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'spacing' => array(
				'__experimentalSkipSerialization' => true,
				'margin' => true,
				'padding' => true,
				'__experimentalDefaultControls' => array(
					'margin' => false,
					'padding' => false
				)
			)
		),
		'attributes' => array(
			'showCopyLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showLinkedIn' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showTwitter' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showFacebook' => array(
				'type' => 'boolean',
				'default' => true
			),
			'iconSize' => array(
				'type' => 'string',
				'default' => '24px'
			),
			'gap' => array(
				'type' => 'string',
				'default' => '12px'
			),
			'iconColor' => array(
				'type' => 'string'
			),
			'iconBgColor' => array(
				'type' => 'string'
			),
			'iconRadius' => array(
				'type' => 'string'
			),
			'iconPadding' => array(
				'type' => 'string'
			),
			'blockStyle' => array(
				'type' => 'object'
			),
			'justifyContent' => array(
				'type' => 'string'
			)
		),
		'textdomain' => 'brilliant-insurance',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php'
	),
	'group-full-height' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bnti/group-full-height-extension',
		'version' => '0.0.5',
		'title' => 'Group Force Full Height Extension',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css'
	),
	'iconic-button' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bnti/iconic-button-extension',
		'title' => 'Iconic Button Extension',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css'
	),
	'text-max-width' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bnti/text-max-width-extension',
		'version' => '0.0.5',
		'title' => 'Text Max Width Extension',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css'
	)
);
