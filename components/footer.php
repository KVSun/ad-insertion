<?php
$footer = \shgysk8zer0\DOM\HTML::getInstance()->createElement('footer');
$footer->append('a', null, [
	'title' => 'View README/documentation',
	'href' => './?load=readme',
	'role' => 'button'
	// 'data-show-modal' => "#{$readme->id}"
])->append('svg', null, [
	'height' => 50,
	'width' => 50
])->append('use', null, [
	'xlink:href' => 'images/icons.svg#book'
]);
$footer->append('button', null, [
	'title' => 'Contact info',
	'data-show-modal' => '#contact-dialog'
])->append('svg', null, [
	'height' => 50,
	'width' => 50
])->append('use', null, [
	'xlink:href' => 'images/icons.svg#person'
]);

$footer('contact-dialog');
return $footer;
// require_once './components/contact-dialog.php';
