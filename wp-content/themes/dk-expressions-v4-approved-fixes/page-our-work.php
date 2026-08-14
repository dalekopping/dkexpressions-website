<?php
/**
 * Template Name: DK Expressions Our Work Archive
 * Dedicated Our Work + Visual Archive template — v1.19.0
 *
 * @package DK_Expressions_V4_Fixes
 */

wp_enqueue_style(
    'dk-archive-v119',
    get_stylesheet_directory_uri() . '/assets/css/archive-v119.css',
    array(),
    '1.19.0'
);
wp_enqueue_script(
    'dk-archive-v119',
    get_stylesheet_directory_uri() . '/assets/archive-v119.js',
    array(),
    '1.19.0',
    true
);

get_header();

$selected_work = array(
    array('Limp Bizkit — South Africa','First-ever South African show.','Editorial announcement and digital amplification surrounding Limp Bizkit’s first South African performance and the support-act announcement featuring Ecca Vandal and Jack Parow.','Event storytelling • Editorial • SEO • Social amplification'),
    array('Comic Con Africa','Culture, fandom and community.','Multi-layer editorial coverage encompassing guest announcements, event information, press content, audience engagement and competition activity.','Editorial • Event coverage • Competitions • Audience engagement'),
    array('Tyla — A*POP World Tour','A South African global story.','The South African tour announcement transformed into search-optimised editorial and social content.','Tour announcement • SEO • Social content'),
    array('Riverdance 30 — The New Generation','A global production returns.','National tour announcement developed into digital editorial content supporting the Pretoria and Cape Town performances.','Editorial • SEO • National event coverage'),
    array('Swan Lake — Montecasino','An experience-led review.','Production review capturing the scale, performance and emotional impact of Swan Lake at Montecasino.','Review • Theatre • Experience storytelling'),
    array('Disney On Ice','Family experience, authentically told.','Family-focused experiential coverage combining live-event storytelling with authentic audience perspective.','Review • Family entertainment • Event storytelling'),
    array('From Behind the Lens','Two decades of defining moments.','Our photography journey has crossed paths with John Legend, Carlos Santana, Bruce Springsteen, Foo Fighters, Seal, Michael Bublé, Justin Bieber, One Direction, Thirty Seconds to Mars, Chris Brown, UB40, Tiësto, Skrillex, Armin van Buuren, OneRepublic, Boyz II Men and many more.','Photography • Music • Culture • Live events'),
);

function dkx_archive_normalize( $value ) {
    $value = pathinfo( (string) $value, PATHINFO_FILENAME );
    $value = remove_accents( strtolower( $value ) );
    $value = preg_replace( '/[^a-z0-9]+/', '', $value );
    return $value;
}

function dkx_archive_media_map() {
    static $map = null;
    if ( null !== $map ) {
        return $map;
    }

    $map = array();
    $attachments = get_posts(
        array(
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'post_mime_type' => 'image',
            'posts_per_page' => 300,
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );

    foreach ( $attachments as $attachment ) {
        $keys = array(
            dkx_archive_normalize( $attachment->post_title ),
            dkx_archive_normalize( get_attached_file( $attachment->ID ) ),
        );
        foreach ( array_unique( array_filter( $keys ) ) as $key ) {
            if ( ! isset( $map[ $key ] ) ) {
                $map[ $key ] = $attachment->ID;
            }
        }
    }

    return $map;
}

function dkx_archive_attachment_id( $candidates ) {
    $map = dkx_archive_media_map();
    foreach ( (array) $candidates as $candidate ) {
        $key = dkx_archive_normalize( $candidate );
        if ( isset( $map[ $key ] ) ) {
            return (int) $map[ $key ];
        }
    }
    return 0;
}

$archive_items = array(
    array('Adrian Smith — Iron Maiden','Live Music','live-music',array('ADRIAN SMITH OF IRON MAIDEN','ADRIAN SMITH IRON MAIDEN'),'feature'),
    array('Tomorrowland Unite SA','Festival Experience','festivals',array('TOMORROWLAND SA UNITE','TOMORROWLAND UNITE SA 1','TOMORROWLAND UNITE SA'),'wide'),
    array('Red Bull X-Fighters','Action & Experiential','action',array('REDBULL X-FIGHTERS','RED BULL X-FIGHTERS'),'wide'),
    array('Alvin Ailey American Dance Company','Theatre & Performing Arts','theatre',array('Alvin Ailey - American Dance Company 1','Alvin Ailey American Dance Company 1','Alvin Ailey American Dance Company'),'tall'),
    array('John Legend','Live Music','live-music',array('JOHN LEGEND'),'tall'),
    array('Mariah Carey','Live Music','live-music',array('MARIAH CAREY'),'tall'),
    array('Jameson Vic Falls Carnival','Brand Experience','brand',array('JAMESON VIC FALLS CARNIVAL'),'wide'),
    array('Priscilla Queen of the Desert','Theatre & Performing Arts','theatre',array('PRISCILLA QUEEN OF THE DESERT'),'tall'),
    array('Kings & Queens of Comedy','Comedy & Entertainment','comedy',array('KINGS & QUEENS OF COMEDY'),'wide'),
    array('Sowing the Seeds','Festival Storytelling','festivals',array('SOWING THE SEEDS'),'wide'),
    array('DJ Fresh','Nightlife & Live Events','live-music',array('DJ FRESH'),'tall'),
    array('Boargazm — Oppikoppi','Live Music','live-music',array('BOARGAZM @ OPPIKOPPI 2016 #THEUNSEA','BOARGAZM OPPIKOPPI 2016'),'wide'),
    array('Albert Hammond','Live Music','live-music',array('ALBERT HAMMOND'),'wide'),
    array('Emma Hewitt','Artist Portrait / Nightlife','live-music',array('EMMA HEWITT'),'tall'),
    array('Jameson & Mixer','Commercial Brand Photography','brand',array('JAMESON & MIXER','JAMESON MIXER'),'tall'),
    array('Manaka Wedding','People & Celebrations','weddings',array('Manaka Wedding 2017','Manaka Wedding 2017(1)'),'wide'),
    array('Mr & Mrs Vitale','People & Celebrations','weddings',array('MR & MRS VITALE'),'wide'),
    array('Wildlife — Cheetah','Wildlife & Editorial','wildlife',array('WILDLIFE - CHEETAH','WILDLIFE CHEETAH'),'tall'),
    array('Wildlife Encounter','Wildlife & Editorial','wildlife',array('NITRO CIRCUS'),'wide'),
);

$resolved_archive = array();
foreach ( $archive_items as $item ) {
    $attachment_id = dkx_archive_attachment_id( $item[3] );
    if ( ! $attachment_id ) {
        continue;
    }
    $full = wp_get_attachment_image_url( $attachment_id, 'full' );
    if ( ! $full ) {
        continue;
    }
    $resolved_archive[] = array(
        'title'    => $item[0],
        'label'    => $item[1],
        'category' => $item[2],
        'class'    => $item[4],
        'id'       => $attachment_id,
        'full'     => $full,
    );
}
?>

<section class="dk-commercial-hero">
    <div class="dk-stars" aria-hidden="true"></div>
    <div class="dk-commercial-orbit" aria-hidden="true"></div>
    <div class="dk-commercial-copy">
        <p class="dk-kicker">Selected Work</p>
        <h1>We Were There.<em>Proof, Not Promises.</em></h1>
        <p>Some agencies talk about attention. We’ve spent years standing where attention happens.</p>
    </div>
</section>

<main class="dk-commercial-page dk-work-page">
    <section class="dk-commercial-lead">
        <div>
            <p class="dk-kicker">The DK Advantage</p>
            <h2>Built on experience.<br><em>Designed for impact.</em></h2>
        </div>
        <p>From stadiums and concert stages to premieres, conventions, launches, theatre productions and brand experiences, DK Expressions has documented and amplified moments across South Africa’s entertainment and cultural landscape.</p>
    </section>

    <section class="dk-stat-band" aria-label="DK Expressions proof points">
        <article><strong>2013</strong><span>DK Expressions founded</span></article>
        <article><strong>13+</strong><span>Years building the platform</span></article>
        <article><strong>20+</strong><span>Years behind the lens</span></article>
        <article><strong>1000s</strong><span>Published stories & moments</span></article>
    </section>

    <section class="dk-commercial-sections">
    <?php foreach ( $selected_work as $i => $x ) : ?>
        <article class="dk-commercial-section <?php echo 0 === $i % 2 ? 'is-dark' : 'is-blue'; ?>">
            <div class="dk-section-number"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></div>
            <div class="dk-section-copy">
                <p class="dk-kicker"><?php echo esc_html( $x[1] ); ?></p>
                <h2><?php echo esc_html( $x[0] ); ?></h2>
                <p><?php echo esc_html( $x[2] ); ?></p>
                <strong><?php echo esc_html( $x[3] ); ?></strong>
            </div>
            <div class="dk-section-art" aria-hidden="true"><span></span><i></i><b></b></div>
        </article>
    <?php endforeach; ?>
    </section>

    <?php if ( $resolved_archive ) : ?>
    <section class="dk-archive-intro" id="archive">
        <div class="dk-archive-intro-inner">
            <div>
                <p class="dk-kicker">From The Archive</p>
                <h2><span>13+ Years Of Stories.</span>Thousands Of Moments.<em>One Continuing Archive.</em></h2>
            </div>
            <p>Long before every campaign became content, we were already there — in the pit, backstage, trackside, in theatres, at festivals and alongside the people whose moments mattered.</p>
        </div>
    </section>

    <section class="dk-archive-shell" aria-label="DK Expressions visual archive">
        <div class="dk-archive-toolbar" role="group" aria-label="Filter visual archive">
            <button type="button" class="is-active" data-dk-filter="all">All</button>
            <button type="button" data-dk-filter="live-music">Live Music</button>
            <button type="button" data-dk-filter="festivals">Festivals</button>
            <button type="button" data-dk-filter="theatre">Theatre</button>
            <button type="button" data-dk-filter="comedy">Comedy</button>
            <button type="button" data-dk-filter="brand">Brand Experiences</button>
            <button type="button" data-dk-filter="weddings">People & Weddings</button>
            <button type="button" data-dk-filter="action">Action</button>
            <button type="button" data-dk-filter="wildlife">Wildlife</button>
        </div>

        <div class="dk-archive-grid">
        <?php foreach ( $resolved_archive as $item ) : ?>
            <figure class="dk-archive-card <?php echo esc_attr( 'is-' . $item['class'] ); ?>" data-dk-category="<?php echo esc_attr( $item['category'] ); ?>">
                <button
                    type="button"
                    class="dk-archive-open"
                    data-dk-lightbox
                    data-full="<?php echo esc_url( $item['full'] ); ?>"
                    data-title="<?php echo esc_attr( $item['title'] ); ?>"
                    data-label="<?php echo esc_attr( $item['label'] ); ?>"
                    aria-label="<?php echo esc_attr( 'View ' . $item['title'] ); ?>"
                >
                    <?php echo wp_get_attachment_image( $item['id'], 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
                    <span class="dk-archive-overlay">
                        <small><?php echo esc_html( $item['label'] ); ?></small>
                        <strong><?php echo esc_html( $item['title'] ); ?></strong>
                        <em>View image ↗</em>
                    </span>
                </button>
            </figure>
        <?php endforeach; ?>
        </div>
    </section>

    <div class="dk-archive-lightbox" data-dk-lightbox-panel hidden>
        <button type="button" class="dk-archive-lightbox-close" data-dk-lightbox-close aria-label="Close image">×</button>
        <div class="dk-archive-lightbox-stage">
            <img src="" alt="" data-dk-lightbox-image>
            <div>
                <small data-dk-lightbox-label></small>
                <strong data-dk-lightbox-title></strong>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <section class="dk-proof-split">
        <div class="dk-proof-panel">
            <p class="dk-kicker">Why DK Expressions</p>
            <h2>One partner.<br><em>Multiple disciplines.</em></h2>
            <p>Strategy, original production, editorial thinking, photography, digital distribution and audience engagement work together as one connected system.</p>
        </div>
        <div class="dk-proof-points">
            <article><span>01</span><h3>Editorial credibility</h3><p>More than a decade of publishing and culture coverage informs every commercial story we create.</p></article>
            <article><span>02</span><h3>Original production</h3><p>We create the photographs, stories and campaign assets instead of relying only on supplied marketing material.</p></article>
            <article><span>03</span><h3>Built-in distribution</h3><p>Content can live across the DK Expressions ecosystem while also being developed for client-owned channels.</p></article>
            <article><span>04</span><h3>Commercial flexibility</h3><p>From single activations to retainers, projects can scale around the objective, audience and available budget.</p></article>
        </div>
    </section>

    <section class="dk-rate-preview">
        <div>
            <p class="dk-kicker">Commercial Packages</p>
            <h2>Transparent packages.<br><em>Built to scale.</em></h2>
            <p>This section is reserved for the DK Expressions Rate Card. It is already designed into the page architecture so package pricing, deliverables and add-ons can be introduced without changing the visual system.</p>
        </div>
        <div class="dk-rate-preview-card">
            <span>RATE CARD</span>
            <strong>Coming Next</strong>
            <p>Event Storytelling • Monthly Brand Content • Executive Personal Branding • Bespoke Campaigns</p>
        </div>
    </section>

    <section class="dk-commercial-cta">
        <p class="dk-kicker">DK Expressions</p>
        <h2>Your Brand Could Be Next.</h2>
        <p>Let’s create work worth remembering—and build the story around it.</p>
        <a class="dk-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Create With DK Expressions ↗</a>
    </section>
</main>

<?php get_footer(); ?>
