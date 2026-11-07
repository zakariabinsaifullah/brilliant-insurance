<?php
/**
 * Title: Template Hero: Search
 * Slug: bnti/hero-search
 * Categories: bnti
 * Inserter: no
 * Description: The search hero: results title and search form.
 *
 * The inner-page hero (CLAUDE.md "Page hero": 192/120 padding, 217/56 on
 * tablet and mobile, 372px min height, bottom-aligned, bnti-hero-overlay) on
 * the theme's default photo, for templates that have no page to hold a hero.
 *
 * @package Brilliant_Insurance
 */

$bnti_hero_img = get_theme_file_uri( 'assets/images/hero-default.webp' );
?>
<!-- wp:kadence/rowlayout {"uniqueID":"tpl_search_hero","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","minHeight":372,"bgImg":"<?php echo esc_url( $bnti_hero_img ); ?>","bgImgSize":"cover","bgImgPosition":"center center","overlayOpacity":100,"align":"full","verticalAlignment":"bottom","tabletPadding":[217,"",56,""],"inheritMaxWidth":true,"overlayGradient":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dgradient\u002d\u002dbnti-hero-overlay)","padding":[192,15,120,15],"mobilePadding":[217,"",56,""],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"tpl_search_hero_col","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-columntpl_search_hero_col"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-has-arrow","textColor":"bnti-white-80","fontSize":"bnti-small"} -->
<p class="is-style-has-arrow has-bnti-white-80-color has-text-color has-bnti-small-font-size"><?php esc_html_e( 'Search', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:query-title {"type":"search","level":1,"textColor":"bnti-white"} /-->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search articles and pages","buttonText":"Search","buttonPosition":"button-outside","buttonUseIcon":false,"className":"bnti-search","style":{"layout":{"selfStretch":"fixed","flexSize":"640px"}}} /-->
</div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
