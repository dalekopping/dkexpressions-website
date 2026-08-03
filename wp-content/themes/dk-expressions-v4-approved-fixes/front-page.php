<?php
/**
 * Cinematic landing page shown at the root domain on every visit.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
?>
<section class="dk-home-hero dk-landing" id="top">
	<div class="dk-stars" aria-hidden="true"></div>
	<div class="dk-city" aria-hidden="true"></div>
	<div class="dk-portal" aria-hidden="true"></div>
	<div class="dk-hero-copy">
		<p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_hero_kicker' ) ); ?></p>
		<h1><?php echo esc_html( dkxv4_content( 'home_hero_title_1' ) ); ?> <span><?php echo esc_html( dkxv4_content( 'home_hero_title_2' ) ); ?></span></h1>
		<p class="dk-tagline"><?php echo esc_html( dkxv4_content( 'home_hero_tagline' ) ); ?><sup>™</sup></p>
		<a class="dk-enter" href="<?php echo esc_url( home_url( '/home/' ) ); ?>"><?php echo esc_html( dkxv4_content( 'home_enter_label' ) ); ?> <span>→</span></a>
	</div>
</section>
<?php get_footer(); ?>
