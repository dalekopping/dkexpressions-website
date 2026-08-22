<?php
/**
 * Shared high-impact booking availability strip.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<aside class="dkx-booking-pulse dk-no-semantic-highlight" aria-label="Current DK Expressions booking availability">
	<div class="dkx-booking-pulse__inner">
		<p class="dkx-booking-pulse__booking">
			<i aria-hidden="true"></i>
			<span><?php echo esc_html( dkxv4_page_meta( 'booking_label', 'Currently booking' ) ); ?></span>
			<strong><?php echo esc_html( dkxv4_page_meta( 'booking_period', 'Q3 & Q4' ) ); ?></strong>
		</p>
		<span class="dkx-booking-pulse__divider" aria-hidden="true"></span>
		<p class="dkx-booking-pulse__slots">
			<span><?php echo esc_html( dkxv4_page_meta( 'booking_only', 'Only' ) ); ?></span>
			<strong><?php echo esc_html( dkxv4_page_meta( 'booking_count', '5' ) ); ?></strong>
			<span><?php echo esc_html( dkxv4_page_meta( 'booking_slots', 'retainer slots left for' ) ); ?></span>
			<b><?php echo esc_html( dkxv4_page_meta( 'booking_months', 'September–October' ) ); ?></b>
		</p>
	</div>
</aside>
