<?php
/**
 * Three original-copy Insights page previews — v1.23.4.
 *
 * @package DK_Expressions_V4_Fixes
 */

defined( 'ABSPATH' ) || exit;

$preview = isset( $args['preview'] ) ? sanitize_key( $args['preview'] ) : 'cinematic-grid';
$preview = in_array( $preview, array( 'cinematic-grid', 'editorial-spectrum', 'timecode-stream' ), true ) ? $preview : 'cinematic-grid';
$paged   = max( 1, absint( get_query_var( 'paged' ) ), absint( get_query_var( 'page' ) ) );

$preview_names = array(
	'cinematic-grid'     => 'Cinematic Grid',
	'editorial-spectrum' => 'Editorial Spectrum',
	'timecode-stream'    => 'Timecode Stream',
);

$categories = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);

/* Every category receives its own signal colour; no two visible categories repeat. */
$signal_palette = array(
	'#43baff', '#ff536d', '#9b7cff', '#2ad6c9', '#ffc857', '#ff914d',
	'#7ee787', '#f472b6', '#60a5fa', '#c084fc', '#fb7185', '#22d3ee',
	'#a3e635', '#facc15', '#38bdf8', '#e879f9', '#34d399', '#f97316',
);
$category_signals = array();
foreach ( $categories as $category_index => $category ) {
	if ( isset( $signal_palette[ $category_index ] ) ) {
		$signal = $signal_palette[ $category_index ];
	} else {
		$signal = sprintf( 'hsl(%d 86%% 64%%)', ( $category_index * 137 ) % 360 );
	}
	$category_signals[ (int) $category->term_id ] = $signal;
}

$configured_sticky_ids = array_filter( array_map( 'absint', (array) get_option( 'sticky_posts', array() ) ) );
$published_sticky_ids  = array();
if ( $configured_sticky_ids ) {
	$published_sticky_ids = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'post__in'       => $configured_sticky_ids,
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);
}

$regular_stories = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 18,
		'paged'               => $paged,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'post__not_in'        => $published_sticky_ids,
		'ignore_sticky_posts' => true,
	)
);

$story_ids = array();
if ( 1 === $paged ) {
	$story_ids = $published_sticky_ids;
}
$story_ids   = array_values( array_unique( array_merge( $story_ids, wp_list_pluck( $regular_stories->posts, 'ID' ) ) ) );
$total_posts = count( $published_sticky_ids ) + (int) $regular_stories->found_posts;
$total_pages = max( 1, (int) $regular_stories->max_num_pages );

$primary_category_for = static function ( $post_id ) {
	$post_categories = get_the_category( $post_id );
	if ( empty( $post_categories ) ) {
		return null;
	}

	$yoast_primary = absint( get_post_meta( $post_id, '_yoast_wpseo_primary_category', true ) );
	if ( $yoast_primary ) {
		foreach ( $post_categories as $post_category ) {
			if ( $yoast_primary === (int) $post_category->term_id ) {
				return $post_category;
			}
		}
	}

	return $post_categories[0];
};

?>
<main class="dkxoi dkxoi--<?php echo esc_attr( $preview ); ?>">
	<section class="dkxoi-hero dk-page-hero dk-insights-hero">
		<div class="dk-stars" aria-hidden="true"></div>
		<div class="dkxoi-orbit" aria-hidden="true"><i></i><i></i><i></i></div>
		<div class="dkxoi-hero-index" aria-hidden="true">DK / INSIGHTS</div>
		<div class="dkxoi-hero-copy dk-page-copy">
			<p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'insights_hero_kicker' ) ); ?></p>
			<h1><?php echo esc_html( dkxv4_content( 'insights_hero_title_1' ) ); ?><em><?php echo esc_html( dkxv4_content( 'insights_hero_title_2' ) ); ?></em></h1>
			<p><?php echo esc_html( dkxv4_content( 'insights_hero_text' ) ); ?></p>
		</div>
	</section>

	<section class="dkxoi-archive">
		<header class="dkxoi-heading">
			<div>
				<p class="dk-kicker">The DK Expressions editorial universe</p>
				<h2>All Insights</h2>
			</div>
			<p><strong><?php echo esc_html( number_format_i18n( $total_posts ) ); ?></strong> published stories spanning entertainment, culture, technology, events and the moments shaping our world.</p>
		</header>

		<nav class="dkxoi-categories" aria-label="<?php esc_attr_e( 'Browse insight categories', 'dk-expressions-v4-fixes' ); ?>">
			<a class="is-active" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" style="--cat-accent:#ffffff">All stories</a>
			<?php foreach ( $categories as $category ) : ?>
				<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" style="--cat-accent:<?php echo esc_attr( $category_signals[ (int) $category->term_id ] ); ?>">
					<?php echo esc_html( $category->name ); ?><span><?php echo esc_html( number_format_i18n( $category->count ) ); ?></span>
				</a>
			<?php endforeach; ?>
		</nav>

		<div class="dkxoi-stories">
			<?php if ( $story_ids ) : ?>
				<?php foreach ( $story_ids as $card_index => $story_id ) :
					$story          = get_post( $story_id );
					$primary        = $primary_category_for( $story_id );
					$category_id    = $primary ? (int) $primary->term_id : 0;
					$category_slug  = $primary ? $primary->slug : 'story';
					$category_name  = $primary ? $primary->name : 'Story';
					$signal         = isset( $category_signals[ $category_id ] ) ? $category_signals[ $category_id ] : '#43baff';
					$is_lead        = 1 === $paged && 0 === $card_index;
					$is_featured    = in_array( $story_id, $published_sticky_ids, true );
					$article_class  = 'dkxoi-card category-' . sanitize_html_class( $category_slug );
					$article_class .= $is_lead ? ' is-lead' : '';
					$article_class .= $is_featured ? ' is-sticky' : '';
					?>
					<article <?php post_class( $article_class, $story_id ); ?> style="--cat-accent:<?php echo esc_attr( $signal ); ?>;--story-index:'<?php echo esc_attr( str_pad( (string) ( $card_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>'">
						<a href="<?php echo esc_url( get_permalink( $story_id ) ); ?>">
							<div class="dkxoi-media">
								<?php if ( has_post_thumbnail( $story_id ) ) : ?>
									<?php echo get_the_post_thumbnail( $story_id, $is_lead ? 'large' : 'medium_large', array( 'loading' => $is_lead ? 'eager' : 'lazy', 'alt' => get_the_title( $story_id ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php else : ?>
									<span aria-hidden="true">DK</span>
								<?php endif; ?>
							</div>
							<div class="dkxoi-copy">
								<div class="dkxoi-meta">
									<span class="dkxoi-category"><?php echo esc_html( $category_name ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( 'c', $story_id ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.y', $story_id ) ); ?></time>
								</div>
								<?php if ( $is_featured ) : ?><strong class="dkxoi-featured">Featured story</strong><?php endif; ?>
								<h3><?php echo esc_html( get_the_title( $story_id ) ); ?></h3>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $story ), $is_lead ? 32 : 20, '…' ) ); ?></p>
								<span class="dkxoi-read">Read the story ↗</span>
							</div>
						</a>
					</article>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="dkxoi-empty"><?php esc_html_e( 'No published stories were found in this section.', 'dk-expressions-v4-fixes' ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $total_pages > 1 ) : ?>
			<nav class="dkxoi-pagination" aria-label="<?php esc_attr_e( 'Insights pages', 'dk-expressions-v4-fixes' ); ?>">
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

	<nav class="dkxoi-switcher" aria-label="Insights design options">
		<?php foreach ( $preview_names as $preview_key => $preview_name ) : ?>
			<a class="<?php echo $preview === $preview_key ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'dk-insights-preview' => $preview_key, 'dk-refresh' => '1234' ), home_url( '/insights/' ) ) ); ?>">
				<span><?php echo esc_html( str_pad( (string) ( array_search( $preview_key, array_keys( $preview_names ), true ) + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><?php echo esc_html( $preview_name ); ?>
			</a>
		<?php endforeach; ?>
	</nav>
</main>
<?php
wp_reset_postdata();
