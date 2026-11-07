<?php
/**
 * Posts Grid Shortcode
 *
 * Renders a filterable, paginated post grid via AJAX. Used by the Blog page,
 * the archive/search/blog-home templates (context="auto") and the "More
 * articles" row under a single post.
 *
 * Usage:
 *   [bnti_posts_grid]                                   all categories, tabs + pagination
 *   [bnti_posts_grid per_page="9" categories="news"]    some categories only
 *   [bnti_posts_grid context="auto" filters="false"]    the current archive or search
 *   [bnti_posts_grid per_page="3" exclude="current" filters="false" pagination="false"]
 *
 * @package Brilliant_Insurance
 */

// =============================================================================
// Asset enqueueing
// =============================================================================

if ( ! function_exists( 'bnti_posts_grid_enqueue_assets' ) ) :
	function bnti_posts_grid_enqueue_assets() {
		wp_enqueue_style(
			'bnti-posts-grid',
			get_theme_file_uri( 'assets/css/shortcode.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_script(
			'bnti-posts-grid',
			get_theme_file_uri( 'assets/js/shortcode.js' ),
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
endif;


// =============================================================================
// Helpers
// =============================================================================

if ( ! function_exists( 'bnti_posts_grid_render_post_item' ) ) :
	/**
	 * Renders a single post card: image, category and date, title, a short
	 * excerpt and a "Read more →" link.
	 *
	 * @param int    $post_id  Post ID.
	 * @param string $taxonomy Taxonomy used for the category label.
	 */
	function bnti_posts_grid_render_post_item( $post_id, $taxonomy = 'category' ) {
		$post = get_post( $post_id );
		if ( ! $post ) {
			return '';
		}

		$permalink = get_permalink( $post );
		$title     = get_the_title( $post );
		$thumbnail = has_post_thumbnail( $post )
			? get_the_post_thumbnail( $post, 'medium_large', array( 'loading' => 'lazy' ) )
			: '';

		// Category (first term of the resolved taxonomy); pages have none.
		$terms    = taxonomy_exists( $taxonomy ) ? get_the_terms( $post, $taxonomy ) : false;
		$cat_name = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';

		$excerpt = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post ) ), 22, '…' );

		$html = '<article class="ipg-card' . ( $thumbnail ? '' : ' ipg-card--no-image' ) . '">';

		if ( $thumbnail ) {
			$html .= '<a href="' . esc_url( $permalink ) . '" class="ipg-card__image" tabindex="-1" aria-hidden="true">' . $thumbnail . '</a>';
		}

		$html .= '<div class="ipg-card__body">';
		$html .= '<div class="ipg-card__text">';

		$html .= '<p class="ipg-card__meta">';
		if ( $cat_name ) {
			$html .= '<span class="ipg-card__category">' . esc_html( $cat_name ) . '</span>';
		}
		if ( 'post' === $post->post_type ) {
			$html .= '<time class="ipg-card__date" datetime="' . esc_attr( get_the_date( 'c', $post ) ) . '">' . esc_html( get_the_date( '', $post ) ) . '</time>';
		}
		$html .= '</p>';

		$html .= '<h3 class="ipg-card__title"><a href="' . esc_url( $permalink ) . '">' . esc_html( $title ) . '</a></h3>';

		if ( $excerpt ) {
			$html .= '<p class="ipg-card__excerpt">' . esc_html( $excerpt ) . '</p>';
		}

		$html .= '</div>';

		$html .= '<a class="ipg-card__button" href="' . esc_url( $permalink ) . '" aria-label="' . esc_attr(
			/* translators: %s: post title. */
			sprintf( __( 'Read more: %s', 'brilliant-insurance' ), wp_strip_all_tags( $title ) )
		) . '">' . esc_html__( 'Read more', 'brilliant-insurance' )
			. '<span class="ipg-card__arrow" aria-hidden="true">&rarr;</span>'
			. '</a>';

		$html .= '</div>';
		$html .= '</article>';

		return $html;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_render_posts' ) ) :
	/**
	 * Renders the full grid of post cards for a given WP_Query.
	 *
	 * @param WP_Query $query    The query to render.
	 * @param string   $taxonomy Taxonomy used for the category label.
	 * @param string   $empty    Message shown when nothing matches.
	 */
	function bnti_posts_grid_render_posts( $query, $taxonomy = 'category', $empty = '' ) {
		if ( ! $query->have_posts() ) {
			$empty = $empty ? $empty : __( 'No articles yet. Check back soon.', 'brilliant-insurance' );
			return '<p class="ipg-no-posts">' . esc_html( $empty ) . '</p>';
		}

		$html = '<div class="ipg-grid">';

		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= bnti_posts_grid_render_post_item( get_the_ID(), $taxonomy );
		}

		$html .= '</div>';

		wp_reset_postdata();

		return $html;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_resolve_category_ids' ) ) :
	/**
	 * Resolves a comma-separated list of term IDs/slugs into an array of term IDs.
	 */
	function bnti_posts_grid_resolve_category_ids( $categories_raw, $taxonomy ) {
		$ids = array();

		foreach ( array_filter( array_map( 'trim', explode( ',', (string) $categories_raw ) ), 'strlen' ) as $token ) {
			$term = is_numeric( $token )
				? get_term_by( 'id', (int) $token, $taxonomy )
				: get_term_by( 'slug', sanitize_title( $token ), $taxonomy );

			if ( $term && ! is_wp_error( $term ) ) {
				$ids[] = (int) $term->term_id;
			}
		}

		return array_unique( $ids );
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_query_args' ) ) :
	/**
	 * Builds the WP_Query arguments shared by the first render and the AJAX
	 * requests, so a page fetched later matches the one rendered first.
	 *
	 * @param array $p {
	 *     @type string[] $post_types Post types to list.
	 *     @type int      $per_page   Posts per page.
	 *     @type int      $page       Page number.
	 *     @type string   $taxonomy   Taxonomy of the filter tabs.
	 *     @type int      $cat        Selected tab's term ID (0 = all).
	 *     @type int[]    $allowed    Term IDs the grid is limited to (empty = no limit).
	 *     @type string   $term_tax   Archive term's taxonomy (context="auto").
	 *     @type int      $term_id    Archive term ID (context="auto").
	 *     @type int      $author     Author archive user ID (context="auto").
	 *     @type string   $search     Search terms (context="auto").
	 *     @type int[]    $exclude    Post IDs to leave out.
	 * }
	 * @return array
	 */
	function bnti_posts_grid_query_args( $p ) {
		$args = array(
			'post_type'           => $p['post_types'],
			'posts_per_page'      => $p['per_page'],
			'paged'               => $p['page'],
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);

		$tax_query = array();

		if ( $p['cat'] > 0 ) {
			$tax_query[] = array(
				'taxonomy' => $p['taxonomy'],
				'field'    => 'term_id',
				'terms'    => $p['cat'],
			);
		} elseif ( ! empty( $p['allowed'] ) ) {
			$tax_query[] = array(
				'taxonomy' => $p['taxonomy'],
				'field'    => 'term_id',
				'terms'    => $p['allowed'],
			);
		}

		if ( $p['term_id'] && taxonomy_exists( $p['term_tax'] ) ) {
			$tax_query[] = array(
				'taxonomy' => $p['term_tax'],
				'field'    => 'term_id',
				'terms'    => $p['term_id'],
			);
		}

		if ( $tax_query ) {
			$args['tax_query'] = $tax_query;
		}

		if ( $p['author'] ) {
			$args['author'] = $p['author'];
		}

		if ( '' !== $p['search'] ) {
			$args['s'] = $p['search'];
		}

		if ( ! empty( $p['exclude'] ) ) {
			$args['post__not_in'] = $p['exclude'];
		}

		return $args;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_pagination_range' ) ) :
	/**
	 * Returns an array of page numbers and '...' placeholders.
	 * Always shows first/last page and current page ± 1 neighbour.
	 */
	function bnti_posts_grid_pagination_range( $total_pages, $current_page ) {
		$total_pages  = (int) $total_pages;
		$current_page = (int) $current_page;

		if ( $total_pages <= 7 ) {
			return range( 1, $total_pages );
		}

		$left  = max( 2, $current_page - 1 );
		$right = min( $total_pages - 1, $current_page + 1 );
		$pages = array( 1 );

		if ( $left > 2 ) {
			$pages[] = '...';
		}

		for ( $i = $left; $i <= $right; $i++ ) {
			$pages[] = $i;
		}

		if ( $right < $total_pages - 1 ) {
			$pages[] = '...';
		}

		$pages[] = $total_pages;

		return $pages;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_render_pagination' ) ) :
	/**
	 * Renders numbered page buttons with ellipsis, bookended by Prev/Next steps.
	 *
	 * Prev and Next are text buttons rather than arrows, and each is omitted at
	 * the end of the range it points past (so page 1 opens with "1 2 3 Next").
	 */
	function bnti_posts_grid_render_pagination( $total_pages, $current_page ) {
		$total_pages  = (int) $total_pages;
		$current_page = (int) $current_page;

		if ( $total_pages <= 1 ) {
			return '';
		}

		$html = '<nav class="ipg-pagination" aria-label="' . esc_attr__( 'Articles pages', 'brilliant-insurance' ) . '">';

		if ( $current_page > 1 ) {
			$html .= '<button type="button" class="ipg-page-btn ipg-page-step" data-page="' . ( $current_page - 1 ) . '" aria-label="' . esc_attr__( 'Previous page', 'brilliant-insurance' ) . '">'
				. '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Prev', 'brilliant-insurance' )
				. '</button>';
		}

		foreach ( bnti_posts_grid_pagination_range( $total_pages, $current_page ) as $page ) {
			if ( '...' === $page ) {
				$html .= '<span class="ipg-page-ellipsis">&hellip;</span>';
			} else {
				$active = ( (int) $page === $current_page );
				$html  .= '<button type="button" class="ipg-page-btn' . ( $active ? ' active' : '' ) . '" data-page="' . (int) $page . '"'
					. ( $active ? ' aria-current="page"' : '' )
					/* translators: %d: page number. */
					. ' aria-label="' . esc_attr( sprintf( __( 'Page %d', 'brilliant-insurance' ), (int) $page ) ) . '">' . (int) $page . '</button>';
			}
		}

		if ( $current_page < $total_pages ) {
			$html .= '<button type="button" class="ipg-page-btn ipg-page-step" data-page="' . ( $current_page + 1 ) . '" aria-label="' . esc_attr__( 'Next page', 'brilliant-insurance' ) . '">'
				. esc_html__( 'Next', 'brilliant-insurance' ) . ' <span aria-hidden="true">&rarr;</span>'
				. '</button>';
		}

		$html .= '</nav>';

		return $html;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_render_count' ) ) :
	/**
	 * Renders the "Showing N of M articles" line that sits opposite the pagination.
	 *
	 * @param WP_Query $query The query the current page was rendered from.
	 */
	function bnti_posts_grid_render_count( $query ) {
		$total = (int) $query->found_posts;

		if ( ! $total ) {
			return '';
		}

		return '<p class="ipg-count">'
			/* translators: 1: number of posts on this page, 2: total number of posts. */
			. sprintf( esc_html__( 'Showing %1$d of %2$d articles', 'brilliant-insurance' ), (int) $query->post_count, $total )
			. '</p>';
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_post_types' ) ) :
	/**
	 * Sanitises a comma-separated list of post types; unknown ones are dropped.
	 *
	 * @param string $raw Comma-separated post type names.
	 * @return string[]
	 */
	function bnti_posts_grid_post_types( $raw ) {
		$types = array_filter(
			array_map( 'sanitize_key', explode( ',', (string) $raw ) ),
			'post_type_exists'
		);

		return $types ? array_values( $types ) : array( 'post' );
	}
endif;


// =============================================================================
// AJAX handler
// =============================================================================

if ( ! function_exists( 'bnti_posts_grid_ajax' ) ) :
	function bnti_posts_grid_ajax() {
		check_ajax_referer( 'bnti_posts_grid_nonce', 'nonce' );

		$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_key( $_POST['taxonomy'] ) : 'category';
		if ( ! taxonomy_exists( $taxonomy ) ) {
			$taxonomy = 'category';
		}

		$ids = static function ( $key ) {
			return isset( $_POST[ $key ] )
				? array_values( array_filter( array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) ) ) ) )
				: array();
		};

		$page = isset( $_POST['page'] ) ? max( 1, absint( $_POST['page'] ) ) : 1;

		$params = array(
			'post_types' => bnti_posts_grid_post_types( isset( $_POST['post_type'] ) ? sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) : 'post' ),
			'per_page'   => isset( $_POST['per_page'] ) ? min( 50, max( 1, absint( $_POST['per_page'] ) ) ) : 6,
			'page'       => $page,
			'taxonomy'   => $taxonomy,
			'cat'        => isset( $_POST['cat'] ) ? absint( $_POST['cat'] ) : 0,
			'allowed'    => $ids( 'categories' ),
			'term_tax'   => isset( $_POST['term_tax'] ) ? sanitize_key( $_POST['term_tax'] ) : '',
			'term_id'    => isset( $_POST['term_id'] ) ? absint( $_POST['term_id'] ) : 0,
			'author'     => isset( $_POST['author'] ) ? absint( $_POST['author'] ) : 0,
			'search'     => isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '',
			'exclude'    => $ids( 'exclude' ),
		);

		$query = new WP_Query( bnti_posts_grid_query_args( $params ) );
		$empty = isset( $_POST['empty'] ) ? sanitize_text_field( wp_unslash( $_POST['empty'] ) ) : '';

		wp_send_json_success( array(
			'html'         => bnti_posts_grid_render_posts( $query, $taxonomy, $empty ),
			'pagination'   => bnti_posts_grid_render_pagination( (int) $query->max_num_pages, $page ),
			'count'        => bnti_posts_grid_render_count( $query ),
			'total_pages'  => (int) $query->max_num_pages,
			'current_page' => $page,
		) );
	}
endif;
add_action( 'wp_ajax_bnti_posts_grid', 'bnti_posts_grid_ajax' );
add_action( 'wp_ajax_nopriv_bnti_posts_grid', 'bnti_posts_grid_ajax' );


// =============================================================================
// Shortcode
// =============================================================================

if ( ! function_exists( 'bnti_posts_grid_resolve_taxonomy' ) ) :
	/**
	 * Returns the primary hierarchical taxonomy for a post type.
	 */
	function bnti_posts_grid_resolve_taxonomy( $post_type ) {
		foreach ( get_object_taxonomies( $post_type, 'objects' ) as $tax ) {
			if ( $tax->public && $tax->hierarchical ) {
				return $tax->name;
			}
		}
		return 'category';
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_resolve_allowed_cats' ) ) :
	/**
	 * Resolves allowed category IDs, falling back to all non-empty terms except
	 * the default "Uncategorized" one.
	 */
	function bnti_posts_grid_resolve_allowed_cats( $categories_raw, $taxonomy ) {
		$ids = bnti_posts_grid_resolve_category_ids( $categories_raw, $taxonomy );

		if ( empty( $ids ) ) {
			$exclude = 'category' === $taxonomy ? array( (int) get_option( 'default_category' ) ) : array();
			$all     = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
					'fields'     => 'ids',
					'exclude'    => $exclude,
				)
			);
			$ids     = is_wp_error( $all ) ? array() : array_map( 'intval', $all );
		}

		return $ids;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_render_tabs' ) ) :
	/**
	 * Renders the filter tab buttons for a given set of terms.
	 *
	 * @param array $terms Array of WP_Term objects.
	 */
	function bnti_posts_grid_render_tabs( $terms ) {
		if ( count( $terms ) < 2 ) {
			return '';
		}

		$html  = '<div class="ipg-nav" role="group" aria-label="' . esc_attr__( 'Filter articles by topic', 'brilliant-insurance' ) . '">';
		$html .= '<button type="button" class="ipg-filter-btn active" data-cat="0" aria-pressed="true">' . esc_html__( 'All', 'brilliant-insurance' ) . '</button>';
		foreach ( $terms as $term ) {
			$html .= '<button type="button" class="ipg-filter-btn" data-cat="' . esc_attr( $term->term_id ) . '" aria-pressed="false">' . esc_html( $term->name ) . '</button>';
		}
		$html .= '</div>';

		return $html;
	}
endif;


if ( ! function_exists( 'bnti_posts_grid_shortcode' ) ) :
	/**
	 * [bnti_posts_grid]
	 *
	 * `per_page`   — posts per page (default 6).
	 * `post_type`  — comma-separated post types (default post).
	 * `categories` — comma-separated term IDs or slugs; omit for every category
	 *                except Uncategorized.
	 * `title`      — h2 above the filter tabs (default none).
	 * `filters`    — "false" hides the category tabs.
	 * `pagination` — "false" hides the count and page buttons.
	 * `exclude`    — comma-separated post IDs, or "current" for the post being
	 *                viewed (the "More articles" row under a post).
	 * `context`    — "auto" lists the current archive (category, tag, author)
	 *                or search results instead of all posts.
	 * `empty`      — message when nothing matches.
	 */
	function bnti_posts_grid_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'per_page'   => 6,
				'post_type'  => 'post',
				'categories' => '',
				'title'      => '',
				'filters'    => 'true',
				'pagination' => 'true',
				'exclude'    => '',
				'context'    => '',
				'empty'      => '',
			),
			$atts,
			'bnti_posts_grid'
		);

		$per_page   = min( 50, max( 1, (int) $atts['per_page'] ) );
		$post_types = bnti_posts_grid_post_types( $atts['post_type'] );
		$title      = trim( wp_strip_all_tags( (string) $atts['title'] ) );
		$filters    = 'false' !== strtolower( (string) $atts['filters'] );
		$paginate   = 'false' !== strtolower( (string) $atts['pagination'] );
		$empty      = trim( wp_strip_all_tags( (string) $atts['empty'] ) );
		$taxonomy   = bnti_posts_grid_resolve_taxonomy( $post_types[0] );

		// What the grid is about: the current archive or search, when asked.
		$term_tax = '';
		$term_id  = 0;
		$author   = 0;
		$search   = '';

		if ( 'auto' === $atts['context'] ) {
			if ( is_search() ) {
				$search     = get_search_query( false );
				$post_types = array( 'post', 'page' );
				$filters    = false;
			} elseif ( is_category() || is_tag() || is_tax() ) {
				$term     = get_queried_object();
				$term_tax = $term->taxonomy;
				$term_id  = (int) $term->term_id;
				$filters  = false;
			} elseif ( is_author() ) {
				$author  = (int) get_queried_object_id();
				$filters = false;
			}
		}

		$exclude = array();
		foreach ( array_filter( array_map( 'trim', explode( ',', (string) $atts['exclude'] ) ) ) as $token ) {
			if ( 'current' === $token ) {
				$exclude[] = (int) get_the_ID();
			} else {
				$exclude[] = absint( $token );
			}
		}
		$exclude = array_values( array_filter( $exclude ) );

		// The tab set is only a limit when the grid is a plain post list.
		$allowed = ( $term_id || $author || '' !== $search )
			? array()
			: bnti_posts_grid_resolve_allowed_cats( $atts['categories'], $taxonomy );

		$params = array(
			'post_types' => $post_types,
			'per_page'   => $per_page,
			'page'       => 1,
			'taxonomy'   => $taxonomy,
			'cat'        => 0,
			'allowed'    => $allowed,
			'term_tax'   => $term_tax,
			'term_id'    => $term_id,
			'author'     => $author,
			'search'     => $search,
			'exclude'    => $exclude,
		);

		$query = new WP_Query( bnti_posts_grid_query_args( $params ) );

		bnti_posts_grid_enqueue_assets();

		$config = wp_json_encode( array(
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'nonce'      => wp_create_nonce( 'bnti_posts_grid_nonce' ),
			'perPage'    => $per_page,
			'postType'   => implode( ',', $post_types ),
			'taxonomy'   => $taxonomy,
			'categories' => implode( ',', $allowed ),
			'termTax'    => $term_tax,
			'termId'     => $term_id,
			'author'     => $author,
			'search'     => $search,
			'exclude'    => implode( ',', $exclude ),
			'empty'      => $empty,
		) );

		$html = '<div class="ipg-wrapper" data-config="' . esc_attr( $config ) . '">';

		$tabs = '';
		if ( $filters && ! empty( $allowed ) ) {
			$terms = get_terms( array(
				'taxonomy'   => $taxonomy,
				'include'    => $allowed,
				'orderby'    => 'include',
				'hide_empty' => true,
			) );
			$tabs  = bnti_posts_grid_render_tabs( is_wp_error( $terms ) ? array() : $terms );
		}

		if ( $title || $tabs ) {
			$html .= '<div class="ipg-header">';
			if ( $title ) {
				$html .= '<h2 class="ipg-heading">' . esc_html( $title ) . '</h2>';
			}
			$html .= $tabs;
			$html .= '</div>';
		}

		$html .= '<div class="ipg-posts" aria-live="polite">' . bnti_posts_grid_render_posts( $query, $taxonomy, $empty ) . '</div>';

		if ( $paginate ) {
			$html .= '<div class="ipg-footer">';
			$html .= '<div class="ipg-count-wrap">' . bnti_posts_grid_render_count( $query ) . '</div>';
			$html .= '<div class="ipg-pagination-wrap">' . bnti_posts_grid_render_pagination( (int) $query->max_num_pages, 1 ) . '</div>';
			$html .= '</div>';
		}

		$html .= '</div>';

		wp_reset_postdata();

		return $html;
	}
endif;
add_shortcode( 'bnti_posts_grid', 'bnti_posts_grid_shortcode' );
