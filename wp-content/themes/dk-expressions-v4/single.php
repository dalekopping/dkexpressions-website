<?php
/**
 * Editorial article template.
 *
 * @package DK_Expressions_V4
 */
get_header();
while ( have_posts() ) : the_post();
	$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$style = $image ? ' style="background-image:url(' . esc_url( $image ) . ')"' : '';
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
			<aside class="dk-share" aria-label="<?php esc_attr_e( 'Share this article', 'dk-expressions-v4' ); ?>"><span>Share</span><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener">f</a><a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener">𝕏</a><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener">in</a></aside>
			<div class="dk-content dk-article-body"><?php the_content(); ?><?php wp_link_pages(); ?></div>
			<aside class="dk-sidebar"><div class="dk-sidebar-card"><p class="dk-kicker">DKX Dispatch</p><h3>Culture, captured in real time.</h3><p>Explore entertainment, events, technology and the stories shaping South African culture.</p><a class="dk-button" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Explore insights ↗</a></div></aside>
		</div>
	</article>
	<?php
endwhile;
get_footer();
