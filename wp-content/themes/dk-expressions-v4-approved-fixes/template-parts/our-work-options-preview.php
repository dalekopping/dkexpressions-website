<?php
/**
 * Three radically different Media Door / Our Work preview experiences.
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
			'dk-refresh'      => '1226',
		),
		home_url( '/our-work/' )
	);
}
?>

<main class="dkxmw dkxmw--<?php echo esc_attr( $dkxv4_work_preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxmw-atmosphere" aria-hidden="true"></div>

	<?php if ( 'editorial' === $dkxv4_work_preview ) : ?>
		<section class="dkxmw-ed-cover" aria-labelledby="dkxmw-ed-title">
			<div class="dkxmw-ed-spine" aria-hidden="true"><span>ISSUE 013</span><b>DK / MEDIA</b><i>2026</i></div>
			<figure class="dkxmw-ed-cover-image">
				<img src="<?php echo esc_url( $work_asset_url( 'jamiroquai.jpg' ) ); ?>" alt="Jamiroquai photographed live by DK Expressions" fetchpriority="high">
				<figcaption>DK EXPRESSIONS / INSIDE THE ROOM</figcaption>
			</figure>
			<div class="dkxmw-ed-cover-copy">
				<p class="dkxmw-kicker">Editorial Pulse <span>● Live</span></p>
				<h1 id="dkxmw-ed-title">Culture<br>does not<br><em>stand still.</em></h1>
				<p class="dkxmw-deck">Stories from the rooms we have been in—music, performance and the moments worth keeping.</p>
				<div class="dkxmw-actions"><a class="is-primary" href="#latest-stories">Open the issue <span>↓</span></a><a href="#archive">Browse the contact sheet <span>→</span></a></div>
			</div>
			<div class="dkxmw-ed-ticker" aria-label="Media content pillars"><span>Event stories</span><span>Artist features</span><span>Photo essays</span><span>Culture</span><span>Industry notes</span></div>
		</section>

		<section class="dkxmw-ed-newsroom" id="latest-stories">
			<header class="dkxmw-ed-section-title"><p>01 / The Front Page</p><h2>Four dispatches.<br><em>One living culture.</em></h2><span>Recent work from the field.</span></header>
			<article class="dkxmw-ed-lead-story">
				<figure><img src="<?php echo esc_url( $work_asset_url( $latest_stories[0][4] ) ); ?>" alt="<?php echo esc_attr( $latest_stories[0][5] ); ?>" loading="lazy"></figure>
				<div><p><span>01</span> <?php echo esc_html( $latest_stories[0][1] ); ?></p><h3><?php echo esc_html( $latest_stories[0][2] ); ?></h3><strong><?php echo esc_html( $latest_stories[0][3] ); ?></strong><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Read the dispatch ↗</a></div>
			</article>
			<div class="dkxmw-ed-dispatches">
				<?php foreach ( array_slice( $latest_stories, 1 ) as $story ) : ?>
				<article><span><?php echo esc_html( $story[0] ); ?></span><div><p><?php echo esc_html( $story[1] ); ?></p><h3><?php echo esc_html( $story[2] ); ?></h3><strong><?php echo esc_html( $story[3] ); ?></strong></div><figure><img src="<?php echo esc_url( $work_asset_url( $story[4] ) ); ?>" alt="<?php echo esc_attr( $story[5] ); ?>" loading="lazy"></figure><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" aria-label="Explore <?php echo esc_attr( $story[2] ); ?>">→</a></article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-ed-screening" id="motion-stories">
			<header><p>02 / Motion Desk</p><h2>Stories that<br><em>refuse to freeze.</em></h2></header>
			<div class="dkxmw-ed-screens">
				<?php foreach ( $preview_videos as $video_index => $preview_video ) : ?>
				<article><span>PLAY / 0<?php echo esc_html( (string) ( $video_index + 1 ) ); ?></span><video controls preload="metadata" playsinline><source src="<?php echo esc_url( wp_get_attachment_url( $preview_video->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $preview_video ) ); ?>"></video><p><?php echo esc_html( get_the_title( $preview_video ) ); ?></p></article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-ed-contact" id="archive">
			<header><p>03 / Contact Sheet</p><h2>The archive,<br><em>still developing.</em></h2><span>Thirteen years. Thousands of moments. No stock. No mock-ups.</span></header>
			<div class="dkxmw-ed-contact-grid">
				<?php foreach ( $archive_frames as $frame_index => $frame ) : ?>
				<figure><img src="<?php echo esc_url( $work_asset_url( $frame[2] ) ); ?>" alt="<?php echo esc_attr( $frame[3] ); ?>" loading="lazy"><figcaption><span><?php echo esc_html( str_pad( (string) ( $frame_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><strong><?php echo esc_html( $frame[0] ); ?></strong><i><?php echo esc_html( $frame[1] ); ?></i></figcaption></figure>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-ed-proof" id="recommendations">
			<p class="dkxmw-proof-label">04 / Reputation, documented</p>
			<div><blockquote><p>“Committed, passionate and dedicated to his craft.”</p><footer>Big Concerts <span>/ TPW</span></footer></blockquote><blockquote><p>“I highly recommend associating any brand with DK Expressions.”</p><footer>One-Eyed Jack</footer></blockquote><blockquote><p>“The photography and social media services had been outstanding.”</p><footer>VWV Massive</footer></blockquote></div>
		</section>

		<section class="dkxmw-ed-final"><p>THE NEXT STORY IS WAITING</p><h2>Follow the work.<br><em>Enter the archive.</em></h2><div class="dkxmw-actions"><a class="is-primary" href="#archive">Explore the Time Vault ↑</a><a href="https://www.instagram.com/dkexpressions/" target="_blank" rel="noopener">Follow the work ↗</a></div></section>

	<?php elseif ( 'field' === $dkxv4_work_preview ) : ?>
		<section class="dkxmw-fd-hero" aria-labelledby="dkxmw-fd-title">
			<div class="dkxmw-fd-map" aria-hidden="true"><span>26.2041° S</span><span>28.0473° E</span><i></i><b>FIELD FILE 013</b></div>
			<figure class="dkxmw-fd-photo"><img src="<?php echo esc_url( $work_asset_url( 'jameson-vic-falls.jpg' ) ); ?>" alt="Festival travellers arriving at the Jameson Vic Falls Carnival" fetchpriority="high"><figcaption>Somewhere between departure and the first song.</figcaption></figure>
			<div class="dkxmw-fd-logbook">
				<p class="dkxmw-kicker">Field Notes / South Africa &amp; beyond</p>
				<h1 id="dkxmw-fd-title">We went<br>where the<br><em>story lived.</em></h1>
				<p class="dkxmw-deck">A documentary trail through culture, music, performance and the human moments outside the official programme.</p>
				<div class="dkxmw-actions"><a class="is-primary" href="#field-trail">Follow the trail <span>↓</span></a><a href="#field-prints">Open the field case <span>→</span></a></div>
			</div>
			<div class="dkxmw-fd-stamps" aria-label="Media content pillars"><span>EVENTS</span><span>ARTISTS</span><span>PHOTO ESSAYS</span><span>CULTURE</span><span>NOTES</span></div>
		</section>

		<section class="dkxmw-fd-trail" id="field-trail">
			<header><p>01 / The route taken</p><h2>Four stops.<br><em>No velvet rope.</em></h2><span>Recent work from the rooms, roads and stages we entered.</span></header>
			<div class="dkxmw-fd-route" aria-hidden="true"><i></i><b>START</b><b>STAGE</b><b>BACKSTAGE</b><b>CURTAIN</b></div>
			<div class="dkxmw-fd-stories">
				<?php foreach ( $latest_stories as $story_index => $story ) : ?>
				<article><figure><img src="<?php echo esc_url( $work_asset_url( $story[4] ) ); ?>" alt="<?php echo esc_attr( $story[5] ); ?>" loading="lazy"><span>FRAME <?php echo esc_html( $story[0] ); ?></span></figure><div><p><?php echo esc_html( $story[1] ); ?></p><h3><?php echo esc_html( $story[2] ); ?></h3><strong><?php echo esc_html( $story[3] ); ?></strong><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Read the field note →</a></div></article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-fd-cinema" id="motion-stories">
			<div class="dkxmw-fd-cinema-title"><p>02 / Moving evidence</p><h2>Press play<br>on the <em>memory.</em></h2><span>Footage carried home from the field.</span></div>
			<div class="dkxmw-fd-cinema-reel">
				<?php foreach ( $preview_videos as $video_index => $preview_video ) : ?>
				<article><div><video controls preload="metadata" playsinline><source src="<?php echo esc_url( wp_get_attachment_url( $preview_video->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $preview_video ) ); ?>"></video></div><p><span>ROLL 0<?php echo esc_html( (string) ( $video_index + 1 ) ); ?></span><?php echo esc_html( get_the_title( $preview_video ) ); ?></p></article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-fd-prints" id="field-prints">
			<header><p>03 / Recovered field prints</p><h2>A wall of<br><em>places we stood.</em></h2></header>
			<div>
				<?php foreach ( $archive_frames as $frame_index => $frame ) : ?>
				<figure><img src="<?php echo esc_url( $work_asset_url( $frame[2] ) ); ?>" alt="<?php echo esc_attr( $frame[3] ); ?>" loading="lazy"><figcaption><b><?php echo esc_html( $frame[0] ); ?></b><span><?php echo esc_html( $frame[1] ); ?> / <?php echo esc_html( (string) ( 2013 + $frame_index ) ); ?></span></figcaption></figure>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-fd-proof" id="recommendations">
			<header><p>04 / Notes left by others</p><h2>The names in<br><em>the margins.</em></h2></header>
			<div><blockquote><span>01</span><p>“Committed, passionate and dedicated to his craft.”</p><footer>Big Concerts / TPW</footer></blockquote><blockquote><span>02</span><p>“I highly recommend associating any brand with DK Expressions.”</p><footer>One-Eyed Jack</footer></blockquote><blockquote><span>03</span><p>“The photography and social media services had been outstanding.”</p><footer>VWV Massive</footer></blockquote></div>
		</section>

		<section class="dkxmw-fd-final"><span>FIELD CLEARANCE / GRANTED</span><h2>Keep moving.<br><em>Keep looking.</em></h2><p>New stories, recovered frames and work from the field.</p><div class="dkxmw-actions"><a class="is-primary" href="#field-prints">Explore the Time Vault ↑</a><a href="https://www.instagram.com/dkexpressions/" target="_blank" rel="noopener">Follow the work ↗</a></div></section>

	<?php else : ?>
		<section class="dkxmw-va-hero" aria-labelledby="dkxmw-va-title">
			<div class="dkxmw-va-orbit" aria-hidden="true"><i></i><i></i><i></i><span>2013</span><span>NOW</span></div>
			<div class="dkxmw-va-shards" aria-hidden="true"><figure><img src="<?php echo esc_url( $work_asset_url( 'ultra-sa-2023.jpg' ) ); ?>" alt=""></figure><figure><img src="<?php echo esc_url( $work_asset_url( 'katy-perry.jpg' ) ); ?>" alt=""></figure><figure><img src="<?php echo esc_url( $work_asset_url( 'collective-soul.jpg' ) ); ?>" alt=""></figure></div>
			<div class="dkxmw-va-core">
				<p class="dkxmw-kicker">Living Archive / Time engine online</p>
				<h1 id="dkxmw-va-title">Every frame<br>is a <em>portal.</em></h1>
				<p class="dkxmw-deck">Thirteen years of culture, performance and motion—stored as living proof that we were there.</p>
				<div class="dkxmw-actions"><a class="is-primary" href="#memory-stream">Enter the memory stream <span>↓</span></a><a href="#vault">Open the vault <span>→</span></a></div>
			</div>
			<p class="dkxmw-va-status"><span></span> ARCHIVE SIGNAL / STABLE <b>6.13M HITS</b></p>
		</section>

		<section class="dkxmw-va-stream" id="memory-stream">
			<header><p>01 / Memory stream</p><h2>Drag through<br><em>documented time.</em></h2><span>Each chapter is a doorway into a room we once occupied. Scroll sideways to travel.</span></header>
			<div class="dkxmw-va-chapters">
				<?php foreach ( $latest_stories as $story ) : ?>
				<article><span><?php echo esc_html( $story[0] ); ?></span><figure><img src="<?php echo esc_url( $work_asset_url( $story[4] ) ); ?>" alt="<?php echo esc_attr( $story[5] ); ?>" loading="lazy"></figure><div><p><?php echo esc_html( $story[1] ); ?></p><h3><?php echo esc_html( $story[2] ); ?></h3><strong><?php echo esc_html( $story[3] ); ?></strong><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Open this memory ↗</a></div></article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkxmw-va-projector" id="motion-stories">
			<header><p>02 / Projection chamber</p><h2>Memory<br><em>in motion.</em></h2></header>
			<div>
				<?php foreach ( $preview_videos as $video_index => $preview_video ) : ?>
				<article><span>TRANSMISSION 0<?php echo esc_html( (string) ( $video_index + 1 ) ); ?></span><video controls preload="metadata" playsinline><source src="<?php echo esc_url( wp_get_attachment_url( $preview_video->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $preview_video ) ); ?>"></video><p><?php echo esc_html( get_the_title( $preview_video ) ); ?></p></article>
				<?php endforeach; ?>
			</div>
		</section>

		<div class="dkxmw-va-field-merge">
			<section class="dkxmw-fd-prints" id="vault">
				<header><p>03 / Recovered field prints</p><h2>A wall of<br><em>places we stood.</em></h2></header>
				<div>
					<?php foreach ( $archive_frames as $frame_index => $frame ) : ?>
					<figure><img src="<?php echo esc_url( $work_asset_url( $frame[2] ) ); ?>" alt="<?php echo esc_attr( $frame[3] ); ?>" loading="lazy"><figcaption><b><?php echo esc_html( $frame[0] ); ?></b><span><?php echo esc_html( $frame[1] ); ?> / <?php echo esc_html( (string) ( 2013 + $frame_index ) ); ?></span></figcaption></figure>
					<?php endforeach; ?>
				</div>
			</section>

			<section class="dkxmw-fd-proof" id="recommendations">
				<header><p>04 / Notes left by others</p><h2>The names in<br><em>the margins.</em></h2></header>
				<div><blockquote><span>01</span><p>“Committed, passionate and dedicated to his craft.”</p><footer>Big Concerts / TPW</footer></blockquote><blockquote><span>02</span><p>“I highly recommend associating any brand with DK Expressions.”</p><footer>One-Eyed Jack</footer></blockquote><blockquote><span>03</span><p>“The photography and social media services had been outstanding.”</p><footer>VWV Massive</footer></blockquote></div>
			</section>

			<section class="dkxmw-fd-final"><span>FIELD CLEARANCE / GRANTED</span><h2>Keep moving.<br><em>Keep looking.</em></h2><p>New stories, recovered frames and work from the field.</p><div class="dkxmw-actions"><a class="is-primary" href="#vault">Explore the Time Vault ↑</a><a href="https://www.instagram.com/dkexpressions/" target="_blank" rel="noopener">Follow the work ↗</a></div></section>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $dkxv4_show_work_switcher ) ) : ?>
		<nav class="dkxmw-switcher" aria-label="Our Work page design options">
			<p><span>Three worlds / one DK universe</span><?php echo esc_html( $work_variant_name ); ?></p>
			<div><?php foreach ( $work_variants as $variant_key => $variant_label ) : ?><a class="<?php echo $variant_key === $dkxv4_work_preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( $preview_urls[ $variant_key ] ); ?>"><span><?php echo esc_html( chr( 65 + array_search( $variant_key, array_keys( $work_variants ), true ) ) ); ?></span><?php echo esc_html( $variant_label ); ?></a><?php endforeach; ?></div>
		</nav>
	<?php endif; ?>
</main>
