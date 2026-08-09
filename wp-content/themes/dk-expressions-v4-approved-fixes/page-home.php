<?php
/**
 * DK Expressions Enterprise Home v1.16.0.
 *
 * Template Name: DK Expressions Home — Enterprise
 * @package DK_Expressions_V4_Fixes
 */
get_header();

$services = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$services[] = array(
		dkxv4_content( "service_{$i}_number" ),
		dkxv4_content( "service_{$i}_title" ),
		dkxv4_content( "service_{$i}_description" ),
		dkxv4_content( "service_{$i}_icon" ),
		dkxv4_content_url( "service_{$i}_url" ),
	);
}
$work = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$work[] = array(
		dkxv4_content( "work_{$i}_category" ),
		dkxv4_content( "work_{$i}_title" ),
		dkxv4_content( "work_{$i}_colour" ),
		dkxv4_content_url( "work_{$i}_url" ),
	);
}
?>

<section class="dk-v116-hero" id="top">
	<div class="dk-v116-hero-logo" aria-label="DK Expressions">
		<span class="dk-v116-hero-logo-ring" aria-hidden="true"></span>
		<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" decoding="async" fetchpriority="high">
	</div>
	<div class="dk-v116-hero-copy">
		<p class="dk-kicker dk-v116-hero-kicker">Premium culture, content &amp; brand storytelling</p>
		<h1 class="dk-v116-hero-title"><span>We help<br>brands</span><em>dominate<br>attention.</em></h1>
		<p>DK Expressions combines editorial authority, world-class visual storytelling and digital growth strategy to create experiences people remember—and results businesses can measure.</p>
		<div class="dk-v116-actions">
			<a class="dk-button" href="<?php echo esc_url( dkxv4_content_url( 'home_page_primary_url' ) ); ?>">Book a strategy call ↗</a>
			<a class="dk-text-link" href="#capabilities">View our services →</a>
		</div>
	</div>
</section>

<section class="dk-v116-metrics dk-no-semantic-highlight" aria-label="DK Expressions in numbers">
	<?php for ( $i = 1; $i <= 6; $i++ ) :
		$value = (string) dkxv4_content( "metric_{$i}_value" );
		$is_text = ! preg_match( '/\d/u', $value );
		?>
		<div class="dk-v116-metric <?php echo $is_text ? 'is-text' : 'is-number'; ?>">
			<strong><?php echo esc_html( $value ); ?></strong>
			<span><?php echo esc_html( dkxv4_content( "metric_{$i}_label" ) ); ?></span>
		</div>
	<?php endfor; ?>
</section>

<section class="dk-v116-trust" aria-label="Trusted brands and events">
	<p>Trusted across global entertainment, major events and ambitious brands</p>
	<div class="dk-v116-marquee">
		<?php $trust = array( 'Justin Bieber', 'Comic Con Africa', 'Big Concerts', 'Disney On Ice', 'Tiësto', 'Ultra South Africa', 'MTV', 'Live Nation', 'Nitro Circus Live', 'John Legend', 'Kings Of Chaos', 'Showtime Management', 'Delicious International Food & Music Festival', 'Massive.Management' ); foreach ( $trust as $index => $brand ) : ?>
			<span><?php echo esc_html( $brand ); ?></span><?php if ( $index < count( $trust ) - 1 ) : ?><i>◆</i><?php endif; ?>
		<?php endforeach; ?>
	</div>
</section>

<section class="dk-v116-stories dk-v116-sticky-stories" aria-labelledby="latest-stories-title">
	<div class="dk-v116-stories-head">
		<p class="dk-kicker">Featured stories, reviews &amp; insights</p>
		<h2 id="latest-stories-title" class="screen-reader-text">Featured sticky stories</h2>
	</div>
	<div class="dk-v116-sticky-list">
		<?php
		$sticky_ids = array_values( array_filter( array_map( 'absint', (array) get_option( 'sticky_posts', array() ) ) ) );
		if ( $sticky_ids ) :
			$sticky_posts = new WP_Query(
				array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'post__in'            => $sticky_ids,
					'posts_per_page'      => count( $sticky_ids ),
					'orderby'             => 'date',
					'order'               => 'DESC',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
			while ( $sticky_posts->have_posts() ) :
				$sticky_posts->the_post();
				$categories = get_the_category();
				?>
				<article class="dk-v116-sticky-story">
					<a href="<?php the_permalink(); ?>">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></time>
						<small><?php echo esc_html( $categories ? $categories[0]->name : 'Story' ); ?></small>
						<h3><?php the_title(); ?></h3>
					</a>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>

<section class="dk-section" id="choose-your-experience">
	<div class="dk-v116-section-head">
		<div><p class="dk-kicker">Choose your experience</p><h2>One brand.<br><em>Two powerful worlds.</em></h2></div>
		<p>Enter through the pathway that matches what you need today. Both are powered by the same standard of creativity, credibility and execution.</p>
	</div>
	<div class="dk-v116-paths">
		<a class="dk-v116-path" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><span>01 / MEDIA</span><h3>Discover culture as it happens.</h3><p>Entertainment news, interviews, reviews, event coverage, competitions and the stories shaping South Africa.</p><strong>Explore DK Expressions Media →</strong></a>
		<a class="dk-v116-path" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><span>02 / AGENCY</span><h3>Build a brand people remember.</h3><p>Strategy, campaigns, photography, film, SEO, paid media and digital experiences engineered for growth.</p><strong>Grow your brand →</strong></a>
	</div>
</section>

<?php get_footer(); ?>
