import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import classnames from 'classnames';

import { softMinifyCssStrings, svgToBase64DataUrl } from '../../helpers';
import { allowedBlocks } from './allowed-blocks';

/**
 * Button Icon HOC - Updated to preserve existing classes
 */
const bntiIconicButtonEditor = createHigherOrderComponent( BlockListBlock => {
    return props => {
        if ( ! allowedBlocks.includes( props.name ) ) {
            return <BlockListBlock { ...props } />;
        }

        const { attributes, clientId, className: existingClassName } = props;
        const {
            iconicButtonEnabled,
            iconicButtonIconName,
            iconicButtonCustomSvg,
            iconicButtonIcon,
            iconicButtonIconPosition,
            iconicButtonIconSize,
            iconicButtonIconGap
        } = attributes;

        if ( ! iconicButtonEnabled ) {
            return <BlockListBlock { ...props } />;
        }

        // Use custom SVG if available, or fallback to old attribute
        const iconSVG = iconicButtonCustomSvg || iconicButtonIcon;

        if ( ! iconSVG && ! iconicButtonIconName ) {
            return <BlockListBlock { ...props } />;
        }

        // unique class
        const uniqueClass = `bnti-icon-button-${ clientId.slice( 0, 8 ) }`;

        const btnIconClass = classnames( 'bnti-icon-button', uniqueClass, iconicButtonIconPosition );

        // Combine existing className with animation class
        const combinedClassName = existingClassName ? `${ existingClassName } ${ btnIconClass }` : btnIconClass;

        // If we have an SVG code, we use the mask approach
        let maskStyle = '';
        if ( iconSVG ) {
            if ( iconicButtonIconGap ) {
                maskStyle += `
                .bnti-icon-button.${ uniqueClass } .wp-block-button__link{
                    --bnti-icon-gap: ${ iconicButtonIconGap }!important;
                }`;
            }
            if ( iconicButtonIconSize ) {
                maskStyle += `
                .bnti-icon-button.${ uniqueClass } .wp-block-button__link::after{
                    --bnti-icon-size: ${ iconicButtonIconSize }!important;
                }`;
            }
            maskStyle += `
            .bnti-icon-button.${ uniqueClass } .wp-block-button__link::after{
                --bnti-icon-url: url("${ svgToBase64DataUrl( iconSVG ) }");
                display: inline-block;
            }`;
        }

        // Icon background + padding are intentionally not previewed here: the editor's
        // ::after is a CSS mask (its background-color paints the icon glyph itself), so
        // a background chip would need a second unmasked layer that never looks right
        // alongside the mask. Frontend rendering (style.scss + bnti_render_iconic_button)
        // uses a real <span> wrapping the SVG, where background/padding work correctly.

        return (
            <>
                { maskStyle && <style>{ softMinifyCssStrings( maskStyle ) }</style> }
                <BlockListBlock { ...props } className={ combinedClassName } />
            </>
        );
    };
}, 'bntiIconicButtonEditor' );

addFilter( 'editor.BlockListBlock', 'bnti/iconic-button-editor', bntiIconicButtonEditor );
