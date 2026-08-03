<?php
/**
 * Search results.
 *
 * @package DK_Expressions_V4
 */
get_header();
?>
<section class="dk-page-hero"><div class="dk-stars" aria-hidden="true"></div><div class="dk-page-ring" aria-hidden="true"></div><div class="dk-page-copy"><p class="dk-kicker">Search the archive</p><h1>Results for<em><?php echo esc_html( get_search_query() ); ?></em></h1><p>Travel through the DK Expressions editorial archive.</p></div></section>
<section class="dk-archive"><div class="dk-post-grid">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'dk-post-card' ); ?>><a href="<?php the_permalink(); ?>"><div class="dk-post-card-image"><?php the_post_thumbnail( 'dkx-card' ); ?></div><div class="dk-post-card-content"><small><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></small><h2><?php the_title(); ?></h2><?php the_excerpt(); ?></div></a></article>
<?php endwhile; else : ?><p><?php esc_html_e( 'No matching stories were found.', 'dk-expressions-v4' ); ?></p><?php endif; ?>
</div><?php the_posts_pagination(); ?></section>
<?php get_footer(); ?>
