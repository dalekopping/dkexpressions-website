<?php
/**
 * Plugin Name: DK Expressions Master FAQ
 * Description: Visible FAQ content supplied by the 2026 Developer Handover Master Copy, matching FAQ schema.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_master_faq_rows() {
	return array(
		array( 'What is included in the Event Domination Signature package?', 'Up to 8 hours of photography and video coverage, live event posting, 5 reels + 80 edited photos, same-day teaser and a post-event recap. Price: R32,000 (excl. VAT).' ),
		array( 'How does a Brand Content Retainer work?', 'Retainers provide ongoing photography, content creation, social management and strategy on a monthly basis. The Core package (Most Chosen) is R35,000 per month with a 3-month minimum and includes two shoots, 20 posts + 8 reels, full social management and monthly reporting.' ),
		array( 'Do you travel outside Johannesburg?', 'Yes. Travel outside Johannesburg, accommodation and related costs are quoted separately unless specifically included in the package.' ),
		array( 'What is the minimum booking or deposit required?', 'A 50% deposit is required to confirm any project. Retainers require a written three-month minimum commitment.' ),
		array( 'Can I buy individual photographs or a single social post?', 'Yes. We offer supporting à-la-carte rates, but we recommend fixed packages for better value and clearer outcomes. Photography starts from R4,500 per session; single sponsored posts from R950.' ),
		array( 'How quickly do you deliver images after an event?', 'Standard turnaround is 5–7 working days after receipt of final materials. Signature Event Domination includes next-day gallery delivery and same-day teasers. Rush work may carry a 20% fee.' ),
	);
}

add_action( 'get_footer', function() {
	if ( ! is_page( array( 'solutions', 'rates', 'agency', 'rate-card' ) ) ) return;
	?>
	<section class="dkx-master-faq" id="faq" aria-labelledby="dkx-master-faq-heading">
		<div class="dkx-master-faq__inner">
			<header><p>DK / FAQ</p><h2 id="dkx-master-faq-heading">Before you book.</h2><span>Clear answers. No hourly surprises.</span></header>
			<div class="dkx-master-faq__grid">
				<?php foreach ( dkx_master_faq_rows() as $index => $row ) : ?>
				<details><summary><b><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></b><span><?php echo esc_html( $row[0] ); ?></span><i>+</i></summary><p><?php echo esc_html( $row[1] ); ?></p></details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<style id="dkx-master-faq-style">
	.dkx-master-faq{--blue:#40b8ff;--gold:#ffc34f;--purple:#976dff;--aqua:#20d7c8;--ink:#02070c;--panel:#07131c;background:var(--ink);color:#fff;padding:clamp(80px,9vw,145px) 0}.dkx-master-faq *{box-sizing:border-box;text-shadow:none!important}.dkx-master-faq__inner{width:min(1320px,calc(100% - 64px));margin:auto}.dkx-master-faq header{display:grid;grid-template-columns:.28fr 1fr .45fr;gap:40px;align-items:end;padding-bottom:48px;border-bottom:4px solid var(--blue)}.dkx-master-faq header p{margin:0;color:var(--blue);font:900 9px/1.2 Arial,sans-serif;letter-spacing:.18em}.dkx-master-faq header h2{margin:0;font:900 clamp(52px,7vw,100px)/.82 "Arial Black",Arial,sans-serif;letter-spacing:-.065em;text-transform:uppercase}.dkx-master-faq header span{color:#9db2c2;font-size:14px;line-height:1.65}.dkx-master-faq__grid{margin-top:28px;border-top:1px solid rgba(64,184,255,.24)}.dkx-master-faq details{border-bottom:1px solid rgba(64,184,255,.24);background:var(--panel)}.dkx-master-faq summary{display:grid;grid-template-columns:54px 1fr 34px;gap:18px;align-items:center;min-height:82px;padding:18px 24px;cursor:pointer;list-style:none}.dkx-master-faq summary::-webkit-details-marker{display:none}.dkx-master-faq summary b{color:var(--gold);font:900 10px/1 Arial,sans-serif;letter-spacing:.12em}.dkx-master-faq summary span{font:900 clamp(16px,1.7vw,22px)/1.25 Arial,sans-serif}.dkx-master-faq summary i{color:var(--aqua);font-size:24px;font-style:normal}.dkx-master-faq details[open] summary i{transform:rotate(45deg)}.dkx-master-faq details>p{max-width:930px;margin:0;padding:0 24px 28px 96px;color:#b8c7d0;font-size:14px;line-height:1.75}@media(max-width:760px){.dkx-master-faq__inner{width:calc(100% - 32px)}.dkx-master-faq header{grid-template-columns:1fr;gap:18px}.dkx-master-faq header h2{font-size:clamp(44px,13vw,68px);line-height:.94}.dkx-master-faq summary{grid-template-columns:38px 1fr 28px;padding:18px 14px}.dkx-master-faq details>p{padding:0 14px 24px 70px}}
	</style>
	<?php
}, 5 );
