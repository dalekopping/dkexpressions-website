<?php
/**
 * Template Name: DK Expressions Home — Conversion Experience
 * Restored v1.20.3 Home with v1.20.4 loader compatibility.
 */
get_header();

$clients_post_type = dkxv4_clients_post_type();
$clients = $clients_post_type ? get_posts( array(
	'post_type'      => $clients_post_type,
	'post_status'    => 'publish',
	'posts_per_page' => 40,
	'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
) ) : array();

$metrics = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$metrics[] = array( dkxv4_content( "metric_{$i}_value" ), dkxv4_content( "metric_{$i}_label" ) );
}

$work_media = array_slice( dkxv4_get_work_media(), 0, 3 );
$work_fallbacks = array(
	array( 'Live Events', 'Moments that only happen once.', 'Concerts, festivals and cultural experiences captured while the energy is still alive.' ),
	array( 'Brand Stories', 'Campaigns built to keep moving.', 'Original photography, film, editorial and social content designed around an outcome.' ),
	array( 'The Time Vault', 'Proof, not promises.', 'A growing archive of the stages, people, productions and brands we have travelled with.' ),
);
?>

<main class="dkx1200-home" id="top">
	<section class="dkxv4-booking dkxv4-booking-home dk-no-semantic-highlight" aria-labelledby="dkxv4-home-booking-title">
		<div class="dkxv4-booking-grid" aria-hidden="true"></div>
		<div class="dkxv4-booking-orbit" aria-hidden="true"><span></span><span></span><span></span></div>
		<div class="dkxv4-booking-shell">
			<p class="dkxv4-booking-availability"><strong>DK Expressions</strong><i aria-hidden="true"></i><b>Currently booking Q3 &amp; Q4</b></p>
			<h1 id="dkxv4-home-booking-title">We help brands <em>dominate attention.</em></h1>
			<p class="dkxv4-booking-intro"><strong>Premium culture, content and brand storytelling.</strong></p>
			<p class="dkxv4-booking-pricing">Packages start from <strong class="is-start">R6,000</strong>. Full production from <strong class="is-production">R32,000</strong>.</p>
			<div class="dkxv4-booking-actions">
				<a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><strong>Start a Project</strong><span>↗</span></a>
				<a class="is-secondary" href="<?php echo esc_url( home_url( '/solutions/#packages' ) ); ?>"><strong>See Packages</strong><span>→</span></a>
			</div>
			<p class="dkxv4-booking-slots"><i aria-hidden="true"></i><strong>Only <span>5</span> retainer slots left for September–October</strong></p>
			<p class="dkxv4-booking-trust"><strong>Trusted by Big Concerts, Comic Con Africa, Showtime Management</strong></p>
		</div>
	</section>

	<section class="dkx1200-stats dk-no-semantic-highlight" aria-label="DK Expressions in numbers">
		<?php foreach ( $metrics as $metric ) : ?><article><strong><?php echo esc_html( $metric[0] ); ?></strong><span><?php echo esc_html( $metric[1] ); ?></span></article><?php endforeach; ?>
	</section>

	<?php if ( $clients ) : ?>
	<section class="dkx1200-trust" aria-label="Selected clients and partners">
		<div class="dkx1200-trust-label"><i></i>TRUSTED BY</div>
		<div class="dkx1200-trust-window"><div class="dkx1200-trust-track">
			<?php for ( $loop = 0; $loop < 2; $loop++ ) : foreach ( $clients as $client ) : if ( has_post_thumbnail( $client ) ) : ?>
				<span title="<?php echo esc_attr( get_the_title( $client ) ); ?>"><?php echo get_the_post_thumbnail( $client, 'medium', array( 'loading' => 'lazy', 'alt' => get_the_title( $client ) ) ); ?></span>
			<?php endif; endforeach; endfor; ?>
		</div></div>
	</section>
	<?php endif; ?>

	<section class="dkx1203-section dkx1203-proof" id="selected-work">
		<header class="dkx1203-section-head"><p class="dkx1203-eyebrow">Selected Work</p><h2>Proof lives in<br>the experience.</h2><p>Real work. Real audiences. Stories created before, during and after the moment.</p></header>
		<div class="dkx1203-proof-grid">
			<?php for ( $i = 0; $i < 3; $i++ ) : $media = $work_media[ $i ] ?? null; $fallback = $work_fallbacks[ $i ]; ?>
			<article class="dkx1203-proof-card">
				<div class="dkx1203-proof-media">
					<?php if ( $media && 0 === strpos( (string) get_post_mime_type( $media ), 'video/' ) ) : ?><video controls preload="metadata" playsinline><source src="<?php echo esc_url( wp_get_attachment_url( $media->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $media ) ); ?>"></video><?php else : ?><div class="dkx1203-proof-placeholder"><span><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span></div><?php endif; ?>
				</div>
				<div class="dkx1203-proof-body"><p class="dkx1203-proof-meta"><?php echo esc_html( $fallback[0] ); ?></p><h3><?php echo esc_html( $media ? get_the_title( $media ) : $fallback[1] ); ?></h3><p><?php echo esc_html( $fallback[2] ); ?></p></div>
			</article>
			<?php endfor; ?>
		</div>
		<div class="dkx1203-actions"><a class="dkx1203-btn is-primary" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Enter the Time Vault ↗</a></div>
	</section>

	<section class="dkx1203-section dkx1203-process" id="how-we-work">
		<header class="dkx1203-section-head"><p class="dkx1203-eyebrow">How We Work</p><h2>One connected<br>creative system.</h2><p>Strategy and storytelling travel together. Every stage is built around the objective, the audience and what needs to happen next.</p></header>
		<div class="dkx1203-process-grid">
			<article><span>01 / DISCOVER</span><h3>Find the signal.</h3><p>We define the objective, audience, opportunity and the story worth telling.</p></article>
			<article><span>02 / DESIGN</span><h3>Build the journey.</h3><p>We shape the concept, campaign, content plan and conversion path.</p></article>
			<article><span>03 / CREATE</span><h3>Capture the moment.</h3><p>Photography, film, editorial and digital assets are produced as one system.</p></article>
			<article><span>04 / AMPLIFY</span><h3>Keep it moving.</h3><p>Publishing, social distribution and reporting extend the impact beyond launch day.</p></article>
		</div>
		<p class="dkx1203-process-note">ONE BRIEF · ONE CONNECTED TEAM · ONE MEASURABLE OUTCOME</p>
	</section>

	<section class="dkx1203-section dkx1203-pricing" id="pricing">
		<header class="dkx1203-section-head"><p class="dkx1203-eyebrow">Start Here</p><h2>Choose the level<br>of attention.</h2><p>Clear starting points for media exposure, event domination and ongoing brand growth.</p></header>
		<div class="dkx1203-pricing-grid">
			<article class="is-media"><p class="dkx1203-pricing-label">Media / Campaign</p><h3>Spotlight</h3><p class="dkx1203-pricing-price">R6,000 <span>/ campaign</span></p><ul><li>8 editorial listings</li><li>Social amplification on each</li><li>Instagram, Facebook and X coverage</li><li>Campaign-window placement</li></ul><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Choose Spotlight ↗</a></article>
			<article class="is-events is-featured"><b class="dkx1203-pricing-badge">Most chosen</b><p class="dkx1203-pricing-label">Event Domination</p><h3>Signature</h3><p class="dkx1203-pricing-price">R32,000 <span>/ event</span></p><ul><li>Up to 8 hours coverage</li><li>Photography and video</li><li>Live event posting</li><li>Same-day teaser and recap</li></ul><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Choose Signature ↗</a></article>
			<article class="is-brands"><p class="dkx1203-pricing-label">Always On</p><h3>Premium</h3><p class="dkx1203-pricing-price">R35,000 <span>/ month</span></p><ul><li>Two shoots per month</li><li>20 posts and 8 reels</li><li>Full social management</li><li>Strategy, creative and reporting</li></ul><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Choose Premium ↗</a></article>
		</div>
		<p class="dkx1203-pricing-note">Need a different scale? <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View the complete 2026 rate card →</a></p>
	</section>

	<section class="dkx1203-section dkx1203-testimonials" id="testimonials">
		<header class="dkx1203-section-head"><p class="dkx1203-eyebrow">Don’t Take Our Word For It</p><h2>Reputation,<br>documented.</h2><p>Original recommendations from people and organisations DK Expressions has worked alongside.</p></header>
		<div class="dkx1203-testimonials-grid">
			<blockquote><p>“Committed, passionate and dedicated to his craft.”</p><footer><strong>Dionne Domyan-Mudie</strong><span>National Publicist, Big Concerts · The Publicity Workshop</span></footer></blockquote>
			<blockquote><p>“I highly recommend associating any brand with DK Expressions.”</p><footer><strong>Mike Pocock</strong><span>PR Manager, One-Eyed Jack</span></footer></blockquote>
			<blockquote><p>“The photography and other Social Media Services had been outstanding.”</p><footer><strong>Lloyd Cornwall</strong><span>Director, VWV Massive</span><span class="dkx1203-delicious">Delicious International Food & Music Festival</span></footer></blockquote>
		</div>
		<div class="dkx1203-actions dkx1203-testimonial-link"><a href="<?php echo esc_url( home_url( '/our-work/#recommendations' ) ); ?>">View the original recommendations ↗</a></div>
	</section>

	<section class="dkx1200-section dkx1200-pathways" id="three-doors">
		<header class="dkx1200-section-head"><div><p class="dkx1200-eyebrow">Choose Your Experience</p><h2>Three doors.<br><em>One DK universe.</em></h2></div><p>Enter through the pathway that matches what you need today. Every door is powered by the same creativity, credibility and execution.</p></header>
		<div class="dkx1200-pathway-grid">
			<a class="agency" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><span>01 / AGENCY</span><h3>Build a brand people remember.</h3><p>Strategy, campaigns, photography, film, SEO and digital experiences engineered for growth.</p><b>Explore Solutions →</b></a>
			<a class="media" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><span>02 / MEDIA</span><h3>Discover culture as it happens.</h3><p>Entertainment news, interviews, reviews, events and the stories shaping South Africa.</p><b>Enter Insights →</b></a>
			<a class="archive" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>"><span>03 / TIME VAULT</span><h3>See where we have travelled.</h3><p>Photography, motion, recommendations and moments frozen across more than a decade.</p><b>Open Our Work →</b></a>
		</div>
	</section>

	<section class="dkx1203-final">
		<div class="dkx1203-final-inner"><p class="dkx1203-eyebrow">Your Next Chapter</p><h2><?php echo wp_kses_post( dkxv4_multiline_heading( dkxv4_page_meta( 'home_final_heading', "Make something\npeople cannot ignore." ) ) ); ?></h2><p><?php echo esc_html( dkxv4_page_meta( 'home_final_copy', 'Tell us what you are launching, promoting or transforming. We will build the right combination of story, strategy and execution.' ) ); ?></p><div class="dkx1203-actions"><a class="dkx1203-btn is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project ↗</a><a class="dkx1203-btn" href="https://wa.me/27722460451" target="_blank" rel="noopener">WhatsApp us →</a></div><p class="dkx1203-location">JOHANNESBURG · SOUTH AFRICA · WORLDWIDE</p></div>
	</section>
</main>
<?php get_footer(); ?>
