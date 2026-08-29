<?php
/**
 * Plugin Name: DK Expressions Client Logo Colours
 * Description: Forces the homepage client-logo ticker to display original full-colour artwork without changing sizing, spacing, or motion.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', function() {
    if ( ! is_front_page() && ! is_home() ) {
        return;
    }
    ?>
    <style id="dkx-client-logo-colours">
        .dkxhp-client-track img {
            filter: none !important;
            -webkit-filter: none !important;
            opacity: 1 !important;
        }

        .dkxhp-client-track span:hover img {
            filter: none !important;
            -webkit-filter: none !important;
            opacity: 1 !important;
        }
    </style>
    <?php
}, 9999 );
