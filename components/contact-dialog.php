<?php
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
