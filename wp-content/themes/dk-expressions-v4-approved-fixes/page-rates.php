<?php
/**
 * Template Name: DK Expressions 2026 Rate Card
 * Rates page — exact package system mirrored from Solutions.
 */
$dkx_solutions_css = get_stylesheet_directory() . '/assets/css/solutions-v1181.css';
wp_enqueue_style(
    'dkx-solutions-v1181',
    get_stylesheet_directory_uri() . '/assets/css/solutions-v1181.css',
    array( 'dkx-approved-fixes', 'dkx-enterprise-v115' ),
    file_exists( $dkx_solutions_css ) ? filemtime( $dkx_solutions_css ) : '1.18.1'
);
get_header();

$rate_card_url = function_exists( 'dkx_final_rate_card_download_url' ) ? dkx_final_rate_card_download_url() : add_query_arg( 'dkx_rate_card', 'final-2026', home_url( '/' ) );
$one_page_pdf_url = function_exists( 'dkx_one_page_rate_card_pdf_url' ) ? dkx_one_page_rate_card_pdf_url() : add_query_arg( 'dkx_rate_card', 'one-page-pdf-2026', home_url( '/' ) );

/* IMPORTANT: This is intentionally the exact same commercial package data as Solutions. */
$solution_families = array(
 array('number'=>'01','slug'=>'event-domination','class'=>'is-blue','title'=>'Event Domination','tagline'=>'Turn the event into something people wish they attended.','packages'=>array(
  array('name'=>'Spark','price'=>'R6,500','suffix'=>'/ event','description'=>'Entry coverage to get a brand in the door','badge'=>'','features'=>array('Up to <strong>4</strong> hours on site','<strong>1</strong> creator','<strong>40</strong> edited photos','<strong>2</strong> short-form reels','Next-day delivery')),
  array('name'=>'Signature','price'=>'R32,000','suffix'=>'/ event','description'=>'The core package most events should buy','badge'=>'Most Chosen','features'=>array('Up to <strong>8</strong> hours','Photo + video','Live posting during the event','<strong>5</strong> reels + <strong>80</strong> edited photos','Same-day teaser edit','Post-event recap reel')),
  array('name'=>'Takeover','price'=>'R95,000','prefix'=>'From','suffix'=>'','description'=>'Multi-day or flagship productions','badge'=>'','features'=>array('Crew of <strong>2</strong>–<strong>4</strong> creators','Real-time social management','Daily reels + stories','Creator/influencer coordination','Full post-event campaign + report')))),
 array('number'=>'02','slug'=>'always-on','class'=>'is-gold','title'=>'Always On','tagline'=>'Your brand should not disappear between campaigns.','packages'=>array(
  array('name'=>'Essential','price'=>'R15,000','suffix'=>'/ month','description'=>'Consistent presence for one brand','badge'=>'','features'=>array('<strong>1</strong> content shoot per month','<strong>12</strong> edited posts','<strong>4</strong> reels','Monthly content calendar','Basic monthly report')),
  array('name'=>'Premium','price'=>'R35,000','suffix'=>'/ month','description'=>'Full content and growth partner','badge'=>'Most Chosen','features'=>array('<strong>2</strong> shoots per month','<strong>20</strong> posts + <strong>8</strong> reels','Full social media management','Content strategy + calendar','Paid ad creative','Monthly performance report')),
  array('name'=>'Elite','price'=>'R60,000','prefix'=>'From','suffix'=>'/ month','description'=>'Own the category online','badge'=>'','features'=>array('Weekly shoots + content drops','Unlimited posts within scope','Full social + community management','Monthly event coverage','Paid ad management','Dedicated strategy sessions')))),
 array('number'=>'03','slug'=>'become-the-name','class'=>'is-purple','title'=>'Become the Name','tagline'=>'People cannot hire, book or invest in someone they never see.','packages'=>array(
  array('name'=>'Starter','price'=>'R18,000','suffix'=>'/ month','description'=>'Show up consistently and look the part','badge'=>'','features'=>array('<strong>1</strong> shoot per month','<strong>12</strong> personal-brand posts','<strong>4</strong> short-form videos','Instagram + TikTok content')),
  array('name'=>'Growth','price'=>'R40,000','suffix'=>'/ month','description'=>'Build real authority and reach','badge'=>'Most Chosen','features'=>array('<strong>2</strong> shoots per month','<strong>20</strong> posts + <strong>8</strong> videos','Personal-brand strategy','Full content management','Interview/talking-head series','Monthly review + reporting')),
  array('name'=>'Authority','price'=>'R75,000','prefix'=>'From','suffix'=>'/ month','description'=>'Become the name in your field','badge'=>'','features'=>array('Weekly content production','Media + PR positioning','Podcast/video show production','Full multi-platform management','Ghostwriting + thought leadership','Quarterly brand strategy sessions')))),
 array('number'=>'04','slug'=>'own-the-attention','class'=>'is-red','title'=>'Own the Attention','tagline'=>'Turn DK Expressions publishing authority into sustained brand visibility.','packages'=>array(
  array('name'=>'Feature','price'=>'R1,500','suffix'=>'/ placement','description'=>'A focused sponsored editorial feature','badge'=>'','features'=>array('<strong>1</strong> dedicated editorial listing','<strong>1</strong> social amplification post','Live for <strong>12</strong> months')),
  array('name'=>'Spotlight','price'=>'R6,000','suffix'=>'/ campaign','description'=>'Sustained presence over a season','badge'=>'Best Value','features'=>array('<strong>8</strong> editorial listings','Social amplification on each','Instagram + Facebook + X coverage','Campaign-window placement')),
  array('name'=>'Headline','price'=>'R12,500','suffix'=>'/ campaign','description'=>'Dominant ongoing exposure','badge'=>'','features'=>array('<strong>16</strong> editorial listings','Full social amplification per post','Priority placement + tagging','Optional event-coverage tie-in')))),
);
$solution_package_slugs = array(
 'event-domination'=>array('event-spark','event-signature','event-takeover'),
 'always-on'=>array('always-essential','always-premium','always-elite'),
 'become-the-name'=>array('name-starter','name-growth','name-authority'),
 'own-the-attention'=>array('attention-feature','attention-spotlight','attention-headline'),
);
?>
<main class="dkxcr dkxcr--rates dkxsr dk-no-semantic-highlight" id="top">
 <div class="dkxcr-grid" aria-hidden="true"></div>
 <section class="dkxcr-rates-hero" aria-labelledby="dkxcr-rates-title">
  <div class="dkxcr-rates-year" aria-hidden="true"><span>20</span><strong>26</strong></div>
  <div class="dkxcr-rates-hero-copy">
   <p class="dkxcr-kicker"><span>DK</span> / Commercial Rate Card</p>
   <h1 id="dkxcr-rates-title">Clear packages.<br>Fixed scopes.<br><em>No hourly surprises.</em></h1>
   <p>The rates below are the exact packages currently displayed on Solutions. Download the complete or one-page PDF for reference.</p>
   <div class="dkxcr-actions">
    <a class="is-primary" href="<?php echo esc_url($rate_card_url); ?>" download="DK-Expressions-2026-Rate-Card.pdf" data-dkx-rate-download>Download Full Rate Card <span>↓</span></a>
    <a href="<?php echo esc_url($one_page_pdf_url); ?>" download="DK-Expressions-2026-One-Page-Rate-Card.pdf" data-dkx-rate-download>One-Page PDF <span>↓</span></a>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>">Start a Project <span>↗</span></a>
   </div>
   <div class="dkxcr-download-meta"><span>4 core packages</span><span>PDF only</span><span>Excludes VAT</span></div>
  </div>
 </section>

 <section class="dkxsr-hero" style="min-height:0;padding-bottom:2rem">
  <div class="dkxsr-shell">
   <p class="dkxsr-eyebrow">Rates / Four systems</p>
   <h2>Exactly the same packages.<br><em>Exactly the same rates.</em></h2>
   <nav class="dkxsr-family-nav" aria-label="Rate families">
    <?php foreach($solution_families as $family): ?><a class="<?php echo esc_attr($family['class']); ?>" href="#<?php echo esc_attr($family['slug']); ?>"><span><?php echo esc_html($family['number']); ?></span><?php echo esc_html($family['title']); ?></a><?php endforeach; ?>
   </nav>
  </div>
 </section>

 <div class="dkxsr-families">
 <?php foreach($solution_families as $family): ?>
  <section class="dkxsr-family <?php echo esc_attr($family['class']); ?>" id="<?php echo esc_attr($family['slug']); ?>">
   <div class="dkxsr-shell">
    <header class="dkxsr-family-head">
     <div><p class="dkxsr-family-kicker"><?php echo esc_html($family['number']); ?> / <?php echo esc_html($family['title']); ?></p><h2><?php echo esc_html($family['title']); ?></h2></div>
     <p class="dkxsr-family-tagline"><?php echo esc_html($family['tagline']); ?></p>
    </header>
    <div class="dkxsr-package-grid">
    <?php foreach($family['packages'] as $package_index=>$package): $package_slug=$solution_package_slugs[$family['slug']][$package_index]??''; ?>
     <article class="dkxsr-package <?php echo $package['badge']?'is-featured':''; ?>">
      <?php if($package['badge']): ?><b class="dkxsr-badge"><?php echo esc_html($package['badge']); ?></b><?php endif; ?>
      <header><span><?php echo esc_html(str_pad((string)($package_index+1),2,'0',STR_PAD_LEFT)); ?></span><h3><?php echo esc_html($package['name']); ?></h3></header>
      <p class="dkxsr-price"><?php if(!empty($package['prefix'])): ?><small><?php echo esc_html($package['prefix']); ?></small><?php endif; ?><strong><?php echo esc_html($package['price']); ?></strong><?php if($package['suffix']): ?><span><?php echo esc_html($package['suffix']); ?></span><?php endif; ?></p>
      <p class="dkxsr-description"><?php echo esc_html($package['description']); ?></p>
      <ul><?php foreach($package['features'] as $feature): ?><li><?php echo wp_kses_post($feature); ?></li><?php endforeach; ?></ul>
      <a href="<?php echo esc_url(dkxv4_package_contact_url($package_slug)); ?>">Start with <?php echo esc_html($package['name']); ?> <span>↗</span></a>
     </article>
    <?php endforeach; ?>
    </div>
   </div>
  </section>
 <?php endforeach; ?>
 </div>

 <section class="dkxsr-custom">
  <div class="dkxsr-shell dkxsr-custom-grid">
   <div><p class="dkxsr-eyebrow">Need something that does not fit in a box?</p><h2>Build a custom<br><em>campaign.</em></h2></div>
   <div><p class="dkxsr-custom-copy">Starting rates exclude VAT where applicable. Final quotations depend on scope, crew, production requirements, travel and deliverables. Project bookings require a <strong>50</strong>% deposit. Retainers carry a three-month minimum.</p><div class="dkxsr-actions"><a class="is-primary" href="<?php echo esc_url(dkxv4_package_contact_url()); ?>">Start a project <span>↗</span></a><a href="<?php echo esc_url($rate_card_url); ?>" data-dkx-rate-download>Download Full PDF <span>↓</span></a></div></div>
  </div>
 </section>
</main>
<?php get_footer(); ?>
