import $ from './std-js/zq.es6';
import handleJSON from './std-js/json_response.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import supports from './std-js/support_test.es6';

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
	let url = new URL(this.href, location.origin);
	let headers = new Headers();
	headers.set('Accept', 'application/json');
	if (typeof ga === 'function') {
		ga('send', 'pageview', a.href);
	}
	fetch(url, {
		method: 'GET',
		headers
	}).then(updateFetchHistory).then(parseResponse).then(handleJSON).catch(reportError);
}

function toggleDetails() {
	if (this.parentElement.hasAttribute('open')) {
		this.parentElement.close();
	} else {
		this.parentElement.open();
	}
}

function toggleCheckboxes(click) {
	let fieldset = this.closest('fieldset');
	let checkboxes = Array.from(fieldset.querySelectorAll('input[type="checkbox"]'));
	checkboxes.forEach(checkbox => {
		checkbox.checked = !checkbox.checked;
	});
}

function closeOnOutsideClick(click) {
	if (! click.target.matches(`dialog, dialog *`)) {
		$('dialog[open]').each(dialog => {
			if ($(dialog.childNodes).some(node =>
				node.dataset.hasOwnProperty('delete')
				&& node.dataset.delete === `#${dialog.id}`
			)) {
				dialog.remove();
			} else {
				dialog.close();
			}
			document.body.removeEventListener('click', closeOnOutsideClick);
			document.body.removeEventListener('keypress', closeOnEscapeKey);
		});
	}
}

function closeOnEscapeKey(keypress) {
	if (keypress.key === 'Escape') {
		$('dialog[open]').each(dialog => {
			if ($(dialog.childNodes).some(node =>
				node.dataset.hasOwnProperty('delete')
				&& node.dataset.delete === `#${dialog.id}`
			)) {
				dialog.remove();
			} else {
				dialog.close();
			}
			document.body.removeEventListener('click', closeOnOutsideClick);
			document.body.removeEventListener('keypress', closeOnEscapeKey);
		});
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
