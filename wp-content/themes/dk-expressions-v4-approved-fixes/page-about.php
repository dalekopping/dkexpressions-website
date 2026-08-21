<?php
/**
 * Template Name: DK Expressions About — Time Machine
 * Final combined About experience — v1.23.8.
 */

get_header();

$team = array(
	array(
		dkxv4_page_meta( 'about_dale_name', 'Dale Kopping' ),
		dkxv4_page_meta( 'about_dale_role', 'Founder / Editor / International Photographer' ),
		'dale',
		array( 'dale kopping', 'dale-kopping', 'dale' ),
		dkxv4_page_meta( 'about_dale_bio', 'Founder of DK Expressions. Photographer, publisher, strategist and professional collector of moments that should not disappear.' ),
	),
	array(
		dkxv4_page_meta( 'about_estelle_name', 'Estelle Janse van Rensburg' ),
		dkxv4_page_meta( 'about_estelle_role', '2IC / Photojournalist / Content Creator / Client Liaison' ),
		'estelle',
		array( 'estelle janse van rensburg', 'estelle janse', 'estelle' ),
		dkxv4_page_meta( 'about_estelle_bio', 'Part of DK Expressions since 2014. Her first assignment was the Monster Motocross Nationals, where she captured more than 4,000 images in one weekend — and roughly 2,500 of them were strong enough to use. Hundreds of events and thousands of listings later, she remains one of the minds behind the machine.' ),
	),
	array(
		dkxv4_page_meta( 'about_craig_name', 'Craig Muscat' ),
		dkxv4_page_meta( 'about_craig_role', 'Photojournalist / Content Creator / Mad Scientist' ),
		'craig',
		array( 'craig muscat', 'craig-muscat' ),
		dkxv4_page_meta( 'about_craig_bio', 'Joined the Time Travellers in 2023. First assignment: Sexpo. Then ULTRA, Comic Con, Calabash and more. Equal parts photojournalist, creator and mad scientist — with ideas that occasionally sound questionable for five seconds before turning out to be annoyingly good.' ),
	),
	array(
		dkxv4_page_meta( 'about_lucky_name', 'Lucky Mthabela' ),
		dkxv4_page_meta( 'about_lucky_role', 'Photojournalist / PRETTIPIKTURES / Time Traveller' ),
		'lucky',
		array( 'lucky mthabela', 'lucky-mthabela', 'prettipiktures', 'pretti piktures', 'lucky' ),
		dkxv4_page_meta( 'about_lucky_bio', 'Joined the journey around 2015 after a chance meeting at an event in Marshalltown. What began with learning event photography became a full-time photographic career and PRETTIPIKTURES. Years of stages, artists and events later, the relationship is far closer to brotherhood than business.' ),
	),
);

$beliefs = array(
	'Coverage is not the same as content.',
	'Pretty pictures that do nothing for the brand are a waste of everyone’s time.',
	'Consistency beats occasional brilliance.',
	'The best work usually happens when the client trusts us enough to get out of the way.',
	'Fixed scopes and clear packages protect both sides.',
);

$ideas = array(
	array( 'Inspired', 'Work that sparks emotion, ideas and action.' ),
	array( 'Time Travellers', 'Creators who preserve the moments others might miss.' ),
	array( 'Legacy Builders', 'Leadership focused on value that lives beyond the campaign.' ),
	array( 'Inspire. Preserve. Build.', 'The idea behind every story, partnership and experience.' ),
);
?>

<main class="dk-about-v1238 dk-no-semantic-highlight" id="top">
	<section class="dk-about-shot-hero" aria-labelledby="dk-about-title">
		<div class="dk-about-shot-stars" aria-hidden="true"></div>
		<div class="dk-about-shot-orbit" aria-hidden="true"></div>
		<div class="dk-about-shot-copy">
			<p class="dk-kicker">About / Since February 2013</p>
			<h1 id="dk-about-title">Not a media company.<br>A time machine.</h1>
			<p class="dk-about-hero-sub">DK Expressions began in Johannesburg in February 2013 with one camera, determination, and the belief that moments matter.</p>
			<div class="dk-about-hero-opening">
				<p>Our Time Travellers capture culture as it happens and build stories that keep moving long after the lights go down.</p>
				<strong>Stories that move people. Experiences they will never forget.</strong>
				<span>We have been in the room since 2013. The tools have changed. The standard has not.</span>
			</div>
		</div>
	</section>

	<section class="dk-about-shot-origin dk-section" id="our-story">
		<p class="dk-about-shot-lead">Stories that move people. Experiences they will never forget.</p>
		<h2>Born in Johannesburg.<br>Built for everywhere.</h2>
		<div class="dk-about-shot-copygrid">
			<p>DK Expressions started when founder Dale Kopping began capturing one experience at a time. What began as a single camera and a clear standard grew into an independent media, creative and brand-storytelling company.</p>
			<p>Our Time Travellers move through entertainment, culture, events, hospitality, lifestyle, technology, real estate and beyond — preserving the emotion of each moment and turning it into work that continues travelling.</p>
			<p>We combine photography, film, editorial, digital strategy and emerging technology into one connected creative experience.</p>
			<p>We do not simply document what happened. We preserve what it felt like — and help brands turn that connection into legacy.</p>
		</div>
	</section>

	<section class="dk-about-beliefs dk-section" id="what-we-believe">
		<header class="dk-section-head">
			<div><p class="dk-kicker">What we believe</p><h2>The standard<br>behind the work.</h2></div>
			<p>The tools have changed. The standard has not. These are the principles that keep every project honest, sharp and useful.</p>
		</header>
		<div class="dk-about-belief-grid">
			<?php foreach ( $beliefs as $belief_index => $belief ) : ?>
			<article data-index="<?php echo esc_attr( str_pad( (string) ( $belief_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>"><span><?php echo esc_html( str_pad( (string) ( $belief_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $belief ); ?></h3></article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dk-about-idea dk-section" id="the-idea">
		<header class="dk-section-head">
			<div><p class="dk-kicker">The Idea</p><h2>Inspire.<br>Preserve. Build.</h2></div>
			<p>Four connected ideas behind every story, partnership and experience.</p>
		</header>
		<div class="dk-about-shot-values">
			<?php foreach ( $ideas as $idea_index => $idea ) : ?>
			<article><span><?php echo esc_html( str_pad( (string) ( $idea_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $idea[0] ); ?></h3><p><?php echo esc_html( $idea[1] ); ?></p></article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dk-about-method dk-section" id="how-we-work">
		<header class="dk-section-head">
			<div><p class="dk-kicker">How we work</p><h2>Direct. Defined.<br>Built to last.</h2></div>
			<p>Most clients begin with a single event or project. Many stay for retainers once they experience the difference.</p>
		</header>
		<div class="dk-about-method-grid">
			<article><span>01 / CLEAR FROM THE START</span><h3>No hourly surprises.</h3><p>We prefer direct communication, defined deliverables and no hourly surprises.</p></article>
			<article><span>02 / ONE CONNECTED DISCIPLINE</span><h3>Audience first. Objective always.</h3><p>We work across multiple industries, but we apply the same discipline everywhere: start with the audience and the objective, then execute at a level that still holds up when the moment has passed.</p></article>
		</div>
	</section>

	<section class="dk-team dk-section" id="time-travellers">
		<div class="dk-section-head">
			<div><p class="dk-kicker">Meet the Time Travellers</p><h2>The minds behind<br>the moments.</h2></div>
			<p>Different disciplines. Different personalities. One shared instinct: if something matters, capture it properly.</p>
		</div>
		<div class="dk-team-grid">
			<?php foreach ( $team as $index => $member ) :
				$media = dkxv4_get_team_media( $member[2], $member[3] );
				?>
			<article class="dk-team-card">
				<div class="dk-team-portrait">
					<?php
					if ( $media && 0 === strpos( (string) get_post_mime_type( $media ), 'image/' ) ) {
						echo wp_get_attachment_image( $media->ID, 'large', false, array( 'loading' => 'lazy', 'alt' => $member[0] ) );
					} else {
						echo '<span>' . esc_html( substr( $member[0], 0, 1 ) ) . '</span>';
					}
					?>
					<i><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></i>
				</div>
				<div class="dk-team-copy"><small>TIME TRAVELLER</small><h3><?php echo esc_html( $member[0] ); ?></h3><strong><?php echo esc_html( $member[1] ); ?></strong><p><?php echo esc_html( $member[4] ); ?></p></div>
			</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dk-about-vault dk-section" id="time-vault">
		<div class="dk-about-vault-orbit" aria-hidden="true"><i></i><i></i><span>13+</span></div>
		<div class="dk-about-vault-copy">
			<p class="dk-kicker">The Time Vault</p>
			<h2>Not a highlight reel.<br>A working archive.</h2>
			<p>Everything we have shot over the years lives in the Time Vault. It is not a highlight reel designed to impress. It is a working archive of what we actually do when the lights go down and the pressure is on.</p>
			<a class="dk-about-inline-link" href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Explore the Time Vault <span>↗</span></a>
		</div>
	</section>

	<section class="dk-join-team dk-section" id="join-the-time-travellers">
		<div class="dk-join-team-copy">
			<p class="dk-kicker">Wanna become a Time Traveller?</p>
			<h2>Think you belong<br>in the timeline?</h2>
			<p>We are always interested in photographers, filmmakers, writers, creators, editors, strategists and wonderfully strange people who see the world differently.</p>
			<p>Send us your portfolio — or tell us why you should be part of the team.</p>
		</div>
		<form class="dk-time-traveller-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="dkx_time_traveller_application">
			<?php wp_nonce_field( 'dkx_time_traveller_application', 'dkx_time_traveller_nonce' ); ?>
			<label><span>Your name *</span><input type="text" name="applicant_name" required></label>
			<label><span>Email address *</span><input type="email" name="applicant_email" required></label>
			<label><span>What do you do?</span><input type="text" name="applicant_role"></label>
			<label><span>Portfolio link</span><input type="url" name="portfolio_url" placeholder="https://"></label>
			<label><span>Upload portfolio</span><input type="file" name="portfolio_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></label>
			<label><span>Why do you want to become a Time Traveller? *</span><textarea name="applicant_reason" rows="7" required></textarea></label>
			<div class="dk-application-actions"><button type="submit" class="dk-button">Send Application ↗</button><a class="dk-application-whatsapp" href="https://wa.me/27722460451?text=<?php echo rawurlencode( 'Hi Dale, I am interested in becoming a Time Traveller at DK Expressions and would like to share my portfolio.' ); ?>" target="_blank" rel="noopener">Apply via WhatsApp ↗</a></div>
		</form>
	</section>

	<section class="dk-about-final dk-section" aria-labelledby="dk-about-final-title">
		<p class="dk-kicker">Freezing time and space with the Time Travellers®</p>
		<h2 id="dk-about-final-title">We are still here.<br>Still shooting.<br><em>Still holding the same standard.</em></h2>
		<div class="dk-about-final-actions">
			<a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a>
			<a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">View the Time Vault <span>→</span></a>
			<a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View Rate Card <span>↓</span></a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
