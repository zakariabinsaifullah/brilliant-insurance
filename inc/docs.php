<?php
/**
 * Brilliant Insurance — theme documentation page (Appearance → Brilliant Insurance).
 *
 * A guide to what the theme adds (Brilliant Insurance blocks, editor extensions, block styles,
 * team members, posts grid shortcode, contact panel), written for whoever is
 * building pages rather than for a developer. Keep it in step with the blocks,
 * src/extensions, inc/block-styles.php, inc/team.php and inc/shortcode.php.
 *
 * @package Brilliant_Insurance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Add menu page under Appearance ────────────────────────────────────────────

add_action( 'admin_menu', 'bnti_docs_add_menu' );

function bnti_docs_add_menu() {
	add_theme_page(
		__( 'Brilliant Insurance', 'brilliant-insurance' ),
		__( 'Brilliant Insurance', 'brilliant-insurance' ),
		'manage_options',
		'bnti-docs',
		'bnti_docs_render_page'
	);
}

// ── Enqueue admin assets on the docs page ─────────────────────────────────────

add_action( 'admin_enqueue_scripts', 'bnti_docs_admin_assets' );

function bnti_docs_admin_assets( $hook ) {
	if ( 'appearance_page_bnti-docs' !== $hook ) {
		return;
	}

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'bnti-docs',
		get_theme_file_uri( 'assets/css/admin-docs.css' ),
		array(),
		$version
	);

	// Generic `.bnti-copy-button` handler.
	wp_enqueue_script(
		'bnti-copy-button',
		get_theme_file_uri( 'assets/js/copy-button.js' ),
		array(),
		$version,
		true
	);
}

// ── Render helpers ────────────────────────────────────────────────────────────

if ( ! function_exists( 'bnti_docs_code' ) ) :
	/**
	 * Outputs a copyable code sample.
	 *
	 * @param string $code  The snippet.
	 * @param string $label Optional caption shown above the snippet.
	 */
	function bnti_docs_code( $code, $label = '' ) {
		?>
		<div class="bnti-docs-code">
			<?php if ( $label ) : ?>
				<p class="bnti-docs-code__label"><?php echo esc_html( $label ); ?></p>
			<?php endif; ?>
			<div class="bnti-docs-code__row">
				<code><?php echo esc_html( $code ); ?></code>
				<button
					type="button"
					class="button bnti-copy-button"
					data-copy="<?php echo esc_attr( $code ); ?>"
					data-label="<?php esc_attr_e( 'Copy', 'brilliant-insurance' ); ?>"
					data-copied="<?php esc_attr_e( '✓ Copied!', 'brilliant-insurance' ); ?>"
				><?php esc_html_e( 'Copy', 'brilliant-insurance' ); ?></button>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'bnti_docs_attr_table' ) ) :
	/**
	 * Outputs an attribute (or setting) reference table.
	 *
	 * @param array $rows    Each row: array( name, default, description ).
	 * @param array $headers Optional column headings; when given, the names are
	 *                       shown as plain text rather than code (for settings).
	 */
	function bnti_docs_attr_table( $rows, $headers = array() ) {
		$is_code = empty( $headers );
		$headers = $is_code ? array( __( 'Attribute', 'brilliant-insurance' ), __( 'Default', 'brilliant-insurance' ), __( 'What it does', 'brilliant-insurance' ) ) : $headers;
		?>
		<table class="widefat striped bnti-docs-table">
			<thead>
				<tr>
					<?php foreach ( $headers as $header ) : ?>
						<th scope="col"><?php echo esc_html( $header ); ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $rows as $row ) : ?>
					<tr>
						<td>
							<?php if ( $is_code ) : ?>
								<code><?php echo esc_html( $row[0] ); ?></code>
							<?php else : ?>
								<strong><?php echo esc_html( $row[0] ); ?></strong>
							<?php endif; ?>
						</td>
						<td>
							<?php if ( '' === $row[1] ) : ?>
								<span class="bnti-docs-empty"><?php esc_html_e( 'empty', 'brilliant-insurance' ); ?></span>
							<?php else : ?>
								<code><?php echo esc_html( $row[1] ); ?></code>
							<?php endif; ?>
						</td>
						<td><?php echo wp_kses_post( $row[2] ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}
endif;

if ( ! function_exists( 'bnti_docs_info_table' ) ) :
	/**
	 * Outputs a two-column "name → what it does" table.
	 *
	 * @param array $rows    Each row: array( name, description ). The description
	 *                       may contain inline HTML (<code>, <a>, <strong>).
	 * @param array $headers The two column headings.
	 */
	function bnti_docs_info_table( $rows, $headers ) {
		?>
		<table class="widefat striped bnti-docs-table">
			<thead>
				<tr>
					<?php foreach ( $headers as $header ) : ?>
						<th scope="col"><?php echo esc_html( $header ); ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $rows as $row ) : ?>
					<tr>
						<td><strong><?php echo esc_html( $row[0] ); ?></strong></td>
						<td><?php echo wp_kses_post( $row[1] ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}
endif;

// ── Render docs page ──────────────────────────────────────────────────────────

function bnti_docs_render_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap bnti-docs">
		<h1><?php esc_html_e( 'Brilliant Insurance', 'brilliant-insurance' ); ?></h1>
		<p class="bnti-docs-intro">
			<?php esc_html_e( 'A quick guide to what this theme adds: the Brilliant Insurance blocks, the extra settings on core blocks, the block styles, team member pages, the posts grid shortcode and the contact panel.', 'brilliant-insurance' ); ?>
		</p>

		<!-- ── Brilliant Insurance blocks ────────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2><?php esc_html_e( 'Brilliant Insurance blocks', 'brilliant-insurance' ); ?></h2>
			<p>
				<?php esc_html_e( 'Find these in the block inserter under the Brilliant Insurance category.', 'brilliant-insurance' ); ?>
			</p>

			<?php
			bnti_docs_info_table(
				array(
					array(
						__( 'Icon', 'brilliant-insurance' ),
						__( 'An SVG icon, by default 20px and white in a 45×45px green box, optionally with a title beside it. Paste SVG code or pick an icon from the library; icons you paste can be saved under <strong>My Icons</strong> and reused anywhere on the site.', 'brilliant-insurance' ),
					),
					array(
						__( 'Timeline', 'brilliant-insurance' ),
						__( 'A row of numbered steps joined by one line, each marked by a square dot, with any blocks (number, heading, text) below each dot. Set the number of steps, columns, gaps and colours in the sidebar, and turn on <strong>Highlight step</strong> on the step to highlight. <strong>Highlight line</strong> makes that step’s line a thicker progress bar; <strong>Highlight on hover</strong> moves the highlight to the step under the mouse. On tablet and mobile the steps stack as a plain list.', 'brilliant-insurance' ),
					),
					array(
						__( 'Rating', 'brilliant-insurance' ),
						__( 'A star rating, optionally with the rating number beside it.', 'brilliant-insurance' ),
					),
					array(
						__( 'Social Share', 'brilliant-insurance' ),
						__( 'Sharing buttons for the current post, for single post templates.', 'brilliant-insurance' ),
					),
				),
				array( __( 'Block', 'brilliant-insurance' ), __( 'What it does', 'brilliant-insurance' ) )
			);
			?>
		</div>

		<!-- ── Extra block settings ──────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2><?php esc_html_e( 'Extra block settings', 'brilliant-insurance' ); ?></h2>
			<p>
				<?php esc_html_e( 'The theme adds these options to core and Kadence blocks. Select the block and look in its sidebar (or toolbar, for Highlight).', 'brilliant-insurance' ); ?>
			</p>

			<?php
			bnti_docs_info_table(
				array(
					array(
						__( 'Highlight', 'brilliant-insurance' ),
						__( 'Text toolbar, the “A” button next to Bold and Italic. Makes the selected words semi-bold and green, as in “Meet <strong>James.</strong>”. Another Brilliant Insurance colour can be picked in its popover. Use it for coloured words in headings instead of colouring them by hand.', 'brilliant-insurance' ),
					),
					array(
						__( 'Figure Frame', 'brilliant-insurance' ),
						__( 'Image and Post Featured Image → Settings. The framed look from the design: a faint border, a dark overlay, white corner ticks and a “FIG. 02” label. Type the number into <strong>FIG value</strong> (leave it empty for no label) and switch off the parts the design leaves out. On Post Featured Image, <strong>Post title as label</strong> shows “[HEADSHOT: NAME]”, and a post without an image shows an empty framed box.', 'brilliant-insurance' ),
					),
					array(
						__( 'Pointer', 'brilliant-insurance' ),
						__( 'Group and Kadence Section → Settings. A thin white line from the block’s edge ending in a dot, pointing at the image beside it. Add it to the text side, not the image. Choose the direction, length, vertical position and size (Large: 18px dot with a green ring; Small: 10px white dot). Shown on desktop only.', 'brilliant-insurance' ),
					),
					array(
						__( 'Icon Settings', 'brilliant-insurance' ),
						__( 'Button. Buttons already end in a → arrow; turn on <strong>Add Icon to Button</strong> and paste SVG code only when the design shows a different icon, which then replaces the arrow.', 'brilliant-insurance' ),
					),
					array(
						__( 'Hover Color', 'brilliant-insurance' ),
						__( 'Any block with colour settings. Text, background and border colours on hover, and how fast they change.', 'brilliant-insurance' ),
					),
					array(
						__( 'Text Max Width', 'brilliant-insurance' ),
						__( 'Heading and Paragraph. Limits how wide the text runs, so long lines wrap where the design wraps them.', 'brilliant-insurance' ),
					),
					array(
						__( 'Full Height, Overlay Background, Global Hover', 'brilliant-insurance' ),
						__( 'Group. Stretch the group to its column’s height, lay a colour or gradient over its background, and change the colours of everything inside when the whole group is hovered (for example, a card).', 'brilliant-insurance' ),
					),
					array(
						__( 'Featured Image Background', 'brilliant-insurance' ),
						__( 'Kadence Row Layout. Uses the current post’s featured image as the row’s background.', 'brilliant-insurance' ),
					),
				),
				array( __( 'Setting', 'brilliant-insurance' ), __( 'Where and what it does', 'brilliant-insurance' ) )
			);
			?>
		</div>

		<!-- ── Block styles ──────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2><?php esc_html_e( 'Block styles', 'brilliant-insurance' ); ?></h2>
			<p>
				<?php esc_html_e( 'Pick these under Styles in the block’s sidebar.', 'brilliant-insurance' ); ?>
			</p>

			<?php
			bnti_docs_info_table(
				array(
					array(
						__( 'Button', 'brilliant-insurance' ),
						__( '<strong>Default</strong>: green, uppercase, square, with a → arrow. <strong>Outline</strong>: the same with a transparent background and a thin border, for dark or image backgrounds. <strong>Alternative</strong>: light green background with dark green text. <strong>Link</strong>: a text link with the arrow.', 'brilliant-insurance' ),
					),
					array(
						__( 'List', 'brilliant-insurance' ),
						__( '<strong>Mega Links</strong> and <strong>Mega Links: Large</strong>, for the link lists in the mega menu panels.', 'brilliant-insurance' ),
					),
					array(
						__( 'Post Template', 'brilliant-insurance' ),
						__( '<strong>Card Grid</strong>, for Query Loop card grids: three columns of equal-height cards, a lone last card fills the row, one column on tablet and mobile.', 'brilliant-insurance' ),
					),
					array(
						__( 'Group', 'brilliant-insurance' ),
						__( '<strong>Plain Links</strong> (links inside aren’t underlined, e.g. an “On this page” list) and <strong>Wrap Mobile</strong> (a row that wraps on mobile).', 'brilliant-insurance' ),
					),
					array(
						__( 'Accordion', 'brilliant-insurance' ),
						__( '<strong>Numbered</strong>: numbers each item.', 'brilliant-insurance' ),
					),
				),
				array( __( 'Block', 'brilliant-insurance' ), __( 'Styles', 'brilliant-insurance' ) )
			);
			?>
		</div>

		<!-- ── Team members ──────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2>
				<?php
				printf(
					'<a href="%s">%s</a>',
					esc_url( admin_url( 'edit.php?post_type=bnti_team' ) ),
					esc_html__( 'Team members', 'brilliant-insurance' )
				);
				?>
			</h2>
			<p>
				<?php esc_html_e( 'Each attorney has their own page at /team/name/, built in the block editor like any page.', 'brilliant-insurance' ); ?>
			</p>

			<h3><?php esc_html_e( 'Adding a team member', 'brilliant-insurance' ); ?></h3>
			<ol class="bnti-docs-list bnti-docs-list--ordered">
				<li><?php esc_html_e( 'Go to Team → Add Team Member. Choose the Team Member Page layout when it is offered.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Title: the full name. Excerpt: the short bio shown on team cards. Featured image: the headshot. Page Attributes → Order: their place in the team list.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Fill in the Team details panel in the sidebar. The page’s name, intro line and facts fill themselves in from it, so don’t retype them.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Edit, remove or duplicate the middle sections to match their page in the design, and renumber the “01 / 07” labels.', 'brilliant-insurance' ); ?></li>
			</ol>

			<?php
			bnti_docs_info_table(
				array(
					array( __( 'Short name', 'brilliant-insurance' ), __( 'First name used in links, e.g. “Read <strong>James’s</strong> bio”.', 'brilliant-insurance' ) ),
					array( __( 'Highlighted name', 'brilliant-insurance' ), __( 'The part of the name shown in green, e.g. “Laura, Jr.”. Leave empty to highlight the last word.', 'brilliant-insurance' ) ),
					array( __( 'Position, Office', 'brilliant-insurance' ), __( 'Shown above the name, e.g. “Founder, Fairhope, Alabama”.', 'brilliant-insurance' ) ),
					array( __( 'Role, Licensed in, Cases, Practicing since', 'brilliant-insurance' ), __( 'The facts listed under the bio hero.', 'brilliant-insurance' ) ),
				),
				array( __( 'Team detail', 'brilliant-insurance' ), __( 'Where it shows', 'brilliant-insurance' ) )
			);
			?>

			<div class="bnti-docs-note">
				<p>
					<?php esc_html_e( 'To show a detail in any block, connect the block to the “Team member” source (block bindings) rather than typing it. This works on the member’s page and inside a Query Loop of team members.', 'brilliant-insurance' ); ?>
				</p>
			</div>
		</div>

		<!-- ── Posts grid ─────────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2><?php esc_html_e( 'Posts grid', 'brilliant-insurance' ); ?> <code>[bnti_posts_grid]</code></h2>

			<p>
				<?php esc_html_e( 'A filterable, paginated grid of posts. Clicking a category or a page number swaps the cards in place, without reloading the page. Add it to a page with a Shortcode block.', 'brilliant-insurance' ); ?>
			</p>

			<?php bnti_docs_code( '[bnti_posts_grid]', __( 'Simplest version: six posts, all categories, heading “All Insights.”', 'brilliant-insurance' ) ); ?>

			<h3><?php esc_html_e( 'Attributes', 'brilliant-insurance' ); ?></h3>

			<?php
			bnti_docs_attr_table(
				array(
					array(
						'title',
						'All Insights.',
						__( 'Heading shown at the top left, opposite the category links, as an <code>h2</code>. Pass <code>title=""</code> to leave it out.', 'brilliant-insurance' ),
					),
					array(
						'per_page',
						'6',
						__( 'How many posts each page of the grid shows. Anything above 50 is capped at 50.', 'brilliant-insurance' ),
					),
					array(
						'categories',
						'',
						__( 'Comma-separated category IDs or slugs. Limits both the posts shown and the category links offered. Leave empty to use every category that has posts.', 'brilliant-insurance' ),
					),
					array(
						'post_type',
						'post',
						__( 'Which post type to list. Falls back to <code>post</code> if the name is not a registered post type.', 'brilliant-insurance' ),
					),
				)
			);
			?>

			<h3><?php esc_html_e( 'Examples', 'brilliant-insurance' ); ?></h3>

			<?php
			bnti_docs_code(
				'[bnti_posts_grid title="Latest articles." per_page="9"]',
				__( 'Nine posts per page with a different heading.', 'brilliant-insurance' )
			);

			bnti_docs_code(
				'[bnti_posts_grid categories="personal-injury,car-accidents"]',
				__( 'Only two categories, by slug (use your own category slugs or IDs).', 'brilliant-insurance' )
			);

			bnti_docs_code(
				'[bnti_posts_grid title=""]',
				__( 'No heading, category links only.', 'brilliant-insurance' )
			);
			?>

			<h3><?php esc_html_e( 'What it shows', 'brilliant-insurance' ); ?></h3>
			<ul class="bnti-docs-list">
				<li><?php esc_html_e( 'Each card: featured image (left out if the post has none), category, title and a “Read More” button.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Three columns on desktop, one on tablet and mobile. On small screens the category links scroll sideways.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Under the cards: a count (“Showing 9 of 16 articles”) with the page numbers opposite it.', 'brilliant-insurance' ); ?></li>
			</ul>
		</div>
	</div>
	<?php
}
