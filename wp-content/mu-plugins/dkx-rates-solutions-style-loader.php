<?php
/**
 * Plugin Name: DK Expressions Rates / Solutions Style Loader
 * Description: Loads the active Solutions package styling on the Rates page without modifying core theme functions.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_page( 'rates' ) ) return;

    $theme_uri = get_stylesheet_directory_uri();
    $theme_dir = get_stylesheet_directory();

    $base = $theme_dir . '/assets/css/solutions-v1197.css';
    if ( file_exists( $base ) ) {
        wp_enqueue_style(
            'dkx-rates-solutions-v1197',
            $theme_uri . '/assets/css/solutions-v1197.css',
            array( 'dkx-recovery-v1204' ),
            filemtime( $base )
        );
    }

    $options = $theme_dir . '/assets/css/solutions-options-v1220.css';
    if ( file_exists( $options ) ) {
        wp_enqueue_style(
            'dkx-rates-solutions-options-v1220',
            $theme_uri . '/assets/css/solutions-options-v1220.css',
            array( file_exists( $base ) ? 'dkx-rates-solutions-v1197' : 'dkx-recovery-v1204' ),
            filemtime( $options )
        );
    }
}, 99 );
