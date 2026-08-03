<?php
/**
 * Giveaways and competitions hub.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
$giveaways = new WP_Query(
	array(
		'post_type'           => 'dkx_giveaway',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
$grouped = array( 'open' => array(), 'upcoming' => array(), 'closed' => array() );
foreach ( $giveaways->posts as $giveaway ) {
	$grouped[ dkxv4_giveaway_status( $giveaway->ID ) ][] = $giveaway;
}
usort(
	$grouped['open'],
	static function ( $a, $b ) {
		return (int) get_post_meta( $b->ID, '_dkx_featured', true ) <=> (int) get_post_meta( $a->ID, '_dkx_featured', true );
	}
);
?>
<section class="dk-giveaways-hero" id="top"><div class="dk-stars" aria-hidden="true"></div><div class="dk-giveaway-rings" aria-hidden="true"></div><div class="dk-giveaways-hero-copy"><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'giveaways_kicker' ) ); ?></p><h1><?php echo esc_html( dkxv4_content( 'giveaways_title_1' ) ); ?><em><?php echo esc_html( dkxv4_content( 'giveaways_title_2' ) ); ?></em></h1><p><?php echo esc_html( dkxv4_content( 'giveaways_intro' ) ); ?></p><a class="dk-button" href="#open-competitions">See what you can win ↓</a></div></section>
<div class="dk-giveaways-page">
	<section class="dk-giveaway-group" id="open-competitions"><div class="dk-giveaway-heading"><p class="dk-kicker">Enter now</p><h2><?php echo esc_html( dkxv4_content( 'giveaways_open_heading' ) ); ?></h2><span><?php echo esc_html( count( $grouped['open'] ) ); ?> live</span></div>
		<?php if ( $grouped['open'] ) : ?><div class="dk-giveaway-grid"><?php foreach ( $grouped['open'] as $giveaway ) { dkxv4_giveaway_card( $giveaway->ID, (bool) get_post_meta( $giveaway->ID, '_dkx_featured', true ) ); } ?></div><?php else : ?><div class="dk-giveaway-empty"><h3>The portal is preparing its next prize.</h3><p>There are no open competitions right now. Follow DK Expressions and return soon.</p></div><?php endif; ?>
	</section>
	<?php if ( $grouped['upcoming'] ) : ?><section class="dk-giveaway-group"><div class="dk-giveaway-heading"><p class="dk-kicker">On the horizon</p><h2><?php echo esc_html( dkxv4_content( 'giveaways_upcoming_heading' ) ); ?></h2></div><div class="dk-giveaway-grid"><?php foreach ( $grouped['upcoming'] as $giveaway ) { dkxv4_giveaway_card( $giveaway->ID ); } ?></div></section><?php endif; ?>
	<?php if ( $grouped['closed'] ) : ?><section class="dk-giveaway-group dk-past-giveaways"><div class="dk-giveaway-heading"><p class="dk-kicker">The archive</p><h2><?php echo esc_html( dkxv4_content( 'giveaways_closed_heading' ) ); ?></h2></div><div class="dk-giveaway-grid"><?php foreach ( array_slice( $grouped['closed'], 0, 6 ) as $giveaway ) { dkxv4_giveaway_card( $giveaway->ID ); } ?></div></section><?php endif; ?>
	<p class="dk-giveaway-disclaimer"><?php echo esc_html( dkxv4_content( 'giveaways_disclaimer' ) ); ?></p>
</div>
<?php get_footer(); ?>
