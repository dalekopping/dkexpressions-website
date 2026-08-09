(() => {
  'use strict';

  const marquee = document.querySelector('[data-dkx-marquee], .dk-v116-marquee');
  if (marquee) {
    marquee.classList.add('dk-marquee-ready');

    /*
     * The animation needs exactly two matching content sets.
     * Do not clone again when PHP or an earlier release already supplied them.
     */
    if (!marquee.dataset.dkxPrepared) {
      const items = Array.from(marquee.children);
      const labels = items.map((item) => item.textContent.trim());
      const half = Math.floor(labels.length / 2);
      const alreadyDuplicated =
        labels.length >= 4 &&
        labels.length % 2 === 0 &&
        labels.slice(0, half).every((label, index) => label === labels[index + half]);

      if (!alreadyDuplicated) {
        items.forEach((item) => marquee.appendChild(item.cloneNode(true)));
      }

      marquee.dataset.dkxPrepared = 'true';
    }
  }

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
})();
