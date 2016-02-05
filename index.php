<?php
$console = \shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$headers = new \shgysk8zer0\Core\Headers();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = new \shgysk8zer0\DOM\HTML();
	$dom->head->append('title', 'Ad Insertion');
	$dom->head->append('link', null, [
		'rel' => 'icon',
		'href' => 'sun.svg',
		'type' => 'image/svg+xml',
		'sizes' => 'any'
	]);
	$dom->head->append('link', null, [
		'rel' => 'stylesheet',
		'href' => 'stylesheets/styles/import.css',
		'media' => 'all'
	]);
	$dom->head->append('script', null, [
		'type' => 'application/javascript',
		'src' => 'scripts/inputdate.es6',
		'defer' => true
	]);
	$dom->head->append('script', null, [
		'type' => 'application/javascript',
		'src' => 'scripts/custom.es6',
		'defer' => true
	]);
	$dom->head->append('meta', null, [
		'name' => 'description',
		'content' => 'An ad insertion form for the Kern Valley Sun'
	]);

	$header = $dom->body->append('header');
	$main = $dom->body->append('main');
	$footer = $dom->body->append('footer');

	$header->append('h1', 'KV Sun Ad Insertion');
	$form = $main->append('form', null, [
		'name' => 'ad-insertion',
		'action' => '.',
		'method' => 'POST'
	]);
	$section = $form->append('fieldset', null, ['form' => 'ad-insertion']);
	$section->append('legend', 'Section');
	$section->append('label', 'Date: ', ['for' => 'ad-insertion[date]']);
	$section->append('input', null, [
		'type' => 'date',
		'name' => 'ad-insertion[date]',
		'id' => 'ad-insertion[date]',
		'placeholder' => 'YY-mm-dd',
		'require' => true
	]);
	$section->append('label', 'By: ', ['for' => 'ad-insertion[by]']);
	$section->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[by]',
		'id' => 'ad-insertion[by]',
		'pattern' => '[A-z ]+',
		'required' => true
	]);
	$section->append('br');
	$section->append('label', 'A', ['for' => 'ad-insertion[section][a]']);
	$section->append('input', null, [
		'type' => 'checkbox',
		'name' => 'ad-insertion[section][a]',
		'id' => 'ad-insertion[section][a]'
	]);
	$section->append('label', 'B', ['for' => 'ad-insertion[section][b]']);
	$section->append('input', null, [
		'type' => 'checkbox',
		'name' => 'ad-insertion[section][b]',
		'id' => 'ad-insertion[section][b]'
	]);
	$section->append('label', 'C', ['for' => 'ad-insertion[section][c]']);
	$section->append('input', null, [
		'type' => 'checkbox',
		'name' => 'ad-insertion[section][c]',
		'id' => 'ad-insertion[section][c]'
	]);
	$section->append('label', 'D', ['for' => 'ad-insertion[section][d]']);
	$section->append('input', null, [
		'type' => 'checkbox',
		'name' => 'ad-insertion[section][d]',
		'id' => 'ad-insertion[section][d]'
	]);
	$section->append('label',' Classification', ['for' => 'ad-insertion[classification]']);
	$section->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[classification]',
		'id' => 'ad-insertion[classification]',
		'required' => true
	]);
	$section->append('label', null, [
		'for' => 'ad-insertion[special-edition]'
	])->append('i', 'Special Edition');
	$section->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[special-edition]',
		'id' => 'ad-insertion[special-edition]'
	]);
	unset($section);

	$contact = $form->append('fieldset', null, ['for' => 'ad-insertion']);
	$contact->append('legend', 'Contact Info');
	$contact->append('label', 'Account name: ', ['for' => 'ad-insertion[acct-name]']);
	$contact->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[acct-name]',
		'id' => 'ad-insertion[acct-name]',
		'pattern' => '[\w ]+',
		'required' => ''
	]);
	$contact->append('br');
	$contact->append('label', 'Contact: ', ['for' => 'ad-insertion[contact]']);
	$contact->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[contact]',
		'id' => 'ad-insertion[contact]',
		// 'placeholder' => 'First Last',
		'pattern' => '[A-z \.]+',
		'required' => ''
	]);
	$contact->append('label', 'Phone: ', ['for' => 'ad-insertion[phone]']);
	$contact->append('input', null, [
		'type' => 'tel',
		'name' => 'ad-insertion[phone]',
		'id' => 'ad-insertion[phone]',
		'required' => ''
	]);
	$contact->append('br');
	$contact->append('label', 'Address: ', ['for' => 'ad-insertion[address]']);
	$contact->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[address]',
		'id' => 'ad-insertion[address]',
		'pattern' => '[\w \.]+',
		'required' => ''
	]);
	unset($contact);

	$charges = $form->append('fieldset', null, ['form' => 'ad-insertion']);
	$charges->append('legend', 'Charges');
	$charges->append('label', 'Rate: ',['for' => 'ad-insertion[rate]']);
	$charges->append('input', null, [
		'type' => 'number',
		'name' => 'ad-insertion[rate]',
		'id' => 'ad-insertion[rate]',
		'min' => '0',
		'step' => 0.01,
		'value' => '0',
		'required' => ''
	]);
	$charges->append('label', 'Color Rate: ',['for' => 'ad-insertion[color-rate]']);
	$charges->append('input', null, [
		'type' => 'number',
		'name' => 'ad-insertion[color-rate]',
		'id' => 'ad-insertion[color-rate]',
		'min' => '0',
		'step' => 0.01,
		'value' => '0',
		'required' => ''
	]);
	$charges->append('label', 'Full ', ['for' => 'ad-insertion[q][full]']);
	$charges->append('input', null, [
		'type' => 'radio',
		'name' => 'ad-insertion[q]',
		'id' => 'ad-insertion[q][full]',
		'value' => 'full'
	]);
	$charges->append('label', '1 ', ['for' => 'ad-insertion[q][1]']);
	$charges->append('input', null, [
		'type' => 'radio',
		'name' => 'ad-insertion[q]',
		'id' => 'ad-insertion[q][1]',
		'value' => '1'
	]);
	$charges->append('label', '2 ', ['for' => 'ad-insertion[q][2]']);
	$charges->append('input', null, [
		'type' => 'radio',
		'name' => 'ad-insertion[q]',
		'id' => 'ad-insertion[q][2]',
		'value' => '2'
	]);
	$charges->append('br');
	$charges->append('h2', 'Size');
	$charges->append('hr');
	$charges->append('label', 'Width: ', ['for' => 'ad-insertion[size][width]']);
	$charges->append('input', null, [
		'type' => 'number',
		'name' => 'ad-insertion[size][width]',
		'id' => 'ad-insertion[size][width]',
		'min' => '1',
		'max' => '6',
		'step' => '1',
		'required' => ''
	]);
	$charges->append('label', 'Height: ', ['for' => 'ad-insertion[size][height]']);
	$charges->append('input', null, [
		'type' => 'number',
		'name' => 'ad-insertion[size][height]',
		'id' => 'ad-insertion[size][height]',
		'min' => '1',
		'max' => '21',
		'step' => '0.5',
		'required' => ''
	]);
	$charges->append('h2', 'Run Dates');
	$charges->append('hr');
	$charges->append('label', 'From: ', ['for' => 'ad-insertion[run][start]']);
	$charges->append('input', null, [
		'type' => 'date',
		'name' => 'ad-insertion[run][start]',
		'id' => 'ad-insertion[run][start]',
		'placeholder' => 'YYYY-mm-dd',
		'required' => ''
	]);
	$charges->append('label', 'To: ', ['for' => 'ad-insertion[run][end]']);
	$charges->append('input', null, [
		'type' => 'date',
		'name' => 'ad-insertion[run][end]',
		'id' => 'ad-insertion[run][end]',
		'placeholder' => 'YYYY-mm-dd',
		'required' => ''
	]);
	$charges->append('label', null, [
		'for' => 'ad-insertion[sheets]'
	])->append('b')->append('abbr', 'TFN', [
		'title' => 'Tile Further Notice'
	]);
	$charges->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[sheets]',
		'id' => 'ad-insertion[sheets]'
	]);
	$charges->append('br');
	$charges->append('label', null, ['for' => 'ad-insertion[pu]'])->append('abbr', 'P/U', ['title' => 'Puck-Up']);
	$charges->append('input', null, [
		'type' => 'text',
		'name' => 'ad-insertion[pu]',
		'id' => 'ad-insertion[pu]'
	]);
	unset($charges);

	$info = $form->append('fieldset');
	$info->append('legend', 'Ad Description &amp; Info');
	$info->append('br');
	$info->append('textarea', null, [
		'name' => 'ad-insertion[info]',
		'id' => 'ad-insertion[info]',
		'required' => ''
	]);
	$info->append('br');
	$info->append('label', 'Attachments: ', ['for' => 'ad-insertion[attachments]']);
	$info->append('input', null, [
		'type' => 'file',
		'name' => 'ad-insertion[attachments]',
		'id' => 'ad-insertion[attachments]'
	]);
	unset($info);

	$form->append('button', 'Submit', ['type' => 'submit']);
	$form->append('button', 'Reset', ['type' => 'reset']);
	$form->append('hr');

	$footer->append('a', 'Contact', [
		'href' => '#contact-dialog',
		'role' => 'button'
	]);
	$dialog = $footer->append('dialog', null, ['id' => 'contact-dialog']);
	$dialog->append('button', 'x', [
		'type' => 'button',
		'data-close-modal' => '#contact-dialog'
	]);
	$dialog->append('br');
	$dialog->append('a', null, [
		'href' => 'mailto:editor@kvsun.com',
		'title' => 'Email'
	])->append('img', null, [
		'src' => 'images/octicons/svg/mail-read.svg',
		'alt' => 'Email',
		'width' => 60,
		'height' => 60
	]);
	$dialog->append('a', null, [
		'href' => 'https://gitter.im/KVSun/ad-insertion',
		'target' => '_blank',
		'title' => 'Chat on Gitter'
	])->append('img', null, [
		'src' => 'images/octicons/svg/comment.svg',
		'alt' => 'Gitter',
		'width' => 60,
		'height' => 60
	]);
	$dialog->append('a', null, [
		'href' => 'https://github.com/KVSun/ad-insertion/',
		'target' => '_blank',
		'title' => 'GitHub'
	])->append('img', null, [
		'src' => 'images/octicons/svg/mark-github.svg',
		'alt' => 'GitHub',
		'width' => 60,
		'height' => 60
	]);
	$dialog->append('a', null, [
		'href' => 'https://github.com/KVSun/ad-insertion/issues/new/',
		'target' => '_blank',
		'title' => 'Open Issue'
	])->append('img', null, [
		'src' => 'images/octicons/svg/issue-opened.svg',
		'alt' => 'Open Issue',
		'width' => 60,
		'height' => 60
	]);
	exit($dom);
} elseif ($headers->accept === 'application/json') {
	$headers->content_type = 'application/json';
	exit(json_encode(['post' => $_POST, 'file' => $_FILES]));
}
