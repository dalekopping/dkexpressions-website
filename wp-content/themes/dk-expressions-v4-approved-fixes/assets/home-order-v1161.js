(function () {
  'use strict';

  function initHomepageOrder() {
    var hero = document.querySelector('.dk-v116-hero');
    var metrics = document.querySelector('.dk-v116-metrics');
    var trust = document.querySelector('.dk-v116-trust');
    var pathways = document.querySelector('#choose-your-experience');
    var stories = document.querySelector('.dk-v116-stories');

    if (!hero || !metrics || !trust || !pathways) {
      return;
    }

    /* Locked order: logo-first hero → stats → trust → Media/Agency pathways. */
    hero.parentNode.insertBefore(metrics, hero.nextSibling);
    metrics.parentNode.insertBefore(trust, metrics.nextSibling);
    trust.parentNode.insertBefore(pathways, trust.nextSibling);

    /* Latest stories follows the pathway section. */
    if (stories && pathways.nextSibling !== stories) {
      pathways.parentNode.insertBefore(stories, pathways.nextSibling);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomepageOrder);
  } else {
    initHomepageOrder();
  }
}());
