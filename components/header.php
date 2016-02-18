<?php
$header = $dom->body->append('header');
$header->append('h1', 'KV Sun Ad Insertion', [
	'class' => 'center'
])->append('img', null, [
	'alt' => 'KV Sun Logo',
	'src' => 'sun.svg',
	'width' => 266,
	'height' => 90
]);
