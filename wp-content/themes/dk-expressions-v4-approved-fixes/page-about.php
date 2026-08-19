<?php
/**
 * Template Name: DK Expressions About — Time Machine
 * v1.20.3
 */
get_header();

$team = array(
    array(dkxv4_page_meta('about_dale_name','Dale Kopping'),dkxv4_page_meta('about_dale_role','Founder / Editor / International Photographer'),'dale',array('dale kopping','dale-kopping','dale'),dkxv4_page_meta('about_dale_bio','Founder of DK Expressions. Photographer, publisher, strategist and professional collector of moments that should not disappear.')),
    array(dkxv4_page_meta('about_estelle_name','Estelle Janse van Rensburg'),dkxv4_page_meta('about_estelle_role','2IC / Photojournalist / Content Creator / Client Liaison'),'estelle',array('estelle janse van rensburg','estelle janse','estelle'),dkxv4_page_meta('about_estelle_bio','Part of DK Expressions since 2014. Her first assignment was the Monster Motorcross Nationals, where she captured more than 4,000 images in one weekend — and roughly 2,500 of them were exceptional enough to use. Hundreds of events and thousands of listings later, she remains one of the minds behind the machine.')),
    array(dkxv4_page_meta('about_craig_name','Craig Muscat'),dkxv4_page_meta('about_craig_role','Photojournalist / Content Creator / Mad Scientist'),'craig',array('craig muscat','craig-muscat'),dkxv4_page_meta('about_craig_bio','Joined the Time Travellers in 2023. First assignment: Sexpo. Then ULTRA, Comic Con, Calabash and more. Equal parts photojournalist, creator and mad scientist, with ideas that occasionally sound questionable for five seconds before turning out to be annoyingly good.')),
    array(dkxv4_page_meta('about_lucky_name','Lucky Mthabela'),dkxv4_page_meta('about_lucky_role','Photojournalist / PRETTIPIKTURES / Time Traveller'),'lucky',array('lucky mthabela','lucky-mthabela','prettipiktures','pretti piktures','lucky'),dkxv4_page_meta('about_lucky_bio','Joined the DK Expressions journey around 2015 after a chance meeting at an event in Marshalltown. What began with learning event photography became a full-time photographic career and PRETTIPIKTURES. Years of stages, artists and events later, the relationship is far closer to brotherhood than business.')),
);
?>
<section class="dk-about-shot-hero" id="top">
    <div class="dk-about-shot-stars" aria-hidden="true"></div>
    <div class="dk-about-shot-orbit" aria-hidden="true"></div>
    <div class="dk-about-shot-copy">
        <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('about_tm_kicker','Since February 2013')); ?></p>
        <h1><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('about_tm_heading',"Not a media company.\nA time machine."))); ?></h1>
        <p><?php echo esc_html(dkxv4_page_meta('about_tm_intro','DK Expressions began in Johannesburg with one camera, determination, imagination and the belief that moments matter. Our Time Travellers capture culture as it happens and build stories that keep moving long after the lights go down.')); ?></p>
    </div>
</section>

<section class="dk-about-shot-origin dk-section">
    <p class="dk-about-shot-lead"><?php echo esc_html(dkxv4_page_meta('about_origin_lead','Stories that move people. Experiences they will never forget.')); ?></p>

    <h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('about_origin_heading',"Born in Johannesburg.\nBuilt for everywhere."))); ?></h2>

    <div class="dk-about-shot-copygrid">
        <p><?php echo esc_html(dkxv4_page_meta('about_origin_1','DK Expressions began in February 2013 with one camera and a belief that moments matter. What started as founder Dale Kopping capturing one experience at a time grew into an independent media, creative and brand-storytelling company.')); ?></p>
        <p><?php echo esc_html(dkxv4_page_meta('about_origin_2','Our Time Travellers move through entertainment, culture, events, hospitality, lifestyle and technology—preserving the emotion of each moment and transforming it into stories that continue travelling.')); ?></p>
        <p><?php echo esc_html(dkxv4_page_meta('about_origin_3','We combine photography, film, editorial, digital strategy and emerging technology into one connected creative experience.')); ?></p>
        <p><?php echo esc_html(dkxv4_page_meta('about_origin_4','We do not simply document what happened. We preserve what it felt like—and help brands turn that connection into legacy.')); ?></p>
    </div>

    <div class="dk-about-shot-values">
        <article><span>01</span><h3><?php echo esc_html(dkxv4_page_meta('about_value_1_title','Inspired')); ?></h3><p><?php echo esc_html(dkxv4_page_meta('about_value_1_copy','Work that sparks emotion, ideas and action.')); ?></p></article>
        <article><span>02</span><h3><?php echo esc_html(dkxv4_page_meta('about_value_2_title','Time Travellers')); ?></h3><p><?php echo esc_html(dkxv4_page_meta('about_value_2_copy','Creators who preserve the moments others might miss.')); ?></p></article>
        <article><span>03</span><h3><?php echo esc_html(dkxv4_page_meta('about_value_3_title','Legacy Builders')); ?></h3><p><?php echo esc_html(dkxv4_page_meta('about_value_3_copy','Leadership focused on value that lives beyond the campaign.')); ?></p></article>
        <article><span>04</span><h3><?php echo esc_html(dkxv4_page_meta('about_value_4_title','Inspire. Preserve. Build.')); ?></h3><p><?php echo esc_html(dkxv4_page_meta('about_value_4_copy','The idea behind every story, partnership and experience.')); ?></p></article>
    </div>
</section>

<section class="dk-team dk-section" id="time-travellers">
    <div class="dk-section-head">
        <div><p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('about_team_section_kicker','Meet the Time Travellers')); ?></p><h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('about_team_section_heading',"The minds behind\nthe moments."))); ?></h2></div>
        <p><?php echo esc_html(dkxv4_page_meta('about_team_section_intro','Different disciplines. Different personalities. One shared instinct: if something matters, capture it properly.')); ?></p>
    </div>
    <div class="dk-team-grid">
        <?php foreach($team as $index=>$member): $media=dkxv4_get_team_media($member[2], $member[3]); ?>
        <article class="dk-team-card">
            <div class="dk-team-portrait">
                <?php if($media && 0===strpos((string)get_post_mime_type($media),'image/')) echo wp_get_attachment_image($media->ID,'large',false,array('loading'=>'lazy','alt'=>$member[0])); else echo '<span>'.esc_html(substr($member[0],0,1)).'</span>'; ?>
                <i><?php echo esc_html(str_pad((string)($index+1),2,'0',STR_PAD_LEFT)); ?></i>
            </div>
            <div class="dk-team-copy"><small>TIME TRAVELLER</small><h3><?php echo esc_html($member[0]); ?></h3><strong><?php echo esc_html($member[1]); ?></strong><p><?php echo esc_html($member[4]); ?></p></div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="dk-join-team dk-section" id="join-the-time-travellers">
    <div class="dk-join-team-copy">
        <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('about_join_kicker','Wanna become a Time Traveller?')); ?></p>
        <h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('about_join_heading',"Think you belong\nin the timeline?"))); ?></h2>
        <p><?php echo esc_html(dkxv4_page_meta('about_join_copy','We are always interested in photographers, filmmakers, writers, creators, editors, strategists and wonderfully strange people who see the world differently. Send us your portfolio — or tell us why you should be part of the team.')); ?></p>
    </div>
    <form class="dk-time-traveller-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="dkx_time_traveller_application"><?php wp_nonce_field('dkx_time_traveller_application','dkx_time_traveller_nonce'); ?>
        <label><span>Your name *</span><input type="text" name="applicant_name" required></label>
        <label><span>Email address *</span><input type="email" name="applicant_email" required></label>
        <label><span>What do you do?</span><input type="text" name="applicant_role"></label>
        <label><span>Portfolio link</span><input type="url" name="portfolio_url" placeholder="https://"></label>
        <label><span>Upload portfolio</span><input type="file" name="portfolio_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></label>
        <label><span>Why do you want to become a Time Traveller? *</span><textarea name="applicant_reason" rows="7" required></textarea></label>
        <div class="dk-application-actions"><button type="submit" class="dk-button">Send Application ↗</button><a class="dk-application-whatsapp" href="https://wa.me/27722460451?text=<?php echo rawurlencode('Hi Dale, I am interested in becoming a Time Traveller at DK Expressions and would like to share my portfolio.'); ?>" target="_blank" rel="noopener">Apply via WhatsApp ↗</a></div>
    </form>
</section>
<?php get_footer(); ?>
