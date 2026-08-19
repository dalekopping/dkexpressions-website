<?php
/**
 * Template Name: DK Expressions Our Work — Time Vault
 * v1.18.7 cinematic media-first portfolio.
 */
get_header();
$items = dkxv4_get_work_media();
$videos = array();
$images = array();
foreach ( $items as $item ) {
    $mime = (string) get_post_mime_type( $item );
    if ( 0 === strpos( $mime, 'video/' ) ) $videos[] = $item;
    elseif ( 0 === strpos( $mime, 'image/' ) ) $images[] = $item;
}
?>
<section class="dk-vault-hero" id="top">
    <div class="dk-vault-orbit" aria-hidden="true"><i></i><i></i><i></i></div>
    <div class="dk-vault-hero-copy">
        <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('work_kicker','The DK Expressions Time Vault')); ?></p>
        <h1><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('work_heading',"WE\nWERE\nTHERE."))); ?></h1>
    </div>
    <div class="dk-vault-hero-side">
        <span>2013 — ∞</span>
        <p><?php echo esc_html(dkxv4_page_meta('work_intro','Not stock. Not mock-ups. Not promises. This is work captured, filmed and produced by DK Expressions.')); ?></p>
        <a href="#motion">Open the vault ↓</a>
    </div>
</section>

<section class="dk-vault-proof dk-no-semantic-highlight">
    <article><strong>1.10M+</strong><span>Visits</span></article>
    <article><strong>2.47M+</strong><span>Pages Viewed</span></article>
    <article><strong>6.13M+</strong><span>Hits</span></article>
    <div><small>Independent server analytics</small><b>PROOF OF AUDIENCE</b></div>
</section>

<section class="dk-vault-motion dk-section" id="motion">
    <div class="dk-vault-section-head">
        <span>01</span><div><p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('work_motion_kicker','Motion Archive')); ?></p><h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('work_motion_heading',"Press play on\nthe memory."))); ?></h2></div>
    </div>
    <?php if ( $videos ) : ?>
    <div class="dk-vault-video-stage">
        <?php foreach ( $videos as $index => $video ) :
            $src = wp_get_attachment_url( $video->ID );
            if ( ! $src ) continue;
        ?>
        <article class="dk-vault-video <?php echo 0 === $index ? 'is-featured' : ''; ?>">
            <div class="dk-vault-video-frame">
                <video controls preload="metadata" playsinline>
                    <source src="<?php echo esc_url( $src ); ?>" type="<?php echo esc_attr( get_post_mime_type( $video ) ); ?>">
                </video>
                <span class="dk-vault-timecode"><?php echo esc_html( str_pad( (string) ($index+1), 2, '0', STR_PAD_LEFT ) ); ?> / MOTION</span>
            </div>
            <div class="dk-vault-video-meta"><strong><?php echo esc_html( get_the_title( $video ) ); ?></strong><small>DK EXPRESSIONS ARCHIVE</small></div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php else : ?><p class="dk-vault-empty">Add videos to the Media Library and tick “Show this photo/video in Our Work”.</p><?php endif; ?>
</section>

<?php if ( $images ) : ?>
<section class="dk-vault-photos dk-section" id="photographs">
    <div class="dk-vault-section-head">
        <span>02</span><div><p class="dk-kicker">Frozen Time</p><h2>One frame.<br><em>No second take.</em></h2></div>
    </div>
    <div class="dk-vault-photo-wall">
        <?php foreach ( $images as $index => $image ) :
            $large = wp_get_attachment_image_url( $image->ID, 'large' );
            if ( ! $large ) continue;
        ?>
        <a class="dk-vault-photo" href="<?php echo esc_url( wp_get_attachment_url( $image->ID ) ); ?>" target="_blank" rel="noopener">
            <?php echo wp_get_attachment_image( $image->ID, 'large', false, array( 'loading'=>'lazy', 'alt'=>get_the_title($image) ) ); ?>
            <span><b><?php echo esc_html( get_the_title( $image ) ); ?></b><small>FREEZING TIME &amp; SPACE</small></span>
            <i><?php echo esc_html( str_pad( (string) ($index+1), 2, '0', STR_PAD_LEFT ) ); ?></i>
        </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>


<section class="dk-proof-voices dk-section" id="recommendations">
    <div class="dk-vault-section-head">
        <span>03</span>
        <div><p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('work_reputation_kicker','Don’t take our word for it')); ?></p><h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('work_reputation_heading',"Reputation,\ndocumented."))); ?></h2></div>
    </div>
    <p class="dk-proof-intro">These are not anonymous review cards. They are archived recommendation letters from people and organisations DK Expressions has worked alongside.</p>
    <div class="dk-proof-letter-grid">
        <article class="dk-proof-letter">
            <div class="dk-proof-letter-mark">BIG<br>CONCERTS</div>
            <div class="dk-proof-letter-copy">
                <small>THE PUBLICITY WORKSHOP / BIG CONCERTS</small>
                <blockquote>“Committed, passionate and dedicated to his craft”</blockquote>
                <p>The recommendation confirms coverage of major international tours, event news and CSI initiatives, and describes Dale as extremely reliable across their projects.</p>
                <footer><strong>Dionne Domyan-Mudie</strong><span>National Publicist, Big Concerts · Owner, The Publicity Workshop</span></footer>
                <a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/recommendations/publicity-workshop-big-concerts-recommendation.pdf' ); ?>" target="_blank" rel="noopener">View original recommendation ↗</a>
            </div>
        </article>
        <article class="dk-proof-letter">
            <div class="dk-proof-letter-mark">ONE<br>EYED<br>JACK</div>
            <div class="dk-proof-letter-copy">
                <small>ONE-EYED JACK</small>
                <blockquote>“I highly recommend associating any brand with DK Expressions™”</blockquote>
                <p>The letter references work around We Are One, Sowing the Seeds, Snoop Dogg, Comic Choice Awards and Vodacom in the City, highlighting both visual and social-media delivery.</p>
                <footer><strong>Mike Pocock</strong><span>PR Manager, One-eyed Jack</span></footer>
                <a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/recommendations/one-eyed-jack-recommendation.pdf' ); ?>" target="_blank" rel="noopener">View original recommendation ↗</a>
            </div>
        </article>
        <article class="dk-proof-letter dk-proof-letter--featured">
            <div class="dk-proof-letter-mark">VWV<br>MASSIVE</div>
            <div class="dk-proof-letter-copy">
                <small>VWV MASSIVE</small>
                <blockquote>“The photography and other Social Media Services … had been outstanding”</blockquote>
                <p>VWV Massive’s recommendation also states that DK Expressions would be appointed as official tour photographer for the next event.</p>
                <footer><strong>Lloyd Cornwall</strong><span>Director, VWV Massive</span></footer>
                <a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/recommendations/vwv-massive-recommendation.pdf' ); ?>" target="_blank" rel="noopener">View original recommendation ↗</a>
            </div>
        </article>
    </div>
    <div class="dk-proof-authenticity"><span></span><b>ORIGINAL DOCUMENTS INCLUDED</b><p>Open any recommendation above to view the source letter.</p></div>
</section>

<section class="dk-vault-end dk-section">
    <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('work_final_kicker','Your moment could be next.')); ?></p>
    <h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('work_final_heading',"Make something\nworth freezing."))); ?></h2>
    <div class="dk-home-actions"><a class="dk-button" href="<?php echo esc_url(home_url('/contact/')); ?>">Start a project ↗</a><a class="dk-text-link" href="https://wa.me/27722460451?text=<?php echo rawurlencode('Hi Dale, I saw the DK Expressions Time Vault and would like to discuss a project.'); ?>" target="_blank" rel="noopener">WhatsApp us →</a></div>
</section>
<?php get_footer(); ?>
