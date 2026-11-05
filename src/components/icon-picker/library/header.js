/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Flex, FlexBlock, Button } from '@wordpress/components';

/**
 * Header Component
 * Displays tab navigation for the icon library modal
 */
export const Header = ({ activeTab, onTabChange }) => {
    // Define tabs
    const tabs = [
        { label: __('Library', 'brilliant-insurance'), value: 'library' },
        { label: __('My Icons', 'brilliant-insurance'), value: 'my-icons' },
        { label: __('Custom SVG', 'brilliant-insurance'), value: 'custom' }
    ];

    return (
        <Flex gap={2}>
            <FlexBlock>
                <div className="bnti-modal__tabs">
                    {tabs.map(tab => (
                        <Button
                            key={tab.value}
                            className={`bnti-modal__tabs-button ${activeTab === tab.value ? 'is-selected' : ''}`}
                            onClick={() => onTabChange(tab.value)}
                            disabled={tab.disabled}
                            __nextHasNoMarginBottom
                            __next40pxDefaultSize
                        >
                            {tab.label}
                        </Button>
                    ))}
                </div>
            </FlexBlock>
        </Flex>
    );
};
