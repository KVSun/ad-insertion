<?php
namespace Components\Readme;
const README = './README.md';
function get_readme()
{
	$parsedown = new \Parsedown\Parsedown();
	return $parsedown->text(file_get_contents(README));
}

$readme = \shgysk8zer0\DOM\HTML::getInstance()->createElement('dialog');
$readme->id = 'README-dailog';
$readme->append('button', null, [
	'type' => 'button',
	'data-delete' => "#{$readme->id}"
]);
$readme->append('button', null, [
	'type' => 'button',
	'data-fullscreen' => "#{$readme->id}"
]);
$readme->append('br');
$readme->importHTML(get_readme());
return $readme;
