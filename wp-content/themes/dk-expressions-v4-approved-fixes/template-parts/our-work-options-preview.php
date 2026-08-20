<?php
/**
 * Media-led Our Work comparison experiences.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$work_variants = array(
	'editorial' => 'Editorial Pulse',
	'field'     => 'Field Notes',
	'archive'   => 'Living Archive',
);
$work_variant_name = $work_variants[ $dkxv4_work_preview ] ?? $work_variants['editorial'];
$work_asset_url = static function ( $filename ) {
	return get_stylesheet_directory_uri() . '/assets/our-work-preview/' . $filename;
};
$preview_videos = array();
foreach ( dkxv4_get_work_media() as $preview_media_item ) {
	if ( 0 === strpos( (string) get_post_mime_type( $preview_media_item ), 'video/' ) ) {
		$preview_videos[] = $preview_media_item;
	}
}
$preview_videos = array_slice( $preview_videos, 0, 2 );
$hero_images = array(
	'editorial' => array( 'jamiroquai.jpg', 'Jamiroquai photographed live by DK Expressions' ),
	'field'     => array( 'jameson-vic-falls.jpg', 'Festival travellers arriving at the Jameson Vic Falls Carnival' ),
	'archive'   => array( 'ultra-sa-2023.jpg', 'Ultra South Africa photographed by DK Expressions' ),
);
$hero_image = $hero_images[ $dkxv4_work_preview ] ?? $hero_images['editorial'];

$latest_stories = array(
	array( '01', 'Live Music', 'Jamiroquai: the room turns electric', 'A frame from the stage, held at the exact second performance becomes memory.', 'jamiroquai.jpg', 'Jamiroquai performing live' ),
	array( '02', 'Festival Field Notes', 'Ultra South Africa: scale, smoke and electricity', 'Inside the crowd, behind the lens and close enough to feel the production move.', 'ultra-sa-2023.jpg', 'Ultra South Africa main stage' ),
	array( '03', 'Interview', 'In the room with Timmy Trumpet', 'The conversations, characters and unexpected moments that happen away from the stage.', 'timmy-trumpet-interview.jpg', 'DK Expressions with Timmy Trumpet after an interview' ),
	array( '04', 'Performance', 'When theatre transforms the room', 'Performance, design and human detail from the productions that deserve to be remembered.', 'alice-in-wonderland.jpg', 'Alice in Wonderland stage production' ),
);

$archive_frames = array(
	array( 'Collective Soul', 'Live Music', 'collective-soul.jpg', 'Collective Soul performing live' ),
	array( 'Lifehouse', 'From the Pit', 'lifehouse.jpg', 'Lifehouse guitarist performing live' ),
	array( 'Foo Fighters', 'International Stage', 'foo-fighters.jpg', 'Dave Grohl of Foo Fighters performing live' ),
	array( 'Katy Perry', 'Arena Production', 'katy-perry.jpg', 'Katy Perry arena production' ),
	array( 'Delicious 2013', 'Festival History', 'delicious-2013.jpg', 'The first Delicious International Food and Music Festival in 2013' ),
	array( 'Jameson Vic Falls', 'Culture in Motion', 'jameson-vic-falls.jpg', 'Festival travellers at the Jameson Vic Falls Carnival' ),
	array( 'Priscilla', 'Backstage & Theatre', 'priscilla-queen-of-the-desert.jpg', 'Priscilla Queen of the Desert stage production' ),
	array( 'Dash Berlin', 'Night Culture', 'dash-berlin.jpg', 'Dash Berlin performing live' ),
);

$preview_urls = array();
foreach ( $work_variants as $variant_key => $variant_label ) {
	$preview_urls[ $variant_key ] = add_query_arg(
		array(
			'dk-work-preview' => $variant_key,
			'dk-refresh'      => '1223',
		),
		home_url( '/our-work/' )
	);
}
?>

<main class="dkxmw dkxmw--<?php echo esc_attr( $dkxv4_work_preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxmw-grid" aria-hidden="true"></div>

	<section class="dkxmw-hero" aria-labelledby="dkxmw-title">
		<div class="dkxmw-hero-media">
			<img src="<?php echo esc_url( $work_asset_url( $hero_image[0] ) ); ?>" alt="<?php echo esc_attr( $hero_image[1] ); ?>" fetchpriority="high">
			<span>DK EXPRESSIONS / IN THE FIELD</span>
		</div>
		<div class="dkxmw-hero-copy">
			<p class="dkxmw-eyebrow"><span>03</span> / Media Door</p>
			<h1 id="dkxmw-title">Stories from the rooms <em>we have been in.</em></h1>
			<p class="dkxmw-lead">Culture, music, performance and the moments worth keeping.</p>
			<p class="dkxmw-intro">This is where we publish. Interviews, event stories, photo essays and the work that sits outside pure client commissions.</p>
			<div class="dkxmw-actions">
				<a class="is-primary" href="#latest-stories">Read the Stories <span>↓</span></a>
				<a href="#archive">Explore the Time Vault <span>→</span></a>
			</div>
		</div>
		<p class="dkxmw-hero-caption"><strong>Culture, documented.</strong><span>Johannesburg · South Africa · Beyond</span></p>
	</section>

	<section class="dkxmw-pillar-strip" aria-label="DK Expressions media content pillars">
		<p><span>01</span> Event &amp; festival stories</p>
		<p><span>02</span> Artist &amp; performer features</p>
		<p><span>03</span> Photo essays</p>
		<p><span>04</span> Culture &amp; lifestyle</p>
		<p><span>05</span> Industry notes</p>
	</section>

	<section class="dkxmw-section dkxmw-latest" id="latest-stories">
		<header class="dkxmw-section-head">
			<div><p class="dkxmw-eyebrow"><span>01</span> / Latest Stories</p><h2>Recent work<br><em>from the field.</em></h2></div>
			<p>Music, performance, culture and the human moments that exist between the official programme and the final applause.</p>
		</header>
		<div class="dkxmw-story-grid">
			<?php foreach ( $latest_stories as $story_index => $story ) : ?>
			<article class="dkxmw-story <?php echo 0 === $story_index ? 'is-lead' : ''; ?>">
				<figure><img src="<?php echo esc_url( $work_asset_url( $story[4] ) ); ?>" alt="<?php echo esc_attr( $story[5] ); ?>" loading="lazy"><span><?php echo esc_html( $story[0] ); ?></span></figure>
				<div><p><?php echo esc_html( $story[1] ); ?></p><h3><?php echo esc_html( $story[2] ); ?></h3><span><?php echo esc_html( $story[3] ); ?></span><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Explore the story <b>→</b></a></div>
			</article>
			<?php endforeach; ?>
		</div>
		<div class="dkxmw-soft-link"><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">View all published stories <span>→</span></a></div>
	</section>

	<section class="dkxmw-section dkxmw-motion" id="motion-stories">
		<header class="dkxmw-section-head">
			<div><p class="dkxmw-eyebrow"><span>02</span> / Motion Stories</p><h2>Press play on<br><em>the memory.</em></h2></div>
			<p>Short films and field footage from the stages, artists and productions that moved through the DK Expressions universe.</p>
		</header>
		<div class="dkxmw-motion-grid">
			<?php foreach ( $preview_videos as $video_index => $preview_video ) : ?>
			<article>
				<div class="dkxmw-video"><video controls preload="metadata" playsinline><source src="<?php echo esc_url( wp_get_attachment_url( $preview_video->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $preview_video ) ); ?>"></video><span><?php echo esc_html( str_pad( (string) ( $video_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?> / <?php echo 0 === $video_index ? 'LIVE ARCHIVE' : 'FIELD FILM'; ?></span></div>
				<p><strong><?php echo esc_html( get_the_title( $preview_video ) ); ?></strong><span><?php echo 0 === $video_index ? 'International performance, captured in motion.' : 'A moving chapter from the DK Expressions archive.'; ?></span></p>
			</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dkxmw-section dkxmw-archive" id="archive">
		<header class="dkxmw-section-head">
			<div><p class="dkxmw-eyebrow"><span>03</span> / From the Archive</p><h2>Frames that<br><em>still matter.</em></h2></div>
			<p>Selected essays and photographs from more than a decade spent inside music, performance, nightlife and culture.</p>
		</header>
		<div class="dkxmw-archive-grid">
			<?php foreach ( $archive_frames as $frame_index => $frame ) : ?>
			<figure class="dkxmw-frame">
				<img src="<?php echo esc_url( $work_asset_url( $frame[2] ) ); ?>" alt="<?php echo esc_attr( $frame[3] ); ?>" loading="lazy">
				<figcaption><span><?php echo esc_html( str_pad( (string) ( $frame_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?> / <?php echo esc_html( $frame[1] ); ?></span><strong><?php echo esc_html( $frame[0] ); ?></strong></figcaption>
			</figure>
			<?php endforeach; ?>
		</div>
		<div class="dkxmw-soft-link"><a href="#top">Return to the beginning <span>↑</span></a></div>
	</section>

	<section class="dkxmw-section dkxmw-mentions" id="recommendations">
		<header class="dkxmw-section-head">
			<div><p class="dkxmw-eyebrow"><span>04</span> / Recommendations &amp; Mentions</p><h2>Where the work<br><em>was recognised.</em></h2></div>
			<p>Original recommendations from the people and organisations who trusted DK Expressions inside the room.</p>
		</header>
		<div class="dkxmw-mention-grid">
			<blockquote class="is-blue"><p>“Committed, passionate and dedicated to his craft.”</p><footer><strong>Big Concerts</strong><span>The Publicity Workshop</span></footer></blockquote>
			<blockquote class="is-gold"><p>“I highly recommend associating any brand with DK Expressions.”</p><footer><strong>One-Eyed Jack</strong><span>Original recommendation</span></footer></blockquote>
			<blockquote class="is-purple"><p>“The photography and other social media services had been outstanding.”</p><footer><strong>VWV Massive</strong><span>Original recommendation</span></footer></blockquote>
		</div>
		<div class="dkxmw-soft-link"><a href="<?php echo esc_url( home_url( '/our-work/#recommendations' ) ); ?>">View the original recommendations <span>↗</span></a></div>
	</section>

	<section class="dkxmw-final">
		<div><p class="dkxmw-eyebrow">Keep Travelling</p><h2>Follow the work.<br><em>Enter the archive.</em></h2></div>
		<div><p>New stories, recovered frames and work from the field—published without turning the Media door into a sales page.</p><div class="dkxmw-actions"><a class="is-primary" href="#archive">Explore the Time Vault <span>↑</span></a><a href="https://www.instagram.com/dkexpressions/" target="_blank" rel="noopener">Follow the work <span>↗</span></a><a class="is-commercial" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Commercial enquiries <span>→</span></a></div></div>
	</section>

	<nav class="dkxmw-switcher" aria-label="Our Work page design options">
		<p><span>Our Work Preview</span><?php echo esc_html( $work_variant_name ); ?></p>
		<div><?php foreach ( $work_variants as $variant_key => $variant_label ) : ?><a class="<?php echo $variant_key === $dkxv4_work_preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( $preview_urls[ $variant_key ] ); ?>"><span><?php echo esc_html( chr( 65 + array_search( $variant_key, array_keys( $work_variants ), true ) ) ); ?></span><?php echo esc_html( $variant_label ); ?></a><?php endforeach; ?></div>
	</nav>
</main>
