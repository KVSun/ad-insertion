<?php
$parsedown = new \Parsedown\Parsedown();
$footer = $dom->body->append('footer');
$readme = $footer->append('dialog', null, ['id' => 'README-dialog']);
$readme->append('button', 'x', [
	'type' => 'button',
	'data-close-modal' => "#{$readme->id}"
]);
$readme->append('br');
$readme->importHTML($parsedown->text(file_get_contents('README.md')));
$footer->append('button', null, [
	'title' => 'Contact info',
	'data-show-modal' => '#contact-dialog'
])->append('img', null, [
	'src' => 'images/octicons/svg/person.svg',
	'alt' => 'View contact info',
	'height' => 50
]);;
$footer->append('button', null, [
	'title' => 'View README/documentation',
	'data-show-modal' => "#{$readme->id}"
])->append('img', null, [
	'src' => 'images/octicons/svg/book.svg',
	'alt' => 'View README',
	'height' => 50
]);
unset($parsedown, $readme);
require_once './components/contact-dialog.php';
