<?php
/**
 * Approved footer with Back to the Future.
 *
 * @package DK_Expressions_V4_Fixes
 */
?>
</main>
<a class="dk-back-to-future" href="#top" aria-label="<?php esc_attr_e( 'Back to the top', 'dk-expressions-v4-fixes' ); ?>"><strong><?php echo esc_html( dkxv4_content( 'footer_back_label' ) ); ?></strong><span>↑</span></a>
<footer class="dk-footer">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
	<p><?php echo esc_html( dkxv4_content( 'footer_tagline' ) ); ?></p>
	<?php
	$socials = array(
		'facebook_url'  => 'Facebook',
		'instagram_url' => 'Instagram',
		'x_url'         => 'X',
		'youtube_url'   => 'YouTube',
		'tiktok_url'    => 'TikTok',
		'linkedin_url'  => 'LinkedIn',
	);
	$active_socials = array_filter(
		$socials,
		static function ( $label, $key ) {
			return (bool) dkxv4_content( $key );
		},
		ARRAY_FILTER_USE_BOTH
	);
	if ( $active_socials ) :
		?>
		<nav class="dk-social-nav" aria-label="<?php esc_attr_e( 'Social media', 'dk-expressions-v4-fixes' ); ?>">
			<?php foreach ( $active_socials as $key => $label ) : ?>
				<a href="<?php echo esc_url( dkxv4_content_url( $key ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>
	<nav class="dk-footer-nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'dk-expressions-v4-fixes' ); ?>">
		<a href="<?php echo esc_url( dkxv4_content_url( 'footer_insights_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'footer_insights_label' ) ); ?></a>
		<a href="<?php echo esc_url( dkxv4_content_url( 'footer_contact_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'footer_contact_label' ) ); ?></a>
		<a href="<?php echo esc_url( dkxv4_content_url( 'footer_privacy_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'footer_privacy_label' ) ); ?></a>
		<a class="back-footer" href="#top"><?php echo esc_html( dkxv4_content( 'footer_back_label' ) ); ?> ↑</a>
	</nav>
	<small>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( dkxv4_content( 'copyright_text' ) ); ?></small>
</footer>
<?php wp_footer(); ?>
</body>
</html>
