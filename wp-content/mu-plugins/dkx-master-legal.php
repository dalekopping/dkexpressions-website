<?php
/**
 * Plugin Name: DK Expressions Master Legal Pages
 * Description: Creates the short Privacy Policy and Terms of Use supplied in the 2026 Developer Handover Master Copy when missing.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_init', function() {
	if ( get_option( 'dkx_master_legal_2026' ) ) return;

	$privacy = get_page_by_path( 'privacy-policy' );
	if ( ! $privacy ) {
		$privacy_id = wp_insert_post( array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'post_title' => 'Privacy Policy',
			'post_name' => 'privacy-policy',
			'post_content' => '<h1>Privacy Policy</h1><p>We only collect the information you choose to send us through the contact form or email. It is used solely to respond to your enquiry and is never sold or shared with third parties. You can request deletion of your data at any time by emailing us.</p>',
		) );
		if ( $privacy_id && ! is_wp_error( $privacy_id ) ) update_option( 'wp_page_for_privacy_policy', (int) $privacy_id );
	}

	if ( ! get_page_by_path( 'terms-of-use' ) ) {
		wp_insert_post( array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'post_title' => 'Terms of Use',
			'post_name' => 'terms-of-use',
			'post_content' => '<h1>Terms of Use</h1><p>All images, video and content on this website remain the property of DK Expressions unless otherwise stated. Content may not be copied, downloaded or used for commercial purposes without written permission.</p><p>Rates and packages are subject to change and are confirmed in writing for each project.</p>',
		) );
	}

	$content = get_option( 'dkxv4_content', array() );
	$content['footer_privacy_label'] = 'Privacy Policy';
	$content['footer_privacy_url'] = '/privacy-policy/';
	update_option( 'dkxv4_content', $content );
	update_option( 'dkx_master_legal_2026', '1', false );
} );
