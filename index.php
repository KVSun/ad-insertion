<?php
require_once './functions.php';
$console = \shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$headers = new \shgysk8zer0\Core\Headers();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	$dom->body->class = 'flex column';
	\KVSun\load('head', 'header', 'main', 'forms/ad-insertion', 'footer');
	exit($dom);
} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {

	$headers->content_type = 'application/json';
	exit(json_encode(['post' => $_POST, 'file' => $_FILES]));
}
