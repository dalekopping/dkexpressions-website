(function () {
	'use strict';

	document.querySelectorAll('[data-dkxi-slider]').forEach(function (slider) {
		var track = slider.querySelector('.dkxoi-slider-track');
		var slides = Array.prototype.slice.call(slider.querySelectorAll('.dkxoi-slide'));
		var previous = slider.querySelector('[data-dkxi-prev]');
		var next = slider.querySelector('[data-dkxi-next]');
		var status = slider.querySelector('[data-dkxi-status]');
		var progress = slider.querySelector('[data-dkxi-progress]');
		var index = 0;
		var timer = null;
		var pointerStart = null;
		var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (!track || slides.length < 2) {
			return;
		}

		function pad(value) {
			return String(value).padStart(2, '0');
		}

		function show(nextIndex, userInitiated) {
			index = (nextIndex + slides.length) % slides.length;
			track.style.transform = 'translate3d(-' + (index * 100) + '%,0,0)';
			slides.forEach(function (slide, slideIndex) {
				slide.setAttribute('aria-hidden', slideIndex === index ? 'false' : 'true');
			});
			if (status) {
				status.textContent = pad(index + 1) + ' / ' + pad(slides.length);
			}
			if (progress) {
				progress.style.width = (((index + 1) / slides.length) * 100) + '%';
			}
			if (userInitiated) {
				restart();
			}
		}

		function stop() {
			if (timer) {
				window.clearInterval(timer);
				timer = null;
			}
		}

		function start() {
			if (reduceMotion || document.hidden) {
				return;
			}
			stop();
			timer = window.setInterval(function () {
				show(index + 1, false);
			}, 7000);
		}

		function restart() {
			stop();
			start();
		}

		previous.addEventListener('click', function () {
			show(index - 1, true);
		});
		next.addEventListener('click', function () {
			show(index + 1, true);
		});

		slider.addEventListener('mouseenter', stop);
		slider.addEventListener('mouseleave', start);
		slider.addEventListener('focusin', stop);
		slider.addEventListener('focusout', start);
		slider.addEventListener('pointerdown', function (event) {
			pointerStart = event.clientX;
		});
		slider.addEventListener('pointerup', function (event) {
			if (null === pointerStart) {
				return;
			}
			var movement = event.clientX - pointerStart;
			pointerStart = null;
			if (Math.abs(movement) > 48) {
				show(index + (movement < 0 ? 1 : -1), true);
			}
		});
		document.addEventListener('visibilitychange', function () {
			if (document.hidden) {
				stop();
			} else {
				start();
			}
		});

		show(0, false);
		start();
	});
}());
