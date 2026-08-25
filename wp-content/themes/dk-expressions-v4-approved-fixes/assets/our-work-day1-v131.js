(function () {
	'use strict';

	var filterBar = document.querySelector('.dkxday1-filters');
	var grid = document.querySelector('[data-dkx-work-grid]');
	var empty = document.querySelector('[data-dkx-work-empty]');
	if (!filterBar || !grid) return;

	filterBar.addEventListener('click', function (event) {
		var button = event.target.closest('[data-dkx-work-filter]');
		if (!button) return;

		var filter = button.getAttribute('data-dkx-work-filter');
		var visible = 0;
		filterBar.querySelectorAll('[data-dkx-work-filter]').forEach(function (item) {
			var active = item === button;
			item.classList.toggle('is-active', active);
			item.setAttribute('aria-pressed', active ? 'true' : 'false');
		});

		grid.querySelectorAll('[data-dkx-work-card]').forEach(function (card) {
			var categories = (card.getAttribute('data-categories') || '').split(/\s+/);
			var show = filter === 'all' || categories.indexOf(filter) !== -1;
			card.hidden = !show;
			if (show) visible += 1;
		});

		if (empty) empty.hidden = visible !== 0;
		grid.classList.add('is-filtering');
		window.setTimeout(function () { grid.classList.remove('is-filtering'); }, 260);
	});
}());
