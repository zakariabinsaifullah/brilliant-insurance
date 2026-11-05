<?php
/**
 * Title: Team Member Page
 * Slug: bnti/team-member
 * Categories: bnti
 * Description: Starter layout for a Team member's bio page: hero with headshot, fact list, introduction, background, beyond the office, recognition, credentials and closing call to action.
 * Post Types: bnti_team
 * Block Types: core/post-content
 * Keywords: team, attorney, bio, lawyer
 * Viewport Width: 1440
 *
 * The hero name, intro line and fact list come from the Team details fields
 * ("Team member" block bindings), and the hero image is the post's featured
 * image (headshot), so those fill in automatically. Replace the bracketed
 * text and the stand-in images with the member's own content.
 *
 * @package Brilliant_Insurance
 */

?>
<!-- wp:kadence/rowlayout {"uniqueID":"318_000004-1c","columns":1,"colLayout":"equal","align":"full","tabletPadding":[150,"",35,""],"inheritMaxWidth":true,"padding":[200,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000005-23","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000005-23"><div class="kt-inside-inner-col"><!-- wp:kadence/rowlayout {"uniqueID":"318_000001-07","tabletLayout":"row","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"left-golden","verticalAlignment":"middle","firstColumnWidth":60,"secondColumnWidth":40,"padding":[0,0,0,0],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000002-0e","rowGap":[24,"",""],"rowGapVariable":["custom","",""],"kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000002-0e"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-x-small"} -->
<p class="has-bnti-x-small-font-size" style="font-weight:600;text-transform:uppercase">FIG. 00</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":1,"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"name"}}}},"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">First M. <mark class="bnti-highlight">Last</mark></h1>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:separator {"opacity":"css","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"/>
<!-- /wp:separator --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"tagline"}}}},"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"typography":{"fontWeight":"600"}},"fontSize":"bnti-large"} -->
<p class="has-bnti-large-font-size" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-weight:600">Attorney, Brilliant Insurance. City, State.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="tel:+18886452222">Call 888-645-2222</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000003-15","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000003-15"><div class="kt-inside-inner-col"><!-- wp:post-featured-image {"aspectRatio":"4/5","width":"100%","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"figFrame":true,"figLabel":"01","figFrameOverlay":false} /--></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_000006-2a","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",35,""],"inheritMaxWidth":true,"padding":[50,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000007-31","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000007-31"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"24px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:24px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">01 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"width":"1px","color":"var:preset|color|bnti-white","style":"solid"},"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-border-color" style="border-color:var(--wp--preset--color--bnti-white);border-style:solid;border-width:1px;margin-top:0;margin-bottom:0"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"8px"},"padding":{"top":"22px","right":"28px","bottom":"22px","left":"28px"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns" style="margin-top:0;margin-bottom:0;padding-top:22px;padding-right:28px;padding-bottom:22px;padding-left:28px"><!-- wp:column {"width":"280px"} -->
<div class="wp-block-column" style="flex-basis:280px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">Role</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"role"}}}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">Attorney</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"8px"},"padding":{"top":"22px","right":"28px","bottom":"22px","left":"28px"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|bnti-white-20","style":"solid","width":"1px"}}}} -->
<div class="wp-block-columns" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:22px;padding-right:28px;padding-bottom:22px;padding-left:28px"><!-- wp:column {"width":"280px"} -->
<div class="wp-block-column" style="flex-basis:280px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">Office</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"office"}}}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">City, State</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"8px"},"padding":{"top":"22px","right":"28px","bottom":"22px","left":"28px"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|bnti-white-20","style":"solid","width":"1px"}}}} -->
<div class="wp-block-columns" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:22px;padding-right:28px;padding-bottom:22px;padding-left:28px"><!-- wp:column {"width":"280px"} -->
<div class="wp-block-column" style="flex-basis:280px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">Licensed in</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"licensed_in"}}}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">State (year)</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"8px"},"padding":{"top":"22px","right":"28px","bottom":"22px","left":"28px"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|bnti-white-20","style":"solid","width":"1px"}}}} -->
<div class="wp-block-columns" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:22px;padding-right:28px;padding-bottom:22px;padding-left:28px"><!-- wp:column {"width":"280px"} -->
<div class="wp-block-column" style="flex-basis:280px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">Cases</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"cases"}}}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">Case types</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px","top":"8px"},"padding":{"top":"22px","right":"28px","bottom":"22px","left":"28px"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|bnti-white-20","style":"solid","width":"1px"}}}} -->
<div class="wp-block-columns" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:22px;padding-right:28px;padding-bottom:22px;padding-left:28px"><!-- wp:column {"width":"280px"} -->
<div class="wp-block-column" style="flex-basis:280px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">Practicing since</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"practicing_since"}}}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">Year</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_00000b-4d","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",35,""],"inheritMaxWidth":true,"padding":[50,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00000c-54","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_00000c-54"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">02 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"textColor":"bnti-neutral-lighter"} -->
<h2 class="wp-block-heading has-bnti-neutral-lighter-color has-text-color">Meet <mark class="bnti-highlight">First name.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_00000a-46","tabletLayout":"row","collapseOrder":"right-to-left","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"left-golden","firstColumnWidth":45,"secondColumnWidth":55,"padding":[0,0,0,0],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000008-38","kbVersion":2,"pointer":true,"pointerLength":78,"pointerPosition":"top"} -->
<div class="wp-block-kadence-column kadence-column318_000008-38"><div class="kt-inside-inner-col"><!-- wp:paragraph {"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Introduction: who this attorney represents, their background in one or two sentences, and where they are licensed.]</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000009-3f","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000009-3f"><div class="kt-inside-inner-col"><!-- wp:image {"id":435,"aspectRatio":"16/11","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"figFrame":true,"figLabel":"02"} -->
<figure class="wp-block-image size-full" style="margin-top:0;margin-bottom:0"><img src="https://mty.1wp.site/wp-content/uploads/2026/10/team-meet.webp" alt="Two lawyers walking up courthouse steps" class="wp-image-435" style="aspect-ratio:16/11;object-fit:cover"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_000010-70","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",35,""],"inheritMaxWidth":true,"padding":[50,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000011-77","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000011-77"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">03 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"textColor":"bnti-neutral-lighter"} -->
<h2 class="wp-block-heading has-bnti-neutral-lighter-color has-text-color"><mark class="bnti-highlight">Background.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_00000f-69","tabletLayout":"row","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"right-golden","firstColumnWidth":55,"secondColumnWidth":45,"padding":[0,0,0,0],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00000e-62","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_00000e-62"><div class="kt-inside-inner-col"><!-- wp:image {"id":436,"aspectRatio":"16/11","scale":"cover","focalPoint":{"x":0.85,"y":0.05},"sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"figFrame":true,"figLabel":"03"} -->
<figure class="wp-block-image size-full" style="margin-top:0;margin-bottom:0"><img src="https://mty.1wp.site/wp-content/uploads/2026/10/sean-d-phinney-background.webp" alt="Lawyer meeting with a client wearing a neck brace" class="wp-image-436" style="aspect-ratio:16/11;object-fit:cover;object-position:85% 5%"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00000d-5b","kbVersion":2,"pointer":true,"pointerDirection":"left","pointerLength":78,"pointerPosition":"top","pointerOffset":44} -->
<div class="wp-block-kadence-column kadence-column318_00000d-5b"><div class="kt-inside-inner-col"><!-- wp:paragraph {"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Background: where they trained and how their career started.]</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Background: what their practice focuses on today and the kinds of cases they handle.]</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_000012-7e","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",35,""],"inheritMaxWidth":true,"padding":[50,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000013-85","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000013-85"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">04 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"textColor":"bnti-neutral-lighter"} -->
<h2 class="wp-block-heading has-bnti-neutral-lighter-color has-text-color">Beyond the <mark class="bnti-highlight">office.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"560px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic"}},"textColor":"bnti-neutral-light","fontSize":"bnti-small"} -->
<p class="has-bnti-neutral-light-color has-text-color has-bnti-small-font-size" style="font-style:italic">[A few sentences about life outside work: family, interests, hobbies, or community involvement.]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_000017-a1","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",35,""],"inheritMaxWidth":true,"padding":[50,15,50,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000018-a8","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000018-a8"><div class="kt-inside-inner-col"><!-- wp:kadence/rowlayout {"uniqueID":"318_000016-9a","tabletLayout":"row","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"right-golden","firstColumnWidth":35,"secondColumnWidth":65,"padding":[0,0,0,0],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000014-8c","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000014-8c"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">05 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"textColor":"bnti-neutral-lighter"} -->
<h2 class="wp-block-heading has-bnti-neutral-lighter-color has-text-color"><mark class="bnti-highlight">Recognition.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:image {"id":381,"aspectRatio":"3/2","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"figFrame":true,"figLabel":"04"} -->
<figure class="wp-block-image size-full" style="margin-top:0;margin-bottom:0"><img src="https://mty.1wp.site/wp-content/uploads/2026/10/james-laura-recognition.webp" alt="Colleagues celebrating with a high five" class="wp-image-381" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000015-93","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000015-93"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"},"top":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">01</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Award, organization, year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">02</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Award, organization, year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">03</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Award, organization, year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_00001c-c4","columns":1,"colLayout":"equal","align":"full","tabletPadding":[35,"",70,""],"inheritMaxWidth":true,"padding":[50,15,100,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00001d-cb","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_00001d-cb"><div class="kt-inside-inner-col"><!-- wp:kadence/rowlayout {"uniqueID":"318_00001b-bd","tabletLayout":"row","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"right-golden","firstColumnWidth":35,"secondColumnWidth":65,"padding":[0,0,0,0],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000019-af","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000019-af"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">06 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:bnti/icon {"blockStyle":{},"iconName":"","customSvgCode":"\u003csvg width=\u002236\u0022 height=\u00228\u0022 viewBox=\u00220 0 36 8\u0022 fill=\u0022none\u0022 xmlns=\u0022http://www.w3.org/2000/svg\u0022\u003e\u003ccircle cx=\u00224\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 fill=\u0022#3A8D3B\u0022 stroke=\u0022#3A8D3B\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002218\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00224\u0022 fill=\u0022#060606\u0022/\u003e\u003ccircle cx=\u002232\u0022 cy=\u00224\u0022 r=\u00223.5\u0022 stroke=\u0022white\u0022 stroke-opacity=\u00220.7\u0022/\u003e\u003c/svg\u003e","sizes":{"Desktop":8},"iconSize":8,"textColor":"","backgroundColor":"","keepAspectRatio":true} -->
<div class="wp-block-bnti-icon is-fill has-aspect-ratio"><div class="bnti-icon-block-wrapper icon-valign-center"><div class="icon-container" style="--dsize:8px"><svg width="36" height="8" viewBox="0 0 36 8" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="4" cy="4" r="3.5" fill="#3A8D3B" stroke="#3A8D3B"/><circle cx="18" cy="4" r="4" fill="#060606"/><circle cx="18" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/><circle cx="32" cy="4" r="4" fill="#060606"/><circle cx="32" cy="4" r="3.5" stroke="white" stroke-opacity="0.7"/></svg></div></div></div>
<!-- /wp:bnti/icon --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"textColor":"bnti-neutral-lighter"} -->
<h2 class="wp-block-heading has-bnti-neutral-lighter-color has-text-color"><mark class="bnti-highlight">Credentials.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:image {"id":382,"aspectRatio":"3/2","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"figFrame":true,"figLabel":"05"} -->
<figure class="wp-block-image size-full" style="margin-top:0;margin-bottom:0"><img src="https://mty.1wp.site/wp-content/uploads/2026/10/james-laura-credentials.webp" alt="Lawyer working on a laptop" class="wp-image-382" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00001a-b6","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_00001a-b6"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"},"top":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--bnti-white-20);border-top-style:solid;border-top-width:1px;border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">01</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[State Bar, admitted year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">02</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[J.D., law school, year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">03</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Undergraduate degree, school, year]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">04</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Professional association]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"24px","padding":{"top":"20px","bottom":"20px"}},"border":{"bottom":{"color":"var:preset|color|bnti-white-20","width":"1px","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bnti-white-20);border-bottom-style:solid;border-bottom-width:1px;padding-top:20px;padding-bottom:20px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"layout":{"selfStretch":"fixedNoShrink","flexSize":"40px"}},"textColor":"bnti-premier","fontSize":"bnti-small"} -->
<p class="has-bnti-premier-color has-text-color has-bnti-small-font-size" style="font-weight:600">05</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"bnti-medium"} -->
<p class="has-bnti-medium-font-size">[Professional association]</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_000021-e7","columns":1,"colLayout":"equal","currentOverlayTab":"gradient","bgImg":"https://mty.1wp.site/wp-content/uploads/2026/10/james-laura-talk-to-james.webp","bgImgID":383,"overlay":"#060606","overlaySecond":"#060606","overlayFirstOpacity":1,"overlaySecondOpacity":0.2,"overlayGradLoc":40,"overlayGradAngle":90,"overlayOpacity":100,"align":"full","tabletPadding":[70,"",70,""],"inheritMaxWidth":true,"overlayGradient":"linear-gradient(90deg, var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dbnti-white) 40%, color-mix(in srgb, var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dbnti-white) 20%, transparent) 100%)","padding":[100,15,100,15],"margin":[0,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000022-ee","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000022-ee"><div class="kt-inside-inner-col"><!-- wp:group {"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:50px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}},"fontSize":"bnti-small"} -->
<p class="has-bnti-small-font-size" style="font-weight:600;text-transform:uppercase">07 / 07</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Talk to First name about<br><mark class="bnti-highlight">your case.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"bnti-white"} -->
<hr class="wp-block-separator has-text-color has-bnti-white-color has-css-opacity has-bnti-white-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"/>
<!-- /wp:separator -->

<!-- wp:kadence/rowlayout {"uniqueID":"318_00001e-d2","tabletLayout":"row","collapseGutter":"custom","customRowGutter":[50,50,50],"columnGutter":"custom","customGutter":[70,70,70],"colLayout":"equal","verticalAlignment":"middle","padding":[0,0,0,0],"margin":[50,"",0,""],"kbVersion":2} -->
<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_00001f-d9","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_00001f-d9"><div class="kt-inside-inner-col"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"bnti-large"} -->
<p class="has-bnti-large-font-size" style="margin-top:0;margin-bottom:0">Your case review is free.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:kadence/column -->

<!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"318_000020-e0","kbVersion":2} -->
<div class="wp-block-kadence-column kadence-column318_000020-e0"><div class="kt-inside-inner-col"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="tel:+18886452222">Call 888-645-2222</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout --></div></div>
<!-- /wp:kadence/column -->
<!-- /wp:kadence/rowlayout -->
