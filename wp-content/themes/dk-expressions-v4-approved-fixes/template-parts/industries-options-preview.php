<?php
/**
 * Industries Infinity Switchboard and archived design previews — v1.23.2.
 *
 * @package DK_Expressions_V4_Fixes
 */

$preview = isset( $args['preview'] ) ? sanitize_key( $args['preview'] ) : 'atlas';
$preview = in_array( $preview, array( 'atlas', 'broadcast', 'switchboard' ), true ) ? $preview : 'atlas';

$industries = array(
	array(
		'number'   => '01',
		'name'     => 'Entertainment & Live Events',
		'signal'   => 'This is where DK Expressions was forged.',
		'copy'     => 'Concerts, festivals, comedy, theatre, exhibitions, international tours and cultural experiences. We understand the difference between simply announcing an event and making people feel that they cannot afford to miss it.',
		'services' => array( 'Event promotion', 'Artist features', 'Photography', 'Reviews', 'Social Media Management', 'Online Publishing', 'Competitions', 'Interviews', 'SEO' ),
		'color'    => '#40b8ff',
		'code'     => 'LIVE / CULTURE',
	),
	array(
		'number'   => '02',
		'name'     => 'Music',
		'signal'   => 'From emerging performers to global stages.',
		'copy'     => 'Music has been part of the DK Expressions DNA since the beginning. Our journey has crossed paths with John Legend, Carlos Santana, Bruce Springsteen, Justin Bieber, Michael Bublé, One Direction, Foo Fighters, UB40 and many more.',
		'services' => array( 'Live coverage', 'Artist storytelling', 'Photography', 'Tour announcements', 'Social Media Management', 'Online Publishing' ),
		'color'    => '#976dff',
		'code'     => 'SOUND / STAGE',
	),
	array(
		'number'   => '03',
		'name'     => 'Film, Theatre & Performing Arts',
		'signal'   => 'Extend the experience beyond the venue.',
		'copy'     => 'From premieres and productions to reviews and interviews, we create content that communicates the emotion and spectacle of live performance and screen entertainment.',
		'services' => array( 'Reviews', 'Premieres', 'Production coverage', 'Interviews' ),
		'color'    => '#ff5364',
		'code'     => 'SCREEN / STAGE',
	),
	array(
		'number'   => '04',
		'name'     => 'Technology & Gaming',
		'signal'   => 'Specifications tell. Stories explain why it matters.',
		'copy'     => 'Technology launches, product experiences, reviews, gaming coverage and digital storytelling that translates technical products into human experiences.',
		'services' => array( 'Launches', 'Reviews', 'Product storytelling', 'Gaming' ),
		'color'    => '#20d7c8',
		'code'     => 'TECH / PLAY',
	),
	array(
		'number'   => '05',
		'name'     => 'Lifestyle & Hospitality',
		'signal'   => 'Sell the feeling, not only the features.',
		'copy'     => 'Photography, editorial and digital campaigns for hospitality, travel, lifestyle and experience-driven businesses.',
		'services' => array( 'Photography', 'Editorial', 'Experiences', 'Digital campaigns', 'Social Media Management', 'Online Publishing' ),
		'color'    => '#ffc34f',
		'code'     => 'PLACE / FEELING',
	),
	array(
		'number'   => '06',
		'name'     => 'Property & Real Estate',
		'signal'   => 'Turn property into opportunity.',
		'copy'     => 'Visual storytelling, digital advertising, copywriting, social content and campaign strategy that transform properties into compelling opportunities.',
		'services' => array( 'Property photography', 'Listing content', 'Social campaigns', 'Digital advertising' ),
		'color'    => '#ff8a4c',
		'code'     => 'SPACE / VALUE',
	),
	array(
		'number'   => '07',
		'name'     => 'Corporate & B2B',
		'signal'   => 'Corporate communication does not have to feel corporate.',
		'copy'     => 'We translate complex propositions into clear, engaging stories through executive positioning, events, content, photography and digital campaigns.',
		'services' => array( 'Executive positioning', 'Events', 'Content', 'Photography', 'Digital campaigns', 'Social Media Management', 'Online Publishing' ),
		'color'    => '#62d6ff',
		'code'     => 'IDEA / AUTHORITY',
	),
	array(
		'number'   => '08',
		'name'     => 'Web & AI',
		'signal'   => 'Infrastructure that compounds.',
		'copy'     => 'We design and build websites, digital platforms and practical AI systems that reduce friction, increase output and give brands a measurable edge. No buzzwords. Just tools that perform.',
		'services' => array( 'Website design & development', 'AI-assisted content systems', 'Workflow automation', 'Custom GPTs & agents', 'Platform architecture', 'Online Publishing systems', 'Performance & conversion optimisation' ),
		'color'    => '#b985ff',
		'code'     => 'SYSTEM / SCALE',
	),
);

$rate_card_url = home_url( '/rates/' );
$contact_url   = home_url( '/contact/' );
$page_url      = home_url( '/industries/' );
$whatsapp_package_url = 'https://wa.me/27722460451?text=Hi%20Dale%2C%20I%20would%20like%20to%20discuss%20a%20DK%20Expressions%20package.';

/* Keep the Industries Package Vault identical to the locked Solutions rates. */
$solution_families = array(
	array(
		'number'   => '01',
		'slug'     => 'industry-event-domination',
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
		'slug'     => 'industry-always-on',
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
		'slug'     => 'industry-become-the-name',
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
		'slug'     => 'industry-own-the-attention',
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

$render_services = static function ( $services ) {
	echo '<ul class="dkxip-services">';
	foreach ( $services as $service ) {
		echo '<li>' . esc_html( $service ) . '</li>';
	}
	echo '</ul>';
};

$render_rates = static function ( $rate_url, $start_url, $sequence = array( '09', '10' ) ) {
	?>
	<section class="dkxip-rates" id="core-solutions">
		<header class="dkxip-rates-intro">
			<p class="dkxip-kicker"><span><?php echo esc_html( $sequence[0] ); ?></span> / Core Solutions &amp; Rates</p>
			<h2>Clear packages.<br><em>No hourly surprises.</em></h2>
			<p>Most clients work with us through one of these clear packages. Scopes are fixed so there are no hourly surprises.</p>
		</header>
		<div class="dkxip-rate-deck">
			<article class="dkxip-rate-card is-event">
				<header><span>LIVE / EXPERIENCE</span><h3>Event<br>Domination</h3><p>Ideal for Entertainment, Music, Theatre, Festivals and live experiences.</p></header>
				<div class="dkxip-rate-lines"><div><span>Entry</span><strong>R6,500</strong></div><div class="is-chosen"><b>Most Chosen</b><span>Signature</span><strong>R32,000</strong></div><div><span>Premium</span><strong>From R95,000</strong></div></div>
				<p class="dkxip-deliverables">Up to <b>8</b> hours coverage · Photography + video · Live posting · Next-day gallery</p>
			</article>
			<article class="dkxip-rate-card is-brand">
				<header><span>ALWAYS / VISIBLE</span><h3>Brand<br>Retainer</h3><p>Ideal for Hospitality, Property, Corporate, Lifestyle and ongoing brand needs.</p></header>
				<div class="dkxip-rate-lines"><div><span>Entry</span><strong>R15,000 <i>/ month</i></strong></div><div class="is-chosen"><b>Most Chosen</b><span>Core</span><strong>R35,000 <i>/ month</i></strong></div><div><span>Premium</span><strong>From R60,000 <i>/ month</i></strong></div></div>
				<p class="dkxip-deliverables"><b>3</b>-month minimum · Ongoing content · Social Media Management · Strategy · Priority scheduling · Monthly reporting</p>
			</article>
		</div>
		<div class="dkxip-custom-work"><div><span><?php echo esc_html( $sequence[1] ); ?> / CUSTOM SIGNAL</span><h3>Additional &amp;<br>Custom Work</h3></div><p>Executive branding, campaign support, web &amp; AI projects, and multi-industry retainers are scoped individually.</p><div><b>50%</b><span>deposit to confirm</span><small>All prices exclude VAT.</small></div></div>
		<div class="dkxip-rate-actions"><a class="is-primary" href="<?php echo esc_url( $rate_url ); ?>">View Full 2026 Rate Card <span>→</span></a><a href="<?php echo esc_url( $start_url ); ?>">Start a Project <span>↗</span></a></div>
	</section>
	<?php
};

$render_solution_vault = static function ( $families, $whatsapp_url, $rate_url, $start_url ) {
	?>
	<section class="dkxip-solution-vault dkxsr dkxsr--vault" id="core-solutions">
		<div class="dkxip-vault-intro dkxsr-shell">
			<p class="dkxip-kicker"><span>10</span> / The Package Vault</p>
			<h2>Same solutions.<br><em>Same locked rates.</em></h2>
			<p>Every package below is identical to the locked Solutions page—from the starting price and scope to the most-chosen recommendation.</p>
			<a href="<?php echo esc_url( $rate_url ); ?>">View Full 2026 Rate Card <span>→</span></a>
		</div>
		<div class="dkxsr-families">
			<?php foreach ( $families as $family ) : ?>
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
							<a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener">Discuss this package <span>↗</span></a>
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
				<div><p class="dkxsr-custom-copy">Starting rates exclude VAT where applicable. Final quotations depend on scope, crew, production requirements, travel and deliverables. Project bookings require a <strong>50</strong>% deposit. Retainers carry a three-month minimum.</p><div class="dkxsr-actions"><a class="is-primary" href="<?php echo esc_url( $start_url ); ?>">Start a project <span>↗</span></a><a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener">WhatsApp us <span>→</span></a></div></div>
			</div>
		</section>
	</section>
	<?php
};
?>

<?php if ( 'atlas' === $preview ) : ?>
	<main class="dkxip dkxip--atlas dk-no-semantic-highlight" id="top">
		<section class="dkxip-atlas-hero">
			<div class="dkxip-atlas-code"><span>DK / SIGNAL MAP</span><strong>2013 — ∞</strong><i>08 ACTIVE SECTORS</i></div>
			<div class="dkxip-atlas-title"><p class="dkxip-kicker"><span>Option 01</span> / Signal Atlas</p><small>Where we work</small><h1>Different industries.<br>One obsession:<br><em>attention.</em></h1><p>We start with the audience and the objective — not a generic marketing template.</p></div>
			<div class="dkxip-atlas-compass" aria-hidden="true"><span>N</span><i>DK</i><b>∞</b></div>
		</section>

		<section class="dkxip-atlas-map">
			<aside><p>Signal index</p><?php foreach ( $industries as $industry ) : ?><a href="#atlas-<?php echo esc_attr( $industry['number'] ); ?>" style="--signal:<?php echo esc_attr( $industry['color'] ); ?>"><span><?php echo esc_html( $industry['number'] ); ?></span><?php echo esc_html( $industry['code'] ); ?></a><?php endforeach; ?></aside>
			<div class="dkxip-atlas-chapters">
				<?php foreach ( $industries as $industry ) : ?>
					<article id="atlas-<?php echo esc_attr( $industry['number'] ); ?>" style="--signal:<?php echo esc_attr( $industry['color'] ); ?>">
						<div class="dkxip-atlas-number"><span><?php echo esc_html( $industry['number'] ); ?></span><small>Industry signal</small></div>
						<div class="dkxip-atlas-copy"><p><?php echo esc_html( $industry['code'] ); ?></p><h2><?php echo esc_html( $industry['name'] ); ?></h2><h3><?php echo esc_html( $industry['signal'] ); ?></h3><div><p><?php echo esc_html( $industry['copy'] ); ?></p><?php $render_services( $industry['services'] ); ?></div></div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
		<?php $render_rates( $rate_card_url, $contact_url ); ?>
		<section class="dkxip-final"><span>11 / CROSS-SIGNAL WORK</span><h2>Strong projects rarely<br>stay in <em>one lane.</em></h2><p>Not sure which signal or package fits? Most strong projects sit across more than one industry and more than one solution.</p><a href="<?php echo esc_url( $contact_url ); ?>">Start a Project <b>↗</b></a></section>
	</main>
<?php elseif ( 'broadcast' === $preview ) : ?>
	<main class="dkxip dkxip--broadcast dk-no-semantic-highlight" id="top">
		<section class="dkxip-broadcast-hero">
			<div class="dkxip-broadcast-mast"><span>DK EXPRESSIONS / INDUSTRIES</span><b>ISSUE 08</b></div>
			<div class="dkxip-broadcast-title"><p class="dkxip-kicker"><span>Option 02</span> / Spectrum Broadcast</p><small>Where we work</small><h1>Attention<br>has no single<br><em>industry.</em></h1></div>
			<div class="dkxip-broadcast-note"><b>Different industries. One obsession: attention.</b><p>We start with the audience and the objective — not a generic marketing template.</p><span>DK / SIGNAL MAP 2013 — ∞</span></div>
			<div class="dkxip-broadcast-word" aria-hidden="true">SIGNAL</div>
		</section>

		<section class="dkxip-broadcast-board">
			<header><p>Industry signals</p><span>Eight sectors / One connected studio</span></header>
			<div class="dkxip-broadcast-grid">
				<?php foreach ( $industries as $index => $industry ) : ?>
					<article class="is-card-<?php echo esc_attr( (string) ( $index + 1 ) ); ?>" style="--signal:<?php echo esc_attr( $industry['color'] ); ?>">
						<div class="dkxip-broadcast-id"><span><?php echo esc_html( $industry['number'] ); ?></span><small><?php echo esc_html( $industry['code'] ); ?></small></div>
						<h2><?php echo esc_html( $industry['name'] ); ?></h2><h3><?php echo esc_html( $industry['signal'] ); ?></h3><p><?php echo esc_html( $industry['copy'] ); ?></p><?php $render_services( $industry['services'] ); ?>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
		<?php $render_rates( $rate_card_url, $contact_url ); ?>
		<section class="dkxip-final"><span>END NOTE / BEGIN BRIEF</span><h2>Cross the lines.<br><em>Own the attention.</em></h2><p>Not sure which signal or package fits? Most strong projects sit across more than one industry and more than one solution.</p><a href="<?php echo esc_url( $contact_url ); ?>">Start a Project <b>↗</b></a></section>
	</main>
<?php else : ?>
	<main class="dkxip dkxip--switchboard dk-no-semantic-highlight" id="top">
		<section class="dkxip-switch-hero">
			<div class="dkxip-switch-topline"><span>DK / SIGNAL MAP 2013 — ∞</span><b>08 CHANNELS ONLINE</b></div>
			<div class="dkxip-switch-copy"><p class="dkxip-kicker"><span>Option 03</span> / Infinity Switchboard</p><small>Where we work</small><h1>Different<br>industries.<br><em>One signal.</em></h1><p>One obsession: attention. We start with the audience and the objective — not a generic marketing template.</p></div>
			<div class="dkxip-switch-core" aria-hidden="true"><i></i><i></i><span><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt=""></span><b>∞</b><small>SIGNAL<br>ACTIVE</small></div>
			<div class="dkxip-switch-readout"><span>INPUT</span><b>AUDIENCE</b><span>OBJECTIVE</span><b>ATTENTION</b></div>
		</section>

		<section class="dkxip-switch-stage">
			<header><p class="dkxip-kicker"><span>01—08</span> / Industry channels</p><h2>Choose a channel.<br>Build a <em>stronger signal.</em></h2></header>
			<div class="dkxip-switch-network">
				<div class="dkxip-switch-spine" aria-hidden="true"><span><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt=""></span><i></i><b>∞</b></div>
				<?php foreach ( $industries as $index => $industry ) : ?>
					<article class="<?php echo 0 === $index % 2 ? 'is-left' : 'is-right'; ?>" style="--signal:<?php echo esc_attr( $industry['color'] ); ?>">
						<div class="dkxip-switch-port"><span><?php echo esc_html( $industry['number'] ); ?></span><i></i><small>ONLINE</small></div>
						<div class="dkxip-switch-panel"><span><?php echo esc_html( $industry['code'] ); ?></span><h2><?php echo esc_html( $industry['name'] ); ?></h2><h3><?php echo esc_html( $industry['signal'] ); ?></h3><p><?php echo esc_html( $industry['copy'] ); ?></p><?php $render_services( $industry['services'] ); ?></div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
		<section class="dkxip-switch-publishing">
			<header><p class="dkxip-kicker"><span>09</span> / Always-on attention</p><h2>Social and publishing<br>are part of the <em>system.</em></h2><p>Strong creative work needs somewhere to live, move and compound. These capabilities connect every industry channel to a consistent audience journey.</p></header>
			<div>
				<article class="is-social"><span>01 / MANAGE THE CONVERSATION</span><h3>Social Media<br>Management</h3><p>Strategy, content calendars, platform-native publishing, community management, paid amplification and performance reporting—managed as one continuous brand signal.</p><ul><li>Content strategy</li><li>Platform management</li><li>Community engagement</li><li>Paid social creative</li><li>Monthly reporting</li></ul></article>
				<article class="is-publishing"><span>02 / OWN THE DISTRIBUTION</span><h3>Online<br>Publishing</h3><p>Editorial features, announcements, interviews, reviews and SEO-led stories published through the DK Expressions platform and built to remain discoverable beyond launch day.</p><ul><li>Editorial production</li><li>SEO publishing</li><li>Features &amp; interviews</li><li>Campaign distribution</li><li>Archive visibility</li></ul></article>
			</div>
		</section>
		<?php $render_solution_vault( $solution_families, $whatsapp_package_url, $rate_card_url, $contact_url ); ?>
		<section class="dkxip-final"><span>ROUTE / 11</span><h2>Connect more<br>than <em>one signal.</em></h2><p>Not sure which signal or package fits? Most strong projects sit across more than one industry and more than one solution.</p><a href="<?php echo esc_url( $contact_url ); ?>">Start a Project <b>↗</b></a></section>
	</main>
<?php endif; ?>


<?php if ( empty( $args['locked'] ) ) : ?>
<nav class="dkxip-switcher" aria-label="Industries design previews">
	<span>Industries options</span>
	<a class="<?php echo 'atlas' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'dk-industries-preview' => 'atlas', 'dk-refresh' => '1231' ), $page_url ) ); ?>">01 Signal Atlas</a>
	<a class="<?php echo 'broadcast' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'dk-industries-preview' => 'broadcast', 'dk-refresh' => '1231' ), $page_url ) ); ?>">02 Spectrum Broadcast</a>
	<a class="<?php echo 'switchboard' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'dk-industries-preview' => 'switchboard', 'dk-refresh' => '1231' ), $page_url ) ); ?>">03 Infinity Switchboard</a>
</nav>
<?php endif; ?>
