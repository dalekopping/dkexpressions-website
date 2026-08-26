<?php
/**
 * Template Name: DK Expressions Our Work — Time Vault
 * Approved Living Archive renderer.
 */
get_header();

$dkxv4_work_preview = function_exists( 'dkxv4_work_preview_key' ) ? dkxv4_work_preview_key() : '';
$dkxv4_show_work_switcher = '' !== $dkxv4_work_preview;
$dkxv4_work_preview = $dkxv4_show_work_switcher ? $dkxv4_work_preview : 'archive';

require get_stylesheet_directory() . '/template-parts/our-work-options-preview.php';

get_footer();
