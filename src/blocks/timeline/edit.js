/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';
import { useDispatch, useSelect } from '@wordpress/data';
import { createBlock } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, useInnerBlocksProps, useSettings, store as blockEditorStore } from '@wordpress/block-editor';
import { PanelBody, RangeControl, ToggleControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { PanelColorControl } from '../../components';
import { getTimelineStyle, getTimelineClass } from './save';

import './editor.scss';

const createStep = () => createBlock('bnti/timeline-step', {}, [createBlock('core/paragraph')]);

const PRESET = /^var\(--wp--preset--color--([a-z0-9-]+)\)$/;

/**
 * Colour helpers: palette colours are stored as preset variables, so a palette
 * change updates the timeline; the picker still needs the hex to mark the
 * swatch as selected.
 *
 * @param {Array} palette Theme palette.
 */
const colorHelpers = palette => ({
    toStored: value => {
        if (!value) {
            return '';
        }
        const preset = palette.find(item => item.color.toLowerCase() === value.toLowerCase());
        return preset ? `var(--wp--preset--color--${preset.slug})` : value;
    },
    toPicker: value => {
        const match = PRESET.exec(value || '');
        return match ? palette.find(item => item.slug === match[1])?.color : value;
    }
});

export default function Edit({ attributes, setAttributes, clientId }) {
    const { steps, columns, color, activeColor, highlightLine, highlightOnHover, activeLineColor, gap, contentGap } = attributes;
    const [themePalette] = useSettings('color.palette.theme');
    const { toStored, toPicker } = colorHelpers(themePalette || []);

    const stepCount = useSelect(select => select(blockEditorStore).getBlockCount(clientId), [clientId]);
    const { getBlocks } = useSelect(blockEditorStore);
    const { replaceInnerBlocks } = useDispatch(blockEditorStore);

    // Keep the Steps setting in line with steps added, duplicated or removed by hand.
    useEffect(() => {
        if (stepCount && stepCount !== steps) {
            setAttributes({ steps: stepCount });
        }
    }, [stepCount]); // eslint-disable-line react-hooks/exhaustive-deps

    const updateSteps = count => {
        const next = getBlocks(clientId).slice(0, count);
        while (next.length < count) {
            next.push(createStep());
        }
        replaceInnerBlocks(clientId, next, false);
        setAttributes({ steps: count });
    };

    const blockProps = useBlockProps({ className: getTimelineClass(attributes), style: getTimelineStyle(attributes) });
    const innerBlocksProps = useInnerBlocksProps(blockProps, {
        allowedBlocks: ['bnti/timeline-step'],
        // The first step starts highlighted, as in the design.
        template: Array.from({ length: steps }, (_, index) => ['bnti/timeline-step', { isActive: index === 0 }, [['core/paragraph']]]),
        orientation: 'horizontal',
        renderAppender: false
    });

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Timeline', 'brilliant-insurance')}>
                    <RangeControl
                        __nextHasNoMarginBottom
                        __next40pxDefaultSize
                        label={__('Steps', 'brilliant-insurance')}
                        value={steps}
                        onChange={value => value && updateSteps(value)}
                        min={1}
                        max={12}
                    />
                    <RangeControl
                        __nextHasNoMarginBottom
                        __next40pxDefaultSize
                        label={__('Columns (desktop)', 'brilliant-insurance')}
                        help={__('Tablet and mobile always show one column.', 'brilliant-insurance')}
                        value={columns}
                        onChange={value => setAttributes({ columns: value || 4 })}
                        min={1}
                        max={6}
                    />
                    <RangeControl
                        __nextHasNoMarginBottom
                        __next40pxDefaultSize
                        label={__('Step gap (px)', 'brilliant-insurance')}
                        help={__('Space between steps; the line runs across it.', 'brilliant-insurance')}
                        value={gap}
                        onChange={value => setAttributes({ gap: value ?? 40 })}
                        min={0}
                        max={120}
                    />
                    <RangeControl
                        __nextHasNoMarginBottom
                        __next40pxDefaultSize
                        label={__('Content gap (px)', 'brilliant-insurance')}
                        help={__('Space between the line and the blocks below it.', 'brilliant-insurance')}
                        value={contentGap}
                        onChange={value => setAttributes({ contentGap: value ?? 40 })}
                        min={0}
                        max={120}
                    />
                    <ToggleControl
                        __nextHasNoMarginBottom
                        label={__('Highlight line', 'brilliant-insurance')}
                        help={__('Also draw the highlighted step’s line, as a 3px progress bar. Off: only its dot is coloured.', 'brilliant-insurance')}
                        checked={!!highlightLine}
                        onChange={value => setAttributes({ highlightLine: value })}
                    />
                    <ToggleControl
                        __nextHasNoMarginBottom
                        label={__('Highlight on hover', 'brilliant-insurance')}
                        help={__('Desktop: hovering a step highlights it (dot, and line if Highlight line is on) instead of the highlighted step.', 'brilliant-insurance')}
                        checked={!!highlightOnHover}
                        onChange={value => setAttributes({ highlightOnHover: value })}
                    />
                </PanelBody>
                <PanelColorControl
                    label={__('Timeline Colors', 'brilliant-insurance')}
                    colorSettings={[
                        {
                            label: __('Dot & Line', 'brilliant-insurance'),
                            value: toPicker(color),
                            onChange: value => setAttributes({ color: toStored(value) })
                        },
                        {
                            label: __('Highlighted Dot', 'brilliant-insurance'),
                            value: toPicker(activeColor),
                            onChange: value => setAttributes({ activeColor: toStored(value) })
                        },
                        ...(highlightLine
                            ? [
                                  {
                                      label: __('Highlighted Line', 'brilliant-insurance'),
                                      value: toPicker(activeLineColor),
                                      onChange: value => setAttributes({ activeLineColor: toStored(value) })
                                  }
                              ]
                            : [])
                    ]}
                />
            </InspectorControls>
            <div {...innerBlocksProps} />
        </>
    );
}
