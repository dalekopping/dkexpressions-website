<?php
/**
 * Ten-story editorial archive: sticky/featured first, then newest stories.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();

$per_page  = min( 24, max( 1, absint( dkxv4_content( 'archive_posts_count' ) ) ) );
$paged     = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
$all_sticky = array_values( array_filter( array_map( 'absint', (array) get_option( 'sticky_posts', array() ) ) ) );
$context_args = array();
if ( is_category() ) {
	$context_args['cat'] = get_queried_object_id();
} elseif ( is_tag() ) {
	$context_args['tag_id'] = get_queried_object_id();
} elseif ( is_author() ) {
	$context_args['author'] = get_queried_object_id();
} elseif ( is_date() ) {
	$context_args['year']     = absint( get_query_var( 'year' ) );
	$context_args['monthnum'] = absint( get_query_var( 'monthnum' ) );
	$context_args['day']      = absint( get_query_var( 'day' ) );
}

$sticky_ids = array();
if ( $all_sticky ) {
	$sticky_query = new WP_Query(
		array_merge(
			array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => -1,
			'post__in'            => $all_sticky,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'fields'              => 'ids',
			'no_found_rows'       => true,
			),
			$context_args
		)
	);
	$sticky_ids = $sticky_query->posts;
}

$sticky_count = count( $sticky_ids );
$published    = wp_count_posts( 'post' );
$total_posts  = $context_args ? (int) $GLOBALS['wp_query']->found_posts : ( isset( $published->publish ) ? (int) $published->publish : 0 );
$regular_count = max( 0, $total_posts - $sticky_count );
$start        = ( $paged - 1 ) * $per_page;
$page_ids     = array();

if ( $start < $sticky_count ) {
	$page_ids = array_slice( $sticky_ids, $start, $per_page );
}

$remaining = $per_page - count( $page_ids );
if ( $remaining > 0 ) {
	$regular_offset = max( 0, $start - $sticky_count );
	if ( $start < $sticky_count ) {
		$regular_offset = 0;
	}
	$regular_query = new WP_Query(
		array_merge(
			array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $remaining,
			'offset'              => $regular_offset,
			'post__not_in'        => $sticky_ids,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'fields'              => 'ids',
			'no_found_rows'       => true,
			),
			$context_args
		)
	);
	$page_ids = array_merge( $page_ids, $regular_query->posts );
}

$stories = $page_ids ? new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => count( $page_ids ),
		'post__in'            => $page_ids,
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => true,
	)
) : null;

$archive_title = is_home() ? dkxv4_content( 'insights_hero_title_1' ) : get_the_archive_title();
$total_pages   = max( 1, (int) ceil( ( $sticky_count + $regular_count ) / $per_page ) );
?>
<section class="dk-page-hero"><div class="dk-stars" aria-hidden="true"></div><div class="dk-page-ring" aria-hidden="true"></div><div class="dk-page-copy"><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'insights_hero_kicker' ) ); ?></p><h1><?php echo wp_kses_post( $archive_title ); ?><em><?php echo esc_html( dkxv4_content( 'insights_hero_title_2' ) ); ?></em></h1><p><?php echo esc_html( dkxv4_content( 'insights_hero_text' ) ); ?></p></div></section>
<section class="dk-archive"><div class="dk-post-grid">
<?php if ( $stories && $stories->have_posts() ) : ?>
	<?php while ( $stories->have_posts() ) : $stories->the_post(); ?>
		<article <?php post_class( 'dk-post-card' ); ?>><a href="<?php the_permalink(); ?>"><div class="dk-post-card-image"><?php the_post_thumbnail( 'dkx-card' ); ?></div><div class="dk-post-card-content"><?php if ( is_sticky() ) : ?><span class="dk-featured-label">Featured</span><?php endif; ?><small><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></small><h2><?php the_title(); ?></h2><?php the_excerpt(); ?></div></a></article>
	<?php endwhile; wp_reset_postdata(); ?>
<?php else : ?>
	<p><?php esc_html_e( 'No stories found.', 'dk-expressions-v4-fixes' ); ?></p>
<?php endif; ?>
</div>
<?php
echo wp_kses_post(
	paginate_links(
		array(
			'total'   => $total_pages,
			'current' => $paged,
			'type'    => 'list',
		)
	)
);
?>
</section>
<?php get_footer(); ?>
