<?php
/**
 * Editorial article with related stories and next-story navigation.
 *
 * @package DK_Expressions_V4_Fixes
 */
get_header();
while ( have_posts() ) : the_post();
	$current_id = get_the_ID();
	$image      = get_the_post_thumbnail_url( $current_id, 'full' );
	$style      = $image ? ' style="background-image:url(' . esc_url( $image ) . ')"' : '';
	?>
	<div class="dk-reading-progress" aria-hidden="true"></div>
	<article <?php post_class(); ?>>
		<header class="dk-article-hero<?php echo $image ? ' has-image' : ''; ?>"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="dk-article-heading">
				<div class="dk-taxonomy"><?php the_category( ' ' ); ?></div>
				<h1><?php the_title(); ?></h1>
				<div class="dk-article-meta"><span>By <?php the_author(); ?></span><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time><span><?php echo esc_html( max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) ) ); ?> minute read</span></div>
			</div>
		</header>
		<div class="dk-article-shell">
			<aside class="dk-share" aria-label="<?php esc_attr_e( 'Share this article', 'dk-expressions-v4-fixes' ); ?>"><span>Share</span><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener">f</a><a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener">𝕏</a><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener">in</a></aside>
			<div class="dk-content dk-article-body"><?php the_content(); ?><?php wp_link_pages(); ?></div>
			<aside class="dk-sidebar"><div class="dk-sidebar-card"><p class="dk-kicker"><?php echo esc_html( dkxv4_content( 'home_insights_kicker' ) ); ?></p><h3><?php echo esc_html( dkxv4_content( 'home_insights_title_1' ) ); ?> <?php echo esc_html( dkxv4_content( 'home_insights_title_2' ) ); ?></h3><p><?php echo esc_html( dkxv4_content( 'home_insights_intro' ) ); ?></p><a class="dk-button" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Explore insights ↗</a></div></aside>
		</div>

		<?php
		$related_count = min( 6, max( 1, absint( dkxv4_content( 'related_posts_count' ) ) ) );
		$category_ids  = wp_get_post_categories( $current_id );
		$related       = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => $related_count,
				'post__not_in'        => array( $current_id ),
				'category__in'        => $category_ids,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => true,
			)
		);
		$related_ids = wp_list_pluck( $related->posts, 'ID' );
		if ( count( $related_ids ) < $related_count ) {
			$fallback = new WP_Query(
				array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      => $related_count - count( $related_ids ),
					'post__not_in'        => array_merge( array( $current_id ), $related_ids ),
					'orderby'             => 'date',
					'order'               => 'DESC',
					'ignore_sticky_posts' => true,
				)
			);
			$related->posts = array_merge( $related->posts, $fallback->posts );
			$related->post_count = count( $related->posts );
		}
		if ( $related->posts ) :
			?>
			<section class="dk-related"><p class="dk-kicker">Continue travelling</p><h2><?php echo esc_html( dkxv4_content( 'related_heading' ) ); ?></h2><div class="dk-related-grid">
				<?php foreach ( $related->posts as $post ) : setup_postdata( $post ); ?>
					<article class="dk-related-card"><a href="<?php the_permalink(); ?>"><div class="dk-related-image"><?php the_post_thumbnail( 'dkx-card' ); ?></div><small><?php echo esc_html( get_the_date( 'd.m.y' ) ); ?></small><h3><?php the_title(); ?></h3><span>Read story ↗</span></a></article>
				<?php endforeach; wp_reset_postdata(); ?>
			</div></section>
		<?php endif; ?>

		<nav class="dk-story-navigation" aria-label="<?php esc_attr_e( 'Article navigation', 'dk-expressions-v4-fixes' ); ?>">
			<div><?php previous_post_link( '%link', '<small>' . esc_html( dkxv4_content( 'previous_story_label' ) ) . '</small><strong>%title</strong>' ); ?></div>
			<div><?php next_post_link( '%link', '<small>' . esc_html( dkxv4_content( 'next_story_label' ) ) . '</small><strong>%title</strong>' ); ?></div>
		</nav>
	</article>
	<?php
endwhile;
get_footer();
