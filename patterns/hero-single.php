<?php
/**
 * Title: Template Hero: Single Post
 * Slug: bnti/hero-single
 * Categories: bnti
 * Inserter: no
 * Description: The post hero: categories, title and date.
 *
 * The inner-page hero (CLAUDE.md "Page hero": 192/120 padding, 217/56 on
 * tablet and mobile, 372px min height, bottom-aligned) on the bnti-midnight
 * gradient instead of a photo: a post's own featured image sits right under
 * it, so a second photo in the hero would compete with it.
 *
 * @package Brilliant_Insurance
 */

?>
<!-- wp:kadence/rowlayout {"uniqueID":"tpl_single_hero","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","minHeight":372,"overlayOpacity":100,"align":"full","verticalAlignment":"bottom","tabletPadding":[217,"",56,""],"inheritMaxWidth":true,"overlayGradient":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dgradient\u002d\u002dbnti-midnight)","padding":[192,15,120,15],"mobilePadding":[217,"",56,""],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"tpl_single_hero_col","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-columntpl_single_hero_col"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","separator":" · ","className":"bnti-hero-terms","style":{"typography":{"fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|bnti-white-80"}}}},"textColor":"bnti-white-80","fontSize":"bnti-small"} /-->

<!-- wp:post-title {"level":1,"textColor":"bnti-white"} /-->

<!-- wp:post-date {"textColor":"bnti-white-80","fontSize":"bnti-regular"} /-->
</div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
