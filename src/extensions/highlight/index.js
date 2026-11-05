/**
 * Highlight — rich text format
 *
 * Adds a "Highlight" button, in its own group on the block toolbar (not in
 * the rich text "More" menu), to every rich text field (headings, paragraphs,
 * lists, buttons…). The selected text is wrapped in
 * <mark class="bnti-highlight">, which makes it semi-bold (600) and Goblin
 * green, as in the Figma headings ("Key takeaways.", "Meet James."). A
 * different colour can be picked from the theme palette; it is stored as the
 * preset's own `has-{slug}-color` class, so no inline styles are saved.
 */
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { registerFormatType, applyFormat, removeFormat, useAnchor } from '@wordpress/rich-text';
import { BlockControls, useSettings } from '@wordpress/block-editor';
import { Popover, ColorPalette, Button, BaseControl, ToolbarGroup, ToolbarButton } from '@wordpress/components';

import './style.scss';

const FORMAT_NAME = 'bnti/highlight';
const DEFAULT_SLUG = 'bnti-goblin';

const highlightIcon = (
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true">
        <path d="M6 18.5h12V20H6zM9.6 15h-1.7L11.2 4h1.6l3.3 11h-1.7l-.8-2.8h-3.2L9.6 15zm1.2-4.2h2.4L12 6.6l-1.2 4.2z" />
    </svg>
);

/**
 * Reads the preset slug from a stored `has-{slug}-color` class.
 *
 * @param {string} className Stored class attribute.
 * @return {string} Slug, or '' for the default colour.
 */
const getSlugFromClass = className => {
    const match = /(?:^|\s)has-([a-z0-9-]+)-color(?:\s|$)/.exec(className || '');
    return match ? match[1] : '';
};

const settings = {
    title: __('Highlight', 'brilliant-insurance'),
    tagName: 'mark',
    className: 'bnti-highlight',
    attributes: {
        class: 'class'
    },
    edit: HighlightEdit
};

function HighlightEdit({ isActive, activeAttributes, value, onChange, contentRef }) {
    const [isOpen, setIsOpen] = useState(false);
    const [themePalette] = useSettings('color.palette.theme');
    // Solid Brilliant Insurance colours only: no Kadence palette, overlays or transparent.
    const palette = (themePalette || []).filter(color => color.slug.startsWith('bnti-') && /^#[0-9a-f]{6}$/i.test(color.color));
    const anchor = useAnchor({ editableContentElement: contentRef.current, settings });

    const activeSlug = getSlugFromClass(activeAttributes?.class) || DEFAULT_SLUG;
    const activeColor = palette.find(color => color.slug === activeSlug)?.color;

    const applyHighlight = slug => {
        const attributes = slug && slug !== DEFAULT_SLUG ? { class: `has-${slug}-color` } : {};
        onChange(applyFormat(value, { type: FORMAT_NAME, attributes }));
    };

    const onToolbarClick = () => {
        if (!isActive) {
            applyHighlight(DEFAULT_SLUG);
        }
        setIsOpen(true);
    };

    const onColorChange = color => {
        if (!color) {
            applyHighlight(DEFAULT_SLUG);
            return;
        }
        const preset = palette.find(item => item.color.toLowerCase() === color.toLowerCase());
        applyHighlight(preset ? preset.slug : DEFAULT_SLUG);
    };

    return (
        <>
            <BlockControls>
                <ToolbarGroup className="bnti-highlight-toolbar">
                    <ToolbarButton
                        icon={highlightIcon}
                        label={__('Highlight', 'brilliant-insurance')}
                        onClick={onToolbarClick}
                        isPressed={isActive}
                    />
                </ToolbarGroup>
            </BlockControls>
            {isOpen && isActive && (
                <Popover anchor={anchor} placement="bottom" onClose={() => setIsOpen(false)} className="bnti-highlight-popover">
                    <div style={{ padding: '16px', width: '260px' }}>
                        <BaseControl
                            label={__('Highlight colour', 'brilliant-insurance')}
                            help={__('Semi-bold text in the chosen colour. Default: Goblin.', 'brilliant-insurance')}
                            __nextHasNoMarginBottom
                        >
                            <ColorPalette
                                colors={palette}
                                value={activeColor}
                                onChange={onColorChange}
                                disableCustomColors
                                clearable={false}
                            />
                        </BaseControl>
                        <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: '12px' }}>
                            <Button variant="secondary" size="compact" onClick={() => applyHighlight(DEFAULT_SLUG)}>
                                {__('Reset to Goblin', 'brilliant-insurance')}
                            </Button>
                            <Button
                                variant="tertiary"
                                size="compact"
                                isDestructive
                                onClick={() => {
                                    onChange(removeFormat(value, FORMAT_NAME));
                                    setIsOpen(false);
                                }}
                            >
                                {__('Remove', 'brilliant-insurance')}
                            </Button>
                        </div>
                    </div>
                </Popover>
            )}
        </>
    );
}

registerFormatType(FORMAT_NAME, settings);
