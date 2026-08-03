<?php
/**
 * Site footer.
 *
 * @package DK_Expressions_V4
 */
?>
</main>
<footer class="dk-footer">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
	<p>Freezing Time and Space with the Time Travellers™</p>
	<nav class="dk-footer-nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'dk-expressions-v4' ); ?>">
		<a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Insights</a>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
		<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy</a>
	</nav>
	<small>© <?php echo esc_html( gmdate( 'Y' ) ); ?> DK Expressions. All moments reserved.</small>
</footer>
<?php wp_footer(); ?>
</body>
</html>
