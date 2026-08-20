<?php
/**
 * Template Name: DK Expressions Industries — Infinity Switchboard
 * v1.23.2
 */
get_header();
get_template_part(
	'template-parts/industries-options-preview',
	null,
	array(
		'preview' => 'switchboard',
		'locked'  => true,
	)
);
get_footer();
