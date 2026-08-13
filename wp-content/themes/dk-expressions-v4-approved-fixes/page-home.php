<?php
/**
 * DK Expressions V4.5 conversion-led Home page.
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
<section class="dk-home-page-hero dk-enterprise-hero" id="top">
	<div class="dk-stars" aria-hidden="true"></div>
	<div class="dk-enterprise-grid" aria-hidden="true"></div>
	<div class="dk-home-page-copy">
		<p class="dk-kicker">Premium culture, content &amp; brand storytelling</p>
		<h1>We help brands <em>dominate attention.</em></h1>
		<p>DK Expressions combines editorial authority, world-class visual storytelling and digital growth strategy to create experiences people remember—and results businesses can measure.</p>
		<div class="dk-home-actions">
			<a class="dk-button" href="<?php echo esc_url( dkxv4_content_url( 'home_page_primary_url' ) ); ?>">Book a strategy call ↗</a>
			<a class="dk-text-link" href="#choose-your-experience">Choose your experience ↓</a>
		</div>
		<ul class="dk-hero-proof" aria-label="DK Expressions credentials">
			<li><strong>Since 2013</strong><span>Independent media authority</span></li>
			<li><strong>3,000+</strong><span>Stories published</span></li>
			<li><strong>100+</strong><span>Brands &amp; partners</span></li>
		</ul>
	</div>
	<div class="dk-home-orbit" aria-hidden="true"><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt=""></div>
</section>

<section class="dk-experience-pathways dk-section" id="choose-your-experience" aria-labelledby="experience-title">
	<div class="dk-section-head">
		<div><p class="dk-kicker">Choose your experience</p><h2 id="experience-title">One brand.<br><em>Two powerful worlds.</em></h2></div>
		<p>Enter through the pathway that matches what you need today. Both are powered by the same standard of creativity, credibility and execution.</p>
	</div>
	<div class="dk-pathway-grid">
		<a class="dk-pathway-card dk-pathway-media" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">
			<span class="dk-pathway-index">01 / MEDIA</span><h3>Discover culture as it happens.</h3><p>Entertainment news, interviews, reviews, event coverage, competitions and the stories shaping South Africa.</p><strong>Explore DK Expressions Media →</strong>
		</a>
		<a class="dk-pathway-card dk-pathway-agency" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">
			<span class="dk-pathway-index">02 / AGENCY</span><h3>Build a brand people remember.</h3><p>Strategy, campaigns, photography, film, SEO, paid media and digital experiences engineered for growth.</p><strong>Grow your brand →</strong>
		</a>
	</div>
</section>

<section class="dk-authority-strip" aria-label="Selected authority and experience">
	<p>Trusted across global entertainment, major events and ambitious brands</p>
	<div class="dk-authority-marquee" data-dkx-marquee>
		<span>John Legend</span><span>Foo Fighters</span><span>Justin Bieber</span><span>Comic Con Africa</span><span>Big Concerts</span><span>Disney On Ice</span><span>Tiësto</span><span>Finance Magnates</span><span>OneRepublic</span><span>Michael Bublé</span>
	</div>
</section>

<section class="dk-metrics dk-home-metrics dk-no-semantic-highlight" aria-label="DK Expressions in numbers">
	<?php for ( $i = 1; $i <= 6; $i++ ) :
		$metric_value = (string) dkxv4_content( "metric_{$i}_value" );
		$metric_class = preg_match( '/\d/u', $metric_value ) ? 'is-numeric' : 'is-textual';
		?>
		<div class="<?php echo esc_attr( $metric_class ); ?>"><strong><?php echo esc_html( $metric_value ); ?></strong><span><?php echo esc_html( dkxv4_content( "metric_{$i}_label" ) ); ?></span></div>
	<?php endfor; ?>
</section>

<section class="dk-section">
	<div class="dk-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_services_kicker' ) ); ?></p><h2>Capability built<br><em>around your outcome.</em></h2></div><p>Choose a focused service or combine capabilities into an integrated campaign designed around your commercial objective.</p></div>
	<div class="dk-card-grid">
		<?php foreach ( $services as $service ) : ?>
			<article class="dk-card"><span class="dk-card-number"><?php echo esc_html( $service[0] ); ?></span><span class="dk-card-icon" aria-hidden="true"><?php echo esc_html( $service[3] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p><a href="<?php echo esc_url( $service[4] ); ?>">Explore ↗</a></article>
		<?php endforeach; ?>
	</div>
</section>

<section class="dk-section">
	<div class="dk-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_work_kicker' ) ); ?></p><h2><?php echo esc_html( dkxv4_content( 'home_work_title_1' ) ); ?><br><em><?php echo esc_html( dkxv4_content( 'home_work_title_2' ) ); ?></em></h2></div><p><?php echo esc_html( dkxv4_content( 'home_work_intro' ) ); ?></p></div>
	<div class="dk-work-grid">
		<?php foreach ( $work as $item ) : ?>
			<a class="dk-work-card" style="--tone:<?php echo esc_attr( $item[2] ); ?>" href="<?php echo esc_url( $item[3] ); ?>"><span class="dk-work-card-content"><small><?php echo esc_html( $item[0] ); ?></small><strong><?php echo esc_html( $item[1] ); ?></strong></span></a>
		<?php endforeach; ?>
	</div>
</section>

<?php
$clients_post_type = dkxv4_clients_post_type();
if ( $clients_post_type ) :
	$clients = new WP_Query( array( 'post_type' => $clients_post_type, 'post_status' => 'publish', 'posts_per_page' => min( 40, max( 1, absint( dkxv4_content( 'home_clients_count' ) ) ) ), 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ), 'no_found_rows' => true ) );
	if ( $clients->have_posts() ) : ?>
	<section class="dk-section dk-clients-section">
		<div class="dk-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_clients_kicker' ) ); ?></p><h2><?php echo esc_html( dkxv4_content( 'home_clients_title_1' ) ); ?><br><em><?php echo esc_html( dkxv4_content( 'home_clients_title_2' ) ); ?></em></h2></div><p><?php echo esc_html( dkxv4_content( 'home_clients_intro' ) ); ?></p></div>
		<div class="dk-client-logo-grid"><?php while ( $clients->have_posts() ) : $clients->the_post(); ?><div class="dk-client-logo" title="<?php echo esc_attr( get_the_title() ); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); } else { echo '<strong>' . esc_html( get_the_title() ) . '</strong>'; } ?></div><?php endwhile; wp_reset_postdata(); ?></div>
	</section>
	<?php endif; endif; ?>

<section class="dk-section dk-eos-bridge">
	<div class="dk-eos-copy"><p class="dk-kicker">Powered by Expressions OS</p><h2>Your project.<br><em>One intelligent workspace.</em></h2><p>Selected clients will collaborate through Expressions OS—our evolving enterprise platform for briefs, approvals, media assets, reporting, tasks and intelligent assistance.</p><div class="dk-home-actions"><a class="dk-button" href="https://staging.dkexpressions.co.za/" target="_blank" rel="noopener">Preview Expressions OS ↗</a><a class="dk-text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request client access →</a></div></div>
	<div class="dk-eos-console" aria-label="Expressions OS capabilities"><span>MISSION CONTROL</span><div><b>Projects</b><strong>12 active</strong></div><div><b>Approvals</b><strong>4 awaiting</strong></div><div><b>Media vault</b><strong>Connected</strong></div><div><b>Reporting</b><strong>Live</strong></div><small>EXPRESS · BUILD · EMPOWER</small></div>
</section>

<section class="dk-section">
	<div class="dk-section-head"><div><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_insights_kicker' ) ); ?></p><h2><?php echo esc_html( dkxv4_content( 'home_insights_title_1' ) ); ?><br><em><?php echo esc_html( dkxv4_content( 'home_insights_title_2' ) ); ?></em></h2></div><p><?php echo esc_html( dkxv4_content( 'home_insights_intro' ) ); ?></p></div>
	<div class="dk-insight-list"><?php $latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => min( 12, max( 1, absint( dkxv4_content( 'home_posts_count' ) ) ) ) ) ); if ( $latest->have_posts() ) : while ( $latest->have_posts() ) : $latest->the_post(); $categories = get_the_category(); ?><article><a href="<?php the_permalink(); ?>"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></time><small><?php echo esc_html( $categories ? $categories[0]->name : 'Story' ); ?></small><h3><?php the_title(); ?></h3><span>↗</span></a></article><?php endwhile; wp_reset_postdata(); else : ?><p>No stories have been published yet.</p><?php endif; ?></div>
</section>

<section class="dk-contact dk-conversion-final"><p class="dk-kicker">Your next chapter</p><h2>Let’s create something<br>people cannot ignore.</h2><p>Tell us what you are launching, promoting or transforming. We will build the right combination of story, strategy and execution.</p><div class="dk-home-actions"><a class="dk-button" href="<?php echo esc_url( dkxv4_content_url( 'header_cta_url' ) ); ?>">Book a strategy call ↗</a><a class="dk-text-link" href="mailto:<?php echo esc_attr( dkxv4_content( 'contact_email' ) ); ?>">Email DK Expressions →</a></div></section>
<?php get_footer(); ?>
