<?php
/**
 * Cinematic landing page shown at the root domain on every visit.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
$three_doors_preview = function_exists( 'dkxv4_is_three_doors_landing_preview' ) && dkxv4_is_three_doors_landing_preview();
$conversion_preview  = function_exists( 'dkxv4_is_conversion_landing_preview' ) && dkxv4_is_conversion_landing_preview();

$landing_metrics = array();
if ( $conversion_preview ) {
	for ( $metric_index = 1; $metric_index <= 6; $metric_index++ ) {
		$landing_metrics[] = array(
			dkxv4_content( "metric_{$metric_index}_value" ),
			dkxv4_content( "metric_{$metric_index}_label" ),
		);
	}
}
?>
<?php if ( $conversion_preview ) : ?>
<main class="dkxv4-conversion-landing" id="top">
	<section class="dkxv4-conversion-hero" aria-labelledby="dkxv4-conversion-title">
		<div class="dkxv4-conversion-grid" aria-hidden="true"></div>
		<div class="dkxv4-conversion-orbit" aria-hidden="true"><span></span><span></span><span></span></div>
		<div class="dkxv4-conversion-shell">
			<p class="dkxv4-conversion-availability"><strong>DK Expressions</strong><i aria-hidden="true"></i>Currently booking <b>Q3 &amp; Q4</b></p>
			<h1 id="dkxv4-conversion-title">We help brands<br><em>dominate attention.</em></h1>
			<p class="dkxv4-conversion-intro">Premium culture, content and brand storytelling.</p>
			<p class="dkxv4-conversion-pricing">Packages start from <strong class="is-start">R6,000</strong>. Full production from <strong class="is-production">R32,000</strong>.</p>
			<div class="dkxv4-conversion-actions">
				<a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a>
				<a class="is-secondary" href="<?php echo esc_url( home_url( '/solutions/#packages' ) ); ?>">See Packages <span>→</span></a>
			</div>
			<p class="dkxv4-conversion-slots"><i aria-hidden="true"></i><strong>Only 5</strong> retainer slots left for <b>September–October</b></p>
			<p class="dkxv4-conversion-trust"><span>Trusted by</span><strong>Big Concerts</strong><i>·</i><strong>Comic Con Africa</strong><i>·</i><strong>Showtime Management</strong></p>
		</div>
	</section>

	<section class="dkx1200-stats dkxv4-conversion-stats dk-no-semantic-highlight" aria-label="DK Expressions server statistics">
		<?php foreach ( $landing_metrics as $metric ) : ?>
			<article><strong><?php echo esc_html( $metric[0] ); ?></strong><span><?php echo esc_html( $metric[1] ); ?></span></article>
		<?php endforeach; ?>
	</section>
</main>
<?php else : ?>
<section class="dk-home-hero dk-landing" id="top">
	<div class="dk-stars" aria-hidden="true"></div>
	<div class="dk-city" aria-hidden="true"></div>
	<div class="dk-portal" aria-hidden="true"></div>
	<div class="dk-hero-copy">
		<p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_hero_kicker' ) ); ?></p>
		<h1><?php echo esc_html( dkxv4_content( 'home_hero_title_1' ) ); ?> <span><?php echo esc_html( dkxv4_content( 'home_hero_title_2' ) ); ?></span></h1>
		<p class="dk-tagline"><?php echo esc_html( dkxv4_registered_phrase( dkxv4_content( 'home_hero_tagline' ) ) ); ?></p>
		<?php if ( ! $three_doors_preview ) : ?>
		<div class="dk-landing-actions" aria-label="<?php esc_attr_e( 'Choose your DK Expressions experience', 'dk-expressions-v4-fixes' ); ?>">
			<a class="dk-landing-cta is-enter" href="<?php echo esc_url( home_url( '/home/' ) ); ?>"><?php echo esc_html( dkxv4_content( 'home_enter_label' ) ); ?> <span>→</span></a>
			<a class="dk-landing-cta is-work" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>"><?php esc_html_e( 'View our work', 'dk-expressions-v4-fixes' ); ?> <span>↗</span></a>
			<a class="dk-landing-cta is-project" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start a project', 'dk-expressions-v4-fixes' ); ?> <span>↗</span></a>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php if ( $three_doors_preview ) : ?>
<section class="dkx1200-section dkx1200-pathways" id="three-doors">
	<header class="dkx1200-section-head">
		<div>
			<p class="dkx1200-eyebrow">Choose Your Experience</p>
			<h2>Three doors.<br><em>One DK universe.</em></h2>
		</div>
		<p>Enter through the pathway that matches what you need today. Every door is powered by the same creativity, credibility and execution.</p>
	</header>
	<div class="dkx1200-pathway-grid">
		<a class="agency" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><span>01 / AGENCY</span><h3>Build a brand people remember.</h3><p>Strategy, campaigns, photography, film, SEO and digital experiences engineered for growth.</p><b>Explore Solutions →</b></a>
		<a class="media" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><span>02 / MEDIA</span><h3>Discover culture as it happens.</h3><p>Entertainment news, interviews, reviews, events and the stories shaping South Africa.</p><b>Enter Insights →</b></a>
		<a class="archive" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>"><span>03 / TIME VAULT</span><h3>See where we have travelled.</h3><p>Photography, motion, recommendations and moments frozen across more than a decade.</p><b>Open Our Work →</b></a>
	</div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
