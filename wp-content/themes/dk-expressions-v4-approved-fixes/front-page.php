<?php
/**
 * Final commercial landing experience.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
?>

<section class="dk-home-hero dk-landing dkx1211-hero dk-no-semantic-highlight" id="top" data-dkx-section-key="landing-hero">
	<div class="dk-stars" aria-hidden="true"></div>
	<div class="dk-city" aria-hidden="true"></div>
	<div class="dk-portal" aria-hidden="true"></div>
	<div class="dk-hero-copy">
		<p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_hero_kicker' ) ); ?></p>
		<h1><?php echo esc_html( dkxv4_content( 'home_hero_title_1' ) ); ?> <span><?php echo esc_html( dkxv4_content( 'home_hero_title_2' ) ); ?></span></h1>
		<p class="dk-tagline"><?php echo esc_html( dkxv4_registered_phrase( dkxv4_content( 'home_hero_tagline' ) ) ); ?></p>
		<p class="dkx1211-hero-sub">Premium culture, content and brand storytelling since <strong>2013</strong>.</p>
		<a class="dkx1211-hero-jump" href="#three-doors">Choose Your Experience <span>↓</span></a>
	</div>
</section>

<main class="dkx1211-landing dk-no-semantic-highlight">
	<section class="dkx1200-section dkx1200-pathways dkx1211-pathways" id="three-doors" data-dkx-section-key="three-doors">
		<header class="dkx1200-section-head">
			<div>
				<p class="dkx1200-eyebrow">Choose Your Experience</p>
				<h2>Three doors.<br><em>One DK universe.</em></h2>
			</div>
			<p>Choose the route that matches what you need now. Every door leads into the same DK Expressions creative system.</p>
		</header>
		<div class="dkx1200-pathway-grid">
			<a class="agency" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">
				<span>01 / AGENCY</span>
				<h3>Build a brand people remember.</h3>
				<p>Strategy, campaigns, photography, film &amp; digital growth.</p>
				<small>From R6,500</small>
				<b>Explore Solutions →</b>
			</a>
			<a class="media" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">
				<span>02 / MEDIA</span>
				<h3>Discover culture as it happens.</h3>
				<p>Entertainment news, interviews, reviews &amp; events.</p>
				<b>Enter Insights →</b>
			</a>
			<a class="archive" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">
				<span>03 / TIME VAULT</span>
				<h3>See where we have travelled.</h3>
				<p>Photography, motion &amp; 13 years of documented work.</p>
				<b>Open Our Work →</b>
			</a>
		</div>
	</section>

	<section class="dkx1211-proof-strip" aria-label="DK Expressions audience proof" data-dkx-section-key="proof-strip">
		<div class="dkx1211-proof-audience">
			<span class="is-visits"><strong>1.10M+</strong> visits</span><i aria-hidden="true">·</i>
			<span class="is-pages"><strong>2.47M+</strong> pages viewed</span><i aria-hidden="true">·</i>
			<span class="is-trusted">Trusted by <strong>Big Concerts, Comic Con Africa, Showtime</strong></span>
		</div>
	</section>

	<div data-dkx-section-key="booking-pulse">
		<?php require get_stylesheet_directory() . '/template-parts/booking-pulse.php'; ?>
	</div>

	<section class="dkx1203-section dkx1203-pricing dkx1211-pricing" id="packages" data-dkx-section-key="core-packages">
		<header class="dkx1203-section-head">
			<p class="dkx1203-eyebrow">Four Core Packages</p>
			<h2>Choose the level<br>of attention.</h2>
			<p>Four clear commercial routes built around the refined 2026 rate card.</p>
		</header>
		<div class="dkx1203-pricing-grid dkx1211-pricing-grid-four">
			<article class="is-events is-featured" data-dkx-repeat-item>
				<b class="dkx1203-pricing-badge">Most Chosen</b>
				<p class="dkx1203-pricing-label">Event Domination</p>
				<h3>Signature</h3>
				<p class="dkx1203-pricing-price">R32,000 <span>/ event</span></p>
				<ul><li>Up to 8 hours coverage</li><li>Photography + video</li><li>Live event posting</li><li>Same-day teaser + recap</li></ul>
				<a href="<?php echo esc_url( dkxv4_package_contact_url( 'event-signature' ) ); ?>">Choose Signature →</a>
			</article>
			<article class="is-brands" data-dkx-repeat-item>
				<p class="dkx1203-pricing-label">Always On</p>
				<h3>Premium</h3>
				<p class="dkx1203-pricing-price">R35,000 <span>/ month</span></p>
				<ul><li>2 shoots per month</li><li>20 posts + 8 reels</li><li>Full social management</li><li>Strategy, creative + reporting</li></ul>
				<a href="<?php echo esc_url( dkxv4_package_contact_url( 'always-premium' ) ); ?>">Choose Premium →</a>
			</article>
			<article class="is-name" data-dkx-repeat-item>
				<p class="dkx1203-pricing-label">Become the Name</p>
				<h3>Growth</h3>
				<p class="dkx1203-pricing-price">R40,000 <span>/ month</span></p>
				<ul><li>2 shoots per month</li><li>20 posts + 8 videos</li><li>Personal-brand strategy</li><li>Interview series + reporting</li></ul>
				<a href="<?php echo esc_url( dkxv4_package_contact_url( 'name-growth' ) ); ?>">Choose Growth →</a>
			</article>
			<article class="is-media" data-dkx-repeat-item>
				<p class="dkx1203-pricing-label">Own the Attention</p>
				<h3>Spotlight</h3>
				<p class="dkx1203-pricing-price">R6,000 <span>/ campaign</span></p>
				<ul><li>8 editorial listings</li><li>Amplification on each</li><li>Instagram, Facebook + X</li><li>Campaign-window placement</li></ul>
				<a href="<?php echo esc_url( dkxv4_package_contact_url( 'attention-spotlight' ) ); ?>">Choose Spotlight →</a>
			</article>
		</div>
		<p class="dkx1203-pricing-note">Need a different scale? <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View the complete 2026 rate card →</a></p>
	</section>

	<section class="dkx1203-section dkx1203-process dkx1211-process" id="how-we-work" data-dkx-section-key="how-we-work">
		<header class="dkx1203-section-head">
			<p class="dkx1203-eyebrow">How We Work</p>
			<h2>One connected<br>creative system.</h2>
		</header>
		<div class="dkx1203-process-grid">
			<article data-dkx-repeat-item><span>01 / DISCOVER</span><h3>Find the signal.</h3><p>We define the objective, audience, opportunity and the story worth telling.</p></article>
			<article data-dkx-repeat-item><span>02 / DESIGN</span><h3>Build the journey.</h3><p>We shape the concept, campaign, content plan and conversion path.</p></article>
			<article data-dkx-repeat-item><span>03 / CREATE</span><h3>Capture the moment.</h3><p>Photography, film, editorial and digital assets are produced as one system.</p></article>
			<article data-dkx-repeat-item><span>04 / AMPLIFY</span><h3>Keep it moving.</h3><p>Publishing, social distribution and reporting extend the impact beyond launch day.</p></article>
		</div>
		<p class="dkx1203-process-note">ONE BRIEF · ONE CONNECTED TEAM · ONE MEASURABLE OUTCOME</p>
	</section>

	<section class="dkx1203-section dkx1203-testimonials dkx1211-testimonials" id="recommendations" data-dkx-section-key="recommendations">
		<header class="dkx1203-section-head">
			<p class="dkx1203-eyebrow">Don’t Take Our Word For It</p>
			<h2>Reputation,<br>documented.</h2>
		</header>
		<div class="dkx1203-testimonials-grid">
			<blockquote data-dkx-repeat-item><p>“Committed, passionate and dedicated to his craft.”</p><footer><strong>Big Concerts / The Publicity Workshop</strong></footer></blockquote>
			<blockquote data-dkx-repeat-item><p>“I highly recommend associating any brand with DK Expressions.”</p><footer><strong>One-Eyed Jack</strong></footer></blockquote>
		</div>
		<div class="dkx1203-actions dkx1203-testimonial-link"><a href="<?php echo esc_url( home_url( '/our-work/#recommendations' ) ); ?>">View the original recommendations →</a></div>
	</section>

	<section class="dkx1203-final dkx1211-final" data-dkx-section-key="final-cta">
		<div class="dkx1203-final-inner">
			<p class="dkx1203-eyebrow">Your Next Chapter</p>
			<h2>Make something<br>people cannot ignore.</h2>
			<p>Tell us what you are launching, promoting or transforming. We will build the right combination of story, strategy and execution.</p>
			<div class="dkx1203-actions">
				<a class="dkx1203-btn is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project →</a>
				<a class="dkx1203-btn" href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">Download the 2026 Rate Card →</a>
			</div>
			<p class="dkx1203-location">Johannesburg · South Africa · Worldwide</p>
			<p class="dkx1211-contact"><a href="mailto:advertise@dkexpressions.co.za">advertise@dkexpressions.co.za</a><i aria-hidden="true">·</i><a href="tel:+27722460451">+27 72 246 0451</a></p>
		</div>
	</section>
</main>

<?php get_footer(); ?>
