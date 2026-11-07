<?php
/**
 * Title: Template Hero: 404
 * Slug: bnti/hero-404
 * Categories: bnti
 * Inserter: no
 * Description: The 404 hero: message, search form and buttons.
 *
 * The inner-page hero (CLAUDE.md "Page hero": 192/120 padding, 217/56 on
 * tablet and mobile, 372px min height, bottom-aligned, bnti-hero-overlay) on
 * the theme's default photo, for templates that have no page to hold a hero.
 *
 * @package Brilliant_Insurance
 */

$bnti_hero_img = get_theme_file_uri( 'assets/images/hero-default.webp' );
?>
<!-- wp:kadence/rowlayout {"uniqueID":"tpl_404_hero","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","minHeight":372,"bgImg":"<?php echo esc_url( $bnti_hero_img ); ?>","bgImgSize":"cover","bgImgPosition":"center center","overlayOpacity":100,"align":"full","verticalAlignment":"bottom","tabletPadding":[217,"",56,""],"inheritMaxWidth":true,"overlayGradient":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dgradient\u002d\u002dbnti-hero-overlay)","padding":[192,15,120,15],"mobilePadding":[217,"",56,""],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"tpl_404_hero_col","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-columntpl_404_hero_col"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-has-arrow","textColor":"bnti-white-80","fontSize":"bnti-small"} -->
<p class="is-style-has-arrow has-bnti-white-80-color has-text-color has-bnti-small-font-size"><?php esc_html_e( 'Error 404', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"textColor":"bnti-white","maxWidth":1000} -->
<h1 class="wp-block-heading has-bnti-white-color has-text-color"><?php esc_html_e( 'We can’t find that page.', 'brilliant-insurance' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"bnti-white-80","fontSize":"bnti-lead","maxWidth":1000} -->
<p class="has-bnti-white-80-color has-text-color has-bnti-lead-font-size"><?php esc_html_e( 'The link may be out of date, or the page may have moved. Search the site, go back to the homepage or ask us for a quote.', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search articles and pages","buttonText":"Search","buttonPosition":"button-outside","buttonUseIcon":false,"className":"bnti-search","style":{"layout":{"selfStretch":"fixed","flexSize":"640px"}}} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the homepage', 'brilliant-insurance' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#bnti-contact"><?php esc_html_e( 'Get a quote', 'brilliant-insurance' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
