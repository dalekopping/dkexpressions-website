<?php
/**
 * Plugin Name: DK Expressions Rate Card Link Lock
 * Description: Forces every legacy DK Expressions rate-card link to the final 2026 downloadable PDF endpoint.
 * Version: 1.0.1
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_final_rate_card_locked_url() {
	return function_exists( 'dkx_final_rate_card_download_url' )
		? dkx_final_rate_card_download_url()
		: add_query_arg( 'dkx_rate_card', 'final-2026', home_url( '/' ) );
}

add_filter( 'the_content', function( $content ) {
	if ( ! is_string( $content ) || '' === $content ) return $content;
	$final = esc_url( dkx_final_rate_card_locked_url() );
	$content = preg_replace(
		"#https?://[^\"']+/DK-Expressions-2026-Rate-Card\\.pdf#i",
		$final,
		$content
	);
	return $content;
}, 99 );

add_action( 'wp_footer', function() {
	if ( is_admin() ) return;
	$final = dkx_final_rate_card_locked_url();
	?>
<script id="dkx-final-rate-card-link-lock">
(function(){
	'use strict';
	var finalUrl=<?php echo wp_json_encode( $final ); ?>;
	function lockLinks(root){
		(root||document).querySelectorAll('a[href]').forEach(function(a){
			var href=a.getAttribute('href')||'';
			var text=(a.textContent||'').toLowerCase();
			if(/DK-Expressions-2026-Rate-Card\.pdf/i.test(href)||(/rate card/.test(text)&&/\.pdf(?:$|[?#])/i.test(href))){
				a.setAttribute('href',finalUrl);
				a.setAttribute('download','DK-Expressions-2026-Rate-Card.pdf');
				a.setAttribute('data-dkx-rate-download','');
			}
		});
	}
	if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',function(){lockLinks(document);}); else lockLinks(document);
})();
</script>
	<?php
}, 999 );
