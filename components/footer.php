<?php
namespace Components\Footer;
function loadFooter()
{
	$size = ['height' => 50, 'width' => 50];
	$params = new \shgysk8zer0\Core\URLSearchParams();
	$params->load = 'readme';
	$footer = \shgysk8zer0\DOM\HTML::getInstance()->createElement('footer');
	$footer->append('a', null, [
		'title' => 'View README/documentation',
		'href' => "?{$params}",
		'role' => 'button'
	])->import(\shgysk8zer0\DOM\SVG::useIcon('book', $size));

	$params->load = 'ad_insertion';
	$contact = $footer('contact_dialog')[0];
	$footer->append('button', null, [
		'title' => 'Contact info',
		'data-show-modal' => "#{$contact->id}"
	])->import(\shgysk8zer0\DOM\SVG::useIcon('person', $size));

	$footer->append('a', 'Ad Insertion', ['href' => "?{$params}"]);
	$params->load = 'circulation';
	return $footer;
}
return loadFooter();
