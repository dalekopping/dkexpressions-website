(() => {
 const root=document.querySelector('.dkow'); if(!root)return;
 const filters=[...root.querySelectorAll('[data-dkow-filter]')];
 const frames=[...root.querySelectorAll('[data-dkow-category]')];
 filters.forEach(btn=>btn.addEventListener('click',()=>{
   const f=btn.dataset.dkowFilter;
   filters.forEach(b=>b.classList.toggle('is-active',b===btn));
   frames.forEach(frame=>frame.hidden=f!=='all'&&frame.dataset.dkowCategory!==f);
 }));
 const panel=root.querySelector('[data-dkow-panel]');
 if(!panel)return;
 const image=panel.querySelector('[data-dkow-image]');
 const title=panel.querySelector('[data-dkow-title]');
 const label=panel.querySelector('[data-dkow-label]');
 const close=panel.querySelector('[data-dkow-close]');
 const hide=()=>{panel.hidden=true;image.src='';document.body.classList.remove('dkow-lightbox-open');};
 root.querySelectorAll('[data-dkow-lightbox]').forEach(btn=>btn.addEventListener('click',()=>{
   image.src=btn.dataset.full||'';image.alt=btn.dataset.title||'';
   title.textContent=btn.dataset.title||'';label.textContent=btn.dataset.label||'';
   panel.hidden=false;document.body.classList.add('dkow-lightbox-open');close.focus();
 }));
 close.addEventListener('click',hide);
 panel.addEventListener('click',e=>{if(e.target===panel)hide();});
 document.addEventListener('keydown',e=>{if(e.key==='Escape'&&!panel.hidden)hide();});
})();
