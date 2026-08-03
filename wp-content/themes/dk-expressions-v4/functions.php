<?php
/**
 * DK Expressions V4 theme functions.
 *
 * @package DK_Expressions_V4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DKX_VERSION', '1.0.0' );

function dkx_setup() {
	load_theme_textdomain( 'dk-expressions-v4', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 220,
			'width'       => 420,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'dk-expressions-v4' ),
			'footer'  => __( 'Footer Navigation', 'dk-expressions-v4' ),
		)
	);
	add_image_size( 'dkx-feature', 1600, 900, true );
	add_image_size( 'dkx-card', 800, 560, true );
}
add_action( 'after_setup_theme', 'dkx_setup' );

function dkx_assets() {
	wp_enqueue_style( 'dkx-style', get_stylesheet_uri(), array(), DKX_VERSION );
	wp_enqueue_script( 'dkx-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), DKX_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'dkx_assets' );

function dkx_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $image ) {
			return $image[0];
		}
	}
	return get_template_directory_uri() . '/assets/images/dk-expressions-logo-white-transparent.png';
}

function dkx_primary_fallback() {
	$items = array(
		'Solutions'  => 'solutions',
		'Our Work'   => 'our-work',
		'Industries' => 'industries',
		'Insights'   => 'insights',
		'About'      => 'about',
		'Legacy'     => 'legacy',
	);
	echo '<ul>';
	foreach ( $items as $label => $slug ) {
		printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( home_url( '/' . $slug . '/' ) ), esc_html( $label ) );
	}
	echo '</ul>';
}

function dkx_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'dkx_excerpt_length', 999 );

function dkx_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'dkx_excerpt_more' );

function dkx_create_core_pages() {
	$pages = array(
		'home'       => 'Home',
		'solutions'  => 'Solutions',
		'our-work'   => 'Our Work',
		'industries' => 'Industries',
		'insights'   => 'Insights',
		'about'      => 'About',
		'legacy'     => 'Legacy',
		'contact'    => 'Contact',
	);
	$home_id = 0;
	foreach ( $pages as $slug => $title ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			if ( 'home' === $slug ) {
				$home_id = (int) $existing->ID;
			}
			continue;
		}
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			)
		);
		if ( 'home' === $slug && ! is_wp_error( $page_id ) ) {
			$home_id = (int) $page_id;
		}
	}
	if ( $home_id && ! get_option( 'page_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'dkx_create_core_pages' );

function dkx_meta_fallback() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || class_exists( 'AIOSEO\\Plugin\\AIOSEO' ) ) {
		return;
	}
	$description = get_bloginfo( 'description' );
	if ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_queried_object_id() ) ), 28 );
	}
	$description = $description ?: 'DK Expressions creates premium photography, film, event, digital and brand storytelling experiences from Johannesburg, South Africa.';
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ) ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( wp_get_document_title() ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( is_singular() ? get_permalink() : home_url( '/' ) ) );
	echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . '">' . "\n";
}
add_action( 'wp_head', 'dkx_meta_fallback', 2 );

function dkx_schema() {
	$schema = array(
		'@context'     => 'https://schema.org',
		'@type'        => 'Organization',
		'name'         => 'DK Expressions',
		'url'          => home_url( '/' ),
		'logo'         => dkx_logo_url(),
		'email'        => 'dale@dkexpressions.co.za',
		'foundingDate' => '2013',
		'founder'      => array( '@type' => 'Person', 'name' => 'Dale Kopping' ),
		'slogan'       => 'Freezing Time and Space with the Time Travellers',
		'address'      => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Johannesburg',
			'addressRegion'   => 'Gauteng',
			'addressCountry'  => 'ZA',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'dkx_schema', 30 );

