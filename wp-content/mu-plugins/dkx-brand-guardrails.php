<?php
/**
 * Plugin Name: DK Expressions Brand Guardrails
 * Description: Launch-safe visual rules: DK Colouring System only, official branding, and non-sticky primary navigation.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_head', function () {
	if ( is_admin() ) { return; }
	?>
<style id="dkx-brand-guardrails">
/* DK Colouring System: solid colour only. Never neon/glow typography. */
.dk-auto-red,
.dk-site-content strong,.dk-site-content b,
main strong,main b,
[class*="metric"] strong,[class*="proof"] strong,[class*="stat"] strong,
[class*="kicker"],[class*="signal"],[class*="number"],[class*="index"] {
	text-shadow:none!important;
	-webkit-text-stroke:0!important;
	filter:none!important;
}

/* Remove luminous halo effects while keeping the approved solid borders/colours. */
.dk-portal,.dk-portal:before,.dk-portal:after,
.dk-home-orbit,.dk-home-orbit:before,.dk-home-orbit:after,
.dk-about-orbit,.dk-about-orbit:before,.dk-about-orbit:after,
.dk-page-ring,.dk-page-ring:after,
.dk-giveaway-rings,.dk-giveaway-rings:before,.dk-giveaway-rings:after,
.dk-work-card:before,.dk-card:after,
.dkxday1-hero-mark,.dkxday1-hero-mark:before,
.dk-about-shot-orbit,.dk-about-vault-orbit,.dk-about-vault-orbit i {
	box-shadow:none!important;
	filter:none!important;
}

/* The official logo must render cleanly, never as a glowing substitute. */
.dk-brand img,.dk-footer-logo img,[data-dkx-global-media="logo"] {
	filter:none!important;
	text-shadow:none!important;
}

/* Primary navigation belongs at the top of the document and must never follow scrolling. */
.dk-header,.dk-header.is-stuck {
	position:absolute!important;
	top:0!important;
	left:0!important;
	right:0!important;
	backdrop-filter:none!important;
}
.admin-bar .dk-header,.admin-bar .dk-header.is-stuck { top:32px!important; }
@media (max-width:782px) {
	.admin-bar .dk-header,.admin-bar .dk-header.is-stuck { top:46px!important; }
}

/* Time Vault brand mark: official DK Expressions logo only; never a text "DK" monogram. */
.dkxday1-hero-mark span {
	display:block!important;
	width:104px!important;
	height:72px!important;
	overflow:hidden!important;
	background:url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/dk-expressions-logo-white-tight.png' ); ?>') center/contain no-repeat!important;
	color:transparent!important;
	font-size:0!important;
	line-height:0!important;
	text-indent:-9999px!important;
}
</style>
	<?php
}, 100 );
