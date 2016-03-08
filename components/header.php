<?php
namespace Components\Header;
return function()
{
	$header = \shgysk8zer0\DOM\HTML::getInstance()->createElement('header');
	$header->append('h1', 'KV Sun Ad Insertion', [
		'class' => 'center'
	])->append('img', null, [
		'alt' => 'KV Sun Logo',
		'src' => 'sun.svg',
		'width' => 266,
		'height' => 90
	]);
	return $header;
};
