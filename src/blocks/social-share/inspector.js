/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, __experimentalToolsPanel as ToolsPanel, __experimentalToolsPanelItem as ToolsPanelItem } from '@wordpress/components';
import { useEffect } from '@wordpress/element';

/**
 * Internal dependencies
 */
import { NativeToggleControl, NativeUnitControl, PanelColorControl } from '../../components';

export default function Inspector(props) {
    const { attributes, setAttributes } = props;
    const { showCopyLink, showLinkedIn, showTwitter, showFacebook, iconSize, gap, iconColor, iconBgColor, iconRadius, iconPadding } =
        attributes;

    useEffect(() => {
        setAttributes({
            blockStyle: {
                ...(iconSize && { '--icon-size': iconSize }),
                ...(gap && { '--gap': gap }),
                ...(iconColor && { '--icon-color': iconColor }),
                ...(iconBgColor && { '--icon-bg': iconBgColor }),
                ...(iconRadius && { '--icon-radius': iconRadius }),
                ...(iconPadding && { '--icon-padding': iconPadding })
            }
        });
    }, [iconSize, gap, iconColor, iconBgColor, iconRadius, iconPadding]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Platforms', 'brilliant-insurance')}>
                    <NativeToggleControl
                        label={__('Copy Link', 'brilliant-insurance')}
                        checked={showCopyLink}
                        onChange={value => setAttributes({ showCopyLink: value })}
                    />
                    <NativeToggleControl
                        label={__('LinkedIn', 'brilliant-insurance')}
                        checked={showLinkedIn}
                        onChange={value => setAttributes({ showLinkedIn: value })}
                    />
                    <NativeToggleControl
                        label={__('X (Twitter)', 'brilliant-insurance')}
                        checked={showTwitter}
                        onChange={value => setAttributes({ showTwitter: value })}
                    />
                    <NativeToggleControl
                        label={__('Facebook', 'brilliant-insurance')}
                        checked={showFacebook}
                        onChange={value => setAttributes({ showFacebook: value })}
                    />
                </PanelBody>
                <PanelBody title={__('Layout', 'brilliant-insurance')} initialOpen={false}>
                    <NativeUnitControl
                        label={__('Icon Size', 'brilliant-insurance')}
                        value={iconSize}
                        onChange={value => setAttributes({ iconSize: value })}
                        mb={16}
                    />
                    <NativeUnitControl label={__('Gap', 'brilliant-insurance')} value={gap} onChange={value => setAttributes({ gap: value })} />
                </PanelBody>
            </InspectorControls>
            <InspectorControls group="styles">
                <ToolsPanel
                    label={__('Icon Style', 'brilliant-insurance')}
                    resetAll={() =>
                        setAttributes({
                            iconColor: undefined,
                            iconBgColor: undefined,
                            iconRadius: undefined,
                            iconPadding: undefined
                        })
                    }
                >
                    <ToolsPanelItem
                        hasValue={() => !!iconBgColor || !!iconColor}
                        label={__('Colors', 'brilliant-insurance')}
                        onDeselect={() => setAttributes({ iconBgColor: undefined })}
                        onSelect={() => {}}
                    >
                        <PanelColorControl
                            label={__('Colors', 'brilliant-insurance')}
                            colorSettings={[
                                {
                                    value: iconColor,
                                    onChange: color => setAttributes({ iconColor: color }),
                                    label: __('Color', 'brilliant-insurance')
                                },
                                {
                                    value: iconBgColor,
                                    onChange: color => setAttributes({ iconBgColor: color }),
                                    label: __('Background', 'brilliant-insurance')
                                }
                            ]}
                        />
                    </ToolsPanelItem>

                    <ToolsPanelItem
                        hasValue={() => !!iconRadius}
                        label={__('Radius', 'brilliant-insurance')}
                        onDeselect={() => setAttributes({ iconRadius: undefined })}
                        onSelect={() => {}}
                    >
                        <NativeUnitControl
                            label={__('Radius', 'brilliant-insurance')}
                            value={iconRadius}
                            onChange={value => setAttributes({ iconRadius: value })}
                        />
                    </ToolsPanelItem>

                    <ToolsPanelItem
                        hasValue={() => !!iconPadding}
                        label={__('Padding', 'brilliant-insurance')}
                        onDeselect={() => setAttributes({ iconPadding: undefined })}
                        onSelect={() => {}}
                    >
                        <NativeUnitControl
                            label={__('Padding', 'brilliant-insurance')}
                            value={iconPadding}
                            onChange={value => setAttributes({ iconPadding: value })}
                        />
                    </ToolsPanelItem>
                </ToolsPanel>
            </InspectorControls>
        </>
    );
}
