(function () {
  'use strict';

  function initHomepageOrder() {
    var hero = document.querySelector('.dk-v116-hero');
    var metrics = document.querySelector('.dk-v116-metrics');
    var trust = document.querySelector('.dk-v116-trust');
    var pathways = document.querySelector('#choose-your-experience');
    var stories = document.querySelector('.dk-v116-stories');
    var config = window.dkxHomeV1161 || {};

    if (!hero || !metrics || !trust || !pathways) {
      return;
    }

    if (!document.querySelector('.dk-v1161-logo-intro')) {
      var intro = document.createElement('section');
      intro.className = 'dk-v1161-logo-intro';
      intro.setAttribute('aria-label', 'Enter the DK Expressions experience');

      var wrap = document.createElement('div');
      wrap.className = 'dk-v1161-logo-wrap';

      var ring = document.createElement('span');
      ring.className = 'dk-v1161-logo-ring';
      ring.setAttribute('aria-hidden', 'true');

      var logo = document.createElement('img');
      logo.src = config.logoUrl || '';
      logo.alt = config.logoAlt || 'DK Expressions';
      logo.decoding = 'async';
      logo.fetchPriority = 'high';

      var enter = document.createElement('a');
      enter.className = 'dk-v1161-enter';
      enter.href = '#top';
      enter.textContent = 'Enter the experience ↓';

      wrap.appendChild(ring);
      wrap.appendChild(logo);
      intro.appendChild(wrap);
      intro.appendChild(enter);
      hero.parentNode.insertBefore(intro, hero);
    }

    /* Permanent approved order: Hero → Stats → Trust → Media/Agency pathways. */
    hero.parentNode.insertBefore(metrics, hero.nextSibling);
    metrics.parentNode.insertBefore(trust, metrics.nextSibling);
    trust.parentNode.insertBefore(pathways, trust.nextSibling);

    /* Latest stories must follow the pathway section, not interrupt the approved top flow. */
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
