<?php
namespace Components\Head;
return function()
{
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	$url = \shgysk8zer0\Core\URL::getInstance();
	unset($url->path, $url->query, $url->fragment, $url->user, $url->pass);
	$frag = $dom->createDocumentFragment();

	$frag('title', 'Ad Insertion');
	$frag('base', null, ['href' => is_array($_SERVER) ? "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}" : '/']);
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
	$frag('base', null, ['href' => $url]);
	$frag('script', null, [
		'type' => 'application/javascript',
		'src' => 'scripts/custom.js',
		'defer' => true
	]);
	$frag('meta', null, [
		'name' => 'description',
		'content' => 'An ad insertion form for the Kern Valley Sun'
	]);
	return $frag;
};
