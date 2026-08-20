<?php
/**
 * Package-first Solutions-page comparison experiences.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$solution_variants = array(
	'chapters' => 'Colour Chapters',
	'matrix'   => 'Rate Matrix',
	'vault'    => 'Package Vault',
);
$solution_variant_name = $solution_variants[ $dkxv4_solutions_preview ] ?? $solution_variants['chapters'];
$solution_preview_urls = array();
foreach ( $solution_variants as $variant_key => $variant_label ) {
	$solution_preview_urls[ $variant_key ] = add_query_arg(
		array(
			'dk-solutions-preview' => $variant_key,
			'dk-refresh'           => '1220',
		),
		home_url( '/solutions/' )
	);
}

$whatsapp_package_url = 'https://wa.me/27722460451?text=Hi%20Dale%2C%20I%20would%20like%20to%20discuss%20a%20DK%20Expressions%20package.';
$solution_families = array(
	array(
		'number'   => '01',
		'slug'     => 'event-domination',
		'class'    => 'is-blue',
		'title'    => 'Event Domination',
		'tagline'  => 'Turn the event into something people wish they attended.',
		'packages' => array(
			array( 'name' => 'Spark', 'price' => 'R6,500', 'suffix' => '/ event', 'description' => 'Entry coverage to get a brand in the door', 'badge' => '', 'features' => array( 'Up to <strong>4</strong> hours on site', '<strong>1</strong> creator', '<strong>40</strong> edited photos', '<strong>2</strong> short-form reels', 'Next-day delivery' ) ),
			array( 'name' => 'Signature', 'price' => 'R32,000', 'suffix' => '/ event', 'description' => 'The core package most events should buy', 'badge' => 'Most Chosen', 'features' => array( 'Up to <strong>8</strong> hours', 'Photo + video', 'Live posting during the event', '<strong>5</strong> reels + <strong>80</strong> edited photos', 'Same-day teaser edit', 'Post-event recap reel' ) ),
			array( 'name' => 'Takeover', 'price' => 'R95,000', 'prefix' => 'From', 'suffix' => '', 'description' => 'Multi-day or flagship productions', 'badge' => '', 'features' => array( 'Crew of <strong>2</strong>–<strong>4</strong> creators', 'Real-time social management', 'Daily reels + stories', 'Creator/influencer coordination', 'Full post-event campaign + report' ) ),
		),
	),
	array(
		'number'   => '02',
		'slug'     => 'always-on',
		'class'    => 'is-gold',
		'title'    => 'Always On',
		'tagline'  => 'Your brand should not disappear between campaigns.',
		'packages' => array(
			array( 'name' => 'Essential', 'price' => 'R15,000', 'suffix' => '/ month', 'description' => 'Consistent presence for one brand', 'badge' => '', 'features' => array( '<strong>1</strong> content shoot per month', '<strong>12</strong> edited posts', '<strong>4</strong> reels', 'Monthly content calendar', 'Basic monthly report' ) ),
			array( 'name' => 'Premium', 'price' => 'R35,000', 'suffix' => '/ month', 'description' => 'Full content and growth partner', 'badge' => 'Most Chosen', 'features' => array( '<strong>2</strong> shoots per month', '<strong>20</strong> posts + <strong>8</strong> reels', 'Full social media management', 'Content strategy + calendar', 'Paid ad creative', 'Monthly performance report' ) ),
			array( 'name' => 'Elite', 'price' => 'R60,000', 'prefix' => 'From', 'suffix' => '/ month', 'description' => 'Own the category online', 'badge' => '', 'features' => array( 'Weekly shoots + content drops', 'Unlimited posts within scope', 'Full social + community management', 'Monthly event coverage', 'Paid ad management', 'Dedicated strategy sessions' ) ),
		),
	),
	array(
		'number'   => '03',
		'slug'     => 'become-the-name',
		'class'    => 'is-purple',
		'title'    => 'Become the Name',
		'tagline'  => 'People cannot hire, book or invest in someone they never see.',
		'packages' => array(
			array( 'name' => 'Starter', 'price' => 'R18,000', 'suffix' => '/ month', 'description' => 'Show up consistently and look the part', 'badge' => '', 'features' => array( '<strong>1</strong> shoot per month', '<strong>12</strong> personal-brand posts', '<strong>4</strong> short-form videos', 'Instagram + TikTok content' ) ),
			array( 'name' => 'Growth', 'price' => 'R40,000', 'suffix' => '/ month', 'description' => 'Build real authority and reach', 'badge' => 'Most Chosen', 'features' => array( '<strong>2</strong> shoots per month', '<strong>20</strong> posts + <strong>8</strong> videos', 'Personal-brand strategy', 'Full content management', 'Interview/talking-head series', 'Monthly review + reporting' ) ),
			array( 'name' => 'Authority', 'price' => 'R75,000', 'prefix' => 'From', 'suffix' => '/ month', 'description' => 'Become the name in your field', 'badge' => '', 'features' => array( 'Weekly content production', 'Media + PR positioning', 'Podcast/video show production', 'Full multi-platform management', 'Ghostwriting + thought leadership', 'Quarterly brand strategy sessions' ) ),
		),
	),
	array(
		'number'   => '04',
		'slug'     => 'own-the-attention',
		'class'    => 'is-red',
		'title'    => 'Own the Attention',
		'tagline'  => 'Turn DK Expressions publishing authority into sustained brand visibility.',
		'packages' => array(
			array( 'name' => 'Feature', 'price' => 'R1,500', 'suffix' => '/ placement', 'description' => 'A focused sponsored editorial feature', 'badge' => '', 'features' => array( '<strong>1</strong> dedicated editorial listing', '<strong>1</strong> social amplification post', 'Live for <strong>12</strong> months' ) ),
			array( 'name' => 'Spotlight', 'price' => 'R6,000', 'suffix' => '/ campaign', 'description' => 'Sustained presence over a season', 'badge' => 'Best Value', 'features' => array( '<strong>8</strong> editorial listings', 'Social amplification on each', 'Instagram + Facebook + X coverage', 'Campaign-window placement' ) ),
			array( 'name' => 'Headline', 'price' => 'R12,500', 'suffix' => '/ campaign', 'description' => 'Dominant ongoing exposure', 'badge' => '', 'features' => array( '<strong>16</strong> editorial listings', 'Full social amplification per post', 'Priority placement + tagging', 'Optional event-coverage tie-in' ) ),
		),
	),
);
?>

<main class="dkxsr dkxsr--<?php echo esc_attr( $dkxv4_solutions_preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxsr-grid" aria-hidden="true"></div>
	<section class="dkxsr-hero">
		<div class="dkxsr-shell">
			<p class="dkxsr-eyebrow">DK Expressions · Solutions</p>
			<h1>Choose the level<br>of <em>attention.</em></h1>
			<p class="dkxsr-hero-copy">Four focused solution systems. Twelve clear starting points. Built to make the moment, the brand and the name impossible to ignore.</p>
			<nav class="dkxsr-family-nav" aria-label="Solution families">
				<?php foreach ( $solution_families as $family ) : ?><a class="<?php echo esc_attr( $family['class'] ); ?>" href="#<?php echo esc_attr( $family['slug'] ); ?>"><span><?php echo esc_html( $family['number'] ); ?></span><?php echo esc_html( $family['title'] ); ?></a><?php endforeach; ?>
			</nav>
		</div>
	</section>

	<?php require get_stylesheet_directory() . '/template-parts/booking-pulse.php'; ?>

	<section class="dkxsr-analytics" aria-label="DK Expressions verified server analytics">
		<div class="dkxsr-shell">
			<header class="dkxsr-analytics-head">
				<div><p class="dkxsr-eyebrow">Proof, Not Promises</p><h2>Independent<br><em>Server Analytics.</em></h2></div>
				<p class="dkxsr-analytics-period">DK Expressions server analytics<br><strong>September 2025–August 2026</strong></p>
			</header>
			<div class="dkxsr-analytics-grid">
				<article class="dkxsr-stat is-visits" data-stat="01"><span class="dkxsr-stat-index">01</span><strong class="dkxsr-stat-value">1.10M+</strong><b class="dkxsr-stat-label">Visits</b><p class="dkxsr-stat-copy">People entering the DK Expressions universe.</p></article>
				<article class="dkxsr-stat is-pages" data-stat="02"><span class="dkxsr-stat-index">02</span><strong class="dkxsr-stat-value">2.47M+</strong><b class="dkxsr-stat-label">Pages Viewed</b></article>
				<article class="dkxsr-stat is-hits" data-stat="03"><span class="dkxsr-stat-index">03</span><strong class="dkxsr-stat-value">6.13M+</strong><b class="dkxsr-stat-label">Hits</b></article>
				<article class="dkxsr-stat is-live" data-stat="04"><span class="dkxsr-stat-index">Live <i aria-hidden="true"></i></span><strong class="dkxsr-stat-value">97,603</strong><b class="dkxsr-stat-label">August Visits</b></article>
			</div>
			<p class="dkxsr-analytics-source"><i aria-hidden="true"></i>Verified Server Analytics · Webalizer</p>
		</div>
	</section>

	<div class="dkxsr-families">
		<?php foreach ( $solution_families as $family ) : ?>
		<section class="dkxsr-family <?php echo esc_attr( $family['class'] ); ?>" id="<?php echo esc_attr( $family['slug'] ); ?>">
			<div class="dkxsr-shell">
				<header class="dkxsr-family-head">
					<div><p class="dkxsr-family-kicker"><?php echo esc_html( $family['number'] ); ?> / <?php echo esc_html( $family['title'] ); ?></p><h2><?php echo esc_html( $family['title'] ); ?></h2></div>
					<p class="dkxsr-family-tagline"><?php echo esc_html( $family['tagline'] ); ?></p>
				</header>
				<div class="dkxsr-package-grid">
					<?php foreach ( $family['packages'] as $package_index => $package ) : ?>
					<article class="dkxsr-package <?php echo $package['badge'] ? 'is-featured' : ''; ?>">
						<?php if ( $package['badge'] ) : ?><b class="dkxsr-badge"><?php echo esc_html( $package['badge'] ); ?></b><?php endif; ?>
						<header><span><?php echo esc_html( str_pad( (string) ( $package_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $package['name'] ); ?></h3></header>
						<p class="dkxsr-price"><?php if ( ! empty( $package['prefix'] ) ) : ?><small><?php echo esc_html( $package['prefix'] ); ?></small><?php endif; ?><strong><?php echo esc_html( $package['price'] ); ?></strong><?php if ( $package['suffix'] ) : ?><span><?php echo esc_html( $package['suffix'] ); ?></span><?php endif; ?></p>
						<p class="dkxsr-description"><?php echo esc_html( $package['description'] ); ?></p>
						<ul><?php foreach ( $package['features'] as $feature ) : ?><li><?php echo wp_kses_post( $feature ); ?></li><?php endforeach; ?></ul>
						<a href="<?php echo esc_url( $whatsapp_package_url ); ?>" target="_blank" rel="noopener">Discuss this package <span>↗</span></a>
					</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endforeach; ?>
	</div>

	<section class="dkxsr-custom">
		<div class="dkxsr-shell dkxsr-custom-grid">
			<div><p class="dkxsr-eyebrow">Need something that does not fit in a box?</p><h2>Build a custom<br><em>campaign.</em></h2></div>
			<div><p class="dkxsr-custom-copy">Starting rates exclude VAT where applicable. Final quotations depend on scope, crew, production requirements, travel and deliverables. Project bookings require a <strong>50</strong>% deposit. Retainers carry a three-month minimum.</p><div class="dkxsr-actions"><a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project <span>↗</span></a><a href="<?php echo esc_url( $whatsapp_package_url ); ?>" target="_blank" rel="noopener">WhatsApp us <span>→</span></a></div></div>
		</div>
	</section>

	<?php if ( ! empty( $dkxv4_solutions_is_preview ) ) : ?>
	<nav class="dkxsr-switcher" aria-label="Solutions page design options">
		<p><span>Solutions Preview</span><?php echo esc_html( $solution_variant_name ); ?></p>
		<div><?php foreach ( $solution_variants as $variant_key => $variant_label ) : ?><a class="<?php echo $variant_key === $dkxv4_solutions_preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( $solution_preview_urls[ $variant_key ] ); ?>"><span><?php echo esc_html( chr( 65 + array_search( $variant_key, array_keys( $solution_variants ), true ) ) ); ?></span><?php echo esc_html( $variant_label ); ?></a><?php endforeach; ?></div>
	</nav>
	<?php endif; ?>
</main>
