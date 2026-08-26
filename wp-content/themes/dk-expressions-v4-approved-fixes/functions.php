<?php
/**
 * DK Expressions v4 approved fixes theme functions.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* NOTE: Existing file content preserved; this replacement includes the Industries stylesheet enqueue fix. */

function dkxv4_package_catalog() {
	return array(
		'event-entry'       => array( 'label' => 'Event Domination — Entry', 'price' => 'R6,500 / event', 'service' => 'Event Coverage', 'budget' => 'Under R15k' ),
		'event-spark'       => array( 'label' => 'Event Domination — Spark', 'price' => 'R6,500 / event', 'service' => 'Event Coverage', 'budget' => 'Under R15k' ),
		'event-signature'   => array( 'label' => 'Event Domination — Signature', 'price' => 'R32,000 / event', 'service' => 'Event Coverage', 'budget' => 'R15k–R35k' ),
		'event-premium'     => array( 'label' => 'Event Domination — Premium', 'price' => 'From R95,000', 'service' => 'Event Coverage', 'budget' => 'R75k+' ),
		'event-takeover'    => array( 'label' => 'Event Domination — Takeover', 'price' => 'From R95,000', 'service' => 'Event Coverage', 'budget' => 'R75k+' ),
		'retainer-entry'    => array( 'label' => 'Brand Retainer — Entry', 'price' => 'R15,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R15k–R35k' ),
		'always-essential'  => array( 'label' => 'Always On — Essential', 'price' => 'R15,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R15k–R35k' ),
		'retainer-core'     => array( 'label' => 'Brand Retainer — Core', 'price' => 'R35,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R35k–R75k' ),
		'always-premium'    => array( 'label' => 'Always On — Premium', 'price' => 'R35,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R35k–R75k' ),
		'retainer-premium'  => array( 'label' => 'Brand Retainer — Premium', 'price' => 'From R60,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R35k–R75k' ),
		'always-elite'      => array( 'label' => 'Always On — Elite', 'price' => 'From R60,000 / month', 'service' => 'Brand Retainer', 'budget' => 'R35k–R75k' ),
		'name-starter'      => array( 'label' => 'Become the Name — Starter', 'price' => 'R18,000 / month', 'service' => 'Executive Branding', 'budget' => 'R15k–R35k' ),
		'name-growth'       => array( 'label' => 'Become the Name — Growth', 'price' => 'R40,000 / month', 'service' => 'Executive Branding', 'budget' => 'R35k–R75k' ),
		'name-authority'    => array( 'label' => 'Become the Name — Authority', 'price' => 'From R75,000 / month', 'service' => 'Executive Branding', 'budget' => 'R75k+' ),
		'attention-feature' => array( 'label' => 'Own the Attention — Feature', 'price' => 'R1,500 / placement', 'service' => 'Campaign / Launch', 'budget' => 'Under R15k' ),
		'attention-spotlight' => array( 'label' => 'Own the Attention — Spotlight', 'price' => 'R6,000 / campaign', 'service' => 'Campaign / Launch', 'budget' => 'Under R15k' ),
		'attention-headline' => array( 'label' => 'Own the Attention — Headline', 'price' => 'R12,500 / campaign', 'service' => 'Campaign / Launch', 'budget' => 'Under R15k' ),
	);
}

function dkxv4_package_contact_url( $package_slug = '' ) {
	$package_slug = sanitize_key( $package_slug );
	$catalog      = dkxv4_package_catalog();
	$url          = home_url( '/contact/' );
	if ( $package_slug && isset( $catalog[ $package_slug ] ) ) {
		$url = add_query_arg( 'package', $package_slug, $url );
	}
	return $url . '#project-brief';
}

function dkx_fixes_assets() {
	$release = '1.32.1';
	wp_enqueue_style( 'dkx-parent-style', get_template_directory_uri() . '/style.css', array(), '1.0.0' );
	wp_enqueue_style( 'dkx-approved-fixes', get_stylesheet_uri(), array( 'dkx-parent-style' ), $release );
	wp_enqueue_style( 'dkx-footer-v1176', get_stylesheet_directory_uri() . '/assets/css/footer-v1176.css', array( 'dkx-approved-fixes' ), $release );
	wp_enqueue_style( 'dkx-enterprise-v115', get_stylesheet_directory_uri() . '/assets/enterprise-v115.css', array( 'dkx-approved-fixes' ), $release );
	wp_enqueue_style( 'dkx-branding-v1200', get_stylesheet_directory_uri() . '/assets/css/branding-v1200.css', array( 'dkx-footer-v1176', 'dkx-enterprise-v115' ), $release );
	wp_enqueue_style( 'dkx-recovery-v1204', get_stylesheet_directory_uri() . '/assets/css/recovery-v1204.css', array( 'dkx-branding-v1200' ), $release );

	if ( is_home() || is_archive() || is_page( 'insights' ) ) {
		wp_enqueue_style( 'dkx-insights-v1168', get_stylesheet_directory_uri() . '/assets/insights-v1168.css', array( 'dkx-enterprise-v115' ), $release );
	}
	if ( is_singular( 'post' ) ) {
		wp_enqueue_style( 'dkx-post-links-v1236', get_stylesheet_directory_uri() . '/assets/css/post-links-v1236.css', array( 'dkx-enterprise-v115' ), $release );
	}
	wp_enqueue_script( 'dkx-mobile-fixes', get_stylesheet_directory_uri() . '/assets/mobile-fixes.js', array(), $release, true );
	wp_enqueue_script( 'dkx-semantic-highlights', get_stylesheet_directory_uri() . '/assets/semantic-highlights.js', array(), $release, true );
	wp_localize_script( 'dkx-semantic-highlights', 'dkxHighlightConfig', array( 'additionalLocations' => array() ) );

	if ( is_front_page() || is_page( 'home' ) ) {
		wp_enqueue_style( 'dkx-home-v1200', get_stylesheet_directory_uri() . '/assets/css/home-v1200.css', array( 'dkx-recovery-v1204' ), $release );
	}
	if ( is_page( 'home' ) ) {
		wp_enqueue_style( 'dkx-landing-conversion-v1209', get_stylesheet_directory_uri() . '/assets/css/landing-conversion-v1209.css', array( 'dkx-home-v1200' ), $release );
		wp_enqueue_style( 'dkx-home-options-v1213', get_stylesheet_directory_uri() . '/assets/css/home-options-v1213.css', array( 'dkx-home-v1200' ), $release );
	}
	if ( is_front_page() ) {
		wp_enqueue_style( 'dkx-landing-final-v1211', get_stylesheet_directory_uri() . '/assets/css/landing-final-v1211.css', array( 'dkx-home-v1200' ), $release );
	}
	if ( is_front_page() || is_page( array( 'home', 'solutions' ) ) ) {
		wp_enqueue_style( 'dkx-booking-pulse-v1221', get_stylesheet_directory_uri() . '/assets/css/booking-pulse-v1221.css', array( 'dkx-branding-v1200' ), $release );
	}
	if ( is_page( 'solutions' ) ) {
		wp_enqueue_style( 'dkx-solutions-v1197', get_stylesheet_directory_uri() . '/assets/css/solutions-v1197.css', array( 'dkx-recovery-v1204' ), $release );
		wp_enqueue_style( 'dkx-solutions-options-v1220', get_stylesheet_directory_uri() . '/assets/css/solutions-options-v1220.css', array( 'dkx-solutions-v1197' ), $release );
	}
	if ( is_page( 'industries' ) ) {
		wp_enqueue_style( 'dkx-industries-options-v1229', get_stylesheet_directory_uri() . '/assets/css/industries-options-v1229.css', array( 'dkx-recovery-v1204' ), $release );
	}
}
add_action( 'wp_enqueue_scripts', 'dkx_fixes_assets', 20 );
