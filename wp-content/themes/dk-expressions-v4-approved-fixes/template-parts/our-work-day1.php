<?php
/**
 * DK Expressions Our Work / Time Vault — proof-led commercial portfolio.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$asset_url = static function ( $filename ) {
	return get_stylesheet_directory_uri() . '/assets/our-work-preview/' . $filename;
};

$rate_card_url = get_stylesheet_directory_uri() . '/assets/downloads/DK-Expressions-2026-Rate-Card.pdf';
$contact_url   = home_url( '/contact/' );

$case_studies = array(
	array(
		'number'     => '01',
		'name'       => 'Ultra South Africa',
		'year'       => '2023',
		'client'     => 'Ultra South Africa',
		'copy'       => 'A field-level record of scale, smoke, light and crowd energy—captured from inside one of the country’s defining festival environments.',
		'outputs'    => 'Main-stage frames · Crowd atmosphere · Archive selects',
		'services'   => 'Live photography · Festival storytelling · Editorial',
		'categories' => 'live-events festivals',
		'color'      => '#40b8ff',
		'image'      => 'ultra-sa-2023.jpg',
		'alt'        => 'Ultra South Africa main stage photographed by DK Expressions',
	),
	array(
		'number'     => '02',
		'name'       => 'Collective Soul & Lifehouse',
		'year'       => '2018',
		'client'     => 'Big Concerts',
		'copy'       => 'Two international rock acts, one live brief and a visual record built around performance, scale and the moments between the expected shots.',
		'outputs'    => 'Performance gallery · Stage wides · Artist moments',
		'services'   => 'Concert photography · Event coverage · Archive delivery',
		'categories' => 'live-events',
		'color'      => '#976dff',
		'image'      => 'collective-soul.jpg',
		'alt'        => 'Collective Soul performing live in South Africa',
	),
	array(
		'number'     => '03',
		'name'       => 'Priscilla, Queen of the Desert',
		'year'       => '2017',
		'client'     => 'Showtime Management',
		'copy'       => 'Stage photography and backstage storytelling that carried the colour, character and human detail of the South African production beyond the curtain.',
		'outputs'    => 'Production frames · Backstage interview · Motion archive',
		'services'   => 'Theatre photography · Interview · Video',
		'categories' => 'theatre-performance portraits-moments',
		'color'      => '#ff5364',
		'image'      => 'priscilla-queen-of-the-desert.jpg',
		'alt'        => 'Priscilla Queen of the Desert South African stage production',
	),
	array(
		'number'     => '04',
		'name'       => 'Delicious International Food & Music Festival',
		'year'       => '2013',
		'client'     => 'Delicious Festival',
		'copy'       => 'A first-edition festival record preserving the scale, atmosphere and cultural mix of a Johannesburg experience that would keep growing.',
		'outputs'    => 'Festival overview · Audience frames · Cultural archive',
		'services'   => 'Festival photography · Lifestyle storytelling · Editorial',
		'categories' => 'festivals brand-lifestyle',
		'color'      => '#ffc34f',
		'image'      => 'delicious-2013.jpg',
		'alt'        => 'Delicious International Food and Music Festival in 2013',
	),
	array(
		'number'     => '05',
		'name'       => 'Kings of Chaos',
		'year'       => '2014',
		'client'     => 'Live production coverage',
		'copy'       => 'Moving evidence from a high-volume rock production, preserving the sound, stage presence and audience energy that a still frame cannot hold alone.',
		'outputs'    => 'Performance footage · Motion selects · Archive master',
		'services'   => 'Live filming · Motion storytelling · Event coverage',
		'categories' => 'live-events',
		'color'      => '#20d7c8',
		'video'      => 'kings-of-chaos-2014.mp4',
	),
	array(
		'number'     => '06',
		'name'       => 'Timmy Trumpet — In the Room',
		'year'       => '2023',
		'client'     => 'Artist interview coverage',
		'copy'       => 'A close-range interview record focused on personality and presence—the part of the story that happens away from the stage.',
		'outputs'    => 'Interview frames · Behind-the-scenes selects · Social assets',
		'services'   => 'Interview · Portraiture · Editorial storytelling',
		'categories' => 'portraits-moments live-events',
		'color'      => '#ff8a4c',
		'image'      => 'timmy-trumpet-interview.jpg',
		'alt'        => 'DK Expressions with Timmy Trumpet after an interview',
	),
	array(
		'number'     => '07',
		'name'       => 'Monster Motocross Nationals',
		'year'       => '2014',
		'client'     => 'Monster Motocross Nationals',
		'copy'       => 'Fast-action field coverage built around timing, endurance and the split seconds that make sport feel immediate long after the event.',
		'outputs'    => 'Action sequence · Event gallery · Archive selects',
		'services'   => 'Action photography · Sports coverage · Rapid selection',
		'categories' => 'action-sport',
		'color'      => '#7ee081',
		'type'       => 'typographic',
	),
	array(
		'number'     => '08',
		'name'       => 'Comic Choice Awards',
		'year'       => 'Time Vault',
		'client'     => 'One-Eyed Jack',
		'copy'       => 'Event and social storytelling from a room built around South African comedy, personality and the moments audiences do not see from their seats.',
		'outputs'    => 'Event coverage · Social media assets · Editorial record',
		'services'   => 'Comedy coverage · Photography · Social media',
		'categories' => 'comedy portraits-moments',
		'color'      => '#62d6ff',
		'type'       => 'typographic',
	),
);
?>

<main class="dkxday1 dk-no-semantic-highlight" id="top">
	<section class="dkxday1-hero" aria-labelledby="dkxday1-title">
		<div class="dkxday1-hero-grid" aria-hidden="true"></div>
		<div class="dkxday1-hero-copy">
			<p class="dkxday1-kicker">The DK Expressions Time Vault <span>● Archive live</span></p>
			<h1 id="dkxday1-title"><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'work_day1_heading', "WE WERE\nTHERE." ) ) ); ?></h1>
			<p class="dkxday1-era">2013 <i>—</i> ∞</p>
		</div>
		<div class="dkxday1-hero-proof">
			<div class="dkxday1-hero-mark"><span>DK</span><i></i></div>
			<p><?php echo esc_html( dkxv4_page_meta( 'work_day1_intro', 'Not stock. Not mock-ups. Not promises.' ) ); ?></p>
			<strong><?php echo esc_html( dkxv4_page_meta( 'work_day1_support', 'This is work captured, filmed and produced by DK Expressions.' ) ); ?></strong>
			<a href="#selected-work">Open the evidence <span>↓</span></a>
		</div>
	</section>

	<section class="dkxday1-proof" aria-label="DK Expressions proof bar">
		<article style="--signal:#40b8ff"><span>01</span><strong>1.10M+</strong><small>Visits</small></article>
		<article style="--signal:#ffc34f"><span>02</span><strong>2.47M+</strong><small>Pages viewed</small></article>
		<article style="--signal:#976dff"><span>03</span><strong>6.13M+</strong><small>Hits</small></article>
		<article style="--signal:#ff5364"><span>04</span><strong>13+</strong><small>Years</small></article>
		<article style="--signal:#20d7c8"><span>05</span><strong>2,000+</strong><small>Projects</small></article>
	</section>

	<nav class="dkxday1-filters" aria-label="Filter selected work">
		<div>
			<p>Filter the archive</p>
			<button type="button" class="is-active" data-dkx-work-filter="all" aria-pressed="true">All</button>
			<button type="button" data-dkx-work-filter="live-events" aria-pressed="false">Live Events</button>
			<button type="button" data-dkx-work-filter="festivals" aria-pressed="false">Festivals</button>
			<button type="button" data-dkx-work-filter="theatre-performance" aria-pressed="false">Theatre &amp; Performance</button>
			<button type="button" data-dkx-work-filter="comedy" aria-pressed="false">Comedy</button>
			<button type="button" data-dkx-work-filter="brand-lifestyle" aria-pressed="false">Brand &amp; Lifestyle</button>
			<button type="button" data-dkx-work-filter="action-sport" aria-pressed="false">Action &amp; Sport</button>
			<button type="button" data-dkx-work-filter="portraits-moments" aria-pressed="false">Portraits &amp; Moments</button>
		</div>
	</nav>

	<section class="dkxday1-work" id="selected-work">
		<header class="dkxday1-section-head">
			<p class="dkxday1-kicker"><span>01</span> / Selected Work</p>
			<h2><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'work_selected_heading', "Proof lives\nin the frame." ) ) ); ?></h2>
			<p><?php echo esc_html( dkxv4_page_meta( 'work_selected_copy', 'Eight recovered records from more than a decade in the room. Every card is work made by DK Expressions.' ) ); ?></p>
		</header>

		<div class="dkxday1-case-grid" data-dkx-work-grid>
			<?php foreach ( $case_studies as $index => $case ) : ?>
			<article class="dkxday1-case <?php echo 0 === $index || 3 === $index ? 'is-wide' : ''; ?>" style="--signal:<?php echo esc_attr( $case['color'] ); ?>" data-dkx-work-card data-categories="<?php echo esc_attr( $case['categories'] ); ?>">
				<div class="dkxday1-case-media<?php echo ! empty( $case['type'] ) ? ' is-typographic' : ''; ?>" data-dkx-media-slot="replace" data-dkx-media-class="dkxday1-case-asset" data-dkx-media-label="<?php echo esc_attr( $case['name'] ); ?> media">
					<?php if ( ! empty( $case['video'] ) ) : ?>
						<video class="dkxday1-case-asset" controls preload="metadata" playsinline><source src="<?php echo esc_url( $asset_url( $case['video'] ) ); ?>" type="video/mp4"></video>
					<?php elseif ( ! empty( $case['image'] ) ) : ?>
						<img class="dkxday1-case-asset" src="<?php echo esc_url( $asset_url( $case['image'] ) ); ?>" alt="<?php echo esc_attr( $case['alt'] ); ?>" loading="lazy">
					<?php else : ?>
						<div class="dkxday1-case-type" aria-hidden="true"><span><?php echo esc_html( $case['number'] ); ?></span><b><?php echo esc_html( $case['name'] ); ?></b></div>
					<?php endif; ?>
					<span class="dkxday1-case-index"><?php echo esc_html( $case['number'] ); ?></span>
				</div>
				<div class="dkxday1-case-copy">
					<header><p><?php echo esc_html( $case['client'] ); ?></p><span><?php echo esc_html( $case['year'] ); ?></span></header>
					<h3><?php echo esc_html( $case['name'] ); ?></h3>
					<p class="dkxday1-case-delivery"><?php echo esc_html( $case['copy'] ); ?></p>
					<dl><div><dt>Key outputs</dt><dd><?php echo esc_html( $case['outputs'] ); ?></dd></div><div><dt>Services used</dt><dd><?php echo esc_html( $case['services'] ); ?></dd></div></dl>
					<a href="<?php echo esc_url( $contact_url ); ?>">Create something like this <span>→ Start a Project</span></a>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
		<p class="dkxday1-empty" data-dkx-work-empty hidden>No recovered records match this signal yet. Choose another archive filter.</p>
	</section>

	<section class="dkxday1-recommendations" id="recommendations">
		<header class="dkxday1-section-head">
			<p class="dkxday1-kicker"><span>02</span> / Recommendation Wall</p>
			<h2><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'work_margin_heading', "Reputation,\ndocumented." ) ) ); ?></h2>
			<p>Not anonymous stars. Original recommendation letters from people who were there for the work.</p>
		</header>
		<div class="dkxday1-letter-grid">
			<article style="--signal:#40b8ff"><span>BIG CONCERTS / TPW</span><blockquote><?php echo esc_html( dkxv4_page_meta( 'work_quote_one', '“Committed, passionate and dedicated to his craft.”' ) ); ?></blockquote><p>Dionne Domyan-Mudie · National Publicist, Big Concerts / Owner, The Publicity Workshop</p><a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/recommendations/publicity-workshop-big-concerts-recommendation.pdf' ); ?>" target="_blank" rel="noopener">View original letter <b>↗</b></a></article>
			<article style="--signal:#976dff"><span>ONE-EYED JACK</span><blockquote><?php echo esc_html( dkxv4_page_meta( 'work_quote_two', '“I highly recommend associating any brand with DK Expressions.”' ) ); ?></blockquote><p>Mike Pocock · PR Manager, One-Eyed Jack</p><a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/recommendations/one-eyed-jack-recommendation.pdf' ); ?>" target="_blank" rel="noopener">View original letter <b>↗</b></a></article>
		</div>
	</section>

	<section class="dkxday1-final">
		<p class="dkxday1-kicker"><span>03</span> / The next chapter</p>
		<h2><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'work_day1_final', "Seen enough?\nLet’s make the next chapter." ) ) ); ?></h2>
		<div class="dkxday1-actions"><a class="is-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Project <span>↗</span></a><a href="<?php echo esc_url( $rate_card_url ); ?>" download="DK-Expressions-2026-Rate-Card.pdf">Download 2026 Rate Card <span>↓</span></a></div>
	</section>
</main>
