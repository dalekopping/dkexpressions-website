<?php
/**
 * Cinematic landing page shown at the root domain on every visit.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();

$three_doors_preview = function_exists( 'dkxv4_is_three_doors_landing_preview' ) && dkxv4_is_three_doors_landing_preview();
$conversion_preview  = function_exists( 'dkxv4_is_conversion_landing_preview' ) && dkxv4_is_conversion_landing_preview();

$server_metrics = array(
	array( '01', '1.10M+', 'Visits', 'People entering the DK Expressions universe.', 'is-visits' ),
	array( '02', '2.47M+', 'Pages viewed', '', 'is-pages' ),
	array( '03', '6.13M+', 'Hits', '', 'is-hits' ),
	array( 'Live', '97,603', 'August visits', '', 'is-live' ),
);
?>

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
<?php elseif ( $conversion_preview ) : ?>
<main class="dkxv4-conversion-landing dk-no-semantic-highlight" id="analytics-preview" data-dkx-preview="conversion">
	<section class="dkxv4-proof" aria-labelledby="dkxv4-proof-title">
		<header class="dkxv4-proof-head">
			<div>
				<p>Proof, not promises</p>
				<h2 id="dkxv4-proof-title">Independent server analytics.</h2>
			</div>
			<p>DK Expressions server analytics<br><strong>September 2025–August 2026</strong></p>
		</header>

		<div class="dkxv4-server-grid">
			<?php foreach ( $server_metrics as $server_metric ) : ?>
			<article class="<?php echo esc_attr( $server_metric[4] ); ?>">
				<div class="dkxv4-server-index"><span><?php echo esc_html( $server_metric[0] ); ?></span><?php if ( 'is-live' === $server_metric[4] ) : ?><i aria-label="Live reporting"></i><?php endif; ?></div>
				<strong><?php echo esc_html( $server_metric[1] ); ?></strong>
				<b><?php echo esc_html( $server_metric[2] ); ?></b>
				<?php if ( $server_metric[3] ) : ?><p><?php echo esc_html( $server_metric[3] ); ?></p><?php endif; ?>
			</article>
			<?php endforeach; ?>
		</div>
		<p class="dkxv4-proof-verified"><i aria-hidden="true"></i>Verified server analytics · Webalizer</p>
	</section>
</main>
<?php endif; ?>

<?php get_footer(); ?>
