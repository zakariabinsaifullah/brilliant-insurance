<?php
/**
 * Title: Template Hero: Archive
 * Slug: bnti/hero-archive
 * Categories: bnti
 * Inserter: no
 * Description: The archive hero: term title and description.
 *
 * The inner-page hero (CLAUDE.md "Page hero": 192/120 padding, 217/56 on
 * tablet and mobile, 372px min height, bottom-aligned, bnti-hero-overlay) on
 * the theme's default photo, for templates that have no page to hold a hero.
 *
 * @package Brilliant_Insurance
 */

$bnti_hero_img = get_theme_file_uri( 'assets/images/hero-default.webp' );
?>
<!-- wp:kadence/rowlayout {"uniqueID":"tpl_archive_hero","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","minHeight":372,"bgImg":"<?php echo esc_url( $bnti_hero_img ); ?>","bgImgSize":"cover","bgImgPosition":"center center","overlayOpacity":100,"align":"full","verticalAlignment":"bottom","tabletPadding":[217,"",56,""],"inheritMaxWidth":true,"overlayGradient":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dgradient\u002d\u002dbnti-hero-overlay)","padding":[192,15,120,15],"mobilePadding":[217,"",56,""],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"tpl_archive_hero_col","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-columntpl_archive_hero_col"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-has-arrow","textColor":"bnti-white-80","fontSize":"bnti-small"} -->
<p class="is-style-has-arrow has-bnti-white-80-color has-text-color has-bnti-small-font-size"><?php esc_html_e( 'Articles', 'brilliant-insurance' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:query-title {"type":"archive","level":1,"showPrefix":false,"textColor":"bnti-white"} /-->

<!-- wp:term-description {"textColor":"bnti-white-80","fontSize":"bnti-lead"} /-->
</div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
