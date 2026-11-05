import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    __experimentalToolsPanel as ToolsPanel, // eslint-disable-line
    __experimentalToolsPanelItem as ToolsPanelItem // eslint-disable-line
} from '@wordpress/components';
import { arrowLeft, arrowRight, arrowUp, arrowDown } from '@wordpress/icons';

import { NativeToggleGroupControl, NativeRangeControl, NativeToggleControl, NativeTextControl, PanelColorControl } from '../../components';

const Inspector = props => {
    const { attributes, setAttributes } = props;
    const { enableRating, ratingText, totalRating, nrPos, ratingSize, ratingNsize, ratingColor, nuRatColor, alignment } = attributes;

    return (
        <>
            <InspectorControls group="settings">
                <PanelBody title={ __( 'Settings', 'brilliant-insurance' ) } initialOpen={ true }>
                    <NativeToggleControl
                        label={ __( 'Show Numeric Rating', 'brilliant-insurance' ) }
                        checked={ enableRating }
                        onChange={ value => setAttributes( { enableRating: value } ) }
                    />
                    { enableRating && (
                        <NativeToggleGroupControl
                            label={ __( 'Position', 'brilliant-insurance' ) }
                            value={ nrPos }
                            onChange={ value => setAttributes( { nrPos: value } ) }
                            options={ [
                                { value: 'nr_left', label: __( 'Left', 'brilliant-insurance' ), icon: arrowLeft },
                                { value: 'nr_right', label: __( 'Right', 'brilliant-insurance' ), icon: arrowRight },
                                { value: 'nr_top', label: __( 'Top', 'brilliant-insurance' ), icon: arrowUp },
                                { value: 'nr_bottom', label: __( 'Bottom', 'brilliant-insurance' ), icon: arrowDown }
                            ] }
                        />
                    ) }
                    <NativeToggleGroupControl
                        label={ __( 'Alignment', 'brilliant-insurance' ) }
                        value={ alignment }
                        onChange={ value => setAttributes( { alignment: value } ) }
                        options={ [
                            { value: '', label: __( 'Left', 'brilliant-insurance' ) },
                            { value: 'center', label: __( 'Center', 'brilliant-insurance' ) },
                            { value: 'right', label: __( 'Right', 'brilliant-insurance' ) }
                        ] }
                    />
                </PanelBody>
                <PanelBody title={ __( 'Rating', 'brilliant-insurance' ) } initialOpen={ false }>
                    <NativeRangeControl
                        label={ __( 'Total Rating', 'brilliant-insurance' ) }
                        value={ totalRating }
                        onChange={ value => setAttributes( { totalRating: value } ) }
                        min={ 1 }
                        max={ 10 }
                        step={ 1 }
                        resetFallbackValue={ 5 }
                    />
                    <NativeTextControl
                        label={ __( 'Rating', 'brilliant-insurance' ) }
                        value={ ratingText }
                        placeholder="4.5"
                        help={ __( 'Shown as the number rating; the stars fill to the number in it.', 'brilliant-insurance' ) }
                        onChange={ value => setAttributes( { ratingText: value } ) }
                    />
                </PanelBody>
            </InspectorControls>
            <InspectorControls group="styles">
                <ToolsPanel
                    label={ __( 'Rating', 'brilliant-insurance' ) }
                    resetAll={ () =>
                        setAttributes( {
                            ratingSize: undefined,
                            ratingColor: undefined
                        } )
                    }
                >
                    <ToolsPanelItem
                        hasValue={ () => !! ratingSize }
                        label={ __( 'Size', 'brilliant-insurance' ) }
                        onDeselect={ () => {
                            setAttributes( {
                                ratingSize: undefined
                            } );
                        } }
                        onSelect={ () => {} }
                    >
                        <NativeRangeControl
                            label={ __( 'Rating Size', 'brilliant-insurance' ) }
                            value={ ratingSize }
                            onChange={ value => setAttributes( { ratingSize: value } ) }
                            min={ 0 }
                            max={ 100 }
                            step={ 1 }
                        />
                    </ToolsPanelItem>

                    <ToolsPanelItem
                        hasValue={ () => !! ratingColor }
                        label={ __( 'Color', 'brilliant-insurance' ) }
                        onDeselect={ () => {
                            setAttributes( {
                                ratingColor: undefined
                            } );
                        } }
                        onSelect={ () => {} }
                    >
                        <PanelColorControl
                            label={ __( 'Star Color', 'brilliant-insurance' ) }
                            colorSettings={ [
                                {
                                    value: ratingColor,
                                    onChange: color => setAttributes( { ratingColor: color } )
                                }
                            ] }
                        />
                    </ToolsPanelItem>
                </ToolsPanel>
                { enableRating && (
                    <ToolsPanel
                        label={ __( 'Numeric Rating', 'brilliant-insurance' ) }
                        resetAll={ () =>
                            setAttributes( {
                                ratingNsize: undefined,
                                nuRatColor: undefined
                            } )
                        }
                    >
                        <ToolsPanelItem
                            hasValue={ () => !! ratingNsize }
                            label={ __( 'Size', 'brilliant-insurance' ) }
                            onDeselect={ () => {
                                setAttributes( {
                                    ratingNsize: undefined
                                } );
                            } }
                            onSelect={ () => {} }
                        >
                            <NativeRangeControl
                                label={ __( 'Font Size', 'brilliant-insurance' ) }
                                value={ ratingNsize }
                                onChange={ value => setAttributes( { ratingNsize: value } ) }
                                min={ 0 }
                                max={ 100 }
                                step={ 1 }
                            />
                        </ToolsPanelItem>

                        <ToolsPanelItem
                            hasValue={ () => !! nuRatColor }
                            label={ __( 'Color', 'brilliant-insurance' ) }
                            onDeselect={ () => {
                                setAttributes( {
                                    nuRatColor: undefined
                                } );
                            } }
                            onSelect={ () => {} }
                        >
                            <PanelColorControl
                                label={ __( 'Text Color', 'brilliant-insurance' ) }
                                colorSettings={ [
                                    {
                                        value: nuRatColor,
                                        onChange: color => setAttributes( { nuRatColor: color } ),
                                        label: __( 'Color', 'brilliant-insurance' )
                                    }
                                ] }
                            />
                        </ToolsPanelItem>
                    </ToolsPanel>
                ) }
            </InspectorControls>
        </>
    );
};

export default Inspector;
