(function () {
	'use strict';

	var config = window.DKXVisualCanvas || {};
	var overrides = Array.isArray(config.overrides) ? config.overrides : [];
	var originals = {};
	var selected = null;

	function cssEscape(value) {
		if (window.CSS && typeof window.CSS.escape === 'function') {
			return window.CSS.escape(value);
		}
		return String(value).replace(/[^a-zA-Z0-9_-]/g, '\\$&');
	}

	function elementPath(element) {
		if (!element || element.nodeType !== 1) {
			return '';
		}
		if (element.id && document.querySelectorAll('#' + cssEscape(element.id)).length === 1) {
			return '#' + cssEscape(element.id);
		}
		var parts = [];
		var current = element;
		while (current && current.nodeType === 1 && current !== document.body) {
			var part = current.tagName.toLowerCase();
			if (current.id && document.querySelectorAll('#' + cssEscape(current.id)).length === 1) {
				parts.unshift('#' + cssEscape(current.id));
				break;
			}
			var parent = current.parentElement;
			if (parent) {
				var siblings = Array.prototype.filter.call(parent.children, function (child) {
					return child.tagName === current.tagName;
				});
				if (siblings.length > 1) {
					part += ':nth-of-type(' + (siblings.indexOf(current) + 1) + ')';
				}
			}
			parts.unshift(part);
			if (current.tagName.toLowerCase() === 'main') {
				break;
			}
			current = parent;
		}
		return parts.join(' > ');
	}

	function captureOriginal(element, path, type) {
		if (originals[path]) {
			return;
		}
		if (type === 'media') {
			var source = element.tagName === 'VIDEO' ? element.querySelector('source') : null;
			originals[path] = {
				type: 'media',
				url: source ? source.getAttribute('src') : element.getAttribute('src'),
				alt: element.getAttribute('alt') || '',
				mime: source ? source.getAttribute('type') || '' : ''
			};
			return;
		}
		originals[path] = { type: 'text', value: element.innerHTML };
	}

	function applyMedia(element, item) {
		if (!element || !item || !item.url) {
			return;
		}
		if (element.tagName === 'IMG') {
			element.setAttribute('src', item.url);
			element.removeAttribute('srcset');
			element.removeAttribute('sizes');
			if (typeof item.alt === 'string') {
				element.setAttribute('alt', item.alt);
			}
			return;
		}
		if (element.tagName === 'VIDEO') {
			var source = element.querySelector('source');
			if (!source) {
				source = document.createElement('source');
				element.appendChild(source);
			}
			source.setAttribute('src', item.url);
			if (item.mime) {
				source.setAttribute('type', item.mime);
			}
			element.removeAttribute('poster');
			try {
				element.load();
			} catch (error) {
				// A visual refresh will load it if this browser blocks reload here.
			}
		}
	}

	function applyOverride(item) {
		if (!item || !item.path) {
			return;
		}
		var element;
		try {
			element = document.querySelector(item.path);
		} catch (error) {
			return;
		}
		if (!element) {
			return;
		}
		if (item.type === 'text' && typeof item.originalValue === 'string' && item.originalValue) {
			var currentText = (element.innerText || '').replace(/\s+/g, ' ').trim();
			var originalText = item.originalValue.replace(/\s+/g, ' ').trim();
			if (currentText !== originalText) {
				return;
			}
		}
		if (item.type === 'media' && item.originalUrl) {
			var currentSource = element.tagName === 'VIDEO' ? element.querySelector('source') : null;
			var currentUrl = currentSource ? currentSource.getAttribute('src') : element.getAttribute('src');
			if (currentUrl && currentUrl !== item.originalUrl) {
				return;
			}
		}
		captureOriginal(element, item.path, item.type);
		if (item.type === 'text') {
			element.innerHTML = item.value || '';
		} else if (item.type === 'media') {
			applyMedia(element, item);
		}
	}

	function post(message) {
		if (window.parent && window.parent !== window) {
			window.parent.postMessage(message, window.location.origin);
		}
	}

	function textTarget(start) {
		if (!start || !start.closest) {
			return null;
		}
		var block = start.closest('h1,h2,h3,h4,h5,h6,p,li,blockquote,figcaption,a,button,label');
		if (block && block.closest('main')) {
			return block;
		}
		var inline = start.closest('strong,b,em,span,small');
		return inline && inline.closest('main') ? inline : null;
	}

	function mediaTarget(start) {
		if (!start || !start.closest) {
			return null;
		}
		var media = start.closest('img,video');
		return media && (media.closest('main') || media.hasAttribute('data-dkx-global-media')) ? media : null;
	}

	function clearSelection() {
		if (!selected) {
			return;
		}
		selected.classList.remove('dkx-visual-selected');
		selected.removeAttribute('contenteditable');
		selected.removeAttribute('spellcheck');
		selected = null;
	}

	function selectElement(element, type) {
		clearSelection();
		selected = element;
		selected.classList.add('dkx-visual-selected');
		var path = elementPath(element);
		captureOriginal(element, path, type);
		if (type === 'text') {
			selected.setAttribute('contenteditable', 'true');
			selected.setAttribute('spellcheck', 'true');
			selected.focus({ preventScroll: true });
		}
		post({
			type: 'dkx-selection',
			elementType: type,
			mediaKind: type === 'media' ? (element.tagName === 'VIDEO' ? 'video' : 'image') : '',
			path: path,
			label: type === 'media' ? (element.tagName === 'VIDEO' ? 'Video' : 'Image') : element.tagName.toLowerCase() + ' text',
			fieldKey: element.getAttribute('data-dkx-field') || '',
			fieldPostId: parseInt(element.getAttribute('data-dkx-field-post') || config.postId || 0, 10),
			globalMedia: element.getAttribute('data-dkx-global-media') || '',
			current: type === 'text' ? element.innerText : originals[path]
		});
	}

	function initialiseEditor() {
		document.documentElement.classList.add('dkx-visual-editing');
		document.body.classList.add('dkx-visual-editing');

		document.addEventListener('click', function (event) {
			var media = mediaTarget(event.target);
			var text = media ? null : textTarget(event.target);
			if (!media && !text) {
				if (event.target.closest('a,button,input,select,textarea,form')) {
					event.preventDefault();
				}
				return;
			}
			event.preventDefault();
			event.stopPropagation();
			selectElement(media || text, media ? 'media' : 'text');
		}, true);

		document.addEventListener('submit', function (event) {
			event.preventDefault();
		}, true);

		document.addEventListener('input', function (event) {
			if (!selected || event.target !== selected) {
				return;
			}
			var path = elementPath(selected);
			post({
				type: 'dkx-change',
				elementType: 'text',
				path: path,
				value: selected.innerHTML,
				plainValue: selected.innerText,
				fieldKey: selected.getAttribute('data-dkx-field') || '',
				fieldPostId: parseInt(selected.getAttribute('data-dkx-field-post') || config.postId || 0, 10)
			});
		});

		window.addEventListener('message', function (event) {
			if (event.origin !== window.location.origin || !event.data || !event.data.type) {
				return;
			}
			if (event.data.type === 'dkx-replace-media') {
				var target;
				try {
					target = document.querySelector(event.data.path);
				} catch (error) {
					return;
				}
				if (!target) {
					return;
				}
				applyMedia(target, event.data.media);
				selectElement(target, 'media');
				post({ type: 'dkx-change', elementType: 'media', path: event.data.path, media: event.data.media, globalMedia: target.getAttribute('data-dkx-global-media') || '' });
			}
			if (event.data.type === 'dkx-reset-element') {
				var element;
				try {
					element = document.querySelector(event.data.path);
				} catch (error) {
					return;
				}
				var original = originals[event.data.path];
				if (!element || !original) {
					return;
				}
				if (original.type === 'text') {
					element.innerHTML = original.value;
				} else {
					applyMedia(element, original);
				}
				selectElement(element, original.type);
			}
		});

		post({ type: 'dkx-canvas-ready', postId: config.postId });
	}

	function start() {
		overrides.forEach(applyOverride);
		if (config.editor) {
			initialiseEditor();
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', start);
	} else {
		start();
	}
}());
