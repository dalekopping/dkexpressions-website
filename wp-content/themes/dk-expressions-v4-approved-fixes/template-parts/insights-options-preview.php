<?php
/**
 * Three non-destructive Insights page previews — v1.23.3.
 *
 * @package DK_Expressions_V4_Fixes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$preview = isset( $args['preview'] ) ? sanitize_key( $args['preview'] ) : 'signal-desk';
$preview = in_array( $preview, array( 'signal-desk', 'deadline-wire', 'story-constellation' ), true ) ? $preview : 'signal-desk';

$variants = array(
	'signal-desk'        => 'Signal Desk',
	'deadline-wire'      => 'Deadline Wire',
	'story-constellation'=> 'Story Constellation',
);

$groups = array(
	'news' => array(
		'number'      => '01',
		'label'       => 'News',
		'accent'      => '#ff536d',
		'deep'        => '#35111b',
		'aliases'     => array( 'news', 'press', 'announcement', 'breaking-news' ),
		'placeholder' => array(
			'title'   => 'What we’re covering next',
			'excerpt' => 'Upcoming events, productions and projects already on the schedule.',
			'date'    => 'Ongoing',
		),
	),
	'reviews' => array(
		'number'      => '02',
		'label'       => 'Reviews',
		'accent'      => '#9b7cff',
		'deep'        => '#241a47',
		'aliases'     => array( 'reviews', 'review' ),
		'placeholder' => array(
			'title'   => 'When the production matches the ambition',
			'excerpt' => 'A look at recent live shows where the visual and technical standard actually rose to the material.',
			'date'    => 'July 2026',
		),
	),
	'interviews' => array(
		'number'      => '03',
		'label'       => 'Interviews',
		'accent'      => '#2ad6c9',
		'deep'        => '#0b3937',
		'aliases'     => array( 'interviews', 'interview', 'people-blogs', 'profiles' ),
		'placeholder' => array(
			'title'   => 'Backstage with the ones who still move the room',
			'excerpt' => 'Conversations and frames from the artists and performers who understand presence.',
			'date'    => 'July 2026',
		),
	),
	'events' => array(
		'number'      => '04',
		'label'       => 'Events',
		'accent'      => '#43baff',
		'deep'        => '#0a3150',
		'aliases'     => array( 'events', 'event', 'entertainment', 'music', 'theatre', 'film-animation', 'movies-videos', 'sport' ),
		'placeholder' => array(
			'title'   => 'The next room worth being in',
			'excerpt' => 'Concerts, festivals, productions and cultural experiences moving onto the DK radar.',
			'date'    => 'August 2026',
		),
	),
	'photo-essays' => array(
		'number'      => '05',
		'label'       => 'Photo Essays',
		'accent'      => '#ffc857',
		'deep'        => '#49370b',
		'aliases'     => array( 'photo-essays', 'photo-essay', 'photography', 'time-vault', 'gallery' ),
		'placeholder' => array(
			'title'   => 'From the Time Vault – Festival dust and stadium light',
			'excerpt' => 'Selected frames that still hold the feeling of the night.',
			'date'    => 'June 2026',
		),
	),
	'industry-notes' => array(
		'number'      => '06',
		'label'       => 'Industry Notes',
		'accent'      => '#ff914d',
		'deep'        => '#46230d',
		'aliases'     => array( 'industry-notes', 'industry', 'technology', 'tech', 'lifestyle', 'hospitality', 'motoring', 'business' ),
		'placeholder' => array(
			'title'   => 'Most event photography is forgettable',
			'excerpt' => 'Why the standard on the ground is still so low — and what separates work that disappears from work that still gets used years later.',
			'date'    => 'August 2026',
		),
	),
);

$resolve_group = static function ( $post_id ) use ( $groups ) {
	$post_categories = get_the_category( $post_id );
	$primary_id       = absint( get_post_meta( $post_id, '_yoast_wpseo_primary_category', true ) );

	if ( $primary_id && $post_categories ) {
		usort(
			$post_categories,
			static function ( $first, $second ) use ( $primary_id ) {
				return (int) ( $second->term_id === $primary_id ) - (int) ( $first->term_id === $primary_id );
			}
		);
	}

	foreach ( $post_categories as $category ) {
		$category_slug = sanitize_title( $category->slug );
		foreach ( $groups as $group_slug => $group ) {
			foreach ( $group['aliases'] as $alias ) {
				if ( $category_slug === $alias || str_contains( $category_slug, $alias ) || str_contains( $alias, $category_slug ) ) {
					return $group_slug;
				}
			}
		}
	}

	return 'industry-notes';
};

$sticky_ids = array_values( array_filter( array_map( 'absint', (array) get_option( 'sticky_posts', array() ) ) ) );
$sticky_posts = $sticky_ids ? get_posts(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'post__in'            => $sticky_ids,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
	)
) : array();

$latest_posts = get_posts(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 96,
		'post__not_in'        => $sticky_ids,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
	)
);

$featured_posts = $sticky_posts ? $sticky_posts : array_slice( $latest_posts, 0, 3 );
$featured_ids   = array_map( static fn( $post ) => (int) $post->ID, $featured_posts );
$grouped_posts  = array_fill_keys( array_keys( $groups ), array() );

foreach ( $latest_posts as $post ) {
	if ( in_array( (int) $post->ID, $featured_ids, true ) ) {
		continue;
	}
	$grouped_posts[ $resolve_group( $post->ID ) ][] = $post;
}

$archive_pool  = array();
foreach ( $grouped_posts as $group_slug => $posts ) {
	$visible_posts = array_slice( $posts, 0, 6 );
	$grouped_posts[ $group_slug ] = $visible_posts;
	$archive_pool  = array_merge( $archive_pool, array_slice( $posts, 6 ) );
}

usort(
	$archive_pool,
	static fn( $first, $second ) => strcmp( $second->post_date, $first->post_date )
);
$archive_posts = array_slice( $archive_pool, 0, 6 );

$render_card = static function ( $item, $group_slug, $card_class = '' ) use ( $groups ) {
	$group          = $groups[ $group_slug ];
	$is_placeholder = is_array( $item );
	$post_id        = $is_placeholder ? 0 : (int) $item->ID;
	$title          = $is_placeholder ? $item['title'] : get_the_title( $post_id );
	$excerpt        = $is_placeholder ? $item['excerpt'] : wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post_id ) ), 24, '…' );
	$date           = $is_placeholder ? $item['date'] : get_the_date( 'F Y', $post_id );
	$permalink      = $is_placeholder ? '' : get_permalink( $post_id );
	$classes        = trim( 'dkxi-card ' . $card_class . ( $is_placeholder ? ' is-placeholder' : '' ) );
	?>
	<article class="<?php echo esc_attr( $classes ); ?>" style="--channel:<?php echo esc_attr( $group['accent'] ); ?>;--channel-deep:<?php echo esc_attr( $group['deep'] ); ?>">
		<?php if ( $permalink ) : ?><a href="<?php echo esc_url( $permalink ); ?>"><?php endif; ?>
		<div class="dkxi-card-media">
			<?php if ( $post_id && has_post_thumbnail( $post_id ) ) : ?>
				<?php echo get_the_post_thumbnail( $post_id, 'large', array( 'loading' => 'lazy', 'alt' => $title ) ); ?>
			<?php else : ?>
				<span aria-hidden="true"><?php echo esc_html( $group['number'] ); ?></span>
			<?php endif; ?>
		</div>
		<div class="dkxi-card-copy">
			<div class="dkxi-card-meta"><strong><?php echo esc_html( $group['label'] ); ?></strong><time><?php echo esc_html( $date ); ?></time></div>
			<?php if ( $post_id && is_sticky( $post_id ) ) : ?><b class="dkxi-sticky-label">Sticky / Featured</b><?php endif; ?>
			<h3><?php echo esc_html( $title ); ?></h3>
			<p><?php echo esc_html( $excerpt ); ?></p>
			<span class="dkxi-read"><?php echo $is_placeholder ? 'Editorial preview' : 'Read the story ↗'; ?></span>
		</div>
		<?php if ( $permalink ) : ?></a><?php endif; ?>
	</article>
	<?php
};

$page_url = home_url( '/insights/' );
?>

<main class="dkxi dkxi--<?php echo esc_attr( $preview ); ?> dk-no-semantic-highlight" id="top">
	<div class="dkxi-grid" aria-hidden="true"></div>
	<section class="dkxi-hero">
		<div class="dkxi-shell dkxi-hero-grid">
			<div class="dkxi-hero-copy">
				<p class="dkxi-eyebrow">DK Expressions / Insights</p>
				<h1>News. Reviews.<br>Interviews.<br><em>Stories from the rooms we are in.</em></h1>
				<p>The publishing side of DK Expressions. Fresh coverage, cultural notes, artist features and the work that sits outside pure client commissions.</p>
			</div>
			<div class="dkxi-hero-index" aria-hidden="true"><span>INSIGHTS</span><b>2013—∞</b><i>LIVE EDITORIAL SIGNAL</i></div>
		</div>
	</section>

	<section class="dkxi-featured" id="latest">
		<div class="dkxi-shell">
			<header class="dkxi-section-head"><div><p class="dkxi-eyebrow">Featured / Latest</p><h2>Sticky stories<br><em>stay first.</em></h2></div><p>The stories selected as sticky remain permanently above every category and are removed from the feeds below, so nothing appears twice.</p></header>
			<div class="dkxi-featured-grid">
				<?php foreach ( $featured_posts as $index => $post ) : ?>
					<?php $render_card( $post, $resolve_group( $post->ID ), 0 === $index ? 'is-featured-lead' : 'is-featured-side' ); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<nav class="dkxi-filters" aria-label="Browse Insights sections">
		<div class="dkxi-shell">
			<a class="is-all" href="#latest"><span>00</span>All</a>
			<?php foreach ( $groups as $group_slug => $group ) : ?>
				<a href="#<?php echo esc_attr( $group_slug ); ?>" style="--channel:<?php echo esc_attr( $group['accent'] ); ?>"><span><?php echo esc_html( $group['number'] ); ?></span><?php echo esc_html( $group['label'] ); ?></a>
			<?php endforeach; ?>
		</div>
	</nav>

	<div class="dkxi-channels">
		<?php foreach ( $groups as $group_slug => $group ) : ?>
		<section class="dkxi-channel" id="<?php echo esc_attr( $group_slug ); ?>" style="--channel:<?php echo esc_attr( $group['accent'] ); ?>;--channel-deep:<?php echo esc_attr( $group['deep'] ); ?>">
			<div class="dkxi-shell dkxi-channel-layout">
				<header><span><?php echo esc_html( $group['number'] ); ?></span><p>Editorial channel</p><h2><?php echo esc_html( $group['label'] ); ?></h2><i><?php echo esc_html( count( $grouped_posts[ $group_slug ] ) ); ?> recent signals</i></header>
				<div class="dkxi-channel-cards">
					<?php if ( $grouped_posts[ $group_slug ] ) : ?>
						<?php foreach ( $grouped_posts[ $group_slug ] as $index => $post ) : ?><?php $render_card( $post, $group_slug, 0 === $index ? 'is-channel-lead' : '' ); ?><?php endforeach; ?>
					<?php else : ?>
						<?php $render_card( $group['placeholder'], $group_slug, 'is-channel-lead' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php endforeach; ?>
	</div>

	<section class="dkxi-archive">
		<div class="dkxi-shell">
			<header class="dkxi-section-head"><div><p class="dkxi-eyebrow">From the Archive</p><h2>Older pieces that<br><em>still earn their place.</em></h2></div><p>The archive holds the work that remains useful, relevant or worth returning to long after publication day.</p></header>
			<?php if ( $archive_posts ) : ?>
			<div class="dkxi-archive-grid"><?php foreach ( $archive_posts as $post ) : ?><?php $render_card( $post, $resolve_group( $post->ID ), 'is-archive-card' ); ?><?php endforeach; ?></div>
			<?php else : ?>
			<p class="dkxi-archive-empty">The current editorial selection is already represented above. More recovered stories will appear here as the archive grows.</p>
			<?php endif; ?>
			<div class="dkxi-quick-links"><a href="<?php echo esc_url( home_url( '/our-work/' ) ); ?>">Open the Time Vault <span>→</span></a><a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View current Rate Card <span>→</span></a><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a></div>
		</div>
	</section>

	<section class="dkxi-conversion">
		<div class="dkxi-shell"><p class="dkxi-eyebrow">Coverage / Feature / Collaboration</p><h2>Want to enter<br><em>the story?</em></h2><p>We are selective with what we take on, but always open to the right work.</p><div><a class="is-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project <span>↗</span></a><a href="<?php echo esc_url( home_url( '/rates/' ) ); ?>">View Rate Card <span>→</span></a></div></div>
	</section>
</main>

<nav class="dkxi-switcher" aria-label="Insights design previews">
	<span>Insights options</span>
	<?php foreach ( $variants as $variant_key => $variant_label ) : ?>
		<a class="<?php echo $variant_key === $preview ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( array( 'dk-insights-preview' => $variant_key, 'dk-refresh' => '1233' ), $page_url ) ); ?>"><?php echo esc_html( $variant_label ); ?></a>
	<?php endforeach; ?>
</nav>
