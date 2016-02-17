<?php
$parsedown = new \Parsedown\Parsedown();
$footer = $dom->body->getElementsByTagName('footer')->item(0);
$readme = $footer->append('dialog', null, ['id' => 'README-dialog']);
$readme->append('button', null, [
	'type' => 'button',
	'data-close' => "#{$readme->id}"
]);
$readme->append('br');
$readme->importHTML($parsedown->text(file_get_contents('README.md')));
$footer->append('button', null, [
	'title' => 'Contact info',
	'data-show-modal' => '#contact-dialog'
])->append('svg', null, [
	'height' => 50,
	'width' => 50
])->append('use', null, [
	'xlink:href' => 'images/icons.svg#person'
]);
