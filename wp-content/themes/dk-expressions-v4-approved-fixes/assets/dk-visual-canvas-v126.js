(function () {
	'use strict';

	var config = window.DKXVisualCanvas || {};
	var overrides = Array.isArray(config.overrides) ? config.overrides : [];
	var originals = {};
	var selected = null;
	var selectedTextNodeIndex = -1;
	var directCanvasEditing = window.matchMedia && window.matchMedia('(pointer: fine)').matches;

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
			var mediaSlot = element.hasAttribute('data-dkx-media-slot');
			var source = element.tagName === 'VIDEO' ? element.querySelector('source') : null;
			var background = element.tagName !== 'IMG' && element.tagName !== 'VIDEO' ? window.getComputedStyle(element).backgroundImage : '';
			originals[path] = {
				type: 'media',
				url: source ? source.getAttribute('src') : (element.tagName === 'IMG' ? element.getAttribute('src') : backgroundUrl(background)),
				alt: element.getAttribute('alt') || '',
				mime: source ? source.getAttribute('type') || '' : '',
				background: background,
				slotHtml: mediaSlot ? element.innerHTML : null
			};
			return;
		}
		originals[path] = { type: 'text', value: element.innerHTML, plainValue: element.innerText };
	}

	function backgroundUrl(background) {
		var match = String(background || '').match(/url\(["']?([^"')]+)["']?\)/i);
		return match ? match[1] : '';
	}

	function applyMedia(element, item) {
		if (!element || !item || !item.url) {
			return;
		}
		if (element.hasAttribute('data-dkx-media-slot')) {
			var slotMedia = createMediaElement(item, element.getAttribute('data-dkx-media-class') || '');
			if (!slotMedia) {
				return;
			}
			element.innerHTML = '';
			element.appendChild(slotMedia);
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
			return;
		}
		var background = window.getComputedStyle(element).backgroundImage || '';
		var replacement = 'url("' + String(item.url).replace(/"/g, '%22') + '")';
		element.style.backgroundImage = /url\([^)]+\)/i.test(background) ? background.replace(/url\([^)]+\)/i, replacement) : replacement;
	}

	function createMediaElement(item, className) {
		if (!item || !item.url) {
			return null;
		}
		var media;
		if (String(item.mime || '').indexOf('video/') === 0) {
			media = document.createElement('video');
			media.controls = true;
			media.playsInline = true;
			media.preload = 'metadata';
			var source = document.createElement('source');
			source.src = item.url;
			source.type = item.mime;
			media.appendChild(source);
		} else {
			media = document.createElement('img');
			media.src = item.url;
			media.alt = item.alt || '';
			media.loading = 'lazy';
		}
		if (className) {
			media.className = className;
		}
		return media;
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
			var currentUrl = currentSource ? currentSource.getAttribute('src') : (element.tagName === 'IMG' ? element.getAttribute('src') : backgroundUrl(window.getComputedStyle(element).backgroundImage));
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

	function createInsertedMedia(item) {
		if (!item || !item.id || !item.anchorPath || !item.url) {
			return null;
		}
		var existing = document.querySelector('[data-dkx-visual-insert-id="' + cssEscape(item.id) + '"]');
		if (existing) {
			return existing.querySelector('img,video');
		}
		var anchor;
		try {
			anchor = document.querySelector(item.anchorPath);
		} catch (error) {
			return null;
		}
		if (!anchor || !anchor.closest('main')) {
			return null;
		}
		var slot = anchor.matches('[data-dkx-media-slot]') ? anchor : anchor.querySelector('[data-dkx-media-slot]');
		var useSlot = !!slot && (item.position === 'slot' || !!slot.querySelector('.dkxhp-work-placeholder'));
		var figure = document.createElement('figure');
		figure.className = 'dkx-visual-inserted-media';
		figure.setAttribute('data-dkx-visual-insert-id', item.id);
		var media = createMediaElement(item, useSlot ? (slot.getAttribute('data-dkx-media-class') || '') : '');
		if (!media) {
			return null;
		}
		figure.appendChild(media);
		if (useSlot) {
			figure.classList.add('is-media-slot');
			slot.innerHTML = '';
			slot.appendChild(figure);
		} else if (item.position === 'before') {
			anchor.insertAdjacentElement('beforebegin', figure);
		} else if (item.position === 'inside') {
			anchor.appendChild(figure);
		} else {
			anchor.insertAdjacentElement('afterend', figure);
		}
		return media;
	}

	function applyInsert(item) {
		createInsertedMedia(item);
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
		var field = start.closest('[data-dkx-field]');
		if (field && field.closest('main')) {
			return field;
		}
		var inline = start.closest('strong,b,em,span,small');
		if (inline && inline.closest('main') && inline.textContent.trim()) {
			return inline;
		}
		var block = start.closest('h1,h2,h3,h4,h5,h6,p,li,blockquote,figcaption,a,button,label');
		if (block && block.closest('main')) {
			return block;
		}
		return null;
	}

	function textNodes(element) {
		var nodes = [];
		var walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null);
		var node;
		while ((node = walker.nextNode())) {
			nodes.push(node);
		}
		return nodes;
	}

	function pointedTextNode(element, event) {
		var node = null;
		if (event && document.caretRangeFromPoint) {
			var range = document.caretRangeFromPoint(event.clientX, event.clientY);
			node = range ? range.startContainer : null;
		} else if (event && document.caretPositionFromPoint) {
			var position = document.caretPositionFromPoint(event.clientX, event.clientY);
			node = position ? position.offsetNode : null;
		}
		if (node && node.nodeType !== Node.TEXT_NODE) {
			node = node.firstChild;
		}
		if (!node || node.nodeType !== Node.TEXT_NODE || !element.contains(node)) {
			var available = textNodes(element).filter(function (item) { return item.nodeValue.trim(); });
			node = available.length === 1 ? available[0] : null;
		}
		return node;
	}

	function mediaTarget(start) {
		if (!start || !start.closest) {
			return null;
		}
		var media = start.closest('img,video');
		if (!media) {
			var visual = start.closest('figure,picture');
			if (visual && !start.closest('figcaption')) {
				media = visual.querySelector('img,video');
			}
		}
		if (media && (media.closest('main') || media.hasAttribute('data-dkx-global-media'))) {
			return media;
		}
		var slot = start.closest('[data-dkx-media-slot]');
		if (slot && slot.closest('main') && slot.querySelector('.dkxhp-work-placeholder')) {
			return slot;
		}
		return null;
	}

	function backgroundTarget(start) {
		var current = start && start.nodeType === 1 ? start : null;
		while (current && current !== document.body) {
			if (current.closest('main') && backgroundUrl(window.getComputedStyle(current).backgroundImage)) {
				return current;
			}
			if (current.tagName === 'MAIN') {
				break;
			}
			current = current.parentElement;
		}
		return null;
	}

	function insertionTarget(element) {
		if (!element || !element.closest('main')) {
			return null;
		}
		var inserted = element.closest('[data-dkx-visual-insert-id]');
		if (inserted) {
			return inserted;
		}
		if (element.tagName === 'IMG' || element.tagName === 'VIDEO') {
			return element.closest('figure') || element;
		}
		var mediaSlot = element.closest('[data-dkx-media-slot]');
		if (mediaSlot) {
			return mediaSlot;
		}
		return element.closest('h1,h2,h3,h4,h5,h6,p,blockquote,li,figure,article,section') || element;
	}

	function clearSelection() {
		if (!selected) {
			return;
		}
		selected.classList.remove('dkx-visual-selected');
		selected.removeAttribute('contenteditable');
		selected.removeAttribute('spellcheck');
		selected = null;
		selectedTextNodeIndex = -1;
	}

	function selectElement(element, type, event) {
		clearSelection();
		selected = element;
		selected.classList.add('dkx-visual-selected');
		var path = elementPath(element);
		captureOriginal(element, path, type);
		var insertAnchor = insertionTarget(element);
		var insertId = element.closest('[data-dkx-visual-insert-id]') ? element.closest('[data-dkx-visual-insert-id]').getAttribute('data-dkx-visual-insert-id') : '';
		var mediaSlot = type === 'media' && element.hasAttribute('data-dkx-media-slot');
		var backgroundMedia = type === 'media' && element.tagName !== 'IMG' && element.tagName !== 'VIDEO';
		var editValue = '';
		if (type === 'text') {
			var nodes = textNodes(element);
			var pointed = pointedTextNode(element, event);
			selectedTextNodeIndex = pointed ? nodes.indexOf(pointed) : -1;
			editValue = selectedTextNodeIndex >= 0 ? pointed.nodeValue : element.innerText;
		}
		if (type === 'text' && directCanvasEditing) {
			selected.setAttribute('contenteditable', 'true');
			selected.setAttribute('spellcheck', 'true');
			selected.focus({ preventScroll: true });
		}
		post({
			type: 'dkx-selection',
			elementType: type,
			mediaKind: type === 'media' ? (mediaSlot ? 'any' : (element.tagName === 'VIDEO' ? 'video' : 'image')) : '',
			path: path,
			label: type === 'media' ? (mediaSlot ? (element.getAttribute('data-dkx-media-label') || 'Empty media frame') : (backgroundMedia ? 'Background image' : (element.tagName === 'VIDEO' ? 'Video' : 'Image'))) : element.tagName.toLowerCase() + ' text',
			mediaSlot: mediaSlot,
			fieldKey: element.getAttribute('data-dkx-field') || '',
			fieldPostId: parseInt(element.getAttribute('data-dkx-field-post') || config.postId || 0, 10),
			globalMedia: element.getAttribute('data-dkx-global-media') || '',
			current: type === 'text' ? element.innerText : originals[path],
			originalCurrent: type === 'text' && originals[path] ? originals[path].plainValue : '',
			editValue: editValue,
			textNodeIndex: selectedTextNodeIndex,
			insertAnchorPath: insertAnchor ? elementPath(insertAnchor) : '',
			insertId: insertId
		});
	}

	function initialiseEditor() {
		document.documentElement.classList.add('dkx-visual-editing');
		document.body.classList.add('dkx-visual-editing');

		document.addEventListener('click', function (event) {
			var media = mediaTarget(event.target);
			var text = media ? null : textTarget(event.target);
			var background = !media && !text ? backgroundTarget(event.target) : null;
			if (!media && !text && !background) {
				if (event.target.closest('a,button,input,select,textarea,form')) {
					event.preventDefault();
				}
				return;
			}
			event.preventDefault();
			event.stopPropagation();
			selectElement(media || text || background, media || background ? 'media' : 'text', event);
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
				var inserted = target.closest('[data-dkx-visual-insert-id]');
				post({ type: 'dkx-change', elementType: 'media', path: event.data.path, media: event.data.media, globalMedia: target.getAttribute('data-dkx-global-media') || '', insertId: inserted ? inserted.getAttribute('data-dkx-visual-insert-id') : '' });
			}
			if (event.data.type === 'dkx-insert-media') {
				var insertedMedia = createInsertedMedia(event.data.insert);
				if (!insertedMedia) {
					return;
				}
				post({ type: 'dkx-change', elementType: 'insert', insert: event.data.insert });
				selectElement(insertedMedia, 'media');
			}
			if (event.data.type === 'dkx-remove-insert') {
				var insertedFigure = document.querySelector('[data-dkx-visual-insert-id="' + cssEscape(event.data.id || '') + '"]');
				if (insertedFigure) {
					if (insertedFigure.contains(selected)) {
						clearSelection();
					}
					insertedFigure.remove();
				}
			}
			if (event.data.type === 'dkx-set-text') {
				var textElement;
				try {
					textElement = document.querySelector(event.data.path);
				} catch (error) {
					return;
				}
				if (!textElement) {
					return;
				}
				captureOriginal(textElement, event.data.path, 'text');
				var nodes = textNodes(textElement);
				var nodeIndex = parseInt(event.data.textNodeIndex, 10);
				if (nodeIndex >= 0 && nodes[nodeIndex]) {
					nodes[nodeIndex].nodeValue = event.data.value || '';
				} else {
					textElement.textContent = event.data.value || '';
				}
				selected = textElement;
				selectedTextNodeIndex = nodeIndex;
				post({
					type: 'dkx-change',
					elementType: 'text',
					path: event.data.path,
					value: textElement.innerHTML,
					plainValue: textElement.innerText,
					fieldKey: textElement.getAttribute('data-dkx-field') || '',
					fieldPostId: parseInt(textElement.getAttribute('data-dkx-field-post') || config.postId || 0, 10)
				});
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
				} else if (typeof original.slotHtml === 'string') {
					element.innerHTML = original.slotHtml;
				} else {
					applyMedia(element, original);
				}
				selectElement(element, original.type);
			}
		});

		post({ type: 'dkx-canvas-ready', postId: config.postId });
	}

	function start() {
		overrides.filter(function (item) { return item && item.type === 'insert'; }).forEach(applyInsert);
		overrides.filter(function (item) { return !item || item.type !== 'insert'; }).forEach(applyOverride);
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
