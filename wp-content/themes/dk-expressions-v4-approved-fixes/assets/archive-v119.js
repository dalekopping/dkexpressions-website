(() => {
  const root = document.querySelector('.dk-archive-experience');
  if (!root) return;

  const filters = [...root.querySelectorAll('[data-dk-filter]')];
  const cards = [...root.querySelectorAll('[data-dk-category]')];

  filters.forEach((button) => {
    button.addEventListener('click', () => {
      const filter = button.dataset.dkFilter;
      filters.forEach((b) => b.classList.toggle('is-active', b === button));
      cards.forEach((card) => {
        card.hidden = filter !== 'all' && card.dataset.dkCategory !== filter;
      });
    });
  });

  const panel = document.querySelector('[data-dk-lightbox-panel]');
  if (!panel) return;

  const image = panel.querySelector('[data-dk-lightbox-image]');
  const title = panel.querySelector('[data-dk-lightbox-title]');
  const label = panel.querySelector('[data-dk-lightbox-label]');
  const close = panel.querySelector('[data-dk-lightbox-close]');

  const hide = () => {
    panel.hidden = true;
    image.src = '';
    document.body.classList.remove('dk-archive-lightbox-open');
  };

  root.querySelectorAll('[data-dk-lightbox]').forEach((button) => {
    button.addEventListener('click', () => {
      image.src = button.dataset.full || '';
      image.alt = button.dataset.title || '';
      title.textContent = button.dataset.title || '';
      label.textContent = button.dataset.label || '';
      panel.hidden = false;
      document.body.classList.add('dk-archive-lightbox-open');
      close.focus();
    });
  });

  close.addEventListener('click', hide);
  panel.addEventListener('click', (event) => {
    if (event.target === panel) hide();
  });
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !panel.hidden) hide();
  });
})();