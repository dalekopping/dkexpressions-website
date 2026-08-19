<?php
/**
 * Template Name: DK Expressions Our Work Experience
 * Dedicated Selected Work + Visual Archive — v1.19.2
 *
 * @package DK_Expressions_V4_Fixes
 */

wp_enqueue_style(
    'dk-our-work-v1192',
    get_stylesheet_directory_uri() . '/assets/css/our-work-v1192.css',
    array(),
    '1.19.2'
);
wp_enqueue_script(
    'dk-our-work-v1192',
    get_stylesheet_directory_uri() . '/assets/our-work-v1192.js',
    array(),
    '1.19.2',
    true
);

get_header();

$selected_work = array(
    array('01','Limp Bizkit — South Africa','First-ever South African show.','Editorial announcement and digital amplification surrounding Limp Bizkit’s first South African performance and the support-act announcement featuring Ecca Vandal and Jack Parow.','Event storytelling · Editorial · SEO · Social amplification'),
    array('02','Comic Con Africa','Culture, fandom and community.','Multi-layer editorial coverage spanning guest announcements, event information, press content, audience engagement and competition activity.','Editorial · Event coverage · Competitions · Audience engagement'),
    array('03','Tyla — A*POP World Tour','A South African global story.','The South African tour announcement transformed into search-led editorial and social content built to travel beyond the announcement itself.','Tour announcement · SEO · Social content'),
    array('04','Riverdance 30 — The New Generation','A global production returns.','National tour announcement developed into digital editorial content supporting the Pretoria and Cape Town performances.','Editorial · SEO · National event coverage'),
    array('05','Swan Lake — Montecasino','An experience-led review.','A personal production review capturing the scale, performance and emotional impact of Swan Lake at Montecasino.','Review · Theatre · Experience storytelling'),
    array('06','Disney On Ice','Family experience, authentically told.','Family-focused experiential coverage combining live-event storytelling with an authentic audience perspective.','Review · Family entertainment · Event storytelling'),
    array('07','From Behind The Lens','Two decades of defining moments.','From international artists and packed arenas to theatre, festivals, action sport, weddings, wildlife and brand experiences — the camera has always been part of the story.','Photography · Music · Culture · Live events'),
);

function dkx_work_normalize($value){
    $value = pathinfo((string)$value, PATHINFO_FILENAME);
    $value = remove_accents(strtolower($value));
    return preg_replace('/[^a-z0-9]+/','',$value);
}
function dkx_work_media_pool(){
    static $pool = null;
    if(null !== $pool) return $pool;
    $pool = array();
    $attachments = get_posts(array(
        'post_type'=>'attachment','post_status'=>'inherit','post_mime_type'=>'image',
        'posts_per_page'=>500,'orderby'=>'date','order'=>'DESC'
    ));
    foreach($attachments as $attachment){
        $title = dkx_work_normalize($attachment->post_title);
        $file  = dkx_work_normalize(get_attached_file($attachment->ID));
        $pool[] = array('id'=>$attachment->ID,'title'=>$title,'file'=>$file);
    }
    return $pool;
}
function dkx_work_find_image($candidates){
    $pool = dkx_work_media_pool();
    $best_id = 0; $best_score = 0;
    foreach((array)$candidates as $candidate){
        $needle = dkx_work_normalize($candidate);
        if(!$needle) continue;
        foreach($pool as $media){
            foreach(array($media['title'],$media['file']) as $hay){
                if(!$hay) continue;
                if($hay === $needle) return (int)$media['id'];
                $score = 0;
                if(strpos($hay,$needle)!==false || strpos($needle,$hay)!==false){
                    $score = min(strlen($hay),strlen($needle)) / max(strlen($hay),strlen($needle));
                    $score += .6;
                } elseif(strlen($needle)>5){
                    similar_text($hay,$needle,$pct);
                    $score = $pct/100;
                }
                if($score>$best_score && $score>.68){
                    $best_score=$score; $best_id=(int)$media['id'];
                }
            }
        }
    }
    return $best_id;
}

$archive_blueprint = array(
    array('Adrian Smith — Iron Maiden','Live Music','live-music','hero',array('ADRIAN SMITH OF IRON MAIDEN','ADRIAN SMITH IRON MAIDEN','IRON MAIDEN ADRIAN SMITH')),
    array('Tomorrowland Unite SA','Festivals','festivals','landscape',array('TOMORROWLAND SA UNITE','TOMORROWLAND UNITE SA','TOMORROWLAND')),
    array('Red Bull X-Fighters','Action','action','landscape',array('REDBULL X-FIGHTERS','RED BULL X-FIGHTERS','X FIGHTERS')),
    array('Alvin Ailey American Dance Company','Theatre','theatre','landscape',array('ALVIN AILEY AMERICAN DANCE COMPANY','ALVIN AILEY')),
    array('John Legend','Live Music','live-music','portrait',array('JOHN LEGEND')),
    array('Priscilla Queen of the Desert','Theatre','theatre','portrait',array('PRISCILLA QUEEN OF THE DESERT','PRISCILLA')),
    array('Jameson Vic Falls Carnival','Brand Experiences','brand','landscape',array('JAMESON VIC FALLS CARNIVAL','VIC FALLS CARNIVAL')),
    array('Kings & Queens of Comedy','Comedy','comedy','landscape',array('KINGS & QUEENS OF COMEDY','KINGS AND QUEENS OF COMEDY')),
    array('Sowing The Seeds','Festivals','festivals','wide',array('SOWING THE SEEDS')),
    array('DJ Fresh','Live Music','live-music','portrait',array('DJ FRESH')),
    array('Manaka Wedding','People & Weddings','people','portrait',array('MANAKA WEDDING 2017','MANAKA WEDDING')),
    array('Wildlife — Cheetah','Wildlife','wildlife','portrait',array('WILDLIFE - CHEETAH','WILDLIFE CHEETAH','CHEETAH')),
    array('Wildlife Encounter','Wildlife','wildlife','landscape',array('NITRO CIRCUS','LION CUBS','LION CUB')),
    array('Albert Hammond','Live Music','live-music','landscape',array('ALBERT HAMMOND')),
    array('Jameson & Mixer','Brand Experiences','brand','portrait',array('JAMESON & MIXER','JAMESON MIXER')),
);

$archive = array();
foreach($archive_blueprint as $item){
    $id = dkx_work_find_image($item[4]);
    if(!$id) continue;
    $full = wp_get_attachment_image_url($id,'full');
    if(!$full) continue;
    $archive[] = array(
        'title'=>$item[0],'label'=>$item[1],'category'=>$item[2],'layout'=>$item[3],
        'id'=>$id,'full'=>$full
    );
}
?>
<div class="dkow">

<section class="dkow-hero">
    <div class="dkow-hero-orbit" aria-hidden="true"><i></i><b></b><span></span></div>
    <div class="dkow-hero-inner">
        <p class="dkow-eyebrow">OUR WORK · DK EXPRESSIONS</p>
        <h1><span>WE WERE</span><strong>THERE.</strong></h1>
        <p class="dkow-hero-deck">Not watching from the sidelines. In the pit. Backstage. Trackside. In theatres. At festivals. Beside the people and brands creating the moments everyone remembers.</p>
        <a href="#selected-work" class="dkow-enter">EXPLORE THE WORK <span>↓</span></a>
    </div>
    <div class="dkow-hero-index">2013 — NOW</div>
</section>

<section class="dkow-chapter dkow-selected" id="selected-work">
    <header class="dkow-chapter-head">
        <div><span>01</span><p>SELECTED WORK</p></div>
        <h2>PROOF,<br><em>NOT PROMISES.</em></h2>
        <p>Campaigns, productions, reviews and experiences that show how DK Expressions turns moments into stories with a life beyond the event itself.</p>
    </header>

    <div class="dkow-case-list">
    <?php foreach($selected_work as $i=>$case): ?>
        <article class="dkow-case <?php echo $i%2 ? 'is-blue' : 'is-black'; ?>">
            <div class="dkow-case-number"><?php echo esc_html($case[0]); ?></div>
            <div class="dkow-case-copy">
                <p><?php echo esc_html($case[2]); ?></p>
                <h3><?php echo esc_html($case[1]); ?></h3>
                <div class="dkow-case-body"><?php echo esc_html($case[3]); ?></div>
                <strong><?php echo esc_html($case[4]); ?></strong>
            </div>
            <div class="dkow-case-orbit" aria-hidden="true"><span></span><i></i><b></b></div>
        </article>
    <?php endforeach; ?>
    </div>
</section>

<?php if($archive): ?>
<section class="dkow-archive" id="archive">
    <div class="dkow-archive-opening">
        <div class="dkow-archive-chapter"><span>02</span><p>THE ARCHIVE</p></div>
        <p class="dkow-archive-kicker">13+ YEARS OF STORIES.</p>
        <h2>THOUSANDS<br>OF MOMENTS.<br><em>ONE CONTINUING<br>ARCHIVE.</em></h2>
        <div class="dkow-archive-opening-copy">
            <p>Long before every campaign became content, we were already there — in the pit, backstage, trackside, ringside, in theatres, at festivals and alongside the people whose moments mattered.</p>
            <a href="#archive-images">ENTER THE ARCHIVE <span>↓</span></a>
        </div>
    </div>

    <div class="dkow-filter-wrap" id="archive-images">
        <div class="dkow-filters" role="group" aria-label="Filter visual archive">
            <button class="is-active" data-dkow-filter="all">ALL</button>
            <button data-dkow-filter="live-music">LIVE MUSIC</button>
            <button data-dkow-filter="festivals">FESTIVALS</button>
            <button data-dkow-filter="theatre">THEATRE</button>
            <button data-dkow-filter="comedy">COMEDY</button>
            <button data-dkow-filter="brand">BRAND EXPERIENCES</button>
            <button data-dkow-filter="people">PEOPLE / WEDDINGS</button>
            <button data-dkow-filter="action">ACTION</button>
            <button data-dkow-filter="wildlife">WILDLIFE</button>
        </div>
    </div>

    <div class="dkow-gallery">
    <?php foreach($archive as $i=>$item): ?>
        <figure class="dkow-frame dkow-<?php echo esc_attr($item['layout']); ?>" data-dkow-category="<?php echo esc_attr($item['category']); ?>">
            <button type="button" class="dkow-image" data-dkow-lightbox data-full="<?php echo esc_url($item['full']); ?>" data-title="<?php echo esc_attr($item['title']); ?>" data-label="<?php echo esc_attr($item['label']); ?>">
                <?php echo wp_get_attachment_image($item['id'],'large',false,array('loading'=>$i<3?'eager':'lazy','decoding'=>'async')); ?>
                <span class="dkow-frame-index"><?php echo esc_html(str_pad((string)($i+1),2,'0',STR_PAD_LEFT)); ?></span>
                <span class="dkow-caption">
                    <small><?php echo esc_html($item['label']); ?></small>
                    <strong><?php echo esc_html($item['title']); ?></strong>
                    <em>OPEN FRAME ↗</em>
                </span>
            </button>
        </figure>
    <?php endforeach; ?>
    </div>

    <div class="dkow-archive-close">
        <p>WHY DK EXPRESSIONS</p>
        <h3>EVERY FRAME IS A PIECE<br>OF TIME WE REFUSED TO LOSE.</h3>
        <span>Photography · Editorial · Experience · Culture</span>
    </div>

    <div class="dkow-lightbox" data-dkow-panel hidden>
        <button type="button" class="dkow-lightbox-close" data-dkow-close aria-label="Close image">×</button>
        <div class="dkow-lightbox-stage">
            <img src="" alt="" data-dkow-image>
            <div><small data-dkow-label></small><strong data-dkow-title></strong></div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="dkow-end">
    <p>YOUR BRAND COULD BE NEXT.</p>
    <h2>LET'S CREATE WORK<br>WORTH REMEMBERING.</h2>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>">START YOUR PROJECT ↗</a>
</section>

</div>
<?php get_footer(); ?>
