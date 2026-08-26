<?php
/**
 * Plugin Name: DK Expressions Mobile Critical Fixes
 * Description: Final mobile overrides for Insights category navigation and Home analytics DK colour system.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_footer', function() {
	if ( is_admin() ) return;
	?>
<style id="dkx-mobile-critical-fixes">
/* HOME analytics — solid DK colours, no glow. Scoped by component classes rather than page condition. */
.dkxhp .dkxhp-analytics-grid article strong,
.dkxhp .dkxhp-analytics-grid article > span {
	text-shadow:none!important;
	filter:none!important;
}
.dkxhp .dkxhp-analytics-grid .is-visits strong,
.dkxhp .dkxhp-analytics-grid .is-visits > span {
	color:#40b8ff!important;
	-webkit-text-fill-color:#40b8ff!important;
}
.dkxhp .dkxhp-analytics-grid .is-pages strong,
.dkxhp .dkxhp-analytics-grid .is-pages > span {
	color:#ffc34f!important;
	-webkit-text-fill-color:#ffc34f!important;
}
.dkxhp .dkxhp-analytics-grid .is-hits strong,
.dkxhp .dkxhp-analytics-grid .is-hits > span {
	color:#976dff!important;
	-webkit-text-fill-color:#976dff!important;
}
.dkxhp .dkxhp-analytics-grid .is-live strong,
.dkxhp .dkxhp-analytics-grid .is-live > span {
	color:#20d7c8!important;
	-webkit-text-fill-color:#20d7c8!important;
}

/* INSIGHTS mobile category strip — normal document flow only. */
@media (max-width: 820px) {
	.dkxoi .dkxoi-categories {
		position:static!important;
		inset:auto!important;
		top:auto!important;
		left:auto!important;
		right:auto!important;
		bottom:auto!important;
		z-index:1!important;
		transform:none!important;
		margin-top:0!important;
		margin-bottom:72px!important;
		backdrop-filter:none!important;
		-webkit-backdrop-filter:none!important;
	}
	.dkxoi .dkxoi-channel-head {
		grid-template-columns:minmax(0,1fr)!important;
		gap:22px!important;
		min-width:0!important;
	}
	.dkxoi .dkxoi-channel-head > div {
		min-width:0!important;
		width:100%!important;
	}
	.dkxoi .dkxoi-channel-head h2 {
		max-width:100%!important;
		font-size:clamp(38px,10.6vw,58px)!important;
		line-height:.88!important;
		letter-spacing:-.055em!important;
		word-break:normal!important;
		overflow-wrap:normal!important;
		hyphens:none!important;
	}
	.dkxoi .dkxoi-channel-head > span {
		justify-self:start!important;
	}
}
</style>
<script id="dkx-mobile-critical-fixes-js">
(function(){
	'use strict';
	function apply(){
		if(window.matchMedia && window.matchMedia('(max-width: 820px)').matches){
			document.querySelectorAll('.dkxoi-categories').forEach(function(nav){
				nav.style.setProperty('position','static','important');
				nav.style.setProperty('top','auto','important');
				nav.style.setProperty('left','auto','important');
				nav.style.setProperty('right','auto','important');
				nav.style.setProperty('bottom','auto','important');
				nav.style.setProperty('transform','none','important');
				nav.style.setProperty('z-index','1','important');
			});
		}
		var colours={
			'is-visits':'#40b8ff',
			'is-pages':'#ffc34f',
			'is-hits':'#976dff',
			'is-live':'#20d7c8'
		};
		Object.keys(colours).forEach(function(cls){
			document.querySelectorAll('.dkxhp-analytics-grid .'+cls+' strong, .dkxhp-analytics-grid .'+cls+' > span').forEach(function(el){
				el.style.setProperty('color',colours[cls],'important');
				el.style.setProperty('-webkit-text-fill-color',colours[cls],'important');
				el.style.setProperty('text-shadow','none','important');
			});
		});
	}
	if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',apply,{once:true}); else apply();
	window.addEventListener('resize',apply,{passive:true});
})();
</script>
	<?php
}, PHP_INT_MAX );
