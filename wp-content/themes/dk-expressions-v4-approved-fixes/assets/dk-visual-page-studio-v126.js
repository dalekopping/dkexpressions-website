(function ($) {
	'use strict';

	var config = window.DKXVisualStudio || {};
	var root = document.querySelector('[data-dkx-visual-studio]');
	if (!root) {
		return;
	}

	var frame = root.querySelector('#dkx-visual-canvas');
	var shell = root.querySelector('[data-dkx-frame-shell]');
	var status = root.querySelector('[data-dkx-status]');
	var selectionPanel = root.querySelector('[data-dkx-selection]');
	var selectionLabel = root.querySelector('[data-dkx-selection-label]');
	var selectionHelp = root.querySelector('[data-dkx-selection-help]');
	var replaceMediaButton = root.querySelector('[data-dkx-replace-media]');
	var textEditor = root.querySelector('[data-dkx-text-editor]');
	var textInput = root.querySelector('[data-dkx-text-value]');
	var saveButtons = Array.prototype.slice.call(root.querySelectorAll('[data-dkx-save]'));
	var saveButton = saveButtons[0];
	var currentSelection = null;
	var overrideMap = {};
	var fieldMap = {};
	var globalLogoId = parseInt(config.globalLogoId || 0, 10);
	var dirty = false;

	(Array.isArray(config.overrides) ? config.overrides : []).forEach(function (item) {
		if (item && item.path) {
			overrideMap[item.path] = item;
		}
	});

	function setStatus(state, title, copy) {
		status.setAttribute('data-state', state);
		status.querySelector('strong').textContent = title;
		status.querySelector('span').textContent = copy;
	}

	function markDirty() {
		dirty = true;
		saveButtons.forEach(function (button) { button.classList.add('is-dirty'); });
		setStatus('dirty', 'Unsaved changes', 'Review each screen size, then save the frontend changes.');
	}

	function sendToCanvas(message) {
		if (frame && frame.contentWindow) {
			frame.contentWindow.postMessage(message, window.location.origin);
		}
	}

	function showSelection(data) {
		currentSelection = data;
		selectionPanel.hidden = false;
		root.classList.add('has-selection');
		selectionLabel.textContent = data.label || 'Page element';
		if (data.elementType === 'media') {
			selectionHelp.textContent = data.globalMedia === 'logo' ? 'This is the global DK logo. Replacing it updates the header and footer everywhere.' : 'Choose another image or video from the WordPress Media Library.';
			replaceMediaButton.hidden = false;
			textEditor.hidden = true;
		} else {
			selectionHelp.textContent = data.fieldKey ? 'Edit below. This is connected to the page’s WordPress content field.' : 'Edit below. The exact visual position and DK styling remain locked.';
			replaceMediaButton.hidden = true;
			textEditor.hidden = false;
			textInput.value = typeof data.editValue === 'string' ? data.editValue : (data.current || '');
		}
	}

	function setViewport(viewport) {
		var target = root.querySelector('[data-dkx-viewport="' + viewport + '"]');
		if (!target) {
			return;
		}
		root.querySelectorAll('[data-dkx-viewport]').forEach(function (button) {
			button.classList.toggle('is-active', button === target);
		});
		shell.className = 'dkx-vps__frame-shell is-' + viewport;
	}

	function closeSelection() {
		selectionPanel.hidden = true;
		root.classList.remove('has-selection');
		currentSelection = null;
	}

	window.addEventListener('message', function (event) {
		if (event.origin !== window.location.origin || !event.data || !event.data.type) {
			return;
		}
		var data = event.data;
		if (data.type === 'dkx-canvas-ready') {
			setStatus(dirty ? 'dirty' : 'ready', dirty ? 'Unsaved changes' : 'Canvas connected', dirty ? 'Review and save when ready.' : 'Click visible content to edit it.');
			return;
		}
		if (data.type === 'dkx-selection') {
			showSelection(data);
			return;
		}
		if (data.type !== 'dkx-change') {
			return;
		}
		if (data.elementType === 'text') {
			if (data.fieldKey) {
				var fieldId = (data.fieldPostId || config.postId) + ':' + data.fieldKey;
				fieldMap[fieldId] = {
					postId: parseInt(data.fieldPostId || config.postId, 10),
					key: data.fieldKey,
					value: data.plainValue || ''
				};
				delete overrideMap[data.path];
			} else {
				overrideMap[data.path] = {
					type: 'text',
					path: data.path,
					originalValue: currentSelection && typeof currentSelection.originalCurrent === 'string' ? currentSelection.originalCurrent : (currentSelection && typeof currentSelection.current === 'string' ? currentSelection.current : ''),
					value: data.value || ''
				};
			}
		} else if (data.elementType === 'media' && data.media) {
			if (data.globalMedia === 'logo') {
				globalLogoId = parseInt(data.media.attachmentId || 0, 10);
			} else {
				overrideMap[data.path] = {
					type: 'media',
					path: data.path,
					originalUrl: currentSelection && currentSelection.current ? (currentSelection.current.url || '') : '',
					attachmentId: parseInt(data.media.attachmentId || 0, 10),
					url: data.media.url || '',
					mime: data.media.mime || '',
					alt: data.media.alt || ''
				};
			}
		}
		markDirty();
	});

	root.addEventListener('click', function (event) {
		var viewportButton = event.target.closest('[data-dkx-viewport]');
		if (viewportButton) {
			setViewport(viewportButton.getAttribute('data-dkx-viewport'));
			return;
		}

		if (event.target.closest('[data-dkx-close-selection]')) {
			closeSelection();
			return;
		}

		if (event.target.closest('[data-dkx-apply-text]')) {
			if (!currentSelection || currentSelection.elementType !== 'text') {
				return;
			}
			sendToCanvas({
				type: 'dkx-set-text',
				path: currentSelection.path,
				value: textInput.value,
				textNodeIndex: parseInt(currentSelection.textNodeIndex, 10)
			});
			return;
		}

		if (event.target.closest('[data-dkx-refresh]')) {
			frame.src = config.canvasUrl + (config.canvasUrl.indexOf('?') === -1 ? '?' : '&') + 'dkx_studio_refresh=' + Date.now();
			setStatus('loading', 'Refreshing canvas', 'Loading the current saved frontend.');
			return;
		}

		if (event.target.closest('[data-dkx-replace-media]')) {
			if (!currentSelection || currentSelection.elementType !== 'media' || !window.wp || !wp.media) {
				return;
			}
			var mediaFrame = wp.media({
				title: currentSelection.globalMedia === 'logo' ? 'Choose the global DK logo' : 'Choose replacement media',
				button: { text: 'Use this media' },
				multiple: false,
				library: { type: currentSelection.globalMedia === 'logo' ? 'image' : (currentSelection.mediaKind || 'image') }
			});
			mediaFrame.on('select', function () {
				var attachment = mediaFrame.state().get('selection').first().toJSON();
				var media = {
					attachmentId: attachment.id,
					url: attachment.url,
					mime: attachment.mime || attachment.type || '',
					alt: attachment.alt || attachment.title || ''
				};
				sendToCanvas({ type: 'dkx-replace-media', path: currentSelection.path, media: media });
			});
			mediaFrame.open();
			return;
		}

		if (event.target.closest('[data-dkx-reset-selection]')) {
			if (!currentSelection) {
				return;
			}
			if (currentSelection.fieldKey) {
				delete fieldMap[(currentSelection.fieldPostId || config.postId) + ':' + currentSelection.fieldKey];
			}
			if (currentSelection.globalMedia === 'logo') {
				globalLogoId = parseInt(config.globalLogoId || 0, 10);
			} else {
				delete overrideMap[currentSelection.path];
			}
			sendToCanvas({ type: 'dkx-reset-element', path: currentSelection.path });
			markDirty();
		}
	});

	function saveChanges() {
		if (saveButtons.some(function (button) { return button.disabled; })) {
			return;
		}
		saveButtons.forEach(function (button) { button.disabled = true; });
		setStatus('saving', 'Saving', 'Updating WordPress and rebuilding the visual canvas.');
		$.ajax({
			url: config.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'dkxv4_save_visual_editor',
				nonce: config.nonce,
				postId: config.postId,
				fieldEdits: JSON.stringify(Object.keys(fieldMap).map(function (key) { return fieldMap[key]; })),
				overrides: JSON.stringify(Object.keys(overrideMap).map(function (key) { return overrideMap[key]; })),
				globalLogoId: globalLogoId
			}
		}).done(function (response) {
			if (!response || !response.success) {
				var message = response && response.data && response.data.message ? response.data.message : 'WordPress could not save these changes.';
				setStatus('error', 'Save failed', message);
				return;
			}
			dirty = false;
			fieldMap = {};
			saveButtons.forEach(function (button) { button.classList.remove('is-dirty'); });
			config.overrides = Object.keys(overrideMap).map(function (key) { return overrideMap[key]; });
			config.globalLogoId = globalLogoId;
			config.canvasUrl = response.data.canvasUrl || config.canvasUrl;
			setStatus('saved', 'Saved', 'The frontend and backend visual canvas now match.');
			frame.src = config.canvasUrl + '&dkx_studio_saved=' + Date.now();
		}).fail(function (xhr) {
			var message = xhr && xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message ? xhr.responseJSON.data.message : 'The server rejected the save request. Please reload the editor and try again.';
			setStatus('error', 'Save failed', message);
		}).always(function () {
			saveButtons.forEach(function (button) { button.disabled = false; });
		});
	}

	saveButtons.forEach(function (button) { button.addEventListener('click', saveChanges); });

	if (window.innerWidth <= 782) {
		setViewport('mobile');
	} else if (window.innerWidth <= 1100) {
		setViewport('tablet');
	}

	window.addEventListener('beforeunload', function (event) {
		if (!dirty) {
			return;
		}
		event.preventDefault();
		event.returnValue = '';
	});
}(jQuery));
