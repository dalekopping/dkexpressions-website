(function () {
	'use strict';

	var backButton = document.querySelector('.dk-back-to-future');
	var menu = document.getElementById('dk-nav');
	var toggle = document.querySelector('.dk-menu-toggle');

	function updateBackButton() {
		if (!backButton) {
			return;
		}
		backButton.classList.toggle('is-visible', window.scrollY > 420);
	}

	updateBackButton();
	window.addEventListener('scroll', updateBackButton, { passive: true });

	if (backButton) {
		backButton.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

	if (menu && toggle) {
		menu.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				menu.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			});
		});
	}
}());
