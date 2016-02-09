import {default as polyfill} from './std-js/polyfills.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import {default as handleJSON} from './std-js/json_response.es6';
import {supportsAsClasses} from "./std-js/support_test.es6";
import {default as popState} from "./std-js/popstate.es6";
import {default as $} from './std-js/zq.es6';

polyfill();

supportsAsClasses('svg', 'audio', 'video', 'picture', 'canvas', 'menuitem',
'details', 'dialog', 'dataset', 'HTMLimports', 'classList', 'connectivity',
'visibility', 'notifications', 'ApplicationCache', 'indexedDB',
'localStorage', 'sessionStorage', 'CSSgradients', 'transitions',
'animations', 'CSSvars', 'CSSsupports', 'CSSmatches', 'querySelectorAll',
'workers', 'promises', 'ajax', 'FormData');

popState();
$(self).load(event => {
	$('a').filter(a => a.origin === location.origin).click(function(click) {
		if (this.hash.length) {
			let target = document.getElementById(this.hash.substring(1));
			if (target.tagName === 'DIALOG') {
				click.preventDefault();
				target.showModal();
			}
		} else {
			click.preventDefault();
			let url = new URL(this.href);
			let headers = new Headers();
			headers.set('Accept', 'application/json');
			fetch(url, {
				headers,
				method: 'GET',
				credentials: 'include'
			}).then(parseResponse).then(handleJSON).catch(reportError);
		}
	});
	$('[data-show-modal]').click(function(click) {
		document.querySelector(this.dataset.showModal).showModal();
	});
	$('[data-close-modal]').click(function(click) {
		document.querySelector(this.dataset.closeModal).close();
	});
	$('form').submit(submit => {
		submit.preventDefault();
		let url = new URL(submit.target.action);
		let headers = new Headers();
		let body = new FormData(submit.target);
		headers.set('Accept', 'application/json');

		fetch(url, {
			headers,
			body,
			method: submit.target.method
		}).then(parseResponse).then(json => {
			console.info(json);
			if (confirm('Reset the form?')) {
				submit.target.reset();
			}
		}).catch(error => {
			console.error(error);
			new Notification(`Error: ${document.title}`, {
				body: `${error.message}\n${error.fileName}:${error.lineNumber}`,
				icon: 'images/octicons/svg/bug.svg'
			});
		});
	});

	new Notification(document.title, {
		body: document.querySelector('meta[name="description"]').content,
		icon: document.querySelector('link[rel="icon"]').href
	});
});
