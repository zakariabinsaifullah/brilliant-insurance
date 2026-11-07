<?php
/**
 * Brilliant Insurance — theme documentation page (Appearance → Brilliant Insurance).
 *
 * A guide to what the theme adds (Brilliant Insurance blocks, editor extensions,
 * block styles, the posts grid shortcode and the quote form panel), written for
 * whoever is building pages rather than for a developer. Keep it in step with
 * src/blocks, src/extensions, inc/block-styles.php, inc/shortcode.php and
 * inc/form-panel.php.
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
			<?php esc_html_e( 'A quick guide to what this theme adds: the Brilliant Insurance blocks, the extra settings on core blocks, the block styles, the posts grid shortcode and the quote form.', 'brilliant-insurance' ); ?>
		</p>

		<!-- ── Brilliant Insurance blocks ────────────────────────────────── -->
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
						__( 'An SVG icon, optionally with a title beside it. Paste SVG code or pick an icon from the library; icons you paste can be saved under <strong>My Icons</strong> and reused anywhere on the site.', 'brilliant-insurance' ),
					),
					array(
						__( 'Social Share', 'brilliant-insurance' ),
						__( 'Copy-link, LinkedIn, X and Facebook buttons for the current post. Used in the single post template.', 'brilliant-insurance' ),
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
				<?php esc_html_e( 'The theme adds these options to core blocks. Select the block and look in its sidebar.', 'brilliant-insurance' ); ?>
			</p>

			<?php
			bnti_docs_info_table(
				array(
					array(
						__( 'Icon Settings', 'brilliant-insurance' ),
						__( 'Button. Turn on <strong>Add Icon to Button</strong> and paste SVG code when the design shows an icon on a button (for example the arrow on Link buttons). The icon follows the text colour and sits 10px from the label.', 'brilliant-insurance' ),
					),
					array(
						__( 'Max Width', 'brilliant-insurance' ),
						__( 'Heading and Paragraph. Limits how wide the text runs (in px), so long lines wrap where the design wraps them. Full width under 768px.', 'brilliant-insurance' ),
					),
					array(
						__( 'Full Height', 'brilliant-insurance' ),
						__( 'Group. Stretches the group to the height of its column.', 'brilliant-insurance' ),
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
						__( '<strong>Default</strong>: the blue gradient button. <strong>Alternative</strong>: white with a dark blue border, for gradient sections such as the CTA. <strong>Outline</strong>: transparent with a thin border and a → arrow, for dark or photo backgrounds. <strong>Link</strong>: a blue text link with a line under it.', 'brilliant-insurance' ),
					),
					array(
						__( 'Paragraph', 'brilliant-insurance' ),
						__( '<strong>Has Arrow</strong>: the small section label (eyebrow) with a corner arrow after it.', 'brilliant-insurance' ),
					),
					array(
						__( 'List', 'brilliant-insurance' ),
						__( '<strong>Dots</strong> (the “Key takeaways” list), <strong>Mega Links</strong> and <strong>Mega Links: Large</strong> (link lists in the mega menu panels).', 'brilliant-insurance' ),
					),
					array(
						__( 'Post Template', 'brilliant-insurance' ),
						__( '<strong>Card Grid</strong>, for Query Loop card grids: three columns of equal-height cards, one column on tablet and mobile.', 'brilliant-insurance' ),
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

		<!-- ── Quote form ─────────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2>
				<?php
				printf(
					'<a href="%s">%s</a>',
					esc_url( admin_url( 'themes.php?page=bnti-form' ) ),
					esc_html__( 'Quote form', 'brilliant-insurance' )
				);
				?>
			</h2>
			<p>
				<?php esc_html_e( 'There is no Contact page. Every “Get a quote” and “Contact” link opens the slide-in quote form. Its title, text, phone number and Gravity Form are set in Appearance → Quote Form. To open it from any button, menu item or text link, use this as the link URL:', 'brilliant-insurance' ); ?>
			</p>
			<?php bnti_docs_code( '#bnti-contact' ); ?>
		</div>

		<!-- ── Posts grid ─────────────────────────────────────────────────── -->
		<div class="bnti-docs-section">
			<h2><?php esc_html_e( 'Posts grid', 'brilliant-insurance' ); ?> <code>[bnti_posts_grid]</code></h2>

			<p>
				<?php esc_html_e( 'A grid of post cards with category filters and page numbers. Clicking a category or a page number swaps the cards in place, without reloading the page. Add it to a page with a Shortcode block. The blog, archive, search and 404 templates use it too.', 'brilliant-insurance' ); ?>
			</p>

			<?php bnti_docs_code( '[bnti_posts_grid]', __( 'Simplest version: six posts per page, every category, with filters.', 'brilliant-insurance' ) ); ?>

			<h3><?php esc_html_e( 'Attributes', 'brilliant-insurance' ); ?></h3>

			<?php
			bnti_docs_attr_table(
				array(
					array( 'per_page', '6', __( 'How many posts each page of the grid shows (up to 50).', 'brilliant-insurance' ) ),
					array( 'categories', '', __( 'Comma-separated category IDs or slugs. Limits both the posts shown and the filter buttons. Leave empty for every category with posts except Uncategorized.', 'brilliant-insurance' ) ),
					array( 'title', '', __( 'Optional heading above the filters, as an <code>h2</code>.', 'brilliant-insurance' ) ),
					array( 'filters', 'true', __( '<code>false</code> hides the category filter buttons.', 'brilliant-insurance' ) ),
					array( 'pagination', 'true', __( '<code>false</code> hides the article count and page numbers.', 'brilliant-insurance' ) ),
					array( 'exclude', '', __( 'Comma-separated post IDs to leave out, or <code>current</code> for the post being viewed.', 'brilliant-insurance' ) ),
					array( 'context', '', __( '<code>auto</code> lists the current category, tag, author or search results instead of every post (used by the templates).', 'brilliant-insurance' ) ),
					array( 'empty', '', __( 'Message shown when there are no matching posts.', 'brilliant-insurance' ) ),
					array( 'post_type', 'post', __( 'Comma-separated post types to list.', 'brilliant-insurance' ) ),
				)
			);
			?>

			<h3><?php esc_html_e( 'Examples', 'brilliant-insurance' ); ?></h3>

			<?php
			bnti_docs_code( '[bnti_posts_grid per_page="9"]', __( 'The Blog page: nine posts per page.', 'brilliant-insurance' ) );
			bnti_docs_code( '[bnti_posts_grid categories="business-insurance,workers-compensation"]', __( 'Only two categories, by slug.', 'brilliant-insurance' ) );
			bnti_docs_code( '[bnti_posts_grid per_page="3" exclude="current" filters="false" pagination="false"]', __( 'Three other posts, no filters or page numbers (the “More articles” row under a post).', 'brilliant-insurance' ) );
			?>

			<h3><?php esc_html_e( 'What it shows', 'brilliant-insurance' ); ?></h3>
			<ul class="bnti-docs-list">
				<li><?php esc_html_e( 'Each card: featured image (left out if the post has none), category and date, title, a short excerpt and a “Read more” link.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Three columns on desktop, one on tablet and mobile. On small screens the category filters scroll sideways.', 'brilliant-insurance' ); ?></li>
				<li><?php esc_html_e( 'Under the cards: a count (“Showing 9 of 16 articles”) with the page numbers opposite it.', 'brilliant-insurance' ); ?></li>
			</ul>
		</div>
	</div>
	<?php
}
