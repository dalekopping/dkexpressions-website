<?php
/**
 * Site header.
 *
 * @package DK_Expressions_V4
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dk-expressions-v4' ); ?></a>
<header class="dk-header" id="dk-header">
	<a class="dk-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'DK Expressions home', 'dk-expressions-v4' ); ?>">
		<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	</a>
	<nav class="dk-nav" id="dk-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'dk-expressions-v4' ); ?>">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'dkx_primary_fallback' ) ); ?>
	</nav>
	<a class="dk-header-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start your project', 'dk-expressions-v4' ); ?> <span>↗</span></a>
	<button class="dk-menu-toggle" type="button" aria-controls="dk-nav" aria-expanded="false"><span></span><span></span><span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'dk-expressions-v4' ); ?></span></button>
</header>
<main id="primary">
