function $(sel) {
	return Array.from(document.querySelectorAll(sel));
}
self.addEventListener('load', event => {
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