<?php
/**
 * Clean core pages without legacy Divi shortcode output.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
$option_slug = 'our-work' === $slug ? 'our_work' : str_replace( '-', '_', $slug );
$hero = array(
	dkxv4_content( "{$option_slug}_hero_kicker" ),
	dkxv4_content( "{$option_slug}_hero_title_1" ),
	dkxv4_content( "{$option_slug}_hero_title_2" ),
	dkxv4_content( "{$option_slug}_hero_text" ),
);
if ( ! array_filter( $hero ) ) {
	$hero = array( 'DK Expressions', get_the_title(), 'Experience Everything.', get_bloginfo( 'description' ) );
}
?>
<section class="dk-page-hero"><div class="dk-stars" aria-hidden="true"></div><div class="dk-page-ring" aria-hidden="true"></div><div class="dk-page-copy"><p class="dk-kicker"><?php echo esc_html( $hero[0] ); ?></p><h1><?php echo esc_html( $hero[1] ); ?><em><?php echo esc_html( $hero[2] ); ?></em></h1><p><?php echo esc_html( $hero[3] ); ?></p></div></section>

<?php if ( 'about' === $slug ) : ?>
	<section class="dk-core-page">
		<p class="dk-about-lead"><?php echo esc_html( dkxv4_content( 'about_lead' ) ); ?></p>
		<div class="dk-about-copy">
			<h2><?php echo esc_html( dkxv4_content( 'about_heading_1' ) ); ?><br><?php echo esc_html( dkxv4_content( 'about_heading_2' ) ); ?></h2>
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<p><?php echo esc_html( dkxv4_content( "about_paragraph_{$i}" ) ); ?></p>
			<?php endfor; ?>
		</div>
		<div class="dk-value-grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<article class="dk-value-card"><span><?php echo esc_html( dkxv4_content( "value_{$i}_number" ) ); ?></span><h3><?php echo esc_html( dkxv4_content( "value_{$i}_title" ) ); ?></h3><p><?php echo esc_html( dkxv4_content( "value_{$i}_description" ) ); ?></p></article>
			<?php endfor; ?>
		</div>
	</section>
<?php elseif ( 'contact' === $slug ) : ?>
	<section class="dk-contact-page">
		<div class="dk-contact-intro"><h2><?php echo esc_html( dkxv4_content( 'contact_intro_heading_1' ) ); ?><br><?php echo esc_html( dkxv4_content( 'contact_intro_heading_2' ) ); ?></h2><p><?php echo esc_html( dkxv4_content( 'contact_intro_text' ) ); ?></p></div>
		<div class="dk-contact-panel">
			<div class="dk-contact-details"><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'contact_kicker' ) ); ?></p><h3><?php echo esc_html( dkxv4_content( 'contact_heading' ) ); ?></h3><p><?php echo esc_html( dkxv4_content( 'contact_services' ) ); ?></p><a href="mailto:<?php echo esc_attr( dkxv4_content( 'contact_email' ) ); ?>"><?php echo esc_html( dkxv4_content( 'contact_email' ) ); ?></a><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', dkxv4_content( 'contact_phone' ) ) ); ?>"><?php echo esc_html( dkxv4_content( 'contact_phone' ) ); ?></a><p><?php echo esc_html( dkxv4_content( 'contact_location' ) ); ?></p><p><?php echo esc_html( dkxv4_content( 'contact_success_note' ) ); ?></p></div>
			<form class="dk-project-form" action="mailto:<?php echo esc_attr( dkxv4_content( 'contact_email' ) ); ?>" method="post" enctype="text/plain">
				<label>Your name *<input required name="Name" autocomplete="name" placeholder="Your full name"></label>
				<label>Company<input name="Company" autocomplete="organization" placeholder="Company or organisation"></label>
				<label>Email address *<input required type="email" name="Email" autocomplete="email" placeholder="name@company.co.za"></label>
				<label>Project type<select name="Project type">
					<?php foreach ( preg_split( '/\R/', dkxv4_content( 'contact_project_types' ) ) as $project_type ) : ?>
						<?php if ( trim( $project_type ) ) : ?><option><?php echo esc_html( trim( $project_type ) ); ?></option><?php endif; ?>
					<?php endforeach; ?>
				</select></label>
				<label class="wide">Tell us about the project *<textarea required name="Project brief" rows="6" placeholder="What are you creating, when is it happening and what would success look like?"></textarea></label>
				<button type="submit"><?php echo esc_html( dkxv4_content( 'contact_button' ) ); ?> ↗</button>
			</form>
		</div>
	</section>
<?php else : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="dk-content">
			<?php
			$content = get_the_content();
			if ( str_contains( $content, '[et_pb_' ) ) {
				echo '<h2>The next expression is being prepared.</h2><p>This page is now using the new DK Expressions design system. Legacy Divi formatting has been removed.</p>';
			} else {
				the_content();
			}
			?>
		</article>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
