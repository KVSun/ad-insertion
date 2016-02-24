<?php
$size = ['height' => 50, 'width' => 50];
$footer = \shgysk8zer0\DOM\HTML::getInstance()->createElement('footer');
$footer->append('a', null, [
	'title' => 'View README/documentation',
	'href' => './?load=readme',
	'role' => 'button'
])->import(\shgysk8zer0\DOM\SVG::useIcon('book', $size));
$footer->append('button', null, [
	'title' => 'Contact info',
	'data-show-modal' => '#contact-dialog'
])->import(\shgysk8zer0\DOM\SVG::useIcon('person', $size));

$footer('contact-dialog');
return $footer;
