<?php
$dom = \shgysk8zer0\DOM\HTML::getInstance();
$head = $dom->createDocumentFragment();
$dom->head->append('title', 'Ad Insertion');
$dom->head->append('link', null, [
	'rel' => 'icon',
	'href' => 'sun.svg',
	'type' => 'image/svg+xml',
	'sizes' => 'any'
]);
$dom->head->append('link', null, [
	'rel' => 'stylesheet',
	'href' => 'stylesheets/styles/styles.css',
	'media' => 'all'
]);
$dom->head->append('link', null, [
	'rel' => 'prefetch',
	'href' => 'images/icons.svg',
	'type' => 'image/svg+xml'
]);
$dom->head->append('script', null, [
	'type' => 'application/javascript',
	'src' => 'scripts/std-js/prototypes.es6',
	'defer' => true
]);
$dom->head->append('script', null, [
	'type' => 'application/javascript',
	'src' => 'scripts/custom.js',
	'defer' => true
]);
$dom->head->append('meta', null, [
	'name' => 'description',
	'content' => 'An ad insertion form for the Kern Valley Sun'
]);
