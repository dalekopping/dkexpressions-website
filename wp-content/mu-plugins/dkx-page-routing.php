<?php
/**
 * Plugin Name: DK Expressions Page Routing Lock
 * Description: Keeps the Landing page and Home page permanently separate.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Ensure WordPress uses a dedicated Landing page as the static front page,
 * while /home/ remains a completely separate page.
 */
add_action( 'admin_init', function() {
	if ( get_option( 'dkx_landing_home_split_2026' ) ) return;

	$landing = get_page_by_path( 'landing' );
	if ( ! $landing ) {
		$landing_id = wp_insert_post( array(
			'post_title'   => 'Landing',
			'post_name'    => 'landing',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( ! is_wp_error( $landing_id ) ) {
			$landing = get_post( $landing_id );
		}
	}

	if ( $landing ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $landing->ID );
	}

	update_option( 'dkx_landing_home_split_2026', '1', false );
} );

/**
 * Explicitly bind the two routes to their own templates.
 */
add_filter( 'template_include', function( $template ) {
	$theme = trailingslashit( get_stylesheet_directory() );
	if ( is_front_page() && file_exists( $theme . 'front-page.php' ) ) {
		return $theme . 'front-page.php';
	}
	if ( is_page( 'home' ) && file_exists( $theme . 'page-home.php' ) ) {
		return $theme . 'page-home.php';
	}
	return $template;
}, 9999 );

/**
 * Prevent WordPress canonical redirect logic from collapsing /home/ into /.
 */
add_filter( 'redirect_canonical', function( $redirect_url, $requested_url ) {
	if ( is_page( 'home' ) ) return false;
	return $redirect_url;
}, 1000, 2 );
