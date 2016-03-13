<?php
namespace Components\Head;

use \shgysk8zer0\DOM as DOM;
use \shgysk8zer0\Core as Core;

return function()
{
	$dom = DOM\HTML::getInstance();
	$url = Core\URL::getClone();
	unset($url->path, $url->query, $url->fragment, $url->user, $url->pass);
	$frag = $dom->createDocumentFragment();

	$frag('title', 'Ad Insertion');
	$frag('base', null, ['href' => $url]);
	$frag('link', null, [
		'rel' => 'icon',
		'href' => 'favicon.svg',
		'type' => 'image/svg+xml',
		'sizes' => 'any'
	]);
	$frag('link', null, [
		'rel' => 'stylesheet',
		'href' => 'stylesheets/styles/styles.css',
		'media' => 'all'
	]);
	$frag('link', null, [
		'rel' => 'prefetch',
		'href' => 'images/icons.svg',
		'type' => 'image/svg+xml'
	]);
	$frag('script', null, [
		'type' => 'application/javascript',
		'src' => 'scripts/custom.js',
		'async' => ''
	]);
	$frag('meta', null, [
		'name' => 'description',
		'content' => 'An ad insertion form for the Kern Valley Sun'
	]);
	return $frag;
};
