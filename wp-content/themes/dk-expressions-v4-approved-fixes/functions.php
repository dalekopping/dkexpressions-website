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

function dkxv4_landing_preview_key() {
	if ( ! isset( $_GET['dk-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-preview'] ) );
	return in_array( $preview_key, array( 'three-doors', 'conversion' ), true ) ? $preview_key : '';
}
function dkxv4_home_preview_key() {
	if ( ! isset( $_GET['dk-home-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-home-preview'] ) );
	return in_array( $preview_key, array( 'cinematic', 'vault', 'editorial' ), true ) ? $preview_key : '';
}
function dkxv4_solutions_preview_key() {
	if ( ! isset( $_GET['dk-solutions-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-solutions-preview'] ) );
	return in_array( $preview_key, array( 'chapters', 'matrix', 'vault' ), true ) ? $preview_key : '';
}
function dkxv4_industries_preview_key() {
	if ( ! isset( $_GET['dk-industries-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-industries-preview'] ) );
	return in_array( $preview_key, array( 'atlas', 'broadcast', 'switchboard' ), true ) ? $preview_key : '';
}
function dkxv4_insights_preview_key() {
	if ( ! isset( $_GET['dk-insights-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-insights-preview'] ) );
	return in_array( $preview_key, array( 'cinematic-grid', 'editorial-spectrum', 'timecode-stream' ), true ) ? $preview_key : '';
}
function dkxv4_work_preview_key() {
	if ( ! isset( $_GET['dk-work-preview'] ) ) { return ''; }
	$preview_key = sanitize_key( wp_unslash( $_GET['dk-work-preview'] ) );
	return in_array( $preview_key, array( 'editorial', 'field', 'archive' ), true ) ? $preview_key : '';
}

if ( ( '' !== dkxv4_landing_preview_key() || '' !== dkxv4_home_preview_key() || '' !== dkxv4_solutions_preview_key() || '' !== dkxv4_industries_preview_key() || '' !== dkxv4_insights_preview_key() || '' !== dkxv4_work_preview_key() ) && ! defined( 'DONOTCACHEPAGE' ) ) {
	define( 'DONOTCACHEPAGE', true );
}

function dkxv4_disable_experience_preview_cache() {
	$landing_preview = dkxv4_landing_preview_key();
	$home_preview = dkxv4_home_preview_key();
	$solutions_preview = dkxv4_solutions_preview_key();
	$industries_preview = dkxv4_industries_preview_key();
	$insights_preview = dkxv4_insights_preview_key();
	$work_preview = dkxv4_work_preview_key();
	if ( '' === $landing_preview && '' === $home_preview && '' === $solutions_preview && '' === $industries_preview && '' === $insights_preview && '' === $work_preview ) { return; }
	nocache_headers();
	if ( '' !== $work_preview ) { header( 'X-DK-Work-Preview: ' . $work_preview ); }
	elseif ( '' !== $insights_preview ) { header( 'X-DK-Insights-Preview: ' . $insights_preview ); }
	elseif ( '' !== $industries_preview ) { header( 'X-DK-Industries-Preview: ' . $industries_preview ); }
	elseif ( '' !== $solutions_preview ) { header( 'X-DK-Solutions-Preview: ' . $solutions_preview ); }
	elseif ( '' !== $home_preview ) { header( 'X-DK-Home-Preview: ' . $home_preview ); }
	else { header( 'X-DK-Landing-Preview: ' . $landing_preview ); }
}
add_action( 'template_redirect', 'dkxv4_disable_experience_preview_cache', 0 );

function dkxv4_is_three_doors_landing_preview() { return 'three-doors' === dkxv4_landing_preview_key(); }
function dkxv4_is_conversion_landing_preview() { return 'conversion' === dkxv4_landing_preview_key(); }

function dkxv4_package_catalog() {
	return array(
		'event-entry'=>array('label'=>'Event Domination — Entry','price'=>'R6,500 / event','service'=>'Event Coverage','budget'=>'Under R15k'),
		'event-spark'=>array('label'=>'Event Domination — Spark','price'=>'R6,500 / event','service'=>'Event Coverage','budget'=>'Under R15k'),
		'event-signature'=>array('label'=>'Event Domination — Signature','price'=>'R32,000 / event','service'=>'Event Coverage','budget'=>'R15k–R35k'),
		'event-premium'=>array('label'=>'Event Domination — Premium','price'=>'From R95,000','service'=>'Event Coverage','budget'=>'R75k+'),
		'event-takeover'=>array('label'=>'Event Domination — Takeover','price'=>'From R95,000','service'=>'Event Coverage','budget'=>'R75k+'),
		'retainer-entry'=>array('label'=>'Brand Retainer — Entry','price'=>'R15,000 / month','service'=>'Brand Retainer','budget'=>'R15k–R35k'),
		'always-essential'=>array('label'=>'Always On — Essential','price'=>'R15,000 / month','service'=>'Brand Retainer','budget'=>'R15k–R35k'),
		'retainer-core'=>array('label'=>'Brand Retainer — Core','price'=>'R35,000 / month','service'=>'Brand Retainer','budget'=>'R35k–R75k'),
		'always-premium'=>array('label'=>'Always On — Premium','price'=>'R35,000 / month','service'=>'Brand Retainer','budget'=>'R35k–R75k'),
		'retainer-premium'=>array('label'=>'Brand Retainer — Premium','price'=>'From R60,000 / month','service'=>'Brand Retainer','budget'=>'R35k–R75k'),
		'always-elite'=>array('label'=>'Always On — Elite','price'=>'From R60,000 / month','service'=>'Brand Retainer','budget'=>'R35k–R75k'),
		'name-starter'=>array('label'=>'Become the Name — Starter','price'=>'R18,000 / month','service'=>'Executive Branding','budget'=>'R15k–R35k'),
		'name-growth'=>array('label'=>'Become the Name — Growth','price'=>'R40,000 / month','service'=>'Executive Branding','budget'=>'R35k–R75k'),
		'name-authority'=>array('label'=>'Become the Name — Authority','price'=>'From R75,000 / month','service'=>'Executive Branding','budget'=>'R75k+'),
		'attention-feature'=>array('label'=>'Own the Attention — Feature','price'=>'R1,500 / placement','service'=>'Campaign / Launch','budget'=>'Under R15k'),
		'attention-spotlight'=>array('label'=>'Own the Attention — Spotlight','price'=>'R6,000 / campaign','service'=>'Campaign / Launch','budget'=>'Under R15k'),
		'attention-headline'=>array('label'=>'Own the Attention — Headline','price'=>'R12,500 / campaign','service'=>'Campaign / Launch','budget'=>'Under R15k'),
	);
}
function dkxv4_package_contact_url( $package_slug = '' ) {
	$package_slug = sanitize_key( $package_slug ); $catalog = dkxv4_package_catalog(); $url = home_url( '/contact/' );
	if ( $package_slug && isset( $catalog[$package_slug] ) ) { $url = add_query_arg( 'package', $package_slug, $url ); }
	return $url . '#project-brief';
}

function dkx_fixes_assets() {
	$release = '1.32.1';
	wp_enqueue_style('dkx-parent-style',get_template_directory_uri().'/style.css',array(),'1.0.0');
	wp_enqueue_style('dkx-approved-fixes',get_stylesheet_uri(),array('dkx-parent-style'),$release);
	wp_enqueue_style('dkx-footer-v1176',get_stylesheet_directory_uri().'/assets/css/footer-v1176.css',array('dkx-approved-fixes'),$release);
	wp_enqueue_style('dkx-enterprise-v115',get_stylesheet_directory_uri().'/assets/enterprise-v115.css',array('dkx-approved-fixes'),$release);
	wp_enqueue_style('dkx-branding-v1200',get_stylesheet_directory_uri().'/assets/css/branding-v1200.css',array('dkx-footer-v1176','dkx-enterprise-v115'),$release);
	wp_enqueue_style('dkx-recovery-v1204',get_stylesheet_directory_uri().'/assets/css/recovery-v1204.css',array('dkx-branding-v1200'),$release);
	if ( is_home() || is_archive() || is_page('insights') ) wp_enqueue_style('dkx-insights-v1168',get_stylesheet_directory_uri().'/assets/insights-v1168.css',array('dkx-enterprise-v115'),$release);
	if ( is_singular('post') ) wp_enqueue_style('dkx-post-links-v1236',get_stylesheet_directory_uri().'/assets/css/post-links-v1236.css',array('dkx-enterprise-v115'),$release);
	wp_enqueue_script('dkx-mobile-fixes',get_stylesheet_directory_uri().'/assets/mobile-fixes.js',array(),$release,true);
	wp_enqueue_script('dkx-semantic-highlights',get_stylesheet_directory_uri().'/assets/semantic-highlights.js',array(),$release,true);
	wp_localize_script('dkx-semantic-highlights','dkxHighlightConfig',array('additionalLocations'=>preg_split('/\R/',dkxv4_content('highlight_locations'),-1,PREG_SPLIT_NO_EMPTY)));
	if ( is_front_page() || is_page('home') || dkxv4_is_three_doors_landing_preview() || dkxv4_is_conversion_landing_preview() ) wp_enqueue_style('dkx-home-v1200',get_stylesheet_directory_uri().'/assets/css/home-v1200.css',array('dkx-recovery-v1204'),$release);
	if ( is_page('home') || dkxv4_is_conversion_landing_preview() ) wp_enqueue_style('dkx-landing-conversion-v1209',get_stylesheet_directory_uri().'/assets/css/landing-conversion-v1209.css',array('dkx-home-v1200'),$release);
	if ( is_page('home') ) wp_enqueue_style('dkx-home-options-v1213',get_stylesheet_directory_uri().'/assets/css/home-options-v1213.css',array('dkx-home-v1200'),$release);
	if ( is_front_page() ) wp_enqueue_style('dkx-landing-final-v1211',get_stylesheet_directory_uri().'/assets/css/landing-final-v1211.css',array('dkx-home-v1200'),$release);
	if ( is_front_page() || is_page(array('home','solutions')) ) wp_enqueue_style('dkx-booking-pulse-v1221',get_stylesheet_directory_uri().'/assets/css/booking-pulse-v1221.css',array('dkx-branding-v1200'),$release);
	if ( is_page('solutions') ) wp_enqueue_style('dkx-solutions-v1197',get_stylesheet_directory_uri().'/assets/css/solutions-v1197.css',array('dkx-recovery-v1204'),$release);
	/* Rates uses the exact active Solutions package renderer, so it must load the exact same package stylesheet. */
	if ( is_page(array('solutions','rates')) ) wp_enqueue_style('dkx-solutions-options-v1220',get_stylesheet_directory_uri().'/assets/css/solutions-options-v1220.css',array(is_page('solutions')?'dkx-solutions-v1197':'dkx-recovery-v1204'),$release);
	if ( is_page('industries') ) wp_enqueue_style('dkx-solutions-options-v1220',get_stylesheet_directory_uri().'/assets/css/solutions-options-v1220.css',array('dkx-recovery-v1204'),$release);
	if ( is_page(array('giveaways','competitions')) || is_singular('dkx_giveaway') ) wp_enqueue_script('dkx-giveaways',get_stylesheet_directory_uri().'/assets/giveaways.js',array(),$release,true);
}
add_action('wp_enqueue_scripts','dkx_fixes_assets',20);

function dkxv4_force_enterprise_home_template( $template ) {
	$managed_templates=array('home'=>'page-home.php','about'=>'page-about.php','solutions'=>'page-solutions.php','our-work'=>'page-our-work.php','industries'=>'page-industries.php','contact'=>'page-contact.php','rates'=>'page-rates.php');
	foreach($managed_templates as $slug=>$filename){if(is_page($slug)){ $managed_template=get_stylesheet_directory().'/'.$filename; if(file_exists($managed_template)) return $managed_template; }}
	if(is_page(array('giveaways','competitions'))){$giveaway_template=get_stylesheet_directory().'/page-giveaways.php';if(file_exists($giveaway_template))return $giveaway_template;}
	if(is_page('insights')){$insights_template=get_stylesheet_directory().'/page-insights.php';if(file_exists($insights_template))return $insights_template;}
	return $template;
}
add_filter('template_include','dkxv4_force_enterprise_home_template',99);

/* Remaining theme functions continue below via the existing includes/hooks loaded by WordPress. */
