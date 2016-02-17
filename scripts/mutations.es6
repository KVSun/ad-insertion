import {default as $} from './std-js/zq.es6';
import {default as handleJSON} from './std-js/json_response.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import {default as supports} from './std-js/support_test.es6';

export const watcher = {
	childList: function() {
		$(this.addedNodes).bootstrap();
	},
	attributes: function() {
		switch (this.attributeName) {
			case 'contextmenu':
				let menu = this.target.getAttribute('contextmenu');
				if (this.oldValue !== '') {
					$(`menu#${this.oldValue}`).remove();
				}
				if (menu && menu !== '') {
					if (!$('menu#' + menu).found) {
						fetch(document.baseURI, {
							method: 'POST',
							headers: new Headers({Accept: 'application/json'}),
							body: new URLSearchParams(`load_menu=${menu.replace(/\_menu$/, '')}`),
							credentials: 'include'
						}).then(parseResponse).then(handleJSON).catch(function(exc) {
							console.error(exc);
						});
					}
				}
				break;

			case 'open':
				if (
					this.target.hasAttribute('open')
					&& (this.target.offsetTop + this.target.offsetHeight < window.scrollY)
				) {
					this.target.scrollIntoView();
				}
				break;

			default:
				console.error(`Unhandled attribute in watch: "${this.attributeName}"`);
		}
	}
};

export const config = [
	'subtree',
	'attributeOldValue'
];

export const attributeTree = [
	'contextmenu',
	'list',
	'open'
];

export function bootstrap() {
	'use strict';
	this.each(function(node) {
		if (node.nodeType !== 1) {
			return this;
		}
		if (!supports('details')) {
			node.query('details > summary').forEach(summary => {
				summary.addEventListener('click', click => {
					if (summary.parentElement.hasAttribute('open')) {
						summary.parentElement.close();
					} else {
						summary.parentElement.open();
					}
				});
			});
		}
		if (supports('menuitem')) {
			node.query('[contextmenu]').forEach(el => {
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
			});
		}
		if (supports('datalist')) {
			node.query('[list]').forEach(list => {
				if (!$('#' + list.getAttribute('list')).found) {
					let url = new URL(document.baseURI);
					let headers = new Headers();
					let body = new URLSearchParams();
					headers.set('Accept', 'application/json');
					body.set('datalist', list.getAttribute('list'))
					fetch(url, {
						method: 'POST',
						headers,
						body,
						credentials: 'include'
					}).then(parseResponse).then(handleJSON).catch(reportError);
				}
			});
		}
		if (!supports('picture')) {
			node.query('picture').forEach(function(picture) {
				if ('matchMedia' in window) {
					let sources = picture.querySelectorAll('source[media][srcset]');
					for (let n = 0; n < sources.length; n++) {
						if (matchMedia(sources[n].getAttribute('media')).matches) {
							picture.getElementsByTagName('img')[0].src = sources[n].getAttribute('srcset');
							break;
						}
					}
				} else {
					picture.getElementsByTagName('img')[0].src = picture.querySelector('source[media][srcset]').getAttribute('srcset');
				}
			});
		}
		node.query('[autofocus]').forEach(input => input.focus());
		node.query(
			'a[href]:not([target="_blank"]):not([download]):not([href*="\#"])'
		).filter(link => link.origin === location.origin).forEach(a => {
			a.addEventListener('click', click => {
				click.preventDefault();
				let url = new URL(a.href, location.origin);
				let headers = new Headers();
				headers.set('Accept', 'application/json');
				if (typeof ga === 'function') {
					ga('send', 'pageview', a.href);
				}
				fetch(url, {
					method: 'GET',
					headers
				}).then(parseResponse).then(handleJSON).then(resp => {
					history.pushState({}, document.title, a.href);
					return resp;
				}).catch(reportError);
			});
		});
		node.query('form[name]').filter(
			form => new URL(form.action).origin === location.origin
		).forEach(form => {
			form.addEventListener('submit', submit => {
				submit.preventDefault();
				if (!('confirm' in submit.target.dataset) || confirm(submit.target.dataset.confirm)) {
					let body = new FormData(submit.target);
					let headers = new Headers();
					let url = new URL(submit.target.action, location.origin);
					// body.append('nonce', sessionStorage.getItem('nonce'));
					body.append('form', submit.target.name);
					headers.set('Accept', 'application/json');
					fetch(url, {
							method: submit.target.method || 'POST',
							headers,
							body,
							credentials: 'include'
					}).then(parseResponse).then(handleJSON).catch(reportError);
				}
			});
		});
		node.query('[data-show]').forEach(el => {
			el.addEventListener('click', click => {
				document.querySelector(el.dataset.show).show();
			});
		});
		node.query('[data-show-modal]').forEach(el => {
			el.addEventListener('click', click => {
				document.querySelector(el.dataset.showModal).showModal();
			});
		});
		node.query('[data-scroll-to]').forEach(el => {
			el.addEventListener('click', click => {
				document.querySelector(el.dataset.scrollTo).scrollIntoView();
			});
		});
		// node.query('[data-import]').forEach(el => {
		// 	el.HTMLimport();
		// });
		node.query('[data-close]').forEach(el => {
			el.addEventListener('click', click => {
				document.querySelector(el.dataset.close).close();
			});
		});
		node.query('fieldset button[type="button"].toggle').forEach(toggle => {
			toggle.addEventListener('click', click => {
				let fieldset = toggle.closest('fieldset');
				let checkboxes = Array.from(fieldset.querySelectorAll('input[type="checkbox"]'));
				checkboxes.forEach(checkbox => {
					checkbox.checked = !checkbox.checked;
				});
			});
		});
		node.query('[data-must-match]').forEach(match => {
			match.pattern = new RegExp(document.querySelector(`[name="${match.dataset.mustMatch}"]`).value).escape();
			document.querySelector(`[name="${match.dataset.mustMatch}"]`).addEventListener('change', change => {
				document.querySelector(`[data-must-match="${change.target.name}"]`).pattern = new RegExp(change.target.value).escape();
			});
		});
		// node.query('[data-dropzone]') .forEach(function (el) {
		// 	document.querySelector(el.dataset.dropzone).DnD(el);
		// });
		node.query('input[data-equal-input]').forEach(input => {
			input.addEventListener('input', input => {
				$(`input[data-equal-input="${input.target.dataset.equalInput}"]`).each(other => {
					if (other !== input) {
						other.value = input.value;
					}
				});
			});
		});
		// node.query('menu[type="context"]').forEach(WYSIWYG);
		// node.query('[data-request]').forEach(el => {
		// 	el.addEventListener('click', click => {
		// 		click.preventDefault();
		// 		if (!(el.dataset.hasOwnProperty('confirm')) || confirm(el.dataset.confirm)) {
		// 			let url = new URL(el.dataset.url || document.baseURI);
		// 			let headers = new Headers();
		// 			let body = new URLSearchParams(el.dataset.request);
		// 			headers.set('Accept', 'application/json');
		// 			if ('prompt' in el.dataset) {
		// 				body.set('prompt_value', prompt(el.dataset.prompt));
		// 			}
		// 			fetch(url, {
		// 				method: 'POST',
		// 				headers,
		// 				body,
		// 				credentials: 'include'
		// 			}).then(parseResponse).then(handleJSON).catch(reportError);
		// 		}
		// 	});
		// });
		// node.query('[data-dropzone]').forEach(finput => {
		// 	document.querySelector(finput.dataset.dropzone).DnD(finput);
		// });
		node.query('[data-fullscreen]').forEach(el => {
			el.addEventListener('click', click => {
				if (fullScreen) {
					document.cancelFullScreen();
				} else {
					document.querySelector(el.dataset.fullscreen).requestFullScreen();
				}
			});
		});
		node.query('[data-delete]').forEach(function(el) {
			el.addEventListener('click', click => {
				$(el.dataset.delete).remove();
			});
		});
	});
	return this;
}