<?php
$parsedown = new \Parsedown\Parsedown();
$footer = $dom->body->append('footer');
$readme = $footer->append('dialog', null, ['id' => 'README-dialog']);
$readme->append('button', 'x', [
	'type' => 'button',
	'data-close-modal' => "#{$readme->id}"
]);
$readme->importHTML($parsedown->text(file_get_contents('README.md')));
$footer->append('button', 'Contact', ['data-show-modal' => '#contact-dialog']);
$footer->append('button', 'Documentation', ['data-show-modal' => "#{$readme->id}"]);
unset($parsedown, $readme);
require_once './components/contact-dialog.php';
