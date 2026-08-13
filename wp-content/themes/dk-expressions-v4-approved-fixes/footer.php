<?php
/**
 * DK Expressions structured footer.
 *
 * @package DK_Expressions_V4_Fixes
 */
?>
</main>

<a class="dk-back-to-future" href="#top" aria-label="<?php esc_attr_e( 'Back to the top', 'dk-expressions-v4-fixes' ); ?>">
	<strong><?php echo esc_html( dkxv4_content( 'footer_back_label' ) ); ?></strong><span>↑</span>
</a>

<footer class="dk-footer" role="contentinfo">
	<div class="dk-footer-shell">

		<section class="dk-footer-brand-block">
			<a class="dk-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			</a>
			<p><?php echo esc_html( dkxv4_content( 'footer_tagline' ) ); ?></p>
			<a class="dk-footer-project-btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start Your Project ↗</a>
		</section>

		<section class="dk-footer-column">
			<h4>Explore</h4>
			<nav aria-label="<?php esc_attr_e( 'Explore navigation', 'dk-expressions-v4-fixes' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Solutions</a>
				<a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Our Work</a>
				<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
				<a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Insights</a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
				<a href="<?php echo esc_url( home_url( '/legacy/' ) ); ?>">Legacy</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
				<a href="<?php echo esc_url( home_url( '/giveaways/' ) ); ?>">Giveaways</a>
			</nav>
		</section>

		<section class="dk-footer-column">
			<h4>Connect</h4>
			<nav aria-label="<?php esc_attr_e( 'Social media', 'dk-expressions-v4-fixes' ); ?>">
				<?php
				$socials = array(
					'facebook_url'  => 'Facebook',
					'instagram_url' => 'Instagram',
					'x_url'         => 'X',
					'youtube_url'   => 'YouTube',
					'tiktok_url'    => 'TikTok',
					'linkedin_url'  => 'LinkedIn',
				);
				foreach ( $socials as $key => $label ) :
					$url = dkxv4_content( $key );
					if ( $url ) :
				?>
					<a href="<?php echo esc_url( dkxv4_content_url( $key ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
				<?php endif; endforeach; ?>
			</nav>
		</section>

		<section class="dk-footer-column dk-footer-company">
			<h4>DK Expressions</h4>
			<nav aria-label="<?php esc_attr_e( 'DK Expressions navigation', 'dk-expressions-v4-fixes' ); ?>">
				<a href="<?php echo esc_url( dkxv4_content_url( 'footer_contact_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'footer_contact_label' ) ); ?></a>
				<a href="<?php echo esc_url( dkxv4_content_url( 'footer_privacy_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'footer_privacy_label' ) ); ?></a>
				<a class="back-footer" href="#top"><?php echo esc_html( dkxv4_content( 'footer_back_label' ) ); ?> ↑</a>
			</nav>
		</section>

	</div>

	<div class="dk-footer-meta">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( dkxv4_content( 'copyright_text' ) ); ?></span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
