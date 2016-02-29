<?php
namespace Components\Footer;
$size = ['height' => 50, 'width' => 50];
$url = \shgysk8zer0\Core\URL::getInstance();
$params = new \shgysk8zer0\Core\URLSearchParams();
$params->load = 'readme';
$url->query = "$params";
$footer = \shgysk8zer0\DOM\HTML::getInstance()->createElement('footer');
$footer->append('a', null, [
	'title' => 'View README/documentation',
	'href' => $url,
	'role' => 'button'
])->import(\shgysk8zer0\DOM\SVG::useIcon('book', $size));

$params->load = 'ad-insertion';
$url->query = "$params";
$footer->append('button', null, [
	'title' => 'Contact info',
	'data-show-modal' => '#contact-dialog'
])->import(\shgysk8zer0\DOM\SVG::useIcon('person', $size));
$footer->append('a', 'Ad Insertion', ['href' => $url]);
$footer('contact-dialog');
return $footer;
