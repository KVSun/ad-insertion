import $ from './std-js/zq.es6';
import handleJSON from './std-js/json_response.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
// import supports from './std-js/support_test.es6';

function sameoriginFrom(form) {
	return new URL(form.action).origin === location.origin;
}

function submitForm(submit) {
	submit.preventDefault();
	let els = Array.from(submit.target.querySelectorAll('fieldset, button'));
	if (!('confirm' in submit.target.dataset) || confirm(submit.target.dataset.confirm)) {
		let body = new FormData(submit.target);
		let headers = new Headers();
		let url = new URL(submit.target.action, location.origin);
		// body.append('nonce', sessionStorage.getItem('nonce'));
		body.append('form', submit.target.name);
		els.forEach(el => el.disabled = true);
		headers.set('Accept', 'application/json');
		fetch(url, {
			method: submit.target.method || 'POST',
			headers,
			body,
			credentials: 'include'
		}).then(parseResponse).then(handleJSON).catch(reportError);
		els.forEach(el => el.disabled = false);
	}
}

function getDatalist(list) {
	if (!$('#' + list.getAttribute('list')).found) {
		let url = new URL(document.baseURI);
		let headers = new Headers();
		let body = new URLSearchParams();
		headers.set('Accept', 'application/json');
		body.set('datalist', list.getAttribute('list'));
		fetch(url, {
			method: 'POST',
			headers,
			body,
			credentials: 'include'
		}).then(parseResponse).then(handleJSON).catch(reportError);
	}
}

function getContextMenu(el) {
	let menu = el.getAttribute('contextmenu');
	if (menu && menu !== '') {
		if (!$(`menu#${menu}`).found) {
			let headers = new Headers();
			let url = new URL(document.baseURI);
			let body = new URLSearchParams();
			body.set('load_menu', menu.replace(/\_menu$/, ''));
			headers.set('Accept', 'application/json');
			fetch(url, {
				method: 'GET',
				headers,
				body,
				credentials: 'include'
			}).then(parseResponse).then(handleJSON).catch(reportError);
		}
	}
}

function updateFetchHistory(resp) {
	if (resp.ok) {
		history.pushState({}, document.title, resp.url);
	}
	return resp;
}

function matchPattern(match) {
	match.pattern = new RegExp(document.querySelector(`[name="${match.dataset.mustMatch}"]`).value).escape();
	document.querySelector(`[name="${match.dataset.mustMatch}"]`).addEventListener('change', change => {
		document.querySelector(`[data-must-match="${change.target.name}"]`).pattern = new RegExp(change.target.value).escape();
	});
}

function matchInput(input) {
	$(`input[data-equal-input="${input.target.dataset.equalInput}"]`).each(other => {
		if (other !== input) {
			other.value = input.value;
		}
	});
}

function getLink(click) {
	click.preventDefault();
	if (this.classList.contains('disabled')) {
		return;
	} else {
		this.classList.add('disabled');
	}
	let url = new URL(this.href, location.origin);
	let headers = new Headers();
	headers.set('Accept', 'application/json');
	if (typeof ga === 'function') {
		ga('send', 'pageview', this.href);
	}
	fetch(url, {
		method: 'GET',
		headers
	}).then(updateFetchHistory).then(parseResponse).then(json => {
		handleJSON(json);
		this.classList.remove('disabled');
	}).catch(error => {
		this.classList.remove('disabled');
		reportError(error);
	});
}

function toggleDetails() {
	if (this.parentElement.hasAttribute('open')) {
		this.parentElement.close();
	} else {
		this.parentElement.open();
	}
}

function toggleCheckboxes() {
	let fieldset = this.closest('fieldset');
	let checkboxes = Array.from(fieldset.querySelectorAll('input[type="checkbox"]'));
	checkboxes.forEach(checkbox => {
		checkbox.checked = !checkbox.checked;
	});
}

function closeOnOutsideClick(click) {
	if (! click.target.matches('dialog, dialog *')) {
		$('dialog[open]:first-of-type').each(autoCloseDialog);
	}
}

export function confirmDialogClose(dialog) {
	if ($(dialog.childNodes).some(node => node.tagName === 'FORM')) {
		return confirm('This will cause you to lose any data entered in the form. Continue?');
	}
	return true;
}

export function autoCloseDialog(dialog) {
	if (confirmDialogClose(dialog)) {
		if ($(dialog.childNodes).some(node =>
			node.dataset.hasOwnProperty('delete')
			&& node.dataset.delete === `#${dialog.id}`
		)) {
			try {
				if (dialog.nextElementSibling.matches('.backdrop')) {
					dialog.nextElementSibling.remove();
				}
			} catch(e) {
				return;
			}
			dialog.remove();
		} else {
			dialog.close();
		}
		document.body.removeEventListener('click', closeOnOutsideClick);
		document.body.removeEventListener('keypress', closeOnEscapeKey);
	}
}

function closeOnEscapeKey(keypress) {
	if (keypress.key === 'Escape') {
		$('dialog[open]:first-of-type').each(autoCloseDialog);
	}
}

export {
	sameoriginFrom,
	submitForm,
	getDatalist,
	getContextMenu,
	updateFetchHistory,
	matchPattern,
	matchInput,
	getLink,
	toggleDetails,
	toggleCheckboxes,
	closeOnEscapeKey,
	closeOnOutsideClick
};
