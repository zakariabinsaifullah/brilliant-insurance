( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		// ── Initialise AJAX fetch for a grid wrapper ─────────────────────────
		function initGrid( wrapper ) {
			var config       = JSON.parse( wrapper.dataset.config || '{}' );
			var postsEl      = wrapper.querySelector( '.ipg-posts' );
			var paginationEl = wrapper.querySelector( '.ipg-pagination-wrap' );
			var countEl      = wrapper.querySelector( '.ipg-count-wrap' );
			var state        = { cat: 0, page: 1 };
			var loading      = false;

			function fetchPosts( scroll ) {
				if ( loading ) return;
				loading = true;
				wrapper.classList.add( 'is-loading' );

				// Everything that shaped the first render goes back with each
				// request, so page 2 of a category or a search stays in it.
				var body = new URLSearchParams( {
					action:     'bnti_posts_grid',
					nonce:      config.nonce,
					cat:        state.cat,
					page:       state.page,
					per_page:   config.perPage    || 6,
					post_type:  config.postType   || 'post',
					taxonomy:   config.taxonomy   || 'category',
					categories: config.categories || '',
					term_tax:   config.termTax    || '',
					term_id:    config.termId     || 0,
					author:     config.author     || 0,
					search:     config.search     || '',
					exclude:    config.exclude    || '',
					empty:      config.empty      || '',
				} );

				fetch( config.ajaxUrl, { method: 'POST', body: body } )
					.then( function ( r ) { return r.json(); } )
					.then( function ( data ) {
						if ( data.success ) {
							postsEl.innerHTML = data.data.html;
							if ( paginationEl ) {
								paginationEl.innerHTML = data.data.pagination;
							}
							if ( countEl ) {
								countEl.innerHTML = data.data.count || '';
							}
							bindPagination();
							if ( scroll ) {
								wrapper.scrollIntoView( { behavior: 'smooth', block: 'start' } );
							}
						}
					} )
					.finally( function () {
						loading = false;
						wrapper.classList.remove( 'is-loading' );
					} );
			}

			function bindPagination() {
				if ( ! paginationEl ) return;
				paginationEl.querySelectorAll( '.ipg-page-btn' ).forEach( function ( btn ) {
					btn.addEventListener( 'click', function () {
						state.page = parseInt( this.dataset.page, 10 );
						fetchPosts( true );
					} );
				} );
			}

			bindPagination();

			return { state: state, fetch: fetchPosts };
		}


		// ── Grids: the filter tabs sit inside the grid's own header ──────────
		document.querySelectorAll( '.ipg-wrapper' ).forEach( function ( wrapper ) {
			var grid = initGrid( wrapper );

			wrapper.querySelectorAll( '.ipg-filter-btn' ).forEach( function ( btn ) {
				btn.addEventListener( 'click', function () {
					wrapper.querySelectorAll( '.ipg-filter-btn' ).forEach( function ( b ) {
						b.classList.remove( 'active' );
						b.setAttribute( 'aria-pressed', 'false' );
					} );
					this.classList.add( 'active' );
					this.setAttribute( 'aria-pressed', 'true' );
					grid.state.cat  = parseInt( this.dataset.cat || '0', 10 );
					grid.state.page = 1;
					grid.fetch( false );
				} );
			} );
		} );

	} );
}() );
