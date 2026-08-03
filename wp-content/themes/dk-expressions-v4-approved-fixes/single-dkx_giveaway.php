<?php
/**
 * Individual giveaway page.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
while ( have_posts() ) : the_post();
	$post_id     = get_the_ID();
	$status      = dkxv4_giveaway_status( $post_id );
	$prize       = get_post_meta( $post_id, '_dkx_prize', true );
	$quantity    = get_post_meta( $post_id, '_dkx_quantity', true );
	$sponsor     = get_post_meta( $post_id, '_dkx_sponsor', true );
	$eligibility = get_post_meta( $post_id, '_dkx_eligibility', true );
	$winners     = get_post_meta( $post_id, '_dkx_winners', true );
	$entry_url   = get_post_meta( $post_id, '_dkx_entry_url', true );
	$entry_label = get_post_meta( $post_id, '_dkx_entry_label', true ) ?: 'Enter now';
	$shortcode   = get_post_meta( $post_id, '_dkx_form_shortcode', true );
	$winner_note = get_post_meta( $post_id, '_dkx_winner_notice', true );
	$start       = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_start', true ) );
	$end         = dkxv4_giveaway_timestamp( get_post_meta( $post_id, '_dkx_end', true ) );
	$image       = get_the_post_thumbnail_url( $post_id, 'full' );
	?>
	<article class="dk-giveaway-single">
		<header class="dk-giveaway-single-hero<?php echo $image ? ' has-image' : ''; ?>"<?php echo $image ? ' style="background-image:url(' . esc_url( $image ) . ')"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><div class="dk-giveaway-single-copy"><p class="dk-kicker">DK Expressions giveaway</p><span class="dk-giveaway-status"><?php echo esc_html( ucfirst( $status ) ); ?></span><h1><?php the_title(); ?></h1><?php if ( $prize ) : ?><p class="dk-single-prize"><?php echo esc_html( $prize ); ?></p><?php endif; ?><?php if ( 'open' === $status && $end ) : ?><div class="dk-countdown" data-countdown="<?php echo esc_attr( wp_date( 'c', $end, wp_timezone() ) ); ?>"><span>Calculating time remaining…</span></div><?php endif; ?></div></header>
		<div class="dk-giveaway-single-layout">
			<div class="dk-giveaway-description"><p class="dk-kicker">The opportunity</p><?php the_content(); ?></div>
			<aside class="dk-giveaway-facts"><h2>Competition details</h2><?php if ( $prize ) : ?><div><small>Prize</small><strong><?php echo esc_html( $prize ); ?></strong></div><?php endif; ?><?php if ( $quantity ) : ?><div><small>Items available</small><strong><?php echo esc_html( $quantity ); ?></strong></div><?php endif; ?><?php if ( $sponsor ) : ?><div><small>Partner</small><strong><?php echo esc_html( $sponsor ); ?></strong></div><?php endif; ?><?php if ( $start ) : ?><div><small>Starts</small><strong><?php echo esc_html( wp_date( 'j F Y, H:i', $start, wp_timezone() ) ); ?></strong></div><?php endif; ?><?php if ( $end ) : ?><div><small>Ends</small><strong><?php echo esc_html( wp_date( 'j F Y, H:i', $end, wp_timezone() ) ); ?></strong></div><?php endif; ?><?php if ( $winners ) : ?><div><small>Winners</small><strong><?php echo esc_html( $winners ); ?></strong></div><?php endif; ?><?php if ( $eligibility ) : ?><div><small>Eligibility</small><strong><?php echo esc_html( $eligibility ); ?></strong></div><?php endif; ?></aside>
		</div>
		<section class="dk-giveaway-entry"><p class="dk-kicker"><?php echo 'closed' === $status ? 'Competition update' : 'Enter the experience'; ?></p><h2><?php echo 'closed' === $status ? 'This portal has closed.' : 'Your moment could be next.'; ?></h2><?php if ( 'closed' === $status ) : ?><?php if ( $winner_note ) : ?><p><?php echo nl2br( esc_html( $winner_note ) ); ?></p><?php else : ?><p>Winner information will be published once verification is complete.</p><?php endif; ?><?php elseif ( 'upcoming' === $status ) : ?><p>Entries have not opened yet. Return when the countdown begins.</p><?php elseif ( get_post_meta( $post_id, '_dkx_mechanics', true ) ) : ?><?php dkxv4_render_native_entry_form( $post_id ); ?><?php elseif ( $shortcode ) : ?><?php echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php elseif ( $entry_url ) : ?><a class="dk-button" href="<?php echo esc_url( $entry_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $entry_label ); ?> ↗</a><?php else : ?><p>Entry instructions will be available here shortly.</p><?php endif; ?></section>
		<nav class="dk-giveaway-back"><a href="<?php echo esc_url( home_url( '/giveaways/' ) ); ?>">← View all giveaways</a></nav>
	</article>
	<?php
endwhile;
get_footer();
