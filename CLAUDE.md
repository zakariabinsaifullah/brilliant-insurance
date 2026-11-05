# Brilliant Insurance Theme — Section Design Rules

Role: Read figma design, then make the exact design in WordPress (Use Figma MCP server and Verify each design using claude browser extension)
Follow these rules whenever you design or build a section, pattern, template or page for this theme.

> **CLAUDE.md wins over Figma (global rule):** the Figma design is not 100% consistent. Take content, structure and layout from Figma, but whenever a Figma style value (spacing, padding, gaps, radius, line-height, letter spacing, font size, colour…) differs from a rule in this file, **follow this file**. Mention the notable differences to the user after building, rather than asking first.

## 0. Project basics

-   **Theme:** Brilliant Insurance, a block (FSE) theme. Text domain `brilliant-insurance`; code prefix `bnti` / `BNTI` (`bnti_` functions, `BNTI_` constants, `bnti/` block names, `bnti-` CSS classes and preset slugs).
-   **Figma file:** `https://www.figma.com/design/OmYw1CMCx6FCYG0R7kdKfb/-MTY--More-2-You-Law-Zak?node-id=11098-4&p=f&t=6AEkPUzVoFI5BOIg-0`. Everything lives on the **↳ Full Design** page: one section per page (e.g. `[MTY] More 2 You Law - Homepage`, with desktop and mobile frames) and an `Assets • <page name>` section to its right, plus `Inner Pages • Components`, `Navigation States`, `Web Assets` and the `Brand Book`. The Figma colour variables (`Color/Goblin`, `Color/Green Pea`, …) and the type scale map to the `bnti-*` presets in section 7.
-   **Repo:** https://github.com/zakariabinsaifullah/brilliant-insurance (public, default branch `main`).
-   **Build:** block and extension sources live in `src/`; run `npm run build` after changing anything there. `build/` is git-ignored (CI builds it).
-   **Deploy (push → live):** pushing to `main` runs `.github/workflows/deploy.yml`: it builds the theme, copies the production files (everything except what `.distignore` lists, so no `src/`, `node_modules/` or dev files, but with `build/`) to the `deploy` branch, then POSTs the `DEPLOYER_WEBHOOK_URL` secret. **Deployer for Git** on the live site has the `brilliant-insurance` theme linked to `https://github.com/zakariabinsaifullah/brilliant-insurance`, branch `deploy`, and reinstalls it from that branch when the webhook fires. Never point Deployer at `main` (it has no `build/`). Only push when the user asks. Check a deploy with `gh run list` / `gh run watch`; if the webhook step fails or is skipped, the theme can be redeployed by hand from Deployer for Git → Dashboard → **Deploy Theme**.
-   **Release:** pushing a tag runs `.github/workflows/release.yml`, which builds the theme, zips it as `brilliant-insurance.zip` (root folder `brilliant-insurance/`, same file list as the deploy branch) and publishes a GitHub Release using the `TOKEN` secret. Tags are the plain theme version, no `v` prefix (e.g. `0.2.1`). To release: bump `Version:` in `style.css` and `version` in `package.json`, commit, push `main`, then `git tag <version> && git push origin <version>`.
-   **Version:** the theme version lives in `style.css` (`Version:`); keep `package.json` in step.
-   **Repo secrets:** `TOKEN` (GitHub token for releases) and `DEPLOYER_WEBHOOK_URL` (the theme's webhook URL from Deployer for Git → Dashboard → "Show webhook URL"). Never print, commit or echo either value.
-   **Where to build designs (global rule):** when the user asks to design a section (or page) from Figma, always build it on the **live site** (https://mty.1wp.site), never on the local Studio site. Edit it in the live site's block editor through Claude in Chrome (the user is logged in there), and use the `wp-mty` MCP server (section 0a) for the content reads/writes it supports. Verify the result on the live front end. The image-upload rule in section 6 applies there too (BinsOptimizer is active on the live site). Theme code changes still happen locally and reach the live site by pushing to `main`.

## 0a. Live site MCP server (`wp-mty`)

-   **What it is:** the Viagent Production MCP server on the live site (`https://mty.1wp.site/wp-json/viagent-production/v1/mcp`), added to Claude Code as `wp-mty` with local scope (`claude mcp add --transport http wp-mty … --header "Authorization: Bearer …"`). The Bearer token lives only in `~/.claude.json`; never write it into this file, the repo or any page. Its tools are named `mcp__wp-mty__*` and load at session start.
-   **Use it for live content work:**
    -   Read: `get_site_info`, `list_posts`, `get_post`, `get_post_blocks`, `list_templates` / `get_template`, `list_patterns` / `get_pattern`, `get_menu`, `list_media`, `get_global_styles`.
    -   Write: `create_post` / `update_post` (block markup), `edit_post_blocks` (change single blocks by path instead of resending the page), `replace_in_post`, `update_template` (headers, footers, templates), `update_navigation_menu`, `update_media` (alt text, captions), `set_featured_image`.
    -   Check markup with `prepare_content` before saving it, and use `list_revisions` / `restore_revision` to undo a bad save.
    -   Every rule in this file still applies to markup written through the server (Kadence Row Layout container, spacing, presets, no custom names…).
-   **Don't use these tools, use the alternative:**
    -   `upload_media_from_url` / `upload_media_base64`: they skip BinsOptimizer. Upload images through the block editor instead (section 6).
    -   `write_extension_file` / `delete_extension_file` on the Brilliant Insurance theme: theme code is changed locally and reaches the live site by deploy (section 0). Editing it live makes local and live drift apart.
    -   `update_global_styles`: user global styles override `theme.json`. Change colours, typography and buttons in `theme.json` instead.
-   **Never save page content containing SVGs or Icon blocks through the server** (`update_post`, `replace_in_post`, `edit_post_blocks` on such pages): its API user has no `unfiltered_html`, so WordPress strips `<svg>` from the markup and from block attributes (the Icon block markers come back empty and invalid). Edit those pages in the block editor (Claude in Chrome), which saves as the logged-in admin. Small text-only edits on pages without SVGs are fine.
-   **Ask first:** anything destructive or site-wide (`delete_*`, plugin/theme install, activate, update or delete, users, `update_settings`, SEO settings, `robots.txt`, redirects, comments) needs the user's clear yes for that action.
-   **Always verify** a server write on the live front end with Claude in Chrome. A successful tool response only means the data was saved, not that the section looks right.

## 1. Container: Kadence Row Layout

-   Wrap every section in a **Kadence Row Layout** block (`kadence/rowlayout`).
-   Don't use `core/group`, `core/cover` or `core/columns` as the outer container of a section.
-   **Top-level width (global rule):** every top-level Row Layout (the section wrapper) is set to **Full Width** alignment (`"align":"full"`) with **Inherit Max Width from Theme?** turned on (`"inheritMaxWidth":true`), so its background spans the screen and its content follows the theme's 1310px content width. Never type a custom Max Width on it. Nested Row Layouts don't get this.
-   **Creating Kadence blocks by script (global rule):** when blocks are built with `wp.blocks.createBlock` in the editor, give every `kadence/rowlayout` and `kadence/column` **`"kbVersion":2`**, or Kadence renders a row without its wrapper (no padding, background or anchor). Kadence adds it in the editor without marking the post dirty, so it is never saved on its own. After inserting, save with `editPost({ content: wp.blocks.serialize( getBlocks() ) })` + `savePost()` and check the front end.
-   **Kadence Section borders:** set `borderStyle` (`[{"top":[color,"solid",1],…,"unit":"px"}]`, colour as a `var(--wp--preset--color--bnti-…)`) **and** clear the legacy widths (`"borderWidth":["","","",""]`, plus `tabletBorderWidth`/`mobileBorderWidth`); while `borderWidth` holds numbers (its default is `[0,0,0,0]`) Kadence ignores `borderStyle`. Turn on the row's **Inner Column Height 100%** (`"columnsInnerHeight":true`) so the bordered inner column fills equal-height cards. Tablet/mobile border sides left empty inherit the desktop value; to remove a side there, set its width to 0 (`[color,"solid",0]`).
-   **Kadence Section content at top and bottom** (e.g. image tiles with an icon at the top and a title at the bottom): set **Vertical Alignment** to space-between on every device (`"verticalAlignment":"space-between","verticalAlignmentTablet":"space-between","verticalAlignmentMobile":"space-between"`) and leave `justifyContent` empty; with a vertical direction Kadence writes `justifyContent` as `align-items`, so it doesn't spread the content. A gradient overlay is `"overlayType":"gradient","overlayGradient":"linear-gradient(… var(--wp--preset--color--bnti-…) …)","overlayOpacity":1`.
-   **Header and navigation (Kadence):** the site header is the **Kadence Header** post "Header" (ID 192), placed by `parts/header.html` (`<!-- wp:kadence/header {"id":192} /-->`); edit it in its own editor (Kadence Header → Header). It is transparent on all devices (header settings are post meta, e.g. `_kad_header_isTransparent`), so the first section of every page sits under it and needs enough top padding. Menus are **Kadence Navigation** posts: Primary (196, desktop) and Mobile Menu (194, off-canvas); their link typography/colours/spacing are post meta (`_kad_navigation_typography`, `_kad_navigation_linkColor…`, `_kad_navigation_spacing`). Every `kadence/navigation-link` needs a `uniqueID`, or Kadence renders the menu empty. The logo is the core Site Logo (`site_logo` = media 204).
-   **Mega menus** (Practice Areas, Service Areas, About Us in the Primary menu): Kadence's native mega menu, no custom post type. Each of those navigation links has **Mega Menu** on with width **Container** (`"isMegaMenu":true,"megaMenuWidth":"container"`) and holds one Kadence Row Layout: a single Section (dark `bnti-background`, 1px White 15% border, padding 44/48/48/48) with the "PRACTICE AREAS →" link (a Plain Links Group), a faint separator and a nested Row Layout of columns. Columns use core blocks: a heading (linked to the hub page), an optional description, a separator and a List in the **Mega Links** style; About Us uses **Mega Links: Large** for its left column, a core **Query Loop** of the Our Team child pages (parent 55, page order; title = name, excerpt = role) and a static featured image. To change a panel, edit Kadence Navigation → **Primary** and select the parent item. A new attorney appears automatically once their page is a child of Our Team with the role in its excerpt and a page order. The theme CSS (blocks.css, "Mega menus") makes the panel span the header row, swaps Kadence's chevron for **+ / −**, turns the open item Goblin with a 2px underline on the header rule, and bridges the gap so hover doesn't drop. On mobile the off-canvas **Mobile Menu** (194) uses plain nested links instead of panels.
-   **Team (custom post type `bnti_team`, `inc/team.php`):** one post per attorney, URL `/team/<slug>/` (under the Our Team page, no archive), single template `single-bnti_team.html` (header, full-width post content, footer), so every bio section is built in the post's block editor like a page. Title = full name, excerpt = short card bio, featured image = headshot, Page Attributes → Order = list order. The **Team details** sidebar panel holds the meta: `bnti_team_short_name` ("James"), `bnti_team_name_highlight` ("Laura, Jr."; empty = last word), `bnti_team_position`, `bnti_team_office`, `bnti_team_role`, `bnti_team_licensed_in`, `bnti_team_cases`, `bnti_team_practicing_since`. Show them with the **Team member** block bindings source (`bnti/team`, works on the member's page and inside a Query Loop of `bnti_team`), never by retyping: keys `name` (title with the highlighted part in the Highlight format), `eyebrow` ("Founder, Fairhope, Alabama"), `tagline` ("Founder, Brilliant Insurance. Fairhope, Alabama."), `bio_link` ("Read James's bio"), and the field names without the prefix (`short_name`, `position`, `office`, `role`, `licensed_in`, `cases`, `practicing_since`); e.g. `"metadata":{"bindings":{"content":{"source":"bnti/team","args":{"key":"name"}}}}`. Link a card's button with `{"url":{"source":"core/post-data","args":{"field":"link"}}}`. A page left at `/team/<slug>/` still works until a team member takes that slug (`bnti_team_page_fallback()`). **Bio page layout:** every member page uses the starter pattern **Team Member Page** (`patterns/team-member.php`, offered when a new Team member is created): Bio Hero (Post Featured Image with Figure Frame FIG. 01, so the headshot or the empty framed box shows), Fact list, then the Figma sections (text + image with a Pointer, text only, numbered list + image) and the closing CTA. Fill the Team details first; the hero name, intro line and fact values come from them. Remove or duplicate middle sections to match the member's Figma page, and renumber the "NN / 07" labels.
-   **Page hero (global rule):** the first section of every page is the hero: a Kadence Row Layout with padding **200**/15/100/15 (tablet 200 top, 70 bottom) and **no min height** (`"minHeight":0` on every device), so the content always starts 200px from the top whatever its length (the transparent header sits over that space). It holds one **h1** (theme size) and a description paragraph in **`bnti-lead`** (fixed 20px). Never use min height to size a hero: with bottom-aligned content it makes the top gap change with the amount of content and the screen width.
-   **Kadence Row Layout min height** is applied inside the padding: enter the design height minus the top and bottom padding (e.g. hero 980px − 160 − 100 = `"minHeight":720`).
-   **Global rule:** don't give blocks custom names (no `"metadata":{"name":...}`). Leave every block with its default name in the List View; the user renames blocks themselves if needed.

## 2. Block priority

Pick blocks in this order, and move down a level only when the level above can't do the job:

1. **Core WordPress blocks.** These are strongly preferred for all content: headings, paragraphs, buttons, images, lists, query loops and so on.
2. **Custom blocks in the Brilliant Insurance inserter category** (`bnti/*`):
    - Icon (`bnti/icon`)
    - Social Share (`bnti/social-share`)
    - Timeline (`bnti/timeline`, with `bnti/timeline-step` children): a row of steps joined by one line, each marked by a 12px square dot, with any blocks below (number, heading, text). Use it for every numbered process/steps section. Settings: Steps, Columns (desktop; tablet and mobile always stack as a plain list: a White 15% divider per step, no dots, no highlight, as in the Figma mobile frames), Step gap and Content gap (both default 40px, as in Figma), colours (Dot & Line default `bnti-white`, Highlighted Dot default `bnti-goblin`), **Highlight line** and **Highlight on hover** (desktop: the hovered step takes the highlight colours from the highlighted step; its line keeps its normal 1px thickness). Turn on **Highlight step** on the step that is highlighted (the first, by default).
        - Step content: one vertical Group with `blockGap: 24px` holding the number (`bnti-heading-one`), an **h3 in `bnti-title`** (fixed 24px) and the text; leave their margins unset. Content gap 40.
        - Practice-page style ("How the process works."): Highlight line **off**, so only the dot is coloured.
        - Homepage style ("How we move your case."): Highlight line **on** (the highlighted step's line becomes a 3px progress bar), **Highlight on hover on**, Highlighted Dot `bnti-green-pea`, Highlighted Line `bnti-goblin`.
    - Rating (`bnti/rating`): SVG star rating with optional rating number.
3. Always use the Brilliant Insurance **Icon** block where an icon is used. Always use SVG code, and save the SVGs under **My Icons** for future use.
4. **Other Kadence blocks.** Use these only when neither core blocks nor the theme's custom blocks can do the job.

## 3. Row Layout spacing

-   A **standalone** Row Layout (a top-level section, not nested inside another Row Layout) uses:
    -   **100px** padding top and bottom
    -   **15px** padding left and right
-   In block markup that's `"padding":[100,15,100,15]`. The order is top, right, bottom, left.
-   on tablet use 70px top bottom padding (mobile will be auto like tablet)
-   **Global rule:** every top-level Row Layout has its top and bottom margin set to **0** (`"margin":[0,"",0,""],"marginUnit":"px"`). This applies everywhere: pages, posts, patterns, templates and template parts. Otherwise the theme's global block gap (1.2rem) adds about 19px between sections, on top of the padding.
-   Row Layouts nested inside another Row Layout don't get this default. Space them as the design needs.
-   but in case of same background based sections like two sections, both have same background, then use **Inner Space** 100px in total (50px-50px) while on tablet it will be (35px-35px)
-   **Section title group (global rule):** wrap a section's title and its description (if any) in a **Group** (`core/group`), and put the **50px** space below them on that Group as its bottom margin, never on the heading or on the last paragraph. The Group's **Block spacing is always 12px** (`blockGap: 12px`), whatever spacing Figma shows between title and description; per the block-spacing rule, **leave the title's and description's margins unset** (never 0), or the 12px won't apply. Group: `"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}}`. This applies on every device, and also when there's only a title (the Group still carries the 50px).
-   Content width is **1310px**; wide width is **1440px** (the Figma frame width).
-   Inner padding for cards is **32px** by default; boxes that Figma pads more tightly (e.g. the 12px × 20px boxed section titles) keep the Figma padding
-   for 2 columns section, the columns gap is 70px where row gap is 50px
-   for 3 columns section, the columns gap is 24px and row gap is also 24px
-   on tablet and mobile all columns will have 1 column

## 3a. Card columns (nested Row Layout)

-   Build card grids as a nested Row Layout (`kadence/rowlayout`) with one **Section** (`kadence/column`) per card.
-   Columns gap is always **24px**, both between columns and between rows: `"columnGutter":"custom","customGutter":[24,24,24],"collapseGutter":"custom","customRowGutter":[24,24,24]`.
-   On tablet and mobile, cards are always **1 column**: `"tabletLayout":"row","mobileLayout":"row"`.
-   For image cards, don't use `core/cover`. Use the Section's own **Background Image + Overlay** settings (`backgroundImg`, `overlay` with a `bnti-*` colour, `overlayOpacity`).
-   Cards in the same row are always **equal height**. If the design gives a card height, set it as the Section's min height. Kadence adds padding on top of min height, so enter the design height minus the top and bottom padding (for example, 443px card − 64px padding = `"height":[379]`).
-   Card content is vertically aligned to the **bottom** (`"verticalAlignment":"bottom"`).
-   Card inner padding is an equal **32px** on all sides (`"padding":[32,32,32,32]`).
-   Cards are **square** (no border radius), per the global radius rule in section 4.
-   **Content gap (global rule):** the gap between stacked content items (icon → heading → description) is always **24px**. Set it with the Section's **Vertical Gap** setting (`"rowGapVariable":["custom","",""],"rowGap":[24,"",""],"rowGapUnit":"px"`), not with block margins.
-   **Numbered items (global rule):** in a content item made of a number + heading + description (e.g. process steps "01 / 02 / 03"), the three are always **24px** apart (the content gap). Put them in one vertical Group with `blockGap: 24px`, leaving the items' margins unset (block-spacing rule); anything after the item (a divider, a button) sits outside that Group with its own gap.
-   **Block spacing: never set child margins (global rule):** when spacing comes from a core block's **Block spacing** (`blockGap` on a Group, Row, Stack, Buttons, etc.), **never set a margin on the blocks inside it — not even 0**. Leave headings, paragraphs, etc. with their margins unset. WordPress applies block spacing as each block's top margin (and clears the theme's default margins itself), so a block's own `"margin":{"top":"0"...}` overrides it and the spacing disappears.
-   **Kadence Section Vertical Gap means zero margins (global rule):** a Kadence Section's **Vertical Gap** is a real CSS gap that doesn't clear the theme's default margins, so there every block inside (headings, paragraphs, icons, lists, buttons, etc.) does get **0 top and bottom margin** (and 0 padding on text blocks): `"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}`. Otherwise the heading's 12px / paragraph's 16px bottom margin adds to the gap.

## 3b. Content columns (nested Row Layout)

-   For content layouts that aren't card grids, such as text beside an image, the column gap is **70px**: `"columnGutter":"custom","customGutter":[70,70,70]`.
-   When the columns stack on tablet and mobile, the row gap is **50px**: `"collapseGutter":"custom","customRowGutter":[50,50,50]`.
-   Card grids keep the 24px gap from section 3a.

## 4. Style with existing block settings

Style blocks through the options they already have, in this order:

1. **Block settings in the editor sidebar:** typography, colour, spacing, border, layout.
2. **The theme's presets from `theme.json`.** Never hard-code values that a preset already covers (see section 7 for the full set).
3. **Registered block styles:** Button — Alternative, Outline (core) and Link; List — Mega Links and Mega Links: Large (mega menu link lists); Post Template — **Card Grid** (Query Loop card grids: Grid layout 3 columns, cards stretch to the row height, a lone last card spans the row, 1 column at 1024px and below); Group — Wrap Mobile and Plain Links (links inside aren't underlined; use it for link lists like "On this page"). Links inherit their text's font, weight and line-height, so set the weight on the paragraph, not the link.
4. **The theme's editor extensions:**
    - Highlight (rich text format: the **Highlight** button with the "A" icon in its own group on the block toolbar, next to Bold/Italic; not core's "Highlight" in the More menu). Makes the selected words semi-bold (600) in `bnti-goblin`; another Brilliant Insurance colour can be picked in its popover. Use it for the coloured words in headings (e.g. "Key **takeaways.**", "Meet **James.**"); never colour or bold those words by hand.
    - Hover Color
    - Text Max Width
    - Iconic Button (Icon Settings panel on a Button: add an SVG icon before/after the label)
    - Group Full Height, Group Overlay Background and Group Global Hover
    - Image Figure Frame (Image → Settings → **Figure Frame**; see section 6)
    - Pointer (Group and Kadence Section → Settings → **Pointer**): the Figma image "callouts", a 1px white line from the block's edge ending in a dot, pointing at the image beside it. Desktop only (hidden at 1024px and below), so nothing to do for mobile. Put it on the **text side** (e.g. the boxed title Group, or the text column), never on the image, so it stays level with the text. Settings: Direction (Right/Left, towards the image), Length (px, dot included), Vertical position (Middle, or px From top), Size (**Large**: 18px dot with a Green Pea ring, e.g. homepage "The claims we take on."; **Small**: 10px white dot, e.g. practice-page text blocks).
    - Kadence Featured Image Background (Row Layout)

**Border radius (global rule):** the Brilliant Insurance design is square. **Images and buttons always have a 0 border radius**, and so do cards, groups/boxes with a background or border, videos, embeds and similar elements (leave the radius setting empty or 0; the theme already makes buttons and framed images square). The only rounded element is the Icon block's box (10px).

## 5. No custom CSS or JS without permission

-   **Never** add custom CSS or JavaScript without asking the user first and getting a clear yes. This covers theme files, block "Additional CSS", inline `style` attributes that go beyond block settings, `theme.json` `css` fields, and new scripts.
-   If a design can't be built with the rules above, stop. Explain what's missing and propose the CSS/JS change, then wait for approval.

## 6. Images, Icons, Content

-   use exact text used in figma design
-   each page's images are in the `Assets • <page name>` section to the right of that page's section on the Full Design page (e.g. `Assets • [MTY] More 2 You Law - Homepage`); take them from there
-   for Icons, always use SVG codes
-   **Uploading images (global rule):** the site uses **BinsOptimizer**, which converts images to WebP and compresses them **in the browser**, before the upload reaches the server. It hooks the block editor's `mediaUpload` setting. So:
    -   **Never** upload images with `studio wp media import`, the REST API directly, the `wp-mty` MCP upload tools (`upload_media_from_url`, `upload_media_base64`), or by copying files into `uploads/`. Those skip BinsOptimizer and leave JPEG/PNG files unconverted.
    -   Upload through the block editor in the browser (Claude in Chrome), using the wrapped `mediaUpload` function:
        1. Make the source file fetchable by the browser: on the local site, put it in a temporary folder under `wp-content/uploads/` (e.g. `claude-upload-tmp/`); on the live site, use a URL the editor page can `fetch` (the same site, or a host that allows cross-origin requests; test it first, because Figma asset URLs may be blocked by CORS).
        2. Open any post or page in the editor and wait until `wp.data.select('core/block-editor').getSettings().mediaUpload.__biioWrapped` is `true`.
        3. Fetch the file as a blob, wrap it in a `File` with the right name and type, and call `mediaUpload({ filesList: [file], allowedTypes: ['image'], onFileChange, onError })`. Use the returned `id` and `url` (they end in `.webp`) in the blocks.
        4. Delete the temporary folder afterwards.
    -   Check the result: the attachment's file should be `.webp` and it should have `_biio_savings` / `_biio_optimized_at` meta.
-   **Icon block defaults** (match the Figma card icons): a **20px** icon, white (`bnti-white`), centred in a **45×45px** box with a `bnti-goblin` background and **10px** radius. These are the block's defaults, so a new Icon block needs no extra settings and no padding. Set only the desktop size (`"sizes":{"Desktop":20},"iconSize":20`); tablet and mobile inherit it.
-   **Icon + title gap (global rule):** when an Icon block shows a title next to the icon, the gap between them is always **16px** (`"listGap":"16px"`). If you set it by script, also set `blockStyle["--list-gap"]` to `"16px"`: the block only recalculates `blockStyle` when it renders in the editor, so changing `listGap` alone can leave the old gap in the saved markup.
-   **Figure frame (global rule):** images in the Figma design use a "figure" style: a faint 1px border, a dark overlay, four white corner ticks and a "FIG. 02" label top left. Recreate it with the Image block's **Figure Frame** panel (Settings tab), never with custom markup or CSS:
    -   Turn on **Enable figure frame** and type the number from the design into **FIG value** (e.g. `02` shows "FIG. 02"). Leave the value empty if the design shows no label.
    -   Switch off **Border**, **Corner ticks** or **Dark overlay** when the design leaves them out. For example, the "Meet James" portrait shows only the label.
    -   Framed images are square, like every image (section 4).
    -   Core Image and **Post Featured Image** blocks have the panel. Images used as Kadence Section backgrounds can't be framed. On Post Featured Image (Query Loop cards, e.g. Our Team headshots) **Post title as label** shows "[HEADSHOT: NAME]" (prefix editable; the editor shows "Post title" in its place), and a post without a featured image shows an empty faint box (White 5%) with the ticks at the block's height.
-   never create custom image without permission

## 7. Color, Typography

-   always use Brilliant Insurance color and typography presets
-   never use custom color and typography without permission
-   never use letter spacing without permission
-   **never use a custom line-height.** Headings and body text always use the theme's line-heights (1.2 and 1.5), even if the Figma value differs.
-   **Never set a custom bottom margin on headings.** All headings get a **12px** bottom margin (and 0 top margin) from the theme (`style.css`); paragraphs get 16px. The only exception is a Kadence Section's Vertical Gap (section 3a), where headings are set to 0 margin; inside a core block's Block spacing, leave heading margins unset.
-   **h1 and h2 always use the theme's default font size** (`bnti-heading-one` / `bnti-heading-two`). Never set a custom or different font size on an h1 or h2; if the design shows another size, pick the heading level that matches it instead.

**Colours** (`bnti-*`, from the Brilliant Insurance Figma colour list; each family runs `-lightest`, `-lighter`, `-light`, base, `-dark`, `-darker`, `-darkest`):

| Role                                  | Preset                                                                       | Value     |
| ------------------------------------- | ---------------------------------------------------------------------------- | --------- |
| Primary / buttons / icon boxes        | `bnti-goblin`                                                                 | `#3A8D3B` |
| Button hover                          | `bnti-goblin-dark`                                                            | `#2E702F` |
| Secondary green                       | `bnti-green-pea`                                                              | `#1E7444` |
| Site background (body)                | `bnti-background` (Figma `Bg-1`)                                              | `#060606` |
| Default text: headings, body, links   | `bnti-white`                                                                  | `#FFFFFF` |
| Dark backgrounds / text on light bg   | `bnti-thunder`                                                                | `#231F20` |
| Muted text on light backgrounds       | `bnti-neutral-dark`                                                           | `#555555` |
| Light backgrounds                     | `bnti-neutral-lightest`, `bnti-goblin-lightest`, `bnti-green-pea-lightest`      |           |
| Neutrals                              | `bnti-white`, `bnti-white-*`, `bnti-neutral-*`                                  |           |
| Transparent overlays                  | `bnti-white-5` … `-60`, `bnti-neutral-darkest-5` … `-60`, `bnti-transparent`    |           |

The site is **dark by default**: the body background is `bnti-background` (#060606) and all text defaults to white. On a light section (white, `bnti-neutral-lightest`, `bnti-goblin-lightest`…) set the heading and text colours to `bnti-thunder` / `bnti-neutral-dark` on the block.

**Typography:**

-   **Headings (h1–h6):** Alexandria, weight **300 (Light)**, line-height **1.2**, colour `bnti-white`. Coloured, semi-bold words in a heading ("Key **takeaways.**") use the Highlight format, never a manual weight or colour.
-   **Body and paragraphs:** Open Sans, **16px** (`bnti-regular`), weight **400**, line-height **1.5**, colour `bnti-white`. Links are white too and turn `bnti-goblin` on hover.
-   **Heading and large text sizes are fluid** (mobile → desktop, scaling between 375px and 1440px viewports):

| Preset              | Element      | Size      |
| ------------------- | ------------ | --------- |
| `bnti-heading-one`   | h1           | 44 → 72px |
| `bnti-heading-two`   | h2           | 40 → 52px |
| `bnti-heading-three` | h3           | 32 → 44px |
| `bnti-heading-four`  | h4           | 24 → 36px |
| `bnti-heading-five`  | h5           | 20 → 28px |
| `bnti-heading-six`   | h6           | 18 → 22px |
| `bnti-large`         | Text Large   | 18 → 22px |
| `bnti-medium`        | Text Medium  | 16 → 18px |

-   **Fixed text sizes:** `bnti-title` 24px (Timeline step headings), `bnti-lead` 20px (hero descriptions), `bnti-regular` 16px (body), `bnti-small` 14px, `bnti-x-small` 12px. Fixed means not fluid: a custom size typed on a block (e.g. 20px) is turned into a fluid `clamp()` by WordPress, so always use these presets for fixed sizes.

**Buttons** (core Button block):

-   **Default (primary):** `bnti-goblin` background, white text, padding 16px 28px, **square corners (0 radius)**, Open Sans 14px (`bnti-small`) / 600 / 1.3, **uppercase**, letter spacing 0.12em (1.68px), centred. A **→ arrow** follows the label automatically (Open Sans 16px / 400, 12px gap); no icon setting needed. Hover darkens to `bnti-goblin-dark`; text stays white. (Figma: `Button / Primary`.)
-   **Outline:** same as default but transparent with a 1px `currentColor` border, white text (for dark or image backgrounds), padding 15px 27px so it matches the default's size, and the same automatic → arrow. Hover turns text and border `bnti-goblin`. (Figma: `Button / Outline`.)
-   The button's uppercase and letter spacing are part of the theme's button style, the one allowed exception to the "no letter spacing" rule; don't add them again on individual buttons.
-   All buttons transition over 0.3s `cubic-bezier(0.4, 0, 0.2, 1)`.
-   **Button icons:** default and outline buttons already show the → arrow. Only when the design shows a different icon, turn on **Icon Settings → Add Icon to Button** and paste the SVG code (save it to My Icons); that icon replaces the arrow. It follows the text colour, sizes to the text (1em) and sits **10px** from the label; leave Size/Gap empty unless the design differs.
