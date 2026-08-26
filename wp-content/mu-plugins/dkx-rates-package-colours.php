<?php
/**
 * Plugin Name: DKX Rates Package Colours
 * Description: Applies the same four-package DK Colour System used on Solutions to the Rates page. No neon/glow effects.
 * Version: 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', function () {
    if ( ! is_page( 'rates' ) ) return;
    ?>
    <style id="dkx-rates-package-colours">
      /* DK Colour System — matched to Solutions */
      .dkxcr--rates .dkxcr-rate-world.is-event{--dkx-package:#40B8FF;}
      .dkxcr--rates .dkxcr-rate-world.is-retainer{--dkx-package:#FFC34F;}
      .dkxcr--rates .dkxcr-rate-world.is-branding{--dkx-package:#976DFF;}
      .dkxcr--rates .dkxcr-rate-world.is-media{--dkx-package:#FF5364;}

      .dkxcr--rates .dkxcr-rate-world{
        border-top:3px solid var(--dkx-package) !important;
        box-shadow:none !important;
        text-shadow:none !important;
        filter:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world > header > span,
      .dkxcr--rates .dkxcr-rate-world > header h3 em,
      .dkxcr--rates .dkxcr-rate-world > header a,
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div > span,
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div > a,
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div > a b{
        color:var(--dkx-package) !important;
        text-shadow:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div{
        box-shadow:none !important;
        filter:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div.is-chosen{
        border-top:3px solid var(--dkx-package) !important;
        box-shadow:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list > div.is-chosen > b{
        color:var(--dkx-package) !important;
        border-color:var(--dkx-package) !important;
        background:transparent !important;
        box-shadow:none !important;
        text-shadow:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list strong{
        color:#02070C !important;
        text-shadow:none !important;
      }
      .dkxcr--rates .dkxcr-rate-world .dkxcr-tier-list i{
        color:inherit !important;
      }
    </style>
    <?php
}, 99 );
