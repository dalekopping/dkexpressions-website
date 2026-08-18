<?php
/**
 * Cinematic front page.
 *
 * @package DK_Expressions_V4
 */
get_header();
$services = array(
	array( '01', 'Brand Storytelling', 'Strategy, campaigns and stories engineered to move people.', '✦' ),
	array( '02', 'Event Experiences', 'From the pit to the boardroom—coverage that keeps the moment alive.', '◉' ),
	array( '03', 'Digital Growth', 'Search, social and paid media that turn attention into momentum.', '↗' ),
	array( '04', 'Creative Production', 'Photography, film and content built to travel across every screen.', '◎' ),
	array( '05', 'Web & AI Solutions', 'Future-ready digital experiences and intelligent automation.', '⌬' ),
	array( '06', 'SEO & Analytics', 'Search visibility, performance intelligence and measurable growth.', '◌' ),
	array( '07', 'Photography', 'Powerful imagery for people, brands, events and defining moments.', '□' ),
	array( '08', 'Videography', 'Cinematic stories and short-form films for every screen.', '▷' ),
);
$work = array(
	array( 'Event Storytelling', 'Ultra South Africa', '#a21bff' ),
	array( 'Automotive', 'BYD South Africa', '#91b9d6' ),
	array( 'Entertainment', 'Comic Con Africa', '#00d8ff' ),
);
?>
<section class="dk-home-hero" id="top">
	<div class="dk-stars" aria-hidden="true"></div><div class="dk-city" aria-hidden="true"></div><div class="dk-portal" aria-hidden="true"></div>
	<div class="dk-hero-copy">
		<p class="dk-kicker">DK Expressions presents</p>
		<h1>Freezing Time <span>and Space</span></h1>
		<p class="dk-tagline">with the Time Travellers®</p>
		<button class="dk-enter" type="button" data-enter>Enter the experience <span>↓</span></button>
	</div>
</section>
<div id="experience">
	<section class="dk-metrics" aria-label="DK Expressions in numbers">
		<div><strong>13+</strong><span>Years of storytelling</span></div><div><strong>2,500+</strong><span>Projects delivered</span></div>
		<div><strong>Millions</strong><span>Audience reached</span></div><div><strong>3,000+</strong><span>Articles published</span></div>
		<div><strong>40+</strong><span>Cities covered</span></div><div><strong>100+</strong><span>Brands worked with</span></div>
	</section>
	<section class="dk-section">
		<div class="dk-section-head"><div><p class="dk-kicker">What we do</p><h2>Every story. Every platform.<br>One standard: <em>excellence.</em></h2></div><p>One connected creative partner—from the first idea to the final result.</p></div>
		<div class="dk-card-grid">
			<?php foreach ( $services as $service ) : ?>
				<article class="dk-card"><span class="dk-card-number"><?php echo esc_html( $service[0] ); ?></span><span class="dk-card-icon" aria-hidden="true"><?php echo esc_html( $service[3] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p><a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Explore ↗</a></article>
			<?php endforeach; ?>
		</div>
	</section>
	<section class="dk-section">
		<div class="dk-section-head"><div><p class="dk-kicker">Selected work</p><h2>Proof lives in<br><em>the experience.</em></h2></div><p>Powerful projects. Real moments. Stories designed to keep moving.</p></div>
		<div class="dk-work-grid">
			<?php foreach ( $work as $item ) : ?>
				<a class="dk-work-card" style="--tone:<?php echo esc_attr( $item[2] ); ?>" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>"><span class="dk-work-card-content"><small><?php echo esc_html( $item[0] ); ?></small><strong><?php echo esc_html( $item[1] ); ?></strong></span></a>
			<?php endforeach; ?>
		</div>
	</section>
	<section class="dk-section dk-split">
		<div class="dk-about-orbit" aria-hidden="true"><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt=""></div>
		<div><p class="dk-kicker">Since 2013</p><h2>Not a media company.<br>A <em>time machine.</em></h2><p>DK Expressions began with one camera and a belief that moments matter. Today, our Time Travellers capture culture as it happens and build stories that keep moving long after the lights go down.</p><p>We help entertainment, hospitality, lifestyle and ambitious brands turn attention into connection—and connection into legacy.</p><a class="dk-button" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Discover our story ↗</a></div>
	</section>
	<section class="dk-section">
		<div class="dk-section-head"><div><p class="dk-kicker">Latest insights</p><h2>Culture, captured<br><em>in real time.</em></h2></div><p>Entertainment, music, technology and the experiences shaping South African culture.</p></div>
		<div class="dk-insight-list">
			<?php
			$latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4, 'ignore_sticky_posts' => true ) );
			if ( $latest->have_posts() ) :
				while ( $latest->have_posts() ) : $latest->the_post();
					$categories = get_the_category();
					?>
					<article><a href="<?php the_permalink(); ?>"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></time><small><?php echo esc_html( $categories ? $categories[0]->name : 'Story' ); ?></small><h3><?php the_title(); ?></h3><span>↗</span></a></article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p>No stories have been published on staging yet. Your existing archive will appear here after migration.</p>';
			endif;
			?>
		</div>
	</section>
	<section class="dk-contact"><p class="dk-kicker">Your next chapter</p><h2>Ready to freeze<br>a moment in <em>time?</em></h2><p>Tell us what you’re building. We’ll show you how far the story can travel.</p><a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start your project ↗</a></section>
</div>
<?php get_footer(); ?>
