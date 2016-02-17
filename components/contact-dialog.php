<?php
$dialog = $dom->body->getElementsByTagName('footer')->item(0)->append('dialog', null, ['id' => 'contact-dialog']);
$dialog->append('button', null, [
	'type' => 'button',
	'data-close' => '#contact-dialog'
]);
$dialog->append('br');
$dialog->append('a', null, [
	'href' => 'mailto:editor@kvsun.com',
	'title' => 'Email'
])->append('svg', null, [
	'width' => 60,
	'height' => 60
])->append('use', null, ['xlink:href' => 'images/icons.svg#mail-read']);
$dialog->append('a', null, [
	'href' => 'https://gitter.im/KVSun/ad-insertion',
	'target' => '_blank',
	'title' => 'Chat on Gitter'
])->append('svg', null, [
	'width' => 60,
	'height' => 60
])->append('use', null, ['xlink:href' => 'images/icons.svg#comment']);
$dialog->append('a', null, [
	'href' => 'https://github.com/KVSun/ad-insertion/',
	'target' => '_blank',
	'title' => 'GitHub'
])->append('svg', null, [
	'width' => 60,
	'height' => 60
])->append('use', null, ['xlink:href' => 'images/icons.svg#mark-github']);
$dialog->append('a', null, [
	'href' => 'https://github.com/KVSun/ad-insertion/issues/new/',
	'target' => '_blank',
	'title' => 'Open Issue'
])->append('svg', null, [
	'width' => 60,
	'height' => 60
])->append('use', null, ['xlink:href' => 'images/icons.svg#issue-opened']);
