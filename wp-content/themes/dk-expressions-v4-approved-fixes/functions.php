<?php
/**
 * Approved fixes child theme functions.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_stylesheet_directory() . '/inc/dk-experience-settings.php';
require_once get_stylesheet_directory() . '/inc/giveaways.php';

function dkx_fixes_assets() {
	$release = '1.16.7';

	wp_enqueue_style( 'dkx-parent-style', get_template_directory_uri() . '/style.css', array(), '1.0.0' );
	wp_enqueue_style( 'dkx-approved-fixes', get_stylesheet_uri(), array( 'dkx-parent-style' ), $release );
	wp_enqueue_style(
		'dkx-enterprise-base',
		get_stylesheet_directory_uri() . '/assets/enterprise-v115.css',
		array( 'dkx-approved-fixes' ),
		$release
	);

	wp_enqueue_script(
		'dkx-mobile-fixes',
		get_stylesheet_directory_uri() . '/assets/mobile-fixes.js',
		array(),
		$release,
		true
	);
	wp_enqueue_script(
		'dkx-semantic-highlights',
		get_stylesheet_directory_uri() . '/assets/semantic-highlights.js',
		array(),
		$release,
		true
	);
	wp_localize_script(
		'dkx-semantic-highlights',
		'dkxHighlightConfig',
		array( 'additionalLocations' => preg_split( '/\R/', dkxv4_content( 'highlight_locations' ), -1, PREG_SPLIT_NO_EMPTY ) )
	);

	if ( is_page( 'home' ) ) {
		wp_enqueue_style(
			'dkx-design-system-v116',
			get_stylesheet_directory_uri() . '/assets/design-system-v116.css',
			array( 'dkx-enterprise-base' ),
			$release
		);
		wp_enqueue_style(
			'dkx-home-order-v1161',
			get_stylesheet_directory_uri() . '/assets/home-order-v1161.css',
			array( 'dkx-design-system-v116' ),
			$release
		);
		wp_enqueue_script(
			'dkx-enterprise-home',
			get_stylesheet_directory_uri() . '/assets/enterprise-home.js',
			array(),
			$release,
			true
		);
		wp_enqueue_script(
			'dkx-home-order-v1161',
			get_stylesheet_directory_uri() . '/assets/home-order-v1161.js',
			array( 'dkx-enterprise-home' ),
			$release,
			true
		);
		wp_localize_script(
			'dkx-home-order-v1161',
			'dkxHomeV1161',
			array(
				'logoUrl' => dkx_logo_url(),
				'logoAlt' => get_bloginfo( 'name' ),
			)
		);
	}

	if ( is_page( 'giveaways' ) || is_singular( 'dkx_giveaway' ) ) {
		wp_enqueue_script(
			'dkx-giveaways',
			get_stylesheet_directory_uri() . '/assets/giveaways.js',
			array(),
			$release,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dkx_fixes_assets', 20 );

function dkxv4_force_enterprise_home_template( $template ) {
	if ( is_page( 'home' ) ) {
		$enterprise_template = get_stylesheet_directory() . '/page-home.php';
		if ( file_exists( $enterprise_template ) ) {
			return $enterprise_template;
		}
	}
	return $template;
}
add_filter( 'template_include', 'dkxv4_force_enterprise_home_template', 99 );

function dkxv4_replace_parent_schema() {
	remove_action( 'wp_head', 'dkx_schema', 30 );
}
add_action( 'after_setup_theme', 'dkxv4_replace_parent_schema', 20 );

function dkxv4_editable_schema() {
	$schema = array(
		'@context'     => 'https://schema.org',
		'@type'        => 'Organization',
		'name'         => dkxv4_content( 'organisation_name' ),
		'url'          => home_url( '/' ),
		'logo'         => dkx_logo_url(),
		'email'        => dkxv4_content( 'contact_email' ),
		'telephone'    => dkxv4_content( 'contact_phone' ),
		'foundingDate' => dkxv4_content( 'founding_year' ),
		'founder'      => array(
			'@type' => 'Person',
			'name'  => dkxv4_content( 'founder_name' ),
		),
		'slogan'       => dkxv4_content( 'tagline' ),
		'address'      => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => dkxv4_content( 'address_locality' ),
			'addressRegion'   => dkxv4_content( 'address_region' ),
			'addressCountry'  => dkxv4_content( 'address_country' ),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'dkxv4_editable_schema', 30 );
