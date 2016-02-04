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
		if (this.nextElementSibling.matches('.backdrop')) {
			this.nextElementSibling.remove();
		}
	}
}
self.addEventListener('load', event => {
	const TODAY = new InputDate();
	new Notification(document.title, {
		body: document.querySelector('meta[name="description"]').content,
		icon: document.querySelector('link[rel="icon"]').href
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
			fetch(event.target.action, {
				headers: new Headers(),
				body: new FormData(event.target),
				method: event.target.method
			}).then(resp => {
				console.log(resp);
				event.target.reset();
			}, error => {
				console.error(error);
			}).catch(error => {
				console.error(error);
			});
		});
	});
});
