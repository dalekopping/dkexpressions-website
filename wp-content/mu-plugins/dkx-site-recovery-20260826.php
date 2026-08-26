<?php
/**
 * DK Expressions emergency page recovery — 2026-08-26.
 * Keeps recovery isolated from the child theme.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Compatibility helper used by the Home experience. Older overlays removed the
 * helper while the template still calls it, which causes a fatal error.
 */
if ( ! function_exists( 'dkxv4_clients_post_type' ) ) {
	function dkxv4_clients_post_type() {
		foreach ( array( 'dkx_client', 'dkx_clients', 'client', 'clients', 'client_logo', 'client_logos' ) as $post_type ) {
			if ( post_type_exists( $post_type ) ) {
				return $post_type;
			}
		}
		return '';
	}
}

/**
 * Restore the last approved Our Work / Time Vault experience instead of the
 * later Day-1 wrapper that is currently failing on staging.
 */
function dkx_recovery_template_include_20260826( $template ) {
	if ( is_page( 'our-work' ) ) {
		$recovery = __DIR__ . '/dkx-our-work-recovery-template.php';
		if ( file_exists( $recovery ) ) {
			return $recovery;
		}
	}
	return $template;
}
add_filter( 'template_include', 'dkx_recovery_template_include_20260826', 1000 );

/**
 * Small, isolated CSS corrections for the current staging regressions.
 */
function dkx_recovery_styles_20260826() {
	if ( is_front_page() || is_page( array( 'home', 'solutions' ) ) ) {
		wp_register_style( 'dkx-recovery-layout-20260826', false, array(), '20260826.1' );
		wp_enqueue_style( 'dkx-recovery-layout-20260826' );
		wp_add_inline_style( 'dkx-recovery-layout-20260826', '
			html,body{overflow-x:hidden}
			.dkx1211-hero,.dkx1211-landing,.dkxhp,.dkxsr{width:100%!important;max-width:none!important;margin-left:0!important;margin-right:0!important}
			.dkxsr-shell{width:min(1280px,calc(100% - 64px))!important;max-width:none!important}
			@media(max-width:700px){.dkxsr-shell{width:calc(100% - 32px)!important}}
		' );
	}

	if ( is_page( 'industries' ) ) {
		wp_register_style( 'dkx-industries-recovery-20260826', false, array(), '20260826.1' );
		wp_enqueue_style( 'dkx-industries-recovery-20260826' );
		wp_add_inline_style( 'dkx-industries-recovery-20260826', '
			@media (min-width:901px) and (max-width:1420px){
				.dkxip-switch-hero{grid-template-columns:minmax(0,1fr) 320px!important;column-gap:44px!important;padding-left:48px!important;padding-right:48px!important}
				.dkxip-switch-copy h1{font-size:clamp(66px,6.7vw,94px)!important;line-height:.78!important;max-width:720px!important}
				.dkxip-switch-core{width:300px!important;justify-self:end!important}
				.dkxip-switch-readout{grid-column:1/-1!important;grid-template-columns:repeat(4,1fr)!important;border:1px solid var(--line)!important}
			}
			@media (min-width:901px) and (max-width:1160px){
				.dkxip-switch-hero{grid-template-columns:minmax(0,1fr) 270px!important;padding-left:34px!important;padding-right:34px!important;column-gap:30px!important}
				.dkxip-switch-copy h1{font-size:clamp(58px,6.4vw,78px)!important}
				.dkxip-switch-core{width:250px!important}
			}
		' );
	}
}
add_action( 'wp_enqueue_scripts', 'dkx_recovery_styles_20260826', 2000 );
