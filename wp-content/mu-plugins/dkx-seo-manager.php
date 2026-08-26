<?php
/**
 * Plugin Name: DK Expressions SEO Manager
 * Description: Editable page-level SEO controls layered safely over the locked DK Master SEO defaults.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_seom_defaults_for_post( $post_id ) {
    $post_id = absint( $post_id );
    $slug = $post_id ? get_post_field( 'post_name', $post_id ) : '';
    $is_front = $post_id && (int) get_option( 'page_on_front' ) === $post_id;
    $map = array(
        'landing' => array(
            'title' => 'DK Expressions | Premium Creative, Media & Brand Storytelling',
            'description' => 'Enter the DK Expressions universe: premium creative, media, event coverage and brand storytelling built in Johannesburg since 2013.',
            'primary_keyword' => 'DK Expressions',
            'secondary_keywords' => 'creative agency Johannesburg, media agency South Africa, brand storytelling, event content agency',
        ),
        'home' => array(
            'title' => 'Event Photography & Brand Storytelling | DK Expressions',
            'description' => 'Premium event photography, brand content and storytelling in Johannesburg since 2013. Fixed packages from R6,500. Start your project today.',
            'primary_keyword' => 'event photography Johannesburg',
            'secondary_keywords' => 'brand storytelling Johannesburg, event content South Africa, commercial photography Johannesburg, creative content agency',
        ),
        'solutions' => array(
            'title' => 'Brand Content, Event Coverage & Retainers | DK Expressions',
            'description' => 'Strategy, photography, film, executive branding, media placements and ongoing brand retainers. Clear packages and fixed scopes.',
            'primary_keyword' => 'brand content agency Johannesburg',
            'secondary_keywords' => 'event coverage Johannesburg, content retainers South Africa, executive personal branding, media placements South Africa',
        ),
        'industries' => array(
            'title' => 'Industries We Serve | Entertainment, Hospitality, Property & More',
            'description' => 'DK Expressions works across live events, music, hospitality, real estate, corporate and web & AI. One obsession: attention.',
            'primary_keyword' => 'creative agency South Africa',
            'secondary_keywords' => 'entertainment marketing South Africa, hospitality content agency, real estate content Johannesburg, corporate content agency',
        ),
        'our-work' => array(
            'title' => 'Time Vault – 13 Years of Captured Moments | DK Expressions',
            'description' => 'Real photography and film from concerts, festivals, theatre and brands since 2013. Not stock. Not mock-ups. See the work.',
            'primary_keyword' => 'event photography portfolio South Africa',
            'secondary_keywords' => 'concert photography South Africa, festival photography Johannesburg, brand photography portfolio, event videography South Africa',
        ),
        'rates' => array(
            'title' => '2026 Rate Card – Clear Packages, Fixed Scopes | DK Expressions',
            'description' => 'Event Domination from R6,500. Brand Retainers from R15,000/month. Executive branding and media placement packages available.',
            'primary_keyword' => 'event photography rates Johannesburg',
            'secondary_keywords' => 'content creation prices South Africa, brand retainer pricing, event coverage packages, social media content rates',
        ),
        'about' => array(
            'title' => 'About DK Expressions – Time Travellers Since 2013',
            'description' => 'Not a media company. A time machine. Founded in Johannesburg in 2013. Meet the Time Travellers and the standard behind the work.',
            'primary_keyword' => 'DK Expressions Johannesburg',
            'secondary_keywords' => 'DK Expressions team, creative agency Johannesburg, event media company South Africa, Time Travellers DK Expressions',
        ),
        'contact' => array(
            'title' => 'Start a Project | DK Expressions Johannesburg',
            'description' => 'Tell us what you are launching, promoting or transforming. Start a direct conversation with DK Expressions in Johannesburg.',
            'primary_keyword' => 'creative agency Johannesburg contact',
            'secondary_keywords' => 'event photographer Johannesburg contact, content agency Johannesburg, brand storytelling agency contact',
        ),
        'insights' => array(
            'title' => 'Insights – News, Reviews & Stories | DK Expressions',
            'description' => 'Entertainment news, interviews, reviews, event coverage and industry notes from the rooms we are in.',
            'primary_keyword' => 'South African entertainment news',
            'secondary_keywords' => 'event reviews South Africa, entertainment interviews South Africa, concert news Johannesburg, culture news South Africa',
        ),
    );
    $key = $is_front ? 'landing' : $slug;
    if ( ! isset( $map[ $key ] ) && 'time-vault' === $slug ) $key = 'our-work';
    $base = isset( $map[ $key ] ) ? $map[ $key ] : array(
        'title' => get_the_title( $post_id ) . ' | DK Expressions',
        'description' => '', 'primary_keyword' => '', 'secondary_keywords' => ''
    );
    $base['canonical'] = $post_id ? get_permalink( $post_id ) : '';
    $base['social_title'] = $base['title'];
    $base['social_description'] = $base['description'];
    $base['social_image_id'] = 0;
    $base['index'] = 'index';
    $base['follow'] = 'follow';
    $base['schema_type'] = in_array( $key, array( 'solutions', 'rates' ), true ) ? 'service' : 'webpage';
    return $base;
}

function dkx_seom_get( $post_id ) {
    $defaults = dkx_seom_defaults_for_post( $post_id );
    $saved = get_post_meta( absint( $post_id ), '_dkx_seo_manager', true );
    return wp_parse_args( is_array( $saved ) ? $saved : array(), $defaults );
}

function dkx_seom_current() {
    if ( ! is_singular( array( 'page', 'post' ) ) ) return array();
    return dkx_seom_get( get_queried_object_id() );
}

add_action( 'add_meta_boxes', function() {
    add_meta_box( 'dkx-seo-manager', 'DK SEO Manager', 'dkx_seom_box', array( 'page', 'post' ), 'normal', 'high' );
} );

function dkx_seom_box( $post ) {
    $v = dkx_seom_get( $post->ID );
    wp_nonce_field( 'dkx_seom_save_' . $post->ID, 'dkx_seom_nonce' );
    $image = ! empty( $v['social_image_id'] ) ? wp_get_attachment_image_url( (int) $v['social_image_id'], 'medium' ) : '';
    ?>
    <style>
    .dkx-seom{background:#02070c;color:#e6eef3;padding:18px;border-radius:6px}.dkx-seom-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}.dkx-seom label{display:block;color:#40b8ff;font-weight:700;margin-bottom:6px}.dkx-seom input[type=text],.dkx-seom input[type=url],.dkx-seom textarea,.dkx-seom select{width:100%;background:#07131c;color:#fff;border:1px solid #264557}.dkx-seom textarea{min-height:76px}.dkx-seom small{color:#9db2c2}.dkx-seom .wide{grid-column:1/-1}.dkx-seom-preview{padding:14px;background:#07131c;border-left:4px solid #40b8ff;margin-top:16px}.dkx-seom-preview strong{display:block;color:#40b8ff;font-size:17px}.dkx-seom-preview p{margin:5px 0;color:#c7d6df}.dkx-seom-image img{max-width:180px;height:auto;margin-top:8px;border:1px solid #264557}@media(max-width:782px){.dkx-seom-grid{grid-template-columns:1fr}.dkx-seom .wide{grid-column:auto}}
    </style>
    <div class="dkx-seom">
      <div class="dkx-seom-grid">
        <div class="wide"><label>SEO Title</label><input type="text" name="dkx_seom[title]" value="<?php echo esc_attr( $v['title'] ); ?>"><small>Aim for roughly 50–60 characters.</small></div>
        <div class="wide"><label>Meta Description</label><textarea name="dkx_seom[description]"><?php echo esc_textarea( $v['description'] ); ?></textarea><small>Aim for roughly 140–160 characters.</small></div>
        <div><label>Primary Focus Keyword</label><input type="text" name="dkx_seom[primary_keyword]" value="<?php echo esc_attr( $v['primary_keyword'] ); ?>"></div>
        <div><label>Secondary Keywords</label><input type="text" name="dkx_seom[secondary_keywords]" value="<?php echo esc_attr( $v['secondary_keywords'] ); ?>"><small>Internal optimisation guidance; not output as an obsolete meta-keywords tag.</small></div>
        <div class="wide"><label>Canonical URL</label><input type="url" name="dkx_seom[canonical]" value="<?php echo esc_attr( $v['canonical'] ); ?>"></div>
        <div><label>Social Title</label><input type="text" name="dkx_seom[social_title]" value="<?php echo esc_attr( $v['social_title'] ); ?>"></div>
        <div><label>Schema Type</label><select name="dkx_seom[schema_type]"><option value="webpage" <?php selected($v['schema_type'],'webpage'); ?>>WebPage</option><option value="service" <?php selected($v['schema_type'],'service'); ?>>Service-focused page</option><option value="about" <?php selected($v['schema_type'],'about'); ?>>AboutPage</option><option value="contact" <?php selected($v['schema_type'],'contact'); ?>>ContactPage</option><option value="collection" <?php selected($v['schema_type'],'collection'); ?>>CollectionPage</option></select></div>
        <div class="wide"><label>Social Description</label><textarea name="dkx_seom[social_description]"><?php echo esc_textarea( $v['social_description'] ); ?></textarea></div>
        <div class="dkx-seom-image"><label>Social Share Image</label><input type="hidden" id="dkx_seom_image_id" name="dkx_seom[social_image_id]" value="<?php echo (int) $v['social_image_id']; ?>"><button type="button" class="button" id="dkx_seom_image_btn">Choose image</button><button type="button" class="button" id="dkx_seom_image_clear">Clear</button><div id="dkx_seom_image_preview"><?php if($image): ?><img src="<?php echo esc_url($image); ?>" alt=""><?php endif; ?></div></div>
        <div><label>Search Engine Directives</label><select name="dkx_seom[index]"><option value="index" <?php selected($v['index'],'index'); ?>>Index</option><option value="noindex" <?php selected($v['index'],'noindex'); ?>>Noindex</option></select><select name="dkx_seom[follow]" style="margin-top:8px"><option value="follow" <?php selected($v['follow'],'follow'); ?>>Follow links</option><option value="nofollow" <?php selected($v['follow'],'nofollow'); ?>>Nofollow links</option></select></div>
      </div>
      <div class="dkx-seom-preview"><small>SEARCH PREVIEW</small><strong><?php echo esc_html( $v['title'] ); ?></strong><p><?php echo esc_html( $v['canonical'] ); ?></p><p><?php echo esc_html( $v['description'] ); ?></p></div>
    </div>
    <script>
    jQuery(function($){var frame;$('#dkx_seom_image_btn').on('click',function(e){e.preventDefault();if(frame){frame.open();return;}frame=wp.media({title:'Choose DK SEO social image',button:{text:'Use this image'},multiple:false,library:{type:'image'}});frame.on('select',function(){var a=frame.state().get('selection').first().toJSON();$('#dkx_seom_image_id').val(a.id);$('#dkx_seom_image_preview').html('<img src="'+a.url+'" alt="">');});frame.open();});$('#dkx_seom_image_clear').on('click',function(){ $('#dkx_seom_image_id').val('');$('#dkx_seom_image_preview').empty();});});
    </script>
    <?php
}

add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) wp_enqueue_media();
} );

add_action( 'save_post', function( $post_id ) {
    if ( ! isset( $_POST['dkx_seom_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkx_seom_nonce'] ) ), 'dkx_seom_save_' . $post_id ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $raw = isset( $_POST['dkx_seom'] ) && is_array( $_POST['dkx_seom'] ) ? wp_unslash( $_POST['dkx_seom'] ) : array();
    $clean = array(
        'title' => sanitize_text_field( $raw['title'] ?? '' ),
        'description' => sanitize_textarea_field( $raw['description'] ?? '' ),
        'primary_keyword' => sanitize_text_field( $raw['primary_keyword'] ?? '' ),
        'secondary_keywords' => sanitize_text_field( $raw['secondary_keywords'] ?? '' ),
        'canonical' => esc_url_raw( $raw['canonical'] ?? '' ),
        'social_title' => sanitize_text_field( $raw['social_title'] ?? '' ),
        'social_description' => sanitize_textarea_field( $raw['social_description'] ?? '' ),
        'social_image_id' => absint( $raw['social_image_id'] ?? 0 ),
        'schema_type' => in_array( $raw['schema_type'] ?? '', array('webpage','service','about','contact','collection'), true ) ? $raw['schema_type'] : 'webpage',
        'index' => ( $raw['index'] ?? 'index' ) === 'noindex' ? 'noindex' : 'index',
        'follow' => ( $raw['follow'] ?? 'follow' ) === 'nofollow' ? 'nofollow' : 'follow',
    );
    update_post_meta( $post_id, '_dkx_seo_manager', $clean );
}, 20 );

/* Override the locked defaults only when viewing a singular page/post. */
add_filter( 'pre_get_document_title', function( $title ) { $m=dkx_seom_current(); return !empty($m['title'])?$m['title']:$title; }, 2000 );
add_filter( 'wpseo_title', function($v){$m=dkx_seom_current();return !empty($m['title'])?$m['title']:$v;},2000);
add_filter( 'wpseo_metadesc', function($v){$m=dkx_seom_current();return !empty($m['description'])?$m['description']:$v;},2000);
add_filter( 'wpseo_canonical', function($v){$m=dkx_seom_current();return !empty($m['canonical'])?$m['canonical']:$v;},2000);
add_filter( 'wpseo_opengraph_title', function($v){$m=dkx_seom_current();return !empty($m['social_title'])?$m['social_title']:(!empty($m['title'])?$m['title']:$v);},2000);
add_filter( 'wpseo_opengraph_desc', function($v){$m=dkx_seom_current();return !empty($m['social_description'])?$m['social_description']:(!empty($m['description'])?$m['description']:$v);},2000);
add_filter( 'wpseo_opengraph_url', function($v){$m=dkx_seom_current();return !empty($m['canonical'])?$m['canonical']:$v;},2000);
add_filter( 'wpseo_twitter_title', function($v){$m=dkx_seom_current();return !empty($m['social_title'])?$m['social_title']:(!empty($m['title'])?$m['title']:$v);},2000);
add_filter( 'wpseo_twitter_description', function($v){$m=dkx_seom_current();return !empty($m['social_description'])?$m['social_description']:(!empty($m['description'])?$m['description']:$v);},2000);
add_filter( 'wpseo_opengraph_image', function($v){$m=dkx_seom_current();$u=!empty($m['social_image_id'])?wp_get_attachment_image_url((int)$m['social_image_id'],'full'):'';return $u?:$v;},2000);
add_filter( 'wpseo_twitter_image', function($v){$m=dkx_seom_current();$u=!empty($m['social_image_id'])?wp_get_attachment_image_url((int)$m['social_image_id'],'full'):'';return $u?:$v;},2000);

add_filter( 'wp_robots', function( $robots ) {
    $m = dkx_seom_current();
    if ( !$m ) return $robots;
    if ( 'noindex' === $m['index'] ) { $robots['noindex']=true; unset($robots['index']); } else { $robots['index']=true; unset($robots['noindex']); }
    if ( 'nofollow' === $m['follow'] ) { $robots['nofollow']=true; unset($robots['follow']); } else { $robots['follow']=true; unset($robots['nofollow']); }
    return $robots;
}, 2000 );

/* Four canonical commercial services; replaces older two-service graph pieces. */
function dkx_seom_services() {
    if ( ! is_page( array( 'solutions','rates','agency','rate-card' ) ) ) return array();
    $provider=array('@id'=>home_url('/#organization')); $area=array('@type'=>'Country','name'=>'South Africa');
    return array(
      array('@type'=>'Service','@id'=>home_url('/solutions/#event-domination'),'name'=>'Event Domination','provider'=>$provider,'areaServed'=>$area,'offers'=>array(
        array('@type'=>'Offer','name'=>'Spark','price'=>'6500','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#event-domination')),
        array('@type'=>'Offer','name'=>'Signature','price'=>'32000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#event-domination')),
        array('@type'=>'Offer','name'=>'Takeover','price'=>'95000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#event-domination')))),
      array('@type'=>'Service','@id'=>home_url('/solutions/#always-on'),'name'=>'Always On / Brand Content Retainer','provider'=>$provider,'areaServed'=>$area,'offers'=>array(
        array('@type'=>'Offer','name'=>'Essential','price'=>'15000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#always-on')),
        array('@type'=>'Offer','name'=>'Premium','price'=>'35000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#always-on')),
        array('@type'=>'Offer','name'=>'Elite','price'=>'60000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#always-on')))),
      array('@type'=>'Service','@id'=>home_url('/solutions/#become-the-name'),'name'=>'Become the Name / Executive Personal Branding','provider'=>$provider,'areaServed'=>$area,'offers'=>array(
        array('@type'=>'Offer','name'=>'Starter','price'=>'18000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#become-the-name')),
        array('@type'=>'Offer','name'=>'Growth','price'=>'40000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#become-the-name')),
        array('@type'=>'Offer','name'=>'Authority','price'=>'75000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#become-the-name')))),
      array('@type'=>'Service','@id'=>home_url('/solutions/#own-the-attention'),'name'=>'Own the Attention / Media Placements','provider'=>$provider,'areaServed'=>$area,'offers'=>array(
        array('@type'=>'Offer','name'=>'Feature','price'=>'1500','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#own-the-attention')),
        array('@type'=>'Offer','name'=>'Spotlight','price'=>'6000','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#own-the-attention')),
        array('@type'=>'Offer','name'=>'Headline','price'=>'12500','priceCurrency'=>'ZAR','url'=>home_url('/solutions/#own-the-attention')))),
    );
}

add_filter( 'wpseo_schema_graph', function( $graph ) {
    if ( ! is_page( array( 'solutions','rates','agency','rate-card' ) ) ) return $graph;
    $clean=array();
    foreach((array)$graph as $piece){$types=(array)($piece['@type']??'');$id=(string)($piece['@id']??'');if(in_array('Service',$types,true) && false!==strpos($id,'/solutions/#')) continue;$clean[]=$piece;}
    foreach(dkx_seom_services() as $service)$clean[]=$service;
    return $clean;
}, 2000 );

/* Make Landing and Home distinct even before any manual edits are saved. */
add_filter( 'wpseo_canonical', function( $url ) {
    if ( is_front_page() ) return home_url('/');
    if ( is_page('home') ) return home_url('/home/');
    return $url;
}, 2100 );

/* Add direct access from Pages list. */
add_filter( 'page_row_actions', function( $actions, $post ) {
    if ( current_user_can('edit_post',$post->ID) ) $actions['dkx_seo']='<a href="'.esc_url(get_edit_post_link($post->ID,'raw').'#dkx-seo-manager').'">DK SEO</a>';
    return $actions;
}, 30, 2 );
