<?php
/**
 * Plugin Name: DK Expressions Navigation Scroll Behaviour
 * Description: Keeps the approved DK navigation visible only at the top of the page and hides it once the visitor scrolls down.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', function () {
	?>
	<style id="dkx-nav-scroll-behaviour">
		/* Navigation is part of the opening viewport, not a sticky/floating bar. */
		.dk-header {
			position: absolute !important;
			top: 0 !important;
			left: 0 !important;
			right: 0 !important;
			transform: translateY(0) !important;
			opacity: 1 !important;
			visibility: visible !important;
			transition: transform .24s ease, opacity .18s ease !important;
		}

		/* Existing theme JS adds .is-stuck after the visitor scrolls 45px. Hide it instead of making it sticky. */
		.dk-header.is-stuck {
			position: fixed !important;
			transform: translateY(-120%) !important;
			opacity: 0 !important;
			visibility: hidden !important;
			pointer-events: none !important;
		}

		body.admin-bar .dk-header {
			top: 32px !important;
		}

		body.admin-bar .dk-header.is-stuck {
			top: 32px !important;
		}

		@media screen and (max-width: 782px) {
			body.admin-bar .dk-header,
			body.admin-bar .dk-header.is-stuck {
				top: 46px !important;
			}
		}
	</style>
	<?php
}, 9999 );
