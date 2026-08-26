<?php
/**
 * Plugin Name: DK Expressions Page Compatibility Fixes
 * Description: Safe compatibility helpers and layout corrections for Home and Solutions.
 * Version: 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'dkxv4_clients_post_type' ) ) {
	function dkxv4_clients_post_type() {
		foreach ( array( 'dkx_client', 'dkx_clients', 'client', 'clients', 'client_logo', 'client_logos' ) as $post_type ) {
			if ( post_type_exists( $post_type ) ) return $post_type;
		}
		return '';
	}
}

add_action( 'wp_enqueue_scripts', function() {
	if ( ! is_page( array( 'home', 'solutions' ) ) ) return;
	wp_register_style( 'dkx-page-compatibility-fixes', false, array(), '20260826.1' );
	wp_enqueue_style( 'dkx-page-compatibility-fixes' );
	wp_add_inline_style( 'dkx-page-compatibility-fixes', '
		html,body{overflow-x:hidden}
		.dkxhp,.dkxsr{width:100%!important;max-width:none!important;margin-left:0!important;margin-right:0!important}
		.dkxhp-shell,.dkxsr-shell{width:min(1280px,calc(100% - 64px))!important;max-width:none!important;margin-left:auto!important;margin-right:auto!important}
		@media(max-width:700px){.dkxhp-shell,.dkxsr-shell{width:calc(100% - 32px)!important}}
	' );
}, 2000 );
