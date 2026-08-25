<?php
/**
 * Plugin Name: DK Expressions Measurement
 * Description: GTM loader, GA4 data layer, launch conversion events and basic Consent Mode v2.
 * Version: 1.1.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function dkx_measurement_gtm_id(){
	if(defined('DKX_GTM_CONTAINER_ID')&&DKX_GTM_CONTAINER_ID)return DKX_GTM_CONTAINER_ID;
	return (string)get_option('dkx_gtm_container_id','');
}
function dkx_measurement_ga4_id(){
	if(defined('DKX_GA4_MEASUREMENT_ID')&&DKX_GA4_MEASUREMENT_ID)return DKX_GA4_MEASUREMENT_ID;
	return (string)get_option('dkx_ga4_measurement_id','');
}
add_action('admin_init',function(){
	register_setting('dkx_measurement','dkx_gtm_container_id',array('type'=>'string','default'=>'','sanitize_callback'=>function($v){$v=strtoupper(trim((string)$v));return preg_match('/^GTM-[A-Z0-9]+$/',$v)?$v:'';}));
	register_setting('dkx_measurement','dkx_ga4_measurement_id',array('type'=>'string','default'=>'','sanitize_callback'=>function($v){$v=strtoupper(trim((string)$v));return preg_match('/^G-[A-Z0-9]+$/',$v)?$v:'';}));
});
add_action('admin_menu',function(){
	add_options_page('DK Measurement','DK Measurement','manage_options','dkx-measurement',function(){?>
	<div class="wrap"><h1>DK Measurement</h1><p>Enter the production Google Tag Manager container ID and GA4 Measurement ID. Configure GA4 as a Google tag inside the same GTM container.</p><form method="post" action="options.php"><?php settings_fields('dkx_measurement'); ?><table class="form-table" role="presentation"><tr><th><label for="dkx_gtm_container_id">GTM Container ID</label></th><td><input class="regular-text" id="dkx_gtm_container_id" name="dkx_gtm_container_id" value="<?php echo esc_attr(get_option('dkx_gtm_container_id','')); ?>" placeholder="GTM-XXXXXXX"></td></tr><tr><th><label for="dkx_ga4_measurement_id">GA4 Measurement ID</label></th><td><input class="regular-text" id="dkx_ga4_measurement_id" name="dkx_ga4_measurement_id" value="<?php echo esc_attr(get_option('dkx_ga4_measurement_id','')); ?>" placeholder="G-XXXXXXXXXX"></td></tr></table><?php submit_button(); ?></form></div>
	<?php;});
});

add_action('wp_head',function(){
	if(is_admin())return;
	$gtm=dkx_measurement_gtm_id();$ga4=dkx_measurement_ga4_id();?>
<script id="dkx-consent-mode">window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}try{var dkxConsent=localStorage.getItem('dkx_consent')||'';}catch(e){var dkxConsent='';}gtag('consent','default',{ad_storage:'denied',analytics_storage:dkxConsent==='granted'?'granted':'denied',ad_user_data:'denied',ad_personalization:'denied',functionality_storage:'granted',security_storage:'granted',wait_for_update:500});window.dkxSetConsent=function(choice){var allow=choice==='granted';try{localStorage.setItem('dkx_consent',allow?'granted':'denied');}catch(e){}gtag('consent','update',{analytics_storage:allow?'granted':'denied',ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied'});window.dataLayer.push({event:'dkx_consent_update',analytics_consent:allow?'granted':'denied'});};<?php if($ga4): ?>window.dataLayer.push({dkx_ga4_measurement_id:<?php echo wp_json_encode($ga4); ?>});<?php endif; ?></script>
<?php if($gtm): ?><script id="dkx-gtm">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',<?php echo wp_json_encode($gtm); ?>);</script><?php endif;
},0);

add_action('wp_body_open',function(){
	$gtm=dkx_measurement_gtm_id();if(!$gtm)return;
	echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.esc_attr($gtm).'" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>';
},1);

add_action('wp_footer',function(){if(is_admin())return;?>
<style id="dkx-consent-style">#dkx-consent{position:fixed;z-index:9998;left:18px;right:18px;bottom:18px;display:none;align-items:center;justify-content:space-between;gap:20px;max-width:900px;margin:auto;padding:16px 18px;border:1px solid rgba(64,184,255,.42);background:#06111d;color:#fff;font:13px/1.55 Arial,sans-serif}#dkx-consent p{margin:0;max-width:620px}#dkx-consent div{display:flex;gap:8px;flex-wrap:wrap}#dkx-consent button{min-height:40px;padding:0 14px;border:1px solid #40b8ff;background:#40b8ff;color:#02070c;font-size:10px;font-weight:900;letter-spacing:.08em;text-transform:uppercase;cursor:pointer}#dkx-consent button[data-choice="denied"]{background:transparent;color:#fff}@media(max-width:650px){#dkx-consent{align-items:flex-start;flex-direction:column}#dkx-consent div,#dkx-consent button{width:100%}}</style>
<div id="dkx-consent" role="dialog" aria-label="Analytics preferences"><p>We use essential storage to run the site and optional analytics to understand what visitors use. You can choose whether analytics storage is enabled.</p><div><button type="button" data-choice="granted">Accept analytics</button><button type="button" data-choice="denied">Essential only</button></div></div>
<script id="dkx-conversion-events">(function(){'use strict';var dl=window.dataLayer=window.dataLayer||[];function push(name,extra){var p=extra||{};p.event=name;dl.push(p);}function once(key,callback){try{if(sessionStorage.getItem(key))return;sessionStorage.setItem(key,'1');}catch(e){}callback();}document.addEventListener('click',function(e){var a=e.target&&e.target.closest?e.target.closest('a'):null;if(!a)return;var href=(a.getAttribute('href')||'').trim(),text=(a.textContent||'').trim();if(/wa\.me|whatsapp/i.test(href))push('whatsapp_click',{link_url:href,link_text:text});if(/\.pdf(?:$|[?#])/i.test(href)||/rate card/i.test(text))push('rate_card_download',{link_url:href,link_text:text});if(/start a project/i.test(text)||/\/contact\/?(?:$|[?#])/i.test(href))push('start_project_click',{link_url:href,link_text:text});},true);document.addEventListener('submit',function(e){var f=e.target;if(!f||f.tagName!=='FORM')return;var marker=(f.getAttribute('action')||'')+' '+(f.id||'')+' '+(f.className||'');if(/contact|project|brief|wpforms|dk-native-entry/i.test(marker))push('form_submit',{form_id:f.id||''});},true);document.addEventListener('DOMContentLoaded',function(){var params=new URLSearchParams(window.location.search);if(/\/contact\/?$/.test(window.location.pathname)&&params.get('project')==='sent'){once('dkx_generate_lead_'+window.location.pathname+window.location.search,function(){push('generate_lead',{lead_source:'project_brief',package:params.get('package')||''});});}var b=document.getElementById('dkx-consent');if(!b)return;var saved='';try{saved=localStorage.getItem('dkx_consent')||'';}catch(e){}if(!saved)b.style.display='flex';b.addEventListener('click',function(e){var btn=e.target.closest('button[data-choice]');if(!btn)return;window.dkxSetConsent(btn.getAttribute('data-choice'));b.style.display='none';});});})();</script>
<?php;},99);
