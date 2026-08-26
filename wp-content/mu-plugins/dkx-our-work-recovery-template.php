<?php
/**
 * Recovery wrapper for the approved Our Work / Time Vault archive experience.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$dkxv4_work_preview = function_exists( 'dkxv4_work_preview_key' ) ? dkxv4_work_preview_key() : '';
$dkxv4_show_work_switcher = '' !== $dkxv4_work_preview;
$dkxv4_work_preview = $dkxv4_show_work_switcher ? $dkxv4_work_preview : 'archive';

$part = get_stylesheet_directory() . '/template-parts/our-work-options-preview.php';
if ( file_exists( $part ) ) {
	require $part;
} else {
	echo '<main style="min-height:60vh;padding:140px 32px;background:#02070c;color:#fff"><h1>Our Work / The Time Vault</h1><p>The approved archive template is temporarily unavailable.</p></main>';
}

get_footer();
