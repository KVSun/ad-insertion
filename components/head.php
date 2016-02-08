<?php
$dom->head->append('title', 'Ad Insertion');
$dom->head->append('link', null, [
	'rel' => 'icon',
	'href' => 'sun.svg',
	'type' => 'image/svg+xml',
	'sizes' => 'any'
]);
$dom->head->append('link', null, [
	'rel' => 'stylesheet',
	'href' => 'stylesheets/styles/import.css',
	'media' => 'all'
]);
$dom->head->append('script', null, [
	'type' => 'application/javascript',
	'src' => 'scripts/inputdate.es6',
	'defer' => true
]);
$dom->head->append('script', null, [
	'type' => 'application/javascript',
	'src' => 'scripts/custom.es6',
	'defer' => true
]);
$dom->head->append('meta', null, [
	'name' => 'description',
	'content' => 'An ad insertion form for the Kern Valley Sun'
]);
