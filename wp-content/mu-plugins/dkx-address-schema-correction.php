<?php
/**
 * Plugin Name: DK Expressions Address Schema Correction
 * Description: Supplies the exact DK Expressions Glenhazel street address to the LocalBusiness/Organization entity.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', function() {
	$schema = array(
		'@context' => 'https://schema.org',
		'@type' => array( 'Organization', 'LocalBusiness' ),
		'@id' => home_url( '/#organization' ),
		'name' => 'DK Expressions',
		'url' => home_url( '/' ),
		'telephone' => '+27-72-246-0451',
		'email' => 'advertise@dkexpressions.co.za',
		'address' => array(
			'@type' => 'PostalAddress',
			'streetAddress' => '#3 Silvamonte Village, 17 Swemmer Road',
			'addressLocality' => 'Glenhazel, Johannesburg',
			'addressRegion' => 'Gauteng',
			'postalCode' => '2192',
			'addressCountry' => 'ZA',
		),
	);
	echo '<script type="application/ld+json" id="dkx-exact-address-schema">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}, 35 );
