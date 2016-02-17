<?php
$footer = $dom->body->append('footer');
\KVSun\Load('readme');
$footer->append('button', null, [
	'title' => 'View README/documentation',
	'data-show-modal' => "#{$readme->id}"
])->append('svg', null, [
	'height' => 50,
	'width' => 50
])->append('use', null, [
	'xlink:href' => 'images/icons.svg#book'
]);
unset($parsedown, $readme);
require_once './components/contact-dialog.php';
