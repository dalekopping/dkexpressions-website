<?php
/**
 * Plugin Name: DK Expressions Master Measurement
 * Description: GTM/GA4 and Search Console integration layer from the 2026 Developer Handover Master Copy.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_master_gtm_id() { return defined( 'DKX_GTM_ID' ) ? DKX_GTM_ID : trim( (string) get_option( 'dkx_master_gtm_id', '' ) ); }
function dkx_master_ga4_id() { return defined( 'DKX_GA4_ID' ) ? DKX_GA4_ID : trim( (string) get_option( 'dkx_master_ga4_id', '' ) ); }
function dkx_master_gsc_token() { return defined( 'DKX_GSC_TOKEN' ) ? DKX_GSC_TOKEN : trim( (string) get_option( 'dkx_master_gsc_token', '' ) ); }

add_action( 'admin_init', function() {
	register_setting( 'dkx_master_measurement', 'dkx_master_gtm_id', array( 'sanitize_callback' => function( $v ) { $v = strtoupper( trim( (string) $v ) ); return preg_match( '/^GTM-[A-Z0-9]+$/', $v ) ? $v : ''; } ) );
	register_setting( 'dkx_master_measurement', 'dkx_master_ga4_id', array( 'sanitize_callback' => function( $v ) { $v = strtoupper( trim( (string) $v ) ); return preg_match( '/^G-[A-Z0-9]+$/', $v ) ? $v : ''; } ) );
	register_setting( 'dkx_master_measurement', 'dkx_master_gsc_token', array( 'sanitize_callback' => 'sanitize_text_field' ) );
} );

add_action( 'admin_menu', function() {
	add_options_page( 'DK SEO & Measurement', 'DK SEO & Measurement', 'manage_options', 'dkx-master-measurement', function() {
		?>
		<div class="wrap"><h1>DK SEO & Measurement</h1><p>Enter the real production IDs. GA4 must be configured as a Google tag inside this GTM container, as required by the Master Handover.</p><form method="post" action="options.php"><?php settings_fields( 'dkx_master_measurement' ); ?><table class="form-table"><tr><th><label for="dkx_master_gtm_id">Google Tag Manager</label></th><td><input class="regular-text" id="dkx_master_gtm_id" name="dkx_master_gtm_id" value="<?php echo esc_attr( dkx_master_gtm_id() ); ?>" placeholder="GTM-XXXXXXX"><p class="description">Required before production tracking can fire.</p></td></tr><tr><th><label for="dkx_master_ga4_id">GA4 Measurement ID</label></th><td><input class="regular-text" id="dkx_master_ga4_id" name="dkx_master_ga4_id" value="<?php echo esc_attr( dkx_master_ga4_id() ); ?>" placeholder="G-XXXXXXXXXX"><p class="description">Reference ID for the GA4 Google tag configured inside GTM.</p></td></tr><tr><th><label for="dkx_master_gsc_token">Search Console verification</label></th><td><input class="regular-text" id="dkx_master_gsc_token" name="dkx_master_gsc_token" value="<?php echo esc_attr( dkx_master_gsc_token() ); ?>" placeholder="google-site-verification token"></td></tr></table><?php submit_button(); ?></form></div>
		<?php
	} );
} );

add_action( 'wp_head', function() {
	$gsc = dkx_master_gsc_token();
	if ( $gsc ) echo '<meta name="google-site-verification" content="' . esc_attr( $gsc ) . '">' . "\n";
	$gtm = dkx_master_gtm_id();
	if ( ! $gtm ) return;
	?>
<script id="dkx-master-gtm">window.dataLayer=window.dataLayer||[];window.dataLayer.push({dkx_ga4_measurement_id:<?php echo wp_json_encode( dkx_master_ga4_id() ); ?>});(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',<?php echo wp_json_encode( $gtm ); ?>);</script>
	<?php
}, 1 );

add_action( 'wp_body_open', function() {
	$gtm = dkx_master_gtm_id();
	if ( $gtm ) echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $gtm ) . '" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>';
}, 1 );

add_action( 'wp_footer', function() {
	if ( is_admin() ) return;
	?>
<script id="dkx-master-conversions">(function(){'use strict';var dl=window.dataLayer=window.dataLayer||[];function push(eventName,detail){var payload=detail||{};payload.event=eventName;dl.push(payload);}document.addEventListener('click',function(e){var a=e.target&&e.target.closest?e.target.closest('a'):null;if(!a)return;var href=(a.getAttribute('href')||'').trim();var text=(a.textContent||'').replace(/\s+/g,' ').trim();if(/wa\.me|whatsapp/i.test(href))push('whatsapp_click',{link_url:href,link_text:text});if(/\.pdf(?:$|[?#])/i.test(href)||/rate card/i.test(text))push('pdf_download',{link_url:href,link_text:text,file_name:'DK-Expressions-2026-Rate-Card.pdf'});if(/start a project/i.test(text)||/\/contact\/?(?:$|[?#])/i.test(href))push('start_project_click',{link_url:href,link_text:text});},true);document.addEventListener('submit',function(e){var f=e.target;if(!f||f.tagName!=='FORM')return;var marker=((f.getAttribute('action')||'')+' '+(f.id||'')+' '+(f.className||'')).toLowerCase();if(/project|contact|brief|wpforms|dkx_project_enquiry/.test(marker))push('form_submit',{form_id:f.id||'',form_name:f.getAttribute('name')||''});},true);})();</script>
	<?php
}, 100 );
