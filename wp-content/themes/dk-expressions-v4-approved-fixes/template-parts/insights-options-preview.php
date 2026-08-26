<?php
/**
 * Locked DK Expressions Insights archive — v1.23.6.
 *
 * Editorial Spectrum hero + Timecode category stream.
 *
 * @package DK_Expressions_V4_Fixes
 */

defined( 'ABSPATH' ) || exit;

$press_parent = get_category_by_slug( 'press' );
if ( ! $press_parent ) {
	$press_parent = get_term_by( 'name', 'Press', 'category' );
}
$press_parent_id = $press_parent && ! is_wp_error( $press_parent ) ? (int) $press_parent->term_id : 0;
$categories      = $press_parent_id
	? get_categories(
		array(
			'hide_empty' => true,
			'parent'     => $press_parent_id,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	)
	: array();
$allowed_category_ids = array_fill_keys( array_map( 'intval', wp_list_pluck( $categories, 'term_id' ) ), true );

/* Each live category owns one distinct signal colour. */
$signal_palette = array(
	'#43baff', '#ff536d', '#9b7cff', '#2ad6c9', '#ffc857', '#ff914d',
	'#7ee787', '#f472b6', '#60a5fa', '#c084fc', '#fb7185', '#22d3ee',
	'#a3e635', '#facc15', '#38bdf8', '#e879f9', '#34d399', '#f97316',
);
$category_signals = array();
foreach ( $categories as $category_index => $category ) {
	$category_signals[ (int) $category->term_id ] = isset( $signal_palette[ $category_index ] )
		? $signal_palette[ $category_index ]
		: sprintf( 'hsl(%d 86%% 64%%)', ( $category_index * 137 ) % 360 );
}

$wpdb               = $GLOBALS['wpdb'];
$yoast_primary_rows = $wpdb->get_results(
	$wpdb->prepare(
		"SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s",
		'_yoast_wpseo_primary_category'
	),
	ARRAY_A
);
$yoast_primary_categories = array();
foreach ( $yoast_primary_rows as $yoast_primary_row ) {
	$yoast_primary_categories[ (int) $yoast_primary_row['post_id'] ] = (int) $yoast_primary_row['meta_value'];
}

$primary_category_for = static function ( $post_id ) use ( $yoast_primary_categories, $allowed_category_ids ) {
	$post_categories = get_the_category( $post_id );
	$post_categories = array_values(
		array_filter(
			$post_categories,
			static function ( $post_category ) use ( $allowed_category_ids ) {
				return isset( $allowed_category_ids[ (int) $post_category->term_id ] );
			}
		)
	);
	if ( ! $post_categories ) {
		return null;
	}

	$yoast_primary = isset( $yoast_primary_categories[ (int) $post_id ] ) ? $yoast_primary_categories[ (int) $post_id ] : 0;
	if ( $yoast_primary ) {
		foreach ( $post_categories as $post_category ) {
			if ( $yoast_primary === (int) $post_category->term_id ) {
				return $post_category;
			}
		}
	}

	return $post_categories[0];
};

/* Sticky posts are physically separated from the category feeds. */
$configured_sticky_ids = array_filter( array_map( 'absint', (array) get_option( 'sticky_posts', array() ) ) );
$sticky_story_ids       = array();
if ( $configured_sticky_ids ) {
	$candidate_sticky_ids = get_posts(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'post__in'            => $configured_sticky_ids,
			'posts_per_page'      => -1,
			'fields'              => 'ids',
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
		)
	);
	if ( $candidate_sticky_ids ) {
		update_object_term_cache( $candidate_sticky_ids, 'post' );
	}
	foreach ( $candidate_sticky_ids as $candidate_sticky_id ) {
		if ( $primary_category_for( $candidate_sticky_id ) ) {
			$sticky_story_ids[] = (int) $candidate_sticky_id;
		}
	}
}

/*
 * Build four-card category chapters from the full archive. Each post resolves
 * to one primary category only and can therefore never repeat on this page.
 */
$regular_story_ids = get_posts(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'fields'              => 'ids',
		'orderby'             => 'date',
		'order'               => 'DESC',
		'post__not_in'        => $sticky_story_ids,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( $regular_story_ids ) {
	update_object_term_cache( $regular_story_ids, 'post' );
}

$category_stories = array();
foreach ( $categories as $category ) {
	$category_stories[ (int) $category->term_id ] = array();
}

$assigned_story_ids = array_fill_keys( $sticky_story_ids, true );
foreach ( $regular_story_ids as $story_id ) {
	$story_id = (int) $story_id;
	if ( isset( $assigned_story_ids[ $story_id ] ) ) {
		continue;
	}

	$primary = $primary_category_for( $story_id );
	if ( ! $primary ) {
		continue;
	}

	$category_id = (int) $primary->term_id;
	if ( ! isset( $category_stories[ $category_id ] ) || count( $category_stories[ $category_id ] ) >= 4 ) {
		continue;
	}

	$category_stories[ $category_id ][] = $story_id;
	$assigned_story_ids[ $story_id ]     = true;
}

/* Fill any quieter category from an eligible secondary category, still once only. */
foreach ( $regular_story_ids as $story_id ) {
	$story_id = (int) $story_id;
	if ( isset( $assigned_story_ids[ $story_id ] ) ) {
		continue;
	}

	foreach ( get_the_category( $story_id ) as $eligible_category ) {
		$eligible_id = (int) $eligible_category->term_id;
		if ( isset( $category_stories[ $eligible_id ] ) && count( $category_stories[ $eligible_id ] ) < 4 ) {
			$category_stories[ $eligible_id ][] = $story_id;
			$assigned_story_ids[ $story_id ]     = true;
			break;
		}
	}
}
?>
<main class="dkxoi dkxoi--locked dk-no-semantic-highlight">
	<section class="dkxoi-hero dkxoi-spectrum-hero">
		<div class="dk-stars" aria-hidden="true"></div>
		<div class="dkxoi-hero-brand" aria-hidden="true">
			<span>INSIGHTS</span>
			<img src="<?php echo esc_url( dkx_logo_url() ); ?>" alt="">
		</div>
		<div class="dkxoi-spectrum-lines" aria-hidden="true"><i></i><i></i><i></i></div>
		<div class="dkxoi-hero-copy">
			<p class="dkxoi-eyebrow"><?php echo esc_html( dkxv4_content( 'insights_hero_kicker' ) ); ?></p>
			<h1><?php echo esc_html( dkxv4_content( 'insights_hero_title_1' ) ); ?><em><?php echo esc_html( dkxv4_content( 'insights_hero_title_2' ) ); ?></em></h1>
			<p><?php echo esc_html( dkxv4_content( 'insights_hero_text' ) ); ?></p>
		</div>
	</section>

	<section class="dkxoi-archive">
		<header class="dkxoi-heading">
			<p class="dkxoi-eyebrow">The DK Expressions editorial universe</p>
			<h2>All Insights</h2>
		</header>

		<nav class="dkxoi-categories" aria-label="<?php esc_attr_e( 'Browse insight categories', 'dk-expressions-v4-fixes' ); ?>">
			<a class="is-active" href="#category-streams" style="--cat-accent:#ffffff">All stories</a>
			<?php foreach ( $categories as $category ) : ?>
				<?php if ( empty( $category_stories[ (int) $category->term_id ] ) ) { continue; } ?>
				<a href="#category-<?php echo esc_attr( $category->slug ); ?>" style="--cat-accent:<?php echo esc_attr( $category_signals[ (int) $category->term_id ] ); ?>">
					<?php echo esc_html( $category->name ); ?><span><?php echo esc_html( number_format_i18n( $category->count ) ); ?></span>
				</a>
			<?php endforeach; ?>
		</nav>

		<?php if ( $sticky_story_ids ) : ?>
		<section class="dkxoi-featured">
			<header class="dkxoi-section-head">
				<div><p class="dkxoi-eyebrow">Sticky / Featured</p><h2>Pinned to<br><em>the signal.</em></h2></div>
				<p>The stories currently held at the top of the DK Expressions editorial universe.</p>
			</header>
			<div class="dkxoi-slider" data-dkxi-slider>
				<div class="dkxoi-slider-viewport">
					<div class="dkxoi-slider-track">
						<?php foreach ( $sticky_story_ids as $sticky_index => $story_id ) :
							$primary       = $primary_category_for( $story_id );
							$category_id   = $primary ? (int) $primary->term_id : 0;
							$category_name = $primary ? $primary->name : 'Story';
							$signal        = isset( $category_signals[ $category_id ] ) ? $category_signals[ $category_id ] : '#43baff';
							?>
							<article class="dkxoi-slide" style="--cat-accent:<?php echo esc_attr( $signal ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Featured story %1$d of %2$d', $sticky_index + 1, count( $sticky_story_ids ) ) ); ?>">
								<a href="<?php echo esc_url( get_permalink( $story_id ) ); ?>">
									<div class="dkxoi-slide-media">
										<?php if ( has_post_thumbnail( $story_id ) ) : ?>
											<?php echo get_the_post_thumbnail( $story_id, 'large', array( 'loading' => 0 === $sticky_index ? 'eager' : 'lazy', 'alt' => get_the_title( $story_id ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<?php else : ?><span aria-hidden="true">DK</span><?php endif; ?>
									</div>
									<div class="dkxoi-slide-copy">
										<div class="dkxoi-meta"><span><?php echo esc_html( $category_name ); ?></span><time datetime="<?php echo esc_attr( get_the_date( 'c', $story_id ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y', $story_id ) ); ?></time></div>
										<b>Featured story</b>
										<h3><?php echo esc_html( get_the_title( $story_id ) ); ?></h3>
										<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $story_id ), 34, '…' ) ); ?></p>
										<span>Read the story ↗</span>
									</div>
								</a>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
				<?php if ( count( $sticky_story_ids ) > 1 ) : ?>
				<div class="dkxoi-slider-controls">
					<button type="button" data-dkxi-prev aria-label="Previous featured story">←</button>
					<span data-dkxi-status>01 / <?php echo esc_html( str_pad( (string) count( $sticky_story_ids ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="dkxoi-slider-progress"><i data-dkxi-progress></i></div>
					<button type="button" data-dkxi-next aria-label="Next featured story">→</button>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<?php endif; ?>

		<section class="dkxoi-streams" id="category-streams">
			<header class="dkxoi-section-head dkxoi-streams-intro">
				<div><p class="dkxoi-eyebrow">Category Streams</p><h2>Every signal.<br><em>One clear channel.</em></h2></div>
				<p>Four recent stories per category. Every post appears once, even when it carries multiple tags or categories.</p>
			</header>

			<div class="dkxoi-timeline">
				<?php $visible_category_index = 0; ?>
				<?php foreach ( $categories as $category ) :
					$category_id = (int) $category->term_id;
					$stories     = $category_stories[ $category_id ];
					if ( empty( $stories ) ) {
						continue;
					}
					$visible_category_index++;
					$signal = $category_signals[ $category_id ];
					?>
					<section class="dkxoi-channel" id="category-<?php echo esc_attr( $category->slug ); ?>" style="--cat-accent:<?php echo esc_attr( $signal ); ?>">
						<div class="dkxoi-channel-time" aria-hidden="true"><?php echo esc_html( str_pad( (string) $visible_category_index, 2, '0', STR_PAD_LEFT ) ); ?></div>
						<header class="dkxoi-channel-head">
							<div><p>Editorial channel / <?php echo esc_html( str_pad( (string) $visible_category_index, 2, '0', STR_PAD_LEFT ) ); ?></p><h2><?php echo esc_html( $category->name ); ?></h2></div>
							<span><?php echo esc_html( number_format_i18n( $category->count ) ); ?> published stories</span>
						</header>

						<div class="dkxoi-channel-grid">
							<?php foreach ( $stories as $story_index => $story_id ) : ?>
								<article class="dkxoi-card" style="--story-index:'<?php echo esc_attr( str_pad( (string) ( $story_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>'">
									<a href="<?php echo esc_url( get_permalink( $story_id ) ); ?>">
										<div class="dkxoi-card-media">
											<?php if ( has_post_thumbnail( $story_id ) ) : ?>
												<?php echo get_the_post_thumbnail( $story_id, 'medium_large', array( 'loading' => 'lazy', 'alt' => get_the_title( $story_id ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<?php else : ?><span aria-hidden="true">DK</span><?php endif; ?>
										</div>
										<div class="dkxoi-card-copy">
											<div class="dkxoi-meta"><span><?php echo esc_html( $category->name ); ?></span><time datetime="<?php echo esc_attr( get_the_date( 'c', $story_id ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y', $story_id ) ); ?></time></div>
											<h3><?php echo esc_html( get_the_title( $story_id ) ); ?></h3>
											<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $story_id ), 18, '…' ) ); ?></p>
											<span>Read the story ↗</span>
									</div>
								</a>
							</article>
						<?php endforeach; ?>
					</div>

					<a class="dkxoi-see-more" href="<?php echo esc_url( get_category_link( $category_id ) ); ?>">See more <?php echo esc_html( $category->name ); ?> stories <span>→</span></a>
				</section>
			<?php endforeach; ?>
		</div>
	</section>
	</section>
</main>
<?php wp_reset_postdata(); ?>
