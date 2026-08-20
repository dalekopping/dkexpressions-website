(() => {
	'use strict';

	const form = document.querySelector('[data-dkx-project-form]');
	if (form) {
		const controls = Array.from(form.querySelectorAll('input, select, textarea')).filter((control) => control.name && 'website' !== control.name);

		const clearError = (control) => {
			control.removeAttribute('aria-invalid');
			const field = control.closest('.dkxcr-field');
			const error = field ? field.querySelector('.dkxcr-field-error') : null;
			if (error) error.remove();
		};

		const showError = (control, message) => {
			clearError(control);
			control.setAttribute('aria-invalid', 'true');
			const field = control.closest('.dkxcr-field');
			if (!field) return;
			const error = document.createElement('small');
			error.className = 'dkxcr-field-error';
			error.textContent = message;
			field.appendChild(error);
		};

		const validate = (control) => {
			const value = control.value.trim();
			if (control.required && !value) {
				showError(control, control.dataset.requiredMessage || 'This field is needed');
				return false;
			}
			if ('email' === control.type && value && !control.validity.valid) {
				showError(control, control.dataset.emailMessage || 'Please enter a valid email address');
				return false;
			}
			clearError(control);
			return true;
		};

		controls.forEach((control) => {
			control.addEventListener('input', () => clearError(control));
			control.addEventListener('change', () => validate(control));
		});

		form.addEventListener('submit', (event) => {
			const invalid = controls.filter((control) => !validate(control));
			if (invalid.length) {
				event.preventDefault();
				invalid[0].focus();
				return;
			}
			const button = form.querySelector('button[type="submit"]');
			if (button) {
				button.disabled = true;
				button.querySelector('span').textContent = 'Sending Brief';
			}
		});
	}

	const status = document.querySelector('[data-dkx-download-status]');
	document.querySelectorAll('[data-dkx-rate-download]').forEach((link) => {
		link.addEventListener('click', () => {
			if (status) status.classList.add('is-visible');
		});
	});
})();
