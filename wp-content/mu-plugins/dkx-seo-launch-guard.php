<?php
/**
 * Plugin Name: DK Expressions SEO Launch Guard
 * Description: Guarantees self-referencing canonicals during staging noindex mode and corrects Open Graph type for WordPress pages without duplicating production Yoast canonicals.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve the canonical URL from the editable DK SEO Manager first, then the
 * locked Master SEO layer, then WordPress itself.
 */
function dkx_launch_guard_canonical() {
	if ( is_singular( array( 'page', 'post' ) ) ) {
		$post_id = get_queried_object_id();
		if ( $post_id && function_exists( 'dkx_seom_get' ) ) {
			$seo = dkx_seom_get( $post_id );
			if ( ! empty( $seo['canonical'] ) ) {
				return esc_url_raw( $seo['canonical'] );
			}
		}
	}

	if ( function_exists( 'dkx_master_canonical_url' ) ) {
		$url = dkx_master_canonical_url();
		if ( $url ) {
			return esc_url_raw( $url );
		}
	}

	if ( is_singular() ) {
		$url = get_permalink( get_queried_object_id() );
		return $url ? esc_url_raw( $url ) : '';
	}

	if ( is_front_page() ) {
		return esc_url_raw( home_url( '/' ) );
	}

	return '';
}

/**
 * Yoast intentionally suppresses canonical output when WordPress is globally
 * set to Discourage search engines (blog_public = 0). Staging uses that mode.
 * Emit exactly one canonical only in that staging/noindex state so the launch
 * crawl can validate canonical targets. Once blog_public becomes 1 at launch,
 * this output stops and Yoast resumes sole ownership of the canonical tag.
 */
add_action( 'wp_head', function() {
	if ( is_admin() || ! defined( 'WPSEO_VERSION' ) || (int) get_option( 'blog_public' ) !== 0 ) {
		return;
	}

	$url = dkx_launch_guard_canonical();
	if ( ! $url ) {
		return;
	}

	echo '<link rel="canonical" href="' . esc_url( $url ) . '" data-dkx-staging-canonical="1">' . "\n";
}, 2 );

/** Commercial/static WordPress pages are website pages, not articles. */
add_filter( 'wpseo_opengraph_type', function( $type ) {
	if ( is_page() ) {
		return 'website';
	}
	return $type;
}, 2200 );
