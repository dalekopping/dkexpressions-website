<?php
/**
 * Plugin Name: DK Expressions Master SEO
 * Description: SEO, canonical, social metadata, schema and local-search foundation from the 2026 Developer Handover Master Copy.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkx_master_seo_key() {
	if ( is_front_page() || is_page( array( 'landing', 'home' ) ) ) return 'home';
	if ( is_page( array( 'solutions', 'agency' ) ) ) return 'solutions';
	if ( is_page( 'industries' ) ) return 'industries';
	if ( is_page( array( 'our-work', 'time-vault' ) ) ) return 'vault';
	if ( is_page( array( 'rates', 'rate-card' ) ) ) return 'rates';
	if ( is_page( 'about' ) ) return 'about';
	if ( is_page( array( 'contact', 'start-a-project' ) ) ) return 'contact';
	if ( is_page( 'insights' ) || is_home() ) return 'insights';
	return '';
}

function dkx_master_seo_map() {
	return array(
		'home' => array(
			'title' => 'Event Photography & Brand Storytelling | DK Expressions',
			'description' => 'Premium event photography, brand content and storytelling in Johannesburg since 2013. Fixed packages from R6,500. Start your project today.',
			'url' => home_url( '/' ),
		),
		'solutions' => array(
			'title' => 'Brand Content, Event Coverage & Retainers | DK Expressions',
			'description' => 'Strategy, photography, film and ongoing brand retainers. Clear packages, fixed scopes, no hourly surprises. Johannesburg & beyond.',
			'url' => home_url( '/solutions/' ),
		),
		'industries' => array(
			'title' => 'Industries We Serve | Entertainment, Hospitality, Property & More',
			'description' => 'DK Expressions works across live events, music, hospitality, real estate, corporate and web & AI. One obsession: attention.',
			'url' => home_url( '/industries/' ),
		),
		'vault' => array(
			'title' => 'Time Vault – 13 Years of Captured Moments | DK Expressions',
			'description' => 'Real photography and film from concerts, festivals, theatre and brands since 2013. Not stock. Not mock-ups. See the work.',
			'url' => home_url( '/our-work/' ),
		),
		'rates' => array(
			'title' => '2026 Rate Card – Clear Packages, Fixed Scopes | DK Expressions',
			'description' => 'Event Domination from R6,500. Brand Retainers from R15,000/month. Download the full 2026 rate card. No hourly surprises.',
			'url' => home_url( '/rates/' ),
		),
		'about' => array(
			'title' => 'About DK Expressions – Time Travellers Since 2013',
			'description' => 'Not a media company. A time machine. Founded in Johannesburg in 2013. Meet the team and the standard behind the work.',
			'url' => home_url( '/about/' ),
		),
		'contact' => array(
			'title' => 'Start a Project | DK Expressions Johannesburg',
			'description' => 'Tell us what you’re working on. We respond within one business day. No automated replies. Just a clear brief and a direct conversation.',
			'url' => home_url( '/contact/' ),
		),
		'insights' => array(
			'title' => 'Insights – News, Reviews & Stories | DK Expressions',
			'description' => 'Entertainment news, interviews, reviews, event coverage and industry notes from the rooms we are in.',
			'url' => home_url( '/insights/' ),
		),
	);
}

function dkx_master_current_meta() {
	$key = dkx_master_seo_key();
	$map = dkx_master_seo_map();
	if ( $key && isset( $map[ $key ] ) ) return $map[ $key ];

	if ( is_singular( 'post' ) ) {
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_queried_object_id() ) ), 28, '' );
		return array( 'title' => single_post_title( '', false ) . ' | DK Expressions', 'description' => $description, 'url' => get_permalink() );
	}
	if ( is_category() ) {
		$term = get_queried_object();
		return array( 'title' => single_cat_title( '', false ) . ' | DK Expressions', 'description' => wp_strip_all_tags( category_description() ), 'url' => get_term_link( $term ) );
	}
	return array();
}

function dkx_master_canonical_url() {
	$meta = dkx_master_current_meta();
	return ! empty( $meta['url'] ) && ! is_wp_error( $meta['url'] ) ? $meta['url'] : '';
}

add_filter( 'pre_get_document_title', function( $title ) {
	$meta = dkx_master_current_meta();
	return ! empty( $meta['title'] ) ? $meta['title'] : $title;
}, 1000 );

add_filter( 'wpseo_title', function( $title ) { $m = dkx_master_current_meta(); return $m['title'] ?? $title; }, 1000 );
add_filter( 'wpseo_metadesc', function( $desc ) { $m = dkx_master_current_meta(); return ! empty( $m['description'] ) ? $m['description'] : $desc; }, 1000 );
add_filter( 'wpseo_canonical', function( $url ) { return dkx_master_canonical_url() ?: $url; }, 1000 );
add_filter( 'wpseo_opengraph_title', function( $v ) { $m = dkx_master_current_meta(); return $m['title'] ?? $v; }, 1000 );
add_filter( 'wpseo_opengraph_desc', function( $v ) { $m = dkx_master_current_meta(); return $m['description'] ?? $v; }, 1000 );
add_filter( 'wpseo_opengraph_url', function( $v ) { return dkx_master_canonical_url() ?: $v; }, 1000 );
add_filter( 'wpseo_twitter_title', function( $v ) { $m = dkx_master_current_meta(); return $m['title'] ?? $v; }, 1000 );
add_filter( 'wpseo_twitter_description', function( $v ) { $m = dkx_master_current_meta(); return $m['description'] ?? $v; }, 1000 );

add_action( 'after_setup_theme', function() {
	remove_action( 'wp_head', 'dkxv4_editable_schema', 30 );
}, PHP_INT_MAX );

add_action( 'wp_head', function() {
	if ( is_admin() || defined( 'WPSEO_VERSION' ) ) return;
	$meta = dkx_master_current_meta();
	if ( empty( $meta ) ) return;
	if ( ! empty( $meta['description'] ) ) echo '<meta name="description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";
	if ( ! empty( $meta['url'] ) ) echo '<link rel="canonical" href="' . esc_url( $meta['url'] ) . '">' . "\n";
	$og_type = is_singular( 'post' ) ? 'article' : 'website';
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $meta['title'] ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $meta['url'] ) . '">' . "\n";
	echo '<meta property="og:site_name" content="DK Expressions">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $meta['title'] ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $meta['description'] ) . '">' . "\n";
}, 5 );

add_filter( 'wp_robots', function( $robots ) {
	if ( is_search() || is_404() || isset( $_GET['dk-preview'] ) || isset( $_GET['dk-home-preview'] ) || isset( $_GET['dk-solutions-preview'] ) || isset( $_GET['dk-industries-preview'] ) || isset( $_GET['dk-insights-preview'] ) || isset( $_GET['dk-work-preview'] ) ) {
		$robots['noindex'] = true;
		$robots['follow'] = true;
	}
	return $robots;
} );

function dkx_master_social_urls() {
	$urls = array();
	if ( function_exists( 'dkxv4_content' ) ) {
		foreach ( array( 'facebook_url', 'instagram_url', 'x_url', 'youtube_url', 'tiktok_url', 'linkedin_url' ) as $key ) {
			$url = trim( (string) dkxv4_content( $key ) );
			if ( $url ) $urls[] = $url;
		}
	}
	return array_values( array_unique( $urls ) );
}

function dkx_master_organization_schema() {
	$logo = function_exists( 'dkx_logo_url' ) ? dkx_logo_url() : '';
	$schema = array(
		'@type' => array( 'Organization', 'LocalBusiness' ),
		'@id' => home_url( '/#organization' ),
		'name' => 'DK Expressions',
		'url' => home_url( '/' ),
		'foundingDate' => '2013-02',
		'email' => 'advertise@dkexpressions.co.za',
		'telephone' => '+27-72-246-0451',
		'address' => array(
			'@type' => 'PostalAddress',
			'addressLocality' => 'Johannesburg',
			'addressRegion' => 'Gauteng',
			'addressCountry' => 'ZA',
		),
		'areaServed' => array(
			array( '@type' => 'Country', 'name' => 'South Africa' ),
			array( '@type' => 'City', 'name' => 'Johannesburg' ),
			array( '@type' => 'City', 'name' => 'Pretoria' ),
			array( '@type' => 'City', 'name' => 'Cape Town' ),
		),
	);
	if ( $logo ) $schema['logo'] = array( '@type' => 'ImageObject', 'url' => $logo );
	$same_as = dkx_master_social_urls();
	if ( $same_as ) $schema['sameAs'] = $same_as;
	return $schema;
}

function dkx_master_service_schema() {
	if ( ! is_page( array( 'solutions', 'rates', 'agency', 'rate-card' ) ) ) return array();
	return array(
		array(
			'@type' => 'Service',
			'@id' => home_url( '/solutions/#event-domination' ),
			'name' => 'Event Domination',
			'provider' => array( '@id' => home_url( '/#organization' ) ),
			'areaServed' => array( '@type' => 'Country', 'name' => 'South Africa' ),
			'offers' => array(
				array( '@type'=>'Offer', 'name'=>'Entry', 'price'=>'6500', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#event-domination') ),
				array( '@type'=>'Offer', 'name'=>'Signature', 'price'=>'32000', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#event-domination') ),
				array( '@type'=>'Offer', 'name'=>'Premium', 'price'=>'95000', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#event-domination') ),
			),
		),
		array(
			'@type' => 'Service',
			'@id' => home_url( '/solutions/#brand-retainer' ),
			'name' => 'Brand Content Retainer',
			'provider' => array( '@id' => home_url( '/#organization' ) ),
			'areaServed' => array( '@type' => 'Country', 'name' => 'South Africa' ),
			'offers' => array(
				array( '@type'=>'Offer', 'name'=>'Entry', 'price'=>'15000', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#always-on') ),
				array( '@type'=>'Offer', 'name'=>'Core', 'price'=>'35000', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#always-on') ),
				array( '@type'=>'Offer', 'name'=>'Premium', 'price'=>'60000', 'priceCurrency'=>'ZAR', 'url'=>home_url('/solutions/#always-on') ),
			),
		),
	);
}

function dkx_master_faq_schema() {
	if ( ! is_page( array( 'solutions', 'rates', 'agency', 'rate-card' ) ) ) return null;
	$faq = array(
		array( 'What is included in the Event Domination Signature package?', 'The Signature package is priced at R32,000 excluding VAT and provides expanded event photography, video and content coverage. Final scope is confirmed in the written project quotation.' ),
		array( 'How do the Always On retainers work?', 'Always On retainers start at R15,000 per month, with Premium at R35,000 per month and Elite from R60,000 per month. Retainers require a minimum three-month commitment.' ),
		array( 'Do you travel outside Johannesburg?', 'Yes. DK Expressions works across South Africa. Travel, accommodation and related costs outside Johannesburg are quoted separately unless specifically included in the package.' ),
		array( 'What deposit is required?', 'A 50% deposit is required to confirm a project.' ),
		array( 'What are the minimum booking levels?', 'New-client projects have a R7,500 excluding VAT commercial floor. Photography is not quoted below R5,000 and event coverage is not quoted below R6,500.' ),
		array( 'Can I book an individual sponsored placement?', 'Yes. Own the Attention includes Feature at R1,500 per placement, Spotlight at R6,000 per campaign and Headline at R12,500 per campaign, excluding VAT.' ),
	);
	$main = array();
	foreach ( $faq as $row ) $main[] = array( '@type'=>'Question', 'name'=>$row[0], 'acceptedAnswer'=>array( '@type'=>'Answer', 'text'=>$row[1] ) );
	return array( '@type'=>'FAQPage', '@id'=>dkx_master_canonical_url() . '#faq', 'mainEntity'=>$main );
}

function dkx_master_schema_graph() {
	$graph = array( dkx_master_organization_schema() );
	foreach ( dkx_master_service_schema() as $service ) $graph[] = $service;
	$faq = dkx_master_faq_schema();
	if ( $faq ) $graph[] = $faq;
	return $graph;
}

add_filter( 'wpseo_schema_graph', function( $graph ) {
	$filtered = array();
	foreach ( (array) $graph as $piece ) {
		$type = $piece['@type'] ?? '';
		$types = (array) $type;
		if ( in_array( 'Organization', $types, true ) || in_array( 'LocalBusiness', $types, true ) ) continue;
		$filtered[] = $piece;
	}
	foreach ( dkx_master_schema_graph() as $piece ) $filtered[] = $piece;
	return $filtered;
}, 1000 );

add_action( 'wp_head', function() {
	if ( is_admin() || defined( 'WPSEO_VERSION' ) ) return;
	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context'=>'https://schema.org', '@graph'=>dkx_master_schema_graph() ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}, 30 );

add_filter( 'robots_txt', function( $output, $public ) {
	if ( $public ) {
		$output .= "\nSitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";
	}
	return $output;
}, 20, 2 );

add_filter( 'wp_get_attachment_image_attributes', function( $attr, $attachment ) {
	if ( empty( $attr['alt'] ) && ( is_front_page() || is_page( array( 'home', 'our-work', 'time-vault' ) ) ) ) {
		$title = trim( get_the_title( $attachment ) );
		if ( $title ) $attr['alt'] = $title . ' — DK Expressions';
	}
	return $attr;
}, 20, 2 );

add_action( 'admin_init', function() {
	if ( get_option( 'dkx_master_seo_migration_2026' ) ) return;
	if ( function_exists( 'dkxv4_content_defaults' ) ) {
		$content = get_option( 'dkxv4_content', array() );
		$current = isset( $content['contact_email'] ) ? strtolower( trim( $content['contact_email'] ) ) : '';
		if ( '' === $current || 'dale@dkexpressions.co.za' === $current ) {
			$content['contact_email'] = 'advertise@dkexpressions.co.za';
			update_option( 'dkxv4_content', $content );
		}
	}
	update_option( 'dkx_master_seo_migration_2026', '1', false );
} );
