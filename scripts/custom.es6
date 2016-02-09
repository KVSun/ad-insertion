function $(sel) {
	return Array.from(document.querySelectorAll(sel));
}
if (! ('HTMLDialogElement' in self)) {
	document.documentElement.classList.add('no-dialog');
} else {
	document.documentElement.classList.add('dialog');
}
if (! ('showModal' in Element.prototype)) {
	Element.prototype.show = function() {
		this.setAttribute('open', '');
	}
	Element.prototype.showModal = function() {
		let back = document.createElement('div');
		back.classList.add('backdrop');
		this.classList.add('modal');
		if (this.parentElement.lastElementChild === this) {
			this.parentElement.appendChild(back);
		} else {
			this.parentElement.insertBefore(back, this.nextElementSibling);
		}
		this.show();
	}
	Element.prototype.close = function() {
		this.classList.remove('modal');
		this.removeAttribute('open');
		if (this.nextElementSibling && this.nextElementSibling.matches('.backdrop')) {
			this.nextElementSibling.remove();
		}
	}
}
self.addEventListener('load', event => {
	const TODAY = new InputDate();
	$('a').filter(a => a.origin === location.origin).forEach(a => {
		a.addEventListener('click', click => {
			if (a.hash.length) {
				let target = document.getElementById(a.hash.substring(1));
				if (target.tagName === 'DIALOG') {
					click.preventDefault();
					target.showModal();
				}
			} else {
				click.preventDefault();
				let url = new URL(a.href);
				let headers = new Headers();
				fetch(url, {
					headers,
					method: 'GET',
					credentials: 'include'
				}).then(resp => {
					if (resp.ok) {
						let type = resp.headers.get('Content-Type');
						if (type.startsWith('application/json')) {
							return resp.json();
						} else {
							throw new Error(`Unsupported Content-Type: ${type}`);
						}
					} else {
						throw new Error(`<${resp.url}> ${resp.statusTest}`);
					}
				}).then(json => {
					console.info(json);
				}).catch(error => {
					console.error(error);
					new Notification(`ERROR - ${document.title}`, {
						body: `"${error.message}\n${error.fileName}:${error.lineNumber}"`,
						icon: 'images/octicons/svg/bug.svg'
					});
				});
			}
		});
	});
	$('[data-show-modal]').forEach(button => {
		button.addEventListener('click', event => {
			document.querySelector(event.target.dataset.showModal).showModal();
		});
	});
	$('[data-close-modal]').forEach(button => {
		button.addEventListener('click', event => {
			document.querySelector(event.target.dataset.closeModal).close();
		});
	});
	$('input[type="date"]').forEach(input => {
		input.min = TODAY;
		input.value = TODAY;
	});
	$('form').forEach(form => {
		form.addEventListener('submit', event => {
			event.preventDefault();
			let url = new URL(event.target.action);
			let headers = new Headers();
			let body = new FormData(event.target);
			headers.set('Accept', 'application/json');

			fetch(url, {
				headers,
				body,
				method: event.target.method
			}).then(resp => {
				if (resp.ok) {
					let type = resp.headers.get('Content-Type');
					if (type.startsWith('application/json')) {
						return resp.json();
					} else {
						throw new Error(`Unsupported Content-Type: ${type}.`);
					}
				} else {
					throw new Error(`<${resp.url}> ${resp.statusText}`);
				}
			}).then(json => {
				console.info(json);
				if (confirm('Reset the form?')) {
					event.target.reset();
				}
			}).catch(error => {
				console.error(error);
				new Notification(`Error: ${document.title}`, {
					body: `${error.message}\n${error.fileName}:${error.lineNumber}`,
					icon: 'images/octicons/svg/bug.svg'
				});
			});
		});
	});

	new Notification(document.title, {
		body: document.querySelector('meta[name="description"]').content,
		icon: document.querySelector('link[rel="icon"]').href
	});
});
