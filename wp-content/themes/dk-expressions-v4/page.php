<?php
/**
 * Standard and core page template.
 *
 * @package DK_Expressions_V4
 */
get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
$defaults = array(
	'solutions'  => array( 'Connected creative capability', 'Every Story.', 'Every Platform.', 'Strategy, production, media and technology brought together by one team—with one standard: excellence.' ),
	'our-work'   => array( 'Selected missions', 'Powerful Projects.', 'Real Impact.', 'A living portfolio of experiences captured, campaigns delivered and cultural moments preserved.' ),
	'industries' => array( 'Where we make an impact', 'Local Insight.', 'Global Imagination.', 'Sector understanding meets multidisciplinary creativity across industries built on attention, trust and experience.' ),
	'insights'   => array( 'The editorial archive', 'Culture, Captured.', 'In Real Time.', 'Entertainment, music, technology, events and the stories shaping South African culture.' ),
	'about'      => array( 'Since February 2013', 'One Camera.', 'A World of Stories.', 'DK Expressions began in Johannesburg with determination, imagination and the belief that moments matter.' ),
	'legacy'     => array( 'Built beyond the moment', 'Preserving Moments.', 'Building Legacies.', 'The legacy of DK Expressions is measured in the moments preserved, the people inspired and the opportunities created.' ),
	'contact'    => array( 'Start your project', 'Your Next Chapter.', 'Starts Here.', 'Tell us what you are building, launching or celebrating. We will show you how far the story can travel.' ),
);
$hero = $defaults[ $slug ] ?? array( 'DK Expressions', get_the_title(), 'Experience Everything.', get_bloginfo( 'description' ) );
?>
<section class="dk-page-hero"><div class="dk-stars" aria-hidden="true"></div><div class="dk-page-ring" aria-hidden="true"></div><div class="dk-page-copy"><p class="dk-kicker"><?php echo esc_html( $hero[0] ); ?></p><h1><?php echo esc_html( $hero[1] ); ?><em><?php echo esc_html( $hero[2] ); ?></em></h1><p><?php echo esc_html( $hero[3] ); ?></p></div></section>
<?php while ( have_posts() ) : the_post(); ?>
	<article class="dk-content">
		<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) ) : the_content(); else : ?>
			<?php if ( 'contact' === $slug ) : ?>
				<h2>Start with the story.</h2><p>Share the essentials and we will respond within one business day to arrange a focused discovery conversation.</p><p><a class="dk-button" href="mailto:dale@dkexpressions.co.za?subject=Start%20a%20project%20with%20DK%20Expressions">Email your project brief ↗</a></p><h3>Johannesburg · South Africa · Worldwide</h3>
			<?php elseif ( 'about' === $slug ) : ?>
				<h2>Stories that move people. Experiences they never forget.</h2><p>What started as one founder capturing one moment at a time became a network of Time Travellers—creators able to preserve culture wherever it happened.</p><h3>Inspired</h3><p>We believe the best work sparks an emotion, an idea or the courage to act.</p><h3>Time Travellers</h3><p>Our people move through moments and preserve what others might miss.</p>
			<?php elseif ( 'legacy' === $slug ) : ?>
				<blockquote>We do not simply document what happened. We preserve what it felt like.</blockquote><h2>Inspire. Preserve. Build.</h2><p>A story becomes a legacy when it continues to move people after the lights go down.</p>
			<?php elseif ( 'insights' === $slug ) : ?>
				<p><a class="dk-button" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>">Enter the editorial archive ↗</a></p>
			<?php else : ?>
				<h2>The page is ready for your approved content.</h2><p>This staging page uses the complete DK Expressions design system and can be edited safely in WordPress without affecting the live website.</p><p><a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start your project ↗</a></p>
			<?php endif; ?>
		<?php endif; ?>
	</article>
<?php endwhile; ?>
<?php get_footer(); ?>
