(function () {
	'use strict';

	function renderCountdown(element) {
		var deadline = new Date(element.dataset.countdown).getTime();
		if (!deadline || Number.isNaN(deadline)) return;

		function update() {
			var distance = deadline - Date.now();
			if (distance <= 0) {
				element.innerHTML = '<span>Competition closed</span>';
				return;
			}
			var days = Math.floor(distance / 86400000);
			var hours = Math.floor((distance % 86400000) / 3600000);
			var minutes = Math.floor((distance % 3600000) / 60000);
			element.innerHTML = '<strong>' + days + '</strong><small>days</small><strong>' + hours + '</strong><small>hrs</small><strong>' + minutes + '</strong><small>min</small>';
			window.setTimeout(update, 30000);
		}
		update();
	}

	document.querySelectorAll('[data-countdown]').forEach(renderCountdown);
	document.querySelectorAll('.dk-share-competition').forEach(function (button) {
		button.addEventListener('click', function () {
			var url = button.dataset.shareUrl || window.location.href;
			if (navigator.share) {
				navigator.share({ title: document.title, url: url }).catch(function () {});
			} else if (navigator.clipboard) {
				navigator.clipboard.writeText(url).then(function () { button.textContent = 'Link copied ✓'; });
			}
		});
	});
}());
