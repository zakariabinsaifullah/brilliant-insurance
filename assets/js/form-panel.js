/**
 * Quote form panel (inc/form-panel.php).
 *
 * Opens from any `a[href$="#bnti-contact"]` or `[data-open="bnti-contact"]`,
 * closes on the × button, the overlay or Escape, and locks the page scroll
 * while open. Focus moves into the panel and returns to the trigger.
 */
( function () {
	'use strict';

	const PANEL_ID = 'bnti-contact';
	const OVERLAY_ID = 'bnti-form-overlay';
	const OPEN_CLASS = 'is-open';
	const LOCK_CLASS = 'bnti-panel-open';
	const TRIGGER = 'a[href$="#' + PANEL_ID + '"], [data-open="' + PANEL_ID + '"]';

	let lastTrigger = null;

	function panel() {
		return document.getElementById( PANEL_ID );
	}

	function overlay() {
		return document.getElementById( OVERLAY_ID );
	}

	// A Contact item in the mobile menu sits inside Kadence's off-canvas: close
	// that first so the two panels don't stack.
	function closeKadenceOffCanvas() {
		document
			.querySelectorAll( '.wp-block-kadence-off-canvas.active .kb-off-canvas-close' )
			.forEach( ( button ) => button.click() );
	}

	function openPanel() {
		const p = panel();
		const o = overlay();
		if ( ! p || ! o ) {
			return;
		}

		closeKadenceOffCanvas();

		p.removeAttribute( 'inert' );
		p.setAttribute( 'aria-hidden', 'false' );
		p.classList.add( OPEN_CLASS );
		o.classList.add( OPEN_CLASS );
		document.body.classList.add( LOCK_CLASS );

		// The panel is `visibility: hidden` until the open class is applied, so
		// wait a frame before moving focus into it.
		const closeBtn = p.querySelector( '.bnti-form-panel__close' );
		if ( closeBtn ) {
			window.requestAnimationFrame( () => closeBtn.focus( { preventScroll: true } ) );
		}
	}

	function closePanel() {
		const p = panel();
		const o = overlay();
		if ( ! p || ! o ) {
			return;
		}

		p.classList.remove( OPEN_CLASS );
		o.classList.remove( OPEN_CLASS );
		document.body.classList.remove( LOCK_CLASS );
		p.setAttribute( 'aria-hidden', 'true' );
		p.setAttribute( 'inert', '' );

		if ( lastTrigger ) {
			lastTrigger.focus( { preventScroll: true } );
		}
		lastTrigger = null;
	}

	// Capture phase, so the panel opens even where another script (e.g. a menu)
	// stops the click from bubbling.
	document.addEventListener(
		'click',
		function ( e ) {
			const trigger = e.target.closest( TRIGGER );
			if ( ! trigger || ! panel() ) {
				return;
			}
			e.preventDefault();
			lastTrigger = trigger;
			openPanel();
		},
		true
	);

	document.addEventListener( 'click', function ( e ) {
		if ( e.target.closest( '.bnti-form-panel__close' ) || e.target === overlay() ) {
			closePanel();
		}
	} );

	document.addEventListener( 'keydown', function ( e ) {
		const p = panel();
		if ( e.key === 'Escape' && p && p.classList.contains( OPEN_CLASS ) ) {
			closePanel();
		}
	} );

	// A shared link to /…#bnti-contact opens the panel on load.
	if ( window.location.hash === '#' + PANEL_ID ) {
		window.addEventListener( 'DOMContentLoaded', openPanel );
	}
} )();
