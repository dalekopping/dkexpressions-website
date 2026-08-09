<?php
/**
 * DK Expressions Insights — complete published editorial archive.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();

$paged = max( 1, absint( get_query_var( 'paged' ) ), absint( get_query_var( 'page' ) ) );
$args  = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 18,
	'paged'               => $paged,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => false,
);

if ( is_category() ) {
	$args['cat'] = get_queried_object_id();
} elseif ( is_tag() ) {
	$args['tag_id'] = get_queried_object_id();
} elseif ( is_author() ) {
	$args['author'] = get_queried_object_id();
} elseif ( is_date() ) {
	$args['year']     = absint( get_query_var( 'year' ) );
	$args['monthnum'] = absint( get_query_var( 'monthnum' ) );
	$args['day']      = absint( get_query_var( 'day' ) );
}

$stories      = new WP_Query( $args );
$total_posts  = (int) $stories->found_posts;
$total_pages  = max( 1, (int) $stories->max_num_pages );
$archive_name = is_home() || is_page( 'insights' ) ? 'All Insights' : wp_strip_all_tags( get_the_archive_title() );
$categories   = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);

$category_tones = array(
	'entertainment'     => array( '#ff2d78', '#48102b' ),
	'celebrities'       => array( '#ff4fa3', '#44132f' ),
	'news'              => array( '#ff4b35', '#46150f' ),
	'reviews'           => array( '#a970ff', '#28164a' ),
	'technology'        => array( '#00d8ff', '#063c48' ),
	'events'            => array( '#2da9ff', '#0a3150' ),
	'music'             => array( '#b9ef35', '#30420a' ),
	'lifestyle'         => array( '#ffc247', '#49320a' ),
	'theatre'           => array( '#8a7dff', '#27224c' ),
	'sport'             => array( '#38df8b', '#0c422a' ),
	'motoring'          => array( '#ff873d', '#4b260c' ),
	'film-animation'    => array( '#ffcf4a', '#49370b' ),
	'movies-videos'     => array( '#ffcf4a', '#49370b' ),
	'people-blogs'      => array( '#56d6c9', '#123f3b' ),
	'press'             => array( '#66a7ff', '#18345d' ),
);

function dkxv4_insight_tone( $slug, $tones ) {
	if ( isset( $tones[ $slug ] ) ) {
		return $tones[ $slug ];
	}
	foreach ( $tones as $key => $tone ) {
		if ( str_contains( $slug, $key ) || str_contains( $key, $slug ) ) {
			return $tone;
		}
	}
	return array( '#2da9ff', '#0a3150' );
}
?>
<section class="dk-page-hero dk-insights-hero">
	<div class="dk-stars" aria-hidden="true"></div>
	<div class="dk-page-ring" aria-hidden="true"></div>
	<div class="dk-page-copy">
		<p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'insights_hero_kicker' ) ); ?></p>
		<h1><?php echo esc_html( dkxv4_content( 'insights_hero_title_1' ) ); ?><em><?php echo esc_html( dkxv4_content( 'insights_hero_title_2' ) ); ?></em></h1>
		<p><?php echo esc_html( dkxv4_content( 'insights_hero_text' ) ); ?></p>
	</div>
</section>

<section class="dk-insights">
	<header class="dk-insights-heading">
		<div>
			<p class="dk-kicker">The DK Expressions editorial universe</p>
			<h2><?php echo esc_html( $archive_name ); ?></h2>
		</div>
		<p><strong><?php echo esc_html( number_format_i18n( $total_posts ) ); ?></strong> published stories spanning entertainment, culture, technology, events and the moments shaping our world.</p>
	</header>

	<nav class="dk-insights-categories" aria-label="<?php esc_attr_e( 'Browse insight categories', 'dk-expressions-v4-fixes' ); ?>">
		<a class="<?php echo ( is_home() || is_page( 'insights' ) ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" style="--cat-accent:#fff;--cat-deep:#28313a">All stories</a>
		<?php foreach ( $categories as $category ) :
			$tone = dkxv4_insight_tone( $category->slug, $category_tones );
			?>
			<a class="<?php echo is_category( $category->term_id ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" style="--cat-accent:<?php echo esc_attr( $tone[0] ); ?>;--cat-deep:<?php echo esc_attr( $tone[1] ); ?>">
				<?php echo esc_html( $category->name ); ?><span><?php echo esc_html( number_format_i18n( $category->count ) ); ?></span>
			</a>
		<?php endforeach; ?>
	</nav>

	<div class="dk-insights-grid">
		<?php if ( $stories->have_posts() ) :
			$card_index = 0;
			while ( $stories->have_posts() ) :
				$stories->the_post();
				$post_categories = get_the_category();
				$primary         = $post_categories ? $post_categories[0] : null;
				$category_slug   = $primary ? $primary->slug : 'story';
				$category_name   = $primary ? $primary->name : 'Story';
				$tone            = dkxv4_insight_tone( $category_slug, $category_tones );
				$is_lead         = 1 === $paged && 0 === $card_index;
				?>
				<article <?php post_class( 'dk-insight-card category-' . sanitize_html_class( $category_slug ) . ( $is_lead ? ' is-lead' : '' ) ); ?> style="--cat-accent:<?php echo esc_attr( $tone[0] ); ?>;--cat-deep:<?php echo esc_attr( $tone[1] ); ?>">
					<a href="<?php the_permalink(); ?>">
						<div class="dk-insight-media">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( $is_lead ? 'large' : 'medium_large', array( 'loading' => $is_lead ? 'eager' : 'lazy', 'alt' => get_the_title() ) ); ?>
							<?php else : ?>
								<span aria-hidden="true">DK</span>
							<?php endif; ?>
						</div>
						<div class="dk-insight-copy">
							<div class="dk-insight-meta">
								<span class="dk-insight-category"><?php echo esc_html( $category_name ); ?></span>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></time>
							</div>
							<?php if ( is_sticky() ) : ?><strong class="dk-insight-featured">Featured story</strong><?php endif; ?>
							<h3><?php the_title(); ?></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), $is_lead ? 32 : 20, '…' ) ); ?></p>
							<span class="dk-insight-read">Read the story ↗</span>
						</div>
					</a>
				</article>
				<?php
				$card_index++;
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<p class="dk-insights-empty"><?php esc_html_e( 'No published stories were found in this section.', 'dk-expressions-v4-fixes' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $total_pages > 1 ) : ?>
		<nav class="dk-insights-pagination" aria-label="<?php esc_attr_e( 'Insights pages', 'dk-expressions-v4-fixes' ); ?>">
			<?php
			echo wp_kses_post(
				paginate_links(
					array(
						'total'     => $total_pages,
						'current'   => $paged,
						'type'      => 'list',
						'prev_text' => '← Newer',
						'next_text' => 'Older →',
					)
				)
			);
			?>
		</nav>
	<?php endif; ?>
</section>
<?php get_footer(); ?>
