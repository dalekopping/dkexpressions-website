<?php
/**
 * Non-destructive homepage comparison experiences.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$variant_names = array(
	'cinematic' => 'Cinematic Conversion',
	'vault'     => 'Time Vault First',
	'editorial' => 'Editorial Command',
);
$variant_name = $variant_names[ $dkxv4_home_preview ] ?? $variant_names['cinematic'];
$work_items   = array_slice( dkxv4_get_work_media(), 0, 8 );
$work_labels  = array(
	array( 'Live Events', 'The moment before the lights change.' ),
	array( 'Culture', 'Stories captured inside the energy.' ),
	array( 'Brand', 'Campaign imagery built to travel.' ),
	array( 'Motion', 'Movement, atmosphere and human detail.' ),
	array( 'Hospitality', 'Experiences made impossible to overlook.' ),
	array( 'Portraiture', 'Presence, personality and point of view.' ),
	array( 'Real Estate', 'Spaces photographed with intention.' ),
	array( 'Time Vault', 'More than a decade, documented.' ),
);

/**
 * Render an image or video from the curated Time Vault.
 */
$render_work_media = static function ( $media, $index, $class_name = '' ) {
	if ( $media && wp_attachment_is_image( $media->ID ) ) {
		echo wp_get_attachment_image(
			$media->ID,
			'large',
			false,
			array(
				'class'   => $class_name,
				'loading' => 0 === $index ? 'eager' : 'lazy',
				'alt'     => get_the_title( $media ),
			)
		);
		return;
	}

	if ( $media && 0 === strpos( (string) get_post_mime_type( $media ), 'video/' ) ) {
		?>
		<video class="<?php echo esc_attr( $class_name ); ?>" controls preload="metadata" playsinline>
			<source src="<?php echo esc_url( wp_get_attachment_url( $media->ID ) ); ?>" type="<?php echo esc_attr( get_post_mime_type( $media ) ); ?>">
		</video>
		<?php
		return;
	}
	?>
	<div class="dkxhp-work-placeholder <?php echo esc_attr( $class_name ); ?>" aria-hidden="true">
		<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
		<i></i>
	</div>
	<?php
};

$preview_urls = array();
foreach ( $variant_names as $key => $name ) {
	$preview_urls[ $key ] = add_query_arg(
		array(
			'dk-home-preview' => $key,
			'dk-refresh'      => '1213',
		),
		home_url( '/home/' )
	);
}
?>

<main class="dkxhp dkxhp--<?php echo esc_attr( $dkxv4_home_preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxhp-atmosphere" aria-hidden="true"><i></i><i></i><i></i></div>

	<section class="dkxhp-hero" aria-labelledby="dkxhp-title">
		<div class="dkxhp-shell dkxhp-hero-grid">
			<div class="dkxhp-hero-copy">
				<p class="dkxhp-kicker"><span>DK Expressions</span><i></i>Photography · Motion · Strategy</p>
				<h1 id="dkxhp-title">We capture what others miss <em>and turn it into work that moves people and brands.</em></h1>
				<p class="dkxhp-lead">Photography. Motion. Strategy. For events, hospitality, real estate and executive brands that refuse to look ordinary.</p>
				<div class="dkxhp-actions">
					<a class="dkxhp-button is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a>
					<a class="dkxhp-button is-secondary" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">View the Time Vault <span>→</span></a>
				</div>
				<p class="dkxhp-meta"><b>13+ years</b><i></i><b>2,000+ projects</b><i></i><b>Johannesburg &amp; beyond</b></p>
			</div>
			<div class="dkxhp-hero-visual" aria-label="Selected DK Expressions work">
				<div class="dkxhp-hero-frame">
					<?php $render_work_media( $work_items[0] ?? null, 0, 'dkxhp-hero-media' ); ?>
					<span class="dkxhp-hero-index">01 / TIME VAULT</span>
				</div>
				<p>Documenting the people, places and moments that shaped the journey.</p>
			</div>
		</div>
	</section>

	<section class="dkxhp-proof" aria-label="DK Expressions proof">
		<div class="dkxhp-shell dkxhp-proof-grid">
			<p><strong class="is-blue">1.10M+</strong><span>visits</span></p>
			<p><strong class="is-gold">2.47M+</strong><span>pages viewed</span></p>
			<p><strong class="is-purple">6.13M+</strong><span>hits</span></p>
			<p class="dkxhp-proof-trust"><strong>Trusted by</strong><span>promoters, brands and artists since 2013</span></p>
		</div>
	</section>

	<section class="dkxhp-section dkxhp-doors" id="choose-your-path">
		<div class="dkxhp-shell">
			<header class="dkxhp-section-head">
				<p class="dkxhp-eyebrow">Three Doors</p>
				<h2>Choose <em>your path.</em></h2>
			</header>
			<div class="dkxhp-door-grid">
				<article class="dkxhp-door is-agency">
					<p class="dkxhp-door-number">01 <span>/ Agency</span></p>
					<h3>For brands and events that need more than content.</h3>
					<p>Strategy, photography, motion and ongoing partnership.</p>
					<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Enter Agency <span>→</span></a>
				</article>
				<article class="dkxhp-door is-media">
					<p class="dkxhp-door-number">02 <span>/ Media</span></p>
					<h3>Stories, culture and the work we publish.</h3>
					<p>Entertainment, people, experiences and the stories shaping South Africa.</p>
					<a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Enter Media <span>→</span></a>
				</article>
				<article class="dkxhp-door is-vault">
					<p class="dkxhp-door-number">03 <span>/ Time Vault</span></p>
					<h3>See where we have travelled.</h3>
					<p>Photography, motion and moments frozen across more than a decade.</p>
					<a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Enter the Vault <span>→</span></a>
				</article>
			</div>
		</div>
	</section>

	<section class="dkxhp-section dkxhp-work" id="selected-work">
		<div class="dkxhp-shell">
			<header class="dkxhp-section-head dkxhp-work-head">
				<div><p class="dkxhp-eyebrow">Selected Work</p><h2>From the <em>Time Vault.</em></h2></div>
				<p>Not stock. Not mock-ups. Not promises.</p>
			</header>
			<div class="dkxhp-work-grid">
				<?php for ( $i = 0; $i < 8; $i++ ) :
					$media      = $work_items[ $i ] ?? null;
					$fallback   = $work_labels[ $i ];
					$caption    = $media ? trim( (string) get_post_field( 'post_excerpt', $media->ID ) ) : '';
					$work_title = $media ? trim( (string) get_the_title( $media ) ) : '';
					$work_title = $caption ?: ( $work_title ?: $fallback[1] );
				?>
				<article class="dkxhp-work-card">
					<div class="dkxhp-work-media"><?php $render_work_media( $media, $i, 'dkxhp-work-asset' ); ?></div>
					<div class="dkxhp-work-caption"><span><?php echo esc_html( $fallback[0] ); ?></span><p><?php echo esc_html( $work_title ); ?></p></div>
				</article>
				<?php endfor; ?>
			</div>
			<p class="dkxhp-inline-link"><a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Open the full Time Vault <span>↗</span></a></p>
		</div>
	</section>

	<section class="dkxhp-section dkxhp-offers" id="core-offers">
		<div class="dkxhp-shell">
			<header class="dkxhp-section-head">
				<p class="dkxhp-eyebrow">Core Offers</p>
				<h2>How most clients <em>work with us.</em></h2>
			</header>
			<div class="dkxhp-offer-grid">
				<article class="dkxhp-offer is-signature">
					<p class="dkxhp-offer-label">Event Domination</p>
					<span class="dkxhp-badge">Most Chosen</span>
					<h3>Signature</h3>
					<p class="dkxhp-price"><strong>R32,000</strong><span>/ event</span></p>
					<ul><li>Up to 8 hours</li><li>Photography + video</li><li>Live posting</li><li>Next-day gallery</li></ul>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Choose Signature <span>↗</span></a>
				</article>
				<article class="dkxhp-offer is-retainer">
					<p class="dkxhp-offer-label">Brand Retainer</p>
					<span class="dkxhp-badge">Most Chosen</span>
					<h3>Core</h3>
					<p class="dkxhp-price"><strong>R35,000</strong><span>/ month</span></p>
					<ul><li>Ongoing content</li><li>Strategy</li><li>Priority access</li><li>Monthly reporting</li></ul>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Choose Core <span>↗</span></a>
				</article>
			</div>
			<p class="dkxhp-rate-note">All prices exclude VAT. 50% deposit. <a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View full 2026 Rate Card <span>→</span></a></p>
		</div>
	</section>

	<section class="dkxhp-section dkxhp-recommendations" id="recommendations">
		<div class="dkxhp-shell">
			<header class="dkxhp-section-head">
				<p class="dkxhp-eyebrow">Recommendations</p>
				<h2>What clients say <em>after the work is done.</em></h2>
			</header>
			<div class="dkxhp-quote-grid">
				<blockquote><span>“</span><p>Committed, passionate and dedicated to his craft.</p><footer>— Big Concerts</footer></blockquote>
				<blockquote><span>“</span><p>Professional, reliable and a pleasure to work with on every project.</p><footer>— One-Eyed Jack</footer></blockquote>
			</div>
			<p class="dkxhp-inline-link"><a href="<?php echo esc_url( home_url( '/our-work/#recommendations' ) ); ?>">See more recommendations <span>↗</span></a></p>
		</div>
	</section>

	<section class="dkxhp-final">
		<div class="dkxhp-shell dkxhp-final-grid">
			<div><p class="dkxhp-eyebrow">Final Conversion</p><h2>Ready <em>when you are.</em></h2></div>
			<div><p>Tell us about the project, the event, or the brand. We respond within one business day.</p><div class="dkxhp-actions"><a class="dkxhp-button is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a><a class="dkxhp-button is-secondary" href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">Download Rate Card <span>↓</span></a></div></div>
		</div>
	</section>

	<nav class="dkxhp-switcher" aria-label="Homepage design options">
		<p><span>Home Preview</span><?php echo esc_html( $variant_name ); ?></p>
		<div>
			<?php foreach ( $variant_names as $key => $name ) : ?>
			<a class="<?php echo $key === $dkxv4_home_preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( $preview_urls[ $key ] ); ?>"><span><?php echo esc_html( chr( 65 + array_search( $key, array_keys( $variant_names ), true ) ) ); ?></span><?php echo esc_html( $name ); ?></a>
			<?php endforeach; ?>
		</div>
	</nav>
</main>
