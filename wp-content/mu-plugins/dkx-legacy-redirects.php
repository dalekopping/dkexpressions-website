<?php
/**
 * Plugin Name: DK Expressions Legacy Redirects
 * Description: Preserves historical DK Expressions post URLs after the production permalink cutover.
 * Version: 1.1.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Extract a likely post slug from supported historical DKEXP URL shapes.
 * Supported examples:
 *   /dkexp/post-slug/
 *   /dkexp/2024/08/post-slug/
 *   /dkexp/2024/08/15/post-slug/
 *   /dkexp/post-slug.html
 */
function dkx_legacy_extract_post_slug( $request_path ) {
    $path = trim( rawurldecode( (string) $request_path ), '/' );

    $patterns = array(
        '#^dkexp/([^/]+?)(?:\.html?)?$#i',
        '#^dkexp/\d{4}/\d{1,2}/([^/]+?)(?:\.html?)?$#i',
        '#^dkexp/\d{4}/\d{1,2}/\d{1,2}/([^/]+?)(?:\.html?)?$#i',
    );

    foreach ( $patterns as $pattern ) {
        if ( preg_match( $pattern, $path, $matches ) ) {
            $slug = sanitize_title( $matches[1] );
            return $slug ?: '';
        }
    }

    return '';
}

/**
 * Preserve benign tracking parameters while dropping parameters that can
 * change WordPress routing or create redirect ambiguity.
 */
function dkx_legacy_safe_query_args() {
    if ( empty( $_GET ) || ! is_array( $_GET ) ) {
        return array();
    }

    $blocked = array( 'p', 'page_id', 'name', 'post_type', 'preview', 'feed', 'paged', 'attachment_id' );
    $args    = array();

    foreach ( wp_unslash( $_GET ) as $key => $value ) {
        $clean_key = sanitize_key( $key );
        if ( ! $clean_key || in_array( $clean_key, $blocked, true ) || ! is_scalar( $value ) ) {
            continue;
        }
        $args[ $clean_key ] = sanitize_text_field( (string) $value );
    }

    return $args;
}

/**
 * Redirect historical post URLs only after WordPress is no longer configured
 * to use the historical /dkexp/ permalink structure. This guard keeps the
 * plugin inert before the production permalink cutover.
 */
add_action( 'template_redirect', function() {
    if ( is_admin() ) {
        return;
    }

    if ( ! in_array( strtoupper( $_SERVER['REQUEST_METHOD'] ?? 'GET' ), array( 'GET', 'HEAD' ), true ) ) {
        return;
    }

    $permalink_structure = (string) get_option( 'permalink_structure' );
    if ( false !== strpos( $permalink_structure, '/dkexp/' ) ) {
        return;
    }

    $request_path = isset( $_SERVER['REQUEST_URI'] )
        ? (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH )
        : '';

    $slug = dkx_legacy_extract_post_slug( $request_path );
    if ( '' === $slug ) {
        return;
    }

    $post = get_page_by_path( $slug, OBJECT, 'post' );
    if ( ! $post || 'publish' !== get_post_status( $post ) ) {
        return;
    }

    $target = get_permalink( $post );
    if ( ! $target ) {
        return;
    }

    $query_args = dkx_legacy_safe_query_args();
    if ( $query_args ) {
        $target = add_query_arg( $query_args, $target );
    }

    $current = home_url( '/' . trim( (string) $request_path, '/' ) . '/' );
    if ( untrailingslashit( $current ) === untrailingslashit( $target ) ) {
        return;
    }

    wp_safe_redirect( $target, 301, 'DK Expressions Legacy Redirects' );
    exit;
}, 1 );
