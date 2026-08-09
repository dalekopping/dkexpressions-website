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
		<p class="dk-kicker">Premium media. Creative storytelling. Measurable impact.</p>
		<h1>We create experiences.<br><em>We drive outcomes.</em></h1>
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

<section class="dk-v116-stories" aria-labelledby="latest-stories-title">
	<div class="dk-v116-stories-head"><p class="dk-kicker">Latest stories, reviews &amp; insights</p><h2 id="latest-stories-title" class="screen-reader-text">Latest stories</h2></div>
	<div class="dk-v116-story-grid">
		<?php
		$latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => min( 6, max( 1, absint( dkxv4_content( 'home_posts_count' ) ) ) ), 'no_found_rows' => true ) );
		if ( $latest->have_posts() ) : while ( $latest->have_posts() ) : $latest->the_post();
			$categories = get_the_category(); ?>
			<article class="dk-v116-story">
				<a href="<?php the_permalink(); ?>">
					<div class="dk-v116-story-media"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); } ?></div>
					<div class="dk-v116-story-copy">
						<div class="dk-v116-story-meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></time><small><?php echo esc_html( $categories ? $categories[0]->name : 'Story' ); ?></small></div>
						<h3><?php the_title(); ?></h3><span class="dk-v116-read">Read story ↗</span>
					</div>
				</a>
			</article>
		<?php endwhile; wp_reset_postdata(); endif; ?>
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

<section class="dk-section" id="capabilities">
	<div class="dk-v116-section-head">
		<div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_services_kicker' ) ); ?></p><h2>Capability built<br><em>around your outcome.</em></h2></div>
		<p>Choose a focused service or combine capabilities into an integrated campaign designed around your commercial objective.</p>
	</div>
	<div class="dk-card-grid">
		<?php foreach ( $services as $service ) : ?>
			<article class="dk-card"><span class="dk-card-number"><?php echo esc_html( $service[0] ); ?></span><span class="dk-card-icon" aria-hidden="true"><?php echo esc_html( $service[3] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p><a href="<?php echo esc_url( $service[4] ); ?>">Explore ↗</a></article>
		<?php endforeach; ?>
	</div>
</section>

<section class="dk-section">
	<div class="dk-v116-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_work_kicker' ) ); ?></p><h2><?php echo esc_html( dkxv4_content( 'home_work_title_1' ) ); ?><br><em><?php echo esc_html( dkxv4_content( 'home_work_title_2' ) ); ?></em></h2></div><p><?php echo esc_html( dkxv4_content( 'home_work_intro' ) ); ?></p></div>
	<div class="dk-work-grid"><?php foreach ( $work as $item ) : ?><a class="dk-work-card" style="--tone:<?php echo esc_attr( $item[2] ); ?>" href="<?php echo esc_url( $item[3] ); ?>"><span class="dk-work-card-content"><small><?php echo esc_html( $item[0] ); ?></small><strong><?php echo esc_html( $item[1] ); ?></strong></span></a><?php endforeach; ?></div>
</section>

<?php
$clients_post_type = dkxv4_clients_post_type();
if ( $clients_post_type ) :
	$clients = new WP_Query( array( 'post_type' => $clients_post_type, 'post_status' => 'publish', 'posts_per_page' => min( 36, max( 1, absint( dkxv4_content( 'home_clients_count' ) ) ) ), 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
	if ( $clients->have_posts() ) : ?>
	<section class="dk-section dk-clients-section">
		<div class="dk-v116-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_clients_kicker' ) ); ?></p><h2><?php echo esc_html( dkxv4_content( 'home_clients_title_1' ) ); ?><br><em><?php echo esc_html( dkxv4_content( 'home_clients_title_2' ) ); ?></em></h2></div><p><?php echo esc_html( dkxv4_content( 'home_clients_intro' ) ); ?></p></div>
		<div class="dk-client-logo-grid"><?php while ( $clients->have_posts() ) : $clients->the_post(); ?><div class="dk-client-logo" title="<?php echo esc_attr( get_the_title() ); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); } else { echo '<strong>' . esc_html( get_the_title() ) . '</strong>'; } ?></div><?php endwhile; wp_reset_postdata(); ?></div>
	</section>
	<?php endif; endif; ?>

<section class="dk-section dk-eos-bridge">
	<div class="dk-eos-copy"><p class="dk-kicker">Powered by Expressions OS</p><h2>Your project.<br><em>One intelligent workspace.</em></h2><p>Selected clients will collaborate through Expressions OS—our evolving enterprise platform for briefs, approvals, media assets, reporting, tasks and intelligent assistance.</p><div class="dk-v116-actions"><a class="dk-button" href="https://staging.dkexpressions.co.za/" target="_blank" rel="noopener">Preview Expressions OS ↗</a><a class="dk-text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request client access →</a></div></div>
	<div class="dk-eos-console" aria-label="Expressions OS capabilities"><span>MISSION CONTROL</span><div><b>Projects</b><strong>12 active</strong></div><div><b>Approvals</b><strong>4 awaiting</strong></div><div><b>Media vault</b><strong>Connected</strong></div><div><b>Reporting</b><strong>Live</strong></div><small>EXPRESS · BUILD · EMPOWER</small></div>
</section>

<section class="dk-contact dk-conversion-final"><p class="dk-kicker">Your next chapter</p><h2>Let’s create something<br>people cannot ignore.</h2><p>Tell us what you are launching, promoting or transforming. We will build the right combination of story, strategy and execution.</p><div class="dk-v116-actions" style="justify-content:center"><a class="dk-button" href="<?php echo esc_url( dkxv4_content_url( 'header_cta_url' ) ); ?>">Book a strategy call ↗</a><a class="dk-text-link" href="mailto:<?php echo esc_attr( dkxv4_content( 'contact_email' ) ); ?>">Email DK Expressions →</a></div></section>

<?php get_footer(); ?>
