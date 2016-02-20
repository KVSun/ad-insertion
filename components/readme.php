<?php
$parsedown = new \Parsedown\Parsedown();
$readme = \shgysk8zer0\DOM\HTML::getInstance()->createElement('dialog');
$readme->id = 'README-dailog';
$readme->append('button', null, [
	'type' => 'button',
	'data-close' => "#{$readme->id}"
]);
$readme->append('br');
$readme->importHTML($parsedown->text(file_get_contents('README.md')));
return $readme;
