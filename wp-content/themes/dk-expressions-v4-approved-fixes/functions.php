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

/* The signed wp-admin visual canvas must always render the current Page. */
if ( isset( $_GET['dkx_visual_canvas'] ) && ! defined( 'DONOTCACHEPAGE' ) ) {
	define( 'DONOTCACHEPAGE', true );
}

/**
 * Return the requested non-destructive landing-page preview key.
 *
 * The normal landing remains unchanged unless an approved preview query is
 * present on the front page.
 */
function dkxv4_landing_preview_key() {
	if ( ! isset( $_GET['dk-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-preview'] ) );

	return in_array( $preview_key, array( 'three-doors', 'conversion' ), true ) ? $preview_key : '';
}

/**
 * Return the requested non-destructive home-page preview key.
 *
 * The published home page is never changed by these comparison routes.
 */
function dkxv4_home_preview_key() {
	if ( ! isset( $_GET['dk-home-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-home-preview'] ) );

	return in_array( $preview_key, array( 'cinematic', 'vault', 'editorial' ), true ) ? $preview_key : '';
}

/**
 * Return the requested non-destructive Solutions-page preview key.
 */
function dkxv4_solutions_preview_key() {
	if ( ! isset( $_GET['dk-solutions-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-solutions-preview'] ) );

	return in_array( $preview_key, array( 'chapters', 'matrix', 'vault' ), true ) ? $preview_key : '';
}

/**
 * Return the requested non-destructive Industries-page preview key.
 */
function dkxv4_industries_preview_key() {
	if ( ! isset( $_GET['dk-industries-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-industries-preview'] ) );

	return in_array( $preview_key, array( 'atlas', 'broadcast', 'switchboard' ), true ) ? $preview_key : '';
}

/**
 * Return the requested non-destructive Insights-page preview key.
 */
function dkxv4_insights_preview_key() {
	if ( ! isset( $_GET['dk-insights-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-insights-preview'] ) );

	return in_array( $preview_key, array( 'cinematic-grid', 'editorial-spectrum', 'timecode-stream' ), true ) ? $preview_key : '';
}

/**
 * Return the requested non-destructive Our Work / Media Door preview key.
 */
function dkxv4_work_preview_key() {
	if ( ! isset( $_GET['dk-work-preview'] ) ) {
		return '';
	}

	$preview_key = sanitize_key( wp_unslash( $_GET['dk-work-preview'] ) );

	return in_array( $preview_key, array( 'editorial', 'field', 'archive' ), true ) ? $preview_key : '';
}

/* Tell compatible page caches to leave approved comparison URLs dynamic. */
if ( ( '' !== dkxv4_landing_preview_key() || '' !== dkxv4_home_preview_key() || '' !== dkxv4_solutions_preview_key() || '' !== dkxv4_industries_preview_key() || '' !== dkxv4_insights_preview_key() || '' !== dkxv4_work_preview_key() ) && ! defined( 'DONOTCACHEPAGE' ) ) {
	define( 'DONOTCACHEPAGE', true );
}

/**
 * Prevent browser, proxy and WordPress page caches from masking a preview.
 */
function dkxv4_disable_experience_preview_cache() {
	$landing_preview = dkxv4_landing_preview_key();
	$home_preview    = dkxv4_home_preview_key();
	$solutions_preview = dkxv4_solutions_preview_key();
	$industries_preview = dkxv4_industries_preview_key();
	$insights_preview = dkxv4_insights_preview_key();
	$work_preview    = dkxv4_work_preview_key();

	if ( '' === $landing_preview && '' === $home_preview && '' === $solutions_preview && '' === $industries_preview && '' === $insights_preview && '' === $work_preview ) {
		return;
	}

	nocache_headers();
	if ( '' !== $work_preview ) {
		header( 'X-DK-Work-Preview: ' . $work_preview );
	} elseif ( '' !== $insights_preview ) {
		header( 'X-DK-Insights-Preview: ' . $insights_preview );
	} elseif ( '' !== $industries_preview ) {
		header( 'X-DK-Industries-Preview: ' . $industries_preview );
	} elseif ( '' !== $solutions_preview ) {
		header( 'X-DK-Solutions-Preview: ' . $solutions_preview );
	} elseif ( '' !== $home_preview ) {
		header( 'X-DK-Home-Preview: ' . $home_preview );
	} else {
		header( 'X-DK-Landing-Preview: ' . $landing_preview );
	}
}
add_action( 'template_redirect', 'dkxv4_disable_experience_preview_cache', 0 );

/**
 * Whether the Three Doors comparison is active.
 */
function dkxv4_is_three_doors_landing_preview() {
	return 'three-doors' === dkxv4_landing_preview_key();
}

/**
 * Whether the booking-led conversion comparison is active.
 */
function dkxv4_is_conversion_landing_preview() {
	return 'conversion' === dkxv4_landing_preview_key();
}

function dkx_fixes_assets() {
	$release = '1.28.0';

	wp_enqueue_style( 'dkx-parent-style', get_template_directory_uri() . '/style.css', array(), '1.0.0' );
	wp_enqueue_style( 'dkx-approved-fixes', get_stylesheet_uri(), array( 'dkx-parent-style' ), $release );
	wp_enqueue_style(
		'dkx-footer-v1176',
		get_stylesheet_directory_uri() . '/assets/css/footer-v1176.css',
		array( 'dkx-approved-fixes' ),
		$release
	);
	wp_enqueue_style(
		'dkx-enterprise-v115',
		get_stylesheet_directory_uri() . '/assets/enterprise-v115.css',
		array( 'dkx-approved-fixes' ),
		$release
	);
	wp_enqueue_style(
		'dkx-branding-v1200',
		get_stylesheet_directory_uri() . '/assets/css/branding-v1200.css',
		array( 'dkx-footer-v1176', 'dkx-enterprise-v115' ),
		$release
	);
	wp_enqueue_style(
		'dkx-recovery-v1204',
		get_stylesheet_directory_uri() . '/assets/css/recovery-v1204.css',
		array( 'dkx-branding-v1200' ),
		$release
	);
	if ( is_home() || is_archive() || is_page( 'insights' ) ) {
		wp_enqueue_style(
			'dkx-insights-v1168',
			get_stylesheet_directory_uri() . '/assets/insights-v1168.css',
			array( 'dkx-enterprise-v115' ),
			$release
		);
	}
	if ( is_singular( 'post' ) ) {
		wp_enqueue_style(
			'dkx-post-links-v1236',
			get_stylesheet_directory_uri() . '/assets/css/post-links-v1236.css',
			array( 'dkx-enterprise-v115' ),
			$release
		);
	}

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
	if ( is_front_page() || is_page( 'home' ) || dkxv4_is_three_doors_landing_preview() || dkxv4_is_conversion_landing_preview() ) {
		wp_enqueue_style(
			'dkx-home-v1200',
			get_stylesheet_directory_uri() . '/assets/css/home-v1200.css',
			array( 'dkx-recovery-v1204' ),
			$release
		);
	}
	if ( is_page( 'home' ) || dkxv4_is_conversion_landing_preview() ) {
		wp_enqueue_style(
			'dkx-landing-conversion-v1209',
			get_stylesheet_directory_uri() . '/assets/css/landing-conversion-v1209.css',
			array( 'dkx-home-v1200' ),
			$release
		);
	}
	if ( is_page( 'home' ) ) {
		wp_enqueue_style(
			'dkx-home-options-v1213',
			get_stylesheet_directory_uri() . '/assets/css/home-options-v1213.css',
			array( 'dkx-home-v1200' ),
			$release
		);
	}
	if ( is_front_page() ) {
		wp_enqueue_style(
			'dkx-landing-final-v1211',
			get_stylesheet_directory_uri() . '/assets/css/landing-final-v1211.css',
			array( 'dkx-home-v1200' ),
			$release
		);
	}
	if ( is_front_page() || is_page( array( 'home', 'solutions' ) ) ) {
		wp_enqueue_style(
			'dkx-booking-pulse-v1221',
			get_stylesheet_directory_uri() . '/assets/css/booking-pulse-v1221.css',
			array( 'dkx-branding-v1200' ),
			$release
		);
	}
	if ( is_page( 'solutions' ) ) {
		wp_enqueue_style(
			'dkx-solutions-v1197',
			get_stylesheet_directory_uri() . '/assets/css/solutions-v1197.css',
			array( 'dkx-recovery-v1204' ),
			$release
		);
	}
	if ( is_page( array( 'solutions', 'industries' ) ) ) {
		wp_enqueue_style(
			'dkx-solutions-options-v1220',
			get_stylesheet_directory_uri() . '/assets/css/solutions-options-v1220.css',
			array( is_page( 'solutions' ) ? 'dkx-solutions-v1197' : 'dkx-recovery-v1204' ),
			$release
		);
	}
	if ( is_page( array( 'giveaways', 'competitions' ) ) || is_singular( 'dkx_giveaway' ) ) {
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
	$managed_templates = array(
		'home'       => 'page-home.php',
		'about'      => 'page-about.php',
		'solutions'  => 'page-solutions.php',
		'our-work'   => 'page-our-work.php',
		'industries' => 'page-industries.php',
		'contact'    => 'page-contact.php',
		'rates'      => 'page-rates.php',
	);
	foreach ( $managed_templates as $slug => $filename ) {
		if ( is_page( $slug ) ) {
			$managed_template = get_stylesheet_directory() . '/' . $filename;
			if ( file_exists( $managed_template ) ) {
				return $managed_template;
			}
		}
	}
	if ( is_page( array( 'giveaways', 'competitions' ) ) ) {
		$giveaway_template = get_stylesheet_directory() . '/page-giveaways.php';
		if ( file_exists( $giveaway_template ) ) {
			return $giveaway_template;
		}
	}
	if ( is_page( 'insights' ) ) {
		$insights_template = get_stylesheet_directory() . '/page-insights.php';
		if ( file_exists( $insights_template ) ) {
			return $insights_template;
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
		'slogan'       => dkxv4_registered_slogan( dkxv4_content( 'tagline' ) ),
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


/**
 * v1.18 recovery: commercial/content page design system.
 * Homepage remains on the stable v1.15.2 layout assets.
 */
function dkxv4_commercial_experience_assets_v118() {
	if ( is_page( array( 'solutions', 'industries', 'our-work', 'legacy', 'giveaways', 'competitions' ) ) ) {
		$path = get_stylesheet_directory() . '/assets/css/commercial-v1173.css';
		wp_enqueue_style(
			'dkxv4-commercial-v1173',
			get_stylesheet_directory_uri() . '/assets/css/commercial-v1173.css',
			array( 'dkx-enterprise-v115' ),
			file_exists( $path ) ? filemtime( $path ) : '1.17.3'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dkxv4_commercial_experience_assets_v118', 999 );

/**
 * Load the Media Door design options after the existing Our Work styles.
 */
function dkxv4_work_preview_assets_v1223() {
	if ( is_page( 'our-work' ) ) {
		wp_enqueue_style(
			'dkx-our-work-options-v1223',
			get_stylesheet_directory_uri() . '/assets/css/our-work-options-v1223.css',
			array( 'dkxv4-commercial-v1173' ),
			'1.22.6'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dkxv4_work_preview_assets_v1223', 1000 );

/**
 * Load the locked Industries Infinity Switchboard experience.
 */
function dkxv4_industries_preview_assets_v1229() {
	if ( ! is_page( 'industries' ) ) {
		return;
	}

	wp_enqueue_style(
		'dkx-industries-options-v1229',
		get_stylesheet_directory_uri() . '/assets/css/industries-options-v1229.css',
		array( 'dkxv4-commercial-v1173' ),
		'1.23.2'
	);
}
add_action( 'wp_enqueue_scripts', 'dkxv4_industries_preview_assets_v1229', 1001 );

/**
 * Load the locked Insights editorial archive.
 */
function dkxv4_insights_preview_assets_v1233() {
	if ( ! is_page( 'insights' ) ) {
		return;
	}

	wp_enqueue_style(
		'dkx-insights-options-v1233',
		get_stylesheet_directory_uri() . '/assets/css/insights-options-v1233.css',
		array( 'dkx-insights-v1168' ),
		'1.23.6'
	);

	wp_enqueue_script(
		'dkx-insights-v1235',
		get_stylesheet_directory_uri() . '/assets/insights-v1235.js',
		array(),
		'1.23.6',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'dkxv4_insights_preview_assets_v1233', 1002 );

/**
 * Convert plain web addresses in editorial posts into safe clickable links.
 */
function dkxv4_linkify_editorial_urls( $content ) {
	if ( is_admin() || ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}

	return make_clickable( $content );
}
add_filter( 'the_content', 'dkxv4_linkify_editorial_urls', 20 );

/**
 * Load the locked Start a Project and 2026 Rate Card conversion system.
 */
function dkxv4_contact_rate_assets_v1227() {
	if ( ! is_page( array( 'contact', 'rates' ) ) ) {
		return;
	}

	wp_enqueue_style(
		'dkx-contact-rates-v1227',
		get_stylesheet_directory_uri() . '/assets/css/contact-rates-v1227.css',
		array( 'dkx-recovery-v1204' ),
		'1.22.8'
	);
	wp_enqueue_script(
		'dkx-contact-rates-v1227',
		get_stylesheet_directory_uri() . '/assets/contact-rates-v1227.js',
		array(),
		'1.22.8',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'dkxv4_contact_rate_assets_v1227', 1001 );

/**
 * Final locked colour and spacing pass for the approved conversion pages.
 *
 * This deliberately loads after every page-specific design system so that
 * mobile browser and legacy theme rules cannot hide the booking pulse or
 * collapse the approved display typography.
 */
function dkxv4_final_spacing_lock_assets_v1237() {
	if ( ! is_front_page() && ! is_page( array( 'home', 'solutions', 'industries', 'insights', 'contact', 'rates' ) ) ) {
		return;
	}

	wp_enqueue_style(
		'dkx-final-spacing-v1237',
		get_stylesheet_directory_uri() . '/assets/css/final-spacing-v1237.css',
		array(),
		'1.23.7'
	);
}
add_action( 'wp_enqueue_scripts', 'dkxv4_final_spacing_lock_assets_v1237', 1200 );

/**
 * Load the final combined About Page copy and its DK presentation layer.
 */
function dkxv4_about_final_assets_v1238() {
	if ( ! is_page( 'about' ) ) {
		return;
	}

	wp_enqueue_style(
		'dkx-about-final-v1238',
		get_stylesheet_directory_uri() . '/assets/css/about-final-v1238.css',
		array( 'dkx-recovery-v1204' ),
		'1.24.0'
	);
}
add_action( 'wp_enqueue_scripts', 'dkxv4_about_final_assets_v1238', 1201 );

/**
 * v1.20.4 recovery helpers.
 *
 * The v1.20.3 page templates survived the server-side Git overlay, while the
 * shared page loader did not. These helpers restore the native page fields,
 * curated media and forms used by those templates.
 */
function dkxv4_multiline_heading( $value ) {
	return nl2br( esc_html( trim( (string) $value ) ) );
}

function dkxv4_page_meta( $key, $default = '', $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	$keys    = array( '_dkx_page_' . $key, '_dkx_' . $key, 'dkx_' . $key );
	foreach ( $keys as $meta_key ) {
		if ( metadata_exists( 'post', $post_id, $meta_key ) ) {
			return get_post_meta( $post_id, $meta_key, true );
		}
	}
	return $default;
}

require_once get_stylesheet_directory() . '/inc/dk-page-content-editor.php';
require_once get_stylesheet_directory() . '/inc/dk-visual-page-studio.php';

function dkxv4_get_team_media( $key, $aliases = array() ) {
	$selected = absint( dkxv4_page_meta( 'about_' . $key . '_media_id', 0 ) );
	if ( $selected && wp_attachment_is_image( $selected ) ) {
		return get_post( $selected );
	}
	$aliases[] = $key;
	$attachments = get_posts( array( 'post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => 250, 'orderby' => 'date', 'order' => 'DESC' ) );
	foreach ( $attachments as $attachment ) {
		$haystack = strtolower( $attachment->post_title . ' ' . wp_basename( get_attached_file( $attachment->ID ) ) );
		foreach ( $aliases as $alias ) {
			if ( $alias && false !== strpos( $haystack, strtolower( $alias ) ) ) {
				return $attachment;
			}
		}
	}
	return null;
}

function dkxv4_get_work_media() {
	$meta_keys = array( '_dkx_show_in_our_work', '_dkx_our_work', '_dkx_featured_work' );
	foreach ( $meta_keys as $meta_key ) {
		$items = get_posts( array(
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'post_mime_type' => array( 'image', 'video' ),
			'posts_per_page' => 60,
			'meta_key' => $meta_key,
			'meta_value' => '1',
			'orderby' => 'menu_order date',
			'order' => 'ASC',
		) );
		if ( $items ) {
			return $items;
		}
	}
	return get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'video', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ) );
}

function dkxv4_attachment_work_field( $fields, $post ) {
	$fields['dkx_show_in_our_work'] = array(
		'label' => 'Show in DK Expressions Our Work',
		'input' => 'html',
		'html' => '<label><input type="checkbox" name="attachments[' . absint( $post->ID ) . '][_dkx_show_in_our_work]" value="1" ' . checked( get_post_meta( $post->ID, '_dkx_show_in_our_work', true ), '1', false ) . '> Include this photo/video in the Time Vault</label>',
	);
	return $fields;
}
add_filter( 'attachment_fields_to_edit', 'dkxv4_attachment_work_field', 10, 2 );

function dkxv4_save_attachment_work_field( $post, $attachment ) {
	update_post_meta( $post['ID'], '_dkx_show_in_our_work', ! empty( $attachment['_dkx_show_in_our_work'] ) ? '1' : '0' );
	return $post;
}
add_filter( 'attachment_fields_to_save', 'dkxv4_save_attachment_work_field', 10, 2 );

function dkxv4_project_enquiry_handler() {
	$redirect_url = home_url( '/contact/' );
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'project', 'sent', $redirect_url ) );
		exit;
	}
	if ( ! isset( $_POST['dkx_project_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkx_project_nonce'] ) ), 'dkx_project_enquiry' ) ) {
		wp_safe_redirect( add_query_arg( 'project', 'error', $redirect_url ) );
		exit;
	}
	$name = sanitize_text_field( wp_unslash( $_POST['project_name'] ?? '' ) );
	$email = sanitize_email( wp_unslash( $_POST['project_email'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['project_service'] ?? '' ) );
	$brief = sanitize_textarea_field( wp_unslash( $_POST['project_brief'] ?? '' ) );
	if ( ! $name || ! is_email( $email ) || ! $service || ! $brief ) {
		wp_safe_redirect( add_query_arg( 'project', 'invalid', $redirect_url ) );
		exit;
	}
	$details = array(
		'Name: ' . $name,
		'Email: ' . $email,
		'Phone: ' . sanitize_text_field( wp_unslash( $_POST['project_phone'] ?? '' ) ),
		'Company / Brand: ' . sanitize_text_field( wp_unslash( $_POST['project_company'] ?? '' ) ),
		'Project Type: ' . $service,
		'Budget: ' . sanitize_text_field( wp_unslash( $_POST['project_budget'] ?? '' ) ),
		'Timeline: ' . sanitize_text_field( wp_unslash( $_POST['project_timeline'] ?? '' ) ),
		'How they found DK Expressions: ' . sanitize_text_field( wp_unslash( $_POST['project_referral'] ?? '' ) ),
		'',
		'Project Brief:',
		$brief,
	);
	$mail_sent = wp_mail( dkxv4_content( 'contact_email' ), 'New DK Expressions project enquiry — ' . $name, implode( "\n", $details ), array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );
	wp_safe_redirect( add_query_arg( 'project', $mail_sent ? 'sent' : 'error', $redirect_url ) );
	exit;
}
add_action( 'admin_post_nopriv_dkx_project_enquiry', 'dkxv4_project_enquiry_handler' );
add_action( 'admin_post_dkx_project_enquiry', 'dkxv4_project_enquiry_handler' );

function dkxv4_time_traveller_application_handler() {
	check_admin_referer( 'dkx_time_traveller_application', 'dkx_time_traveller_nonce' );
	$name = sanitize_text_field( wp_unslash( $_POST['applicant_name'] ?? '' ) );
	$email = sanitize_email( wp_unslash( $_POST['applicant_email'] ?? '' ) );
	$reason = sanitize_textarea_field( wp_unslash( $_POST['applicant_reason'] ?? '' ) );
	if ( ! $name || ! is_email( $email ) || ! $reason ) {
		wp_safe_redirect( add_query_arg( 'application', 'invalid', home_url( '/about/#join-the-time-travellers' ) ) );
		exit;
	}
	$attachments = array();
	if ( ! empty( $_FILES['portfolio_file']['name'] ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$uploaded = wp_handle_upload( $_FILES['portfolio_file'], array( 'test_form' => false ) );
		if ( empty( $uploaded['error'] ) && ! empty( $uploaded['file'] ) ) {
			$attachments[] = $uploaded['file'];
		}
	}
	$message = "Name: {$name}\nEmail: {$email}\nRole: " . sanitize_text_field( wp_unslash( $_POST['applicant_role'] ?? '' ) ) . "\nPortfolio: " . esc_url_raw( wp_unslash( $_POST['portfolio_url'] ?? '' ) ) . "\n\nWhy they want to join:\n{$reason}";
	wp_mail( dkxv4_content( 'contact_email' ), 'Time Traveller application — ' . $name, $message, array( 'Reply-To: ' . $name . ' <' . $email . '>' ), $attachments );
	wp_safe_redirect( add_query_arg( 'application', 'sent', home_url( '/about/#join-the-time-travellers' ) ) );
	exit;
}
add_action( 'admin_post_nopriv_dkx_time_traveller_application', 'dkxv4_time_traveller_application_handler' );
add_action( 'admin_post_dkx_time_traveller_application', 'dkxv4_time_traveller_application_handler' );
