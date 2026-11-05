/**
 * Image — Figure Frame
 *
 * Adds a "Figure Frame" panel to core/image blocks. When enabled, the image
 * gets the Figma "figure" treatment used across the Brilliant Insurance design: a faint 1px
 * border, a dark overlay, four corner ticks and a "FIG. 02" label in the top
 * left corner. The label number is set per image; border, ticks and overlay
 * can each be switched off (e.g. the "Meet James" portrait shows only the
 * label).
 *
 * The Post Featured Image block has the same panel (e.g. the Our Team
 * headshot cards in a Query Loop). It can also label the image with the
 * post's title ("[HEADSHOT: JAMES T. LAURA, JR.]"), and when the post has no
 * featured image it shows an empty framed box at the block's height.
 *
 * Editor: classes and the label are applied to the block wrapper here.
 * Front end: bnti_render_image_figure_frame() in inc/extensions.php wraps the
 * image in a .bnti-fig-frame element (or frames the featured image figure) and
 * adds the label as real markup.
 */
import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';

import { NativeToggleControl, NativeTextControl } from '../../components';

import './style.scss';

const BLOCKS = ['core/image', 'core/post-featured-image'];
const FEATURED_IMAGE = 'core/post-featured-image';

/**
 * Builds the modifier classes shared by the editor preview and the front end.
 *
 * @param {Object} attributes Block attributes.
 * @return {string[]} Class names.
 */
const getFrameClasses = attributes => {
    const classes = [];
    if (attributes.figFrameBorder !== false) {
        classes.push('has-fig-border');
    }
    if (attributes.figFrameTicks !== false) {
        classes.push('has-fig-ticks');
    }
    if (attributes.figFrameOverlay !== false) {
        classes.push('has-fig-overlay');
    }
    return classes;
};

/**
 * Add the figure frame attributes to core/image.
 */
addFilter('blocks.registerBlockType', 'bnti/image-figure-frame-add-attributes', (settings, name) => {
    if (!BLOCKS.includes(name)) {
        return settings;
    }

    return {
        ...settings,
        attributes: {
            ...settings.attributes,
            figFrame: {
                type: 'boolean',
                default: false
            },
            figLabel: {
                type: 'string',
                default: ''
            },
            figFrameBorder: {
                type: 'boolean',
                default: true
            },
            figFrameTicks: {
                type: 'boolean',
                default: true
            },
            figFrameOverlay: {
                type: 'boolean',
                default: true
            },
            ...(name === FEATURED_IMAGE && {
                figTitleLabel: {
                    type: 'boolean',
                    default: false
                },
                figTitlePrefix: {
                    type: 'string',
                    default: 'Headshot'
                }
            })
        }
    };
});

/**
 * Add the "Figure Frame" panel to the core/image settings sidebar.
 */
addFilter(
    'editor.BlockEdit',
    'bnti/image-figure-frame-add-inspector-controls',
    createHigherOrderComponent(BlockEdit => {
        return props => {
            const { name, attributes, setAttributes } = props;

            if (!BLOCKS.includes(name)) {
                return <BlockEdit {...props} />;
            }

            const { figFrame, figLabel, figFrameBorder, figFrameTicks, figFrameOverlay, figTitleLabel, figTitlePrefix } = attributes;
            const isFeaturedImage = name === FEATURED_IMAGE;

            return (
                <>
                    <BlockEdit {...props} />
                    <InspectorControls>
                        <PanelBody title={__('Figure Frame', 'brilliant-insurance')} initialOpen={!!figFrame}>
                            <NativeToggleControl
                                label={__('Enable figure frame', 'brilliant-insurance')}
                                checked={!!figFrame}
                                onChange={value => setAttributes({ figFrame: value })}
                            />
                            {figFrame && (
                                <>
                                    {isFeaturedImage && (
                                        <>
                                            <NativeToggleControl
                                                label={__('Post title as label', 'brilliant-insurance')}
                                                help={__('e.g. “[HEADSHOT: JAMES T. LAURA, JR.]”. Replaces the FIG label.', 'brilliant-insurance')}
                                                checked={!!figTitleLabel}
                                                onChange={value => setAttributes({ figTitleLabel: value })}
                                            />
                                            {figTitleLabel && (
                                                <NativeTextControl
                                                    label={__('Label prefix', 'brilliant-insurance')}
                                                    value={figTitlePrefix}
                                                    placeholder="Headshot"
                                                    onChange={value => setAttributes({ figTitlePrefix: value })}
                                                />
                                            )}
                                        </>
                                    )}
                                    {!(isFeaturedImage && figTitleLabel) && (
                                        <NativeTextControl
                                            label={__('FIG value', 'brilliant-insurance')}
                                            value={figLabel}
                                            placeholder="02"
                                            help={
                                                figLabel
                                                    ? `${__('Shown as', 'brilliant-insurance')} “FIG. ${figLabel.toUpperCase()}”`
                                                    : __('Leave empty to hide the FIG label.', 'brilliant-insurance')
                                            }
                                            onChange={value => setAttributes({ figLabel: value })}
                                        />
                                    )}
                                    <NativeToggleControl
                                        label={__('Border', 'brilliant-insurance')}
                                        checked={figFrameBorder !== false}
                                        onChange={value => setAttributes({ figFrameBorder: value })}
                                    />
                                    <NativeToggleControl
                                        label={__('Corner ticks', 'brilliant-insurance')}
                                        checked={figFrameTicks !== false}
                                        onChange={value => setAttributes({ figFrameTicks: value })}
                                    />
                                    <NativeToggleControl
                                        label={__('Dark overlay', 'brilliant-insurance')}
                                        checked={figFrameOverlay !== false}
                                        onChange={value => setAttributes({ figFrameOverlay: value })}
                                    />
                                </>
                            )}
                        </PanelBody>
                    </InspectorControls>
                </>
            );
        };
    })
);

/**
 * Apply the frame classes and label in the editor preview.
 */
addFilter(
    'editor.BlockListBlock',
    'bnti/image-figure-frame-add-class',
    createHigherOrderComponent(BlockListBlock => {
        return props => {
            const { name, attributes } = props;

            if (!BLOCKS.includes(name) || !attributes.figFrame) {
                return <BlockListBlock {...props} />;
            }

            const classes = [props.className, 'bnti-fig-frame-editor', ...getFrameClasses(attributes)].filter(Boolean).join(' ');
            const wrapperProps = { ...props.wrapperProps };
            if (name === FEATURED_IMAGE && attributes.figTitleLabel) {
                // The post title isn't known here; the front end shows the real name.
                const prefix = (attributes.figTitlePrefix || '').trim();
                const title = __('Post title', 'brilliant-insurance');
                wrapperProps['data-fig-label'] = `[${prefix ? `${prefix}: ` : ''}${title}]`;
            } else if (attributes.figLabel) {
                wrapperProps['data-fig-label'] = `FIG. ${attributes.figLabel}`;
            }

            return <BlockListBlock {...props} className={classes} wrapperProps={wrapperProps} />;
        };
    })
);
