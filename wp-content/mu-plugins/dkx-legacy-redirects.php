<?php
/**
 * Plugin Name: DK Expressions Legacy Redirects
 * Description: Preserves historical /dkexp/%postname%/ post URLs after the production permalink cutover.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Redirect legacy DK Expressions post URLs only after WordPress is no longer
 * configured to use the historical /dkexp/%postname%/ permalink structure.
 *
 * The guard makes this file safe to deploy before the production permalink
 * change: while /dkexp/ remains the configured structure, this plugin is inert.
 */
add_action( 'template_redirect', function() {
    if ( is_admin() ) {
        return;
    }

    if ( ! in_array( strtoupper( $_SERVER['REQUEST_METHOD'] ?? 'GET' ), array( 'GET', 'HEAD' ), true ) ) {
        return;
    }

    $permalink_structure = (string) get_option( 'permalink_structure' );

    // Production safety guard: do nothing while /dkexp/ is still the live structure.
    if ( false !== strpos( $permalink_structure, '/dkexp/' ) ) {
        return;
    }

    $request_path = isset( $_SERVER['REQUEST_URI'] )
        ? (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH )
        : '';

    if ( ! $request_path ) {
        return;
    }

    $request_path = trim( rawurldecode( $request_path ), '/' );

    // Match historical single-post URLs only: /dkexp/{post-slug}/
    if ( ! preg_match( '#^dkexp/([^/]+)$#i', $request_path, $matches ) ) {
        return;
    }

    $slug = sanitize_title( $matches[1] );
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

    // Preserve harmless query parameters such as campaign tracking values.
    if ( ! empty( $_GET ) && is_array( $_GET ) ) {
        $query_args = array();
        foreach ( wp_unslash( $_GET ) as $key => $value ) {
            if ( is_scalar( $value ) ) {
                $query_args[ sanitize_key( $key ) ] = sanitize_text_field( (string) $value );
            }
        }
        if ( $query_args ) {
            $target = add_query_arg( $query_args, $target );
        }
    }

    wp_safe_redirect( $target, 301, 'DK Expressions Legacy Redirects' );
    exit;
}, 1 );
