<?php
/**
 * Template Name: DK Expressions Contact — Start a Project
 * Conversion brief experience — v1.22.7.
 */
get_header();

$project_status = isset( $_GET['project'] ) ? sanitize_key( wp_unslash( $_GET['project'] ) ) : '';
$brief_received = 'sent' === $project_status;
$package_slug   = isset( $_GET['package'] ) ? sanitize_key( wp_unslash( $_GET['package'] ) ) : '';
$package_catalog = dkxv4_package_catalog();
$selected_package = isset( $package_catalog[ $package_slug ] ) ? $package_catalog[ $package_slug ] : null;
$selected_service = $selected_package ? $selected_package['service'] : '';
$selected_budget  = $selected_package ? $selected_package['budget'] : '';
$rate_card_url  = get_stylesheet_directory_uri() . '/assets/downloads/DK-Expressions-2026-Rate-Card.pdf';
$whatsapp_message = $selected_package
	? 'Hi Dale, I would like to discuss ' . $selected_package['label'] . ' (' . $selected_package['price'] . ').'
	: 'Hi Dale, I would like to discuss a project with DK Expressions.';
$whatsapp_url   = 'https://wa.me/27722460451?text=' . rawurlencode( $whatsapp_message );
$error_title    = 'invalid' === $project_status ? 'Please check the required fields.' : 'Something went wrong.';
$error_message  = 'invalid' === $project_status ? 'This field is needed, and the email address must be valid.' : 'Please try again or email us directly.';
?>
<main class="dkxcr dkxcr--contact dk-no-semantic-highlight" id="top">
	<div class="dkxcr-grid" aria-hidden="true"></div>

	<section class="dkxcr-contact-hero" aria-labelledby="dkxcr-contact-title">
		<div class="dkxcr-contact-hero-copy">
			<p class="dkxcr-kicker"><span>01</span> / Start a Project</p>
			<h1 id="dkxcr-contact-title">Tell us what<br>you’re <em>working on.</em></h1>
			<p>We’ll respond within one business day.</p>
		</div>
		<aside class="dkxcr-response-card" aria-label="Response time">
			<span><i></i> Direct line open</span>
			<strong>01</strong>
			<b>Business day</b>
			<p>One clear brief. One direct conversation.</p>
		</aside>
		<div class="dkxcr-contact-manifesto"><span>No automated replies.</span><span>No long forms.</span><strong>Just a clear brief and a direct conversation.</strong></div>
	</section>

	<section class="dkxcr-contact-strip" aria-label="Direct contact options">
		<a href="mailto:<?php echo esc_attr( dkxv4_content( 'contact_email' ) ); ?>"><span>EMAIL</span><strong><?php echo esc_html( dkxv4_content( 'contact_email' ) ); ?></strong><b>↗</b></a>
		<a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener"><span>WHATSAPP</span><strong>+27 72 246 0451</strong><b>↗</b></a>
		<div><span>BASE</span><strong>Johannesburg · South Africa · Worldwide</strong><b>●</b></div>
	</section>

	<section class="dkxcr-brief-stage" id="project-brief">
		<aside class="dkxcr-brief-guide">
			<p class="dkxcr-kicker"><span>02</span> / The brief</p>
			<h2>Enough detail<br>to find the <em>signal.</em></h2>
			<p>Tell us what is happening, what needs to move and what success should look like. We will build the next conversation around that.</p>
			<ol>
				<li><span>01</span><div><b>Share the objective</b><p>The project, event or brand challenge.</p></div></li>
				<li><span>02</span><div><b>Add the timing</b><p>A date, launch window or “Flexible”.</p></div></li>
				<li><span>03</span><div><b>Expect a human reply</b><p>Within one business day.</p></div></li>
			</ol>
			<a class="dkxcr-guide-link" href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View 2026 packages <span>→</span></a>
		</aside>

		<div class="dkxcr-form-shell">
			<?php if ( $brief_received ) : ?>
				<div class="dkxcr-success" role="status">
					<div class="dkxcr-success-signal" aria-hidden="true"><i></i><i></i><span>✓</span></div>
					<p class="dkxcr-kicker"><span>03</span> / Transmission received</p>
					<h2>Brief <em>received.</em></h2>
					<p>We’ve got it and will come back to you within one business day.</p>
					<?php if ( $selected_package ) : ?><p class="dkxcr-success-package"><span>Selected package</span><strong><?php echo esc_html( $selected_package['label'] ); ?></strong><b><?php echo esc_html( $selected_package['price'] ); ?></b></p><?php endif; ?>
					<div class="dkxcr-success-next">
						<span>In the meantime you can:</span>
						<a href="<?php echo esc_url( $rate_card_url ); ?>" download="DK-Expressions-2026-Rate-Card.pdf">Download the 2026 Rate Card <b>↓</b></a>
						<a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Browse the Time Vault <b>→</b></a>
						<a href="<?php echo esc_url( home_url( '/our-work/#recommendations' ) ); ?>">Read recent recommendations <b>↗</b></a>
					</div>
					<div class="dkxcr-actions"><a class="is-primary" href="<?php echo esc_url( $rate_card_url ); ?>" download="DK-Expressions-2026-Rate-Card.pdf">Download Rate Card <span>↓</span></a><a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">View Time Vault <span>→</span></a></div>
				</div>
			<?php else : ?>
				<?php if ( $selected_package ) : ?>
					<div class="dkxcr-selected-package" role="status">
						<span>Package carried into your brief</span>
						<strong><?php echo esc_html( $selected_package['label'] ); ?></strong>
						<b><?php echo esc_html( $selected_package['price'] ); ?></b>
						<a href="<?php echo esc_url( home_url( '/rates/#packages' ) ); ?>">Change package →</a>
					</div>
				<?php endif; ?>
				<header class="dkxcr-form-header">
					<div><p class="dkxcr-kicker"><span>03</span> / Your project</p><h2>Send the <em>brief.</em></h2></div>
					<p>Required fields are marked <b>*</b></p>
				</header>
				<?php if ( in_array( $project_status, array( 'invalid', 'error' ), true ) ) : ?>
					<div class="dkxcr-form-alert" role="alert"><b><?php echo esc_html( $error_title ); ?></b><span><?php echo esc_html( $error_message ); ?></span></div>
				<?php endif; ?>
				<form class="dkxcr-project-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate data-dkx-project-form>
					<input type="hidden" name="action" value="dkx_project_enquiry">
					<input type="hidden" name="project_package" value="<?php echo esc_attr( $package_slug ); ?>">
					<?php wp_nonce_field( 'dkx_project_enquiry', 'dkx_project_nonce' ); ?>
					<label class="dkxcr-honeypot" aria-hidden="true">Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>

					<div class="dkxcr-form-grid">
						<label class="dkxcr-field"><span><b>01</b> Full name <i class="is-required">*</i></span><input type="text" name="project_name" placeholder="Your name" autocomplete="name" required data-required-message="This field is needed"><small>Your name</small></label>
						<label class="dkxcr-field"><span><b>02</b> Email address <i class="is-required">*</i></span><input type="email" name="project_email" placeholder="We’ll reply here" autocomplete="email" required data-required-message="This field is needed" data-email-message="Please enter a valid email address"><small>We’ll reply here</small></label>
						<label class="dkxcr-field"><span><b>03</b> Phone <i>Optional</i></span><input type="tel" name="project_phone" placeholder="Prefer a call? Add your number" autocomplete="tel"><small>Prefer a call? Add your number</small></label>
						<label class="dkxcr-field"><span><b>04</b> Company or brand name <i>Optional</i></span><input type="text" name="project_company" placeholder="Optional but helpful" autocomplete="organization"><small>Optional but helpful</small></label>
						<label class="dkxcr-field"><span><b>05</b> What do you need? <i class="is-required">*</i></span><select name="project_service" required data-required-message="This field is needed"><option value="">Select a project type</option><option value="Event Coverage" <?php selected( $selected_service, 'Event Coverage' ); ?>>Event Coverage</option><option value="Brand Retainer" <?php selected( $selected_service, 'Brand Retainer' ); ?>>Brand Retainer</option><option value="Executive Branding" <?php selected( $selected_service, 'Executive Branding' ); ?>>Executive Branding</option><option value="Hospitality / Venue" <?php selected( $selected_service, 'Hospitality / Venue' ); ?>>Hospitality / Venue</option><option value="Real Estate" <?php selected( $selected_service, 'Real Estate' ); ?>>Real Estate</option><option value="Campaign / Launch" <?php selected( $selected_service, 'Campaign / Launch' ); ?>>Campaign / Launch</option><option value="Other" <?php selected( $selected_service, 'Other' ); ?>>Other</option></select><small><?php echo $selected_package ? 'Pre-selected from your chosen package' : 'Choose the closest fit'; ?></small></label>
						<label class="dkxcr-field"><span><b>06</b> When is it happening? <i>Optional</i></span><input type="text" name="project_timeline" placeholder="Approximate date or “Flexible”"><small>Date, launch window or flexible</small></label>
						<label class="dkxcr-field"><span><b>07</b> Budget range <i>Optional</i></span><select name="project_budget"><option value="">Select a range</option><option value="Under R15k" <?php selected( $selected_budget, 'Under R15k' ); ?>>Under R15k</option><option value="R15k–R35k" <?php selected( $selected_budget, 'R15k–R35k' ); ?>>R15k–R35k</option><option value="R35k–R75k" <?php selected( $selected_budget, 'R35k–R75k' ); ?>>R35k–R75k</option><option value="R75k+" <?php selected( $selected_budget, 'R75k+' ); ?>>R75k+</option><option value="Prefer to discuss" <?php selected( $selected_budget, 'Prefer to discuss' ); ?>>Prefer to discuss</option></select><small><?php echo $selected_package ? 'Matched to the selected package starting rate' : 'Helps us recommend the right scale'; ?></small></label>
						<label class="dkxcr-field is-wide"><span><b>08</b> Tell us more <i class="is-required">*</i></span><textarea name="project_brief" rows="7" placeholder="Brief overview, location, goals, or anything we should know" required data-required-message="This field is needed"></textarea><small>Brief overview, location, goals, or anything we should know</small></label>
						<label class="dkxcr-field is-wide"><span><b>09</b> How did you hear about us? <i>Optional</i></span><input type="text" name="project_referral" placeholder="Optional"><small>Search, referral, social or event</small></label>
					</div>

					<div class="dkxcr-form-submit">
						<button type="submit"><span>Send Brief</span><b>↗</b></button>
						<div><strong>We reply within one business day.</strong><p>If it’s urgent, call or <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener">WhatsApp directly</a>.</p></div>
					</div>
					<p class="dkxcr-privacy">Your information is only used to respond to this enquiry.</p>
				</form>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
