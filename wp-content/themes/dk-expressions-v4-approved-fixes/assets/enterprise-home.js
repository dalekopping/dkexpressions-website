(() => {
  'use strict';
  const marquee = document.querySelector('[data-dkx-marquee]');
  if (marquee && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const items = Array.from(marquee.children);
    items.forEach((item) => marquee.appendChild(item.cloneNode(true)));
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
