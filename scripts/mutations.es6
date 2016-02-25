import $ from './std-js/zq.es6';
import handleJSON from './std-js/json_response.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import supports from './std-js/support_test.es6';
import {
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
	closeOnOutsideClick,
	confirmDialogClose
} from './eventHandlers.es6';

export const watcher = {
	childList: function() {
		$(this.addedNodes).bootstrap();
	},
	removedNodes: function() {
		if (Array.from(this.removedNodes).some(node => node.tagName === 'DIALOG')) {
			document.body.removeEventListener('click', closeOnOutsideClick);
			document.body.removeEventListener('keypress', closeOnEscapeKey);
		}
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
				if (this.target.tagName === 'DIALOG') {
					if (this.target.hasAttribute('open')) {
						setTimeout(() => {
							$(document.body).click(closeOnOutsideClick).keypress(closeOnEscapeKey);
						}, 500);
					} else {
						document.body.removeEventListener('click', closeOnOutsideClick);
						document.body.removeEventListener('keypress', closeOnEscapeKey);
					}
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
				summary.addEventListener('click', toggleDetails);
			});
		}
		if (supports('menuitem')) {
			node.query('[contextmenu]').forEach(getContextMenu);
		}
		if (supports('datalist')) {
			node.query('[list]').forEach(getDatalist);
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
			a.addEventListener('click', getLink);
		});
		node.query('form[name]').filter(sameoriginFrom).forEach(form => {
			form.addEventListener('submit', submitForm);
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
			toggle.addEventListener('click', toggleCheckboxes);
		});
		node.query('[data-must-match]').forEach(matchPattern);
		// node.query('[data-dropzone]') .forEach(function (el) {
		// 	document.querySelector(el.dataset.dropzone).DnD(el);
		// });
		node.query('input[data-equal-input]').forEach(input => {
			input.addEventListener('input', matchInput);
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
				let target = $(el.dataset.delete);
				target.each(el => {
					if (confirmDialogClose(el)) {
						target.remove();
					}
				});
			});
		});
	});
	return this;
}
