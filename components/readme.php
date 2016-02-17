<?php
$parsedown = new \Parsedown\Parsedown();
$readme = $dom->body->append('dialog', null, ['id' => 'README-dialog']);
$readme->append('button', null, [
	'type' => 'button',
	'data-close' => "#{$readme->id}"
]);
$readme->append('br');
$readme->importHTML($parsedown->text(file_get_contents('README.md')));
