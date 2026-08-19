<?php
/**
 * Template Name: DK Expressions Contact — Start a Project
 * v1.19.8
 */
get_header();
$sent = isset($_GET['project']) && 'sent' === sanitize_key($_GET['project']);
?>
<section class="dk-contact-hero" id="top">
  <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('contact_kicker','Start a Project · DK Expressions 2026')); ?></p>
  <h1><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('contact_heading',"Tell us what\nneeds attention."))); ?></h1>
  <p><?php echo esc_html(dkxv4_page_meta('contact_intro','Give us the objective, the timeline and enough context to understand what success should look like. We’ll take it from there.')); ?></p>
</section>

<section class="dk-contact-conversion dk-section">
  <div class="dk-contact-side">
    <p class="dk-kicker"><?php echo esc_html(dkxv4_page_meta('contact_side_kicker','Two ways in')); ?></p>
    <h2><?php echo wp_kses_post(dkxv4_multiline_heading(dkxv4_page_meta('contact_side_heading',"Brief us properly.\nOr WhatsApp us now."))); ?></h2>
    <p><?php echo esc_html(dkxv4_page_meta('contact_side_copy','For structured campaign work, use the form. For a faster conversation, WhatsApp DK Expressions directly.')); ?></p>
    <a class="dk-contact-wa" href="https://wa.me/27722460451?text=<?php echo rawurlencode('Hi Dale, I would like to discuss a project with DK Expressions.'); ?>" target="_blank" rel="noopener">WhatsApp +27 72 246 0451 ↗</a>
    <div class="dk-contact-details">
      <span>Email</span><a href="mailto:<?php echo esc_attr(dkxv4_content('contact_email')); ?>"><?php echo esc_html(dkxv4_content('contact_email')); ?></a>
      <span>Based in</span><b>Johannesburg · South Africa</b>
    </div>
  </div>
  <form class="dk-project-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="action" value="dkx_project_enquiry">
    <?php wp_nonce_field('dkx_project_enquiry','dkx_project_nonce'); ?>
    <?php if($sent): ?><div class="dk-form-success">Project brief sent. We’ll be in touch.</div><?php endif; ?>
    <div class="dk-form-row">
      <label><span>Your name *</span><input type="text" name="project_name" required></label>
      <label><span>Company</span><input type="text" name="project_company"></label>
    </div>
    <label><span>Email address *</span><input type="email" name="project_email" required></label>
    <label><span>What do you need?</span>
      <select name="project_service">
        <option value="Brand Amplification">Brand Amplification</option>
        <option value="Content & Storytelling">Content & Storytelling</option>
        <option value="Event Domination">Event Domination</option>
        <option value="Photography & Visual Storytelling">Photography & Visual Storytelling</option>
        <option value="Digital & Social Media">Digital & Social Media</option>
        <option value="SEO & Digital Publishing">SEO & Digital Publishing</option>
        <option value="Competitions & Audience Activation">Competitions & Audience Activation</option>
        <option value="Executive & Personal Branding">Executive & Personal Branding</option>
        <option value="Other">Something else</option>
      </select>
    </label>
    <label><span>Budget range</span>
      <select name="project_budget">
        <option value="Under R10,000">Under R10,000</option>
        <option value="R10,000 – R25,000">R10,000 – R25,000</option>
        <option value="R25,000 – R50,000">R25,000 – R50,000</option>
        <option value="R50,000 – R100,000">R50,000 – R100,000</option>
        <option value="R100,000+">R100,000+</option>
        <option value="Not sure yet">Not sure yet</option>
      </select>
    </label>
    <label><span>When do you need it?</span><input type="text" name="project_timeline" placeholder="Event date / launch date / preferred start"></label>
    <label><span>Project brief *</span><textarea name="project_brief" rows="8" required placeholder="What are you trying to achieve? Who is the audience? What does success look like?"></textarea></label>
    <button type="submit" class="dk-button">Send Project Brief ↗</button>
  </form>
</section>
<?php get_footer(); ?>
