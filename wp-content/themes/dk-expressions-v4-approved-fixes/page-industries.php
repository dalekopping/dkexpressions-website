<?php
/**
 * Template Name: DK Expressions Industries — Signal Map
 * v1.18.9
 */
get_header();
$industries = array(
 array('01','ENTERTAINMENT & LIVE EVENTS','This is where DK Expressions was forged.','Concerts, festivals, comedy, theatre, exhibitions, international tours and cultural experiences. We understand the difference between simply announcing an event and making people feel that they cannot afford to miss it.','Event promotion · Artist features · Photography · Reviews · Social amplification · Competitions · Interviews · SEO','#43baff'),
 array('02','MUSIC','From emerging performers to global stages.','Music has been part of the DK Expressions DNA since the beginning. Our journey has crossed paths with John Legend, Carlos Santana, Bruce Springsteen, Justin Bieber, Michael Bublé, One Direction, Foo Fighters, UB40 and many more.','Live coverage · Artist storytelling · Photography · Tour announcements','#8d6bff'),
 array('03','FILM, THEATRE & PERFORMING ARTS','Extend the experience beyond the venue.','From premieres and productions to reviews and interviews, we create content that communicates the emotion and spectacle of live performance and screen entertainment.','Reviews · Premieres · Production coverage · Interviews','#ff536d'),
 array('04','TECHNOLOGY & GAMING','Specifications tell. Stories explain why it matters.','Technology launches, product experiences, reviews, gaming coverage and digital storytelling that translates technical products into human experiences.','Launches · Reviews · Product storytelling · Gaming','#34d399'),
 array('05','LIFESTYLE & HOSPITALITY','Sell the feeling, not only the features.','Photography, editorial and digital campaigns for hospitality, travel, lifestyle and experience-driven businesses.','Photography · Editorial · Experiences · Digital campaigns','#ffc857'),
 array('06','PROPERTY & REAL ESTATE','Turn property into opportunity.','Visual storytelling, digital advertising, copywriting, social content and campaign strategy that transform properties into compelling opportunities.','Property photography · Listing content · Social campaigns · Digital advertising','#fb923c'),
 array('07','CORPORATE & B2B','Corporate communication does not have to feel corporate.','We translate complex propositions into clear, engaging stories through executive positioning, events, content, photography and digital campaigns.','Executive positioning · Events · Content · Photography · Digital campaigns','#22d3ee'),
);
?>
<section class="dk-industries-hero" id="top">
 <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('industries_kicker','Where we work')); ?></p><h1><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('industries_heading',"Different industries.\nOne obsession:\nattention."))); ?></h1>
 <p><?php echo esc_html(dkxv4_page_meta('industries_intro','We start with the audience and the objective — not a generic marketing template.')); ?></p>
</section>
<section class="dk-industry-map dk-section">
 <div class="dk-industry-map-axis"><span>DK / SIGNAL MAP</span><i></i><b>2013 — ∞</b></div>
 <div class="dk-industry-grid">
 <?php foreach($industries as $item): ?>
  <article class="dk-industry-card" style="--industry:<?php echo esc_attr($item[5]); ?>">
   <span><?php echo esc_html($item[0]); ?></span><small>INDUSTRY SIGNAL</small><h2><?php echo esc_html($item[1]); ?></h2><h3><?php echo esc_html($item[2]); ?></h3><p><?php echo esc_html($item[3]); ?></p><footer><?php echo esc_html($item[4]); ?></footer>
  </article>
 <?php endforeach; ?>
 </div>
</section>
<section class="dk-vault-end dk-section"><p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('industries_cta_kicker','Your industry is not listed?')); ?></p><h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('industries_cta_heading',"Good.\nSurprise us."))); ?></h2><p><?php echo esc_html(dkxv4_page_meta('industries_cta_copy','Tell us who you need to reach and what you need to achieve. We will build around the objective.')); ?></p><a class="dk-button" href="<?php echo esc_url(home_url('/contact/')); ?>">Let’s build something ↗</a></section>
<?php get_footer(); ?>
