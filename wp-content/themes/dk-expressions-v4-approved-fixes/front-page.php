<?php
/**
 * Cinematic landing page shown at the root domain on every visit.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();

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
		<div class="dk-landing-actions" aria-label="<?php esc_attr_e( 'Choose your DK Expressions experience', 'dk-expressions-v4-fixes' ); ?>">
			<a class="dk-landing-cta is-enter" href="<?php echo esc_url( home_url( '/home/' ) ); ?>"><?php echo esc_html( dkxv4_content( 'home_enter_label' ) ); ?> <span>→</span></a>
			<a class="dk-landing-cta is-work" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>"><?php esc_html_e( 'View our work', 'dk-expressions-v4-fixes' ); ?> <span>↗</span></a>
			<a class="dk-landing-cta is-project" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start a project', 'dk-expressions-v4-fixes' ); ?> <span>↗</span></a>
		</div>
	</div>
</section>

<main class="dkxv4-conversion-landing dk-no-semantic-highlight" id="analytics-proof">
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

<?php get_footer(); ?>
