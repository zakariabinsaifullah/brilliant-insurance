/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * Inline custom properties for the timeline wrapper. Defaults are left out so
 * the stylesheet's values (Brilliant Insurance presets, 40px gaps) apply.
 *
 * Colours are stored as preset variables (var(--wp--preset--color--…)) when
 * picked from the palette.
 *
 * @param {Object} attributes Block attributes.
 * @return {Object} Style object.
 */
export const getTimelineStyle = ({ columns, color, activeColor, highlightLine, activeLineColor, gap, contentGap }) => {
    const style = {};

    if (columns && columns !== 4) {
        style['--bnti-timeline-columns'] = columns;
    }
    if (color) {
        style['--bnti-timeline-color'] = color;
    }
    if (activeColor) {
        style['--bnti-timeline-active'] = activeColor;
    }
    // The highlighted step's line becomes a 3px progress bar.
    if (highlightLine) {
        style['--bnti-timeline-active-line'] = activeLineColor || 'var(--bnti-timeline-active)';
        style['--bnti-timeline-active-line-height'] = '3px';
    }
    if (typeof gap === 'number' && gap !== 40) {
        style['--bnti-timeline-gap'] = `${gap}px`;
    }
    if (typeof contentGap === 'number' && contentGap !== 40) {
        style['--bnti-timeline-content-gap'] = `${contentGap}px`;
    }

    return style;
};

/**
 * Wrapper class for the "Highlight on hover" option.
 *
 * @param {Object} attributes Block attributes.
 * @return {string|undefined} Class name.
 */
export const getTimelineClass = ({ highlightOnHover }) => (highlightOnHover ? 'has-hover-highlight' : undefined);

export default function save({ attributes }) {
    const blockProps = useBlockProps.save({ className: getTimelineClass(attributes), style: getTimelineStyle(attributes) });
    const innerBlocksProps = useInnerBlocksProps.save(blockProps);

    return <div {...innerBlocksProps} />;
}
