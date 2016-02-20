<?php
$dom = \shgysk8zer0\DOM\HTML::getInstance();
$frag = $dom->createDocumentFragment();

$frag('title', 'Ad Insertion');
$frag('link', null, [
	'rel' => 'icon',
	'href' => 'sun.svg',
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
	'src' => 'scripts/std-js/prototypes.es6',
	'defer' => true
]);
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
