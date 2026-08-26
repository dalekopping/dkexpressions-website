<?php
/**
 * Plugin Name: DK Expressions Rate Card PDF Only
 * Description: Blocks legacy Word/DOCX rate-card routes so only PDF rate cards are publicly available.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'template_redirect', function() {
    if ( ! isset( $_GET['dkx_rate_card'] ) ) return;
    $key = sanitize_key( wp_unslash( $_GET['dkx_rate_card'] ) );
    if ( 'one-page-docx-2026' !== $key ) return;

    status_header( 404 );
    nocache_headers();
    header( 'Content-Type: text/plain; charset=UTF-8' );
    echo 'This download format is not available.';
    exit;
}, 0 );

add_action( 'wp_footer', function() {
    if ( is_admin() ) return;
    ?>
<script id="dkx-remove-docx-rate-links">
(function(){
  function clean(root){
    (root||document).querySelectorAll('a[href]').forEach(function(a){
      var href=(a.getAttribute('href')||'').toLowerCase();
      var text=(a.textContent||'').toLowerCase();
      if(href.indexOf('.docx')!==-1 || href.indexOf('one-page-docx-2026')!==-1 || /word|docx/.test(text)){
        if(/rate card|one-page|commercial/.test(text+' '+href)) a.remove();
      }
    });
  }
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',function(){clean(document);}); else clean(document);
})();
</script>
    <?php
}, 1000 );
