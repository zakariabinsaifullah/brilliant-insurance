<?php
/**
 * Title: Template Hero: Blog
 * Slug: bnti/hero-blog
 * Categories: bnti
 * Inserter: no
 * Description: The blog home hero.
 *
 * The inner-page hero (CLAUDE.md "Page hero": 192/120 padding, 217/56 on
 * tablet and mobile, 372px min height, bottom-aligned, bnti-hero-overlay) on
 * the theme's default photo, for templates that have no page to hold a hero.
 *
 * @package Brilliant_Insurance
 */

$bnti_hero_img = get_theme_file_uri( 'assets/images/hero-default.webp' );
?>
<!-- wp:kadence/rowlayout {"uniqueID":"tpl_blog_hero","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","minHeight":372,"bgImg":"<?php echo esc_url( $bnti_hero_img ); ?>","bgImgSize":"cover","bgImgPosition":"center center","overlayOpacity":100,"align":"full","verticalAlignment":"bottom","tabletPadding":[217,"",56,""],"inheritMaxWidth":true,"overlayGradient":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dgradient\u002d\u002dbnti-hero-overlay)","padding":[192,15,120,15],"mobilePadding":[217,"",56,""],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"tpl_blog_hero_col","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-columntpl_blog_hero_col"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-has-arrow","textColor":"bnti-white-80","fontSize":"bnti-small"} -->
<p class="is-style-has-arrow has-bnti-white-80-color has-text-color has-bnti-small-font-size"><?php esc_html_e( 'Insights', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"textColor":"bnti-white","maxWidth":1000} -->
<h1 class="wp-block-heading has-bnti-white-color has-text-color"><?php esc_html_e( 'Insurance insights for Glendale businesses and homeowners.', 'brilliant-insurance' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"bnti-white-80","fontSize":"bnti-lead","maxWidth":1000} -->
<p class="has-bnti-white-80-color has-text-color has-bnti-lead-font-size"><?php esc_html_e( 'Plain-language answers about coverage, contracts and claims, from the team at Brilliant Premier Insurance.', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
