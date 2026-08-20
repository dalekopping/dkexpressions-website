<?php
/**
 * Three non-destructive Industries page design previews — v1.22.9.
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
		'services' => array( 'Event promotion', 'Artist features', 'Photography', 'Reviews', 'Social amplification', 'Competitions', 'Interviews', 'SEO' ),
		'color'    => '#40b8ff',
		'code'     => 'LIVE / CULTURE',
	),
	array(
		'number'   => '02',
		'name'     => 'Music',
		'signal'   => 'From emerging performers to global stages.',
		'copy'     => 'Music has been part of the DK Expressions DNA since the beginning. Our journey has crossed paths with John Legend, Carlos Santana, Bruce Springsteen, Justin Bieber, Michael Bublé, One Direction, Foo Fighters, UB40 and many more.',
		'services' => array( 'Live coverage', 'Artist storytelling', 'Photography', 'Tour announcements' ),
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
		'services' => array( 'Photography', 'Editorial', 'Experiences', 'Digital campaigns' ),
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
		'services' => array( 'Executive positioning', 'Events', 'Content', 'Photography', 'Digital campaigns' ),
		'color'    => '#62d6ff',
		'code'     => 'IDEA / AUTHORITY',
	),
	array(
		'number'   => '08',
		'name'     => 'Web & AI',
		'signal'   => 'Infrastructure that compounds.',
		'copy'     => 'We design and build websites, digital platforms and practical AI systems that reduce friction, increase output and give brands a measurable edge. No buzzwords. Just tools that perform.',
		'services' => array( 'Website design & development', 'AI-assisted content systems', 'Workflow automation', 'Custom GPTs & agents', 'Platform architecture', 'Performance & conversion optimisation' ),
		'color'    => '#b985ff',
		'code'     => 'SYSTEM / SCALE',
	),
);

$rate_card_url = home_url( '/rates/' );
$contact_url   = home_url( '/contact/' );
$page_url      = home_url( '/industries/' );

$render_services = static function ( $services ) {
	echo '<ul class="dkxip-services">';
	foreach ( $services as $service ) {
		echo '<li>' . esc_html( $service ) . '</li>';
	}
	echo '</ul>';
};

$render_rates = static function ( $rate_url, $start_url ) {
	?>
	<section class="dkxip-rates" id="core-solutions">
		<header class="dkxip-rates-intro">
			<p class="dkxip-kicker"><span>09</span> / Core Solutions &amp; Rates</p>
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
				<p class="dkxip-deliverables"><b>3</b>-month minimum · Ongoing content · Strategy · Priority scheduling · Monthly reporting</p>
			</article>
		</div>
		<div class="dkxip-custom-work"><div><span>10 / CUSTOM SIGNAL</span><h3>Additional &amp;<br>Custom Work</h3></div><p>Executive branding, campaign support, web &amp; AI projects, and multi-industry retainers are scoped individually.</p><div><b>50%</b><span>deposit to confirm</span><small>All prices exclude VAT.</small></div></div>
		<div class="dkxip-rate-actions"><a class="is-primary" href="<?php echo esc_url( $rate_url ); ?>">View Full 2026 Rate Card <span>→</span></a><a href="<?php echo esc_url( $start_url ); ?>">Start a Project <span>↗</span></a></div>
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
			<div class="dkxip-switch-core" aria-hidden="true"><i></i><i></i><span>DK</span><b>∞</b><small>SIGNAL<br>ACTIVE</small></div>
			<div class="dkxip-switch-readout"><span>INPUT</span><b>AUDIENCE</b><span>OBJECTIVE</span><b>ATTENTION</b></div>
		</section>

		<section class="dkxip-switch-stage">
			<header><p class="dkxip-kicker"><span>01—08</span> / Industry channels</p><h2>Choose a channel.<br>Build a <em>stronger signal.</em></h2></header>
			<div class="dkxip-switch-network">
				<div class="dkxip-switch-spine" aria-hidden="true"><span>DK</span><i></i><b>∞</b></div>
				<?php foreach ( $industries as $index => $industry ) : ?>
					<article class="<?php echo 0 === $index % 2 ? 'is-left' : 'is-right'; ?>" style="--signal:<?php echo esc_attr( $industry['color'] ); ?>">
						<div class="dkxip-switch-port"><span><?php echo esc_html( $industry['number'] ); ?></span><i></i><small>ONLINE</small></div>
						<div class="dkxip-switch-panel"><span><?php echo esc_html( $industry['code'] ); ?></span><h2><?php echo esc_html( $industry['name'] ); ?></h2><h3><?php echo esc_html( $industry['signal'] ); ?></h3><p><?php echo esc_html( $industry['copy'] ); ?></p><?php $render_services( $industry['services'] ); ?></div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
		<?php $render_rates( $rate_card_url, $contact_url ); ?>
		<section class="dkxip-final"><span>ROUTE / 09</span><h2>Connect more<br>than <em>one signal.</em></h2><p>Not sure which signal or package fits? Most strong projects sit across more than one industry and more than one solution.</p><a href="<?php echo esc_url( $contact_url ); ?>">Start a Project <b>↗</b></a></section>
	</main>
<?php endif; ?>

<nav class="dkxip-switcher" aria-label="Industries design previews">
	<span>Industries options</span>
	<a class="<?php echo 'atlas' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'dk-industries-preview', 'atlas', $page_url ) ); ?>">01 Signal Atlas</a>
	<a class="<?php echo 'broadcast' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'dk-industries-preview', 'broadcast', $page_url ) ); ?>">02 Spectrum Broadcast</a>
	<a class="<?php echo 'switchboard' === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'dk-industries-preview', 'switchboard', $page_url ) ); ?>">03 Infinity Switchboard</a>
</nav>
