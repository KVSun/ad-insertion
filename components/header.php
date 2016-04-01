<?php
namespace Components\Header;
return function()
{
	$header = \shgysk8zer0\DOM\HTML::getInstance()->createElement('header');
	$header->append('h1', 'KV Sun Ad Insertion', [
		'class' => 'center'
	])->importHTML(file_get_contents('sun.svg'));
	return $header;
};
