<?php
/**
 * Template Name: DK Expressions Solutions
 * Premium commercial services page — v1.17.2
 * Blue service titles + per-service starting rates + packages at bottom
 *
 * @package DK_Expressions_V4_Fixes
 */
/**
 * Solutions page presentation layer.
 * Loads only on this template so no other DK Expressions pages are affected.
 */
$dkx_solutions_css = get_stylesheet_directory() . '/assets/css/solutions-v1181.css';
wp_enqueue_style(
    'dkx-solutions-v1181',
    get_stylesheet_directory_uri() . '/assets/css/solutions-v1181.css',
    array( 'dkx-approved-fixes', 'dkx-enterprise-v115' ),
    file_exists( $dkx_solutions_css ) ? filemtime( $dkx_solutions_css ) : '1.18.1'
);

get_header();

$dkxv4_solutions_preview    = function_exists( 'dkxv4_solutions_preview_key' ) ? dkxv4_solutions_preview_key() : '';
$dkxv4_solutions_is_preview = '' !== $dkxv4_solutions_preview;
$dkxv4_solutions_preview    = $dkxv4_solutions_is_preview ? $dkxv4_solutions_preview : 'vault';

require get_stylesheet_directory() . '/template-parts/solutions-options-preview.php';
get_footer();
return;
?>

<main class="dk-solutions-page">

	<section class="dk-sol-hero">
		<div class="dk-sol-hero-bg" aria-hidden="true"></div>
		<div class="dk-sol-hero-inner">
			<p class="dk-kicker"><?php echo esc_html( dkxv4_page_meta( 'solutions_kicker', 'What we do' ) ); ?></p>
			<h1><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'solutions_heading', "We don’t just create content.\nWe create impact." ) ) ); ?></h1>
			<p class="dk-sol-lead"><?php echo esc_html( dkxv4_page_meta( 'solutions_intro', 'DK Expressions connects brands, experiences and audiences through powerful storytelling, strategic digital amplification and content designed to be remembered.' ) ); ?></p>
			<div class="dk-sol-hero-actions">
				<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project ↗</a>
				<a class="dk-text-link" href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View 2026 rate card →</a>
			</div>
		</div>
	</section>

	<section class="dk-sol-intro">
		<div class="dk-sol-intro-grid">
			<div>
				<p class="dk-kicker">The DK Advantage</p>
				<h2>Built on experience.<br><em>Designed for impact.</em></h2>
			</div>
			<p>Since 2013 we have worked at the intersection of media, entertainment, photography, digital marketing and live experiences. Today that experience forms an integrated suite of solutions for brands that want more than visibility — they want attention, engagement and relevance.</p>
		</div>
	</section>

	<section class="dk-sol-services" id="services">
		<?php
		$services = array(
			array(
				'num'   => '01',
				'title' => 'Brand Amplification',
				'kicker'=> 'Your brand deserves more than another post in the feed.',
				'copy'  => 'We develop integrated campaigns designed to put brands in front of the right audiences through compelling content, digital publishing, social distribution and strategic amplification. From a single activation to an ongoing campaign, every element is designed around one objective: make people pay attention.',
				'tags'  => 'Campaign strategy · Digital amplification · Sponsored content · Branded storytelling · Social distribution · Audience engagement',
				'from'  => 'From R4,500',
				'rate'  => 'Original sponsored feature from R4,500 · Premium brand story R7,500 · Brand Momentum package R14,500',
			),
			array(
				'num'   => '02',
				'title' => 'Content & Storytelling',
				'kicker'=> 'Every brand has a story. The difference is how you tell it.',
				'copy'  => 'DK Expressions transforms announcements, launches, experiences and ideas into content people actually want to consume. Our editorial heritage gives us a different perspective: we identify the story within the marketing.',
				'tags'  => 'Editorial content · SEO articles · Brand stories · Interviews · Press-release transformation · Website content · Social storytelling',
				'from'  => 'From R2,500',
				'rate'  => 'Client-supplied release R2,500 · Original feature R4,500 · Sponsored series (3 articles) R12,500',
			),
			array(
				'num'   => '03',
				'title' => 'Event Domination',
				'kicker'=> 'The event lasts a few hours. Its digital impact shouldn’t.',
				'copy'  => 'We capture, document and amplify events before, during and after they happen. From anticipation and announcements to photography, live content, reviews and post-event amplification, a single event becomes an entire content ecosystem.',
				'tags'  => 'Before · During · After · Everywhere',
				'from'  => 'From R7,500',
				'rate'  => 'Essential coverage R7,500 · Signature Event Story R15,000 · Full event partnership from R25,000',
			),
			array(
				'num'   => '04',
				'title' => 'Photography & Visual Storytelling',
				'kicker'=> 'Our roots are behind the lens.',
				'copy'  => 'From international performers and packed stadiums to intimate launches and corporate environments, DK Expressions has spent more than two decades capturing moments that cannot be repeated.',
				'tags'  => 'Concerts · Events · Brands · Corporate · Lifestyle · Property · Portraiture · Behind-the-scenes',
				'from'  => 'From R4,500',
				'rate'  => '2-hour session R4,500 · Half-day R7,500 · Full-day R12,500 · Event highlight film from R15,000',
			),
			array(
				'num'   => '05',
				'title' => 'Digital & Social Media',
				'kicker'=> 'Great content achieves very little if nobody sees it.',
				'copy'  => 'We combine creative production with digital distribution to extend campaigns across websites, search and social platforms.',
				'tags'  => 'Social campaigns · Content calendars · Campaign creative · Paid-media support · Community engagement · Digital strategy',
				'from'  => 'From R950',
				'rate'  => 'Single post R950 · 3-post campaign R2,500 · Multi-platform launch R4,500 · Live takeover from R6,500',
			),
			array(
				'num'   => '06',
				'title' => 'SEO & Digital Publishing',
				'kicker'=> 'Built to be discovered.',
				'copy'  => 'We combine editorial experience with search-led content architecture, structured headings, keyword strategy, internal linking, metadata and evergreen content.',
				'tags'  => 'SEO strategy · Digital publishing · Search-led editorial · Content architecture',
				'from'  => 'From R4,500',
				'rate'  => 'Search-led brand features from R4,500 · Ongoing SEO publishing via monthly partnerships from R9,500',
			),
			array(
				'num'   => '07',
				'title' => 'Competitions & Audience Activation',
				'kicker'=> 'Turn passive audiences into participants.',
				'copy'  => 'We develop competition and giveaway campaigns supporting launches, events, ticket sales and brand-awareness campaigns while generating measurable audience interaction.',
				'tags'  => 'Giveaways · Ticket competitions · Audience activation · Campaign engagement',
				'from'  => 'Custom scoped',
				'rate'  => 'Competition & giveaway campaigns scoped to prize, reach and platform requirements — request a proposal',
			),
			array(
				'num'   => '08',
				'title' => 'Executive & Personal Branding',
				'kicker'=> 'Build authority around the people behind the business.',
				'copy'  => 'We help executives, entrepreneurs, creatives and professionals develop authoritative digital identities through strategic content, photography, thought leadership and social positioning.',
				'tags'  => 'Strategy · Photography · Thought leadership · Social positioning',
				'from'  => 'From R4,500',
				'rate'  => 'Portrait / branding session from R4,500 · Thought-leadership features from R4,500 · Retainer programmes available',
			),
		);

		foreach ( $services as $i => $s ) :
			$alt = ( $i % 2 === 1 ) ? ' is-alt' : '';
		?>
		<article class="dk-sol-service<?php echo $alt; ?>">
			<div class="dk-sol-service-num"><?php echo esc_html( $s['num'] ); ?></div>
			<div class="dk-sol-service-body">
				<p class="dk-sol-service-kicker"><?php echo esc_html( $s['kicker'] ); ?></p>
				<h2><?php echo esc_html( $s['title'] ); ?></h2>
				<p><?php echo esc_html( $s['copy'] ); ?></p>
				<div class="dk-sol-service-tags"><?php echo esc_html( $s['tags'] ); ?></div>
				<div class="dk-sol-service-rate">
					<strong><?php echo esc_html( $s['from'] ); ?></strong>
					<span><?php echo esc_html( $s['rate'] ); ?></span>
					<a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">Full rate card →</a>
				</div>
			</div>
		</article>
		<?php endforeach; ?>
	</section>

	<section class="dk-sol-why">
		<div class="dk-sol-why-head">
			<p class="dk-kicker">Why DK Expressions</p>
			<h2>One partner.<br><em>Multiple disciplines.</em></h2>
			<p>Strategy, original production, editorial thinking, photography, digital distribution and audience engagement work together as one connected system.</p>
		</div>
		<div class="dk-sol-why-grid">
			<article><span>01</span><h3>Editorial credibility</h3><p>More than a decade of publishing and culture coverage informs every commercial story we create.</p></article>
			<article><span>02</span><h3>Original production</h3><p>We create the photographs, stories and campaign assets instead of relying only on supplied marketing material.</p></article>
			<article><span>03</span><h3>Built-in distribution</h3><p>Content can live across the DK Expressions ecosystem while also being developed for client-owned channels.</p></article>
			<article><span>04</span><h3>Commercial flexibility</h3><p>From single activations to retainers, projects can scale around the objective, audience and available budget.</p></article>
		</div>
	</section>

	<section class="dk-packages" id="packages">
		<div class="dk-v116-section-head">
			<div>
				<p class="dk-kicker">Ready-made bundles</p>
				<h2>Prefer a packaged outcome?<br><em>Start here.</em></h2>
			</div>
			<p>One clear outcome. One bundled fee. Ideal when you want speed and clarity without assembling line items yourself.</p>
		</div>
		<div class="dk-package-grid">
			<article class="dk-package-card">
				<h3>Launch Spark</h3>
				<div class="dk-package-price">R7,500 <small>one-off</small></div>
				<ul>
					<li>One original sponsored feature</li>
					<li>Coordinated multi-platform social launch</li>
					<li>One week in-content banner</li>
				</ul>
				<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request this package ↗</a>
			</article>
			<article class="dk-package-card featured">
				<h3>Event Story</h3>
				<div class="dk-package-price">R15,000 <small>one-off</small></div>
				<ul>
					<li>Pre-event spotlight article</li>
					<li>Up to 4 hours photography</li>
					<li>Live social coverage</li>
					<li>Original post-event recap</li>
				</ul>
				<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request this package ↗</a>
			</article>
			<article class="dk-package-card">
				<h3>Brand Momentum</h3>
				<div class="dk-package-price">R14,500 <small>one-off</small></div>
				<ul>
					<li>Two original features</li>
					<li>Multi-platform campaign</li>
					<li>One month sidebar banner</li>
					<li>Campaign report</li>
				</ul>
				<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request this package ↗</a>
			</article>
			<article class="dk-package-card">
				<h3>Campaign Partner</h3>
				<div class="dk-package-price">R25,000 <small>per month</small></div>
				<ul>
					<li>Two premium brand stories</li>
					<li>Monthly banner placement</li>
					<li>Two social campaigns</li>
					<li>Planning + reporting</li>
				</ul>
				<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request this package ↗</a>
			</article>
		</div>
		<div class="dk-sol-packages-cta">
			<a class="dk-button" href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View full 2026 rate card ↗</a>
			<a class="dk-text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request a tailored proposal →</a>
		</div>
	</section>

	<section class="dk-sol-final-cta">
		<p class="dk-kicker">DK Expressions</p>
		<h2>Need something different?</h2>
		<p>Good ideas rarely fit neatly into a package. Tell us what you’re trying to achieve. We’ll build the solution around it.</p>
		<a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project ↗</a>
	</section>

</main>

<?php get_footer(); ?>
