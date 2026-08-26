<?php
/**
 * Plugin Name: DK Expressions Master Local SEO
 * Description: Contact-page NAP and Johannesburg map from the 2026 Developer Handover Master Copy.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'get_footer', function() {
	if ( ! is_page( array( 'contact', 'start-a-project' ) ) ) return;
	?>
	<section class="dkx-local-seo" aria-labelledby="dkx-local-heading">
		<div class="dkx-local-seo__inner">
			<div class="dkx-local-seo__copy"><p>DK / JOHANNESBURG</p><h2 id="dkx-local-heading">Johannesburg.<br>South Africa.</h2><dl><div><dt>Name</dt><dd>DK Expressions</dd></div><div><dt>Phone</dt><dd><a href="tel:+27722460451">+27 72 246 0451</a></dd></div><div><dt>Email</dt><dd><a href="mailto:advertise@dkexpressions.co.za">advertise@dkexpressions.co.za</a></dd></div><div><dt>Location</dt><dd>Johannesburg, South Africa</dd></div></dl></div>
			<div class="dkx-local-seo__map"><iframe title="DK Expressions Johannesburg service area" src="https://www.google.com/maps?q=Johannesburg%2C%20South%20Africa&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
		</div>
	</section>
	<style id="dkx-local-seo-style">.dkx-local-seo{background:#031019;color:#fff;padding:clamp(75px,8vw,125px) 0;border-top:1px solid rgba(64,184,255,.24)}.dkx-local-seo *{box-sizing:border-box;text-shadow:none!important}.dkx-local-seo__inner{width:min(1280px,calc(100% - 64px));margin:auto;display:grid;grid-template-columns:.8fr 1.2fr;gap:clamp(35px,6vw,85px);align-items:stretch}.dkx-local-seo__copy>p{color:#40b8ff;font:900 9px/1 Arial,sans-serif;letter-spacing:.18em}.dkx-local-seo h2{margin:22px 0 40px;font:900 clamp(48px,6vw,90px)/.84 "Arial Black",Arial,sans-serif;letter-spacing:-.065em;text-transform:uppercase}.dkx-local-seo dl{margin:0;border-top:1px solid rgba(64,184,255,.24)}.dkx-local-seo dl div{display:grid;grid-template-columns:90px 1fr;gap:20px;padding:15px 0;border-bottom:1px solid rgba(64,184,255,.18)}.dkx-local-seo dt{color:#ffc34f;font:900 9px/1.3 Arial,sans-serif;letter-spacing:.1em;text-transform:uppercase}.dkx-local-seo dd{margin:0;color:#c5d3dc;font:700 13px/1.5 Arial,sans-serif}.dkx-local-seo a{color:inherit}.dkx-local-seo__map{min-height:420px;border:1px solid rgba(64,184,255,.36)}.dkx-local-seo iframe{display:block;width:100%;height:100%;min-height:420px;border:0;filter:grayscale(1) invert(.88) contrast(.9)}@media(max-width:760px){.dkx-local-seo__inner{width:calc(100% - 32px);grid-template-columns:1fr}.dkx-local-seo__map,.dkx-local-seo iframe{min-height:330px}}
	</style>
	<?php
}, 4 );
