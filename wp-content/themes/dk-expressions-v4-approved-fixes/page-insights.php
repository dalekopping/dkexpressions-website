<?php
/**
 * Insights page with non-destructive editorial design previews.
 *
 * Template Name: DK Expressions Insights
 * @package DK_Expressions_V4_Fixes
 */

$insights_preview = function_exists( 'dkxv4_insights_preview_key' ) ? dkxv4_insights_preview_key() : '';

if ( '' !== $insights_preview ) {
	get_header();
	get_template_part( 'template-parts/insights-options-preview', null, array( 'preview' => $insights_preview ) );
	get_footer();
	return;
}

require get_stylesheet_directory() . '/archive.php';
