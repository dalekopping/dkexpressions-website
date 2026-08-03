(function () {
	'use strict';
	const header = document.getElementById('dk-header');
	const nav = document.getElementById('dk-nav');
	const toggle = document.querySelector('.dk-menu-toggle');
	const enter = document.querySelector('[data-enter]');
	const progress = document.querySelector('.dk-reading-progress');

	function onScroll() {
		if (header) header.classList.toggle('is-stuck', window.scrollY > 45);
		if (progress) {
			const height = document.documentElement.scrollHeight - window.innerHeight;
			progress.style.width = (height > 0 ? Math.min(100, (window.scrollY / height) * 100) : 0) + '%';
		}
	}
	window.addEventListener('scroll', onScroll, { passive: true });
	onScroll();

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			const open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', String(open));
		});
		nav.addEventListener('click', function (event) {
			if (event.target.closest('a')) {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	}
	if (enter) {
		enter.addEventListener('click', function () {
			document.getElementById('experience')?.scrollIntoView({ behavior: 'smooth' });
		});
	}
})();
