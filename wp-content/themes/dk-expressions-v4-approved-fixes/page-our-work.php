<?php
/**
 * Template Name: DK Expressions Our Work Archive
 * Dedicated Our Work + Visual Archive template — v1.19.1
 *
 * @package DK_Expressions_V4_Fixes
 */

wp_enqueue_style('dk-archive-v119', get_stylesheet_directory_uri() . '/assets/css/archive-v119.css', array(), '1.19.1');
wp_enqueue_script('dk-archive-v119', get_stylesheet_directory_uri() . '/assets/archive-v119.js', array(), '1.19.1', true);

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

if ( ! function_exists( 'dkx_archive_normalize' ) ) {
    function dkx_archive_normalize( $value ) {
        $value = pathinfo( (string) $value, PATHINFO_FILENAME );
        $value = remove_accents( strtolower( $value ) );
        return preg_replace( '/[^a-z0-9]+/', '', $value );
    }
}

if ( ! function_exists( 'dkx_archive_media_index' ) ) {
    function dkx_archive_media_index() {
        static $index = null;
        if ( null !== $index ) return $index;
        $index = array();
        $attachments = get_posts( array(
            'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image',
            'posts_per_page' => 1000, 'orderby' => 'date', 'order' => 'DESC',
        ) );
        foreach ( $attachments as $attachment ) {
            $file = get_attached_file( $attachment->ID );
            $guid = wp_get_attachment_url( $attachment->ID );
            $keys = array_unique( array_filter( array(
                dkx_archive_normalize( $attachment->post_title ),
                dkx_archive_normalize( $file ),
                dkx_archive_normalize( $guid ),
            ) ) );
            $index[] = array( 'id' => (int) $attachment->ID, 'keys' => $keys );
        }
        return $index;
    }
}

if ( ! function_exists( 'dkx_archive_attachment_id' ) ) {
    function dkx_archive_attachment_id( $candidates ) {
        $index = dkx_archive_media_index();
        $normalized = array_values( array_filter( array_map( 'dkx_archive_normalize', (array) $candidates ) ) );
        foreach ( $normalized as $needle ) {
            foreach ( $index as $row ) {
                if ( in_array( $needle, $row['keys'], true ) ) return $row['id'];
            }
        }
        $best_id = 0; $best_score = 0;
        foreach ( $normalized as $needle ) {
            if ( strlen( $needle ) < 5 ) continue;
            foreach ( $index as $row ) {
                foreach ( $row['keys'] as $key ) {
                    if ( false !== strpos( $key, $needle ) || false !== strpos( $needle, $key ) ) {
                        $score = min( strlen( $needle ), strlen( $key ) );
                        if ( $score > $best_score ) { $best_score = $score; $best_id = $row['id']; }
                    }
                }
            }
        }
        return $best_id;
    }
}

$archive_items = array(
    array('Adrian Smith — Iron Maiden','Live Music','live-music',array('ADRIAN SMITH OF IRON MAIDEN','ADRIAN SMITH IRON MAIDEN','adrian-smith'),'hero'),
    array('Tomorrowland Unite SA','Festival Experience','festivals',array('TOMORROWLAND SA UNITE','TOMORROWLAND UNITE SA 1','TOMORROWLAND UNITE SA','tomorrowland'),'cinema'),
    array('Red Bull X-Fighters','Action & Experiential','action',array('REDBULL X-FIGHTERS','RED BULL X-FIGHTERS','x-fighters'),'cinema'),
    array('Alvin Ailey American Dance Company','Theatre & Performing Arts','theatre',array('Alvin Ailey - American Dance Company 1','Alvin Ailey American Dance Company','alvin-ailey'),'portrait'),
    array('John Legend','Live Music','live-music',array('JOHN LEGEND','john-legend'),'portrait'),
    array('Mariah Carey','Live Music','live-music',array('MARIAH CAREY','mariah-carey'),'portrait'),
    array('Jameson Vic Falls Carnival','Brand Experience','brand',array('JAMESON VIC FALLS CARNIVAL','vic-falls-carnival'),'cinema'),
    array('Priscilla Queen of the Desert','Theatre & Performing Arts','theatre',array('PRISCILLA QUEEN OF THE DESERT','priscilla'),'portrait'),
    array('Kings & Queens of Comedy','Comedy & Entertainment','comedy',array('KINGS & QUEENS OF COMEDY','kings-queens-comedy'),'cinema'),
    array('Sowing the Seeds','Festival Storytelling','festivals',array('SOWING THE SEEDS','sowing-the-seeds'),'cinema'),
    array('DJ Fresh','Nightlife & Live Events','live-music',array('DJ FRESH','dj-fresh'),'portrait'),
    array('Boargazm — Oppikoppi','Live Music','live-music',array('BOARGAZM @ OPPIKOPPI 2016 #THEUNSEA','BOARGAZM OPPIKOPPI 2016','boargazm'),'cinema'),
    array('Albert Hammond','Live Music','live-music',array('ALBERT HAMMOND','albert-hammond'),'cinema'),
    array('Emma Hewitt','Artist Portrait / Nightlife','live-music',array('EMMA HEWITT','emma-hewitt'),'portrait'),
    array('Jameson & Mixer','Commercial Brand Photography','brand',array('JAMESON & MIXER','JAMESON MIXER','jameson-mixer'),'portrait'),
    array('Manaka Wedding','People & Celebrations','weddings',array('Manaka Wedding 2017','Manaka Wedding','manaka-wedding'),'cinema'),
    array('Mr & Mrs Vitale','People & Celebrations','weddings',array('MR & MRS VITALE','mrs-vitale','vitale'),'cinema'),
    array('Wildlife — Cheetah','Wildlife & Editorial','wildlife',array('WILDLIFE - CHEETAH','WILDLIFE CHEETAH','cheetah'),'portrait'),
    array('Wildlife Encounter','Wildlife & Editorial','wildlife',array('NITRO CIRCUS','lion cub','lions'),'cinema'),
);

$resolved_archive = array(); $used_ids = array();
foreach ( $archive_items as $item ) {
    $attachment_id = dkx_archive_attachment_id( $item[3] );
    if ( ! $attachment_id || isset( $used_ids[$attachment_id] ) ) continue;
    $full = wp_get_attachment_image_url( $attachment_id, 'full' );
    if ( ! $full ) continue;
    $used_ids[$attachment_id] = true;
    $resolved_archive[] = array('title'=>$item[0],'label'=>$item[1],'category'=>$item[2],'class'=>$item[4],'id'=>$attachment_id,'full'=>$full);
}
?>
<section class="dk-commercial-hero"><div class="dk-stars" aria-hidden="true"></div><div class="dk-commercial-orbit" aria-hidden="true"></div><div class="dk-commercial-copy"><p class="dk-kicker">Selected Work</p><h1>We Were There.<em>Proof, Not Promises.</em></h1><p>Some agencies talk about attention. We’ve spent years standing where attention happens.</p></div></section>
<main class="dk-commercial-page dk-work-page">
<section class="dk-commercial-lead"><div><p class="dk-kicker">The DK Advantage</p><h2>Built on experience.<br><em>Designed for impact.</em></h2></div><p>From stadiums and concert stages to premieres, conventions, launches, theatre productions and brand experiences, DK Expressions has documented and amplified moments across South Africa’s entertainment and cultural landscape.</p></section>
<section class="dk-stat-band" aria-label="DK Expressions proof points"><article><strong>2013</strong><span>DK Expressions founded</span></article><article><strong>13+</strong><span>Years building the platform</span></article><article><strong>20+</strong><span>Years behind the lens</span></article><article><strong>1000s</strong><span>Published stories & moments</span></article></section>
<section class="dk-commercial-sections"><?php foreach($selected_work as $i=>$x):?><article class="dk-commercial-section <?php echo 0===$i%2?'is-dark':'is-blue';?>"><div class="dk-section-number"><?php echo esc_html(str_pad((string)($i+1),2,'0',STR_PAD_LEFT));?></div><div class="dk-section-copy"><p class="dk-kicker"><?php echo esc_html($x[1]);?></p><h2><?php echo esc_html($x[0]);?></h2><p><?php echo esc_html($x[2]);?></p><strong><?php echo esc_html($x[3]);?></strong></div><div class="dk-section-art" aria-hidden="true"><span></span><i></i><b></b></div></article><?php endforeach;?></section>
<?php if($resolved_archive):?>
<section class="dk-archive-experience" id="archive"><header class="dk-archive-title"><p class="dk-kicker">From The Archive</p><div class="dk-archive-title-grid"><h2><span>13+ Years.</span><strong>Thousands Of Moments.</strong><em>One Continuing Archive.</em></h2><div><p>Long before every campaign became content, we were already there — in the pit, backstage, trackside, in theatres, at festivals and alongside the people whose moments mattered.</p><small><?php echo esc_html(count($resolved_archive));?> moments currently selected from the archive.</small></div></div></header>
<div class="dk-archive-toolbar-wrap"><div class="dk-archive-toolbar" role="group" aria-label="Filter visual archive"><button type="button" class="is-active" data-dk-filter="all">All</button><button type="button" data-dk-filter="live-music">Live Music</button><button type="button" data-dk-filter="festivals">Festivals</button><button type="button" data-dk-filter="theatre">Theatre</button><button type="button" data-dk-filter="comedy">Comedy</button><button type="button" data-dk-filter="brand">Brand Experiences</button><button type="button" data-dk-filter="weddings">People & Weddings</button><button type="button" data-dk-filter="action">Action</button><button type="button" data-dk-filter="wildlife">Wildlife</button></div></div>
<div class="dk-archive-canvas"><?php foreach($resolved_archive as $i=>$item):?><figure class="dk-archive-shot <?php echo esc_attr('is-'.$item['class']);?>" data-dk-category="<?php echo esc_attr($item['category']);?>"><button type="button" class="dk-archive-open" data-dk-lightbox data-full="<?php echo esc_url($item['full']);?>" data-title="<?php echo esc_attr($item['title']);?>" data-label="<?php echo esc_attr($item['label']);?>" aria-label="<?php echo esc_attr('View '.$item['title']);?>"><?php echo wp_get_attachment_image($item['id'],'large',false,array('loading'=>$i<3?'eager':'lazy','decoding'=>'async'));?><span class="dk-archive-index"><?php echo esc_html(str_pad((string)($i+1),2,'0',STR_PAD_LEFT));?></span><span class="dk-archive-overlay"><small><?php echo esc_html($item['label']);?></small><strong><?php echo esc_html($item['title']);?></strong><em>Open frame ↗</em></span></button></figure><?php endforeach;?></div>
<footer class="dk-archive-end"><span>THE ARCHIVE CONTINUES</span><strong>Every frame is a piece of time we refused to lose.</strong></footer></section>
<div class="dk-archive-lightbox" data-dk-lightbox-panel hidden><button type="button" class="dk-archive-lightbox-close" data-dk-lightbox-close aria-label="Close image">×</button><div class="dk-archive-lightbox-stage"><img src="" alt="" data-dk-lightbox-image><div><small data-dk-lightbox-label></small><strong data-dk-lightbox-title></strong></div></div></div>
<?php endif;?>
<section class="dk-proof-split"><div class="dk-proof-panel"><p class="dk-kicker">Why DK Expressions</p><h2>One partner.<br><em>Multiple disciplines.</em></h2><p>Strategy, original production, editorial thinking, photography, digital distribution and audience engagement work together as one connected system.</p></div><div class="dk-proof-points"><article><span>01</span><h3>Editorial credibility</h3><p>More than a decade of publishing and culture coverage informs every commercial story we create.</p></article><article><span>02</span><h3>Original production</h3><p>We create the photographs, stories and campaign assets instead of relying only on supplied marketing material.</p></article><article><span>03</span><h3>Built-in distribution</h3><p>Content can live across the DK Expressions ecosystem while also being developed for client-owned channels.</p></article><article><span>04</span><h3>Commercial flexibility</h3><p>From single activations to retainers, projects can scale around the objective, audience and available budget.</p></article></div></section>
<section class="dk-rate-preview"><div><p class="dk-kicker">Commercial Packages</p><h2>Transparent packages.<br><em>Built to scale.</em></h2><p>This section is reserved for the DK Expressions Rate Card. It is already designed into the page architecture so package pricing, deliverables and add-ons can be introduced without changing the visual system.</p></div><div class="dk-rate-preview-card"><span>RATE CARD</span><strong>Coming Next</strong><p>Event Storytelling • Monthly Brand Content • Executive Personal Branding • Bespoke Campaigns</p></div></section>
<section class="dk-commercial-cta"><p class="dk-kicker">DK Expressions</p><h2>Your Brand Could Be Next.</h2><p>Let’s create work worth remembering—and build the story around it.</p><a class="dk-button" href="<?php echo esc_url(home_url('/contact/'));?>">Create With DK Expressions ↗</a></section>
</main>
<?php get_footer(); ?>
