<?php
/**
 * Plugin Name: DK Expressions Handover Schema 2026
 * Description: Production structured-data layer for the DK Expressions 2026 handover. Enhances the Yoast graph with exact Organization/LocalBusiness, four commercial Service entities and page-matched FAQ schema while preserving Yoast WebSite, WebPage, Breadcrumb and Article entities.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkx_handover_schema_org_id() {
	return home_url( '/#organization' );
}

function dkx_handover_schema_logo_url() {
	if ( function_exists( 'dkx_logo_url' ) ) {
		$logo = trim( (string) dkx_logo_url() );
		if ( $logo ) return $logo;
	}
	return get_stylesheet_directory_uri() . '/assets/images/dk-expressions-logo-white-tight.png';
}

function dkx_handover_schema_social_urls() {
	$urls = array();
	if ( function_exists( 'dkxv4_content' ) ) {
		foreach ( array( 'facebook_url', 'instagram_url', 'x_url', 'youtube_url', 'tiktok_url', 'linkedin_url' ) as $key ) {
			$url = trim( (string) dkxv4_content( $key ) );
			if ( $url ) $urls[] = $url;
		}
	}
	return array_values( array_unique( array_filter( $urls ) ) );
}

function dkx_handover_schema_organization() {
	$schema = array(
		'@type'       => array( 'Organization', 'LocalBusiness' ),
		'@id'         => dkx_handover_schema_org_id(),
		'name'        => 'DK Expressions',
		'url'         => home_url( '/' ),
		'logo'        => array(
			'@type' => 'ImageObject',
			'url'   => dkx_handover_schema_logo_url(),
		),
		'foundingDate' => '2013-02',
		'email'        => 'advertise@dkexpressions.co.za',
		'telephone'    => '+27 72 246 0451',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '#3 Silvamonte Village, 17 Swemmer Road',
			'addressLocality' => 'Glenhazel, Johannesburg',
			'addressRegion'   => 'Gauteng',
			'postalCode'      => '2192',
			'addressCountry'  => 'ZA',
		),
		'areaServed'   => array(
			array( '@type' => 'Country', 'name' => 'South Africa' ),
			array( '@type' => 'City', 'name' => 'Johannesburg' ),
			array( '@type' => 'City', 'name' => 'Pretoria' ),
			array( '@type' => 'City', 'name' => 'Cape Town' ),
		),
	);

	$same_as = dkx_handover_schema_social_urls();
	if ( $same_as ) $schema['sameAs'] = $same_as;
	return $schema;
}

function dkx_handover_schema_offer( $name, $price, $url, $description = '' ) {
	$offer = array(
		'@type'         => 'Offer',
		'name'          => $name,
		'price'         => (string) $price,
		'priceCurrency' => 'ZAR',
		'url'           => $url,
		'availability'  => 'https://schema.org/InStock',
	);
	if ( $description ) $offer['description'] = $description;
	return $offer;
}

function dkx_handover_schema_services() {
	if ( ! is_page( array( 'solutions', 'rates', 'agency', 'rate-card' ) ) ) return array();

	$provider = array( '@id' => dkx_handover_schema_org_id() );
	$served   = array( '@type' => 'Country', 'name' => 'South Africa' );

	return array(
		array(
			'@type'      => 'Service',
			'@id'        => home_url( '/solutions/#event-domination' ),
			'name'       => 'Event Domination',
			'description'=> 'Event photography, video and live content coverage packages for launches, concerts, festivals, corporate events and brand experiences.',
			'provider'   => $provider,
			'areaServed' => $served,
			'offers'     => array(
				dkx_handover_schema_offer( 'Spark', 6500, home_url( '/solutions/#event-domination' ) ),
				dkx_handover_schema_offer( 'Signature', 32000, home_url( '/solutions/#event-domination' ) ),
				dkx_handover_schema_offer( 'Takeover', 95000, home_url( '/solutions/#event-domination' ), 'From R95,000 excluding VAT.' ),
			),
		),
		array(
			'@type'      => 'Service',
			'@id'        => home_url( '/solutions/#always-on' ),
			'name'       => 'Always On',
			'description'=> 'Monthly brand content retainers combining photography, short-form video, social content and ongoing campaign support.',
			'provider'   => $provider,
			'areaServed' => $served,
			'offers'     => array(
				dkx_handover_schema_offer( 'Essential', 15000, home_url( '/solutions/#always-on' ) ),
				dkx_handover_schema_offer( 'Premium', 35000, home_url( '/solutions/#always-on' ) ),
				dkx_handover_schema_offer( 'Elite', 60000, home_url( '/solutions/#always-on' ), 'From R60,000 per month excluding VAT.' ),
			),
		),
		array(
			'@type'      => 'Service',
			'@id'        => home_url( '/solutions/#become-the-name' ),
			'name'       => 'Become the Name',
			'description'=> 'Executive and personal-brand content systems designed to build authority, visibility and consistent market presence.',
			'provider'   => $provider,
			'areaServed' => $served,
			'offers'     => array(
				dkx_handover_schema_offer( 'Starter', 18000, home_url( '/solutions/#become-the-name' ) ),
				dkx_handover_schema_offer( 'Growth', 40000, home_url( '/solutions/#become-the-name' ) ),
				dkx_handover_schema_offer( 'Authority', 75000, home_url( '/solutions/#become-the-name' ), 'From R75,000 per month excluding VAT.' ),
			),
		),
		array(
			'@type'      => 'Service',
			'@id'        => home_url( '/solutions/#own-the-attention' ),
			'name'       => 'Own the Attention',
			'description'=> 'Paid editorial, sponsored-content and campaign amplification placements across the DK Expressions media ecosystem.',
			'provider'   => $provider,
			'areaServed' => $served,
			'offers'     => array(
				dkx_handover_schema_offer( 'Feature', 1500, home_url( '/solutions/#own-the-attention' ), 'R1,500 per placement excluding VAT.' ),
				dkx_handover_schema_offer( 'Spotlight', 6000, home_url( '/solutions/#own-the-attention' ), 'R6,000 per campaign excluding VAT.' ),
				dkx_handover_schema_offer( 'Headline', 12500, home_url( '/solutions/#own-the-attention' ), 'R12,500 per campaign excluding VAT.' ),
			),
		),
	);
}

function dkx_handover_schema_faq_rows() {
	return array(
		array( 'What is included in the Event Domination Signature package?', 'The Signature package is priced at R32,000 excluding VAT and provides expanded event photography, video and content coverage. Final scope is confirmed in the written project quotation.' ),
		array( 'How do the Always On retainers work?', 'Always On retainers start at R15,000 per month, with Premium at R35,000 per month and Elite from R60,000 per month. Retainers require a minimum three-month commitment.' ),
		array( 'Do you travel outside Johannesburg?', 'Yes. DK Expressions works across South Africa. Travel, accommodation and related costs outside Johannesburg are quoted separately unless specifically included in the package.' ),
		array( 'What deposit is required?', 'A 50% deposit is required to confirm a project.' ),
		array( 'What are the minimum booking levels?', 'New-client projects have a R7,500 excluding VAT commercial floor. Photography is not quoted below R5,000 and event coverage is not quoted below R6,500.' ),
		array( 'Can I book an individual sponsored placement?', 'Yes. Own the Attention includes Feature at R1,500 per placement, Spotlight at R6,000 per campaign and Headline at R12,500 per campaign, excluding VAT.' ),
	);
}

function dkx_handover_schema_faq() {
	if ( ! is_page( array( 'solutions', 'rates', 'agency', 'rate-card' ) ) ) return null;
	$canonical = function_exists( 'dkx_master_canonical_url' ) ? dkx_master_canonical_url() : get_permalink();
	$main = array();
	foreach ( dkx_handover_schema_faq_rows() as $row ) {
		$main[] = array(
			'@type' => 'Question',
			'name'  => $row[0],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $row[1],
			),
		);
	}
	return array(
		'@type'      => 'FAQPage',
		'@id'        => trailingslashit( $canonical ) . '#faq',
		'url'        => $canonical,
		'mainEntity' => $main,
	);
}

function dkx_handover_schema_is_type( $piece, $wanted ) {
	$types = isset( $piece['@type'] ) ? (array) $piece['@type'] : array();
	return (bool) array_intersect( $types, (array) $wanted );
}

add_filter( 'wpseo_schema_graph', function( $graph ) {
	$filtered = array();
	foreach ( (array) $graph as $piece ) {
		if ( dkx_handover_schema_is_type( $piece, array( 'Organization', 'LocalBusiness', 'Service', 'FAQPage' ) ) ) {
			continue;
		}
		$filtered[] = $piece;
	}

	// Yoast's WebSite, WebPage, BreadcrumbList and Article pieces are intentionally retained.
	$filtered[] = dkx_handover_schema_organization();
	foreach ( dkx_handover_schema_services() as $service ) $filtered[] = $service;
	$faq = dkx_handover_schema_faq();
	if ( $faq ) $filtered[] = $faq;

	return $filtered;
}, 2000 );
