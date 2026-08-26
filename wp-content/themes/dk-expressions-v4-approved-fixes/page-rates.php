<?php
/**
 * Template Name: DK Expressions 2026 Rate Card
 * Full and one-page PDF commercial rate card downloads — v1.23.1.
 */
get_header();

$rate_card_url = function_exists( 'dkx_final_rate_card_download_url' )
	? dkx_final_rate_card_download_url()
	: add_query_arg( 'dkx_rate_card', 'final-2026', home_url( '/' ) );
$one_page_pdf_url = function_exists( 'dkx_one_page_rate_card_pdf_url' )
	? dkx_one_page_rate_card_pdf_url()
	: add_query_arg( 'dkx_rate_card', 'one-page-pdf-2026', home_url( '/' ) );
?>
<main class="dkxcr dkxcr--rates dk-no-semantic-highlight" id="top">
	<div class="dkxcr-grid" aria-hidden="true"></div>

	<section class="dkxcr-rates-hero" aria-labelledby="dkxcr-rates-title">
		<div class="dkxcr-rates-year" aria-hidden="true"><span>20</span><strong>26</strong></div>
		<div class="dkxcr-rates-hero-copy">
			<p class="dkxcr-kicker"><span>DK</span> / Commercial Rate Card</p>
			<h1 id="dkxcr-rates-title">Clear packages.<br>Fixed scopes.<br><em>No hourly surprises.</em></h1>
			<p>Explore all four DK Expressions commercial packages, then download either the complete seven-page rate card or the one-page quick-reference PDF.</p>
			<div class="dkxcr-actions">
				<a class="is-primary" href="<?php echo esc_url( $rate_card_url ); ?>" download="DK-Expressions-2026-Rate-Card.pdf" data-dkx-rate-download>Download Full Rate Card <span>↓</span></a>
				<a href="<?php echo esc_url( $one_page_pdf_url ); ?>" download="DK-Expressions-2026-One-Page-Rate-Card.pdf" data-dkx-rate-download>One-Page PDF <span>↓</span></a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a>
			</div>
			<div class="dkxcr-download-meta"><span>4 core packages</span><span>7-page full edition</span><span>1-page quick reference</span><span>PDF only</span><span>Excludes VAT</span></div>
			<p class="dkxcr-download-status" role="status" aria-live="polite" data-dkx-download-status>Rate card downloaded. Ready when you are. <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project →</a></p>
		</div>
	</section>

	<section class="dkxcr-rate-summary" id="packages">
		<header class="dkxcr-section-title">
			<p class="dkxcr-kicker"><span>01</span> / Four ways to work with us</p>
			<h2>Choose the kind<br>of <em>attention.</em></h2>
			<p>All four commercial packages from Solutions are represented here, with three pricing tiers for each.</p>
		</header>

		<div class="dkxcr-rate-worlds">
			<article class="dkxcr-rate-world is-event" id="event-domination">
				<header><span>01 / EVENT DOMINATION</span><h3>One event.<br>Maximum <em>impact.</em></h3><p><a href="<?php echo esc_url( home_url( '/solutions/#event-domination' ) ); ?>">View full solution ↗</a></p></header>
				<div class="dkxcr-tier-list">
					<div><span>SPARK</span><strong>R6,500</strong><small>Up to 4 hours, 1 creator, 40 edited photos, 2 reels, next-day delivery.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'event-entry' ) ); ?>">Choose Spark <b>↗</b></a></div>
					<div class="is-chosen"><b>Most Chosen</b><span>SIGNATURE</span><strong>R32,000</strong><small>Full event coverage, photo + video, live posting, 5 reels, 80 photos and recap.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'event-signature' ) ); ?>">Choose Signature <b>↗</b></a></div>
					<div><span>TAKEOVER</span><strong>From R95,000</strong><small>Flagship or multi-day production with a 2–4 creator crew and full post-event campaign.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'event-premium' ) ); ?>">Choose Takeover <b>↗</b></a></div>
				</div>
			</article>

			<article class="dkxcr-rate-world is-retainer" id="always-on">
				<header><span>02 / ALWAYS ON</span><h3>Always visible.<br>Always <em>moving.</em></h3><p>Three-month minimum · <a href="<?php echo esc_url( home_url( '/solutions/#always-on' ) ); ?>">View full solution ↗</a></p></header>
				<div class="dkxcr-tier-list">
					<div><span>ESSENTIAL</span><strong>R15,000 <i>/ month</i></strong><small>1 shoot, 12 posts, 4 reels, monthly content calendar and basic report.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'retainer-entry' ) ); ?>">Choose Essential <b>↗</b></a></div>
					<div class="is-chosen"><b>Most Chosen</b><span>PREMIUM</span><strong>R35,000 <i>/ month</i></strong><small>2 shoots, 20 posts, 8 reels, full social management, strategy, ad creative and reporting.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'retainer-core' ) ); ?>">Choose Premium <b>↗</b></a></div>
					<div><span>ELITE</span><strong>From R60,000 <i>/ month</i></strong><small>Weekly shoots, high-volume content, community management, monthly event coverage and paid ads.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'retainer-premium' ) ); ?>">Choose Elite <b>↗</b></a></div>
				</div>
			</article>

			<article class="dkxcr-rate-world is-branding" id="become-the-name">
				<header><span>03 / BECOME THE NAME</span><h3>Build authority.<br>Become <em>the name.</em></h3><p>Three-month minimum · <a href="<?php echo esc_url( home_url( '/solutions/#become-the-name' ) ); ?>">View full solution ↗</a></p></header>
				<div class="dkxcr-tier-list">
					<div><span>STARTER</span><strong>R18,000 <i>/ month</i></strong><small>1 shoot, 12 personal-brand posts, 4 short-form videos and Instagram + TikTok content.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'branding-starter' ) ); ?>">Choose Starter <b>↗</b></a></div>
					<div class="is-chosen"><b>Most Chosen</b><span>GROWTH</span><strong>R40,000 <i>/ month</i></strong><small>2 shoots, 20 posts, 8 videos, personal-brand strategy, content management and interview series.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'branding-growth' ) ); ?>">Choose Growth <b>↗</b></a></div>
					<div><span>AUTHORITY</span><strong>From R75,000 <i>/ month</i></strong><small>Weekly production, PR positioning, podcast/video show, multi-platform management and thought leadership.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'branding-authority' ) ); ?>">Choose Authority <b>↗</b></a></div>
				</div>
			</article>

			<article class="dkxcr-rate-world is-media" id="own-the-attention">
				<header><span>04 / OWN THE ATTENTION</span><h3>Publish with authority.<br>Own the <em>attention.</em></h3><p><a href="<?php echo esc_url( home_url( '/solutions/#own-the-attention' ) ); ?>">View full solution ↗</a></p></header>
				<div class="dkxcr-tier-list">
					<div><span>FEATURE</span><strong>R1,500 <i>/ placement</i></strong><small>1 dedicated editorial listing, 1 social amplification post and 12-month live placement.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'media-feature' ) ); ?>">Choose Feature <b>↗</b></a></div>
					<div class="is-chosen"><b>Best Value</b><span>SPOTLIGHT</span><strong>R6,000 <i>/ campaign</i></strong><small>8 editorial listings with social amplification across Instagram, Facebook and X.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'media-spotlight' ) ); ?>">Choose Spotlight <b>↗</b></a></div>
					<div><span>HEADLINE</span><strong>R12,500 <i>/ campaign</i></strong><small>16 editorial listings, full social amplification, priority placement and optional event tie-in.</small><a href="<?php echo esc_url( dkxv4_package_contact_url( 'media-headline' ) ); ?>">Choose Headline <b>↗</b></a></div>
				</div>
			</article>
		</div>
	</section>

	<section class="dkxcr-other-services">
		<div><p class="dkxcr-kicker"><span>02</span> / Beyond the four</p><h2>Not every brief<br>belongs <em>in a box.</em></h2></div>
		<ul><li><span>01</span>Hospitality content</li><li><span>02</span>Real estate storytelling</li><li><span>03</span>Campaign support</li><li><span>04</span>Motion and short-form film</li><li><span>05</span>Web &amp; AI builds</li></ul>
		<p>Custom combinations and integrated campaigns are scoped on request.</p>
	</section>

	<section class="dkxcr-commercial-notes">
		<header><p class="dkxcr-kicker"><span>03</span> / Commercial notes</p><h2>Clear terms.<br><em>No surprises.</em></h2></header>
		<div>
			<article><span>01</span><strong>50%</strong><h3>Deposit</h3><p>Required to confirm the booking.</p></article>
			<article><span>02</span><strong>ON DELIVERY</strong><h3>Balance</h3><p>Due on delivery or as agreed.</p></article>
			<article><span>03</span><strong>EXCL.</strong><h3>VAT</h3><p>All listed prices exclude VAT.</p></article>
			<article><span>04</span><strong>JHB+</strong><h3>Travel</h3><p>Outside Johannesburg quoted separately.</p></article>
			<article><span>05</span><strong>CUSTOM</strong><h3>Scope</h3><p>Available when the brief needs another scale.</p></article>
		</div>
	</section>

	<section class="dkxcr-rate-final">
		<div><p class="dkxcr-kicker"><span>04</span> / Keep the card</p><h2>Your next project<br>starts with <em>clarity.</em></h2><p>Keep the full commercial edition for detailed scopes, or download the single-page PDF for a fast internal reference.</p></div>
		<div>
			<a class="dkxcr-final-download" href="<?php echo esc_url( $rate_card_url ); ?>" download="DK-Expressions-2026-Rate-Card.pdf" data-dkx-rate-download><span>FULL PDF / 2026</span><strong>Download Complete<br>7-Page Rate Card</strong><b>↓</b></a>
			<a class="dkxcr-final-download" href="<?php echo esc_url( $one_page_pdf_url ); ?>" download="DK-Expressions-2026-One-Page-Rate-Card.pdf" data-dkx-rate-download><span>QUICK PDF / 2026</span><strong>Download One-Page<br>Rate Card</strong><b>↓</b></a>
			<p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project →</a></p>
		</div>
	</section>
</main>
<?php get_footer(); ?>
