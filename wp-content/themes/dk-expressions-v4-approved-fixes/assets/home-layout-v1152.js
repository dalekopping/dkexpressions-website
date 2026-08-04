(function () {
  'use strict';

  function initialiseHomeLayout() {
    var hero = document.querySelector('.dk-enterprise-hero');
    if (!hero || hero.classList.contains('dk-home-reordered')) {
      return;
    }

    var copy = hero.querySelector('.dk-home-page-copy');
    var logo = hero.querySelector('.dk-home-orbit');
    var proof = hero.querySelector('.dk-hero-proof');

    if (!copy || !logo || !proof) {
      return;
    }

    hero.classList.add('dk-home-reordered');

    /* Required visual order: logo, statistics, then the main brand message. */
    hero.insertBefore(logo, copy);
    hero.insertBefore(proof, copy);

    var proofItems = proof.querySelectorAll('li');
    proofItems.forEach(function (item, index) {
      var strong = item.querySelector('strong');
      if (!strong) {
        return;
      }

      var value = strong.textContent.trim();
      strong.textContent = '';

      if (index === 0) {
        var prefix = document.createElement('span');
        prefix.className = 'dk-proof-prefix';
        prefix.textContent = 'Since';

        var year = document.createElement('span');
        year.className = 'dk-proof-number';
        year.textContent = value.replace(/\D/g, '') || '2013';

        strong.appendChild(prefix);
        strong.appendChild(year);
      } else {
        var number = document.createElement('span');
        number.className = 'dk-proof-number';
        number.textContent = value;
        strong.appendChild(number);
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initialiseHomeLayout);
  } else {
    initialiseHomeLayout();
  }
}());
