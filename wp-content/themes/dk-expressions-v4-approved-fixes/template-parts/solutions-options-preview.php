<?php
/**
 * Non-destructive Solutions-page comparison experiences.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$solution_variants = array(
	'command'   => 'Command Grid',
	'portals'   => 'Dual Portals',
	'rate-card' => 'Editorial Rate Card',
);
$solution_variant_name = $solution_variants[ $dkxv4_solutions_preview ] ?? $solution_variants['command'];
$solution_preview_urls = array();
foreach ( $solution_variants as $variant_key => $variant_label ) {
	$solution_preview_urls[ $variant_key ] = add_query_arg(
		array(
			'dk-solutions-preview' => $variant_key,
			'dk-refresh'           => '1217',
		),
		home_url( '/solutions/' )
	);
}

$capabilities = array(
	'Executive & personal branding',
	'Hospitality and venue content',
	'Real estate and development storytelling',
	'Campaign and launch support',
	'Motion and short-form film',
);

$process_steps = array(
	array( '01', 'Short discovery call' ),
	array( '02', 'Clear proposal with fixed scope' ),
	array( '03', '50% deposit to confirm' ),
	array( '04', 'Execution and delivery' ),
	array( '05', 'Optional retainer conversation after the first project' ),
);
?>

<main class="dkxsp dkxsp--<?php echo esc_attr( $dkxv4_solutions_preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxsp-atmosphere" aria-hidden="true"><i></i><i></i><i></i></div>

	<section class="dkxsp-hero" aria-labelledby="dkxsp-title">
		<div class="dkxsp-shell dkxsp-hero-grid">
			<div class="dkxsp-hero-index" aria-hidden="true"><span>Agency</span><b>01</b></div>
			<div class="dkxsp-hero-copy">
				<p class="dkxsp-eyebrow">Agency</p>
				<h1 id="dkxsp-title">We don’t just document the moment. <em>We help shape how it is seen, shared and remembered.</em></h1>
				<p>DK Expressions works with events, hospitality groups, real estate developments and executive brands that need more than pretty pictures. We combine photography, motion, strategy and consistent execution so the work actually performs.</p>
				<a class="dkxsp-scroll-link" href="#core-solutions">Explore the Solutions <span>↓</span></a>
			</div>
		</div>
	</section>

	<section class="dkxsp-core" id="core-solutions">
		<div class="dkxsp-shell">
			<header class="dkxsp-section-head"><p class="dkxsp-eyebrow">Core Solutions</p><h2>Two ways to put<br><em>attention to work.</em></h2></header>
			<div class="dkxsp-solution-grid">
				<article class="dkxsp-solution is-event">
					<header><span>01 / Live Experiences</span><h3>Event<br>Domination</h3><p>One event. Complete coverage. Maximum impact.</p></header>
					<div class="dkxsp-tier-list">
						<div><span>Entry</span><strong>R6,500</strong></div>
						<div class="is-chosen"><i>Most Chosen</i><span>Signature</span><strong>R32,000</strong></div>
						<div><span>Premium</span><strong><small>from</small> R95,000</strong></div>
					</div>
					<footer><p>Includes photography, video, live posting, rapid gallery delivery and optional same-day edits.</p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Brief Event Domination <span>↗</span></a></footer>
				</article>

				<article class="dkxsp-solution is-retainer">
					<header><span>02 / Ongoing Partnership</span><h3>Brand<br>Retainer</h3><p>Ongoing partnership for brands that need consistent, high-quality content without the briefing fatigue.</p></header>
					<div class="dkxsp-tier-list">
						<div><span>Entry</span><strong>R15,000 <small>/ month</small></strong></div>
						<div class="is-chosen"><i>Most Chosen</i><span>Core</span><strong>R35,000 <small>/ month</small></strong></div>
						<div><span>Premium</span><strong><small>from</small> R60,000 <small>/ month</small></strong></div>
					</div>
					<footer><p>Minimum 3 months. Priority scheduling. Monthly reporting. Strategy included at Core and above.</p><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss a Retainer <span>↗</span></a></footer>
				</article>
			</div>
		</div>
	</section>

	<section class="dkxsp-capabilities">
		<div class="dkxsp-shell dkxsp-capability-layout">
			<header><p class="dkxsp-eyebrow">Additional Capabilities</p><h2>Built around<br><em>the objective.</em></h2></header>
			<div class="dkxsp-capability-list">
				<?php foreach ( $capabilities as $capability_index => $capability ) : ?>
				<article><span><?php echo esc_html( str_pad( (string) ( $capability_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $capability ); ?></h3><i>↗</i></article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="dkxsp-process" id="how-we-work">
		<div class="dkxsp-shell">
			<header class="dkxsp-section-head"><p class="dkxsp-eyebrow">How We Work</p><h2>Clear from brief<br><em>to delivery.</em></h2></header>
			<ol class="dkxsp-process-list">
				<?php foreach ( $process_steps as $process_step ) : ?>
				<li><span><?php echo esc_html( $process_step[0] ); ?></span><p><?php echo esc_html( $process_step[1] ); ?></p></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="dkxsp-proof" aria-label="DK Expressions proof">
		<div class="dkxsp-shell">
			<p><strong>13+</strong><span>years</span></p><i>·</i>
			<p><strong>2,000+</strong><span>projects</span></p><i>·</i>
			<p class="is-stage"><strong>Work that has appeared across</strong><span>major South African and international stages</span></p>
		</div>
	</section>

	<section class="dkxsp-final">
		<div class="dkxsp-shell dkxsp-final-grid">
			<div><p class="dkxsp-eyebrow">Your Next Project</p><h2>Ready to<br><em>brief us?</em></h2></div>
			<div class="dkxsp-actions"><a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a><a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">Download 2026 Rate Card <span>↓</span></a></div>
		</div>
	</section>

	<nav class="dkxsp-switcher" aria-label="Solutions page design options">
		<p><span>Solutions Preview</span><?php echo esc_html( $solution_variant_name ); ?></p>
		<div>
			<?php foreach ( $solution_variants as $variant_key => $variant_label ) : ?>
			<a class="<?php echo $variant_key === $dkxv4_solutions_preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( $solution_preview_urls[ $variant_key ] ); ?>"><span><?php echo esc_html( chr( 65 + array_search( $variant_key, array_keys( $solution_variants ), true ) ) ); ?></span><?php echo esc_html( $variant_label ); ?></a>
			<?php endforeach; ?>
		</div>
	</nav>
</main>
