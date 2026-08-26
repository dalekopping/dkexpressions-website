<?php
/**
 * Plugin Name: DK Expressions Final Visual Polish
 * Description: Final launch guardrails for DK Colouring System, Time Vault branding/spacing and visual editor edit targets.
 * Version: 1.0.0
 * Author: DK Expressions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The official logo is the only mark permitted inside the Time Vault hero.
 * CSS is emitted at the very end of wp_head so older theme rules cannot
 * reintroduce glow/text-shadow treatments after this guardrail.
 */
add_action(
	'wp_head',
	function () {
		if ( is_admin() ) {
			return;
		}
		$logo = function_exists( 'dkx_logo_url' ) ? dkx_logo_url() : '';
		?>
<style id="dkx-final-visual-guardrails">
/* DK COLOURING SYSTEM — SOLID COLOUR ONLY. NO NEON TEXT/OUTLINES. */
body main *,
body .dk-site-content * {
	text-shadow: none !important;
}
body main strong,
body main b,
body .dk-site-content strong,
body .dk-site-content b,
body .dk-auto-red,
body .dkxday1-proof strong,
body .dkxday1-hero-proof > strong {
	text-shadow: none !important;
	animation: none !important;
}

/* Time Vault proof numbers use their assigned solid DK signal colour. */
body .dkxday1-proof strong,
body .dkxday1-proof article > span,
body .dkxday1-case-index,
body .dkxday1-kicker,
body .dkxday1-kicker span {
	filter: none !important;
}

/* Official DK Expressions logo only — never a plain DK monogram. */
body .dkxday1-hero-mark {
	box-shadow: none !important;
}
body .dkxday1-hero-mark span {
	display: block !important;
	width: 112px !important;
	height: 82px !important;
	background-image: url('<?php echo esc_url( $logo ); ?>') !important;
	background-position: center !important;
	background-repeat: no-repeat !important;
	background-size: contain !important;
	color: transparent !important;
	-webkit-text-fill-color: transparent !important;
	font-size: 0 !important;
	line-height: 0 !important;
	letter-spacing: 0 !important;
	text-indent: -9999px !important;
	overflow: hidden !important;
}

/* Tighten the excessive vertical gap between the Time Vault hero and proof bar. */
body .dkxday1-proof {
	padding-top: 48px !important;
	padding-bottom: 64px !important;
}

@media (max-width: 980px) {
	body .dkxday1-proof {
		padding-top: 36px !important;
		padding-bottom: 52px !important;
	}
}
</style>
		<?php
	},
	PHP_INT_MAX
);

/**
 * Some proof-card copy uses definition lists. The original visual editor only
 * recognised headings/paragraphs/links, so dt/dd clicks could fall through to
 * the card background. Wrap direct text nodes so they become first-class text
 * targets without changing the frontend markup saved by WordPress.
 */
add_action(
	'wp_footer',
	function () {
		if ( ! function_exists( 'dkxv4_is_visual_canvas_request' ) || ! dkxv4_is_visual_canvas_request() ) {
			return;
		}
		?>
<script id="dkx-visual-definition-list-targets">
(function(){
	'use strict';
	function makeEditableTargets(){
		document.querySelectorAll('main dt, main dd').forEach(function(el){
			Array.prototype.slice.call(el.childNodes).forEach(function(node){
				if(node.nodeType!==Node.TEXT_NODE || !node.nodeValue.trim()) return;
				var span=document.createElement('span');
				span.className='dkx-vps-inline-edit-target';
				span.textContent=node.nodeValue;
				el.replaceChild(span,node);
			});
		});
	}
	if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',makeEditableTargets);
	else makeEditableTargets();
})();
</script>
		<?php
	},
	PHP_INT_MAX
);

/**
 * Keep the editor inspector usable at common laptop widths. Selection becomes
 * a fixed, visible panel instead of appearing below the iframe where it can be
 * mistaken for a failed click.
 */
add_action(
	'admin_head',
	function () {
		if ( empty( $_GET['page'] ) || 'dkx-visual-page-editor' !== sanitize_key( wp_unslash( $_GET['page'] ) ) ) {
			return;
		}
		?>
<style id="dkx-vps-usability-polish">
.dkx-vps__status,
.dkx-vps__selection,
.dkx-vps__inspector section,
.dkx-vps__text-editor textarea:focus {
	box-shadow:none !important;
}
@media (max-width: 1300px) {
	.dkx-vps__selection:not([hidden]) {
		position:fixed !important;
		z-index:100100 !important;
		top:72px !important;
		right:18px !important;
		bottom:auto !important;
		left:auto !important;
		width:min(390px,calc(100vw - 72px)) !important;
		max-height:calc(100vh - 96px) !important;
		overflow:auto !important;
		background:#061019 !important;
		border:2px solid #35b8ff !important;
		margin:0 !important;
	}
	.dkx-vps__selection-heading button { display:block !important; }
}
</style>
		<?php
	},
	PHP_INT_MAX
);
