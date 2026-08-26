<?php
/**
 * Approved site header and navigation.
 *
 * @package DK_Expressions_V4_Fixes
 */
$current_path = trim( wp_parse_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ), PHP_URL_PATH ), '/' );
$menu_items = array(
	'Home'       => '/',
	'Solutions'  => '/solutions/',
	'Our Work'   => '/our-work/',
	'Industries' => '/industries/',
	'Insights'   => '/insights/',
	'About'      => '/about/',
	'Contact'    => '/contact/',
	'Rates'      => '/rates/',
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Spydr Media AskArticle AI Voice & Chat Embed -->
<script
  src="https://ais-pre-l64ahyhci3wck33badk5cz-630662724406.europe-west2.run.app/embed.js"
  data-publisher-id="dk-expressions"
  data-bot-id="goliath"
  async>
</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dk-expressions-v4-fixes' ); ?></a>
<header class="dk-header" id="top">
	<a class="dk-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'DK Expressions home', 'dk-expressions-v4-fixes' ); ?>">
		<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" data-dkx-global-media="logo">
	</a>
	<nav class="dk-nav" id="dk-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'dk-expressions-v4-fixes' ); ?>">
		<ul class="dk-nav-menu">
			<?php foreach ( $menu_items as $label => $path ) : ?>
				<?php $active = '/' === $path ? is_front_page() : str_contains( '/' . $current_path . '/', trim( $path, '/' ) ); ?>
				<li><a href="<?php echo esc_url( str_starts_with( $path, '/' ) ? home_url( $path ) : $path ); ?>"<?php echo $active ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $label ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<a class="dk-header-cta" href="<?php echo esc_url( dkxv4_content_url( 'header_cta_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'header_cta_label' ) ); ?> <span>↗</span></a>
	<button class="dk-menu-toggle" type="button" aria-controls="dk-nav" aria-expanded="false"><span></span><span></span><span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'dk-expressions-v4-fixes' ); ?></span></button>
</header>
<main id="primary">