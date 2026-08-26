<?php
/**
 * Plugin Name: DK Expressions Mobile Polish & Legacy Rates
 * Description: Mobile Insights fixes, DK-coloured Home analytics and the Legacy rate-card replacement.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', function() {
	?>
	<style id="dkx-mobile-polish-2026">
	/* HOME — enforce the solid DK colour system on server analytics. */
	<?php if ( is_page( 'home' ) ) : ?>
	.dkxhp-analytics-grid article strong,
	.dkxhp-analytics-grid article > span { text-shadow:none!important; filter:none!important; }
	.dkxhp-analytics-grid .is-visits strong,.dkxhp-analytics-grid .is-visits>span{color:#40b8ff!important}
	.dkxhp-analytics-grid .is-pages strong,.dkxhp-analytics-grid .is-pages>span{color:#ffc34f!important}
	.dkxhp-analytics-grid .is-hits strong,.dkxhp-analytics-grid .is-hits>span{color:#976dff!important}
	.dkxhp-analytics-grid .is-live strong,.dkxhp-analytics-grid .is-live>span{color:#20d7c8!important}
	.dkxhp-site-stats>div article:nth-child(4n+1) strong{color:#40b8ff!important}
	.dkxhp-site-stats>div article:nth-child(4n+2) strong{color:#ffc34f!important}
	.dkxhp-site-stats>div article:nth-child(4n+3) strong{color:#976dff!important}
	.dkxhp-site-stats>div article:nth-child(4n+4) strong{color:#20d7c8!important}
	<?php endif; ?>

	/* INSIGHTS — category navigation scrolls with the page on mobile, never sticks. */
	<?php if ( is_page( 'insights' ) || is_home() ) : ?>
	@media (max-width:820px){
		.dkxoi-categories{position:relative!important;top:auto!important;left:auto!important;right:auto!important;transform:none!important;backdrop-filter:none!important;margin-bottom:72px!important}
		.dkxoi-channel-head{grid-template-columns:1fr!important;gap:24px!important;min-width:0!important}
		.dkxoi-channel-head>div{min-width:0!important;width:100%!important}
		.dkxoi-channel-head h2{max-width:100%!important;font-size:clamp(44px,10.8vw,66px)!important;line-height:.86!important;letter-spacing:-.065em!important;overflow-wrap:normal!important;word-break:normal!important;hyphens:none!important}
		.dkxoi-channel-head>span{justify-self:start!important}
		.dkxoi-channel{min-width:0!important}
	}
	@media (max-width:520px){
		.dkxoi-channel-head h2{font-size:clamp(40px,11vw,56px)!important;letter-spacing:-.055em!important}
	}
	<?php endif; ?>

	/* LEGACY — solid DK rate-card system. */
	<?php if ( is_page( 'legacy' ) ) : ?>
	.dkx-legacy-rates{--blue:#40b8ff;--gold:#ffc34f;--purple:#976dff;--red:#ff5364;--teal:#20d7c8;--ink:#02070c;--panel:#07131c;width:min(1240px,calc(100% - 40px));margin:0 auto;padding:90px 0 120px;color:#fff}
	.dkx-legacy-rates *{box-sizing:border-box;text-shadow:none!important}
	.dkx-legacy-rates__head{border-top:4px solid var(--blue);padding-top:28px;margin-bottom:36px}
	.dkx-legacy-rates__head p{margin:0 0 16px;color:var(--blue);font:900 11px/1 Arial,sans-serif;letter-spacing:.18em;text-transform:uppercase}
	.dkx-legacy-rates__head h2{margin:0;font:900 clamp(48px,7vw,92px)/.82 "Arial Black",Arial,sans-serif;letter-spacing:-.06em;text-transform:uppercase;color:#fff}
	.dkx-legacy-rates__head h2 em{color:var(--blue);font-style:normal}
	.dkx-legacy-rates__grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
	.dkx-legacy-rate{--accent:var(--blue);position:relative;padding:34px;background:var(--panel);border:1px solid color-mix(in srgb,var(--accent) 48%,transparent);border-top:6px solid var(--accent)}
	.dkx-legacy-rate:nth-child(2){--accent:var(--gold)}.dkx-legacy-rate:nth-child(3){--accent:var(--purple)}.dkx-legacy-rate:nth-child(4){--accent:var(--red)}
	.dkx-legacy-rate>span{color:var(--accent);font:900 10px/1 Arial,sans-serif;letter-spacing:.15em;text-transform:uppercase}
	.dkx-legacy-rate h3{margin:18px 0 26px;color:#fff;font:900 clamp(36px,4vw,58px)/.84 "Arial Black",Arial,sans-serif;letter-spacing:-.06em;text-transform:uppercase}
	.dkx-legacy-rate dl{margin:0;border-top:1px solid rgba(255,255,255,.13)}
	.dkx-legacy-rate dl div{display:grid;grid-template-columns:1fr auto;gap:20px;align-items:center;padding:18px 0;border-bottom:1px solid rgba(255,255,255,.11)}
	.dkx-legacy-rate dt{color:#d6e0e7;font:800 12px/1.2 Arial,sans-serif;text-transform:uppercase}.dkx-legacy-rate dd{margin:0;color:var(--accent);font:900 22px/1 "Arial Black",Arial,sans-serif}
	.dkx-legacy-rates__actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:28px}.dkx-legacy-rates__actions a{display:inline-flex;align-items:center;justify-content:space-between;gap:36px;min-height:58px;padding:0 20px;text-decoration:none;text-transform:uppercase;font:900 10px/1 Arial,sans-serif;letter-spacing:.12em;border:1px solid var(--blue);color:#02070c;background:var(--blue)}.dkx-legacy-rates__actions a+ a{background:transparent;color:#fff}
	@media(max-width:760px){.dkx-legacy-rates{width:calc(100% - 32px);padding:65px 0 90px}.dkx-legacy-rates__grid{grid-template-columns:1fr}.dkx-legacy-rate{padding:26px 22px}.dkx-legacy-rate dl div{grid-template-columns:1fr}.dkx-legacy-rate dd{font-size:20px}.dkx-legacy-rates__head h2{font-size:52px}}
	<?php endif; ?>
	</style>
	<?php
}, 999 );

add_filter( 'the_content', function( $content ) {
	if ( is_admin() || ! is_page( 'legacy' ) || ! in_the_loop() || ! is_main_query() ) return $content;
	$rates_url = home_url( '/rates/' );
	$pdf_url = get_stylesheet_directory_uri() . '/assets/downloads/DK-Expressions-2026-Rate-Card.pdf';
	$contact = home_url( '/contact/' );
	$rates = '<section class="dkx-legacy-rates" id="legacy-rate-card" aria-labelledby="dkx-legacy-rates-title"><header class="dkx-legacy-rates__head"><p>2026 / Rate Card</p><h2 id="dkx-legacy-rates-title">Clear packages.<br><em>Built to scale.</em></h2></header><div class="dkx-legacy-rates__grid">';
	$cards = array(
		array('Event Domination',array('Spark'=>'R6,500','Signature'=>'R32,000','Takeover'=>'From R95,000')),
		array('Always On',array('Essential'=>'R15,000 / month','Premium'=>'R35,000 / month','Elite'=>'From R60,000 / month')),
		array('Become the Name',array('Starter'=>'R18,000 / month','Growth'=>'R40,000 / month','Authority'=>'From R75,000 / month')),
		array('Own the Attention',array('Feature'=>'R1,500','Spotlight'=>'R6,000','Headline'=>'R12,500')),
	);
	foreach ( $cards as $i => $card ) {
		$rates .= '<article class="dkx-legacy-rate"><span>0'.($i+1).' / Package Family</span><h3>'.esc_html($card[0]).'</h3><dl>';
		foreach ( $card[1] as $name => $price ) $rates .= '<div><dt>'.esc_html($name).'</dt><dd>'.esc_html($price).'</dd></div>';
		$rates .= '</dl></article>';
	}
	$rates .= '</div><div class="dkx-legacy-rates__actions"><a href="'.esc_url($contact).'">Start a Project <span>↗</span></a><a href="'.esc_url($pdf_url).'" download="DK-Expressions-2026-Rate-Card.pdf">Download Full Rate Card <span>↓</span></a></div></section>';
	return $content . $rates;
}, 50 );

add_action( 'wp_footer', function() {
	if ( ! is_page( 'legacy' ) ) return;
	?>
	<script id="dkx-remove-legacy-rate-placeholder">document.addEventListener('DOMContentLoaded',function(){document.querySelectorAll('section,article').forEach(function(el){var t=(el.innerText||'').replace(/\s+/g,' ').toUpperCase();if(t.indexOf('RATE CARD')!==-1&&t.indexOf('COMING NEXT')!==-1&&t.indexOf('CLEAR PACKAGES')===-1){el.style.display='none';}});});</script>
	<?php
}, 999 );
