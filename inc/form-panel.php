<?php
/**
 * Quote form panel: the slide-in form every "Get a quote" / "Contact" button
 * opens, and its settings page (Appearance → Quote Form).
 *
 * There is no Contact page. Any link or button whose URL is `#bnti-contact`
 * (or that carries `data-open="bnti-contact"`) opens the panel, which holds a
 * Gravity Form chosen by shortcode. Ported from the Tiny Steps theme.
 *
 * Options:
 *   bnti_phone_number      – Phone shown in the panel header
 *   bnti_form_shortcode    – Form shortcode, e.g. [gravityform id="1" title="false" ajax="true"]
 *   bnti_form_title        – Panel heading
 *   bnti_form_description  – Paragraph(s) under the heading, one per line
 *   bnti_form_note         – Small print under the form
 *
 * @package Brilliant_Insurance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Enqueue front-end assets ───────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'bnti_form_panel_assets' );

function bnti_form_panel_assets() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'bnti-form-panel',
		get_theme_file_uri( 'assets/css/form-panel.css' ),
		array( 'bnti-gravity-forms' ),
		$version
	);

	wp_enqueue_script(
		'bnti-form-panel',
		get_theme_file_uri( 'assets/js/form-panel.js' ),
		array(),
		$version,
		true
	);
}

// ── Inject panel HTML into every page footer ───────────────────────────────────

add_action( 'wp_footer', 'bnti_form_panel_html' );

function bnti_form_panel_html() {
	$phone       = get_option( 'bnti_phone_number', '' );
	$shortcode   = get_option( 'bnti_form_shortcode', '' );
	$title       = get_option( 'bnti_form_title', __( 'Get a quote', 'brilliant-insurance' ) );
	$description = get_option( 'bnti_form_description', '' );
	$note        = get_option( 'bnti_form_note', '' );

	// Nothing to show until a form is chosen.
	if ( ! $shortcode ) {
		return;
	}
	?>
	<div id="bnti-form-overlay" class="bnti-form-overlay" aria-hidden="true"></div>

	<div
		id="bnti-contact"
		class="bnti-form-panel"
		role="dialog"
		aria-modal="true"
		aria-label="<?php echo esc_attr( $title ? $title : __( 'Get a quote', 'brilliant-insurance' ) ); ?>"
		aria-hidden="true"
		inert
	>
		<div class="bnti-form-panel__header">
			<?php if ( $phone ) : ?>
			<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>" class="bnti-form-panel__phone">
				<?php echo esc_html( $phone ); ?>
			</a>
			<?php else : ?>
			<span></span>
			<?php endif; ?>

			<button type="button" class="bnti-form-panel__close" aria-label="<?php esc_attr_e( 'Close form', 'brilliant-insurance' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</button>
		</div>

		<div class="bnti-form-panel__body">
			<?php if ( $title ) : ?>
				<h2 class="bnti-form-panel__title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<div class="bnti-form-panel__desc">
					<?php
					// Each line of the description is its own paragraph.
					foreach ( preg_split( '/\R+/', trim( $description ) ) as $line ) {
						echo '<p>' . esc_html( $line ) . '</p>';
					}
					?>
				</div>
			<?php endif; ?>

			<?php echo do_shortcode( $shortcode ); ?>

			<?php if ( $note ) : ?>
				<p class="bnti-form-panel__note"><?php echo esc_html( $note ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

// ── Register settings ──────────────────────────────────────────────────────────

add_action( 'admin_init', 'bnti_form_register_settings' );

function bnti_form_register_settings() {
	$text = array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	);

	register_setting( 'bnti_form_group', 'bnti_phone_number', $text );
	register_setting( 'bnti_form_group', 'bnti_form_shortcode', $text );
	register_setting( 'bnti_form_group', 'bnti_form_note', $text );
	register_setting(
		'bnti_form_group',
		'bnti_form_title',
		array_merge( $text, array( 'default' => __( 'Get a quote', 'brilliant-insurance' ) ) )
	);
	register_setting(
		'bnti_form_group',
		'bnti_form_description',
		array_merge( $text, array( 'sanitize_callback' => 'sanitize_textarea_field' ) )
	);
}

// ── Add menu page under Appearance ────────────────────────────────────────────

add_action( 'admin_menu', 'bnti_form_add_menu' );

function bnti_form_add_menu() {
	add_theme_page(
		__( 'Quote Form Settings', 'brilliant-insurance' ),
		__( 'Quote Form', 'brilliant-insurance' ),
		'manage_options',
		'bnti-form',
		'bnti_form_render_page'
	);
}

// ── Enqueue admin assets on the settings page ─────────────────────────────────

add_action( 'admin_enqueue_scripts', 'bnti_form_admin_assets' );

function bnti_form_admin_assets( $hook ) {
	if ( 'appearance_page_bnti-form' !== $hook ) {
		return;
	}

	wp_enqueue_script(
		'bnti-form-settings',
		get_theme_file_uri( 'assets/js/form-settings.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}

// ── Render settings page ───────────────────────────────────────────────────────

function bnti_form_render_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$fields = array(
		'bnti_form_title'       => array(
			'label'       => __( 'Title', 'brilliant-insurance' ),
			'description' => __( 'Heading at the top of the panel.', 'brilliant-insurance' ),
		),
		'bnti_form_description' => array(
			'label'       => __( 'Description', 'brilliant-insurance' ),
			'description' => __( 'Text under the heading. Each line becomes its own paragraph.', 'brilliant-insurance' ),
			'textarea'    => true,
		),
		'bnti_phone_number'     => array(
			'label'       => __( 'Phone number', 'brilliant-insurance' ),
			'description' => __( 'Shown as a call link in the panel header. Leave empty to hide it.', 'brilliant-insurance' ),
		),
		'bnti_form_shortcode'   => array(
			'label'       => __( 'Form shortcode', 'brilliant-insurance' ),
			'description' => __( 'e.g. [gravityform id="1" title="false" description="false" ajax="true"]. The panel is hidden while this is empty.', 'brilliant-insurance' ),
		),
		'bnti_form_note'        => array(
			'label'       => __( 'Note', 'brilliant-insurance' ),
			'description' => __( 'Small print under the form. Leave empty to hide it.', 'brilliant-insurance' ),
		),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Quote Form Settings', 'brilliant-insurance' ); ?></h1>

		<?php settings_errors( 'bnti_form_group' ); ?>

		<div style="background:#f0f6fc;border-left:4px solid #2271b1;border-radius:0 4px 4px 0;padding:14px 18px;margin:16px 0 24px;max-width:600px;">
			<p style="margin:0 0 8px;font-weight:600;color:#1d2327;">
				<?php esc_html_e( 'How to open the quote form', 'brilliant-insurance' ); ?>
			</p>
			<p style="margin:0 0 10px;color:#3c434a;font-size:13px;">
				<?php esc_html_e( 'Use this as the link URL of any button, menu item or text link:', 'brilliant-insurance' ); ?>
			</p>
			<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
				<code style="background:#1d2327;color:#7dd3fc;padding:6px 14px;border-radius:4px;font-size:14px;user-select:all;">#bnti-contact</code>
				<button
					type="button"
					class="bnti-copy-button"
					data-copy="#bnti-contact"
					data-label="<?php esc_attr_e( 'Copy', 'brilliant-insurance' ); ?>"
					data-copied="<?php esc_attr_e( '✓ Copied!', 'brilliant-insurance' ); ?>"
					style="background:#2271b1;color:#fff;border:none;border-radius:4px;padding:5px 14px;font-size:13px;cursor:pointer;"
				><?php esc_html_e( 'Copy', 'brilliant-insurance' ); ?></button>
			</div>
		</div>

		<form method="post" action="options.php">
			<?php settings_fields( 'bnti_form_group' ); ?>

			<table class="form-table" role="presentation">
				<?php foreach ( $fields as $name => $field ) : ?>
				<tr>
					<th scope="row">
						<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					</th>
					<td>
						<?php if ( ! empty( $field['textarea'] ) ) : ?>
							<textarea id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" class="large-text" rows="3"><?php echo esc_textarea( get_option( $name, '' ) ); ?></textarea>
						<?php else : ?>
							<input type="text" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( get_option( $name, '' ) ); ?>" class="regular-text" />
						<?php endif; ?>
						<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
