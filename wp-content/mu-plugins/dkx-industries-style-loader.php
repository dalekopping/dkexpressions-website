<?php
/**
 * Plugin Name: DK Expressions Industries Style Loader
 * Description: Ensures the locked Infinity Switchboard stylesheet is loaded only on the Industries page, with collision-safe responsive hero sizing.
 * Version: 1.1.0
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
		'1.32.2'
	);

	/*
	 * The original Switchboard hero uses three desktop columns and a very large
	 * display title. At common 1024–1280px laptop widths that combination can
	 * cause the headline, orbit and readout to occupy the same visual space.
	 * Keep the approved design, but move the readout below the hero pair and
	 * reduce the title/core proportion before the mobile breakpoint is reached.
	 */
	$css = <<<'CSS'
@media (min-width: 821px) and (max-width: 1280px) {
	.dkxip--switchboard .dkxip-switch-hero {
		grid-template-columns: minmax(0, 1fr) minmax(270px, 340px) !important;
		grid-template-rows: auto 1fr auto !important;
		column-gap: clamp(26px, 4vw, 52px) !important;
		row-gap: 38px !important;
		min-height: 760px !important;
		padding: 54px clamp(28px, 5vw, 58px) 64px !important;
		align-items: center !important;
	}
	.dkxip--switchboard .dkxip-switch-topline {
		grid-column: 1 / -1 !important;
	}
	.dkxip--switchboard .dkxip-switch-copy {
		grid-column: 1 !important;
		grid-row: 2 !important;
		position: relative !important;
		z-index: 3 !important;
		max-width: 100% !important;
	}
	.dkxip--switchboard .dkxip-switch-copy h1 {
		font-size: clamp(58px, 7vw, 88px) !important;
		line-height: .79 !important;
		max-width: 690px !important;
		letter-spacing: -.06em !important;
	}
	.dkxip--switchboard .dkxip-switch-core {
		grid-column: 2 !important;
		grid-row: 2 !important;
		width: min(100%, 330px) !important;
		justify-self: center !important;
		position: relative !important;
		z-index: 2 !important;
	}
	.dkxip--switchboard .dkxip-switch-readout {
		grid-column: 1 / -1 !important;
		grid-row: 3 !important;
		position: relative !important;
		z-index: 4 !important;
		width: 100% !important;
		margin: 0 !important;
	}
}

@media (min-width: 1281px) and (max-width: 1500px) {
	.dkxip--switchboard .dkxip-switch-copy h1 {
		font-size: clamp(72px, 7.2vw, 108px) !important;
		line-height: .77 !important;
	}
	.dkxip--switchboard .dkxip-switch-core {
		width: min(100%, 360px) !important;
	}
}
CSS;

	wp_add_inline_style( $handle, $css );
}, 100 );
