<?php
/**
 * Cinematic landing page shown at the root domain on every visit.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
$three_doors_preview = function_exists( 'dkxv4_is_three_doors_landing_preview' ) && dkxv4_is_three_doors_landing_preview();
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
<?php endif; ?>
<?php get_footer(); ?>
