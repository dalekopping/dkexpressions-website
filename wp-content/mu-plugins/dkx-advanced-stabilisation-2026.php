<?php
/**
 * Plugin Name: DK Expressions Advanced Stabilisation 2026
 * Description: Rollback-safe front-end technical-debt reduction: consolidates the global CSS chain, defers DK-owned non-critical JavaScript, and prevents duplicate Organization schema output.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Convert relative url(...) references to absolute URLs before a stylesheet is
 * moved into the generated consolidated bundle.
 */
function dkx_adv_css_absolutize_urls( $css, $source_url ) {
	$base = trailingslashit( dirname( $source_url ) );

	return preg_replace_callback(
		'/url\(\s*([\'\"]?)([^\)\'\"]+)\1\s*\)/i',
		function( $matches ) use ( $base ) {
			$url = trim( $matches[2] );
			if ( '' === $url || 0 === strpos( $url, 'data:' ) || 0 === strpos( $url, 'http://' ) || 0 === strpos( $url, 'https://' ) || 0 === strpos( $url, '//' ) || 0 === strpos( $url, '#' ) || 0 === strpos( $url, '/' ) ) {
				return $matches[0];
			}
			return 'url("' . esc_url_raw( $base . $url ) . '")';
		},
		$css
	);
}

/**
 * Build one cached global stylesheet from the six files that every key page
 * previously requested separately. Page-specific CSS remains isolated so the
 * stabilisation does not alter the site's visual cascade unnecessarily.
 */
function dkx_adv_build_core_css_bundle() {
	$release = '1.32.0';
	$upload  = wp_upload_dir();
	if ( ! empty( $upload['error'] ) ) {
		return false;
	}

	$dir = trailingslashit( $upload['basedir'] ) . 'dkx-cache';
	$url = trailingslashit( $upload['baseurl'] ) . 'dkx-cache';
	if ( ! wp_mkdir_p( $dir ) ) {
		return false;
	}

	$sources = array(
		array( 'handle' => 'dkx-parent-style',    'path' => get_template_directory() . '/style.css', 'url' => get_template_directory_uri() . '/style.css' ),
		array( 'handle' => 'dkx-approved-fixes',  'path' => get_stylesheet_directory() . '/style.css', 'url' => get_stylesheet_uri() ),
		array( 'handle' => 'dkx-footer-v1176',    'path' => get_stylesheet_directory() . '/assets/css/footer-v1176.css', 'url' => get_stylesheet_directory_uri() . '/assets/css/footer-v1176.css' ),
		array( 'handle' => 'dkx-enterprise-v115', 'path' => get_stylesheet_directory() . '/assets/enterprise-v115.css', 'url' => get_stylesheet_directory_uri() . '/assets/enterprise-v115.css' ),
		array( 'handle' => 'dkx-branding-v1200',  'path' => get_stylesheet_directory() . '/assets/css/branding-v1200.css', 'url' => get_stylesheet_directory_uri() . '/assets/css/branding-v1200.css' ),
		array( 'handle' => 'dkx-recovery-v1204',  'path' => get_stylesheet_directory() . '/assets/css/recovery-v1204.css', 'url' => get_stylesheet_directory_uri() . '/assets/css/recovery-v1204.css' ),
	);

	$fingerprint_parts = array( $release );
	foreach ( $sources as $source ) {
		if ( ! is_readable( $source['path'] ) ) {
			return false;
		}
		$fingerprint_parts[] = $source['path'] . ':' . filemtime( $source['path'] ) . ':' . filesize( $source['path'] );
	}
	$fingerprint = substr( md5( implode( '|', $fingerprint_parts ) ), 0, 12 );
	$filename    = 'dkx-core-' . $fingerprint . '.css';
	$target      = trailingslashit( $dir ) . $filename;

	if ( ! file_exists( $target ) ) {
		$bundle = "/* DK Expressions consolidated core CSS. Generated automatically. */\n";
		foreach ( $sources as $source ) {
			$css = file_get_contents( $source['path'] );
			if ( false === $css ) {
				return false;
			}
			$bundle .= "\n/* Source: {$source['handle']} */\n";
			$bundle .= dkx_adv_css_absolutize_urls( $css, $source['url'] ) . "\n";
		}
		if ( false === file_put_contents( $target, $bundle, LOCK_EX ) ) {
			return false;
		}
	}

	return array(
		'url'     => trailingslashit( $url ) . $filename,
		'version' => $fingerprint,
		'handles' => wp_list_pluck( $sources, 'handle' ),
	);
}

/**
 * Replace the fragmented global CSS request chain with one generated bundle.
 * The old handles are re-registered as dependency aliases so page-specific
 * styles that depend on them continue to resolve in the same order.
 */
function dkx_adv_consolidate_core_css() {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	$bundle = dkx_adv_build_core_css_bundle();
	if ( ! $bundle ) {
		return; // Fail open: original theme styles remain untouched.
	}

	foreach ( $bundle['handles'] as $handle ) {
		wp_dequeue_style( $handle );
		wp_deregister_style( $handle );
	}

	wp_enqueue_style( 'dkx-core-consolidated', $bundle['url'], array(), $bundle['version'] );

	$dependency = 'dkx-core-consolidated';
	foreach ( $bundle['handles'] as $handle ) {
		wp_register_style( $handle, false, array( $dependency ), $bundle['version'] );
		$dependency = $handle;
	}
}
add_action( 'wp_enqueue_scripts', 'dkx_adv_consolidate_core_css', 10000 );

/**
 * Defer only DK-owned front-end scripts that are already loaded in the footer.
 * This deliberately excludes GTM, consent and third-party embeds because their
 * ordering/consent semantics must be tested independently before alteration.
 */
function dkx_adv_defer_owned_scripts() {
	foreach ( array( 'dkx-mobile-fixes', 'dkx-semantic-highlights', 'dkx-giveaways' ) as $handle ) {
		if ( wp_script_is( $handle, 'registered' ) ) {
			wp_script_add_data( $handle, 'strategy', 'defer' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'dkx_adv_defer_owned_scripts', 10001 );

/**
 * The dedicated handover-schema plugin owns Organization/LocalBusiness schema.
 * Suppress the older standalone child-theme Organization script when that
 * graph-aware implementation is available, preventing duplicate entities.
 */
function dkx_adv_remove_duplicate_theme_schema() {
	if ( function_exists( 'dkx_handover_schema_organization' ) && function_exists( 'dkxv4_editable_schema' ) ) {
		remove_action( 'wp_head', 'dkxv4_editable_schema', 30 );
	}
}
add_action( 'wp', 'dkx_adv_remove_duplicate_theme_schema', 0 );

/**
 * Small, safe front-end resource hints. No DNS hints are added for unknown or
 * optional third parties.
 */
function dkx_adv_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type || 'dns-prefetch' === $relation_type ) {
		$urls[] = 'https://www.googletagmanager.com';
	}
	return array_values( array_unique( $urls ) );
}
add_filter( 'wp_resource_hints', 'dkx_adv_resource_hints', 10, 2 );
