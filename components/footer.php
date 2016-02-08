<?php
$footer = $dom->body->append('footer');
$footer->append('a', 'Contact', [
	'href' => '#contact-dialog',
	'role' => 'button'
]);
require_once './components/contact-dialog.php';
