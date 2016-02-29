<?php
namespace Components\Footer;
function loadFooter()
{
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

	$params->load = 'ad_insertion';
	$url->query = "$params";
	$contact = $footer('contact_dialog')[0];
	$footer->append('button', null, [
		'title' => 'Contact info',
		'data-show-modal' => "#{$contact->id}"
	])->import(\shgysk8zer0\DOM\SVG::useIcon('person', $size));
	$footer->append('a', 'Ad Insertion', ['href' => $url]);
	return $footer;
}
return loadFooter();
