<?php
namespace Components\Footer;
use \shgysk8zer0\DOM as DOM;

return function()
{
	$size = ['height' => 50, 'width' => 50];
	$params = new \shgysk8zer0\Core\URLSearchParams();

	$params->load = 'readme';
	$footer = DOM\HTML::getInstance()->createElement('footer');
	$footer->append('a', null, [
		'title' => 'View README/documentation',
		'href' => "?{$params}",
		'role' => 'button'
	])->import(DOM\SVG::useIcon('info', $size));

	$contact = $footer('contact_dialog')[0];
	$footer->append('button', null, [
		'title' => 'Contact info',
		'data-show-modal' => "#{$contact->id}"
	])->import(DOM\SVG::useIcon('organization', $size));

	$params->load = 'login';
	$footer->append('a', null, [
		'href' => "?{$params}",
		'title' => 'login',
		'role' => 'button'
	])->import(DOM\SVG::useIcon('sign-in', $size));

	$params->load = 'ad_insertion';
	$footer->append('a', null, [
		'href' => "?{$params}",
		'title' => 'Ad Insertion',
		'role' => 'button'
	])->import(DOM\SVG::useIcon('smiley', $size));

	$params->load = 'circulation';
	$footer->append('a', null, [
		'href' => "?{$params}",
		'title' => 'Circulation',
		'role' => 'button'
	])->import(DOM\SVG::useIcon('credit-card', $size));

	return $footer;
};
