<?php
/**
 * Plugin Name: DK Expressions Industries Style Loader
 * Description: Ensures the locked Infinity Switchboard stylesheet is loaded only on the Industries page.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {
	if ( ! is_page( 'industries' ) ) return;

	$theme_uri = get_stylesheet_directory_uri();
	wp_enqueue_style(
		'dkx-industries-options-v1229',
		$theme_uri . '/assets/css/industries-options-v1229.css',
		array( 'dkx-recovery-v1204' ),
		'1.32.1'
	);
}, 100 );
