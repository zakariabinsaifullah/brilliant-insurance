# Brilliant Insurance Theme — Section Design Rules

Role: Read figma design, then make the exact design in WordPress (Use Figma MCP server and Verify each design using claude browser extension)
Follow these rules whenever you design or build a section, pattern, template or page for this theme.

## Core rules (always apply)

1.  **Figma pages are built on the live site.** Every page and section from the Figma design is built in the live site's block editor (https://brilliantinsur.1wp.site), never on the local Studio site. See "Where to build designs" in section 0.
2.  **Custom code is built and verified locally first.** Any new or changed custom block, block extension, block style, pattern, template or other theme code is built in this repo (`src/`, `inc/`, `assets/`…), run through `npm run build`, and verified on the **local Studio site** (with the Brilliant Insurance theme active there; check the editor and the front end with Claude in Chrome). Only once it works locally does it go to the live site, by committing and pushing to `main` (section 0, Deploy), and only then is it used on live pages. Never write or patch theme code on the live site.
3.  **Consistency wins over Figma.** The Figma pages are not consistent with each other: the same kind of element (section padding, title-to-text gap, card padding, button, heading, eyebrow, body text…) often has slightly different sizes from page to page. Never copy those one-off values. Every element of the same kind uses **one** size everywhere: the theme presets (section 7) and the spacing rules (sections 3–3b). Take content, structure and layout from Figma, but whenever a Figma style value (font size, spacing, padding, gaps, radius, line-height, letter spacing, colour…) differs from a rule in this file or from how the same element is already built on another page, **follow this file and the existing pages**, not Figma. When a new kind of element needs a size that isn't covered yet, pick one value (the most common one in Figma), add it to this file, and reuse it from then on. Mention the notable differences to the user after building, rather than asking first.

## 0. Project basics

-   **Theme:** Brilliant Insurance, a block (FSE) theme. Text domain `brilliant-insurance`; code prefix `bnti` / `BNTI` (`bnti_` functions, `BNTI_` constants, `bnti/` block names, `bnti-` CSS classes and preset slugs).
-   **Figma file:** `https://www.figma.com/design/BRqoi36AccbHC6kYSSnVbQ/-BHG--Brilliant-Holdings-Group-Design?node-id=15589-106&p=f&t=UF5zJJ3BXMhligKY-0`. The insurance site is on the **↳ Insurance Full Design** page: one section per page (e.g. `Brilliant Premier Insurance Homepage`, with desktop (1440px) and mobile (393px) frames). The file's colour variables (`Premier Primary`, `Premier Dark`, `Color/Crown of Thorns`, `Color/Neutral …`) and text styles (`Heading/H1`…`H6`, `Mobile Heading/H1`…, `Text/Large`…`Tiny`) map to the `bnti-*` presets in section 7.
-   **Repo:** https://github.com/zakariabinsaifullah/brilliant-insurance (public, default branch `main`).
-   **Build:** block and extension sources live in `src/`; run `npm run build` after changing anything there. `build/` is git-ignored (CI builds it).
-   **Deploy (push → live):** pushing to `main` runs `.github/workflows/deploy.yml`: it builds the theme, copies the production files to the `deploy` branch, then POSTs the `DEPLOYER_WEBHOOK_URL` secret. Only runtime files ship: `assets/`, `build/`, `inc/`, `parts/`, `patterns/`, `templates/`, `functions.php`, `style.css`, `theme.json`, `screenshot.png`. Everything else (`src/`, `node_modules/`, package files, configs, `*.md` incl. CLAUDE.md, `.claude/`, `.github/`, source maps) is excluded by `.distignore`, and `.github/scripts/verify-dist.sh` fails the run if any of it slips through or if `build/` is missing. Pushes that only change `*.md` or `.claude/` don't deploy. **Deployer for Git** on the live site (https://brilliantinsur.1wp.site → Deployer for Git → Dashboard) has the `brilliant-insurance` theme linked to `https://github.com/zakariabinsaifullah/brilliant-insurance`, branch `deploy`, and reinstalls it from that branch when the webhook fires. Never point Deployer at `main` (it has no `build/` and includes the dev files). Only push when the user asks. Check a deploy with `gh run list` / `gh run watch`; if the webhook step fails or is skipped, the theme can be redeployed by hand from Deployer for Git → Dashboard → **Deploy Theme**.
-   **Release:** pushing a tag runs `.github/workflows/release.yml`, which builds the theme, zips it as `brilliant-insurance.zip` (root folder `brilliant-insurance/`, same file list and the same verify-dist check as the deploy branch) and publishes a GitHub Release using the `TOKEN` secret. Tags are the plain theme version, no `v` prefix (e.g. `0.2.1`). To release: bump `Version:` in `style.css` and `version` in `package.json`, commit, push `main`, then `git tag <version> && git push origin <version>`.
-   **Version:** the theme version lives in `style.css` (`Version:`); keep `package.json` (and the theme's entries in `package-lock.json`) in step. **Bump the patch version on every CSS change** (theme CSS files, `theme.json` styles, block styles), in the same commit, so browsers and caches pick up the new styles (WordPress versions the theme's stylesheets with it).
-   **Repo secrets:** `TOKEN` (GitHub token for releases) and `DEPLOYER_WEBHOOK_URL` (the theme's webhook URL from Deployer for Git → Dashboard → "Show webhook URL"). Never print, commit or echo either value.
-   **Where to build designs (global rule, core rule 1):** when the user asks to design a section (or page) from Figma, always build it on the **live site** (https://brilliantinsur.1wp.site), never on the local Studio site. Edit it in the live site's block editor through Claude in Chrome (the user is logged in there), and use the `wp-brilliant-insurance` MCP server (section 0a) for the content reads/writes it supports. Verify the result on the live front end. The image-upload rule in section 6 applies there too (BinsOptimizer is active on the live site). Theme code changes still happen locally, are verified on the local Studio site, and reach the live site by pushing to `main` (core rule 2). If a design needs something the theme can't do yet (a new block, extension, block style or CSS), stop building the page, ask the user for approval (section 5), build and verify it locally, deploy it, then continue on the live page.

## 0a. Live site MCP server (`wp-brilliant-insurance`)

-   **What it is:** the Viagent Production MCP server on the live site (`https://brilliantinsur.1wp.site/wp-json/viagent-production/v1/mcp`), added to Claude Code as `wp-brilliant-insurance` with local scope (`claude mcp add --transport http wp-brilliant-insurance … --header "Authorization: Bearer …"`). The Bearer token lives only in `~/.claude.json`; never write it into this file, the repo or any page. Its tools are named `mcp__wp-brilliant-insurance__*` and load at session start.
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
-   **Header and navigation (Kadence Headers & Navigations, global rule):** the site header is always built with **Kadence Header** and **Kadence Navigation** posts, never core Navigation or a hand-built Row Layout header. A dummy header and dummy navigations were imported on the live site; modify them to match the Figma design (Figma page **↳ Insurance Full Design** → `Navigation States`, plus the navbar at the top of each page frame) instead of creating new ones:
    -   **Header:** Kadence Header "Header" (live #42), edited in its own editor (Kadence → Headers → Header). It is placed by `parts/header.html` (`<!-- wp:kadence/header {"id":…} /-->`); that file still holds the MTY id (192) and must be changed to the live id (42) as a theme change (core rule 2). Header settings are post meta (e.g. `_kad_header_isTransparent`); the Figma header is transparent over the hero, so the first section of every page sits under it and needs enough top padding (see "Page hero"). Logo = core Site Logo, set to the **SVG** logo (section 6, "Logos").
    -   **Navigations:** "Primary" (live #38, desktop) and "Mobile Menu" (live #40, off-canvas) are the ones header #42 uses; both still hold the imported dummy links (an accounting firm's menu) and must be rebuilt with the Figma items. The other imported navigations are unused dummies: a second "Primary" (#34), a second "Mobile Menu" (#24), "Footer" (#36, unused: the footer uses core paragraph links), "About Core" (#30), "Services" (#32), "Industries" (#26), "Resources" (#28); ask before deleting any. Link typography/colours/spacing are navigation post meta (`_kad_navigation_typography`, `_kad_navigation_linkColor…`, `_kad_navigation_spacing`). Every `kadence/navigation-link` needs a `uniqueID`, or Kadence renders the menu empty. Link each item to its page (section 0, the sitemap pages), not a typed URL.
    -   **Figma desktop menu:** About · Workers' Compensation Insurance · Commercial Insurance · Personal Insurance · Contact, then the **Get a Quote** button (default button style). **Figma mobile menu:** full-screen panel with a × close, each item on its own row with a → arrow and a divider; Commercial Insurance and Personal Insurance expand with **+ / −** into the hub link ("COMMERCIAL INSURANCE →", small uppercase, Premier Light) and a plain list of their child pages; Get a Quote button at the bottom.
-   **Footer:** the `footer` template part, customised on the live site (template-part post #67; the theme file `parts/footer.html` is only the fallback). One full-width Kadence Row Layout, `tagName` footer: `bnti-neutral-darkest` background with the faint logo-mark outline SVG (media #65) as background image (contain, right top) and the `bnti-footer-glow` gradient as the overlay with blend mode **lighten** (so the outline shows through). Inside: logo image (SVG #48, 352px) + address + phone link on the left, the five page links (Plain Links group, `bnti-small` 600) on the right (Section `textAlign` right/left/left), then a credits band with a white-20% top rule: license line, © line, Privacy · Terms (Plain Links group), "Powered by" + NEST logo SVG (#66). Edit it in the Site Editor (it holds SVG images, so not through the MCP server). The footer links are core paragraphs, not the imported "Footer" Kadence Navigation (#36).
-   **Mega menus (needed):** the Figma design uses Kadence's native mega menu on **Commercial Insurance** (4 columns: General Liability, Commercial Property & Building, Professional Liability (E&O), Cyber) and **Personal Insurance** (3 columns: Homeowners, Landlord & Rental Property, Personal Umbrella); About, Workers' Compensation and Contact are plain links. Before building any other menu item, check `Navigation States` for whether it opens a panel; add a mega menu only where Figma shows one. Build them the way the MTY project does (see `../mty/`: its `CLAUDE.md` "Mega menus" rule, the "Mega menus" CSS in `assets/css/blocks.css`, which this theme already carries, and its Primary navigation): each mega item has **Mega Menu** on with width **Container** (`"isMegaMenu":true,"megaMenuWidth":"container"`) and holds one Kadence Row Layout: a single Section with the dark panel background (Figma: black fading to navy, use the closest `bnti-*` gradient), a faint 1px border, the hub link ("COMMERCIAL INSURANCE →", a Plain Links Group in small uppercase), a faint separator, and a nested Row Layout of columns. Each column uses core blocks: a heading in Baskervville linked to the child page (with a → on the active/hovered one, Premier Light), a separator and a one-line description (`bnti-small`, muted white). Adjust the MTY panel CSS (colours, + / − sign, active underline) to the Figma panel rather than copying MTY's green; CSS changes go through core rule 2. On mobile the off-canvas **Mobile Menu** uses plain nested links (the hub link plus the child pages) instead of panels.
-   **Team (custom post type `bnti_team`, `inc/team.php`):** carried over from the MTY theme (attorney bio pages with the **Team member** block bindings source `bnti/team` and the **Team Member Page** pattern). The Brilliant Figma design has **no team member pages** (the About page shows a team photo, not bios), so don't use it unless the user asks; if bios are added later, check the Figma design first and update this rule.
-   **Page hero (global rule, the one deliberate exception to the section spacing rules):** the first section of every page is the hero: a Kadence Row Layout with padding **192**/15/**120**/15 on desktop and **217**/15/**56**/15 on tablet and mobile (`"padding":[192,15,120,15],"tabletPadding":[217,"",56,""],"mobilePadding":[217,"",56,""]`), taken from the Figma inner-page heroes, and **no min height** (`"minHeight":0` on every device), so the h1 always starts at the same place whatever the content length (the transparent 80px header sits over the top). The homepage uses the same values (its Figma hero is taller; the user chose consistency). It holds one **h1** (theme size) and a description paragraph in **`bnti-lead`** (fixed 20px), then the button(s), as in Figma; set the h1/description widths with the **Max Width** setting (e.g. homepage h1 900, description 1000) rather than a constrained Group. Heroes sit on a photo with the `bnti-hero-overlay` gradient (`bnti-hero-overlay-mobile` on mobile) and white text. Never use min height to size a hero.
-   **Kadence Row Layout min height** is applied inside the padding: enter the design height minus the top and bottom padding (e.g. hero 980px − 160 − 100 = `"minHeight":720`).
-   **Global rule:** don't give blocks custom names (no `"metadata":{"name":...}`). Leave every block with its default name in the List View; the user renames blocks themselves if needed.

## 2. Block priority

Pick blocks in this order, and move down a level only when the level above can't do the job:

1. **Core WordPress blocks.** These are strongly preferred for all content: headings, paragraphs, buttons, images, lists, query loops and so on.
2. **Custom blocks in the Brilliant Insurance inserter category** (`bnti/*`):
    - Icon (`bnti/icon`)
    - Social Share (`bnti/social-share`)
    - Timeline (`bnti/timeline`, with `bnti/timeline-step` children): a horizontal row of steps joined by a line with square dots, carried over from MTY. **The Brilliant Figma design doesn't use it.** Its process sections ("How do I get … ?", homepage "How It Works") are a title + description and button on the left and a **vertical list of numbered steps** on the right: each step is a **56px round number badge** (the `bnti-premier` gradient, white number, Inter ~20px) beside the step title (**h3 in `bnti-heading-five`**, 28px) and its text (`bnti-medium`, 18px). Build that with core blocks; if the round gradient badge can't be made with block settings, propose a block style for it (section 5, core rule 2) rather than using Timeline.
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
-   **Section title group (global rule):** wrap a section's title and its description (if any) in a **Group** (`core/group`), and put the **50px** space below them on that Group as its bottom margin, never on the heading or on the last paragraph. The Group's **Block spacing is always 12px** (`blockGap: 12px`), whatever spacing Figma shows between title and description; per the block-spacing rule, **leave the title's and description's margins unset** (never 0), or the 12px won't apply. Group: `"style":{"spacing":{"blockGap":"12px","margin":{"top":"0","bottom":"50px"}}}`. This applies on every device, and also when there's only a title (the Group still carries the 50px). The title is always the section's **h2 at the theme's default size** (`bnti-heading-two`, 52px → 40px), even where Figma shows a smaller title (the inner pages use 44px); change it only when a design truly can't work otherwise, and ask first. The description is `bnti-medium` (18px, 16px on mobile); an eyebrow above the title is a paragraph in the **Has Arrow** style (`bnti-small`).
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
-   Cards have a **20px** border radius (Kadence Section → Border Radius), per the global radius rule in section 4.
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
3. **Registered block styles:** Button — Alternative, Outline (core) and Link; List — Mega Links and Mega Links: Large (mega menu link lists); Post Template — **Card Grid** (Query Loop card grids: Grid layout 3 columns, cards stretch to the row height, a lone last card spans the row, 1 column at 1024px and below); Paragraph — **Has Arrow** (the Figma section eyebrow, e.g. "What We Cover": a corner arrow 16px after the text, in the text colour; set the paragraph to `bnti-small` like the design); Group — Wrap Mobile and Plain Links (links inside aren't underlined; use it for link lists like "On this page"). Links inherit their text's font, weight and line-height, so set the weight on the paragraph, not the link.
4. **The theme's editor extensions:**
    - Highlight (not used in the Brilliant Figma design, whose headings are one colour; don't add coloured words unless a page shows them) (rich text format: the **Highlight** button with the "A" icon in its own group on the block toolbar, next to Bold/Italic; not core's "Highlight" in the More menu). Makes the selected words semi-bold (600) in `bnti-premier`; another Brilliant Insurance colour can be picked in its popover. If a design does colour words in a heading, use it for them; never colour or bold those words by hand.
    - Hover Color
    - Text Max Width (Heading/Paragraph → **Max Width**, px; full width under 768px): use it to give left-aligned titles and descriptions their Figma text width (e.g. section h2 700px) instead of a constrained Group; centred title groups keep a centred constrained Group
    - Iconic Button (Icon Settings panel on a Button: add an SVG icon before/after the label)
    - Group Full Height, Group Overlay Background and Group Global Hover
    - Image Figure Frame (Image → Settings → **Figure Frame**; not used in this design, see section 6)
    - Pointer (Group and Kadence Section → Settings → **Pointer**; carried over from MTY, **not used in the Brilliant Figma design**): image "callouts", a 1px white line from the block's edge ending in a dot, pointing at the image beside it. Desktop only (hidden at 1024px and below), so nothing to do for mobile. Put it on the **text side** (e.g. the boxed title Group, or the text column), never on the image, so it stays level with the text. Settings: Direction (Right/Left, towards the image), Length (px, dot included), Vertical position (Middle, or px From top), Size (**Large**: 18px dot with a ring; **Small**: 10px white dot).
    - Kadence Featured Image Background (Row Layout)

**Border radius (global rule):** the Brilliant Figma design is **rounded**, and every element of a kind uses one radius (core rule 3): **cards, boxes and panels with a background or border: 20px** (also on mobile); **small inner cards** (cards nested inside a card or panel, e.g. the "An agent" / "Brilliant Premier Insurance." comparison rows, mega menu panel items): **16px**; **images and videos: 20px**; **buttons: 8px** (set by the theme; leave the button's radius setting empty); **number badges: fully round**. Sections themselves (top-level Row Layouts) are never rounded. Set the radius in the block's Border settings (Kadence Section: Border Radius), never with custom CSS.

## 5. No custom CSS or JS without permission

-   **Never** add custom CSS or JavaScript without asking the user first and getting a clear yes. This covers theme files, block "Additional CSS", inline `style` attributes that go beyond block settings, `theme.json` `css` fields, and new scripts.
-   If a design can't be built with the rules above, stop. Explain what's missing and propose the CSS/JS change, then wait for approval.
-   Approved CSS/JS goes into the theme files, never into the live site's Additional CSS or a block's custom CSS: build it locally, verify it on the local Studio site, then push to deploy it (core rule 2).

## 6. Images, Icons, Content

-   use exact text used in figma design
-   take each page's images from that page's section in the Figma file (or its Assets section, if the page has one)
-   for Icons, always use SVG codes
-   **Uploading images (global rule):** the site uses **BinsOptimizer**, which converts images to WebP and compresses them **in the browser**, before the upload reaches the server. It hooks the block editor's `mediaUpload` setting. So:
    -   **Never** upload images with `studio wp media import`, the REST API directly, the `wp-brilliant-insurance` MCP upload tools (`upload_media_from_url`, `upload_media_base64`), or by copying files into `uploads/`. Those skip BinsOptimizer and leave JPEG/PNG files unconverted.
    -   Upload through the block editor in the browser (Claude in Chrome), using the wrapped `mediaUpload` function:
        1. Make the source file fetchable by the browser: on the local site, put it in a temporary folder under `wp-content/uploads/` (e.g. `claude-upload-tmp/`); on the live site, use a URL the editor page can `fetch` (the same site, or a host that allows cross-origin requests; test it first, because Figma asset URLs may be blocked by CORS).
        2. Open any post or page in the editor and wait until `wp.data.select('core/block-editor').getSettings().mediaUpload.__biioWrapped` is `true`.
        3. Fetch the file as a blob, wrap it in a `File` with the right name and type, and call `mediaUpload({ filesList: [file], allowedTypes: ['image'], onFileChange, onError })`. Use the returned `id` and `url` (they end in `.webp`) in the blocks.
        4. Delete the temporary folder afterwards.
    -   Check the result: the attachment's file should be `.webp` and it should have `_biio_savings` / `_biio_optimized_at` meta.
-   **"vs" badge:** a Group with the `bnti-vs-badge` class (64px circle in `bnti-neutral-darkest`, 6px border in the section background colour, "vs" in Baskervville `bnti-title`, white), placed as the last block of the first of two cards; the theme CSS centres it on the gap between them (and between the stacked cards on tablet/mobile).
-   **Logos are SVG (global rule):** every logo (the header Site Logo, the footer logo, the logo mark, partner/carrier logos…) is an **SVG file**, never PNG/JPG/WebP. Export it from Figma as SVG (the logo node, no background, text outlined), keep its exact colours, and upload it through the block editor's media upload like any image (Media Library or the block's Upload): **BinsOptimizer** has SVG support enabled, so it accepts and sanitises SVG uploads (and leaves them as SVG rather than converting to WebP). Use the uploaded SVG in the Site Logo block (or an Image block) and set its width there; give it alt text with the company name. Don't paste logo SVG code into Icon or Custom HTML blocks, and don't upload logos through the MCP upload tools or WP-CLI.
-   **Icon block defaults** (carried over from MTY; the Brilliant Figma pages have no boxed card icons so far): a **20px** icon, white (`bnti-white`), centred in a **45×45px** box with a `bnti-premier` background and **10px** radius. When a Figma page does show an icon, match its size and box from Figma (once, then reuse it everywhere, core rule 3) and record it here. Set only the desktop size (`"sizes":{"Desktop":20},"iconSize":20`); tablet and mobile inherit it.
-   **Icon + title gap (global rule):** when an Icon block shows a title next to the icon, the gap between them is always **16px** (`"listGap":"16px"`). If you set it by script, also set `blockStyle["--list-gap"]` to `"16px"`: the block only recalculates `blockStyle` when it renders in the editor, so changing `listGap` alone can leave the old gap in the saved markup.
-   **Figure frame:** carried over from MTY. **The Brilliant Figma design doesn't use it** (its images are plain photos with **20px rounded corners**, no "FIG." labels, ticks or overlay), so leave Figure Frame off. If a page ever shows the figure style, recreate it with the Image block's **Figure Frame** panel (Settings tab), never with custom markup or CSS:
    -   Turn on **Enable figure frame** and type the number from the design into **FIG value** (e.g. `02` shows "FIG. 02"). Leave the value empty if the design shows no label.
    -   Switch off **Border**, **Corner ticks** or **Dark overlay** when the design leaves them out.
    -   Core Image and **Post Featured Image** blocks have the panel. Images used as Kadence Section backgrounds can't be framed. On Post Featured Image (Query Loop cards, e.g. Our Team headshots) **Post title as label** shows "[HEADSHOT: NAME]" (prefix editable; the editor shows "Post title" in its place), and a post without a featured image shows an empty faint box (White 5%) with the ticks at the block's height.
-   never create custom image without permission

## 7. Color, Typography

-   always use Brilliant Insurance color and typography presets
-   never use custom color and typography without permission
-   never use letter spacing without permission
-   **never use a custom line-height.** Headings and body text always use the theme's line-heights (1.2 and 1.5), even if the Figma value differs.
-   **Never set a custom bottom margin on headings.** All headings get a **12px** bottom margin (and 0 top margin) from the theme (`style.css`); paragraphs get 16px. The only exception is a Kadence Section's Vertical Gap (section 3a), where headings are set to 0 margin; inside a core block's Block spacing, leave heading margins unset.
-   **h1 and h2 always use the theme's default font size** (`bnti-heading-one` / `bnti-heading-two`). Never set a custom or different font size on an h1 or h2, and never change the heading level to match a Figma size: section titles stay h2 at the default size even where Figma shows them smaller (e.g. 44px on inner pages). Only change it when it's truly needed, and ask the user first.

**Colours** (`bnti-*`, from the Figma file's colour variables and paint styles):

| Role                                        | Preset                                                                       | Value     |
| ------------------------------------------- | ---------------------------------------------------------------------------- | --------- |
| Primary / buttons / icon boxes / link hover | `bnti-premier` (Figma `Premier Primary`)                                     | `#214280` |
| Button hover / dark brand sections          | `bnti-premier-dark` (Figma `Premier Dark`)                                   | `#132548` |
| Brand tone in gradients                     | `bnti-premier-deep`                                                          | `#1B3669` |
| Light accent on dark sections               | `bnti-premier-light`                                                         | `#8DB5FF` |
| Menu hover / open item (header, mega menus) | `bnti-premier-soft` (Figma nav active colour)                                | `#9DB8EC` |
| Site background (body)                      | `bnti-white`                                                                 | `#FFFFFF` |
| Headings and links                          | `bnti-ink`                                                                   | `#111111` |
| Body text                                   | `bnti-text`                                                                  | `#4A4A4A` |
| Borders and dividers on light sections      | `bnti-gray-100` (Figma `Gray-100`)                                           | `#E6E6E6` |
| Light section background                    | `bnti-neutral-lightest`                                                      | `#F2F2F2` |
| Neutrals                                    | `bnti-white`, `bnti-neutral-lightest` … `bnti-neutral-darkest` (#000)        |           |
| Red accent (Crown of Thorns scale)          | `bnti-crown-of-thorns-lightest` … `-darkest`, `bnti-darker-thorn`            | `#7A1E2B` |
| Transparent overlays                        | `bnti-white-5` … `-60`, `bnti-white-80` (menu links), `bnti-neutral-darkest-5` … `-60`, `bnti-transparent` |           |

Gradients (`bnti-*`, taken from the gradients used in the Figma pages):

| Preset                     | Use in Figma                                                  | Value                                         |
| -------------------------- | ------------------------------------------------------------- | --------------------------------------------- |
| `bnti-premier`             | Buttons, CTA bands, Takeaways cards (the main brand gradient) | 180°, #214280 37.5% → #132548                 |
| `bnti-premier-angled`      | Mobile CTA bands                                              | 79°, #214280 56.9% → #132548 92.63%           |
| `bnti-premier-radial`      | The logo mark (round)                                         | radial, #214280 57.44% → #132548              |
| `bnti-midnight`            | Dark "Promises" / "Why choose us" sections                    | 180°, #000 → #0B0B0B 50% → #1B3669            |
| `bnti-hero-overlay`        | Inner page hero overlay on the photo, desktop                 | radial from the left, black 80% → #1B3669 80% |
| `bnti-hero-overlay-mobile` | The same, mobile                                              | black 86% 45.67% → #1B3669 86%                |
| `bnti-footer-glow`         | Footer background (navy glow rising from the bottom)          | radial at 50% 124%, black / #1B3669 / black   |
| `bnti-thorn-radial`        | Red shape in the footer                                       | radial, #9D272D 67% → #5E0000                 |

The site is **light by default**: the body background is white, headings and links are `bnti-ink` and text is `bnti-text`. On a dark section (`bnti-neutral-darkest`, `bnti-premier-dark`, a gradient or an image) set the heading and text colours to `bnti-white` (muted text `bnti-white-60`) on the block.

**Typography:**

-   **Headings (h1–h6):** Baskervville, weight **400 (Regular)**, line-height **1.2**, colour `bnti-ink` (white on dark sections). Headings in the Figma design are one colour and weight; don't colour or bold parts of them.
-   **Body and paragraphs:** Inter, **16px** (`bnti-regular`), weight **400**, line-height **1.5**, colour `bnti-text`. Links are `bnti-ink` and turn `bnti-premier` on hover.
-   **Fonts are self-hosted** variable woff2 files in `assets/fonts/` (Baskervville 400–700, Inter 100–900, normal and italic, Latin subset).
-   **Heading and large text sizes are fluid** (Figma mobile → desktop size, scaling between the 393px and 1440px viewports of the Figma frames):

| Preset               | Element     | Size      |
| -------------------- | ----------- | --------- |
| `bnti-heading-one`   | h1          | 48 → 72px |
| `bnti-heading-two`   | h2          | 40 → 52px |
| `bnti-heading-three` | h3          | 32 → 44px |
| `bnti-heading-four`  | h4          | 24 → 36px |
| `bnti-heading-five`  | h5          | 20 → 28px |
| `bnti-heading-six`   | h6          | 18 → 22px |
| `bnti-large`         | Text Large  | 18 → 22px |
| `bnti-medium`        | Text Medium | 16 → 18px |

-   **Fixed text sizes:** `bnti-title` 24px, `bnti-lead` 20px (hero descriptions), `bnti-regular` 16px (body), `bnti-small` 14px, `bnti-x-small` 12px. Fixed means not fluid: a custom size typed on a block (e.g. 20px) is turned into a fluid `clamp()` by WordPress, so always use these presets for fixed sizes.

**Buttons** (core Button block):

-   **Default (primary):** the Figma `CTA` button: the **`bnti-premier` gradient** (#214280 to 37.5%, then to #132548, top to bottom), white text, **8px radius**, padding 12px 24px (set as 11px 23px plus a 1px transparent border), Inter 16px (`bnti-regular`) / **500** / 1.5, sentence case, no letter spacing, **no arrow**, and the **`bnti-cta` shadow** (`11px 8px 41px 2px` #F2F2F2 at 25%). Hover: everything stays the same except the gradient, which smoothly rotates from 180° to 0° (bottom to top) over 0.3s; the angle is the registered `--bnti-button-angle` property (blocks.css, "Button hover").
-   **Alternative:** the Figma `Button` (the CTA's white twin): white background, 1px `bnti-premier-dark` border and text, same size, radius and type as default, no gradient or shadow. Hover (its hover variant): the `bnti-premier` gradient fades in behind the label (over the border) and the text turns white. Goes full width on tablet/mobile.
-   **Outline:** same size and type as default but transparent, no gradient or shadow, with a 1px `currentColor` border, white text (for dark or image backgrounds) and an automatic **→ arrow** (Inter 16px / 400, 12px gap). Hover turns text and border `bnti-premier`.
-   Don't set colours, gradients, shadows, radius or typography on individual buttons; the theme's button styles already match Figma.
-   All buttons transition over 0.3s `cubic-bezier(0.4, 0, 0.2, 1)` (colour, border and the gradient angle), and not at all for visitors who prefer reduced motion.
-   **Button icons:** the outline button already shows the → arrow. Only when the design shows an icon on a button, turn on **Icon Settings → Add Icon to Button** and paste the SVG code (save it to My Icons); that icon replaces the arrow. It follows the text colour, sizes to the text (1em) and sits **10px** from the label; leave Size/Gap empty unless the design differs.
