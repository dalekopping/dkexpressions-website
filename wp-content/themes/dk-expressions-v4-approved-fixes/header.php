<?php
/**
 * Approved site header and navigation.
 *
 * @package DK_Expressions_V4_Fixes
 */
$current_path = trim( wp_parse_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) ), PHP_URL_PATH ), '/' );
$menu_items = array(
	'Home'       => '/home/',
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
	<style id="dkx-global-fixed-header">
		/* Global navigation lock: the DK navigation remains at the top on every page. */
		.dk-header{
			position:fixed!important;
			top:0!important;
			left:0!important;
			right:0!important;
			z-index:10000!important;
			background:rgba(2,5,10,.97)!important;
			border-bottom:1px solid rgba(67,174,255,.22)!important;
			backdrop-filter:blur(16px);
			-webkit-backdrop-filter:blur(16px);
		}
		body.admin-bar .dk-header{top:32px!important;}
		@media(max-width:782px){body.admin-bar .dk-header{top:46px!important;}}
		.dk-header.is-stuck{position:fixed!important;}
	</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dk-expressions-v4-fixes' ); ?></a>
<span id="top" class="screen-reader-text" aria-hidden="true"></span>
<header class="dk-header" id="dk-header">
	<a class="dk-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'DK Expressions landing page', 'dk-expressions-v4-fixes' ); ?>">
		<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" data-dkx-global-media="logo">
	</a>
	<nav class="dk-nav" id="dk-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'dk-expressions-v4-fixes' ); ?>">
		<ul class="dk-nav-menu">
			<?php foreach ( $menu_items as $label => $path ) : ?>
				<?php $active = str_contains( '/' . $current_path . '/', trim( $path, '/' ) ); ?>
				<li><a href="<?php echo esc_url( str_starts_with( $path, '/' ) ? home_url( $path ) : $path ); ?>"<?php echo $active ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $label ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<a class="dk-header-cta" href="<?php echo esc_url( dkxv4_content_url( 'header_cta_url' ) ); ?>"><?php echo esc_html( dkxv4_content( 'header_cta_label' ) ); ?> <span>↗</span></a>
	<button class="dk-menu-toggle" type="button" aria-controls="dk-nav" aria-expanded="false"><span></span><span></span><span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'dk-expressions-v4-fixes' ); ?></span></button>
</header>
<main id="primary">