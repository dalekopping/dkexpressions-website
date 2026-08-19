<?php
/**
 * Template Name: DK Expressions Rates & Packages
 * Commercial pricing architecture — v1.18.5
 */
get_header();
$wa = 'https://wa.me/27722460451?text=' . rawurlencode('Hi Dale, I would like to discuss a DK Expressions package.');
$groups = array(
 array('01','EVENT DOMINATION','Turn the event into something people wish they attended.','events',array(
  array('SPARK','R6,500','/ event','Entry coverage to get a brand in the door',array('Up to 4 hours on site','1 creator','40 edited photos','2 short-form reels','Next-day delivery')),
  array('SIGNATURE','R32,000','/ event','The core package most events should buy',array('Up to 8 hours','Photo + video','Live posting during the event','5 reels + 80 edited photos','Same-day teaser edit','Post-event recap reel'),'MOST CHOSEN'),
  array('TAKEOVER','From R95,000','','Multi-day or flagship productions',array('Crew of 2–4 creators','Real-time social management','Daily reels + stories','Creator/influencer coordination','Full post-event campaign + report')))),
 array('02','ALWAYS ON','Your brand should not disappear between campaigns.','brands',array(
  array('ESSENTIAL','R15,000','/ month','Consistent presence for one brand',array('1 content shoot per month','12 edited posts','4 reels','Monthly content calendar','Basic monthly report')),
  array('PREMIUM','R35,000','/ month','Full content and growth partner',array('2 shoots per month','20 posts + 8 reels','Full social media management','Content strategy + calendar','Paid ad creative','Monthly performance report'),'MOST CHOSEN'),
  array('ELITE','From R60,000','/ month','Own the category online',array('Weekly shoots + content drops','Unlimited posts within scope','Full social + community management','Monthly event coverage','Paid ad management','Dedicated strategy sessions')))),
 array('03','BECOME THE NAME','People cannot hire, book or invest in someone they never see.','people',array(
  array('STARTER','R18,000','/ month','Show up consistently and look the part',array('1 shoot per month','12 personal-brand posts','4 short-form videos','Instagram + TikTok content')),
  array('GROWTH','R40,000','/ month','Build real authority and reach',array('2 shoots per month','20 posts + 8 videos','Personal-brand strategy','Full content management','Interview/talking-head series','Monthly review + reporting'),'MOST CHOSEN'),
  array('AUTHORITY','From R75,000','/ month','Become the name in your field',array('Weekly content production','Media + PR positioning','Podcast/video show production','Full multi-platform management','Ghostwriting + thought leadership','Quarterly brand strategy sessions')))),
 array('04','OWN THE ATTENTION','Turn DK Expressions publishing authority into sustained brand visibility.','media',array(
  array('FEATURE','R1,500','/ placement','A focused sponsored editorial feature',array('1 dedicated editorial listing','1 social amplification post','Live for 12 months')),
  array('SPOTLIGHT','R6,000','/ campaign','Sustained presence over a season',array('8 editorial listings','Social amplification on each','Instagram + Facebook + X coverage','Campaign-window placement'),'BEST VALUE'),
  array('HEADLINE','R12,500','/ campaign','Dominant ongoing exposure',array('16 editorial listings','Full social amplification per post','Priority placement + tagging','Optional event-coverage tie-in'))))
);
?>
<section class="dk-rates-hero dk-section"><p class="dk-kicker">Invest in attention</p><h1>Not hours. Not posts.<br><em>Outcomes.</em></h1><p>Every brand is at a different point in time. Choose where you want to go next.</p><nav class="dk-rates-jump" aria-label="Pricing categories"><a href="#events">Events</a><a href="#brands">Brands</a><a href="#people">People</a><a href="#media">Media</a></nav></section>
<?php foreach($groups as $g): ?>
<section class="dk-rate-group dk-section" id="<?php echo esc_attr($g[3]); ?>">
 <div class="dk-section-head"><div><p class="dk-kicker"><?php echo esc_html($g[0]); ?> / <?php echo esc_html($g[1]); ?></p><h2><?php echo esc_html($g[1]); ?></h2></div><p><?php echo esc_html($g[2]); ?></p></div>
 <div class="dk-rate-grid">
 <?php foreach($g[4] as $tier): $featured=!empty($tier[5]); ?>
  <article class="dk-rate-card<?php echo $featured?' is-featured':''; ?>">
   <?php if($featured): ?><span class="dk-rate-badge"><?php echo esc_html($tier[5]); ?></span><?php endif; ?>
   <p class="dk-rate-name"><?php echo esc_html($tier[0]); ?></p><h3><?php echo esc_html($tier[1]); ?> <small><?php echo esc_html($tier[2]); ?></small></h3><p><?php echo esc_html($tier[3]); ?></p>
   <ul><?php foreach($tier[4] as $item): ?><li><?php echo esc_html($item); ?></li><?php endforeach; ?></ul>
   <a class="dk-button" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener">Discuss this package ↗</a>
  </article>
 <?php endforeach; ?>
 </div>
</section>
<?php endforeach; ?>
<section class="dk-section dk-rate-custom"><p class="dk-kicker">Need something that does not fit in a box?</p><h2>Build a custom campaign.</h2><p>Starting rates exclude VAT where applicable. Final quotations depend on scope, crew, production requirements, travel and deliverables. Project bookings require a 50% deposit. Retainers carry a three-month minimum.</p><div class="dk-home-actions"><a class="dk-button" href="<?php echo esc_url(home_url('/contact/')); ?>">Start a project ↗</a><a class="dk-text-link" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener">WhatsApp us →</a></div></section>
<?php get_footer(); ?>
