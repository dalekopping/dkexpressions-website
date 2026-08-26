<?php
/**
 * Plugin Name: DK Expressions Industries Style Loader
 * Description: Ensures the locked Infinity Switchboard stylesheet is loaded only on the Industries page, with collision-safe responsive hero sizing.
 * Version: 1.2.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {
	if ( ! is_page( 'industries' ) ) return;

	$theme_uri = get_stylesheet_directory_uri();
	$handle    = 'dkx-industries-options-v1229';

	wp_enqueue_style(
		$handle,
		$theme_uri . '/assets/css/industries-options-v1229.css',
		array( 'dkx-recovery-v1204' ),
		'1.32.3'
	);

	$css = <<<'CSS'
/* Keep the approved Infinity Switchboard visual language, but reserve real
   space for the headline, official logo/orbit and right-side readout. */
@media (min-width: 821px) and (max-width: 1360px) {
	.dkxip--switchboard .dkxip-switch-hero {
		grid-template-columns: minmax(0, 1fr) minmax(240px, 300px) !important;
		grid-template-rows: auto 1fr auto !important;
		column-gap: 28px !important;
		row-gap: 34px !important;
		min-height: 760px !important;
		padding: 48px 34px 60px !important;
		align-items: center !important;
	}
	.dkxip--switchboard .dkxip-switch-topline { grid-column: 1 / -1 !important; }
	.dkxip--switchboard .dkxip-switch-copy {
		grid-column: 1 !important;
		grid-row: 2 !important;
		min-width: 0 !important;
		max-width: 100% !important;
		position: relative !important;
		z-index: 3 !important;
	}
	.dkxip--switchboard .dkxip-switch-copy h1 {
		max-width: 610px !important;
		font-size: clamp(54px, 5.9vw, 76px) !important;
		line-height: .80 !important;
		letter-spacing: -.055em !important;
	}
	.dkxip--switchboard .dkxip-switch-core {
		grid-column: 2 !important;
		grid-row: 2 !important;
		width: min(100%, 285px) !important;
		justify-self: end !important;
		position: relative !important;
		right: auto !important;
		bottom: auto !important;
		z-index: 2 !important;
	}
	.dkxip--switchboard .dkxip-switch-readout {
		grid-column: 1 / -1 !important;
		grid-row: 3 !important;
		position: relative !important;
		width: 100% !important;
		margin: 0 !important;
		z-index: 4 !important;
	}
}

@media (min-width: 1361px) and (max-width: 1540px) {
	.dkxip--switchboard .dkxip-switch-hero {
		grid-template-columns: minmax(0,1fr) minmax(300px,350px) minmax(180px,210px) !important;
		column-gap: 34px !important;
		padding-left: 50px !important;
		padding-right: 50px !important;
	}
	.dkxip--switchboard .dkxip-switch-copy h1 {
		max-width: 690px !important;
		font-size: clamp(68px, 6.4vw, 94px) !important;
		line-height: .78 !important;
	}
	.dkxip--switchboard .dkxip-switch-core { width: min(100%, 330px) !important; }
}

/* DK colour system only — no neon/glow treatment. */
.dkxip--switchboard,
.dkxip--switchboard * { text-shadow: none !important; }
CSS;

	wp_add_inline_style( $handle, $css );
}, 100 );
