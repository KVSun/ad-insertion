<?php
$size = ['height' => 60, 'width' => 60];
$dialog = \shgysk8zer0\DOM\HTML::getInstance()->createElement('dialog');
$dialog->id = 'contact-dialog';
$dialog->append('button', null, [
	'type' => 'button',
	'data-close' => '#contact-dialog'
]);
$dialog->append('br');
$dialog->append('a', null, [
	'href' => 'mailto:editor@kvsun.com',
	'title' => 'Email'
])->import(\shgysk8zer0\DOM\SVG::useIcon('mail-read', $size), true);
$dialog->append('a', null, [
	'href' => 'https://gitter.im/KVSun/ad-insertion',
	'target' => '_blank',
	'title' => 'Chat on Gitter'
])->import(\shgysk8zer0\DOM\SVG::useIcon('comment', $size), true);
$dialog->append('a', null, [
	'href' => 'https://github.com/KVSun/ad-insertion/',
	'target' => '_blank',
	'title' => 'GitHub'
])->import(\shgysk8zer0\DOM\SVG::useIcon('mark-github', $size), true);
$dialog->append('a', null, [
	'href' => 'https://github.com/KVSun/ad-insertion/issues/new/',
	'target' => '_blank',
	'title' => 'Open Issue'
])->import(\shgysk8zer0\DOM\SVG::useIcon('issue-opened', $size), true);
return $dialog;
